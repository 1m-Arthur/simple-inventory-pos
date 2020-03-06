<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Control System - Mantap DJIWA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url('vendor/normalize/normalize.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendor/bootstrap/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/font-awesome-4.7.0/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendor/themify-icons/themify-icons.css'); ?>">


    <link rel="stylesheet" href="<?php echo base_url('vendor/pe-icon-7-stroke/css/pe-icon-7-stroke.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/cs-skin-elastic.css'); ?>">
    <!-- datatable -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/lib/datatable/dataTables.bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendor/tempusdominus-bootstrap-4/build//css/tempusdominus-bootstrap-4.min.css') ?>" />
    <!-- script jq -->

</head>

<body>

    <!-- Scripts -->
    <!-- jq2&3 depends -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('vendor/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('vendor/jquery/jquery.matchHeight.min.js') ?>"></script>
    <!-- moment js -->
    <script src="<?php echo base_url('vendor/moments/moment.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js') ?>">
    </script>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?php echo base_url(); ?>"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Daftar Menu</li><!-- /.menu-title -->

                    <?php if ($this->session->userdata('role') <= '3') { ?>
                        <li>
                            <a href="<?php echo base_url('material/') ?>"> <i class="menu-icon fa fa-briefcase"></i>Material</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('material/stock') ?>"> <i class="menu-icon fa fa-tag"></i>Stock Material</a>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Bahan</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('lppm/') ?>">LPPM</a></li>
                                <li><i class="fa fa-id-badge"></i><a href="<?php echo base_url('PO/') ?>">Purchase Order</a></li>
                                <li><i class="fa fa-bars"></i><a href="<?php echo base_url('receipt/') ?>">Bon Penerimaan</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Bon Pengeluaran</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="<?php echo base_url('receiptbill/') ?>">Permintaan Bahan</a></li>
                                <li><i class="fa fa-table"></i><a href="<?php echo base_url('productbill/') ?>">Pengeluaran Bahan</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Laporan Stock</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-th"></i><a href="<?php echo base_url('report/receipt') ?>">Laporan Penerimaan Bahan</a></li>
                                <li><i class="menu-icon fa fa-th"></i><a href="<?php echo base_url('report/product') ?>">Laporan Pengeluaran Bahan</a></li>
                                <li><i class="menu-icon fa fa-th"></i><a href="<?php echo base_url('report/stock') ?>">Laporan Stock Bahan</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">User</li><!-- /.menu-title -->
                        <li>
                            <a href="<?php echo base_url('user/userlist'); ?>"> <i class="menu-icon fa fa-users"></i>Userlist</a>
                        </li>
                    <?php } elseif ($this->session->userdata('role') == '4') { ?>
                        <li>
                            <a href="<?php echo base_url('material/') ?>"> <i class="menu-icon fa fa-briefcase"></i>Material</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('material/stock') ?>"> <i class="menu-icon fa fa-tag"></i>Stock Material</a>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Bahan</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('lppm/') ?>">LPPM</a></li>
                                <li><i class="fa fa-id-badge"></i><a href="<?php echo base_url('PO/') ?>">Purchase Order</a></li>
                                <li><i class="fa fa-bars"></i><a href="<?php echo base_url('receipt/') ?>">Bon Penerimaan</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Bon Pengeluaran</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="<?php echo base_url('receiptbill/') ?>">Permintaan Bahan</a></li>
                                <li><i class="fa fa-table"></i><a href="<?php echo base_url('productbill/') ?>">Pengeluaran Bahan</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Laporan Stock</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-th"></i><a href="<?php echo base_url('report/stock') ?>">Laporan Stock Bahan</a></li>
                            </ul>
                        </li>
                    <?php } elseif ($this->session->userdata('role') == '5') { ?>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Bon Pengeluaran</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="<?php echo base_url('receiptbill/') ?>">Permintaan Bahan</a></li>
                                <li><i class="fa fa-table"></i><a href="<?php echo base_url('productbill/') ?>">Pengeluaran Bahan</a></li>
                            </ul>
                        </li>
                    <?php } elseif ($this->session->userdata('role') == '6') { ?>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Bahan</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('lppm/') ?>">LPPM</a></li>
                                <li><i class="fa fa-id-badge"></i><a href="<?php echo base_url('PO/') ?>">Purchase Order</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">PT. Mantap DJIWA</a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                        <div class="dropdown for-message">
                            <strong><?php echo $this->session->userdata('firstname') . $this->session->userdata('lastname'); ?></strong>
                        </div>
                    </div>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?php echo base_url('images/admin.jpg'); ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i><?php echo $this->session->userdata('nickname'); ?></a>
                            <hr style="margin-top:0;margin-bottom:0;">
                            <a class="nav-link" href="<?php echo base_url('user/update_Self') ?>"><i class="fa fa- user"></i>My Profile</a>
                            <a class="nav-link" href="<?php echo base_url('user/changepass'); ?>"><i class="fa fa -cog"></i>Change Password</a>
                            <a class="nav-link" href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->