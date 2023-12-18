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
     * Select z jedné tabulky
     *
     * @param string $tableName Název tabulky
     * @param string $whereStatement Pripadne omezeni na ziskani radek tabulky. Default "".
     * @param string $orderByStatement Pripadne razeni ziskanych radek tabulky. Default "".
     * @return array                    Vraci pole ziskanych radek tabulky.
     */
//    public function selectFromTable(string $tableName, string $whereStatement = "", string $orderByStatement = ""): array
//    {
//        $q = "SELECT * FROM " . $tableName
//            . (($whereStatement == "") ? "" : " WHERE $whereStatement")
//            . (($orderByStatement == "") ? "" : " ORDER BY $orderByStatement");
//
//        $obj = $this->executeQuery($q);
//        if ($obj == null) {
//            return [];
//        }
//        return $obj->fetchAll();
//    }

    /**
     * Upráva řádku databáze
     *
     * @param string $tableName Nazev tabulky.
     * @param string $updateStatementWithValues Cela cast updatu s hodnotami.
     * @param string $whereStatement Cela cast pro WHERE.
     * @return bool                                 Upraveno v poradku?
     */
//    public function updateInTable(string $tableName, string $updateStatementWithValues, string $whereStatement): bool
//    {
//
//        $q = "UPDATE $tableName SET $updateStatementWithValues WHERE $whereStatement";
//
//        $obj = $this->executeQuery($q);
//        if ($obj == null) {
//            return false;
//        } else {
//            return true;
//        }
//    }

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

    /**
     * Získání jedné dané řeky podle jména řeky
     *
     * @param string $jmenoReky Jméno řeky
     * @return array    Pole se řekou.
     */
//    public function getExactReka(string $jmenoReky): ?array
//    {
//        $q = "SELECT * FROM " . TABLE_REKY . " WHERE nazev=:nazev;";
//        $vystup = $this->pdo->prepare($q);
//        $vystup->bindValue(":nazev", $jmenoReky);
//        if ($vystup->execute()) {
//            return $vystup->fetchAll();
//        } else {
//            return null;
//        }
//    }

    /**
     * Získání jedné řeky podle jejího ID.
     *
     * @param int $id ID hledané řeky
     * @return array    Pole s řekou.
     */
//    public function getExactRekaById(int $id): array
//    {
//        $reka = $this->selectFromTable(TABLE_REKY, "id_reky='$id'");
//        return $reka[0];
//    }


    /**
     * Získání všech lodí, které jsou v jedné objednávce
     *
     * @param int $idObjednavky ID objednávky ve které hledám lodě
     * @return array    Pole se vsemi loděmi.
     */
//    public function getAllLodeByIdObjednavky(int $idObjednavky): array
//    {
//        $lode = $this->selectFromTable(TABLE_OBJEDNAVKA_LODE, "OBJEDNAVKA_id_objednavky='$idObjednavky'");
//        return $lode;
//    }


    /**
     * Získání dané lodě podle jejího jména
     *
     * @param $nazev
     * @return array    Pole s lodí.
     */
//    public function getExactLodByName($nazev): ?array
//    {
//        $q = "SELECT * FROM " . TABLE_LODE . " WHERE typ_lode=:nazev;";
//        $vystup = $this->pdo->prepare($q);
//        $vystup->bindValue(":nazev", $nazev);
//        if ($vystup->execute()) {
//            return $vystup->fetchAll();
//        } else {
//            return null;
//        }
//    }

    /**
     * Získání všeho příslušenství, které je u jedné objednávky
     *
     * @param int $idObjednavky ID objednávky ve které hledám příslušenství
     * @return array    Pole s příslušenstvím
     */
//    public function getAllPrisluByIdObjednavky(int $idObjednavky): array
//    {
//        $prislu = $this->selectFromTable(TABLE_POMOCNA_PRISLUSENSTVI, "OBJEDNAVKA_id_objednavky='$idObjednavky'");
//        return $prislu;
//    }


    /**
     * Získání daného příslušenství podle jejo jména
     *
     * @param $nazev
     * @return array    Pole s lodí.
     */
