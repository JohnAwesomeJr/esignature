<?php require "/var/www/html/htmlStart.php"; ?>

<body style="font-size:40px;">
    <a href="/signer/1instructions.php?contractNumber=1&contractSigner=1">JJ</a>
    <br>
    <a href="/signer/1instructions.php?contractNumber=1&contractSigner=2">Jessica</a>
    <br>
    <a href="/signer/1instructions.php?contractNumber=1&contractSigner=5">Jenny</a>
    <br>
    <br>
    <br>
    <?php
    if (empty($_GET['error'])) {
    } else {
        echo $_GET['error'];
    }
    ?>
    <div style="font-size:10px;">
        <form action="backendMainPage.php" method="post">
            <p style="margin-bottom: 0px;">Email</p>
            <br>
            <input type="email" name="userName">
            <br>
            <p style="margin-bottom: 0px;">Password</p>
            <br>
            <input type="password" name="password">
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>