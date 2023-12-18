<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class whiteTeaController implements IController {

    /** @var MyDatabase $db  Sprava databaze. */
    private $db;
    /**
     * @var userManage $user Správa uživatele
     */
    private $user;

    /**
     * Inicializace připojení k databázi a správě uživatele
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/MyDatabase.class.php");
        $this->db = new MyDatabase();
        require_once (DIRECTORY_MODELS ."/userManage.php");
        $this->user = new userManage();
    }

    /**
     * Vrátí obsah stránky O nás
     * @param string $pageTitle     Název stránky
     * @return string               Výpis
     */
    public function show(string $pageTitle):string {
        global $tplData;
        $tplData = [];

        $tplData['title'] = $pageTitle;

        if(isset($_POST['logout']) and $_POST['logout'] == "logout"){
            $this->user->userLogout();
        }

        $tplData['userLogged'] = $this->user->isUserLogged();

        if($tplData['userLogged']){
            $user = $this->user->getLoggedUserData();
            $tplData['perm_id'] = $user['perm_id'];
        } else {
            $tplData['perm_id'] = null;
        }

        ob_start();
        require(DIRECTORY_VIEWS ."/categories/white_tea.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>