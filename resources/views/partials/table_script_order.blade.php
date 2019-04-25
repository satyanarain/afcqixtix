<script>
$(document).ready(function() {

    var table= $('#example1').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "order": [],
        "info": true,
        "autoWidth": false,
        "colVis": [{
            exclude: [ 0 ]
        }],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                     columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }
        ]
    } );
    var table2= $('#example2').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      //"order": [[0,'asc']],
      "info": true,
      "autoWidth": false,
    "colVis": [{
            exclude: [ 0 ]
        }],
  dom: 'Bfrtip',
    lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                     columns: ':visible'
                }
            },
                  {
            extend: 'colvis',
            columns: ':gt(0)'
        }

        ]
    } );


    var table2= $('#reportTable').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      //"order": [[0,'asc']],
      "info": true,
      "autoWidth": false,
    "colVis": [{
            exclude: [ 0 ]
        }],
  dom: 'Bfrtip',
    lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                     columns: ':visible'
                },
                orientation: 'landscape'
            },
            {
                extend: 'colvis',
                columns: ':gt(0)'
            }

        ]
    } );

    $('#tableWithFilter thead tr').clone(true).appendTo( '#tableWithFilter thead' );
    $('#tableWithFilter thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#tableWithFilter').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );


    $('#tableWithDropdownFilter').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
    
} );

</script>