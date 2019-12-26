$(document).ready(function() {
    var table_name="purchasereturn_master";
    datashow();
    $('#form').hide();
	var validate=0;
    var check=0;
    datashow();
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        buttons: [
           {
                title: tit,
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11, 12, 13, 14, 15]
                }
            }
        ]
    });
	$(document).on('click','#btnadd',function(){
		//alert("HII");	
		$('#form').show();
		$('#tbl').hide();		
		$('#column').hide();
	});
	$(document).on('click','#btncancel',function(){
		//alert("HII");	
		$('#form').hide();
		$('#tbl').show();
        $('#column').show();
        $('#payment')[0].reset();
        $('#purchbody').html('');
        $('.date').datepicker({
            'todayHighlight':true,
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
     var date = new Date();
         date = date.toString('dd/MM/yyyy');
        $("#bill_date").val(date);
        $("#entry_date").val(date);
        $('#saveid').val('');
        $('#save_update').val('')
	});
    
  /*----------submite Payment Data--------*/  
    $(document).on('submit','#payment', function(e){
        e.preventDefault();
       // alert('hii');
        var id=$('#saveid').val();
        var billno=$('#bill_no').val();
        var date=$('#bill_date').val();
        var entyno=$('#entry_no').val();
        var entrydate=$('#entry_date').val();
        var supplier=$('#supplier').val();
        var invoice_no=$('#invoice_no').val();
        var address=$('#address').val();
        var mobileno=$('#mobile_no').val();
        var bill_amt=$('#total_amount').val();
        var dis_per=$('#discount_less') .val();
        var dis_plus=$('#discountless').val();
        var gstt=$('#gstt').val();
        var paid=$('#paid_rs').val();

        var tdateAr = date.split('/');
        var   date1 = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];  
    
        var tdateAr = entrydate.split('/');
        var entrydate1 = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];  
        $.ajax({
            type: "POST",
            url: base_url + "Controller/adddata",
            data: { table_name: table_name,
                id:id,
                billno:billno,
                date:date1,
                entyno:entyno,
                entrydate:entrydate1,
                address:address,
                mobileno:mobileno,
                supplier:supplier,
                invoice_no:invoice_no,
                bill_amt:bill_amt,
                dis_per:dis_per,
                dis_plus:dis_plus,
                gstt:gstt,
                paid:paid
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var parid;
                if(id!=""){
                    parid=id;
            }else{
                parid=data; 
            }
           // alert(parid);
                var r1 = $('table#purchase_bill').find('tbody').find('tr');
                var r = r1.length;
                var tr="";                           
                for(var i=0;i<r;i++)
                {                             
                    groupid = $(r1[i]).find('td:eq(0)').html();
                    itemid = $(r1[i]).find('td:eq(1)').html();
                    mrp = $(r1[i]).find('td:eq(5)').html();
                    qty = $(r1[i]).find('td:eq(6)').html();
                    dis= $(r1[i]).find('td:eq(7)').html();
                    gst = $(r1[i]).find('td:eq(8)').html();
                    total= $(r1[i]).find('td:eq(11)').html();
                    returnid = invoice_no;
                    //alert(returnid);
                    $.ajax({
                        type : "POST",
                        url  :  base_url+"Controller/adddata",
                        dataType : "JSON",
                        async : false,
                        data : {
                            proid:parid,
                            groupid:groupid,
                            itemid:itemid,
                            mrp:mrp,
                            dis:dis,
                            qty:qty,
                            gst:gst,
                            total:total, 
                            returnid:returnid,
                            
                            table_name:'purchasereturndetails',
                        },
                        success: function(data){                                        
                        }
                    });													
                }
                successTost("Operation Successfull");
            },
            error:function(){
                errorTost("Operation Failed");
            }
        });
        $('#form').hide();
		$('#tbl').show();
        $('#column').show();
        $('#payment')[0].reset();
        $('#purchbody').html('');
        $('#saveid').val('');
        datashow();
    });
    /*----------End Of Data------------*/
    $(document).on("change",".brand",function(e){
        e.preventDefault();
          var  id1=$(this).val();          

            getitemname("item_master",'#item_name',"company="+id1+"");
    });
    $(document).on("change",".suppliernm",function(e){
        e.preventDefault();
          var  id1=$(this).val();          

            getsuppiler("supplier_master","id="+id1+"");
            getitemname("paychasebill_master",".invoice","supplierid="+id1+"");

    });
    $(document).on("change","#item_name",function(e){
        e.preventDefault();
            var idda=$(this).val();          

            getmrp("item_master","id="+idda+"");
           // getgst("item_master","id="+idda+"");
    });
    function getitemname(table_name, selecter,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
            //  alert("HII");
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>';
                for (i = 0; i < data.length; i++) {
                    var id = '';
                   if(table_name=="paychasebill_master"){
                    name = data[i].billno;
                    id = data[i].id;
                   }else{
                    name = data[i].item_name;
                    id = data[i].id;
                }
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            },
            error:function(){

            }
            
        });
    }
    function getsuppiler(table_name,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
                    $('#address').val(data[0].address);
                    $('#mobile_no').val(data[0].mobile);
            },
            error:function(){

            }
            
        });
    }
    $(document).on("blur","#barcode",function(e){
        e.preventDefault();
        //alert("HII");
            var idda=$("#barcode").val();     
            var table_name="item_master";
            //alert(idda);
            $.ajax({
                type: "POST",
                url: base_url + "Controller/getdata",
                data: { table_name:table_name ,
                        where:"barcode="+idda,
                 },
                dataType: "JSON",
                async: false,
                success: function(data) {
                       //alert('Success');
                       $('#mrp').val(data[0].mrp);
                       $('#gst').val(data[0].gst);
                       $('#brand').val(data[0].company).trigger('change');
                       $('#item_name option:selected').text(data[0].item_name);
                },
                error:function(){
                    errorTost('Error');
                }
                
            });
    });
    function getmrp(table_name,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
                    $('#mrp').val(data[0].mrp);
                    $('#gst').val(data[0].gst);
                    $('#barcode').val(data[0].barcode);
            },
            error:function(){

            }
            
        });
    }
   
    function getgst(table_name,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
                    $('#gst').val(data[0].gst);
            },
            error:function(){

            }
            
        });
    }
    $(document).on("blur","#gst",function(e){
        e.preventDefault();
        var total=1;
         var mrp=  $('#mrp').val();
        var qty=$('#qty').val();
        var gst=  $('#gst').val();
        var discoutn=$('#discount').val();
       
         total=parseFloat(mrp)* parseFloat(qty);
         
       var dis=parseFloat(total)*parseFloat(discoutn)/100;
      
      var totaldata=parseFloat(total)-parseFloat(dis);
       var gst=parseFloat(totaldata)*parseFloat(gst)/100;
      
        var totalamt= parseFloat(totaldata)+parseFloat(gst);
        $('#total').val(totalamt.toFixed(2));
    });
    $(document).on("blur","#paid_rs",function(e){
        e.preventDefault();
        var balance= $('#total_amount').val();
        var paid=$('#paid_rs').val();
        var total=parseFloat(balance)-parseFloat(paid);
        $('#Balance').val(total);
        //getfinal();
    });
    $(document).on("blur","#discountless",function(e){
        e.preventDefault();
        var total=0;
        var amt=  $('#bill_amount').val();
        var discoutn=$('#discountless').val();
        var discountamt= $('#disc_amount').val();
        var dis_plus=parseFloat(amt)*discoutn/100;
        var disdata= parseFloat(discountamt)+parseFloat(dis_plus);
        total=parseFloat(amt)-parseFloat(dis_plus);
        $('#disc_amount').val(disdata.toFixed(2));
        total=Math.round(total);
        $('#total_amount').val(total.toFixed(2));
      
    });
    
    /*------ add data in purchase Table------------*/
    var sr=1;  
    $(document).on("click","#add",function(){        
         
        var batchvalue=0;
        var table="";
        var serialno=0;
        var groupname=$("#brand option:selected").text();
        var groupid = $("#brand").val();
        var item_id = $("#item_name").val();
        var mrp=$('#mrp').val();
        var qty=$('#qty').val();
        var discount=$('#discount').val();
        var gst=$('#gst').val();
        var total=$('#total').val();             
        var item_name=$("#item_name option:selected").text(); 
        var save_update = $('#save_update').val();	   
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length; 
        var totaldata=1;
        var totalamt=parseFloat(mrp)* parseFloat(qty);
        var disamt=parseFloat(totalamt)*parseFloat(discount)/100;
        var totaldata=parseFloat(totalamt)-parseFloat(disamt);
        var gstamt=parseFloat(totaldata)*parseFloat(gst)/100;
      

        if(save_update==""){
            for(var i=0;i<r;i++)
            {  
                var col=$(r1[i]).find('td:eq(1)').html();
                //alert(col);
                
                if(col == item_id)
                {
                    serialno=$(r1[i]).find('td:eq(11)').html();
                    batchvalue = 1;
                }
            }
        }
        if(batchvalue > 0){
            swal({
                title: "Please Not Add Same Brand?",
                text: "You will Not Add Same Brand And Same Item!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
                });
                batchvalue=0;
        }
    
       else if(save_update!="" && groupid!="" && item_id!="" ){
                       
            $("#groupid_"+save_update).html(groupid);
            $("#itemid_"+save_update).html(item_id);
            $("#groupname"+save_update).html(groupname);
            $("#itemname"+save_update).html(item_name);
            $("#mrp"+save_update).html(mrp);
            $("#qty_"+save_update).html(qty);
            $("#discount_"+save_update).html(discount);
            $("#gst_"+save_update).html(gst);
            $("#discountamt_"+save_update).html(disamt);
            $("#gstamt_"+save_update).html(gstamt);
            $("#total_"+save_update).html(total);
            $("#sr_"+save_update).html(save_update);
           
            $('#save_update').val('');
               
           
        }
         else{                
            if(groupid!="" && item_id!="" ){       
            
                var markup = '<tr>'+
                '<td id="groupid_'+sr+'" style="display:none;" >'+groupid+'</td>'+
                '<td id="itemid_'+sr+'"  style="display:none;">'+item_id+'</td>'+
                '<td>   </td>'+
                '<td id="groupname'+sr+'">'+groupname+'</td>'+
                '<td id="itemname'+sr+'">'+item_name+'</td>'+
                '<td id="mrp'+sr+'">'+mrp+'</td>'+
                '<td id="qty_'+sr+'">'+qty+'</td>'+
                '<td id="discount_'+sr+'" style="display:none;">'+discount+'</td>'+
                '<td id="gst_'+sr+'" style="display:none;" >'+gst+'</td>'+
                '<td id="discountamt_'+sr+'" >'+disamt+'</td>'+
                '<td id="gstamt_'+sr+'" >'+gstamt+'</td>'+
                '<td id="total_'+sr+'">'+total+'</td>'+
                '<td hidden id="'+sr+'">'+sr+'</td>'+
                '<td><button type="button" name="edit" class="edit_data_pur btn btn-xs btn-success" id="'+sr+'"><i class="fa fa-edit"></i></button>  <button name="delete" value="Delete" class="btn btn-xs dele_data btn-danger" ><i class="fa fa-trash"></i></button></td>'+
                '</tr>';
                sr=sr+1;
                $("#purchbody").append(markup);       
            }
            else{
                errorTost("please select Brand and Item");
            }
         }
         $('#barcode').val('');
         $("#brand").val('');
         $("#item_name").val('');
         $('#mrp').val(''); 
         $('#qty').val('');
         $('#discount').val('');
         $('#gst').val('');
         $('#total').val('');
        gettotal();
        getgst1();
        getdis();
        getdisamt();
        getgstdata();

      
    }); 

    /*-----------delete a Row Of purchase_bill table-----------------------*/
    $(document).on("click",".dele_data",function(e){
        var tr="";                           
        var id1= $(this).parents("tr").remove(); 
        gettotal();
    }); 
    $(document).on("click",".edit_data_pur",function(e){
        var id1 = $(this).attr('id');
        var groupid_=$('#groupid_'+id1).html();
        var itemid_=$('#itemid_'+id1).html();
        var mrp=$('#mrp'+id1).html();
        var qty_=$('#qty_'+id1).html();
        var discount_=$('#discount_'+id1).html();
        var gst=$('#gst_'+id1).html();
        var total=$('#total_'+id1).html();
        $('#save_update').val(id1);

        $("#brand").val(groupid_).trigger('change');
        $("#item_name").val(itemid_).trigger('change');
        $('#mrp').val(mrp);
        $('#qty').val(qty_);
        $('#discount').val(discount_);
        $('#gst').val(gst);
        // total=Math.toFixed(2);
        $('#total').val(total); 
     });


     /*--------- Calculate Total Amt ------------------*/
