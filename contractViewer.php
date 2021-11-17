<?php session_start(); ?>
<?php require "/var/www/html/.env"; ?>
<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/uiParts/card.php"; ?>

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
        font-size: 11px;
        color: white;
        background: red;
        padding: 5px 15px;
        width: 80px;
    }
















    .container {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 60px 1fr;
        gap: 0px 0px;
        grid-auto-flow: row;
        grid-template-areas:
            "title"
            "lowerContainer";
    }

    .title {
        grid-area: title;
        overflow: hidden;
    }

    .lowerContainer {
        display: grid;
        grid-template-columns: 1.4fr 0.6fr;
        grid-template-rows: 40px auto;
        gap: 0px 0px;
        grid-auto-flow: row;
        grid-template-areas:
            "name gridStatus"
            "signature imageIcon";
        grid-area: lowerContainer;
    }

    .gridStatus {
        grid-area: gridStatus;
    }

    .imageIcon {
        grid-area: imageIcon;
    }

    .name {
        grid-area: name;
    }

    .signature {
        grid-area: signature;
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

    <?php

    $sql = <<<EOD
        SELECT 
        signers.signerId as signerId,
        signers.signerTitle as signerTitle,
        signers.signerName as signerName,
        signers.signDate as signStatus,
        signers.signerImagePath,
        users.userEmail as contractOwner
        FROM esignature.signers
        LEFT JOIN esignature.contract
        ON signers.signerParentContract = contract.contractId
        RIGHT JOIN esignature.users
        ON users.userId = contract.contractParentUser
        WHERE users.userEmail = "johnawesomejr@gmail.com";
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
        <a href="http://www.google.com" class="customCard ">


            <div class="container">
                <div class="title">
                    <h3 style="white-space: nowrap;"><?= $rows[$key]['signerTitle']; ?></h3>
                </div>
                <div class="lowerContainer">
                    <div class="gridStatus centerRow">
                        <?php if ($rows[$key]['signStatus'] > "") : ?>
                            <div class="status centerRow" style="background:#6BD650;"><?= date("M jS y", strtotime($rows[$key]['signStatus'])); ?></div>
                        <?php else : ?>
                            <div class="status centerRow" style="background:#5075D6;">Pending</div>
                        <?php endif; ?>
                    </div>
                    <div class="imageIcon centerRow">
                        <div>
                            <?php $iconSize = 80; ?>
                            <?php require "/var/www/html/uiImages/contractIconColor.php"; ?>
                        </div>
                    </div>
                    <div class="name centerRow" style="justify-content:flex-start;">
                        <div><?= $rows[$key]['signerName']; ?></div>
                    </div>
                    <div class="signature centerRow"> <?php if ($rows[$key]['signerImagePath'] > "") : ?>
                            <div>
                                <img src="<?= "/signature" . $rows[$key]['signerImagePath']; ?>" width=100px>
                            </div>
                        <?php else : ?>
                            <h4 style="color:gainsboro;">Waiting for Signature</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- template -->
            <!-- <div>
                <?php $iconSize = 80; ?>
                <?php require "/var/www/html/uiImages/contractIconColor.php"; ?>
            </div>
            <div class="status"><?= $rows[$key]['signStatus']; ?></div>
            <div class="name"><?= $rows[$key]['signerName']; ?></div>
            <?php if ($rows[$key]['signerImagePath'] > "") : ?>
                <div class="drawBorder">
                    <img src="<?= "/signature" . $rows[$key]['signerImagePath']; ?>" height=100px>
                </div>
            <?php endif; ?>
            <h3 style="white-space: nowrap"><?= $rows[$key]['signerTitle']; ?></h3> -->
            <!-- template -->
        </a>
    <?php endforeach; ?>

    <div class="drawBorder" style="font-size: 30px; white-space: nowrap;">
        <?= $rows[$key]['signerTitle']; ?>
    </div>













    <div style="height:200px;"></div>
</div>

<!-- End of base CONTAINER -->
</div>
<?php // require "/var/www/html/arrayVisualizer.php";
?>