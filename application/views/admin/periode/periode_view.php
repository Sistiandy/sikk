<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    Detail Periode
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/periode') ?>" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/periode/edit/' . $periode['periode_id']) ?>" class="btn btn-success"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td><?php echo pretty_date($periode['periode_date'], 'd F Y', FALSE) ?></td>
                        </tr>
                        <tr>
                            <td>Total yang didapat</td>
                            <td>:</td>
                            <td><?php echo 'Rp ' . number_format($periode['periode_total_budget'], 2, ',', '.') ?></td>
                        </tr>                       
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?php echo $periode['periode_description'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal dibuat</td>
                            <td>:</td>
                            <td><?php echo pretty_date($periode['periode_last_update'], 'l, d F Y', FALSE) ?></td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td><?php echo $periode['user_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                 <h3>
            Daftar Transaksi Pemasukan
            <a href="<?php echo site_url('admin/input_transaction/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="controls" align="center">TANGGAL</th>
                                <th class="controls" align="center">MAHASISWA</th>
                                <th class="controls" align="center">AKSI</th>
                            </tr>
                        </thead>
                        <?php
                        if (!empty($transaction)) {
                            foreach ($transaction as $row) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td ><?php echo pretty_date($row['periode_date'], 'd F Y', FALSE); ?></td>
                                        <td ><?php echo $row['student_name']; ?></td>
                                        <td>
                                            <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/input_transaction/detail/' . $row['transaction_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                            <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/input_transaction/edit/' . $row['transaction_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                            }
                        } else {
                            ?>
                            <tbody>
                                <tr id="row">
                                    <td colspan="3" align="center">Data Kosong</td>
                                </tr>
                            </tbody>
                            <?php
                        }
                        ?>   
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>