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
$db->updateSql($updateExample, [$contentReplaced, $_GET['contractNumber']]);



?>
<?php if ($_POST['arrayPosition'] == $numberInArray) : ?>
    You are at the end
    <a href="/createAContract/getTagValues.php?contractNumber=<?= $_POST['contractNumber']; ?>&arrayPosition=<?= $_POST['arrayPosition']; ?>&templateNumber=<?= $_POST['templateNumber']; ?>">Click</a>
<?php else : ?>
    You have more to go
    <a href="/createAContract/getTagValues.php?contractNumber=<?= $_POST['contractNumber']; ?>&arrayPosition=<?= $_POST['arrayPosition'] + 1; ?>&templateNumber=<?= $_POST['templateNumber']; ?>">Click</a>
<?php endif; ?>

<?php require "/var/www/html/arrayVisualizer.php"; ?>