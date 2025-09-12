<?= $this->extend('layouts/main'); ?>

<?= $this->section('css'); ?>
<?= $this->include('partials/profile_balance_css') ?>
<style>
    .transaction-container {
        margin: 20px auto;
    }
    .transaction-item {
        padding: 16px 10px;
        border-radius: 12px;
        background-color: white;
        margin-bottom: 10px;
    }
    .amount-positive {
        color: #28a745;
        font-weight: 600;
    }
    .amount-negative {
        color: #dc3545;
        font-weight: 600;
    }
    .transaction-type {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .transaction-date {
        color: #adb5bd;
        font-size: 0.8rem;
    }
    .show-more {
        color: #dc3545;
        font-weight: 500;
        text-align: center;
        padding: 10px 0;
        margin-bottom: 40px;
    }
    .show-more:hover {
        color: #c82333;
    }
    h1 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= $this->include('partials/profile_balance') ?>
<div class="transaction-container">
    <h1>Semua Transaksi</h1>
    <div class="transactions">
        <?php foreach ($transactions as $transaction) : ?>
            <div class="transaction-item">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="<?= $transaction['total_amount'] > 0 ? 'amount-positive' : 'amount-negative' ?>">
                            <?= $transaction['total_amount'] >= 0 ? '+' : '-' ?>
                            Rp.<?= number_format($transaction['total_amount'], 0, ',', '.') ?>
                        </div>
                        <div class="transaction-date"><?= $transaction['created_on'] ?></div>
                    </div>
                    <div class="transaction-type text-end">
                        <?= $transaction['description'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <button class="btn show-more">Show more</button>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<?= $this->include('partials/profile_balance_js') ?>
<script>
    let offset = 0
    $(".show-more").on("click", function () {
        $.ajax({
            url: `/transaction/${++offset}`,
            contentType: "application/json",
            success: function (response) {
                for (const row of response) {
                    $(".transactions").append(`
                    <div class="transaction-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="${row.total_amount > 0 ? 'amount-positive' : 'amount-negative'}">
                                    ${row.total_amount >= 0 ? '+' : '-'}
                                    Rp.${row.total_amount.toLocaleString('id-ID')}
                                </div>
                                <div class="transaction-date">${row.created_on}</div>
                            </div>
                            <div class="transaction-type text-end">
                                ${row.description}
                            </div>
                        </div>
                    </div>
                    `)
                }
            },
            error: function (xhr, status, error) {
            }
        })
    })
</script>
<?= $this->endSection(); ?>
