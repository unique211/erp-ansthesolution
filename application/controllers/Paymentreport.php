<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentreport extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Paymentreportmodel','p');
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
        if($table_name == 'payment_master'){
            if($this->session->role=="distributor"){
            $data = array(
                 'e_no'=>$this->input->post('e_no'),
                 'e_date'=>$this->input->post('entry_date'),
                 'name'=>$this->input->post('name'),
                 'r_no'=> $this->input->post('r_no'),
                 'r_date'=>$this->input->post('r_date'),
                 'type'=>$this->input->post('type'),
                 'agroup'=>$this->input->post('a_group'),
                 'payment'=>$this->input->post('payment'),
                 'bankname'=> $this->input->post('b_name'),
                 'checkno'=>$this->input->post('check_no'),
                 't_id'=>$this->input->post('t_id'),
                 'amount'=>$this->input->post('amount'),
                 'remark'=>$this->input->post('remark'),
                 'distributorid'=>$this->session->c_id,
                 'branchid'=> $this->session->branchid,
                 'userid'=>$this->session->c_id,
        
            );
            }else{
                $data = array(
                    'e_no'=>$this->input->post('e_no'),
                 'e_date'=>$this->input->post('entry_date'),
                 'name'=>$this->input->post('name'),
                 'r_no'=> $this->input->post('r_no'),
                 'r_date'=>$this->input->post('r_date'),
                 'type'=>$this->input->post('type'),
                 'agroup'=>$this->input->post('a_group'),
                 'payment'=>$this->input->post('payment'),
                 'bankname'=> $this->input->post('b_name'),
                 'checkno'=>$this->input->post('check_no'),
                 't_id'=>$this->input->post('t_id'),
                 'amount'=>$this->input->post('amount'),
                 'remark'=>$this->input->post('remark'),
                 'distributorid'=>'',
                 'branchid'=>'' ,
                 'userid'=>$this->session->userid,
            );
            }
        }
        if($id==""){
            $data1 = $this->p->insertdata($table_name,$data);
        }else{
            $data1 = $this->p->updatedata($table_name,$data,$id);
        }
        echo json_encode($data1);
    }
    public function deleteData()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
       
        $data1=$this->p->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    public function get_master(){
        $branchid	=$this->input->post('branchid');
        $distributorid	=$this->input->post('distributorid');

		$table_name	=$this->input->post('table_name');//"account_group"; //
		$data=$this->p->data_get($table_name,$branchid,$distributorid);			
		echo json_encode($data);	
    }
    public function getdropdowndata(){
        $table_name	=$this->input->post('table_name');
        $where	=$this->input->post('where');//"account_group"; //
       // $table_name	="distributor_master";
       // $where="branchid='3'";
		$data=$this->p->filldropdown($table_name,$where);			
		echo json_encode($data);	
    }
    public function gettotalremainamt(){
        
        $id	=$this->input->post('id');//"customer id"; //
        $table_name	=$this->input->post('table_name');//"bill master"; //
        /*$id='3';
        $table_name	="bill_master";*/
		$data=$this->p->getremainamt($id,$table_name);			
		echo json_encode($data);
    }
    public function getcustomerpayment(){
        $id	=$this->input->post('id');//"customer id"; //
        $customer=$this->input->post('customer');
        $table_name	=$this->input->post('table_name');//"bill master"; //
		$data=$this->p->getcustomer_amt($id,$customer,$table_name);			
		echo json_encode($data);
    }
}

?>