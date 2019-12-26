<?php  
class Billmastermodel extends CI_Model  
{  
    function insertdata($table,$data)
	{      if($table=="bill_master"){   
        $this->db->insert($table,$data);
        $result = $this->db->insert_id();
        }else{
        $result = $this->db->insert($table,$data);
        }
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
        if($table=="bill_master"){
        
        $data=array(
            'status'=>0,
        );
        $this->db->where('id',$id);
		$result = $this->db->update($table,$data);
          return $result;
      }
       if($table=="bii_description"){
        $this->db->where('billid',$id);    
        $result = $this->db->delete($table);
       }
     
    }
    function data_get($table){
        if($this->session->role=="admin"){
        $this->db->select('bill_master.*,customer_matserdata.customername as coustomer');    
        $this->db->from($table);
        $this->db->join('customer_matserdata', 'customer_matserdata.id = bill_master.customerid');
        $this->db->where('bill_master.status',1);
        $query = $this->db->get();
        }else if($this->session->role=="distributor"){ 
        $this->db->select('bill_master.*,customer_matserdata.customername as coustomer');    
        $this->db->from($table);
        $this->db->join('customer_matserdata', 'customer_matserdata.id = bill_master.customerid');
        $this->db->where('bill_master.branchid',$this->session->branchid);
        $this->db->where('bill_master.status','1');
        $query = $this->db->get();
        }else if($this->session->role=="employee"){
        $this->db->select('bill_master.*,customer_matserdata.customername as coustomer');    
        $this->db->from($table);
        $this->db->join('customer_matserdata', 'customer_matserdata.id = bill_master.customerid');
        $this->db->where('bill_master.branchid',$this->session->branchid);
        $this->db->where('bill_master.distributorid',$this->session->c_id);
        $this->db->where('bill_master.status',1);
        $query = $this->db->get();
        }

        return $query->result();
    }
    function filldropdown($table,$where){
            if($table=="customer_matserdata"){
                $this->db->select('*');    
                $this->db->from($table);
                $this->db->where($where);
                $this->db->where('branchid',$this->session->branchid);
                $this->db->order_by('customer_matserdata.customername','asc');
                $query = $this->db->get();
                return $query->result();
            }else if($table=="service_master"){
                 $this->db->select('*');    
                $this->db->from($table);
                $this->db->where($where);
                $this->db->where('bramchid',$this->session->branchid);
                $this->db->order_by('service_master.s_name','asc');
                $query = $this->db->get();
                return $query->result();
            }
    }
    function get_amt_service($where){
        $this->db->select('amount');    
        $this->db->from('service_master');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }function get_billdescrpition_data($where){
        $this->db->select('bii_description.*,service_master.s_name as servicename');    
        $this->db->from('bii_description');
        $this->db->join('service_master', 'service_master.id = bii_description.serviceid');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    // function get_print_bill($id){
        
    //     $this->db->select('bill_master.*,customer_matserdata.customername as customername,customer_matserdata.address,distributor_master.distributor_name as distributor,distributor_master.dis_address');    
    //     $this->db->from('bill_master');
    //     $this->db->join('customer_matserdata', 'customer_matserdata.id = bill_master.customerid');
    //     $this->db->join('distributor_master', 'distributor_master.id = bill_master.distributorid');
    //     $this->db->where('bill_master.id',$id);
    //     $query = $this->db->get();
        
    //     return $query->result();
       
       
    // }
    // function get_print_bill_discrption($id){
    //     $this->db->select('bii_description.*,service_master.s_name as servicename');    
    //     $this->db->from('bii_description');
    //     $this->db->join('service_master', 'service_master.id = bii_description.serviceid');
    //     $this->db->where('bii_description.billid',$id);
    //     $query = $this->db->get();
    //     return $query->result();
    //    }

       function get_print_bill($id){        

        $this->db->select('bill_master.*,customer_matserdata.customername as customername,customer_matserdata.address,customer_matserdata.phone_no,distributor_master.distributor_name as distributor,distributor_master.dis_address');    
        $this->db->from('bill_master');
        $this->db->join('customer_matserdata', 'customer_matserdata.id = bill_master.customerid');
        $this->db->join('distributor_master', 'distributor_master.id = bill_master.distributorid');
        $this->db->where('bill_master.id',$id);
        $query = $this->db->get();        

        return $query->result();              

    }
    function get_print_bill_discrption($id){
        $this->db->select('bii_description.*,service_master.s_name as servicename');    
        $this->db->from('bii_description');
        $this->db->join('service_master', 'service_master.id = bii_description.serviceid');
        $this->db->where('bii_description.billid',$id);
        $query = $this->db->get();
        return $query->result();
       }
}
?>