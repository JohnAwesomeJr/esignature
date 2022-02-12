<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php require "/var/www/html/peak/.env"; ?>
<?php
// are you logged in?
session_start();
if ($_SESSION > 0) :
?>

    you are logged in
    <br>



    <?php
    // are you the owner of the contract?
    require "/{$rootD}/classes/db.php";
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
        $updateContractName = <<<EOD

        UPDATE `esignature`.`contract` 
        SET `contractName` = ?
        WHERE (`contractId` = ?);

        EOD;
        $db->updateSql($updateContractName, [$_POST['ContractName'], $_GET['contractNumber']]);
        ?>


        <?php

        $updateSignersSqlStatment = "";
        $prepairedVariablesArray = [];
        if (!empty($_POST['contractSigners'])) {
            foreach ($_POST['contractSigners'] as $key => $value) {

                $addToString = <<<EOD
                UPDATE `esignature`.`signers` 
                SET `signerName` = ?, `signerEmail` = ? 
                WHERE (`signerId` = ?);
                EOD;

                $updateSignersSqlStatment = $updateSignersSqlStatment . $addToString;


                $keyWithQuotes = $key;
                $keyWithoutQuotes = (int)substr($keyWithQuotes, 1, -1);



                $signerName = $_POST['contractSigners'][$key]["'signerName'"];
                $signerEmail = $_POST['contractSigners'][$key]["'signerEmail'"];
                $signerId = $keyWithoutQuotes;

                array_push($prepairedVariablesArray, $signerName, $signerEmail, $signerId);
            }
        }



        echo "<pre>";
        print_r($updateSignersSqlStatment);
        print_r($prepairedVariablesArray);
        echo "</pre>";


        $getContractNumber = $_GET['contractNumber'];
        $db->updateSql($updateSignersSqlStatment, $prepairedVariablesArray);
        header("Location: {$rootFolder}JavascriptLibrarys/pell-master/9contractEditor.php?contractNumber={$getContractNumber}")
        ?>



















    <?php else : ?>
        You are not the owner of this contract.
        <br>
    <?php endif; ?>

<?php else : ?>
    you are not logged in.
    <br>
<?php endif; ?>
<?php // require "/{$rootD}/arrayVisualizer.php"; 
?>