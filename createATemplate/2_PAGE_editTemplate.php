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
    <?php require "/var/www/html/htmlStart.php"; ?>

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
    <?php if ($_SESSION['userId'] == $templateDbArray[0]['parentUser']) : ?>
        <!-- are you the owner of the template? -->


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

        <table style="position:absolute;">
            <thead>
                <tr>
                    <td>
                        <!-- --------------------------Content and title--------------------- -->
                        <div class="screen1">
                            <h2>contract info</h2>
                            <form class="customCard centerColumn" method="post" action="/createATemplate/3_DB_updateTemplate.php?templateNumber=<?= $templateId; ?>">
                                <div style="padding:10px; display:none;">
                                    <label for="templateId">Template ID</label>
                                    <br>
                                    <input readonly name="templateId" type="text" value="<?= $templateId; ?>">
                                    <br>
                                </div>

                                <div class="stage1 centerRow">
                                    <label for="templateName">Template Name</label>
                                    <br>
                                    <input name="templateName" type="text" value="<?= $templateName; ?>">
                                    <br>
                                    <div onclick="contentscreen()" class="button" style=" padding: 12px 40px;">Edit Content</div>
                                </div>


                                <div style="padding:10px; display:none;">
                                    <label for="parentUser">Parent User</label>
                                    <br>
                                    <input readonly name="parentUser" type="text" value="<?= $parentUser; ?>">
                                    <br>
                                </div>

                                <div class="stage2" style="padding:10px;">
                                    <label for="templateContent" style="display:none;">Template Content</label>
                                    <br>
                                    <textarea style="display:none;" id="html-output" name="templateContent" type="text" placeholder="<?= $placeholder; ?>"><?= $templateContent; ?></textarea>
                                    <br>
                                    <!-- ---------------Pell---------------- -->
                                    <div class="content">
                                        <div id="editor" class="pell"></div>
                                    </div>
                                    <!-- ---------------Pell---------------- -->

                                    <div onclick="titleScreen()" class="button" style=" padding: 12px 40px;">Edit title</div>
                                    <br>
                                </div>
                                <input type="submit" value="Process All">

                            </form>
                            <div class="centerRow customCard">
                                <div onclick="showTitles()" class="button" style=" padding: 12px 40px;">show tags</div>
                                <div onclick="showTags()" class="button" style=" padding: 12px 40px;">Show Titles</div>
                            </div>
                        </div>
                        <!-- --------------------------Content and title--------------------- -->

                    </td>


                    <td>
                        <!-- --------------------------TITLES--------------------- -->
                        <div class="screen2">
                            <h2>insert tags</h2>
                            <?php
                            $db = new db();
                            $selectTitlesSql = <<<EOD
                                SELECT * FROM esignature.titles
                                WHERE parentTemplate = ?;
                                EOD;
                            $titleListArray = $db->selectSql($selectTitlesSql, [$templateId]);
                            ?>

                            <h4>Add Title</h4>
                            <input id="titleInput"></input>
                            <button onclick="addNewTitle()">Add</button>
                            <h4>Title List</h4>

                            <div class="list">
                            </div>
                            <!-- --------------------------TITLES--------------------- -->

                    </td>
                    <td>
                        <!-- --------------------------TAGS--------------------- -->
                        <div class="screen3">
                            <h2>insert tags</h2>
                            <div class="list">

                                <?php
                                $db = new db();
                                $selectTagsQuery = <<<EOD
                                SELECT * FROM esignature.tags
                                WHERE parentTemplate = ?;
                                EOD;
                                $tagListArray = $db->selectSql($selectTagsQuery, [$templateId]);
                                ?>

                                <h4>Add Tags</h4>
                                <input id="tagInput"></input>
                                <button onclick="addNewTag()">Add</button>
                                <h4>Tag List</h4>

                            </div>
                        </div>
                        <!-- --------------------------TAGS--------------------- -->

                    </td>
                </tr>
            </thead>
        </table>







        <!-- ---------------Pell---------------- -->
        <script>
            const el = document.getElementById('editor');
        </script>

        <link rel="stylesheet" type="text/css" href="/JavascriptLibrarys/pell-master/dist/pell.css">


        <div class="outputs">
            <h1>pell</h1>
            <div style="margin-top:20px;">
                <h3>Text output:</h3>
                <div id="text-output"></div>
            </div>
        </div>


        <script src="/JavascriptLibrarys/pell-master/dist/pell.js"></script>
        <script>
            document.querySelectorAll('.outputs')[0].style.display = "none";
        </script>

        <script>
            var editor = window.pell.init({
                element: document.getElementById('editor'),
                defaultParagraphSeparator: 'p',
                onChange: function(html) {
                    document.getElementById('text-output').innerHTML = html
                    document.getElementById('html-output').textContent = html
                }
            })
            document.querySelector('.pell-content').innerHTML = "<?= $templateContent; ?>";
        </script>
        <!-- ---------------Pell---------------- -->

        <script>
            // convert tags array to be used with javascript
            var tagsArray = <?= json_encode($tagListArray); ?>;
            // convert tags array to be used with javascript

            // convert titles array to be used with javascript
            var titlessArray = <?= json_encode($titleListArray); ?>;
            // convert titles array to be used with javascript
        </script>
        <script src="/createATemplate/listManipulation.js"></script>














    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>