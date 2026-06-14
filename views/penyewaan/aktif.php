<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 fw-semibold">Penyewaan Sedang Aktif</h5>
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
                        <th class="px-4">Unit PS</th>
                        <th>Pelanggan</th>
                        <th>No. HP</th>
                        <th>Jam Mulai</th>
                        <th>Durasi</th>
                        <th>Jam Selesai (Est.)</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($penyewaan_list)): ?>
                    <tr><td colspan="8" class="text-center text-muted py-5">
                        <i class="bi bi-check-circle fs-3 d-block mb-2 text-success"></i>
                        Tidak ada penyewaan aktif saat ini
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($penyewaan_list as $s): ?>
                    <?php
                        $jam_selesai = date('d/m/Y H:i', strtotime($s->jam_mulai . ' + ' . $s->durasi_jam . ' hours'));
                    ?>
                    <tr>
                        <td class="px-4">
                            <span class="fw-bold"><?= $s->nomor_unit ?></span>
                            <span class="d-block text-muted small"><?= $s->tipe ?></span>
                            <small class="text-muted">Rp <?= number_format($s->tarif_per_jam, 0, ',', '.') ?>/jam</small>
                        </td>
                        <td class="fw-semibold"><?= htmlspecialchars($s->nama_pelanggan) ?></td>
                        <td><?= $s->no_hp ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($s->jam_mulai)) ?></td>
                        <td><span class="badge bg-primary rounded-pill"><?= $s->durasi_jam ?> Jam</span></td>
                        <td><?= $jam_selesai ?></td>
                        <td class="fw-bold text-success">Rp <?= number_format($s->total_bayar, 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= base_url('penyewaan/selesai/'.$s->id) ?>"
                               class="btn btn-sm btn-success"
                               onclick="return confirm('Tandai sewa ini selesai? Unit akan kembali tersedia.')">
                                <i class="bi bi-check2 me-1"></i>Selesai
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
