<div class="row justify-content-center">
<div class="col-md-7">
<div class="card">
    <div class="card-header py-3 px-4">
        <i class="bi bi-journal-plus me-2 text-primary"></i>Tambah Penyewaan Baru
    </div>
    <div class="card-body p-4">

        <?php if (validation_errors()): ?>
        <div class="alert alert-danger py-2 small">
            <?= validation_errors('<div>⚠ ', '</div>') ?>
        </div>
        <?php endif; ?>

        <?= form_open(base_url('penyewaan/simpan'), ['id' => 'form-sewa']) ?>

        <div class="mb-3">
            <label class="form-label fw-semibold">Unit PlayStation <span class="text-danger">*</span></label>
            <select name="id_unit" id="id_unit" class="form-select" required onchange="hitungTotal()">
                <option value="">-- Pilih Unit Tersedia --</option>
                <?php foreach ($unit_list as $u): ?>
                <option value="<?= $u->id ?>"
                        data-tarif="<?= $u->tarif_per_jam ?>"
                        <?= set_value('id_unit') == $u->id ? 'selected' : '' ?>>
                    <?= $u->nomor_unit ?> - <?= $u->tipe ?> (Rp <?= number_format($u->tarif_per_jam, 0, ',', '.') ?>/jam)
                </option>
                <?php endforeach; ?>
            </select>
            <?php if (empty($unit_list)): ?>
            <div class="form-text text-danger">Tidak ada unit tersedia saat ini.</div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Pelanggan <span class="text-danger">*</span></label>
            <select name="id_pelanggan" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php foreach ($pelanggan_list as $p): ?>
                <option value="<?= $p->id ?>" <?= set_value('id_pelanggan') == $p->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p->nama) ?> (<?= $p->no_hp ?>)
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jam Mulai <span class="text-danger">*</span></label>
            <input type="datetime-local" name="jam_mulai" class="form-control"
                   value="<?= set_value('jam_mulai', date('Y-m-d\TH:i')) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Durasi (Jam) <span class="text-danger">*</span></label>
            <input type="number" name="durasi_jam" id="durasi_jam" class="form-control"
                   placeholder="cth: 2" min="1" max="24"
                   value="<?= set_value('durasi_jam', 1) ?>" required oninput="hitungTotal()">
        </div>

        <!-- Preview Total Bayar -->
        <div class="alert alert-info d-flex justify-content-between align-items-center mb-4" id="preview-total">
            <span><i class="bi bi-calculator me-2"></i>Total Bayar (otomatis):</span>
            <span class="fw-bold fs-5" id="total-display">Rp 0</span>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-ps px-4" <?= empty($unit_list) ? 'disabled' : '' ?>>
                <i class="bi bi-check-circle me-1"></i>Catat Penyewaan
            </button>
            <a href="<?= base_url('penyewaan') ?>" class="btn btn-outline-secondary px-4">Batal</a>
        </div>

        <?= form_close() ?>
    </div>
</div>
</div>
</div>

<script>
function hitungTotal() {
    const unitSelect = document.getElementById('id_unit');
    const durasiInput = document.getElementById('durasi_jam');
    const totalDisplay = document.getElementById('total-display');

    const selectedOption = unitSelect.options[unitSelect.selectedIndex];
    const tarif = parseFloat(selectedOption.getAttribute('data-tarif') || 0);
    const durasi = parseInt(durasiInput.value || 0);

    const total = tarif * durasi;

    totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Hitung saat halaman load
hitungTotal();
</script>
