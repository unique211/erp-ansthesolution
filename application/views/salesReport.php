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
        <div class="row" style="border:0px solid black;">
            <div class="col-12 d-flex no-block align-items-center" style="border:0px solid black;height:100px;background-color:white;">
                <div class="ml-left text-left">
                    <div style="border:0px solid black;float:left;">
                        <img src="<?php echo base_url();?>/assets/images/sales.png" />
                    </div>
                    <div style="border:0px solid black;float:left;margin-left:5px;">
                        <h3>Sales Report</h3>
                        <h6>Total Sales Report</h6>
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
    <div class="container-fluid ">
    <!-- ============================================================== -->
    <!-- ============================================================== -->
      
        <div id="form" class="col-md-12" >
            <div class="card" >
				<div class="card-body">
                    <div class="row col-sm-12">
		                <div class="form-group col-md-3">
		                    <label class="sr-only" for="from_date">Start Date</label>
		                    <input type="text" name="fdate" class="form-control date hasDatepicker" id="fdate" placeholder="Start Date">
		                </div> 
		                <div class="form-group col-md-3">
		                    <label class="sr-only" for="to_date">End Date</label>
		                    <input type="text" name="tdate" class="form-control date hasDatepicker" id="tdate" placeholder="End Date">
                        </div>  
                        <div class="col-md-3">
                            <button type="submit" id="btnsearch" class="btn btn-success">Search</button>
                        </div>
                    </div><br>
                    <div style="border-bottom:1px solid;width:100%; ">
                            <h4 class="card-title" style="text-align: left;">Sales Report</h4>
                        </div>
                        <br>
                    <div class="row col-sm-12">          
                       
                        
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>Sales Date</th>
                                        <th>Invoice No</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tablebody"></tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
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
</div>
<?php 
	include("include/footer.php");
?>
</div>
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
<script>
    // $( ".datepicker" ).datepicker({ dateFormat: 'dd-MM-yyyy' });

var base_url="<?php echo base_url(); ?>";
var table_name="company";
var tit="Company Profile";
</script>

<script src="<?php echo base_url(); ?>dist/js/salesreport.js"></script>
