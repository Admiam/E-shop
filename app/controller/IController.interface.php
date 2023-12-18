<?php

/**
 * Rozhraní pro všechny Controllery
 */
interface IController {

    /**
     * Zajistí vypsání příslušné stránky
     *
     * @param string $pageTitle     Název stránky.
     * @return string               HTML dané stránky.
     */
    public function show(string $pageTitle):string;

}

?>