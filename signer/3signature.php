<?php $urlPath = "/signature/sig.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']; ?>
<?php header("Location: {$urlPath}");
