<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'invoice_code',
        'user_id',
        'destination_id',
        'package_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'institution',
        'visit_date',
        'participants',
        'total_amount',
        'status',
        'payment_status',
        'invoice_date',
        'payment_date',
        'payment_method',
        'payment_proof',
        'notes',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'invoice_date' => 'datetime',
        'payment_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = self::generateBookingCode();
            }
            if (empty($booking->invoice_code)) {
                $booking->invoice_code = self::generateInvoiceCode();
            }
            if (empty($booking->invoice_date)) {
                $booking->invoice_date = now();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public static function generateBookingCode()
    {
        $date = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'BK' . $date . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public static function generateInvoiceCode()
    {
        $year = now()->format('Y');
        $count = self::whereYear('created_at', $year)->count() + 1;
        return 'INV-' . $year . '-' . str_pad($count, 6, '0', STR_PAD_LEFT);
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return match($this->payment_status) {
            'Paid' => 'success',
            'Pending' => 'warning',
            'Refunded' => 'info',
            default => 'secondary',
        };
    }
}
