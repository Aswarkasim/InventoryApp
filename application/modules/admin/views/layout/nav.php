<?php

$id_user = $this->session->userdata('id_user');
$role = $this->session->userdata('role');

?>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>

            <li class="<?php if ($this->uri->segment(2) == "dashboard") {
                            echo "active";
                        } ?>"><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview <?php if ($this->uri->segment(1) == "barang") {
                                    echo "active";
                                } ?>">
                <a href="#"><i class="fa fa-folder"></i> <span>Data Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($this->uri->segment(2) == "barang") {
                                    echo "active";
                                }  ?>"><a href="<?= base_url('barang/barang') ?>">Data Barang</a></li>
                    <?php if ($role == "Admin") { ?>
                        <li class="<?php if ($this->uri->segment(2) == "jenis") {
                                        echo "active";
                                    }  ?>"><a href="<?= base_url('barang/jenis') ?>">Jenis Barang</a></li>
                        <li class="<?php if ($this->uri->segment(2) == "satuan") {
                                        echo "active";
                                    }  ?>"><a href="<?= base_url('barang/satuan') ?>">Satuan</a></li>
                    <?php  } ?>
                </ul>
            </li>

            <?php if ($role == "Admin") { ?>

                <li class="treeview <?php if ($this->uri->segment(1) == "transaksi") {
                                        echo "active";
                                    } ?>">
                    <a href="#"><i class="fa fa-exchange"></i> <span>Transaksi</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($this->uri->segment(2) == "masuk") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('transaksi/masuk') ?>">Barang Masuk</a></li>
                        <li class="<?php if ($this->uri->segment(2) == "keluar") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('transaksi/keluar') ?>">Barang Keluar</a></li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == "laporan") {
                                        echo "active";
                                    } ?>">
                    <a href="#"><i class="fa fa-file"></i> <span>Laporan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($this->uri->segment(2) == "barang") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('laporan/barang') ?>" target="blank" target="blank">Stok Barang</a></li>
                        <li class="<?php if ($this->uri->segment(2) == "masuk") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('laporan/masuk') ?>">Barang Masuk</a></li>
                        <li class="<?php if ($this->uri->segment(2) == "keluar") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('laporan/keluar') ?>">Barang Keluar</a></li>
                    </ul>
                </li>


                <li class="treeview <?php if ($this->uri->segment(2) == "userl") {
                                        echo "active";
                                    } ?>">
                    <a href="#"><i class="fa fa-user"></i> <span>Manajemen User</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($this->uri->segment(2) == "user") {
                                        echo "active";
                                    } ?>"><a href="<?= base_url('admin/user') ?>">List User</a></li>
                    </ul>
                </li>

                <li class="<?php if ($this->uri->segment(2) == "konfigurasi") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo base_url('admin/konfigurasi')
                                                ?>"><i class="fa fa-cogs"></i> <span>Konfigurasi</span></a></li>

            <?php } ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">