 <?php
//print_r($sales_texdata);
//include 'fpdf.php';
//include 'exfpdf.php';
//include 'easyTable.php';

/*$cells=array('Lorem ipsum dolor', 
'Consectetur adipiscing elit. Nam quis tincidunt mi', 
'Vitae pulvinar tortor. Integer quis mattis lorem. Quisque maximus ut ipsum aliquet mattis.', 
'Sed in tristique enim. Vivamus malesuada, sapien non consequat tempus, risus mauris ornare risus, in varius urna est quis enim.', 
'Suspendisse nec fermentum orci, ut feugiat felis.', 
'Phasellus molestie urna nisi, nec
imperdiet orci pretium vel. Donec vehicula tellus nisl, nec commodo diam posuere eu.',
'Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc in libero non velit consectetur facilisis tincidunt non justo.',
'Pellentesque', 'Scelerisque nec nibh a sollicitudin.', 'Nullam porttitor nulla est, nec semper felis mattis sit amet.',
'Donec', 'fringilla congue felis, ornare', 'tempus velit congue at.', 
'Curabitur euismod, urna ut pretium sodales',
'felis ligula tincidunt tellus, a vestibulum urna velit ac odio.',
'In non est et arcu sollicitudin', 
'Faucibus et in metus. Proin consequat dictum aliquam. Fusce sodales, nisl sit amet ornare porta', 
'velit odio ultricies quam', 'ut accumsan massa enim a tortor', 
'Sed euismod est eu laoreet blandit.',
'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
'Donec eget enim egestas, pulvinar nulla non, mollis risus. In id ipsum ex. Morbi laoreet dui feugiat enim dapibus rhoncus. Curabitur mollis velit accumsan ex suscipit fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur quis fermentum nibh. Aenean eget tellus eu ligula hendrerit dapibus vitae at leo. Vivamus at ligula non purus iaculis eleifend. Integer eget risus non dui scelerisque consectetur. Quisque et leo ut ex lacinia malesuada dictum vitae diam. Integer eleifend in nibh in mattis. Aenean eu justo quis mauris tempus eleifend. Praesent malesuada turpis ut justo semper tempor. Integer varius, nisi non elementum molestie, leo arcu euismod velit, eu tempor ligula diam convallis sem. Sed ultrices hendrerit suscipit. Pellentesque volutpat a urna nec placerat. Etiam auctor dapibus leo nec ullamcorper. Nullam id placerat elit. Vivamus ut quam a metus tincidunt laoreet sit amet a ligula. Sed rutrum felis ipsum, sit amet finibus magna tincidunt id. Suspendisse vel urna interdum lacus luctus ornare. Curabitur ultricies nunc est, eget rhoncus orci vestibulum eleifend. In in consequat mi. Curabitur sodales magna at consequat molestie. Aliquam vulputate, neque varius maximus imperdiet, nisi orci accumsan risus, sit amet placerat augue ipsum eget elit. Quisque sodales orci non est tincidunt tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In ut diam in dolor ultricies accumsan sit amet eu ex. Pellentesque aliquet scelerisque ullamcorper. Aenean porta enim eget nisl viverra euismod sed non eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at imperdiet sem, non volutpat metus. Phasellus sed velit sed orci iaculis venenatis ac id risus.');*/
           //$data;
         $words2=10;
