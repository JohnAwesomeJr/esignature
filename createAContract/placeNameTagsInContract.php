<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<h1>Hi</h1>


<?php ob_start(); ?>
<?php

require "/var/www/html/classes/db.php";
$db = new db();



// SELECT
$getTags = <<<EOD
SELECT signerId,signerName, signerTitle
FROM esignature.signers
WHERE signerParentContract = ?;
EOD;
$tagArray = $db->selectSql($getTags, [$_GET['contractNumber']]);

echo "<pre>";
print_r($tagArray);
echo "</pre>";

$replaceTag = "{[ " . $tagArray[$_GET['arrayPosition']]['signerTitle'] . " ]}";
$replaceWith = "<b>" . $tagArray[$_GET['arrayPosition']]['signerName'] . "</b>";

echo $replaceTag;
echo "<br>";
echo $replaceWith;




// SELECT
$getContract = <<<EOD
SELECT contractContent
FROM esignature.contract
WHERE contractId = ?;
EOD;
$contractArray = $db->selectSql($getContract, [$_GET['contractNumber']]);
$contractContent = $contractArray[0]['contractContent'];
$contractWithReplacedTag = str_replace($replaceTag, $replaceWith, $contractContent);

echo "<h2>before replace</h2>";

echo $contractContent;
echo "<br>";
echo "<br>";
echo "<br>";


echo "<h2>after replace</h2>";

echo $contractWithReplacedTag;



// UPDATE
$updateContractWithTag = <<<EOD
UPDATE `esignature`.`contract` 
SET contractContent = ?
WHERE (`contractId` = ?);
EOD;
$db->updateSql($updateContractWithTag, [$contractWithReplacedTag, $_GET['contractNumber']]);

$numberOfTags = count($tagArray) - 1;
$arrayPosition = $_GET['arrayPosition'];


echo "<br>" . $numberOfTags;
echo "<br>" . $arrayPosition;

$link = "";

if ($numberOfTags == $arrayPosition) {
    $link = "http://www.google.com";
    echo "<br>" . $link;
} else {
    $nextArrayPosition = $arrayPosition + 1;
    $link = "/createAContract/placeNameTagsInContract.php?contractNumber={$_GET['contractNumber']}&arrayPosition={$nextArrayPosition}";
    echo "<br>" . $link;
}

header("Location: {$link}");
?>
<?php ob_end_flush(); ?>