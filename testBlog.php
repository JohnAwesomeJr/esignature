<?php
$blog = <<<EOD
<div style="width: 100%; border-radius: 15px; padding:30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ">
    <div align="left" style="width: 50%;float: left;">
        <h2>{$signerTitle}</h2>
        <h4>{$rows[0]['signerName']}</h4>
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
