<?php require "/var/www/html/colors.php"; ?>

<?php require "/var/www/html/uiParts/card.php"; ?>
<?php $content = "I am thinking that I want to do somthing fun. I am thinking that I want to do somthing fun. I am thinking that I want to do somthing fun. I am thinking that I want to do somthing fun."; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Signature</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed&display=swap" rel="stylesheet">
</head>

<body>
    <!-- start of the base container -->
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php require "/var/www/html/uiParts/headder.php"; ?>
        <div style="height:85px;"></div>
        <?php makeCard($content, "", 1); ?>
        <?php makeCard($content); ?>
        <?php makeCard($content); ?>
        <?php makeCard($content); ?>
        <?php makeCard($content); ?>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/var/www/html/uiParts/footer.php";
        $allButtons = [
            $button1 = ["templatesButton", "http://www.google.com"],
            $button2 = ["contractsButton", "http://www.google.com"],
            $button3 = ["plusButtonShort", "http://www.google.com"]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>