function getIndianCurrency( $number)
{
    $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_1 ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
   // $points = ($point) ?"." . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
    
   return $result . "Rupees Only";
}

           
           
            foreach($company as $value){
                $name=$value->name;
                $address=$value->address;
                $email=$value->email;
                $mobile=$value->mobile;
                $gstno=$value->gstno;
                $bank_name=$value->bank_name;
                $branch_name=$value->branch_name;
                $acno=$value->acno;
                $ifsc=$value->ifsc;
            }

            foreach($master_data as $valuem){
                $cname=$valuem->name1;
                $caddress=$valuem->address1;
                $mobilenm=$valuem->mobilenm;
                $invoice_no=$valuem->invoice_no;
                $invoice_date=$valuem->invoice_date;
                $total=$valuem->total;
                $cgst=$valuem->cgst;
                $sgst=$valuem->sgst;
                $gstin=$valuem->gstin;
                $dis_plus=$valuem->dis_plus;
              
            }
           
           
                $pdf=new exFPDF();
                $pdf->AddPage();
                $pdf->SetXY(0,5);

                $pdf->SetFont('helvetica', '', 10);
                $pdf->AddFont('helvetica', '', 'helvetica.php');
                $pdf->AddFont('helvetica', 'B', 'helveticab.php');
                $pdf->AddFont('helvetica', 'I', 'helveticai.php');
                $pdf->AddFont('helvetica', 'BI', 'helveticabi.php');
               


             /*   $pdf->AddPage("p","A4"); 
            $pdf->SetXY(0,5);
            $pdf->SetMargins(5,5,5);
            $pdf->SetAutoPageBreak(false);
            $pdf->SetFont('helvetica','',10);*/

                $table=new easyTable($pdf, '{10,40, 80, 50}', 'width:180; border-color:#000000; font-size:10; paddingY:2;');

                $table->easyCell('', 'img:assets/images/logo_icon.png,w35; align:C; rowspan:6; border:LT;');
                $table->easyCell('', 'img:assets/images/logo_text.png,w35; align:C; rowspan:6; border:T;');
                $table->easyCell("", ' align:L; border:T; font-size:10;');
                $table->easyCell("Origional Copy", ' align:R;   font-size:10; border:RT; font-style:B; ');
                $table->printRow();

 
                $table->easyCell("TAX INVOICE", ' align:C;   font-size:11; font-style:BU; ');
                $table->easyCell("", ' align:L; border:R; font-size:11;');
                $table->printRow();

                $table->easyCell("$name", ' align:C;   font-size:16; font-style:B; ');
                $table->easyCell("", ' align:L; border:R; font-size:16;');
                $table->printRow();

                $table->easyCell("$address", ' align:C;   font-size:10; font-style:B; ');
                $table->easyCell("", ' align:L; border:R; font-size:10;');
                $table->printRow();

                $table->easyCell("GSTIN : $gstno", ' align:C;   font-size:10; font-style:B; ');
                $table->easyCell("", ' align:L;border:R; font-size:10;');
                $table->printRow();

                $table->easyCell("Mo. : $mobile   Email : $email", ' align:C;   font-size:9; font-style:B; ');
                $table->easyCell("", ' align:L; border:R; font-size:10;');
                $table->printRow();
                $table->endTable(0);

                $table=new easyTable($pdf, '{10, 37, 12, 12, 12,12, 13, 13, 13, 13, 13, 20}', 'width:180; border-color:#000000; font-size:10; paddingY:2;');
                $table->easyCell("Party Details :\n $cname \n $caddress\n\n", 'align:L; colspan:6;font-style:B;  border:LRT;');
                $table->easyCell("Invoice No.\nDated", ' align:L; colspan:2;border:LT; font-style:B; font-size:10;');
                $table->easyCell(": $invoice_no\n: $invoice_date", ' align:L; colspan:4; border:RT;font-style:B; font-size:10;');
                $table->printRow();

                $table->easyCell("Mobile No : $mobilenm\nGSTIN/UIN : $gstin", 'align:L;colspan:6; font-style:B;  border:LR;');
                $table->easyCell("", ' align:L; colspan:2;border:L; font-style:B; font-size:10;');
                $table->easyCell("", ' align:L; colspan:4; border:R;font-style:B; font-size:10;');
                $table->printRow();
 
                $table->easyCell("S N", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Description of Goods", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Unit", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Qty.", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Price", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Dis. Rate", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Dis. Amount", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("CGST Rate", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("CGST Amount", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("SGST Rate", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("SGST Amount", 'border:1; align:C; font-size:8; font-style:B;');
                $table->easyCell("Amount( )", 'border:1; align:C; font-size:8; font-style:B;');
                $table->printRow();
                
                $sr=1;
              $num=0;
              $tot_qty=0;
              $tot_cgst=0;
              $tot_sgst=0;
              $tot_rate=0;
              $tot_dis=0;
                foreach($sales_data as $row){ 
                    
                        $mrp= $row->mrp;
                        $item_name= $row->item_name;
                        $brand_masternm= $row->brand_masternm;
                        $qty= $row->qty;
                        $cgst= $row->cgst;
                        $sgst= $row->sgst;
                        $dis=$row->dis;

                        $totalamt =  floatval($mrp) * floatval($qty);
                        $totalamt=round($totalamt);
                        $tot_discount =floatval($totalamt) * floatval($dis) / 100;
                        $tot_discount=round($tot_discount);
                        $totamt= floatval($totalamt) -floatval($tot_discount);
                        $totamt=round($totamt);
                        $cgstamt = floatval($totamt) * floatval($cgst) / 100;
                        $cgstamt=round($cgstamt);
                        $sgstamt = floatval($totamt) * floatval($sgst) / 100;
                        $sgstamt=round($sgstamt);
                        $total_amount =floatval($totamt)+floatval($cgstamt)+floatval($sgstamt); 
                        $total_amount=round($total_amount);
                        $num=floatval($num)+floatval($total_amount); 
                        $tot_qty=floatval($tot_qty)+floatval($qty); 
                        $tot_cgst=floatval($tot_cgst)+floatval($cgstamt); 
                        $tot_sgst=floatval($tot_sgst)+floatval($sgstamt);
                        $tot_rate=floatval($tot_rate)+floatval($mrp); 
                        $tot_dis=floatval($tot_dis)+floatval($tot_discount); 

                $table->easyCell("$sr", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("$item_name\n$brand_masternm", 'border:LR; align:L; font-size:8; font-style:B;');
                $table->easyCell("Pcs", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("$qty", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("$mrp", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("$dis%", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("$tot_discount", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("$cgst%", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("$cgstamt", 'border:LR; align:R; font-size:8; font-style:B;');          
                $table->easyCell("$sgst%", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("$sgstamt", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("$total_amount", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->printRow();
                $sr=$sr+1;  
            }
            

                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:L; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->printRow();

                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:L; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:C; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->easyCell("", 'border:LR; align:R; font-size:8; font-style:B;');
                $table->printRow();

            
        $table->easyCell("", 'border:1; colspan:12; align:R; font-size:8; font-style:B;');
        $table->printRow();

        
        $table->easyCell("Total Amount", 'border:LR; colspan:3; align:C; font-size:10; font-style:B;');
        $table->easyCell("$tot_qty", 'border:LR; align:C; font-size:8; font-style:B;');
        $table->easyCell("$tot_rate", 'border:LR;  align:R; font-size:8; font-style:B;');
        $table->easyCell("", 'border:L; align:R; font-size:8; font-style:B;');
        $table->easyCell("$tot_dis", 'border:R; align:R; font-size:8; font-style:B;');
        $table->easyCell("", 'border:L; align:C; font-size:8; font-style:B;');
        $table->easyCell("$tot_cgst", 'border:R; align:R; font-size:8; font-style:B;');
        $table->easyCell("", 'border:L; align:C; font-size:8; font-style:B;');
        $table->easyCell("$tot_sgst", 'border:R; align:R; font-size:8; font-style:B;');
        $table->easyCell("$num", 'border:LR; align:R; font-size:8; font-style:B;');
        $table->printRow();

        $table->easyCell("", 'border:1; colspan:12; align:R; font-size:8; font-style:B;');
        $table->printRow();
        $table->endTable(0);

                            $tot_disa =floatval($num) * floatval($dis_plus) / 100;
                            $tot_disa=round($tot_disa);         
                            $g_tot= floatval($num) -floatval($tot_disa);
                            $g_tot=round($g_tot);

        $table=new easyTable($pdf, '{36, 36, 36, 36, 36}', 'width:180; border-color:#000000; font-size:10; paddingY:2;');
        $table->easyCell("Grand Total", 'border:LR;  align:C; rowspan:2; font-size:12; font-style:B;');
        $table->easyCell("Total Amount", 'border:LRB; align:C; font-size:8; font-style:B;');
        $table->easyCell("Discount", 'border:LRB;  align:C; font-size:8; font-style:B;');
        $table->easyCell("Discount Amount", 'border:LB; align:C; font-size:8; font-style:B;');
        $table->easyCell("$g_tot", 'border:LR;rowspan:2;  align:C; font-size:12; font-style:B;');
        $table->printRow();

               

      
        $table->easyCell("$num", 'border:LR; align:C; font-size:8; font-style:B;');
        $table->easyCell("$dis_plus%", 'border:LR;  align:C; font-size:8; font-style:B;');
        $table->easyCell("$tot_disa", 'border:L; align:C; font-size:8; font-style:B;');
      $table->printRow();

        $table->endTable(0);


        $table=new easyTable($pdf, '{18, 18, 18, 18, 18, 90}', 'width:180; border-color:#000000; font-size:10; paddingY:2;');
      /*  $table->easyCell("Tax Rate", 'border:LB;  align:L; font-size:8; font-style:B;');
        $table->easyCell("Total Amt.", 'border:B;  align:R; font-size:8; font-style:B;');
        $table->easyCell("CGST", 'border:B;  align:R; font-size:8; font-style:B;');
        $table->easyCell("SGST", 'border:B;  align:R; font-size:8; font-style:B;');
        $table->easyCell("Total Tax", 'border:BR;  align:R; font-size:8; font-style:B;');
        $table->easyCell("", 'border:R; colspan:6; align:R; font-size:8; font-style:B;');
        $table->printRow();
 
        $table->easyCell("18%", 'border:L;  align:L; font-size:8; font-style:B;');
        $table->easyCell("7,923.76", '  align:R; font-size:8; font-style:B;');
        $table->easyCell("$cgst", '  align:R; font-size:8; font-style:B;');
        $table->easyCell("$sgst", '  align:R; font-size:8; font-style:B;');
        $table->easyCell("1,426.24", ' border:R;  align:R; font-size:8; font-style:B;');
        $table->easyCell("", 'border:R; colspan:6; align:R; font-size:8; font-style:B;');
        $table->printRow();

        $table->easyCell("", 'border:RLT; colspan:6; align:R; font-size:8; font-style:B;');
        $table->printRow();*/

        $add=getIndianCurrency($g_tot);
       
        $table->easyCell("Rupees", 'border:LBT; align:L; font-size:8; font-style:B;');
        $table->easyCell("$add", 'border:RBT; colspan:5; align:L; font-size:12; font-style:B;');
        $table->printRow();

        $table->endTable(0);

        $table=new easyTable($pdf, '{30,50,10, 45,45}', 'width:180; border-color:#000000; font-size:10; paddingY:2;');
        $table->easyCell("BANK DETAILS", 'border:L;colspan:2; align:L; font-size:10; font-style:BU;');
        $table->easyCell("", ' border:L;  font-size:10; align:R; ');
        $table->easyCell("Terms & Conditions", 'border:R; colspan:2; align:L; font-size:10; font-style:BU;');
        $table->printRow();

        $table->easyCell("BANK NAME\nA/c TYPE\nAccount NAME\nIFSC CODE\nA/c NO.\nBRANCH NAME", 'border:L; align:L; font-size:8; font-style:B;');
        $table->easyCell(":- $bank_name\n:- CURRENT ACCOUNT\n:- $name\n:- $ifsc\n:- $acno\n:- $branch_name", 'align:L; font-size:8; font-style:B;');
        $table->easyCell("", ' border:L;  font-size:10; align:R; ');
        $table->easyCell("1.Goods once sold will not be taken back.\n2.Intrest @ 18% p.a. will be charged if the payment.\nis not made with the suplied time.\n3.Subject to 'Maharashtra' junction only.", 'border:R; colspan:2; align:L; font-size:8; font-style:B;');
        $table->printRow();

        $table->easyCell("Receiver's Signature :", 'border:LT;colspan:2; align:L; font-size:10; font-style:B;');
        $table->easyCell("", ' border:LT;  font-size:10; align:R; ');
        $table->easyCell("", ' border:T;  font-size:10; align:R; ');
        $table->easyCell("$name", 'border:RT; align:C; font-size:10; font-style:B;');
        $table->printRow();

        $table->easyCell("", 'border:L;colspan:2; align:L; font-size:10; font-style:B;');
        $table->easyCell("", ' border:L;  font-size:10; align:R; ');
        $table->easyCell("", '   font-size:10; align:R; ');
        $table->easyCell("", 'border:R; align:C; font-size:10; font-style:B;');
        $table->printRow();

        $table->easyCell("", 'border:L;colspan:2; align:L; font-size:10; font-style:B;');
        $table->easyCell("", ' border:L;  font-size:10; align:R; ');
        $table->easyCell("", '   font-size:10; align:R; ');
        $table->easyCell("", 'border:R; align:C; font-size:10; font-style:B;');
        $table->printRow();

        $table->easyCell("", 'border:LB;colspan:2; align:L; font-size:10; font-style:B;');
        $table->easyCell("", ' border:LB;  font-size:10; align:R; ');
        $table->easyCell("", '  border:B; font-size:10; align:R; ');
        $table->easyCell("Authorised Signatory", 'border:RB; align:L; font-size:10; font-style:B;');
        $table->printRow();
        $table->endTable(10);



        $pdf->Output(); 
     
    

?>