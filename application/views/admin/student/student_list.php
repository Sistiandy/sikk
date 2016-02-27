<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3>
            Daftar Mahasiswa
            <a href="<?php echo site_url('admin/student/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3>

        <!-- Indicates a successful or positive action -->

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="controls" align="center">NO</th>
                        <th class="controls" align="center">NPM</th>
                        <th class="controls" align="center">NAMA</th>
                        <th class="controls" align="center">EMAIL</th>
                        <th class="controls" align="center">AKSI</th>
                    </tr>
                </thead>
                <?php 
                $i=1;
                if (!empty($student)) {
                    foreach ($student as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td ><?php echo $i; ?></td>
                                <td ><?php echo $row['student_nip']; ?></td>
                                <td ><?php echo $row['student_name']; ?></td>
                                <td ><?php echo $row['student_email']; ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/student/detail/' . $row['student_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/student/edit/' . $row['student_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php $i++;
                    }
                } else {
                    ?>
                    <tbody>
                        <tr id="row">
                            <td colspan="4" align="center">Data Kosong</td>
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