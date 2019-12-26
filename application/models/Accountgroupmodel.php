<?php  
class Accountgroupmodel extends CI_Model  
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
        
        return $result;*/
       
    }
    function data_get($table){
        if($this->session->role == "distributor"){   
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where('status',1);
        $this->db->where('brachid',$this->session->branchid);
        $this->db->where('distributorid',$this->session->c_id);
        $query = $this->db->get();
        return $query->result();
        }else{
            $this->db->select('*');    
            $this->db->from($table);
            $this->db->where('status',1);
            $query = $this->db->get();
            return $query->result();
        }
    }
}
?>