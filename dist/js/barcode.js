$(document).ready(function(){
	//alert(table_name);	
		
	//$('#form').hide();
	var validate=0;
	var check=0;
/*	$(document).on('click','#btnadd',function(){
		//alert("HII");	
		$('#form').show();
		$('#tbl').hide();		
		$('#column').hide();
    });*/
    $(document).on('click','#btncancel',function(){
		//alert("HII");	
		$('#mainform')[0].reset();
        $('#saveid').val('');
        $('#save_update').val('');
    });
    $(document).on('click','#btndelete',function(){
		$('#mainform')[0].reset();	
    });
    $(document).on("change",".cname",function(e){
        e.preventDefault();
        var name= $('#cname option:selected').text();
          var  id1=$(this).val();          

           // getsuppiler("supplier_master","id="+id1+"");
            getitemname("item_master",".iname","c_id="+id1+"");
            $('#name').val(name);
    });
    function getitemname(table_name, selecter,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
             // alert("success");
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>';
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    name = data[i].item_name;
                    id = data[i].id;
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            },
            error:function(){

            }
            
        });
    }
    $(document).on("change",".iname",function(e){
        e.preventDefault();
            var item= $('#iname option:selected').text();
            var idda=$(this).val();          

            getmrp("item_master","id="+idda+"");
           // getgst("item_master","id="+idda+"");
           $('#item').val(item);
    });
    function getmrp(table_name,where) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name,
                    where:where,
             },
            dataType: "JSON",
            async: false,
            success: function(data) {
                //alert("success");
                console.log(data[0].item_code);
                $('#icode').val(data[0].item_code);
                console.log(data[0].mrp);
                $('#mrp').val(data[0].mrp);
            },
            error:function(){
                alert(error);
            }
            
        });
    }
});