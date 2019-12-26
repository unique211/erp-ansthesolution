<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountgroup extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Accountgroupmodel','a');
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
        if($table_name == 'account_group'){
            if($this->session->role=="distributor"){
            $data = array(
                 'name'=>$this->input->post('name'),
                 'bal'=>$this->input->post('bal'),
                 'date'=>$this->input->post('date'),
                 'brachid'=> $this->session->branchid,
                 'distributorid'=>$this->session->c_id,
        
            );
            }else{
                $data = array(
                'name'=>$this->input->post('name'),
                'bal'=>$this->input->post('bal'),
                'date'=>$this->input->post('date'),
                'brachid'=>'',
                'distributorid'=> $this->session->userid,
            );
            }
        }
        if($id==""){
            $data1 = $this->a->insertdata($table_name,$data);
        }else{
            $data1 = $this->a->updatedata($table_name,$data,$id);
        }
        echo json_encode($data1);
    }
    public function deleteData()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
       
        $data1=$this->a->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    public function get_master(){
	
		$table_name	=$this->input->post('table_name');//"account_group"; //
		$data=$this->a->data_get($table_name);			
		echo json_encode($data);	
    }
}

?>