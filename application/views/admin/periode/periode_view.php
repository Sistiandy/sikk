<?php $this->load->view('admin/multi_select'); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit" ng-controller="transactionCtrl">
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
                            <td>Rp. {{ periode.periode_total_budget | number : fractionSize}}</td>
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

                </h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="controls" align="center">NO</th>
                                <th class="controls" align="center">MAHASISWA</th>
                                <th class="controls" align="center">NIP</th>
                                <th class="controls" align="center">KETERANGAN <span ng-show="animate" class="fa fa-spin fa-spinner"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="studentTransaction in studentTransactions">
                                <td >{{$index + 1}}</td>
                                <td >{{studentTransaction.student_name}}</td>
                                <td >{{studentTransaction.student_nip}}</td>
                                <td ng-show="studentTransaction.input_transaction_value == NULL">
                                    <div class="input-group input-group-sm">
                                        <input type="number" class="form-control" ng-model="studentTransaction.value"> 
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" ng-disabled="!(!!studentTransaction.value)" ng-click="inputTransaction(studentTransaction)" type="button"><i class="fa fa-check"></i> Simpan</button>
                                        </span>
                                    </div><!-- /input-group -->

                                </td>
                                <td ng-show="studentTransaction.input_transaction_value != NULL">
                                    <label><span class="ion-checkmark"></span> Sudah bayar</label>
                                </td>
                            </tr>
                        </tbody>                            
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var inputApp = angular.module("inputApp", []);
    var SITEURL = "<?php echo site_url() ?>";
    inputApp.controller('transactionCtrl', function ($scope, $http) {
        $scope.studentTransactions = [];
        $scope.periode = [];
        $scope.animate = false;
        $scope.getStudentTransaction = function () {

            var url = SITEURL + 'api/getPeriodeTransaction/<?php echo $periode['periode_id'] ?>';
            $http.get(url).then(function (response) {
                $scope.studentTransactions = response.data;
            })

        };
        $scope.getPeriode = function () {

            var url = SITEURL + 'api/getPeriode/<?php echo $periode['periode_id'] ?>';
            $http.get(url).then(function (response) {
                $scope.periode = response.data;
            })

        };
        $scope.inputTransaction = function (data) {
            $scope.animate = true;
            var postData = $.param({
                input_transaction_value: data.value,
                transaction_id: data.transaction_id,
                periode_id: data.periode_periode_id,
            });
            $.ajax({
                method: "POST",
                url: SITEURL + "admin/input_transaction/input",
                data: postData,
                success: function (response) {
                    $scope.animate = false;
                    $scope.getStudentTransaction();
                    $scope.getPeriode();
                }
            });
        };
        angular.element(document).ready(function () {
            $scope.getStudentTransaction();
            $scope.getPeriode();
        });
    });
</script>