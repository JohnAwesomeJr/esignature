<?php require "/var/www/html/esignature/.env"; ?>

<?php
ob_start();
require "/{$rootD}/htmlStart.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<body>
    <html>
    <?php
    require "/{$rootD}/classes/db.php";

    $origanal = $_POST['output'];
    $removeLineBreak = str_replace(["\r", "\n"], '', $origanal);
    $stripTags = strip_tags($removeLineBreak, ['p', 'h1', 'h2', 'ul', 'li', 'ol', 'strong', 'b', 'em']);
    $escape = $stripTags;


    $draft = (int)$_GET['draft'];

    // UPDATE
    $db = new db();
    $updateExample = <<<EOD
    UPDATE `esignature`.`contract` 
    SET `contractContent` = ?, draft = ?
    WHERE (`contractId` = ?);
    EOD;

    $db->updateSql($updateExample, [$escape, $draft, $_GET['contractNumber']]);

    ?>

</body>

</html>
<?php if ($draft == 0) : ?>
    <?php header("Location: {$rootFolder}createAContract/11sendSignNotifacationEmails.php?arrayPosition=0&contractNumber=" . $_GET['contractNumber']); ?>
<?php else : ?>
    <?php header("Location: {$rootFolder}templatesAndContracts.php?screen=contracts"); ?>
<?php endif; ?>

<?php ob_end_flush(); ?>