<?php
include __DIR__ . '/../service/database.php';

$token = $_POST['token'];
$password =$_POST['password'];

// ambil data token
$stmt = $db->prepare("SELECT * FROM password_resets WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();



if (!$data) {
    echo "<script>
            alert('token tidak valid!');
            window.location.href = '/main/change_pass.php';
        </script>";
    die("Token tidak valid");
}

if (strtotime($data['expired']) < time()) {
    echo "<script>
            alert('token kadarluarsa,kirim ulang Email');
            window.location.href = '/main/forgot.php';
        </script>";
    die("Token sudah kadaluarsa");
}

$user_id = $data['user_id'];

// update password
$stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $password, $user_id);
$stmt->execute();

// hapus token setelah dipakai
$stmt = $db->prepare("DELETE FROM password_resets WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

echo "<script>
            alert('Password berhasil dirubah');
            window.location.href = '/main/login.php';
        </script>";