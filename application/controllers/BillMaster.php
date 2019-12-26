<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillMaster extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Billmastermodel','b');
        $this->load->helper(array('form', 'url'));
	    $this->load->library('upload');
        header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");				
    }
    public function adddata(){ 
        $table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
        $data1="";
        $data="";
        if($table_name == 'bill_master'){
            $data = array(
                 'customerid'=>$this->input->post('customer_name'),
                 'grandamt'=>$this->input->post('grand_amount'),
                 'totalpaidamt'=>$this->input->post('billing_paid_amount'),
                 'distributorid'=>$this->session->c_id,
                 'branchid'=>$this->session->branchid,
                 'bill_date'=>date("Y/m/d"),
                 );
        }else if($table_name=="bii_description"){
            $data = array(
                'billid'=>$this->input->post('billid'),
                'serviceid'=>$this->input->post('serviceid'),
                'amount'=>$this->input->post('amount'),
                'qty'=>$this->input->post('quantity'),
                'paidamt'=>$this->input->post('paid_amount'),
                );
        }
        if($id==""){
            $data1 = $this->b->insertdata($table_name,$data);
        }else{
            $data1 = $this->b->updatedata($table_name,$data,$id);
        }
        echo json_encode($data1);
    }
    public function deletedata()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
       
        $data1=$this->b->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    public function get_master(){
	
        $table_name	=$this->input->post('table_name');
        
		$data=$this->b->data_get($table_name);			
		echo json_encode($data);	
    }
    public function getdropdown(){

        $table_name	=$this->input->post('table_name');
        $where	=$this->input->post('where');
		$data=$this->b->filldropdown($table_name,$where);			
		echo json_encode($data);	

    }
    public function getamount(){
        $where	=$this->input->post('where');
		$data=$this->b->get_amt_service($where);			
		echo json_encode($data);	
    }
    public function getbill_descriptiondata(){
        $where	=$this->input->post('where');
       
		$data=$this->b->get_billdescrpition_data($where);			
		echo json_encode($data);
    }
    // public function print_tax()
    // {   $id=$this->input->post('btnprint');
    //    $this->load->library('myfpdf');
    //     $data['masterdata']=$this->b->get_print_bill($id);
    //     $data['productdata']=$this->b->get_print_bill_discrption($id);
    //     $this->load->view('tax_invoice',$data);
    //    // echo json_encode($data);
    // }

    public function print_tax()
    {   $id=$this->input->post('btnprint');
       $this->load->library('myfpdf');
        $data['masterdata']=$this->b->get_print_bill($id);
        $data['productdata']=$this->b->get_print_bill_discrption($id);
        $this->load->view('tax_invoice',$data);
       // echo json_encode($data);
    }
    public function getprintbilldata(){

        $id	=$this->input->post('id');
      
        $data=$this->b->get_print_bill($id);			
		echo json_encode($data);
    }
}

?>