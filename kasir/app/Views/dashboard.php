<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pengaturan->judul ?? 'Home') ?></title>

    <!-- Materio Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>"> -->

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f5fa;
        }
        .content {
            margin-left: 40px;
            padding: 20px;
        }
        .card-custom {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-custom img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-custom h5 {
            margin-top: 10px;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="content">
        
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3 mb-4">
            <span class="navbar-brand">Dashboard</span>
        </nav>

<div class="welcome">
    <?php if (session()->get('level') == 2 && session()->get('nama_kasir')): ?>
        <h4>Selamat Datang, <?= session()->get('nama_kasir') ?>!</h4>
    <?php else: ?>
        <h4>Selamat Datang, <?= session()->get('nama_user') ?>!</h4>
    <?php endif; ?>
</div>

        <!-- Dashboard Cards -->
        <div class="row">
            <div class="col-md-4">
               <!--  <a href="<?= base_url('transactions') ?>" --> <a class="text-decoration-none text-dark">
                    <div class="card card-custom">
                        <img src="<?= base_url('assets/img/dashboard/transactions.jpg') ?>" alt="Transactions">
                        <div class="card-body text-center">
                            <h5>Transactions</h5>
                            <p>Process sales and view recent transactions</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <!-- <a href="<?= base_url('products') ?>" --> <a class="text-decoration-none text-dark">
                    <div class="card card-custom">
                        <img src="<?= base_url('assets/img/dashboard/products.jpg') ?>" alt="Products">
                        <div class="card-body text-center">
                            <h5>Products</h5>
                            <p>Manage items available for sale</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <!-- <a href="<?= base_url('reports') ?>" --> <a class="text-decoration-none text-dark">
                    <div class="card card-custom">
                        <img src="<?= base_url('assets/img/dashboard/reports.jpg') ?>" alt="Reports">
                        <div class="card-body text-center">
                            <h5>Reports</h5>
                            <p>Check sales reports and analytics</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
<!-- 
        <script>
function logUserActivity(activity) {
    fetch('<?= base_url('home/logActivity') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ activity: activity })
    });
}

document.addEventListener('DOMContentLoaded', function() {
    logUserActivity('Visited: ' + window.location.pathname);
    
    document.body.addEventListener('click', function(event) {
        let element = event.target.tagName.toLowerCase();
        logUserActivity('Clicked: ' + element);
    });
});
</script>


 -->