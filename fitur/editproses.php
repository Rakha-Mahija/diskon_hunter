<?php
session_start();
include __DIR__ . '/../service/database.php';

if (isset($_POST ["edit"])){
$id = $_SESSION['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST ['email'];

$stmt = $db->prepare("UPDATE users SET username = ?, password = ?, email = ? WHERE id = ?");
$stmt->bind_param("sssi", $username, $password, $email, $id);
$stmt->execute();
echo "<script>
            alert('berhasil edit!');
            window.location.href = '/../main/Dashboard/profile.php';
        </script>";

$db->close();
}
?>