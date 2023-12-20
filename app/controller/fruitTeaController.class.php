<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class fruitTeaController implements IController {

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
            $tplData['category_id'] = 5;
        } else {
            $tplData['perm_id'] = null;
        }

        $products = $this->db->getTea($tplData['category_id']);

        if (isset($_POST['buy']) && isset($_POST['id'])){

            $res = $this->db->addToCart($user["user_id"],$_POST['id']);

            if ($res) {
                $qa = $this->db->decrease(intval($_POST['quantity']), 1);

                $res2 = $this->db->updateQuantity($_POST['id'], $qa);
                if ($res2) {
                    echo "<script>console.log('updated')</script>";
                } else {
                    echo "<script>alert('ERROR: Něco se nepovedlo :( {update}')</script>";
                }
                echo "<script>console.log('add to cart')</script>";
            } else {
                echo "<script>alert('ERROR: Něco se nepovedlo :( {add}')</script>";
            }
        }
        ob_start();
        require(DIRECTORY_VIEWS ."/fruit_tea.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>