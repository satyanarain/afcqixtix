<script>
$(document).ready(function() {

    var table= $('#example1').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'desc']],
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
    
} );

</script>