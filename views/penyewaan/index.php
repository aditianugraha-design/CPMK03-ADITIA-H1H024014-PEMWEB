<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 fw-semibold">Riwayat Semua Penyewaan</h5>
    <a href="<?= base_url('penyewaan/tambah') ?>" class="btn btn-ps">
        <i class="bi bi-plus-lg me-1"></i>Sewa Baru
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4">No</th>
                        <th>Unit PS</th>
                        <th>Pelanggan</th>
                        <th>Jam Mulai</th>
                        <th>Durasi</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($penyewaan_list)): ?>
                    <tr><td colspan="8" class="text-center text-muted py-5">
                        <i class="bi bi-journal-x fs-3 d-block mb-2"></i>Belum ada data penyewaan
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($penyewaan_list as $i => $s): ?>
                    <tr>
                        <td class="px-4"><?= $i + 1 ?></td>
                        <td>
                            <span class="fw-semibold"><?= $s->nomor_unit ?></span>
                            <span class="d-block text-muted small"><?= $s->tipe ?></span>
                        </td>
                        <td>
                            <?= htmlspecialchars($s->nama_pelanggan) ?>
                            <span class="d-block text-muted small"><?= $s->no_hp ?></span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($s->jam_mulai)) ?></td>
                        <td><?= $s->durasi_jam ?> jam</td>
                        <td class="fw-semibold">Rp <?= number_format($s->total_bayar, 0, ',', '.') ?></td>
                        <td>
                            <?php if ($s->status === 'aktif'): ?>
                            <span class="badge badge-aktif rounded-pill px-3">Aktif</span>
                            <?php else: ?>
                            <span class="badge badge-selesai rounded-pill px-3">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($s->status === 'aktif'): ?>
                            <a href="<?= base_url('penyewaan/selesai/'.$s->id) ?>"
                               class="btn btn-sm btn-success me-1"
                               onclick="return confirm('Tandai sewa ini selesai?')">
                                <i class="bi bi-check2"></i>
                            </a>
                            <?php endif; ?>
                            <a href="<?= base_url('penyewaan/hapus/'.$s->id) ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Hapus data penyewaan ini?')">
                                <i class="bi bi-trash"></i>
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
