<div class="row justify-content-start">
    <div class="col-xl-6 col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light border-bottom d-flex align-items-center justify-content-between py-3">
                <h5 class="mb-0 text-dark fw-bold"><?php echo $title; ?></h5>
                <a class="btn btn-sm btn-secondary" href="<?php echo base_url('fakultas') ?>">Kembali</a>
            </div>
            <div class="card-body p-4">
                <form action="<?php echo $form_action; ?>" method="post" novalidate>
                    
                    <?php if ($submit_label === 'Simpan'): ?>
                        <div class="mb-4">
                            <label for="fakultas_id" class="form-label fw-semibold">Kode ID Fakultas (Manual)</label>
                            <?php 
                                $id_class = form_error('fakultas_id') ? 'is-invalid' : (isset($_POST['fakultas_id']) ? 'is-valid' : '');
                            ?>
                            <input type="number" name="fakultas_id" id="fakultas_id" class="form-control <?php echo $id_class; ?>" value="<?php echo set_value('fakultas_id'); ?>" placeholder="Contoh: 1">
                            <?php if (form_error('fakultas_id')): ?>
                                <div class="invalid-feedback fw-medium"><?php echo form_error('fakultas_id'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <label for="fakultas_name" class="form-label fw-semibold">Nama Resmi Fakultas</label>
                        <?php 
                            $name_class = form_error('fakultas_name') ? 'is-invalid' : (isset($_POST['fakultas_name']) ? 'is-valid' : '');
                            $name_value = set_value('fakultas_name', isset($form_value['fakultas_name']) ? $form_value['fakultas_name'] : '');
                        ?>
                        <input type="text" name="fakultas_name" id="fakultas_name" class="form-control <?php echo $name_class; ?>" value="<?php echo $name_value; ?>" placeholder="Masukkan nama fakultas">
                        <?php if (form_error('fakultas_name')): ?>
                            <div class="invalid-feedback fw-medium"><?php echo form_error('fakultas_name'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="pt-2 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 fw-bold"><?php echo $submit_label; ?></button>
                        <a href="<?php echo base_url('fakultas') ?>" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>