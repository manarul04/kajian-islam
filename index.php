<?php include 'include/header.php';?>
<?php

  if(isset($_GET['halaman'])){
    $hal = $_GET['halaman'];
    switch($hal){
      case 'home';
        include 'halaman/home.php';
      break;
      case 'about';
        include 'halaman/about.php';
      break;
      case 'profil';
        include 'halaman/profil.php';
      break;
      case 'detail';
        header('Location: halaman/detail.php');
      break;
    }
  }else{
    include 'halaman/home.php';
  }
?>
<?php include 'include/footer.php';?>