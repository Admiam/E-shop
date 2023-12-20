<?php


/**
 * Třída spravující databázi
 */
class MyDatabase
{

    /** @var PDO $pdo PDO objekt pro práci s databází. */
    private $pdo;

    /**
     * Inicializace připojení k databázi.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->pdo->exec("set names utf8");
    }


    /**
     *  Provede dotaz a bud vrati ziskana data, nebo pri chybe ji vypise a vrati null.
     *
     * @param string $dotaz SQL dotaz.
     * @return PDOStatement|null    Výsledek dotazu
     */
    private function executeQuery(string $dotaz): ?PDOStatement
    {

        $res = $this->pdo->query($dotaz);
        if ($res) {
            return $res;
        } else {
            $error = $this->pdo->errorInfo();
            echo $error[2];
            return null;
        }
    }

    /**
     * Ziskani zaznamu vsech uzivatelu aplikace.
     *
     * @return array    Pole se vsemi uzivateli.
     */
    public function getAllUsers()
    {
        // ziskam vsechny uzivatele z DB razene dle ID a vratim je
        $users = $this->selectFromTable(TABLE_USER, "", "user_id");
        return $users;
    }

    /**
     * Ziskani zaznamu vsech prav uzivatelu.
     *
     * @return array    Pole se vsemi pravy.
     */
    public function getAllRights()
    {
        // ziskam vsechna prava z DB razena dle ID a vratim je
        $rights = $this->selectFromTable(TABLE_PERM, "", "tier ASC, name ASC");
        return $rights;
    }

    /**
     * Ziskani zaznamu vsech prav uzivatelu.
     *
     * @return array    Pole se vsemi pravy.
     */
    public function getAllCategories()
    {
        // ziskam vsechna prava z DB razena dle ID a vratim je
        $categories = $this->selectFromTable(TABLE_CATEGORY, "", "category_name ASC");
        return $categories;
    }

    /**
     * Ziskani zaznamu vsech prav uzivatelu.
     *
     * @return array    Pole se vsemi pravy.
     */
    public function getAllProducts()
    {
        // ziskam vsechna prava z DB razena dle ID a vratim je
        $products = $this->selectFromTable(TABLE_PRODUCT, "", "product_name ASC");
        return $products;
    }

    /**
     * Ziskani zaznamu vsech lodí z aplikace.
     *
     * @return array    Pole se vsemi loděmi.
     */
    public function getAllTea(): array
    {
        $cena = $this->selectFromTable(TABLE_PRODUCT, "", "product_id");
        return $cena;
    }

    /**
     * Získání uživatele podle Emailu.
     *
     * @param string $email Email pro vyhledání v databízi.
     * @return array    Pole se vsemi uživateli (vždycky bude pouze jeden uživatel).
     */
    public function getRight(int $id): ?array
    {
        $q = "SELECT * FROM " . TABLE_PERM
            . " WHERE perm_id=:perm_id;";
        $user = $this->pdo->prepare($q);
        $user->bindValue(":perm_id", $id);
        if ($user->execute()) {
            return $user->fetchAll();
        } else {
            return null;
        }
    }

    public function getTea(int $category_id): ?array
    {
//        echo "ahoj 2";
        $q = "SELECT * FROM " . TABLE_PRODUCT
            . " WHERE category_id=:category_id;";
        $category = $this->pdo->prepare($q);
        $category->bindValue(":category_id", $category_id);
        if ($category->execute()) {
            return $category->fetchAll();
        } else {
            return null;
        }
    }

    public function getCart(int $user_id): ?array
    {
//        echo "ahoj 2";
        $q = "SELECT * FROM " . TABLE_CART
            . " WHERE user_id=:user_id;";
        $cart = $this->pdo->prepare($q);
        $cart->bindValue(":user_id", $user_id);
        if ($cart->execute()) {
            return $cart->fetchAll();
        } else {
            return null;
        }
    }

    public function getCartDetail(int $user_id): ?array
    {
//        echo "ahoj 2";
        $q = "SELECT Cart.*, Product.product_id,  Product.product_name, Product.quantity AS product_quantity, Product.price, Product.text
          FROM " . TABLE_CART . " AS Cart
          JOIN " . TABLE_PRODUCT . " AS Product ON Product.product_id = Cart.product_id
          WHERE Cart.user_id = :user_id";

        $cart = $this->pdo->prepare($q);
        $cart->bindValue(":user_id", $user_id);

        if ($cart->execute()) {
            return $cart->fetchAll();
        } else {
            return null;
        }
    }

