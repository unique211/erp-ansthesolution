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
                        <h4 class="card-title">Payment Return</h4>
					</div>
					<div class="col-md-12" style="float:left;">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="e_no" class="control-label ">Entry no.</label>
                            </div>
                            <div class="col-md-3">
                                <input type="number" required class="form-control" id="e_no" placeholder="Entry No.">
                            </div>
                            <div class="col-md-2">
                                <label for="e_date" class="control-label ">Entry Date</label>
                            </div>
                            <div class="col-md-3">
								<div class="input-group date doj" data-provide="datepicker">
									<input type="text"  class="form-control input-sm placeholdesize datepicker"  id="entry_date" name="entry_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left;">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="customer" class="control-label ">Name</label>
                            </div>
                            <div class="col-md-3">
                            <select id="customer" name="customer" style="width:200px;" class="form-control customer">
                            </select>
                            </div>
                            <div class="col-md-2">
                                <label for="address" class="control-label ">Address</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" required class="form-control" id="address" placeholder="Address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="r_no" class="control-label">Reciept No.</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" required class="form-control" id="r_no" placeholder="Reciept No.">
                            </div>
                            <div class="col-md-2">
                                <label for="r_date" class="control-label">Reciept Date</label>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group date doj" data-provide="datepicker">
									<input type="text"  class="form-control input-sm placeholdesize datepicker"  id="r_date" name="r_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="type" class="control-label ">Type</label>
                            </div>
                            <div class="col-sm-3">
                                <select id="type" name="type" class="form-control type">
                                    <option value="" selected disabled>--Select--</option>
                                    <option value="payment">Payment</option>
                                    <option value="return">Return</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="a_group" class="control-label ">Account Group</label>
                            </div>
                            <div class="col-md-3">
                                <select id="a_group" name="a_group" class="form-control a_group">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left;">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="payment" class="control-label ">Payment Through</label>
                            </div>
                            <div class="col-sm-3">
                                <select id="payment" name="payment" class="form-control payment">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left;"  >
                        <div class="form-group row" id="row">
                            <div class="col-md-2">
                                <label for="b_name" class="control-label ">Bank Name</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text"  class="form-control" id="b_name" placeholder="Bank Name">
                            </div>
                            <div class="col-md-2">
                                <label for="check_no" class="control-label ">Check No.</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text"  class="form-control" id="check_no" placeholder="Check No">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="float:left;" id="row1">
                        <div class="form-group row" >
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
                                <input type="text" required class="form-control" id="amount" placeholder="Amount">
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
                                <label for="total_balance" class="control-label ">Total Balance</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" disabled required class="form-control" id="total_balance" placeholder="Total Balance">
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
                                        <th style="display:none;">ID</th>
                                        <th >Customer</th>
                                        <th>Reciept No</th>
                                        <th>Reciept Date</th>
                                        <th>Type</th>
                                        <th>Payment</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                        <th style="display:none;">Name</th>
                                        <th style="display:none;">Entry No.</th>
                                        <th style="display:none;">Entry Date</th>
                                        <th style="display:none;">Account Group</th>
                                        <th style="display:none;">Bank Name</th>
                                        <th style="display:none;">Check No</th>
                                        <th style="display:none;">Transection id</th>
                                        <th style="display:none;">Pay</th>
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
?><script>$('.date').datepicker({
    'todayHighlight':true,
    format: 'dd/mm/yyyy',
    autoclose: true,
});
var date = new Date();
 date = date.toString('dd/MM/yyyy');
$("#entry_date").val(date);
$('#r_date').val(date);
</script>
<script>
var base_url="<?php echo base_url(); ?>";
var table_name="refund_master";
var tit="Advance Refund Details";
</script>
<script src="<?php echo base_url(); ?>dist/js/refund.js"></script>
<script src="<?php echo base_url(); ?>dist/js/dynamic.js"></script>
<script src="<?php echo base_url(); ?>dist/js/filldata.js"></script>


