<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="align-items-center mb-4">
            <img src="<?= session()->get('profile')['profile_image'] ?? base_url('/img/Profile Photo.png'); ?>" alt="User Avatar" class="user-avatar me-3">
            <div>
                <div class="welcome-text">Selamat datang,</div>
                <h2 class="user-name"><?= session()->get('profile')['first_name'] ?> <?= session()->get('profile')['last_name'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="balance-card">
            <div class="balance-label">Saldo anda</div>
            <div class="d-flex align-items-center">
                <div class="balance-amount" id="balanceAmount">Rp ••••••••</div>
            </div>
            <div class="mt-3 toggleBalance" style="cursor:pointer;">
                <small>Lihat Saldo <i class="fas fa-eye ms-1" id="toggleIcon"></i></small>
            </div>
        </div>
    </div>
</div>