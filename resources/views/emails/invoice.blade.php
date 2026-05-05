<x-mail::message>
# Invoice Booking Berhasil! 

Halo **{{ $booking->customer_name }}**,

Terima kasih telah melakukan pemesanan di **NusantaraGreen**! 

---

## Ringkasan Booking

| Keterangan | Detail |
|:-----------|:-------|
| **Kode Invoice** | {{ $booking->invoice_code }} |
| **Destinasi** | {{ $booking->destination->name ?? 'Destinasi' }} |
| **Tanggal Kunjungan** | {{ $booking->visit_date->format('d M Y') }} |
| **Jumlah Peserta** | {{ $booking->participants }} orang |
| **Total Pembayaran** | **Rp {{ number_format($booking->total_amount, 0, ',', '.') }}** |

---

## Invoice PDF Terlampir 📄

Invoice lengkap dengan instruksi pembayaran dan QR code **sudah terlampir dalam format PDF**.

Silahkan unduh file PDF untuk:
- Melihat detail invoice lengkap
- Informasi rekening pembayaran
- QR Code untuk pembayaran
- Menyimpan sebagai bukti

---

@if($booking->payment_status == 'Unpaid')
## Cara Pembayaran

1. **Buka file PDF** yang terlampir
2. **Transfer** sesuai nominal ke rekening yang tertera
3. **Scan QR Code** atau transfer manual
4. **Konfirmasi pembayaran** melalui dashboard

<x-mail::button :url="config('app.url') . '/user/invoices/' . $booking->id" color="success">
Konfirmasi Pembayaran
</x-mail::button>
@endif

---

<x-mail::button :url="config('app.url') . '/user/dashboard'" color="primary">
Lihat Dashboard
</x-mail::button>

---

### Butuh Bantuan?

📧 **Email:** support@nusantaragreen.com  
📱 **WhatsApp:** +62 812-3456-7890

Salam hangat,  
**Tim NusantaraGreen** 🌿

---

<small style="color: #999;">Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</small>
</x-mail::message>
