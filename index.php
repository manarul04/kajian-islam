<?php include 'include/header.php';?>
<?php

  if(isset($_GET['halaman'])){
    $hal = $_GET['halaman'];
    switch($hal){
      case 'home';
        include 'halaman/home.php';
      break;
      case 'kajian';
        include 'halaman/kajian.php';
      break;
      case 'admin';
        include 'include/admin/admin.php';
      break;
    }
  }else{
    include 'halaman/home.php';
  }
?>
<?php include 'include/footer.php';?>