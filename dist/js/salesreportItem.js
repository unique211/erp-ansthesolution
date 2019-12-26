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
    getMasterSelect1("item_master", ".item_name");
    function getMasterSelect1(table_name, selecter) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/get_master",
            data: { table_name: table_name },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data[0].item_name);
             // alert("HII");
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>';
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    name = data[i].item_name;
                    id = data[i].id;
                    //alert(id);
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            },
            error:function(){

            }
            
        });
    }
    $(document).on("click","#btnsearch",function(e){
        e.preventDefault();
        var item=$('#name').val();
        var from=$('#fdate').val();
        var to=$('#tdate').val();
        var todate = to.split('/');
        var tdate=todate[2] + '-' + todate[1] + '-' + todate[0];
        var fromdate = from.split('/');
        var fdate=fromdate[2] + '-' + fromdate[1] + '-' + fromdate[0];
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getsalesItem",
            data: { table_name: 'salesbill_master',
                    item:item,
                     tdate:tdate,
                    fdate:fdate
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log("Data is:"+data[1].item_name);
               
                if(data==""){
                    // swal("There is no data to show");
                    $('#tablebody').html('');
				var table=""; var index =1;
				for(var i=1 ;i<data.length;i++)
				{ 
                   // var total=parseFloat(data[i].mrp)*parseFloat(data[i].qty);
                    //alert("Success");
                    table+='<tr>'+
                    '<td>'+'</td>'+
                    '<td>'+'</td>'+
                    '<td>'+'</td>'+
                    '<td>'+'</td>'+
                    '<td>'+'</td>'+
                    '<td>'+'</td>'+
                    '</tr>' ;index+=1;
                }
                $('#tablebody').append(table);
                }
                $('#tablebody').html('');
				var table=""; var index =1;
				for(var i=1 ;i<data.length;i++)
				{ 
                    var total=parseFloat(data[i].mrp)*parseFloat(data[i].qty);
                    //alert("Success");
                    table+='<tr>'+
                    '<td>'+data[i].invoice_date+'</td>'+
                    '<td>'+data[i].item_name+'</td>'+
                    '<td>'+data[i].brand+'</td>'+
                    '<td>'+data[i].customer+'</td>'+
                    '<td>'+data[i].mrp+'</td>'+
                    '<td>'+total+'</td>'+
                    '</tr>' ;index+=1;
                }
                $('#tablebody').append(table);
            },error: function(){
                alert("Error");
                errorTost("Error");
            }
        });
       // alert("HEyy.");
    });
    function getTsales(){
        table_name="salesbill_master";
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getsalesReportItem",
            data: { table_name: table_name,
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
               // var data=eval(data);
                console.log(data);
                if(data != 0){
                    $('#tablebody').html('');
                     var table=""; var index =1;
                     for(var i=1;i<data.length;i++)
                     {
                        var total=parseFloat(data[i].mrp)*parseFloat(data[i].qty);
                         table+='<tr>'+
                         '<td>'+data[i].invoice_date+'</td>'+
                         '<td>'+data[i].item_name+'</td>'+
                         '<td>'+data[i].brand+'</td>'+
                         '<td>'+data[i].customer+'</td>'+
                         '<td>'+data[i].mrp+'</td>'+
                         '<td>'+total+'</td>'+
                         '</tr>';
                     }
                     $('#tablebody').append(table);
                 }
                 else{
                    // swal("There is no record to show");
                 }
                
                    // $('#tablebody').html('');
                    // var table=""; var index =1;
                    // for(var i=0;i<data.length;i++)
                    //  {
                    //     var total=parseFloat(data[i].mrp)*parseFloat(data[i].qty);
                    //     '<td>'+data[i].invoice_date+'</td>'+
                    //     '<td>'+data[i].item_name+'</td>'+
                    //     '<td>'+data[i].brand+'</td>'+
                    //     '<td>'+data[i].customer+'</td>'+
                    //     '<td>'+data[i].mrp+'</td>'+
                    //     '<td>'+total+'</td>'+
                    //     '</tr>' ;index+=1;
                    //  }
                    //  $('#tablebody').append(table);
                
            },
            error: function(){
                errorTost("Error");
            }
        });
    }
});