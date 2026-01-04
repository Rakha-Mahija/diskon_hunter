<?php
$db = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME')
);

if($db->connect_error){
    echo "koneksi gagal";
    die("error");
}

?>