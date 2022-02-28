<?php require "/var/www/html/esignature/.env"; ?>
<?php require "/{$rootD}/colors.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= $rootFolder; ?>allStyles.css">
    <link rel="stylesheet" href="<?= $rootFolder; ?>newStyles.css">
    <style>
        #root {
            position: fixed;
            /* border:solid rgb(133, 247, 125) 4px; */
            width: 100vw;
            height: 600px;
            pointer-events: none;
            overflow-y: scroll;
            transition: all 200ms;
        }

        input {
            pointer-events: auto;
        }

        body {
            pointer-events: none;
            background: #80b2d0;
        }
    </style>

</head>

<body>
    <div id="root" class="flexColumn xFlexCenter yFlexCenter">
    </div>
</body>

</html>
<?php if (empty($_POST)) : ?>
    <script>
        let visableSpace = 0;
        let root = document.getElementById('root');
        setInterval(() => {
            let visableSpace = window.visualViewport.height;
            root.style.height = visableSpace + "px";
            window.scrollTo(0, 0);
        }, 1);

        root = document.getElementById('root');

        box = document.createElement('form');
        box.className = "flexColumn xFlexCenter yFlexSpaceAround shadow padding";
        box.method = "post"
        box.style.borderRadius = "20px";
        box.style.background = "white";
        box.style.width = "0px";
        box.style.height = "0px";
        box.style.padding = "0px";
        box.style.overflow = "hidden";
        box.style.transition = "all 500ms cubic-bezier(.86,0,.58,1.6) 0s";
        root.append(box);

        setTimeout(() => {
            box.style.height = "400px";
            box.style.padding = "5px";
            setTimeout(() => {
                box.style.padding = "30px";
                box.style.width = "400px";
                setTimeout(() => {
                    title.style.opacity = 1;
                    title.style.filter = "blur(0px)"
                    setTimeout(() => {
                        inputEmail.style.opacity = 1;
                        inputEmail.style.filter = "blur(0px)"
                        setTimeout(() => {
                            inputPassword.style.opacity = 1;
                            inputPassword.style.filter = "blur(0px)"
                            setTimeout(() => {
                                submitButton.style.opacity = 1;
                                submitButton.style.filter = "blur(0px)"
                            }, 200)
                        }, 100)
                    }, 50)
                }, 500)
            }, 500)
        }, 500)

        title = document.createElement('p');
        title.innerHTML = "Create an Account";
        title.style.opacity = 0;
        title.style.transition = "all 2000ms";
        title.style.filter = "blur(10px)"
        box.append(title);


        inputEmail = document.createElement('input');
        inputEmail.type = "email";
        inputEmail.name = "emailInputValue";
        inputEmail.placeholder = "Email";
        inputEmail.style.opacity = 0;
        inputEmail.style.transition = "all 500ms";
        inputEmail.style.filter = "blur(10px)";
        box.append(inputEmail);


        inputPassword = document.createElement('input');
        inputPassword.type = "password";
        inputPassword.name = "passwordInputValue";
        inputPassword.placeholder = "Password";
        inputPassword.style.opacity = 0;
        inputPassword.style.transition = "all 500ms";
        inputPassword.style.filter = "blur(10px)";
        box.append(inputPassword);


        submitButton = document.createElement('button');
        submitButton.type = "submit";
        submitButton.innerHTML = "Sign Up";
        submitButton.className = "buttonNew";
        submitButton.style.opacity = 0;
        submitButton.style.transition = "all 1000ms";
        submitButton.style.filter = "blur(10px)";
        box.append(submitButton);
    </script>
<?php else : ?>
    <!-- is the email alredy in the database? -->
    <?php require "/{$rootD}/classes/db.php" ?>

    <?php
    // SELECT
    $db = new db();
    $selectExample = <<<EOD
    SELECT userEmail FROM esignature.users
    WHERE userEmail = ?;
    EOD;
    $fromDatabase = $db->selectSql($selectExample, [$_POST['emailInputValue']]);


    if (array_key_exists(0, $fromDatabase)) {
        echo "<h1>that email is alredy reistered</h1>";
    } else {
        echo "<h1>its not in the database, adding it now</h1>";
    }
    ?>





<?php endif; ?>