<?php //require "/var/www/html/esignature/.env"; ?>
<?php

// update variables
$titleUpdateQUery = "";
$prepairedQueryQuestionsListUpdate = [];

// update variables
$titleAddNewQUery = "";
$prepairedQueryQuestionsListAddNew = [];

// update variables
$titleDeleteQUery = "";
$prepairedQueryQuestionsListDelete = [];

echo "<br>";
echo "<br>";
echo "<pre>";
print_r($_POST);
echo "</pre>";






foreach ($_POST['title'] as $key => $value) {
    if ($_POST['title'][$key]["'tagId'"] != "none") {

        $q3 = $_POST['title'][$key]["'name'"];
        array_push($prepairedQueryQuestionsListUpdate, $q3);

        $q1 = $_POST['title'][$key]["'tagId'"];
        array_push($prepairedQueryQuestionsListUpdate, $q1);

        $sqlupdate = <<<EOD
        UPDATE `esignature`.`titles` 
        SET `titleName` = ? WHERE (`titlesId` = ?);
        EOD;

        $titleUpdateQUery = $titleUpdateQUery . $sqlupdate;
    } else {

        $q3 = $_POST['title'][$key]["'name'"];
        array_push($prepairedQueryQuestionsListAddNew, $q3);

        $q1 = $_GET['templateNumber'];
        array_push($prepairedQueryQuestionsListAddNew, $q1);

        $sqlAddNew = <<<EOD
        INSERT INTO `esignature`.`titles` (`titleName` ,`parentTemplate`) 
        VALUES (?, ?);
        EOD;

        $titleAddNewQUery = $titleAddNewQUery . $sqlAddNew;
    }

    if ($_POST['title'][$key]["'deleteFlag'"] == 1) {

        $q1 = $_POST['title'][$key]["'tagId'"];
        array_push($prepairedQueryQuestionsListDelete, $q1);

        $deleteSql = <<<EOD
        DELETE FROM `esignature`.`titles` WHERE (`titlesId` = ?);
        EOD;

        $titleDeleteQUery = $titleDeleteQUery . $deleteSql;
    }
}

// update Items
$db->updateSql($titleUpdateQUery, $prepairedQueryQuestionsListUpdate);
// add new items
$db->createSql($titleAddNewQUery, $prepairedQueryQuestionsListAddNew);
// update Items
$db->deleteSql($titleDeleteQUery, $prepairedQueryQuestionsListDelete);
