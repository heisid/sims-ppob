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
            padding: 15px 10px;
            border-radius: 12px;
            height: 100%;
        }

        .service-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .service-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            line-height: 1.3;
        }

        .banner-img {
            padding: 10px;
            cursor: pointer;
            border-radius: 12px;
        }

        @media (max-width: 576px) {
            .service-icon {
                width: 50px;
                height: 50px;
            }

            .service-text {
                font-size: 11px;
            }

            .service-item {
                padding: 10px 5px;
            }
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 1.25rem;
            }
        }

        .slick-slide {
            padding: 0 5px;
        }

        @media (max-width: 768px) {
            .slick-slide {
                padding: 0 2px;
            }
        }
    </style>
<?= $this->include('partials/profile_balance_css') ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<?= $this->include('partials/profile_balance') ?>

    <div class="row g-2 g-md-3 mb-4">
        <?php foreach($services as $service): ?>
            <!-- Responsive columns: 3 per row on mobile, 4 on tablet, all services in one row on laptop/desktop -->
            <div class="col-4 col-sm-3 col-lg">
                <div class="service-item h-100" data-code="<?= $service['service_code'] ?>">
                    <div class="service-icon">
                        <img class="img-fluid" src="<?= $service['service_icon'] ?>" alt="<?= $service['service_name'] ?>" />
                    </div>
                    <div class="service-text"><?= $service['service_name'] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4 mt-md-5">
        <h3 class="section-title mb-3">Temukan promo menarik</h3>
        <div class="bannerSlider">
            <?php foreach($banners as $banner): ?>
                <div class="px-1">
                    <img src="<?= $banner['banner_image'] ?>" alt="<?= $banner['banner_name'] ?>" class="img-fluid banner-img w-100">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
    <script src="<?= base_url('/js/slick.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            const bannerSlider = $(".bannerSlider")

            bannerSlider.slick({
                arrows: true,
                autoplay: true,
                autoplaySpeed: 3000,
                infinite: true,
                centerMode: true,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '60px',
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            centerPadding: '40px',
                            arrows: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '20px',
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });

            if ($(window).width() >= 1024) {
                bannerSlider.slick('slickSetOption', 'slidesToShow', 4, true);
                bannerSlider.slick('slickSetOption', 'centerPadding', '100px', true);
            }

            $('.service-item').click(function() {
                const serviceCode = $(this).data('code')
                if (serviceCode) {
                    window.location.href = `/transaction/pay/${serviceCode}`;
                }
            });
        });
    </script>
<?= $this->include('partials/profile_balance_js') ?>
<?= $this->endSection(); ?>