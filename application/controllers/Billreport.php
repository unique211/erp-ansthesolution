<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billreport extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Billreportmodel','m');
        $this->load->helper(array('form', 'url'));
	    $this->load->library('upload');
        header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");				
    }
    
    public function get_master(){
	
        $table_name	=$this->input->post('table_name');
        
		$data=$this->m->data_get($table_name);			
		echo json_encode($data);	
    }
    public function getdropdown(){

        $table_name	=$this->input->post('table_name');
        $where	=$this->input->post('where');
		$data=$this->m->filldropdown($table_name,$where);			
		echo json_encode($data);	

    }
    public function get_billdescription(){
        $table_name	=$this->input->post('table_name');
        $id	=$this->input->post('id');
      
        $data=$this->m->data_get_data($table_name,$id);			
		echo json_encode($data);
    }
}

?>