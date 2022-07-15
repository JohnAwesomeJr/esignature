<?php require "/var/www/html/esignature/.env"; ?>
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

    $pdo = new PDO("mysql:host={$mysqlIpAddress};dbname=esignature", $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contractNumber]);
    $rows = $stmt->fetchAll();

    ?>

    <?php if ($_SESSION['userId'] == $rows[0]['contractParentUser']) : ?>
        <?php require "/{$rootD}/htmlStart.php"; ?>
        <!-- PLACE CODE HERE -->






















        <!-- PLAEC CODE ABOVE HERE -->
    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>
<?php // require "/{$rootD}/arrayVisualizer.php";
?>