<?php require "/{$rootD}/colors.php"; ?>
<?php require "/{$rootD}/uiParts/card.php"; ?>
<?php require "/{$rootD}/htmlStart.php"; ?>

<head>
    <link rel="stylesheet" href="signature-pad.css">
    <script type="text/javascript" async="" src="app.js"></script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-39365077-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</head>
<style>
    #container {
        width: 100vw;
        height: 100vh;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #spacer {
        width: 200px;
        height: 70px;
        /* background: red; */
    }

    #rotateScreen {
        position: fixed;
        width: 100vw;
        height: calc(100vh - 70px);
        background: <?= $background; ?>;

        display: flex;

        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #signPrompt {
        position: relative;
        pointer-events: none;
        width: 100%;
        height: 100%;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #grayLine {
        width: calc(100% - 50px);
        height: 3px;
        background: hsla(0, 0%, 0%, 0.21);
        margin: 30px;
        pointer-events: none;

    }

    #fade {
        opacity: 20%;
        transition: all 1s;

    }

    @media screen and (orientation:landscape) {
        #rotateScreen {
            display: none;
        }
    }
</style>


<body>

    <!-- start of the base container -->
    <?php require "/{$rootD}/uiParts/baseContainer.php"; ?>



    <div id="bodyCentering">
        <div id="container">
            <div id="signature-pad" class="signature-pad">
                <div class="signature-pad--body">
                    <canvas style="touch-action: none;" width="1328" height="738"></canvas>
                    <div id="signPrompt">
                        <div id="fade">
                            <?php require "/{$rootD}/uiImages/signPromptIcon.svg"; ?>
                        </div>
                        <div id="grayLine"></div>
                    </div>
                </div>
                <div class="signature-pad--actions">
                    <div>
                        <button style="display:none;" type="button" class="button clear" data-action="clear">Reset</button>
                        <button style="display:none;" type="button" class="button" data-action="change-color">Change color</button>
                        <button style="display:none;" type="button" class="button" data-action="undo">Undo</button>
                        <button style="display:none;" type="button" class="button save" data-action="save-png">Save as PNG</button>
                        <button style="display:none;" type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                        <button style="display:none;" type="button" class="button save" data-action="save-svg">Save as SVG</button>
                        <button style="display:none;" type="button" id="base64id" class="button save" data-action="conBase64">JJ's
                            base64</button>
                    </div>
                </div>

            </div>
            <div id="spacer">

            </div>
        </div>

        <?php $urlPath = "upload.php?" . "contractNumber=" . $_GET['contractNumber'] . "&" . "contractSigner=" . $_GET['contractSigner']; ?>
        <form action="<?= $urlPath; ?>" method="post">
            <textarea style="display:none;" id="myTest" name="base64Data"></textarea>
            <input style="display:none;" id="submitSvg" type="submit">
        </form>
        <div style="display:none;" id="clickRed" onclick="startLoading()" style="background:red; padding:10px;">Click!</div>


        <div id="rotateScreen">
            <div>Please rotate your device.</div>
            <?php require "/{$rootD}/uiImages/rotateIcon.svg"; ?>
        </div>
        <!-- Add the footer -->
        <?php
        require "/{$rootD}/uiParts/footer.php";
        $allButtons = [
            //$button1 = ["templatesButton", "http://www.google.com"],
            //$button2 = ["contractsButton", "http://www.google.com"],
            $button3 = ["nextButtonOrangeJavascript", ""]
        ];
        footer(...$allButtons);
        ?>
        <script src="signature_pad.js"></script>
        <script src="app.js"></script>
        <script>
            function finalClick() {
                document.getElementById('base64id').click();
                var button = document.getElementById("myTest").innerHTML;
                if (button != "") {
                    document.getElementById('submitSvg').click();
                }
            }

            function clickRed() {
                document.getElementById('clickRed').click();
            }
        </script>



    </div>





    <!-- end of the base container -->
    </div>

    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        #screen {
            position: fixed;
            background: <?= $background; ?>;
            width: 100vw;
            height: 100vh;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>


    <div id="screen">
        <?php require "/{$rootD}/uiImages/loading/loading.php"; ?>
    </div>

    <script>
        const screen = document.getElementById('screen').style;
        screen.display = "none";

        function startLoading() {
            screen.display = "flex";
            finalClick();
        }



        // setTimeout(() => {
        //     location.reload();
        //     alert("done");
        // }, 1000);
        window.onresize = function() {
            location.reload();

        };
    </script>



</body>