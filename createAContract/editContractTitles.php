<?php require "/var/www/html/.env"; ?>
<?php require "/var/www/html/colors.php"; ?>

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
        <?php require "/var/www/html/uiParts/baseContainer.php"; ?>
        <div id="bodyCentering">
            <?php
            $backButton = true;
            $backLink1 = "/templatesAndContracts.php?screen=contracts";
            require "/var/www/html/uiParts/headder.php";
            ?>
            <div style="height:85px;"></div>
            <?php if ($_POST) : ?>
                <?php
                $sql = <<<EOD
                UPDATE esignature.contract
                SET contractName=?
                WHERE contractId=?;        
                EOD;

                $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_POST['updatedName'], $_GET['contractNumber']]);
                $rows = $stmt->fetchAll();
                ?>
                <a id="redirect" href="/createAContract/editContractTitles.php?contractNumber=<?= $_GET['contractNumber']; ?>"></a>
                <script>
                    document.getElementById('redirect').click();
                </script>
            <?php else : ?>
                <!-- open contract----------------------------------------------------------------------------- -->

                <?php foreach ($rows as $key => $value) : ?>
                    <?= $key; ?>
                <?php endforeach; ?>
                <!-- edit contract name screen----------------------------------------------------------------- -->
                <!-- loop through titles, add inputs to the textArea------------------------------------------- -->
                <!-- loop through tags, add inputs to the textArea--------------------------------------------- -->
                <!-- show textArea for editing----------------------------------------------------------------- -->
                <!-- save the contract------------------------------------------------------------------------- -->
            <?php endif; ?>
            <div style="height:100px;"></div>
            <!-- Add the footer -->
            <?php
            require "/var/www/html/uiParts/footer.php";
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