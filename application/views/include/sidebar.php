 <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="<?php echo base_url();?>Main/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="<?php echo base_url();?>Main/master" aria-expanded="false"><i class="mdi mdi-plus"></i><span class="hide-menu">Master </span></a>
                  
						    <ul aria-expanded="false" class="collapse  first-level">
                                
                            <?php
                            if($this->session->role == "superadmin"){
                            ?>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/company" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Company </span></a>
                                </li>
                            <?php
                            }else if($this->session->role == "admin"){
                            ?>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/createbranch" aria-expanded="false"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Create Branch </span></a>
                                </li>

                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/createservice" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Create Service </span></a>
                                </li>
                                
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/distbrute" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Create Distributor </span></a>
                                </li>

                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/createcustomer" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Create Customer </span></a>
                                </li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/createbillreport" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Billing Report </span></a>

                                </li>

                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/instractiondata" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Instractions </span></a>
                                </li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/paymentoutreport" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Payment Outstanding Report </span></a>
                                </li>

                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/Accountstatement" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Account Statement</span></a>
                                </li>
                                <!-- <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/brand" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Billing Report </span></a> -->
                                <!-- </li> -->
									
							<!---	<li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/customermaster" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Create Customer </span></a>
                                </li> --->
                              <!--  <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/billingmaster" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Billing </span></a>
                                </li>  --->

                            </ul>
						</li>
                

                        <?php } else if($this->session->role == "distributor" || $this->session->role == "employee"){
                            ?>
                              <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/createcustomer" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Create Customer </span></a>
                                </li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/billingmaster" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Billing </span></a>
                                </li>

                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/createoutstaningreport" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Billing Outstanding  Report </span></a>
                                </li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/disinstractiondata" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Instractions </span></a>
                                </li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/accountgroup" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Account Group </span></a>
                                </li>
                                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/paymentreturn" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Payment Return </span></a>

                            </li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/Accountstatement" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Account Statement</span></a>
                                </li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url();?>Main/paymentoutreport" aria-expanded="false"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Payment Outstanding Report </span></a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
