<style type="text/css">
    .upper { text-transform: uppercase; }
    .lower { text-transform: lowercase; }
    .cap   { text-transform: capitalize; }
    .small { font-variant:   small-caps; }
</style>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit" ng-controller="StudentCtrl">
    <div class="x_panel post-inherit">
        <div class="row x_title">
            <div class="col-md-8">
                <h3>
                    Detail Mahasiswa
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/student') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/student/edit/' . $student['student_id']) ?>" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp; Edit</a> 
                </span>
            </div>
        </div>
        <div class="row x_content">
            <div class="col-md-12">
                <div class="progress progress-bar-gray">
                    <div ng-show="hutang > 0" class="progress-bar bg-red" role="progressbar" aria-valuenow="{{jml}}" aria-valuemin="0" aria-valuemax="100" style="width: {{jml}}%; border-radius: 0;">
                        {{jml}}% Lunas Uang Kas
                    </div>
                    <div ng-show="hutang < 1" class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; border-radius: 0;">
                        100% Lunas Uang Kas
                    </div>
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
                            <td>Rp. {{ totalBudget | number : fractionSize}}</td>
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
                                <div ng-show="hutang > 0">
                                    <div ng-repeat="hutangTransaction in hutangTransactions" class="col-md-3">
                                        <div class="thumbnail">
                                            <center>
                                                <span class="fa fa-calendar text-danger"></span> {{ hutangTransaction.periode_date | date :  'd MMMM y' : timezone}} 
                                                <button class="btn btn-success btn-block" ng-click="inputTransaction(hutangTransaction)" type="button"><i class="fa fa-check"></i> Bayar</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>

                                <div ng-show="hutang < 1" class="col-md-12">
                                    <div class="alert alert-success">
                                        <center>
                                            <span class="fa fa-check"></span> Tidak Ada Tunggakan
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
                var inputApp = angular.module("inputApp", []);
                var SITEURL = "<?php echo site_url() ?>";
                inputApp.controller('StudentCtrl', function ($scope, $http) {
                $scope.studentTransactions = [];
                        $scope.hutangTransactions = [];
                        $scope.animate = false;
                        $scope.getStudentTransaction = function () {

                        var url = SITEURL + 'api/getStudentTransaction/<?php echo $student['student_id'] ?>';
                                $http.get(url).then(function (response) {
                        $scope.hutangTransactions = [];
                                $scope.studentTransactions = response.data;
                                $scope.lunas = 0;
                                $scope.hutang = 0;
                                $scope.totalBudget = 0;
                                angular.forEach($scope.studentTransactions, function (value) {
                                if (value.input_transaction_value != null) {
                                $scope.totalBudget = $scope.totalBudget + parseInt(value.input_transaction_value);
                                        $scope.lunas++;
                                } else {
                                $scope.hutangTransactions.push(value);
                                        $scope.hutang++;
                                }
                                });
                                $scope.jml = $scope.lunas / $scope.studentTransactions.length * 100;
                        })

                        };
                        angular.element(document).ready(function () {
                $scope.getStudentTransaction();
                });
                });
    </script>