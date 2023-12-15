<?php
///////////////////////////////////////////////////////
////////////// Zakladni nastaveni webu ////////////////
///////////////////////////////////////////////////////

////// nastaveni pristupu k databazi ///////

// prihlasovaci udaje k databazi
define("DB_SERVER", "localhost"); // https://students.kiv.zcu.cz nebo 147.228.63.10
define("DB_NAME", "TspaceSP");
define("DB_USER", "root");
define("DB_PASS", "");

// definice konkretnich nazvu tabulek
define("TABLE_USER", "User");
define("TABLE_PERM", "Permission");


///// vsechny stranky webu ////////

// pripona souboru
$phpExtension = ".php";

// dostupne stranky webu
define("WEB_PAGES", [
    'main' => "main" . $phpExtension,
    'login' => "login" . $phpExtension,
    'account' => "account" . $phpExtension,
    'users' => "users" . $phpExtension,
    'about' => "about" . $phpExtension,
    'contact' => "contact" . $phpExtension,
    'warehouse' => "warehouse" . $phpExtension,
    'fruit_tea' => "categories/fruit_tea" . $phpExtension,
    'green_tea' => "categories/green_tea" . $phpExtension,
    'black_tea' => "categories/black_tea" . $phpExtension,
    'herbs_tea' => "categories/herbs_tea" . $phpExtension,
    'white_tea' => "categories/white_tea" . $phpExtension
]);

// defaultni/vychozi stranka webu
define("WEB_PAGE_DEFAULT_KEY", 'main');

?>
