<?php ob_start(); ?>
<?php
require "/var/www/html/classes/db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php session_start(); ?>
<!-- are you logged in? -->
<?php if ($_SESSION) : ?>
    <!-- are you the owner of the template? -->
    <script src="/node_modules/insert-text-at-cursor/dist/index.umd.js"></script>
    <?php
    $templateId = $_GET['templateNumber'];








    $sql = <<<EOD
    SELECT * FROM esignature.template
    WHERE templateId = ?;
    EOD;


    $pdo = new PDO('mysql:host=localhost;dbname=esignature', $mysqlUser, $mysqlPassword);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$templateId]);
    $templateDbArray = $stmt->fetchAll();



    ?>
    <fieldset>
        <legend>
            <h3>template Info</h3>
        </legend>

        <pre> <?php print_r($templateDbArray); ?> </pre>
    </fieldset>

    <?php if ($_SESSION['userId'] == $templateDbArray[0]['parentUser']) : ?>

        <?php
        $templateId = $templateDbArray[0]['templateId'];
        $templateName = $templateDbArray[0]['templateName'];
        $templateContent = $templateDbArray[0]['templateContent'];
        $parentUser = $templateDbArray[0]['parentUser'];

        if ($templateName == "") {
            $templateName = "New Template";
        }

        if ($templateContent == "") {
            $placeholder = "Wright your contract here";
        }
        ?>








        You are the owner and are qualified to modify this contract

        <style>
            td {
                border: black solid 1px;
                padding: 30px;
            }
        </style>

        <table>
            <thead>
                <tr>
                    <td>
                        <h2>contract info</h2>
                        <form method="post" action="/createATemplate/3_DB_updateTemplate.php">
                            <label for="templateId">Template ID</label>
                            <br>
                            <input name="templateId" type="text" value="<?= $templateId; ?>">
                            <br>

                            <label for="templateName">Template Name</label>
                            <br>
                            <input name="templateName" type="text" value="<?= $templateName; ?>">
                            <br>

                            <label for="parentUser">Parent User</label>
                            <br>
                            <input name="parentUser" type="text" value="<?= $parentUser; ?>">
                            <br>

                            <label for="templateContent">Template Content</label>
                            <br>
                            <textarea id="contentArea" name="templateContent" type="text" placeholder="<?= $placeholder; ?>"><?= $templateContent; ?></textarea>
                            <br>

                            <input type="submit">
                        </form>
                    </td>
                    <td>
                        <h2>insert titles</h2>
                        <?php
                        $db = new db();
                        $selectTitlesSql = <<<EOD
                        SELECT * FROM esignature.titles
                        WHERE parentTemplate = ?;
                        EOD;

                        $titleListArray = $db->selectSql($selectTitlesSql, [$templateId]);

                        echo "<fieldset>";
                        echo "<pre>";
                        print_r($titleListArray);
                        echo "</pre>";
                        echo "</fieldset>";


                        foreach ($titleListArray as $key => $value) {
                            $tag = "{[ " . $titleListArray[$key]['titleName'] . " ]}";
                            echo "<button onclick=\" insertTextAtCursor(el, '{$tag}')\">Insert Title Name</button>";
                            echo "{[ " . $titleListArray[$key]['titleName'] . " ]}" . "<br>";
                        }
                        ?>
                        <form method="post" action="/createATemplate/2a_DB_addNewTitle.php?templateNumber=<?= $templateId; ?>">
                            <input type="text" name="newTitleName">
                            <br>
                            <input type="submit" value="Add New Title">
                        </form>
                    </td>
                    <td>
                        <h2>insert tags</h2>
                        <?php
                        $db = new db();
                        $selectTagsQuery = <<<EOD
                        SELECT * FROM esignature.tags
                        WHERE parentTemplate = ?;
                        EOD;

                        $tagListArray = $db->selectSql($selectTagsQuery, [$templateId]);

                        echo "<fieldset>";
                        echo "<pre>";
                        print_r($tagListArray);
                        echo "</pre>";
                        echo "</fieldset>";


                        foreach ($tagListArray as $key => $value) {
                            $tag = "{[ " . $tagListArray[$key]['tagName'] . " ]}";
                            echo "<button onclick=\" insertTextAtCursor(el, '{$tag}')\">Insert Tag</button>";
                            echo "{[ " . $tagListArray[$key]['tagName'] . " ]}" . "<br>";
                        }
                        ?>
                    </td>
                </tr>
            </thead>
        </table>

        <script>
            const el = document.getElementById('contentArea');
        </script>











    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>