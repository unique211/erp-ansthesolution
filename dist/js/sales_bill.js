$(document).ready(function() {
    //alert("HII");
    var table_name = "salesbill_master";
    datashow();
    var invoice;
    var invoiceno;
    var validate = 0;
    var check = 0;
    $.ajax({
        type: "POST",
        url: base_url + "Controller/getinvoice",
        data: {
            table_name: table_name,
        },
        dataType: "JSON",
        async: false,
        success: function(data) {
            //alert(data);
            invoice = data;
            $('#inv').val(invoice);
        },
        error: function() {
            // alert("errror");
        }
    });
    // alert(invoice);
    $('#form').hide();

    $(document).on('click', '#btnadd', function() {
        //alert("HII");	
        $('#form').show();
        $('#tbl').hide();
        $('#column').hide();
        invoiceno = "INV-" + invoice;

        $('#invoice_no').val(invoiceno);
        $("#btnprint").prop('disabled', true);
    });
    $(document).on('click', '#btncancel', function() {
        //alert("HII");	
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#payment')[0].reset();
        $('#purchbody').html('');

        $('.date').datepicker({
            'todayHighlight': true,
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
        var date = new Date();
        date = date.toString('dd/MM/yyyy');
        $("#invoice_date").val(date);
        $('#saveid').val('');
        $('#btnprint').val('');
        $('#save_update').val('');
    });
    $(document).on("change", "#customer", function(e) {
        e.preventDefault();
        var id1 = $(this).val();

        getcustomer("customer_master", "id=" + id1 + "");
    });

    function getcustomer(table_name, where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: {
                table_name: table_name,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                $('#address').val(data[0].address);
                $('#mobile_no').val(data[0].mobile);
            },
            error: function() {}

        });
    }
    $(document).on("change", ".brand", function(e) {
        e.preventDefault();
        var id1 = $(this).val();

        getitemname("item_master", '#item_name', "company=" + id1 + "");
    });

    function getitemname(table_name, selecter, where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: {
                table_name: table_name,
                where: where,
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

                    name = data[i].item_name;
                    id = data[i].id;
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            },
            error: function() {

            }

        });
    }
    $(document).on("change", "#item_name", function(e) {
        e.preventDefault();
        var idda = $(this).val();
        stock();
        getmrp("item_master", "id=" + idda + "");
        //getgst("item_master","id="+idda+"");
    });

    function stock() {
        var where = $('#item_name').val();
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getStock",
            data: {
                where: where
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                $('#stock').val(data);
            },
            error: function() {
                //alert("error");
            }

        });
    }
    $(document).on("blur", "#barcode", function(e) {
        e.preventDefault();
        var idda = $("#barcode").val();
        var table_name = "item_master";
        //alert(idda);
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: {
                table_name: table_name,
                where: "barcode=" + idda,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var gst1 = data[0].gst;
                var gst = parseFloat(gst1) / 2;
                $('#mrp').val(data[0].mrp);
                $('#cgst').val(gst);
                $('#sgst').val(gst);
                $('#brand').val(data[0].company).trigger('change');
                $('#item_name option:selected').text(data[0].item_name);
            },
            error: function() {
                // alert('Error');
            }

        });
    });

    function getmrp(table_name, where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: {
                table_name: table_name,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var gst1 = data[0].gst;
                var gst = parseFloat(gst1) / 2;
                $('#mrp').val(data[0].mrp);
                $('#sgst').val(gst);
                $('#cgst').val(gst);
                $('#barcode').val(data[0].barcode);
            },
            error: function() {}
        });
    }

    function getgst(table_name, where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: {
                table_name: table_name,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data = data[0].gst;
                var gst = data / 2;
                //alert(gst);
                $('#cgst').val(gst);
                $('#sgst').val(gst);
            },
            error: function() {}
        });
    }
    /*------ add data in purchase Table------------*/
    var sr=1;  
    $(document).on("click","#add",function(e){        
        e.preventDefault();
         //alert("HII");
        var batchvalue=0;
        var table="";
        var serialno=0;
        var groupname=$("#brand option:selected").text();
        var groupid = $("#brand").val();
        var item_id = $("#item_name").val();
        var mrp=$('#mrp').val();
        var qty=$('#qty').val();
        var discount=$('#discount').val();
        var cgst=$('#cgst').val();
        var sgst=$('#sgst').val();
        var total=$('#total').val();             
        var item_name=$("#item_name option:selected").text(); 
        var save_update = $('#save_update').val();	   
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length; 
        var totaldata=1;
        totalamt=parseFloat(mrp) * parseFloat(qty);
        var disamt=parseFloat(totalamt)*parseFloat(discount)/100;
        var totaldata=parseFloat(totalamt)-parseFloat(disamt);
        var cgst1=parseFloat(totaldata)*parseFloat(cgst)/100;
        var sgst2=parseFloat(totaldata)*parseFloat(sgst)/100;
        //alert(disamt);
          if(save_update==""){
        for(var i=0;i<r;i++)
        {  
            var col=$(r1[i]).find('td:eq(2)').html();
            //alert(col);
            
            if(col == item_id)
            {
                serialno=$(r1[i]).find('td:eq(14)').html();
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
        else  if(save_update!=""){
            $("#groupid_"+save_update).html(groupid);
            $("#itemid_"+save_update).html(item_id);
            $("#groupname"+save_update).html(groupname);
            $("#itemname"+save_update).html(item_name);
            $("#mrp"+save_update).html(mrp);
            $("#qty_"+save_update).html(qty);
            $("#discount_"+save_update).html(discount);
            //$("#cgst_"+save_update).html(cgst);
            $("#discountamt_"+save_update).html(disamt);
            $("#cgst_"+save_update).html(cgst1);
            $("#sgst_"+save_update).html(sgst2);
            $("#total_"+save_update).html(total);
            $("#sr_"+save_update).html(save_update);
            $('#save_update').val('');
        }
         else{                
            var markup = '<tr>'+
            '<td id="groupid_'+sr+'" style="display:none;" >'+groupid+'</td>'+
            '<td id="itemid_'+sr+'" style="display:none;">'+item_id+'</td>'+
            '<td width=5%">  </td>'+
            '<td width=10%"d id="groupname'+sr+'">'+groupname+'</td>'+
            '<td width=10%" id="itemname'+sr+'">'+item_name+'</td>'+
            '<td width=10%" id="mrp'+sr+'">'+mrp+'</td>'+
            '<td width=5%" id="qty_'+sr+'">'+qty+'</td>'+
            '<td id="discount_'+sr+'" style="display:none;" >'+discount+'</td>'+
            '<td id="cgst1_'+sr+'" style="display:none;" >'+cgst+'</td>'+
            '<td id="sgst1_'+sr+'" style="display:none;" >'+sgst+'</td>'+
            '<td width=10%" id="discountamt_'+sr+'" >'+disamt+'</td>'+
            '<td width=10%" id="cgst_'+sr+'" >'+cgst1+'</td>'+
            '<td width=10%" id="sgst_'+sr+'" >'+sgst2+'</td>'+
            '<td width=10%" id="total_'+sr+'">'+total+'</td>'+
            '<td hidden id="'+sr+'">'+sr+'</td>'+
            '<td width=20%"><button type="button" name="edit" class="edit_data_pur btn btn-xs btn-success" id="'+sr+'"><i class="fa fa-edit"></i></button>  <button name="delete" value="Delete" class="dele_data1 btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></td>'+
            '</tr>';
            sr=sr+1;
            $("#purchbody").append(markup);       
           
         }$('#barcode').val('');
         $("#brand").val('');
         $("#item_name").val('');
         $('#mrp').val('');
         $('#qty').val('');
         $('#discount').val('');
         $('#cgst').val('');
         $('#sgst').val('');
         $('#total').val('');
        gettotal();
        getgst1();
        getdis();
        getdisamt();
        getcgstdata();
        getsgstdata();
        //getfinal();
    }); 

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
            totalamt=parseFloat(totalamt)+parseFloat(total);                       
        }
        $('#discount_less').val(totalamt);
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
            total= $(r1[i]).find('td:eq(10)').html();
            totalamt=parseFloat(totalamt)+ parseFloat(total);                               
        }
        $('#disc_amount').val(totalamt);
    }

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
            total= $(r1[i]).find('td:eq(13)').html();
            totalamt=parseFloat(totalamt)+ parseFloat(total);                               
        }
        $('#bill_amount').val(totalamt.toFixed(2));
        totalamt1=Math.round(totalamt);
        diff=parseFloat(totalamt1)-parseFloat(totalamt);
        diff=Math.abs(diff);
        $('#round_off').val(diff.toFixed(2))
        $('#total_amount').val(totalamt1.toFixed(2));
    }
    function getgst1()
    {   
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;
        var tr="";
        var totalamt=0;                          
        var total=0;
        var row=0;
        for(var i=0;i<r;i++)
        {                             
            var sr = i+1;
            total= $(r1[i]).find('td:eq(10)').html();
           
            totalamt=parseFloat(totalamt)+ parseFloat(total);                               
        }
        Math.round(totalamt);
        
        $('#gst_amount').val(totalamt);
    }   

    function getcgstdata()
    {   
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;
        var tr="";
        var totalamt=0;  
        var totalrow=0;                        
        var total=0;
        var row=0;
        for(var i=0;i<r;i++)
        {                             
            var sr = i+1;
            total= $(r1[i]).find('td:eq(11)').html();
            row=$(r1[i]).find('td:eq(8)').html();
            totalrow=parseFloat(totalrow)+ parseFloat(row);
            totalamt=parseFloat(totalamt)+ parseFloat(total);                               
        }
        $('#cgst1').val(totalrow);
        $('#cgst_amount').val(totalamt.toFixed(2));
    }
    function getsgstdata()
    {   
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;
        var tr="";
        var totalamt=0;  
        var totalrow=0;                                  
        var total=0;
        var row=0;
        for(var i=0;i<r;i++)
        {                             
            var sr = i+1;
            total= $(r1[i]).find('td:eq(12)').html();
            row=$(r1[i]).find('td:eq(9)').html();
            totalrow=parseFloat(totalrow)+ parseFloat(row);
            totalamt=parseFloat(totalamt)+ parseFloat(total);                               
        }
        $('#sgst1').val(totalrow);
        $('#sgst_amount').val(totalamt.toFixed(2));
    }
    $(document).on("blur", "#paid_rs", function(e) {
        e.preventDefault();
        var balance = $('#total_amount').val();
        var paid = $('#paid_rs').val();
        var total = parseFloat(balance) - parseFloat(paid);
        $('#Balance').val(total.toFixed(2));
        // getfinal();
    });
    $(document).on("blur", "#discountless", function(e) {
        e.preventDefault();
        var total = 0;
        var amt = $('#bill_amount').val();
        var discoutn = $('#discountless').val();
        var discountamt = $('#disc_amount').val();
        var dis_plus = parseFloat(amt) * discoutn / 100;
        var disdata = parseFloat(discountamt) + parseFloat(dis_plus);
        total = parseFloat(amt) - parseFloat(dis_plus);
        total1 = Math.round(total);
        var diff = parseFloat(total1) - parseFloat(total);
        diff = Math.abs(diff);
        $('#round_off').val(diff.toFixed(2));
        //  $('#discount_less').val(dis)
        $('#disc_amount').val(disdata.toFixed(2));
        $('#total_amount').val(total1.toFixed(2));
    });

    $(document).on("blur", "#sgst", function(e) {
        e.preventDefault();
        var total = 1;
        var mrp = $('#mrp').val();
        var qty = $('#qty').val();
        var cgst = $('#cgst').val();
        var sgst = $('#sgst').val();
        var discoutn = $('#discount').val();
        total = parseFloat(mrp) * parseFloat(qty);
        var dis = parseFloat(total) * parseFloat(discoutn) / 100;
        var totaldata = parseFloat(total) - parseFloat(dis);
        var cgst = parseFloat(totaldata) * parseFloat(cgst) / 100;
        var sgst = parseFloat(totaldata) * parseFloat(sgst) / 100;
        var totalamt = parseFloat(totaldata) + parseFloat(cgst) + parseFloat(sgst);
        //totalamt=Math.round(totalamt);
        $('#total').val(totalamt.toFixed(2));
    });

    /*----------submite Payment Data--------*/
    $(document).on('submit', '#payment', function(e) {
        e.preventDefault();
        // alert('hii');
        var id = $('#saveid').val();
        var customer = $('#customer').val();
        var invoice_no = $('#inv').val();
        var invoice_date = $('#invoice_date').val();

        var sales_man = $('#sales_man').val();
        var bill_amt = $('#bill_amount').val();
        var dis_per = $('#discount_less').val();
        var dis_plus = $('#discountless').val();
        var cgst = $('#cgst1').val();
        var sgst = $('#sgst1').val();
        var paid = $('#paid_rs').val();
        var round_off = $('#round_off').val();

        var tdateAr = invoice_date.split('/');
        var invoice_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];


        $.ajax({
            type: "POST",
            url: base_url + "Controller/adddata",
            data: {
                table_name: table_name,
                id: id,
                customer: customer,
                invoice_no: invoice_no,
                invoice_date: invoice_date,
                sales_man: sales_man,
                bill_amt: bill_amt,
                dis_per: dis_per,
                dis_plus: dis_plus,
                cgst: cgst,
                sgst: sgst,
                paid: paid,
                round_off: round_off
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var parid;
                if (id != "") {
                    parid = id;
                } else {
                    parid = data;
                }
                //alert(parid);
                $('#btnprint').val(parid);

                var r1 = $('table#purchase_bill').find('tbody').find('tr');
                var r = r1.length;
                var tr = "";
                for (var i = 0; i < r; i++) {
                    groupid = $(r1[i]).find('td:eq(0)').html();
                    itemid = $(r1[i]).find('td:eq(1)').html();
                    mrp = $(r1[i]).find('td:eq(5)').html();
                    qty = $(r1[i]).find('td:eq(6)').html();
                    dis = $(r1[i]).find('td:eq(7)').html();
                    cgst1 = $(r1[i]).find('td:eq(8)').html();
                    sgst1 = $(r1[i]).find('td:eq(9)').html()
                    total = $(r1[i]).find('td:eq(13)').html();
                    //alert('id'+parid+'g'+groupid+'i'+itemid+'m'+mrp+'q'+qty+'d'+dis+'gs'+cgst+'gs'+sgst+'to'+total);
                    $.ajax({
                        type: "POST",
                        url: base_url + "Controller/adddata",
                        dataType: "JSON",
                        async: false,
                        data: {
                            proid: parid,
                            groupid: groupid,
                            itemid: itemid,
                            mrp: mrp,
                            dis: dis,
                            qty: qty,
                            cgst: cgst1,
                            sgst: sgst1,
                            total: total,
                            table_name: 'salesbilldetails',
                        },
                        success: function(data) {
                            successTost("Operation Successfull");
                        },
                        error: function() {
                            errorTost("Operation Failed for salesbilldetails");
                        }
                    });
                }
                successTost("Operation Successfull");
            },
            error: function() {
                errorTost("Operation Failed");
            }
        });
        id2 = $("#btnprint").val();
        $('#saveid').val(id2);
        if ($("#btnprint").val() == '') {
            $("#btnprint").prop('disabled', true);
        } else {
            $("#btnprint").prop('disabled', false);
        }
        datashow();
    });
    /*----------End Of Data------------*/

    /*-----------Show Data Function--------------*/
    datashow();

    function datashow() {
        var where = "";
        $.ajax({
            type: "POST",
            url: base_url + "Controller/showallsales",
            data: {
                table_name: table_name,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data = eval(data);
                //alert(data[0].billno);
                console.log(data);
                $('#show_master').html('');
                var html = "";

                html += '<table id="myTable" class="table table-striped"  style="width:100%;table-layout: fixed;">' +
                    '<thead>' +
                    '<tr>' +
                    '<th width="7%">No</th>' +
                    '<th style="display:none;">Id</th>' +
                    '<th width="10%">Name</th>' +
                    '<th width="7%">InvNo</th>' +
                    '<th width="10%">InvDate</th>' +
                    '<th width="10%">Sales Man</th>' +
                    '<th width="8%">Total</th>' +
                    '<th width="8%">Dis_per</th>' +
                    '<th width="7%">Dis Plus</th>' +
                    '<th width="8%">cgst</th>' +
                    '<th width="8%">Sgst</th>' +
                    '<th width="9%">Paid</th>' +
                    '<th style="display:none;">RoundOFf</th>' +
                    '<th style="display:none;">Sr</th>' +
                    '<th style="display:none;">Name</th>' +
                    '<th width="8%">Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                var index = 1;
                for (var i = 0; i < data.length; i++) {
                    var tdateAr = data[i].invoice_date.split('-');
                    invoice_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
                    html += '<tr>' +
                        '<td>' + index + '</td>' +
                        '<td style="display:none;" id="id' + data[i].id + '">' + data[i].id + '</td>' +
                        '<td id="name1_' + data[i].id + '">' + data[i].name1 + '</td>' +
                        '<td id="invoiceno_' + data[i].id + '">' + data[i].invoice_no + '</td>' +
                        '<td id="date' + data[i].id + '">' + invoice_date + '</td>' +
                        '<td id="salesman_' + data[i].id + '">' + data[i].salesman + '</td>' +
                        '<td id="total_' + data[i].id + '">' + data[i].total + '</td>' +
                        '<td id="dis_per_' + data[i].id + '">' + data[i].dis_per + '</td>' +
                        '<td id="dis_less_' + data[i].id + '">' + data[i].dis_plus + '</td>' +
                        '<td id="cgst_' + data[i].id + '">' + data[i].cgst + '</td>' +
                        '<td id="sgst_' + data[i].id + '">' + data[i].sgst + '</td>' +
                        '<td id="paid_' + data[i].id + '">' + data[i].paid + '</td>' +
                        '<td hidden id="roundoff_' + data[i].id + '">' + data[i].roundoff + '</td>' +
                        '<td hidden id="' + sr + '">' + sr + '</td>' +
                        '<td hidden id="name_' + data[i].id + '">' + data[i].name + '</td>' +
                        '<td><button type="button" name="edit" class="edit_data btn btn-xs btn-success" id="' + data[i].id + '"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class="btn btn-xs delete_data btn-danger" id="' + data[i].id + '"><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                    index += 1;
                }
                html += '</tbody></table>';
                $('#show_master').html(html);
                $('#myTable').DataTable({
                    dom: 'Bfrtip',
                    //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                    buttons: [{
                            extend: 'pdfHtml5',
                            title: tit,
                            orientation: 'landscape',
                            pageSize: 'A4',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                            },
                        },
                        {
                            title: tit,
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                            }
                        }
                    ]
                });
            }
        });
    }
    /*-----------End of Showdata function -----------*/
    /*-----------Edit data function-----------*/
    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();
        $('#form').show();
        $('#tbl').hide();
        $('#column').hide();
        var sr = 0;
        var id1 = $(this).attr('id');
        var name = $('#name_' + id1).html();
        var invoiceno = $('#invoiceno_' + id1).html();
        var date = $('#date' + id1).html();

        var salesman = $('#salesman_' + id1).html();
        var total = $('#total_' + id1).html();
        var dis_per = $('#dis_per_' + id1).html();
        var dis_less = $('#dis_less_' + id1).html();
        var cgst = $('#cgst_' + id1).html();
        var sgst = $('#sgst_' + id1).html();
        var paid = $('#paid_' + id1).html();
        var round_off = $('#roundoff_' + id1).html();
        console.log(id1 + "/" + name + "/" + invoiceno + "/" + cgst + "/" + sgst);
        $('#saveid').val(id1);
        $('#btnprint').val(id1);
        $('#customer').val(name).trigger('change');
        $('#inv').val(invoiceno);
        $('#invoice_no').val("INV-" + invoiceno);
        $('#invoice_date').val(date);
        $("#btnprint").prop('disabled', false);
        $('#sales_man').val(salesman);
        $('#bill_amount').val(total);
        $('#discount_less').val(dis_per);
        $('#discountless').val(dis_less);
        $('#cgst1').val(cgst);
        $('#sgst1').val(sgst);
        $('#paid_rs').val(paid);
        $('#round_off').val(round_off);

        where = id1;
        // alert('where '+where);
        $.ajax({
            type: "POST",
            url: base_url + "Controller/showallsales",
            data: {
                table_name: 'salesbilldetails',
                where: where
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                // var data=eval(data);
                console.log("Sales Data " + data[1].mrp);
                var markup = "";
                var totaldata = 0;
                var disamt = 0,
                    disamt1 = 0;
                var totalamt = 0;
                var cgstamt = 0,
                    cgstamt1 = 0;
                var sgstamt = 0,
                    sgstamt1 = 0;
                var total = 0,
                    total1 = 0;
                disless1 = 0;
                finalDisamt = 0;
                var dis_less = $('#discountless').val();
                for (i = 1; i < data.length; i++) {
                    sr = sr + 1;
                    var mrp = data[i].mrp;
                    var qty = data[i].qty;
                    console.log(mrp + " & " + qty);
                    totalamt = parseFloat(mrp) * parseFloat(qty);
                    disamt = parseFloat(totalamt) * parseFloat(data[i].discount) / 100;
                    //console.log("Disamt:"+disamt);
                    disless = parseFloat(totalamt) * parseFloat(dis_less) / 100;
                    //console.log("Dissless:"+disless);
                    disamt1 = disamt1 + disamt;
                    // console.log("Disamt1:"+disamt1);
                    disless1 = disless1 + disless;
                    // console.log("Dissless1:"+disless1);
                    finalDisamt = disamt1 + disless1;
                    // console.log("Final Dis amt: "+finalDisamt);
                    totaldata = parseFloat(totalamt) - parseFloat(disamt);
                    //console.log(totaldata);
                    cgstamt = parseFloat(totaldata) * parseFloat(data[i].cgst) / 100;
                    cgstamt1 = cgstamt1 + cgstamt;
                    // console.log(cgstamt);
                    sgstamt = parseFloat(totaldata) * parseFloat(data[i].sgst) / 100;
                    sgstamt1 = sgstamt1 + sgstamt;
                    //console.log(sgstamt);

                    total = totaldata + cgstamt + sgstamt;
                    total1 = total + total1;
                    total = Math.round(total);
                    total1 = Math.round(total1);
                    $('#disc_amount').val(finalDisamt.toFixed(2));
                    $('#cgst_amount').val(cgstamt1.toFixed(2));

                    $('#sgst_amount').val(sgstamt1.toFixed(2));
                    $('#bill_amount').val(total1.toFixed(2));
                    markup += '<tr>' +

                        '<td id="groupid_' + sr + '" style="display:none;" >' + data[i].groupid + '</td>' +
                        '<td style="display:none;"  id="itemid_' + sr + '" >' + data[i].itemid + '</td>' +
                        '<td width="5%">  </td>'+
                        '<td width=10%" id="groupname' + sr + '">' + data[i].brand_masternm + '</td>' +
                        '<td width=10%" id="itemname' + sr + '">' + data[i].item_name + '</td>' +
                        '<td width=10%" id="mrp' + sr + '">' + data[i].mrp + '</td>' +
                        '<td width=5%" id="qty_' + sr + '">' + data[i].qty + '</td>' +
                        '<td id="discount_' + sr + '" style="display:none;" >' + data[i].discount + '</td>' +
                        '<td id="cgst1_' + sr + '" style="display:none;" >' + data[i].cgst + '</td>' +
                        '<td id="sgst1_' + sr + '" style="display:none;" >' + data[i].sgst + '</td>' +
                        '<td width=10%" id="discountamt_' + sr + '" >' + disamt + '</td>' +
                        '<td width=10%" id="cgst_' + sr + '" >' + cgstamt + '</td>' +
                        '<td width=10%" id="sgst_' + sr + '" >' + sgstamt + '</td>' +
                        '<td width=10%" id="total_' + sr + '">' + total + '</td>' +
                        '<td hidden id="sr_' + sr + '">' + sr + '</td>' +
                        '<td width=20%"><button type="button" name="edit" class="edit_data_pur btn btn-xs btn-success" id="' + sr + '"><i class="fa fa-edit"></i></button> <button name="delete" value="Delete" class="dele_data1 btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                    $("#purchbody").html(markup);
                    //  gettotal();
                }
            }
        });
        getamtdata();

    });

    /*-----------End of Edit data function-----------*/
    function getamtdata() {
        var total = $('#bill_amount').val();
        var paid = $('#paid_rs').val();
        var discountless = $('#discountless').val();
        var totaldata = 0;
        var balance = 0;
        if (discountless > 0) {
            var totaldis = parseFloat(total) * parseFloat(discountless) / 100;
            totaldata = parseFloat(total) - parseFloat(totaldis);
            balance = parseFloat(totaldata) - parseFloat(paid);
            $('#Balance').val(balance);
            totaldata = Math.round(totaldata);
            $('#total_amount').val(totaldata.toFixed(2));
        } else {
            balance = parseFloat(total) - parseFloat(paid);
            $('#Balance').val(balance);
            total = Math.round(total);
            $('#total_amount').val(total.toFixed(2));
        }
    }
    /*---------------End of Edit data -----------*/

    //Delete Data code starts here
    $(document).on('click', '.delete_data', function() {
        var id1 = $(this).attr('id');
        // $('#saveid').val(id1);
        // alert(id1+" & "+ table_name);
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
                            type: "post",
                            url: base_url + "Controller/deleteData",
                            dataType: "json",
                            data: {
                                id: id1,
                                table_name: table_name
                            },
                            success: function(data) {
                                //alert(data);
                                swal("Deleted!", "Your Record has been deleted.", "success");
                                datashow();
                            }
                        });
                    } else {
                        swal("Cancelled", "Your record is safe :)", "error");
                    }
                });
        } else {
            return false;
        }
    });
    /*-------------End of Delete Data------*/
    /*-----------delete a Row Of purchase_bill table-----------------------*/
    $(document).on("click", ".dele_data1", function(e) {
        // $("table tbody").find('input[name="record"]').each(function(){
        //  var id1 = $(this).attr('id');
        //var t=$('#totoldata').val();         

        /*var t="";
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;*/
        var tr = "";

        var id1 = $(this).parents("tr").remove();
        gettotal();
    });
    $(document).on("click", ".edit_data_pur", function(e) {
        var id1 = $(this).attr('id');

        var groupid_ = $('#groupid_' + id1).html();
        var itemid_ = $('#itemid_' + id1).html();
        var mrp = $('#mrp' + id1).html();
        var qty_ = $('#qty_' + id1).html();
        var discount_ = $('#discount_' + id1).html();
        var cgst = $('#cgst1_' + id1).html();
        var sgst = $('#sgst1_' + id1).html();
        var total = $('#total_' + id1).html();
        $('#save_update').val(id1);

        $("#brand").val(groupid_).trigger('change');
        $("#item_name").val(itemid_).trigger('change');
        $('#mrp').val(mrp);
        $('#qty').val(qty_);
        $('#discount').val(discount_);
        $('#cgst').val(cgst);
        $('#sgst').val(sgst);
        $('#total').val(total);
    });


});