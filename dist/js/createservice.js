$(document).ready(function() {

    getMasterSelect("branch_mastre", "#branchname", " status = '1' ");
    var table_name = "service_master";
    datashow();
    $('#mainform')[0].reset();
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
                    columns: [0, 3, 4, 5]
                }
            }
        ]
    });

    function getMasterSelect(table_name, selecter, where) {

        $.ajax({
            type: "POST",
            url: base_url + "Service/getdropdown",
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


                    name = data[i].name;
                    id = data[i].id;

                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            }
        });
    }
    $(document).on('submit', "#mainform", function(e) {
        e.preventDefault();

        var data = $('#mainform').serialize();

        var id = $('#saveid').val();
        var branch_name = $('#branchname').val();
        var service_name = $('#service_name').val();
        var amount = $('#amount').val();


        $.ajax({
            type: "post",
            url: base_url + "Service/adddata",
            dataType: "json",
            //fileElementId:'userfile',
            data: {
                id: id,
                branch_name: branch_name,
                service_name: service_name,

                amount: amount,
                table_name: table_name
            },
            async: false,
            success: function(data) {
                if (id == "") {
                    successTost("Operation Save Successfull");

                } else if (id > 0) {
                    successTost("Operation Update Successfull");
                } else {
                    errorTost("Operation Failed for login master");
                }
            }
        });
        $('#mainform')[0].reset();
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#containerother_kyc1').html('');
        datashow();
    });


    /*----Edit Code Here-------*/
    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();
        $('#form').show();
        $('#tbl').hide();
        $('#column').hide();

        var id1 = $(this).attr('id');
        var bramchid = $('#branchid_' + id1).html();
        var s_name = $('#s_name_' + id1).html();
        var amount = $('#amount_' + id1).html();




        $('#saveid').val(id1);

        $('#branchname').val(bramchid).trigger('change');
        $('#service_name').val(s_name);
        $('#amount').val(amount);

    });
    //End of Edit data

    //Delete Data code starts here
    $(document).on('click', '#btndelete', function() {

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
                            url: base_url + "Service/deleteData",
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
                                $('#mainform')[0].reset();
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

    function datashow() {

        $.ajax({
            type: "POST",
            url: base_url + "Service/get_master",
            data: {
                table_name: 'service_master',
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data = eval(data);
                console.log(data);

                $('#tablebody').html('');
                var table = "";


                index = 1;
                for (var i = 0; i < data.length; i++) {

                    table += '<tr>' +
                        '<td>' + index + '</td>' +
                        '<td hidden id="id' + data[i].id + '">' + data[i].id + '</td>' +
                        '<td hidden id="branchid_' + data[i].id + '">' + data[i].bramchid + '</td>' +
                        '<td id="branchname' + data[i].id + '">' + data[i].branchname + '</td>' +
                        '<td id="s_name_' + data[i].id + '">' + data[i].s_name + '</td>' +
                        '<td  style="text-align:right;" id="amount_' + data[i].id + '">' + parseFloat(data[i].amount).toFixed(2) + '</td>';
                    if (role == "admin") {
                        table += '<td><button type="button" name="edit" class="edit_data btn btn-success" id="' + data[i].id + '"><i class="fa fa-edit"></i></button> </td>';
                    }
                    table += '</tr>';
                    index += 1;
                }
                $('#tablebody').append(table);
                /* $('#dataTable').DataTable();
                  $('#dataTable').DataTable({
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
                    });
                    //$('#dataTable').DataTable();*/
            }
        });
    }
    $(document).on('click', '#btnadd', function() {
        $('#mainform')[0].reset();
        $('#form').show();
        $('#tbl').hide();
        $('#column').show();
        $('#containerother_kyc1').html('');


    });

    $(document).on('click', '#btncancel', function() {
        $('#mainform')[0].reset();
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#containerother_kyc1').html('');


    });
});