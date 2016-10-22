<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h3>Mahasiswa <small>List</small></h3>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <li class="pull-right"><a href="<?php echo site_url('admin/student/add'); ?>" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> Tambah</a> 
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped responsive-utilities jambo_table dataTable_init">
                <thead>
                    <tr>
                        <th class="controls" align="center">NPM</th>
                        <th class="controls" align="center">NAMA</th>
                        <th class="controls" align="center">EMAIL</th>
                        <th class="controls" align="center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($student) > 0) {
                        foreach ($student as $row) {
                            ?>
                            <tr>
                                <td ><?php echo $row['student_nip']; ?></td>
                                <td ><span class="cap"><?php echo $row['student_name']; ?></span></td>
                                <td ><?php echo $row['student_email']; ?></td>
                                <td>
                                    <a class="text-warning" href="<?php echo site_url('admin/student/detail/' . $row['student_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="text-success" href="<?php echo site_url('admin/student/edit/' . $row['student_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
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

<style type="text/css">
     .upper { text-transform: uppercase; }
     .lower { text-transform: lowercase; }
     .cap   { text-transform: capitalize; }
     .small { font-variant:   small-caps; }
 </style>