<?php session_start(); ?>
<?php require "/var/www/html/esignature/.env"; ?>
<!-- are you logged in? -->
<?php if ($_SESSION) : ?>

    <!-- Add a new contract to database -->
    <?php
$sql = <<<EOD
INSERT INTO
contract(contractParentUser,draft)
VALUES (?,1); 
EOD;
    $contractOwner = $_SESSION['userId'];
    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contractOwner]);
    // the row number of the last inserted item so you can go back and edit it
    $rows = $pdo->lastInsertId();
    ?>



    <!-- go to edit contract page -->
    <?php header("Location: {$rootFolder}createAContract/1TemplatePicker.php?contractNumber={$rows}"); ?>
    <!-- if you are not logged in -->
<?php else : ?>
    you are not logged in
<?php endif; ?>