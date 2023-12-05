<?php

namespace components;

class footer
{
    public static function getFooter()
    {
        ?>
        <footer class=" d-flex justify-content-center flex-column px-4 py-4">

            <div class="row text-white justify-content-between">
                <div class="col text-white">
                    <img src="../../assets/logo-w.svg" alt="T space logo">
                </div>
                <div class="flex-column col">
                    <h3>Kategorie</h3>
                    <p>Bílý čaj</p>
                    <p>Bylinný čaj</p>
                    <p>Černý čaj</p>
                    <p>Ovocný čaj</p>
                    <p>Zelený čaj</p>
                </div>
                <div class="flex-column col">
                    <h3>O nás</h3>
                    <p>Příběh</p>
                    <p>Výroba</p>
                </div>
                <div class="flex-column col">
                    <h3>Účet</h3>
                    <p>Osobní údaje</p>
                    <p>Objednávky</p>
                    <p>Seznam přání</p>
                </div>
                <div class="flex-column col">
                    <h3>Kontakt</h3>
                    <p>Tea Space</p>
                    <p>Nevim 123</p>
                    <p>333 11 Plzeň</p>
                    <p>+420 123 456 789</p>
                    <p>hello@tspace.cz</p>
                </div>
            </div>
            <div class="text-white text-center">Vytvořil s láskou k čaji Adam Míka</div>
        </footer>
        <?php
    }
}

?>