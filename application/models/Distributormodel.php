<?php  
class Distributormodel extends CI_Model  
{  
    function insertdata($table,$data)
	{         
         $this->db->insert($table,$data);
        $result = $this->db->insert_id();
        if($result >0){
            $logindata = array(
	
                'c_id'=>$result,
                 'username'=> $this->input->post('user_id'),
                 'password'=> $this->input->post('password'),
                 'role'=> $this->input->post('role'),
                 'code'=> $this->input->post('distributor_code'),
            );
            $result = $this->db->insert('login_master',$logindata);
        }
        return $result;
    } 
    function updatedata($table,$data,$id)
    {
       
        $this->db->where('id',$id);
        $result = $this->db->update($table,$data);
        $logindata = array(

             'username'=> $this->input->post('user_id'),
             'password'=> $this->input->post('password'),
             'role'=> $this->input->post('role'),
             'code'=> $this->input->post('distributor_code'),
        );
        $this->db->where('c_id',$id);
        $this->db->update('login_master',$logindata);
      	return $result;
    } 
    function delete_data($table,$id)
    {
      $data=array(
        'status'=>0,
      );
        $this->db->where('id',$id);    
        $result =  $this->db->update($table,$data);
        if($table =='distributor_master'){
         $this->db->where('c_id',$id);    
         $this->db->update('login_master',$data);
        }
        return $result;
       
    }
    function data_get($table){
          if($this->session->role == "distributor"){
              $cid=$this->session->c_id;
            $this->db->select('distributor_master.branchid');    
            $this->db->from($table);
            $this->db->where('id',$cid);
           $query1 = $this->db->get();
           $branch=$query1->result_array();
           $branchid=$branch[0]['branchid'];

        $this->db->select('distributor_master.*,branch_mastre.name as branchname,login_master.username,password');    
        $this->db->from($table);
        $this->db->join('branch_mastre', 'branch_mastre.id = distributor_master.branchid');
        $this->db->join('login_master', 'login_master.c_id = distributor_master.id');
        $this->db->where('branchid',$branchid);
        $this->db->where('distributor_master.status',1);
        $query = $this->db->get();
          }else if($this->session->role == "admin"){
            $this->db->select('distributor_master.*,branch_mastre.name as branchname,login_master.username,password');    
            $this->db->from($table);
            $this->db->join('branch_mastre', 'branch_mastre.id = distributor_master.branchid');
            $this->db->join('login_master', 'login_master.c_id = distributor_master.id');
            $this->db->where('distributor_master.status',1);
            $query = $this->db->get(); 
          }else if($this->session->role == "employee"){
            $this->db->select('distributor_master.*,branch_mastre.name as branchname,login_master.username,password');    
            $this->db->from($table);
            $this->db->join('branch_mastre', 'branch_mastre.id = distributor_master.branchid');
            $this->db->join('login_master', 'login_master.c_id = distributor_master.id');
            $this->db->where('id',$this->session->c_id);
            $this->db->where('distributor_master.status',1);
            $query = $this->db->get(); 
          }
        return $query->result();
    }
    function filldropdown($table,$where){
             
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
}
?>