<?= $this->extend('layouts/main'); ?>

<?= $this->section('css'); ?>
<?= $this->include('partials/profile_balance_css') ?>
<style>
    .container-custom {
        margin: 0 auto;
        padding-top: 20px;
    }

    .page-title {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 8px;
        font-weight: 400;
    }

    .main-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 30px;
    }

    .form-control-custom {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        font-size: 1rem;
        background-color: white;
    }

    .form-control-custom:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .topup-btn {
        background-color: #a8a8a8;
        border: none;
        border-radius: 8px;
        padding: 15px;
        width: 100%;
        color: white;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 15px;
        cursor: pointer;
    }

    .topup-btn:enabled:hover {
        background-color: #979797;
        transform: translateY(-1px);
    }

    .topup-btn:disabled {
        background-color: #b0b0b0;
        cursor: not-allowed;
    }

    .amount-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .amount-btn {
        border: 2px solid #dee2e6;
        background-color: white;
        border-radius: 8px;
        padding: 15px 10px;
        text-align: center;
        font-weight: 500;
        color: #495057;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.95rem;
    }

    .amount-btn:hover {
        border-color: #007bff;
        background-color: #f8f9ff;
        transform: translateY(-1px);
    }

    .amount-btn.selected {
        border-color: #007bff;
        background-color: #007bff;
        color: white;
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
<div class="container-custom">
    <div class="page-title">Silahkan masukan</div>
    <h1 class="main-title">Nominal Top Up</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                    <i class="fa-solid fa-wallet"></i>
                </span>
                <input type="text" class="form-control form-control-custom" placeholder="masukan nominal Top Up" id="nominalInput">
            </div>

            <button id="topup-btn" class="topup-btn" disabled>
                Top Up
            </button>
        </div>

        <div class="col-md-6">
            <div class="amount-grid">
                <div class="amount-btn" data-amount="10000">Rp10.000</div>
                <div class="amount-btn" data-amount="20000">Rp20.000</div>
                <div class="amount-btn" data-amount="50000">Rp50.000</div>
                <div class="amount-btn" data-amount="100000">Rp100.000</div>
                <div class="amount-btn" data-amount="250000">Rp250.000</div>
                <div class="amount-btn" data-amount="500000">Rp500.000</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border: none; border-radius: 12px; padding: 40px 30px;">
            <div class="confirm-text">
                <div class="logo-circle"></div>
                <div class="modal-title">Anda Yakin Untuk topup sebesar</div>
                <div class="price-text">Rp<span class="nominal-text"></span></div>
                <div class="d-grid gap-2">
                    <button type="button" id="btn-confirm" class="btn btn-red">Ya, lanjutkan Top Up</button>
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
            <div class="modal-title">Top Up sebesar</div>
            <div class="price-text">Rp<span class="nominal-text"></span></div>
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
            <div class="modal-title">Top Up sebesar</div>
            <div class="price-text">Rp<span class="nominal-text"></span></div>
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
    const amountBtn = $(".amount-btn")
    const nominalInput = $("#nominalInput")
    const topupBtn = $("#topup-btn")
    const confirmBtn = $("#btn-confirm")
    const confirmModal = $("#confirmModal")
    const confirmText = $(".confirm-text")
    const loading = $(".loading")
    const successModal = $("#successModal")
    const failModal = $("#failModal")
    const homeBtn = $(".btn-home")
    const nominalText = $(".nominal-text")

    amountBtn.on("click", function () {
        const amount = $(this).data("amount")
        nominalInput.val(amount)
        nominalText.text(amount.toLocaleString("id-ID"))
        topupBtn.prop("disabled", false)
    })
    topupBtn.on("click", function () {
        if (nominalInput.val() < 10000 || nominalInput.val() > 1000000) {
            showError('Nominal top up harus di antara Rp10.000 - Rp1.000.000')
            return
        }
        confirmModal.modal("toggle")
    })
    nominalInput.on('keyup', function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''))
        if ($(this).val() === '') topupBtn.prop("disabled", true)
        else {
            topupBtn.prop("disabled", false)
            nominalText.text(parseFloat($(this).val()).toLocaleString("id-ID"))
        }
    })
    confirmBtn.on("click", function() {
        const payload = {
            top_up_amount: nominalInput.val(),
        }
        confirmText.hide()
        loading.removeClass("d-none")
        $.ajax({
            url: "/transaction/topup",
            type: "POST",
            data: JSON.stringify(payload),
            contentType: "application/json",
            success: function (response) {
                confirmText.show()
                loading.addClass("d-none")
                confirmModal.modal("toggle")
                successModal.modal("toggle")
            },
            error: function (xhr, status, error) {
                console.error("Error:", error)
                confirmText.show()
                loading.addClass("d-none")
                confirmModal.modal("toggle")
                failModal.modal("toggle")
            }
        })
    })
    homeBtn.on("click", function () {
        window.location.href = "/dashboard"
    })
</script>
<?= $this->endSection(); ?>
