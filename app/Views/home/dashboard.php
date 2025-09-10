<?= $this->extend('layouts/main'); ?>
<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('/css/slick.css') ?>">
<link rel="stylesheet" href="<?= base_url('/css/slick-theme.css') ?>">
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

    .section-title {
        color: #333;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .banner-img {
        padding: 10px;
        cursor: pointer;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="align-items-center mb-4">
            <img src="<?= $profile_image ?? base_url('/img/Profile Photo.png'); ?>" alt="User Avatar" class="user-avatar me-3">
            <div>
                <div class="welcome-text">Selamat datang,</div>
                <h2 class="user-name"><?= $first_name ?> <?= $last_name ?></h2>
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
<!-- Services Grid -->
<div class="row g-3 mb-4">
    <?php foreach($services as $service): ?>
        <div class="col-1">
            <div class="service-item">
                <div class="service-icon">
                    <img class="img-fluid" src="<?= $service['service_icon'] ?>" />
                </div>
                <div class="service-text"><?= $service['service_name'] ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!--banner-->
<div class="mt-5">
    <h3 class="section-title">Temukan promo menarik</h3>
    <div class="row g-3 bannerSlider">
        <?php foreach($banners as $banner): ?>
            <div>
                <img src="<?= $banner['banner_image'] ?>" alt="<?= $banner['banner_name'] ?>" class="img-fluid banner-img">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="<?= base_url('/js/slick.min.js') ?>"></script>
<script>
    const realBalance = "Rp <?= number_format($balance, 0, ',', '.') ?>"
    let isVisible = false

    function toggleBalance() {
        if (isVisible) {
            $("#balanceAmount").text("Rp ••••••••")
            $("#toggleIcon").removeClass("fa-eye-slash").addClass("fa-eye")
            isVisible = false
        } else {
            $("#balanceAmount").text(realBalance);
            $("#toggleIcon").removeClass("fa-eye").addClass("fa-eye-slash")
            isVisible = true
        }
    }

    $(document).ready(function() {
        $(".toggleBalance").on("click", toggleBalance)
        $('.bannerSlider').slick({
            arrows: true,
            autoplay: true,
            autoplaySpeed: 3000,
            centerMode: true,
            centerPadding: '100px',
            slidesToShow: 4,
        })
    });
</script>
<?= $this->endSection(); ?>
