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
        $signersSql = <<<EOD
        SELECT * 
        FROM esignature.signers
        WHERE signerParentContract = ?;
        EOD;
        $signersArray = $db->selectSql($signersSql, [$_GET['contractNumber']]);
        ?>



        <?php if (!empty($_POST)) : ?>
            process
        <?php else : ?>





















            <?php require "/var/www/html/htmlStart.php"; ?>
            <?php require "/var/www/html/colors.php" ?>

            <style>
                * {
                    border: none;
                }
            </style>

            <body class="centerColomn" style="overflow-y: scroll; background:<?= $background; ?>">

                <form class="centerColomn" style="width:100%; max-width: 700px;" method="post" action="/editContract/2updateContract.php?contractNumber=<?= $_GET['contractNumber']; ?>">
                    <fieldset class="customCard">
                        <legend>Contract Title: <?= $contractTitle; ?></legend>
                        <br>
                        Contract Name
                        <br>
                        <input name="ContractName" type="text" value="<?= $contractTitle; ?>">
                        <br>
                    </fieldset>
                    <?php foreach ($signersArray as $key => $value) : ?>
                        <fieldset class="customCard">
                            <legend>Signer ID#: <?= $signersArray[$key]['signerId']; ?></legend>
                            <div>
                                <h3><?= $signersArray[$key]['signerTitle']; ?></h3>
                                <br>
                                Email
                                <br>
                                <input name="contractSigners['<?= $signersArray[$key]['signerId']; ?>']['signerEmail']" value="<?= $signersArray[$key]['signerEmail']; ?>">
                                <br>
                                Signer Name
                                <br>
                                <input name="contractSigners['<?= $signersArray[$key]['signerId']; ?>']['signerName']" value="<?= $signersArray[$key]['signerName']; ?>">
                                <br>
                            </div>
                        </fieldset>
                    <?php endforeach; ?>

                    <br>
                    <input type="submit">

                </form>
            </body>














        <?php endif; ?>











    <?php else : ?>
        You are not the owner of this contract.
        <br>
    <?php endif; ?>

<?php else : ?>
    you are not logged in.
    <br>
<?php endif; ?>




















<?php //require "/var/www/html/arrayVisualizer.php"; 
?>