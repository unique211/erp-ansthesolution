$(document).ready(function(){
    //alert(table_name);
	$('#form').hide();
	$('#row').hide();
	$('#row1').hide();
	
	$(document).on('click','#btnadd',function(e){
		e.preventDefault();
		//alert("HII");	
		$('#form').show();
		$('#tbl').hide();		
		$('#column').hide();
	});
	$(document).on('click','#btncancel',function(e){
		e.preventDefault();
		//alert("HII");	
		$('#form').hide();
		$('#tbl').show();
		$('#column').show();
		$('#mainform')[0].reset();
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
        $('#save_update').val('');
	});
	$(document).on("change",'#payment',function(){
		var type=$('#payment option:selected').text();
		if(type=="Cheque"){
			$('#row').show();
            $('#row1').hide();
            $('#t_id').val('');
		}else if(type=="NEFT"){
			$('#row1').show();
            $('#row').hide();
            $('#b_name').val('');
            $('#check_no').val('');
		}
		else if(type=="RTGS"){
			$('#row1').show();
            $('#row').hide();
            $('#b_name').val('');
            $('#check_no').val('');
		}
		else {
			$('#row').hide();
            $('#row1').hide();
            $('#b_name').val('');
            $('#check_no').val('');
            $('#t_id').val('');
		}
	});
	$(document).on("change",".customer",function(e){
        e.preventDefault();
        var id1=$(this).val();          
		total();
        getcustomer("customer_master","id="+id1+"");
	});
	function total(){
		var url=base_url + "Controller/showTotal";
		var where=$('#customer').val();
		var table="salesbill_master";
		//alert(url);
		$.ajax({
            type: "POST",
            url: url,
            data: { table_name: table,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
				console.log(data);
				data=Math.round(data);
				$('#total_balance').val(data);
            },
            error:function(){
            }
            
        });
	}
	function getcustomer(table_name,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data[0].address)
                    $('#address').val(data[0].address);
                  //  $('#mobile_no').val(data[0].mobile);
            },
            error:function(){
            }
            
        });
    }
	$(document).on('change','#type',function(){
		total();
		/*var balance=parseFloat(diff)-parseFloat(tot);
		balance=Math.abs(balance);
		$('#total_balance').val(balance);*/
	});

	$(document).on('submit',"#mainform",function(e){
		e.preventDefault();
		var url=base_url+"Controller/adddata";
		var id=$('#saveid').val();
		var e_no=$('#e_no').val();
		var entry_date=$('#entry_date').val();
		var name=$('#customer').val();
		var r_no=$('#r_no').val();
		var r_date=$('#r_date').val();
		var type=$('#type').val();
		var a_group=$('#a_group').val();
		var payment=$('#payment').val();
		var b_name=$('#b_name').val();
		var check_no=$('#check_no').val();
		var t_id=$('#t_id').val();
		var amount=$('#amount').val();
		var remark=$('#remark').val();
		var tdateAr = r_date.split('/');
		r_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];  
		var tdateAr = entry_date.split('/');
        entry_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];  
		//alert(url);
		$.ajax({
			type:"post",
			url:url,
			dataType:"json",
			data:{
				id:id,
				e_no:e_no,
				entry_date:entry_date,
				name:name,
				r_no:r_no,
				r_date:r_date,
				type:type,
				a_group:a_group,
				payment:payment,
				b_name:b_name,
				check_no:check_no,
				t_id:t_id,
				amount:amount,
				remark:remark,
				table_name:table_name
			},
			dataType:"JSON",
			async:false,
			success: function(data){
				//alert("Success");
				successTost("Operation Successfull");
				//datashow();
			},
			error:function(){
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

	$(document).on('click','#btndelete',function(){
		$('#mainform')[0].reset();	
	});
    
    
	//Show data Function
	datashow();
	
	function datashow(){
		
		$.ajax({
			type:"POST",
			url:base_url+"Controller/showData",
			data:{		
				table_name: table_name
			},
			dataType:"JSON",
			async:false,
			success: function(data){
				var data=eval(data);
				$('#tablebody').html('');
				var table="";
				var index=1;
				
				for(var i=0;i<data.length;i++)
				{
					var tdateAr = data[i].r_date.split('-');
					var r_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					//alert(r_date);
					var tdateAr = data[i].e_date.split('-');
                    var e_date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					table+='<tr>'+
					'<td >'+index+'</td>'+
					'<td hidden id="id'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="sname_'+data[i].id+'">'+data[i].customernm+'</td>'+
					'<td id="r_no_'+data[i].id+'">'+data[i].r_no+'</td>'+
					'<td id="r_date_'+data[i].id+'">'+r_date+'</td>'+
					'<td id="type_'+data[i].id+'">'+data[i].type+'</td>'+
					'<td id="paynm_'+data[i].id+'">'+data[i].paynm+'</td>'+
					'<td id="amt_'+data[i].id+'">'+data[i].amount+'</td>'+
					'<td id="remark_'+data[i].id+'">'+data[i].remark+'</td>'+
					'<td hidden id="name_'+data[i].id+'">'+data[i].name+'</td>'+
					'<td hidden id="eno_'+data[i].id+'">'+data[i].e_no+'</td>'+
					'<td hidden id="edt_'+data[i].id+'">'+e_date+'</td>'+
					'<td hidden id="ag_'+data[i].id+'">'+data[i].agroup+'</td>'+
					'<td hidden id="bnm_'+data[i].id+'">'+data[i].bankname+'</td>'+
					'<td hidden id="chk_'+data[i].id+'">'+data[i].checkno+'</td>'+
					'<td hidden id="t_id_'+data[i].id+'">'+data[i].t_id+'</td>'+
					'<td hidden id="pay_'+data[i].id+'">'+data[i].payment+'</td>'+
					'<td><button type="button" name="edit" class="edit_data  btn btn-xs btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class=" btn btn-xs delete_data btn-danger" id="'+data[i].id+'"><i class="fa fa-trash"></i></button></td>'+
					'</tr>' ;
					index+=1;
				}
				$('#tablebody').append(table);
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
						        columns: [1, 2, 3, 4, 5, 6, 7, 8, 13, 14, 15]
						    },
						},
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
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
			
		var id1 = $(this).attr('id');
		var e_no=$('#eno_'+id1).html();
		var e_date=$('#edt_'+id1).html();
		var name = $('#name_'+id1).html();
		var r_no=$('#r_no_'+id1).html();
		var r_date=$('#r_date_'+id1).html();	
		var type=$('#type_'+id1).html();
		var agroup=$('#ag_'+id1).html();
		var payment=$('#pay_'+id1).html();
		var bankname=$('#bnm_'+id1).html();
		var checkno=$('#chk_'+id1).html();
		var t_id=$('#t_id_'+id1).html();
		var amount=$('#amt_'+id1).html();
		var remark=$('#remark_'+id1).html();
		$('#saveid').val(id1);
		$('#e_no').val(e_no);
		$('#entry_date').val(e_date);
		$('#customer').val(name).trigger('change');
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
		var type=$('#paynm_'+id1).html();
		//alert(type);
		if(type=="Cheque"){
			$('#row').show();
            $('#row1').hide();
            $('#t_id').val('');
		}else if(type=="NEFT"){
			$('#row1').show();
            $('#row').hide();
            $('#b_name').val('');
            $('#check_no').val('');
		}
		else if(type=="RTGS"){
			$('#row1').show();
            $('#row').hide();
            $('#b_name').val('');
            $('#check_no').val('');
		}
		else {
			$('#row').hide();
            $('#row1').hide();
            $('#b_name').val('');
            $('#check_no').val('');
            $('#t_id').val('');
		}

	});
	//End of Edit data

	//Delete Data code starts here
	$(document).on('click','.delete_data',function(e){
		e.preventDefault();
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
	//Delete Data code starts here*/
});