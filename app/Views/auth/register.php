<?= $this->extend('layouts/auth'); ?>
<?= $this->section('content'); ?>
<form id="registerForm" method="post">
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

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-user"></i>
            </span>
            <input
                type="text"
                id="firstNameInput"
                name="first_name"
                class="form-control border-start-0"
                placeholder="nama depan"
                style="border-color: #dee2e6;"
            >
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                <i class="fa-solid fa-user"></i>
            </span>
            <input
                type="text"
                id="lastNameInput"
                name="last_name"
                class="form-control border-start-0"
                placeholder="nama belakang"
                style="border-color: #dee2e6;"
            >
        </div>
    </div>

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
                placeholder="buat password"
                style="border-color: #dee2e6;"
            >
            <span class="input-group-text bg-white border-start-0" id="togglePassword" style="border-color: #dee2e6; cursor: pointer;">
                <span id="eyeIcon"><i class="fa-regular fa-eye"></i></i></span>
            </span>
        </div>
    </div>

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

    <p class="text-center mb-0" style="color: #666666; font-size: 0.9rem;">
        sudah punya akun? login
        <a href="/auth/login" style="color: #dc3545; text-decoration: none;">di sini</a>
    </p>
</form>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(function () {
        const form = $("#registerForm")
        const emailInput = $("#emailInput")
        const firstNameInput = $("#firstNameInput")
        const lastNameInput = $("#lastNameInput")
        const passwordInput = $("#passwordInput")
        const confirmPasswordInput = $("#confirmPasswordInput")

        form.on("submit", function (e) {
            e.preventDefault();

            const email = $.trim(emailInput.val());
            const firstName = $.trim(firstNameInput.val());
            const lastName = $.trim(lastNameInput.val());
            const password = $.trim(passwordInput.val());
            const confirmPassword = $.trim(confirmPasswordInput.val());

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!email) return showError("Email tidak boleh kosong!");
            if (!emailRegex.test(email)) return showError("Format email tidak valid!");
            if (!firstName) return showError("Nama depan tidak boleh kosong!");
            if (!lastName) return showError("Nama belakang tidak boleh kosong!");
            if (!password) return showError("Password tidak boleh kosong!");
            if (password.length < 8) return showError("Password minimal 8 karakter!");
            if (!confirmPassword) return showError("Konfirmasi password tidak boleh kosong!");
            if (password !== confirmPassword) return showError("Password dan konfirmasi tidak sama!");

            this.submit();
        })

        $("#togglePassword").on("click", function () {
            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye-slash"></i>');
            } else {
                passwordInput.attr("type", "password");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye"></i>');
            }
        });

        $("#toggleConfirmPassword").on("click", function () {
            if (confirmPasswordInput.attr("type") === "password") {
                confirmPasswordInput.attr("type", "text");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye-slash"></i>');
            } else {
                confirmPasswordInput.attr("type", "password");
                $(this).find("#eyeIcon").html('<i class="fa-regular fa-eye"></i>');
            }
        });
    });
</script>
<?= $this->endSection(); ?>
