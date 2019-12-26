$(document).ready(function(){
    //alert("Hii");
  
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
                        columns: [1, 2, 3, 4]
                    },
                },
                {
                    title: tit,
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                }
            ]
        });
        getTsales();
    
    $(document).on("click","#btnsearch",function(e){
        e.preventDefault();
        // var item=$('#name').val();
        var from=$('#fdate').val();
        var to=$('#tdate').val();
        var todate = to.split('/');
        var tdate=todate[2] + '-' + todate[1] + '-' + todate[0];
        var fromdate = from.split('/');
        var fdate=fromdate[2] + '-' + fromdate[1] + '-' + fromdate[0];
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getpurchasebyDate",
            data: { table_name: 'paychasebill_master',
                   // item:item,
                     tdate:tdate,
                    fdate:fdate
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                if(data==""){
                    //swal("There is no data to show");
                }else{
                    $('#tablebody').html('');
                    var table="";
                    for(var i=0;i<data.length;i++)
                    {
                        table+='<tr>'+
                        '<td>'+data[i].billdate+'</td>'+
                        '<td>'+data[i].billno+'</td>'+
                        '<td>'+data[i].customer+'</td>'+
                        '<td>'+data[i].totalamount+'</td>'+
                        '</tr>' ;
                    }
                    $('#tablebody').append(table); //$('#dataTable').DataTable();
                }
           
            },error: function(){
                errorTost("Error");
            }
        });
       // alert("HEyy.");
    });
    //dataTable();
    function getTsales(){
        table_name="paychasebill_master";
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getpurchaseReport",
            data: { table_name: table_name,
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data=eval(data);
                console.log(data);
                 if(data != 0){
                   
                     $('#tablebody').html('');
                     var table=""; var index =1;
                     for(var i=0;i<data.length;i++)
                     {
                         table+='<tr>'+
                         '<td>'+data[i].billdate+'</td>'+
                         '<td>'+data[i].billno+'</td>'+
                         '<td>'+data[i].supplier+'</td>'+
                         '<td>'+data[i].totalamount+'</td>'+
                         '</tr>' ;index+=1;
                     }
                     $('#tablebody').append(table);
                 }
                 else{
                    //swal("There is no data to show");
                 }
                 
            },
            error: function(){
                errorTost("Error");
            }
        });
    }
});