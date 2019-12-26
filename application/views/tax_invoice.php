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
         $bill_date=$value->bill_date;
         $phone_no=$value->phone_no;
        $billdate= explode("-", $bill_date);
       //print_r( $billdate);
       $totalpaidamt=$value->totalpaidamt;
       $dis_address=$value->dis_address;
        $date=$billdate[2]."/".$billdate[1]."/".$billdate[0];
        $remainamt= $grandamt- $totalpaidamt;
         
       } 
      $totalpaidamt= number_format($totalpaidamt,2);
     $remainamt=  number_format($remainamt,2);

       // $pdf=new exFPDF('L','mm',array(100,150));
       $pdf=new exFPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddFont('helvetica', '', 'helvetica.php');
        $pdf->AddFont('helvetica', 'B', 'helveticab.php');
        $pdf->AddFont('helvetica', 'I', 'helveticai.php');
        $pdf->AddFont('helvetica', 'BI', 'helveticabi.php');

        $table=new easyTable($pdf, '{15,57,108}', 'width:180; border-color:#000000; font-size:10; paddingY:1;');
        $table->easyCell('', 'img:assets/images/favicon _ans.png,w10,h10; align:L;colspan:2;  border:LT;');
         $table->easyCell("INVOICE BILL",'font-size:18; align:L;font-style:B;border:TR; ');
     
      $table->printRow();

      


        $table->endTable(0);
        $table=new easyTable($pdf, '{5,55,60,30,30}', 'width:180; border-color:#000000; font-size:10; paddingY:2;');
        $table->easyCell("",'font-size:10; align:C;font-style:B; border:TL;');
        $table->easyCell("www.ansthesolution.com \nansthesolution030gmail.com",'font-size:10;font-color:#0000FF; align:L;font-style:B; border:T;');
        $table->easyCell("ANS THE SOLUTION ",'font-size:16; align:C;font-style:B;border:T; ');
         $table->easyCell('', 'img:assets/images/mobile.png,w9,h9; align:R; border:T;paddingY:1;');
        $table->easyCell("\n+91-8600605950 \n+91-7558650950",'font-size:10; align:L;font-style:B;border:TR;paddingY:2; ');
      $table->printRow();

      

      $table->endTable(0);
      $table=new easyTable($pdf, '{5,50,5,60,60}', 'width:180; border-color:#000000; font-size:10; paddingY:1;');
      $table->easyCell("",'font-size:10; align:C;font-style:B; border:LT;');
      $table->easyCell("\n",'font-size:10; align:C;font-style:B; border:T;');
      $table->easyCell("\n",'font-size:14; align:C;font-style:B;border:T; ');
      $table->easyCell("\n",'font-size:14; align:C;font-style:B;border:T; ');
      $table->easyCell("\n",'font-size:10; align:C;font-style:B;border:TR; ');
    $table->printRow();

     
    $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
    $table->easyCell("Franchisee Name ",'font-size:10; align:L;font-style:B; ');
    $table->easyCell("<b>:</b>",'font-size:10; align:L;  ');
    $table->easyCell("$distributor",'font-size:10;colspan:2; align:L; border:R; ');
   
   $table->printRow();

   $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
   $table->easyCell("ADD ",'font-size:10; align:L;font-style:B;');
   $table->easyCell("<b>:</b>",'font-size:10; align:L;  ');
   $table->easyCell("$dis_address",'font-size:10;colspan:2; align:L; border:R; ');
  
  $table->printRow();

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("",'font-size:10; align:L;font-style:B');
   $table->easyCell("",'font-size:10; align:L; colspan:2;');
   $table->easyCell("",'font-size:10; align:C;font-style:B; border:R;');
  $table->printRow();

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("",'font-size:10; align:L;font-style:B;');  
   $table->easyCell("",'font-size:10; align:L; colspan:2; ');
   $table->easyCell("",'font-size:10; align:C;font-style:B; border:R;');
  $table->printRow();

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("",'font-size:10; align:L;font-style:B;');  
   $table->easyCell("",'font-size:10; align:L; colspan:2;');
   $table->easyCell("",'font-size:10; align:C;font-style:B; border:R;');
  $table->printRow();

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("Cell NO. ",'font-size:10; align:L;font-style:B;');
  $table->easyCell("<b>:</b>",'font-size:10; align:L; ');
  $table->easyCell(" $phone_no",'font-size:10; colspan:2; align:L; border:R;');
 $table->printRow();



