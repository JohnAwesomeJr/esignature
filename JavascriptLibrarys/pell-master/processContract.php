<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require "/var/www/html/arrayVisualizer.php";
require "/var/www/html/classes/db.php";

$escape = addslashes($_POST['output']);
$draft = (int)$_POST['draft'];

// UPDATE
$db = new db();
$updateExample = <<<EOD
UPDATE `esignature`.`contract` 
SET `contractContent` = ?, draft = ?
WHERE (`contractId` = ?);
EOD;
$db->updateSql($updateExample, [$escape, $draft, $_GET['contractNumber']]);
