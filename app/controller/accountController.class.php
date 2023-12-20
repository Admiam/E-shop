<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class accountController implements IController {

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
        global $userData;
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

        // pokud je uzivatel prihlasen, tak ziskam jeho data
        if ($this->user->isUserLogged()) {
            // ziskam data prihlasenoho uzivatele
            $userData = $this->user->getLoggedUserData();
        }

        // ziskam vsechna prava
        $rights = $this->db->getRight($userData['perm_id']);

// zpracovani odeslanych formularu
        if (isset($_POST['potvrzeni'])) {
//            var_dump($user);
//            echo "/////////////////////////////";
//            var_dump($_POST);


            if ( isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email'])
                && $_POST['password'] == $_POST['password2']
                && $_POST['password'] != "" && $_POST['email'] != ""
                // je soucasnym uzivatelem a zadal spravne heslo?

            ) {
                // bylo zadano sprevne soucasne heslo?
                if (password_verify($_POST['last_password'], $user['password']) || $_POST['last_password'] == $user['password']) {
                    // bylo a mam vsechny atributy - ulozim uzivatele do DB
                    $res = $this->db->updateUser($userData['user_id'], $userData['login'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['full_name'], $_POST['email'], $userData['perm_id']);
                    // byl ulozen?
                    if ($res) {
                        echo "<script>alert('Uživatel byl úspěšně upraven')</script>";
                        // nactu znovu jeho aktualni data
                        $userData = $this->user->getLoggedUserData();
                    } else {
                        echo "<script>alert('ERROR: Něco se nepovedlo')</script>";
                    }
                } else {
                    // nebylo
                    echo "<script>alert('ERROR: Údaje se neshodují')</script>";
                }
            } else {
                // nemam vsechny atributy
                echo "<script>alert('ERROR: Nebyly vyplňěny všechny požadované údaje')</script>";
            }
        }

        ob_start();
        require(DIRECTORY_VIEWS ."/account.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>