$table->endTable(0);
$table=new easyTable($pdf, '{5,55,60,60}', 'width:180; border-color:#000000; font-size:10; paddingY:1;');

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:LT;');
   $table->easyCell("<b>M/S. : </b>$customername",'font-size:10; align:L;border:T;colspan:2 ');
   //$table->easyCell(" ",'font-size:10;  border:T; ');
   $table->easyCell("<b>Invoice No. : </b>  $billno",'font-size:10; align:L; border:RT; ');
  $table->printRow();

  $table->easyCell("",'font-size:10; align:C;font-style:B; border:L;');
  $table->easyCell("<b>ADD. :</b> $address",'font-size:10; align:L; colspan:2;');
  //$table->easyCell("",'font-size:10; align:L;');
  $table->easyCell("<b>Invoice Date. :</b> $date",'font-size:10; align:L; border:R; ');
 $table->printRow();

 

 $table->easyCell("",'font-size:10; colspan:4; align:C;font-style:B; border:BLR;');
 $table->printRow();

        $table->endTable(0);

        $table=new easyTable($pdf, '{15,90,15,30,30}', 'width:180; border-color:#000000; font-size:10; paddingY:1; ');

        $table->easyCell("Sr. No.",'font-size:10;  align:C;font-style:B; border:1;');
        $table->easyCell("Services Desc.",'font-size:10;  align:C;font-style:B; border:1;');
        $table->easyCell("Period",'font-size:10;  align:C;font-style:B; border:1;');
        $table->easyCell("Rate",'font-size:10;  align:C;font-style:B; border:1;');
        $table->easyCell("Amount",'font-size:10;  align:C;font-style:B; border:1;');
        $table->printRow();

        $count=1;
        foreach($productdata as $productinfo){
          
          
          $totalamt=$productinfo->qty *$productinfo->amount;
          $finaltotal=$finaltotal+ $totalamt;
        $table->easyCell("$count",'font-size:10;  align:C; border:LR;');
        $table->easyCell($productinfo->servicename,'font-size:10;  align:L; border:LR;');
        $table->easyCell($productinfo->qty,'font-size:10;  align:C; border:LR;');
        $table->easyCell(number_format($productinfo->amount,2),'font-size:10;  align:R;border:LR;');
        $table->easyCell(number_format($totalamt,2),'font-size:10;  align:R; border:LR;');
        $table->printRow();
        $count= $count+1;
        }
        $finaltotal=  number_format($finaltotal,2);
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



        $table->easyCell("*Amount will not transferable or Refundable.\n* Subject to Chandrapur Jurisidiction Court.",'font-size:10;font-style:B; colspan:3; rowspan:2;  align:L; border:LRT;');
       $table->easyCell("Total Amt.",'font-size:10; font-style:B; align:C;border:LRT;');
        $table->easyCell("$finaltotal",'font-size:10;  align:R; border:LRT;');
        $table->printRow();

        $table->easyCell("Paid Amt.",'font-size:10;  align:C;border:LRT;');
         $table->easyCell("$totalpaidamt",'font-size:10;  align:R; border:LRT;');
         $table->printRow();

         $table->easyCell("",'font-size:10;font-style:B; colspan:3;  align:L; border:LR;');
         $table->easyCell("Balance Amt.",'font-size:10;  align:C;border:1;');
          $table->easyCell("$remainamt",'font-size:10;  align:R; border:1;');
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
        $table->printRow();*/

        $table->easyCell("",'font-size:10;  align:C; border:L;');
        $table->easyCell("",'font-size:10;  align:C; ');
        $table->easyCell("",'font-size:10;  align:C;');
        $table->easyCell("",'font-size:10;  align:C;');
        $table->easyCell("",'font-size:10;  align:C; border:R;');
        $table->printRow();

        $table->easyCell("",'font-size:10;  align:C; border:L;');
        $table->easyCell("",'font-size:10;  align:C; ');
        $table->easyCell("",'font-size:10;  align:C; ');
        $table->easyCell("",'font-size:10;  align:C;');
        $table->easyCell("",'font-size:10;  align:C; border:R;');
        $table->printRow();

       
        $table->endTable(0);
   
      
       
       

        $table=new easyTable($pdf, '{10,50,60,60}', 'width:180; border-color:#000000;  font-size:10; paddingY:1;');
    
        $table->easyCell("Thank For Your Business",'font-size:16;colspan:4; align:C;font-style:B; border:LR;');
        $table->printRow();

        $table->easyCell("",'font-size:10;colspan:3; align:C;font-style:B; border:LB;');
        $table->easyCell("This Billing Invoice generated online\nhence no manual signature required",'font-size:8; align:R;font-style:B; border:RB;');
        $table->printRow();


     
   
    
          $table->endTable(0);
       
        
    
        $pdf->Output();
