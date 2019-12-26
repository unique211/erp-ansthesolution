<?php  
class Main_model extends CI_Model  
{  	
    function getBillno()
    {
        //$this->load->database();
        $this->db->select_max('item_code');
        $this->db->from('item_master');
        $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->row();
		//$last_row = $this->db->order_by('item_code',"desc")->limit(1)->get('item_master')->row();
        //return $last_row;
        return $query;
	}
	   
    function insertdata($table,$data)
	{         
        $result = $this->db->insert($table,$data);
        return $result;
    } 
    function insertrecord($table,$data)
	{         
        $this->db->insert($table,$data);
        $result = $this->db->insert_id();
        return $result;
   	} 
   	function updatedata($table,$data,$id)
    {
        $this->db->where('id',$id);
		$result = $this->db->update($table,$data);
      	return $result;
    } 
    function showalldata($table)
    { 
        if($this->session->role == "superadmin"){
                $this->db->select('*');    
                $this->db->from($table);
                $query = $this->db->get();
                // $query = $this->db->get();
                return $query->result();
        }
        elseif($table=="payment_master"){
            $this->db->select('payment_master.*,supplier_master.name as supplernm,payment_option.name as paynm');    
            $this->db->from('payment_master');
            $this->db->join('supplier_master', 'supplier_master.id = payment_master.name');
            $this->db->join('payment_option', 'payment_option.id = payment_master.payment');
            $this->db->where('payment_master.c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
        }
        elseif($table=="refund_master"){
            $this->db->select('refund_master.*,customer_master.name as customernm,payment_option.name as paynm');    
            $this->db->from('refund_master');
            $this->db->join('customer_master', 'customer_master.id = refund_master.name');
            $this->db->join('payment_option', 'payment_option.id = refund_master.payment');
            $this->db->where('refund_master.c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
        }
        elseif($table=="bank_details"){
            $this->db->select('bank_details.*,payment_option.name as paynm');    
            $this->db->from('bank_details');
            $this->db->join('payment_option', 'payment_option.id = bank_details.payment');
            $this->db->where('bank_details.c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
        }
        elseif($table=="item_master"){
            $id=''; $item_code=''; $item_name='';
            $item_type='';$item_group='';$hsn='';$unit='';$location='';$company='';$supplier='';$expiry_date='';$min_qty='';
            $max_qty='';$size='';$packing='';$purchase_rate='';$mrp='';$net_rate='';$gst='';$sales_rate='';
            $opening_stock='';$c_id='';$userid=''; $stock=0;
            $qty=0;$valQty=0;
            $operation=0;
            $valpur=0;
            $valsal=0;
            $valsalret=0;
            $valpurret=0;
            $this->db->select('*');
            $this->db->from('item_master');
            $this->db->where('c_id',$this->session->c_id);
            $query=$this->db->get()->result();
           // echo json_encode($query);
            foreach($query as $row){
                $id = $row->id;
                $barcode=$row->barcode;
                $item_code=$row->item_code;
                $item_name=$row->item_name;
                $item_type=$row->item_type;
                $item_group=$row->item_group;
                $hsn=$row->hsn;
                $unit=$row->unit;
                $location=$row->location;
                $company=$row->company;
                $supplier=$row->supplier;
                $expiry_date=$row->expiry_date;
                $min_qty=$row->min_qty;
                $max_qty=$row->max_qty;
                $size=$row->size;
                $packing=$row->packing;
                $purchase_rate=$row->purchase_rate;
                $mrp=$row->mrp;
                $net_rate=$row->net_rate;
                $gst=$row->gst;
                $sales_rate=$row->sales_rate;
                $opening_stock = $row->opening_stock;
                $c_id=$row->c_id;
                $userid=$row->userid;
                $this->db->select('*');
                $this->db->from('stock_master');
                $this->db->where('itemid',$id);
                $result = $this->db->get()->result();
                $res=$result;
                foreach($res as $row){
                    $operation=$row->opration;
                    $qty=$row->qty;
                    if($operation == "sales"){
                        $valsal=$valsal+$qty;
                    }
                    elseif($operation == "sales_return"){
                        $valsalret=$valsalret+$qty;
                    }
                    elseif($operation == "purchase"){
                        $valpur=$valpur+$qty;
                    }
                    elseif($operation == "purchase_return"){
                        $valpurret=$valpurret+$qty;
                    }
                }
                $valQty=$valpur-$valsal-$valpurret;
                $valQty=$valQty+$valsalret;
                $opening_stock=$opening_stock+$valQty;
                //echo $opening_stock;
               // $stc=$this->CountStock($id);
                //echo  "  here is the stock : ".$opening_stock;
                $data = array(
                    'id' => $id ,
                    'barcode'=>$barcode,
                    'item_code' => $item_code ,
                    'item_name' => $item_name,
                    'item_type' => $item_type ,
                    'item_group' => $item_group ,
                    'hsn' => $hsn ,
                    'unit' => $unit ,
                    'location' => $location ,
                    'company' => $company ,
                    'supplier' => $supplier ,
                    'expiry_date' => $expiry_date ,
                    'min_qty' => $min_qty ,
                    'max_qty' => $max_qty ,
                    'size' => $size ,
                    'packing' => $packing ,
                    'purchase_rate' => $purchase_rate ,
                    'mrp' => $mrp ,
                    'net_rate' => $net_rate ,
                    'gst' => $gst ,
                    'sales_rate' => $sales_rate ,
                    'opening_stock' => $opening_stock ,
                    'c_id' => $c_id ,
                    'userid' => $userid ,
                // 'total' => $total ,
                    
                );
            $data1[]=$data;
            }
           return $data1;
        }
      /*  elseif($table=="company"){
            $this->db->select('*');    
            $this->db->from($table);
            //$this->db->where('c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
        }*/
        else{
            $this->db->select('*');    
            $this->db->from($table);
            $this->db->where('c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
        }
       
       
    }
    function delete_data($table,$id)
    {
        $this->db->where('id',$id);    
        $result = $this->db->delete($table);
        if($table == 'company'){
            $this->db->where('c_id',$id);
            $this->db->delete('login_master');
        }
        return $result;
       
    }
    function data_delete1($table,$colum,$id){
           if($table=="purchasedetails" || $table=="salesbilldetails" || $table=="purchasereturndetails" || $table=="salesreturndetails"){
                $this->db->where($colum,$id);
            }else if($table=="stock_master"){
                $this->db->where('oprationid',$id);
                $this->db->where('opration',$colum);
            }
       
        $result = $this->db->delete($table);
        return $result;
       
        }
    function data_get($table){
             
        $this->db->select('*');    
        $this->db->from($table);
        $this->db->where('c_id',$this->session->c_id);
        $query = $this->db->get();
        return $query->result();
    }
    function getinvoice($table){
        //$where = $this->session->c_id;
        $this->db->select_max('id AS id');
        $result = $this->db->get($table)->row();  
        if($result->id > 0 ){
            return 0;
        }
        echo $result->id;
    }
    function getalldropdown($table){
        $where=$this->input->post('where');
        if($where!=""){
            $this->db->select('*');    
            $this->db->from($table);
            $this->db->where($where);
            $this->db->where('c_id',$this->session->c_id);
            $query = $this->db->get();
        }
        elseif($table == "company"){
            $this->db->select('*');    
            $this->db->from($table);
            $this->db->where('id',$this->session->c_id);
            $query = $this->db->get();
        }
        else{
            $this->db->select('*');    
            $this->db->from($table);
            $this->db->where('c_id',$this->session->c_id);
            $query = $this->db->get();
        }
        return $query->result();
    }
    function getitem($table){
        $where=$this->input->post('where');
        if($where!=""){
            $this->db->select('*');    
            $this->db->from($table);
            $this->db->where($where);
            $this->db->where('c_id',$this->session->c_id);
            $query = $this->db->get();
        }
        return $query->result();
    }
    function getinvoicedate($table,$where){
        
        $this->db->select('invoice_date');    
        $this->db->from('salesbill_master');
        $this->db->where('invoice_no',$where);
        $query = $this->db->get();
        return $query->result();
    }
    //-----------*Login*-------------------//
    function can_login($username,$password,$code)
	{ 
        $date='';
        $this->db->select('login_master.*');
        $this->db->where('login_master.username',$username);
        $this->db->where('login_master.password',$password);
       $this->db->where('login_master.code',$code);
     //  $this->db->where('login_master.status','1');
        $this->db->from('login_master');
       // $this->db->join('company','company.username=login_master.username','company.password=login_master.password');company.end_date as edate,company.start_date as sdate,
        $query = $this->db->get();
        //print_r($this->db->last_query());    
        $flag=0;
        $startdate='';$enddate='';
        $date=date('Y-m-d');
        //echo "date is : ".$date;
		if($query->num_rows() > 0)
		{
            $get_username = $query->row()->username;
			$get_password = $query->row()->password;
			$id = $query->row()->id;
			$role = $query->row()->role;
            $c_id = $query->row()->c_id;
            $status = $query->row()->status;
            $code = $query->row()->code;
            $username = $query->row()->username;
            $branch='';
          //  $enddate =$query->row()->edate;
         //   $startdate=$query->row()->sdate;
            //echo $enddate,$date;
            //$date=$enddate-$date;
            if($role !="admin"){
            $this->db->select('distributor_master.*');    
            $this->db->from('distributor_master');
            $this->db->where('id',$c_id);
            $query1 = $this->db->get(); 
            $resultdata=$query1->result_array();
            $branch=$resultdata[0]['branchid'];
            }

            if($status == 1){
                $this->session->userid = $id;
                $this->session->role = $role;
                $this->session->c_id = $c_id;
                $this->session->code = $code;
                $this->session->username = $username;
                $this->session->branchid = $branch;
                $flag=1;
                /*if($role == "admin"){
                    $this->db->select('end_date,start_date');
                    $this->db->from('company');
                    $this->db->where('id',$c_id);
                    $res=$this->db->get();
                    $enddate=$res->row()->end_date;
                    $startdate=$res->row()->start_date;
                    if($enddate <= $date){
                        $flag = 202;
                    }
                    else{
                        if(($username==$get_username)&&($password==$get_password)){
                            $flag=1;
                            $this->session->userid = $id;
                            $this->session->role = $role;
                            $this->session->c_id = $c_id;
                            $this->session->s_date=$startdate;
                            $this->session->e_date=$enddate;
                        }
                    }
                }
                else{
                    if(($username==$get_username)&&($password==$get_password)){
                        $flag=1;
                        $this->session->userid = $id;
                        $this->session->role = $role;
                    }
                }*/
                return $flag;
            }else if($status==0){
                $flag=505;
                return $flag;
            }
            else{
                $flag=404;
                return $flag;
            }
		}
		else{
			return $flag;
		}
		//return $query;
    }
    //------------------*Login End*-----------------------//
    
    function getallpurchase($table,$where){
        
        if($table=="paychasebill_master"){
            $this->db->select('paychasebill_master.*,supplier_master.name as supplernm');    
            //$this->db->where('c_id',$this->session->c_id);
            $this->db->from('paychasebill_master');
            $this->db->join('supplier_master', 'supplier_master.id = paychasebill_master.supplierid');
            $this->db->where('paychasebill_master.c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
        }
        else if($table=="purchasedetails"){
            $id=0;$purid=0;$groupid=0;$itemid=0;$mrp=0;$qty=0;
            $retqty=0;$discount=0;$gst=0;$total=0;$brand_masternm=0;$item_name=0;
            $finalqty=0; $data='';$data1[]='';
            $this->db->select('purchasedetails.*,brand_master.name as brand_masternm,item_master.item_name');    
            $this->db->from('purchasedetails');
            $this->db->join('brand_master', 'brand_master.id = purchasedetails.groupid');
            $this->db->join('item_master', 'item_master.id = purchasedetails.itemid');
            $this->db->where('purid',$where);
            $query = $this->db->get()->result();
            //echo json_encode($query);   
          
            foreach($query as $row){    
                $id=$row->id;
                $purid=$row->purid;
                $groupid=$row->groupid;
                $itemid=$row->itemid;
                $mrp=$row->mrp;
                $qty=$row->qty;
                $discount=$row->discount;
                $gst=$row->gst;
                $total=$row->total;
                $brand_masternm=$row->brand_masternm;
                $item_name=$row->item_name;
                $finalqty=$this->getdetail($where,$groupid,$itemid,$qty);
                $data = array(
                    'id' => $id ,
                    'purid' => $purid ,
                    'groupid' => $groupid ,
                    'itemid' => $itemid ,
                    'qty' => $finalqty ,
                    'mrp' => $mrp ,
                    'discount' => $discount ,
                    'gst' => $gst ,
                    'total' => $total ,
                    'brand_masternm' => $brand_masternm ,
                    'item_name' => $item_name,
                );
               $data1[]=$data;
            }
            return $data1;
        }
    }
    function getallsales($table,$where){
        //$query=0;
        if($table=="salesbill_master"){
            $this->db->select('salesbill_master.*,customer_master.name as name1,customer_master.address as address1,customer_master.mobile as mobilenm');    
            $this->db->from('salesbill_master');
            $this->db->join('customer_master', 'customer_master.id = salesbill_master.name');
            $this->db->where('salesbill_master.c_id',$this->session->c_id);
            $query = $this->db->get();
            return $query->result();
            
        }else if($table=="salesbilldetails"){
            $id=0;$salesid=0;$groupid=0;$itemid=0;$mrp=0;$qty=0;
            $retqty=0;$discount=0;$sgst=0;$cgst=0;$total=0;$brand_masternm=0;$item_name=0;
            $finalqty=0; $data='';$data1[]='';
            $this->db->select('salesbilldetails.*,brand_master.name as brand_masternm,item_master.item_name');    
            $this->db->from('salesbilldetails');
            $this->db->join('brand_master', 'brand_master.id = salesbilldetails.groupid');
            $this->db->join('item_master', 'item_master.id = salesbilldetails.itemid');
            $this->db->where('salesid',$where);
            $query = $this->db->get()->result();
            //echo json_encode($query);
            foreach($query as $row){    
                $id=$row->id;
                $salesid=$row->salesid;
                $groupid=$row->groupid;
                $itemid=$row->itemid;
                $mrp=$row->mrp;
                $qty=$row->qty;
                $discount=$row->dis;
                $cgst=$row->cgst;
                $sgst=$row->sgst;
                $total=$row->total;
                $brand_masternm=$row->brand_masternm;
                $item_name=$row->item_name;
                //$finalqty=$finalqty;//$this->getdetail($where,$groupid,$itemid,$qty);
                $this->db->select('qty as returnqty');
                $this->db->from('salesreturndetails');
                $this->db->where('returnid',$where);
                $this->db->where('groupid',$groupid);
                $this->db->where('itemid',$itemid);
                $result=$this->db->get()->result();
                //print_r($result);
                if(count($result)>0){
                    //echo "Row is:". count($result);
                    foreach($result as $row){
                        $retqty=$row->returnqty;
                        $finalqty=$qty - $retqty ;
                       // echo $finalqty;
                    }
                }
                else{
                    //echo "column is:". count($result);
                    $retqty=0;
                    $finalqty=$qty - $retqty ;
                    //echo $finalqty;
                }
                $data = array(
                    'id' => $id ,
                    'salesid' => $salesid ,
                    'groupid' => $groupid ,
                    'itemid' => $itemid ,
                    'qty' => $finalqty ,
                    'mrp' => $mrp ,
                    'discount' => $discount ,
                    'cgst' => $cgst ,
                    'sgst' => $sgst ,
                    'total' => $total ,
                    'brand_masternm' => $brand_masternm ,
                    'item_name' => $item_name,
                    'returnqty'=>$retqty
                );
               $data1[]=$data;
            }
           return $data1;
          
        }
        
    }
    function getdetail($where,$groupid,$itemid,$qty){
        $this->db->select('qty as returnqty');
        $this->db->from('purchasereturndetails');
        $this->db->where('returnid',$where);
        $this->db->where('groupid',$groupid);
        $this->db->where('itemid',$itemid);
        $result=$this->db->get()->result();
        //print_r($result);
        if(count($result)>0){
            //echo "Row is:". count($result);
            foreach($result as $row){
                $retqty=$row->returnqty;
                $finalqty=$qty - $retqty ;
                return $finalqty;
            }
        }
        else{
            //echo "column is:". count($result);
            $retqty=0;
            $finalqty=$qty - $retqty ;
            return $finalqty;
        }
    }
    function getallreturn($table,$where){
        if($table=="purchasereturn_master"){
        $this->db->select('purchasereturn_master.*,supplier_master.name as supplernm');    
        $this->db->from('purchasereturn_master');
        $this->db->join('supplier_master', 'supplier_master.id = purchasereturn_master.supplier');
        $this->db->where('purchasereturn_master.c_id',$this->session->c_id);
        $query = $this->db->get();
        }else if($table=="purchasereturndetails"){
            $this->db->select('purchasereturndetails.*,brand_master.name as brand_masternm,item_master.item_name');    
            $this->db->from('purchasereturndetails');
            $this->db->join('brand_master', 'brand_master.id = purchasereturndetails.groupid');
            $this->db->join('item_master', 'item_master.id = purchasereturndetails.itemid');
            $this->db->where($where);
            $query = $this->db->get();
            }
        return $query->result();
    }
       
   
    function getallsalesreturn($table,$where){
        //$query=0;
        if($table=="salesreturn_master"){
            $this->db->select('salesreturn_master.*,customer_master.name as name1,customer_master.address as address1,customer_master.mobile as mobilenm');    
            $this->db->from('salesreturn_master');
            $this->db->join('customer_master', 'customer_master.id = salesreturn_master.name');
            $this->db->where('salesreturn_master.c_id',$this->session->c_id);
            $query = $this->db->get();
            
        }else if($table=="salesreturndetails"){
            $this->db->select('salesreturndetails.*,brand_master.name as brand_masternm,item_master.item_name');    
            $this->db->from('salesreturndetails');
            $this->db->join('brand_master', 'brand_master.id = salesreturndetails.groupid');
            $this->db->join('item_master', 'item_master.id = salesreturndetails.itemid');
            $this->db->where($where);
            $query = $this->db->get();
           // return $query->result();
        }
        return $query->result();
    }
    function gettotal($table,$where){
        //print_r($where);
       // $data=0;
       $balance=0;
       $total=0;
       $paid=0;
    if($table=="paychasebill_master"){
        $this->db->select_sum('totalamount');
        $this->db->select_sum('paid');
        $this->db->from('paychasebill_master');
        $this->db->where('supplierid',$where);
        $query = $this->db->get()->result();
        $data=$query;
        foreach($data as $row){
            $total=$row->totalamount;
            $paid=$row->paid;
        }
        $balance=$total-$paid;
        //echo $data;
        $this->db->select('*');
        $this->db->where('name',$where);
        $result = $this->db->get('payment_master')->result();
        $data1= $result;
        $paymentsum=0;
        $returnsum=0;
        foreach($data1 as $row){
            $type = $row->type;
            $amount=$row->amount;
            if($type=="return"){
                $returnsum=$returnsum+$amount;
            }
            elseif($type=="payment"){
                $paymentsum=$paymentsum+$amount;
            }
        }
        $balance=$balance-$paymentsum;
        $balance=$balance+$returnsum;
        return $balance;
    }elseif($table="salesbill_master"){
        $this->db->select_sum('total');
        $this->db->select_sum('paid');
        $this->db->from('salesbill_master');
        $this->db->where('name',$where);
        $query = $this->db->get()->result();
        $data=$query;
        foreach($data as $row){
            $total=$row->total;
            $paid=$row->paid;
        }
        $balance=$total-$paid;
        //echo $data;
        $this->db->select('*');
        $this->db->where('name',$where);
        $result = $this->db->get('refund_master')->result();
        $data1= $result;
        $paymentsum=0;
        $returnsum=0;
        foreach($data1 as $row){
            $type = $row->type;
            $amount=$row->amount;
            if($type=="return"){
                $returnsum=$returnsum+$amount;
            }
            elseif($type=="payment"){
                $paymentsum=$paymentsum+$amount;
            }
        }
        $balance=$balance-$paymentsum;
        $balance=$balance+$returnsum;
        return $balance;
    }
        
       
       
    }
    function getStock($where){
        $stock=0;
        $valQty=0;
        $operation=0;
        $valpur=0;
        $valsal=0;
        $valsalret=0;
        $valpurret=0;
        $this->db->select('opening_stock');
        $this->db->from('item_master');
        $this->db->where('id',$where);
        $query = $this->db->get()->result();
        $data=$query;
        foreach($data as $row){
            $stock=$row->opening_stock;
        }
        $this->db->select('*');
        $this->db->from('stock_master');
        $this->db->where('itemid',$where);
        $result = $this->db->get()->result();
        $data1=$result;
        foreach($data1 as $row){
            $operation=$row->opration;
            $qty=$row->qty;
            if($operation == "sales"){
                $valsal=$valsal+$qty;
            }
            elseif($operation == "sales_return"){
                $valsalret=$valsalret+$qty;
            }
            elseif($operation == "purchase"){
                $valpur=$valpur+$qty;
            }
            elseif($operation == "purchase_return"){
                $valpurret=$valpurret+$qty;
            }
        }
        $valQty=$valpur-$valsal-$valpurret;
        $valQty=$valQty+$valsalret;
        $stock=$stock+$valQty;
        return $stock;
    }
    function CountStock($id){
        $stock=0;
        $qty=0;$valQty=0;
        $operation=0;
        $valpur=0;
        $valsal=0;
        $valsalret=0;
        $valpurret=0;
        $this->db->select('opening_stock');
        $this->db->from('item_master');
        $this->db->where('id',$id);
        $query = $this->db->get()->result();
        $data=$query;
        foreach($data as $row){
            $stock=$row->opening_stock;
            //echo "stock Is:".$stock;
        }
        $this->db->select('qty,opration');
        $this->db->from('stock_master');
        $this->db->where('itemid',$id);
       // $result = $this->db->get()->row();
        $result = $this->db->get()->result();
        $data1=$result;
        foreach($data1 as $row){
            $operation=$row->opration;
            $qty=$row->qty;
           // echo $qty;
            if($operation == "sales"){
                $valsal=$valsal+$qty;
            }
            elseif($operation == "sales_return"){
                $valsalret=$valsalret+$qty;
            }
            elseif($operation == "purchase"){
                $valpur=$valpur+$qty;
            }
            elseif($operation == "purchase_return"){
                $valpurret=$valpurret+$qty;
            }
        }
        $valQty=$valpur-$valsal-$valpurret;
        $valQty=$valQty+$valsalret;
        $stock=$stock+$valQty;
        //$data1=$result->qty;
       // echo " Qty is:".$data1;
        //$finalval=$stock-$data1;
        echo "Stock is: ".$stock;
    }
    function getcompany_detail(){
        
        $this->db->select('company.*');    
        $this->db->from('company');
       
        $query = $this->db->get();
        return $query->result();
    }
    function getmaster_detail($where){
        
        $this->db->select('salesbill_master.*,customer_master.name as name1,customer_master.address as address1,customer_master.mobile as mobilenm,customer_master.gstin as gstin');    
        $this->db->from('salesbill_master');
        $this->db->join('customer_master', 'customer_master.id = salesbill_master.name');
        $this->db->where('salesbill_master.id',$where);
        $query = $this->db->get();
        return $query->result();
    }
  
    function getsales_data($where){
        
       
        $this->db->select('salesbilldetails.*,brand_master.name as brand_masternm,item_master.item_name');    
        $this->db->from('salesbilldetails');
        $this->db->join('brand_master', 'brand_master.id = salesbilldetails.groupid');
        $this->db->join('item_master', 'item_master.id = salesbilldetails.itemid');
        $this->db->where('salesid',$where);
        $query = $this->db->get();
        return $query->result();
        
    }
  
}
 
?>
