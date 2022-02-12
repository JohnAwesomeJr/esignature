<?php

require "/{$rootD}/.env";

class db
{
    public function selectSql($sql, $prepairedArray)
    {
        global $mysqlUser;
        global $mysqlPassword;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([...$prepairedArray]);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function createSql($sql, $prepairedArray)
    {
        global $mysqlUser;
        global $mysqlPassword;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([...$prepairedArray]);
        $rows = $pdo->lastInsertId();
        return $rows;
    }
    public function updateSql($sql, $prepairedArray)
    {
        global $mysqlUser;
        global $mysqlPassword;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([...$prepairedArray]);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function deleteSql($sql, $prepairedArray)
    {
        global $mysqlUser;
        global $mysqlPassword;

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([...$prepairedArray]);
    }
}



////INSERT
// $db = new db();
// $insertExample = <<<EOD
// INSERT INTO `esignature`.`contract` (`contractName`, `contractContent`) 
// VALUES (?, ?);
// EOD;
// // use echo to see the key of the last inserted 
// echo $db->createSql($insertExample, ["name", "content"]);






//// SELECT
// $db = new db();
// $selectExample = <<<EOD
// SELECT * 
// FROM esignature.contract
// WHERE contractId = ?;
// EOD;

// echo "<pre>";
// print_r($db->selectSql($selectExample, [5]));
// echo "</pre>";







//// UPDATE
// $db = new db();
// $updateExample = <<<EOD
// UPDATE `esignature`.`contract` 
// SET `contractName` = ?, contractContent = ?
// WHERE (`contractId` = ?);
// EOD;
// $db->updateSql($updateExample, ["yup", "yup2", 63]);







///// DELETE
// $db = new db();
// $deleteExample = <<<EOD
// DELETE FROM `esignature`.`contract` 
// WHERE (`contractId` = ?);
// EOD;
// $db->deleteSql($deleteExample, [62]);