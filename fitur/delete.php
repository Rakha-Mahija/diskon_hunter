<?php
session_start();
include __DIR__ . '/../service/database.php';

if (isset($_POST ["hapus"])){
$id = $_SESSION['id_user'];

$periksa = "DELETE  FROM users WHERE 
    id='$id' ";

    $cari = $db->query($periksa);
    session_unset();
    session_destroy();
    header("location: '/../../main/login.php");
    
    $db->close();
}


?>