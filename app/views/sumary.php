<html lang="cz">
<head>
    <?php
    require("components/head.php");
    $createHead = new \components\head();
    $createHead->createHead();
    global $tplData, $receipt, $order;

    ?>
    <link rel="stylesheet" href="styles/receipt.css">

</head>

<body class="">

<div class="product">
    <div class="product_title">
        Shrnutí objednávky
    </div>
    <div class="product_content">
        <?php
        foreach ($receipt as $r){
        echo"
        <div class='product_item grid-container'>
            <div class='product_item_name'>
                {$r['product_name']}
            </div>
            <div class='product_item_quantity'>
                {$r['quantity']}
            </div>
            <div class='product_item_price'>
                {$r['price']}kč
            </div>
        </div>
        ";
        }
        ?>
    </div>
    <div class="product_total grid-container-total">
        <div>Celkem:</div>
        <?php echo"<div>{$order[0]['total']}kč</div>" ?>

    </div>
    <div>
        <a href="index.php?page=main" class="back">Jít zpět</a>
    </div>
</div>
</body>
</html>