<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Servicemodel','s');
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
        if($table_name == 'service_master'){
            $data = array(
                 'bramchid'=>$this->input->post('branch_name'),
                 's_name'=>$this->input->post('service_name'),
                 'amount'=>$this->input->post('amount'),
        
            );
        }
        if($id==""){
            $data1 = $this->s->insertdata($table_name,$data);
        }else{
            $data1 = $this->s->updatedata($table_name,$data,$id);
        }
        echo json_encode($data1);
    }
    public function deletedata()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
       
        $data1=$this->s->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    public function get_master(){
	
		$table_name	=$this->input->post('table_name');
		$data=$this->s->data_get($table_name);			
		echo json_encode($data);	
    }
    public function getdropdown(){

        $table_name	=$this->input->post('table_name');
        $where	=$this->input->post('where');
		$data=$this->s->filldropdown($table_name,$where);			
		echo json_encode($data);	

    }
}

?>