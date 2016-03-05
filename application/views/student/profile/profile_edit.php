<?php
$this->load->view('admin/datepicker');
$id = $member['member_id'];
$inputName = $member['username'];
$inputFullName = $member['member_full_name'];
$inputSex = $member['member_sex'];
$inputBirthPlace = $member['member_birth_place'];
$inputBirthDate = $member['member_birth_date'];
$inputSchool = $member['member_school'];
$inputPhone = $member['member_phone'];
$inputAddress = $member['member_address'];
$inputMentor = $member['member_mentor'];
$inputDivison = $member['member_division'];
$inputEntry = $member['member_entry_date'];
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
                    <input type="hidden" name="member_id" value="<?php echo $member['member_id'] ?>" />
                    <input type="hidden" name="member_nip" value="<?php echo $member['member_nip'] ?>" />
                    <input type="hidden" name="member_input_date" value="<?php echo $member['member_input_date'] ?>" />
                    <label >NIPM *</label>
                    <input name="member_nip" type="text" <?php echo $member['member_nip'] ? 'readonly' : '' ?> placeholder="NIPM" class="form-control" value="<?php echo $member['member_nip'] ?>"><br>
                    <label >Nama Lengkap *</label>
                    <input type="text" name="member_full_name" <?php echo $member['member_full_name'] ? 'readonly' : '' ?> placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputFullName; ?>"><br>
                    <label>Jenis Kelamin *</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="member_sex" value="MALE" <?php echo ($inputSex == 'MALE') ? 'checked' : ''; ?>> Laki-laki
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="member_sex" value="FEMALE" <?php echo ($inputSex == 'FEMALE') ? 'checked' : ''; ?>> Perempuan
                        </label>
                    </div>
                    <label >Tempat Lahir *</label>
                    <input type="text" name="member_birth_place" placeholder="Tempat Lahir" class="form-control" value="<?php echo $inputBirthPlace; ?>"><br>
                    <label >Tanggal Lahir *</label>
                    <input type="text" name="member_birth_date" placeholder="Tanggal Lahir" class="form-control datepicker" value="<?php echo $inputBirthDate; ?>"><br>
                    <label >Asal Sekolah *</label>
                    <input type="text" name="member_school" placeholder="Asal Sekolah" class="form-control" value="<?php echo $inputSchool; ?>"><br>
                    <label >Pembimbing Prakerin *</label>
                    <input type="text" name="member_mentor" placeholder="Pembimbing" class="form-control" value="<?php echo $inputMentor; ?>"><br>
                    <label >No. Telepon *</label>
                    <input type="text" name="member_phone" placeholder="No. Telepon" class="form-control" value="<?php echo $inputPhone; ?>"><br>
                    <label >Alamat </label>
                    <textarea name="member_address" placeholder="Alamat" class="form-control"><?php echo $inputAddress; ?></textarea><br>
                    <label >Departement </label>
                    <input type="text" name="member_division" placeholder="Bagian" class="form-control" value="<?php echo $inputDivison; ?>"><br>
                    <label >Mulai Prakerin </label>
                    <input type="text" name="member_entry_date" placeholder="Tanggal Masuk" class="form-control datepicker" value="<?php echo $inputEntry; ?>"><br>
                    <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
                </div>
                <div class="col-sm-9 col-md-3">
                    <div class="form-group">
                        <label >Upload Photo </label>
                        <input type="file" name="member_image" class="form-control" ><br>
                        <?php if (isset($member) AND $member['member_image'] != NULL) { ?>
                        <img src="<?php echo upload_url('member_photo/' . pretty_date($member['member_input_date'], 'Y/m/d/', FALSE) . $member['member_image']) ?>" class="img-responsive ava-detail"><br>
                        <?php } ?>   
                        <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                        <a href="<?php echo site_url('member/profile'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                        <?php if (isset($member)): ?>
                            <a href="<?php echo site_url('member/profile/cpw') ?>" class="btn btn-primary btn-form"><i class="fa fa-refresh"></i> Ubah Password</a><br>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>