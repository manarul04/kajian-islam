<?php
include '../config/koneksi.php';


    if(!isset($_SESSION)) 
    { 
        session_start();
    } 

 
if (isset($_SESSION['username'])) {
    echo '<meta content="0; url=../admin/" http-equiv="refresh">';
// 	echo '<script>alert("Sudah Login.")</script>';
    // echo $_SESSION['username'];
}

            if($_SERVER['REQUEST_METHOD'] == "POST"){
              if($_POST['submit']=="Simpan"){
                $namaFile = "USER"."-".$_POST["nama"].".jpg";
                $dirUpload = "../admin/img/foto/";
                $idpengguna = cek("tb_pengguna","id_pengguna");
                $data=array(
                  "id_pengguna"  => $idpengguna,
                  "nama"  => $_POST['nama'],
                  "alamat"  => $_POST['alamat'],
                  "email"  => $_POST['email'],
                  "foto" => $namaFile
                );
                Insert("tb_pengguna",$data);
                
                $datauser=array(
                  "username"  => $_POST['username'],
                  "password"  => $_POST['password'],
                  "level"  => $_POST['level'],
                  "id_pengguna"  => $idpengguna
                );
                Insert("tb_user",$datauser);
                
                $file_name = $_FILES['foto']['tmp_name'];
                $folder=$dirUpload.$namaFile;
                copy($file_name, $folder);
                // echo("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP 'meta'
				echo '<meta content="0; url=index.php" http-equiv="refresh">';
				echo '<script>swal("Daftar Berhasil, silahkan login", "Klik OK", "success");</script>';
				echo "<script>alert('Register Berhasil. Silahkan login')</script>";
              }
			}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Kajian Islam App</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" method="POST" enctype="multipart/form-data">
					<div class="login100-form-avatar">
						<img src="images/avatar-01.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Register
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Nama is required">
						<input class="input100" type="text" name="nama" placeholder="Nama" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" >
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" >
						<input class="input100" type="text" name="alamat" placeholder="Alamat">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-map"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<select class="input100" name="level" id="select2Single" required>
							<option value="pengguna">Pengguna</option>
                            <option value="kontributor">Kontributor</option>
                          </select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-cog"></i>
						</span>
					</div>
					<div style="color:#fff">Foto Profil</div>
						<input type="file" class="form-control" name="foto" placeholder="Foto Profil">
					

					<div class="container-login100-form-btn p-t-10">
						<!-- <button class="login100-form-btn">
							Login
						</button> -->
						<input type="submit" class="login100-form-btn" name="submit" value="Simpan" />
					</div>

				

					<div class="text-center w-full">
						<a class="txt1" href="#">
							<!-- Create new account
							<i class="fa fa-long-arrow-right"></i>						 -->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->

	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>