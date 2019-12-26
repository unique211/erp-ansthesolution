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
				   <form id="mainform" method="post" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Branch Master List</h4>
					</div>
					<div class="col-md-6" style="float:left;">
						<div class="form-group row">
								<label class="col-sm-3 text-left control-label col-form-label">Branch Name* </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="branch_name" placeholder="Branch Name" required>
								</div>
							</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Address</label>
		                    <div class="col-sm-9">
		                        <textarea class="form-control" id="address" placeholder="Address"></textarea>
		                    </div>
	                    </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Branch Phone No</label>
		                    <div class="col-sm-9">
								<input type="number" minlength="10" maxlength="10" style="text-align:left;" class="form-control" id="branch_phone_no" placeholder="Branch Phone No">
		                    </div>
						</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Branch City</label>
		                    <div class="col-sm-9">
								<input type="text" class="form-control" id="branch_city" placeholder="Branch City">
		                    </div>
						</div>
						
					</div>
					
					<div class="col-md-6" style="float:right;">
						
                        <div class="form-group row">
                            <label class="col-sm-3 text-left control-label col-form-label">Contact Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact_name" placeholder="Contact Name">
                            </div>
                        </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Contact Email</label>
		                    <div class="col-sm-9">
		                        <input type="email" class="form-control" id="contact_email" placeholder="Contact Email">
		                    </div>
	                    </div><br>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Contact Phone No</label>
		                    <div class="col-sm-9">
		                       <input type="number" minlength="10" maxlength="10" style="text-align:left;" class="form-control" id="contact_phone_no" placeholder="Contact Phone No"> 
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
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr.</th>
										<th style="display:none;">Id.</th>
										<th>Branch Name</th>
										<th>Address</th>
										<th>Branch Mobile No</th>
										
										<th>Branch City</th>
										<th>Contact Name</th>
										<th>Contact Email</th>
										<th>Contact Phone No</th>
										<th style="display:none;">Bankname.</th>
										<th style="display:none;">Bankbranchname.</th>
										<th style="display:none;">Acno.</th>
										<th style="display:none;">IfSC Code.</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody id="tablebody" >
								<!--	<tr>
										<td>1</td>
										<td>ALLY SOFT SOLUTIONS</td>
										<td>RAJKOT</td>
										<td style="text-align:right;">7698903070</td>
										<td>RAJKOT</td>
										<td>VIshal AKbari</td>
										<td>vishal.rkcet@gmail.com</td>
										<td style="text-align:right;">7574865414</td>
										<td><button type="button" name="edit" class="btn btn-xs btn-success" id="1"><i class="fa fa-edit"></i></button><button type="button" name="delete" value="Delete" class=" btn btn-xs btn-danger" id="3"><i class="fa fa-trash"></i></button></td>
									</tr>  -->
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
var tit="Branch Master Details";
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
<script src="<?php echo base_url(); ?>dist/js/cratebranch.js"></script>

