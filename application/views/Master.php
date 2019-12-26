<?php
	include("include/header_link.php");
	include("include/header.php");
	include("include/sidebar.php");
	
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
		                <button type="button" id="btnadd" data-target="#form" class="mdi mdi-plus-circle  btn btn-info btn-xs">  Add  </button>                  	
					</div>
				</div>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Issue Book </li>
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
                <form id="issue"  method="post" class="form-horizontal">
					<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('id'); ?>"/>
                    <div class="card-body">
                        <h4 class="card-title">Issue Book Info</h4>
					</div>
					<div class="col-md-6" style="float:left;">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Member Barcode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="m_id" placeholder="Member Barcode Here">
                            </div>
                        </div>
						<div class="form-group row">
		                    <label for="publisher1" class="col-sm-3 text-right control-label col-form-label">Book ID</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" id="b_id" placeholder="Book ID Here">
		                    </div>
	                    </div>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Book Name</label>
		                    <div class="col-sm-9">
		                        <input disabled type="text" class="form-control" id="b_name" placeholder="Book Name Here">
		                    </div>
						</div>
						<div class="form-group row">
		                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Authore Name</label>
		                    <div class="col-sm-9">
		                        <input disabled type="text" class="form-control" id="author" placeholder="Authore Name Here">
		                    </div>
						</div>
					</div>
					<div class="col-md-12 card-body align-items-center" style="float:left">
                        <div class="modal-footer">
							<input type="hidden" id="saveid" />
							<br>
							<button type="button" id="btncancel" class="btn btn-info">Cancel</button>
							<button type="submit" id="save"  class="btn btn-success">Save</button>
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
										<th width="10%">Id</th>
										<th width="10%">Member Id</th>
										<th width="10%">Book Id</th>
										<th width="10%">Book Name</th>
										<th width="10%">Author</th>
										<th width="10%">Issu Date</th>
										<th width="10%">Due Date</th>
										<th width="10%">Panelty</th>
										<th width="10%">Status</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody id="issuetbody">
									<tr>
										<td>1</td>
										<td>abc</td>
										<td>def</td>
										<td>ghi</td>
										<td>jkl</td>
										<td>mno</td>
										<td>pqr</td>
										<td>rsv</td>
										<td>uvw</td>
										<td>xyz</td>
									</tr>
									<tr>
										<td>2</td>
										<td>def</td>
										<td>ghi</td>
										<td>jkl</td>
										<td>mno</td>
										<td>pqr</td>
										<td>rsv</td>
										<td>uvw</td>
										<td>xyz</td>
										<td>abc</td>
									</tr>
									<tr>
										<td>3</td>
										<td>ghi</td>
										<td>pqr</td>
										<td>rst</td>
										<td>uvw</td>
										<td>xyz</td>
										<td>abc</td>
										<td>def</td>
										<td>mno</td>
										<td>jkl</td>
									</tr>
									<tr>
										<td>4</td>
										<td>jkl</td>
										<td>mno</td>
										<td>pqr</td>
										<td>rst</td>
										<td>vwx</td>
										<td>yzu</td>
										<td>sv</td>
										<td>abc</td>
										<td>dfg</td>
									</tr>
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
</script>
<script src="<?php echo base_url(); ?>dist/js/Issue.js"></script>

