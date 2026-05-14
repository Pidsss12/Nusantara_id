<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $booking->invoice_code }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #2d3436; margin: 0; padding: 0; }
        .header { position: relative; height: 150px; }
        .curve-bg { position: absolute; top: 0; right: 0; width: 60%; height: 130px; background: #198754; border-radius: 0 0 0 100px; }
        .curve-bg-dark { position: absolute; top: 0; right: 0; width: 55%; height: 110px; background: #2d3436; border-radius: 0 0 0 100px; }
        
        .logo-text { position: absolute; top: 30px; right: 30px; color: white; text-align: right; }
        .logo-text h2 { margin: 0; font-size: 24px; letter-spacing: 2px; }
        .logo-text small { font-size: 10px; text-transform: uppercase; }

        .invoice-title { position: absolute; top: 30px; left: 30px; }
        .invoice-title h1 { margin: 0; font-size: 40px; color: #2d3436; }
        
        .info-table { margin-top: 10px; font-size: 12px; }
        .info-table td { padding: 2px 0; }

        .content { padding: 30px; }
        .user-info { margin-bottom: 30px; width: 100%; }
        .user-info td { vertical-align: top; }
        
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { background: #198754; color: white; text-align: left; padding: 12px; font-size: 13px; border: none; }
        .table td { padding: 15px 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
        
        .summary { width: 100%; margin-top: 30px; }
        .summary td { padding: 5px 0; }
        .total-row { color: #198754; font-weight: bold; font-size: 18px; border-top: 1px solid #198754; }

        .footer-info { margin-top: 50px; width: 100%; border-top: 1px solid #f1f5f9; padding-top: 20px; }
        .footer-info td { vertical-align: middle; }

        .footer-curve { position: fixed; bottom: 0; width: 100%; height: 50px; background: #198754; border-radius: 100px 0 0 0; }
        .footer-curve-dark { position: fixed; bottom: 0; width: 100%; height: 40px; background: #2d3436; border-radius: 100px 0 0 0; }
        
        .signature { margin-top: 30px; text-align: right; }
        .signature-img { height: 40px; opacity: 0.5; }
    </style>
</head>
<body>
    <div class="header">
        <div class="curve-bg"></div>
        <div class="curve-bg-dark"></div>
        <div class="logo-text">
            <h2>EKOWISATA</h2>
            <small>Portal Wisata Indonesia</small>
        </div>
        <div class="invoice-title">
            <h1>INVOICE</h1>
            <table class="info-table">
                <tr>
                    <td width="80">Account No</td>
                    <td width="10">:</td>
                    <td><strong>{{ $booking->user_id }}</strong></td>
                </tr>
                <tr>
                    <td>Invoice No</td>
                    <td>:</td>
                    <td><strong style="color: #198754;">{{ $booking->invoice_code }}</strong></td>
                </tr>
                <tr>
                    <td>Invoice Date</td>
                    <td>:</td>
                    <td><strong>{{ $booking->invoice_date ? $booking->invoice_date->format('d M Y') : now()->format('d M Y') }}</strong></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="content">
        <table class="user-info">
            <tr>
                <td width="50%">
                    <small style="color: #636e72; font-weight: bold; text-transform: uppercase; font-size: 10px;">Pelanggan:</small>
                    <h3 style="margin: 5px 0 0 0;">{{ $booking->customer_name }}</h3>
                    <div style="font-size: 12px; color: #636e72; margin-top: 5px;">
                        {{ $booking->customer_email }}<br>
                        {{ $booking->customer_phone ?? '-' }}
                    </div>
                </td>
                <td width="50%" align="right">
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; display: inline-block; text-align: left;">
                        <small style="color: #636e72; font-weight: bold; text-transform: uppercase; font-size: 10px;">Status Pembayaran:</small><br>
                        <strong style="color: {{ $booking->payment_status == 'Paid' ? '#198754' : '#f39c12' }};">
                            {{ $booking->payment_status == 'Unpaid' ? 'BELUM BAYAR' : ($booking->payment_status == 'Pending' ? 'MENUNGGU VERIFIKASI' : 'LUNAS') }}
                        </strong>
                    </div>
                </td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th width="40">SL</th>
                    <th>Item Description</th>
                    <th width="100" align="center">Price</th>
                    <th width="60" align="center">Qty</th>
                    <th width="120" align="right">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center">1</td>
                    <td>
                        <strong>{{ $booking->destination->name }}</strong><br>
                        <small style="color: #636e72;">{{ $booking->visit_date->format('d F Y') }}</small>
                        @if($booking->notes)
                            <div style="font-size: 10px; color: #636e72; margin-top: 8px; border-top: 1px solid #eee; padding-top: 5px;">
                                {!! nl2br(e($booking->notes)) !!}
                            </div>
                        @endif
                    </td>
                    <td align="center">Rp {{ number_format($booking->total_amount / $booking->participants, 0, ',', '.') }}</td>
                    <td align="center">{{ $booking->participants }}</td>
                    <td align="right"><strong>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <table class="summary" align="right">
            <tr>
                <td width="60%" align="right" style="color: #636e72; font-size: 13px;">Subtotal</td>
                <td width="40%" align="right" style="font-size: 13px; font-weight: bold;">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td align="right" style="color: #636e72; font-size: 13px;">Tax Rate (0%)</td>
                <td align="right" style="font-size: 13px; font-weight: bold;">Rp 0</td>
            </tr>
            <tr class="total-row">
                <td align="right" style="padding-top: 10px;">TOTAL</td>
                <td align="right" style="padding-top: 10px;">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="signature">
            <h4 style="margin: 0; font-weight: bold;">Admin Ekowisata</h4>
            <small style="color: #636e72;">Manager</small>
        </div>

        <table class="footer-info">
            <tr>
                <td width="60%">
                    <h4 style="color: #198754; margin: 0; font-size: 14px;">GET IN TOUCH</h4>
                    <div style="font-size: 11px; color: #636e72; margin-top: 5px;">
                        Jl. Kebon Jeruk No. 123, Jakarta Selatan<br>
                        +62 812-3456-7890 | info@ekowisata.id
                    </div>
                </td>
                <td width="40%" align="right">
                    <p style="font-size: 10px; color: #636e72; font-style: italic;">
                        Note: Harap simpan invoice ini sebagai bukti pemesanan yang sah.
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer-curve"></div>
    <div class="footer-curve-dark"></div>
</body>
</html>
