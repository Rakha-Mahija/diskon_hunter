<?php
include __DIR__ . '/../service/database.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

$email = $_POST['email'];

$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>
            alert('Email tidak di temukan!');
            window.location.href = '/main/forgot.php';
        </script>";
    die("Email tidak ditemukan");
}

$user_id = $user['id'];

$stmt = $db->prepare("DELETE FROM password_resets WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$token = bin2hex(random_bytes(32));
$expired = date("Y-m-d H:i:s", strtotime("+1 minutes"));

$stmt = $db->prepare("
    INSERT INTO password_resets (user_id, token, expired)
    VALUES (?, ?, ?)
");
$stmt->bind_param("iss", $user_id, $token, $expired);
$stmt->execute();
// kirim pakai PHPMailer

$mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('', 'Diskon Hunter');
        
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Reset Password";
        $mail->Body = "Masukkan token ini untuk mengubah password:$token";

        $mail->send();
        

    } catch (Exception $e) {
        die("Gagal mengirim email");
    }
header("Location: /main/change_pass.php");
exit;
