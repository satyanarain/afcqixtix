<script>
    $(function () {
        $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0,'desc']],
      "info": true,
      "autoWidth": false
     //"columnDefs": [{ "orderable": false, "targets": 2 }]
    });
    });
 </script> 