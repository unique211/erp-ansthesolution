<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller {
	function __construct(){
		parent:: __construct();
        $this->load->model('Main_model','m');
        $this->load->helper(array('form', 'url'));
	    $this->load->library('upload');
        header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");				
    }
    public function data()
    {
		$data=$this->m->getBillno();
        echo json_encode($data);
	}
	public function index()
	{					
    }
    //adddata function for adding data 
    public function adddata(){ 
        $table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
        $data1="";
        $data="";
        if($table_name == 'employee_master'){
            $data = array(
                 'name'=>$this->input->post('name'),
                 'address'=>$this->input->post('address'),
                 'mobile'=>$this->input->post('mobile'),
                 'email'=>$this->input->post('email'),
                 'age'=>$this->input->post('age'),
                 'gender'=>$this->input->post('gender'),
                 'c_id'=>$this->session->c_id,
                 'userid'=>$this->session->userid
            );
        }
        elseif($table_name == 'supplier_master'){
            $data = array(
                 'name'=>$this->input->post('name'),
                 'address'=>$this->input->post('address'),
                 'mobile'=>$this->input->post('mobile'),
                 'gstin'=>$this->input->post('gstin'),
                 'con_person'=>$this->input->post('person'),
                 'con_number'=>$this->input->post('number'),
                 'c_id'=>$this->session->c_id,
                 'userid'=>$this->session->userid
            );
        }
        elseif($table_name == 'customer_master'){
            $data = array(
                 'name'=>$this->input->post('name'),
                 'address'=>$this->input->post('address'),
                 'mobile'=>$this->input->post('mobile'),
                 'gstin'=>$this->input->post('gstin'),
                 'c_id'=>$this->session->c_id,
                 'userid'=>$this->session->userid
            );
        }
        elseif($table_name =='paychasebill_master'){
            $data = array(
                'billno'=>$this->input->post('billno'),
                'billdate'=>$this->input->post('date'),
                'supplierid'=>$this->input->post('supplier'),
                'entryno'=>$this->input->post('entyno'),
                'entrydate'=>$this->input->post('entrydate'),
                'address'=>$this->input->post('address'),
                'mobileno'=>$this->input->post('mobileno'),
                'totalamount'=>$this->input->post('bill_amt'),
                'disscount_per'=>$this->input->post('dis_per'),
                'disscount_plus'=>$this->input->post('dis_plus'),
                'gst'=>$this->input->post('gstt'),
                'paid'=>$this->input->post('paid'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        
        elseif($table_name =='purchasereturn_master'){
            $data = array(
                'billno'=>$this->input->post('billno'),
                'billdate'=>$this->input->post('date'),
                'supplier'=>$this->input->post('supplier'),
                'entryno'=>$this->input->post('entyno'),
                'entrydate'=>$this->input->post('entrydate'),
                'address'=>$this->input->post('address'),
                'mobileno'=>$this->input->post('mobileno'),
                'invoiceno'=>$this->input->post('invoice_no'),
                'totalamount'=>$this->input->post('bill_amt'),
                'dis_per'=>$this->input->post('dis_per'),
                'dis_plus'=>$this->input->post('dis_plus'),
                'gst'=>$this->input->post('gstt'),
                'paid'=>$this->input->post('paid'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        elseif($table_name =='salesbill_master'){
            $data = array(
                'name'=>$this->input->post('customer'),
                'invoice_no'=>$this->input->post('invoice_no'),
                'invoice_date'=>$this->input->post('invoice_date'),
              //  'stock'=>$this->input->post('stock'),
                'salesman'=>$this->input->post('sales_man'),
                'total'=>$this->input->post('bill_amt'),
                'dis_per'=>$this->input->post('dis_per'),
                'dis_plus'=>$this->input->post('dis_plus'),
                'cgst'=>$this->input->post('cgst'),
                'sgst'=>$this->input->post('sgst'),
                'paid'=>$this->input->post('paid'),
                'roundoff'=>$this->input->post('round_off'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        elseif($table_name =='salesreturn_master'){
            $data = array(
                'name'=>$this->input->post('customer'),
                'invoice_no'=>$this->input->post('invoice_no'),
                'invoice_date'=>$this->input->post('invoice_date'),
                'total'=>$this->input->post('bill_amt'),
                'dis_per'=>$this->input->post('dis_per'),
                'dis_plus'=>$this->input->post('dis_plus'),
                'cgst'=>$this->input->post('cgst'),
                'sgst'=>$this->input->post('sgst'),
                'paid'=>$this->input->post('paid'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        elseif($table_name =='purchasedetails'){
            $data = array(
                 'purid'=>$this->input->post('proid'),
                 'groupid'=>$this->input->post('groupid'),
                 'itemid'=>$this->input->post('itemid'),
                 'mrp'=>$this->input->post('mrp'),
                 'qty'=>$this->input->post('qty'),
                 'discount'=>$this->input->post('dis'),
                 'gst'=>$this->input->post('gst'),
                 'total'=>$this->input->post('total')                
            );
        }
        elseif($table_name =='purchasereturndetails'){
            $data = array(
                 'purretid'=>$this->input->post('proid'),
                 'groupid'=>$this->input->post('groupid'),
                 'itemid'=>$this->input->post('itemid'),
                 'mrp'=>$this->input->post('mrp'),
                 'qty'=>$this->input->post('qty'),
                 'discount'=>$this->input->post('dis'),
                 'gst'=>$this->input->post('gst'),
                 'total'=>$this->input->post('total'),
                 'returnid'=>$this->input->post('returnid')
                
            );
        }
        elseif($table_name =='salesbilldetails'){
            $data = array(
                'salesid'=>$this->input->post('proid'),
                'groupid'=>$this->input->post('groupid'),
                'itemid'=>$this->input->post('itemid'),
                'mrp'=>$this->input->post('mrp'),
                'dis'=>$this->input->post('dis'),
                'qty'=>$this->input->post('qty'),
                'cgst'=>$this->input->post('cgst'),
                'sgst'=>$this->input->post('sgst'),
                'total'=>$this->input->post('total'),
                
            );
        }
        elseif($table_name =='salesreturndetails'){
            $data = array(
                'salesid'=>$this->input->post('proid'),
                'groupid'=>$this->input->post('groupid'),
                'itemid'=>$this->input->post('itemid'),
                'mrp'=>$this->input->post('mrp'),
                'dis'=>$this->input->post('dis'),
                'qty'=>$this->input->post('qty'),
                'cgst'=>$this->input->post('cgst'),
                'sgst'=>$this->input->post('sgst'),
                'total'=>$this->input->post('total'),
                'returnid'=>$this->input->post('returnid')
                
            );
        }
        elseif($table_name=="company"){
            $data = array(
                'name'=>$this->input->post('company_name'),
                'address'=>$this->input->post('address'),
                'email'=>$this->input->post('email'),
                'mobile'=>$this->input->post('phone'),
                'gstno'=>$this->input->post('gst'),
                'pan'=>$this->input->post('pan'),
                'integration'=>$this->input->post('integration'),
                'bank_name'=>$this->input->post('bank_name'),
                'branch_name'=>$this->input->post('branch_name'),
                'acno'=>$this->input->post('acno'),
                'ifsc'=>$this->input->post('ifsc'),
                'username'=>$this->input->post('username'),
                'password'=>$this->input->post('password'),
                'image'=>$this->input->post('image'),
                'start_date'=>$this->input->post('sdate'),
                'end_date'=>$this->input->post('edate')
            );
        }
        elseif($table_name == 'login_master'){
            $data = array(
                'c_id'=>$this->input->post('c_id'),
                'username'=>$this->input->post('username'),
                'password'=>$this->input->post('password') 
            );
        }
        elseif($table_name == 'item_master'){
            $data = array(
                'barcode'=>$this->input->post('barcode'),
                'item_code'=>$this->input->post('code'),
                'item_name'=>$this->input->post('name'),
                'item_type'=>$this->input->post('type'),
                'item_group'=>$this->input->post('group'),
                'hsn'=>$this->input->post('hsn'),
                'unit'=>$this->input->post('unit'),
                'location'=>$this->input->post('location'),
                'company'=>$this->input->post('comapny'),
                'supplier'=>$this->input->post('supplier'),
                'expiry_date'=>$this->input->post('e_date'),
                'min_qty'=>$this->input->post('min_qty'),
                'max_qty'=>$this->input->post('max_qty'),
                'size'=>$this->input->post('size'),
                'packing'=>$this->input->post('packing'),
                'purchase_rate'=>$this->input->post('purchase_rate'),
                'mrp'=>$this->input->post('mrp'),
                'net_rate'=>$this->input->post('net_rate'),
                'gst'=>$this->input->post('gst'),
                'sales_rate'=>$this->input->post('sales_rate'),
                'opening_stock'=>$this->input->post('opening_stock'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
       
        else if($table_name == 'account_group'){
            $data = array(
                'name'=>$this->input->post('name'),
                'bal'=>$this->input->post('bal'),
                'date'=>$this->input->post('date'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        else if($table_name == 'payment_master'){
            $data = array(
                'e_no'=>$this->input->post('e_no'),
                'e_date'=>$this->input->post('entry_date'),
                'name'=>$this->input->post('name'),
                'r_no'=>$this->input->post('r_no'),
                'r_date'=>$this->input->post('r_date'),
                'type'=>$this->input->post('type'),
                'agroup'=>$this->input->post('a_group'),
                'payment'=>$this->input->post('payment'),
                'bankname'=>$this->input->post('b_name'),
                'checkno'=>$this->input->post('check_no'),
                't_id'=>$this->input->post('t_id'),
                'amount'=>$this->input->post('amount'),
                'remark'=>$this->input->post('remark'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        else if($table_name == 'refund_master'){
            $data = array(
                'e_no'=>$this->input->post('e_no'),
                'e_date'=>$this->input->post('entry_date'),
                'name'=>$this->input->post('name'),
                'r_no'=>$this->input->post('r_no'),
                'r_date'=>$this->input->post('r_date'),
                'type'=>$this->input->post('type'),
                'agroup'=>$this->input->post('a_group'),
                'payment'=>$this->input->post('payment'),
                'bankname'=>$this->input->post('b_name'),
                'checkno'=>$this->input->post('check_no'),
                't_id'=>$this->input->post('t_id'),
                'amount'=>$this->input->post('amount'),
                'remark'=>$this->input->post('remark'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        else if($table_name == 'bank_details'){
            $data = array(
                'b_name'=>$this->input->post('bankname'),
                'ac_no'=>$this->input->post('acno'),
                'branch'=>$this->input->post('branch'),
                'payment'=>$this->input->post('payment'),
                'bname'=>$this->input->post('b_name'),
                'checkno'=>$this->input->post('check_no'),
                't_id'=>$this->input->post('t_id'),
                'amount'=>$this->input->post('amount'),
                'remark'=>$this->input->post('remark'),
                'pay_opt'=>$this->input->post('pay_opt'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            );
        }
        else {
            $data = array(
                'name'=>$this->input->post('name'),
                'c_id'=>$this->session->c_id,
                'userid'=>$this->session->userid
            ); 
        }
        //checking the value of id 
        if($id == ''){ //is blank then perform insert operation
            if($table_name == 'company'){
                $data1 = $this->m->insertrecord($table_name,$data);
            }else if($table_name == 'paychasebill_master'){
                $data1 = $this->m->insertrecord($table_name,$data);
            }
            else if($table_name == 'purchasereturn_master'){
                $data1 = $this->m->insertrecord($table_name,$data);
            }
            else if($table_name == 'salesbill_master'){
                $data1 = $this->m->insertrecord($table_name,$data);
            }
            else if($table_name == 'salesreturn_master'){
                $data1 = $this->m->insertrecord($table_name,$data);
            }
            else{
                if($table_name=="purchasedetails"){
                    $data2 = array(
                        'oprationid'=>$this->input->post('proid'),
                        'stockdate'=>date("Y-m-d"),
                        'opration'=>'purchase',
                        'itemid'=>$this->input->post('itemid'),
                        'qty'=>$this->input->post('qty')
                   );
                   $data1 = $this->m->insertdata('stock_master',$data2);
                }
                elseif($table_name=="purchasereturndetails"){
                    $data2 = array(
                        'oprationid'=>$this->input->post('proid'),
                        'stockdate'=>date("Y-m-d"),
                        'opration'=>'purchase_return',
                        'itemid'=>$this->input->post('itemid'),
                        'qty'=>$this->input->post('qty')
                   );
                   $data1 = $this->m->insertdata('stock_master',$data2);
                }
                elseif($table_name=="salesbilldetails"){
                    $data2 = array(
                        'oprationid'=>$this->input->post('proid'),
                        'stockdate'=>date("Y-m-d"),
                        'opration'=>'sales',
                        'itemid'=>$this->input->post('itemid'),
                        'qty'=>$this->input->post('qty')
                   );
                   $data1 = $this->m->insertdata('stock_master',$data2);
                }
                elseif($table_name=="salesreturndetails"){
                    $data2 = array(
                        'oprationid'=>$this->input->post('proid'),
                        'stockdate'=>date("Y-m-d"),
                        'opration'=>'sales_return',
                        'itemid'=>$this->input->post('itemid'),
                        'qty'=>$this->input->post('qty')
                   );
                   $data1 = $this->m->insertdata('stock_master',$data2);
                }
                $data1 = $this->m->insertdata($table_name,$data);
            }
		}
		else{ //is not blank then perform update operation
            if($table_name=="paychasebill_master"){

                $this->m->data_delete1('purchasedetails','purid',$id);
                  $this->m->data_delete1('stock_master','purchase',$id);   
            }else if($table_name=="purchasereturn_master"){
                $this->m->data_delete1('purchasereturndetails','purretid',$id);
                $this->m->data_delete1('stock_master','purchase_return',$id);   
            }
            else if($table_name=="salesbill_master"){
                $this->m->data_delete1('salesbilldetails','salesid',$id);
                $this->m->data_delete1('stock_master','sales',$id);   
            }
            else if($table_name=="salesreturn_master"){
                $this->m->data_delete1('salesreturndetails','salesid',$id);
                $this->m->data_delete1('stock_master','sales_return',$id);   
            }
            $data1 = $this->m->updatedata($table_name,$data,$id);
		}
		echo json_encode($data1);
    }
    //adddata ends...
    /*function data(){
        $table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
        $data1="";
        $data="";
        
        if($id == ''){ //is blank then perform insert operation
            if($table_name == 'company'){
                $data1 = $this->m->insertrecord($table_name,$data);
            }
            else{  
                $data1 = $this->m->insertdata($table_name,$data);
            }
        }
        else{ 
            $data1 = $this->m->updatedata($table_name,$data,$id);
        }
        
        echo json_encode($data1);
    }*/
    public function getDate(){
        $table_name=$this->input->post('table_name');
        $data=$this->m->getDate($table_name);
        echo json_encode($data);
    }
    //showdata function for display the data
    public function showData()
    {   
       	$table_name=$this->input->post('table_name');
        $data1=$this->m->showalldata($table_name);
        echo json_encode($data1);	
    }
    //showdata function ends here
    public function showTotal()
    {   
        $table_name=$this->input->post('table_name');
        $where=$this->input->post('where');
        $data1=$this->m->gettotal($table_name,$where);
        echo json_encode($data1);	
    }
    public function getStock()
    {   
        //$table_name=$this->input->post('table_name');
        $where=$this->input->post('where');
        $data1=$this->m->getStock($where);
        echo json_encode($data1);	
    }
    public function CountStock()
    {   
        $where=$this->input->post('where');
        $data1=$this->m->CountStock($where);
        echo json_encode($data1);	
    }
    //deletedata function for deleting records
    public function deletedata()
    { 
		$table_name = $this->input->post('table_name');
        $id=$this->input->post('id');
        if($table_name=="paychasebill_master"){
            $this->m->data_delete1('purchasedetails','purid',$id);
            $this->m->data_delete1('stock_master','purchase',$id); 
        }else if($table_name=="purchasereturn_master"){
            $this->m->data_delete1('purchasereturndetails','purretid',$id);
            $this->m->data_delete1('stock_master','purchase_return',$id);  
        }
        else if($table_name=="salesbill_master"){
            $this->m->data_delete1('salesbilldetails','salesid',$id);
            $this->m->data_delete1('stock_master','sales',$id);  
        }
        else if($table_name=="salesreturn_master"){
            $this->m->data_delete1('salesreturndetails','salesid',$id);
            $this->m->data_delete1('stock_master','sales_return',$id);  
        }
        $data1=$this->m->delete_data($table_name,$id);
    	echo json_encode($data1);
    }
    //deletedata function ends here
    public function get_master(){
		//$table_name="project_master";
		$table_name	=$this->input->post('table_name');//"account_group"; //
		$data=$this->m->data_get($table_name);			
		echo json_encode($data);	
    }
    public function getdata()
    {   
        $table_name=$this->input->post('table_name');
        $data1=$this->m->getalldropdown($table_name);
        echo json_encode($data1);	
    }
    public function getitem()
    {   
        $table_name=$this->input->post('table_name');
        $data1=$this->m->getitem($table_name);
        echo json_encode($data1);	
    }
    public function getinvoicedate()
    {   
        $where=$this->input->post('where');
        $table_name=$this->input->post('table_name');
        $data1=$this->m->getinvoicedate($table_name,$where);
        echo json_encode($data1);	
    }
    public function getinvoice()
    {   
        $this->db->select_max('invoice_no');
        $this->db->where('c_id',$this->session->c_id);
        $this->db->from('salesbill_master');
        $result = $this->db->get()->row();
        $result->invoice_no;
        $id=1;
        $query=$result->invoice_no;
        if($query == NULL){
            $id=1;
        }else{
            $id= $id + $query;
        }
        echo $id;
    }
    public function showallpurchase(){
        $table_name=$this->input->post('table_name');
        $where=$this->input->post('where');
        $data1=$this->m->getallpurchase($table_name,$where);
        if($table_name=="paychasebill_master"){
            echo json_encode($data1);
        }
        else{
            echo json_encode($data1);
        }
    }
    public function showallreturn(){
        $table_name=$this->input->post('table_name');
        $where=$this->input->post('where');
        
      $data1=$this->m->getallreturn($table_name,$where);
      echo json_encode($data1);
    }
    public function getcode(){
        
    }
    public function showallsales(){
        $table_name=$this->input->post('table_name');
        $where=$this->input->post('where');
        $data1=$this->m->getallsales($table_name,$where);
       echo json_encode($data1);
    }
    public function showallsalesreturn(){
        $table_name=$this->input->post('table_name');
        $where=$this->input->post('where');
        $data1=$this->m->getallsalesreturn($table_name,$where);
       echo json_encode($data1);
    }
    public function doc_image_upload()
	{
		$this->load->helper("file");	
		$this->load->library("upload");
		
		if ($_FILES['uploadFile1']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => './assets/Companylogos/',
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "remove_spaces" => TRUE,
		       "allowed_types" => 'jpg|jpeg|png|gif',
		       "max_size" => 30000,
		    ));
			
			

		   if (!$this->upload->do_upload('uploadFile1')) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
		}

		    $data = $this->upload->data();
			$path = $data['file_name'];
			
			echo json_encode($path);	
		}else{
			echo "no file"; 
		}
		
		
    }
    public function print_pdf(){
        $this->load->library('myfpdf');
       // $table_name1=$this->input->post('table_name1');
       // $table_name2=$this->input->post('table_name2');
         $where=$this->input->post('btnprint');
      // $table_name1="company";
       //$table_name2="salesbill_master";
       
      // $where=1;
        $data['master_data']=$this->m->getmaster_detail($where);
        $data['sales_data']=$this->m->getsales_data($where);
    
		$data['company']=$this->m->getcompany_detail();
        $pdf=$this->load->view('salesbill_pdf',$data);
       
    }
   /* public function do_upload()
    {
		$filename="userfile";
        $config['upload_path'] = './upload/';
  		$config['allowed_types'] = 'jpg|jpeg|png|gif';
  		$config['max_size'] = 204800;
  		$config['encrypt_name'] = False;
        $this->load->library('upload', $config);
		$this->upload->initialize($config);
        if ( ! $this->upload->do_upload($filename))
        {
            $error = array('error' => $this->upload->display_errors());
          //  $data=$error;
            echo $error;
        }
        else
        {
            $data= $this->upload->data('file_name');
            echo $data;
        }
    }
}
/* $size='';
            /*$image=$this->input->post('image');
         
            $size=$_FILES['image']['size'];	
            if($size == ''){
                log_message('error', 'thereis no file');
            }
            else{
                log_message('info',"there is value in name");
            }
            $path ='';
            
            if ($size > 0){
                $this->upload->initialize(array( 
                    "upload_path" => $image_path,
                    "overwrite" => FALSE,
                    "max_filename" => 300,
                    "remove_spaces" => TRUE,
                    "allowed_types" => 'jpg|jpeg|png|gif',
                    //"allowed_types" => '*',
                    "max_size" => 1024*10,
                ));	
                if (!$this->upload->do_upload($id)) {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode($error);
                }
    
                    $data['upload_data']= $this->upload->data('file_name');
                    $path = $data['upload_data'];			
    
                    //echo json_encode($path);	
                }else{
                    echo "no file"; 
                }*//*public function doc_image_upload()
	{
		$this->load->helper("file");	
		$this->load->library("upload");		

		$size='';
		$size=$_FILES['attachreg_certy']['size'];		

		if ($size > 0){
			$this->upload->initialize(array( 
		       "upload_path" => './assets/documents/',
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "remove_spaces" => TRUE,
//		       "allowed_types" => 'jpg|jpeg|png|gif',
		       "allowed_types" => '*',
		       "max_size" => 1024*10,
		    ));				

		   if (!$this->upload->do_upload($id)) {
				$error = array('error' => $this->upload->display_errors());
				echo json_encode($error);
			}

		    $data = $this->upload->data();
			$path = $data['file_name'];			

			echo json_encode($path);	
		}else{
			echo "no file"; 
		}				*/

	}
?>