<?php require "/var/www/html/peak/.env"; ?>
<?php require "/{$rootD}/colors.php"; ?>
<?php require "/{$rootD}/classes/db.php"; ?>

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
        <?php require "/{$rootD}/htmlStart.php"; ?>
        <?php require "/{$rootD}/uiParts/baseContainer.php"; ?>
        <div id="bodyCentering">
            <?php
            $backButton = true;
            $backLink1 = "{$rootFolder}templatesAndContracts.php?screen=contracts";
            require "/{$rootD}/uiParts/headder.php";
            ?>
            <div style="height:85px;"></div>


            <?php
            // SELECT
            $db = new db();
            $selectExample = <<<EOD
            SELECT * 
            FROM esignature.signers 
            WHERE signerParentContract=?;
            EOD;
            $currentSigner = $db->selectSql($selectExample, [$_GET['contractNumber']]);
            ?>

            <div class="customCard centerColomn">
                <h1><?= strtoupper($currentSigner[$_GET['totalTitleList']]['signerTitle']); ?></h1>
                <div>
                    <?php $iconSize = 100; ?>
                    <?php require "/{$rootD}/uiImages/personIcon.php"; ?>
                </div>
                <form method="post" action="<?= $rootFolder; ?>createAContract/5processTitles.php">
                    <input hidden name="templateNumber" type="text" value="<?= $_GET['templateNumber']; ?>">
                    <input hidden name="signerId" type="text" value="<?= $currentSigner[$_GET['totalTitleList']]['signerId']; ?>">
                    <input hidden name="contractNumber" type="text" value="<?= $currentSigner[$_GET['totalTitleList']]['signerParentContract']; ?>">
                    <input hidden name="arrayPosition" type="text" value="<?= $_GET['totalTitleList']; ?>">
                    <input name="email" type="email" placeholder="Signer Email">
                    <input name="name" type="text" placeholder="Signer Name">
                    <input hidden id="submit" type="submit">
                </form>
            </div>



            <div style="height:100px;"></div>
            <!-- Add the footer -->
            <?php
            require "/{$rootD}/uiParts/footer.php";
            $allButtons = [
                //$button1 = ["templatesButton", "http://www.google.com"],
                //$button2 = ["contractsButton", "http://www.google.com"],
                $button3 = ["nextButtonOrangeJavascript", ""]
            ];
            footer(...$allButtons);
            ?>
        </div>
        </div>
        <script>
            function clickRed() {
                document.getElementById('submit').click();
            }
        </script>
    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>