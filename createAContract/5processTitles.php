<?php
require "/var/www/html/esign/classes/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php session_start(); ?>
<!-- are you logged in? -->
<?php if ($_SESSION) : ?>
    <!-- are you the owner of the contract? -->
    <?php

    $sql = <<<EOD
    SELECT contractParentUser
    FROM esignature.contract
    WHERE contractId = ?;
    EOD;

    $contractNumber = $_POST['contractNumber'];

    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contractNumber]);
    $rows = $stmt->fetchAll();

    ?>

    <?php if ($_SESSION['userId'] == $rows[0]['contractParentUser']) : ?>

















        <?php

        // SELECT
        $db = new db();
        $selectExample = <<<EOD
        SELECT signerId
        FROM esignature.signers
        WHERE signerParentContract = ?;
        EOD;
        $listOfSignerIds = $db->selectSql($selectExample, [$_POST['contractNumber']]);

        $numberOfTitles = [];

        foreach ($listOfSignerIds as $key => $value) {
            array_push($numberOfTitles, $listOfSignerIds[$key]['signerId']);
        }

        $numberOfItemsInArray = count($numberOfTitles);

        if ($_POST['arrayPosition'] == $numberOfItemsInArray - 1) {
            $urlPath = "/createAContract/6loopGetTagValues.php?contractNumber=" . $_POST['contractNumber'] . "&arrayPosition=0&templateNumber=" . $_POST['templateNumber'];
            header("Location: {$urlPath}");
        } else {
            $addToArray = (int)$_POST['arrayPosition'] + 1;
            $urlPath = "/createAContract/4loopEditContractTitles.php?contractNumber=" . $_POST['contractNumber'] . "&totalTitleList=" . $addToArray . "&templateNumber=" . $_POST['templateNumber'];
            header("Location: {$urlPath}");
        }


        // UPDATE
        $db = new db();
        $updateExample = <<<EOD
        UPDATE `esignature`.`signers` 
        SET `signerName` = ?, `signerEmail` = ? 
        WHERE (`signerId` = ?);
        EOD;
        $db->updateSql($updateExample, [$_POST['name'], $_POST['email'], $_POST['signerId']]);
        ?>












    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>