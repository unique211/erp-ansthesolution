$(document).ready(function() {
    //alert(table_name);	
    var table_name = "payment_master"
    $('#form').hide();
    $('#row').hide();
    $('#row1').hide();
    var customer = "";
    var diff = 0;
    var tot = 0;
    datashow();

    function total() {
        var where = $('#supplier_name').val();
        var table = "paychasebill_master";
        //alert(where);
        $.ajax({
            type: "POST",
            url: base_url + "Controller/showTotal",
            data: {
                table_name: table,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                $('#total_balance').val(data);
            },
            error: function() {}

        });
    }

    //getMasterSelect("account_group", ".a_group");
    $(document).on('click', '#btnadd', function(e) {
        e.preventDefault();
        //alert("HII");	
        $('#form').show();
        $('#tbl').hide();
        $('#column').hide();
    });
    $(document).on('click', '#btncancel', function(e) {
        e.preventDefault();
        //alert("HII");	
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#mainform')[0].reset();
        $('.date').datepicker({
            'todayHighlight': true,
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
        var date = new Date();
        date = date.toString('dd/MM/yyyy');
        $("#bill_date").val(date);
        $("#entry_date").val(date);
        $('#saveid').val('');
        $('#save_update').val('');
    });
    $(document).on("change", '#payment', function() {
        var type = $('#payment option:selected').text();
        if (type == "Cheque") {
            $('#row').show();
            $('#row1').hide();
        } else if (type == "NEFT") {
            $('#row1').show();
            $('#row').hide();
        } else if (type == "RTGS") {
            $('#row1').show();
            $('#row').hide();
        } else {
            $('#row').hide();
            $('#row1').hide();
        }
    });
    $(document).on('change', '#type', function() {
        var id = $(this).val();

        /*$.ajax({
            type: "POST",
            url: base_url + "Paymentreturn/getcustomerpayment",
            data: { 
				id:id,
				customer:customer,
				table_name: 'payment_master' ,
			},
            dataType: "JSON",
            async: false,
            success: function(data) {
			//  alert("HII");
			var fulltotal=0;
			var data = eval(data);
			if(data.length>0){
				var paymenttotal=data;	
		
				if(type=="payment"){
				var total=	$('#getamttotal').val();
				fulltotal=parseFloat(total)-parseFloat(paymenttotal);
				$('#total_balance').val(fulltotal);	
				}else{
				var total=	$('#getamttotal').val();
				fulltotal=parseFloat(total)+parseFloat(paymenttotal);
				$('#total_balance').val(fulltotal);	
				}
				
			}else{
				var total=	$('#getamttotal').val();
				$('#total_balance').val(total);	
			}
			}
		});*/
    });
    /*---------get data------*/
    $(document).on('change', '.supplier_name', function(e) {
        e.preventDefault();
        var id = $(this).val();
        customer = id;
        $.ajax({
            type: "POST",
            url: base_url + "Paymentreturn/gettotalremainamt",
            data: {
                id: id,
                table_name: 'bill_master',
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                //  alert("HII");
                var data = eval(data);
                if (data.length > 0) {
                    $('#total_balance').val(data[0].remainamt);
                    $('#getamttotal').val(data[0].remainamt);
                    $('#address').val(data[0].address);
                } else {
                    $('#total_balance').val('0');
                    $('#getamttotal').val('0');
                    $('#address').val(data[0].address);
                }
            }
        });

    });

    function getsuppiler(table_name, where) {
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
                //$('#mobile_no').val(data[0].mobile);
            },
            error: function() {

            }

        });
    }

    $(document).on('submit', "#mainform", function(e) {
        e.preventDefault();
        var url = base_url + "Paymentreturn/adddata";
        var id = $('#saveid').val();
        var e_no = $('#e_no').val();
        var entry_date = $('#entry_date').val();
        var name = $('#supplier_name').val();
        var r_no = $('#r_no').val();
        var r_date = $('#r_date').val();
        var type = $('#type').val();
        var a_group = $('#a_group').val();
        var payment = $('#payment').val();
        var b_name = $('#b_name').val();
        var check_no = $('#check_no').val();
        var t_id = $('#t_id').val();
        var amount = $('#amount').val();
        var remark = $('#remark').val();
        var tdateAr = r_date.split('/');
        r_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
        var tdateAr = entry_date.split('/');
        entry_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
        //alert(url);
        $.ajax({
            type: "post",
            url: url,
            dataType: "json",
            data: {
                id: id,
                e_no: e_no,
                entry_date: entry_date,
                name: name,
                r_no: r_no,
                r_date: r_date,
                type: type,
                a_group: a_group,
                payment: payment,
                b_name: b_name,
                check_no: check_no,
                t_id: t_id,
                amount: amount,
                remark: remark,
                table_name: table_name
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                //alert("Success");
                successTost("Operation Successfull");
                //datashow();
            },
            error: function() {
                //alert("failed");
                errorTost("Operation Failed");
            }
        });
        $('#mainform')[0].reset();
        $('#form').hide();
        $('#tbl').show();
        $('#column').show();
        $('#saveid').val('');
        datashow();
    });
    //End of Form submitting function




    //Show data Function
    datashow();

    function datashow() {

        $.ajax({
            type: "POST",
            url: base_url + "Paymentreturn/get_master",
            data: {
                table_name: table_name
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data = eval(data);
                $('#tablebody').html('');
                var table1 = $('#dataTable').DataTable();
                table1.destroy();
                var table = "";
                var index = 1;

                for (var i = 0; i < data.length; i++) {
                    var tdateAr = data[i].r_date.split('-');
                    var r_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
                    //alert(r_date);
                    var tdateAr = data[i].e_date.split('-');
                    var e_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
                    var paynm = "";
                    var type = "";
                    if (data[i].payment == "Cash") {
                        paynm = "by chase";
                    } else if (data[i].payment == "Cheque") {
                        paynm = "by cheque";
                    } else if (data[i].payment == "RIGS") {
                        paynm = "RIGS";
                    } else if (data[i].payment == "NEFT") {
                        paynm = "NEFT";
                    }

                    if (data[i].type == "payment") {
                        type = "Credit";
                    } else {
                        type = "Debit";
                    }
                    table += '<tr>' +
                        '<td >' + index + '</td>' +
                        '<td hidden id="id' + data[i].id + '">' + data[i].id + '</td>' +
                        '<td id="sname_' + data[i].id + '">' + data[i].customername + '</td>' +
                        '<td id="r_no_' + data[i].id + '">' + data[i].r_no + '</td>' +
                        '<td id="r_date_' + data[i].id + '">' + r_date + '</td>' +
                        '<td id="type_' + data[i].id + '">' + type + '</td>' +
                        '<td id="paynm_' + data[i].id + '">' + paynm + '</td>' +
                        '<td style="text-align:right;" id="amt_' + data[i].id + '">' + data[i].amount + '</td>' +
                        '<td id="remark_' + data[i].id + '">' + data[i].remark + '</td>' +
                        '<td hidden id="name_' + data[i].id + '">' + data[i].name + '</td>' +
                        '<td hidden id="eno_' + data[i].id + '">' + data[i].e_no + '</td>' +
                        '<td hidden id="edt_' + data[i].id + '">' + e_date + '</td>' +
                        '<td hidden id="ag_' + data[i].id + '">' + data[i].agroup + '</td>' +
                        '<td hidden id="bnm_' + data[i].id + '">' + data[i].bankname + '</td>' +
                        '<td hidden id="chk_' + data[i].id + '">' + data[i].checkno + '</td>' +
                        '<td hidden id="t_id_' + data[i].id + '">' + data[i].t_id + '</td>' +
                        '<td hidden id="pay_' + data[i].id + '">' + data[i].payment + '</td>' +
                        '<td><button type="button" name="edit" class="edit_data  btn btn-xs btn-success" id="' + data[i].id + '"><i class="fa fa-edit"></i></button></td>' +
                        '</tr>';
                    index += 1;
                }
                $('#tablebody').append(table);
                $('#dataTable').DataTable({
                    dom: 'Bfrtip',
                    //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
                    buttons: [

                        {
                            title: tit,
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 13, 14, 15]
                            }
                        }
                    ]
                });
            }

        });
    }
    //Edit data code
    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();
        $('#form').show();
        $('#tbl').hide();
        $('#column').hide();

        var id1 = $(this).attr('id');
        var e_no = $('#eno_' + id1).html();
        var e_date = $('#edt_' + id1).html();
        var name = $('#name_' + id1).html();
        var r_no = $('#r_no_' + id1).html();
        var r_date = $('#r_date_' + id1).html();
        var type = $('#type_' + id1).html();
        var agroup = $('#ag_' + id1).html();
        var payment = $('#pay_' + id1).html();
        var bankname = $('#bnm_' + id1).html();
        var checkno = $('#chk_' + id1).html();
        var t_id = $('#t_id_' + id1).html();
        var amount = $('#amt_' + id1).html();
        var remark = $('#remark_' + id1).html();
        $('#saveid').val(id1);
        $('#e_no').val(e_no);
        $('#entry_date').val(e_date);
        $('#supplier_name').val(name).trigger('change');
        $('#r_no').val(r_no);
        $('#r_date').val(r_date);
        $('#type').val(type);
        $('#a_group').val(agroup);
        $('#payment').val(payment);
        $('#b_name').val(bankname);
        $('#check_no').val(checkno);
        $('#t_id').val(t_id);
        $('#amount').val(amount);
        $('#remark').val(remark);
        var type = $('#paynm_' + id1).html();
        //alert(type);
        if (type == "Cheque") {
            $('#row').show();
            $('#row1').hide();
        } else if (type == "NEFT") {
            $('#row1').show();
            $('#row').hide();
        } else if (type == "RTGS") {
            $('#row1').show();
            $('#row').hide();
        } else {
            $('#row').hide();
            $('#row1').hide();
        }

    });
    //End of Edit data

    //Delete Data code starts here
    $(document).on('click', '.delete_data', function(e) {
        e.preventDefault();
        var id1 = $('#saveid').val();
        //$('#saveid').val(id1);
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
                            url: base_url + "Paymentreturn/deleteData",
                            dataType: "json",
                            data: {
                                id: id1,
                                table_name: table_name
                            },
                            success: function(data) {
                                //alert(data);
                                swal("Deleted!", "Your Record has been deleted.", "success");
                                $('#mainform')[0].reset();
                                $('#form').hide();
                                $('#tbl').show();
                                $('#column').show();
                                $('#saveid').val('');
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
    //Delete Data code starts here*/
    getMasterSelect('customer_matserdata', '.supplier_name');
    getMasterSelect('account_group', '#a_group');
    /*--------Fill The Customer Name In Drop Down ------------*/
    function getMasterSelect(table_name, selecter) {
        $.ajax({
            type: "POST",
            url: base_url + "Paymentreturn/getdropdowndata",
            data: { table_name: table_name },
            dataType: "JSON",
            async: false,
            success: function(data) {
                //  alert("HII");
                var data = eval(data);
                console.log("Data is:" + data);
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>';
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    if (table_name == "customer_matserdata") {
                        name = data[i].customername;
                        id = data[i].id;
                    } else {
                        name = data[i].name;
                        id = data[i].id;
                    }
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            },
            error: function() {

            }

        });
    }


});