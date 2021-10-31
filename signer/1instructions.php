<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/uiParts/card.php"; ?>
<?php require "/var/www/html/htmlStart.php"; ?>

<body>

    <?php $content = <<<EODCONTENTTHINGS
        <h1>H1 headding</h1>

        <ul>
            <li>TEST</li>
            <li>TEST</li>
            <li>TEST</li>
        </ul>
        <p>
        I am testing all of the functions in the HTML section.
        </p>
        <p>
        Pekaboo!
        </p>
        <h1>this is an H1 headding</h1>
        <h2>this is an H2 headding</h2>
        <h3>this is an H3 headding</h3>

    EODCONTENTTHINGS;; ?>

    <!-- start of the base container -->
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php require "/var/www/html/uiParts/headder.php"; ?>
        <div style="height:85px;"></div>
        <?php makeCard($content); ?>
        <div style="height:100px;"></div>

        <!-- Add the footer -->
        <?php
        require "/var/www/html/uiParts/footer.php";
        $allButtons = [
            //$button1 = ["templatesButton", "http://www.google.com"],
            //$button2 = ["contractsButton", "http://www.google.com"],
            $button3 = ["nextButtonOrange", "/signer/2contract.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>