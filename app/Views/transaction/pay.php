<?= $this->extend('layouts/main'); ?>

<?= $this->section('css'); ?>
<?= $this->include('partials/profile_balance_css') ?>
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

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-5 mb-5""><img src="<?= base_url('/img/Logo.png') ?>" alt="Logo" class="logo"></div>
                <div class="text-center mb-3">Beli <?= $service['service_name'] ?> senilai</div>
                <div class="text-center"><h4>Rp <?= number_format($service['service_tariff'], 0, ',', '.') ?> ?</h4></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->include('partials/profile_balance_js') ?>
<?= $this->endSection(); ?>
