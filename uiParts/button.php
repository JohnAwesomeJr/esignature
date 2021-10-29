<?php
function button($contents, $arguments = NULL, $color = 0)
{
    global $secondColor;

    echo "<div ";
    echo "id=button ";
    echo "style= " . '"';

    if ($color == 0) {
        echo "background: #FFFFFF; ";
    } else {
        echo "background:" . $secondColor . "; ";
    }
    echo "display: inline-block; ";
    echo "min-width: 150px; ";
    echo "min-width: 50px; ";
    echo "height: 50px; ";
    echo "padding:15px; ";
    echo "margin:0px; ";
    echo "overflow: hidden; ";

    echo "display: flex; ";
    echo "flex-direction: row; ";
    echo "align-items: center; ";
    echo "justify-content: space-between; ";




    echo "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ";
    echo "border-radius: 15px; ";

    echo '"';
    echo '>';


    $isAFunction = function_exists($contents);
    if ($isAFunction) {
        $contents(...$arguments);
    } else {
        echo $contents;
    }
    echo "</div>";
}
