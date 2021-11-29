<?php
require "/var/www/html/classes/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php session_start(); ?>
<!-- are you logged in? -->
<?php if ($_SESSION) : ?>
  <!-- are you the owner of the contract? -->

  <?php

  $sql = <<<EOD
  SELECT contractParentUser
  FROM esignature.contract
  WHERE contractId = ?;
  EOD;

  $contractNumber = $_GET['contractNumber'];

  $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$contractNumber]);
  $rows = $stmt->fetchAll();
  ?>

  <?php if ($_SESSION['userId'] == $rows[0]['contractParentUser']) : ?>






















    <?php
    require "/var/www/html/colors.php";


    // SELECT
    $db = new db();
    $selectExample = <<<EOD
    SELECT * 
    FROM esignature.contract
    WHERE contractId = ?;
    EOD;

    $content = $db->selectSql($selectExample, [$_GET['contractNumber']])[0]['contractContent'];

    ?>

    <!DOCTYPE html>
    <html>

    <head>

      <meta name="viewport" content="user-scalable=1.0,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">

      <title>Contract Editor</title>

      <link rel="stylesheet" type="text/css" href="dist/pell.css">

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

        .centerColomn {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;



        }

        .centerRow {
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: center;
        }

        * {
          box-sizing: border-box;
        }

        body {
          margin: 0;
          padding: 0;
        }

        .content {
          box-sizing: border-box;
          margin: 0 auto;
          max-width: 600px;
          padding: 20px;
        }

        #html-output {
          white-space: pre-wrap;
        }

        #footer {
          display: inline-block;
          width: 100%;
          /* max-width: 500px; */
          padding: 0px 15px 0px 15px;
          position: fixed;
          bottom: 0px;
          background: <?= $primaryColor; ?>;
          border-radius: 15px 15px 0px 0px;
          box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);



          display: flex;
          flex-direction: row-reverse;
          align-items: center;
          justify-content: space-evenly;
        }

        .button {
          -webkit-user-select: none;
          /* Safari */
          -moz-user-select: none;
          /* Firefox */
          -ms-user-select: none;
          /* IE10+/Edge */
          user-select: none;
          /* Standard */

          display: inline-block;
          font-size: 18px;
          position: relative;
          max-width: 100px;
          height: 50px;
          padding: 0px;
          bottom: 15px;
          overflow: hidden;
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: center;
          margin-left: 7px;
          margin-right: 7px;
          box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
          border-radius: 15px;
          background: <?= $secondColor; ?>;
          min-width: 100px;
          color: white;
        }
      </style>

    </head>

    <body>

      <div class="content">
        <div id="editor" class="pell"></div>
      </div>
      <div id="footer">
        <div class="button" onclick="send();">SEND</div>
        <div class="button" onclick="draft();" style="background:white; color:black;">DRAFT</div>
      </div>


      <div class="outputs">
        <h1>pell</h1>
        <div style="margin-top:20px;">
          <h3>Text output:</h3>
          <div id="text-output"></div>
        </div>
        <div style="margin-top:20px;">
          <h3>HTML output:</h3>
          <pre id="html-output"></pre>
        </div>
      </div>

      <form id="formInput" method="post" action="" style="display:block; position:fixed; top:0px; right:0px;">
        <textarea hidden name="output" id="sendToDatabase"></textarea>
        <input hidden id="send" type="submit">
      </form>

      <script src="dist/pell.js"></script>
      <script>
        var editor = window.pell.init({
          element: document.getElementById('editor'),
          defaultParagraphSeparator: 'p',
          onChange: function(html) {
            document.getElementById('text-output').innerHTML = html
            document.getElementById('html-output').textContent = html
          }
        })
      </script>

      <script>
        var mybody = document.body;
        // mybody.style.width = "100vw";
        mybody.style.height = "100vh";
        mybody.style.overflow = "hidden";
        mybody.style.background = "<?php $background; ?>";



        var myMenuBar = document.querySelector('.pell-actionbar').style;
        var barHeight = document.querySelector('.pell-actionbar').clientHeight;

        myMenuBar.position = "fixed";
        myMenuBar.padding = "10px";
        myMenuBar.top = "0px";
        myMenuBar.left = "0px";
        // myMenuBar.boxShadow = "10px 10px 10px black";
        myMenuBar.zIndex = "100";
        myMenuBar.width = "calc(100%)";
        myMenuBar.display = "flex";
        menubar.alignItems = "coloumn";
        myMenuBar.justifyContent = "flex-start";
        myMenuBar.flexWrap = "wrap";
        myMenuBar.borderBottom = "none";
        myMenuBar.background = "<?= $primaryColor; ?>";
        myMenuBar.borderRadius = "0px 0px 15px 15px";


        var pellEditor = document.querySelector('#editor').style;
        pellEditor.background = "<?= $background; ?>";

        pellEditor.position = "fixed";
        pellEditor.top = "0px";
        pellEditor.left = "opx";

        pellEditor.height = "100%";
        pellEditor.width = "100vw";


        pellEditor.display = "flex";
        pellEditor.flexDirection = "column";
        pellEditor.alignItems = "center";
        pellEditor.justifyContent = "flex-start"


        var contentContainer = document.querySelector('.content').style;

        contentContainer.position = "fixed";
        contentContainer.top = "0px";
        contentContainer.left = "0px";

        contentContainer.margin = "0px";
        contentContainer.padding = "0px";

        contentContainer.maxWidth = "100vw";
        contentContainer.width = "100vw";

        contentContainer.maxHeight = "100%";
        contentContainer.height = "100%";


        document.body.style.height = window.innerHeight;



        var contentArea = document.querySelector('.pell-content').style;
        document.querySelector('.pell-content').innerHTML = "<?= $content; ?>";
        document.querySelector('#html-output').innerHTML = "<?= $content; ?>";


        // document.querySelector(".pell-content").addEventListener("click", () => {
        //   setTimeout(() => {
        //     window.scrollTo(20000, 20000);
        //     window.scrollTo(0, 0);
        //   }, 0)
        // });


        // contentArea.display = "flex";
        // contentArea.flexDirection = "column";
        // contentArea.alignItems = "center";
        // contentArea.justifyContent = "center"



        // contentArea.position = "fixed";
        // contentArea.top = "0px";
        // contentArea.left = "0px";
        // contentArea.border = "solid black 1px";
        contentArea.padding = "30px";
        // contentArea.margin = "30px";
        contentArea.marginTop = barHeight + 56 + "px";


        contentArea.overflow = "auto";
        contentArea.background = "<?= $whiteColor; ?>";
        contentArea.width = "calc(100vw - 60px)";
        contentArea.height = "calc(100% - 150px)";
        contentArea.borderRadius = "15px";
        contentArea.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";


        // contentArea.boxShadow = "10px 10px 10px black";

        var pellstyle = document.querySelector('.pell').style;
        pellstyle.border = "none";


        var output = document.querySelector('.outputs').style;
        output.display = "none";


        var myPellButton = document.getElementsByClassName('pell-button');

        for (var i = 0; i < myPellButton.length; i++) {
          myPellButton[i].style.width = "30px";
          myPellButton[i].style.height = "30px";
          myPellButton[i].style.background = "<?= $whiteColor; ?>";
          myPellButton[i].style.borderRadius = "10px";
          myPellButton[i].style.margin = "3px";
        }
        myPellButton[7].style.display = "none";
        myPellButton[10].style.display = "none";
        myPellButton[12].style.display = "none";
        myPellButton[13].style.display = "none";


        var startingOutput = document.getElementById('html-output').innerHTML;
        document.getElementById('sendToDatabase').innerHTML = startingOutput;

        function send() {
          document.getElementById('formInput').action = "/JavascriptLibrarys/pell-master/processContract.php?contractNumber=<?= $_GET['contractNumber']; ?>&draft=0&arrayPosition=0";
          process();
        }

        function draft() {
          document.getElementById('formInput').action = "/JavascriptLibrarys/pell-master/processContract.php?contractNumber=<?= $_GET['contractNumber']; ?>&draft=1&arrayPosition=0";
          process();
        }

        function process() {
          var output = document.getElementById('html-output').innerHTML;
          document.getElementById('sendToDatabase').innerHTML = output;
          document.getElementById('send').click();
        }
      </script>


    </body>

    </html>




  <?php else : ?>
    You are not the owner of this contract.
  <?php endif; ?>
<?php else : ?>
  you are not logged in
<?php endif; ?>