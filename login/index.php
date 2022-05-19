<?php
include '../config/koneksi.php';


    if(!isset($_SESSION)) 
    { 
        session_start();
    } 

 
if (isset($_SESSION['username'])) {
    echo '<meta content="0; url=../Admin/index.php" http-equiv="refresh">';
// 	echo '<script>alert("Sudah Login.")</script>';
    // echo $_SESSION['username'];
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        
        ini_set('session.cookie_lifetime', 86400);
        ini_set('session.gc_maxlifetime', 86400);
        // header("Location: berhasil_login.php");
        // echo '<script>alert("Berhasil Login.")</script>';
        echo '<meta content="0; url=../Admin/index.php" http-equiv="refresh">';
    } else {
        echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
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
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" method="POST">
					<div class="login100-form-avatar">
						<img src="images/avatar-01.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<!-- <button class="login100-form-btn">
							Login
						</button> -->
						<input type="submit" class="login100-form-btn" name="submit" value="Login" />
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