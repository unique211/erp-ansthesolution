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
                        <li class="breadcrumb-item active"><?php echo $title1 ?></li> 
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
                <form id="bill_master_form" class="form-horizontal">
					<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('id'); ?>"/>
                    <div class="card-body">
                        <h4 class="card-title">Billing Master</h4>
					</div>
					<div class="col-md-6" style="float:left;">
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Customer Name*</label>
                            <div class="col-sm-9">
                                <select id="customer_name" name="customer_name" class="form-control suppliernm" required>
									<option selected disabled >Select</option>
								<!--	<option value="1" >VISHESH GIRI</option>
									<option value="2" >SUNIL BHISADE</option>
									<option value="3" >Arzoo Shaikh</option>-->
								</select> 
                            </div>
                        </div>
					</div>
					<div class="col-md-6" style="float:right;">
                        <div class="form-group row">
                          
                            <div class="col-sm-9">
							
                            </div>
                        </div>
						
						
					</div>
					
					<hr style="margin-top:150px;width:1024px;">
					
					<div class="col-md-12">
						<div class="table-responsive">
					
							<table id="purchase_bill" class="table table-striped" width="100%" cellspacing="0" >
							
								<thead>
									<tr>
										<th width="27%">Service Name</th>
										<th width="13%">Amount</th>
										<th width="9%">Quantity</th>
										<th width="13%">Total Amount</th>
										<th width="13%">Paid Amount</th>
										<th width="15%">Balance Amount</th>
										<th width="10%">Action</th>
									</tr>
									<tr>
									<form id="bill_tableform">
									<td>
									<select id="suppliername" name="suppliername" class="form-control" form="bill_tableform" require>
												<option selected disabled >Select</option>
												
											</select>
									</td>
										<td>
											<input type="number" style="text-align:right"  class="form-control" id="amount" placeholder="Amount" form="bill_tableform">
										</td>
										<td>
											<input type="number"  style="text-align:right" class="form-control" id="quantity" placeholder="Quantity" form="bill_tableform">
										</td>
										<td>
											<input type="number"  style="text-align:right" class="form-control" id="total_amount" placeholder="Total Amount" form="bill_tableform">
										</td>
										<td>
											<input type="number" style="text-align:right"  class="form-control" id="paid_amount" placeholder="Paid Amount" form="bill_tableform">
										</td>
										<td>
											<input type="number" style="text-align:right"  class="form-control" id="balance_amount" placeholder="Balance Amount" form="bill_tableform">
										</td>
										<td>
										<button type="submit"  form="bill_tableform"  class="btn btn-sm btn-success btn-sm pull-right" name="add" id="add">+</button>
										<!--	<button  type="submit" class="btn btn-sm btn-xs btn-success"  >+</button>-->
										</td>
										</form>
									</tr>
								</thead>
								<tbody id="purchase_billtbody"></tbody>
							<input type="hidden" id="bill_row_id" value="0">
							<input type="hidden" id="bill_save_update" value="">
							</table>
							
						</div>
					</div>
						
					</br>
					
				
					<div class="col-md-6" style="float:right;">
					  

					<div class="form-group row">
                            <div class="col-sm-3"></div>
							<label for="grand_amount"  class="col-sm-3 text-right control-label col-form-label">Grand Amount</label>
                            <div class="col-sm-6">
                                <input type="number" value="0" style="text-align:right" class="form-control" id="grand_amount" placeholder="Grand Amount" >
                            </div>
                        </div>
						<div class="form-group row">
							<div class="col-sm-3"></div>
                            <label for="billing_paid_amount" class="col-sm-3 text-right control-label col-form-label">Total Billing Paid Amount</label>
                            <div class="col-sm-6">
                                <input type="number"  value="0" style="text-align:right" class="form-control" id="billing_paid_amount" placeholder="Total Billing Paid Amount">
                            </div>
                        </div>
						<div class="form-group row">
							<div class="col-sm-3"></div>
							<label for="billing_balance_amount" class="col-sm-3 text-right control-label col-form-label">Total Billing Balance Amount</label>
                            <div class="col-sm-6">
                                <input type="number" value="0" style="text-align:right" class="form-control" id="billing_balance_amount" placeholder="Total Billing Balance Amount">
                            </div>
                        </div>
					</div>

					<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<input type="hidden" id="save_update" />
							<br>
							<button type="submit" style="display:none;" form="pdfgenerate" id="btnprint" name="btnprint" class="btn btn-sm btn-success btn-sm pull-left pdfprint">Print</button>
							<button type="submit" id="save"  class="btn btn-sm btn-success btn-sm pull-right">Save</button>
							<button type="button" id="btndelete" class="btn btn-sm btn-danger pull-left">Delete</button>
							<button type="button" id="btncancel" class="btn btn-sm btn-info pull-right ">Cancel</button>
                        </div>
					</div>
				</form>
            </div>           
		</div>   
		<form id="pdfgenerate" name="pdfgenerate"  method="POST" action="<?php echo base_url('BillMaster/print_tax');?>" target="_blank">
		
		</form>         	
		<div id="tbl" class="row panel">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						
						<div class="table-responsive" id="billing_master">
							<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr.</th>
										<th style="display:none;">Id.</th>
										<th style="display:none;">Customer Id.</th>
										<th>Customer Name</th>
										<th>Grand Amount</th>
										<th>Total Billing Paid Amount</th>
										<th>Total Billing Balance Amount</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody id="tablebody">
								<!--	<tr>
										<td>1</td>
										<td>Arzoo Shaikh</td>
										<td>RAJKOT</td>
										<td>7</td>
										<td>51</td>
										<td>1</td>
										<td>455</td>
										<td>74</td>
										<td>7478</td>
										<td>74</td>
										<td>25</td>
										<td><button type="button" name="edit" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></button><button type="button" name="delete" value="Delete" class=" btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></td>
									</tr>-->
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
$('.date').datepicker({
	   'todayHighlight':true,
	   format: 'dd/mm/yyyy',
	   autoclose: true,
   });
var date = new Date();
	date = date.toString('dd/MM/yyyy');
   $("#bill_date").val(date);
   $("#entry_date").val(date);
  // alert(date);
</script>
<script>
var base_url="<?php echo base_url(); ?>";
var tit="Bill Details";
</script>

<script src="<?php echo base_url(); ?>dist/js/bill_master.js"></script>

