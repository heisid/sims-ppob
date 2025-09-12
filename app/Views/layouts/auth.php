<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Rosyid Haryadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", sans-serif;
        }
        .right-side {
            background-image: url("<?= base_url('img/Illustrasi_Login.png') ?>");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
<div class="container-fluid vh-100 p-0">
    <div class="row h-100 g-0">
        <!-- Left side - Login Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #ffffff;">
            <div class="w-100" style="max-width: 400px; padding: 0 2rem;">
                <!-- Logo and Title -->
                <div class="text-center mb-4">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <img src="<?= base_url('img/Logo.png') ?>" alt="SIMS PPOB Logo" width="32" height="32" class="me-2">
                        <h4 class="mb-0 fw-bold" style="color: #333333;">SIMS PPOB</h4>
                    </div>
                    <h2 class="fw-bold mb-1" style="color: #333333; font-size: 1.75rem;">
                        Masuk atau buat akun
                    </h2>
                    <h2 class="fw-bold" style="color: #333333; font-size: 1.75rem;">
                        untuk memulai
                    </h2>
                </div>

                <?= $this->renderSection('content'); ?>
            </div>
        </div>

        <!-- Right side - Illustration -->
        <div class="col-md-6 d-flex align-items-center justify-content-center right-side">
        </div>
    </div>

    <!-- Error Toast -->
    <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x mb-3">
        <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/321a7ce62f.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('js'); ?>
</body>
</html>
