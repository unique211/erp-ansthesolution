$(document).ready(function() {


    var table_name = "bill_master";

    //  $('#bill_master_form')[0].reset();
    $('#form').show();
    $('#tbl').show();
    $('#column').show();
    $('#containerother_kyc1').html('');
    // datashow();
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        buttons: [

            {
                title: tit,
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, ]
                }
            }
        ]
    });
    /*---------- Start For Getting branch In to Dropdown--------*/
    getMasterSelect("customer_matserdata", "#customername", " status = '1' ");

    function getMasterSelect(table_name, selecter, where) {

        $.ajax({
            type: "POST",
            url: base_url + "Accountstatement/getdropdown",
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
                    }



                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            }
        });
    }

    /*---------------click Event of --------------------*/
    $(document).on('click', '#generate', function(e) {
        e.preventDefault();

        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        var customername = $('#customername').val();
        var Customername = $('#customername option:selected').text();

        $('#Customername').html("Customername:" + Customername);
        $('#Fromdate').html("Fromdate:" + fromdate);
        $('#Todate').html("Todate:" + todate);
        var tdateAr = fromdate.split('/');
        fromdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];

        var tdateAr = todate.split('/');
        todate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];



        $.ajax({
            type: "POST",
            url: base_url + "Accountstatement/get_master",
            data: {
                table_name: 'bill_master',
                fromdate: fromdate,
                todate: todate,
                customername: customername,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                index = 1;
                var table1 = $('#dataTable').DataTable();
                table1.destroy();
                var table = "";
                $('#tablebody').html('');
                if (data.length > 0) {

                    var date = '';
                    var debit = 0;
                    var cridit = 0;
                    var balance = 0;


                    for (var i = 0; i < data.length; i++) {
                        var tdateAr = data[i].date.split('-');
                        date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
                        if (data[i].debit > 0) {
                            debit = data[i].debit;
                        } else {
                            debit = 0;
                        }
                        if (data[i].credit > 0) {
                            cridit = data[i].credit;
                        } else {
                            cridit = 0;
                        }
                        if (data[i].balance > 0) {
                            balance = data[i].balance;
                        } else {
                            balance = 0;
                        }
                        if (debit > 0 || cridit > 0) {
                            table = '<tr>' +
                                '<td  id="date_' + data[i].id + '">' + date + '</td>' +
                                '<td id="customername_' + data[i].id + '">' + data[i].customername + '</td>' +
                                '<td  id="credit_' + data[i].id + '">' + cridit + '</td>' +
                                '<td id="debit_' + data[i].id + '">' + debit + '</td>' +
                                '<td id="debit_' + data[i].id + '">' + balance + '</td>' +

                                '</tr>';
                            index += 1;
                            $('#tablebody').append(table);
                        }
                    }
                    $('#dataTable').DataTable({
                        dom: 'Bfrtip',
                        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                        buttons: [

                            {
                                title: "Customername: " + Customername + "  Fromdate:" + fromdate + "  Todate:" + todate,
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, ]
                                }
                            }
                        ]
                    });
                }

            }
        });

    });


    /*-----------Blur Event of  Bill no-------------*/
    $(document).on('change', '#billno', function(e) {
        e.preventDefault();
        var val = $(this).val();

        $('.pdfprint').removeAttr("disabled");
        if (val > 0) {
            var r1 = $('table#myTable').find('tbody').find('tr');
            var r = r1.length;
            var tr = "";
            var id = $(r1[val - 1]).find('td:eq(1)').html();
            var sid = $(r1[val - 1]).find('td:eq(4)').html();
            //  var id = $(r1[val-1]).find('td:eq(1)').html();

            $('#btnprint').val(id);

            $('.pdfprint').attr("serviceid", sid);
        } else {

        }

    });

    function datashow() {

        $.ajax({
            type: "POST",
            url: base_url + "Billreport/get_master",
            data: {
                table_name: 'bill_master',
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                var data = eval(data);
                console.log(data);
                //  $('#tablebody').html('');
                var table = "";
                table += '<table id="myTable" class="table table-striped" style="width:100%;">' +
                    '<thead>' +
                    '<tr>' +
                    '<td >Select Branch.</td>' +
                    '<td ><select class="form-control" id="branchname" ></select></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td></td>' +

                    '</tr>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">Billing id.</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Customer Id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">FullName</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Serviceid</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">Servicename</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Branch Id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">Quantity</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">Total Amt	</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">Amount</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px;">DistributorName</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                var totalbillingamt = 0;
                index = 1;
                for (var i = 0; i < data.length; i++) {

                    table += '<tr>' +
                        '<td>' + index + '</td>' +
                        '<td  id="date_' + data[i].id + '">' + data[i].bill_date + '</td>' +
                        '<td  style="display:none;" id="customerid_' + data[i].id + '">' + data[i].customerid + '</td>' +
                        '<td  id="coustomername_' + data[i].id + '">' + data[i].coustomer + '</td>' +
                        '<td style="display:none;"  id="serviceid' + data[i].id + '">' + data[i].serviceid + '</td>' +
                        '<td  id="servicename' + data[i].id + '">' + data[i].servicename + '</td>' +
                        '<td style="display:none;"  id="branch_id_' + data[i].id + '">' + data[i].branchid + '</td>' +
                        '<td  id="qty_' + data[i].id + '">' + data[i].qty + '</td>' +
                        '<td id="amount_' + data[i].id + '">' + data[i].amount + '</td>' +
                        '<td  id="totalpaidamt_' + data[i].id + '">' + data[i].totalamt + '</td>' +
                        '<td  id="totalpaidamt_' + data[i].id + '">' + data[i].totalamt + '</td>' +
                        '</tr>';
                    index += 1;
                }
                table += '</tbody></table>';
                $('#tabledata').html(table);
                $('#myTable').DataTable({});
                //$('#tablebody').append(table);
                // $('#dataTable').DataTable();
                /*  $('#dataTable').DataTable({
                        dom: 'Bfrtip',
                        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                title: tit,
                                orientation: 'landscape',
                                pageSize: 'A4',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 15, 16 ]
                                },
                            },
                            {
                                title: tit,
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8 ,9 ,10, 11, 15, 16 ]
                                }
                            }
                        ]
                    });*/
                //      $('#dataTable').DataTable();
            }
        });
    }
    $(document).on('click', '#btnadd', function() {
        //  $('#bill_master_form')[0].reset();
        $('#form').show();
        $('#tbl').show();
        $('#column').show();
        $('#saveid').val('');
        $('#containerother_kyc1').html('');
        $('#purchase_billtbody').html('');

    });
    $(document).on('click', '#btncancel', function() {
        //  $('#bill_master_form')[0].reset();
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#containerother_kyc1').html('');


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
        if (save_update != "") {


            $('#serviceid' + save_update).html(service);
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
                '<td  id="amount_' + row_id + '">' + amount + '</td>' +
                '<td  id="quantity_' + row_id + '">' + quantity + '</td>' +
                '<td  id="total_amount_' + row_id + '">' + total_amount + '</td>' +
                '<td  id="paid_amount_' + row_id + '">' + paid_amount + '</td>' +
                '<td  id="balance_amount_' + row_id + '">' + balance_amount + '</td>' +
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

});