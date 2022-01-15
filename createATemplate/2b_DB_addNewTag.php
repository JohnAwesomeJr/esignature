<?php ob_start(); ?>
<?php
require "/var/www/html/classes/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php session_start(); ?>
<!-- are you logged in? -->
<?php if ($_SESSION) : ?>
    <!-- are you the owner of the template? -->
    <script src="/node_modules/insert-text-at-cursor/dist/index.umd.js"></script>
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
        if (!empty($_POST['newTagName'])) {
            $newTagName = $_POST['newTagName'];


            //INSERT
            $db = new db();
            $insertExample = <<<EOD
            INSERT INTO `esignature`.`tags` (`parentTemplate`, `tagName`) 
            VALUES (?, ?);
            EOD;
            // use echo to see the key of the last inserted 
            echo $db->createSql($insertExample, [$templateId, $newTagName]);
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