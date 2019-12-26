<?php  
class Createbranchmodel extends CI_Model  
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
             
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where('status',1);
        $this->db->order_by('branch_mastre.name','asc');
        $query = $this->db->get();
        return $query->result();
    }
}
?>