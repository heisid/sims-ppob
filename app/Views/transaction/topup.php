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

<div class="modal fade" id="loadingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 200px;">
        <div class="modal-content" style="border: none; border-radius: 12px; padding: 40px 30px;">
            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                <div class="spinner-border" role="status"></div>
                <p>Mohon Tunggu</p>
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
    const loadingModal = $("#loadingModal")

    amountBtn.on("click", function () {
        const amount = $(this).data("amount")
        nominalInput.val(amount)
        topupBtn.prop("disabled", false)
    })
    nominalInput.on('keyup', function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''))
        if ($(this).val() === '') topupBtn.prop("disabled", true)
        else topupBtn.prop("disabled", false)
    })
    topupBtn.on("click", function() {
        if (nominalInput.val() < 10000 || nominalInput.val() > 1000000) {
            showError('Nominal top up harus di antara Rp10.000 - Rp1.000.000')
            return
        }
        const payload = {
            top_up_amount: nominalInput.val(),
        }
        loadingModal.modal("toggle")
        $.post({
            url: "/transaction/topup",
            data: JSON.stringify(payload),
            contentType: "application/json",
            success: function (response) {
                setTimeout(function () {
                    loadingModal.modal("toggle")
                }, 1000)
            },
            error: function (xhr, status, error) {
                console.error("Error:", error)
                setTimeout(function () {
                    loadingModal.modal("toggle")
                }, 1000)
            }
        })
    })
</script>
<?= $this->endSection(); ?>
