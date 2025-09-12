<?= $this->extend('layouts/main'); ?>
<?= $this->section('css') ?>
<style>
    .profile-container {
        display: flex;
        flex-direction: column;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }
    .profile-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }
    .edit-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 24px;
        height: 24px;
        padding: 0;
        border: 2px solid white;
    }
    .profile-name {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }
    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }
    .form-control {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #e53e3e;
        box-shadow: 0 0 0 0.2rem rgba(229, 62, 62, 0.25);
    }
    .input-group-text {
        background: transparent;
        border: 1px solid #dee2e6;
        border-right: none;
        border-radius: 8px 0 0 8px;
        color: #6c757d;
    }
    .input-group .form-control {
        border-left: none;
        border-radius: 0 8px 8px 0;
    }
    .btn-edit {
        background: #e53e3e;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 500;
        width: 100%;
        margin-bottom: 15px;
        transition: all 0.2s;
    }
    .btn-edit:hover {
        background: #c53030;
        transform: translateY(-1px);
    }
    .btn-logout {
        background: transparent;
        border: 2px solid #e53e3e;
        color: #e53e3e;
        border-radius: 8px;
        padding: 10px;
        font-weight: 500;
        width: 100%;
        transition: all 0.2s;
    }
    .btn-logout:hover {
        background: #e53e3e;
        color: white;
        transform: translateY(-1px);
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="profile-container">
    <div class="text-center mb-4">
        <div class="position-relative d-inline-block">
            <img
                id="profile-img"
                src="<?= $profile_image ?>"
                alt="Profile"
                class="rounded-circle profile-image"
            />
            <button id="edit-propic" class="btn btn-light btn-sm rounded-circle edit-icon" style="display: none">
                <i class="fas fa-pencil-alt" style="font-size: 10px"></i>
            </button>
            <input type="file" id="profile-image-input" accept="image/jpeg, image/png" style="display:none;"/>
        </div>
    </div>

    <h2 id="profile-name" class="profile-name"><?= $first_name ?> <?= $last_name ?? '' ?></h2>

    <form id="profile-form">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                <input type="email" class="form-control" value="<?= $email ?>" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="firstName" class="form-label">Nama Depan</label>
            <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                <input type="text" class="editable form-control" name="first_name" id="firstName" value="<?= $first_name ?>" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Nama Belakang</label>
            <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                <input type="text" class="editable form-control" name="last_name" id="lastName" value="<?= $last_name ?>" readonly>
            </div>
        </div>
    </form>
    <div class="mt-4">
        <button id="btn-edit" type="button" class="btn btn-danger btn-edit">
            Edit Profil
        </button>
        <button id="btn-logout-cancel" type="button" class="btn btn-outline-danger btn-logout">
            Logout
        </button>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js') ?>
<script>
    const editBtn = $("#btn-edit")
    const logoutCancelBtn = $("#btn-logout-cancel")
    const editableInput = $(".editable")
    const form = $("#profile-form")
    const profileImg = $("#profile-img")
    const profileName = $("#profile-name")
    const firstNameInput = $("#firstName")
    const editPropicBtn = $("#edit-propic")
    const profileImageInput = $("#profile-image-input")
    const MAX_FILE_SIZE = <?= env('MAX_FILE_SIZE_IN_KB', 100) ?>

    editBtn.on("click", function() {
        if ($(this).text().trim() === "Edit Profil") {
            editableInput.prop("readonly", false)
            $(this).text("Simpan")
            logoutCancelBtn.text("Batalkan")
            editPropicBtn.show()
        } else {
            if (firstNameInput.val().trim() === "") {
                showError("Nama depan harus diisi")
                return
            }
            $.ajax({
                url: "/profile",
                type: "POST",
                data: form.serialize(),
                success: function (response) {
                    profileName.text(`${response.first_name} ${response.last_name}`)

                    editBtn.text("Edit Profil")
                    editableInput.prop("readonly", true)
                    logoutCancelBtn.text("Logout")
                    editPropicBtn.hide()

                    showSuccess("Profil berhasil diupdate")
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error)
                }
            })
        }
    })

    logoutCancelBtn.on("click", function() {
        if ($(this).text().trim() === "Logout") window.location.href = "/auth/logout"
        else {
            $(this).text("Logout")
            editBtn.text("Edit Profil")
            editableInput.prop("readonly", true)
        }
    })

    editPropicBtn.on("click", function() {
        profileImageInput.click()
    })

    profileImageInput.on("change", function() {
        const file = this.files[0]
        if (file) {
            if (!file.type.startsWith('image/')) {
                showError('File tidak valid')
                return
            }

            if (file.size > MAX_FILE_SIZE * 1024) {
                showError('Ukuran foto maksimum 100kb')
                return
            }

            const formData = new FormData()
            formData.append('profile_image', file)

            $.ajax({
                url: "/profile/image",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    profileImg.attr("src", response.profile_image)
                },
                error: function (xhr, status, error) {
                    console.error("Upload error:", error)
                }
            })
        }
    })

    profileImg.on("error", function () {
        $(this).attr("src", "/img/Profile Photo.png")
    })

</script>
<?= $this->endSection(); ?>
