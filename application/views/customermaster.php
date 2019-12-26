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
				   <form id="customer_form" method="post" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Customer Master</h4>
					</div>
					<div class="col-md-6" style="float:left;">
						<div class="form-group row">
								<label class="col-sm-3 text-left control-label col-form-label">Customer Name*</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="customer_name" placeholder="Customer Name" required>
								</div>
							</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Address</label>
		                    <div class="col-sm-9">
		                        <textarea class="form-control" id="address" placeholder="Address"></textarea>
		                    </div>
	                    </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Phone No</label>
		                    <div class="col-sm-9">
								<input type="number" minlength="10" maxlength="10" style="text-align:right;" class="form-control" id="phone_no" placeholder="Phone No">
		                    </div>
						</div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Category*</label>
		                    <div class="col-sm-9">
								<select class="form-control" id="category" required>
									<option selected disabled>select</option>
									<option value="1">Monthly</option>
									<option value="2">Quarterly</option>
									<option value="3">Half Yearly</option>
									<option value="4">Yearly</option>
									<option value="5">Other</option>
								</select>
		                    </div>
						</div>

						<div class="form-group row" id="narrationinfo" style="display:none;">
                            <label class="col-sm-3 text-left control-label col-form-label">Narration</label>
                            <div class="col-sm-9">
                               <textarea style="width:100%;height:100%;"  id="narration" name="narration" placeholder="Narration"></textarea>
                            </div>
                        </div>
						
					</div>
					
					<div class="col-md-6" style="float:right;">
						
                        <div class="form-group row">
                            <label class="col-sm-3 text-left control-label col-form-label">Referance No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="reference_no" placeholder="Referance No">
                            </div>
                        </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-left control-label col-form-label">Pan Card No</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" id="pan_card_no" placeholder="Pan Card No">
		                    </div>
	                    </div><br>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-left control-label col-form-label">Aadhar No</label>
		                    <div class="col-sm-9">
		                       <input type="text" class="form-control" id="aadhar_no" placeholder="Aadhar No"> 
		                    </div>
						</div>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-left control-label col-form-label">GSTIN No</label>
		                    <div class="col-sm-9">
		                       <input type="text" class="form-control" id="gstin_no" placeholder="GSTIN No"> 
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
										<th style="display:none;">Id</th>
										<th>Customer Name</th>
										<th>Address</th>
										<th>Phone No</th>
										<th style="display:none;">Category Id</th>
										<th>Category</th>
										<th>Referance No</th>
										<th>Pan Card No</th>
										<th>Aadhar Card No</th>
										<th>GSTIN No</th>
										<th style="display:none;">Narration</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody id="tablebody">
									<!--<tr>
										<td>1</td>
										<td>Arzoo Shaikh</td>
										<td>RAJKOT</td>
										<td style="text-align:right;">7698903070</td>
										<td>Monthly</td>
										<td>1</td>
										<td>ABCDE6523H</td>
										<td>123456255646466</td>
										<td>sd11fgd51dfg1d</td>
										<td><button type="button" name="edit" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button><button type="button" name="delete" value="Delete" class=" btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></td>
									</tr> --->
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
var tit="Customer Details";
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
<script src="<?php echo base_url(); ?>dist/js/createcustomer.js"></script>
