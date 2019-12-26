<?php 

//echo $newsDate; 
?>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?php echo base_url();?>Main/dashboard">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                           <!-- Dark Logo icon -->
                            <img src="<?php echo base_url(); ?>assets/images/logo_icon.png" alt=" " class="light-logo" />
                           
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                            <!-- <img src="<?php echo base_url(); ?>assets/images/logo_text.png" alt="Stock Management" class="light-logo" /> -->
                            <h4 style="margin-top:10px;">Ans The Solution</h4>
                            
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        
                      
                        
                    </ul>
                    <ul class="navbar-nav float-left mr-auto">
                     <!--   <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li> -->
                       
                       
                    </ul>
                    <!-- ============================================================== --> 
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right" style="border:0px solid white;">
                      <!--  <li class="nav-item dropdown" style="border:0px solid white;padding-top: 7px;">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="<?php echo base_url(); ?>Main/changePassword" aria-haspopup="true" aria-expanded="false"><i class="font-24 fas fa-key"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown" style="border:0px solid white;padding-top: 7px;">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark"  href="<?php echo base_url(); ?>Main/profile" aria-haspopup="true" aria-expanded="false"> <i class="font-24 fas fa-user-circle"></i>
                            </a>
                        </li> -->
                        <li class="nav-item dropdown" style="border:0px solid white;padding-top: 3px;">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="<?php echo base_url(); ?>Main/index" id="2" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-logout"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header  pe-7s-users -->
        <!-- ============================================================== -->
