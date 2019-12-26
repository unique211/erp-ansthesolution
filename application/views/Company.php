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
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div  class="panel panel-default">			
					<div class="panel-heading">
		                <button type="button" id="btnadd" data-target="#form" class="mdi mdi-plus-circle  btn btn-info btn-xs"> ADD </button>                  	
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
    <div class="container-fluid">
    <!-- ============================================================== -->
	<div id="form" class="col-md-12">
        <div class="card">
		<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->role ; ?>"/>
		 <!--<?php /* echo form_open_multipart('Controller/data');*/ ?>
		<form id="mainform">-->
               <form id="mainform" method="post"  class="form-horizontal" enctype="multipart/form-data">
					<div class="col-sm-6" style="float:left;">
                        <div style="margin-top:10px;border-bottom:2px solid;width:90%;">
                            <h4 class="modal-title">Company Information</h4>
                        </div>
						<br>
						<div class="col-sm-10">
                            <div class="form-group">
                                <label>Company Name* </label>
                                <input type="text" class="form-control input-sm placeholdesize" id="company_name" name="company_name" required >
                            </div>
                        </div>
						<div class="col-sm-10">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control textareacss placeholdesize" rows="5" name="address" id="address" style="height: 91px;"></textarea>
                            </div>
                        </div>
						<div class="col-sm-10">
                        	<div class="form-group">
                        		<label>Email ID*</label>
                                <input type="email" class="form-control input-sm placeholdesize" id="email" name="email" required>
                            </div>
                        </div>
						<div class="col-sm-10">
                        	<div class="form-group">
                            	<label>Phone No.*</label>
                                <input type="number" class="form-control input-sm placeholdesize" id="phone" name="phone" maxlength="10" required>
                            </div>
                        </div>
						<div class="col-sm-10">
                            <div class="form-group">
                            	<label>GST No.</label>
                                <input type="text" class="form-control input-sm placeholdesize" id="gst" name="gst" maxlength="15">
                            </div>
                        </div>
						<div class="col-sm-10">
                        	<div class="form-group">
                            	<label>PAN No.</label>
                                <input type="text" class="form-control input-sm placeholdesize" id="pan" name="pan" maxlength="15">
                            </div>
						</div>
						<div class="col-sm-10">
                        	<div class="form-group">
								<label>Licence Start Date</label>
								<div class="input-group date doj" data-provide="datepicker">
									<input type="text"   form="approval_form"  class="form-control input-sm placeholdesize datepicker"  id="start_date" name="start_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
						</div>
						<div class="col-sm-10">
                        	<div class="form-group">
                            	<label>Is SMS Integration ??</label>
								<select id="integration"  name="integration" class="form-control">
									<option value="" selected disabled>--Select--</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
                            </div>
                        </div>
					</div>
					<div class="col-sm-6" style="float:left;">
                        <div style="margin-top:10px;border-bottom:2px solid;width:90%;">
                            <h4 class="modal-title">Bank Information</h4>
                        </div>
						<br>
						<div class="col-sm-10">
                            <div class="form-group">
                                <label>Bank Name </label>
                                <input type="text" class="form-control input-sm placeholdesize" id="bank_name" name="bank_name" >
                            </div>
                        </div>
						
						<div class="col-sm-10">
                        	<div class="form-group">
                            	<label>Branch Name</label>
                                <input type="text" class="form-control input-sm placeholdesize" id="branch_name" name="branch_name" >
                            </div>
                        </div>
						<div class="col-sm-10">
                            <div class="form-group">
                            	<label>A/C No.</label>
                                <input type="text" class="form-control input-sm placeholdesize" id="acno" name="acno" />
                            </div>
                        </div>
						<div class="col-sm-10">
                        	<div class="form-group">
                            	<label>IFSC Code</label>
                                <input type="text" class="form-control input-sm placeholdesize" id="ifsc" name="ifsc" >
                            </div>
                        </div>
					</div>
					<div class="col-sm-6" style="float:left;">
                        <div style="margin-top:10px;border-bottom:2px solid;width:90%;">
                            <h4 class="modal-title">Login Information</h4>
                        </div>
						<br>
						<div class="col-sm-10">
                            <div class="form-group">
                                <label>UserName *</label>
                                <input type="text" class="form-control input-sm placeholdesize" id="username" name="username" required>
                            </div>
						</div>
						<div class="col-sm-10">
                            <div class="form-group">
                                <label>Password *</label>
                                <input type="password" class="form-control input-sm placeholdesize" id="password" name="password" required>
                            </div>
						</div>
						<div class="col-sm-10">
                        	<div class="form-group">
                            	<label>Licence End Date</label>
                                <div class="input-group date doj" data-provide="datepicker">
									<input type="text"   form="approval_form"  class="form-control input-sm placeholdesize datepicker"  id="end_date" name="end_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>

                            </div>
						</div>
						<div class="col-sm-10">
                            <div class="form-group">
                                <label>Company Logo</label>
								<input type="file" class="form-control input-md" id="uploadFile1" name="uploadFile1" accept="image/*">							
								<input type="hidden" id="file_attachother1" value=""/>
								<div id="msg1"></div>
								<div class="col-md-2" style="margin-top:30px;">
									<div id="containerother_kyc1" ></div>
								</div>
                            </div>
                        </div>
					</div>
					<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<br>
							<button type="submit" id="save"  class="btn btn-sm btn-success btn-sm pull-right">Save</button>
							<button type="button" id="btndelete" class="btn btn-sm btn-danger pull-left">Delete</button>
							<button type="button" id="btncancel" class="btn btn-sm btn-info pull-right ">Cancel</button>
                        </div>
					</div>
				</form>
				
            </div>           
		</div>            	
		<div id="tbl" class="row panel">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Records</h5>
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr.</th>
										<th style="display: none;">ID</th>
										<th>Company Name</th>
										<th style="display: none;">Address</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>GST No</th>
										<th style="display: none;">Pan</th>
										<th>Bank Name</th>
										<th>Branch Name</th>
										<th style="display: none;">Ac.No</th>
										<th style="display: none;">IFSC</th>
										<th>UserName</th>
										<th style="display: none;">Password</th>
										<th style="display: none;">Image</th>
										<th style="display: none;">Start Date</th>
										<th style="display: none;">End Date</th>
										
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="tablebody">
								</tbody>        		
							</table>
						</div>
					</div>
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
<?php 
	include("include/footer.php");
?>
<script src="<?php echo base_url(); ?>dist/js/company.js"></script>
<script src="<?php echo base_url(); ?>dist/js/AjaxFileUpload.js"></script>
<script>
var base_url="<?php echo base_url(); ?>";
var table_name="company";
var tit="Company Details";
</script>
<script>
$('.date').datepicker({
	   'todayHighlight':true,
	   format: 'dd/mm/yyyy',
	   autoclose: true,
   });
var date = new Date();
	date = date.toString('dd/MM/yyyy');
   $("#start_date").val(date);
   $("#end_date").val(date);
  // alert(date);
</script>
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
				'width': 50,					
			}).appendTo('#containerother_kyc1');
		} 
	}
});
function getRootUrl() {
	return window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
}	
</script>



