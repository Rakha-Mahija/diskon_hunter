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
        $mail->Host       = getenv('MAIL_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('MAIL_USERNAME');
        $mail->Password   = getenv('MAIL_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = getenv('MAIL_PORT');
        

        $mail->setFrom(
        getenv('MAIL_FROM_ADDRESS'),
        getenv('MAIL_FROM_NAME')
        );
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
