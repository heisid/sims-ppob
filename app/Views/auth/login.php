<?= $this->extend('layouts/auth'); ?>
<?= $this->section('content'); ?>
<form id="loginForm" method="post">
    <!-- Email Input -->
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-at"></i>
            </span>
            <input
                type="email"
                id="emailInput"
                name="email"
                class="form-control border-start-0"
                placeholder="masukan email anda"
                style="border-color: #dee2e6;"
            >
        </div>
    </div>

    <!-- Password Input -->
    <div class="mb-3">
        <div class="input-group" id="passwordGroup">
            <span class="input-group-text bg-white border-end-0" id="passwordIcon" style="border-color: #dee2e6;">
                <i class="fa-solid fa-lock"></i>
            </span>
            <input
                type="password"
                id="passwordInput"
                name="password"
                class="form-control border-start-0 border-end-0"
                placeholder="masukan password anda"
                style="border-color: #dee2e6;"
            >
            <span class="input-group-text bg-white border-start-0" id="togglePassword" style="border-color: #dee2e6; cursor: pointer;">
                <span id="eyeIcon"><i class="fa-regular fa-eye-slash"></i></i></span>
            </span>
        </div>
    </div>

    <button
            type="submit"
            class="btn w-100 text-white fw-bold py-2 mb-3"
            style="background-color: #dc3545; border: none; border-radius: 4px;"
    >
        Masuk
    </button>

    <!-- Registration Link -->
    <p class="text-center mb-0" style="color: #666666; font-size: 0.9rem;">
        belum punya akun? registrasi
        <a href="/auth/register" style="color: #dc3545; text-decoration: none;">di sini</a>
    </p>
</form>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(function () {
        const $loginForm = $("#loginForm");
        const $emailInput = $("#emailInput");
        const $passwordInput = $("#passwordInput");
        const $toastEl = $("#errorToast");
        const toast = new bootstrap.Toast($toastEl[0], { delay: 4000 });
        const $toastBody = $toastEl.find(".toast-body");

        $loginForm.on("submit", function (e) {
            e.preventDefault();

            const email = $.trim($emailInput.val());
            const password = $.trim($passwordInput.val());
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email) return showError("Email tidak boleh kosong!");
            if (!emailRegex.test(email)) return showError("Format email tidak valid!");
            if (!password) return showError("Password tidak boleh kosong!");
            if (password.length < 6) return showError("Password minimal 6 karakter!");

            this.submit();
        });

        function showError(message) {
            $toastBody.text(message);
            toast.show();
        }

        // Toggle password visibility
        $("#togglePassword").on("click", function () {
            if ($passwordInput.attr("type") === "password") {
                $passwordInput.attr("type", "text");
                $("#eyeIcon").html('<i class="fa-regular fa-eye"></i>');
            } else {
                $passwordInput.attr("type", "password");
                $("#eyeIcon").html('<i class="fa-regular fa-eye-slash"></i>');
            }
        });
    });
</script>
<?= $this->endSection(); ?>