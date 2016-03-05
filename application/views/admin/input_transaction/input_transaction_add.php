<?php
$this->load->view('admin/datepicker');
$this->load->view('admin/multi_select');

if (isset($input_transaction)) {
    $inputPeriode = $input_transaction['periode_periode_id'];
}; 
?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php if (!isset($input_transaction)) echo validation_errors(); ?>
        <?php echo form_open_multipart(current_url()); ?>
        <div>
            <h3><?php echo $operation; ?> Input Transaksi</h3><br>
        </div>

        <div class="row">
            <div class="col-sm-9 col-md-9">
                <?php if (isset($input_transaction)): ?>
                    <input type="hidden" name="transaction_id" value="<?php echo $input_transaction['transaction_id']; ?>" />
                <?php endif; ?>
                <label>Periode *</label>
                <select class="form-control" name="periode_id">
                    <?php foreach ($periode as $row): ?>
                    <option value="<?php echo $row['periode_id'] ?>" <?php echo (isset($input_transaction) AND $input_transaction['periode_periode_id'] == $row['periode_id'])? 'selected' : '' ?>><?php echo $row['periode_date'] ?> </option>
                    <?php endforeach; ?>
                </select><br>
                <label>Mahasiswa *</label>
                <?php if(!isset($input_transaction)){ ?>
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
                </div>
                <?php }else{ ?>
                <input disabled="" class="form-control" value="<?php echo $input_transaction['student_name'] ?>" >
                <input hidden="" name="student_id" value="<?php echo $input_transaction['student_student_id'] ?>" >
                <?php } ?>
                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
            </div>
            <div class="col-sm-9 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
                    <a href="<?php echo site_url('admin/input_transaction'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
                    <?php if (isset($input_transaction)): ?>
                        <a href="<?php echo site_url('admin/input_transaction/delete/' . $input_transaction['transaction_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($input_transaction)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b><span class="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/input_transaction/delete/' . $input_transaction['transaction_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $input_transaction['transaction_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $input_transaction['student_name'] ?>" />
                    <button type="submit" class="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
        <script type="text/javascript">
            $(window).load(function() {
                $('#confirm-del').modal('show');
            });
        </script>
    <?php }
    ?>
<?php endif; ?>
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