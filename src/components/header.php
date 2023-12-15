<?php

namespace components;

use MyDatabase;

class header
{
    public static function getHeader()
    {

        require_once("../pages/MyDatabase.class.php");
        $myDB = new MyDatabase();
        if ($_POST['action'] == 'logout') {
            // odhlasim uzivatele
            $myDB->userLogout();
        }

        ?>
        <nav class="navbar navbar-expand-sm navbar-dark ">
            <!--            <script src="../js/dropdown.js"></script>-->

            <div class="container-fluid">
                <a href="index.php?page=main"><img src="../../assets/logo-g.svg" alt="T space logo" class="logo"></a>
                <button class="navbar-toggler dropbtn nav-text" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon">
                        <i class="fa-solid fa-bars btn-primary" style="font-size: 2rem;"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ">
                            <div class="dropdown nav-text">
                                <button class="dropbtn nav-btn all-full">Kategorie</button>
                                <div class="dropdown-content w-full">
                                    <a href="index.php?page=white_tea" class="nav-el">Bílý čaje</a>
                                    <a href="index.php?page=herbs_tea" class="nav-el">Bylinné čaje</a>
                                    <a href="index.php?page=black_tea" class="nav-el">Černé čaje</a>
                                    <a href="index.php?page=fruit_tea" class="nav-el">Ovocné čaje</a>
                                    <a href="index.php?page=green_tea" class="nav-el">Zelené čaje</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="index.php?page=about">
                                <button class="dropbtn  nav-btn all-full">O nás</button>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="index.php?page=contact">
                                <button class="dropbtn nav-btn all-full">Kontakt</button>
                            </a>
                        </li>
                        <?php
                        if ($myDB->isUserLogged() && ($myDB->getLoggedUserData()["perm_id"] == 1) || ($myDB->getLoggedUserData()["perm_id"] == 2)) {

                            ?>
                            <li class="nav-item dropdown">
                                <a href="index.php?page=users">
                                    <button class="dropbtn nav-btn all-full">Správa uživatelů</button>
                                </a>
                            </li>
                            <?php
                        }
                        if ($myDB->isUserLogged() && ($myDB->getLoggedUserData()["perm_id"] == 1) || ($myDB->getLoggedUserData()["perm_id"] == 2) || ($myDB->getLoggedUserData()["perm_id"] == 3)) {
                            ?>
                            <li class="nav-item dropdown">
                                <a href="index.php?page=warehouse">
                                    <button class="dropbtn nav-btn all-full">Sklad</button>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <a href="#" class="mr-4"><i class="fa-solid fa-basket-shopping nav-icons btn-primary"></i></a>
                    <?php
                    if ($myDB->isUserLogged()) {

                        ?>

                        <a href="index.php?page=account"><i class="fa-solid fa-user nav-icons btn-primary"></i></a>

                        <form action="" method="POST">
                            <input type="hidden" name="action" value="logout" class=" all-full">
                            <input type="submit" name="potvrzeni" value="Odhlásit" class="btn-primary all-full">
                        </form>

                        <?php
                    } else {
                        ?>
                        <a href="index.php?page=login" class="nav-text">Login</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </nav>

        <?php
    }
}

?>