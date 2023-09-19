<?php

declare(strict_types= 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

(new Dotenv())->load(__DIR__ .'.env');

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = '';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL_USER'];
    $mail->Password = $_ENV['MAIL_PASS'];
    $mail->SMTPSecure = 'ssl';
    $mail->Port = $_ENV['MAIL_PORT'];

    $mail->setFrom($_ENV['MAIL_USER'],'no-reply');
    $mail->addAddress('johndoe@mailnator.com','John Doe');
    $mail->addReplyTo('','');
    $mail->addCC('','');
    $mail->addBCC('','');

    $mail->addAttachment('','');

    $mail->isHTML(true);
    $mail->Subject = argv(1);
    $mail->Body = argv(2);
    $mail->AltBody = argv(3);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
}