<?php require "/var/www/html/.env"; ?>
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

    $contractNumber = $_GET['contractNumber'];

    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contractNumber]);
    $rows = $stmt->fetchAll();

    ?>

    <?php if ($_SESSION['userId'] == $rows[0]['contractParentUser']) : ?>
        <?php require "/var/www/html/htmlStart.php"; ?>
        <!-- PLACE CODE HERE -->

        <?php
        $sql = <<<EOD
        SELECT * 
        FROM esignature.template
        WHERE templateId = ?;
        EOD;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['templateNumber']]);
        $rows = $stmt->fetchAll();
        ?>

        <?php
        $TemplateName = $rows[0]['templateName'];
        $templateContent = $rows[0]['templateContent'];
        ?>




        <?php require "/var/www/html/arrayVisualizer.php"; ?>




        <?php
        $sql = <<<EOD
        UPDATE esignature.contract
        SET contractContent=?
        WHERE contractId=?;        
        EOD;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$templateContent, $_GET['contractNumber']]);
        $rows = $stmt->fetchAll();
        ?>










        <?php header("Location: /createAContract/editContractName.php?contractNumber={$_GET['contractNumber']}"); ?>




        <!-- PLAEC CODE ABOVE HERE -->
    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>