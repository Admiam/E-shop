<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <script src="https://kit.fontawesome.com/c1a76831d2.js" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/forms.css">

    <title>Tea space 👾</title>
</head>
<body class="bg-orange">
<?php
///////////////////////////////////////////////////////////////////
////////////// Stranka pro upravu osobnich udaju uzivatele ////////////////
///////////////////////////////////////////////////////////////////

// nacteni souboru s funkcemi
require_once("MyDatabase.class.php");
$myDB = new MyDatabase();

// pokud je uzivatel prihlasen, tak ziskam jeho data
if ($myDB->isUserLogged()) {
    // ziskam data prihlasenoho uzivatele
    $userData = $myDB->getLoggedUserData();
}

// zpracovani odeslanych formularu
if (isset($_POST['potvrzeni'])) {
    // mam vsechny pozadovane hodnoty?
    if (isset($_POST['user_id']) && isset($_POST['password']) && isset($_POST['password2'])
        && isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['perm'])
        && $_POST['password'] == $_POST['password2']
        && $_POST['password'] != "" && $_POST['full_name'] != "" && $_POST['email'] != ""
        && $_POST['perm'] > 0
        // je soucasnym uzivatelem a zadal spravne heslo?
        && $_POST['user_id'] == $userData['user_id']
    ) {
        // bylo zadano sprevne soucasne heslo?
        if ($_POST['last_password'] == $userData['password']) {
            // bylo a mam vsechny atributy - ulozim uzivatele do DB
            $res = $myDB->updateUser($userData['user_id'], $userData['login'], $_POST['password'], $_POST['full_name'], $_POST['email'], $_POST['perm']);
            // byl ulozen?
            if ($res) {
                echo "OK: Uživatel byl upraven.";
                // nactu znovu jeho aktualni data
                $userData = $myDB->getLoggedUserData();
            } else {
                echo "ERROR: Upravení uživatele se nezdařilo.";
            }
        } else {
            // nebylo
            echo "ERROR: Zadané současné heslo uživatele není správné.";
        }
    } else {
        // nemam vsechny atributy
        echo "ERROR: Nebyly přijaty požadované atributy uživatele.";
    }
    echo "<br><br>";
}

//require("../components/header.php");
//$createHeader = new \components\header();
//$createHeader->getHeader();
?>
<header class="d-flex header flex-row justify-content-between pt-4 px-4" id="header">

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
        <?php
        require_once("MyDatabase.class.php");
        $myDB = new MyDatabase();

        if ($myDB->isUserLogged()) {
            // ziskam data prihlasenoho uzivatele
            ?>
            <a href="index.php?page=account"><i class="fa-solid fa-user nav-icons"></i></a>
            <i class="fa-solid fa-right-from-bracket"></i>
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

<section class="screen d-flex flex-column container body-white signup form-peice">
    <h2>Osobní údaje</h2>
    <form action="" method="POST" oninput="x.value=(pas1.value==pas2.value)?'OK':'Nestejná hesla'"
          autocomplete="off" class="signup-form"
    >
        <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
        <table>
            <tr>
                <td>Login:</td>
                <td><?php echo $userData['login']; ?></td>
            </tr>
            <tr>
                <div class="form-group">
                    <label for="loginPassword">Nové heslo</label>
                    <input type="password" name="password" id="pas1">
                </div>
            </tr>
            <tr>
                <td>Heslo 2:</td>
                <td><input type="password" name="password2" id="pas2"></td>
            </tr>
            <tr>
                <td>Ověření hesla:</td>
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
                <td>
                    <select name="perm">
                        <?php
                        // ziskam vsechna prava
                        $rights = $myDB->getAllRights();
                        // projdu je a vypisu
                        foreach ($rights as $r) {
                            $selected = ($userData['perm_id'] == $r['perm_id']) ? "selected" : "";
                            echo "<option value='$r[perm_id]' $selected>$r[name]</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Současné heslo:</td>
                <td><input type="password" name="last_password" required></td>
            </tr>
        </table>

        <input type="submit" name="potvrzeni" value="Upravit osobní údaje">
    </form>
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