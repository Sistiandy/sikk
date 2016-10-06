<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="row x_title">
            <h3>
                Pengaturan
            </h3>
        </div>

        <div class="row x_content">
            <!-- Indicates a successful or positive action -->
            <div class="col-md-8">

                <?php echo form_open_multipart(current_url()) ?>
                <div class="row">
                    <div class="col-md-4">
                        <label>Nama Kelas</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="class_name" value="<?php echo $class_name['setting_value'] ?>" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Deskripsi Kelas</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="class_description" value="<?php echo $class_description['setting_value'] ?>" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Biaya kas</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="class_cash" value="<?php echo $class_cash['setting_value'] ?>" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Simpan" class="btn btn-primary pull-right">
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="col-md-4">
                <div class="alert alert-info">
                    Kolom tidak boleh kosong, Jika ingin di nonaktifkan silakan beri tanda ( - ) pada kolom yang tersedia.
                </div>
            </div>
        </div>
    </div>
</div>