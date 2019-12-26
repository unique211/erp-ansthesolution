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
                        <h4 class="card-title">Bank Details</h4>
					</div>
					<div class="col-md-12" style="float:left;">
                            <div class="form-group row">
                            <div class="col-md-2">
                                <label for="bankname" class="control-label form-group">Bank Name</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" required class="form-control" id="bankname" placeholder="Bank Name">
                                </div>
                                <div class="col-md-2">
                                <label for="account_no" class="control-label form-group">Account No</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" required class="form-control" id="account_no" placeholder="Account No">
                                </div>
                                <div class="col-md-2">
                                <label for="branch" class="control-label form-group">Branch</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" required class="form-control" id="branch" placeholder="Branch">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="float:left;">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="payment" class="control-label ">Payment Through</label>
                            </div>
                            <div class="col-sm-3">
                                <select id="payment" name="payment" class="form-control payment"><option selected="" disabled="" value="">Select</option><option value="3">Cash</option><option value="5">Cheque</option><option value="6">NEFT</option><option value="7">RTGS</option></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left;">
                        <div class="form-group row" id="row" style="">
                            <div class="col-md-2">
                                <label for="b_name" class="control-label ">Bank Name</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="b_name" placeholder="Bank Name">
                            </div>
                            <div class="col-md-2">
                                <label for="check_no" class="control-label ">Check No.</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="check_no" placeholder="Check No">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float: left;" id="row1">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="t_id" class="control-label ">Transaction Id</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="t_id" name="t_id" class="form-control" placeholder="Transaction Id">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="amount" class="control-label col-form-label">Amount</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" required="" class="form-control" id="amount" placeholder="Amount">
                            </div>
                            <div class="col-md-2">
                                <label for="remark" class="control-label ">Remark</label>
                            </div>
                            <div class="col-md-3">
                                <textarea id="remark" name="remark" class="form-control" placeholder="Remark"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="float:left;">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="payment_option" class="control-label ">Payment Option</label>
                            </div>
                            <div class="col-md-3">
                                <select id="payment_option" name="payment_option" class="form-control payment_option">
                                    <option value="" selected disabled >--Select--</option>            
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">Withdraw</option>
                                </select>
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
                                        <th style="display:none;">ID.</th>
                                        <th>Bank Name</th>
                                        <th>Account No</th>
                                        <th>Branch</th>
                                        <th>Payment Through</th>
                                        <th>Operation</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                        <th style="display:none;">Bank</th>
                                        <th style="display:none;">Check no</th>
                                        <th style="display:none;">Transection Id</th>
                                        <th style="display:none;">Payment</th>
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
<script>
var base_url="<?php echo base_url(); ?>";
var table_name="bank_details";
var tit="Bank Details";
</script>
<script src="<?php echo base_url(); ?>dist/js/bank_details.js"></script>
<script src="<?php echo base_url(); ?>dist/js/dynamic.js"></script>


