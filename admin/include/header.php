<?php

include "../config/koneksi.php";
// error_reporting(0);
 error_reporting(E_ALL);
session_start(['cookie_lifetime' => 86400,]);

if (isset($_SESSION['username'])) {
  // echo '<meta content="0; url=profil/" http-equiv="refresh">';
  $username = $_SESSION['username'];
  
    $query = mysqli_query($connect, "SELECT * FROM v_user WHERE username='$username'");
    $data = mysqli_fetch_array($query);
    $id = $data['id_pengguna'];
    $level = $data['level'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $email = $data['email'];

    if($level=="Kontributor"){
        $user="hidden";
    
    }else{
        $user="";
        
    }
   
}else{
  echo '<script>alert("Login Terlebih Dahulu.")</script>';
  echo '<meta http-equiv="refresh" content="0;url=https://app.betamedia.id"/> ';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Kalam - Kajian Islam</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Kajian Islam</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=kajian">
          <i class="fas fa-fw fa-video"></i>
          <span>Kajian</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=ustad">
          <i class="fas fa-fw fa-users"></i>
          <span>Ustad</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=kategori">
          <i class="fas fa-fw fa-list"></i>
          <span>Kategori</span>
        </a>
      </li>
      <div <?=$user;?>>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          User
        </div>
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
          </a>
        </li>
      </div>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><?=$nama;?> | <?=$level;?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
          