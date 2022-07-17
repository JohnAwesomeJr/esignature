<?php require "/var/www/html/esignature/.env"; ?>
<?php $urlPath = "{$rootFolder}signature/sig.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']; ?>
<?php header("Location: {$urlPath}");
