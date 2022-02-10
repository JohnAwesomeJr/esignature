<?php require "/var/www/html/esign/.env"; ?>
<?php require "/var/www/html/esign/colors.php"; ?>
<?php require "/var/www/html/esign/classes/db.php"; ?>

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
        <?php require "/var/www/html/esign/htmlStart.php"; ?>
        <?php require "/var/www/html/esign/uiParts/baseContainer.php"; ?>
        <div id="bodyCentering">
            <?php
            $backButton = true;
            $backLink1 = "/templatesAndContracts.php?screen=contracts";
            require "/var/www/html/esign/uiParts/headder.php";
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



            $selectTags = <<<EOD
            SELECT * 
            FROM esignature.tags
            WHERE parentTemplate = ?;
            EOD;
            $tagList = $db->selectSql($selectTags, [$_GET['templateNumber']]);
            ?>


            <div class="customCard centerColomn">
                <h1>{[ <?= $tagList[$_GET['arrayPosition']]['tagName']; ?> ]}</h1>
                <div>
                    <?php $iconSize = 100; ?>
                    <?php require "/var/www/html/esign/uiImages/personIcon.php"; ?>
                </div>
                <form method="post" action="/createAContract/7updateTagOnContract.php">
                    <input hidden name="templateNumber" type="text" value="<?= $_GET['templateNumber']; ?>">
                    <input hidden name="contractNumber" type="text" value="<?= $_GET['contractNumber']; ?>">
                    <input hidden name="arrayPosition" type="text" value="<?= $_GET['arrayPosition']; ?>">
                    <input name="tag" type="text" placeholder="Tag Replacement Text">
                    <input hidden id="submit" type="submit">
                </form>
            </div>



            <div style="height:100px;"></div>
            <!-- Add the footer -->
            <?php
            require "/var/www/html/esign/uiParts/footer.php";
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


<?php // require "/var/www/html/esign/arrayVisualizer.php"; 
?>