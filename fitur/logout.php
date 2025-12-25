<?php
session_start();
include __DIR__ . '/../service/database.php';
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: /main/login.php');

    exit;
}
?>