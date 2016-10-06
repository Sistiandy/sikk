<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h3>Transaksi Pemasukan <small>List</small></h3>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped jambo_table"> 
                <thead>
                    <tr>
                        <th class="controls" align="center">TANGGAL</th>
                        <th class="controls" align="center">MAHASISWA</th>
                        <th class="controls" align="center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($input_transaction) > 0) {
                        foreach ($input_transaction as $row) {
                            ?>
                            <tr>
                                <td ><?php echo pretty_date($row['periode_date'], 'd F Y', FALSE); ?></td>
                                <td ><?php echo $row['student_name']; ?></td>
                                <td>
                                    <a class="text-warning" href="<?php echo site_url('admin/input_transaction/detail/' . $row['transaction_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                </td>
                            </tr>
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
                </tbody>
            </table>
        </div>
        <div >
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>