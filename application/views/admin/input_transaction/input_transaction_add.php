<?php
$this->load->view('admin/datepicker');

if (isset($input_transaction)) {
    $inputDate = $input_transaction['input_transaction_date'];
    $inputDescription = $input_transaction['input_transaction_description'];
} else {
    $inputDate = set_value('input_transaction_date');
    $inputDescription = set_value('input_transaction_description');
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php if (!isset($input_transaction)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Periode</h3><br>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-9">
                <?php if (isset($input_transaction)): ?>
                    <input type="hidden" name="input_transaction_id" value="<?php echo $input_transaction['input_transaction_id']; ?>" />
                <?php endif; ?>
                <label >Tanggal *</label>
                <input name="input_transaction_date" placeholder="Tanggal" type="text" class="datepicker form-control" value="<?php echo $inputDate; ?>"><br>
                <label >Keterangan </label>
                <textarea name="input_transaction_description" placeholder="Description" type="text" class="form-control"><?php echo $inputDescription; ?></textarea><br>
                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/input_transaction'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($input_transaction)): ?>
                        <a href="<?php echo site_url('admin/input_transaction/delete/' . $input_transaction['input_transaction_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($input_transaction)): ?>
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
                <?php echo form_open('admin/input_transaction/delete/' . $input_transaction['input_transaction_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $input_transaction['input_transaction_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $input_transaction['input_transaction_date'] ?>" />
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