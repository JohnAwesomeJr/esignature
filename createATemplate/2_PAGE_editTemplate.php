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

        <?php
        $templateId = $templateDbArray[0]['templateId'];
        $templateName = $templateDbArray[0]['templateName'];
        $templateContent = $templateDbArray[0]['templateContent'];
        $parentUser = $templateDbArray[0]['parentUser'];

        if ($templateName == "") {
            $templateName = "New Template";
        }

        if ($templateContent == "") {
            $placeholder = "Wright your contract here";
        }
        ?>








        You are the owner and are qualified to modify this contract

        <form method="post">
            <label for="templateId">Template ID</label>
            <input name="templateId" type="text" value="<?= $templateId; ?>">
            <br>

            <label for="templateName">Template Name</label>
            <input name="templateName" type="text" value="<?= $templateName; ?>">
            <br>

            <label for="parentUser">Parent User</label>
            <input name="parentUser" type="text" value="<?= $parentUser; ?>">
            <br>

            <label for="templateContent">Template Content</label>
            <textarea name="templateContent" type="text" placeholder="<?= $placeholder; ?>"><?= $templateContent; ?></textarea>
            <br>

            <input type="submit">
        </form>










    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>