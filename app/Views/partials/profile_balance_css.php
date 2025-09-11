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
</style>