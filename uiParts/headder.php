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

    #menu {
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        min-width: 100px;
        min-height: 100px;
        background: white;
        border-radius: 15px 0px 15px 15px;
        z-index: 4;
        position: fixed;
        top: 0px;
        padding: 30px;
        right: -100px;
    }

    #menu p {
        margin: 10px;
    }

    #darkOverlay {
        transition: all 0.3s;
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: black;
        z-index: 3;
        opacity: 0;
        pointer-events: none;
    }
</style>
<div id="headder">
    <?php if ($backButton == true) : ?>
        <a href="<?= $backLink1; ?>">
            <?php require "/var/www/html/uiImages/backButton.svg"; ?>
        </a>
    <?php else : ?>
        <div></div>
    <?php endif; ?>

    <div onclick="showMenu()">
        <?php require "/var/www/html/uiImages/hamburgerMenu.svg"; ?>
    </div>

</div>

<div id="menu">

    <a href="/">
        <p>login</p>
    </a>


    <a href="/templatesAndContracts.php?screen=templates">
        <p>Main Menu</p>
    </a>

</div>

<div onclick="showMenu()" id="darkOverlay">
</div>

<script>
    var menuToggleStatus = 0;
    const menuWidth = document.getElementById('menu').clientWidth;
    document.getElementById('menu').style.right = "-" + menuWidth + "px";

    const menuHeight = document.getElementById('menu').clientHeight;
    document.getElementById('menu').style.top = "-" + menuHeight + "px";

    function showMenu() {
        if (menuToggleStatus == 0) {
            document.getElementById('menu').style.transition = "all 0.3s";
            document.getElementById('menu').style.right = "0px";
            document.getElementById('menu').style.top = "0px";



            document.getElementById('darkOverlay').style.opacity = "0.7";
            document.getElementById('darkOverlay').style.pointerEvents = "auto";


            menuToggleStatus = 1;
        } else {
            document.getElementById('menu').style.transition = "all 0.3s";
            document.getElementById('menu').style.right = "-" + menuWidth + "px";

            document.getElementById('menu').style.top = "-" + menuHeight + "px";



            document.getElementById('darkOverlay').style.opacity = "0";
            document.getElementById('darkOverlay').style.pointerEvents = "none";

            menuToggleStatus = 0;
        }
    }
</script>