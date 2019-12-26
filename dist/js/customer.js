$(document).ready(function(){
	//alert(table_name);	
		
	$('#form').hide();
	var validate=0;
	var check=0;
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
		$('#mainform')[0].reset();
        $('#saveid').val('');
        $('#save_update').val('');
	});
	$(document).on("blur","#mobile",function(e){
		var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		var m=$('#mobile').val();
		if (filter.test(m))
		{
			if(m.length==10){
				validate = 1;
		   } else {
				swal({ title: "Opss...",text: "Please Enter 10 digits!",
				type: "warning",});
			   //alert('Please put 10  digit mobile number');
			   validate = 0;
		   }
		}
		else {
			swal("Not a valid number");
			validate = 0;
		  }
	});
	
	$(document).on('submit',"#mainform",function(){
		/**/
		
		//alert(validate);
		var url=base_url+"Controller/adddata";
		var id=$('#saveid').val();
		var name=$('#name').val();
		var address=$('#address').val();
		var mobile=$('#mobile').val();
		var gstin=$('#gstin').val();
		if(validate == 1 ){
			$.ajax({
				type:"post",
				url:url,
				dataType:"json",
				data:{
					id:id,
					name:name,
					address:address,
					mobile:mobile,
					gstin:gstin,
					table_name:table_name
				},
				success: function(data){
					//alert("Success");
					datashow();
					successTost("Operation Successfull");
				},
				error:function(){
					//alert("failed");
					errorTost("Operation Failed");
				}
			});
		}
		else{
			swal("Please Enter 10 digits");

		}
	});
	//End of Form
	
	//ShowData of table
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
				for(var i=0;i<data.length;i++)
				{
					table+='<tr>'+
					'<td id="id'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="name_'+data[i].id+'">'+data[i].name+'</td>'+
					'<td id="address_'+data[i].id+'">'+data[i].address+'</td>'+
					'<td id="mobile_'+data[i].id+'">'+data[i].mobile+'</td>'+
					'<td id="gstin_'+data[i].id+'">'+data[i].gstin+'</td>'+
				    '<td><button type="button" name="edit" class="edit_data  btn btn-xs btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class=" btn btn-xs delete_data btn-danger" id="'+data[i].id+'"><i class="fa fa-trash"></i></button></td>'+
	                '</tr>' ;
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
							        columns: [0, 1, 2, 3, 4]
							    },
							},
							{
									title: tit,
									extend: 'excelHtml5',
									exportOptions: {
											columns: [0, 1, 2, 3, 4]
									}
							}
					]
			});
			}
		});
	}
	//end of showdata function

	//Editdata function for edit the record
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
			
		var id1 = $(this).attr('id');
		var name = $('#name_'+id1).html();
		var address=$('#address_'+id1).html();
		var mobile=$('#mobile_'+id1).html();
		var gstin=$('#gstin_'+id1).html();
		//	console.log(id+"/"+name+"/"+address+"/"+mobile+"/"+email+"/"+age+"/"+gender);
		$('#saveid').val(id1);
		$('#name').val(name);
		$('#address').val(address);
		$('#mobile').val(mobile);
		$('#gstin').val(gstin);
		validate=1;check=1;
	});
	//End of Editdata function for edit the record

	//Delete Data code starts here
	$(document).on('click','.delete_data',function(){
		var id1 = $(this).attr('id');
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
	//Delete Data code starts here
});