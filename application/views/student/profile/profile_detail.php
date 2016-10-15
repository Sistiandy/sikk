<style type="text/css">
    .upper { text-transform: uppercase; }
    .lower { text-transform: lowercase; }
    .cap   { text-transform: capitalize; }
    .small { font-variant:   small-caps; }
</style>
<?php
$jmlLunas = count($lunas);
$jmlTransaksi=  count($transaksi);
$jmlTunggakan=  count($tunggakan);
$persenLunas = $jmlLunas/$jmlTransaksi * 100;
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row x_title">
            <div class="col-md-8">
                <h3>
                    Profile Mahasiswa
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('student/dashboard') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('student/profile/edit') ?>" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp; Edit</a> 
                </span>
            </div>
        </div>
        <div class="row x_content">
            <div class="col-md-12">
                <div class="progress progress-bar-gray">
                    <?php if($jmlTunggakan > 0){ ?>
                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="<?php echo $persenLunas ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenLunas ?>%; border-radius: 0;">
                        <?php echo $persenLunas ?>% Lunas Uang Kas
                    </div>
                    <?php }else{ ?>
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; border-radius: 0;">
                        100% Lunas Uang Kas
                    </div>
                    <?php } ?>
                </div>
            </div>
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
                            <td>Rp. <?php echo $student['kas'] ?></td>
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
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Daftar Tunggakan Uang Kas
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <?php
                                if (count($tunggakan) > 0) {
                                    foreach ($tunggakan as $row):
                                        ?>
                                        <div class="col-md-3">
                                            <div class="thumbnail">
                                                <center>
                                                    <span class="fa fa-calendar text-danger"></span> <?php echo pretty_date($row['periode_date'], 'd F Y', FALSE); ?>
                                                </center>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                } else {
                                    ?>

                                    <div class="col-md-12">
                                        <div class="alert alert-success">
                                            <center>
                                                <span class="fa fa-check"></span> Tidak Ada Tunggakan
                                            </center>
                                        </div>
                                    </div>
<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>