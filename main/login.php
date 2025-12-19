<?php
session_start();
$pesan = $_SESSION["pesan"] ?? "";
unset($_SESSION["pesan"]);
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
    <form action="/fitur/loginproses.php" method = "POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="login"> Daftar </button>
    </form>
</body>
</html>