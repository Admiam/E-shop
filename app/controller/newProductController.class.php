<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class newProductController implements IController {

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
        global $tplData, $categories;
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

        if (isset($_POST['add'])) {
            var_dump($_POST);
//            echo "ahoj 1";

            if (isset($_POST['product_name']) && isset($_POST['country']) && isset($_POST['price']) && isset($_POST['quantity'])
                && isset($_POST['category_id']) && isset($_POST['text'])){
//                echo "ahoj 2";
                $res = $this->db->addNewProduct($_POST['product_name'], $_POST['country'], intval($_POST['price']), intval($_POST['quantity']), intval($_POST['category_id']), $_POST['text']);
//                echo "ahoj š";

                if ($res) {
                    echo "<script>
                        alert('Produkt byl úspěšně přidán.');
                    </script>";
                    header("Location: index.php?page=warehouse");
                    exit;
                } else {
                    echo "<script>
                        alert('Produkt se nepodařilo přidat.');
                    </script>";
                }
            }
        }

        $categories = $this->db->getAllCategories();


        ob_start();
        require(DIRECTORY_VIEWS ."/newProduct.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>