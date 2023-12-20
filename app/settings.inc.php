<?php
///////////////////////////////////////////////////////
////////////// Zakladni nastaveni webu ////////////////
///////////////////////////////////////////////////////

////// nastaveni pristupu k databazi ///////

    // prihlasovaci udaje k databazi
//    define("DB_SERVER","localhost");
//    define("DB_NAME","pujcovna_semestralka");
//    define("DB_USER","root");
//    define("DB_PASS","");
//
//    // definice konkretnich nazvu tabulek
//    define("TABLE_USER","user");
//    define("TABLE_PRAVA","prava");
//    define("TABLE_LODE","lode");
//    define("TABLE_OBJEDNAVKA","objednavka");
//    define("TABLE_OBJEDNAVKA_LODE","objednavky_lodi");
//    define("TABLE_POMOCNA_PRISLUSENSTVI","pomocna_prislusenstvi");
//    define("TABLE_PRISLUSENSTVI","prislusenstvi");
//    define("TABLE_REKY","reky");

// prihlasovaci udaje k databazi
define("DB_SERVER", "localhost");
define("DB_NAME", "TspaceSP");
define("DB_USER", "root");
define("DB_PASS", "");

// definice konkretnich nazvu tabulek
define("TABLE_USER", "User");
define("TABLE_PERM", "Permission");
define("TABLE_ORDER_DETAIL", "Order_detail");
define("TABLE_ORDER_ITEM", "Order_item");
define("TABLE_CATEGORY", "Category");
define("TABLE_PRODUCT", "Product");
define("TABLE_CART", "Cart");


///// vsechny stranky webu ////////

// pripona souboru
//$phpExtension = ".php";
//
//// dostupne stranky webu
//define("WEB_PAGES", [
//    'main' => "main" . $phpExtension,
//    'login' => "login" . $phpExtension,
//    'account' => "account" . $phpExtension,
//    'users' => "users" . $phpExtension,
//    'about' => "about" . $phpExtension,
//    'contact' => "contact" . $phpExtension,
//    'warehouse' => "warehouse" . $phpExtension,
//    'fruit_tea' => "categories/fruit_tea" . $phpExtension,
//    'green_tea' => "categories/green_tea" . $phpExtension,
//    'black_tea' => "categories/black_tea" . $phpExtension,
//    'herbs_tea' => "categories/herbs_tea" . $phpExtension,
//    'white_tea' => "categories/white_tea" . $phpExtension
//]);
//
//// defaultni/vychozi stranka webu
//define("WEB_PAGE_DEFAULT_KEY", 'main');


//// Dostupne stranky webu ////

/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "controller";
/** Adresar modelu. */
const DIRECTORY_MODELS = "model";
/** Adresar pohledů */
const DIRECTORY_VIEWS = "views";

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "main";

/** Dostupne webove stranky. */
const WEB_PAGES = array(
    //// Uvodni stranka ////
    "main" => array(
        "title" => "Tea Space",

        //// kontroler
        "file_name" => "mainController.class.php",
        "class_name" => "mainController",
    ),
    //// KONEC: Uvodni stranka ////

    //// oNas ////
    "about" => array(
        "title" => "O nás",

        //// kontroler
        "file_name" => "aboutController.class.php",
        "class_name" => "aboutController",
    ),
    //// KONEC: oNas ////

    /// Registrace ///
    "login" => array(
        "title" => "Registrace",

        //// kontroler
        "file_name" => "loginController.class.php",
        "class_name" => "loginController"
    ),
    //// KONEC: Registrace /////

    //// Objednávka ////
    "cart" => array(
        "title" => "Nákupní košík",

        //// kontroler
        "file_name" => "cartController.class.php",
        "class_name" => "cartController",
    ),
    //// KONEC: Objednávka ////


    //// Uvodni stranka ////
    "contact" => array(
        "title" => "Kontakt",

        //// kontroler
        "file_name" => "contactController.class.php",
        "class_name" => "contactController",
    ),
    //// KONEC: Uvodni stranka ////

    //// Tea ////
    "black_tea" => array(
        "title" => "Černé čaje",

        //// kontroler
        "file_name" => "blackTeaController.class.php",
        "class_name" => "blackTeaController",
    ),
    "fruit_tea" => array(
        "title" => "Ovocné čaje",

        //// kontroler
        "file_name" => "fruitTeaController.class.php",
        "class_name" => "fruitTeaController",
    ),
    "green_tea" => array(
        "title" => "Zelené čaje",

        //// kontroler
        "file_name" => "greenTeaController.class.php",
        "class_name" => "greenTeaController",
    ),
    "herbs_tea" => array(
        "title" => "Bylinné čaje",

        //// kontroler
        "file_name" => "herbsTeaController.class.php",
        "class_name" => "herbsTeaController",
    ),
    "white_tea" => array(
        "title" => "Bílé čaj",

        //// kontroler
        "file_name" => "whiteTeaController.class.php",
        "class_name" => "whiteTeaController",
    ),
    //// KONEC: Objednávky ////

    ///  Profil ///
    "account" => array(
        "title" => "Profil",

        //// kontroler ////
        "file_name" => "accountController.class.php",
        "class_name" => "accountController",
    ),
    //// KONEC: Profil ////

    /// Přidání produktu ///
    "users" => array(
        "title" => "Správa uživatelů",

        //// kontroler ////
        "file_name" => "usersController.class.php",
        "class_name" => "usersController",
    ),
    //// KONEC: Přidání produktu ///

    /// Přidání produktu ///
    "warehouse" => array(
        "title" => "Sklad",

        //// kontroler ////
        "file_name" => "warehouseController.class.php",
        "class_name" => "warehouseController",
    ),
    //// KONEC: Přidání produktu ///

    /// Přidání produktu ///
    "newProduct" => array(
        "title" => "Přidání produktu",

        //// kontroler ////
        "file_name" => "newProductController.class.php",
        "class_name" => "newProductController",
    ),
    //// KONEC: Přidání produktu ///

    /// Přidání produktu ///
    "summary" => array(
        "title" => "Shrnutí objednávky",

        //// kontroler ////
        "file_name" => "sumaryController.class.php",
        "class_name" => "sumaryController",
    ),
    //// KONEC: Přidání produktu ///
);
?>
