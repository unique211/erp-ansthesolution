$(document).ready(function() {


    var table_name = "bill_master";

    //  $('#bill_master_form')[0].reset();
    $('#form').show();
    $('#tbl').show();
    $('#column').show();
    $('#containerother_kyc1').html('');

    /*---------- Start For Getting branch In to Dropdown--------*/
    getMasterSelect("customer_matserdata", "#customername", " status = '1' ");

    function getMasterSelect(table_name, selecter, where) {

        $.ajax({
            type: "POST",
            url: base_url + "Billoutstandingreport/getdropdown",
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
                                // $('#bill_master_form')[0].reset();
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

    /*----for data table------*/
    function fnFormatDetails(table_id, html) {
        var sOut = "<table id=\"myTable" + table_id + "\">";
        sOut += html;
        sOut += "</table>";
        return sOut;
    }
    var iTableCounter = 1;
    var oTable;
    var oInnerTable;
    var TableHtml;
    var detailsTableHtml;
    var nTr = "";
    var colsetb = "";
    $(document).on('change', '#customername', function(e) {
        e.preventDefault();
        var id = $(this).val();

        $.ajax({
            type: "POST",
            url: base_url + "Billoutstandingreport/get_master",
            data: {
                table_name: 'bill_master',
                id: id,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                var data = eval(data);
                console.log(data);
                //  $('#tablebody').html('');

                var table = "";
                var table1 = "";
                if (data.length > 0) {
                    table += '<table id="myTable" class="table table-striped" style="width:100%;">' +
                        '<thead>' +
                        '<tr>' +

                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Billing id.</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Date</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;"> Branch Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Customer Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Branchname</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Customer Name</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Total Amount	</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">PaidAmount</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">BalanceAmount</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;"">Distributor id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Distributor Name</th>' +

                        //  '<th style="white-space:nowrap;text-align:left;padding:10px;"></th>'+
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    var totalbillingamt = 0;
                    index = 1;
                    var date = "";
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].bill_date != "0000-00-00") {

                            var tdateAr = data[i].bill_date.split('-');
                            date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                        }

                        table += '<tr  id="' + data[i].id + '">' +
                            '<td>' + index + '</td>' +
                            '<td  id="date_' + data[i].id + '">' + date + '</td>' +
                            '<td  style="display:none;" id="id_' + data[i].id + '">' + data[i].branchid + '</td>' +
                            '<td  style="display:none;" id="id_' + data[i].id + '">' + data[i].id + '</td>' +
                            '<td  style="display:none;" id="customerid_' + data[i].id + '">' + data[i].customerid + '</td>' +

                            '<td  id="serviceid' + data[i].id + '">' + data[i].branchname + '</td>' +
                            '<td  id="servicename' + data[i].id + '">' + data[i].coustomer + '</td>' +
                            '<td  style="text-align:right;"  id="branch_id_' + data[i].id + '">' + data[i].grandamt + '</td>' +

                            '<td  style="text-align:right;"  id="qty_' + data[i].id + '">' + data[i].totalpaidamt + '</td>' +
                            '<td   style="text-align:right;"  id="totalpaidamt_' + data[i].id + '">' + data[i].ramindamt + '</td>' +
                            '<td   id="amount_' + data[i].id + '" style="display:none;">' + data[i].distributorid + '</td>' +
                            '<td id="amount_' + data[i].id + '">' + data[i].distributor + '</td>' +

                            // '<td> <button id="btn_'+data[i].id+'" name="btn_'+data[i].id+'" class="btn btn-sm btn-success btnplus" >+</button></td>'+

                            '</tr>';
                        index += 1;
                    }
                    table += '</tbody></table>';
                    $('#tabledata').html(table);
                    // $('#myTable').DataTable({});

                } else {
                    $('#tabledata').html('');
                }
            }
        });

        $('#billno').val('');
        $('#pdfprint').attr('disabled', 'disabled');
        $('#myTable tr').click(function() {
            var cid = $(this).attr('id');

            $.ajax({
                type: "POST",
                url: base_url + "Billoutstandingreport/get_billdescription",
                data: {
                    table_name: 'bill_master',
                    id: cid,
                },
                dataType: "JSON",
                async: false,
                success: function(data1) {
                    var table1 = "";
                    if (data1.length > 0) {

                        table1 += '<table id="myTable1" class="table table-striped" style="width:100%;">' +
                            '<thead>' +
                            '<tr>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;">Id</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;">Service</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;"> Service Id</th>' +
                            '<th  style="white-space:nowrap;text-align:left;padding:10px;text-align:right;">Qty</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;text-align:right;">Amount</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;text-align:right;">Total Amount	</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;text-align:right;">PaidAmount</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px;text-align:right;">Remain Amount</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        var totalbillingamt = 0;
                        sr = 1;

                        for (var i = 0; i < data1.length; i++) {


                            table1 += '<tr  id="' + data1[i].id + '">' +
                                '<td>' + sr + '</td>' +

                                '<td  id="servicename' + data1[i].id + '">' + data1[i].servicename + '</td>' +
                                '<td  style="display:none;" id="serviceid' + data1[i].id + '">' + data1[i].serviceid + '</td>' +
                                '<td   style="text-align:right;" id="qty_' + data1[i].id + '">' + data1[i].qty + '</td>' +
                                '<td  style="text-align:right;"  id="totalpaidamt_' + data1[i].id + '">' + data1[i].amt + '</td>' +
                                '<td   style="text-align:right;" id="amount_' + data1[i].id + '">' + data1[i].totalamt + '</td>' +
                                '<td  style="text-align:right;" id="amount_' + data1[i].id + '">' + data1[i].paidamt + '</td>' +
                                '<td   style="text-align:right;"  id="date_' + data1[i].id + '">' + data1[i].remainamt + '</td>' +
                                '</tr>';
                            sr += 1;

                        }

                        $("#myTable1").html(table1);
                        // $('#detailsTable').DataTable({});
                    }
                }
            });
            detailsTableHtml = $("#myTable" + iTableCounter).html();
        });


        detailsTableHtml = $("#myTable").html();

        //  alert(iTableCounter+""+detailsTableHtml);
        //Insert a 'details' column to the table
        var nCloneTh = document.createElement('th');
        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<img src="http://i.imgur.com/SD7Dz.png">';
        nCloneTd.className = "center";

        $('#myTable thead tr').each(function() {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        $('#myTable tbody tr').each(function() {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });
        var oTable = $('#myTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [0] }
            ],
            "aaSorting": [
                [1, 'asc']
            ]
        });
        $('#myTable tbody td img').on('click', function() {
            colsetb = nTr;
            nTr = $(this).parents('tr')[0];



            var parent = $(this).closest('table').find('thead > tr th');

            if (oTable.fnIsOpen(nTr)) {
                /* This row is already open - close it */
                // this.src = "http://i.imgur.com/d4ICC.png";
                // this.src = "http://i.imgur.com/SD7Dz.png";
                oTable.fnClose(nTr);
            } else {
                /* Open this row */
                this.src = "http://i.imgur.com/SD7Dz.png";
                oTable.fnClose(colsetb);
                // this.src = "http://i.imgur.com/d4ICC.png";
                oTable.fnOpen(nTr, fnFormatDetails(iTableCounter, detailsTableHtml), 'details');
                /* oInnerTable = $("#myTable_").dataTable({
                     "bJQueryUI": true,
                     "sPaginationType": "full_numbers"
                 });*/
                // iTableCounter = iTableCounter + 1;

            }
        });
    });


    function getdata(id) {
        $.ajax({
            type: "POST",
            url: base_url + "Billoutstandingreport/get_masterdata",
            data: {
                table_name: 'bill_master',
                id: id,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                var data = eval(data);
                console.log(data);
                //  $('#tablebody').html('');

                var table = "";
                if (data.length > 0) {
                    table += '<table id="myTable" class="table table-striped" style="width:100%;">' +
                        '<thead>' +
                        '<tr>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Billing id.</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Customer Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">FullName</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Serviceid</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Servicename</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Branch Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Quantity</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Total Amount	</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Amount</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">PaidAmount</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">BalanceAmount</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Date</th>' +

                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    var totalbillingamt = 0;
                    index = 1;
                    var date = "";
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].bill_date != "0000-00-00") {

                            var tdateAr = data[i].bill_date.split('-');
                            date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0];

                        }

                        table += '<tr>' +
                            '<td>' + index + '</td>' +
                            '<td  style="display:none;" id="id_' + data[i].id + '">' + data[i].id + '</td>' +
                            '<td  style="display:none;" id="customerid_' + data[i].id + '">' + data[i].customerid + '</td>' +
                            '<td  id="coustomername_' + data[i].id + '">' + data[i].coustomer + '</td>' +



                            '<td style="display:none;"  id="serviceid' + data[i].id + '">' + data[i].serviceid + '</td>' +
                            '<td  id="servicename' + data[i].id + '">' + data[i].servicename + '</td>' +
                            '<td style="display:none;"  id="branch_id_' + data[i].id + '">' + data[i].branchid + '</td>' +

                            '<td  id="qty_' + data[i].id + '">' + data[i].qty + '</td>' +
                            '<td  id="totalpaidamt_' + data[i].id + '">' + data[i].totalamt + '</td>' +
                            '<td id="amount_' + data[i].id + '">' + data[i].amount + '</td>' +

                            '<td  id="totalpaidamt_' + data[i].id + '">' + data[i].paidamt + '</td>' +
                            '<td  id="totalpaidamt_' + data[i].id + '">' + data[i].ramindamt + '</td>' +
                            '<td  id="date_' + data[i].id + '">' + date + '</td>' +
                            '</tr>';
                        index += 1;
                    }
                    table += '</tbody></table>';
                    $('#tabledata').html(table);
                    $('#myTable').DataTable({});

                } else {
                    $('#tabledata').html('');
                }
            }
        });
        $('#billno').val('');


    }


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