<?php
function button($contents, $arguments = NULL, $color = 0)
{
    global $secondColor;
    global $whiteColor;
    global $blackColor;


    echo "<div ";
    echo "id=button ";
    echo "style= " . '"';

    if ($color == 0) {
        echo "background: #FFFFFF; ";
    } else {
        echo "background:" . $secondColor . "; ";
        echo "color:white; ";
    }
    echo "display: inline-block; ";
    echo "position:relative; ";
    echo "min-width: 50px; ";
    echo "max-width: 150px; ";
    echo "height: 50px; ";
    echo "padding:15px; ";
    echo "margin-left: 7px; ";
    echo "margin-right: 7px; ";
    echo "bottom: 15px; ";




    echo "margin:0px; ";
    echo "overflow: hidden; ";

    echo "display: flex; ";
    echo "flex-direction: row; ";
    echo "align-items: center; ";
    echo "justify-content: center; ";




    echo "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ";
    echo "border-radius: 15px; ";

    echo '"';
    echo '>';


    $isAFunction = function_exists($contents);
    if ($isAFunction) {
        $contents(...$arguments);
    } else {
        if (file_exists($contents)) {
            echo file_get_contents($contents);
        } else {
            echo $contents;
        }
    }
    echo "</div>";
}
