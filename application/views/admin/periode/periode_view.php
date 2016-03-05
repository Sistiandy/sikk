<?php
$this->load->view('admin/multi_select');?>
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
                <a class="glyphicon glyphicon-plus-sign" data-toggle="modal" href="#modalTransaksi"></a> 
                
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
    <div class="modal fade" id="modalTransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php echo form_open_multipart(site_url('admin/periode/addtransaction/'.$periode['periode_id'])) ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Transaksi Pemasukan</h4>
                </div>
                <div class="modal-body">                    
                    <input type="hidden" name="from_list" value="TRUE" >
                    <label >Tanggal Dikirim *</label>
                    <div ng-controller="studentCtrl">
                        <div ng-repeat="model in studentOutput">
                            <input type="hidden" name="student_id[]" required value="{{model.student_id}}" ng-model="model.student_id">
                        </div>
                        <div
                        isteven-multi-select
                        input-model="student"
                        output-model="studentOutput"
                        default-label="Pilih Mahasiswa"
                        button-label="student_name"
                        item-label="student_name"
                        max-labels="7"
                        tick-property="ticked"
                        ></div>
                        </div
                        <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var inputApp = angular.module("inputApp", ["isteven-multi-select"]);
    var SITEURL = "<?php echo site_url() ?>";
    inputApp.controller('studentCtrl', function($scope, $http) {
        $scope.studentOutput = [];
        $scope.student = [];

        $scope.getInputTransaction = function() {

            var url = SITEURL + 'admin/student/get_student';
            $http.get(url).then(function(response) {
                $scope.student = response.data;
            })

        };

        angular.element(document).ready(function() {
            $scope.getInputTransaction();
        });

    });
</script>