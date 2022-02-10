<?php session_start(); ?>

<?php
// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
?>

<?php require "/var/www/html/esign/colors.php"; ?>
<?php require "/var/www/html/esign/htmlStart.php"; ?>

<body style="font-size:40px;">
    <?php require "/var/www/html/esign/uiParts/baseContainer.php"; ?>
    <div id="centering">
        <div class="customCard" style="font-size:10px; max-width:300px;">
            <?php
            if (empty($_POST['error'])) {
            } else {
                echo "<p style=\" color:red; text-align:center;\">" . $_POST['error'] . "</p>";
            }
            ?>
            <p style="text-align:center; margin: 10px;">Login</p>
            <form action="authLogin.php" method="post">
                <input type="email" name="userName" placeholder="email" value="<?php if ($_POST) {
                                                                                    echo $_POST['lastTypedEmail'];
                                                                                }; ?>">
                <input type="password" placeholder="password" name="password">
                <br>
                <input type="submit" value="Login">
            </form>
            <a href="http://www.google.com"> Create An Account </a>
        </div>
    </div>
    <!-- <div class="sideWindow">
        <a href="/signer/1instructions.php?contractNumber=2&contractSigner=1">JJ</a>
        <a href="/signer/1instructions.php?contractNumber=2&contractSigner=2">Jessica</a>
        <a href="/signer/1instructions.php?contractNumber=2&contractSigner=5">Jenny</a>
    </div> -->
    </div><!-- endo of base container -->

</body>

</html>