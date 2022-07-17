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


    $pdo = new PDO("mysql:host={$mysqlIpAddress};dbname=esignature", $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$templateId]);
    $templateDbArray = $stmt->fetchAll();



    ?>
    <fieldset>
        <legend>
            <h3>template Info</h3>
        </legend>

        <pre> <?php print_r($templateDbArray); ?> </pre>
    </fieldset>

    <?php if ($_SESSION['userId'] == $templateDbArray[0]['parentUser']) : ?>











        You are good
        <br>


        <?php
        if (!empty($_POST['newTitleName'])) {
            $newTitleName = $_POST['newTitleName'];


            //INSERT
            $db = new db();
            $insertExample = <<<EOD
INSERT INTO `esignature`.`titles` (`parentTemplate`, `titleName`) 
VALUES (?, ?);
EOD;
            // use echo to see the key of the last inserted 
            echo $db->createSql($insertExample, [$templateId, $newTitleName]);
        }

        header("Location: /createATemplate/2_PAGE_editTemplate.php?templateNumber={$templateId}");


        ?>










    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>