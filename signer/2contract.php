<?php
// enviroment variables
require "/var/www/html/.env";
?>
<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/uiParts/card.php"; ?>
<?php require "/var/www/html/htmlStart.php"; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

<?php
$sql = <<<EOD
SELECT contractName, contractContent 
FROM contract
WHERE contractId = ?;
EOD;
$id = $_GET['contractNumber'];
$pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$rows = $stmt->fetchAll();
?>

<?php $content = $rows[0]['contractContent']; ?>
<?php $title = $rows[0]['contractName']; ?>


<style>
    #title {
        font-size: 30px;
        font-family: 'Merriweather', serif;
        margin-bottom: 24px;
    }

    #contractText p {
        font-size: 14px;
        font-family: 'Merriweather', serif;
        margin-bottom: 24px;
    }

    #contractText li {
        font-size: inherit;
        font-family: 'Merriweather', serif;
        margin-bottom: 10px;
        margin-left: 30px;
    }

    #contractText h1 {
        font-size: 30px;
        font-family: 'Merriweather', serif;
        margin-bottom: 24px;
    }

    #contractText h2 {
        font-size: 24px;
        font-family: 'Merriweather', serif;
        margin-bottom: 24px;

    }

    #contractText h3 {
        font-size: 20px;
        font-family: 'Merriweather', serif;
        margin-bottom: 24px;

    }
</style>

<body>
    <!-- start of the base container -->
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php
        $backButton = true;
        $backLink1 = "/signer/1instructions.php?contractNumber={$_GET['contractNumber']}&contractSigner={$_GET['contractSigner']}";
        require "/var/www/html/uiParts/headder.php";
        ?>
        <div style="height:85px;"></div>
        <?php makeCard("<p>please read the contract and press (NEXT) when you are ready to sign.</p>", "", 1); ?>
        <?php makeCard("<h1 id=title>" . $title . "</h1>" . "<br>" . "<div id=contractText>"  . $content . "</div>"); ?>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/var/www/html/uiParts/footer.php";
        $allButtons = [
            //$button1 = ["templatesButton", "http://www.google.com"],
            //$button2 = ["contractsButton", "http://www.google.com"],
            $button3 = ["nextButtonOrange", "/signer/3signature.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>