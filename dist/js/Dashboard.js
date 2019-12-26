$(document).ready(function(){
    //alert("HII");
    url=base_url+"Dashboard/getData";
    
    getSales();
    getPurchase();
    getSupplier();
    getChart();
    function getChart(){
        
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getchart",
            data: { table_name: table_name,
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
               var monobj=[];
               var salesobj=[];
               var purchaseobj=[];
                for(var i=0;i<data.length;i++){
                    var monthname=data[i].month;
                    monobj.push(monthname);
                    var salesval=data[i].sales;
                    salesobj.push(salesval);
                    var purchaseval=data[i].purchase;
                    purchaseobj.push(purchaseval);
                    //console.log(purchaseval);    
                }
                
                    //Bar chart;
                 //   var data="3500";
                  //  var data1="5267";
                    new Chart(document.getElementById("bar-chart"), {
                        
                        type: 'bar',
                        data: {
                            labels: monobj,
                            datasets: [
                                {
                                    label: "Sales",
                                    backgroundColor: ["#006666", "#006666","#006666","#006666","#006666","#006666","#006666", "#006666","#006666","#006666","#006666","#006666"],
                                    data: salesobj
                                },
                                {
                                    label: "Purchase",
                                    backgroundColor: ["#6cba5f", "#6cba5f","#6cba5f","#6cba5f","#6cba5f","#6cba5f","#6cba5f", "#6cba5f","#6cba5f","#6cba5f","#6cba5f","#6cba5f"],
                                    data: purchaseobj
                                }
                            ]
                        },
                        options: {
                            legend: { display: true },
                            title: {
                                display: true,
                                text: 'Predicted world population (millions) in 2050'
                            }
                        }
                    });
             //  $('#sales').text(data);
                //alert(data);
            },
            error: function(){
                errorTost("Error");
            }
        });  
  
    }
    function getSales(){
     //   e.priventDefault();
        table_name="salesbill_master";
        $.ajax({
            type: "POST",
            url: url,
            data: { table_name: table_name,
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data=eval(data);
                //console.log(data);
                $('#sales').text(data);
                //alert(data);
            },
            error: function(){
                errorTost("Error");
            }
        });
    }
    function getPurchase(){
        //   e.priventDefault();
           table_name="paychasebill_master";
           $.ajax({
               type: "POST",
               url: url,
               data: { table_name: table_name,
                   },
               dataType: "JSON",
               async: false,
               success: function(data) {
                   var data=eval(data);
                   //console.log(data);
                   $('#purchase').text(data);
                   //alert(data);
               },
               error: function(){
                errorTost("Error");
               }
           });
       }
       function getSupplier(){
        //   e.priventDefault();
           table_name="supplier_master";
           $.ajax({
               type: "POST",
               url: url,
               data: { table_name: table_name,
                   },
               dataType: "JSON",
               async: false,
               success: function(data) {
                   var data=eval(data);
                   //console.log(data);
                   $('#supplier').text(data);
                  // alert(data);
               },
               error: function(){
                errorTost("Error");
               }
           });
       }
       getCustomer();
       function getCustomer(){
        //   e.priventDefault();
           table_name="customer_master";
           $.ajax({
               type: "POST",
               url: url,
               data: { table_name: table_name,
                   },
               dataType: "JSON",
               async: false,
               success: function(data) {
                   var data=eval(data);
                   //console.log(data);
                   $('#customer').text(data);
                   //alert(data);
               },
               error: function(){
                   errorTost("Error");
               }
           });
       }
       getEmployee();
       function getEmployee(){
        //   e.priventDefault();
           table_name="employee_master";
           $.ajax({
               type: "POST",
               url: url,
               data: { table_name: table_name,
                   },
               dataType: "JSON",
               async: false,
               success: function(data) {
                   var data=eval(data);
                   //console.log(data);
                   $('#employee').text(data);
                   //alert(data);
               },
               error: function(){
                   errorTost("Error");
               }
           });
       }
    getTsales();
    function getTsales(){
        table_name="salesbill_master";
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getTotal",
            data: { table_name: table_name,
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data=eval(data);
                //console.log(data);
                if(data != null){
                    $('#tsales').text(data);
                }
                else{
                    $('#tsales').text("0");
                }
                //alert(data);
            },
            error: function(){
                errorTost("Error");
            }
        });
    }
    getPsales();
    function getPsales(){
        table_name="paychasebill_master";
        $.ajax({
            type: "POST",
            url: base_url+"Dashboard/getPTotal",
            data: { table_name: table_name,
                },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data=eval(data);
                //console.log(data);
                if(data != null){
                    $('#tpurchase').text(data);
                }
                else{
                   
                    $('#tpurchase').text('0');
                }
                
                //alert(data);
            },
            error: function(){
                errorTost("Error");
            }
        });
    }
});
