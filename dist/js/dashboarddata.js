$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: base_url + "Customer/get_dashbord_data",
        data: {

        },
        dataType: "JSON",
        async: false,
        success: function(data) {

            if (data.length > 0) {

                $('#totalbranch').html(data[0].totalbranch);
                $('#totalDistributor').html(data[0].distributortotal);
                $('#totalcustomer').html(data[0].customertotal);
                $('#totalservice').html(data[0].servicetotal);
            }

        }
    });

    /*-----------------For  Todays Report-------------------*/
    $.ajax({
        type: "POST",
        url: base_url + "Customer/get_today_data",
        data: {

        },
        dataType: "JSON",
        async: false,
        success: function(data) {
            var row_id = 0;
            var html = "";
            if (data.length > 0) {
                $('#gettodaydata').html('');
                row_id = row_id + 1;
                var totalbillamt = 0;
                var totalpaidamt = 0;
                for (var i = 0; i < data.length; i++) {

                    if (data[i].totalbillamt > 0) {
                        totalbillamt = data[i].totalbillamt;
                    }
                    if (data[i].totalpaidamt > 0) {
                        totalpaidamt = data[i].totalpaidamt;
                    }
                    html = '<tr class="project_tab_add_row" id="' + row_id + '" >' +
                        '<td id="totalbill' + row_id + '">' + data[i].branchname + '</td>' +
                        '<td  id="totalbill' + row_id + '">' + data[i].distributorname + '</td>' +
                        '<td style="text-align:right;" id="totalbill' + row_id + '">' + parseFloat(data[i].totalbill).toFixed(2) + '</td>' +
                        '<td style="text-align:right;" id="totalbillamt' + row_id + '">' + parseFloat(totalbillamt).toFixed(2) + '</td>' +
                        '<td style="text-align:right;" id="totalpaidamt' + row_id + '">' + parseFloat(totalpaidamt).toFixed(2) + '</td>' +
                        '<td style="text-align:right;" id="remainamt' + row_id + '">' + parseFloat(data[i].remainamt).toFixed(2) + '</td>' +
                        '</tr>';
                    $("#gettodaydata").append(html);
                }

            } else {
                $('#gettodaydata').html('');
            }

        }
    });

    /*---------------get payment detalis ---------------------*/
    $.ajax({
        type: "POST",
        url: base_url + "Customer/getpaymentinfo",
        data: {

        },
        dataType: "JSON",
        async: false,
        success: function(data) {
            var row_id = 0;
            var html = "";
            var remainamt = 0;
            var grandamt = 0;
            var paidamt = 0;
            if (data.length > 0) {
                if (data[0].grandtotal != null) {
                    grandamt = data[0].grandtotal;
                } else {
                    grandamt = 0;
                }
                if (data[0].paidamt != null) {
                    paidamt = data[0].paidamt;
                } else {
                    paidamt = 0;
                }

                remainamt = (parseInt(grandamt) - parseInt(paidamt)).toFixed(2);
                html = '<tr class="project_tab_add_row" id="' + row_id + '" >' +
                    '<td style="text-align:right;" id="totalgrand_' + row_id + '">' + parseFloat(grandamt).toFixed(2) + '</td>' +
                    '<td style="text-align:right;" id="paidamt_' + row_id + '">' + parseFloat(paidamt).toFixed(2) + '</td>' +
                    '<td style="text-align:right;" id="remainamt_' + row_id + '">' + parseFloat(remainamt).toFixed(2) + '</td>' +
                    '</tr>';
                $("#getpaymentdata").append(html);
            }

        }
    });


});