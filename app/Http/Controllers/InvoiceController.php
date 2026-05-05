<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Show the invoice check form.
     */
    public function index()
    {
        return view('invoice');
    }

    /**
     * Check invoice status based on invoice code and email.
     */
    public function check(Request $request)
    {
        $request->validate([
            'invoice_code' => 'required|string',
            'email' => 'required|email',
        ]);

        $booking = Booking::with(['destination', 'package'])
            ->where('invoice_code', $request->invoice_code)
            ->where('customer_email', $request->email)
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice tidak ditemukan atau email tidak sesuai.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'invoice_code' => $booking->invoice_code,
                'date' => $booking->invoice_date ? $booking->invoice_date->format('d F Y') : $booking->created_at->format('d F Y'),
                'status' => strtoupper($booking->payment_status),
                'payment_status' => $booking->payment_status,
                'item_name' => $booking->destination->name . ($booking->package ? ' (' . $booking->package->name . ')' : ''),
                'qty' => $booking->participants,
                'price' => number_format($booking->total_amount / $booking->participants, 0, ',', '.'),
                'total' => number_format($booking->total_amount, 0, ',', '.'),
                'booking_id' => $booking->id,
            ]
        ]);
    }
}
