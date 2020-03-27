<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Customermodel', 'c');
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	}
	public function adddata()
	{
		$table_name = $this->input->post('table_name');
		$id = $this->input->post('id');
		$data1 = "";
		$data = "";
		if ($table_name == 'customer_matserdata') {
			$data = array(
				'customername' => $this->input->post('customer_name'),
				'address' => $this->input->post('address'),
				'phone_no' => $this->input->post('phone_no'),
				'category' => $this->input->post('category'),
				'referenceno' => $this->input->post('reference_no'),
				'pancard_no' => $this->input->post('pan_card_no'),
				'aadhar_no' => $this->input->post('aadhar_no'),
				'gstinno' => $this->input->post('gstin_no'),
				'distributorid' => $this->session->c_id,
				'branchid' => $this->session->branchid,
				'narration' => $this->input->post('narration'),

			);
		}
		if ($id == "") {
			$data1 = $this->c->insertdata($table_name, $data);
		} else {
			$data1 = $this->c->updatedata($table_name, $data, $id);
		}
		echo json_encode($data1);
	}
	public function deletedata()
	{
		$table_name = $this->input->post('table_name');
		$id = $this->input->post('id');

		$data1 = $this->c->delete_data($table_name, $id);
		echo json_encode($data1);
	}
	public function get_master()
	{

		$table_name	= $this->input->post('table_name');

		$data = $this->c->data_get($table_name);
		echo json_encode($data);
	}
	public function getdropdown()
	{

		$table_name	= $this->input->post('table_name');
		$where	= $this->input->post('where');
		$data = $this->c->filldropdown($table_name, $where);
		echo json_encode($data);
	}
	public function get_dashbord_data()
	{

		$data = $this->c->get_dashboard_info();
		echo json_encode($data);
		// $this->load->view('include/header',$this->data);
		// $this->load->view('Dashboard',$data);
	}
	public function get_today_data()
	{
		$data = $this->c->get_today_data();
		echo json_encode($data);
	}

	public function getpaymentinfo()
	{
		$data = $this->c->get_payment();
		echo json_encode($data);
	}
}
