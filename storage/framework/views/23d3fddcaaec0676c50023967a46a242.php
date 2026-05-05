<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice <?php echo e($booking->invoice_code); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .container { padding: 20px; max-width: 800px; margin: 0 auto; }
        
        /* Header */
        .header { 
            background: linear-gradient(135deg, #198754 0%, #20c997 100%); 
            color: white; 
            padding: 20px; 
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .header-content { display: flex; align-items: center; }
        .logo-box { 
            background: white; 
            border-radius: 50%; 
            padding: 5px; 
            margin-right: 15px;
            width: 60px;
            height: 60px;
            text-align: center;
        }
        .logo-box img { width: 50px; height: 50px; }
        .header-text h1 { font-size: 24px; margin-bottom: 5px; }
        .header-text small { opacity: 0.8; }
        .status-badge { 
            float: right; 
            background: white; 
            color: #198754; 
            padding: 8px 15px; 
            border-radius: 20px; 
            font-weight: bold;
            font-size: 11px;
        }
        
        /* Info boxes */
        .info-row { display: table; width: 100%; margin-bottom: 20px; }
        .info-box { 
            display: table-cell; 
            width: 48%; 
            background: #f8f9fa; 
            padding: 15px; 
            border-radius: 8px;
        }
        .info-box:first-child { margin-right: 4%; }
        .info-box h4 { color: #198754; font-size: 11px; margin-bottom: 8px; }
        .info-box h3 { font-size: 14px; margin-bottom: 5px; }
        .info-box p { font-size: 11px; color: #666; line-height: 1.6; }
        
        /* Grid info */
        .grid-info { display: table; width: 100%; margin-bottom: 20px; }
        .grid-item { 
            display: table-cell; 
            width: 25%; 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: center;
        }
        .grid-item small { display: block; color: #999; font-size: 10px; margin-bottom: 3px; }
        .grid-item strong { font-size: 11px; }
        
        /* Table */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #198754; color: white; padding: 10px; text-align: left; font-size: 11px; }
        td { border: 1px solid #ddd; padding: 10px; font-size: 11px; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        tfoot th { background: #198754; color: white; }
        
        /* Payment section */
        .payment-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .payment-content { display: table; width: 100%; }
        .payment-left { display: table-cell; width: 65%; vertical-align: top; }
        .payment-right { display: table-cell; width: 35%; text-align: center; vertical-align: middle; }
        .payment-box h4 { font-size: 13px; margin-bottom: 10px; color: #856404; }
        .payment-box p { font-size: 11px; margin: 3px 0; }
        .qr-code { max-width: 100px; height: auto; }
        
        /* Footer */
        .footer { 
            text-align: center; 
            margin-top: 30px; 
            padding-top: 15px; 
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="logo-box">
                    <img src="<?php echo e(public_path('img/logo.png')); ?>" alt="Logo">
                </div>
                <div class="header-text">
                    <h1>NusantaraGreen</h1>
                    <small>INVOICE <?php echo e($booking->invoice_code); ?></small>
                </div>
                <div class="status-badge">
                    <?php echo e($booking->payment_status == 'Unpaid' ? 'BELUM BAYAR' : ($booking->payment_status == 'Pending' ? 'MENUNGGU' : 'LUNAS')); ?>

                </div>
            </div>
        </div>
        
        <!-- From & To -->
        <div class="info-row">
            <div class="info-box">
                <h4>DARI</h4>
                <h3>NusantaraGreen</h3>
                <p>
                    Jl. Kebon Jeruk No. 123<br>
                    Jakarta Selatan 12210<br>
                    info@nusantaragreen.com<br>
                    +62 21 1234 5678
                </p>
            </div>
            <div class="info-box">
                <h4>KEPADA</h4>
                <h3><?php echo e($booking->customer_name); ?></h3>
                <p>
                    <?php echo e($booking->customer_email); ?><br>
                    <?php echo e($booking->customer_phone ?? '-'); ?><br>
                    <?php if($booking->institution): ?><?php echo e($booking->institution); ?><?php endif; ?>
                </p>
            </div>
        </div>
        
        <!-- Grid Info -->
        <div class="grid-info">
            <div class="grid-item">
                <small>Tanggal Invoice</small>
                <strong><?php echo e($booking->invoice_date ? $booking->invoice_date->format('d/m/Y') : now()->format('d/m/Y')); ?></strong>
            </div>
            <div class="grid-item">
                <small>Kode Booking</small>
                <strong><?php echo e($booking->booking_code); ?></strong>
            </div>
            <div class="grid-item">
                <small>Tanggal Kunjungan</small>
                <strong><?php echo e($booking->visit_date->format('d/m/Y')); ?></strong>
            </div>
            <div class="grid-item">
                <small>Jumlah Peserta</small>
                <strong><?php echo e($booking->participants); ?> orang</strong>
            </div>
        </div>
        
        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-center" width="60">Qty</th>
                    <th class="text-end" width="120">Harga</th>
                    <th class="text-end" width="120">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong><?php echo e($booking->destination->name ?? 'Destinasi'); ?></strong><br>
                        <small style="color: #666;">
                            <?php if($booking->package): ?>Paket: <?php echo e($booking->package->name); ?> | <?php endif; ?>
                            <?php echo e($booking->visit_date->format('d M Y')); ?>

                        </small>
                    </td>
                    <td class="text-center"><?php echo e($booking->participants); ?></td>
                    <td class="text-end">Rp <?php echo e(number_format($booking->total_amount / $booking->participants, 0, ',', '.')); ?></td>
                    <td class="text-end"><strong>Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></strong></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Subtotal</th>
                    <th class="text-end">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end" style="font-size: 14px;">TOTAL PEMBAYARAN</th>
                    <th class="text-end" style="font-size: 16px;">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></th>
                </tr>
            </tfoot>
        </table>
        
        <!-- Payment Instructions -->
        <?php if($booking->payment_status == 'Unpaid'): ?>
        <div class="payment-box">
            <div class="payment-content">
                <div class="payment-left">
                    <h4>INSTRUKSI PEMBAYARAN</h4>
                    <p><strong>Bank BCA:</strong> 1234567890</p>
                    <p><strong>Bank Mandiri:</strong> 0987654321</p>
                    <p><strong>Bank BNI:</strong> 1122334455</p>
                    <p style="margin-top: 10px;"><small>a.n. PT Nusantara Green</small></p>
                    <p style="margin-top: 10px; font-weight: bold;">Cantumkan kode invoice: <?php echo e($booking->invoice_code); ?></p>
                </div>
                <div class="payment-right">
                    <img src="<?php echo e(public_path('img/qr-payment.png')); ?>" alt="QR Payment" class="qr-code">
                    <p style="font-size: 10px; margin-top: 5px;">Scan untuk bayar</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>NusantaraGreen</strong> - Jelajahi keindahan alam Indonesia dengan bertanggung jawab 🌿</p>
            <p style="margin-top: 5px;">Email: support@nusantaragreen.com | WhatsApp: +62 812-3456-7890</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/pdf/invoice.blade.php ENDPATH**/ ?>