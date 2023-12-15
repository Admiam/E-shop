<?php
//////////////////////////////////////////////////////////////
////////////// Vstupni bod cele webove aplikace ////////////////
////////////// - stranka s funkci rozcestniku   ////////////////
//////////////////////////////////////////////////////////////

// nactu zakladni nastaveni
require_once("settings.inc.php");

// mam spravnou hodnotu na vstupu nebo nastavim default
if (isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)) {
    $pageId = $_GET["page"];
} else {
    $pageId = WEB_PAGE_DEFAULT_KEY; // default
}

// vypisu zvolenou stranku
require_once(WEB_PAGES[$pageId]);
//
//require_once("myAutoloader.inc.php");
//
//// nactu vlastni nastaveni webu
//require_once("settings.inc.php");
//
//// spustim aplikaci
//$app = new \kivweb\ApplicationStart();
//$app->appStart();
//
//?>

<!--?>-->
