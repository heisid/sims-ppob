<?= $this->extend('layouts/main'); ?>
<?= $this->section('css'); ?>
<style>
    .balance-card {
        background: linear-gradient(135deg, #ff4757, #ff3742);
        border-radius: 20px;
        color: white;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }

    .balance-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .balance-amount {
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 2px;
    }

    .service-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 24px;
        color: white;
    }

    .service-item {
        text-align: center;
        align-items: center;
        margin-bottom: 20px;
        cursor: pointer;
        transition: transform 0.2s;
        background-color: rgb(240, 240, 240);
        padding: 10px;
        border-radius: 12px;
        height: 100%;
    }

    .service-item:hover {
        transform: translateY(-2px);
    }

    .service-text {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="align-items-center mb-4">
            <img src="<?= base_url('/img/Profile Photo.png'); ?>" alt="User Avatar" class="user-avatar me-3">
            <div>
                <div class="welcome-text">Selamat datang,</div>
                <h2 class="user-name">Kristanto Wibowo</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="balance-card">
            <div class="balance-label">Saldo anda</div>
            <div class="d-flex align-items-center">
                <div class="balance-amount" id="balanceAmount">Rp ••••••••</div>
                <i class="fas fa-eye eye-icon" id="toggleBalance" onclick="toggleBalance()"></i>
            </div>
            <div class="mt-3">
                <small>Lihat Saldo <i class="fas fa-eye ms-1"></i></small>
            </div>
        </div>
    </div>
</div>
<!-- Services Grid -->
<div class="row g-3 mb-4">
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/PBB.png'); ?>" />
            </div>
            <div class="service-text">PBB</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Listrik.png'); ?>" />
            </div>
            <div class="service-text">Listrik</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Pulsa.png'); ?>" />
            </div>
            <div class="service-text">Pulsa</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/PDAM.png'); ?>" />
            </div>
            <div class="service-text">PDAM</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/PGN.png'); ?>" />
            </div>
            <div class="service-text">PGN</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Televisi.png'); ?>" />
            </div>
            <div class="service-text">TV Langganan</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Musik.png'); ?>" />
            </div>
            <div class="service-text">Musik</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Game.png'); ?>" />
            </div>
            <div class="service-text">Voucher Game</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Voucher Makanan.png'); ?>" />
            </div>
            <div class="service-text">Voucher Makanan</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Kurban.png'); ?>" />
            </div>
            <div class="service-text">Kurban</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Zakat.png'); ?>" />
            </div>
            <div class="service-text">Zakat</div>
        </div>
    </div>
    <div class="col-1">
        <div class="service-item">
            <div class="service-icon">
                <img class="img-fluid" src="<?= base_url('/img/Paket Data.png'); ?>" />
            </div>
            <div class="service-text">Paket Data</div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
