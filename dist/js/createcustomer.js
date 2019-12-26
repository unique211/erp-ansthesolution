$(document).ready(function(){
  datashow();


   
    var table_name="customer_matserdata";

    $('#customer_form')[0].reset();
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
					columns: [0,2,3,4,6,7,8,9,10]
				}
			}
		]
	});
   
        $(document).on('submit',"#customer_form",function(e){
            e.preventDefault();
           
            var data= $('#customer_form').serialize();
        
            var id=$('#saveid').val();
            var customer_name=$('#customer_name').val();
            var address=$('#address').val();
            var phone_no=$('#phone_no').val();
            var category=$('#category').val();
            var reference_no=$('#reference_no').val();
            var pan_card_no=$('#pan_card_no').val();
            var aadhar_no=$('#aadhar_no').val();
            var gstin_no=$('#gstin_no').val();
            var narration=$('#narration').val();
         
            $.ajax({
                    type:"post",
                url:base_url+"Customer/adddata",
                dataType:"json",
                //fileElementId:'userfile',
                data:{
                    id:id,
                    customer_name:customer_name,
                    address:address,
                    phone_no:phone_no,
                    category:category,
                    reference_no:reference_no,
                    pan_card_no:pan_card_no,
                    aadhar_no:aadhar_no,
                    gstin_no:gstin_no,
                    narration:narration,
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
            $('#customer_form')[0].reset();
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
            var customername = $('#customername_'+id1).html();
            var address=$('#address_'+id1).html();
            var phone_no=$('#phone_no_'+id1).html();
            var category=$('#category_'+id1).html();

            var referenceno=$('#referenceno_'+id1).html();
            var pancard_no=$('#pancard_no_'+id1).html();
            var aadhar_no=$('#aadhar_no_'+id1).html();
            var gstinno=$('#gstinno_'+id1).html();
            var narration=$('#narration_'+id1).html();
            
            $('#saveid').val(id1);
            $('#customer_name').val(customername);
            $('#address').val(address);
            $('#phone_no').val(phone_no);
            $('#category').val(category).trigger('change');
            $('#reference_no').val(referenceno);
            $('#pan_card_no').val(pancard_no);
            $('#aadhar_no').val(aadhar_no);
            $('#gstin_no').val(gstinno);
            $('#narration').val(narration);
            
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
                                url:base_url+"Customer/deleteData",
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
                                    $('#customer_form')[0].reset();
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
     //   datashow();
        function datashow(){
          
            $.ajax({
                type:"POST",
                url:base_url+"Customer/get_master",
                data:{		
                    table_name:'customer_matserdata',
                },
                dataType:"JSON",
                async:false,
                success: function(data){
                    var data=eval(data);
                    console.log(data);
                    $('#tablebody').html('');
                    var table="";

                    var categoryname="";
                    index=1;
                    for(var i=0;i<data.length;i++)
                    {
                        if(data[i].category=='1'){
                            categoryname="Monthly";
                        }else if(data[i].category=='2'){
                            categoryname="Quarterly";
                        }else if(data[i].category=='3'){
                            categoryname="Half Yearly";
                        }else if(data[i].category=='4'){
                            categoryname="Yearly";
                        }

                        table+='<tr>'+
                        '<td>'+index+'</td>'+
                        '<td hidden id="id'+data[i].id+'">'+data[i].id+'</td>'+
                        '<td id="customername_'+data[i].id+'">'+data[i].customername+'</td>'+
                        '<td  id="address_'+data[i].id+'">'+data[i].address+'</td>'+
                        '<td id="phone_no_'+data[i].id+'">'+data[i].phone_no+'</td>'+
                        '<td hidden id="category_'+data[i].id+'">'+data[i].category	+'</td>'+
                        '<td id="categoryname_'+data[i].id+'">'+categoryname+'</td>'+
                        '<td id="referenceno_'+data[i].id+'">'+data[i].referenceno+'</td>'+
                       '<td id="pancard_no_'+data[i].id+'">'+data[i].pancard_no	+'</td>'+
                        '<td  id="aadhar_no_'+data[i].id+'">'+data[i].aadhar_no+'</td>'+
                       '<td id="gstinno_'+data[i].id+'">'+data[i].gstinno+'</td>'+
                       '<td hidden id="narration_'+data[i].id+'">'+data[i].narration+'</td>'+//----Last Changes here
                     '<td><button type="button" name="edit" class="edit_data btn btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button> </td>'+
                        '</tr>' ;
                        index+=1;
                    }
                    $('#tablebody').append(table);
                   /* $('#dataTable').DataTable({
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
                    });*/
                }
            });
        }
        $(document).on('click','#btnadd',function(){
            $('#customer_form')[0].reset();
            $('#form').show();
            $('#tbl').hide();
            $('#column').show();
            $('#containerother_kyc1').html('');
         
           
        });
        $(document).on('click','#btncancel',function(){
            $('#customer_form')[0].reset();
            $('#form').hide();
            $('#tbl').show();
            $('#column').show();
            $('#containerother_kyc1').html('');
         
           
        });
        /*----------change Event Of Category-----------*/
        $(document).on('change','#category',function(e){
            e.preventDefault();
            var value=$(this).val();
            if(value=="5"){
                $('#narrationinfo').show();
            }else{
                $('#narrationinfo').hide();
            }

        });
    });