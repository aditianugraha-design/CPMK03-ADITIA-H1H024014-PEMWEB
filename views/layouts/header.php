<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'PS Rental' ?></title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --ps-blue: #003087;
            --ps-light-blue: #0070cc;
            --ps-accent: #00439c;
        }
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            width: 260px; min-height: 100vh; background: var(--ps-blue);
            position: fixed; top: 0; left: 0; z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
        }
        .sidebar .brand {
            padding: 20px 20px 10px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }
        .sidebar .brand h5 {
            color: #fff; font-weight: 700; font-size: 1.1rem; margin: 0;
        }
        .sidebar .brand small { color: rgba(255,255,255,0.6); font-size: 0.78rem; }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.75); padding: 10px 20px;
            border-radius: 0; transition: all .2s;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: var(--ps-light-blue); color: #fff;
        }
        .sidebar .nav-section {
            color: rgba(255,255,255,0.4); font-size: 0.72rem;
            text-transform: uppercase; letter-spacing: 1px;
            padding: 16px 20px 6px;
        }
        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar {
            background: #fff; padding: 14px 28px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 900;
        }
        .topbar .page-title { font-weight: 600; color: #1a1a2e; margin: 0; font-size: 1rem; }
        .content-area { padding: 28px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .card-header { background: #fff; border-bottom: 1px solid #eee; font-weight: 600; border-radius: 12px 12px 0 0 !important; }
        .stat-card { border-radius: 12px; padding: 20px; color: #fff; }
        .stat-card .stat-icon { font-size: 2rem; opacity: 0.8; }
        .stat-card .stat-value { font-size: 1.8rem; font-weight: 700; }
        .stat-card .stat-label { font-size: 0.82rem; opacity: 0.85; }
        .badge-tersedia { background: #d1fae5; color: #065f46; }
        .badge-dipakai { background: #fee2e2; color: #991b1b; }
        .badge-aktif { background: #dbeafe; color: #1e40af; }
        .badge-selesai { background: #f3f4f6; color: #374151; }
        .btn-ps { background: var(--ps-blue); color: #fff; }
        .btn-ps:hover { background: var(--ps-light-blue); color: #fff; }
        @media (max-width: 768px) {
            .sidebar { width: 100%; min-height: auto; position: relative; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-controller fs-4 text-white"></i>
            <div>
                <h5>PS Rental</h5>
                <small>Sistem Informasi Penyewaan</small>
            </div>
        </div>
    </div>

    <nav class="mt-2">
        <div class="nav-section">Menu Utama</div>
        <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (uri_string() == 'dashboard' || uri_string() == '') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">Master Data</div>
        <a href="<?= base_url('unit_ps') ?>" class="nav-link <?= (strpos(uri_string(), 'unit_ps') !== FALSE) ? 'active' : '' ?>">
            <i class="bi bi-tv"></i> Unit PlayStation
        </a>
        <a href="<?= base_url('pelanggan') ?>" class="nav-link <?= (strpos(uri_string(), 'pelanggan') !== FALSE) ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Pelanggan
        </a>

        <div class="nav-section">Transaksi</div>
        <a href="<?= base_url('penyewaan') ?>" class="nav-link <?= (uri_string() == 'penyewaan') ? 'active' : '' ?>">
            <i class="bi bi-journal-text"></i> Semua Penyewaan
        </a>
        <a href="<?= base_url('penyewaan/aktif') ?>" class="nav-link <?= (uri_string() == 'penyewaan/aktif') ? 'active' : '' ?>">
            <i class="bi bi-play-circle"></i> Sewa Aktif
        </a>
        <a href="<?= base_url('penyewaan/tambah') ?>" class="nav-link">
            <i class="bi bi-plus-circle"></i> Sewa Baru
        </a>

        <div class="nav-section mt-3">Akun</div>
        <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Topbar -->
    <div class="topbar">
        <p class="page-title"><?= isset($title) ? htmlspecialchars($title) : 'PS Rental' ?></p>
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle text-secondary"></i>
            <span class="text-muted small"><?= $this->session->userdata('nama_lengkap') ?></span>
        </div>
    </div>

    <div class="content-area">
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
