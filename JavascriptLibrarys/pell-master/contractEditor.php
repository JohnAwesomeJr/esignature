<?php require "/var/www/html/colors.php";
?>
<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="user-scalable=1.0,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">

  <title>pell</title>

  <link rel="stylesheet" type="text/css" href="dist/pell.css">

  <style>
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
  </style>

</head>

<body>

  <div class="content">
    <div id="editor" class="pell"></div>
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
    mybody.style.width = "100vw";
    mybody.style.height = "100vh";
    mybody.style.overflow = "hidden";
    mybody.style.background = "<?php $background; ?>";



    var myMenuBar = document.querySelector('.pell-actionbar').style;
    myMenuBar.position = "fixed";
    myMenuBar.padding = "10px";
    var barHeight = document.querySelector('.pell-actionbar').clientHeight;

    myMenuBar.top = "0px";
    myMenuBar.left = "0px";
    // myMenuBar.boxShadow = "10px 10px 10px black";
    myMenuBar.zIndex = "100";
    myMenuBar.width = "calc(100% - 60px)";
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

    pellEditor.height = "100vh";
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

    contentContainer.maxHeight = "100vh";
    contentContainer.height = "100vh";



    var contentArea = document.querySelector('.pell-content').style;

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
    contentArea.marginTop = barHeight + 20 + "px";


    contentArea.overflow = "auto";
    contentArea.background = "<?= $whiteColor; ?>";
    contentArea.width = "calc(100vw - 60px)";
    contentArea.height = "calc(100vh - 150px)";
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
  </script>

</body>

</html>