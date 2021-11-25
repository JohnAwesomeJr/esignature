<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php session_start(); ?>
<?php require "/var/www/html/classes/db.php"; ?>


<?php
// SELECT
$db = new db();
$selectExample = <<<EOD
SELECT contractContent 
FROM esignature.contract
WHERE contractId =?;
EOD;
$contract = $db->selectSql($selectExample, [$_POST['contractNumber']])[0]['contractContent'];


// SELECT
$selectTags = <<<EOD
SELECT * 
FROM esignature.tags
WHERE parentTemplate = ?;
EOD;
$tagList = $db->selectSql($selectTags, [$_POST['templateNumber']]);
$numberInArray = count($tagList) - 1;


$tagToReplace =  "{[ " . $tagList[$_POST['arrayPosition']]['tagName'] . " ]}";

$contentReplaced = str_replace($tagToReplace, " <b> " . $_POST['tag'] . " </b> ", $contract);
echo $contentReplaced;


// UPDATE
$updateExample = <<<EOD
UPDATE `esignature`.`contract` 
SET `contractContent` = ? 
WHERE (`contractId` = ?);
EOD;
$db->updateSql($updateExample, [$contentReplaced, $_POST['contractNumber']]);



?>
<?php if ($_POST['arrayPosition'] == $numberInArray) : ?>
    <?php
    $urlPath = "/createAContract/placeNameTagsInContract.php";
    echo "<br>" . $urlPath;
    header("Location: {$urlPath}");
    ?>
<?php else : ?>
    <?php
    $newPosition = (int)$_POST['arrayPosition'] + 1;
    $urlPath = "/createAContract/getTagValues.php?contractNumber=" . (int)$_POST['contractNumber'] . "&arrayPosition=" . $newPosition . "&templateNumber=" . (int)$_POST['templateNumber'];
    echo "<br>" . $urlPath;
    header("Location: {$urlPath}");
    ?>
<?php endif; ?>

<?php require "/var/www/html/arrayVisualizer.php"; ?>