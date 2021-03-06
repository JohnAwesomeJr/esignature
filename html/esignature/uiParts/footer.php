<?php

/**
 * add the footer
 * all 3 arguments are arrays
 * 
 * each array has 2 elements
 * 1 is a string that has the button name
 * 2 is a string that has a link url
 * 
 * Button strings
 * 
 * plusButtonShort
 * plusButtonWide
 * 
 * contractsButton
 * templatesButton
 * 
 * nextButtonWhite
 * nextButtonOrange
 * 
 * saveButton
 * doneButton
 * skipButton
 * draftButton
 * sendButton
 * homeButton
 *
 * @param array 
 * @param array 
 * @param array 
 * 
 * 
 */
require "/{$rootD}/uiParts/button.php";
function footer($button1 = NULL, $button2 = NULL, $button3 = NULL)
{; ?>

    <?php global $primaryColor; ?>

    <?php
    function plusButtonShort($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button("/{$GLOBALS['rootD']}/uiImages/plus.svg", "", 0, 1);
        echo "</a>";
    }
    function plusButtonWide($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button("/{$GLOBALS['rootD']}/uiImages/plus.svg", "", 0, 0);
        echo "</a>";
    }
    function contractsButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button("Contracts", "", 0);
        echo "</a>";
    }
    function templatesButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button("Templates", "", 0);
        echo "</a>";
    }
    function nextButtonWhite($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" NEXT");
        echo "</a>";
    }
    function nextButtonOrange($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" NEXT", "", 1, NULL);
        echo "</a>";
    }
    function nextButtonOrangeJavascript()
    {
        echo "<div ";
        echo "onclick=" . "'" . "clickRed()" . "'";
        echo ">";
        button(" NEXT", "", 1, NULL);
        echo "</div>";
    }
    function saveButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" SAVE", "", 1, NULL);
        echo "</a>";
    }
    function doneButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" DONE", "", 1, NULL);
        echo "</a>";
    }
    function skipButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" SKIP", "", 1, NULL);
        echo "</a>";
    }
    function draftButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" DRAFT", "", 1, NULL);
        echo "</a>";
    }
    function sendButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" SEND", "", 1, NULL);
        echo "</a>";
    }
    function homeButton($link)
    {
        echo "<a ";
        echo "href=" . "'";
        echo $link;
        echo "' ";
        echo ">";
        button(" HOME", "", 1, NULL);
        echo "</a>";
    }

    ?>

    <div id="shadow"></div>
    <div id="footer">
        <?php
        if ($button3 != NULL) {
            if (function_exists($button3[0])) {
                eval($button3[0] . "('" . strval($button3[1]) . "');");
            } else {
                echo "string not a button";
            }
        }
        if ($button2 != NULL) {
            if (function_exists($button2[0])) {
                eval($button2[0] . "('" . strval($button2[1]) . "');");
            } else {
                echo "string not a button";
            }
        }
        if ($button1 != NULL) {
            if (function_exists($button1[0])) {
                eval($button1[0] . "('" . strval($button1[1]) . "');");
            } else {
                echo "string not a button";
            }
        }
        ?>
    </div>

<?php }; ?>