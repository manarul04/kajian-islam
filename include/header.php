<?php

include "config/koneksi.php";
error_reporting(0);
//  error_reporting(E_ALL);
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
    $foto = $data['foto'];
   $loginhdn="hidden";
}else{
    $loginhdn="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalam - Kajian Islam</title>
    <link href="admin/img/logo/logo.png" rel="icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
<!--
    
TemplateMo 556 Catalog-Z

https://templatemo.com/tm-556-catalog-z

-->
</head>
<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <i class="fas fa-film mr-2"></i> -->
                <img src="img/logo.png" width="100px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="home"){echo 'active';}?>" aria-current="page" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="about"){echo 'active';}?>" href="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="profil"){echo 'active';}?>" href="profil">Profil</a>
                </li>
                
                <?php if($loginhdn!='hidden'){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-1" href="login">Login</a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-2 active"  href="#"><?=$username?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            </div>
        </div>
    </nav>

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
        <!-- <form class="d-flex tm-search-form">
            <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success tm-search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form> -->
    </div>