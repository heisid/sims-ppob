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
                src="<?= $profile_image ?>"
                alt="Profile"
                class="rounded-circle profile-image"
            />
            <button class="btn btn-light btn-sm rounded-circle edit-icon">
                <i class="fas fa-pencil-alt" style="font-size: 10px"></i>
            </button>
        </div>
    </div>

    <h2 class="profile-name"><?= $first_name ?> <?= $last_name ?? '' ?></h2>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
            <input type="email" class="form-control" id="email" value="<?= $email ?>" readonly>
        </div>
    </div>

    <div class="mb-3">
        <label for="firstName" class="form-label">Nama Depan</label>
        <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
            <input type="text" class="form-control" id="firstName" value="<?= $first_name ?>" readonly>
        </div>
    </div>

    <div class="mb-3">
        <label for="lastName" class="form-label">Nama Belakang</label>
        <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
            <input type="text" class="form-control" id="lastName" value="<?= $last_name ?>" readonly>
        </div>
    </div>

    <div class="mt-4">
        <button type="button" class="btn btn-danger btn-edit">
            Edit Profil
        </button>
        <a type="button" href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger btn-logout">
            Logout
        </a>
    </div>
</div>
<?= $this->endSection(); ?>