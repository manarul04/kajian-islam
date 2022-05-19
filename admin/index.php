<?php include 'include/header.php';?>
<?php

  if(isset($_GET['halaman'])){
    $hal = $_GET['halaman'];
    switch($hal){
      case 'dashboard';
        include 'halaman/dashboard.php';
      break;
      case 'kajian';
        include 'halaman/kajian.php';
      break;
      case 'admin';
        include 'include/admin/admin.php';
      break;
    }
  }else{
    include 'halaman/dashboard.php';
  }
?>
<?php include 'include/footer.php';?>