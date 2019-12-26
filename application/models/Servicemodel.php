<?php  
class Servicemodel extends CI_Model  
{  
    function insertdata($table,$data)
	{         
        $result = $this->db->insert($table,$data);
        return $result;
    } 
    function updatedata($table,$data,$id)
    {
        $this->db->where('id',$id);
		$result = $this->db->update($table,$data);
      	return $result;
    } 
    function delete_data($table,$id)
    {
        $data=array(
            'status'=>0,
        );
        $this->db->where('id',$id);
		$result = $this->db->update($table,$data);
      	return $result;
       /* $this->db->where('id',$id);    
        $result = $this->db->delete($table);
        if($table == 'company'){
            $this->db->where('c_id',$id);
            $this->db->delete('login_master');
        }
        return $result;*/
       
    }
    function data_get($table){
        if($this->session->role=="admin"){    
        $this->db->select('service_master.*,branch_mastre.name as branchname');    
        $this->db->from($table);
        $this->db->join('branch_mastre', 'branch_mastre.id = service_master.bramchid');
        $this->db->where('service_master.status',1);
        $this->db->order_by('service_master.s_name','asc');
        $query = $this->db->get();
        return $query->result();
        }else{
            $this->db->select('service_master.*,branch_mastre.name as branchname');    
            $this->db->from($table);
            $this->db->join('branch_mastre', 'branch_mastre.id = service_master.bramchid');
            $this->db->where('service_master.status',1);
            $this->db->where('bramchid',$this->session->branchid);
            $this->db->order_by('service_master.s_name','asc');
            $query = $this->db->get();
            return $query->result();
        }
    }
    function filldropdown($table,$where){
             
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by('branch_mastre.name','asc');
        $query = $this->db->get();
        return $query->result();
    }
}
?>