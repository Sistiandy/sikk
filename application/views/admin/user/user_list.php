<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h3>Pengguna <small>List</small></h3>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <li class="pull-right"><a href="<?php echo site_url('admin/user/add'); ?>" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped responsive-utilities jambo_table dataTable_init">
                <thead class="gradient">
                    <tr>
                        <th>Nama Singkat</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($user) > 0) {
                        foreach ($user as $row) {
                            ?>
                            <tr>
                                <td ><?php echo $row['user_name']; ?></td>
                                <td ><?php echo $row['user_full_name']; ?></td>
                                <td ><?php echo $row['user_email']; ?></td>
                                <td ><?php echo $row['role_name']; ?></td>
                                <td>
                                    <a class="text-warning" href="<?php echo site_url('admin/user/detail/' . $row['user_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="text-success" href="<?php echo site_url('admin/user/edit/' . $row['user_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                    <?php if ($this->session->userdata('user_id') != $row['user_id']) { ?>
                                        <a class="text-primary" href="<?php echo site_url('admin/user/rpw/' . $row['user_id']); ?>" ><span class="glyphicon glyphicon-lock"></span></a>
                                    <?php } else {
                                        ?>
                                        <a class = "text-primary" href = "<?php echo site_url('admin/profile/cpw/'); ?>" ><span class = "glyphicon glyphicon-repeat"></span></a>
                                    <?php } ?>
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