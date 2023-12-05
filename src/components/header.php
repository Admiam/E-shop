<?php

namespace components;

class header
{
    public static function getHeader()
    {
        ?>
        <header class="d-flex header flex-row justify-content-between pt-4 px-4" id="header">

            <img src="../../assets/logo-g.svg" alt="T space logo">
            <div class="nav" id="mainListDiv">
                <div class="dropdown nav-text">
                    <button class="dropbtn all-full">Kategorie</button>
                    <div class="dropdown-content w-full">
                        <a href="#" class="nav-el">Bílé čaje</a>
                        <a href="#" class="nav-el">Bylinné čaje</a>
                        <a href="#" class="nav-el">Černé čaje</a>
                        <a href="#" class="nav-el">Ovocné čaje</a>
                        <a href="#" class="nav-el">Zelené čaje</a>
                    </div>
                </div>
                <div class="dropdown nav-text">
                    <button class="dropbtn all-full">O nás</button>
                </div>
                <div class="dropdown nav-text">
                    <button class="dropbtn all-full">Kontakt</button>
                </div>
            </div>
            <div>
                <a href="#" class="mr-4"><i class="fa-solid fa-basket-shopping nav-icons mx-4"></i></a>
                <?php
                require_once("MyDatabase.class.php");
                $myDB = new MyDatabase();

                if ($myDB->isUserLogged()) {
                    // ziskam data prihlasenoho uzivatele
                    ?>
                    <a href="account.php"><i class="fa-solid fa-user nav-icons"></i></a>
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <?php
                } else {
                    ?>
                    <a href="login.php" class="nav-text">Login</a>
                    <?php
                }
                ?>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </header>

        <?php
    }
}

?>