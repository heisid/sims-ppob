<?= $this->extend('layouts/main'); ?>
<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('/css/slick.css') ?>">
<link rel="stylesheet" href="<?= base_url('/css/slick-theme.css') ?>">
<style>
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
<?= $this->include('partials/profile_balance_css') ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<?= $this->include('partials/profile_balance') ?>

<!-- Services Grid -->
<div class="row g-3 mb-4">
    <?php foreach($services as $service): ?>
        <div class="col-1">
            <div class="service-item" data-code="<?= $service['service_code'] ?>">
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
    $(document).ready(function() {
        $('.bannerSlider').slick({
            arrows: true,
            autoplay: true,
            autoplaySpeed: 3000,
            centerMode: true,
            centerPadding: '100px',
            slidesToShow: 4,
        })

        $('.service-item').click(function() {
            const serviceCode = $(this).data('code')
            if (serviceCode) {
                window.location.href = `/transaction/pay/${serviceCode}`;
            }
        });
    })
</script>
<?= $this->include('partials/profile_balance_js') ?>
<?= $this->endSection(); ?>
