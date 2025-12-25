<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';


function sendDiskonMail($to, $namaProduk, $hargaBaru, $diskonBaru, $linkes) {
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
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'Diskon Baru!';
        $mail->Body    = "
            <b>$namaProduk</b><br>
            Harga: Rp $hargaBaru<br>
            Diskon: $diskonBaru%<br>
            Ayo di beli ----> website $linkes
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
