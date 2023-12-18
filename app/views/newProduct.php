<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <script src="https://kit.fontawesome.com/c1a76831d2.js" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="../../styles/main.css">-->
    <link rel="stylesheet" href="styles/forms.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <title>Tea space 👾</title>
</head>

<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro prihlaseni/odhlaseni uzivatele ////////////////
///////////////////////////////////////////////////////////////////

// nacteni souboru s funkcemi
global $tplData, $categories;


// pokud je uzivatel prihlasen, tak ziskam jeho data
//if ($tplData->isUserLogged()) {
//    // ziskam data prihlasenoho uzivatele
//    $user = $tplData->getLoggedUserData();
//}

///////////// PRO NEPRIHLASENE UZIVATELE ///////////////
// pokud uzivatel neni prihlasen nebo nebyla ziskana jeho data, tak vypisu prihlasovaci formular
?>

<div class="container ">


    <section id="formHolder">

        <div class="row">

            <!-- Form Box -->
            <div class="col-sm-6 form" >
                <!-- Signup Form -->
                <div class="signup form-peice" style="min-height:1000px; left:auto; margin-left: 0;">
                    <form class="signup-form" action="#" method="post">
                        <div id="first-forms">
                            <div class="form-group">
                                <label for="name">Jméno produktu</label>
                                <input type="text" name="product_name" id="name" class="name">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Země původu</label>
                                <input type="text" name="country" id="" class="">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="price">Cena</label>
                                <input type="number" name="price" id="price" class="price">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Množství</label>
                                <input type="number" name="quantity" id="quantity" class="quantity">
                                <span class="error"></span>
                            </div>

                            <div class="form-group" style="">
                                <label for="quantity">Kategorie</label>
                                <select name='category_id'>
                                    <?php

                                foreach ($categories as $c) {
                                    if ($c['perm_id'] != 1 && $c['category_id'] != 2) {
                                        echo "<option value='{$c['category_id']}'>{$c['category_name']}</option>";
                                    }
                                }

                                ?>
                                </select>
                                <span class="error"></span>

                            </div>
                            <div class="form-group">
                                <label for="passwordCon">Popisek</label>
                                <textarea type="text" name="text" placeholder="zadejte Váš text"></textarea><br>
                                <span class="error"></span>
                            </div>
                                <input type="hidden" name="add" value="register">
                                <input type="submit" value="Přidat" id="submit" name="add">
                        </div>
                    </form>
                </div>
                <!-- End Signup Form -->
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="views/js/form.js"></script>

</div>
</html>