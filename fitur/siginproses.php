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
    
      try {
        // PREPARED STATEMENT
        $stmt = $db->prepare(
            "INSERT INTO users (username, password, email) 
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param("sss", $username, $password, $email);
        $stmt->execute();

        $pesan = "daftar berhasil, silahkan log in";
        header("location: ../main/sigin.php");
        $_SESSION["pesan"] = $pesan;
        exit;

    } catch (mysqli_sql_exception $e) {
        $pesan = "Username atau email sudah di gunakan";
        $_SESSION["pesan"] = $pesan;
        header("location: ../main/sigin.php");
        exit;
    }
    
}

?>