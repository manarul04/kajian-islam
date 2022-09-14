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
      case 'ustad';
        include 'halaman/ustad.php';
      break;
      case 'jadwal';
        include 'halaman/jadwal.php';
      break;
      case 'kategori';
        include 'halaman/kategori.php';
      break;
      case 'user';
        include 'halaman/user.php';
      break;
    }
  }else{
    include 'halaman/dashboard.php';
  }
?>
<?php include 'include/footer.php';?>