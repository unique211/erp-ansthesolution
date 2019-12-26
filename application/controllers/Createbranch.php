<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createbranch extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Createbranchmodel','c');
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
        if($table_name == 'branch_mastre'){
            $data = array(
                 'name'=>$this->input->post('branch_name'),
                 'address'=>$this->input->post('address'),
                 'phone_no'=>$this->input->post('branch_phone_no'),
                 'b_city'=>$this->input->post('branch_city'),
                 'con_name'=>$this->input->post('contact_name'),
                 'con_email'=>$this->input->post('contact_email'),
                 'con_phoneno'=>$this->input->post('contact_phone_no'),
                 'bankname'=>$this->input->post('bankname'),
                 'bankbranchname'=>$this->input->post('bankbranchname'),
                 'acno'=>$this->input->post('acno'),
                 'zfsccode'=>$this->input->post('zfsccode'),

                /* 'name'=>'as',
                 'address'=>'s',
                 'phone_no'=>'123',
                 'b_city'=>'sads',
                 'con_name'=>'sada',
                 'con_email'=>'sads',
                 'con_phoneno'=>'1122',*/
                
                 
            );
        }
        if($id==""){
            $data1 = $this->c->insertdata($table_name,$data);
        }else{
            $data1 = $this->c->updatedata($table_name,$data,$id);
        }
        echo json_encode($data1);
    }
    public function deletedata()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
       
        $data1=$this->c->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    public function get_master(){
	
		$table_name	=$this->input->post('table_name');//"account_group"; //
		$data=$this->c->data_get($table_name);			
		echo json_encode($data);	
    }
}

?>