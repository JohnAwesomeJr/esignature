<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
// are you logged in?
session_start();
if ($_SESSION > 0) :
?>

    you are logged in
    <br>



    <?php
    // are you the owner of the contract?
    require "/var/www/html/classes/db.php";
    $db = new db();
    $contractOwnerSql = <<<EOD
    SELECT * 
    FROM esignature.contract
    WHERE contractId = ?;
    EOD;
    $contractArray = $db->selectSql($contractOwnerSql, [$_GET['contractNumber']]);
    $loggedInUser = $_SESSION['userId'];
    $contractOwner = $contractArray[0]['contractParentUser'];
    $contractContent = $contractArray[0]['contractContent'];
    $contractTitle = $contractArray[0]['contractName'];


    if ($loggedInUser == $contractOwner) : ?>
        You are the owner
        <br>









        <?php

        $deleteExample = <<<EOD
        DELETE FROM `esignature`.`signers` 
        WHERE (`signerId` = ?);

        EOD;
        $db->deleteSql($deleteExample, [$_GET['signerId']]);

        ?>

        <?php header("Location: /editContract/1editContractDetails.php?contractNumber={$_GET['contractNumber']}"); ?>















    <?php else : ?>
        You are not the owner of this contract.
        <br>
    <?php endif; ?>

<?php else : ?>
    you are not logged in.
    <br>
<?php endif; ?>