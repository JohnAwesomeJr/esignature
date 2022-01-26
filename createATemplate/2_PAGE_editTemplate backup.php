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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>





    <!-- --------------------------Rangy-------------------------------------------------------------------------- -->
    <script type="text/javascript" src="/node_modules/rangy/lib/rangy-core.js"></script>
    <script type="text/javascript" src="/node_modules/rangy/lib/rangy-selectionsaverestore.js"></script>
    <script type="text/javascript">
        function gEBI(id) {
            return document.getElementById(id);
        }

        var savedSel = null;
        var savedSelActiveElement = null;

        function saveSelection() {
            // Remove markers for previously saved selection
            if (savedSel) {
                rangy.removeMarkers(savedSel);
            }
            savedSel = rangy.saveSelection();
            savedSelActiveElement = document.activeElement;
            gEBI("restoreButton").disabled = false;
        }

        function restoreSelection() {
            if (savedSel) {
                rangy.restoreSelection(savedSel, true);
                savedSel = null;
                gEBI("restoreButton").disabled = true;
                window.setTimeout(function() {
                    if (savedSelActiveElement && typeof savedSelActiveElement.focus != "undefined") {
                        savedSelActiveElement.focus();
                    }
                }, 1);
            }
        }

        window.onload = function() {
            // Turn multiple selections on in IE
            try {
                document.execCommand("MultipleSelection", null, true);
            } catch (ex) {}

            rangy.init();

            // Enable buttons
            var saveRestoreModule = rangy.modules.SaveRestore;
            if (rangy.supported && saveRestoreModule && saveRestoreModule.supported) {
                var saveButton = gEBI("saveButton");
                saveButton.disabled = false;
                saveButton.ontouchstart = saveButton.onmousedown = function() {
                    saveSelection();
                    return false;
                };

                var restoreButton = gEBI("restoreButton");
                restoreButton.ontouchstart = restoreButton.onmousedown = function() {
                    restoreSelection();
                    return false;
                };

                // Display the control range element in IE
                if (rangy.features.implementsControlRange) {
                    gEBI("controlRange").style.display = "block";
                }
            }
        }
    </script>
    <!-- --------------------------Rangy-------------------------------------------------------------------------- -->





    <?php
    $templateId = $_GET['templateNumber'];


    // Stage status
    if (empty($_GET['stage'])) {
        $stage = 1;
    } else {
        $stage = $_GET['stage'];
    }

    echo "<br>" . "Stage Number: " . $stage . "<br>";
    // Stage status




    // screen selection
    if (empty($_GET['screen'])) {
        $screen = 1;
    } else {
        $screen = $_GET['screen'];
    }

    echo "<br>" . "Screen Number: " . $screen . "<br>";
    // screen selection










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
                                <input type="submit">

                            </form>
                            <div class="centerRow customCard">
                                <div onclick="showTitles()" class="button" style=" padding: 12px 40px;">show tags</div>
                                <div onclick="showTags()" class="button" style=" padding: 12px 40px;">Show Titles</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="screen2">
                            <h2>insert titles</h2>
                            <form method="post" action="/createATemplate/2a_DB_addNewTitle.php?templateNumber=<?= $templateId; ?>">
                                <input type="text" name="newTitleName">
                                <br>
                                <input type="submit" value="Add New Title">
                            </form>
                            <?php
                            $db = new db();
                            $selectTitlesSql = <<<EOD
                            SELECT * FROM esignature.titles
                            WHERE parentTemplate = ?;
                            EOD;

                            $titleListArray = $db->selectSql($selectTitlesSql, [$templateId]);


                            foreach ($titleListArray as $key => $value) {
                                $tag = " {[ " . $titleListArray[$key]['titleName'] . " ]} ";
                                echo "<div style=\"border:solid black 1px; padding: 5px; \">";
                                echo "<button onclick=\" insertTextAtCursor(el, '{$tag}')\">Insert Title Name</button>";
                                echo "{[ " . $titleListArray[$key]['titleName'] . " ]}" . "<br>";
                                echo "</div>";
                            }
                            ?>
                            <div class="centerRow">
                                <div onclick="goToMain()" class="button" style=" padding: 12px 40px;">Back</div>
                                <div onclick="showTags()" class="button" style=" padding: 12px 40px;">show tags</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="screen3">
                            <h2>insert tags</h2>
                            <form method="post" action="/createATemplate/2b_DB_addNewTag.php?templateNumber=<?= $templateId; ?>">
                                <input type="text" name="newTagName">
                                <br>
                                <input type="submit" value="Add New Tag">
                            </form>
                            <?php
                            $db = new db();
                            $selectTagsQuery = <<<EOD
                        SELECT * FROM esignature.tags
                        WHERE parentTemplate = ?;
                        EOD;

                            $tagListArray = $db->selectSql($selectTagsQuery, [$templateId]);


                            foreach ($tagListArray as $key => $value) {
                                $tag = " {[ " . $tagListArray[$key]['tagName'] . " ]} ";

                                echo "<div style=\"border:solid black 1px; padding: 5px; \">";
                                echo "<button onclick=\" insertTextAtCursor(el, '{$tag}')\">Insert Tag</button>";
                                echo "{[ " . $tagListArray[$key]['tagName'] . " ]}" . "<br>";
                                echo "</div>";
                            }
                            ?>
                            <div class="centerRow">
                                <div onclick="goToMain()" class="button" style=" padding: 12px 40px;">Back</div>
                                <div onclick="showTags()" class="button" style=" padding: 12px 40px;">show tags</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>

        <script>
            const el = document.getElementById('editor');
        </script>

        <!-- ---------------Pell---------------- -->
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


        <!-- Stage hiding -->
        <script>
            var stage = <?= $stage; ?>;
            document.querySelectorAll('.stage1')[0].style.display = "none";
            document.querySelectorAll('.stage2')[0].style.display = "none";

            console.log("stage number: " + stage);

            var classLoop = document.querySelectorAll('.stage<?= $stage; ?>');
            var itemsInLoop = classLoop.length;


            for (i = 0; i < itemsInLoop; i++) {
                console.log(i);
                var key = i;
                classLoop[key].style.display = "block";
            }

            console.log("length: " + classLoop.length);
        </script>
        <!-- Stage hiding -->




        <!-- Screen hiding -->
        <script>
            var Screen = <?= $screen; ?>;
            document.querySelectorAll('.screen1')[0].style.display = "none";
            document.querySelectorAll('.screen2')[0].style.display = "none";
            document.querySelectorAll('.screen3')[0].style.display = "none";







            var classLoop = document.querySelectorAll('.screen<?= $screen; ?>');
            var itemsInLoop = classLoop.length;


            for (i = 0; i < itemsInLoop; i++) {
                console.log(i);
                var key = i;
                classLoop[key].style.display = "block";
            }

            console.log("length: " + classLoop.length);
        </script>
        <!-- Screen hiding -->


        <script>
            function showTags() {
                document.querySelectorAll('.screen1')[0].style.display = "none";
                document.querySelectorAll('.screen2')[0].style.display = "block";
                document.querySelectorAll('.screen3')[0].style.display = "none";
            }

            function goToMain() {
                document.querySelectorAll('.screen1')[0].style.display = "block";
                document.querySelectorAll('.screen2')[0].style.display = "none";
                document.querySelectorAll('.screen3')[0].style.display = "none";
            }

            function showTitles() {
                document.querySelectorAll('.screen1')[0].style.display = "none";
                document.querySelectorAll('.screen2')[0].style.display = "none";
                document.querySelectorAll('.screen3')[0].style.display = "block";
            }




            function titleScreen() {
                document.querySelectorAll('.stage1')[0].style.display = "flex";
                document.querySelectorAll('.stage2')[0].style.display = "none";

            }

            function contentscreen() {
                document.querySelectorAll('.stage1')[0].style.display = "none";
                document.querySelectorAll('.stage2')[0].style.display = "block";

            }
        </script>











        <script src="/createATemplate/range_selection_save_restore.js"></script>








    <?php else : ?>
        You are not the owner of this contract.
    <?php endif; ?>
<?php else : ?>
    you are not logged in
<?php endif; ?>




<?php ob_end_flush(); ?>