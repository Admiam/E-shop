<?php

require("../components/head.php");
$createHead = new \components\head();
$createHead->createHead();

require_once("MyDatabase.class.php");
$myDB = new MyDatabase();
if ($_POST['action'] == 'logout') {
    // odhlasim uzivatele
    $myDB->userLogout();
}
?>
<html>
<body>
<section class="screen d-flex flex-column bg-green">
    <header class="" id="header">
        <?php
        require("../components/header.php");
        $createHeader = new \components\header();
        $createHeader->getHeader();
        ?>
    </header>
    <h1 class="title">O nás</h1>
</section>
<?php
require("../components/footer.php");
$getFooter = new \components\footer();
$getFooter->getFooter();
?>
</body>
</html>