<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <h3>Dashboard</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $student ?></h3>
                            <p>Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="<?php echo site_url('admin/student'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $inputSum ?></h3>
                            <p>Pemasukkan</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cloud-download"></i>
                        </div>
                        <a href="<?php echo site_url('admin/input_transaction'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $outputSum ?></h3>
                            <p>Pengeluaran</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                        <a href="<?php echo site_url('admin/output_transaction'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $periode ?></h3>
                            <p>Periode Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <a href="<?php echo site_url('admin/periode'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Transaksi <small>Pemasukan</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php foreach ($input as $row){ ?>
                    <article class="media event">
                        <a href="<?php echo site_url('admin/input_transaction/detail/'.$row['transaction_id']); ?>" class="pull-left date">
                            <p class="month"><?php echo pretty_date($row['transaction_input_date'], 'F', FALSE); ?></p>
                            <p class="day"><?php echo pretty_date($row['transaction_input_date'], 'd', FALSE); ?></p>
                        </a>
                        <div class="media-body">
                            <a class="title" href="<?php echo site_url('admin/student/detail/'.$row['student_student_id']); ?>"><?php echo $row['student_name']; ?></a>
                            <p><?php echo $row['periode_description']; ?></p>
                        </div>
                    </article>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Transaksi <small>Pengeluaran</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php foreach ($output as $row){ ?>
                    <article class="media event">
                        <a href="<?php echo site_url('admin/output_transaction/detail/'.$row['output_transaction_id']); ?>" class="pull-left date">
                            <p class="month"><?php echo pretty_date($row['transaction_input_date'], 'F', FALSE); ?></p>
                            <p class="day"><?php echo pretty_date($row['transaction_input_date'], 'd', FALSE); ?></p>
                        </a>
                        <div class="media-body">
                            <a class="title" href="<?php echo site_url('admin/output_transaction/detail/'.$row['output_transaction_id']); ?>"><?php echo $row['transaction_title']; ?></a>
                            <p><?php echo $row['transaction_description']; ?></p>
                        </div>
                    </article>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>