$(document).ready(function(){
	//alert(id);
	//alert(table_name);
	$('#form').hide();
	
	var validate=0;
	$(document).on('click','#btnadd',function(){
		$('#form').show();
		$('#tbl').hide();		
		$('#column').hide();
	});
	$(document).on('click','#btncancel',function(){
        $('#mainform')[0].reset();
		$('#form').hide();
		$('#tbl').show();
		$('#column').show();
	});
	$(document).on('click','#btndelete',function(){
		$('#mainform')[0].reset();	
	});
	//code for validate mobile number
	$(document).on("blur","#phone",function(e){
		var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		var m=$('#phone').val();
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
	//End of validation of mobile number-------//
	
 //--submit function starts here------//
	$(document).on('submit',"#mainform",function(e){
		e.preventDefault();
		var data= $('#mainform').serialize();
		var url=base_url+"Controller/adddata";
		var id=$('#saveid').val();
		var name=$('#company_name').val();
		var address=$('#address').val();
		var email=$('#email').val();
		var mobile=$('#phone').val();
		var gstno=$('#gst').val();
		var pan=$('#pan').val();
		var integration=$('#integration').val();
		var bankname=$('#bank_name').val();
		var branchname=$('#branch_name').val();
		var acno=$('#acno').val();
		var ifsc=$('#ifsc').val();
		var username=$('#username').val();
		var password=$('#password').val();
		var image=$('#file_attachother1').val();
		var sdate=$('#start_date').val();
		var edate=$('#end_date').val();
		alert("Data is: "+integration +"date is:"+edate);
		var tdateAr = sdate.split('/');
       var sdate1 = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];  
    
        var tdateAr = edate.split('/');
		var edate1 = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];  
		//alert(url);
		$.ajax({
			type:"post",
			url:url,
			dataType:"json",
			//fileElementId:'userfile',
			data:{
				id:id,
				company_name:name,
				address:address,
				email:email,
				phone:mobile,
				gst:gstno,
				pan:pan,
				integration:integration,
				bank_name:bankname,
				branch_name:branchname,
				acno:acno,
				ifsc:ifsc,
				username:username,
                password:password,
				image:image,
				sdate:sdate1,
				edate:edate1,
				table_name:table_name
			},
			async:false,
			success: function(data){
				//alert(data);
				var data=eval(data);
				c_id=data;
				//alert(c_id);
				$.ajax({
					type:"post",
					url:url,
					dataType:"json",
					data:{
						id:id,
						c_id:c_id,
						username:username,
						password:password,
						table_name:'login_master'
					},
					dataType:"JSON",
					async:false,
					success: function(data){
						//alert("success");
						successTost("Operation Successfull");
						
					},
					error:function(){
						//alert("failed");
						errorTost("Operation Failed for login master");
					}
				});
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
		$('#containerother_kyc1').html('');
		datashow();
	});
	//End of Form submitting function
	datashow();
	//Show data Function
	//alert();
	function datashow(){
		//alert(table_name);
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
				var table="";
				index=1;
				for(var i=0;i<data.length;i++)
				{
					var tdateAr = data[i].start_date.split('-');
					var sdate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					
					var tdateAr = data[i].end_date.split('-');
					var edate = tdateAr[2] + '/' + tdateAr[1] + '/' + tdateAr[0].slice();
					table+='<tr>'+
					'<td>'+index+'</td>'+
					'<td hidden id="id'+data[i].id+'">'+data[i].id+'</td>'+
					'<td id="name_'+data[i].id+'">'+data[i].name+'</td>'+
					'<td hidden id="address_'+data[i].id+'">'+data[i].address+'</td>'+
					'<td id="email_'+data[i].id+'">'+data[i].email+'</td>'+
					'<td id="mobile_'+data[i].id+'">'+data[i].mobile+'</td>'+
					'<td id="gstno_'+data[i].id+'">'+data[i].gstno+'</td>'+
					'<td hidden id="pan_'+data[i].id+'">'+data[i].pan+'</td>'+
					'<td id="bankname_'+data[i].id+'">'+data[i].bank_name+'</td>'+
					'<td id="branchname_'+data[i].id+'">'+data[i].branch_name+'</td>'+
					'<td hidden id="acno_'+data[i].id+'">'+data[i].acno+'</td>'+
					'<td hidden id="ifsc_'+data[i].id+'">'+data[i].ifsc+'</td>'+
					'<td id="username_'+data[i].id+'">'+data[i].username+'</td>'+
					'<td hidden id="password_'+data[i].id+'">'+data[i].password+'</td>'+
					'<td hidden id="image_'+data[i].id+'">'+data[i].image+'</td>'+
					'<td hidden id="sdate_'+data[i].id+'">'+sdate+'</td>'+
					'<td hidden id="edate_'+data[i].id+'">'+edate+'</td>'+
					'<td><button type="button" name="edit" class="edit_data btn btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button>  <button type="button" name="delete" value="Delete" class="btn delete_data btn-danger" id="'+data[i].id+'"><i class="fa fa-trash"></i></button></td>'+
					'</tr>' ;index+=1;
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
				//$('#dataTable').DataTable();
			}
		});
	}
	//End of showdata function

	//Edit data code
	$(document).on('click','.edit_data',function(e){
		e.preventDefault();
		$('#form').show();
		$('#tbl').hide();
		$('#column').hide();
			
		var id1 = $(this).attr('id');
		var name = $('#name_'+id1).html();
		var address=$('#address_'+id1).html();
		var email=$('#email_'+id1).html();
		var mobile=$('#mobile_'+id1).html();
		var gstno=$('#gstno_'+id1).html();
		var pan=$('#pan_'+id1).html();
		var bankname=$('#bankname_'+id1).html();
		var branchname=$('#branchname_'+id1).html();
		var acno=$('#acno_'+id1).html();
		var ifsc=$('#ifsc_'+id1).html();
		var username=$('#username_'+id1).html();
		var password=$('#password_'+id1).html();
		var image=$('#image_'+id1).html();
		var sdate=$('#sdate_'+id1).html();
		var edate=$('#edate_'+id1).html();
		alert(id1)	;
		$('#saveid').val(id1);
		$('#company_name').val(name);
		$('#address').val(address);
		$('#email').val(email);
		$('#phone').val(mobile);
		$('#gst').val(gstno);
		$('#pan').val(pan);
		$('#bank_name').val(bankname);
		$('#branch_name').val(branchname);
		$('#acno').val(acno);
		$('#ifsc').val(ifsc);
		$('#username').val(username);
		$('#password').val(password);
		$('#username').prop("disabled", true);
		$('#password').prop("disabled", true);
		$('#file_attachother1').val(image);
		//$('#uploadFile1').val(image);
		$("#start_date").val(sdate);
   		$("#end_date").val(edate);
	});
	//End of Edit data
	$(document).on('click','.delete_data',function(){
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
							dataType:"JSON",
							async:false,
							success: function(data){
                                swal("Deleted !!", "Hey, your Data has been deleted !!", "success");
                                $('.closehideshow').trigger('click');
                                $('#saveid').val("");
                                datashow();; //call function show all data				
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

       

      
    
