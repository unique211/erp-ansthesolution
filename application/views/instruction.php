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
                        <h4 class="card-title">Insruction</h4>
					</div>
					<div class="col-md-12" style="float:left;" >
					<div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Service Name*</label>
                            <div class="col-sm-9">
							<select class="form-control" id="servicename" required >
										
								</select>
                            </div>
                        </div>
                        </div>
                      
                        <div class="col-md-12" style="float:left;" >
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">Services Process & document requirement</label>
                            <div class="col-sm-9">
                               <textarea style="width:100%;height:100%;"  id="distributordropselect" name="distributordropselect" placeholder="Services Process & document requirement"></textarea>
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
										<th width="10%">Sr.</th>
										<th style="display:none;">id</th>
                                        <th style="display:none;">Service id</th>
										<th width="10%">Service Name</th>
										<th width="10%">Services Process & document requirement</th>
										<th width="10%">Action</th>
									</tr>
								</thead>
								<tbody id="tablebody" >
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
var tit="Supplier Master Details";
</script>
<script src="<?php echo base_url(); ?>dist/js/instraction.js"></script>

