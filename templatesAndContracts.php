<?php session_start(); ?>
<?php require "/var/www/html/.env"; ?>
<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/uiParts/card.php"; ?>
<?php require "/var/www/html/uiParts/footer.php"; ?>

<!-- Start of base CONTAINER -->
<?php require "/var/www/html/htmlStart.php"; ?>
<?php require "/var/www/html/uiParts/baseContainer.php"; ?>
<style>
    .centerColomn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;



    }

    .centerRow {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .drawBorder {
        border: solid black 1px;
    }

    .status {
        border-radius: 6px;
        font-size: 13px;
        color: white;
        background: red;
        padding: 5px 15px;
        width: 67px;
    }
</style>
<div id="bodyCentering">
    <?php
    $backButton = false;
    $backLink1 = "http://www.youtube.com";
    require "/var/www/html/uiParts/headder.php";
    ?>

    <div style="height:100px;"></div>
    <!-- Contracts screen--------------------------------- -->
    <?php if ($_GET['screen'] == "contracts") : ?>

        <?php

        $sql = <<<EOD
        SELECT contract.contractId as contractId, 
        contract.contractName as contractName,
        contract.emailSent as contractStatus,
        contract.draft as draftStatus
        FROM esignature.contract
        RIGHT JOIN esignature.users
        ON  contract.contractParentUser = users.userId
        WHERE users.userEmail =  ?
        ORDER BY contractId DESC;
        EOD;

        $userEmail = $_SESSION['userName'];

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userEmail]);
        $rows = $stmt->fetchAll();
        ?>

        <div class="customCard">
            you are looking at all of your contracts
        </div>

        <?php foreach ($rows as $key => $value) : ?>
            <a href="/contractViewer.php" class="customCard centerRow" style="justify-content: space-between;">
                <div class=" centerColomn" style="height:100px; margin-right:15px; overflow:hidden; align-items: flex-start; justify-content: space-between; ">
                    <div style="font-size: 30px; white-space: nowrap;"><?= $rows[$key]['contractName']; ?></div>
                    <?php
                    if ($rows[$key]['draftStatus'] == 1) {
                        echo "<div class=\" centerRow status\" style=\" background: #D65050; \">Draft</div>";
                    } else {
                        if ($rows[$key]['contractStatus'] == 1) {
                            echo "<div class=\" centerRow status\" style=\" background: #6BD650; \" >Done</div>";
                        } else {
                            echo "<div class=\" centerRow status\" style=\" background: #5075D6; \">Pending</div>";
                        }
                    }
                    ?>
                </div>
                <div>
                    <?php $iconSize = 80; ?>
                    <?php require "/var/www/html/uiImages/contractIconColor.php"; ?>
                </div>
            </a>
        <?php endforeach; ?>



    <?php else : ?>
        <!-- templates screen -------------------------------- -->

        you are looking at all of your templates

    <?php endif; ?>








    <div style="height:200px;"></div>

    <?php

    $allButtons = [
        $button1 = ["contractsButton", "/templatesAndContracts.php?screen=contracts"],
        $button2 = ["templatesButton", "/templatesAndContracts.php?screen=templates"]
    ];
    if ($_GET['screen'] == "contracts") {
        //URL to the create contracts page!!!!!!!!!!!!!!!!
        $button3 = ["plusButtonShort", "temp-url/createACOntractphp"];
    } else {
        //URL to the create templates page!!!!!!!!!!!!!!!!
        $button3 = ["plusButtonShort", "temp-url/createATemplate.php"];
    }
    array_push($allButtons, $button3);
    footer(...$allButtons);
    ?>
</div>

<!-- End of base CONTAINER -->
</div>
<?php // require "/var/www/html/arrayVisualizer.php";
?>