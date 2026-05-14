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
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Validasi input dari form
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'participants' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'restaurant' => 'required|string',
            'menu' => 'required|string',
            'meal_frequency' => 'required|integer|min:1',
            'transport' => 'required|string',
        ]);

        $destination = Destination::findOrFail($validated['destination_id']);
        
        // Hitung Durasi (Hari)
        $start = new \DateTime($validated['start_date']);
        $end = new \DateTime($validated['end_date']);
        $days = $end->diff($start)->days + 1;

        // Harga Dasar Destinasi
        $totalAmount = $destination->price * $validated['participants'];

        // Tambahan Biaya Restoran & Menu (Simulasi harga karena di form dikirim nama menu)
        // Kita bisa ambil harga dari data menu di frontend, tapi untuk keamanan kita simulasi di backend
        $menuPrices = [
            'Lobster Bakar' => 185000, 'Cumi Saos Padang' => 75000, 'Kepiting Soka' => 125000, 'Ikan Bakar Jimbaran' => 95000, 'Udang Windu Madu' => 85000,
            'Nasi Campur Bali' => 45000, 'Ayam Betutu' => 65000, 'Sate Lilit Ayam' => 40000, 'Bebek Goreng Crispy' => 85000, 'Lawar Ayam' => 30000,
            'Salad Salmon' => 120000, 'Smoothie Bowl' => 55000, 'Quinoa Veggie Burger' => 75000, 'Avocado Toast Special' => 65000, 'Grilled Chicken Caesar' => 80000
        ];
        $menuPrice = $menuPrices[$validated['menu']] ?? 0;
        $totalAmount += ($menuPrice * $validated['meal_frequency']) * $validated['participants'] * $days;

        // Tambahan Biaya Transportasi
        $transPrice = ($validated['transport'] == 'Udara') ? 850000 : 150000;
        $totalAmount += $transPrice * $validated['participants'] * $days;

        // Kumpulkan informasi detail ke dalam notes
        $notes = "Pesanan Ekowisata:\n" .
                 "- Restoran: {$validated['restaurant']}\n" .
                 "- Menu: {$validated['menu']}\n" .
                 "- Frekuensi Makan: {$validated['meal_frequency']}x sehari\n" .
                 "- Transportasi: {$validated['transport']}\n" .
                 "- Durasi: {$days} hari ({$validated['start_date']} s/d {$validated['end_date']})";

        // Simpan ke Database
        $booking = Booking::create([
            'user_id' => $user->id,
            'destination_id' => $validated['destination_id'],
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone ?? '08123456789', // Menggunakan nomor user atau default
            'visit_date' => $validated['start_date'],
            'participants' => $validated['participants'],
            'total_amount' => $totalAmount,
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
            'notes' => $notes,
        ]);

        // Kirim Email (Opsional, jika mail server sudah siap)
        try {
            Mail::to($user->email)->send(new InvoiceMail($booking));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email: ' . $e->getMessage());
        }

        return redirect()->route('user.invoices.show', $booking)
            ->with('success', 'Pemesanan berhasil! Detail pesanan Anda telah disimpan.');
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
