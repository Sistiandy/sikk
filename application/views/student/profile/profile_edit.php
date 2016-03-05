<?php
$this->load->view('student/tinymce_init');
$this->load->view('student/datepicker');
$id = $student['student_id'];
$inputName = $student['student_name'];
$inputNip = $student['student_nip'];
$inputPhone = $student['student_phone'];
$inputEmaile = $student['student_email'];
$inputAddress = $student['student_address'];
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Profil</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-9 col-md-9">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id'] ?>" />
                    <label >Nama *</label>
                    <input name="student_name" type="text" <?php echo (isset($student)) ? 'readonly' : '' ?> placeholder="studentname" class="form-control" value="<?php echo $inputName; ?>"><br>
                    <label >Nip *</label>
                    <input type="text" name="student_nip" placeholder="NIP" class="form-control" value="<?php echo $inputNip; ?>"><br>
                    <label >Phone *</label>
                    <input type="text" name="student_phone" placeholder="No. telepon" class="form-control" value="<?php echo $inputPhone; ?>"><br>
                    <label >Email *</label>
                    <input type="text" name="student_email" placeholder="Email" class="form-control" value="<?php echo $inputEmailValue; ?>">
                    <p style="color:#9C9C9C;margin-top: 5px"><i>Contoh : example@yahoo.com / example@example.com</i></p>
                    <label>Alamat </label>
                    <textarea name="student_address" class="form-control mce-init" rows="5" placeholder="Alamat"><?php echo $inputAddress; ?></textarea><br>
                    <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
                </div>
                <div class="col-sm-9 col-md-3">
                    <div class="form-group">
                        <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                        <a href="<?php echo site_url('student/profile'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                        <?php if (isset($student)): ?>
                            <?php if ($this->session->studentdata('student_id') == $id) {
                                ?>
                                <a href="<?php echo site_url('student/profile/cpw') ?>" class="btn btn-primary btn-form"><i class="fa fa-refresh"></i> Ubah Password</a><br>
                            <?php } elseif ($this->session->studentdata('student_id') != $id) { ?>
                                <a class="btn btn-primary btn-form" href="<?php echo site_url('student/student/rpw/' . $student['student_id']); ?>" ><i class="fa fa-key"></i> Reset Password</a><br>
                            <?php } ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>