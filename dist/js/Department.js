$(document).ready(function(){

	$('#form').hide();

	$(document).on('click','#btnadd',function(){
	
		$('#form').show();
		$('#tbl').hide();		
		$('#column').hide();
	});
	$(document).on('click','#btncancel',function(){

		$('#form').hide();
		$('#tbl').show();
		$('#column').show();
	});
	$(document).on('submit','#addDept',function(e){
		e.preventDefault();
		var url=base_url+"LMS/adddata";
		var d_name=$('#d_name').val();
		var id=$('#saveid').val();
		$.ajax({
			type:"POST",
			url: url,
			data:{
				id:id,
				d_name:d_name,
				table_name:'department'
			},
			dataType : 'json',
			async:false,
			success: function(data){

				$('#addDept')[0].reset();
				$('#tbl').show();
				$('#column').show();
				$('#form').hide()
				datashow();
			}
		});
	});
	datashow();
	function datashow(){

		$.ajax({
			type:"POST",
			url:base_url+"LMS/ShowData",
			data:{		
				table_name: 'department'
			},
			dataType:"JSON",
			async:false,
			success: function(data){	
				console.log('data'+data);
				//console.log(data);
				var data=eval(data);
				$('#deptbody').html('');
				var table="";
				for(var i=0;i<data.length;i++)
				{
					table+='<tr>'+
					'<td id="id_'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="name_'+data[i].id+'">'+data[i].d_name+'</td>'+
					'<td ><input type="button" name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id='+data[i].id+'></td>'+
					'<td ><input type="button" name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id='+data[i].id+'></td>'+
	                '</tr>' ;
				}
				$('#deptbody').append(table);
                $('#dataTable').DataTable();
		                        
			}
		});
	}
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
		$('.modal-title').text("Edit Department");
		$('#btnsave').text('Update');
		
		var id1 = $(this).attr('id');
		var d_name = $('#name_'+id1).html();
			
		$('#saveid').val(id1);
		$('#d_name').val(d_name);
	});
	$(document).on('click','.delete_data',function(){
		var id1 = $(this).attr('id');
		$('#saveid').val(id1);
		if(confirm("Are you sure you want to delete")){
			$.ajax({
				type:"post",
				url:base_url+"LMS/deleteData",
				dataType:"json",
				data:{
					id:id1,
					table_name:'department'
				},
				success: function(data){
					//alert("Record Deleted successfully");
					datashow();
				}
			});
		}
		else{
			return false;
		}
	});
});

       

      
    
