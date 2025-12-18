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
        header("location: ../main/dashboard.php");

    }else{
        $pesan = "username atau password salah";
    }
    $db->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <header>
        <h3>cobain log,sig in</h3>
        <a href="/main/index.php">Home</a>
        <a href="/main/login.php">Login</a>
        <a href="/main/sigin.php">Sigin</a>
    </header>
    <h3>MASUK AKUN</h3>
    <i><?= $pesan ?></i>
    <form action="login.php" method = "POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="login"> Daftar </button>
    </form>
</body>
</html>