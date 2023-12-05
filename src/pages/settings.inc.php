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
    'management' => "user-management" . $phpExtension
]);

// defaultni/vychozi stranka webu
define("WEB_PAGE_DEFAULT_KEY", 'main');

?>
