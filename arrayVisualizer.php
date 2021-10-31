<style>
    #debugBox {
        height: 200px;
        max-width: 400px;
        position: fixed;
        right: 0px;
        top: 100px;
        background: white;
        overflow: scroll;
        padding: 10px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

    }
</style>
<div id="debugBox">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>
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