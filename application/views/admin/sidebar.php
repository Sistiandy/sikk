<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin') ?>">Dashboard</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-users"></i> Mahasiswa <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/student') ?>">Daftar Mahasiswa</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-money"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/input_transaction') ?>">Input Transaksi</a>
                    <li><a href="<?php echo site_url('admin/output_transaction') ?>">Output Transaksi</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-calendar"></i> Periode Kas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/periode') ?>">Daftar Periode</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-gear"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/setting') ?>">Pengaturan Dasar</a>
                    </li>
                </ul>
            </li>

            <li><a><i class="fa fa-users"></i> Pengguna <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('admin/user') ?>">Daftar Pengguna</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->