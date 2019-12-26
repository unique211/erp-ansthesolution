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
    <!-- ============================================================== -->
		<div id="form" class="col-md-12">
            <div class="card">
				<div class="card-body">
                    <h4 class="card-title">Stock Report</h4>
				</div> 
				<div class="col-md-12" >
					<div class="form-group row">
							<div class="col-md-2">
								<label class="control-label">Search Supplier wise</label>
							</div>
							<div class="col-md-3">
								<select id="name" class="form-control supplier_name">
								</select>
							</div>
						
							<div class="col-md-1" style="text-align:center;">
								<label class="control-label">Date: </label>
							</div>
							<div class="col-md-3">
								<div class="input-group date doj" data-provide="datepicker">
									<input type="text"  class="form-control input-sm placeholdesize datepicker"  id="fdate" name="r_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
							</div>
							<!-- <div class="col-md-1" style="text-align:right;">
								<label class="control-label"> To:</label>
							</div>
							<div class="col-md-2">
								<div class="input-group date doj" data-provide="datepicker">
									<input type="text"  class="form-control input-sm placeholdesize datepicker" id="tdate" name="r_date"  >
									<div class="input-group-addon">
										<span class="fa fa-calender"></span>
									</div>
								</div>
							</div> -->
							<div class="col-md-2"  style="text-align:center;">
								<Button class="btn btn-success" id="btnsearch" name="Search">Search</Button>
							</div>
					</div>
					
				</div>
				<div class="col-md-12">
						
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Records</h5>
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped ">
								<thead>
									<tr>
									<th class="text-center">SL.</th>
											<th class="text-center">Brand Name</th>
											<th class="text-center">Item Name</th>
											<th class="text-center">Purchase Rate</th>
											<th class="text-center">Sales Rate</th>
											<th class="text-center">In Ctn.</th>
											<th class="text-center">Out Ctn.</th>
											<th class="text-center">Stock</th>
									</tr>
								</thead>
								<tbody id="tablebody">
								
								</tbody>        		
							</table>
						</div>
					</div>
				</div>
			</div>
			    <!-- <div class="table-responsive" style="margin-top: 10px;">
			                    <table id="dataTable" class="table table-striped" >
			                        <thead>
										<tr>
											<th class="text-center">SL.</th>
											<th class="text-center">Brand Name</th>
											<th class="text-center">Item Name</th>
											<th class="text-center">Purchase Rate</th>
											<th class="text-center">Sales Rate</th>
											<th class="text-center">In Ctn.</th>
											<th class="text-center">Out Ctn.</th>
											<th class="text-center">Stock</th>
										</tr>
									</thead>
									<tbody id="tablebody">
									</tbody>
									<tfoot>
										<tr>
																				
										</tr>
									</tfoot>
			                    </table>
			                </div> -->
			            </div>
		                <div class="text-center">
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
var table_name="item_master";
var tit="Stock";
</script>
<script>$('.date').datepicker({
    'todayHighlight':true,
    format: 'dd/mm/yyyy',
    autoclose: true,
});
var date = new Date();
 date = date.toString('dd/MM/yyyy');
$("#fdate").val(date);
$('#tdate').val(date);
</script>

<script src="<?php echo base_url(); ?>dist/js/stocksupplier.js"></script>

