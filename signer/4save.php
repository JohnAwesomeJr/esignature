<?php require "/var/www/html/colors.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        #screen {
            position: fixed;
            background: <?= $background; ?>;
            width: 100vw;
            height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>

    <!-- <div id="screen"> -->
    <?php //require "/var/www/html/uiImages/loading/loading.php"; 
    ?>
    <!-- </div> -->


    <?php

    $sql = <<<EOD
    SELECT * 
    FROM esignature.signers
    WHERE signerId =?;
    EOD;

    $id = $_GET['contractSigner'];

    $pdo = new PDO('mysql:host=localhost;dbname=esignature', "root", "il0veG@D");
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $rows = $stmt->fetchAll();
    ?>
    <pre>
        <?php print_r($rows); ?>
    </pre>



    <?php


    $signatureCss = "style=\"width:300px;\" ";
    $pathToSignature = "/var/www/html/signature" . $rows[0]['signerImagePath'];
    $svgImage = "<img class=sig {$signatureCss} src=\"{$pathToSignature}\">";
    $signatureDate = $rows[0]['signDate'];
    $signerEmail = $rows[0]['signerEmail'];
    $signerTitle = $rows[0]['signerTitle'];


    require "/var/www/html/testBlog.php";

    require_once __DIR__ . "/.." . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($blog);
    $mpdf->Output();

    // $mpdf->Output('/var/www/html/pdfFiles/mydoc.pdf');
    ?>







</body>

</html>