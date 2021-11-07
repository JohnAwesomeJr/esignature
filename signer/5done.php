<?php
require "/var/www/html/.env";

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
    <pre>
        <?php print_r($emailToAdresses); ?>
    </pre>



<?php endif; ?>




















<?php require "/var/www/html/colors.php"; ?>

<?php require "/var/www/html/uiParts/card.php"; ?>
<?php $content = <<<EOD
<p>The signed document has been sent back to the contract creater.</p>
<p>You can save your own persanal copy by clicking the save button below.</p>
EOD; ?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Signature</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed&display=swap" rel="stylesheet">
</head>
<style>
    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
        font-size: 24px;
        text-decoration: none;
        color: black;

    }

    body {
        overflow: hidden;
        font-family: 'Barlow Condensed', sans-serif;
    }

    #bodyCentering {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
</style>

<body>
    <!-- start of the base container -->
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php require "/var/www/html/uiParts/headder.php"; ?>
        <div style="height:85px;"></div>
        <?php makeCard($content); ?>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/var/www/html/uiParts/footer.php";
        $allButtons = [
            $button1 = ["doneButton", "http://www.google.com"]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>