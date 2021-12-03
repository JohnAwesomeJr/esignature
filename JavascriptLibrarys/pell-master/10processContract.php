<?php
ob_start();
require "/var/www/html/htmlStart.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<body>
    <html>
    <?php
    require "/var/www/html/arrayVisualizer.php";
    require "/var/www/html/classes/db.php";
    require "/var/www/html/.env";

    $escape = addslashes($_POST['output']);
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
    <?php header('Location: /createAContract/11sendSignNotifacationEmails.php?arrayPosition=0&contractNumber=' . $_GET['contractNumber']); ?>
<?php else : ?>
    <?php header('Location: /templatesAndContracts.php?screen=contracts'); ?>
<?php endif; ?>


?>
<?php ob_end_flush(); ?>