<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        //$this->load->model('InvoiceModel');
        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');
    }
    public function index()
    {
        $name=$_POST['name'];
        $item=$_POST['item'];
        $icode=$_POST['icode'];
        $mrp=$_POST['mrp'];
        $qty=$_POST['print_qty'];
        $code=$icode.$mrp;
       // $names = $name;
        $rendererOptions = array('imageType'=>'png');
        $file= Zend_Barcode::draw('code128', 'image', array('text'=>$code), $rendererOptions);
        imagepng($file,"assets/barcode/{$code}.png");
        $data['barcode'] = $code;
        $data['qty']=$qty;
        $this->load->view('InvoiceView', $data);

    }
    
}
?>