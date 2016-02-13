<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    Detail Mahasiswa
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/student') ?>" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/student/edit/' . $student['student_id']) ?>" class="btn btn-success"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>NPM</td>
                            <td>:</td>
                            <td><?php echo $student['student_nip'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo $student['student_name'] ?></td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td><?php echo $student['student_phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $student['student_email'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo $student['student_address'] ?></td>
                        </tr>
                        <tr>
                            <td>Terakhir edit</td>
                            <td>:</td>
                            <td><?php echo $student['student_last_update'] ?></td>
                        </tr>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td><?php echo $student['user_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>