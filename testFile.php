<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
<?php
    $array = [1,2,3,4];

    $sqlupdate = <<<EOD
    UPDATE `esignature`.`tags` 
    SET `tagName` = ? WHERE (`tagId` = ?);
    EOD;

    foreach($array as $key => $value){
        echo $key;
    }
    echo $sqlupdate;
?>