<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
// require "/var/www/html/arrayVisualizer.php";
require "/var/www/html/classes/db.php";
require "/var/www/html/.env";

// SELECT
$db = new db();
$selectExample = <<<EOD
SELECT signerEmail, signerTitle, signerName, signerId
FROM esignature.signers
WHERE signerParentContract = ?;
EOD;
$emails = $db->selectSql($selectExample, [$_GET['contractNumber']]);

echo "<pre>";
print_r($emails);
echo "</pre>";



//top level php mailer class
require "/var/www/html/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/var/www/html/vendor/phpmailer/phpmailer/src/SMTP.php";
require "/var/www/html/vendor/phpmailer/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$emailToAdresses = array();
foreach ($emails as $key => $value) {
    array_push($emailToAdresses, $emails[$key]['signerEmail']);
}
$lastItem = count($emailToAdresses) - 1;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username = $googleEmail;
$mail->Password = $googlePassword;
$mail->isHTML(true);
$mail->Subject = 'Sign Contract';
$mail->setFrom($googleEmail);
$mail->Body = 'Hey ' . ucwords($emails[$_GET['arrayPosition']]['signerName']) . ' <br> This email is to inform you that you have been assigned as a ' . strtolower($emails[$_GET['arrayPosition']]['signerTitle']) . ' on this contract. <br> You can click the link to sign it. <a href="' . $mainUrl . "/signer/1instructions.php?" . "contractNumber=" . $_GET['contractNumber'] . "&contractSigner= " . $emails[$_GET['arrayPosition']]['signerId'] . '">click here to sign</a>';
$mail->addAddress($emailToAdresses[$_GET['arrayPosition']]);
$mail->send();
$mail->smtpClose();

echo $mail->Body;

echo $_GET['arrayPosition'];
echo "<br>";
echo $lastItem;
if ($_GET['arrayPosition'] == $lastItem) {
    echo "last one";
    header("Location: /createAContract/12finished.php");
} else {
    $newPosition = (int)$_GET['arrayPosition'] + 1;
    echo "not done";
    header("Location: /createAContract/11sendSignNotifacationEmails.php?arrayPosition=" . $newPosition . "&contractNumber=" . $_GET['contractNumber']);
}
