<?php
session_start();
include __DIR__ . '/../service/database.php';
$pesan = "";

if(isset($_SESSION["is_login"]) && isset($_SESSION['id_user'])){
    header("Location: /main/dashboard.php");
    exit;
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $periksa = "SELECT * FROM users WHERE 
    username='$username' AND password='$password'";

    $hasil = $db->query($periksa);

    if($hasil->num_rows > 0){
        $data = $hasil->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["id_user"] = $data["id"];
        $_SESSION["is_login"] = true ;
        unset($_SESSION["pesan"]);
        header("Location: /main/dashboard.php");
        exit;

    }else{
        $_SESSION["pesan"] = "Username atau password salah";
        header("Location: /main/login.php");
        exit;
    }
    $db->close();
}

$_SESSION["pesan"] = $pesan;
?>