<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : now()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : now();

        $stats = [
            'total_bookings' => Booking::whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_revenue' => Booking::where('status', 'Confirmed')
                ->whereBetween('updated_at', [$startDate, $endDate])
                ->sum('total_amount'),
            'new_users' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            'avg_booking_value' => Booking::where('status', 'Confirmed')->avg('total_amount') ?? 0,
        ];

        // Top Destinations
        $topDestinations = Destination::withCount(['bookings' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }])
        ->orderByDesc('bookings_count')
        ->limit(5)
        ->get();

        return view('admin.reports', compact('stats', 'topDestinations', 'startDate', 'endDate'));
    }
}
