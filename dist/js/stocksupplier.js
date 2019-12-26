$(document).ready(function(){
    getMasterSelect("supplier_master", ".supplier_name");
    function getMasterSelect(table_name, selecter) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/get_master",
            data: { table_name: table_name },
            dataType: "JSON",
            async: false,
            success: function(data) {
               // console.log(data[0].name);
             // alert("HII");
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option><option value="all">All</option>';
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    name = data[i].name;
                    id = data[i].id;
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            },
            error:function(){

            }
            
        });
    }
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
        var supplier=$('#name').val();
        var from=$('#fdate').val();
        // var to=$('#tdate').val();
        // var todate = to.split('/');
        // var tdate=todate[2] + '-' + todate[1] + '-' + todate[0];
        var fromdate = from.split('/');
        var fdate=fromdate[2] + '-' + fromdate[1] + '-' + fromdate[0];
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getstockbySupplier",
            data: { table_name: 'item_master',
            supplier:supplier,
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