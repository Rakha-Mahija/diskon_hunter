<?php
include __DIR__ . '/../service/database.php';
session_start();

if(isset($_SESSION["is_login"])){
    header("location: ../main/dashboard.php");
}

$pesan ="";
unset($_SESSION["pesan"]);
if(isset($_POST['sigin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];
    
    try{
    $daftar = "INSERT INTO users (username, password, email) VALUES
    ('$username', '$password', '$email')";

    if($db->query("$daftar")){
        $pesan = "daftar berhasil , silahkan log in";
        header("location: ../main/sigin.php");
    }else{
        $pesan = "daftar gagal ";
        header("location: ../main/sigin.php");
    }
    }catch(mysqli_sql_exception){
        $pesan ="Username atau email sudah di gunakan";
        header("location: ../main/sigin.php");
    }$db->close();

    
}
$_SESSION["pesan"] = $pesan;
?>