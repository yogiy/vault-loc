jQuery( document ).ready( function($) {
    var $table4 = jQuery( "#table-4" );
    $table4.DataTable({
        "columnDefs": [{
            "targets": 'no-sorting',
            "orderable": false,
        }],
        "dom": "<'row'<'col-sm-5'B><'col-sm-3'l><'col-sm-4'f>>" +"<'row'<'col-sm-6'i><'col-sm-6 pull-right'p>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5' i><'col-sm-7'p>>",
        "aLengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "buttons": [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            }
        ],
        "fnDrawCallback": function () {
            $("#loading").hide();
            var api = this.api();

            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
            pagination.toggle(this.api().page.info().pages > 1);

            setTimeout( function () {
                api.columns().flatten().each(function (colIdx) {
                    var columnData = api.columns(colIdx).data().join('');
                    if (columnData.length == (api.rows().count() - 1) && colIdx != 0) {
                        api.column(colIdx).visible(false);
                    }
                    else{api.column(colIdx).visible(true);}
                });
            },0)
        }
    });

    $table4.closest( '.dataTables_wrapper' ).find( 'select' ).select2({
        minimumResultsForSearch: -1
    });
    $.fn.digits = function(){
        return this.each(function(){
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d)+\d$)/g, "$1,") );
        })
    }
    $(".comma_sep_no").digits();

    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 9000);



    $('#advSearch_close').click(function () {
        $('#transactionform_income')[0].reset();
    });

    $("#s2id_business_units").select2();


    $("#abc").click(function () {
        $("#popUp").show();
        $("#input-transaction_date").hide();
    });

    $("#edit-popup").click(function () {
        $("#input-transaction_date").show();
    });

    $("#edit-function").click(function () {
        $("#view-transaction_date").hide();
        $("#input-transaction_date").show();
    });
    $("#close").click(function () {
        $("#largeModal").hide();
        $("#select2-drop").hide();

    });
    $("#close2").click(function () {
        $("#popUp").hide();
    });
    $("#close3").click(function () {
        $("#popUp").hide();
    });


    var $table2 = jQuery( "#table-2" );
    $table2.DataTable({
        "columnDefs": [{
            "targets": 'no-sorting',
            "orderable": false,
        }],
        "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +"<'row'<'col-sm-6'i><'col-sm-6 pull-right'p>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5' i><'col-sm-7'p>>",
        "aLengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pageLength": 100,
        "buttons": [],
        "fnDrawCallback": function () {
            $("#loading").hide();
            var api = this.api();

            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
            pagination.toggle(this.api().page.info().pages > 1);

            setTimeout( function () {
                api.columns().flatten().each(function (colIdx) {
                    var columnData = api.columns(colIdx).data().join('');
                    if (columnData.length == (api.rows().count() - 1) && colIdx != 0) {
                        api.column(colIdx).visible(false);
                    }
                    else{api.column(colIdx).visible(true);}
                });
            },0)
        }
    });

    $table2.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
        minimumResultsForSearch: -1
    });

    var reports = jQuery( ".reports" );
    var reports2 = jQuery( ".reports2" );
    reports.DataTable({
        "columnDefs": [{
            "targets": 'no-sorting',
            "orderable": false,
        }],
        "dom": "<'row'<''B>>" ,
        "buttons": [
            {
                extend: 'excelHtml5',
                footer: true,
            exportOptions: {
                    columns: [ 0, 1, 2, 3,4]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4]
                }
            }
        ]
    });
    reports2.DataTable({
        "columnDefs": [{
            "targets": 'no-sorting',
            "orderable": false,
        }],
        "dom": "<'row'<''B>>" ,
        "buttons": [
            {
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            }
        ]
    });


    $('#period11').on('change',function () {
        var per = $('#period11').val();
        $('#proNm').hide();
        $("#cost_center_ids").prop("disabled", true);
        //$('#cost_center_ids').empty().append('');
        $("#bu_id option:selected").removeAttr("selected");

        if(per==5)
        {
            $('#date_range').show();
            $("#date_from").prop('disabled', false);
            $("#date_to").prop('disabled', false);
        } else {
            $('#date_range').hide();
            $("#date_from").prop('disabled', true);
            $("#date_to").prop('disabled', true);
        }
    });
});

function action(val) {
    //confirm(val);
    var res = confirm("Note* Are you sure "+val+" this record?");
    if(res == true) {
        return true;
    }
    return false;
}
