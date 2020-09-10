<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/'); ?>img/box.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>SD3PDP - Sistem Data Pengaturan, Penyimpanan, Peminjaman dan Data Pegawai</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url('assets/'); ?>css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url('assets/'); ?>css/light-bootstrap-dashboard.css" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url('assets/'); ?>css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-2.jpg">
            <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?php echo site_url('Home') ?>" class="simple-text">
                        <img src="<?php echo base_url('assets/'); ?>img/box.png" height="25" width="25">
                        | SD3PDP <br><br> Sistem Data Pengaturan, Penyimpanan, Peminjaman dan Data Pegawai
                    </a>
                    <center><span><?php echo $this->session->userdata('tanggal');  ?></span></center>
                </div>

                <ul class="nav">
                    <li>
                        <a href="<?php echo site_url('Home') ?>">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-toggle="collapse" class="row">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            <p class="">Dashboard</p>
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </a>
                        <div id="submenu1" class="collapse">

                            <a class="list-group-item" href="<?php echo site_url('Pegawai') ?>">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <p>Pegawai</p>
                            </a>
                            <?php if ($this->session->userdata('status') == 'admin') { ?>
                                <a class="list-group-item" href="<?php echo site_url('Penyedia') ?>">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                    <p>Penyedia</p>
                                </a>
                                <a class="list-group-item" href="<?php echo site_url('Barang') ?>">
                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                    <p>Barang</p>
                                </a>
                            <?php } ?>
                            <a class="list-group-item" href="<?php echo site_url('Pembelian') ?>">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <p>Pembelian</p>
                            </a>
                        </div>
                    </li>

                    <li>
                        <a href="<?php echo site_url('Inventaris') ?>">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <p>Inventaris</p>
                        </a>
                    </li>

                    <li>
                        <a href="#submenu2" data-toggle="collapse" class="row">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <p class="">Peminjaman</p>
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </a>
                        <div id="submenu2" class="collapse">
                            <a class="list-group-item" href="<?php echo site_url('Pinjam_barang') ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                <p>Daftar Barang</p>
                            </a>
                            <a class="list-group-item" href="<?php echo site_url('Peminjaman') ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                <p>Peminjaman</p>
                            </a>
                        </div>
                    </li>

                    <li>
                        <a href="#submenu3" data-toggle="collapse" class="row">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <p class="">Arsip Surat</p>
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </a>
                        <div id="submenu3" class="collapse">
                            <a class="list-group-item" href="<?php echo site_url('Arsip_surat_keluar')
                                                                ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                <p>Surat Keluar</p>
                            </a>
                            <a class="list-group-item" href="<?php echo site_url('Arsip_surat_masuk')
                                                                ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                <p>Surat Masuk</p>
                            </a>
                        </div>
                    </li>

                    <?php if ($this->session->userdata('status') == 'admin') { ?>
                        <li>
                            <a href="<?php echo site_url('User') ?>">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>User</p>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?php echo site_url('Login/logout'); ?>" class="btn btn-danger btn-flat">Keluar</a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>