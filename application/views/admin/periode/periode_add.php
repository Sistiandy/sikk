<?php
$this->load->view('admin/datepicker');

if (isset($periode)) {
    $inputDate = $periode['periode_date'];
    $inputDescription = $periode['periode_description'];
} else {
    $inputDate = set_value('periode_date');
    $inputDescription = set_value('periode_description');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php echo form_open_multipart(current_url()); ?>
        <div class="row x_title">
            <h3><?php echo $operation; ?> Periode</h3><br>
        </div>

        <div class="row x_content">
            <div class="col-sm-9 col-md-9">
                <?php echo validation_errors(); ?>
                <?php if (isset($periode)): ?>
                    <input type="hidden" name="periode_id" value="<?php echo $periode['periode_id']; ?>" />
                <?php endif; ?>
                <label >Tanggal *</label>
                <input name="periode_date" placeholder="Tanggal" <?php echo (isset($periode)? 'readonly' : '') ?> type="text" class="datepicker form-control" value="<?php echo $inputDate; ?>"><br>
                <label >Keterangan </label>
                <textarea name="periode_description" placeholder="Description" type="text" class="form-control"><?php echo $inputDescription; ?></textarea><br>
                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/periode'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($periode)): ?>
                        <a href="<?php echo site_url('admin/periode/delete/' . $periode['periode_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($periode)): ?>
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
                <?php echo form_open('admin/periode/delete/' . $periode['periode_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $periode['periode_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $periode['periode_date'] ?>" />
                    <button type="submit" class="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
        <script type="text/javascript">
            $(window).load(function () {
                $('#confirm-del').modal('show');
            });
        </script>
    <?php }
    ?>
<?php endif; ?>