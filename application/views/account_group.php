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
				<form id="mainform" class="form-horizontal">
                    <div class="card-body">
                        <h4 class="card-title">Account Group</h4>
					</div>

					<div class="col-md-6" style="float:left;">
					<div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Account Group*</label>
                            <div class="col-sm-9">
							<input type="text"  class="form-control" id="name" placeholder="Account Group" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Balance*</label>
                            <div class="col-sm-9">
							<input type="text"  class="form-control" id="bal" placeholder="Balance" required>
                            </div>
                        </div>
						<div class="form-group row">
		                    <label class="col-sm-3 text-right control-label col-form-label">Date*</label>
		                    <div class="col-sm-9">
							<input type="text" class="form-control input-sm placeholdesize datepicker date"  id="date" name="date" placeholder="Date"/>
								<div class="input-group-addon">
									<span class="mdi mdi-calender"></span>
								</div>
		                    </div>
	                    </div>
						
					</div>
	
		<!--	<div class="col-sm-12" align="center">
				<div class="col-lg-3">
				<div class="form-group">
				<label for="fname">Account Group</label>
			
				</div>
				</div>
				<div class="col-sm-4">
				<div class="form-group">
									<input type="text"  class="form-control" id="name" placeholder="Account Group" required>
								
					</div>
				</div>

		</div>
		<div class="col-sm-12" align="center">
				<div class="col-sm-3">
				<div class="form-group">
								<label for="fname">Balance</label>
				</div>
				</div>
				<div class="col-sm-4">
				<div class="form-group">
									<input type="text"  class="form-control" id="bal" placeholder="Balance" required>
								
					</div>
				</div>

		</div>
		<div class="col-sm-12" align="center">
				<div class="col-sm-3">
				<div class="form-group">
								<label for="fname">Date</label>
				</div>
				</div>
				<div class="col-sm-4">
				<div class="form-group">
					<input type="text" class="form-control input-sm placeholdesize datepicker date"  id="date" name="date" placeholder="Date"/>
								<div class="input-group-addon">
									<span class="mdi mdi-calender"></span>
								</div>
					</div>
				</div>

		</div>-->

					<!--
				<div class="row">
				<div class="form-group">
						<div class="col-md-4" >
							
								<label for="fname" class="col-sm-3 text-right control-label col-form-label">Account Group</label>
								<div class="col-sm-9">
									<input type="text" required class="form-control" id="name" placeholder="Account Group">
								</div>
							</div>
						
						</div>
					
					</div>-->
					<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<br>
							<button type="submit" id="save"  class="btn btn-sm btn-success btn-sm pull-right">Save</button>
							<button type="button" id="btndelete" class="btn btn-sm btn-danger pull-left delete_data">Delete</button>
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
										<th width="10%">Sr.</th>
										<th width="10%">Account Group</th>
										<th width="10%">Balance</th>
										<th width="10%">Date</th>
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
var table_name="account_group";
var tit="Acount Group Details";
</script>
<script>
	//var date = $('#date').datepicker({ dateFormat: 'dd/mm/yyyy' }).val();
$('.date').datepicker({
           'todayHighlight':true,
           format: 'dd/mm/yyyy',
           autoclose: true,
       });
var date = new Date();
        date = date.toString('dd/MM/yyyy');
	   $("#date").val(date);
	  // alert(date);
</script>
<script src="<?php echo base_url(); ?>dist/js/accountgroup.js"></script>

