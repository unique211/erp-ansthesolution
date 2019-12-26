$(document).ready(function(){
  
    getMasterSelect("service_master","#servicename"," status = '1' ");
    var table_name="instraction_master";

    $('#mainform')[0].reset();
    $('#form').hide();
    $('#tbl').show();
    $('#column').show();
    $('#containerother_kyc1').html('');
    datashow();
    $('#dataTable').DataTable({
		dom: 'Bfrtip',
		//"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
		buttons: [
			
			{
				title: tit,
				extend: 'excelHtml5',
				exportOptions: {
					columns: [0,3,4]
				}
			}
		]
	});
    function getMasterSelect(table_name,selecter,where){
	
        $.ajax({
           type : "POST",
           url  : base_url+"Instraction/getdropdown",
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
                      
                           
                           name = data[i].s_name;								
                           id = data[i].id;
                      
               //alert(name);	
               html += '<option value="'+id+'">'+name+'</option>';
               }
               $(selecter).html(html);
           }
       });
}

        $(document).on('submit',"#mainform",function(e){
            e.preventDefault();
           
            var data= $('#mainform').serialize();
        
            var id=$('#saveid').val();
            var servicename=$('#servicename').val();
            var distributordropselect=$('#distributordropselect').val();
           
         
        
            $.ajax({
                    type:"post",
                url:base_url+"Instraction/adddata",
                dataType:"json",
                //fileElementId:'userfile',
                data:{
                    id:id,
                    distributordropselect:distributordropselect,
                    service_name:servicename,
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
            var serviceid = $('#serviceid_'+id1).html();
            var documentrequire=$('#documentrequire_'+id1).html();
            
           
            
            
            
            $('#saveid').val(id1);
            
            $('#servicename').val(serviceid).trigger('change');
            $('#distributordropselect').val(documentrequire);
           
            
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
                                url:base_url+"Instraction/deleteData",
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
        datashow();
        function datashow(){
          
            $.ajax({
                type:"POST",
                url:base_url+"Instraction/get_master",
                data:{		
                    table_name:'instraction_master',
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
                        '<td hidden id="serviceid_'+data[i].id+'">'+data[i].serviceid+'</td>'+
                        '<td id="servicename_'+data[i].id+'">'+data[i].servicename+'</td>'+
                        '<td id="documentrequire_'+data[i].id+'">'+data[i].documentrequire+'</td>'+
                       '<td><button type="button" name="edit" class="edit_data btn btn-success" id="'+data[i].id+'"><i class="fa fa-edit"></i></button> </td>'+
                        '</tr>' ;
                        index+=1;
                    }
                    $('#tablebody').append(table);
                    //$('#dataTable').DataTable();
                  
                    //$('#dataTable').DataTable();*/
                }
            });
        }
        $(document).on('click','#btnadd',function(){
            $('#mainform')[0].reset();
            $('#form').show();
            $('#tbl').hide();
            $('#column').show();
            $('#containerother_kyc1').html('');
            $('#saveid').val('');
         
           
        });

        $(document).on('click','#btncancel',function(){
            $('#mainform')[0].reset();
            $('#form').hide();
            $('#tbl').show();
            $('#column').show();
            $('#containerother_kyc1').html('');
         
           
        });
        /*---- Start Change Event Of Service --------*/
        $(document).on("change","#servicename",function(e){
            e.preventDefault();
                 id1=$(this).val();
                 var where='serviceid='+id1;
               
                 $.ajax({
                    type : "POST",
                    url  : base_url+"Instraction/gettesxtareainfo",
                    data:{
                    table_name:'instraction_master', 
                     where:where
                    },
                    dataType : "JSON",
                    async : false,
                    success: function(data){
                       
                      if(data !=""){
                      $('#distributordropselect').val(data[0].documentrequire);
                      }else{
                        $('#distributordropselect').val('');  
                      }
                   
                    }
                });
               //this is demo change
            });

    });