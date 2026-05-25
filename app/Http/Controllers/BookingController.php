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
            'hotel' => 'required|string',
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

        $travelOptions = config('travel_pricing.destinations');
        $destinationOptions = $travelOptions[$destination->name] ?? $travelOptions['Default'];

        $hotelPrices = collect($destinationOptions['hotels'])->pluck('price', 'name')->all();
        $selectedRestaurant = collect($destinationOptions['restaurants'])->firstWhere('name', $validated['restaurant']);
        $menuPrices = $selectedRestaurant
            ? collect($selectedRestaurant['menus'])->pluck('price', 'name')->all()
            : [];
        $unavailableHotels = $destination->unavailable_hotels ?? [];
        $unavailableRestaurants = $destination->unavailable_restaurants ?? [];
        $unavailableMenus = $destination->unavailable_menus ?? [];

        if (!$selectedRestaurant || !array_key_exists($validated['hotel'], $hotelPrices) || !array_key_exists($validated['menu'], $menuPrices)) {
            return back()
                ->withErrors(['booking' => 'Pilihan hotel atau menu tidak valid untuk destinasi ini.'])
                ->withInput();
        }

        if (in_array($validated['hotel'], $unavailableHotels, true)) {
            return back()
                ->withErrors(['hotel' => 'Hotel ini sedang penuh. Silakan pilih hotel lain.'])
                ->withInput();
        }

        if (in_array($validated['restaurant'], $unavailableRestaurants, true)) {
            return back()
                ->withErrors(['restaurant' => 'Restoran ini sedang tidak tersedia. Silakan pilih restoran lain.'])
                ->withInput();
        }

        $menuKey = $validated['restaurant'] . '::' . $validated['menu'];
        if (in_array($menuKey, $unavailableMenus, true) || in_array($validated['menu'], $unavailableMenus, true)) {
            return back()
                ->withErrors(['menu' => 'Menu ini sedang habis. Silakan pilih menu lain.'])
                ->withInput();
        }

        $hotelPrice = $hotelPrices[$validated['hotel']];
        $totalAmount += $hotelPrice * $validated['participants'] * $days;

        $menuPrice = $menuPrices[$validated['menu']];
        $totalAmount += ($menuPrice * $validated['meal_frequency']) * $validated['participants'] * $days;

        // Tambahan Biaya Transportasi
        $transPrice = ($validated['transport'] == 'Udara') ? 850000 : 150000;
        $totalAmount += $transPrice * $validated['participants'] * $days;

        // Kumpulkan informasi detail ke dalam notes
        $notes = "Pesanan Ekowisata:\n" .
                 "- Hotel: {$validated['hotel']}\n" .
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
