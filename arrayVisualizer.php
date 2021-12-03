<div id="debugBox">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>

    Session
    <pre style="font-size: 10px !important;">
        <?php print_r($_SESSION); ?>
    </pre>
    $_GET
    <pre style="font-size: 10px !important;">
        <?php print_r($_GET); ?>
    </pre>
    $_POST
    <pre style="font-size: 10px !important;">
        <?php print_r($_POST); ?>
    </pre>
    DatabasePull
    <pre style="font-size: 10px !important;">
        <?php print_r($rows); ?>
    </pre>


</div>