<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class blackTeaController implements IController {

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
        global $tplData, $products;
        $tplData = [];

        $tplData['title'] = $pageTitle;

        if(isset($_POST['logout']) and $_POST['logout'] == "logout"){
            $this->user->userLogout();
        }

        $tplData['userLogged'] = $this->user->isUserLogged();

        if($tplData['userLogged']){
            $user = $this->user->getLoggedUserData();
            $tplData['perm_id'] = $user['perm_id'];
            $tplData['category_id'] = 4;
        } else {
            $tplData['perm_id'] = null;
        }
//        echo "ahoj 1";

//        var_dump($tplData);
        // ziskam data vsech uzivatelu
        $products = $this->db->getTea($tplData['category_id']);
//        echo "ahoj 2";

        ob_start();
        require(DIRECTORY_VIEWS ."/black_tea.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>