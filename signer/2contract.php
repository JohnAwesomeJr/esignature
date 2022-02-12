<?php
// enviroment variables
require "/var/www/html/esignature/.env";
?>
<?php require "/{$rootD}/colors.php"; ?>
<?php require "/{$rootD}/uiParts/card.php"; ?>
<?php require "/{$rootD}/htmlStart.php"; ?>

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

<body>
    <!-- start of the base container -->
    <?php require "/{$rootD}/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php
        $backButton = true;
        $backLink1 = "/signer/1instructions.php?contractNumber={$_GET['contractNumber']}&contractSigner={$_GET['contractSigner']}";
        require "/{$rootD}/uiParts/headder.php";
        ?>
        <div style="height:85px;"></div>
        <?php makeCard("<p>please read the contract and press (NEXT) when you are ready to sign.</p>", "", 1); ?>
        <?php makeCard("<h1 id=title>" . $title . "</h1>" . "<br>" . "<div id=contractText>"  . $content . "</div>"); ?>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/{$rootD}/uiParts/footer.php";
        $allButtons = [
            //$button1 = ["templatesButton", "http://www.google.com"],
            //$button2 = ["contractsButton", "http://www.google.com"],
            $button3 = ["nextButtonOrange", "{$rootFolder}signer/3signature.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>