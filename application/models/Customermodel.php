<?php  
class Customermodel extends CI_Model  
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
     $data= array(
        'status'=>0,
     );
    $this->db->where('id',$id);
    $result = $this->db->update($table,$data);
      return $result;
    
    /*$this->db->where('id',$id);    
        $result = $this->db->delete($table);
        
        return $result;*/
       
    }
    function data_get($table){
        if($this->session->role=="admin"){
        $this->db->select('customer_matserdata.*');    
        $this->db->from($table);
        $this->db->where('customer_matserdata.status',1);
        $query = $this->db->get();
      
        }else if($this->session->role=="distributor"){ 
        $this->db->select('customer_matserdata.*');    
        $this->db->from($table);
        $this->db->where('branchid',$this->session->branchid);
        $this->db->where('customer_matserdata.status',1);
        $query = $this->db->get(); 
        }else if($this->session->role=="employee"){ 
            $this->db->select('customer_matserdata.*');    
            $this->db->from($table);
            $this->db->where('distributorid',$this->session->c_id);
            $this->db->where('branchid',$this->session->branchid);
            $this->db->where('customer_matserdata.status',1);
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
    function get_dashboard_info(){
         $branch=0;
         $distributor=0;
         $customertotal=0;
         $servicetotal=0;
         if($this->session->role=="admin"){
        $this->db->select('count(id) as branchtotal');    
        $this->db->from('branch_mastre');
        $this->db->where('status',1);
         $query = $this->db->get();
         if($query->num_rows()>0){
        $res=  $query->result_array();
         $branch=$res[0]['branchtotal'];
         }
         $this->db->select('count(id) as distributortotal');    
         $this->db->from('distributor_master');
         $this->db->where('status',1);
          $query1 = $this->db->get();
          if($query1->num_rows()>0){
         $res1=$query1->result_array();
          $distributor=$res1[0]['distributortotal'];
          }
          $this->db->select('count(id) as customertotal');    
          $this->db->from('customer_matserdata');
          $this->db->where('status',1);
           $query2 = $this->db->get();
           if($query2->num_rows()>0){
          $res1=$query2->result_array();
           $customertotal=$res1[0]['customertotal'];
           }

           $this->db->select('count(id) as servicetotal');    
           $this->db->from('service_master');
           $this->db->where('status',1);
            $query3 = $this->db->get();
            if($query3->num_rows()>0){
             $res1=$query3->result_array();
            $servicetotal=$res1[0]['servicetotal'];
            }
        }else if($this->session->role=="distributor"){
            
             $this->db->select('count(id) as distributortotal');    
             $this->db->from('distributor_master');
             $this->db->where('branchid',$this->session->branchid);
             $this->db->where('status',1);
              $query1 = $this->db->get();
              if($query1->num_rows()>0){
             $res1=$query1->result_array();
              $distributor=$res1[0]['distributortotal'];
              }
              $this->db->select('count(id) as customertotal');    
              $this->db->from('customer_matserdata');
              $this->db->where('branchid',$this->session->branchid);
              $this->db->where('status',1);
               $query2 = $this->db->get();
               if($query2->num_rows()>0){
              $res1=$query2->result_array();
               $customertotal=$res1[0]['customertotal'];
               }
    
               $this->db->select('count(id) as servicetotal');    
               $this->db->from('service_master');
               $this->db->where('bramchid',$this->session->branchid);
               $this->db->where('status',1);
                $query3 = $this->db->get();
                if($query3->num_rows()>0){
                 $res1=$query3->result_array();
                $servicetotal=$res1[0]['servicetotal'];
                } 
        }
            $result[]=array(
                'totalbranch'=>$branch,
                'distributortotal'=>$distributor,
                'customertotal'=>$customertotal,
                'servicetotal'=>$servicetotal,
            );
            return $result;
            
    }
    function get_today_data(){
        $result=array();
        $totalbill=0;
        $totalbillamt=0;
        $totalpaidamt=0;
        $totalremain=0;
        $branchname="";
        $branchid="";
        $distributorid="";
        $distributorname="";
        if($this->session->role=="admin"){
        $this->db->select('count(id) as totalbill,sum(grandamt) as totalbillamt,sum(totalpaidamt) as totalpaidamt,distributorid,branchid');    
        $this->db->from('bill_master');
        $this->db->where('status',1);
        $this->db->group_by('distributorid');
        $this->db->where('bill_date',date("Y/m/d"));
         $query3 = $this->db->get();
         if($query3->num_rows()>0){

            foreach($query3->result_array() as $res1){
                $totalbill=$res1['totalbill'];
                $totalbillamt=$res1['totalbillamt'];
                $totalpaidamt=$res1['totalpaidamt'];
                $distributorid=$res1['distributorid'];
                $branchid=$res1['branchid'];

               
                if($branchid !=""){
                    $this->db->select('branch_mastre.name as branchname');    
                    $this->db->from('branch_mastre');
                    $this->db->where('id',$branchid);
                    $query4 = $this->db->get();
                    if($query4->num_rows()>0){
                       foreach($query4->result_array() as $branchdata){
                        $branchname=$branchdata['branchname'];
                       }
                        
                    }else{
                        $branchname="";
                    }
                }
                if($branchid !=""){
                    $this->db->select('distributor_master.distributor_name as distributorname');    
                    $this->db->from('distributor_master');
                    $this->db->where('id',$distributorid);
                    $query5 = $this->db->get();
                    if($query5->num_rows()>0){
                       foreach($query5->result_array() as $distributordata){
                        $distributorname=$distributordata['distributorname'];
                       }
                        
                    }else{
                        $distributorname="";
                    }
                }

                if($totalbillamt >0 || $totalpaidamt >0){
                    $totalremain=$totalbillamt- $totalpaidamt;
                }
                $result[]=array(
                    'totalbill'=>$totalbill,
                    'totalbillamt'=>$totalbillamt,
                    'totalpaidamt'=>$totalpaidamt,
                    'remainamt'=>$totalremain,
                    'branchid'=>$branchid,
                    'distributorid'=>$distributorid,
                    'branchname'=>$branchname,
                    'distributorname'=>$distributorname,
                );
   
            } 

         }
        }else{
            $this->db->select('count(id) as totalbill,sum(grandamt) as totalbillamt,sum(totalpaidamt) as totalpaidamt,distributorid,branchid');    
            $this->db->from('bill_master');
            $this->db->where('distributorid',$this->session->c_id);
            $this->db->where('branchid',$this->session->branchid);
           // $this->db->group_by('distributorid');
            $this->db->where('bill_date',date("Y/m/d"));
             $query3 = $this->db->get();
             if($query3->num_rows()>0){
    
                foreach($query3->result_array() as $res1){
                    $totalbill=$res1['totalbill'];
                    $totalbillamt=$res1['totalbillamt'];
                    $totalpaidamt=$res1['totalpaidamt'];
                    $distributorid=$res1['distributorid'];
                    $branchid=$res1['branchid'];
                    if($branchid !=""){
                        $this->db->select('branch_mastre.name as branchname');    
                        $this->db->from('branch_mastre');
                        $this->db->where('id',$branchid);
                        $query4 = $this->db->get();
                        if($query4->num_rows()>0){
                           foreach($query4->result_array() as $branchdata){
                            $branchname=$branchdata['branchname'];
                           }
                            
                        }else{
                            $branchname="";
                        }
                    }
                    if($branchid !=""){
                        $this->db->select('distributor_master.distributor_name as distributorname');    
                        $this->db->from('distributor_master');
                        $this->db->where('id',$distributorid);
                        $query5 = $this->db->get();
                        if($query5->num_rows()>0){
                           foreach($query5->result_array() as $distributordata){
                            $distributorname=$distributordata['distributorname'];
                           }
                            
                        }else{
                            $distributorname="";
                        }
                    }
    
                    if($totalbillamt >0 || $totalpaidamt >0){
                        $totalremain=$totalbillamt- $totalpaidamt;
                    }
                    $result[]=array(
                        'totalbill'=>$totalbill,
                        'totalbillamt'=>$totalbillamt,
                        'totalpaidamt'=>$totalpaidamt,
                        'remainamt'=>$totalremain,
                        'branchid'=>$branchid,
                        'distributorid'=>$distributorid,
                        'branchname'=>$branchname,
                        'distributorname'=>$distributorname,
                    );
       
                } 
    
             }
        }
        return $result;

    }
    function get_payment(){
        if($this->session->role=="admin"){
            $this->db->select('sum(grandamt) as grandtotal,sum(totalpaidamt) as paidamt');    
            $this->db->from('bill_master');
            $this->db->where('status',1);
            $query3 = $this->db->get();
             return $query3->result();

        }else{
            $this->db->select('sum(grandamt) as grandtotal,sum(totalpaidamt) as paidamt');    
            $this->db->from('bill_master');
            $this->db->where('status',1);
            $this->db->where('distributorid',$this->session->c_id);
            $this->db->where('branchid',$this->session->branchid);
            $query3 = $this->db->get();
             return $query3->result();
        }
    }
}
?>