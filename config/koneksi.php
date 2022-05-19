<?php 
$connect = mysqli_connect("localhost","root","","db_kajian");
 
//Tambah Fungsi
require_once("database-function.php");

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>