<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Signature</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed&display=swap" rel="stylesheet">
</head>

<style>
    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
        /* font-size: 24px; */
        text-decoration: none;
        color: black;

    }

    body {
        overflow: hidden;
        font-family: 'Barlow Condensed', sans-serif;
    }


    li {
        font-size: 24px;
        margin-left: 30px;
    }

    ul {
        margin-bottom: 30px;
    }

    p {
        font-size: 24px;
        margin-bottom: 30px;
    }

    h1 {
        font-size: 40px;
        margin-bottom: 30px;

    }

    h2 {
        font-size: 35px;
        margin-bottom: 30px;

    }

    h3 {
        font-size: 30px;
        margin-bottom: 30px;

    }

    input {
        margin: 20px 0px;
        padding: 10px;
        width: calc(100%);
        border: none;
        border-radius: 15px;
        background: #e8e8e8
    }



    #bodyCentering {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .customCard {
        -webkit-appearance: none;
        width: calc(100% - 30px);
        max-width: 700px;
        background: white;
        padding: 30px 30px 30px 30px;
        margin: 15px 30px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 15px;
    }

    input[type=submit] {
        -webkit-appearance: none;
        background-color: <?= $secondColor; ?>;
        border-radius: 15px;
        border: none;
        color: white;
        padding: 20px;
        text-decoration: none;
        cursor: pointer;
        margin: 20px 0px;

    }
</style>