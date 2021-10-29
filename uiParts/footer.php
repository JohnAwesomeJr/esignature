<?php require "/var/www/html/uiParts/button.php"; ?>
<style>
    #footer {
        display: inline-block;
        width: 100%;
        max-width: 760px;
        /* height: 70px; */
        padding: 15px;
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
</style>
<div id="footer">
    <?php $mike = require "/var/www/html/uiImages/plus.svg"; ?>
    <?php button($mike); ?>
</div>