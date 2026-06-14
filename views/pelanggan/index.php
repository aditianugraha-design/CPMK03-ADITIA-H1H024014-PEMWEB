<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 fw-semibold">Daftar Pelanggan</h5>
    <a href="<?= base_url('pelanggan/tambah') ?>" class="btn btn-ps">
        <i class="bi bi-person-plus me-1"></i>Tambah Pelanggan
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4" style="width:50px">No</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($pelanggan_list)): ?>
                    <tr><td colspan="5" class="text-center text-muted py-5">
                        <i class="bi bi-people fs-3 d-block mb-2"></i>Belum ada data pelanggan
                    </td></tr>
                <?php else: ?>
                    <?php foreach ($pelanggan_list as $i => $p): ?>
                    <tr>
                        <td class="px-4"><?= $i + 1 ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($p->nama) ?></td>
                        <td><?= htmlspecialchars($p->no_hp) ?></td>
                        <td><?= date('d/m/Y', strtotime($p->created_at)) ?></td>
                        <td>
                            <a href="<?= base_url('pelanggan/edit/'.$p->id) ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= base_url('pelanggan/hapus/'.$p->id) ?>" class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Hapus pelanggan <?= htmlspecialchars($p->nama) ?>?')">
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
