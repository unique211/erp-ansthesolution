$(document).ready(function(){
	datashow();
	$('#form').hide();
	$('#mainform')[0].reset();
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
					columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10, 11, 12]
				},
			},
			{
				title: tit,
				extend: 'excelHtml5',
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11, 12]
				}
			}
		]
	});
	//$('#dataTable').DataTable();
	$(document).on('click','#btnadd',function(){
		$('#form').show();
		$('#tbl').hide();		
		$('#column').hide();
		$.ajax({
			type:'POST',
			url:base_url+"Controller/data",
			dataType:"JSON",
			async:false,	
			data:{
			},
			success:function(data){
				//alert(data[0].billno);
				var data = eval(data);
				//alert(data.billno);
				var d1= data.item_code;
				d1++
				//alert(d1);
				$('#item_code').val(d1);
				//$('#b1').val(d1);	
			},
			error:function(){
			}
		});
		$('.date').datepicker({
            'todayHighlight':true,
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
    	var date = new Date();
        date = date.toString('dd/MM/yyyy');
        $("#e_date").val(date);
	});
	$(document).on('click','#btncancel',function(){
		$('#form').hide();
		$('#tbl').show();
		$('#column').show();
		$('#saveid').val('');
		$('#mainform')[0].reset();
		$('.date').datepicker({
            'todayHighlight':true,
            format: 'dd/mm/yyyy',
            autoclose: true,
        });
    	var date = new Date();
        date = date.toString('dd/MM/yyyy');
       // $("#e_date").val(date);
        $("#e_date").val(date);
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
	$(document).on("blur","#con_number",function(e){
		var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		var m=$('#con_number').val();
		if (filter.test(m))
		{
			if(m.length==10){
				check = 1;
		   } else {
				swal({ title: "Opss...",text: "Please Enter 10 digits!",
				type: "warning",});
			   //alert('Please put 10  digit mobile number');
			   check = 0;
		   }
		}
		else {
			swal("Not a valid number");
			check = 0;
		  }
	});
	
	//Form submitting function starts here
	$(document).on('submit','#mainform', function(e){
		e.preventDefault();
		//console.log("Hey....");
		var url=base_url+"Controller/adddata";
		var id=$('#saveid').val();
		var barcode=$('#barcode').val();
		//alert(id+barcode);
		var code=$('#item_code').val();
		var name=$('#item_name').val();
		var type=$('#name').val();
		var group=$('#item_group').val();
		var hsn=$('#hsn_code').val();
		var unit=$('#unit').val();
		var location=$('#location').val();
		var comapny=$('#comapny').val();
		var supplier=$('#supplier_name').val();
		var date=$('#e_date').val();
		var min_qty=$('#m_qty').val();
		var max_qty=$('#max_qty').val();
		var size=$('#size').val();
		var packing=$('#packing').val();
		var purchase_rate=$('#purchase_rate').val();
		var mrp=$('#mrp').val();
		var net_rate=$('#net_rate').val();
		var gst=$('#gst').val();
		var sales_rate=$('#sales_rate').val();
		var opening_stock=$('#opening_stock').val();
		var tdateAr = date.split('/');
        e_date = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
		if(validate == 1 && check == 1){
		$.ajax({
			type:"post",
			url:url,
			dataType:"json",
			data:{
				id:id,
				barcode:barcode,
				code:code,
				name:name,
				type:type,
				group:group,
				hsn:hsn,
				unit:unit,
				location:location,
				comapny:comapny,
				supplier:supplier,
				e_date:e_date,
				min_qty:min_qty,
				max_qty:max_qty,
				size:size,
				packing:packing,
				purchase_rate:purchase_rate,
				mrp:mrp,
				net_rate:net_rate,
				gst:gst,
				sales_rate:sales_rate,
				opening_stock:opening_stock,
				table_name:table_name
			},
			dataType:"JSON",
			async:false,
			success: function(data){
				//alert("Success");
				successTost("Operation Successfull");
				datashow();
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
		$('#saveid').val('');
	});
	//Show data Function
	
	
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
				console.log(data);
				$('#tablebody').html('');
				var table=""; var index =1;
				for(var i=0;i<data.length;i++)
				{
					var tdateAr = data[i].expiry_date.split('-');
					var  date = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					table+='<tr>'+
					'<td>'+index+'</td>'+
					'<td hidden id="id'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="barcode_'+data[i].id+'">'+data[i].barcode+'</td>'+
					'<td hidden id="code_'+data[i].id+'">'+data[i].item_code+'</td>'+
					'<td id="name_'+data[i].id+'">'+data[i].item_name+'</td>'+
					'<td id="hsn_'+data[i].id+'">'+data[i].hsn+'</td>'+
					'<td id="u_'+data[i].id+'">'+data[i].unit+'</td>'+
					'<td id="dt_'+data[i].id+'">'+date+'</td>'+
					'<td hidden id="size_'+data[i].id+'">'+data[i].size+'</td>'+
					'<td id="pack_'+data[i].id+'">'+data[i].packing+'</td>'+
					'<td id="gst_'+data[i].id+'">'+data[i].gst+'</td>'+
					'<td id="sr_'+data[i].id+'">'+data[i].sales_rate+'</td>'+
					'<td id="os_'+data[i].id+'">'+data[i].opening_stock+'</td>'+
					'<td hidden id="type_'+data[i].id+'">'+data[i].item_type+'</td>'+
					'<td hidden id="grp_'+data[i].id+'">'+data[i].item_group+'</td>'+
					'<td hidden id="l_'+data[i].id+'">'+data[i].location+'</td>'+
					'<td hidden id="c_'+data[i].id+'">'+data[i].company+'</td>'+
					'<td hidden id="s_'+data[i].id+'">'+data[i].supplier+'</td>'+
					'<td hidden id="nq_'+data[i].id+'">'+data[i].min_qty+'</td>'+
					'<td hidden id="mq_'+data[i].id+'">'+data[i].max_qty+'</td>'+
					'<td hidden id="purchase_'+data[i].id+'">'+data[i].purchase_rate+'</td>'+
					'<td hidden id="mrp_'+data[i].id+'">'+data[i].mrp+'</td>'+
					'<td hidden id="nr_'+data[i].id+'">'+data[i].net_rate+'</td>'+
					'<td><button type="button" name="edit" class="edit_data  btn btn-xs btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class=" btn btn-xs delete_data btn-danger" id="'+data[i].id+'"><i class="fa fa-trash"></i></button></td>'+
	                '</tr>' ;index+=1;
				}
				$('#tablebody').append(table);
				
			}
		});
	}
	//End of show data function

	//Edit data code
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
			
		var id1 = $(this).attr('id');
		var barcode= $('#barcode_'+id1).html();
		var code= $('#code_'+id1).html();
		var name = $('#name_'+id1).html();
		var type= $('#type_'+id1).html();
		var group= $('#grp_'+id1).html();
		var hsn= $('#hsn_'+id1).html();
		var unit= $('#u_'+id1).html();
		var location= $('#l_'+id1).html();
		var comapny= $('#c_'+id1).html();
		var supplier= $('#s_'+id1).html();
		var date= $('#dt_'+id1).html();
		var min= $('#nq_'+id1).html();
		var max= $('#mq_'+id1).html();
		var size= $('#size_'+id1).html();
		var packing= $('#pack_'+id1).html();
		var purchase= $('#purchase_'+id1).html();
		var mrp= $('#mrp_'+id1).html();
		var nr= $('#nr_'+id1).html();
		var gst= $('#gst_'+id1).html();
		var sr= $('#sr_'+id1).html();
		var os= $('#os_'+id1).html();
		
		$('#saveid').val(id1);barcode
		$('#barcode').val(barcode);
		$('#item_code').val(code);
		$('#item_name').val(name);
		$('#name').val(type).trigger('change');
		$('#item_group').val(group).trigger('change');
		$('#hsn_code').val(hsn);
		$('#unit').val(unit);
		$('#location').val(location);
		$('#comapny').val(comapny);
		$('#supplier_name').val(supplier);
		$('#e_date').val(date);
		$('#m_qty').val(min);
		$('#max_qty').val(max);
		$('#size').val(size);
		$('#packing').val(packing);
		$('#purchase_rate').val(purchase);
		$('#mrp').val(mrp);
		$('#net_rate').val(nr);
		$('#gst').val(gst);
		$('#sales_rate').val(sr);
		$('#opening_stock').val(os);
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

       

      
    
