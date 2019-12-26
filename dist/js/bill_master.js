$(document).ready(function() {


    var table_name = "bill_master";
    datashow();
    $('#bill_master_form')[0].reset();
    $('#form').hide();
    $('#tbl').show();
    $('#column').show();
    $('#containerother_kyc1').html('');

    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        buttons: [

            {
                title: tit,
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            }
        ]
    });

    getMasterSelect("customer_matserdata", "#customer_name", " status = '1' ");
    getMasterSelect("service_master", "#suppliername", " status = '1' ");

    function getMasterSelect(table_name, selecter, where) {

        $.ajax({
            type: "POST",
            url: base_url + "BillMaster/getdropdown",
            data: {
                table_name: table_name,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                html = '';
                var name = '';
                //					if(table_name=="victim_age"){
                //					html += '<option selected  value="" >Select Victim Age</option>';
                //						}else{
                html += '<option selected disabled value="" >Select</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    if (table_name == "customer_matserdata") {
                        name = data[i].customername;
                        id = data[i].id;
                    } else if (table_name == "service_master") {
                        name = data[i].s_name;
                        id = data[i].id;
                    }



                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            }
        });
    }

    $(document).on('submit', "#bill_master_form", function(e) {
        e.preventDefault();

        var data = $('#bill_master_form').serialize();
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;
        if (r > 0) {
            var id = $('#saveid').val();
            var customer_name = $('#customer_name').val();
            var grand_amount = $('#grand_amount').val();
            var billing_paid_amount = $('#billing_paid_amount').val();


            $.ajax({
                type: "post",
                url: base_url + "BillMaster/adddata",
                dataType: "json",
                //fileElementId:'userfile',
                data: {
                    id: id,
                    customer_name: customer_name,
                    grand_amount: grand_amount,
                    billing_paid_amount: billing_paid_amount,
                    table_name: table_name
                },
                async: false,
                success: function(data) {
                    if (data > 0 || data == true) {
                        var billid = data;
                        var uid = $('#saveid').val();
                        if (uid != "") {
                            $('.pdfprint').val(uid);
                        } else {
                            $('.pdfprint').val(billid);
                        }

                        if (uid != "") {
                            billid = uid;
                            $.ajax({
                                type: "POST",
                                url: base_url + "BillMaster/deletedata",
                                dataType: "JSON",
                                async: false,
                                data: {
                                    id: billid,
                                    table_name: 'bii_description',

                                },
                                success: function(data) {

                                }
                            });
                        }


                        var r1 = $('table#purchase_bill').find('tbody').find('tr');
                        var r = r1.length;
                        var tr = "";


                        for (var i = 0; i < r; i++) {


                            var t = document.getElementById('purchase_bill');
                            var serviceid = $(r1[i]).find('td:eq(1)').html();
                            var amount = $(r1[i]).find('td:eq(3)').html();
                            var quantity = $(r1[i]).find('td:eq(4)').html();
                            var paid_amount = $(r1[i]).find('td:eq(6)').html();




                            $.ajax({
                                type: "POST",
                                url: base_url + "BillMaster/adddata",
                                dataType: "JSON",
                                async: false,
                                data: {
                                    billid: billid,
                                    serviceid: serviceid,
                                    amount: amount,
                                    quantity: quantity,
                                    paid_amount: paid_amount,
                                    table_name: 'bii_description',
                                },
                                success: function(data) {



                                }



                            });
                        }
                    }
                    if (id == "") {
                        successTost("Operation Saved Successfull");

                    } else if (id > 0) {
                        successTost("Operation Update Successfull");
                    } else {
                        errorTost("Operation Failed for login master");
                    }

                }
            });
            $('.pdfprint').show();
        } else {
            swal("Please Enter at least one Service in Billing !!");
        }
        /*$('#bill_master_form')[0].reset();
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#containerother_kyc1').html('');
        datashow();*/
    });


    /*----Edit Code Here-------*/
    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();
        $('#form').show();
        $('#tbl').hide();
        $('#column').hide();
        $('.pdfprint').show();

        var id1 = $(this).attr('id');
        $('.pdfprint').attr('id', id1);
        $('.pdfprint').val(id1);
        var customername = $('#customerid_' + id1).html();
        var grandamt = $('#grandamt_' + id1).html();
        var totalpaidamt = $('#totalpaidamt_' + id1).html();
        var totalbillingamt = $('#totalbillingamt_' + id1).html();



        $('#saveid').val(id1);
        $('#customer_name').val(customername);
        $('#grand_amount').val(grandamt);
        $('#billing_paid_amount').val(totalpaidamt);
        $('#billing_balance_amount').val(totalbillingamt);

        where = "billid=" + id1;
        $.ajax({
            type: "POST",
            url: base_url + "BillMaster/getbill_descriptiondata",
            data: {
                where: where,
                table_name: 'bii_description',
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                var row_id = 0;
                var total_amount = 0;
                var balance_amount = 0;
                $('#purchase_billtbody').html('');
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {

                        total_amount = parseFloat(data[i].amount) * parseFloat(data[i].qty);
                        balance_amount = parseFloat(total_amount) - parseFloat(data[i].paidamt);
                        row_id = row_id + 1;
                        var html = '<tr class="project_tab_add_row" id="' + row_id + '" >' +
                            '<td style="display:none;" >' + row_id + '</td>' +
                            '<td  style="display:none;" id="serviceid_' + row_id + '">' + data[i].serviceid + '</td>' +
                            '<td  id="servicename_' + row_id + '">' + data[i].servicename + '</td>' +
                            '<td style="text-align:right;"  id="amount_' + row_id + '">' + data[i].amount + '</td>' +
                            '<td style="text-align:right;"   id="quantity_' + row_id + '">' + data[i].qty + '</td>' +
                            '<td style="text-align:right;"  id="total_amount_' + row_id + '">' + total_amount + '</td>' +
                            '<td  style="text-align:right;"  id="paid_amount_' + row_id + '">' + data[i].paidamt + '</td>' +
                            '<td style="text-align:right;"   id="balance_amount_' + row_id + '">' + balance_amount + '</td>' +
                            '<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="' + row_id + '"  ><i class="fa fa-trash"></i></button>' +
                            '</tr>';

                        $("#purchase_billtbody").append(html);

                    }

                    $('#bill_row_id').val(row_id);
                }
            }
        });


    });
    //End of Edit data

    //Delete Data code starts here
    $(document).on('click', '#btndelete', function() {
        //   alert(table_name);
        var id1 = $('#saveid').val();
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
                            url: base_url + "BillMaster/deleteData",
                            dataType: "json",
                            data: {
                                id: id1,
                                table_name: table_name
                            },
                            dataType: "JSON",
                            async: false,
                            success: function(data) {
                                swal("Deleted !!", "Hey, your Data has been deleted !!", "success");
                                $('.closehideshow').trigger('click');
                                $('#saveid').val("");
                                datashow();; //call function show all data	
                                $('#bill_master_form')[0].reset();
                                $('#form').hide();
                                $('#tbl').show();
                                $('#column').show();
                                $('#containerother_kyc1').html('');
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
    // datashow();
    function datashow() {

        $.ajax({
            type: "POST",
            url: base_url + "BillMaster/get_master",
            data: {
                table_name: 'bill_master',
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data = eval(data);
                console.log(data);
                $('#tablebody').html('');
                var table = "";

                var totalbillingamt = 0;
                index = 1;
                for (var i = 0; i < data.length; i++) {
                    totalbillingamt = parseFloat(data[i].grandamt) - parseFloat(data[i].totalpaidamt);
                    table += '<tr>' +
                        '<td>' + index + '</td>' +
                        '<td hidden id="id' + data[i].id + '">' + data[i].id + '</td>' +
                        '<td  hidden id="customerid_' + data[i].id + '">' + data[i].customerid + '</td>' +
                        '<td  id="coustomer_' + data[i].id + '">' + data[i].coustomer + '</td>' +
                        '<td style="text-align:right;" id="grandamt_' + data[i].id + '">' + data[i].grandamt + '</td>' +
                        '<td  style="text-align:right;" id="totalpaidamt_' + data[i].id + '">' + data[i].totalpaidamt + '</td>' +
                        '<td style="text-align:right;" id="totalbillingamt_' + data[i].id + '">' + totalbillingamt + '</td>' +
                        '<td><button type="button" name="edit" class="edit_data btn btn-success" id="' + data[i].id + '"><i class="fa fa-edit"></i></button> </td>' +
                        '</tr>';
                    index += 1;
                }
                $('#tablebody').append(table);
                // $('#dataTable').DataTable();
                /*  $('#dataTable').DataTable({
                       dom: 'Bfrtip',
                       "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                       buttons: [
                           {
                               extend: 'pdfHtml5',
                               title: tit,
                               orientation: 'landscape',
                               pageSize: 'A4',
                               exportOptions: {
                                   columns: [0,  3, 4, 5, 6 ]
                               },
                           },
                           {
                               title: tit,
                               extend: 'excelHtml5',
                               exportOptions: {
                                   columns: [0,  3, 4, 5, 6 ]
                               }
                           }
                       ]
                   });*/
                //$('#dataTable').DataTable();*/
            }
        });
    }
    $(document).on('click', '#btnadd', function() {
        $('#bill_master_form')[0].reset();
        $('#form').show();
        $('#tbl').hide();
        $('#column').show();
        $('#saveid').val('');
        $('#containerother_kyc1').html('');
        $('#purchase_billtbody').html('');
        $('.pdfprint').hide();

    });
    $(document).on('click', '#btncancel', function() {
        $('#bill_master_form')[0].reset();
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#containerother_kyc1').html('');
        datashow();


    });
    /*---- Start Change Event Of Service --------*/
    $(document).on("change", "#suppliername", function(e) {
        e.preventDefault();
        id1 = $(this).val();
        var where = 'id=' + id1;

        $.ajax({
            type: "POST",
            url: base_url + "BillMaster/getamount",
            data: {

                where: where
            },
            dataType: "JSON",
            async: false,
            success: function(data) {


                $('#amount').val(data[0].amount)

            }
        });
        //this is demo change
    });


    /*----End Of Change Event Of Service --------*/

    /*-----Submite of Table Form--------*/

    $(document).on('click', "#add", function(e) {
        e.preventDefault();
        var service = $("#suppliername").val();
        var servicename = $("#suppliername option:selected").text();
        var amount = $("#amount").val();
        var quantity = $("#quantity").val();
        var total_amount = $("#total_amount").val();
        var paid_amount = $("#paid_amount").val();
        var balance_amount = $("#balance_amount").val();

        var row_id = $('#bill_row_id').val();
        row_id = parseInt(row_id) + parseInt(1);
        var save_update = $('#bill_save_update').val();
        var dlt = 0;

        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;
        for (var i = 0; i < r; i++) {

            var serviceid = $(r1[i]).find('td:eq(2)').html();

            if (save_update == "") {
                if (servicename == serviceid) {
                    dlt = parseInt(dlt) + parseInt(1);
                }
            }
        }

        if (dlt > 0) {
            if (dlt == 1) {
                errorTost("Selected Service Already Exists !!!");
            }
            var dlt = 0;

        } else if (save_update != "") {


            $('#serviceid_' + save_update).html(service);
            $('#servicename_' + save_update).html(servicename);
            $('#amount_' + save_update).html(amount);
            $('#quantity_' + save_update).html(quantity);
            $('#total_amount_' + save_update).html(total_amount);
            $('#paid_amount_' + save_update).html(paid_amount);
            $('#balance_amount_' + save_update).html(balance_amount);
            $('#bill_save_update').val('');


        } else {


            var html = '<tr class="project_tab_add_row" id="' + row_id + '" >' +
                '<td style="display:none;" >' + row_id + '</td>' +
                '<td  style="display:none;" id="serviceid_' + row_id + '">' + service + '</td>' +
                '<td  id="servicename_' + row_id + '">' + servicename + '</td>' +
                '<td style="text-align:right;"  id="amount_' + row_id + '">' + amount + '</td>' +
                '<td style="text-align:right;"  id="quantity_' + row_id + '">' + quantity + '</td>' +
                '<td style="text-align:right;"  id="total_amount_' + row_id + '">' + total_amount + '</td>' +
                '<td style="text-align:right;"  id="paid_amount_' + row_id + '">' + paid_amount + '</td>' +
                '<td style="text-align:right;"  id="balance_amount_' + row_id + '">' + balance_amount + '</td>' +
                '<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="' + row_id + '"  ><i class="fa fa-trash"></i></button>' +
                '</tr>';

            $("#purchase_billtbody").append(html);
            $('#bill_row_id').val(row_id);
            $('#bill_save_update').val('');


        }
        $("#suppliername").val('').trigger('change');
        //$("#suppliername option:selected").text();
        $("#amount").val('');
        $("#quantity").val('');
        $("#total_amount").val('');
        $("#paid_amount").val('');
        $("#balance_amount").val('');
        allgettotal();
    });

    /*--------Edit Of Table Data-----------*/
    $(document).on('click', '.doc_edit_data1', function(e) {
        e.preventDefault();

        var row = $(this).attr('id');

        var serviceid = $("#serviceid_" + row).html();
        var amount = $("#amount_" + row).html();
        var quantity = $("#quantity_" + row).html();
        var total_amount = $("#total_amount_" + row).html();
        var paid_amount = $("#paid_amount_" + row).html();
        var balance_amount = $("#balance_amount_" + row).html();

        $("#suppliername").val(serviceid).trigger('change');
        //$("#suppliername option:selected").text();
        $("#amount").val(amount);
        $("#quantity").val(quantity);
        $("#total_amount").val(total_amount);
        $("#paid_amount").val(paid_amount);
        $("#balance_amount").val(balance_amount);
        $('#bill_save_update').val(row);

    });

    /*------Delete of Table data-------*/
    $(document).on('click', '.regional_delete_data1', function(e) {
        e.preventDefault();
        var save_update = $(this).attr('id');

        if (save_update != "") {
            $("#" + save_update).remove();
            $('#doc_save_update').val('');

        }
        allgettotal();
    });
    /*------  End of Delete of Table data-------*/



    /*----Blur Event of Amount------*/
    $('#amount').blur(function() {
        var amount = $("#amount").val();
        var quantity = $("#quantity").val();

        if (amount > 0 && quantity > 0) {
            var total_amount = parseFloat(amount) * parseFloat(quantity);
            total_amount.toFixed(2);
            $('#total_amount').val(total_amount);

        } else if (amount == 0 || quantity == 0) {
            $('#total_amount').val('0');
        } else {
            $('#total_amount').val('');
        }
    });
    /*----Blur Event of Amount------*/
    $('#quantity').blur(function() {
        var amount = $("#amount").val();
        var quantity = $("#quantity").val();

        if (amount > 0 && quantity > 0) {
            var total_amount = parseFloat(amount) * parseFloat(quantity);
            total_amount.toFixed(2);
            $('#total_amount').val(total_amount);
        } else if (amount == 0 || quantity == 0) {
            $('#total_amount').val('0');
        } else {
            $('#total_amount').val('');
        }
    });
    /*----Blur Event of Amount------*/
    $('#paid_amount').blur(function() {
        var total_amount = $("#total_amount").val();
        var paid_amount = $("#paid_amount").val();

        if (total_amount >= 0 && paid_amount >= 0) {
            var balanceamt = parseFloat(total_amount) - parseFloat(paid_amount);
            $('#balance_amount').val(balanceamt);
        } else {
            $('#balance_amount').val('');
        }
    });

    function allgettotal() {
        var r1 = $('table#purchase_bill').find('tbody').find('tr');
        var r = r1.length;
        var tr = "";
        var grandamt = 0;
        var paid = 0;
        var totalpaid = 0;
        var totalbalance = 0;
        var amt = 0;
        for (var i = 0; i < r; i++) {


            var t = document.getElementById('file_info1');
            amt = $(r1[i]).find('td:eq(5)').html();
            paid = $(r1[i]).find('td:eq(6)').html();
            grandamt = parseFloat(amt) + parseFloat(grandamt);
            totalpaid = parseFloat(totalpaid) + parseFloat(paid);
        }
        totalbalance = parseFloat(grandamt) - parseFloat(totalpaid);
        $('#grand_amount').val(grandamt);
        $('#billing_paid_amount').val(totalpaid);
        $('#billing_balance_amount').val(totalbalance);
    }
    /*------------ Start get print button click code------------*/
    /*  $(document).on('click','.pdfprint',function(e){
          e.preventDefault();
        
          var id = $(this).val();
          alert('hiii');
          $.ajax({
              type : "POST",
              url  : base_url+"BillMaster/print_tax",
              data:{
                  id:id,   
              
              },
              dataType : "JSON",
              async : false,
              success: function(data){
                 alert(data);
                
                
             
              }
          });

      });*/
    /*------------ End get print button click code------------*/

});