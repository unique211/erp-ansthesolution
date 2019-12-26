<?php  
class Accountstatementmodel extends CI_Model  
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
    function data_get($table_name,$fromdate,$todate,$customername){
        $gradtotal=0;
        $totalpaid=0;
        $remian=0;
        $paymentamt=0;
        $returnamt=0;
        $balance=0;
        $datedata=array();
        $todaygradtotal=0;
        $todaytotalpaid=0;
        $todayremian=0;
        $todaypaymentamt=0;
        $todayreturnamt=0;
        $result=array();
        $customernameinfo="";
        $lastbalnce=0;
      //  $todaybalnce=0;
        $this->db->select('customer_matserdata.customername');    
        $this->db->from('customer_matserdata');
        $this->db->where('id',$customername);
        $query5 = $this->db->get();
        if($query5->num_rows()>0){
            foreach($query5->result_array() as $customerdata){
               
                $customernameinfo=$customerdata['customername'];
               
            }
        }else{
            $customernameinfo="";
        }


                $this->db->select('sum(grandamt) as totalamt,sum(totalpaidamt) as totalpaid');    
                $this->db->from('bill_master');
                $this->db->where('customerid',$customername);
                $this->db->where('bill_date <=',$fromdate);
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
                $this->db->where('name',$customername);
                $this->db->where('e_date <=',$fromdate);
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
                $this->db->where('name',$customername);
                $this->db->where('type','return');
                $this->db->where('e_date <=',$fromdate);
               $query2 = $this->db->get();
                if($query2->num_rows()>0){
                    foreach($query2->result_array() as $return){
                        $returnamt=$return['returntamt'];
                        
                         
                    }
                    
                }else{
                    $returnamt=0;
                         
                }
                
                $balance= $remian+$returnamt-$paymentamt;
               
              
                function getDatesFromRange($start, $end, $format = 'Y-m-d') {
                    $array = array();
                    $interval = new DateInterval('P1D');
                
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);
                
                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                
                    foreach($period as $date) { 
                        $array[] = $date->format($format); 
                    }
                
                    return $array;
                }
                $datedata=getDatesFromRange($fromdate,$todate);
                foreach($datedata as $date){
                    $this->db->select('sum(grandamt) as totalamt,sum(totalpaidamt) as totalpaid');    
                    $this->db->from('bill_master');
                    $this->db->where('customerid',$customername);
                    $this->db->where('bill_date',$date);
                   $query = $this->db->get();
                    if($query->num_rows()>0){
                        foreach($query->result_array() as $remainamt){
                           
                            $todaygradtotal=$remainamt['totalamt'];
                            $todaytotalpaid=$remainamt['totalpaid'];
                            $todayremian=$todaygradtotal- $todaytotalpaid;
                           
                        }
                        
                    }else{
                        $todayremian=0;       
                    }
                    $this->db->select('sum(amount) as pamentamt');    
                    $this->db->from('payment_master');
                    $this->db->where('name',$customername);
                    $this->db->where('e_date',$date);
                    $this->db->where('type','payment');
                   $query1 = $this->db->get();
                    if($query1->num_rows()>0){
                        foreach($query1->result_array() as $pay){
                            $todaypaymentamt=$pay['pamentamt'];
                            
                           
                        }
                        
                    }else{
                        $todaypaymentamt=0;       
                    }
                    $this->db->select('sum(amount) as returntamt');    
                    $this->db->from('payment_master');
                    $this->db->where('name',$customername);
                    $this->db->where('type','return');
                    $this->db->where('e_date',$date);
                   $query2 = $this->db->get();
                    if($query2->num_rows()>0){
                        foreach($query2->result_array() as $return){
                            $todayreturnamt=$return['returntamt'];
                            
                           
                        }
                        
                    }else{
                        $todayreturnamt=0;       
                    }
                 // echo $balance."todayreturnamt".$todayreturnamt."todayremian".$todayremian."todaypaymentamt".$todaypaymentamt;
                    if($fromdate==$date){
                        $todaybalnce=($balance+$todayreturnamt+$todayremian)-$todaypaymentamt; 
                        $lastbalnce= $todaybalnce;
                    }else{
                        $todaybalnce=($lastbalnce+$todayreturnamt+$todayremian)-$todaypaymentamt;
                        $lastbalnce= $todaybalnce;
                    }
              /* if($todayreturnamt >0 || $todayremian > 0 || $todaypaymentamt >0){
                    $todaybalnce=($balance+$todayreturnamt+$todayremian)-$todaypaymentamt;
                    $lastbalnce= $todaybalnce;
                    }else{
                        $todaybalnce=$lastbalnce; 
                    }*/
                   // echo $todaybalnce."<br>";
                    
                    if($fromdate==$date){
                        $result[]=array(
                        'date'=>$date,
                        'customername'=>$customernameinfo,
                        'debit'=>$returnamt,
                        'credit'=>$paymentamt,
                        'balance'=>$balance,
                        );
                    }else{
                        $result[]=array(
                            'date'=>$date,
                            'customername'=>$customernameinfo,
                            'debit'=>$todayreturnamt,
                            'credit'=>$todaypaymentamt,
                            'balance'=>$todaybalnce,
                            ); 
                    }
                        
                }
               return $result;


        
              
       
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
        if($this->session->role == "distributor"){  
            $this->db->select('*');    
                $this->db->from($table);
                $this->db->where($where);
               $this->db->where('branchid',$this->session->branchid);
                $query = $this->db->get();
                return $query->result();
        }else{
                $this->db->select('*');    
                $this->db->from($table);
                $this->db->where($where);
             
                $query = $this->db->get();
                return $query->result();
        }
            
    }
    
}
?>