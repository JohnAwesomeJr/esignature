<?php session_start(); ?>
<?php require "/var/www/html/colors.php"; ?>
<?php require "/var/www/html/htmlStart.php"; ?>

<style>
    #centering {
        width: 100%;
        height: 100%;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .customCard {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>

<body style="font-size:40px;">
    <?php require "/var/www/html/uiParts/baseContainer.php"; ?>
    <div id="centering">
        <div class="customCard" style="font-size:10px; max-width:300px;">
            <?php
            if (empty($_POST['error'])) {
            } else {
                echo "<p style=\" color:red; text-align:center;\">" . $_POST['error'] . "</p>";
            }
            ?>
            <p style="text-align:center; margin: 10px;">Login</p>
            <form action="backendMainPage.php" method="post">
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
    <a href="/signer/1instructions.php?contractNumber=1&contractSigner=1">JJ</a>
    <br>
    <a href="/signer/1instructions.php?contractNumber=1&contractSigner=2">Jessica</a>
    <br>
    <a href="/signer/1instructions.php?contractNumber=1&contractSigner=5">Jenny</a>
    </div>

</body>

</html>