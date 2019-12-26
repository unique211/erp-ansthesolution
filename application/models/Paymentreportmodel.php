<?php  
class Paymentreportmodel extends CI_Model  
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
    function data_get($table,$getbranchid,$getdisid){
        $customername="";
        $customerid="";
        $distribuname="";
        $remian=0;
        $address="";
        $paymentamt=0;
        $returnamt=0;
        $result=array();
        $distribuid=0;
        $branchid="";
        $branchname="";
            $id="";
        if($this->session->role == "distributor"){   
       
        $this->db->select('*');    
        $this->db->from('payment_master');
        $this->db->where('payment_master.branchid',$this->session->branchid);
        $this->db->where('payment_master.distributorid',$this->session->c_id);
        $this->db->group_by('payment_master.name'); 
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach($query->result_array() as $getcustomer){
                $customerid=$getcustomer['name'];
                $distribuid=$getcustomer['distributorid'];
                $branchid=$getcustomer['branchid'];
                $id=$getcustomer['id'];

                    if($customerid!=""){
                        $this->db->select('customername');    
                        $this->db->from('customer_matserdata');
                        $this->db->where('customer_matserdata.id',$customerid);
                        $query2=$this->db->get();
                        if($query2->num_rows()>0){
                            foreach($query2->result_array() as $customerdata){
                                $customername=$customerdata['customername'];
                            }
                        }
                        $this->db->select('sum(grandamt) as totalamt,sum(totalpaidamt) as totalpaid');    
                        $this->db->from('bill_master');
                        $this->db->where('customerid',$customerid);
                        $this->db->where('bill_master.distributorid',$this->session->c_id);
                        $this->db->where('bill_master.branchid',$this->session->branchid);
                       // $this->db->group_by('payment_master.name');     
                         $query4 = $this->db->get();
                        if($query4->num_rows()>0){
                            foreach($query4->result_array() as $remainamt){
                                $gradtotal=$remainamt['totalamt'];
                                $totalpaid=$remainamt['totalpaid'];
                                $remian=$gradtotal- $totalpaid;
                               
                            }
                        }else{
                            $remian=0;       
                        }
                        $this->db->select('sum(amount) as pamentamt');    
                        $this->db->from('payment_master');
                        $this->db->where('name',$customerid);
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
                            $this->db->where('name',$customerid);
                            $this->db->where('type','return');
                          $query2 = $this->db->get();
                            if($query2->num_rows()>0){
                                foreach($query2->result_array() as $return){
                                    $returnamt=$return['returntamt'];
                                    
                                
                                }
                                
                            }else{
                                $returnamt=0;       
                            }
                    }
                    if($branchid!=""){
                        $this->db->select('branch_mastre.name as branch');    
                        $this->db->from('branch_mastre');
                        $this->db->where('branch_mastre.id',$branchid);
                        $query2=$this->db->get();
                        if($query2->num_rows()>0){
                            foreach($query2->result_array() as $branchinfo){
                                $branchname=$branchinfo['branch'];
                            }
                        }
                    }
                    if($distribuid!=""){
                        $this->db->select('distributor_master.distributor_name as distributorname');    
                        $this->db->from('distributor_master');
                        $this->db->where('distributor_master.id',$distribuid);
                        $query2=$this->db->get();
                        if($query2->num_rows()>0){
                            foreach($query2->result_array() as $distributorinfo){
                                $distribuname=$distributorinfo['distributorname'];
                            }
                        }
                    }

                    $totalamount=0;
                    $totalamount=($remian+$returnamt)-$paymentamt;
                        $result[]=array(
                            'remainamt'=>$totalamount,
                            'branchname'=>$branchname,
                            'customername'=>$customername,
                            'distribuname'=>$distribuname,
                            'distribuid'=>$distribuid,
                            'customerid'=>$customerid,
                            'branchid'=>$branchid,
                            'id'=>$id,
                        );
                       
            }
           
        } 
        return $result;
        }else{

            $this->db->select('*');    
            $this->db->from('payment_master');
            if($getbranchid !="All" && $getdisid !="All"){
                if($getbranchid !="" && $getdisid!=""){
                $this->db->where('payment_master.distributorid',$getdisid);
                $this->db->where('payment_master.branchid',$getbranchid);
                }if($getbranchid =="") {
                    $this->db->where('payment_master.distributorid',$getdisid);
                }
                if($getdisid =="") {
                    $this->db->where('payment_master.branchid',$getbranchid);
                }
            }else if($getbranchid !="All" && $getdisid =="All"){
               // $this->db->where('payment_master.distributorid',$getdisid);
                $this->db->where('payment_master.branchid',$getbranchid);
            }else if($getbranchid =="All" && $getdisid !="All"){
                 $this->db->where('payment_master.distributorid',$getdisid);
                // $this->db->where('payment_master.branchid',$branchid);
             }
           // $this->db->where('payment_master.branchid',$this->session->branchid);
            //$this->db->where('payment_master.distributorid',$this->session->c_id);
            $this->db->group_by('payment_master.name'); 
            $query = $this->db->get();
            if($query->num_rows()>0){
                foreach($query->result_array() as $getcustomer){
                    $customerid=$getcustomer['name'];
                    $distribuid=$getcustomer['distributorid'];
                    $branchid=$getcustomer['branchid'];
                    $id=$getcustomer['id'];
    
                        if($customerid!=""){
                            $this->db->select('customername');    
                            $this->db->from('customer_matserdata');
                            $this->db->where('customer_matserdata.id',$customerid);
                            $query2=$this->db->get();
                            if($query2->num_rows()>0){
                                foreach($query2->result_array() as $customerdata){
                                    $customername=$customerdata['customername'];
                                }
                            }
                            $this->db->select('sum(grandamt) as totalamt,sum(totalpaidamt) as totalpaid');    
                            $this->db->from('bill_master');
                            $this->db->where('customerid',$customerid);
                             $query4 = $this->db->get();
                            if($query4->num_rows()>0){
                                foreach($query4->result_array() as $remainamt){
                                    $gradtotal=$remainamt['totalamt'];
                                    $totalpaid=$remainamt['totalpaid'];
                                    $remian=$gradtotal- $totalpaid;
                                   
                                }
                            }else{
                                $remian=0;       
                            }
                            $this->db->select('sum(amount) as pamentamt');    
                            $this->db->from('payment_master');
                            $this->db->where('name',$customerid);
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
                                $this->db->where('name',$customerid);
                                $this->db->where('type','return');
                              $query2 = $this->db->get();
                                if($query2->num_rows()>0){
                                    foreach($query2->result_array() as $return){
                                        $returnamt=$return['returntamt'];
                                        
                                    
                                    }
                                    
                                }else{
                                    $returnamt=0;       
                                }
                        }
                        if($branchid!=""){
                            $this->db->select('branch_mastre.name as branch');    
                            $this->db->from('branch_mastre');
                            $this->db->where('branch_mastre.id',$branchid);
                            $query2=$this->db->get();
                            if($query2->num_rows()>0){
                                foreach($query2->result_array() as $branchinfo){
                                    $branchname=$branchinfo['branch'];
                                }
                            }else{
                                $branchname="";
                            }
                        }
                        if($distribuid!=""){
                            $this->db->select('distributor_master.distributor_name as distributorname');    
                            $this->db->from('distributor_master');
                            $this->db->where('distributor_master.id',$distribuid);
                            $query2=$this->db->get();
                            if($query2->num_rows()>0){
                                foreach($query2->result_array() as $distributorinfo){
                                    $distribuname=$distributorinfo['distributorname'];
                                }
                            }else{
                                $distribuname="";
                            }
                        }
    
                        $totalamount=0;
                        $totalamount=($remian+$returnamt)-$paymentamt;
                            $result[]=array(
                                'remainamt'=>$totalamount,
                                'branchname'=>$branchname,
                                'customername'=>$customername,
                                'distribuname'=>$distribuname,
                                'distribuid'=>$distribuid,
                                'customerid'=>$customerid,
                                'branchid'=>$branchid,
                                'id'=>$id,
                            );
                           
                }
               
            }
            return $result;
        }
    }
    function filldropdown($table,$where){
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
                    if($table=="distributor_master"){
                        $this->db->select('*');    
                        $this->db->from($table);
                        $this->db->where($where);
                        $this->db->where('status',1);
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