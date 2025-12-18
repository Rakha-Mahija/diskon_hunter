<?php
include __DIR__ . '/../service/database.php';
session_start();

if(isset($_SESSION["is_login"])){
    header("location: ../main/dashboard.php");
}

$pesan ="";
if(isset($_POST['sigin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];
    
    try{
    $daftar = "INSERT INTO users (username, password, email) VALUES
    ('$username', '$password', '$email')";

    if($db->query("$daftar")){
        $pesan = "daftar berhasil , silahkan log in";
    }else{
        $pesan = "daftar gagal ";
    }
    }catch(mysqli_sql_exception){
        $pesan ="Username atau email sudah di gunakan";
    }$db->close();

    
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
    <h3>BUAT AKUN</h3>
    <i><?= $pesan ?></i>
    <form action="sigin.php" method = "POST" id="formsig">
        <input type="text" placeholder="username" name="username" id="username"/>
        <input type="password" placeholder="password" name="password" id="link"/>
        <input type="email" placeholder="email" name="email" id="email"/>
        <button type="submit" name="sigin"> Daftar </button>
    </form>
    <script>
    document.getElementById("formsig").addEventListener("submit", function(e) {
    const username = document.getElementById("username").value.trim();
    const link = document.getElementById("link").value.trim();
    const email = document.getElementById("email").value.trim();

    if (username === "" || link === "" || email === "") {
        e.preventDefault(); 
        alert("Semua field wajib diisi!");
        return;
    }
    });
</script>
</body>
</html>