<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    Detail Transaksi Pemasukan
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/input_transaction') ?>" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/input_transaction/edit/' . $input_transaction['transaction_id']) ?>" class="btn btn-success"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Tanggal Periode</td>
                            <td>:</td>
                            <td><?php echo pretty_date($input_transaction['periode_date'], 'd F Y', FALSE) ?></td>
                        </tr>
                        <tr>
                            <td>Mahasiswa</td>
                            <td>:</td>
                            <td><?php echo $input_transaction['student_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Tunggakan</td>
                            <td>:</td>
                            <td><?php echo ($input_transaction['transaction_is_late'] == TRUE)? 'Ya' : 'Tidak' ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal diinput</td>
                            <td>:</td>
                            <td><?php echo $input_transaction['transaction_input_date'] ?></td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td><?php echo $input_transaction['user_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>