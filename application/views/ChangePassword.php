<?php
	include("include/header_link.php");
	include("include/header.php");
	include("include/sidebar.php");
	
?>
<?php
	$title = '';
	$title1 = '';
if(isset($title_name)){
	$title = $title_name;
	$title1 = $title_name1;
}
?>
 <!-- Page wrapper  -->
        <!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div id="column" class="page-breadcrumb">
    <div class="row" style="border:0px solid black;">
            <div class="col-12 d-flex no-block align-items-center" style="border:0px solid black;height:100px;background-color:white;">
                <div class="ml-left text-left">
                    <div style="border:0px solid black;float:left;">
                        <img src="<?php echo base_url();?>/assets/images/padlock.png"/>  
                    </div>
                    <div style="border:0px solid black;float:left;margin-left:5px;">
                        <h3 style="margin-top:15px;">Change your Password</h3>
                        
                    </div>
                </div>    
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home /</a></li>&nbsp;	
                        <li class="active"><?php echo $title1 ?></li> 
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
       
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
	<!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid ">
    <!-- ============================================================== -->
    <!-- ============================================================== -->
     <center>
        <div id="form" class="col-md-6" >
            <div class="card" >
				<div class="card-body">
                    <div style="border-bottom:2px solid;width:100%; ">
                        
                    
                        <h3 class="card-title" style="text-align: center;">Change Your Password</h3>
                    </div>
                    <br>
                    <form id="mainform" method="post" class="form-horizontal">
                      
                                <div class="form-group">
                                    <label class="label-control pull-left">Old Password </label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Old Password"/>
                                </div>
                               
                                <div class="form-group">
                                    <label class="label-control pull-left">New Password </label>
                                    <input disabled type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password"/>
                                </div>
                                <div class="form-group">
                                    <label class="label-control pull-left">Confirm Password </label>
                                    <input disabled type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password"/>
                                </div>
                        <div class="col-md-12 card-body align-items-center" style="float:left">
                            <div class="modal-footer">
                                <input type="hidden" id="saveid" />
                                <br>
                                <button type="submit" id="save"  class="btn btn-success pull-right">Change Password </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 
    </center>
    </div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<?php 
	include("include/footer.php");
?>
</div>
<script>
var base_url="<?php echo base_url(); ?>";
var table_name="company";
var tit="Company Profile";
</script>
<script src="<?php echo base_url(); ?>dist/js/changePassword.js"></script>
