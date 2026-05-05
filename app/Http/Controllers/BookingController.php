<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show booking form for a destination
     */
    public function create(Destination $destination)
    {
        $packages = Package::where('destination_id', $destination->id)
            ->where('status', 'Active')
            ->get();
        
        return view('booking.create', compact('destination', 'packages'));
    }

    /**
     * Store a new booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'package_id' => 'nullable|exists:packages,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'institution' => 'nullable|string|max:255',
            'visit_date' => 'required|date|after:today',
            'participants' => 'required|integer|min:1|max:100',
            'notes' => 'nullable|string',
        ]);

        $destination = Destination::findOrFail($validated['destination_id']);
        
        // Calculate total amount
        $pricePerPax = $destination->price;
        if (!empty($validated['package_id'])) {
            $package = Package::find($validated['package_id']);
            if ($package) {
                $pricePerPax = $package->price;
            }
        }
        
        $totalAmount = $pricePerPax * $validated['participants'];

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'destination_id' => $validated['destination_id'],
            'package_id' => $validated['package_id'] ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'institution' => $validated['institution'] ?? null,
            'visit_date' => $validated['visit_date'],
            'participants' => $validated['participants'],
            'total_amount' => $totalAmount,
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
            'notes' => $validated['notes'] ?? null,
        ]);

        // Load relations for email
        $booking->load(['destination', 'package']);

        // Send invoice email
        try {
            Mail::to($booking->customer_email)->send(new InvoiceMail($booking));
        } catch (\Exception $e) {
            // Log error but don't fail the booking
            \Log::error('Failed to send invoice email: ' . $e->getMessage());
        }

        return redirect()->route('user.invoices.show', $booking)
            ->with('success', 'Booking berhasil! Invoice sudah dikirim ke email Anda.');
    }

    /**
     * Show booking success page
     */
    public function success(Booking $booking)
    {
        // Check if booking belongs to user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['destination', 'package']);
        
        return view('booking.success', compact('booking'));
    }
}
