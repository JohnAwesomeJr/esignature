<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php require "/var/www/html/esignature/.env"; ?>
<?php require "/{$rootD}/colors.php"; ?>
<?php require "/{$rootD}/uiParts/card.php"; ?>
<?php require "/{$rootD}/htmlStart.php"; ?>
<?php
// enviroment variables
require "/var/www/html/esignature/.env";
?>

<?php

$sql = <<<EOD
SELECT * 
FROM esignature.signers
WHERE signerId =?;
EOD;

$id = $_GET['contractSigner'];

$pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$rows = $stmt->fetchAll();
?>

<body>

    <?php
    if ($rows[0]['signDate'] == 0) {
        $content = <<<EODCONTENTTHINGS
        <div class="flexCentering">
            <div>
                <div class="numberTextContainer">
                    <img src="{$rootFolder}uiImages/1.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Read The Contract</h4>
                </div>
                <div class="numberTextContainer">
                    <img src="{$rootFolder}uiImages/2.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Sign The Contract</h4>
                </div>
                <div class="numberTextContainer">
                    <img src="{$rootFolder}uiImages/3.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Send a copy to the owner</h4>
                </div>
                <div class="numberTextContainer">
                    <img src="{$rootFolder}uiImages/4.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Save Your Copy</h4>
                </div>
            </div>
        </div>
    EODCONTENTTHINGS;
    } else {
        $content = "<p>You have alredy signed this contract</p>";
    }
    ?>



    <!-- start of the base container -->
    <?php require "/{$rootD}/uiParts/baseContainer.php"; ?>



    <div id="bodyCentering">
        <?php
        $backButton = false;
        $backLink1 = "http://www.youtube.com";
        require "/{$rootD}/uiParts/headder.php";
        ?>

        <div style="height:85px;"></div>
        <?php makeCard($content); ?>
        <div style="height:100px;"></div>

        <!-- Add the footer -->
        <?php
        if ($rows[0]['signDate'] == 0) {

            require "/{$rootD}/uiParts/footer.php";
            $allButtons = [
                //$button1 = ["templatesButton", "http://www.google.com"],
                //$button2 = ["contractsButton", "http://www.google.com"],
                $button3 = ["nextButtonOrange", "{$rootFolder}signer/2contract.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
            ];
            footer(...$allButtons);
        }
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>