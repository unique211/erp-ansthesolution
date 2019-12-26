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
				<input type="hidden" name="userid" id="userid" value=""/>
                	<form id="payment" class="form-horizontal">
					
                    <div class="card-body">
                        <h4 class="card-title">Sales Bill</h4>
					</div>
					<div class="col-md-6" style="float:left;">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
							<select id="customer" name="customer" style="width:200px;" class="form-control customer" required>
                            </select>
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" placeholder="Address">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="mobile_no" class="col-sm-3 text-right control-label col-form-label">Mobile No</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="mobile_no" placeholder="Mobile No">
                            </div>
                        </div>
					</div>
					<div class="col-md-6" style="float:right;">
                        <div class="form-group row">
                            <label for="invoice_no" class="col-sm-3 text-right control-label col-form-label">Invoice No.</label>
                            <div class="col-sm-4">
								<input type="hidden" id="inv"/>
                                <input type="text" disabled class="form-control" id="invoice_no" placeholder="Invoice No" >
                            </div>
                        </div>
						<div class="form-group row">
							<label for="invoice_date" class="col-sm-3 text-right control-label col-form-label">Invoice Date</label>
							<div class="col-sm-4">
								<div class="input-group date doj" data-provide="datepicker">
									<input type="text" form="approval_form"  class="form-control input-sm placeholdesize datepicker"  id="invoice_date" name="invoice_date" required >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="stock" class="col-sm-3 text-right control-label col-form-label">Stock</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="stock" placeholder="Stock" >
                            </div>
							<label for="sales_man" class="col-sm-2 text-right control-label col-form-label">Sales Man</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="sales_man" placeholder="Sales Man" required>
                            </div>
                        </div>
					</div>
					<hr style="margin-top:150px;width:1024px;">
					<div class="col-md-12">
						<div class="table-responsive">
							<table id="purchase_bill"  class="table table-striped" style="width:100%;table-layout: fixed;"  cellspacing="0">
								<thead>
									<tr>
										<td>Barcode</td>
										<td>Brand</td>
										<td>Item Name</td>
										<td>MRP</td>
										<td>Quantity</td>
										<td>Discount%</td>
										<td>CGST%</td>
										<td>SGST%</td>
										<td>Total</td>
										<td>Action</td>
									</tr>
									<tr>
										<td>
											<input type="text" style="width:70px;" class="form-control" id="barcode" placeholder="Barcode">
										</td>
										<td>
											<select id="brand" name="brand" style="width:100px;" class="form-control brand">
												<option selected disabled >Select</option>
												<option value="1" >group1</option>
												<option value="2" >group2</option>
												<option value="3" >group3</option>
											</select>
										</td>
										<td><select id="item_name" style="width:100px;" name="item_name" class="form-control">
												<option selected disabled >Select</option>
												<option value="1" >item1</option>
												<option value="2" >item2</option>
												<option value="3" >item3</option>
											</select>
										</td>
										<td><input type="text" style="width:70px;" value="0" class="form-control" id="mrp" placeholder="MRP"></td>
										<td><input type="number" style="width:70px;" value="0" class="form-control" id="qty" placeholder="Quantity"></td>
										<td><input type="number" style="width:70px;" value="0" class="form-control" id="discount" placeholder="Discount"></td>
										<td><input type="number" style="width:50px;" value="0" class="form-control" id="cgst" placeholder="GST"></td>
										<td><input type="number" style="width:50px;" value="0" class="form-control" id="sgst" placeholder="GST"></td>
										<td><input disabled type="number" style="width:70px;" value="0" class="form-control" id="total" placeholder="Total"></td>
										<td><button class="btn btn-sm btn-xs btn-success" name="add" id="add"><i class="mdi mdi-plus"></i></button></td>
									</tr>
								</thead>
								<tbody id="purchbody"></tbody>
							</table>
						</div>
					</div>
					</br>
					<div class="col-md-6" style="float:right;">
                        <div class="form-group row">
                            
							<label for="discount_less" class="col-sm-3 text-right control-label col-form-label">Discount less %</label>
                            <div class="col-sm-3">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="discount_less" placeholder="Discount less" >
                            </div>
							<label for="bill_amount" class="col-sm-3 text-right control-label col-form-label">Bill Amount</label>
							<div class="col-sm-3">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="bill_amount" placeholder="Bill Amount">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="discountless" class="col-sm-3 text-right control-label col-form-label">Discount less +/-</label>
                            <div class="col-sm-3">
                                <input type="number" style="text-align:right" class="form-control" id="discountless" placeholder="Discount less +/-" value="0">
                            </div>
							<label for="disc_amount" class="col-sm-3 text-right control-label col-form-label">Discount Amount</label>
							<div class="col-sm-3">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="disc_amount" placeholder="Discount Amount">
                            </div>
                        </div>
						<div class="form-group row">
							<label for="cgst%" class="col-sm-3 text-right control-label col-form-label">CGST %</label>
                            <div class="col-sm-3">
                                <input type="number" value="0" disabled style="text-align:right" class="form-control" id="cgst1" placeholder="CGST %">
                            </div>
							<label for="cgst_amount" value="0" class="col-sm-3 text-right control-label col-form-label">CGST Amount</label>
							<div class="col-sm-3">
                                <input type="number" value="0" disabled style="text-align:right" class="form-control" id="cgst_amount" placeholder="CGST Amount">
                            </div>
                        </div>
					</div>
					<div class="col-md-9" style="float:right;">
						
						<div class="form-group row">
							<label for="round_off" class="col-sm-2 text-right control-label col-form-label">Round off</label>
                            <div class="col-sm-2">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="round_off" placeholder="Round off">
                            </div>
							<label for="sgst%" class="col-sm-2 text-right control-label col-form-label">SGST %</label>
                            <div class="col-sm-2">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="sgst1" placeholder="SGST %">
                            </div>
							<label for="sgst_amount" class="col-sm-2 text-right control-label col-form-label">SGST Amount</label>
							<div class="col-sm-2">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="sgst_amount" placeholder="SGST Amount">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="paid_rs" class="col-sm-2 text-right control-label col-form-label">Paid RS</label>
                            <div class="col-sm-2">
                                <input type="number" value="0" style="text-align:right" class="form-control" id="paid_rs" placeholder="paid RS">
                            </div>
							<label for="balance" class="col-sm-2 text-right control-label col-form-label">Balance</label>
							<div class="col-sm-2">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="Balance" placeholder="Balance">
                            </div>
							<label for="total_amount" class="col-sm-2 text-right control-label col-form-label">Total Amount</label>
							<div class="col-sm-2">
                                <input disabled type="number" value="0" style="text-align:right" class="form-control" id="total_amount" placeholder="Total Amount">
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

							<button type="submit" form="pdf" id="btnprint" name="btnprint" value="" class="btn btn-sm btn-info pull-right" disabled >Print</button>
                        </div>
					</div>
				</form>
            </div>  
			<form name="pdf" id="pdf" method="POST" action="<?php echo base_url('Controller/print_pdf');?>" target="_blank"></form>                             
		</div>            	
		<div id="tbl" class="row panel">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						
						<div class="table-responsive"  id="show_master">
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
?>
<script>
$('.date').datepicker({
	   'todayHighlight':true,
	   format: 'dd/mm/yyyy',
	   autoclose: true,
   });
var date = new Date();
	date = date.toString('dd/MM/yyyy');
   $("#invoice_date").val(date);
</script>
<script>
var base_url="<?php echo base_url(); ?>";
var table_name="customer_master";
var tit="Sales_Bill Details";
</script>
<script src="<?php echo base_url(); ?>dist/js/filldata.js"></script>
<script src="<?php echo base_url(); ?>dist/js/sales_bill.js"></script>

