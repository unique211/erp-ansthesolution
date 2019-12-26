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
                        <img src="<?php echo base_url();?>/assets/images/profile.png" />
                    </div>
                    <div style="border:0px solid black;float:left;margin-left:5px;">
                        <h3>Update Profile</h3>
                        <h6>Your Profile</h6>
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
      
        <div id="form" class="col-md-12" >
            <div class="card" >
				<div class="card-body">
                    <div style="border-bottom:2px solid;width:100%; ">
                        <div><img  class="light-logo" height="70px" width="auto" id="img" name="Image" alt="Image" />
                        </div>
                    
                        <h3 class="card-title" style="text-align: right;" id="name"></h3>
                    </div>
                    <br>
                    <form id="mainform" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-12 row" style="border:0px solid black;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Name of Company </label>
                                    <input type="text" class="form-control" name="cname" id="cname"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Address </label>
                                    <input type="text" class="form-control" name="address" id="address"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Email </label>
                                    <input type="text" class="form-control" name="email" id="email"/>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row" style="border:0px solid black;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Number </label>
                                    <input type="text" class="form-control" name="number" id="number"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">GstNo </label>
                                    <input type="text" class="form-control" name="gst" id="gst"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Pan Number </label>
                                    <input type="text" class="form-control" name="pan" id="pan"/>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row" style="border:0px solid black;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Bank Name </label>
                                    <input type="text" class="form-control" name="bname" id="bname"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">Branch Name</label>
                                    <input type="text" class="form-control" name="branch" id="branch"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">AcNo </label>
                                    <input type="text" class="form-control" name="acno" id="acno"/>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12 row" style="border:0px solid black;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="label-control">IFSC </label>
                                    <input type="text" class="form-control" name="ifsc" id="ifsc"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Company Logo</label>
                                    <input type="file" class="form-control input-md" id="uploadFile1" name="uploadFile1" accept="image/*">
                                    <input type="hidden" id="file_attachother1" value=""/>
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div id="msg1"></div>
                                    <div class="col-md-2" style="margin-top:5px;float:left;">
                                        <div id="containerother_kyc1" ></div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12 card-body align-items-center" style="float:left">
                            <div class="modal-footer">
                                <input type="hidden" id="saveid" />
                                <br>
                                <button type="submit" id="save"  class="btn btn-success pull-right">Update Profile</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 

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
<script src="<?php echo base_url(); ?>dist/js/AjaxFileUpload.js"></script>
<script>
$('#uploadFile1').ajaxfileupload({
	//alert("file Upload");
	//'action' : 'callAction',
	'action' : base_url+'Controller/doc_image_upload',
	'onStart': function() {$("#msg1").html("<font color='red'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>Please wait file is uploading.....</font>"); },
	'onComplete' : function(response) {
		if(response==''){
			$("#msg1").html("<font color='red'>"+"Error in file upload"+"</font>");
		}else{
			$("#file_attachother1").val(response);
			$("#msg1").html("<font id='doc_image_name1' color='green'>"+response+"</font>");
			$("#image_name").val(response);
			$('#containerother_kyc1').empty();
			var url = getRootUrl();  
			var img = $('<img />').addClass('img').attr({
				'id': 'myImage',
				'src': base_url+'assets/Companylogos/'+response,
				'width': 100,					
			}).appendTo('#containerother_kyc1');
		} 
	}
});
function getRootUrl() {
	return window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
}	
</script>
<script src="<?php echo base_url(); ?>dist/js/profile.js"></script>
