<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3>
            Daftar Transaksi Keluar
            <a href="<?php echo site_url('admin/output_transaction/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>

        <!-- Indicates a successful or positive action -->

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="controls" align="center">NO.</th>
                        <th class="controls" align="center">TRANSAKSI</th>
                        <th class="controls" align="center">TANGGAL</th>
                        <th class="controls" align="center">RUPIAH</th>
                        <th class="controls" align="center">AKSI</th>
                    </tr>
                </thead>
                <?php
                $i=1;
                if (!empty($output)) {
                    foreach ($output as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td ><?php echo $i ?></td>
                                <td ><?php echo $row['transaction_title']; ?></td>
                                <td ><?php echo pretty_date($row['transaction_date'], 'd F Y', FALSE); ?></td>                                
                                <td ><?php echo 'Rp ' . number_format($row['transaction_budget'], 2, ',', '.'); ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/output_transaction/detail/' . $row['output_transaction_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/output_transaction/edit/' . $row['output_transaction_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++;
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
        <div >
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>