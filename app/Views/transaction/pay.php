<?= $this->extend('layouts/main'); ?>

<?= $this->section('css'); ?>
<?= $this->include('partials/profile_balance_css') ?>
<style>
    #nominalInput[disabled] {
        background-color: #fff !important;
        color: #212529;
        opacity: 1;
    }
    .logo-circle {
        width: 80px;
        height: 80px;
        background-image: url("<?= base_url('img/Logo.png') ?>");
        background-size: cover;
        background-position: center;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px auto;
    }
    .modal-title {
        color: #6c757d;
        font-size: 18px;
        margin-bottom: 20px;
        text-align: center;
    }
    .price-text {
        color: #212529;
        font-size: 32px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-red {
        color: #dc3545;
        background-color: white;
        font-weight: 500;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 6px;
        width: 100%;
        margin-bottom: 15px;
    }

    .btn-red:hover {
        background-color: #c82333;
        border-color: #bd2130;
        color: white;
    }

    .btn-cancel {
        background-color: transparent;
        border: none;
        color: #6c757d;
        font-size: 16px;
        padding: 12px 30px;
        width: 100%;
    }

    .btn-cancel:hover {
        color: #495057;
        background-color: #f8f9fa;
    }

    .modal-content {
        border: none;
        border-radius: 12px;
        min-height: 300px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 40px 30px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= $this->include('partials/profile_balance') ?>
<div class="mt-5">
    <h3 class="section-title">Pembayaran</h3>
    <h3 class="section-title"><img src="<?= $service['service_icon'] ?>" class="img-fluid mr-5" /><?= $service['service_name'] ?></h3>
</div>

<div class="mb-3">
    <div class="input-group mb-3">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-wallet"></i>
            </span>
        <input
            type="text"
            id="nominalInput"
            value="<?= number_format($service['service_tariff'], 0, ',', '.') ?>"
            readonly
            disabled
            class="form-control border-start-0"
            style="border-color: #dee2e6;"
        >
    </div>
    <button
            class="btn w-100 text-white fw-bold py-2 mb-3"
            style="background-color: #dc3545; border: none; border-radius: 4px;"
            data-bs-toggle="modal" data-bs-target="#confirmModal" aria-hidden="true"
    >
        Bayar
    </button>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border: none; border-radius: 12px; padding: 40px 30px;">
            <div class="payment-confirm">
                <div class="logo-circle"></div>
                <div class="modal-title">Beli <?= $service['service_name'] ?> senilai</div>
                <div class="price-text">Rp<?= number_format($service['service_tariff'], 0, ',', '.') ?>?</div>
                <div class="d-grid gap-2">
                    <button type="button" id="btn-pay" class="btn btn-red">Ya, lanjutkan Bayar</button>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Batalkan</button>
                </div>
            </div>
            <div class="loading d-flex flex-column justify-content-center align-items-center gap-3 d-none">
                <div class="spinner-border" role="status"></div>
                <p>Mohon Tunggu</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border: none; border-radius: 12px; padding: 40px 30px;">
            <div style="display: flex; align-items: center; justify-content: center; font-size: 3em; color: green; padding-bottom: 20px;">
              <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="modal-title">Pembayaran <?= $service['service_name'] ?> sebesar</div>
            <div class="price-text">Rp<?= number_format($service['service_tariff'], 0, ',', '.') ?></div>
            <div class="modal-title">berhasil</div>
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-red btn-home">Kembali Ke Beranda</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="failModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border: none; border-radius: 12px; padding: 40px 30px;">
            <div style="display: flex; align-items: center; justify-content: center; font-size: 3em; color: red; padding-bottom: 20px;">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="modal-title">Pembayaran <?= $service['service_name'] ?> sebesar</div>
            <div class="price-text">Rp<?= number_format($service['service_tariff'], 0, ',', '.') ?></div>
            <div class="modal-title">gagal</div>
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-red btn-home">Kembali Ke Beranda</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->include('partials/profile_balance_js') ?>
<script>
    $(document).ready(function () {
        $("#btn-pay").on("click", function () {
            const payload = {
                service_code: "<?= $service['service_code'] ?>",
            }
            $(".loading").removeClass("d-none")
            $(".payment-confirm").hide()
            $.ajax({
                url: "/transaction/pay",
                type: "POST",
                data: JSON.stringify(payload),
                contentType: "application/json",
                success: function (response) {
                    $(".loading").addClass("d-none")
                    $(".payment-confirm").show()
                    $("#confirmModal").modal("toggle")
                    $("#successModal").modal("toggle")
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error)
                    $(".loading").addClass("d-none")
                    $(".payment-confirm").show()
                    $("#confirmModal").modal("toggle")
                    $("#failModal").modal("toggle")
                }
            })
        })
        $(".btn-home").on("click", function () {
            window.location.href = "/dashboard"
        })
    })
</script>
<?= $this->endSection(); ?>
