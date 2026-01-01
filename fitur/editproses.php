<?php
session_start();
include __DIR__ . '/../service/database.php';

if (isset($_POST ["edit"])){
$id = $_SESSION['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST ['email'];

$periksa = "UPDATE users
SET username = '$username', password ='$password' , email = '$email' WHERE id = '$id' ";

$db->query($periksa);
echo "<script>
            alert('berhasil edit!');
            window.location.href = '/../main/Dashboard/profile.php';
        </script>";

$db->close();
}
?>