<?php
$this->load->view('admin/datepicker');

if (isset($output)) {
    $inputTitle = $output['transaction_title'];
    $inputDate = $output['transaction_date'];
    $inputDesc = $output['transaction_description'];
    $inputBudget = $output['transaction_budget'];       
} else {   
    $inputTitle = set_value('transaction_title');
    $inputDate = set_value('transaction_date');
    $inputDesc = set_value('transaction_description');
    $inputBudget = set_value('transaction_budget');
    
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php if (!isset($output)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Transaksi Keluar</h3><br>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-9">
                <?php if (isset($output)): ?>
                    <input type="hidden" name="output_transaction_id" value="<?php echo $output['output_transaction_id']; ?>" />
                <?php endif; ?>
                <label >Nama Transaksi *</label>
                <input name="transaction_title" placeholder="Nama Transaksi" type="text" class="form-control" value="<?php echo $inputTitle; ?>"><br>
                <label >Tanggal Transaksi *</label>
                <input name="transaction_date" placeholder="Tanggal" type="text" class="form-control datepicker" value="<?php echo $inputDate; ?>"><br>                
                <label >Jumlah Rupiah *</label>
                <input name="transaction_budget" placeholder="Masukan Rupiah" type="text" class="form-control" value="<?php echo $inputBudget; ?>"><br>
                <label >Keterangan Transaksi *</label>
                <textarea name="transaction_description" placeholder="Keterangan" type="text" class="form-control">
                <?php echo $inputDesc; ?>
                </textarea><br>

                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/output_transaction'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($output)): ?>
                        <a href="<?php echo site_url('admin/output_transaction/delete/' . $output['output_transaction_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($output)): ?>
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
                <?php echo form_open('admin/output_transaction/delete/' . $output['output_transaction_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $output['output_transaction_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $output['transaction_title'] ?>" />
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