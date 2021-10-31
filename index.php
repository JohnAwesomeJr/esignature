<?php
$primaryColor = "#476CF2";
// $primaryColor = "#8fd1f7";
$secondColor = "#F1AD47";
$background = "#EEF8FF";
$blackColor = "black";
$whiteColor = "white";
?>

<?php require "/var/www/html/uiParts/card.php"; ?>
<?php $content = "I am thinking that I want to do somthing fun. I am thinking that I want to do somthing fun. I am thinking that I want to do somthing fun. I am thinking that I want to do somthing fun."; ?>


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
        <?php require "/var/www/html/uiParts/footer.php"; ?>
    </div>
    </div>
</body>

</html>