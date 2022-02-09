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
        <br>
        <br>













        Are your sure you want to delete this contract?

        <?php if (empty($_POST)) : ?>
            <form method="post">
                <button name="delete" type="submit" value="yes">Yes I am sure I want to delete it.</button>
                <button name="delete" type="submit" value="no">Go Back</button>
            </form>
        <?php else : ?>
            <?php
            if ($_POST['delete'] == 'yes') {
                echo "it is deleted";
                $deleteExample = <<<EOD
                DELETE FROM `esignature`.`contract` 
                WHERE (`contractId` = ?);
                EOD;
                $db->deleteSql($deleteExample, [$_GET['contractNumber']]);

                $deleteSigners = <<<EOD
                DELETE FROM `esignature`.`signers` 
                WHERE (`signerParentContract` = ?);
                EOD;
                $db->deleteSql($deleteSigners, [$_GET['contractNumber']]);
                header("Location: /templatesAndContracts.php?screen=contracts");
            } else {
                echo "going back";
            }
            ?>
        <?php endif; ?>







































    <?php else : ?>
        You are not the owner of this contract.
        <br>
    <?php endif; ?>

<?php else : ?>
    you are not logged in.
    <br>
<?php endif; ?>
<?php // require "/var/www/html/arrayVisualizer.php"; 
?>