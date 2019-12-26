<?php
defined('BASEPATH') or exit('direct access not allowed');
//define('FPDF_FONTPATH','fpdf/font/');


require('fpdf/fpdf.php');
require ('fpdf/exfpdf.php');
require ('fpdf/easyTable.php');
require('fpdf/html_table.php');


class Myfpdf extends Fpdf
{
    function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
    }

    
        
    
}
?>