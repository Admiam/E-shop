<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <script src="https://kit.fontawesome.com/c1a76831d2.js" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="../../styles/main.css">-->
    <link rel="stylesheet" href="../../styles/reg.css">

    <title>Tea space 👾</title>
</head>

<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro prihlaseni/odhlaseni uzivatele ////////////////
///////////////////////////////////////////////////////////////////

// nacteni souboru s funkcemi
require_once("MyDatabase.class.php");
$myDB = new MyDatabase();

// zpracovani odeslanych formularu
if (isset($_POST['action'])) {
    // prihlaseni
    if ($_POST['action'] == 'login' && isset($_POST['login']) && isset($_POST['password'])) {
        // pokusim se prihlasit uzivatele
        $res = $myDB->userLogin($_POST['login'], $_POST['password']);
        if ($res) {
            echo "OK: User was successfully logged.";
        } else {
            echo "ERROR: Something went wrong";
        }
    } // odhlaseni
    else if ($_POST['action'] == 'logout') {
        // odhlasim uzivatele
        $myDB->userLogout();
        echo "OK: User was successfully logged out.";
    } // neznama akce
    else {
        echo "WARNING: Unknown action.";
    }
    echo "<br>";
}

// pokud je uzivatel prihlasen, tak ziskam jeho data
if ($myDB->isUserLogged()) {
    // ziskam data prihlasenoho uzivatele
    $user = $myDB->getLoggedUserData();
}

///////////// PRO NEPRIHLASENE UZIVATELE ///////////////
// pokud uzivatel neni prihlasen nebo nebyla ziskana jeho data, tak vypisu prihlasovaci formular
?>
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login">
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" class="login__input" placeholder="Login">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="login__input" placeholder="Password">
                </div>
                <button class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
            </form>
            <div class="social-login">
                <h3>log in via</h3>
                <div class="social-icons">
                    <a href="#" class="social-login__icon fab fa-instagram"></a>
                    <a href="#" class="social-login__icon fab fa-facebook"></a>
                    <a href="#" class="social-login__icon fab fa-twitter"></a>
                </div>
            </div>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>
</html>
