<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">My App</a>

        <div class="navbar-nav ms-auto">
            <?php if (session()->get('logged_in')): ?>
                <a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a>
                <a class="nav-link" href="<?= base_url('/profile') ?>">Profile</a>
                <a class="nav-link" href="<?= base_url('/topup') ?>">Top Up</a>
                <a class="nav-link" href="<?= base_url('/transaction') ?>">Transactions</a>
                <a class="nav-link" href="<?= base_url('/auth/logout') ?>">Logout</a>
            <?php else: ?>
                <a class="nav-link" href="<?= base_url('/auth/login') ?>">Login</a>
                <a class="nav-link" href="<?= base_url('/auth/register') ?>">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>