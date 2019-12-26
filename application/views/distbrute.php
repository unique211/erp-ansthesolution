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
				<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('id'); ?>"/>
				   <form id="distributor_form" method="post" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Distributore Master</h4>
					</div>
					<div class="col-md-6" style="float:left;">
					<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Select Role*</label>
		                    <div class="col-sm-9">
								<select class="form-control" id="role" required>
									<option selected disabled>Select</option>
									<option  value="admin">Admin</option>
									<option  value="distributor">Distributor</option>
									<option  value="employee">Employee</option>
									
								</select>
		                    </div>
						</div>
						<div class="form-group row">
								<label class="col-sm-3 text-left control-label col-form-label">Distributor Name*</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="distributor_name" placeholder="Distributor Name" required>
								</div>
							</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Distributor Address</label>
		                    <div class="col-sm-9">
		                        <textarea class="form-control" id="distributor_address" placeholder="Distributor Address"></textarea>
		                    </div>
	                    </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Branch*</label>
		                    <div class="col-sm-9">
								<select class="form-control" id="branchname" required>
									<option selected disabled>select</option>
									
								</select>
		                    </div>
						</div>

						
						
					</div>
					
					<div class="col-md-6" style="float:right;">
						
                        <div class="form-group row">
                            <label class="col-sm-3 text-left control-label col-form-label">User Id*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="user_id" placeholder="User Id" required>
                            </div>
                        </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Password*</label>
		                    <div class="col-sm-9">
		                        <input type="password" class="form-control" id="password" placeholder="Password" required>
		                    </div>
	                    </div><br>
						<div class="form-group row" id="forcodediv">
		                    <label for="lname" id="forcode_lable" class="col-sm-3 text-left control-label col-form-label">Distributor Code</label>
		                    <div class="col-sm-9">
		                       <input type="text" class="form-control" id="distributor_code" placeholder="Distributor Code"> 
		                    </div>
						</div>
						
						
					</div>
					<div class="col-md-12 card-body align-items-center" style="float:left">
					<div  style="text-align:left;"><b>Bank Details</b> </div>
					<div class="modal-footer"> </div>
					<div class="col-md-6" style="float:left;">
						<div class="form-group row">
								<label class="col-sm-3 text-left control-label col-form-label">Bank Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="bankname" placeholder="Bank Name">
								</div>
							</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Branch Name</label>
		                    <div class="col-sm-9">
		                        <textarea class="form-control" id="bankbranchname" placeholder="Branch Name"></textarea>
		                    </div>
	                    </div>
					</div>
					
					
					<div class="col-md-6" style="float:right;">
						<div class="form-group row">
								<label class="col-sm-3 text-left control-label col-form-label">A/c No</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="acno" placeholder="A/c No">
								</div>
							</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Ifsc Code</label>
		                    <div class="col-sm-9">
		                        <textarea class="form-control" id="zfsccode" placeholder="Ifsc Code"></textarea>
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
							<table id="dataTable" class="table table-striped table-bordered" style="width:100%;">
								<thead>
									<tr>
										<th>Sr.</th>
										<th style="display:none;">Id.</th>
										<th style="display:none;">User Role.</th>
										<th>Distributor Name</th>
										<th>Distributor Address</th>
										<th style="display:none;">Branch ID.</th>
										<th>Branch</th>
										<!--<th>User Id</th>
										<th>Password</th>  -->
										<th>Distributor Code</th>
										<th style="display:none;">Username</th>
										<th style="display:none;">Password</th>
										<th style="display:none;">Bankname</th>
										<th style="display:none;">Bankbranchname</th>
										<th style="display:none;">AC No</th>
										<th style="display:none;">IFSc Code</th>
										
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody id="tablebody">
								<!--	<tr>
										<td>1</td>
										<td>ALLY SOFT</td>
										<td>RAJKOT</td>
										<td>ALLY SOFT SOLUTIONS</td>
										<td>ally</td>
										<td>ally</td>
										<td>ally</td>
										<td><button type="button" name="edit" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button><button type="button" name="delete" value="Delete" class=" btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></td>
									</tr> -->
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
<script>
var base_url="<?php echo base_url(); ?>";
//var table_name="item_master";
var tit="Distributor Details";
</script>
<script>
	$('.date').datepicker({
        'todayHighlight':true,
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
    var date = new Date();
    date = date.toString('dd/MM/yyyy');
    $("#e_date").val(date);
</script>
<script src="<?php echo base_url(); ?>dist/js/createdistributor.js"></script>

