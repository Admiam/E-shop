<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class warehouseController implements IController {

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
        global $tplData, $products, $categories;
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

        if (isset($_POST['delete'])) {

            // smazu daneho uzivatele z databaze
            $res = $this->db->deleteFromTable(TABLE_PRODUCT, "product_id='$_POST[product_id]'");
            // vysledek mazani
            if ($res) {
                echo "<script>alert('Produkt byl úspěšně smazán')</script>";
            } else {
                echo "<script>alert('ERROR: Něco se nepovedlo :(')</script>";

            }
        }

        if (isset($_POST['update'])) {
//            echo "ahoj 2";
//var_dump($_POST);
            $res = $this->db->updateProduct($_POST['product_id'], $_POST['price'], $_POST['quantity'], $_POST['category_id']);
//            echo "ahoj 3";

//            echo  $_POST['perm'];

            if ($res) {
                echo "<script>alert('UPRAVENO')</script>";
            } else {
                echo "<script>alert('ERROR: Něco se nepovedlo :(')</script>";
            }
        }

        // ziskam data vsech uzivatelu
        $products = $this->db->getAllProducts();

        // ziskam data vsech prav
        $categories = $this->db->getAllCategories();

        ob_start();
        require(DIRECTORY_VIEWS ."/warehouse.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>