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
		               <!-- <button type="button" id="btnadd" data-target="#form" class="mdi mdi-plus-circle  btn btn-info btn-xs"> ADD </button>                  	-->
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
					<form id="mainform" method="post" action="<?php echo base_url();?>Invoice" target="_blank" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Barcode master</h4>
					</div>
					<div class="col-md-6" style="float:left;">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Company Name</label>
                            <div class="col-sm-9">
                                <select id="cname" name="cname"  class="form-control cname">
                                    <option value="" selected disabled>--Select--</option>
								</select>
								<input type="hidden" name="name" id="name"/>
                            </div>
                        </div>
						<div class="form-group row">
		                    <label for="publisher1" class="col-sm-3 text-right control-label col-form-label">Item Name</label>
		                    <div class="col-sm-9">
                            <select id="iname" name="iname"  class="form-control iname">
                                <option value="" selected disabled>--Select--</option>
							</select>
							<input type="hidden" name="item" id="item"/>
		                    </div>
	                    </div>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Item Code</label>
		                    <div class="col-sm-9">
		                        <input type="number" class="form-control" name="icode"  id="icode" placeholder="Item Code">
		                    </div>
						</div>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">MRP.</label>
		                    <div class="col-sm-9">
		                        <input type="text" value="0" style="text-align:right;" class="form-control" name="mrp" id="mrp" placeholder="MRP">
		                    </div>
						</div>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Barcode Quantity</label>
		                    <div class="col-sm-9">
								<input autocomplete="OFF" type="number" class="form-control" id="print_qty"  name="print_qty">
		                    </div>
						</div>						

					</div>
					<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<br>
							<button type="submit" id="save"  class="btn btn-sm btn-success btn-sm pull-right">Generate</button>
						<!--	<button type="button" id="btndelete" class="btn btn-sm btn-danger pull-left">Delete</button>
							<button type="button" id="btncancel" class="btn btn-sm btn-info pull-right ">Cancel</button> -->
                        </div>
					</div>
				</form>
            </div>           
		</div>            	
		<!-- <div id="tbl" class="row panel">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Records</h5>
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="10%">Sr.</th>
										<th width="10%">Supplier Name</th>
										<th width="10%">Address</th>
										<th width="10%">Mobile No</th>
										<th width="10%">GSTIN</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody id="tablebody">								

								</tbody>        		
							</table>
						</div>
					</div>
				</div>
			</div>
		</div> -->
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
var table_name="customer_master";
</script>
<script src="<?php echo base_url(); ?>dist/js/filldata.js"></script>
<script src="<?php echo base_url(); ?>dist/js/barcode.js"></script>