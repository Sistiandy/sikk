<?php
$this->load->view('admin/datepicker');
if (isset($student)) {
    $inputNip = $student['student_nip'];
    $inputName = $student['student_name'];    
    $inputPlace = $student['student_place_birth'];
    $inputBirth = $student['student_birth_date'];
    $inputPhone = $student['student_phone'];
    $inputEmail = $student['student_email'];
    $inputAddress = $student['student_address'];
} else {
    $inputNip = set_value('student_nip');
    $inputName = set_value('student_name');    
    $inputPlace = set_value('student_place_birth');
    $inputBirth = set_value('student_birth_date');
    $inputPhone = set_value('student_phone');
    $inputEmail = set_value('student_email');
    $inputAddress = set_value('student_address');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php if (!isset($student)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Mahasiswa</h3><br>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-9">
                <?php if (isset($student)): ?>
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>" />
                <?php endif; ?>
                <label >NPM *</label>
                <input name="student_nip" <?php echo (isset($student)? 'disabled' : '') ?> placeholder="NPM" type="text" class="form-control" value="<?php echo $inputNip; ?>"><br>
                <label >Nama Lengkap *</label>
                <input name="student_name" <?php echo (isset($student)? 'disabled' : '') ?> placeholder="Nama Lengkap" type="text" class="form-control" value="<?php echo $inputName; ?>"><br>
                <?php if (!isset($student)): ?>
                    <label >Password *</label>
                    <input type="password" placeholder="Password" name="student_password" class="form-control"><br>
                    <label >Konfirmasi Password *</label>
                    <input type="password" placeholder="Konfirmasi Password" name="passconf" class="form-control">
                    <p style="color:#9C9C9C;margin-top: 5px"><i>Password minimal 6 karakter</i></p>
                <?php endif; ?>
                <label >Tempat Lahir *</label>
                <input name="student_place_birth" <?php echo (isset($student)? 'disabled' : '') ?> placeholder="Tempat Lahir" type="text" class="form-control" value="<?php echo $inputPlace; ?>"><br>
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
                    <?php if (isset($student)): ?>
                        <a href="<?php echo site_url('admin/student/delete/' . $student['student_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($student)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b><span class="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/student/delete/' . $student['student_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $student['student_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $student['student_name'] ?>" />
                    <button type="submit" class="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
        <script type="text/javascript">
            $(window).load(function() {
                $('#confirm-del').modal('show');
            });
        </script>
    <?php }
    ?>
<?php endif; ?>