$(document).ready(function(){
	//alert(table_name);	
	var table_name="brand_master"
	$('#form').hide();
	
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
        $('#saveid').val('');
        $('#save_update').val('');
	});
	$(document).on('submit',"#mainform",function(e){
		e.preventDefault();
		var url=base_url+"Controller/adddata";
		var id=$('#saveid').val();
		var name=$('#name').val();
		//alert(url);
		$.ajax({
			type:"post",
			url:url,
			dataType:"json",
			data:{
				id:id,
				name:name,
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
				for(var i=0;i<data.length;i++)
				{
					table+='<tr>'+
					'<td id="id'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="name_'+data[i].id+'">'+data[i].name+'</td>'+
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
						        columns: [0, 1]
						    },
						},
						{
							title: tit,
							extend: 'excelHtml5',
							exportOptions: {
								columns: [0, 1]
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
		var name = $('#name_'+id1).html();
			
		$('#saveid').val(id1);
		$('#name').val(name);
	});
	//End of Edit data

	//Delete Data code starts here
	$(document).on('click','.delete_data',function(e){
		e.preventDefault();
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