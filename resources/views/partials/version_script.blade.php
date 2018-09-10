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
    
    var table1= $('#example2').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example3').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example4').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example5').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example6').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example7').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example8').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example9').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example10').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example11').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example12').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example13').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example14').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example15').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example16').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example17').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example18').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example19').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example20').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example21').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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
    
    var table1= $('#example22').DataTable( {
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'asc']],
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