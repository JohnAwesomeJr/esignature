<?php
$primaryColor = "#476CF2";
// $primaryColor = "#8fd1f7";
$secondColor = "#F1AD47";
$background = "#EEF8FF";
$blackColor = "black";
$whiteColor = "white";
?>

<?php require "/var/www/html/uiParts/card.php"; ?>


<?php

$sql = <<<EOD
SELECT contractName, contractContent 
FROM contract
WHERE contractId = ?;
EOD;

$id = $_GET['contractNumber'];

$pdo = new PDO('mysql:host=localhost;dbname=esignature', "root", "il0veG@D");
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$rows = $stmt->fetchAll();

?>
<?php $content = $rows[0]['contractContent']; ?>
<?php $title = $rows[0]['contractName']; ?>

<?php //require "/var/www/html/arrayVisualizer.php"; 
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

    #contractText {
        font-size: 12px;
    }
</style>

<body>
    <!-- start of the base container -->
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>


    <div id="bodyCentering">
        <?php require "/var/www/html/uiParts/headder.php"; ?>
        <div style="height:85px;"></div>
        <?php makeCard("<h1>" . $title . "</h1>" . "<br>" . "<div id=contractText>"  . $content . "</div>"); ?>
        <div style="height:100px;"></div>



        <!-- Add the footer -->
        <?php
        require "/var/www/html/uiParts/footer.php";
        $allButtons = [
            //$button1 = ["templatesButton", "http://www.google.com"],
            //$button2 = ["contractsButton", "http://www.google.com"],
            $button3 = ["nextButtonOrange", "/signer/4save.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']]
        ];
        footer(...$allButtons);
        ?>



    </div>





    <!-- end of the base container -->
    </div>




</body>

</html>