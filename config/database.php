<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "iot";

$conn = mysqli_connect($servername, $username, $password, $database);

// Periksa koneksi apakah berhasil atau tidak
if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

// echo "Koneksi berhasil";
?>