<?php
$this->load->view('admin/datepicker');
$inputNip = $student['student_nip'];
$inputName = $student['student_name'];
$inputPlace = $student['student_place_birth'];
$inputBirth = $student['student_birth_date'];
$inputPhone = $student['student_phone'];
$inputEmail = $student['student_email'];
$inputAddress = $student['student_address'];
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel">
        <?php echo form_open_multipart(current_url()); ?>
        <div class="row x_title">
            <h3>Sunting Profil</h3>
        </div>

        <div class="row x_content">
            <div class="col-sm-9 col-md-9">
                <label >NPM *</label>
                <input name="student_nip" <?php echo (isset($student) ? 'disabled' : '') ?> placeholder="NPM" type="text" class="form-control" value="<?php echo $inputNip; ?>"><br>
                <label >Nama Lengkap *</label>
                <input name="student_name" placeholder="Nama Lengkap" type="text" class="form-control" value="<?php echo $inputName; ?>"><br>
                <label >Tempat Lahir *</label>
                <input name="student_place_birth" placeholder="Tempat Lahir" type="text" class="form-control" value="<?php echo $inputPlace; ?>"><br>
                <label >Tanggal Lahir *</label>
                <input name="student_birth_date" placeholder="Tanggal Lahir" type="text" class="form-control datepicker" value="<?php echo $inputBirth; ?>"><br>
                <label >No. Telepon *</label>
                <input name="student_phone" placeholder="No. Telepon" type="text" class="form-control" value="<?php echo $inputPhone; ?>"><br>
                <label >Email *</label>
                <input name="student_email" placeholder="Email" type="text" class="form-control" value="<?php echo $inputEmail; ?>"><br>
                <label >Alamat *</label>
                <textarea name="student_address" placeholder="Alamat" type="text" class="form-control"><?php echo $inputAddress; ?></textarea><br>
                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/student'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
