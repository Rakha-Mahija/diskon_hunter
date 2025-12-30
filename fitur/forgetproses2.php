<?php
include __DIR__ . '/../service/database.php';

$token = $_POST['token'];
$password =$_POST['password'];

// ambil data token
$q = $db->query("SELECT * FROM password_resets WHERE token='$token'");
$data = $q->fetch_assoc();

if (!$data) {
    die("Token tidak valid");
}

$user_id = $data['user_id'];

// update password
$db->query("UPDATE users SET password='$password' WHERE id='$user_id'");

// hapus token setelah dipakai
$db->query("DELETE FROM password_resets WHERE user_id='$user_id'");

echo "<script>
            alert('Password berhasil dirubah');
            window.location.href = '/main/login.php';
        </script>";