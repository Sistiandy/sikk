<style type="text/css">
    .upper { text-transform: uppercase; }
    .lower { text-transform: lowercase; }
    .cap   { text-transform: capitalize; }
    .small { font-variant:   small-caps; }
</style>

<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row">
            <div class="col-md-8">
                <h3>
                    Profil Mahasiswa
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('student') ?>" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('student/profile/edit/' . $student['student_id']) ?>" class="btn btn-success"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </div>
        </div><br>
        
                <div class="progress progress-bar-gray">
                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%; border-radius: 0;">
                        60% Lunas Uang Kas
                    </div><br>
                </div>
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
                            <td><span class="cap"><?php echo $student['student_name'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><span class="cap"><?php echo $student['student_place_birth'] . ', ' . pretty_date($student['student_birth_date'], 'd F Y', FALSE) ?></span></td>
                        </tr>
                        <tr>
                            <td>Pemasukan Uang Kas</td>
                            <td>:</td>
                            <td><?php echo 'Rp ' . number_format($student['student_budget'], 2, ',', '.'); ?></td>
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
                            <td><?php echo pretty_date($student['student_last_update'], 'd F Y',FALSE) ?></td>                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>