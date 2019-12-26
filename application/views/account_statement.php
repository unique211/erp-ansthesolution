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
		               <!-- <button type="button" id="btnadd" data-target="#form" class="mdi mdi-plus-circle  btn btn-info btn-xs"> ADD </button> -->
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
		<<div id="form1" class="col-md-12">
            <div class="card">
				<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('id'); ?>"/>
					<form id="mainform" method="post" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Account Statement</h4>
					</div>
					<div class="col-md-6" style="float:left;">
					<div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Customer Name</label>
                            <div class="col-sm-3">
							<select class="form-control" id="customername" >
										
								</select>
                            </div>
                            <label class="col-sm-3 text-right control-label col-form-label">Fromdate</label>
                            <div class="col-sm-3">
							<div class="input-group date doj" data-provide="datepicker">
									<input type="text"  class="form-control input-sm placeholdesize datepicker"  id="fromdate" name="fromdate"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
                        </div>
                       
						
					</div>
                    <div class="col-md-6" style="float:right;">
					<div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">To Date</label>
                            <div class="col-sm-3">
							<div class="input-group date doj" data-provide="datepicker">
									<input type="text"  class="form-control input-sm placeholdesize datepicker"  id="todate" name="todate"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
                            </div>
                          
                            <div class="col-sm-3">
                            <button id="generate"  class="btn btn-sm btn-success btn-sm pull-right">Generate</button>
                            </div>
                        </div>
                       
						
					</div>
					<!--<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<br>
							<button type="submit" id="save"  class="btn btn-sm btn-success btn-sm pull-right">Save</button>
							<button type="button" id="btndelete" class="btn btn-sm btn-danger pull-left">Delete</button>
							<button type="button" id="btncancel" class="btn btn-sm btn-info pull-right ">Cancel</button>
                        </div>
					</div>-->
				</form>
            </div>           
		</div>      	
		<div id="tbl" class="row panel">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Records</h5>
						<div class="table-responsive" >
							<table id="dataTable" class="table table-striped table-bordered"  style="width:100%">
								<thead>
                                <tr>
									
										<th width="20%" colspan="2" id="Customername" ></th>
										<th width="20%"></th>
										<th width="20%"  id="Todate"></th>
										<th width="20%"  id="Fromdate"></th>
                                      
                                      
									</tr>
									<tr>
									
										<th width="20%">Date</th>
										<th width="20%">Customername</th>
										<th width="20%">Credit</th>
										<th width="20%">Debit</th>
                                        <th width="20%">Balance</th>
                                      
									</tr>
								</thead>
								<tbody id="tablebody">
									<!--<tr>
										<td>1</td>
										<td>GST REGISTRATION</td>
										<td>2000</td>
										<td><button type="button" name="edit" class="btn btn-xs btn-success" id="1"><i class="fa fa-edit"></i></button><button type="button" name="delete" value="Delete" class=" btn btn-xs btn-danger" id="3"><i class="fa fa-trash"></i></button></td>
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
var base_url="<?php echo base_url(); ?>";
var table_name="supplier_master";
var tit="";
var Customername="";
var Fromdate="";
var Todate="";
</script>
<script>$('.date').datepicker({
    'todayHighlight':true,
    format: 'dd/mm/yyyy',
    autoclose: true,
});
var date = new Date();
 date = date.toString('dd/MM/yyyy');
$("#fromdate").val(date);
$('#todate').val(date);
</script>
<script src="<?php echo base_url(); ?>dist/js/account_statement.js"></script>

