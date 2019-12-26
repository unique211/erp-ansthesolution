<?php
//include 'fpdf.php';
//include 'exfpdf.php';
//include 'easyTable.php';

$finaltotal=0;
$remainamt=0;
       foreach($masterdata as $value){
        
         $billno=$value->id;
         $customername=$value->customername;
         $grandamt=$value->grandamt;
         $address=$value->address;
         $distributor=$value->distributor;
         $dis_address=$value->dis_address;
         $bill_date=$value->bill_date;
        $billdate= explode("-", $bill_date);
       //print_r( $billdate);
       $totalpaidamt=$value->totalpaidamt;
       $dis_address=$value->dis_address;
        $date=$billdate[2]."/".$billdate[1]."/".$billdate[0];
        $remainamt= $grandamt- $totalpaidamt;
         
       } 

       // $pdf=new exFPDF('L','mm',array(100,150));
       $pdf=new exFPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddFont('helvetica', '', 'helvetica.php');
        $pdf->AddFont('helvetica', 'B', 'helveticab.php');
        $pdf->AddFont('helvetica', 'I', 'helveticai.php');
        $pdf->AddFont('helvetica', 'BI', 'helveticabi.php');

        $table=new easyTable($pdf, '{60,60,60}', 'width:180; border-color:#000000; font-size:10; paddingY:1;');

        $table->easyCell("www.ansthesolution.com ",'font-size:10; align:C;font-style:B; border:TL;');
        $table->easyCell("TAX INVOICE",'font-size:16; align:C;font-style:B;border:T; ');
        $table->easyCell("Mobile No:+91 8600605950,",'font-size:10; align:L;font-style:B;border:TR; ');
      $table->printRow();

        $table->easyCell("Email:ansthesolution030gmail.com",'font-size:9; align:C;font-style:B; border:L;');
        $table->easyCell("",'font-size:10; align:C;font-style:B;border:; ');
        $table->easyCell("+91 7558650950",'font-size:10; align:C;font-style:B;border:R; ');
        $table->printRow();

     

      $table->easyCell("\n",'font-size:10; align:C;font-style:B; border:TL;');
      $table->easyCell("\n",'font-size:14; align:C;font-style:B;border:T; ');
      $table->easyCell("\n",'font-size:10; align:C;font-style:B;border:TR; ');
    $table->printRow();

     
   
    $table->easyCell("Franchsor Name : ",'font-size:10; align:L;font-style:B;border:L; ');
    $table->easyCell("$distributor",'font-size:10; align:L; colspan:2;border:R; ');
    $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
   $table->printRow();

  
   $table->easyCell("Address : ",'font-size:10; align:L;font-style:B;border:L;');
   $table->easyCell("$dis_address",'font-size:10; align:L; colspan:2;border:R; ');
   $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->printRow();
  $table->easyCell("\n",'font-size:10; align:C;font-style:B; border:TL;');
  $table->easyCell("\n",'font-size:14; align:C;font-style:B;border:T; ');
  $table->easyCell("\n",'font-size:10; align:C;font-style:B;border:TR; ');
$table->printRow();
  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("ANS THE SOLUTION",'font-size:12; align:C;font-style:B; ');
  $table->easyCell("",'font-size:10; align:C;font-style:B;border:R; ');
$table->printRow();

$table->easyCell("S-107, MADHUBAN PLAZA, 1ST FLOOR, SHIVAJI NAGAR, MUL ROAD CHANDRAPUR, Maharashtra 442401 IN",'font-size:12; colspan:3; align:C; border:LRB;');
$table->printRow();

