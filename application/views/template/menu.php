<div class="page-loader">
            <div class="page-loader__spinner">
               <svg viewBox="25 25 50 50">
                  <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
               </svg>
            </div>
         </div>
         <header class="header" style="background-color: #ED4C67;">
            <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
               <div class="navigation-trigger__inner">
                  <i class="navigation-trigger__line"></i>
                  <i class="navigation-trigger__line"></i>
                  <i class="navigation-trigger__line"></i>
               </div>
            </div>
            <div class="header__logo hidden-sm-down">
               <h1><a href="<?php echo base_url();?>">Inventory</a></h1>
            </div>
         </header>
         <aside class="sidebar">
            <div class="scrollbar-inner">
               <div class="user">
                  <div class="user__info" data-toggle="dropdown">
                     <img class="user__img" src="<?php echo base_url();?>assets/demo/img/profile-pics/4.jpg" alt="">
                     <div>
                        <!--<div class="user__email">Owner</div>-->
                     </div>
                  </div>
                  <div class="dropdown-menu">
                     <!--<a class="dropdown-item" href="">Settings</a>-->
                     <a class="dropdown-item" href="<?php echo base_url();?>home/logout">Logout</a>
                  </div>
               </div>
               <ul class="navigation">
      				<li><a href="<?php echo base_url();?>home">Home</a></li>
                  <li class="navigation__sub">
                     <a data-toggle="collapse" href="#xmenu1" role="button" aria-expanded="false" aria-controls="xmenu1">cdl &nbsp;
                        <i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i>
                     </a>
                        <div class="collapse xmenu" id="xmenu1">
                           <ul style="padding-left: 10px;">
                              <li>
                                 <a href="<?php echo base_url();?>">Cek</a>
                              </li> 
                           </ul>
                           <br>
                        </div>
                  </li>
      				<li><a href="<?php echo base_url();?>User">User</a></li>
      				<li><a href="<?php echo base_url();?>home">Supplier</a></li>
      				<li><a href="<?php echo base_url();?>home">Barang</a></li>
      				<li><a href="<?php echo base_url();?>home">Barang Masuk</a></li>
      				<li><a href="<?php echo base_url();?>home">Barang Keluar</a></li>
               </ul>
            </div>
         </aside>