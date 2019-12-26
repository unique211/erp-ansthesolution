$(document).ready(function(){
	datashow();
	$('#mainform')[0].reset();
    $('#form').hide();
    $('#tbl').show();
    $('#column').show();
	$('#containerother_kyc1').html('');
	

var table_name="branch_mastre";

$('#dataTable').DataTable({
	dom: 'Bfrtip',
	//"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
	buttons: [
		
		{
			title: tit,
			extend: 'excelHtml5',
			exportOptions: {
				columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11, 12]
			}
		}
	]
});
    $(document).on('submit',"#mainform",function(e){
        e.preventDefault();
       
		var data= $('#mainform').serialize();
	
		var id=$('#saveid').val();
		var branch_name=$('#branch_name').val();
		var address=$('#address').val();
		var branch_phone_no=$('#branch_phone_no').val();
		var branch_city=$('#branch_city').val();
		var contact_name=$('#contact_name').val();
		var contact_email=$('#contact_email').val();
		var contact_phone_no=$('#contact_phone_no').val();

		var bankname=$('#bankname').val();
		var bankbranchname=$('#bankbranchname').val();
		var acno=$('#acno').val();
		var zfsccode=$('#zfsccode').val();
	
		$.ajax({
		    	type:"post",
			url:base_url+"Createbranch/adddata",
			dataType:"json",
			//fileElementId:'userfile',
			data:{
				id:id,
                branch_name:branch_name,
                address:address,
                branch_phone_no:branch_phone_no,
                branch_city:branch_city,
                contact_name:contact_name,
                contact_email:contact_email,
				contact_phone_no:contact_phone_no,
				bankname:bankname,
				bankbranchname:bankbranchname,
				acno:acno,
				zfsccode:zfsccode,
				table_name:table_name
			},
			async:false,
			success: function(data){
                if(id==""){
				successTost("Operation Save Successfull");
						
                }else if(id >0)	{
                    successTost("Operation Update Successfull");
                }else{
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
    $(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
			
		var id1 = $(this).attr('id');
		var name = $('#name_'+id1).html();
		var address=$('#address_'+id1).html();
		var phone_no=$('#phone_no_'+id1).html();
		var b_city=$('#b_city_'+id1).html();
		var conname=$('#conname_'+id1).html();
		var con_email=$('#con_email_'+id1).html();
		var con_phoneno=$('#con_phoneno_'+id1).html();
		var bankname=$('#bankname_'+id1).html();
		var bankbranchname=$('#branchname_'+id1).html();
		var acno=$('#acno_'+id1).html();
		var zfsccode=$('#zfsccode_'+id1).html();
		
		
		$('#saveid').val(id1);
        
		$('#branch_name').val(name);
		$('#address').val(address);
		$('#branch_phone_no').val(phone_no);
		$('#branch_city').val(b_city);
		$('#contact_name').val(conname);
		$('#contact_email').val(con_email);
		$('#contact_phone_no').val(con_phoneno);
		$('#bankname').val(bankname);
		$('#bankbranchname').val(bankbranchname);
		$('#acno').val(acno);
		$('#zfsccode').val(zfsccode);
	});
	//End of Edit data
    
//Delete Data code starts here
    $(document).on('click','#btndelete',function(){
		
		var id1=$('#saveid').val();
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
							url:base_url+"Createbranch/deleteData",
							dataType:"json",
							data:{
								id:id1,
								table_name:table_name
							},
							dataType:"JSON",
							async:false,
							success: function(data){
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
					}else {
						swal("Cancelled", "Your record is safe :)", "error");
					}
				});
		}
		else{
			return false;
		}
    });
   
	function datashow(){
		//alert(table_name);
		$.ajax({
			type:"POST",
			url:base_url+"Createbranch/get_master",
			data:{		
				table_name:'branch_mastre',
			},
			dataType:"JSON",
			async:false,
			success: function(data){
				var data=eval(data);
				console.log(data);
				$('#tablebody').html('');
				var table="";
				index=1;
				for(var i=0;i<data.length;i++)
				{
					
					table+='<tr>'+
					'<td>'+index+'</td>'+
					'<td hidden id="id'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="name_'+data[i].id+'">'+data[i].name+'</td>'+
					'<td id="address_'+data[i].id+'">'+data[i].address+'</td>'+
					'<td id="phone_no_'+data[i].id+'">'+data[i].phone_no+'</td>'+
					'<td id="b_city_'+data[i].id+'">'+data[i].b_city+'</td>'+
					'<td id="conname_'+data[i].id+'">'+data[i].con_name+'</td>'+
					'<td  id="con_email_'+data[i].id+'">'+data[i].con_email+'</td>'+
					'<td id="con_phoneno_'+data[i].id+'">'+data[i].con_phoneno+'</td>'+
					'<td hidden id="bankname_'+data[i].id+'">'+data[i].bankname+'</td>'+
					'<td hidden id="branchname_'+data[i].id+'">'+data[i].bankbranchname+'</td>'+
					'<td hidden id="acno_'+data[i].id+'">'+data[i].acno+'</td>'+
					'<td hidden id="zfsccode_'+data[i].id+'">'+data[i].zfsccode+'</td>'+
					
					'<td><button type="button" name="edit" class="edit_data btn btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button> </td>'+
                    '</tr>' ;
                    index+=1;
				}
				$('#tablebody').append(table);
				/*$('#dataTable').DataTable({
					dom: 'Bfrtip',
					//"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
					buttons: [
						{
						    extend: 'pdfHtml5',
						    title: tit,
						    orientation: 'landscape',
						    pageSize: 'A4',
						    exportOptions: {
						        columns: [0 ,1, 2, 3]
						    },
						},
						{
							title: tit,
							extend: 'excelHtml5',
							exportOptions: {
								columns: [0,1, 2, 3]
							}
						}
					]
				});
				$('#dataTable').DataTable();*/
			}
		});
	}

	$(document).on('click','#btnadd',function(){
		$('#mainform')[0].reset();
		$('#form').show();
		$('#tbl').hide();
		$('#column').show();
		$('#saveid').val('');
		$('#containerother_kyc1').html('');
	 $('#purchase_billtbody').html('');
	   
	});
	$(document).on('click','#btncancel',function(){
		$('#mainform')[0].reset();
		$('#form').hide();
		$('#tbl').show();
		$('#column').show();
		$('#containerother_kyc1').html('');
	 
	   
	});
});