    public function getNumberOrder(int $user_id): int
    {
        $q = "SELECT COUNT(*) AS order_count FROM " . TABLE_ORDER_DETAIL . " WHERE user_id=:user_id;";
        $order_detail = $this->pdo->prepare($q);
        $order_detail->bindValue(":user_id", $user_id);

        if ($order_detail->execute()) {
            $result = $order_detail->fetch(PDO::FETCH_ASSOC);

            // Check if a result was fetched
            if ($result) {
                return (int)$result['order_count'];
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getOrder(int $user_id, int $number): ?array
    {
//        echo "ahoj 2";
        $q = "SELECT * FROM " . TABLE_ORDER_DETAIL
            . " WHERE user_id=:user_id AND number=:number";
        $cart = $this->pdo->prepare($q);
        $cart->bindValue(":user_id", $user_id);
        $cart->bindValue(":number", $number);

        if ($cart->execute()) {
            return $cart->fetchAll();
        } else {
            return null;
        }
    }

    public function getReceipt(int $order_id): ?array
    {
//        echo "ahoj 2";
        $q = "SELECT Order_item.*, Product.product_name,  Product.price
          FROM " . TABLE_ORDER_ITEM . " AS Order_item
          JOIN " . TABLE_PRODUCT . " AS Product ON Product.product_id = Order_item.product_id
          WHERE Order_item.order_id = :order_id";

        $cart = $this->pdo->prepare($q);
        $cart->bindValue(":order_id", $order_id);

        if ($cart->execute()) {
            return $cart->fetchAll();
        } else {
            return null;
        }
    }


    public function selectFromTable(string $tableName, string $whereStatement = "", string $orderByStatement = ""): array
    {
        // slozim dotaz
        $q = "SELECT * FROM " . $tableName
            . (($whereStatement == "") ? "" : " WHERE $whereStatement")
            . (($orderByStatement == "") ? "" : " ORDER BY $orderByStatement");

        $obj = $this->executeQuery($q);

        if ($obj == null) {
            return [];
        }

        return $obj->fetchAll();
    }

    /**
     * Jednoduche vlozeni do prislusne tabulky.
     *
     * @param string $tableName Nazev tabulky.
     * @param string $insertStatement Text s nazvy sloupcu pro insert.
     * @param string $insertValues Text s hodnotami pro prislusne sloupce.
     * @return bool                     Vlozeno v poradku?
     */
    public function insertIntoTable(string $tableName, string $insertStatement, string $insertValues): bool
    {
        // slozim dotaz
        $q = "INSERT INTO $tableName($insertStatement) VALUES ($insertValues)";
        // provedu ho a vratim uspesnost vlozeni
        $obj = $this->executeQuery($q);
        // pokud ($obj == null), tak vratim false
        return ($obj != null);
    }

    /**
     * Jednoducha uprava radku databazove tabulky.
     *
     * @param string $tableName Nazev tabulky.
     * @param string $updateStatementWithValues Cela cast updatu s hodnotami.
     * @param string $whereStatement Cela cast pro WHERE.
     * @return bool                                 Upraveno v poradku?
     */
    public function updateInTable(string $tableName, string $updateStatementWithValues, string $whereStatement): bool
    {
        // slozim dotaz
        $q = "UPDATE $tableName SET $updateStatementWithValues WHERE $whereStatement";
        // provedu ho a vratim vysledek
        $obj = $this->executeQuery($q);
        // pokud ($obj == null), tak vratim false
        return ($obj != null);
    }

    /**
     * Dle zadane podminky maze radky v prislusne tabulce.
     *
     * @param string $tableName Nazev tabulky.
     * @param string $whereStatement Podminka mazani.
     * @return bool
     */
    public function deleteFromTable(string $tableName, string $whereStatement): bool
    {
        // slozim dotaz
        $q = "DELETE FROM $tableName WHERE $whereStatement";
        // provedu ho a vratim vysledek
        $obj = $this->executeQuery($q);
        // pokud ($obj == null), tak vratim false
        return ($obj != null);
    }


    /**
     * Nalezne uživatele s daným emailem a heslem
     *
     * @param $email /Email uživatele v databázi
     * @param $password /Heslo uživatele
     * @param $password /Heslo uživatele
     * @return mixed        Vrácení uživatele pokud se povede nebo vrátí NULL
     */
    public function isInTable($login, $email, $password)
    {

        $q = "SELECT * FROM " . TABLE_USER . " WHERE login=:login AND email=:email AND password=:password;";
        $output = $this->pdo->prepare($q);
        $output->bindValue(":login", $login);
        $output->bindValue(":email", $email);
        $output->bindValue(":password", $password);
        if ($output->execute()) {
            return $output->fetchAll();
        } else {
            return null;
        }
    }

    /**
     * Vytvoreni noveho uzivatele v databazi
     *
     * @param string $login Login uzivatele.
     * @param string $password Heslo uzivatele.
     * @param string $full_name Jmeno uzivatele.
     * @param string $email Email uzivatele.
     * @param int $permID ID prava uzivatele.
     * @param int $phone Telefon uzivatele.
     * @param int $postal_code PSC uzivatele.
     * @param string $address Adresa uzivatele.
     * @param string $country ID zeme uzivatele.
     * @param string $city Mesto uzivatele.
     *
     * @return bool             Vlozen v poradku?
     */
    public function addNewUser(string $login, string $password, string $full_name, string $email, int $permID, int $phone, int $postal_code, string $address, string $country, string $city)
    {
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $full_name = htmlspecialchars($full_name);
        $email = htmlspecialchars($email);
        $permID = htmlspecialchars($permID);
        $phone = htmlspecialchars($phone);
        $postal_code = htmlspecialchars($postal_code);
        $address = htmlspecialchars($address);
        $country = htmlspecialchars($country);
        $city = htmlspecialchars($city);

        echo "Ahoj 2.1";

        $user = $this->isInTable($login, $email, $password);

        echo "Ahoj 2.2";

        if (!isset($user) || count($user) == 0) {

            $q = "INSERT INTO " . TABLE_USER . " (user_id,login,password,full_name,email,perm_id,phone,postal_code,address,country,city) VALUES (NULL,:login, :password, :full_name, :email, :permID, :phone, :postal_code, :address, :country, :city)";
            $output = $this->pdo->prepare($q);
            $output->bindValue(":login", $login);
            $output->bindValue(":password", $password);
            $output->bindValue(":full_name", $full_name);
            $output->bindValue(":email", $email);
            $output->bindValue(":permID", $permID);
            $output->bindValue(":phone", $phone);
            $output->bindValue(":postal_code", $postal_code);
            $output->bindValue(":address", $address);
            $output->bindValue(":country", $country);
            $output->bindValue(":city", $city);


            if ($output->execute()) {
                return true;
            } else {
                return false;
            }
        }
//        // hlavicka pro vlozeni do tabulky uzivatelu
//        $insertStatement = "full_name, email, password, phone, address, postal_code, city, country, perm_id, login";
//        // hodnoty pro vlozeni do tabulky uzivatelu
//        $insertValues = "'$full_name', '$email', '$password', '$phone', '$address', '$postal_code', '$city', '$country', '$permID', '$login'";
//        // provedu dotaz a vratim jeho vysledek
//        return $this->insertIntoTable(TABLE_USER, $insertStatement, $insertValues);
        return false;
    }

    public function addNewProduct(string $product_name, string $country, int $price, int $quantity, int $category_id, string $text)
    {
        $product_name = htmlspecialchars($product_name);
        $country = htmlspecialchars($country);
        $price = htmlspecialchars($price);
        $quantity = htmlspecialchars($quantity);
        $category_id = htmlspecialchars($category_id);
        $text = htmlspecialchars($text);

//        echo "Ahoj 2.1";


            $q = "INSERT INTO " . TABLE_PRODUCT . " (product_id,product_name,country,price,quantity,category_id,text) VALUES (NULL,:product_name, :country, :price, :quantity, :category_id, :text)";
//        echo "Ahoj 2.2";

        $output = $this->pdo->prepare($q);
//            echo "Ahoj 2.3";
            $output->bindValue(":product_name", $product_name);
            $output->bindValue(":country", $country);
            $output->bindValue(":price", $price);
            $output->bindValue(":quantity", $quantity);
            $output->bindValue(":category_id", $category_id);
            $output->bindValue(":text", $text);
//        echo "Ahoj 2.4";
        try {
            if ($output->execute()) {
//                echo "Ahoj 2.4.true";
                return true;
            } else {
//                echo "Ahoj 2.4.false";
                return false;
            }
        } catch (PDOException $e) {
            // Log or print the error message
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

    public function addToCart(int $user_id, int $product_id)
    {
        $quantity = 1;
        $user_id = htmlspecialchars($user_id);
        $product_id = htmlspecialchars($product_id);
        $quantity = htmlspecialchars($quantity);
        $q = "INSERT INTO " . TABLE_CART . " (user_id,product_id,quantity) VALUES (:user_id,:product_id,:quantity)";
        $output = $this->pdo->prepare($q);
        $output->bindValue(":user_id", $user_id);
        $output->bindValue(":product_id", $product_id);
        $output->bindValue(":quantity", $quantity);
        if ($output->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewOrder(int $user_id, int $total, int $number)
    {
        $payment = 0;
        $user_id = htmlspecialchars($user_id);
        $total = htmlspecialchars($total);
        $number = htmlspecialchars($number);

        $q = "INSERT INTO " . TABLE_ORDER_DETAIL . " (user_id,total,payment,number) VALUES (:user_id,:total,:payment,:number)";
        $output = $this->pdo->prepare($q);
        $output->bindValue(":user_id", $user_id);
        $output->bindValue(":payment", $payment);
        $output->bindValue(":total", $total);
        $output->bindValue(":number", $number);

        if ($output->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewOrderItem(int $product_id, int $quantity, int $order_id)
    {
        $product_id = htmlspecialchars($product_id);
        $quantity = htmlspecialchars($quantity);
        $order_id = htmlspecialchars($order_id);

        $q = "INSERT INTO " . TABLE_ORDER_ITEM . " (product_id,quantity,order_id) VALUES (:product_id,:quantity,:order_id)";
        $output = $this->pdo->prepare($q);
        $output->bindValue(":product_id", $product_id);
        $output->bindValue(":quantity", $quantity);
        $output->bindValue(":order_id", $order_id);

        if ($output->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Uprava konkretniho uzivatele v databazi.
     *
     * @param int $userID ID upravovaneho uzivatele.
     * @param string $login Login.
     * @param string $password Heslo.
     * @param string $full_name Jmeno.
     * @param string $email E-mail.
     * @param int $permID ID prava.
     * @return bool             Bylo upraveno?
     */
    public function updateUser(int $userID, string $login, string $password, string $full_name, string $email, int $permID)
    {
        // slozim cast s hodnotami
        $updateStatementWithValues = "login='$login', password='$password', full_name='$full_name', email='$email', perm_id='$permID'";
        // podminka
        $whereStatement = "user_id=$userID";
        // provedu update
        return $this->updateInTable(TABLE_USER, $updateStatementWithValues, $whereStatement);
    }
    public function updateQuantity(int $product_id, int $quantity)
    {
        $updateStatementWithValues = "quantity='$quantity'";

        $whereStatement = "product_id=$product_id";
        return $this->updateInTable(TABLE_PRODUCT, $updateStatementWithValues, $whereStatement);
    }

    public function updateRights(int $userID, int $permID)
    {
//        echo "ahoj2.1";
        // slozim cast s hodnotami
        $updateStatementWithValues = "perm_id='$permID'";
        // podminka
        $whereStatement = "user_id=$userID";
        // provedu update
        return $this->updateInTable(TABLE_USER, $updateStatementWithValues, $whereStatement);
    }



    /**
     * Uprava konkretniho uzivatele v databazi.
     *
     * @param int $userID ID upravovaneho uzivatele.
     * @param string $login Login.
     * @param string $password Heslo.
     * @param string $full_name Jmeno.
     * @param string $email E-mail.
     * @param int $permID ID prava.
     * @return bool             Bylo upraveno?
     */
    public function updateProduct(int $product_id, int $price, int $quantity, int $category_id)
    {
        // slozim cast s hodnotami
        $updateStatementWithValues = "price='$price', quantity='$quantity', category_id='$category_id'";
        // podminka
        $whereStatement = "product_id=$product_id";
        // provedu update
        return $this->updateInTable(TABLE_PRODUCT, $updateStatementWithValues, $whereStatement);
    }
    public function decrease(int $value, int $decrement){
        $value = $value - $decrement;
        return $value;
    }
    public function increase(int $value, int $increment){
        $value = $value + $increment;
        return $value;
    }

}

?>
