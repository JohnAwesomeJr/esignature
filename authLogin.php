<?php
session_start();
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
    $errorText = "Please Correct User Name Or Password.";
    echo <<<EOD
    <form method="post" action="/">
        <input type="hidden" name="error" value="{$errorText}">
        <input type="hidden" name="lastTypedEmail" value="{$userName}">
        <input id="submit" type="submit" hidden>
    </form>
    <script>
        document.getElementById("submit").click();
    </script>
    EOD;
} else {
    if ($rows != true) {
        $errorText = "No Account Found";
        echo <<<EOD
        <form method="post" action="/">
            <input type="hidden" name="error" value="{$errorText}">
            <input type="hidden" name="lastTypedEmail" value="{$userName}">
            <input id="submit" type="submit" hidden>
        </form>
        <script>
            document.getElementById("submit").click();
        </script>
        EOD;
    } else {
        if ($HashedPassword != $rows[0]['userPassword']) {
            $errorText = "that is not the right password for that account.";
            echo <<<EOD
            <form method="post" action="/">
                <input type="hidden" name="error" value="{$errorText}">
                <input type="hidden" name="lastTypedEmail" value="{$userName}">
                <input id="submit" type="submit" hidden>
            </form>
            <script>
                document.getElementById("submit").click();
            </script>
            EOD;
        } else {
            $_SESSION['userName'] = $userName;
            $_SESSION['userId'] = $rows[0]['userId'];
            $errorText = "You are now qualified to login!";
            echo <<<EOD
            <form method="post" action="/templatesAndContracts.php">
                <input id="submit" type="submit" hidden>
            </form>
            <script>
                 document.getElementById("submit").click();
            </script>
            EOD;
        }
    }
}
?>

<body>

</body>