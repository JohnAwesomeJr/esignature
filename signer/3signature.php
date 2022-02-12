<?php require "/var/www/html/peak/.env"; ?>
<?php $urlPath = "{$rootFolder}signature/sig.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']; ?>
<?php header("Location: {$urlPath}");
