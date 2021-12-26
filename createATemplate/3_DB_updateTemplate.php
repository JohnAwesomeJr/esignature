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

    <fieldset>
        <legend>
            <h3>User Session Info</h3>
        </legend>

        <pre> <?php print_r($_SESSION); ?> </pre>
    </fieldset>

    <fieldset>
        <legend>
            <h3>Post array</h3>
        </legend>

        <pre> <?php print_r($_POST); ?> </pre>
    </fieldset>

    <?php
    $userId = $_SESSION['userId'];



    // header("location: /createATemplate/2_PAGE_editTemplate.php?templateNumber={$newTemplateId}")
    ?>



<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>