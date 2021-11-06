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

    <div id="screen">
        <?php require "/var/www/html/uiImages/loading/loading.php";
        ?>
    </div>


    <?php

    $sql = <<<EOD
    SELECT * 
    FROM esignature.signers
    WHERE signerParentContract =?;
    EOD;

    $id = $_GET['contractNumber'];

    $pdo = new PDO('mysql:host=localhost;dbname=esignature', "root", "il0veG@D");
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $rows = $stmt->fetchAll();
    ?>

    <?php
    $contractNotDoneSigning = FALSE;
    foreach ($rows as $key => $value) {
        if ($rows[$key]['signDate'] == "") {
            $contractNotDoneSigning = TRUE;
        }
    }; ?>
    <?php
    if ($contractNotDoneSigning == FALSE) {

        $signers = "";
        foreach ($rows as $value => $id) {
            $signatureCss = "style=\"width:300px;\" ";
            $pathToSignature = "/var/www/html/signature" . $rows[$value]['signerImagePath'];
            $svgImage = "<img class=sig {$signatureCss} src=\"{$pathToSignature}\">";
            $signatureDate = $rows[$value]['signDate'];
            $signerEmail = $rows[$value]['signerEmail'];
            $signerTitle = $rows[$value]['signerTitle'];
            $signatureName = $rows[$value]['signerName'];
            $html = <<<EOD

        <div style="width: 100%; border-radius: 15px; padding:30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ">
            <div align="left" style="width: 50%;float: left;">
                <h2>{$signerTitle}</h2>
                <h4>{$signatureName}</h4>
                <h4>{$signerEmail}</h4>
            </div>
            <div align="left" style="width: 50%;float: left;">
                <div style="width: 100%;">
                    <img style="width:200px;" src="{$pathToSignature}">
                    <p>Signed: {$signatureDate}</p>
                </div>
            </div>
        </div>
        EOD;

            $signers = $signers . $html;
        }


        $sql = <<<EOD
        SELECT contractContent, contractName
        FROM esignature.contract
        WHERE contractId = ?;
        EOD;

        $id = $_GET['contractNumber'];

        $pdo = new PDO('mysql:host=localhost;dbname=esignature', "root", "il0veG@D");
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll();

        $title = "<h1>" . $rows[0]['contractName'] . "</h1> <br>";
        $content = $rows[0]['contractContent'];



        // require "/var/www/html/testBlog.php";

        require_once __DIR__ . "/.." . '/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($title . $content . $signers);
        // $mpdf->Output();
        $mpdf->Output('/var/www/html/pdfFiles/mydoc.pdf');
    } else {
        echo "we will email you when everyone has signed the contract.";
    }



    ?>
    <?php $urlPath = "/signer/5done.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']; ?>
    <?php header("Location: {$urlPath}"); ?>







</body>

</html>