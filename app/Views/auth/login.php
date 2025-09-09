<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", sans-serif;
        }

        /* Password input error state */
        .password-error {
            border-color: #dc3545 !important;
        }

        /* Smooth transitions */
        .input-group-text,
        .form-control {
            transition: border-color 0.15s ease-in-out;
        }

        /* Error toast animation */
        #errorToast {
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateX(-50%) translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        /* Hide error toast initially */
        #errorToast.d-none {
            display: none !important;
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

                <!-- Login Form -->
                <form id="loginForm">
                    <!-- Email Input -->
                    <div class="mb-3">
                        <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-color: #dee2e6;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </span>
                            <input
                                    type="email"
                                    id="emailInput"
                                    class="form-control border-start-0"
                                    placeholder="masukan email anda"
                                    value="wallet@nutech.com"
                                    style="border-color: #dee2e6;"
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <div class="input-group" id="passwordGroup">
                                <span class="input-group-text bg-white border-end-0" id="passwordIcon" style="border-color: #dee2e6;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <circle cx="12" cy="16" r="1"></circle>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                </span>
                            <input
                                    type="password"
                                    id="passwordInput"
                                    class="form-control border-start-0 border-end-0"
                                    placeholder="masukan password anda"
                                    style="border-color: #dee2e6;"
                            >
                            <span class="input-group-text bg-white border-start-0" id="togglePassword" style="border-color: #dee2e6; cursor: pointer;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="eyeIcon">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </span>
                        </div>
                    </div>

                    <!-- Login Button -->
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
                        <a href="#" style="color: #dc3545; text-decoration: none;">di sini</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Right side - Illustration -->
        <div class="col-md-6 d-flex align-items-center justify-content-center" style="background-color: #fdf2f8;">
                <img src="<?= base_url('img/Illustrasi_Login.png') ?>" alt="Login Illustration" class="img-fluid" style="max-width: 400px; height: auto;">
        </div>
    </div>

    <!-- Error Toast -->
    <div class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index: 1050;" id="errorToast">
        <div class="alert alert-danger d-flex align-items-center" role="alert" style="min-width: 300px;">
            <span>password yang anda masukan salah</span>
            <button type="button" class="btn-close ms-auto" id="closeError" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const emailInput = document.getElementById("emailInput")
        const passwordInput = document.getElementById("passwordInput")
        const togglePassword = document.getElementById("togglePassword")
        const eyeIcon = document.getElementById("eyeIcon")
        const loginForm = document.getElementById("loginForm")
        const errorToast = document.getElementById("errorToast")
        const closeError = document.getElementById("closeError")
        const passwordGroup = document.getElementById("passwordGroup")
        const passwordIcon = document.getElementById("passwordIcon")

        // State variables
        let showPassword = false
        let showError = true

        // Initialize page
        init()

        function init() {
            // Show error toast initially (as per design)
            if (showError) {
                errorToast.classList.remove("d-none")
            }

            // Add event listeners
            togglePassword.addEventListener("click", handleTogglePassword)
            closeError.addEventListener("click", handleCloseError)
            loginForm.addEventListener("submit", handleSubmit)
            passwordInput.addEventListener("input", handlePasswordInput)
        }

        function handleTogglePassword() {
            showPassword = !showPassword

            if (showPassword) {
                passwordInput.type = "text"
                eyeIcon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
            `
            } else {
                passwordInput.type = "password"
                eyeIcon.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            `
            }
        }

        function handleCloseError() {
            showError = false
            errorToast.classList.add("d-none")
        }

        function handleSubmit(e) {
            e.preventDefault()

            const email = emailInput.value
            const password = passwordInput.value

            // Simulate login logic
            console.log("Login attempt:", { email, password })

            // Show error for demo purposes
            if (password) {
                showError = true
                errorToast.classList.remove("d-none")
                updatePasswordErrorState(true)
            }
        }

        function handlePasswordInput() {
            const hasPassword = passwordInput.value.length > 0
            updatePasswordErrorState(hasPassword && showError)
        }

        function updatePasswordErrorState(isError) {
            const borderColor = isError ? "#dc3545" : "#dee2e6"

            // Update all password input group elements
            const elements = passwordGroup.querySelectorAll(".input-group-text, .form-control")
            elements.forEach((element) => {
                element.style.borderColor = borderColor
            })
        }
    })

</script>
</body>
</html>
