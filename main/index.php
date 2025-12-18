<?php
session_start();

if(!isset($_SESSION["is_login"])){
    header("Location: login.php");
    exit;
}

if(isset($_SESSION["hasil"])){
    $hasil = $_SESSION["hasil"];
    unset($_SESSION["hasil"]); 
} else {
    $hasil = null;
}

if(isset($_SESSION["pesan"])){
    $pesan = $_SESSION["pesan"];
    unset($_SESSION["pesan"]); 
} else {
    $pesan = null;
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
        <h3>home</h3>
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
    </header>
    <main>
        <form action="/fitur/linkproses.php" method='post'>
            <label>Masukkan link</label>
            <input type="text" name="link"><br><br>
            <input type="submit">
        </form>
        <!--
        </*?php if($hasil): ?>
        <p></*?= htmlspecialchars($hasil) ?></p>
        <p>berhasil disimpan</p>
        </*?php endif; ?*/>-->
        
        <?php if($pesan): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
        <?php endif; ?>
    </main>
</body>
</html>