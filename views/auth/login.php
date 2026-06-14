<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #003087 0%, #0070cc 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
        }
        .login-card {
            background: #fff; border-radius: 16px; padding: 40px;
            width: 100%; max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }
        .login-logo { font-size: 3rem; color: #003087; }
        .btn-login { background: #003087; color: #fff; font-weight: 600; padding: 12px; }
        .btn-login:hover { background: #0070cc; color: #fff; }
        .form-control:focus { border-color: #0070cc; box-shadow: 0 0 0 3px rgba(0,112,204,0.15); }
    </style>
</head>
<body>
<div class="login-card">
    <div class="text-center mb-4">
        <div class="login-logo"><i class="bi bi-controller"></i></div>
        <h4 class="fw-700 mt-2" style="font-weight:700; color:#003087;">PS Rental</h4>
        <p class="text-muted small">Sistem Informasi Penyewaan PlayStation</p>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger py-2 small">
        <i class="bi bi-exclamation-triangle me-1"></i><?= $this->session->flashdata('error') ?>
    </div>
    <?php endif; ?>

    <?= form_open('auth/proses') ?>
    <div class="mb-3">
        <label class="form-label fw-semibold">Username</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username"
                   value="<?= set_value('username') ?>" required>
        </div>
    </div>
    <div class="mb-4">
        <label class="form-label fw-semibold">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-login w-100 rounded-pill">
        <i class="bi bi-box-arrow-in-right me-2"></i>Login
    </button>
    <?= form_close() ?>

    <p class="text-center text-muted small mt-3 mb-0">Default: admin / password</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
