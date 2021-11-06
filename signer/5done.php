<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<h1>All done!</h1>
<?php if ($_GET['email'] == "no") : ?>
    <p>We will send you an email with a copy of the contract once everyone signs.</p>
<?php else : ?>
    <p>please download the pdf copy of the signed contract</p>
    <?php
    $filePath = '/var/www/html' . urldecode($_GET['downloadLink']);
    chmod($filePath, 0777);
    ?>
    <a href="<?= "" . urldecode($_GET['downloadLink']); ?>" download>
        DOWNLOAD PDF CONTRACT
    </a>
<?php endif; ?>