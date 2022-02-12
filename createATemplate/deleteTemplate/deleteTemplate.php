<?php require "/var/www/html/esignature/.env"; ?>
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
    <!-- are you the owner of the template? -->
    <script src="<?= $rootFolder; ?>node_modules/insert-text-at-cursor/dist/index.umd.js"></script>
    <?php
    $templateId = $_GET['templateNumber'];








    $sql = <<<EOD
    SELECT * FROM esignature.template
    WHERE templateId = ?;
    EOD;


    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$templateId]);
    $templateDbArray = $stmt->fetchAll();



    ?>

    <?php if ($_SESSION['userId'] == $templateDbArray[0]['parentUser']) : ?>
        <!-- are you the owner of the template? -->




        <?php
        $itemToDelete = $templateId;

        /// DELETE
        $db = new db();
        $deleteExample = <<<EOD
        DELETE FROM `esignature`.`template` WHERE (`templateId` = ?);

        DELETE FROM `esignature`.`titles` WHERE (`parentTemplate` = ?);

        DELETE FROM `esignature`.`tags` WHERE (`parentTemplate` = ?);
        EOD;
        $db->deleteSql($deleteExample, [$itemToDelete, $itemToDelete, $itemToDelete]);

        header("Location: {$rootFolder}templatesAndContracts.php")
        ?>




    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>