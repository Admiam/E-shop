<head>
<?php

require("components/head.php");
$createHead = new \components\head();
$createHead->createHead();

global $tplData;

?>
</head>
<html>
<body>
<section class="screen d-flex flex-column bg-green">


    <header class="" id="header">
        <?php
        require("components/header.php");
        $createHeader = new \components\header();
        $createHeader->getHeader();
        ?>
    </header>
    <div class="d-flex flex-column flex-grow-1 justify-content-center align-items-center main-center other">
        <h1 class="title">Zapomeňte na kávu a objevte vesmír čajů!</h1>
        <img src="../../assets/main.png" alt="main background image " class="main-img">
    </div>
    <div class="position-relative d-flex justify-content-center align-items-center other">
        <svg width="100%" height="50">
            <rect ry="200" width="100%" height="100" style="fill:rgb(250,250,250);"/>
            Sorry, your browser does not support SVG.
        </svg>
        <div class="d-flex flex-column align-items-center position-absolute">
            <h2 class="main-bottom-font">Vyber si svůj</h2>
            <i class="fa-solid fa-caret-down main-bottom-icon"></i>
        </div>
    </div>
</section>
<section class="main-bg-white pt-5 other">

</section>
<?php
require("components/footer.php");
$getFooter = new \components\footer();
$getFooter->getFooter();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="views/js/menu.js"></script>
<script>
    $(window).scroll(function () {
        if ($(document).scrollTop() > 50) {
            $('.nav').addClass('affix');
            console.log("OK");
        } else {
            $('.nav').removeClass('affix');
        }
    });
</script>
</body>

</html>
