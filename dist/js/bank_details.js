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
    $(document).on('click','#btndelete',function(){
		$('#mainform')[0].reset();	
	});
    //Form submit function starts here..........
    $(document).on('submit',"#mainform",function(e){
		e.preventDefault();
		var url=base_url+"Controller/adddata";
		var id=$('#saveid').val();
		var bankname=$('#bankname').val();
		var acno=$('#account_no').val();
		var branch=$('#branch').val();
		var payment=$('#payment').val();
		var b_name=$('#b_name').val();
		var check_no=$('#check_no').val();
		var t_id=$('#t_id').val();
		var amount=$('#amount').val();
		var remark=$('#remark').val();
		var pay_opt=$('#payment_option').val();
		$.ajax({
			type:"post",
			url:url,
			dataType:"json",
			data:{
				id:id,
				bankname:bankname,
				acno:acno,
				branch:branch,
				payment:payment,
				b_name:b_name,
				check_no:check_no,
				t_id:t_id,
				amount:amount,
                remark:remark,
                pay_opt:pay_opt,
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
					
					table+='<tr>'+
					'<td >'+index+'</td>'+
					'<td hidden id="id'+data[i].id+'">'+data[i].id+'</td>'+
                    '<td id="name_'+data[i].id+'">'+data[i].b_name+'</td>'+
                    '<td id="acno_'+data[i].id+'">'+data[i].ac_no+'</td>'+
                    '<td id="branch_'+data[i].id+'">'+data[i].branch+'</td>'+
                    '<td id="paynm_'+data[i].id+'">'+data[i].paynm+'</td>'+
                    '<td id="opt_'+data[i].id+'">'+data[i].pay_opt+'</td>'+
					'<td id="amt_'+data[i].id+'">'+data[i].amount+'</td>'+
                    '<td id="remark_'+data[i].id+'">'+data[i].remark+'</td>'+
                    '<td hidden id="bname_'+data[i].id+'">'+data[i].bname+'</td>'+
                    '<td hidden id="chk_'+data[i].id+'">'+data[i].checkno+'</td>'+
					'<td hidden id="t_id_'+data[i].id+'">'+data[i].t_id+'</td>'+
					'<td hidden id="pay_'+data[i].id+'">'+data[i].payment+'</td>'+
					'<td><button type="button" name="edit" class="edit_data btn btn-xs btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class="btn btn-xs delete_data btn-danger" id="'+data[i].id+'"><i class="fa fa-trash"></i></button></td>'+
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
						        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
						    },
						},
						{
							title: tit,
							extend: 'excelHtml5',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
							}
						}
					]
				});
			}
		});
    }
    //End of datashow function
    //Edit data code
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
			
		var id1 = $(this).attr('id');
		var bname=$('#name_'+id1).html();
		var acno=$('#acno_'+id1).html();
		var branch = $('#branch_'+id1).html();
		var payment=$('#pay_'+id1).html();
		var bankname=$('#bname_'+id1).html();
		var checkno=$('#chk_'+id1).html();
		var t_id=$('#t_id_'+id1).html();
		var amount=$('#amt_'+id1).html();
        var remark=$('#remark_'+id1).html();
        var pay_opt=$('#opt_'+id1).html();
		$('#saveid').val(id1);
		$('#bankname').val(bname);
		$('#account_no').val(acno);
		$('#branch').val(branch);
		$('#payment').val(payment);
		$('#b_name').val(bankname);
		$('#check_no').val(checkno);
		$('#t_id').val(t_id);
		$('#amount').val(amount);
        $('#remark').val(remark);
        $('#payment_option').val(pay_opt);
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