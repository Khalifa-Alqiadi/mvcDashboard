<?php 
    include("include/head.php");
?>

  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

  
  
      <!-- Menu -->

      <?php 
      include("include/aside.php");
      include("include/nav.php");
      ?>
      <!-- / Menu -->


    <!-- Layout container -->
    <div class="layout-page">
        <div class="content-wrapper"> 
            <div class="alert alert-success"><?php echo $params; ?></div>
        </div>
    </div>
</body>
</html>
