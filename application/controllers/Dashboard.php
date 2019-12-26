<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct(){
        parent:: __construct();
        $this->load->model('My_model','m');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
	{					
    }
    public function getData(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getData($table_name);
        echo json_encode($query);
    }
    public function getTotal(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getTotal($table_name);
        echo json_encode($query);
    }
    public function getsalesbyDate(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getsalesbyDate($table_name);
        echo json_encode($query);
    }
    public function getpurchasebyDate(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getpurchasebyDate($table_name);
        echo json_encode($query);
    }
    public function getsalesReport(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getsalesReport($table_name);
        echo json_encode($query);
    }//
    public function getsalesReportItem(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getsalesReportItem($table_name);
        echo json_encode($query);
    }
    public function getpurchaseReport(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getpurchaseReport($table_name);
        echo json_encode($query);
    }
    public function getPTotal(){
        $table_name=$this->input->post('table_name');
        $query=$this->m->getPTotal($table_name);
        echo json_encode($query);
    }
    public function getchart(){
        $data=$this->m->getchart();
        echo json_encode($data);
    }
    public function getstock(){
        $table_name=$this->input->post('table_name');
        $data=$this->m->getstock($table_name);
        echo json_encode($data);
    }
    public function getstockbyDate(){
        $table_name=$this->input->post('table_name');//"item_master";
        $data=$this->m->getstockbyDate($table_name);
        echo json_encode($data);
    }
    public function getstockbySupplier(){
        $table_name=$this->input->post('table_name');//"item_master";
        $data=$this->m->getstockbySupplier($table_name);
        echo json_encode($data);
    }
    public function getCompany(){
        $table_name=$this->input->post('table_name');
        $data=$this->m->getCompany($table_name);
        echo json_encode($data);
    }
    public function updateProfile(){
        $table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
        $data1="";
        $data="";
        $data = array(
            'name'=>$this->input->post('company_name'),
            'address'=>$this->input->post('address'),
            'email'=>$this->input->post('email'),
            'mobile'=>$this->input->post('phone'),
            'gstno'=>$this->input->post('gst'),
            'pan'=>$this->input->post('pan'),
            'bank_name'=>$this->input->post('bank_name'),
            'branch_name'=>$this->input->post('branch_name'),
            'acno'=>$this->input->post('acno'),
            'ifsc'=>$this->input->post('ifsc'),
            'image'=>$this->input->post('image')
        );
        $data1 = $this->m->updatedata($table_name,$data,$id);
        echo json_encode($data1);
    }
    public function Login(){
        $table_name=$this->input->post('table_name');
		$password = $this->input->post('password');
		$result = $this->m->can_login($table_name,$password);
		echo json_encode($result);
    }
    public function Change(){
        $table_name=$this->input->post('table_name');
        $password = $this->input->post('password');
        $result = $this->m->change($table_name,$password);
		echo json_encode($result);
    }
    public function getsalesItem(){
        $table_name=$this->input->post('table_name');
        $data=$this->m->getsalesItem($table_name);
        echo json_encode($data);
    }
    public function getProfit(){
        $table_name=$this->input->post('table_name');//'salesbill_master';
        $data=$this->m->getProfit($table_name);
        echo json_encode($data);
    }
    public function getProfitbyDate(){
        $table_name=$this->input->post('table_name');//'salesbill_master';
        $data=$this->m->getProfitbyDate($table_name);
        echo json_encode($data);
    }
}
?>