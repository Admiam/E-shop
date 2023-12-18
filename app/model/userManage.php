<?php

/**
 * Třída userManage slouží ke správě uživatele
 */
class userManage
{

    /** @var string $userSessionKey Klíč pro session */
    private $userSessionKey = "current_user_id";
    /**
     * @var MyDatabase $db Správa databáze
     */
    private $db;
    /**
     * @var MySession $mySession Správa sessions
     */
    private $mySession;

    public function __construct()
    {
        require_once("MyDatabase.class.php");
        $this->db = new MyDatabase();
        require_once("MySessions.class.php");
        $this->mySession = new MySession();
    }

    /**
     * Pokusím se přihlásit uživatele
     *
     * @param string $email Email uživatele
     * @param string $heslo Heslo uzivatele.
     * @return bool         Byl prihlasen?
     */
    public function userLogin(string $login, string $password): bool
    {
        $where = "login='$login' AND password='$password'";
        $user = $this->db->selectFromTable(TABLE_USER, $where);
        // ziskal jsem uzivatele
        if (count($user)) {
            $_SESSION[$this->userSessionKey] = $user[0]['user_id']; // beru prvniho nalezeneho a ukladam jen jeho ID
            return true;
        } else {
            return false;
        }
    }

    /**
     * Odhlasím uživatele
     */
    public function userLogout()
    {
        unset($_SESSION[$this->userSessionKey]);
    }

    /**
     * Je uživatel přihlášený?
     *
     * @return bool     Je přihlášen?
     */
    public function isUserLogged(): bool
    {
        return isset($_SESSION[$this->userSessionKey]);
    }

    /**
     * Pokusím se zjistit data o uživateli, pokud je přihlášen
     *
     * @return mixed|null   Data uzivatele nebo null.
     */
    public function getLoggedUserData()
    {
        if ($this->isUserLogged()) {
            $userId = $_SESSION[$this->userSessionKey];
            if ($userId == null) {
                echo "Data o uživateli nebyla nalezena, odhlašuji uživatele!";
                $this->userLogout();
                return null;
            } else {
                $userData = $this->db->selectFromTable(TABLE_USER, "user_id=$userId");
                if (empty($userData)) {
                    echo "Data o uživateli se nenachází v naší databázi, odhlašuji!";
                    $this->userLogout();
                    return null;
                } else {
                    return $userData[0];
                }
            }
        } else {
            return null;
        }
    }


}