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
				<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('id'); ?>"/>	
                <form id="payment" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Purchase Return</h4>
					</div>
					<div class="col-md-6" style="float:left;">
                        <div class="form-group row">
                            <label for="bill_no" class="col-sm-3 text-right control-label col-form-label">Bill No.</label>
                            <div class="col-sm-3">
                                <input type="number" style="text-align:right" class="form-control" id="bill_no" placeholder="Bill No" >
                            </div>
							<label for="bill_date" class="col-sm-2 text-right control-label col-form-label">Bill Date</label>
							<div class="col-sm-4">
						   		<div class="input-group date doj" data-provide="datepicker">
									<input type="text"   form="approval_form"  class="form-control input-sm placeholdesize datepicker"  id="bill_date" name="bill_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="entry_no" class="col-sm-3 text-right control-label col-form-label">Entry No.</label>
                            <div class="col-sm-3">
                                <input type="number" style="text-align:right" class="form-control" id="entry_no" placeholder="Entry No">
                            </div>
							<label for="entry_date" class="col-sm-2 text-right control-label col-form-label">Entry Date</label>
							<div class="col-sm-4">
							   <div class="input-group date doj" data-provide="datepicker">
												<input type="text"   form="approval_form"  class="form-control input-sm placeholdesize datepicker"  id="entry_date" name="entry_date"  >
												<div class="input-group-addon">
													<span class="fa fa-calender"></span>
												</div>
											</div>
                            </div>
                        </div>
					</div>
					<div class="col-md-6" style="float:right;">
                        <div class="form-group row">
                            <label for="sname" class="col-sm-3 text-right control-label col-form-label">Supplier Name</label>
                            <div class="col-sm-3">
							<select id="supplier" name="supplier"  class="form-control suppliernm">
							</select>
							</div>
							<label for="invoice_no" class="col-sm-3 text-right control-label col-form-label">Invoice No</label>
                            <div class="col-sm-3">
								
								<select id="invoice_no" name="supplinvoice_noier"  class="form-control invoice">
								</select>
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="address" placeholder="Address">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="mobile_no" class="col-sm-3 text-right control-label col-form-label">Mobile No</label>
                            <div class="col-sm-4">
                                <input type="number"  class="form-control" id="mobile_no" placeholder="Mobile No">
                            </div>
						
                        </div>
						
					</div>
					<hr style="margin-top:150px;width:1024px;">
					<div class="col-md-12">
						<div class="table-responsive">
							
							<table id="purchase_bill" class="table table-striped" width="100%" cellspacing="0" >
								<thead>
									<tr>
										<td style="display:none;">Group Id</td>
										<td style="display:none;">Item Id</td>
										<td>Barcode</td>
										<td>Brand</td>
										<td>Item Name</td>
										<td>MRP</td>
										<td>Quantity</td>
										<td>Discount%</td>
										<td>GST%</td>
										<td>Total Amount</td>
										<td>Action</td>
									</tr>
									<tr>
										<td>
											<input type="text" style="width:80px;" class="form-control" id="barcode" placeholder="Barcode">
										</td>
										<td><select id="brand" name="brand" style="width:100px;" class="form-control brand">
												
											</select></td>
										<td><select id="item_name" style="width:100px;" name="item_name" class="form-control">
												
											</select>
										</td>
										<td>
											<input type="text" value="0"  style="width:70px;" class="form-control" id="mrp" placeholder="MRP">
										</td>
										<td>
											<input type="number" value="0" style="width:70px;" class="form-control" id="qty" placeholder="Quantity">
										</td>
										<td>
											<input type="number" value="0" style="width:70px;" class="form-control" id="discount" placeholder="Discount">
										</td>
										<td>
											<input type="number" value="0" style="width:70px;" class="form-control" id="gst" placeholder="GST">
										</td>
										<td>
											<input type="text" value="0" disabled style="width:70px;" class="form-control" id="total" placeholder="Total">
										</td>
										<td>
											<input type="button" class="btn btn-sm btn-xs btn-success" name="add" id="add" value="+">
										</td>
									</tr>
								</thead>
								<tbody id="purchbody"></tbody>
							
							</table>
							
						</div>
					</div>
					</br>
					<div class="col-md-6" style="float:right;">
					  
					<div class="form-group row">
                            
							<label for="discount_less"  class="col-sm-3 text-right control-label col-form-label">Discount less %</label>
                            <div class="col-sm-3">
                                <input type="number" value="0" disabled style="text-align:right" class="form-control" id="discount_less" placeholder="Discount less" >
                            </div>
							<label for="bill_amount" class="col-sm-3 text-right control-label col-form-label">Bill Amount</label>
							<div class="col-sm-3">
                                <input type="text" value="0" disabled style="text-align:right" class="form-control" id="bill_amount" placeholder="Bill Amount">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="discountless" class="col-sm-3 text-right control-label col-form-label">Discount less +/-</label>
                            <div class="col-sm-3">
                                <input type="number"  value="0" style="text-align:right" class="form-control" id="discountless" placeholder="Discount less +/-">
                            </div>
							<label for="disc_amount" class="col-sm-3 text-right control-label col-form-label">Discount Amount</label>
							<div class="col-sm-3">
                                <input type="text" value="0" disabled style="text-align:right" class="form-control" id="disc_amount" placeholder="Discount Amount">
                            </div>
                        </div>
						<div class="form-group row">
							<label for="gstt" class="col-sm-3 text-right control-label col-form-label">GST %</label>
                            <div class="col-sm-3">
                                <input type="number" value="0" disabled style="text-align:right" class="form-control" id="gstt" placeholder="GST %">
                            </div>
							<label for="gst_amount" class="col-sm-3 text-right control-label col-form-label">GST Amount</label>
							<div class="col-sm-3">
                                <input type="text" value="0" disabled style="text-align:right" class="form-control" id="gst_amount" placeholder="GST Amount">
                            </div>
                        </div>
					</div>
					<div class="col-md-9" style="float:right;">
						
						<div class="form-group row">
                            <label for="paid_rs" class="col-sm-2 text-right control-label col-form-label">Paid RS</label>
                            <div class="col-sm-2">
                                <input type="number" value="0" style="text-align:right" class="form-control" id="paid_rs" placeholder="paid RS">
                            </div>
							<label for="balance" class="col-sm-2 text-right control-label col-form-label">Balance</label>
							<div class="col-sm-2">
                                <input type="number" value="0" disabled style="text-align:right" class="form-control" id="Balance" placeholder="Balance">
                            </div>
							<label for="total_amount" class="col-sm-2 text-right control-label col-form-label">Total Amount</label>
							<div class="col-sm-2">
                                <input type="number" value="0" disabled style="text-align:right" class="form-control" id="total_amount" placeholder="Total Amount">
                            </div>
                        </div>
					</div>
					
					<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<input type="hidden" id="save_update" />
							<br>
							<button type="submit" id="save"  class="btn btn-sm btn-success btn-sm pull-right">Save</button>
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
						
						<div class="table-responsive" id="show_master">
							<!----table display here----->
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
?><script>
//var date = $('#date').datepicker({ dateFormat: 'dd/mm/yyyy' }).val();
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
var tit="Purchase Return Details";
</script>

<script src="<?php echo base_url(); ?>dist/js/filldata.js"></script>
<script src="<?php echo base_url(); ?>dist/js/purchase_return.js"></script>
