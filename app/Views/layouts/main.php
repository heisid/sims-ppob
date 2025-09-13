<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Rosyid Haryadi</title>
    <link rel="icon" type="image/png" href="<?= base_url('/img/Logo.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
            color: #333 !important;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link.active {
            color: #dc3545 !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #dc3545 !important;
        }

        .logo {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .section-title {
            color: #333;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        @media (max-width: 992px) {
            .navbar-nav {
                text-align: center;
                padding-top: 1rem;
                border-top: 1px solid #dee2e6;
                margin-top: 1rem;
            }

            .navbar-nav .nav-link {
                padding: 0.75rem 1rem;
                border-radius: 0.375rem;
                margin: 0.25rem 0;
            }

            .navbar-nav .nav-link.active,
            .navbar-nav .nav-link:hover {
                background-color: #dc3545;
                color: white !important;
            }
        }

        @media (min-width: 992px) {
            .navbar-nav {
                flex-direction: row;
                gap: 0.5rem;
            }
        }
    </style>
    <?= $this->renderSection('css') ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="<?= base_url('/img/Logo.png') ?>" alt="Logo" class="logo">
            SIMS PPOB
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto">
                <a class="nav-link <?= uri_string() == 'transaction/topup' ? 'active' : '' ?>" href="/transaction/topup">Top Up</a>
                <a class="nav-link <?= uri_string() == 'transaction' ? 'active' : '' ?>" href="/transaction">Transaction</a>
                <a class="nav-link <?= uri_string() == 'profile' ? 'active' : '' ?>" href="/profile">Akun</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?= $this->renderSection('content'); ?>
</div>

<div class="toast-container position-fixed bottom-0 start-50 translate-middle-x mb-3">
    <div id="toast-notif" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/321a7ce62f.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let showError
    let showSuccess
    $(document).ready(function () {
        const toastEl = $("#toast-notif")
        const toast = new bootstrap.Toast(toastEl[0], { delay: 4000 })
        const toastBody = toastEl.find(".toast-body")

        showError = (message) => {
            toastEl.removeClass("bg-success").addClass("bg-danger")
            toastBody.text(message)
            toast.show()
        }

        showSuccess = (message) => {
            toastEl.removeClass("bg-danger").addClass("bg-success")
            toastBody.text(message)
            toast.show()
        }

        const flashError = <?= "'".session()->getFlashdata('error')."'" ?? 'null' ?>;
        const flashSuccess = <?= "'".session()->getFlashdata('success')."'" ?? 'null' ?>;
        if (flashError) showError(flashError)
        if (flashSuccess) showSuccess(flashSuccess)

        $('.navbar-nav .nav-link').on('click', function() {
            if (window.innerWidth < 992) {
                $('.navbar-collapse').collapse('hide')
            }
        })
    })
</script>
<?= $this->renderSection('js') ?>
</body>
</html>