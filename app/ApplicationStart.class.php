<?php

/**
 * Vstupní bod celé aplikace
 */
class ApplicationStart {

    /**
     * Inicializace webové aplikace.
     */
    public function __construct()
    {
        require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
    }

    /**
     * Spuštění webové aplikace
     */
    public function appStart(){
        if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
            $pageKey = $_GET["page"];
        } else {
            $pageKey = DEFAULT_WEB_PAGE_KEY;
        }

        $pageInfo = WEB_PAGES[$pageKey];

        require_once(DIRECTORY_CONTROLLERS ."/". $pageInfo["file_name"]);

        /** @var IController $controller  Ovladač příslušné stránky */
        $controller = new $pageInfo["class_name"];

        echo $controller->show($pageInfo["title"]);

    }
}

?>

