<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/uiParts/card.php"; ?>
<?php require "/var/www/html/htmlStart.php"; ?>
<?php
// enviroment variables
require "/var/www/html/.env";
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


<style>
    .numberTextContainer {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: left;

        margin: 30px 0px;
    }

    .numberTextContainer h4 {
        margin: 0px;
        flex-shrink: 1;
        font-size: 20px;
    }

    #card {
        padding: 30px 30px 30px 30px !important;
    }

    .flexCentering {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
</style>

<body>

    <?php
    if ($rows[0]['signDate'] == 0) {
        $content = <<<EODCONTENTTHINGS
        <div class="flexCentering">
            <div>
                <div class="numberTextContainer">
                    <img src="/uiImages/1.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Read The Contract</h4>
                </div>
                <div class="numberTextContainer">
                    <img src="/uiImages/2.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Sign The Contract</h4>
                </div>
                <div class="numberTextContainer">
                    <img src="/uiImages/3.svg">
                    <h4>&nbsp;&nbsp;&nbsp;Send a copy to the owner</h4>
                </div>
                <div class="numberTextContainer">
                    <img src="/uiImages/4.svg">
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
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>



    <div id="bodyCentering">
        <?php
        $backButton = false;
        $backLink1 = "http://www.youtube.com";
        require "/var/www/html/uiParts/headder.php";
        ?>

        <div style="height:85px;"></div>
        <?php makeCard($content); ?>
        <div style="height:100px;"></div>

        <!-- Add the footer -->
        <?php
        if ($rows[0]['signDate'] == 0) {

            require "/var/www/html/uiParts/footer.php";
            $allButtons = [
                //$button1 = ["templatesButton", "http://www.google.com"],
                //$button2 = ["contractsButton", "http://www.google.com"],
                $button3 = ["nextButtonOrange", "/signer/2contract.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
            ];
            footer(...$allButtons);
        }
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>