<?php
include("include/header_link.php");
include("include/header.php");
include("include/sidebar.php");

?>
<style type="text/css">
	#chart-container {
		width: 600px;
		height: auto;
	}
</style>
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->

		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Dashboard</h4>
					<div class="ml-auto text-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->

		<div class="row">
			<!-- Column -->
			<?php if ($this->session->role == "admin") { ?>

				<div class="col-md-6 col-lg-3 col-xlg-3">
					<a href="<?php echo base_url(); ?>Main/createbranch">
						<div class="card card-hover">
							<div class="box bg-cyan text-center">
								<div class="col-md-3" style="float:left;margin-top:20px;margin-bottom:20px;">
									<h3 class="font-light text-white pull-left"><i class="fas fa-chart-line"></i></h2>
								</div>
								<div style="text-align:right;">
									<h1 id="sales" class="text-white"></h1>
									<h4 class="font-light text-white">Total Branch</h4>
									<h2 class="font-light text-white" id="totalbranch"></h2>
								</div>
							</div>
						</div>
					</a>
				</div>

				<!-- Column -->
				<div class="col-md-6 col-lg-3 col-xlg-3">
					<a href="<?php echo base_url(); ?>Main/distbrute">
						<div class="card card-hover">
							<div class="box bg-success col-md-12 text-center">
								<div class="col-md-3" style="float:left;margin-top:20px;margin-bottom:20px;">
									<h3 class="font-light text-white pull-left">
										<i class="fas fa-shopping-cart"></i>
									</h3>
								</div>
								<div style="text-align:right;">
									<h1 id="purchase" class="text-white"></h1>
									<h4 class="font-light text-white">Total Distributor</h4>
									<h2 class="font-light text-white" id="totalDistributor"></h2>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6 col-lg-3 col-xlg-3">
					<a href="<?php echo base_url(); ?>Main/createcustomer">
						<div class="card card-hover">
							<div class="box bg-warning">
								<div class="col-md-3" style="float:left;margin-top:20px;margin-bottom:20px;">
									<h3 class="font-light text-white pull-left"><i class="fas fa-people-carry"></i></h3>
								</div>
								<div style="text-align:right;">
									<h1 id="supplier" class="text-white"></h1>
									<h4 class="font-light text-white">Total Customer</h4>
									<h2 class="font-light text-white" id="totalcustomer"></h2>
								</div>
							</div>
						</div>
					</a>
				</div>
				<!-- Column -->
				<div class="col-md-6 col-lg-3 col-xlg-3">
					<a href="<?php echo base_url(); ?>Main/createservice">
						<div class="card card-hover">
							<div class="box bg-danger text-center">
								<div class="col-md-3" style="float:left;margin-top:20px;margin-bottom:20px;">
									<h3 class="font-light text-white pull-left"><i class="fas fa-chart-line"></i></h3>
								</div>
								<div style="text-align:right;">
									<h1 id="customer" class="text-white"></h1>
									<h4 class="font-light text-white">Total Service</h4>
									<h2 class="font-light text-white" id="totalservice"></h2>
								</div>
							</div>
						</div>
				</div>
				</a>
		</div>
		<!-- Column -->
	<?php } else if ($this->session->role == "distributor") { ?>
		<div class="col-md-6 col-lg-3 col-xlg-3">
			<a href="<?php echo base_url(); ?>Main/createcustomer">
				<div class="card card-hover">
					<div class="box bg-warning">
						<div class="col-md-3" style="float:left;margin-top:20px;margin-bottom:20px;">
							<h3 class="font-light text-white pull-left"><i class="fas fa-people-carry"></i></h3>
						</div>
						<div style="text-align:right;">
							<h1 id="supplier" class="text-white"></h1>
							<h4 class="font-light text-white">Total Customer</h4>
							<h2 class="font-light text-white" id="totalcustomer"></h2>
						</div>
					</div>
				</div>
			</a>
		</div>
		<!-- Column -->
		<div class="col-md-6 col-lg-3 col-xlg-3">
			<a href="<?php echo base_url(); ?>Main/createservice">
				<div class="card card-hover">
					<div class="box bg-danger text-center">
						<div class="col-md-3" style="float:left;margin-top:20px;margin-bottom:20px;">
							<h3 class="font-light text-white pull-left"><i class="fas fa-chart-line"></i></h3>
						</div>
						<div style="text-align:right;">
							<h1 id="customer" class="text-white"></h1>
							<h4 class="font-light text-white">Total Service</h4>
							<h2 class="font-light text-white" id="totalservice"></h2>
						</div>
					</div>
				</div>
			</a>
		</div>

	</div>
<?php } ?>
<!-- ============================================================== -->
<!-- Sales chart -->
<!-- ============================================================== -->

<div class="col-sm-12" style="border:0px solid blue;float:right;">
	<div class="panel panel-bd lobidisable">
		<div class="panel-heading">
			<div class="panel-title">
				<h4>Today's Report</h4>
			</div>
		</div>
		<div class="panel-body">
			<div class="message_inner">
				<div class="message_widgets">

					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th colspan="2" style="text-align:center;">Today's Report</th>
								<th colspan="4" style="text-align:center;">Total</th>
							</tr>
							<tr>
								<?php if ($this->session->role == "distributor") { ?>
									<th>Customer Name</th>
									<th>Category</th>
								<?php } else { ?>
									<th>Branch Name</th>
									<th>Distributor Name</th>
								<?php } ?>
								<th>Total Bill</th>
								<th>Total Amount</th>
								<th>Total Paid</th>
								<th>Remain Amount</th>

							</tr>


						</thead>
						<tbody id="gettodaydata">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>

<br>
<div class="col-sm-12" style="border:0px solid blue;float:right;">
	<div class="panel panel-bd lobidisable">
		<div class="panel-heading">
			<div class="panel-title">
				<h4>Payment Details</h4>
			</div>
		</div>
		<div class="panel-body">
			<div class="message_inner">
				<div class="message_widgets">

					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Grand Total</th>
								<th>Paid Amont</th>
								<th>Remain Amount</th>


							</tr>


						</thead>
						<tbody id="getpaymentdata"></tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?php
include("include/footer.php");
?>

<script>
	var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>dist/js/dashboarddata.js"></script>
