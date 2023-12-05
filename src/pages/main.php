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


    <header class="d-flex header flex-row justify-content-between pt-4 px-4 bg-light-green" id="header">

        <img src="../../assets/logo-g.svg" alt="T space logo">
        <div class="nav" id="mainListDiv">
            <div class="dropdown nav-text">
                <button class="dropbtn all-full">Kategorie</button>
                <div class="dropdown-content w-full">
                    <a href="#" class="nav-el">Bílý čaje</a>
                    <a href="#" class="nav-el">Bylinné čaje</a>
                    <a href="#" class="nav-el">Černé čaje</a>
                    <a href="#" class="nav-el">Ovocné čaje</a>
                    <a href="#" class="nav-el">Zelené čaje</a>
                </div>
            </div>
            <div class="dropdown nav-text">
                <button class="dropbtn all-full">O nás</button>
            </div>
            <div class="dropdown nav-text">
                <button class="dropbtn all-full">Kontakt</button>
            </div>
        </div>
        <div>
            <a href="#" class="mr-4"><i class="fa-solid fa-basket-shopping nav-icons mx-4"></i></a>
            <form action="" method="POST">
                <input type="hidden" name="action" value="logout" class=" all-full">
                <input type="submit" name="potvrzeni" value="Odhlásit" class=" all-full">
            </form>
            <?php
            require_once("MyDatabase.class.php");
            $myDB = new MyDatabase();
            echo $_SESSION['current_user_id'];
            if ($myDB->isUserLogged()) {

                ?>
                <a href="index.php?page=account"><i class="fa-solid fa-user nav-icons"></i></a>

                <?php
            } else {
                ?>
                <a href="index.php?page=login" class="nav-text">Login</a>
                <?php
            }
            ?>
        </div>
        <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
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
    <div>
        <?php
        require("../components/teaSlider.php");
        $createSlider = new \components\teaSlider();
        $createSlider->getTeaSlider();
        ?>
    </div>
</section>
<?php
require("../components/footer.php");
$getFooter = new \components\footer();
$getFooter->getFooter();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../js/menu.js"></script>
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
