<div class="row g-3 mb-4">
    <!-- Stat Cards -->
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#003087,#0055b3)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value"><?= $total_unit ?></div>
                    <div class="stat-label">Total Unit PS</div>
                </div>
                <i class="bi bi-tv stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#065f46,#059669)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value"><?= $unit_tersedia ?></div>
                    <div class="stat-label">Unit Tersedia</div>
                </div>
                <i class="bi bi-check-circle stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#991b1b,#dc2626)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value"><?= $unit_dipakai ?></div>
                    <div class="stat-label">Sedang Dipakai</div>
                </div>
                <i class="bi bi-play-fill stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#1e40af,#2563eb)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value"><?= $total_pelanggan ?></div>
                    <div class="stat-label">Total Pelanggan</div>
                </div>
                <i class="bi bi-people stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <i class="bi bi-calendar-check fs-2 text-primary mb-2"></i>
                <div class="fw-bold fs-4"><?= $sewa_hari_ini ?></div>
                <div class="text-muted small">Transaksi Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <i class="bi bi-play-circle fs-2 text-warning mb-2"></i>
                <div class="fw-bold fs-4"><?= $sewa_aktif ?></div>
                <div class="text-muted small">Sewa Sedang Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <i class="bi bi-cash-stack fs-2 text-success mb-2"></i>
                <div class="fw-bold fs-4">Rp <?= number_format($pendapatan_hari_ini, 0, ',', '.') ?></div>
                <div class="text-muted small">Pendapatan Hari Ini</div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Sewa Aktif -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3 px-4">
        <span><i class="bi bi-play-circle me-2 text-primary"></i>Penyewaan Sedang Berlangsung</span>
        <a href="<?= base_url('penyewaan/tambah') ?>" class="btn btn-sm btn-ps">
            <i class="bi bi-plus me-1"></i>Sewa Baru
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">Unit PS</th>
                        <th>Pelanggan</th>
                        <th>Jam Mulai</th>
                        <th>Durasi</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($list_aktif)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-4 d-block mb-1"></i>Tidak ada sewa aktif saat ini
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($list_aktif as $s): ?>
                    <tr>
                        <td class="px-4">
                            <span class="fw-semibold"><?= $s->nomor_unit ?></span>
                            <span class="text-muted small d-block"><?= $s->tipe ?></span>
                        </td>
                        <td>
                            <?= htmlspecialchars($s->nama_pelanggan) ?>
                            <span class="text-muted small d-block"><?= $s->no_hp ?></span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($s->jam_mulai)) ?></td>
                        <td><?= $s->durasi_jam ?> jam</td>
                        <td class="fw-semibold text-success">Rp <?= number_format($s->total_bayar, 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= base_url('penyewaan/selesai/'.$s->id) ?>"
                               class="btn btn-sm btn-success"
                               onclick="return confirm('Tandai sewa ini selesai?')">
                                <i class="bi bi-check2"></i> Selesai
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