function gettotal()
{   
    var r1 = $('table#purchase_bill').find('tbody').find('tr');
    var r = r1.length;
    var tr="";
    var totalamt=0;                          
    var total=0;
    for(var i=0;i<r;i++)
    {                             
        var sr = i+1;
        total= $(r1[i]).find('td:eq(11)').html();
        totalamt=parseFloat(totalamt)+ parseFloat(total);                               
    }
    //Math.round(totalamt);
    totalamt=totalamt.toFixed(2);
    $('#bill_amount').val(totalamt);
    totalamt=Math.round(totalamt);
    $('#total_amount').val(totalamt.toFixed(2));
    

}
function getfinal()
{
    var dis=$('#disc_amount').val();
    var gst=$('#gst_amount').val();
    var tot=$('#bill_amount').val();
    var final=parseFloat(tot)-parseFloat(dis)+parseFloat(gst);
    final=Math.round(final);
    $('#total_amount').val(final.toFixed(2));
}
function getdis()
{   
    var r1 = $('table#purchase_bill').find('tbody').find('tr');
    var r = r1.length;
    var tr="";
    var totalamt=0;                          
    var total=0;
    for(var i=0;i<r;i++)
    {                             
        var sr = i+1;
        total= $(r1[i]).find('td:eq(7)').html();
        totalamt=parseFloat(totalamt)+ parseFloat(total);                               
    }
  
    
    $('#discount_less').val(totalamt);
}   
function getgstdata()
{   
    var r1 = $('table#purchase_bill').find('tbody').find('tr');
    var r = r1.length;
    var tr="";
    var totalamt=0;                          
    var total=0;
    for(var i=0;i<r;i++)
    {                             
        var sr = i+1;
        total= $(r1[i]).find('td:eq(8)').html();
        totalamt=parseFloat(totalamt)+ parseFloat(total);                               
    }
  
    
    $('#gstt').val(totalamt);
}
function getdisamt()
{   
    var r1 = $('table#purchase_bill').find('tbody').find('tr');
    var r = r1.length;
    var tr="";
    var totalamt=0;                          
    var total=0;
    for(var i=0;i<r;i++)
    {                             
        var sr = i+1;
        total= $(r1[i]).find('td:eq(9)').html();
        totalamt=parseFloat(totalamt)+ parseFloat(total);                               
    }
                       
     $('#disc_amount').val(totalamt);
}     
function getgst1()
{   
    var r1 = $('table#purchase_bill').find('tbody').find('tr');
    var r = r1.length;
    var tr="";
    var totalamt=0;                          
    var total=0;
    for(var i=0;i<r;i++)
    {                             
        var sr = i+1;
        total= $(r1[i]).find('td:eq(10)').html();
        totalamt=parseFloat(totalamt)+ parseFloat(total);                               
    }
    Math.round(totalamt);
   
    $('#gst_amount').val(totalamt);
}    
datashow();
function datashow(){
  var where="";
    $.ajax({
        type:"POST",
        url:base_url+"Controller/showallreturn",
        data:{		
            table_name: table_name,
            where:where,
        },
        dataType:"JSON",
        async:false,
        success: function(data){
            var data=eval(data);
            //alert(data[0].billno);
            console.log(data);
            $('#show_master').html('');
            var html="";
            
            html += '<table id="myTable" class="table table-striped" style="width:100%;">'+
                    '<thead>'+
                    '<tr>'+
                        '<th>Sr no</th>'+
                        '<th style="display:none;">Id</th>'+
                        '<th >Bill No</th>'+
                        '<th>Bill Date</th>'+
                        '<th style="display:none;"> Supplier Id</th>'+
                        '<th> Supplier Name</th>'+
                        '<th> Entry No.</th>'+
                        '<th> Entry Date</th>'+
                       '<th> Address</th>'+
                        '<th>Mobile No</th>'+
                        '<th>Invoice No</th>'+
                        '<th>Bill Amount</th>'+
                        '<th style="display:none;">Dis Per</th>'+
                        '<th style="display:none;">Dis Plus</th>'+
                        '<th style="display:none;">Gst</th>'+
                        '<th style="display:none;">Paid</th>'+
                        '<th>Action</th>'+
                    '</tr>'+
                    '</thead>'+
                    '<tbody>';  var index =1;
                    for(var i=0;i<data.length;i++)
                    {
                        
                        var tdateAr = data[i].billdate.split('-');
                        date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
                        
                        var tdateAr = data[i].entrydate.split('-');
                        edate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
                        html+='<tr>'+
                        '<td>'+index+'</td>'+
                        '<td style="display:none;" id="id'+data[i].id+'">'+data[i].id+'</td>'+
                        '<td id="billno_'+data[i].id+'">'+data[i].billno+'</td>'+
                        '<td id="billdate'+data[i].id+'">'+date+'</td>'+
                        '<td style="display:none;" id="supplierid_'+data[i].id+'">'+data[i].supplier+'</td>'+
                        '<td  id="suppliernm_'+data[i].id+'">'+data[i].supplernm+'</td>'+
                        '<td id="entryno_'+data[i].id+'">'+data[i].entryno+'</td>'+
                        '<td id="entrydate_'+data[i].id+'">'+edate+'</td>'+
                        '<td id="address_'+data[i].id+'">'+data[i].address+'</td>'+
                        '<td id="mobileno_'+data[i].id+'">'+data[i].mobileno+'</td>'+
                        '<td id="invoiceno_'+data[i].id+'">'+data[i].invoiceno+'</td>'+
                        '<td id="totalamount_'+data[i].id+'">'+data[i].totalamount+'</td>'+
                        '<td hidden id="dis_per'+data[i].id+'">'+data[i].dis_per+'</td>'+
                        '<td hidden id="dis_less'+data[i].id+'">'+data[i].dis_plus+'</td>'+
                        '<td hidden id="paid'+data[i].id+'">'+data[i].paid+'</td>'+
                        '<td hidden id="gst'+data[i].id+'">'+data[i].gst+'</td>'+
                        '<td><button type="button" name="edit" class="edit_data btn  btn-xs btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class="btn delete_data btn-xs   btn-danger" id="'+data[i].id+'"><i class="fa fa-trash"></i></button></td>'+
                        '</tr>' ;
                        index+=1;
                    }
                    html += '</tbody></table>';
                    $('#show_master').html(html);
                  
           
        }
    });
}
$(document).on('click','.edit_data',function(e){
    e.preventDefault();
    $('#form').show();
    $('#tbl').hide();
    $('#column').hide();
        var sr=0;
    var id1 = $(this).attr('id');
    var billno= $('#billno_'+id1).html();
    var billdate=$('#billdate'+id1).html();
    var supplierid=$('#supplierid_'+id1).html();
   // alert('supplier'+supplierid);
    var entryno=$('#entryno_'+id1).html();
    var entrydate=$('#entrydate_'+id1).html();
    var address=$('#address_'+id1).html();
    var mobileno=$('#mobileno_'+id1).html();
    var totalamount=$('#totalamount_'+id1).html();
    var dis_per=$('#dis_per'+id1).html();
    var dis_less=$('#dis_less'+id1).html();
    var gst=$('#gst'+id1).html();
    var paid=$('#paid'+id1).html();
    var invoiceno=$('#invoiceno_'+id1).html();
  
//	console.log(id+"/"+name+"/"+address+"/"+mobile+"/"+email+"/"+age+"/"+gender);
    
    $('#saveid').val(id1);
    $('#bill_no').val(billno);
    $('#bill_date').val(billdate);
    $('#entry_no').val(entryno);
    $('#entry_date').val(entrydate);
    $('#supplier').val(supplierid).trigger('change');
    $('#address').val(address);
    $('#mobile_no').val(mobileno);
    $('#invoice_no').val(invoiceno).trigger('change');
    $('#bill_amount').val(totalamount);
    $('#discount_less').val(dis_per);
    $('#discountless').val(dis_less);
    $('#gstt').val(gst);
    $('#paid_rs').val(paid);
    where="purretid="+id1;
   //alert('where'+where);
    $.ajax({
        type:"POST",
        url:base_url+"Controller/showallreturn",
        data:{		
            table_name:'purchasereturndetails',
            where:where
        },
        dataType:"JSON",
        async:false,
        success: function(data){
            console.log(data);
            var markup="";
            var totaldata=0;
            var disamt=0,disamt1=0;
            var totalamt=0;
            var gstamt=0,gstamt1=0;
            var total1=0,total=0;disless1=0;finalDisamt=0;
            var dis_less=$('#discountless').val();
            for(i=0;i<data.length; i++){
                sr=sr+1;
                var mrp=data[i].mrp;
                var qty=data[i].qty;
                sr=sr+1;
                totalamt=parseFloat(mrp)* parseFloat(qty);
                disamt=parseFloat(totalamt)*parseFloat(data[i].discount)/100;
                disamt1=disamt+disamt1;
                disless=parseFloat(totalamt)*parseFloat(dis_less)/100;
                disless1=disless1+disless;
                finalDisamt=disamt1+disless1;
                totaldata=parseFloat(totalamt)-parseFloat(disamt);
                gstamt=parseFloat(totaldata)*parseFloat(data[i].gst)/100; 
                gstamt1=gstamt+gstamt1;
                total=totaldata+gstamt;
                total=Math.round(total);
                total1=total+total1;
                $('#disc_amount').val(finalDisamt.toFixed(2));
                $('#gst_amount').val(gstamt1.toFixed(2));
                $('#bill_amount').val(total1.toFixed(2));0; 

                /*$('#disc_amount').val(disamt);
                $('#gst_amount').val(gstamt);*/
            markup += '<tr>'+

            '<td id="groupid_'+sr+'" style="display:none;" >'+data[i].groupid+'</td>'+
            '<td id="itemid_'+sr+'"  style="display:none;">'+data[i].itemid+'</td>'+
            '<td>   </td>'+
            '<td id="groupname'+sr+'">'+data[i].brand_masternm+'</td>'+
            '<td id="itemname'+sr+'">'+data[i].item_name+'</td>'+
            '<td id="mrp'+sr+'">'+data[i].mrp+'</td>'+
            '<td id="qty_'+sr+'">'+data[i].qty+'</td>'+
            '<td id="discount_'+sr+'" style="display:none;" >'+data[i].discount+'</td>'+
            '<td id="gst_'+sr+'" style="display:none;" >'+data[i].gst+'</td>'+
            '<td id="discountamt_'+sr+'" >'+disamt+'</td>'+
            '<td id="gstamt_'+sr+'" >'+gstamt+'</td>'+
            '<td id="total_'+sr+'">'+data[i].total+'</td>'+
            '<td hidden id="sr_'+sr+'">'+sr+'</td>'+
           '<td><button type="button" name="edit" class="edit_data_pur btn  btn-xs           btn-success" id="'+sr+'"><i class="fa fa-edit"></i></button>  <button name="delete" value="Delete" class="dele_data btn  btn-xs           btn-danger" ><i class="fa fa-trash"></i></button></td>'+
            '</tr>';
           
            $("#purchbody").html(markup);       
          //  gettotal();
          
            }
        }
    });
    getamtdata();
    
});

