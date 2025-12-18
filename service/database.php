<?php
$hostname = "mysql_db";
$username = "root";
$password = "root";
$database_name = "diskon_hunter";

$db = mysqli_connect($hostname , $username , $password , $database_name);

if($db->connect_error){
    echo "koneksi gagal";
    die("error");
}



?>