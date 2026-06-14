<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
    <div class="card-header py-3 px-4">
        <i class="bi bi-person me-2 text-primary"></i>
        <?= isset($pelanggan) ? 'Edit Data Pelanggan' : 'Tambah Pelanggan Baru' ?>
    </div>
    <div class="card-body p-4">

        <?php if (validation_errors()): ?>
        <div class="alert alert-danger py-2 small">
            <?= validation_errors('<div>⚠ ', '</div>') ?>
        </div>
        <?php endif; ?>

        <?php
        $action = isset($pelanggan) ? base_url('pelanggan/update/'.$pelanggan->id) : base_url('pelanggan/simpan');
        echo form_open($action);
        ?>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control"
                   placeholder="cth: Budi Santoso"
                   value="<?= set_value('nama', isset($pelanggan) ? $pelanggan->nama : '') ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">No. HP <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                <input type="text" name="no_hp" class="form-control"
                       placeholder="cth: 08123456789"
                       value="<?= set_value('no_hp', isset($pelanggan) ? $pelanggan->no_hp : '') ?>" required>
            </div>
            <div class="form-text">10–15 digit angka</div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-ps px-4">
                <i class="bi bi-save me-1"></i><?= isset($pelanggan) ? 'Simpan Perubahan' : 'Tambahkan' ?>
            </button>
            <a href="<?= base_url('pelanggan') ?>" class="btn btn-outline-secondary px-4">Batal</a>
        </div>

        <?= form_close() ?>
    </div>
</div>
</div>
</div>
