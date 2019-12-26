<?php  
class Instractionmodel extends CI_Model  
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
             
        $this->db->select('instraction_master.*,service_master.s_name as servicename');    
        $this->db->from($table);
        $this->db->join('service_master', 'service_master.id = instraction_master.serviceid');
        $this->db->where('instraction_master.status',1);
        $query = $this->db->get();
        return $query->result();
    }
    function filldropdown($table,$where){
             
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by('service_master.s_name','asc');
        $query = $this->db->get();
        return $query->result();
    }
    function getinfodata($table,$where){
        if($this->session->role == "distributor"){
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where($where);
        $this->db->where('instraction_master.status',1);
       $query = $this->db->get();
        return $query->result();
        }
    }
}
?>