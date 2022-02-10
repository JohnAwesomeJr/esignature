<?php session_start(); ?>
<?php if ($_SESSION) : ?>
    <?php require "/var/www/html/esign/.env"; ?>
    <?php require "/var/www/html/esign/colors.php"; ?>
    <?php require "/var/www/html/esign/uiParts/card.php"; ?>

    <!-- Start of base CONTAINER -->
    <?php require "/var/www/html/esign/htmlStart.php"; ?>
    <?php require "/var/www/html/esign/uiParts/baseContainer.php"; ?>

    <div id="bodyCentering">
        <?php
        $backButton = true;
        $backLink1 = "/templatesAndContracts.php?screen=contracts";
        require "/var/www/html/esign/uiParts/headder.php";
        ?>

        <div style="height:100px;"></div>

        <?php

        $sql = <<<EOD
        SELECT contractId, contractParentUser
        FROM esignature.contract
        WHERE contractId = ?
        AND contractParentUser = ?;
        EOD;

        $userEmail = $_SESSION['userId'];
        $contractNumber = $_GET['contractNumber'];

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$contractNumber, $userEmail]);
        $rows = $stmt->fetchAll();
        ?>

        <?php if ($rows) : ?>

            <!-- Contracts screen--------------------------------- -->

            <?php

            $contractId = $_GET['contractNumber'];

            $sql = <<<EOD
            SELECT 
            signers.signerId as signerId,
            signers.signerTitle as signerTitle,
            signers.signerName as signerName,
            signers.signDate as signStatus,
            signers.signerEmail as signerEmail,
            signers.signerImagePath,
            users.userEmail as contractOwner
            FROM esignature.signers
            LEFT JOIN esignature.contract
            ON signers.signerParentContract = contract.contractId
            RIGHT JOIN esignature.users
            ON users.userId = contract.contractParentUser
            WHERE contract.contractId = ?;
            EOD;

            $userEmail = $_SESSION['userName'];

            $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$contractId]);
            $rows = $stmt->fetchAll();
            ?>

            <div class="customCard">
                you are looking at all of your contracts
            </div>

            <?php foreach ($rows as $key => $value) : ?>
                <div class="customCard ">
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
                                    <?php require "/var/www/html/esign/uiImages/personIcon.php"; ?>
                                </div>
                            </div>
                            <div class="name centerRow" style="justify-content:flex-start;">
                                <div style="white-space: nowrap;"><b><?= ucwords($rows[$key]['signerName']) . "</b> <br> " . strtolower($rows[$key]['signerEmail']); ?></div>
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
                    <a href="/signer/1instructions.php?contractNumber=<?= $_GET['contractNumber']; ?>&contractSigner=<?= $rows[$key]['signerId']; ?>">
                        /signer/1instructions.php?contractNumber=<?= $_GET['contractNumber']; ?>&contractSigner=<?= $rows[$key]['signerId']; ?>
                    </a>
                </div>
            <?php endforeach; ?>

            <?php

            $sql = <<<EOD
            SELECT contractName, contractContent, draft
            FROM esignature.contract
            WHERE contractId = ?;
            EOD;

            $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$contractId]);
            $rows = $stmt->fetchAll();
            ?>
            <?php if ($rows[0]["draft"] == 1) : ?>
                <div class="customCard">
                    <a href="/editContract/1editContractDetails.php?contractNumber=<?= $_GET['contractNumber']; ?>" style="display:inline-block; ">
                        <div class="centerRow status " style="background:#5075D6; font-size:20px; width: 100px;">Edit Draft</div>
                    </a>
                    <a href="/deleteContract.php?contractNumber=<?= $_GET['contractNumber']; ?>" style="display:inline-block;">
                        <div class="centerRow status" style="background:#f54242; font-size:20px; width: 150px;">DELETE DRAFT</div>
                    </a>
                </div>
            <?php endif; ?>
            <div class="customCard">
                <h1><?= $rows[0]["contractName"]; ?></h1>
                <div>
                    <?= $rows[0]["contractContent"]; ?>
                </div>
            </div>

            <div style="height:200px;"></div>
    </div>

    <!-- End of base CONTAINER -->
    </div>


<?php else : ?>
    You do not have access to this contract.
<?php endif; ?>





<?php else : ?>
    You are not logged in.
<?php endif; ?>