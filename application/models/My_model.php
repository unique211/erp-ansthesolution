<?php  
class My_model extends CI_Model  
{
    function getData($table){
        $this->db->select('COUNT(id) as id');
        $this->db->from($table);
        $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->row()->id;
        return $query;
    }
    function getsalesbyDate($table){
        $fdate=$this->input->post('fdate');
        $tdate=$this->input->post('tdate');
        $this->db->select('salesbill_master.*,customer_master.name customer');
        $this->db->from($table);
        $this->db->join('customer_master','customer_master.id=salesbill_master.name');
        $this->db->where('invoice_date >=',$fdate);
        $this->db->where('invoice_date <=',$tdate);
        $query=$this->db->get()->result();
        return $query;
    }
    function getpurchasebyDate($table){
        $fdate=$this->input->post('fdate');
        $tdate=$this->input->post('tdate');
        $this->db->select('paychasebill_master.*,supplier_master.name customer');
        $this->db->from($table);
        $this->db->join('supplier_master','supplier_master.id=paychasebill_master.supplierid');
        $this->db->where('billdate >=',$fdate);
        $this->db->where('billdate <=',$tdate);
        $query=$this->db->get()->result();
        return $query;
    }
    function getsalesReport($table){
        $date=date('Y-m-d');
        $this->db->select('salesbill_master.*,customer_master.name as customer');
        $this->db->from($table);
        $this->db->join('customer_master','customer_master.id=salesbill_master.name');
        $this->db->where('invoice_date',$date);
        //$this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->result();
        return $query;
    }
    function getsalesReportItem($table){
        $date=date('Y-m-d');
        $mrp='';
        $qty='';
        $itemname='';
        $barnd='';
        $id='';
        $invoice_no='';
        $customer='';
        $invoice_date='';$data[]='';
        $this->db->select('salesbill_master.*,customer_master.name as customer');
        $this->db->from($table);
        $this->db->join('customer_master','customer_master.id=salesbill_master.name');
        $this->db->where('invoice_date',$date);
        $query=$this->db->get()->result();
        foreach($query as $row){
            $id=$row->id;
            $invoice_no=$row->invoice_no;
            $customer=$row->customer;
            $invoice_date=$row->invoice_date;
            $this->db->select('salesbilldetails.*,item_master.item_name,brand_master.name as brand');
            $this->db->from('salesbilldetails');
            $this->db->join('item_master','item_master.id=salesbilldetails.itemid');
            $this->db->join('brand_master','brand_master.id=salesbilldetails.groupid');
            $this->db->where('salesbilldetails.salesid',$id);
            $result = $this->db->get()->result();
            foreach($result as $row){
                $mrp=$row->mrp;
                $qty=$row->qty;
                $itemname=$row->item_name;
                $barnd=$row->brand;
            }
            $data[]=array(
                'invoice_no'=>$invoice_no,
                'invoice_date'=>$invoice_date,
                'item_name'=>$itemname,
                'brand'=>$barnd,
                'customer'=>$customer,
                'mrp'=>$mrp,
                'qty'=>$qty
            );
        }
        //echo  "Data  ".json_encode($data);
        return $data;
    }
    function getpurchaseReport($table){
        $date=date('Y-m-d');
        $this->db->select('paychasebill_master.*,supplier_master.name as supplier');
        $this->db->from($table);
        $this->db->join('supplier_master','supplier_master.id=paychasebill_master.supplierid');
        $this->db->where('billdate',$date);
       // $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->result();
        return $query;
    }
    function can_login($table, $password)
	{  $flag=0;$pwd='';
        if($password != ''){
            $this->db->select('login_master.password as password');
            $this->db->from($table);
            $this->db->join('login_master','login_master.c_id=company.id');
            $this->db->where('company.password',$password);
            $query = $this->db->get()->result();
            foreach($query as $row){
                $pwd=$row->password;
            }
            if($password == $pwd){
                $flag=1;
            }
            else{
            }
           return $flag;
        }
        else{
            $flag=202;
            return $flag;
        }
    }
    function change($table,$password){
        $data = array(
            'password'=>$password,
        );
        $this->db->where('id',$this->session->c_id);
        $result = $this->db->update($table,$data);
        $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->update('login_master',$data);
        //return $result;
        // if($result=affected_rows > 0 && $query=_affected_rows() > 0){
            return true;
        // }
        // else{
        //     return false;
        // }
        
    }
    function getCompany($table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id',$this->session->c_id);
        $result=$this->db->get()->result();
        return $result;
    }
    function updatedata($table,$data,$id)
    {
        $this->db->where('id',$id);
		$result = $this->db->update($table,$data);
      	return $result;
    } 
    function getTotal($table){
        $date=date('Y-m-d');
        $this->db->select_sum('total');
        $this->db->from($table);
        $this->db->where('invoice_date',$date);
        $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->row()->total;
        return $query;
    }
    function getPTotal($table){
        $date=date('Y-m-d');
        $this->db->select_sum('totalamount');
        $this->db->from($table);
        $this->db->where('billdate',$date);
        $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->row()->totalamount;
        return $query;
    }
    function getchart(){
        $month_name = array(
            'Jan-1',
            'Feb-2',
            'Mar-3',
            'Apr-4',
            'May-5',
            'Jun-6',
            'Jul-7',
            'Aug-8',
            'Sep-9',
            'Oct-10',
            'Nov-11',
            'Dec-12'
        ); 
       foreach($month_name as $row){
        $month=explode('-',$row);
        $var=$month[1];
        $name=$month[0];
        //echo $var." ".$name." ";
        $res=0;$tot=0;
        $this->db->select_sum('total');
        $this->db->from('salesbill_master');
        $this->db->where('Month(invoice_date)',$var);
        $this->db->where('c_id',$this->session->c_id);
        $query=$this->db->get()->row()->total;
       // $qry=$query->row()->invoice_date;
        $this->db->select_sum('totalamount');
        $this->db->from('paychasebill_master');
        $this->db->where('Month(billdate)',$var);
        $this->db->where('c_id',$this->session->c_id);
        $result=$this->db->get()->row()->totalamount;
        $total = $query;
        $totalamt=$result;
        $exp= implode('-',$month); 
        //echo $exp;
        //echo $total." ";
        //echo $totalamt." ";
        //echo " Total: ".$tot;
        $data[]=array(
            'sales'=>$total,
            'purchase'=>$totalamt,
            'month'=>$name
        );
        $data1=$data;
        }
       return $data1;
    }
    function getstock($table){
        $stock=0;$totalqty=0;$totalpur=0;
        $qty=0;$valQty=0;
        $operation=0;
        $valpur=0;
        $valsal=0;
        $valsalret=0;
        $valpurret=0;
        $this->db->select('item_master.*,brand_master.name');
        $this->db->from($table);
        $this->db->join('brand_master','brand_master.id=item_master.company');
        $result= $this->db->get()->result();
        foreach($result as $row){
            $id=$row->id;
            $brandname=$row->name;
            $itemname=$row->item_name;
            $purchase_rate=$row->purchase_rate;
            $sales_rate=$row->sales_rate;
            $opening_stock=$row->opening_stock;
           // echo $brandname." ".$itemname." ";$this->db->select('*');
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
                $totalpur=$valpur+$opening_stock;
               // echo $totalpur." ";
                $totret=$totalpur-$valpurret;
                //echo $totret." ";
                $totalqty=$totret+$valsalret;
                //echo $totalqty." ";
                $data[]=array(
                    'id'=>$id,
                    'brandname'=>$brandname,
                    'itemname'=>$itemname,
                    'purchase_rate'=>$purchase_rate,
                    'sales_rate'=>$purchase_rate,
                    'inqty'=>$totalqty,
                    'outqty'=>$valsal
                );
               
        }
        return $data;
    }
    function getstockbyDate($table){
        $item=$this->input->post('item');//"2";
        $fdate=$this->input->post('fdate');//'2019-03-06';;
       // $tdate=$this->input->post('tdate');
        $stock=0;$totalqty=0;$totalpur=0;
        $qty=0;$valQty=0;$query =0;
        $operation=0;$data[]='';$data1='';
        $valpur=0;
        $valsal=0;
        $valsalret=0;
        $valpurret=0;$result= 0;
        //echo $item;
        if($item=="all"){
            $this->db->select('item_master.*,brand_master.name');
            $this->db->from($table);
            $this->db->join('brand_master','brand_master.id=item_master.company');
            $result= $this->db->get()->result();
        }
        elseif($item == null || $item == ""){
            $this->db->select('item_master.*,brand_master.name');
            $this->db->from($table);
            $this->db->join('brand_master','brand_master.id=item_master.company');
            $result= $this->db->get()->result();
        }
        else{
            $this->db->select('item_master.*,brand_master.name');
            $this->db->from($table);
            $this->db->join('brand_master','brand_master.id=item_master.company');
            $this->db->where('item_master.id',$item);
            $result= $this->db->get()->result();
        }
        
        
        foreach($result as $row){
            $id=$row->id;
            $brandname=$row->name;
            $itemname=$row->item_name;
            $purchase_rate=$row->purchase_rate;
            $sales_rate=$row->sales_rate;
            $opening_stock=$row->opening_stock;
           // echo $brandname." ".$itemname." ";$this->db->select('*');
            if($item == "all"){
                //echo $item." if ";
                $this->db->from('stock_master');
                $this->db->where('itemid',$id);
                $this->db->where('stockdate <=',$fdate);
                $query = $this->db->get()->result();
            }else{
                //echo $item." else ";
                $this->db->from('stock_master');
                $this->db->where('itemid',$id);
                $this->db->where('stockdate <=',$fdate);
                $query = $this->db->get()->result();
            }
             //echo $this->db->last_query();
        // }
             $res=$query;
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
            $totalpur=$valpur+$opening_stock;
               // echo $totalpur." ";
            $totret=$totalpur-$valpurret;
                //echo $totret." ";
            $totalqty=$totret+$valsalret;
                //echo $totalqty." ";
            $data[]=array(
                    'id'=>$id,
                    'brandname'=>$brandname,
                    'itemname'=>$itemname,
                    'purchase_rate'=>$purchase_rate,
                    'sales_rate'=>$purchase_rate,
                    'inqty'=>$totalqty,
                    'outqty'=>$valsal
                );
                //$data1[]=$data;
        }
        return $data;
    }
    


