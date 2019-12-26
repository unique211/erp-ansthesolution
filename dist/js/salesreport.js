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
            url: base_url+"Dashboard/getsalesbyDate",
            data: { table_name: 'salesbill_master',
                   // item:item,
                     tdate:tdate,
                    fdate:fdate
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                if(data==""){
                    // swal("There is no data to show");
                }
                $('#tablebody').html('');
				var table=""; var index =1;
				for(var i=0;i<data.length;i++)
				{
                    table+='<tr>'+
                    '<td>'+data[i].invoice_date+'</td>'+
                    '<td>'+data[i].invoice_no+'</td>'+
                    '<td>'+data[i].customer+'</td>'+
                    '<td>'+data[i].total+'</td>'+
                    '</tr>' ;index+=1;
                }
                $('#tablebody').append(table);
            },error: function(){
                errorTost("Error");
            }
        });
       // alert("HEyy.");
    });
    function getTsales(){
        table_name="salesbill_master";
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getsalesReport",
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
                         '<td>'+data[i].invoice_date+'</td>'+
                         '<td>'+data[i].invoice_no+'</td>'+
                         '<td>'+data[i].customer+'</td>'+
                         '<td>'+data[i].total+'</td>'+
                         '</tr>' ;index+=1;
                     }
                     $('#tablebody').append(table);
                 }
                 else{
                    // swal("There is no record to show");
                 }
                
            },
            error: function(){
                errorTost("Error");
            }
        });
    }
});