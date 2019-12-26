$(document).ready(function() {

   //alert(table_name);
    getMasterSelect1("item_master", ".item_name");
    getMasterSelect("item_type", ".name");
    getMasterSelect("item_group", ".item_group");
    getMasterSelect("item_location", ".location");
    getMasterSelect("brand_master", ".brand");
    getMasterSelect("supplier_master", ".supplier_name");
    getMasterSelect("account_group", ".a_group");
    getMasterSelect("payment_option", ".payment");
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
            url: base_url + "Controller/get_master",
            data: { table_name: table_name },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data[0].item_name);
             // alert("HII");
                html = '';
                var name = '';
                html += '<option selected disabled value="" >Select</option>'+'<option value="all">All </option>';
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





});