<div class="page-loader">
    <div class="page-loader__spinner">
        <svg viewBox="25 25 50 50">
            <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<header class="header" style="background-color: #29477F;">
    <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
        <div class="navigation-trigger__inner">
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
        </div>
    </div>
    <div class="header__logo hidden-sm-down">
        <h1><a href="<?php echo base_url();?>"><i class="fas fa-warehouse fa-2x  "></i> Inventory</a></h1>
    </div>
</header>
<aside class="sidebar">
    <div class="scrollbar-inner">
        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src="<?php echo base_url();?>assets/demo/img/profile-pics/4.jpg" alt="">
                <div>
                    <?php echo $this->session->userdata('nama_user') ?>
                </div>
            </div>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo base_url();?>home/logout">Logout</a>
            </div>
        </div>
        <ul class="navigation">
            <li><a href="<?php echo base_url('home/');?>"> <i class="fas fa-tachometer-alt"></i> Home</a></li>
            <?php if($this->session->userdata('level') == 'superadmin'){ ?>
            <li class="navigation__sub">
                <a data-toggle="collapse" href="#xmod1" role="button" aria-expanded="false" aria-controls="xmod1"><i
                        class="fas fa-fire"></i>
                    Master Data<i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i></a>
                <div class="collapse xmenu" id="xmod1">
                    <ul style="padding-left: 10px;">
                        <li><a href="<?php echo base_url('user/');?>"><i class="fas fa-user"></i> User</a></li>
                    </ul><br>
                </div>
            </li>
            <?php } ?>
            <?php if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'adminkemas') { ?>
            <li class="navigation__sub">
                <a data-toggle="collapse" href="#xmod" role="button" aria-expanded="false" aria-controls="xmod"><i
                        class="fas fa-box"></i> Data
                    Bahan Kemas<i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i></a>
                <div class="collapse xmenu" id="xmod">
                    <ul style="padding-left: 10px;">
                        <li><a href="<?php echo base_url('items/');?>"><i class="fas fa-boxes"></i> Barang</a></li>
                        <li><a href="<?php echo base_url('supplier/');?>"><i class="fas fa-people-carry"></i>
                                Supplier</a></li>
                        <li><a href="<?php echo base_url('input/');?>"><i class="fas fa-sign-in-alt"></i> Barang
                                Masuk</a></li>
                        <li><a href="<?php echo base_url('output/');?>"><i class="fas fa-sign-out-alt"></i> Barang
                                Keluar</a></li>
                    </ul><br>
                </div>
            </li>
            <?php } 
            if($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'adminbaku') { ?>
            <li class="navigation__sub">
<!--                 <a data-toggle="collapse" href="#xmod2" role="button" aria-expanded="false" aria-controls="xmod2"><i
                        class="fas fa-box"></i> Data
                    Bahan Baku<i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i></a> -->
                <a data-toggle="collapse" href="#xmod2" role="button" aria-expanded="false" aria-controls="xmod2"><i class="fas fa-archive"></i> Data
                 Bahan Baku<i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i></a>
                <div class="collapse xmenu" id="xmod2">
                    <ul style="padding-left: 10px;">
                        <li><a href="<?php echo base_url('Baku');?>"><i class="fas fa-boxes"></i> Barang</a></li>
                        <li><a href="<?php echo base_url('supplierBaku/');?>"><i class="fas fa-people-carry"></i>
                                Supplier</a></li>
                        <li><a href="<?php echo base_url('InputBaku');?>"><i class="fas fa-sign-in-alt"></i> Barang
                                Masuk</a></li>
                        <li><a href="<?php echo base_url('OutputBaku');?>"><i class="fas fa-sign-out-alt"></i> Barang
                                Keluar</a></li>
                        <li><a href="<?php echo base_url('InputExpired');?>"><i class="fas fa fa-exclamation-triangle"></i> Barang
                                Expired</a></li>
                    </ul><br>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</aside>