//    public function getExactPrisluByName($nazev): ?array
//    {
//        $q = "SELECT * FROM " . TABLE_PRISLUSENSTVI . " WHERE nazev_prislusen=:nazev;";
//        $vystup = $this->pdo->prepare($q);
//        $vystup->bindValue(":nazev", $nazev);
//        if ($vystup->execute()) {
//            return $vystup->fetchAll();
//        } else {
//            return null;
//        }
//    }


    /**
     * Vytvoření celé objednávky
     *
     * @param $id /ID objednávky
     * @param $datumVyberu /Datum vypůjčení
     * @param $id_user /ID uživatele, který vytvořil objednávku
     * @param $id_reky /ID řeky, která byla vybrána
     * @param $datumVraceni /Datum vrácení
     * @param int $schvalena Byla schálena? 0 - NE || 1 - ANO
     * @return bool                 Povedlo se vytvořit objednávku?
     */
//    public function vytvorObjednavku($id, $datumVyberu, $id_user, $id_reky, $datumVraceni, $schvalena = 0): bool
//    {
//
//        $q = "INSERT INTO " . TABLE_OBJEDNAVKA . " (id_objednavky,datum_vytvoreni,USER_id_user,REKY_id_reky,schvalena,datum_vraceni)
//        VALUES (:idObj,:datumVyberu, :ID_User, :ID_Reky,:schvalena,:datumVraceni);";
//        $vystup = $this->pdo->prepare($q);
//
//        $vystup->bindValue(":idObj", $id);
//        $vystup->bindValue(":datumVyberu", $datumVyberu);
//        $vystup->bindValue(":ID_User", $id_user);
//        $vystup->bindValue(":ID_Reky", $id_reky);
//        $vystup->bindValue(":schvalena", $schvalena);
//        $vystup->bindValue(":datumVraceni", $datumVraceni);
//
//        if ($vystup->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Přidání příslušenství dané objednávky
     *
     * @param $idPrislu /ID příslušenství
     * @param $idObj /ID objednávky
     * @param $pocet /Počet příslušenství
     * @return bool     Povedlo se přidat?
     */
//    public function pridejPrislusenstvi($idPrislu, $idObj, $pocet): bool
//    {
//
//        $q = "INSERT INTO " . TABLE_POMOCNA_PRISLUSENSTVI . " (PRISLUSENSTVI_id_prislusenstvi,OBJEDNAVKA_id_objednavky,pocet)
//        VALUES (:idPrislu,:idObj,:pocet);";
//        $vystup = $this->pdo->prepare($q);
//
//        $vystup->bindValue(":idPrislu", $idPrislu);
//        $vystup->bindValue(":idObj", $idObj);
//        $vystup->bindValue(":pocet", $pocet);
//
//        if ($vystup->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Přidání lodí dané objednávky
     *
     * @param $idlod /ID lodi
     * @param $idObj /ID objednávky
     * @param $pocet /Počet lodí
     * @return bool     Povedlo se?
     */
//    public function pridejLod($idlod, $idObj, $pocet): bool
//    {
//
//        $q = "INSERT INTO " . TABLE_OBJEDNAVKA_LODE . " (LODE_id_lod,OBJEDNAVKA_id_objednavky,pocet)
//        VALUES (:idLod,:idObj,:pocet);";
//        $vystup = $this->pdo->prepare($q);
//
//        $vystup->bindValue(":idLod", $idlod);
//        $vystup->bindValue(":idObj", $idObj);
//        $vystup->bindValue(":pocet", $pocet);
//
//        if ($vystup->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Přidání řeky
     *
     * @param $idReky /ID řeky
     * @param $nazev /Název řeky
     * @return bool     Povedlo se?
     */
//    public function pridejReku($idReky, $nazev): bool
//    {
//
//        $q = "INSERT INTO " . TABLE_REKY . " (id_reky,nazev)
//        VALUES (:idReky,:nazev);";
//        $vystup = $this->pdo->prepare($q);
//
//        $vystup->bindValue(":idReky", $idReky);
//        $vystup->bindValue(":nazev", $nazev);
//
//        if ($vystup->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Přidání řeky
     *
     * @param $idPrislusenstvi
     * @param $nazev /Název příslušenství
     * @param $cena
     * @return bool     Povedlo se?
     */
