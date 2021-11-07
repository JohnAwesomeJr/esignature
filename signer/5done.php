<?php
require "/var/www/html/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/var/www/html/vendor/phpmailer/phpmailer/src/SMTP.php";
require "/var/www/html/vendor/phpmailer/phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
?>



<?php
$sql = <<<EOD
SELECT * 
FROM esignature.signers
WHERE signerParentContract = ?;
EOD;

$id = $_GET['contractNumber'];

$pdo = new PDO('mysql:host=localhost;dbname=esignature', "root", "il0veG@D");
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$rows = $stmt->fetchAll();
?>


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<h1>All done!</h1>
<?php if ($_GET['email'] == "no") : ?>
    <p>We will send you an email with a copy of the contract once everyone signs.</p>
<?php else : ?>
    <p>please download the pdf copy of the signed contract</p>
    <?php
    $filePath = '/var/www/html' . urldecode($_GET['downloadLink']);
    chmod($filePath, 0777);
    ?>

    <a href="<?= "" . urldecode($_GET['downloadLink']); ?>" download>
        DOWNLOAD PDF CONTRACT
    </a>

    <?php
    $emailToAdresses = array();
    foreach ($rows as $key => $value) {
        array_push($emailToAdresses, $rows[$key]['signerEmail']);
    }
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = 'johnawesomejr@gmail.com';
    $mail->Password = 'Gooil0veG@Dgoo!1';
    $mail->isHTML(true);
    $mail->Subject = 'Everyone has signed!';
    $mail->setFrom('johnawesomejr@gmail.com');
    $mail->Body = 'Everyone has signed the contract!<br> you can now download it <a href="http://www.google.com">here</a> or you cand save the attatchment on this email. <br>Thank you for using our e-signature service!<br>If you appreciate this service please tell oters about your expiriance! Thank you, thank you!';
    foreach ($emailToAdresses as $key => $value) {
        $mail->addAddress($emailToAdresses[$key]);
    }
    $mail->addAttachment($filePath, 'Contract.pdf');
    $mail->send();
    $mail->smtpClose();
    ?>
    <pre>
        <?php print_r($emailToAdresses); ?>
    </pre>



<?php endif; ?>