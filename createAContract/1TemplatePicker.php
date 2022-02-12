<?php require "/{$rootD}/.env"; ?>
<?php require "/{$rootD}/colors.php"; ?>

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
            $backLink1 = "/templatesAndContracts.php?screen=contracts";
            require "/{$rootD}/uiParts/headder.php";
            ?>
            <div style="height:85px;"></div>



            <?php

            $sql = <<<EOD
            SELECT * 
            FROM esignature.template
            WHERE parentUser = ?;
            EOD;

            $user = $_SESSION['userId'];

            $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user]);
            $rows = $stmt->fetchAll();
            ?>

            <!-- do you have access to this content? -->
            <?php if ($rows[0]['parentUser'] == $_SESSION['userId']) : ?>
                <?php foreach ($rows as $key => $value) : ?>

                    <a href="/createAContract/2addTemplateDataToContract.php?contractNumber=<?= $_GET['contractNumber']; ?>&templateNumber=<?= $rows[$key]['templateId']; ?>" class="customCard centerRow" style="justify-content: space-between;">
                        <div class=" centerColomn" style="height:100px; margin-right:15px; overflow:hidden; align-items: flex-start; justify-content: space-between; ">
                            <div style="font-size: 30px; white-space: nowrap;"><?= strtoupper($rows[$key]['templateName']); ?></div>
                        </div>
                        <div>
                            <?php $iconSize = 80; ?>
                            <?php require "/{$rootD}/uiImages/templateIcon.svg"; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>


            <div style="height:100px;"></div>
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