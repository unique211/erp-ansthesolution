$(document).ready(function(){
    //alert(table_name);
    $.ajax({
        type: "POST",
        url: base_url + "Dashboard/getCompany",
        data: { table_name: table_name },
        dataType: "JSON",
        async: false,
        success: function(data) {
            //alert("Success");
            console.log(data);
            $('#img').attr("src",base_url+'assets/Companylogos/'+data[0].image);
            $('#name').text(data[0].name);
            $('#saveid').val(data[0].id);
            $('#cname').val(data[0].name);
            $('#address').val(data[0].address);
            $('#email').val(data[0].email);
            $('#number').val(data[0].mobile);
            $('#gst').val(data[0].gstno);
            $('#pan').val(data[0].pan);
            $('#bname').val(data[0].bank_name);
            $('#branch').val(data[0].branch_name);
            $('#acno').val(data[0].acno);
            $('#ifsc').val(data[0].ifsc);
            $('#file_attachother1').val(data[0].image);
            $("#msg1").html("<font id='doc_image_name1' color='green'>"+data[0].image+"</font>");
			var img = $('<img />').addClass('img').attr({
				'id': 'myImage',
				'src': base_url+'assets/Companylogos/'+data[0].image,
				'width': 100,					
			}).appendTo('#containerother_kyc1');
        },
        error:function(){
            errorTost("Error");
        }
    });
    $(document).on('submit',"#mainform",function(e){
        e.preventDefault();
       // alert("HII");
            var id=$('#saveid').val();
            var name=$('#cname').val();
            var address=$('#address').val();
            var email=$('#email').val();
            var mobile=$('#number').val();
            var gstno=$('#gst').val();
            var pan=$('#pan').val();
            var bankname=$('#bname').val();
            var branchname=$('#branch').val();
            var acno=$('#acno').val();
            var ifsc=$('#ifsc').val();
            var image=$('#file_attachother1').val();
        $.ajax({
            type: "POST",
            url: base_url + "Dashboard/updateProfile",
            data: { 
                table_name: table_name ,
                id:id,
				company_name:name,
				address:address,
				email:email,
				phone:mobile,
				gst:gstno,
				pan:pan,
				bank_name:bankname,
				branch_name:branchname,
				acno:acno,
				ifsc:ifsc,
				image:image,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                //alert(success);
                successTost("Data Updated Successfully","Success");
            },
            error:function(){
                errorTost("Something Wrong","error");
            }
        });
    });
});