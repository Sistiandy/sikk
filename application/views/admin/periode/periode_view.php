<?php $this->load->view('admin/multi_select'); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit" ng-controller="transactionCtrl">
    <div class="x_panel post-inherit">
        <div class="row x_title">
            <div class="col-md-8">
                <h3>
                    Detail Periode
                </h3>
            </div>
            <div class="col-md-4">
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/periode') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/periode/edit/' . $periode['periode_id']) ?>" class="btn btn-success"><i class="fa fa-edit"></i>&nbsp; Edit</a> 
                </span>
            </div>
        </div>
        <div class="row x_content">
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

    </div>
    <div class="x_panel">
        <div class="x_title">
            <h3>Daftar Transaksi Pemasukan</h3>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped" id="example">
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
                                        <button class="btn btn-success btn-xs" ng-click="inputTransaction(studentTransaction)" type="button"><i class="fa fa-check"></i> Bayar</button>

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
</div>

<script>
    var inputApp = angular.module("inputApp", []);
    var SITEURL = "<?php echo site_url() ?>";
    inputApp.controller('transactionCtrl', function ($scope, $http, $timeout) {
        $scope.studentTransactions = [];
        $scope.periode = [];
        $scope.animate = false;
        $scope.getStudentTransaction = function () {

            var url = SITEURL + 'api/getPeriodeTransaction/<?php echo $periode['periode_id'] ?>';
            $http.get(url).then(function (response) {
                console.log(response.data);
                $scope.studentTransactions = response.data;
                $scope.initDataTable();
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
        $scope.initDataTable = function () {
            $timeout(function () {
                var rowCount = $("#example tr").length;
                if (rowCount >= 0) {
                    $("#example").dataTable({
                        "aaSorting": [],
                        "oLanguage": {
                            "sSearch": "Pencarian :"
                        },
                        "bPaginate": false
                    });
                }
            }, 200)
        }
        angular.element(document).ready(function () {
            $scope.getStudentTransaction();
            $scope.getPeriode();
        });
    });
</script>