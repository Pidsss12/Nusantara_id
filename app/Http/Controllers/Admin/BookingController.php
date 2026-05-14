<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'destination', 'package']);

        // Filter by search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('booking_code', 'like', '%' . $request->search . '%')
                    ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                    ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by destination
        if ($request->destination_id) {
            $query->where('destination_id', $request->destination_id);
        }

        // Filter by date
        if ($request->date_from) {
            $query->whereDate('visit_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('visit_date', '<=', $request->date_to);
        }

        $bookings = $query->orderBy('id', 'desc')->paginate(15);
        $destinations = Destination::all();

        // Stats
        $stats = [
            'confirmed' => Booking::where('status', 'Confirmed')->count(),
            'pending' => Booking::where('status', 'Pending')->count(),
            'cancelled' => Booking::where('status', 'Cancelled')->count(),
            'total_revenue' => Booking::where('status', 'Confirmed')->sum('total_amount'),
        ];

        return view('admin.bookings', compact('bookings', 'destinations', 'stats'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'destination', 'package']);
        return response()->json($booking);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('admin.bookings')->with('success', 'Booking updated successfully!');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $booking->update(['status' => $request->status]);
        return redirect()->route('admin.bookings')->with('success', 'Booking status updated to ' . $request->status);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully!');
    }
}
