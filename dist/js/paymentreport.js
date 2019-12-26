$(document).ready(function() {

    datashow('All', 'All');
    var table1 = $('#myTable').DataTable();
    table1.destroy();
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        buttons: [

            {
                title: tit,
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 2, 3, 5, 6]
                }
            }
        ]
    });
    var getbranchid = "";
    var getdistribuid = "";

    function datashow(branchid, distributorid) {

        $.ajax({
            type: "POST",
            url: base_url + "Paymentreport/get_master",
            data: {
                table_name: table_name,
                branchid: branchid,
                distributorid: distributorid,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                var data = eval(data);
                var table1 = $('#myTable').DataTable();
                table1.destroy();
                $('#tablebody').html('');
                //alert(data);
                var table = "";
                if (data.length > 0) {
                    var index = 1;
                    table += '<table id="myTable" class="table table-striped" style="width:100%;">' +
                        '<thead>' +
                        '<tr>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Sr no</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Branch Name</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Branch Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Distributor Name</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;display:none;">Distributor id</th>' +

                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Customer Name</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px;">Amount due</th>' +


                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    for (var i = 0; i < data.length; i++) {



                        table += '<tr>' +
                            '<td >' + index + '</td>' +
                            '<td hidden id="branchid_' + data[i].id + '">' + data[i].branchid + '</td>' +
                            '<td  id="branchname_' + data[i].id + '">' + data[i].branchname + '</td>' +
                            '<td id="distribuname_' + data[i].id + '">' + data[i].distribuname + '</td>' +
                            '<td hidden id="distribuid_' + data[i].id + '">' + data[i].distribuid + '</td>' +
                            '<td id="customername_' + data[i].id + '">' + data[i].customername + '</td>' +
                            '<td style="text-align:right;" id="remainamt_' + data[i].id + '">' + data[i].remainamt + '</td>' +

                            '</tr>';
                        index += 1;
                    }
                    table += '</tbody></table>';
                    $('#tabledata').html(table);

                    $('#myTable').DataTable({
                        dom: 'Bfrtip',
                        //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',


                        buttons: [

                            {
                                title: tit,
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 13, 14, 15]
                                }
                            }
                        ]
                    });
                }
            }
        });


    }
    getMasterSelect("branch_mastre", ".branchid", " status = '1' ");
    getMasterSelect("distributor_master", ".distributorname", " status = '1' ");
    /*	function dropdown(){	
    		$('.branchid').on( 'change', function () {
    		//var	table = $('#myTable').DataTable();
    		var table = $('#myTable').DataTable();
    			var regExSearch = this.value;
    			alert(regExSearch);
    			//alert('reg'+regExSearch);
    			if(regExSearch=="All"){
    				datashow();
    			}else{
    			table.column(1).search(regExSearch, true, false).draw();
    			}
    			});
    			$('.distributorid').on( 'change', function () {
    				var	table = $('#myTable').DataTable();
    					var regExSearch = this.value;
    					//alert('reg'+regExSearch);
    					if(regExSearch=="All"){
    						datashow();
    					}else{
    					table.column(4).search(regExSearch, true, false).draw();
    					}
    					});
    	}*/
    $('.branchid').on('change', function() {
        getbranchid = $(this).val();
        if (getbranchid != "All") {

            getMasterSelect("distributor_master", ".distributorname", 'branchid=' + getbranchid);
        } else {
            getMasterSelect("branch_mastre", ".branchid", " status = '1' ");
        }
        if (getdistribuid != "") {
            datashow(getbranchid, getdistribuid);
        } else if (getdistribuid == "") {
            datashow(getbranchid, "All");
        }

    });
    $('.distributorname').on('change', function() {
        getdistribuid = $(this).val();

        if (getbranchid != "") {
            datashow(getbranchid, getdistribuid);
        } else if (getbranchid == "") {
            datashow("All", getdistribuid);
        }

    });

    function getMasterSelect(table_name, selecter, where) {
        var colum;

        $.ajax({
            type: "POST",
            url: base_url + "Paymentreport/getdropdowndata",
            data: {
                table_name: table_name,
                where: where,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                html = '';

                // html += '<option selected disabled value="" >Select</option>';
                html += '<option value="All" selected>All</option>';

                for (i = 0; i < data.length; i++) {
                    var id = '';
                    if (table_name == "branch_mastre") {
                        name = data[i].name;
                        id = data[i].id;
                    } else if (table_name == "distributor_master") {
                        name = data[i].distributor_name;
                        id = data[i].id;
                    }



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            }
        });
    }

});