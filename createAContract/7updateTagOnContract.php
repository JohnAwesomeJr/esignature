<?php require "/var/www/html/peak/.env"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php
require "/{$rootD}/classes/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

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
        SELECT contractContent 
        FROM esignature.contract
        WHERE contractId =?;
        EOD;
        $contract = $db->selectSql($selectExample, [$_POST['contractNumber']])[0]['contractContent'];


        // SELECT
        $selectTags = <<<EOD
        SELECT * 
        FROM esignature.tags
        WHERE parentTemplate = ?;
        EOD;
        $tagList = $db->selectSql($selectTags, [$_POST['templateNumber']]);
        $numberInArray = count($tagList) - 1;


        $tagToReplace =  "{[ " . $tagList[$_POST['arrayPosition']]['tagName'] . " ]}";

        $contentReplaced = str_replace($tagToReplace, " <b> " . $_POST['tag'] . " </b> ", $contract);
        echo $contentReplaced;


        // UPDATE
        $updateExample = <<<EOD
        UPDATE `esignature`.`contract` 
        SET `contractContent` = ? 
        WHERE (`contractId` = ?);
        EOD;
        $db->updateSql($updateExample, [$contentReplaced, $_POST['contractNumber']]);



        ?>
        <?php if ($_POST['arrayPosition'] == $numberInArray) : ?>
            <?php
            $urlPath = "{$rootFolder}createAContract/8placeNameTagsInContract.php?" . "contractNumber=" . (int)$_POST['contractNumber'] . "&arrayPosition=0";
            header("Location: {$urlPath}");
            ?>
        <?php else : ?>
            <?php
            $newPosition = (int)$_POST['arrayPosition'] + 1;
            $urlPath = "{$rootFolder}createAContract/6loopGetTagValues.php?contractNumber=" . (int)$_POST['contractNumber'] . "&arrayPosition=" . $newPosition . "&templateNumber=" . (int)$_POST['templateNumber'];
            header("Location: {$urlPath}");
            ?>
        <?php endif; ?>










    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>

<?php ob_end_flush(); ?>