$table->endTable(0);
$table=new easyTable($pdf, '{10,50,60,60}', 'width:180; border-color:#000000; font-size:10; paddingY:1;');

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:LT;');
   $table->easyCell("M/S. : ",'font-size:10; align:L;font-style:B;border:T; ');
   $table->easyCell("$customername",'font-size:10; align:L; border:T; ');
   $table->easyCell("<b>Bill No. :</b>  $billno",'font-size:10; align:L; border:RT; ');
  $table->printRow();

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("ADD. : ",'font-size:10; align:L;font-style:B; ');
  $table->easyCell("$address",'font-size:10; align:L;  ');
  $table->easyCell("<b>Bill Date. :</b> $date",'font-size:10; align:L; border:R; ');
 $table->printRow();

 $table->easyCell("",'font-size:10; colspan:4; align:C;font-style:B; border:TLR;');
  $table->printRow();

 $table->easyCell("",'font-size:10; colspan:4; align:C;font-style:B; border:BLR;');
 $table->printRow();

        $table->endTable(0);

        $table=new easyTable($pdf, '{15,105,15,15,30}', 'width:180; border-color:#000000; font-size:10; paddingY:1; ');

        $table->easyCell("Sr. No.",'font-size:10;  align:C;font-style:B; border:BLR;');
        $table->easyCell("Services Desc.",'font-size:10;  align:C;font-style:B; border:BLR;');
        $table->easyCell("Period",'font-size:10;  align:C;font-style:B; border:BLR;');
        $table->easyCell("Rate",'font-size:10;  align:C;font-style:B; border:BLR;');
        $table->easyCell("Amount",'font-size:10;  align:C;font-style:B; border:BLR;');
        $table->printRow();

        $count=1;
        foreach($productdata as $productinfo){
          
          
          $totalamt=$productinfo->qty *$productinfo->amount;
          $finaltotal=$finaltotal+ $totalamt;
        $table->easyCell("$count",'font-size:10;  align:L; border:LR;');
        $table->easyCell($productinfo->servicename,'font-size:10;  align:L; border:LR;');
        $table->easyCell($productinfo->qty,'font-size:10;  align:L; border:LR;');
        $table->easyCell($productinfo->amount,'font-size:10;  align:L;border:LR;');
        $table->easyCell($totalamt,'font-size:10;  align:R; border:LR;');
        $table->printRow();
        $count= $count+1;
        }
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();


        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();


        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        /*$table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->easyCell("",'font-size:10;  align:L;border:LR;');
        $table->easyCell("",'font-size:10;  align:L; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:C; border:LRB;');
        $table->easyCell("",'font-size:10;  align:C; border:LRB;');
        $table->easyCell("",'font-size:10;  align:C; border:LRB;');
        $table->easyCell("",'font-size:10;  align:C;border:LRB;');
        $table->easyCell("",'font-size:10;  align:C; border:LRB;');
        $table->printRow();*/
        $table->endTable(0);
   
      
        $table=new easyTable($pdf, '{15,105,15,15,30}', 'width:180; border-color:#000000; font-size:10; paddingY:1; ');
        $table->easyCell("* Amount will not transferble or Refundable  Amount Recived",'font-size:10; colspan:2; align:C; border:LT;');
        $table->easyCell("Total Amt : ",'font-size:10; colspan:2; font-style:B;border:T; align:R;');
        $table->easyCell(" $finaltotal",'font-size:10;  font-style:B; align:R;border:RT;');
        $table->printRow();
        $table->endTable(0);
        $table=new easyTable($pdf, '{60,30,30,30,30}', 'width:180; border-color:#000000; font-size:10; paddingY:1; ');
        $table->easyCell(" 1)Paid Amount:",'font-size:10; font-style:B; align:C; border:LT;');
        $table->easyCell(" $totalpaidamt ",'font-size:10; font-style:B;border:T; align:C;');
        $table->easyCell("2)Remain Amount:",'font-size:10; colspan:2; font-style:B;border:T; align:R;');
        $table->easyCell(" $remainamt",'font-size:10; font-style:B;border:RT; align:R;');
       // $table->easyCell("",'font-size:10;  font-style:B; align:R;border:RT;');
        $table->printRow();

      /*  $table->easyCell("<b>1) Paid Amount:</b> $totalpaidamt",'font-size:10; colspan:2; align:C;font-style:B; border:L;');
        $table->easyCell("<b>2)Remain Amount   :</b>",'font-size:10;colspan:3; align:R;font-style:B;border:R;');
        $table->easyCell("$remainamt",'font-size:10;  align:R;font-style:B; border:R;');
        $table->printRow();*/
        $table->endTable(0);
        $table=new easyTable($pdf, '{15,105,15,15,30}', 'width:180; border-color:#000000; font-size:10; paddingY:1; ');

        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();
        $table->easyCell("",'font-size:10; colspan:5; font-style:B; align:L;border:LR;');
        $table->printRow();

        $table->endTable(0);

        $table=new easyTable($pdf, '{10,50,60,60}', 'width:180; border-color:#000000;  font-size:10; paddingY:1;');
    
       
      $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
       $table->easyCell("*condition Apply *",'font-size:10; border:R;colspan:3; align:L; ');
      $table->printRow();
     /* $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
      $table->easyCell("Thank For Your Business",'font-size:10; border:R;colspan:3; align:L; ');
     $table->printRow();*/
     
     /* $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();
      $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();*/
      $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();
      $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();
      $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();
      $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();
      $table->easyCell("",'font-size:10;colspan:4; align:C;font-style:B; border:LR;');
      $table->printRow();

       $table->easyCell("Thank For Your Business",'font-size:10;colspan:4; align:C;font-style:B; border:LRB;');
       $table->printRow();
    
          $table->endTable(0);
       
          $table=new easyTable($pdf, '{10,50,60,60}', 'width:180; border-color:#000000;  font-size:10; paddingY:1;');
    
       
         
           $table->easyCell("Subject to Chandrapur Jurisdiction Court",'font-size:12;font-style:B;colspan:5; align:C; ');
          $table->printRow();
    
        $pdf->Output();
