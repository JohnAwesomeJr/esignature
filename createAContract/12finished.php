<?php session_start(); ?>
<?php require "/var/www/html/.env"; ?>
<?php require "/{$rootD}/htmlStart.php"; ?>
<?php // require "/{$rootD}/arrayVisualizer.php"; 
?>
<?php require "/{$rootD}/colors.php"; ?>



<body>
    <!-- start of the base container -->
    <?php require "/{$rootD}/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php
        $backButton = true;
        $backLink1 = "/templatesAndContracts.php?screen=contracts";
        require "/{$rootD}/uiParts/headder.php";
        ?>
        <div style="height:85px;"></div>
        <div class="customCard">
            <p>Congradulations! The document has been sent to the signers. <br>Check back in your contracts section to see who has finished signing the document.</p>
        </div>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/{$rootD}/uiParts/footer.php";
        $allButtons = [
            $button1 = ["homeButton", "/templatesAndContracts.php?screen=contracts"],
            // $button2 = ["contractsButton", "http://www.google.com"]
            // $button3 = ["plusButtonShort", "http://www.google.com"]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>