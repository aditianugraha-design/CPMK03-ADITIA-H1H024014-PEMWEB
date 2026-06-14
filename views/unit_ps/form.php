<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
    <div class="card-header py-3 px-4">
        <i class="bi bi-tv me-2 text-primary"></i>
        <?= isset($unit) ? 'Edit Unit PlayStation' : 'Tambah Unit PlayStation' ?>
    </div>
    <div class="card-body p-4">

        <?php if (validation_errors()): ?>
        <div class="alert alert-danger py-2 small">
            <?= validation_errors('<div>⚠ ', '</div>') ?>
        </div>
        <?php endif; ?>

        <?php
        $action = isset($unit) ? base_url('unit_ps/update/'.$unit->id) : base_url('unit_ps/simpan');
        echo form_open($action);
        ?>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nomor Unit <span class="text-danger">*</span></label>
            <input type="text" name="nomor_unit" class="form-control"
                   placeholder="cth: PS-01"
                   value="<?= set_value('nomor_unit', isset($unit) ? $unit->nomor_unit : '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tipe PlayStation <span class="text-danger">*</span></label>
            <select name="tipe" class="form-select" required>
                <option value="">-- Pilih Tipe --</option>
                <?php
                $tipes = ['PlayStation 3', 'PlayStation 4', 'PlayStation 5'];
                foreach ($tipes as $t):
                    $sel = (set_value('tipe', isset($unit) ? $unit->tipe : '') === $t) ? 'selected' : '';
                ?>
                <option value="<?= $t ?>" <?= $sel ?>><?= $t ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tarif Per Jam (Rp) <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" name="tarif_per_jam" class="form-control"
                       placeholder="10000" min="1"
                       value="<?= set_value('tarif_per_jam', isset($unit) ? $unit->tarif_per_jam : '') ?>" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-select" required>
                <?php
                $statuses = ['tersedia' => 'Tersedia', 'dipakai' => 'Dipakai'];
                foreach ($statuses as $val => $label):
                    $sel = (set_value('status', isset($unit) ? $unit->status : 'tersedia') === $val) ? 'selected' : '';
                ?>
                <option value="<?= $val ?>" <?= $sel ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-ps px-4">
                <i class="bi bi-save me-1"></i><?= isset($unit) ? 'Simpan Perubahan' : 'Tambahkan' ?>
            </button>
            <a href="<?= base_url('unit_ps') ?>" class="btn btn-outline-secondary px-4">Batal</a>
        </div>

        <?= form_close() ?>
    </div>
</div>
</div>
</div>