    function getstockbySupplier($table){
        $supplier=$this->input->post('supplier');//"2";
        $fdate=$this->input->post('fdate');//'2019-03-06';;
       // $tdate=$this->input->post('tdate');
        $stock=0;$totalqty=0;$totalpur=0;
        $qty=0;$valQty=0;$query =0;
        $operation=0;$data[]='';$data1='';
        $valpur=0;
        $valsal=0;
        $valsalret=0;
        $valpurret=0;$result= 0;
        //echo $item;
        if($supplier=="all"){
            $this->db->select('item_master.*,brand_master.name');
            $this->db->from($table);
            $this->db->join('brand_master','brand_master.id=item_master.company');
            $result= $this->db->get()->result();
        }
        elseif($supplier == null || $supplier == ""){
            $this->db->select('item_master.*,brand_master.name');
            $this->db->from($table);
            $this->db->join('brand_master','brand_master.id=item_master.company');
            $result= $this->db->get()->result();
        }
        else{
            $this->db->select('item_master.*,brand_master.name');
            $this->db->from($table);
            $this->db->join('brand_master','brand_master.id=item_master.company');
            $this->db->where('item_master.supplier',$supplier);
            $result= $this->db->get()->result();
        }
        
        
        foreach($result as $row){
            $id=$row->id;
            $brandname=$row->name;
            $itemname=$row->item_name;
            $purchase_rate=$row->purchase_rate;
            $sales_rate=$row->sales_rate;
            $opening_stock=$row->opening_stock;
           // echo $brandname." ".$itemname." ";$this->db->select('*');
            if($supplier == "all"){
                //echo $item." if ";
                $this->db->from('stock_master');
                $this->db->where('itemid',$id);
                $this->db->where('stockdate <=',$fdate);
                $query = $this->db->get()->result();
            }else{
                //echo $item." else ";
                $this->db->from('stock_master');
                $this->db->where('itemid',$id);
                $this->db->where('stockdate <=',$fdate);
                $query = $this->db->get()->result();
            }
             //echo $this->db->last_query();
        // }
             $res=$query;
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
            $totalpur=$valpur+$opening_stock;
               // echo $totalpur." ";
            $totret=$totalpur-$valpurret;
                //echo $totret." ";
            $totalqty=$totret+$valsalret;
                //echo $totalqty." ";
            $data[]=array(
                    'id'=>$id,
                    'brandname'=>$brandname,
                    'itemname'=>$itemname,
                    'purchase_rate'=>$purchase_rate,
                    'sales_rate'=>$purchase_rate,
                    'inqty'=>$totalqty,
                    'outqty'=>$valsal
                );
                //$data1[]=$data;
        }
        return $data;
    }
    function getsalesItem($table){
        $mrp='';
        $qty='';
        $itemname='';
        $barnd='';
        $id='';
        $invoice_no='';
        $customer='';
        $invoice_date='';$data[]='';
        $item=$this->input->post('item');//'2';//
        $fdate=$this->input->post('fdate');//;'2019-03-06';//
        $tdate=$this->input->post('tdate');//'2019-03-25';//
        $this->db->select('salesbill_master.*,customer_master.name as customer');
        $this->db->from($table);
        $this->db->join('customer_master','customer_master.id=salesbill_master.name');
        $this->db->where('invoice_date >=',$fdate);
        $this->db->where('invoice_date <=',$tdate);
        $query=$this->db->get()->result();

        foreach($query as $row){
            $id=$row->id;
            $invoice_no=$row->invoice_no;
            $customer=$row->customer;
            $invoice_date=$row->invoice_date;
            $this->db->select('salesbilldetails.*,item_master.item_name,brand_master.name as brand');
            $this->db->from('salesbilldetails');
            $this->db->join('item_master','item_master.id=salesbilldetails.itemid');
            $this->db->join('brand_master','brand_master.id=salesbilldetails.groupid');
            $this->db->where('salesbilldetails.salesid',$id);
            $this->db->where('salesbilldetails.itemid',$item);
            $result = $this->db->get()->result();
            foreach($result as $row){
                $mrp=$row->mrp;
                $qty=$row->qty;
                $itemname=$row->item_name;
                $barnd=$row->brand;
            }
            $data[]=array(
                'invoice_no'=>$invoice_no,
                'invoice_date'=>$invoice_date,
                'item_name'=>$itemname,
                'brand'=>$barnd,
                'customer'=>$customer,
                'mrp'=>$mrp,
                'qty'=>$qty
            );
        }
        //echo  "Data  ".json_encode($data);
        return $data;
    }
}
 
?>