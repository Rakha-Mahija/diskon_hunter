<?php

session_start();

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: login.php');

    exit;
}
if (!isset($_SESSION['is_login']) || !isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
//ini jangan di sentuh,debug ini
/*
if(isset($_SESSION["pesan"])){
    $pesan = $_SESSION["pesan"];
    unset($_SESSION["pesan"]); 
} else {
    $pesan = null;
}*/
include "../service/database.php";

$idUser = $_SESSION['id_user'];

$query = "SELECT * FROM scrap WHERE id_user = $idUser";
$result = mysqli_query($db, $query);
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
        <h3>Dashboard</h3>
        <a href="index.php">Home</a>
        <a href="/fitur/loginproses.php">Dasboard</a>
    </header>
    <h1>Selamat datang <?= $_SESSION["username"] ?></h1>
    <form action="dashboard.php" method="POST">
        <button type="submit" name="logout">Log out </button><br>
        <!--
        </?php if($pesan): ?>
        <p></?= htmlspecialchars($pesan) ?></p>
        </?php endif; ?>-->
    </form>
    <table border = "1">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Diskon</th>
        <th>Link</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['harga'] ?></td>
        <td><?= $row['diskon'] ?></td>
        <td><?= $row['link'] ?></td>
    </tr>
    <?php endwhile; ?><br>
</table>
    <script>/*  ini percobaan timer nya
setInterval(() => {
    fetch('/fitur/timerlink.php', { method: 'POST' })
        .then(res => res.text())
        .then(txt => console.log(txt));
}, 30000); // 5 menit
</script>
    <form action="/fitur/tesbanding.php" method="post">
        <button type="submit" name="coba">coba </button><br>
    </form>

</body>
</html>