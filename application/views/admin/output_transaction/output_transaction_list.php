<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h3>Transaksi Pengeluaran <small>List</small></h3>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <li class="pull-right"><a href="<?php echo site_url('admin/output_transaction/add'); ?>" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped responsive-utilities jambo_table dataTable_init">
                <thead>
                    <tr>
                        <th class="controls" align="center">TRANSAKSI</th>
                        <th class="controls" align="center">TANGGAL</th>
                        <th class="controls" align="center">RUPIAH</th>
                        <th class="controls" align="center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($output) > 0) {
                        foreach ($output as $row) {
                            ?>
                            <tr>
                                <td ><?php echo $row['transaction_title']; ?></td>
                                <td ><?php echo pretty_date($row['transaction_date'], 'd F Y', FALSE); ?></td>                                
                                <td ><?php echo 'Rp ' . number_format($row['transaction_budget'], 2, ',', '.'); ?></td>
                                <td>
                                    <a class="text-warning" href="<?php echo site_url('admin/output_transaction/detail/' . $row['output_transaction_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="text-success" href="<?php echo site_url('admin/output_transaction/edit/' . $row['output_transaction_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>   
                </tbody>
            </table>
        </div>
    </div>
</div>