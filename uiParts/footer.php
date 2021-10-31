<?php

/**
 * add the footer
 *
 * @param string 
 * @param string 
 * @param string 
 * 
 * 
 */
function footer($button1 = NULL, $button2 = NULL, $button3 = NULL)
{; ?>

    <?php global $primaryColor; ?>
    <?php require "/var/www/html/uiParts/button.php"; ?>

    <style>
        #footer {
            display: inline-block;
            width: 100%;
            max-width: 500px;
            padding: 0px 15px 0px 15px;
            position: fixed;
            bottom: 0px;
            background: <?= $primaryColor; ?>;
            border-radius: 15px 15px 0px 0px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);



            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            justify-content: space-between;
        }

        #shadow {
            position: fixed;
            bottom: 0px;
            pointer-events: none;

            width: 100%;
            height: 100px;
            background: rgb(0, 0, 0);
            background: linear-gradient(0deg, rgba(0, 0, 0, 50%) 0%, rgba(0, 0, 0, 0) 100%);
        }
    </style>
    <?php
    function plusButtonShort()
    {
        button("/var/www/html/uiImages/plus.svg", "", 0, 1);
    }
    function plusButtonWide()
    {
        button("/var/www/html/uiImages/plus.svg", "", 0, 0);
    }
    function contractsButton()
    {
        button("Contracts", "", 0);
    }
    function nextButton()
    {
        button(" NEXT");
    }

    ?>

    <div id="shadow"></div>
    <div id="footer">
        <?php
        if ($button3 != NULL) {
            if (function_exists($button3)) {
                eval($button3 . "();");
            } else {
                echo "string not a button";
            }
        }
        if ($button2 != NULL) {
            if (function_exists($button2)) {
                eval($button2 . "();");
            } else {
                echo "string not a button";
            }
        }
        if ($button1 != NULL) {
            if (function_exists($button1)) {
                eval($button1 . "();");
            } else {
                echo "string not a button";
            }
        }
        ?>
    </div>

<?php }; ?>