<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 fw-semibold">Daftar Unit PlayStation</h5>
    <a href="<?= base_url('unit_ps/tambah') ?>" class="btn btn-ps">
        <i class="bi bi-plus-lg me-1"></i>Tambah Unit
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4" style="width:50px">No</th>
                        <th>Nomor Unit</th>
                        <th>Tipe</th>
                        <th>Tarif/Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($unit_list)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-tv fs-3 d-block mb-2"></i>Belum ada data unit PS
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($unit_list as $i => $u): ?>
                    <tr>
                        <td class="px-4"><?= $i + 1 ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($u->nomor_unit) ?></td>
                        <td><?= htmlspecialchars($u->tipe) ?></td>
                        <td>Rp <?= number_format($u->tarif_per_jam, 0, ',', '.') ?></td>
                        <td>
                            <?php if ($u->status === 'tersedia'): ?>
                            <span class="badge badge-tersedia rounded-pill px-3">
                                <i class="bi bi-circle-fill me-1" style="font-size:.5rem"></i>Tersedia
                            </span>
                            <?php else: ?>
                            <span class="badge badge-dipakai rounded-pill px-3">
                                <i class="bi bi-circle-fill me-1" style="font-size:.5rem"></i>Dipakai
                            </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('unit_ps/edit/'.$u->id) ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= base_url('unit_ps/hapus/'.$u->id) ?>" class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Hapus unit <?= $u->nomor_unit ?>?')">
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
