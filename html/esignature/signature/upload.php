<?php
// enviroment variables
require "/var/www/html/esignature/.env";
?>
<?php
$fileName = uniqid();
$data_uri = $_POST['base64Data'];
$encoded_image = explode(",", $data_uri)[1];
$decoded_image = base64_decode($encoded_image);
$newFilePath = "signatureUploads/" . $fileName . ".svg";
file_put_contents($newFilePath, $decoded_image);
?>

<?php
// make the file path
$completeFilePath = "/" . $newFilePath;
?>
<?php $todaysDate = date("Y-m-d"); ?>
<?php $urlPath = $rootFolder . "signer/4save.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']; ?>

<?php
$sql = <<<EOD
UPDATE esignature.signers
SET signers.signerImagePath=?, signers.signDate=? 
WHERE signerId = ?;
EOD;

$pdo = new PDO("mysql:host={$mysqlIpAddress};dbname=esignature", $mysqlUser, $mysqlPassword);
$stmt = $pdo->prepare($sql);
$stmt->execute([$completeFilePath, $todaysDate, $_GET['contractSigner']]);
$rows = $stmt->fetchAll();
?>
<?php header("Location: {$urlPath}");
