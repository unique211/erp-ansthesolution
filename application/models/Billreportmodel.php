<?php  
class Billreportmodel extends CI_Model  
{  
   /* function data_get($table){
        $bill_no=0;
        $date='';
        $fullname='';
        $serviceid='';
        $servicename='';
        $coustomerid='';
        $qty=0;
        $amt=0;
        $totalamt=0;
        $distributor_name="";
        $distributorid="";
        $branchid=0;
        $result1=array();
        $result=array();
        if($this->session->role=="admin"){
        $this->db->select('bill_master.*');    
        $this->db->from('bill_master');
        //$this->db->join('customer_matserdata', 'customer_matserdata.id = bill_master.customerid');
       // $this->db->join('distributor_master', 'customer_matserdata.id = bill_master.customerid');
       // $this->db->where('bill_master.status',1);
        $query = $this->db->get();
            if($query->num_rows()>0){
                    foreach($query->result_array() as $billdata){
                         $bill_no=$billdata['id'];
                         $date=$billdata['bill_date'];
                         $coustomerid=$billdata['customerid'];
                        $distributorid=$billdata['distributorid'];
                        $branchid=$billdata['branchid'];
                        
                            if($coustomerid >0){
                                $this->db->select('customer_matserdata.customername,id');    
                                $this->db->from('customer_matserdata');
                               $this->db->where('id',$coustomerid);
                               $query2 = $this->db->get();
                               foreach($query2->result_array() as $coustomerdata){
                                $fullname=$coustomerdata['customername'];;  
                               }
                            }
                            if($distributorid >0){
                                $this->db->select('distributor_master.distributor_name,id');    
                                $this->db->from('distributor_master');
                               $this->db->where('id',$distributorid);
                               $query3 = $this->db->get();
                               foreach($query3->result_array() as $distributordata){
                                $distributor_name=$distributordata['distributor_name'];;  
                               }
                            }
                    
                       
                            $this->db->select('bii_description.*,service_master.s_name as servicename');    
                            $this->db->from('bii_description');
                            $this->db->join('service_master', 'service_master.id = bii_description.serviceid');
                            $this->db->where('billid',$bill_no);
                            $query1 = $this->db->get();
                            foreach($query1->result_array() as $billdescriptiondata){
                                $serviceid=$billdescriptiondata['serviceid'];
                                $servicename=$billdescriptiondata['servicename'];
                                $qty=$billdescriptiondata['qty'];
                                $amt=$billdescriptiondata['amount'];
                                if($qty >0 && $amt >0){
                                    $totalamt=$qty * $amt;
                                }
                                $result[]=array(
                                    'bill_date'=>$date,
                                    'id'=> $bill_no,
                                    'billid'=> $bill_no,
                                    'customerid'=> $coustomerid,
                                    'coustomer'=> $fullname,
                                    'distributorname'=> $distributor_name,
                                    'branchid'=> $branchid,
                                    'serviceid'=> $serviceid,
                                    'servicename'=> $servicename,
                                    'qty'=> $qty,
                                    'amount'=> $amt,
                                    'totalamt'=> $totalamt,
                                );
                                

                            }
                           
                         }
                        
                        
                     return $result;
            }else{
                return '400';
            }
           
        }
        
        
       
    }*/
    function data_get($table){
        $bill_no=0;
        $date='';
        $fullname='';
        $serviceid='';
        $servicename='';
        $coustomerid='';
        $branchname=0;
        $grandamt=0;
        $totalamt=0;
        $distributor="";
        $distributorid="";
        $branchid=0;
        $totalpaidamt=0;
        $ramindamt=0;
        $id="";
       $result=array();
       
        $this->db->select('bill_master.*,branch_mastre.name as branchname,distributor_master.distributor_name as distributor,bill_master.id as billdata');    
        $this->db->from('bill_master');
        $this->db->join('branch_mastre', 'branch_mastre.id = bill_master.branchid');
        $this->db->join('distributor_master', 'distributor_master.id = bill_master.distributorid');
       // $this->db->join('distributor_master', 'customer_matserdata.id = bill_master.customerid');
       // $this->db->where('bill_master.status',1);
       // $this->db->where('bill_master.customerid',$id);
        $query = $this->db->get();
            if($query->num_rows()>0){
                    foreach($query->result_array() as $billdata){
                         $bill_no=$billdata['id'];
                         $date=$billdata['bill_date'];
                         $coustomerid=$billdata['customerid'];
                         $branchid=$billdata['branchid'];
                         $branchname=$billdata['branchname'];
                         $distributorid=$billdata['distributorid'];
                         $distributor=$billdata['distributor'];
                         $grandamt=$billdata['grandamt'];
                         $totalpaidamt=$billdata['totalpaidamt'];
                         $id=$billdata['billdata'];
                            if($coustomerid >0){
                                $this->db->select('customer_matserdata.customername,id');    
                                $this->db->from('customer_matserdata');
                               $this->db->where('id',$coustomerid);
                               $query2 = $this->db->get();
                               foreach($query2->result_array() as $coustomerdata){
                                $fullname=$coustomerdata['customername'];;  
                               }
                            }
                            if($totalpaidamt >0 ){
                                $ramindamt=$grandamt - $totalpaidamt; 
                            }else{
                                $ramindamt=$grandamt; 
                            }
                         
                           /* $this->db->select('sum().*,service_master.s_name as servicename');    
                            $this->db->from('bii_description');
                            $this->db->join('service_master', 'service_master.id = bii_description.serviceid');
                            $this->db->where('billid',$bill_no);
                            $query1 = $this->db->get();
                            foreach($query1->result_array() as $billdescriptiondata){
                                $serviceid=$billdescriptiondata['serviceid'];
                                $servicename=$billdescriptiondata['servicename'];
                                $qty=$billdescriptiondata['qty'];
                                $amt=$billdescriptiondata['amount'];
                                $paidamt=$billdescriptiondata['paidamt'];
                                if($qty >0 && $amt >0){
                                    $totalamt=$qty * $amt;
                                }
                               
                               

                            }*/
                            $result[]=array(
                                'bill_date'=>$date,
                                'id'=> $id,
                                'billid'=> $bill_no,
                                'customerid'=> $coustomerid,
                                'coustomer'=> $fullname,
                                'branchid'=> $branchid,
                                'branchname'=> $branchname,
                                'distributorid'=> $distributorid,
                                'distributor'=> $distributor,
                                'grandamt'=> $grandamt,
                                'totalpaidamt'=> $totalpaidamt,
                                'ramindamt'=> $ramindamt,
                            );
                            
                         }
                        
                        
                     return $result;
            }else{
                return '400';
            }
   
       
    }
    function data_get_data($table,$id){
        $serviceid=0;$servicename="";$qty=0;$amt=0;$totalamt=0;$paidamt=0;$remainamt=0;
        $result=array();
        $iddata="";
        $this->db->select('*,service_master.s_name as servicename');    
        $this->db->from('bii_description');
        $this->db->join('service_master', 'service_master.id = bii_description.serviceid');
        $this->db->where('billid',$id);
        $query1 = $this->db->get();
 
        foreach($query1->result_array() as $billdescriptiondata){
            $serviceid=$billdescriptiondata['serviceid'];
            $servicename=$billdescriptiondata['servicename'];
            $qty=$billdescriptiondata['qty'];
            $amt=$billdescriptiondata['amount'];
            $paidamt=$billdescriptiondata['paidamt'];
            $iddata=$billdescriptiondata['id'];
            if($qty >0 && $amt >0){
                $totalamt=$qty * $amt;
            }
 
            if($paidamt > 0){
             $remainamt=$totalamt - $paidamt; 
            }
            $result[]=array(
             
             'id'=> $iddata,
             'serviceid'=> $serviceid,
             'servicename'=> $servicename,
             'qty'=> $qty,
             'amt'=> $amt,
             'paidamt'=> $paidamt,
             'remainamt'=> $remainamt,
             'totalamt'=> $totalamt,
             
         );
 
        }
        return $result;
     }
    function filldropdown($table,$where){
            if($table=="branch_mastre"){
                $this->db->select('*');    
                $this->db->from($table);
                $this->db->where($where);
               // $this->db->where('branchid',$this->session->branchid);
                $query = $this->db->get();
                return $query->result();
            }
    }
    
}
?>