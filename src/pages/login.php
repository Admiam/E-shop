<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <script src="https://kit.fontawesome.com/c1a76831d2.js" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="../../styles/main.css">-->
    <link rel="stylesheet" href="../../styles/forms.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
    switch ($_POST['action']) {
        case 'login':
            if (isset($_POST['login']) && isset($_POST['password'])) {
                // pokusim se prihlasit uzivatele
                $res = $myDB->userLogin($_POST['login'], $_POST['password']);
                if ($res) {
                    echo "<script>
                // This will log a message to the console when the script is executed
                console.log('User was logged! Good job');

                //        \$(\"#brand\").addClass(\"active\");

                </script>";
                    header("Location: index.php?page=main");
                    exit;
                } else {
                    echo "<script>console.log('ERROR: User was not logged');</script>";
                }
            }
            break;
        case 'register':
//            var_dump($_POST);
            echo "Ahoj";
            if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['phone'])
                && isset($_POST['password']) && isset($_POST['password2'])
                && isset($_POST['login']) && isset($_POST['address'])
                && isset($_POST['postal_code']) && isset($_POST['country']) && isset($_POST['city'])
            ) {
                echo "Ahoj2";
                // pozn.: heslo by melo byt sifrovano
                // napr. password_hash($password, PASSWORD_BCRYPT) pro sifrovani
                // a password_verify($password, $hash) pro kontrolu hesla.

                // mam vsechny atributy - ulozim uzivatele do DB
                $res = $myDB->addNewUser($_POST['login'], $_POST['password'], $_POST['full_name'], $_POST['email'], 4, intval($_POST['phone']), intval($_POST['postal_code']), $_POST['address'], $_POST['country'], $_POST['city']);
                echo "Ahoj3";
                // byl ulozen?
                if ($res === false) $kokot = "kokot";
                echo $kokot;
                if ($res) {
                    echo "<script>console.log('User was logged! Good job');</script>";
                    header("Location: index.php?page=main");
                    exit;

                } else {
                    echo "<script>console.log('ERROR: User was not logged');</script>";
                }
            } else {
                // nemam vsechny atributy
                echo "<script>console.log('ERROR: Not all data');</script>";
            }
    }
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


    <section id="formHolder">

        <div class="row">

            <!--             Brand Box -->
            <div class="col-sm-6 brand" id="brand">
                <a href="index.php?page=main" class="logo"> <img src="../../assets/logo-w.png" alt="T space logo"></a>

                <div class="heading title">
                    <h2>T-space</h2>
                    <p>Vášeň z každého doušku</p>
                </div>

                <div class="success-msg">
                    <p>Dobrá práce, právě jsi jeden z nás.</p>
                    <a href="index.php?page=main" class="profile">Vítej v říši čajů</a>
                </div>
                <!--                                <div class="back-msg">-->
                <!--                                    <p>Vítej zpět!</p>-->
                <!--                                    <a href="index.php?page=main" class="profile">Podívej se co je nového</a>-->
                <!--                                </div>-->
            </div>


            <!-- Form Box -->
            <div class="col-sm-6 form">

                <!-- Login Form -->
                <div class="login form-peice switched">
                    <form class="login-form" action="" method="post" id="myForm"
                          onsubmit="activateClass();">
                        <div class="form-group">
                            <label for="loginemail">Login</label>
                            <input type="text" name="login" id="loginemail" required>
                        </div>

                        <div class="form-group">
                            <label for="loginPassword">Heslo</label>
                            <input type="password" name="password" id="loginPassword" required>
                        </div>

                        <div class="CTA">
                            <input type="hidden" name="action" value="login">
                            <input type="submit" name="submit" value="Přihlásit se" id="submit">
                            <a href="" class="switch">Jsem tu nový</a>
                        </div>

                    </form>
                </div><!-- End Login Form -->
                <?php

                // zpracovani formulare pro registraci uzivatele
                //                if (!empty($_POST['submit2'])) {
                //                    var_dump($_POST);
                //                    // mam vsechny pozadovane hodnoty?
                //                    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['phone'])
                //                        && !empty($_POST['password']) && !empty($_POST['password2'])
                //                        && !empty($_POST['login']) && !empty($_POST['address'])
                //                        && !empty($_POST['postal_code']) && !empty($_POST['country']) && !empty($_POST['city'])
                //                    ) {
                //                        // pozn.: heslo by melo byt sifrovano
                //                        // napr. password_hash($password, PASSWORD_BCRYPT) pro sifrovani
                //                        // a password_verify($password, $hash) pro kontrolu hesla.
                //
                //                        // mam vsechny atributy - ulozim uzivatele do DB
                //                        $res2 = $myDB2->addNewUser($_POST['login'], $_POST['password'], $_POST['full_name'], $_POST['email'], $_POST['perm'], $_POST['phone'], $_POST['postal_code'], $_POST['address'], $_POST['country'], $_POST['city']);
                //                        // byl ulozen?
                //                        if ($res2) {
                //                            echo "<script>console.log('User was logged! Good job');</script>";
                //                        } else {
                //                            echo "<script>console.log('ERROR: User was not logged');</script>";
                //                        }
                //                    } else {
                //                        // nemam vsechny atributy
                //                        echo "<script>console.log('ERROR: Not all data');</script>";
                //                    }
                //                    echo "<br><br>";
                //                } else {
                //                    echo "<script>console.log('ERROR: Nothing is here');</script>";
                //                }


                ?>

                <!-- Signup Form -->
                <div class="signup form-peice">
                    <form class="signup-form" action="#" method="post">
                        <div id="first-forms">
                            <div class="form-group">
                                <label for="name">Celé Jméno</label>
                                <input type="text" name="full_name" id="name" class="name">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Emailová Adresa</label>
                                <input type="email" name="email" id="email" class="email">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="phone">Telefoní číslo - <small>Volitelné</small></label>
                                <input type="number" name="phone" id="phone">
                            </div>

                            <div class="form-group">
                                <label for="password">Heslo</label>
                                <input type="password" name="password" id="password" class="pass">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="passwordCon">Potvrzení Hesla</label>
                                <input type="password" name="password2" id="passwordCon" class="passConfirm">
                                <span class="error"></span>
                            </div>

                            <div class="CTA">
                                <button type="button" onclick="showForms()">Next</button>
                                <a href="#" class="switch">Mám účet</a>
                            </div>
                        </div>

                        <!--                        Second forms-->

                        <div id="second-forms" style="display:none;">
                            <div class="form-group">
                                <label for="name">Login</label>
                                <input type="text" name="login" id="name" class="name">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Adresa</label>
                                <input type="text" name="address" id="name" class="name">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="email">Poštovní číslo</label>
                                <input type="number" name="postal_code" id="post" class="number">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="password">Země</label>
                                <input type="text" name="country" id="" class="">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="passwordCon">Město</label>
                                <input type="text" name="city" id="" class="">
                                <span class="error"></span>
                            </div>

                            <div class="CTA d-flex justify-content-between">
                                <button type="button" onclick="goBack()">Jít zpět</button>
                                <input type="hidden" name="action" value="register">
                                <input type="submit" value="Registrovat se" id="submit" name="submit">
                            </div>
                        </div>
                        <script>
                            function showForms() {
                                // Hide the first content
                                document.getElementById("first-forms").style.display = "none";

                                // Show the second content
                                document.getElementById("second-forms").style.display = "block";
                            }

                            function goBack() {
                                // Hide the first content
                                document.getElementById("first-forms").style.display = "block";

                                // Show the second content
                                document.getElementById("second-forms").style.display = "none";
                            }
                        </script>
                    </form>
                </div>
                <!-- End Signup Form -->
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/form.js"></script>

</div>