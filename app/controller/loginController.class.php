<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class loginController implements IController {

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

        // zpracovani odeslanych formularu
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'login':
                    if (isset($_POST['login']) && isset($_POST['password']) ) {
                        // pokusim se prihlasit uzivatele
                        $res = $this->user->userLogin($_POST['login'], $_POST['password']);
                        if ($res) {
                            echo "<script>
                            // This will log a message to the console when the script is executed
                            console.log('User was logged! Good job');</script>";
                            header("Location: index.php?page=main");
                            exit;
                        } else {
                            echo "<script>alert('ERROR: User was not logged');</script>";
                        }
                    }
                    break;
                case 'register':
//            var_dump($_POST);
                    echo "Ahoj";
                    if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['phone'])
                        && isset($_POST['password']) && isset($_POST['password2'])
                        && isset($_POST['login']) && isset($_POST['address'])
                        && isset($_POST['postal_code']) && isset($_POST['country']) && isset($_POST['city'])
                    ) {
                        echo "Ahoj2";
                        // pozn.: heslo by melo byt sifrovano
                        // napr. password_hash($password, PASSWORD_BCRYPT) pro sifrovani
                        // a password_verify($password, $hash) pro kontrolu hesla.

                        // mam vsechny atributy - ulozim uzivatele do DB
                        $res = $this->db->addNewUser($_POST['login'],password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['full_name'], $_POST['email'], 4, intval($_POST['phone']), intval($_POST['postal_code']), $_POST['address'], $_POST['country'], $_POST['city']);
                        echo "Ahoj3";
                        // byl ulozen?
//                        if ($res === false) $kokot = "kokot";
//                        echo $kokot;
                        if ($res) {
                            echo "<script>console.log('User was logged! Good job');</script>";
                            header("Location: index.php?page=main");
                            exit;

                        } else {
                            echo "<script>console.log('ERROR: User was not logged');</script>";
                        }
                    } else {
                        // nemam vsechny atributy
                        echo "<script>console.log('ERROR: Not all data');</script>";
                    }
            }
        }

        ob_start();
        require(DIRECTORY_VIEWS ."/login.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>