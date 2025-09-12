<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Rosyid Haryadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            color: #333 !important;
        }

        .logo {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .section-title {
            color: #333;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }
    </style>
    <?= $this->renderSection('css') ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="<?= base_url('/img/Logo.png') ?>" alt="Logo" class="logo">
            SIMS PPOB
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="/transaction/topup">Top Up</a>
            <a class="nav-link" href="/transaction">Transaction</a>
            <a class="nav-link" href="/profile">Akun</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?= $this->renderSection('content'); ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/321a7ce62f.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->renderSection('js') ?>
</body>
</html>