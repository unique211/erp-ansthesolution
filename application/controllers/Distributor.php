<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Distributormodel','d');
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
        if($table_name == 'distributor_master'){
            $data = array(
                 'userrole'=>$this->input->post('role'),
                 'distributor_name'=>$this->input->post('distributor_name'),
                 'dis_address'=>$this->input->post('distributor_address'),
                 'branchid'=>$this->input->post('branchname'),
                 'distributorcode'=>$this->input->post('distributor_code'),
                 'disbankname'=>$this->input->post('bankname'),
                 'disbankbranchname'=>$this->input->post('bankbranchname'),
                 'disacno'=>$this->input->post('acno'),
                 'disifsccode'=>$this->input->post('zfsccode'),

            );
        }
        if($id==""){
            $data1 = $this->d->insertdata($table_name,$data);
        }else{
            $data1 = $this->d->updatedata($table_name,$data,$id);
        }
        echo json_encode($data1);
    }
    public function deletedata()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
       
        $data1=$this->d->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    public function get_master(){
	
        $table_name	=$this->input->post('table_name');
        $data=$this->d->data_get($table_name);			
		echo json_encode($data);	
    }
    public function getdropdown(){

        $table_name	=$this->input->post('table_name');
        $where	=$this->input->post('where');
		$data=$this->d->filldropdown($table_name,$where);			
		echo json_encode($data);	

    }
}

?>