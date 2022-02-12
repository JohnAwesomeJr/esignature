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
//if contract emails have not been sent
$sql = <<<EOD
SELECT emailSent
FROM esignature.contract
WHERE contractId = ?;
EOD;

$id = 2;
$pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$emailStatus = $stmt->fetchAll();
?>


    <?php
    // sql get a list of signers
$sql = <<<EOD
SELECT * 
FROM esignature.signers 
WHERE signerParentContract=?; 
EOD;
    $id = 2;
    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $rows = $stmt->fetchAll();
    ?>


        <?php
        $filePath = '/{$rootD}/pdfFiles/618c6a4366bc79.46793694.pdf';

        $emailToAdresses = array();
        foreach ($rows as $key => $value) {
            array_push($emailToAdresses, $rows[$key]['signerEmail']);
        }
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
        $mail->Body = 'Everyone has signed the contract!<br> you can now download it <a href="http://www.google.com">here</a> or you cand save the attatchment on this email. <br>Thank you for using our e-signature service!<br>If you appreciate this service please tell oters about your expiriance! Thank you, thank you!';
        foreach ($emailToAdresses as $key => $value) {
            $mail->addAddress($emailToAdresses[$key]);
        }
        $mail->addAttachment($filePath, 'Contract.pdf');
        $mail->send();
        $mail->smtpClose();

        ?>