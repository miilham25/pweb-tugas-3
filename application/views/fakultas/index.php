<div class="card shadow border-0 rounded-3 mb-4">
    <div class="card-header bg-gradient bg-dark text-white d-flex align-items-center justify-content-between py-3 border-bottom-0 rounded-top-3">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-building fs-5"></i>
            <h6 class="mb-0 text-uppercase tracking-wider fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.85rem;">Daftar Fakultas</h6>
        </div>
        <a class="btn btn-sm btn-primary bg-gradient fw-bold shadow-sm px-3 rounded-pill" href="<?php echo base_url('fakultas/tambah') ?>">
            <i class="bi bi-plus-lg me-1"></i> Registrasi Fakultas
        </a>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table id="datatable" class="table table-hover align-middle w-100 mb-0">
                <thead class="table-light text-secondary text-uppercase border-bottom" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <tr>
                        <th class="text-center py-3" style="width: 15%">Kode ID</th>
                        <th class="py-3">Nama Resmi Fakultas</th>
                        <th class="text-center py-3" style="width: 15%">Manajemen Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fakultas_data as $row): ?>
                        <tr>
                            <td class="text-center font-monospace small text-secondary fw-bold"><?php echo $row['fakultas_id'] ?></td>
                            <td class="fw-semibold text-dark"><?php echo $row['fakultas_name'] ?></td>
                            <td class="text-center">
                                <div class="btn-group gap-2">
                                    <a class="btn btn-sm btn-light text-warning border-0 rounded-2 shadow-sm px-2.5" href="<?php echo base_url('fakultas/ubah/'.$row['fakultas_id']) ?>" title="Ubah Data">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a class="btn btn-sm btn-light text-danger border-0 rounded-2 shadow-sm px-2.5 btn-hapus" href="<?php echo base_url('fakultas/hapus/'.$row['fakultas_id']) ?>" title="Hapus Data">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>