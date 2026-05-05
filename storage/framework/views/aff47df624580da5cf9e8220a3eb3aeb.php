

<?php $__env->startSection('title', 'Cek Invoice'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="bg-success text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Cek Invoice</h1>
        <p class="lead">Lacak status pembayaran dan booking Anda</p>
    </div>
</div>

<!-- Invoice Check Form -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-receipt text-success" style="font-size: 4rem;"></i>
                        <h3 class="fw-bold mt-3">Masukkan Kode Invoice</h3>
                        <p class="text-muted">Cek status pembayaran dan detail booking Anda</p>
                    </div>

                    <form id="invoiceForm">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kode Invoice</label>
                            <input type="text" class="form-control form-control-lg rounded-pill" 
                                   id="invoiceCode" placeholder="Contoh: INV-2026-001234" required>
                            <small class="text-muted">Kode invoice dapat ditemukan di email konfirmasi</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control form-control-lg rounded-pill" 
                                   id="email" placeholder="email@example.com" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill fw-bold">
                            <i class="bi bi-search me-2"></i>Cari Invoice
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history text-success fs-3"></i>
                            <h6 class="mt-2 mb-0">Status Real-time</h6>
                            <small class="text-muted">Update langsung</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check text-success fs-3"></i>
                            <h6 class="mt-2 mb-0">Data Aman</h6>
                            <small class="text-muted">Terenkripsi SSL</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sample Invoice Result (Hidden by default) -->
<div class="container pb-5 d-none" id="invoiceResult">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-success text-white py-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0"><i class="bi bi-file-text me-2"></i>Detail Invoice</h4>
                        </div>
                        <div class="col-auto">
                            <span id="resultStatus" class="badge bg-warning text-dark px-3 py-2">PENDING</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1 text-muted small">Kode Invoice</p>
                            <h5 class="fw-bold" id="resultInvoiceCode">-</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-1 text-muted small">Tanggal</p>
                            <h5 class="fw-bold" id="resultDate">-</h5>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">Detail Pesanan</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th class="text-end">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Paket Wisata Raja Ampat</td>
                                    <td>2</td>
                                    <td class="text-end">Rp 11.000.000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th class="text-end text-success">Rp 11.000.000</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="alert alert-warning mt-4">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Menunggu Pembayaran</strong><br>
                        <small>Silakan transfer ke rekening berikut:<br>
                        BCA 1234567890 a.n. PT Nusantara Green</small>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="#" id="confirmBtn" class="btn btn-success rounded-pill">Konfirmasi Pembayaran</a>
                        <button id="pdfBtn" class="btn btn-outline-secondary rounded-pill">Download PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Help Section -->
<div class="bg-light py-5">
    <div class="container text-center">
        <h4 class="fw-bold mb-3">Butuh Bantuan?</h4>
        <p class="text-muted mb-4">Tim customer service kami siap membantu Anda</p>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="p-3">
                    <i class="bi bi-whatsapp text-success fs-2"></i>
                    <p class="mt-2 mb-0 fw-bold">WhatsApp</p>
                    <small class="text-muted">+62 812-3456-7890</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="bi bi-envelope text-success fs-2"></i>
                    <p class="mt-2 mb-0 fw-bold">Email</p>
                    <small class="text-muted">support@nusantaragreen.com</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('invoiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const invoiceCode = document.getElementById('invoiceCode').value;
    const email = document.getElementById('email').value;
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Reset state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mencari...';
    document.getElementById('invoiceResult').classList.add('d-none');

    fetch('<?php echo e(route("invoice.check.process")); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({
            invoice_code: invoiceCode,
            email: email
        })
    })
    .then(response => response.json())
    .then(result => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-search me-2"></i>Cari Invoice';

        if (result.success) {
            const data = result.data;
            
            // Populate data
            document.getElementById('resultInvoiceCode').textContent = data.invoice_code;
            document.getElementById('resultDate').textContent = data.date;
            
            // Update badge color
            const badge = document.getElementById('resultStatus');
            badge.textContent = data.status;
            badge.className = 'badge px-3 py-2';
            if (data.payment_status === 'Paid') badge.classList.add('bg-success');
            else if (data.payment_status === 'Pending') badge.classList.add('bg-warning', 'text-dark');
            else badge.classList.add('bg-danger');

            // Table entry
            const tbody = document.querySelector('#invoiceResult tbody');
            tbody.innerHTML = `
                <tr>
                    <td>${data.item_name}</td>
                    <td>${data.qty}</td>
                    <td class="text-end">Rp ${data.price}</td>
                </tr>
            `;

            document.querySelector('#invoiceResult tfoot .text-success').textContent = `Rp ${data.total}`;

            // Payment Instructions
            const alertBox = document.querySelector('#invoiceResult .alert');
            if (data.payment_status === 'Paid') {
                alertBox.className = 'alert alert-success mt-4';
                alertBox.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i><strong>Pembayaran Berhasil</strong><br><small>Pembayaran Anda telah kami terima dan dikonfirmasi. Terima kasih!</small>';
                document.getElementById('confirmBtn').classList.add('d-none');
            } else {
                alertBox.className = 'alert alert-warning mt-4';
                alertBox.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i><strong>Menunggu Pembayaran</strong><br><small>Silakan transfer ke rekening berikut:<br>BCA 1234567890 a.n. PT Nusantara Green</small>';
                document.getElementById('confirmBtn').classList.remove('d-none');
                document.getElementById('confirmBtn').href = `/user/invoices/${data.booking_id}`;
            }

            // PDF Button
            document.getElementById('pdfBtn').onclick = () => {
                window.location.href = `/user/invoices/${data.booking_id}/download-pdf`;
            };

            // Show result
            document.getElementById('invoiceResult').classList.remove('d-none');
            document.getElementById('invoiceResult').scrollIntoView({ behavior: 'smooth' });
        } else {
            alert(result.message || 'Invoice tidak ditemukan.');
        }
    })
    .catch(error => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-search me-2"></i>Cari Invoice';
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mencari invoice.');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/invoice.blade.php ENDPATH**/ ?>