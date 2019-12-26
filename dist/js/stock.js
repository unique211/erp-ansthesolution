$(document).ready(function(){
 
    GetDataOfStock();
    //alert("HII");
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
    $(document).on('click',"#btnsearch",function(e){
        e.preventDefault();
        var item=$('#name').val();
        var from=$('#fdate').val();
        // var to=$('#tdate').val();
        // var todate = to.split('/');
        // var tdate=todate[2] + '-' + todate[1] + '-' + todate[0];
        var fromdate = from.split('/');
        var fdate=fromdate[2] + '-' + fromdate[1] + '-' + fromdate[0];
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getstockbyDate",
            data: { table_name: 'item_master',
                    item:item,
                    // tdate:tdate,
                    fdate:fdate
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                //var data=eval(data);
                //alert("success"+data);
                console.log(data);
                $('#tablebody').html('');
				var table=""; var index =1;
				for(var i=1;i<data.length;i++)
				{
                    var inctn=data[i].inqty;
                    var outctn=data[i].outqty;
                    var stock=parseFloat(inctn)-parseFloat(outctn);
                    table+='<tr>'+
                    '<td>'+index+'</td>'+
                    '<td>'+data[i].brandname+'</td>'+
                    '<td>'+data[i].itemname+'</td>'+
                    '<td>'+data[i].purchase_rate+'</td>'+
                    '<td>'+data[i].sales_rate+'</td>'+
                    '<td>'+inctn+'</td>'+
                    '<td>'+outctn+'</td>'+
                    '<td>'+stock+'</td>'+
                    '</tr>' ;index+=1;
                }
                $('#tablebody').append(table);
            },error: function(){
                errorTost("Error");
            }
        });
        //alert("HII");
    });
    function GetDataOfStock(){

        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getstock",
            data: { table_name: 'item_master',
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
              //  console.log(data);
                $('#tablebody').html('');
				var table=""; var index =1;
				for(var i=0;i<data.length;i++)
				{
                    var inctn=data[i].inqty;
                    var outctn=data[i].outqty;
                    var stock=parseFloat(inctn)-parseFloat(outctn);
                    table+='<tr>'+
                    '<td>'+index+'</td>'+
                    '<td>'+data[i].brandname+'</td>'+
                    '<td>'+data[i].itemname+'</td>'+
                    '<td>'+data[i].purchase_rate+'</td>'+
                    '<td>'+data[i].sales_rate+'</td>'+
                    '<td>'+inctn+'</td>'+
                    '<td>'+outctn+'</td>'+
                    '<td>'+stock+'</td>'+
                    '</tr>' ;index+=1;
                }
                $('#tablebody').append(table);   //$('#dataTable').DataTable();
            },
            error:function(){
                errorTost("Error");
            }
        });
    }
});