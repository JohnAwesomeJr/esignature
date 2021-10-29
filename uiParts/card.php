<?php
function makeCard($contents, $arguments = NULL, $color = 0)
{
    global $secondColor;

    echo "<div ";
    echo "id=card ";
    echo "style= " . '"';

    if ($color == 0) {
        echo "background: #FFFFFF; ";
    } else {
        echo "background:" . $secondColor . "; ";
    }
    echo "display: inline-block; ";
    echo "min-width: 200px; ";
    echo "max-width: 700px; ";
    // echo "width:100px; ";
    // echo "height:100px; ";
    echo "padding:30px; ";
    echo "margin:15px 30px; ";

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