//    public function pridejNovePrislusenstvi($idPrislusenstvi, $nazev, $cena): bool
//    {
//
//        $q = "INSERT INTO " . TABLE_PRISLUSENSTVI . " (id_prislusenstvi,nazev_prislusen,cena)
//        VALUES (:idPrislu,:nazev,:cena);";
//        $vystup = $this->pdo->prepare($q);
//
//        $vystup->bindValue(":idPrislu", $idPrislusenstvi);
//        $vystup->bindValue(":nazev", $nazev);
//        $vystup->bindValue(":cena", $cena);
//
//        if ($vystup->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    /**
     * Přidání řeky
     *
     * @param $idLodi
     * @param $nazev /Název řeky
     * @param $cena
     * @return bool     Povedlo se?
     */
//    public function pridejNovouLod($idLodi, $nazev, $cena): bool
//    {
//
//        $q = "INSERT INTO " . TABLE_LODE . " (id_lod,typ_lode,cena)
//        VALUES (:idLodi,:nazev,:cena);";
//        $vystup = $this->pdo->prepare($q);
//
//        $vystup->bindValue(":idLodi", $idLodi);
//        $vystup->bindValue(":nazev", $nazev);
//        $vystup->bindValue(":cena", $cena);
//
//        if ($vystup->execute()) {
//            return true;
//        } else {
//            return false;
//        }
//    }


    /**
     * Nalezne uživatele s daným emailem a heslem
     *
     * @param $email /Email uživatele v databázi
     * @param $password /Heslo uživatele
     * @return mixed        Vrácení uživatele pokud se povede nebo vrátí NULL
     */
//    public function vratUzivatele($email, $password)
//    {
//
//        $q = "SELECT * FROM " . TABLE_USER . " WHERE email=:uLogin AND password=:uHeslo;";
//        $vystup = $this->pdo->prepare($q);
//        $vystup->bindValue(":uLogin", $email);
//        $vystup->bindValue(":uHeslo", $password);
//        if ($vystup->execute()) {
//            return $vystup->fetchAll();
//        } else {
//            return null;
//        }
//    }



    /**
     * Úprava konkrétní objednávky
     *
     * @param int $idObjednavky ID objednávky
     * @param $datum_vytvoreni /Datum vypůjčení
     * @param int $USER_id_user /ID uživatele, který je autor objednávky
     * @param int $REKY_id_reky /ID řeky, která byla vybrána
     * @param int $schvalena /Schávalena? 0 = NE || 1 = ANO
     * @param $datum_vraceni /Datum vrácení objednávky
     * @return bool                 Byla upravena?
     */
//    public function updateObjednavka(int $idObjednavky, $datum_vytvoreni, int $USER_id_user, int $REKY_id_reky, int $schvalena, $datum_vraceni): bool
//    {
//        $updateStatementWithValues = "id_objednavky='$idObjednavky', datum_vytvoreni='$datum_vytvoreni', USER_id_user='$USER_id_user', REKY_id_reky='$REKY_id_reky', schvalena='$schvalena', datum_vraceni='$datum_vraceni'";
//
//        $whereStatement = "id_objednavky=$idObjednavky";
//
//        return $this->updateInTable(TABLE_OBJEDNAVKA, $updateStatementWithValues, $whereStatement);
//    }

    public function selectFromTable(string $tableName, string $whereStatement = "", string $orderByStatement = ""): array
    {
        // slozim dotaz
        $q = "SELECT * FROM " . $tableName
            . (($whereStatement == "") ? "" : " WHERE $whereStatement")
            . (($orderByStatement == "") ? "" : " ORDER BY $orderByStatement");
        // provedu ho a vratim vysledek
        $obj = $this->executeQuery($q);
        // pokud je null, tak vratim prazdne pole
        if ($obj == null) {
            return [];
        }
        // projdu jednotlive ziskane radky tabulky
        /*while($row = $vystup->fetch(PDO::FETCH_ASSOC)){
            $pole[] = $row['login'].'<br>';
        }*/
        // prevedu vsechny ziskane radky tabulky na pole
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

}

?>
