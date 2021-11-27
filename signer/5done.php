<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
// enviroment variables
require "/var/www/html/.env";
?>
<?php
//top level php mailer class
require "/var/www/html/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require "/var/www/html/vendor/phpmailer/phpmailer/src/SMTP.php";
require "/var/www/html/vendor/phpmailer/phpmailer/src/Exception.php";

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

$id = $_GET['contractNumber'];
$pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$emailStatus = $stmt->fetchAll();
?>




<?php if ($emailStatus[0]['emailSent'] < 1) : ?>

    <?php
    // sql get a list of signers
    $sql = <<<EOD
     SELECT * 
     FROM esignature.signers 
     WHERE signerParentContract=?; 
     EOD;
    $id = $_GET['contractNumber'];
    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $rows = $stmt->fetchAll();
    ?>

    <?php if ($_GET['email'] == "no") : ?>
    <?php else : ?>
        <?php
        $sql = <<<EOD
        UPDATE esignature.contract 
        SET emailSent=1
        WHERE contractId=?;
        EOD;

        $id = $_GET['contractNumber'];

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll();
        $filePath = '/var/www/html' . urldecode($_GET['downloadLink']);
        chmod($filePath, 0777);

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

    <?php endif; ?>
<?php endif; ?>


<?php require "/var/www/html/uiParts/footer.php"; ?>
<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/uiParts/card.php"; ?>
<?php require "/var/www/html/htmlStart.php"; ?>

<?php $content = <<<EOD
<p>The signed document has been sent back to the contract creater.</p>
<p>You can save your own persanal copy by clicking the save button below or check your email for a copy of the contract.</p>
EOD; ?>

<body>
    <!-- start of the base container -->
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>
    <div id="bodyCentering">
        <?= $backLink1 = "yourMom!" ?>
        <?php $backButton = true; ?>
        <?php require "/var/www/html/uiParts/headder.php"; ?>
        <div style="height:85px;"></div>

        <?php
        $fileDownload = urldecode($_GET['downloadLink']);
        $stringWithButton = <<<EOD
        <style>
            .card {
                padding: 30px !important;
            }

            .outerBox {
                width: 100%;

                display: flex;
                flex-direction: row;
                align-items: flex-start;
                justify-content: flex-start;

            }

            .innerBox {
                width: 50%;
                height: 125px;

                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;

            }
        </style>

        <div class="outerBox" style="height:100%;">
        
            <div class="innerBox">
                <a href="{$fileDownload}" download>
                    <div class="button" style="position:static; background:{$secondColor}; color:white; padding:30px 70px;">SAVE</div>
                </a>
            </div>

            <div class="innerBox">
                <img src="/uiImages/contractIcon.svg" style="width:60px;">
            </div>

        </div>
        EOD;

        $everyoneNotSigned = "<p>It looks like we are still waiting for signatures from everyone else who needs to sign. <br> We will send you an email with a copy of the contract once everyone else signs the contract.</p>"
        ?>

        <?php if ($_GET['email'] == "yes") : ?>
            <?php makeCard($content); ?>
            <?php makeCard($stringWithButton); ?>
        <?php else : ?>
            <?php makeCard($everyoneNotSigned); ?>
        <?php endif; ?>
        <div style="height:100px;"></div>


        <!-- Add the footer--------------------------------------------------------------- -->
        <?php
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