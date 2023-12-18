<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <script src="https://kit.fontawesome.com/c1a76831d2.js" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/forms.css">

    <title>Tea space 👾</title>
</head>
<body class="bg-orange">
<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro upravu osobnich udaju uzivatele ////////////////
///////////////////////////////////////////////////////////////////

// nacteni souboru s funkcemi
global $tplData, $rights, $userData;


//require("../components/header.php");
//$createHeader = new \components\header();
//$createHeader->getHeader();
?>

<header class="" id="header">
    <?php
    require("components/header.php");
    $createHeader = new \components\header();
    $createHeader->getHeader();
    ?>
</header>

<section class="screen d-flex flex-column container body-white signup form-peice">
    <h2>Osobní údaje</h2>
    <form action="" method="POST" oninput="x.value=(pas1.value==pas2.value)?'OK':'Nestejná hesla'"
          autocomplete="off" class="signup-form"
    >
        <input type="hidden" name="user_id" value="">
        <table>
            <tr>
                <td>Login:</td>
                <td><?php echo $userData['login']; ?></td>
            </tr>
            <tr>
                <td>Současné heslo:</td>
                <td><input type="password" name="last_password" required></td>
            </tr>
            <tr>
                <td>Nové heslo:</td>
                <td><input type="password" name="password" id="pas1"></td>
            </tr>
            <tr>
                <td>Ověření hesla:</td>
                <td><input type="password" name="password2" id="pas2"></td>
            </tr>
            <tr>
                <td>Je v pořádku:</td>
                <td>
                    <output name="x" for="pas1 pas2"></output>
                </td>
            </tr>
            <tr>
                <td>Jméno:</td>
                <td><input type="text" name="full_name" value="<?php echo $userData['full_name']; ?>" required></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><input type="email" name="email" value="<?php echo $userData['email']; ?>" required></td>
            </tr>
            <tr>
                <td>Právo:</td>
                <td><?php

                    echo $rights['name']; ?></td>
            </tr>
        </table>

        <input type="submit" name="potvrzeni" value="Upravit osobní údaje">
    </form>
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