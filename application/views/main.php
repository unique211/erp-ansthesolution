<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title>Ans The Solutions</title>
	<link href="http://fonts.googleapis.com/css?family=Nova+Flat" rel="stylesheet" type="text/css" /><link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,300" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <!-- <link href="<?php echo base_url(); ?>dist/css/style.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/libs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	
    <!--Sweetalert -->
    <!-- <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet"> -->

    <!--tost msg -->
    <!-- <link href="<?php echo base_url(); ?>assets/toastr/toastr.min.css" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
	body {
    font-family: 'Open Sans', sans-serif;
    line-height: 30px;
	    margin: 0;
    overflow-x: hidden;
     
}
	.media-heading{
	font-family:'Nova Flat';
}
.main_background{
	background-image:url("../assets/images/background/header-bg.jpg");
	<!-- background-repeat:no-repeat; -->
	background-size:cover;
	<!-- vertical-align: middle; -->
	<!-- border-style: none; -->
	<!-- overflow-x: hidden; -->
}
</style>

</head>

<body class="main_background" style="background-image: url('<?php echo base_url(); ?>assets/images/background/header-bg.jpg');">
    <form method="post" action="./" id="form1">
	<img src="<?php echo base_url(); ?>assets/images/zodiac.jpeg" style="width:13%;float:left;margin-top:1%;margin-left:1%;">

   <section style="padding: 100px 0px 0px 0px;">
   <!-- <center> -->
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-lg-offset-3  col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 ">
                        <div class="alert alert-info">
                            <div class="media">
                                <div class="pull-left">
                               
                                    <img src="<?php echo base_url(); ?>assets/images/users/admin.png">
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Admin Login </h3>
                                    <p>
                                       First one in the company to register into the system will act as the main user, who will confirm the user rights of others trying to register under the same account. 
                                    </p>
                                    <a href="<?php echo base_url(); ?>Main/adminlogin" id="adminlogin"  class="btn btn-primary">Go To Admin Login</a>
                                </div>
                            </div>


                        </div>
                        <div class="alert alert-danger">
                            <div class="media">
                                <div class="pull-left">

                                    <img src="<?php echo base_url(); ?>assets/images/users/admin.png" class="img-responsive">
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading">Distributor Login Instructions</h3>
                                    <p>
                                       Enter your user Customer code,Name and Password and click “Login”
                                     (NOTE: for security reasons the user ID will be locked after 5 incorrect tries and login with the ID is no longer possible. In order to open the user ID, user must contact Probus technical support.)
                                    </p>
                                    <a href="<?php echo base_url(); ?>Main/userlogin" class="btn btn-danger ">Go To Distributor Login</a>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
		<!-- </center> -->
        </section>
    </form>

    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <!-- <script src="<?php echo base_url(); ?>assets/libs/popper.js/dist/umd/popper.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
     <!-- sweetalert -->
     <!-- <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script> -->
     <!-- tost msg --> 
   <!-- <script src="<?php echo base_url(); ?>assets/toastr/toastr.min.js"></script> -->
  <!-- <script src="<?php echo base_url(); ?>assets/toastr/tost.js"></script> -->
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
   

</body>

</html>
