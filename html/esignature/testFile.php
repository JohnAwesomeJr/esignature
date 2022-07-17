<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
// enviroment variables
require "/var/www/html/esignature/.env";
?>
<?php
//top level php mailer class
require "/{$rootD}/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/{$rootD}/vendor/phpmailer/phpmailer/src/SMTP.php";
require "/{$rootD}/vendor/phpmailer/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
?>



        <?php

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = $googleEmail;
        $mail->Password = $googlePassword;
        $mail->isHTML(true);
        $mail->Subject = 'Everyone has signed!';
        $mail->setFrom($googleEmail);
        $mail->Body = 'The guy is a test';
        $mail->addAddress('johnawesomejr@gmail.com');

        $mail->send();
        $mail->smtpClose();

        ?>