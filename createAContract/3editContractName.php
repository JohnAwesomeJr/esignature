<?php require "/var/www/html/esign/.env"; ?>
<?php require "/var/www/html/esign/colors.php"; ?>

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
                <a id="redirect" href="/createAContract/4loopEditContractTitles.php?contractNumber=<?= $_GET['contractNumber']; ?>&totalTitleList=0&templateNumber=<?= $_GET['templateNumber']; ?>"></a>
                <script>
                    document.getElementById('redirect').click();
                </script>
            <?php else : ?>
                <!-- open contract----------------------------------------------------------------------------- -->

                <div class="customCard">
                    <div class="centerColomn" style="justify-content:space-evenly; min-height:200px;">
                        <h3>Type the name of the contract</h3>
                        <div>
                            <?php $iconSize = 80; ?>
                            <?php require "/var/www/html/esign/uiImages/contractIconColor.php"; ?>
                        </div>
                        <form method="post">
                            <!-- pull contract name into textbox if it exsists -->

                            <?php

                            $sql = <<<EOD
                        SELECT contractName
                        FROM esignature.contract
                        WHERE contractId = ?;
                        EOD;

                            $contractNumber = $_GET['contractNumber'];

                            $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$contractNumber]);
                            $rows = $stmt->fetchAll();

                            ?>
                            <?php if ($rows[0]['contractName'] == 'None') : ?>
                                <input type="text" name="updatedName" placeholder="Contract Name">
                            <?php else : ?>
                                <input type="text" name="updatedName" value="test">
                            <?php endif; ?>
                            <input id="submit" type="submit" hidden>
                        </form>
                    </div>
                </div>
                <!-- edit contract name screen----------------------------------------------------------------- -->
                <!-- loop through titles, add inputs to the textArea------------------------------------------- -->
                <!-- loop through tags, add inputs to the textArea--------------------------------------------- -->
                <!-- show textArea for editing----------------------------------------------------------------- -->
                <!-- save the contract------------------------------------------------------------------------- -->
            <?php endif; ?>
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