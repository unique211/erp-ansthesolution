<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct(){
		parent:: __construct();
		$this->load->model('Main_model','m');	
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");			
	}
	
	public function index()
	{
		//$this->login();
		if(isset($this->session->userid)){
			$this->session->unset_userdata('userid');  	
			$this->session->unset_userdata('role');  	
			$this->session->unset_userdata('c_id');  	
		}
		$this->load->view("main");			
	}

	function Login(){
		$username = $this->input->post('username'); 
		$password = $this->input->post('password');
		$code = $this->input->post('code');
		
		$result = $this->m->can_login($username, $password,$code);
		echo json_encode($result);
	}
	function adminlogin(){
		
		$this->load->view("adminlogin");
	}
	function userlogin(){
		
		$this->load->view("Login");
	}
	public function dashboard(){
		if((isset($this->session->userid)) && (isset($this->session->role))){
			$this->load->view("Dashboard");
		}else{
			redirect(base_url('Main'));
		}
		
	}
	public function master(){
		$this->load->view("Master");
	}
	public function createbranch()
	{
		if((isset($this->session->userid)) && (isset($this->session->c_id))){
			$title['title_name'] = "  ";
			$title['title_name1'] = "Create Branch";
			//$title['active_menu'] = "v";
			$this->load->view('createbranch',$title);	
		}else{
			redirect(base_url('Main'));
		}
	}
	public function company()
	{
		 if((isset($this->session->userid)) && (isset($this->session->role)== "superadmin")){
			$title['title_name'] = "  ";
			$title['title_name1'] = "Company";
			//$title['active_menu'] = "v";
			$this->load->view('Company',$title);	
		 }else{
		 	redirect(base_url('Main'));
		 }
	}
	public function createservice()
	{
		if((isset($this->session->userid)) && (isset($this->session->c_id))){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Create Service";
		//$title['active_menu'] = "v";
		$this->load->view('createservice',$title);	
		}else{
			redirect(base_url('Main'));
		}
	}
	public function distbrute()
	{
		if((isset($this->session->userid)) && (isset($this->session->c_id))){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Create Distributor";
		//$title['active_menu'] = "v";
		$this->load->view('distbrute',$title);	
		}else{
			redirect(base_url('Main'));
		}
	}
	public function createcustomer()
	{
		if((isset($this->session->userid)) && (isset($this->session->c_id))){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Create Customer";
		//$title['active_menu'] = "v";
		$this->load->view('createcustomer',$title);	
		}else{
			redirect(base_url('Main'));
		}
	}
	public function customermaster()
	{
		if((isset($this->session->userid)) && (isset($this->session->c_id))){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Customer Master";
		//$title['active_menu'] = "v";
		$this->load->view('customermaster',$title);	
		}else{
			redirect(base_url('Main'));
		}
	}
	public function billingmaster()
	{
		if((isset($this->session->userid)) && (isset($this->session->c_id))){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Billing Master";
		//$title['active_menu'] = "v";
		$this->load->view('billingmaster',$title);	
		}else{
			redirect(base_url('Main'));
		}
	}
	public function stocksupplier()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Stock Report(supplier Wise)";
		//$title['active_menu'] = "v";
		$this->load->view('StockSupplier',$title);	
	}
	public function profile()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Profile";
		//$title['active_menu'] = "v";
		$this->load->view('Profile',$title);	
	}
	public function changePassword()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Change Password";
		//$title['active_menu'] = "v";
		$this->load->view('ChangePassword',$title);	
	}
	public function salesReport()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Sales Report";
		//$title['active_menu'] = "v";
		$this->load->view('salesReport',$title);	
	}
	public function purchaseReport()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Purchase Report";
		//$title['active_menu'] = "v";
		$this->load->view('purchaseReport',$title);	
	}
	public function salesReportItem()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Sales Report";
		//$title['active_menu'] = "v";
		$this->load->view('salesreportItem',$title);	
	}
	public function profitReport()
	{
		$title['title_name'] = "  ";
		$title['title_name1'] = "Purchase Report";
		//$title['active_menu'] = "v";
		$this->load->view('profitReport',$title);	
	}
	public function createbillreport(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Billing Report";
		//$title['active_menu'] = "v";
		$this->load->view('bill_report',$title);
	}
	public function createoutstaningreport(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Billing Master";
		//$title['active_menu'] = "v";
		$this->load->view('billingoutstandingreport',$title);
	}
	public function instractiondata(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Instruction Master";
		//$title['active_menu'] = "v";
		$this->load->view('instruction',$title);
	}
	public function disinstractiondata(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Instruction Master";
		//$title['active_menu'] = "v";
		$this->load->view('disinstraction',$title);
	}public function accountgroup(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Instruction Master";
		//$title['active_menu'] = "v";
		$this->load->view('account_group',$title);
	}
	public function paymentreturn(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Instruction Master";
		//$title['active_menu'] = "v";
		$this->load->view('payment_return',$title);
	}
	public function paymentoutreport(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Instruction Master";
		//$title['active_menu'] = "v";
		$this->load->view('paymentreport',$title);
	}
	public function Accountstatement(){
		$title['title_name'] = "  ";
		$title['title_name1'] = "Instruction Master";
		//$title['active_menu'] = "v";
		$this->load->view('account_statement',$title);
	}
	
}
?>
