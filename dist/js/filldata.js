$(document).ready(function() {

   //alert();
   
    getMasterSelect("brand_master", ".brand");
    getMasterSelect("company", ".cname");
    getMasterSelect("supplier_master", ".suppliernm");
    getMasterSelect("customer_master", ".customer");
    getMasterSelect1("salesbill_master",".invoice")
    function getMasterSelect(table_name, selecter) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name },
            dataType: "JSON",
            async: false,
            success: function(data) {
            //  alert("HII");
            var data = eval(data);
            console.log("Data is:"+data);
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>';
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
    function getMasterSelect1(table_name, selecter) {
        $.ajax({
            type: "POST",
            url: base_url + "Controller/getdata",
            data: { table_name: table_name },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>';
                for (i = 0; i < data.length; i++) {
                    var id = '';
                    invoice = data[i].invoice_no;
                    html += '<option value="' + invoice + '">'+"INV - "+ invoice  +  '</option>';
                }
                $(selecter).html(html);
            },
            error:function(){
                console.log("Error");
            }
            
        });
    }





});