<?php  
class Paymentreturnmodel extends CI_Model  
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
      
       
       
    }
    function data_get($table){
        if($this->session->role == "distributor"){   
        $this->db->select('*,customer_matserdata.customername');    
        $this->db->from($table);
        $this->db->join('customer_matserdata', 'customer_matserdata.id = payment_master.name');
        $this->db->where('payment_master.status',1);
        $this->db->where('payment_master.branchid',$this->session->branchid);
        $this->db->where('payment_master.distributorid',$this->session->c_id);
        $query = $this->db->get();
        return $query->result();
        }else{
            $this->db->select('*,customer_matserdata.customername');    
            $this->db->from($table);
            $this->db->join('customer_matserdata', 'customer_matserdata.id = payment_master.name');
            $this->db->where('payment_master.status',1);
            $query = $this->db->get();
            return $query->result();
        }
    }
    function filldropdown($table){
        if($this->session->role == "distributor"){  
            if($table=="account_group") {
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
            $this->db->where('branchid',$this->session->branchid);
            $this->db->where('distributorid',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
            }
            }else{
                $this->db->select('*');    
                $this->db->from($table);
                $this->db->where('status',1);
                $query = $this->db->get();
                return $query->result();
            } 
    }
    function getremainamt($id,$table){
        $remian=0;
        $address="";
        $paymentamt=0;
        $returnamt=0;
        $result=array();
                 $this->db->select('sum(grandamt) as totalamt,sum(totalpaidamt) as totalpaid');    
                $this->db->from($table);
                $this->db->where('customerid',$id);
               $query = $this->db->get();
                if($query->num_rows()>0){
                    foreach($query->result_array() as $remainamt){
                        $gradtotal=$remainamt['totalamt'];
                        $totalpaid=$remainamt['totalpaid'];
                        $remian=$gradtotal- $totalpaid;
                       
                    }
                    
                }else{
                    $remian=0;       
                }
                $this->db->select('sum(amount) as pamentamt');    
                $this->db->from('payment_master');
                $this->db->where('name',$id);
                $this->db->where('type','payment');
               $query1 = $this->db->get();
                if($query1->num_rows()>0){
                    foreach($query1->result_array() as $pay){
                        $paymentamt=$pay['pamentamt'];
                        
                       
                    }
                    
                }else{
                    $paymentamt=0;       
                }
                $this->db->select('sum(amount) as returntamt');    
                $this->db->from('payment_master');
                $this->db->where('name',$id);
                $this->db->where('type','return');
               $query2 = $this->db->get();
                if($query2->num_rows()>0){
                    foreach($query2->result_array() as $return){
                        $returnamt=$return['returntamt'];
                        
                       
                    }
                    
                }else{
                    $returnamt=0;       
                }

                $this->db->select('address');    
                $this->db->from('customer_matserdata');
                $this->db->where('id',$id);
               $query = $this->db->get();
               if($query->num_rows()>0){
                foreach($query->result_array() as $remainamt){
                    $address=$remainamt['address'];
                }
            }
            $totalamount=0;
            $totalamount=($remian+$returnamt)-$paymentamt;
                $result[]=array(
                    'remainamt'=>$totalamount,
                    'address'=>$address,
                );
                return $result;
    }
    function getcustomer_amt($id,$customer,$table){
       $amt=0;
        $this->db->select('sum(amount) as custamt');    
        $this->db->from('payment_master');
        $this->db->where('name',$customer);
        $this->db->where('type',$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach($query->result_array() as $remainamt){
                $amt=$remainamt['custamt'];
            }
           
        }else{
            $amt=0;
        }
        return $amt;
    }
}
?>