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
            type="submit"
            class="btn w-100 text-white fw-bold py-2 mb-3"
            style="background-color: #dc3545; border: none; border-radius: 4px;"
    >
        Bayar
    </button>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->include('partials/profile_balance_js') ?>
<?= $this->endSection(); ?>
