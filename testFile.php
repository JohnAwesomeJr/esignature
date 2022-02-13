<?php
            $sqlupdate = <<<EOD
            UPDATE `esignature`.`tags` 
            SET `tagName` = ? WHERE (`tagId` = ?);
            EOD;
            
            echo $sqlupdate;
            ?>