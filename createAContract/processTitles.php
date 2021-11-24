<?php
require "/var/www/html/classes/db.php";





// SELECT
$db = new db();
$selectExample = <<<EOD
SELECT signerId
FROM esignature.signers
WHERE signerParentContract = ?;
EOD;
$listOfSignerIds = $db->selectSql($selectExample, [$_POST['contractNumber']]);



$numberOfTitles = [];

foreach ($listOfSignerIds as $key => $value) {
    array_push($numberOfTitles, $listOfSignerIds[$key]['signerId']);
}

$numberOfItemsInArray = count($numberOfTitles);

if ($_POST['arrayPosition'] == $numberOfItemsInArray - 1) {
    echo "this is the last one";
} else {
    $addToArray = (int)$_POST['arrayPosition'] + 1;
    $urlPath = "/createAContract/editContractTitles.php?contractNumber=" . $_POST['contractNumber'] . "&totalTitleList=" . $addToArray;
    header("Location: {$urlPath}");
}




























// UPDATE
$db = new db();
$updateExample = <<<EOD
UPDATE `esignature`.`signers` 
SET `signerName` = ?, `signerEmail` = ? 
WHERE (`signerId` = ?);

EOD;
$db->updateSql($updateExample, [$_POST['name'], $_POST['email'], $_POST['signerId']]);
