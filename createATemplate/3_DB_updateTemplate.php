<?php require "/var/www/html/esignature/.env"; ?>
<?php require "/var/www/html/esignature/arrayVisualizer.php"; ?>
<?php ob_start(); ?>
<?php
require "/{$rootD}/classes/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php session_start(); ?>
<!-- are you logged in? -->
<?php if ($_SESSION) : ?>

    <fieldset>
        <legend>
            <h3>User Session Info</h3>
        </legend>

        <pre> <?php print_r($_SESSION); ?> </pre>
    </fieldset>


    <?php
    $origanal = $_POST['templateContent'];
    $removeLineBreak = str_replace(["\r", "\n"], '', $origanal);
    $stripTags = strip_tags($removeLineBreak, ['p', 'h1', 'h2', 'ul', 'li', 'ol', 'strong', 'b', 'em']);
    $escape = $stripTags;

    $userId = $_SESSION['userId'];

    $db = new db();
$insertExample = <<<EOD
UPDATE `esignature`.`template` 
SET `templateName` = ?, `templateContent` = ? 
WHERE (`templateId` = ?);
EOD;
    $db->createSql($insertExample, [$_POST['templateName'], $escape, $_GET['templateNumber']]);




    // update variables
    $tagUpdateQUery = "SELECT * FROM users;";
    $prepairedQueryQuestionsListUpdate = [];

    // update variables
    $tagAddNewQUery = "SELECT * FROM users;";
    $prepairedQueryQuestionsListAddNew = [];

    // update variables
    $tagDeleteQUery = "SELECT * FROM users;";
    $prepairedQueryQuestionsListDelete = [];



    foreach ($_POST['tag'] as $key => $value) {
        if ($_POST['tag'][$key]["'tagId'"] != "none") {

            $q3 = $_POST['tag'][$key]["'name'"];
            array_push($prepairedQueryQuestionsListUpdate, $q3);

            $q1 = $_POST['tag'][$key]["'tagId'"];
            array_push($prepairedQueryQuestionsListUpdate, $q1);

            $sqlupdate = <<<EOD
            UPDATE `esignature`.`tags` 
            SET `tagName` = ? WHERE (`tagId` = ?);
            EOD;

            $tagUpdateQUery = $tagUpdateQUery . $sqlupdate;
        } else {

            $q3 = $_POST['tag'][$key]["'name'"];
            array_push($prepairedQueryQuestionsListAddNew, $q3);

            $q1 = $_GET['templateNumber'];
            array_push($prepairedQueryQuestionsListAddNew, $q1);

            $sqlAddNew = <<<EOD
            INSERT INTO `esignature`.`tags` (`tagName` ,`parentTemplate`) 
            VALUES (?, ?);
            EOD;

            $tagAddNewQUery = $tagAddNewQUery . $sqlAddNew;
        }

        if ($_POST['tag'][$key]["'deleteFlag'"] == 1) {

            $q1 = $_POST['tag'][$key]["'tagId'"];
            array_push($prepairedQueryQuestionsListDelete, $q1);

            $deleteSql = <<<EOD
            DELETE FROM `esignature`.`tags` WHERE (`tagId` = ?);
            EOD;

            $tagDeleteQUery = $tagDeleteQUery . $deleteSql;
        }
    }
echo "<h1>update</h1>";
echo "<pre>";
print_r($prepairedQueryQuestionsListUpdate);
echo "<pre>";

echo "<h1>add new</h1>";
echo "<pre>";
print_r($prepairedQueryQuestionsListAddNew);
echo "<pre>";

echo "<h1>delete</h1>";
echo "<pre>";
print_r($prepairedQueryQuestionsListDelete);
echo "<pre>";

    // update Items
    $db->updateSql($tagUpdateQUery, $prepairedQueryQuestionsListUpdate);
    // add new items
    $db->createSql($tagAddNewQUery, $prepairedQueryQuestionsListAddNew);
    // update Items
    $db->deleteSql($tagDeleteQUery, $prepairedQueryQuestionsListDelete);

    require "/{$rootD}/createATemplate/processTitles.php";





























    header("location: {$rootFolder}templatesAndContracts.php")
    ?>



<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>