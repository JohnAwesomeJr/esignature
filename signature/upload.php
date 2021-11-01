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


<?php
$sql = <<<EOD
UPDATE esignature.signers
SET signers.signerImagePath=?
WHERE signerId = ?;
EOD;

$pdo = new PDO('mysql:host=localhost;dbname=esignature', "root", "il0veG@D");
$stmt = $pdo->prepare($sql);
$stmt->execute([$completeFilePath, $_GET['contractSigner']]);
$rows = $stmt->fetchAll();
?>
<?php header("Location: /signer/4save.php");
