<?php require "/var/www/html/esignature/.env"; ?>
<?php session_start(); ?>
<?php if ($_SESSION) : ?>
    <?php require "/{$rootD}/colors.php"; ?>
    <?php require "/{$rootD}/uiParts/card.php"; ?>
    <?php require "/{$rootD}/uiParts/footer.php"; ?>

    <!-- Start of base CONTAINER -->
    <?php require "/{$rootD}/htmlStart.php"; ?>
    <?php require "/{$rootD}/uiParts/baseContainer.php"; ?>
    <div id="bodyCentering">
        <?php
        $backButton = false;
        $backLink1 = "http://www.youtube.com";
        require "/{$rootD}/uiParts/headder.php";
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
WHERE users.userId =  ?
ORDER BY contractId DESC;
EOD;

            $userEmail = $_SESSION['userId'];

            $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userEmail]);
            $rows = $stmt->fetchAll();
            ?>

            <?php if ($rows[0]['contractStatus'] == "" && count($rows) == 1) : ?>

                <div class="customCard">
                    No contracts yet, press the (+) icon to add one.
                </div>

            <?php else : ?>

                <?php foreach ($rows as $key => $value) : ?>
                    <a href="<?= $rootFolder; ?>contractViewer.php?contractNumber=<?= $rows[$key]['contractId']; ?>" class="customCard centerRow" style="justify-content: space-between;">
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
                            <?php require "/{$rootD}/uiImages/contractIconColor.php"; ?>
                        </div>
                    </a>

                <?php endforeach; ?>

            <?php endif; ?>



        <?php else : ?>
            <!-- START templates screen -------------------------------- -->

            <div class="customCard">you are looking at all of your templates</div>

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
                    <?php $templateId = $rows[$key]['0']; ?>
                    <div class="customCard centerRow">
                        <div class="centerColumn" style="width:100%;">
                            <div class="centerRow" style="justify-content:space-between;">
                                <div class=" centerColomn" style="height:100px; margin-right:15px; overflow:hidden; align-items: flex-start; justify-content: space-between; ">
                                    <div style="font-size: 30px; white-space: nowrap;"><?= strtoupper($rows[$key]['templateName']); ?></div>
                                </div>
                                <div>
                                    <?php $iconSize = 80; ?>
                                    <?php require "/{$rootD}/uiImages/templateIcon.svg"; ?>
                                </div>
                            </div>
                            <div class="centerRow" style="justify-content:flex-start;">
                                <a href="<?= $rootFolder; ?>createATemplate/deleteTemplate/deleteTemplate.php?templateNumber=<?= $templateId; ?>">
                                    <div class=" centerRow status" style=" background: #D65050; margin:5px;">Delete</div>
                                </a>
                                <a href="<?= $rootFolder; ?>createATemplate/2_PAGE_editTemplate.php?templateNumber=<?= $templateId; ?>">
                                    <div class=" centerRow status" style=" background: #5075D6; margin:5px;">Edit</div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>






            <!-- END templates screen -------------------------------- -->

        <?php endif; ?>
        <div style="height:200px;"></div>

        <?php

        // Check if there are any templates

        // SELECT
        require "/{$rootD}/classes/db.php";
        $db = new db();
        $selectExample = <<<EOD
        SELECT parentUser FROM esignature.template
        WHERE parentUser = ?;
        EOD;

        $templateExsistanceCheck = $db->selectSql($selectExample, [$_SESSION['userId']]);
        $templatesExsistanceCheckFinalValue = $templateExsistanceCheck[0];

        // END Check if there are any templates


        $allButtons = [
            $button1 = ["contractsButton", $rootFolder . "templatesAndContracts.php?screen=contracts"],
            $button2 = ["templatesButton", $rootFolder . "templatesAndContracts.php?screen=templates"]
        ];
        if ($_GET['screen'] == "contracts") {
            if (array_key_exists(0, (array)$templatesExsistanceCheckFinalValue)) {
                //URL to the create contracts page!!!!!!!!!!!!!!!!
                $button3 = ["plusButtonShort", $rootFolder . "createAContract/0createAContract.php"];
            } else {
                // $button3 = "<div>nope</div>";
            }
        } else {
            //URL to the create templates page!!!!!!!!!!!!!!!!
            $button3 = ["plusButtonShort", $rootFolder . "createATemplate/1_DB_createATemplate.php"];
        }
        array_push($allButtons, $button3);
        footer(...$allButtons);
        ?>
    </div>

    <!-- End of base CONTAINER -->
    </div>
<?php else : ?>
    You are not logged in.
<?php endif; ?>