//Delete Data code starts here
$(document).on('click','.delete_data',function(){
    var id1 = $(this).attr('id');
    $('#saveid').val(id1);
    if (id1 != "") {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type:"post",
                        url:base_url+"Controller/deleteData",
                        dataType:"json",
                        data:{
                            id:id1,
                            table_name:table_name
                        },
                        success: function(data){
                            //alert(data);
                            swal("Deleted!", "Your Record has been deleted.", "success");
                            datashow();
                        }		
                    });
                }else {
                    swal("Cancelled", "Your record is safe :)", "error");
                }
            });
    }
    else{
        return false;
    }
});
function getamtdata(){
var total=$('#bill_amount').val();
var paid=$('#paid_rs').val();
var discountless=$('#discountless').val();
var totaldata=0;
var balance=0;
if(discountless>0){
    var totaldis=parseFloat(total)*parseFloat(discountless)/100;
    totaldata= parseFloat(total)-parseFloat(totaldis);
    balance=parseFloat(totaldata)-parseFloat(paid);
    $('#Balance').val(balance);
    totaldata=Math.round(totaldata);
    $('#total_amount').val(totaldata.toFixed(2));
}else{
balance=parseFloat(total)-parseFloat(paid);
$('#Balance').val(balance);
total=Math.round(total);
$('#total_amount').val(total.toFixed(2));
}

}
});