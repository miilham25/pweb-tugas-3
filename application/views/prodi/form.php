<div class="row justify-content-start">
    <div class="col-xl-6 col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-light border-bottom d-flex align-items-center justify-content-between py-3">
                <h5 class="mb-0 text-dark fw-bold"><?php echo $title; ?></h5>
                <a class="btn btn-sm btn-secondary" href="<?php echo base_url('prodi') ?>">Kembali</a>
            </div>
            <div class="card-body p-4">
                <form action="<?php echo $form_action; ?>" method="post" novalidate>

                    <?php if ($submit_label === 'Simpan'): ?>
                        <div class="mb-3">
                            <label for="prodi_id" class="form-label fw-semibold">Kode ID Prodi (Manual)</label>
                            <?php $id_state = form_error('prodi_id') ? 'is-invalid' : (isset($_POST['prodi_id']) ? 'is-valid' : ''); ?>
                            <input type="number" name="prodi_id" id="prodi_id" class="form-control <?php echo $id_state; ?>" value="<?php echo set_value('prodi_id'); ?>" placeholder="Contoh: 101">
                            <?php if (form_error('prodi_id')): ?>
                                <div class="invalid-feedback fw-medium"><?php echo form_error('prodi_id'); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="fakultas_id" class="form-label fw-semibold">Fakultas Penaung</label>
                        <?php $select_state = form_error('fakultas_id') ? 'is-invalid' : (isset($_POST['fakultas_id']) ? 'is-valid' : ''); ?>
                        <select name="fakultas_id" id="fakultas_id" class="form-select <?php echo $select_state; ?>">
                            <option value="">-- Tentukan Relasi Fakultas --</option>
                            <?php foreach ($fakultas_options as $f): ?>
                                <option value="<?php echo $f['fakultas_id']; ?>" <?php echo set_select('fakultas_id', $f['fakultas_id'], (isset($form_value['fakultas_id']) && $form_value['fakultas_id'] == $f['fakultas_id'])); ?>>
                                    <?php echo $f['fakultas_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (form_error('fakultas_id')): ?>
                            <div class="invalid-feedback fw-medium"><?php echo form_error('fakultas_id'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="prodi_name" class="form-label fw-semibold">Nama Program Studi</label>
                        <?php 
                            $prodi_state = form_error('prodi_name') ? 'is-invalid' : (isset($_POST['prodi_name']) ? 'is-valid' : ''); 
                            $prodi_val = set_value('prodi_name', isset($form_value['prodi_name']) ? $form_value['prodi_name'] : '');
                        ?>
                        <input type="text" name="prodi_name" id="prodi_name" class="form-control <?php echo $prodi_state; ?>" value="<?php echo $prodi_val; ?>" placeholder="Masukkan nama prodi">
                        <?php if (form_error('prodi_name')): ?>
                            <div class="invalid-feedback fw-medium"><?php echo form_error('prodi_name'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block">Jenjang Pendidikan (Strata)</label>
                        <div class="py-1">
                            <?php 
                            $options = ['D3', 'S1', 'S2'];
                            $radio_state = form_error('prodi_strata') ? 'is-invalid' : '';
                            foreach ($options as $opt): 
                            ?>
                                <div class="form-check form-check-inline me-4">
                                    <input class="form-check-input <?php echo $radio_state; ?>" type="radio" name="prodi_strata" id="opt_<?php echo $opt; ?>" value="<?php echo $opt; ?>" <?php echo set_radio('prodi_strata', $opt, (isset($form_value['prodi_strata']) && $form_value['prodi_strata'] === $opt)); ?>>
                                    <label class="form-check-label fw-medium" for="opt_<?php echo $opt; ?>"><?php echo $opt; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (form_error('prodi_strata')): ?>
                            <div class="text-danger small faw-medium mt-1"><i class="bi bi-exclamation-circle me-1"></i><?php echo form_error('prodi_strata'); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="pt-2 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 fw-bold"><?php echo $submit_label; ?></button>
                        <a href="<?php echo base_url('prodi') ?>" class="btn btn-light px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>