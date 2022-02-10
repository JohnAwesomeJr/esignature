<?php session_start(); ?>
<?php require "/var/www/html/esign/.env"; ?>
<?php require "/var/www/html/esign/htmlStart.php"; ?>
<?php // require "/var/www/html/esign/arrayVisualizer.php"; 
?>
<?php require "/var/www/html/esign/colors.php"; ?>



<body>
    <!-- start of the base container -->
    <?php require "/var/www/html/esign/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php
        $backButton = true;
        $backLink1 = "/templatesAndContracts.php?screen=contracts";
        require "/var/www/html/esign/uiParts/headder.php";
        ?>
        <div style="height:85px;"></div>
        <div class="customCard">
            <p>Congradulations! The document has been sent to the signers. <br>Check back in your contracts section to see who has finished signing the document.</p>
        </div>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/var/www/html/esign/uiParts/footer.php";
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