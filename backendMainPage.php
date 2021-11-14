<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require "/var/www/html/htmlStart.php";
require "/var/www/html/.env";
$errors = [];


$sql = <<<EOD
SELECT * FROM esignature.users
WHERE userEmail=?;
EOD;

$userName = $_POST['userName'];
$userPassword = $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
$stmt = $pdo->prepare($sql);
$stmt->execute([$userName,]);
$rows = $stmt->fetchAll();

$HashedPassword = hash("sha512", $_POST['password'] . $rows[0]['salt']);

if ($userName == "" | $userPassword == "") {
    $errorText = urlencode("Please Correct User Name Or Password.");
    array_push($errors, $errorText);
    header("Location: /?error={$errorText}");
} else {
    if ($rows != true) {
        $errorText = "No Account Found";
        array_push($errors, $errorText);
        header("Location: /?error={$errorText}");
    } else {
        if ($HashedPassword != $rows[0]['userPassword']) {
            echo "<br><br><br>";

            echo $HashedPassword;
            echo "<br>";
            echo $rows[0]['userPassword'];
            echo "<br><br><br>";

            $errorText = "that is not the right password for that account.";
            array_push($errors, $errorText);
            header("Location: /?error={$errorText}");
        } else {
            $errorText = "You are now qualified to login!";
            array_push($errors, $errorText);
            header("Location: /?error={$errorText}");
        }
    }
}

require "arrayVisualizer.php";

?>

<body>
    <?php
    foreach ($errors as $key => $value) {
        echo $errors[$key] . "<br>";
    }
    ?>

</body>