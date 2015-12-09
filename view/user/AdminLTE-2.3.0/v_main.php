<!DOCTYPE html>
<html>
  <?php require_once('elements/head.php'); ?>

  <body class="skin-blue-light sidebar-mini sidebar-collapse fixed">

    <div class="wrapper">

      <?php require_once('elements/header.php'); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php require_once('elements/sidebar.php'); ?>

      <!-- Content Wrapper. Contains page content -->
      <?php 
        require_once($content);
      ?>

      <?php require_once('elements/footer.php'); ?>

      <!-- Control Sidebar -->
      <?php require_once('elements/right_sidebar.php'); ?>

    </div><!-- ./wrapper -->

    <?php require_once('elements/scripts.php'); ?>


  </body>
</html>
