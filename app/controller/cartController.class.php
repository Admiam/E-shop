<?php

require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladač pro výpis stránky O nás
 */
class cartController implements IController {

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
        global $tplData , $cartItems;
//        global $total;
//        $total = 0;
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

//        echo "ahoj 1";
        $cartItems = $this->db->getCartDetail($user["user_id"]);

        if (isset($_POST['delete'])) {



            // smazu daneho uzivatele z databaze
            $res = $this->db->deleteFromTable(TABLE_CART, "cart_id='$_POST[cart_id]'");
            $qa = $this->db->increase(intval($_POST['product_quantity']), intval($_POST['quantity']));

            $res2 = $this->db->updateQuantity($_POST['product_id'], $qa);
            // vysledek mazani
            if ($res && $res2) {
                echo "<script>console.log('Uživatel byl úspěšně smazán')</script>";
            } else {
                echo "<script>console.log('ERROR: Něco se nepovedlo :(')</script>";

            }
        }


        if (isset($_POST['buy'])) {
//            echo $_POST['total'];
            if ($_POST['total'] != 70 ) {

            $number = $this->db->getNumberOrder($user["user_id"]);
            ++$number;

            $newOrder = $this->db->addNewOrder($user["user_id"], $_POST['total'], $number);

            $order = $this->db->getOrder($user["user_id"], $number);
;
            foreach ($cartItems as $item) {
                $orderItem = $this->db->addNewOrderItem($item["product_id"], $item["quantity"], $order["0"]["order_id"]);
            }

            $delete = $this->db->deleteFromTable(TABLE_CART, "user_id='$user[user_id]'");
                echo "<script>console.log('success')</script>";
                header("Location: index.php?page=summary");
                exit;
            }
//            $res2 = $this->db->deleteFromTable(TABLE_CART, "cart_id='$_POST[cart_id]'");
//            $qa = $this->db->increase(intval($_POST['product_quantity']), intval($_POST['quantity']));

//            $res2 = $this->db->updateQuantity($_POST['product_id'], $qa);
            // vysledek mazani
//            if ($res && $res2) {
//                echo "<script>console.log('Uživatel byl úspěšně smazán')</script>";
//            } else {
//                echo "<script>console.log('ERROR: Něco se nepovedlo :(')</script>";
//
//            }
        }

//        $cartItems = $this->db->getCart($user["user_id"]);


//        var_dump($product);


        ob_start();
        require(DIRECTORY_VIEWS ."/cart.php");
        $obsah = ob_get_clean();

        return $obsah;
    }
}
?>