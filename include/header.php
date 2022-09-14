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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/regular.min.css" integrity="sha512-EbT6icebNlvxlD4ECiLvPOVBD0uQdt4pHRg8Gpkfirdu9W8l2rtRZO8rThjqeIK08ubcFeiFKHbek7y+lEbWIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" integrity="sha512-5PV92qsds/16vyYIJo3T/As4m2d8b6oWYfoqV+vtizRB6KhF1F9kYzWzQmsO6T3z3QG2Xdhrx7FQ+5R1LiQdUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <a class="navbar-brand" href="/kajian-islam">
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
                    <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="jadwal"){echo 'active';}?>" href="jadwal">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="about"){echo 'active';}?>" href="about">About</a>
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
                        <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="profil"){echo 'active';}?>" href="profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-1 <?php if($_GET['halaman']=="favorit"){echo 'active';}?>" href="favorit">Favorit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-2 active"  href="admin/logout.php">Logout</a>
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