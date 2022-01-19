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
    <style>
        .jasonHolder {
            display: none;
        }
    </style>

    <link rel="stylesheet" href="/newStyles.css">


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

        <form class="demoBorder flexColumn xFlexCenter yFlexTop" style="width:100vw; height:100vh; overflow-x: hidden; overflow-y: scroll;" method="post" action="/createATemplate/3_DB_updateTemplate.php?templateNumber=<?= $templateId; ?>">













            <!-- --------------------------Content and title--------------------- -->
            <div class="screen1 demoBorder" style="width:100%; max-width:700px;">
                <h2>contract info</h2>
                <div style="padding:10px; display:none;">
                    <label for="templateId">Template ID</label>
                    <br>
                    <input readonly name="templateId" type="text" value="<?= $templateId; ?>">
                    <br>
                </div>

                <div class="stage1 centerRow">
                    <label for="templateName">Template Name</label>
                    <input name="templateName" type="text" value="<?= $templateName; ?>">
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

                </div>
            </div>
            <!-- --------------------------Content and title--------------------- -->












            <!-- --------------------------TITLES--------------------- -->
            <div class="screen2 demoBorder flexColumn xFlexCenter yFlexTop">
                <h2>insert Titles</h2>
                <?php
                $db = new db();
                $selectTitlesSql = <<<EOD
                SELECT * FROM esignature.titles
                WHERE parentTemplate = ?;
                EOD;
                $titleListArray = $db->selectSql($selectTitlesSql, [$templateId]);
                ?>

                <div class="shadow flexColumn xFlexCenter yFlexTop" style="width:100%;max-width:400px; padding:30px; border-radius: 15px;">
                    <h4>Add New Title</h4>
                    <div class="flexRow yFlexCenter xFlexCenter">
                        <input style="margin:0px; max-width:300px; margin:5px;" class="shadow" id="titleInput"></input>
                        <div class=" shadow flexColumn xFlexCenter yFlexCenter" style="width:100px; border-radius:15px; height:50px; width:100px; margin:5px;" onclick="addNewTitle()">Add</div>
                    </div>
                </div>
                <h4>Title List</h4>

                <div class="list flexColumn xFlexCenter yFlexTop">
                </div>
            </div>

            <!-- --------------------------TITLES--------------------- -->

















            <!-- --------------------------TAGS--------------------- -->
            <div class="screen3 demoBorder flexColumn xFlexCenter yFlexTop">
                <h2>insert tags</h2>

                <?php
                $db = new db();
                $selectTagsQuery = <<<EOD
                SELECT * FROM esignature.tags
                WHERE parentTemplate = ?;
                EOD;
                $tagListArray = $db->selectSql($selectTagsQuery, [$templateId]);
                ?>

                <div class="shadow flexColumn xFlexCenter yFlexTop" style="width:100%;max-width:400px; padding:30px; border-radius: 15px;">
                    <h4>Add New Tag</h4>
                    <div class="flexRow yFlexCenter xFlexCenter">
                        <input style="margin:0px; max-width:300px; margin:5px;" class="shadow" id="tagInput"></input>
                        <div class=" shadow flexColumn xFlexCenter yFlexCenter" style="width:100px; border-radius:15px; height:50px; width:100px; margin:5px;" onclick="addNewTag()">Add</div>
                    </div>
                </div>
                <h4>Tag List</h4>

                <div class="list flexColumn xFlexCenter yFlexTop">
                </div>
            </div>
            <!-- --------------------------TAGS--------------------- -->










            <input type="submit" value="Process All">










        </form>







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