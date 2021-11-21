<?php require "/var/www/html/arrayVisualizer.php"; ?>
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




        $TemplateName = $rows[0]['templateName'];
        $templateContent = $rows[0]['templateContent'];



        $sql = <<<EOD
        SELECT *
        FROM esignature.titles
        WHERE parentTemplate = ?;
        EOD;
        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['templateNumber']]);
        $rows = $stmt->fetchAll();

        echo "<pre>";
        print_r($rows);
        echo "</pre>";

        $insertSql = "";

        foreach ($rows as $key => $value) {

            $sql = <<<EOD
            INSERT INTO
            signers(signerTitle, signerParentContract)
            VALUES (?, ?); 
            EOD;

            $pdo = new PDO('sqlite:/var/www/html/movingBox.db');
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$rows[$key]['titleName']], $_GET['contractNumber']);
            // the row number of the last inserted item so you can go back and edit it
            $rowNumber = $pdo->lastInsertId();



            $insertSql = $insertSql . "test";
        }
        echo $insertSql;







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






        <?php //header("Location: /createAContract/editContractName.php?contractNumber={$_GET['contractNumber']}&templateNumber={$_GET['templateNumber']}"); 
        ?>




        <!-- PLAEC CODE ABOVE HERE -->
    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>