<?php

namespace components;

class head
{
    public static function createHead()
    {
        ?>
        <!DOCTYPE html>
        <html lang="cz">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <script src="https://kit.fontawesome.com/c1a76831d2.js" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="../../styles/main.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <title>Tea space 👾</title>

        </head>
        <?php
    }
}

?>