<?php require "/var/www/html/esignature/.env"; ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= $rootFolder;?>allStyles.css">
    <link rel="stylesheet" href="<?= $rootFolder;?>newStyles.css">
    <style>
        #root{
            position: fixed;
            border:solid rgb(133, 247, 125) 4px;
            width:100vw;
            height:600px;
            pointer-events: none;
            overflow-y: scroll;
            transition: all 200ms;
        }
        input{
            pointer-events: auto;
        }
    </style>

</head>
<body>

<div id="root" class="flexColumn xFlexCenter yFlexCenter">
    <h1>This page is not yet ready. <br> Come back again.</h1>
</div>

</body>
</html>


<script>
    let visableSpace = 0;
    let root = document.getElementById('root');
    setInterval(()=>{
        let visableSpace = window.visualViewport.height;
        root.style.height = visableSpace + "px";
        window.scrollTo(0,0);
    },1);


    root = document.getElementById('root');

    box = document.createElement('div');
    box.className = "flexColumn xFlexCenter yFlexCenter";
    root.append(box);

    title = document.createElement('h3');
    title.innerHTML = "test";
    box.append(title);

    inputEmail = document.createElement('input');
    inputEmail.name = "emailInputValue";
    inputEmail.placeholder = "Email";

    box.append(inputEmail);

    inputPassword = document.createElement('input');
    inputPassword.name = "passwordInputValue";
    inputPassword.placeholder = "Password";
    box.append(inputPassword);


    
</script>