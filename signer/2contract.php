<?php require "/var/www/html/arrayVisualizer.php"; ?>

<?php
$primaryColor = "#476CF2";
// $primaryColor = "#8fd1f7";
$secondColor = "#F1AD47";
$background = "#EEF8FF";
$blackColor = "black";
$whiteColor = "white";
?>

<?php require "/var/www/html/uiParts/card.php"; ?>
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
<h2>this is an H2 headding</h2>
EODCONTENTTHINGS;; ?>


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>



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
<style>
    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
        font-size: 24px;
        text-decoration: none;
        color: black;

    }

    body {
        overflow: hidden;
        font-family: 'Barlow Condensed', sans-serif;
    }

    #bodyCentering {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
</style>

<body>
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
            $button3 = ["nextButtonOrange", "/signer/3signature.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>