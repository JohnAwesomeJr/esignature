<style>
    #headder {
        display: inline-block;
        width: 100%;
        max-width: 760px;
        /* height: 70px; */
        padding: 15px;
        position: fixed;
        background: <?= $primaryColor; ?>;
        border-radius: 0px 0px 15px 15px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        z-index: 2;



        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
</style>
<div id="headder">
    <?php require "/var/www/html/uiImages/backButton.svg"; ?>
    <?php require "/var/www/html/uiImages/hamburgerMenu.svg"; ?>
</div>