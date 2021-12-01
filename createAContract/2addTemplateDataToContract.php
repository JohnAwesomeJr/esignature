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

        <!-- get a list of all the titles to from the template-->
        <?php

        $sql = <<<EOD
        SELECT *
        FROM esignature.titles
        WHERE parentTemplate = ?;
        EOD;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['templateNumber']]);
        $listOfTitles = $stmt->fetchAll();
        ?>


        <!-- add new signers based on the template -->

        <?php

        foreach ($listOfTitles as $key => $value) {
            $sql = <<<EOD
            INSERT INTO
            signers(signerTitle, signerParentContract)
            VALUES (?, ?); 
            EOD;
            $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$listOfTitles[$key]['titleName'], $_GET['contractNumber']]);
            $rows = $pdo->lastInsertId();
        }
        ?>


        <!-- Get The content of the template -->

        <?php

        $sql = <<<EOD
        SELECT templateContent
        FROM esignature.template
        WHERE templateId = ?;
        EOD;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_GET['templateNumber']]);
        $rows = $stmt->fetchAll();
        ?>


        <!-- update the content based on the template -->

        <?php
        $sql = <<<EOD
        UPDATE esignature.contract
        SET contractContent=?
        WHERE contractId=?;     
        EOD;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$rows[0]['templateContent'], $_GET['contractNumber']]);
        $insertSigneres = $stmt->fetchAll();
        ?>



        <?php header("Location: /createAContract/3editContractName.php?contractNumber={$_GET['contractNumber']}&templateNumber={$_GET['templateNumber']}");
        ?>




        <!-- PLAEC CODE ABOVE HERE -->
    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>