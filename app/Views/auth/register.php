<?= $this->extend('layouts/auth'); ?>
<?= $this->section('content'); ?>
<form id="registerForm">
    <!-- Email Input -->
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-at"></i>
            </span>
            <input
                type="email"
                id="emailInput"
                class="form-control border-start-0"
                placeholder="masukan email anda"
                style="border-color: #dee2e6;"
            >
        </div>
    </div>

    <!--First Name-->
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-user"></i>
            </span>
            <input
                type="text"
                id="firstNameInput"
                class="form-control border-start-0"
                placeholder="nama depan"
                style="border-color: #dee2e6;"
            >
        </div>
    </div>

    <!--Last Name-->
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-user"></i>
            </span>
            <input
                type="text"
                id="lastNameInput"
                class="form-control border-start-0"
                placeholder="nama belakang"
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
                class="form-control border-start-0 border-end-0"
                placeholder="buat password"
                style="border-color: #dee2e6;"
            >
            <span class="input-group-text bg-white border-start-0" id="togglePassword" style="border-color: #dee2e6; cursor: pointer;">
                <span id="eyeIcon"><i class="fa-regular fa-eye"></i></i></span>
            </span>
        </div>
    </div>

    <!--Confirm Password-->
    <div class="mb-3">
        <div class="input-group" id="passwordGroup">
            <span class="input-group-text bg-white border-end-0" id="passwordIcon" style="border-color: #dee2e6;">
                <i class="fa-solid fa-lock"></i>
            </span>
            <input
                type="password"
                id="confirmPasswordInput"
                class="form-control border-start-0 border-end-0"
                placeholder="konfirmasi password"
                style="border-color: #dee2e6;"
            >
            <span class="input-group-text bg-white border-start-0" id="toggleConfirmPassword" style="border-color: #dee2e6; cursor: pointer;">
                <span id="eyeIcon"><i class="fa-regular fa-eye"></i></i></span>
            </span>
        </div>
    </div>

    <button
        type="submit"
        class="btn w-100 text-white fw-bold py-2 mb-3"
        style="background-color: #dc3545; border: none; border-radius: 4px;"
    >
        Registrasi
    </button>

    <!-- Login Link -->
    <p class="text-center mb-0" style="color: #666666; font-size: 0.9rem;">
        sudah punya akun? login
        <a href="/auth/login" style="color: #dc3545; text-decoration: none;">di sini</a>
    </p>
</form>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(function () {
        const $form = $("#registerForm");
        const $email = $("#emailInput");
        const $firstName = $("#firstNameInput");
        const $lastName = $("#lastNameInput");
        const $password = $("#passwordInput");
        const $confirmPassword = $("#confirmPasswordInput");

        const $toastEl = $("#errorToast");
        const toast = new bootstrap.Toast($toastEl[0], { delay: 4000 });
        const $toastBody = $toastEl.find(".toast-body");

        $form.on("submit", function (e) {
            e.preventDefault();

            const email = $.trim($email.val());
            const firstName = $.trim($firstName.val());
            const lastName = $.trim($lastName.val());
            const password = $.trim($password.val());
            const confirmPassword = $.trim($confirmPassword.val());

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email) return showError("Email tidak boleh kosong!");
            if (!emailRegex.test(email)) return showError("Format email tidak valid!");
            if (!firstName) return showError("Nama depan tidak boleh kosong!");
            if (!lastName) return showError("Nama belakang tidak boleh kosong!");
            if (!password) return showError("Password tidak boleh kosong!");
            if (password.length < 6) return showError("Password minimal 6 karakter!");
            if (!confirmPassword) return showError("Konfirmasi password tidak boleh kosong!");
            if (password !== confirmPassword) return showError("Password dan konfirmasi tidak sama!");

            this.submit();
        });

        function showError(message) {
            $toastBody.text(message);
            toast.show();
        }

        $("#togglePassword").on("click", function () {
            if ($password.attr("type") === "password") {
                $password.attr("type", "text");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye-slash"></i>');
            } else {
                $password.attr("type", "password");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye"></i>');
            }
        });

        $("#toggleConfirmPassword").on("click", function () {
            if ($confirmPassword.attr("type") === "password") {
                $confirmPassword.attr("type", "text");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye-slash"></i>');
            } else {
                $confirmPassword.attr("type", "password");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye"></i>');
            }
        });
    });
</script>
<?= $this->endSection(); ?>
