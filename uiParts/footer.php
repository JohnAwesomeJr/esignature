<?php require "/var/www/html/uiParts/button.php"; ?>
<? php; ?>

<style>
    #footer {
        display: inline-block;
        width: 100%;
        max-width: 400px;
        padding: 0px 15px 0px 15px;
        position: fixed;
        bottom: 0px;
        background: <?= $primaryColor; ?>;
        border-radius: 15px 15px 0px 0px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);



        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    #shadow {
        position: fixed;
        bottom: 0px;
        pointer-events: none;

        width: 100%;
        height: 100px;
        background: rgb(0, 0, 0);
        background: linear-gradient(0deg, rgba(0, 0, 0, 50%) 0%, rgba(0, 0, 0, 0) 100%);
    }
</style>

<div id="shadow"></div>
<div id="footer">
    <?php button("Templates", "", 0); ?>
    <?php button("Contracts", "", 0); ?>
    <?php button("/var/www/html/uiImages/plus.svg", "", 0); ?>

</div>