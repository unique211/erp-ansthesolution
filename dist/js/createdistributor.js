$(document).ready(function(){
  
    getMasterSelect("branch_mastre","#branchname"," status = '1' ");
    var table_name="distributor_master";
datashow();
    $('#distributor_form')[0].reset();
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
					columns: [0,3,4,5,6,7,10,11,12]
				}
			}
		]
	});
    function getMasterSelect(table_name,selecter,where){
	
        $.ajax({
           type : "POST",
           url  : base_url+"Distributor/getdropdown",
           data:{table_name:table_name,
                   where:where,},
           dataType : "JSON",
           async : false,
           success: function(data){

               html = '';
               var name = '';
//					if(table_name=="victim_age"){
//					html += '<option selected  value="" >Select Victim Age</option>';
//						}else{
               html += '<option selected disabled value="" >Select</option>';
//						}
               for(i=0; i<data.length; i++){
                       var id = '';
                      
                           
                           name = data[i].name;								
                           id = data[i].id;
                     
               //alert(name);	
               html += '<option value="'+id+'">'+name+'</option>';
               }
               $(selecter).html(html);
           }
       });
}
        $(document).on('submit',"#distributor_form",function(e){
            e.preventDefault();
           
            var data= $('#distributor_form').serialize();
        
            var id=$('#saveid').val();
            var role=$('#role').val();
            var distributor_name=$('#distributor_name').val();
            var distributor_address=$('#distributor_address').val();
            var branchname=$('#branchname').val();
            var distributor_code=$('#distributor_code').val();
            var user_id=$('#user_id').val();
            var password=$('#password').val();
            var bankname=$('#bankname').val();
            var bankbranchname=$('#bankbranchname').val();
            var acno=$('#acno').val();
            var zfsccode=$('#zfsccode').val();
            $.ajax({
                    type:"post",
                url:base_url+"Distributor/adddata",
                dataType:"json",
                //fileElementId:'userfile',
                data:{
                    id:id,
                    role:role,
                    distributor_name:distributor_name,
                    distributor_address:distributor_address,
                    branchname:branchname,
                    distributor_code:distributor_code,
                    user_id:user_id,
                    password:password,
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
            $('#distributor_form')[0].reset();
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
            var distributor_name = $('#distributor_name_'+id1).html();
            var dis_address=$('#dis_address_'+id1).html();
            var branchid=$('#branchid_'+id1).html();
            var distributorcode=$('#distributorcode_'+id1).html();
            var userrole=$('#userrole_'+id1).html();
            var username=$('#username_'+id1).html();
            var password=$('#password_'+id1).html();
            var bankname=$('#bankname_'+id1).html();
            var bankbranchname=$('#bankbranchname_'+id1).html();
            var acno=$('#acno_'+id1).html();
            var zfsccode=$('#zfsccode_'+id1).html();
            
            
            $('#saveid').val(id1);
            $('#role').val(userrole).trigger('change');
            $('#user_id').val(username);
            $('#password').val(password);
            $('#distributor_name').val(distributor_name);
           $('#distributor_address').val(dis_address);
           $('#branchname').val(branchid);
           $('#distributor_code').val(distributorcode);
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
                                url:base_url+"Distributor/deleteData",
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
                                    $('#distributor_form')[0].reset();
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
          
            $.ajax({
                type:"POST",
                url:base_url+"Distributor/get_master",
                data:{		
                    table_name:'distributor_master',
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
                        '<td hidden id="userrole_'+data[i].id+'">'+data[i].userrole+'</td>'+
                        '<td id="distributor_name_'+data[i].id+'">'+data[i].distributor_name+'</td>'+
                        '<td id="dis_address_'+data[i].id+'">'+data[i].dis_address+'</td>'+
                        '<td hidden id="branchid_'+data[i].id+'">'+data[i].branchid+'</td>'+
                        '<td id="branchname_'+data[i].id+'">'+data[i].branchname+'</td>'+
                        '<td id="distributorcode_'+data[i].id+'">'+data[i].distributorcode+'</td>'+
                        '<td hidden id="username_'+data[i].id+'">'+data[i].username+'</td>'+
                        '<td hidden id="password_'+data[i].id+'">'+data[i].password+'</td>'+
                        '<td hidden id="bankname_'+data[i].id+'">'+data[i].disbankname+'</td>'+
                        '<td hidden id="bankbranchname_'+data[i].id+'">'+data[i].disbankbranchname+'</td>'+
                        '<td hidden id="acno_'+data[i].id+'">'+data[i].disacno+'</td>'+
                        '<td hidden id="zfsccode_'+data[i].id+'">'+data[i].disifsccode+'</td>'+
                     '<td><button type="button" name="edit" class="edit_data btn btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button> </td>'+
                        '</tr>' ;
                        index+=1;
                    }
                    $('#tablebody').append(table);
                   // $('#dataTable').DataTable();
                 /*  $('#dataTable').DataTable({
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
                    //$('#dataTable').DataTable();*/
                }
            });
        }
        $(document).on('click','#btnadd',function(){
            $('#distributor_form')[0].reset();
            $('#form').show();
            $('#tbl').hide();
            $('#column').show();
            $('#containerother_kyc1').html('');
            $('#saveid').val("");
           
        });
        $(document).on('click','#btncancel',function(){
            $('#distributor_form')[0].reset();
            $('#form').hide();
            $('#tbl').show();
            $('#column').show();
            $('#containerother_kyc1').html('');
         
           
        });
        /*----Chane of Role Event Start------------*/
        $(document).on('change','#role',function(e){
            e.preventDefault();
            var role=$(this).val();

            if(role=="admin"){
                $('#forcodediv').hide();
            }else if(role=="distributor"){
                $('#forcodediv').show(); 
                $('#forcode_lable').text('Distributor Code'); 
                //$('#distributor_code').placeholder('Distributor Code'); 
              var distributor=  $('#distributor_code').val();
            
              if(distributor==""){
                $('#distributor_code').attr("placeholder",'Distributor Code'); 
              }else{
                $('#distributor_code').removeAttr('placeholder');
              }
            }else if(role=="employee"){
                $('#forcodediv').show(); 
                $('#forcode_lable').text('Employee Code'); 
                var distributor=  $('#distributor_code').val();
                if(distributor==""){
                $('#distributor_code').attr("placeholder",'Employee Code'); 
                }else{
                    $('#distributor_code').removeAttr('placeholder'); 
                }
            }
        });
         /*----Chane of Role Event End------------*/

    });