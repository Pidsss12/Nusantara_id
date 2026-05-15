<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk handle file
use Illuminate\Support\Facades\Mail;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get user statistics
        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'confirmed_bookings' => Booking::where('user_id', $user->id)->where('status', 'Confirmed')->count(),
            'pending_bookings' => Booking::where('user_id', $user->id)->where('status', 'Pending')->count(),
            'total_spent' => Booking::where('user_id', $user->id)->where('status', 'Confirmed')->sum('total_amount'),
        ];
        
        // Get recent bookings
        $recentBookings = Booking::where('user_id', $user->id)
            ->with(['destination', 'package'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get upcoming bookings
        $upcomingBookings = Booking::where('user_id', $user->id)
            ->where('status', 'Confirmed')
            ->where('visit_date', '>=', now())
            ->with(['destination', 'package'])
            ->orderBy('visit_date', 'asc')
            ->take(3)
            ->get();
        
        // Get all destinations for interactive map (38+ locations)
        $destinations = Destination::where('status', 'Active')
            ->with('province')
            ->withCount('bookings')
            ->get();
        
        return view('user.dashboard', compact('stats', 'recentBookings', 'upcomingBookings', 'destinations'));
    }

    public function bookings(Request $request)
    {
        $query = Booking::where('user_id', Auth::id())
            ->with(['destination', 'package']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('visit_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('visit_date', '<=', $request->date_to);
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('user.bookings', compact('bookings'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);
        
        $user->update($validated);
        
        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * METHOD BARU: Update Foto Profil
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada agar storage tidak penuh
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan foto baru ke folder profile_photos
            $path = $request->file('photo')->store('profile_photos', 'public');

            // Update path foto di database
            $user->update([
                'profile_photo' => $path
            ]);

            return back()->with('success', 'Profile photo updated successfully!');
        }

        return back()->with('error', 'Failed to upload photo.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        
        return back()->with('success', 'Password changed successfully!');
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        if (!in_array($booking->status, ['Pending', 'Confirmed'])) {
            return back()->with('error', 'This booking cannot be cancelled');
        }
        
        $booking->update(['status' => 'Cancelled']);
        
        return back()->with('success', 'Booking cancelled successfully');
    }

    public function invoices(Request $request)
    {
        $query = Booking::where('user_id', Auth::id())
            ->whereNotNull('invoice_code')
            ->with(['destination', 'package']);
        
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        
        $invoices = $query->orderBy('invoice_date', 'desc')->paginate(10);
        
        return view('user.invoices', compact('invoices'));
    }

    public function invoiceDetail(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        $booking->load(['destination', 'package', 'user']);
        
        return view('user.invoice-detail', compact('booking'));
    }

    public function confirmPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|image|max:2048',
        ]);
        
        $data = [
            'payment_status' => 'Pending',
            'payment_method' => $request->payment_method,
        ];
        
        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $data['payment_proof'] = $path;
        }
        
        $booking->update($data);
        
        return back()->with('success', 'Payment confirmation submitted. Waiting for admin verification.');
    }

    public function downloadInvoicePdf(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['destination', 'package', 'user']);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', ['booking' => $booking]);
        
        return $pdf->download('Invoice-' . $booking->invoice_code . '.pdf');
    }

    public function resendInvoiceEmail(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['destination', 'package']);
        
        try {
            Mail::to($booking->customer_email)->send(new \App\Mail\InvoiceMail($booking));
            return back()->with('success', 'Invoice email sent successfully to ' . $booking->customer_email);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}