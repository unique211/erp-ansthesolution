$(document).ready(function(){
    //alert("HII");
    $(document).on("blur",'#password',function(){
        var url= base_url+"Dashboard/Login";
        var password=$('#password').val();
       $.ajax({
           method: "POST",
           url:url,
           data: {
               table_name:table_name,
               password: password
           },  
           dataType: "JSON",
           async: false,
           success: function (data) {
               // alert(data);
                // alert("Success");
                console.log(data);
                if(data==1){
                    $('#cpassword').prop('disabled',false);
                    $('#newpassword').prop('disabled',false);
                }
                else if(data == 202){
                    errorTost("Please Enter Password ");
                }
                else{
                    errorTost("Password Doesn't match");
                }
           },
           error: function(){
               alert("error");
               errorTost("Error..");
           }
       });
    });

    $(document).on("submit",'#mainform',function(e){
        e.preventDefault();
       // alert("Hello...");
       var npassword=$('#newpassword').val();
       var cpassword=$('#cpassword').val();
       var password='';
       if(npassword == cpassword){
           password=npassword;
           $.ajax({
            method: "POST",
            url:base_url+"Dashboard/Change",
            data: {
                table_name:table_name,
                password: password
            },  
            dataType: "JSON",
            async: false,
            success: function (data) {
                successTost("Password has been Changed","Success");
                $('#mainform')[0].reset();
            },
            error: function(data){
                errorTost('error');
            }
        });
           //alert("success");
       }
       else{
           errorTost("Password Doesn't Match");
           $('#mainform')[0].reset();
       }
    });
});
