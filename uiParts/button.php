<style>
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
    }
</style>
<?php
/**
 * Inserts a button
 *
 * @param function or string  $contents can be a function or a string. This is waht will be insid the button.
 * @param array $arguments if the first argument happens to be a function: 
 * Must be an array of all of the arguments. 
 * If you are NOT passing a function, than this can be a blank string. (eg "").
 * @param integer $color 0 or 1... (0 = white button) (1 = secondariy color button).
 * @param integer $buttonSize 0 or 1... (0 = button size 100px) (1 = button size 50px).
 * 
 */
function button($contents, $arguments = NULL, $color = 0, $buttonSize = NULL)
{
    global $secondColor;
    global $whiteColor;
    global $blackColor;


    echo "<div ";
    echo "class=button ";
    echo "style= " . '"';

    if ($color == 0) {
        echo "background: #FFFFFF; ";
    } else {
        echo "background:" . $secondColor . "; ";
        echo "color:white; ";
    }
    if ($buttonSize != NULL) {
        $buttonSize = 50;
    } else {
        $buttonSize = 100;
    }
    echo "min-width: " . $buttonSize . "px; ";
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
