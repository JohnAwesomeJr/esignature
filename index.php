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
        max-width: 100%;
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
    <style>
        .sideWindow {
            display: inline-block;
            background: white;
            padding: 30px;
            position: fixed;
            z-index: 10;
            bottom: 30px;
            right: 30px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div class="sideWindow">
        <a href="/signer/1instructions.php?contractNumber=2&contractSigner=1">JJ</a>
        <a href="/signer/1instructions.php?contractNumber=2&contractSigner=2">Jessica</a>
        <a href="/signer/1instructions.php?contractNumber=2&contractSigner=5">Jenny</a>
    </div>
    </div><!-- endo of base container -->

</body>

</html>