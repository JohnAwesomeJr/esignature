<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<pre>
<?php print_r($_POST); ?>
</pre>

<?php
$fileName = uniqid();
$data_uri = $_POST['base64Data'];
$encoded_image = explode(",", $data_uri)[1];
$decoded_image = base64_decode($encoded_image);
file_put_contents("signatureUploads/" . $fileName . ".svg", $decoded_image);

?>