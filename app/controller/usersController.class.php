<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class usersController implements IController {

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
        global $users;
        global $rights;

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

//        if (!empty($_POST['user_id'])) {
//            // smazu daneho uzivatele z databaze
//            $res = $this->db->deleteFromTable(TABLE_USER, "user_id='$_POST[user_id]'");
//            // vysledek mazani
//            if ($res) {
//                echo "OK: Uživatel byl smazán z databáze.";
//            } else {
//                echo "ERROR: Smazání uživatele se nezdařilo.";
//            }
//        }
//        echo "ahoj 1";
//        var_dump($_POST);

        if (isset($_POST['delete'])) {

            // smazu daneho uzivatele z databaze
            $res = $this->db->deleteFromTable(TABLE_USER, "user_id='$_POST[user_id]'");
            // vysledek mazani
            if ($res) {
                echo "<script>alert('Uživatel byl úspěšně smazán')</script>";
            } else {
                echo "<script>alert('ERROR: Něco se nepovedlo :(')</script>";

            }
        }

        if (isset($_POST['update'])) {
//            echo "ahoj 2";

            $res = $this->db->updateRights($_POST['user_id'], $_POST['perm']);
//            echo "ahoj 3";

//            echo  $_POST['perm'];

            if ($res) {
                echo "<script>alert('UPRAVENO')</script>";
            } else {
                echo "<script>alert('ERROR: Něco se nepovedlo :(')</script>";
            }
        }


        // ziskam data vsech uzivatelu
        $users = $this->db->getAllUsers();

        // ziskam data vsech prav
        $rights = $this->db->getAllRights();


        ob_start();
        require(DIRECTORY_VIEWS ."/users.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>