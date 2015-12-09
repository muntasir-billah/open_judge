    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $fullpath; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $fullpath; ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $fullpath; ?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $fullpath; ?>dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo $fullpath; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $fullpath; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $fullpath; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo $fullpath; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo $fullpath; ?>plugins/chartjs/Chart.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo $fullpath; ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $fullpath; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo $fullpath; ?>dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $fullpath; ?>dist/js/demo.js"></script>

    <script>

        var id = '';

          $(function () {
            $(".oj_datatable").DataTable();
            $('.oj_datatable_basic').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });
          });

          $('.submit_button').click(function() {
            var problem = $(this).attr('for');
            //alert(problem);
            id = "option" + problem;
            $('#'+id).attr('selected', 'selected');
            $('.submit_form').show();
          });

          $('.submit_form_close').click(function() {
            $('#'+id).removeAttr('selected');
            $('.submit_form').hide();
          });

          // $('.submit_form').submit(function() {
          //   alert("hello");
          // });
        
    </script>