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

    $stmt = $db->prepare(
        "SELECT id, username, password 
         FROM users 
         WHERE username = ?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();

        
        if ($password === $data['password']) {
            $_SESSION["id_user"] = $data["id"];
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;

            unset($_SESSION["pesan"]);
            header("Location: /main/dashboard.php");
            echo "if";
            exit;
        }
    }

    $_SESSION["pesan"] = "Username atau password salah";
    header("Location: /main/login.php");
    echo "else";
    exit;
    $db->close();
}

$_SESSION["pesan"] = $pesan;
?>