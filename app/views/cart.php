<html>
<head>
    <?php
    require("components/head.php");
    $createHead = new \components\head();
    $createHead->createHead();
//    echo "ahoj 1";

    require_once (DIRECTORY_MODELS ."/MyDatabase.class.php");
    $this->db = new MyDatabase();

    global $cartItems, $tplData;
    $total = 0;
    ?>
    <link rel="stylesheet" href="styles/cart.css">

</head>

<body class="bg-green">
<header class="" id="header">
    <?php
    require("components/header.php");
    $createHeader = new \components\header();
    $createHeader->getHeader();
    ?>
</header>
<h1 class="title mb-5">Shopping Cart</h1>
<!--<input type>-->
<table class="shopping-cart">

    <thead class="column-labels">
    <tr>
        <th class="product-image"></th>
        <th class="product-details"></th>
        <th class="product-price">Cena</th>
        <th class="product-quantity">Množství</th>
        <th class="product-removal">Odstranit</th>
        <th class="product-line-price">Celkem</th>
    </tr>
    </thead>
        <tbody >
        <?php
        foreach ($cartItems as $c){

            $total += $c["price"];

//            var_dump($c);
//            var_dump($product);
            if($c["product_quantity"] == 0){
                $quantity = 1;
            }else{
                $quantity = $c["product_quantity"];
            }
            echo "
            <form method='POST'>    
            <tr class='product'>
                <td class='product-image'>
                    <img src='https://cdn.midjourney.com/ec734fa7-8c6c-433b-96f2-23901898b175/0_2.png'>
                </td>
                <td class='product-details' id='content'>
                    <div class='product-title'>{$c["product_name"]}</div>
                    <p class='product-description'>{$c["text"]}</p>
                </td>
                <td class='product-price'>{$c["price"]}</td>
                <td class='product-quantity'>
                    <input type='number' value={$c["quantity"]} min='1' max={$quantity}>
                </td>
                <td class='product-removal'>
                    <input type='hidden' name='cart_id' value={$c["cart_id"]}>
                    <input type='hidden' name='product_id' value={$c["product_id"]}>
                    <input type='hidden' name='quantity' value={$c["quantity"]}>
                    <input type='hidden' name='price' value={$c["price"]}>
                    <input type='hidden' name='product_quantity' value={$c["product_quantity"]}>
                    <input class='remove-product text-center' type='submit' name='delete' value='Odstranit'>
                        
                </td>
                <td class='product-line-price'>{$c["price"]}</td>
            </tr>
            </form>
            ";}
            ?>
        </tbody>
    </table>





<form method="POST">

<div class="totals">
        <div class="totals-item">
            <label>Cena bez DPH</label>
            <div class="totals-value" id="cart-subtotal"></div>
        </div>
        <div class="totals-item">
            <label>DPH (21%)</label>
            <div class="totals-value" id="cart-tax"></div>
        </div>
        <div class="totals-item">
            <label>Doprava</label>
            <div class="totals-value" id="cart-shipping"></div>
        </div>
        <div class="totals-item totals-item-total">
            <label>Celková cena</label>
            <div class="totals-value" id="cart-total"></div>
            <?php
            $total += $total * 0.21 + 70;
            echo "<input type='hidden' name='total' value='$total'>";
            ?>

        </div>
    </div>
<!--    <input type="hidden" name="total" value="total">-->
    <input class="checkout" type="submit" name="buy" value="Zaplatit" >
</form>





</body>





<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="views/js/cart.js"></script>
<script>
    function limitT(a) {
        if (a.length > 32) return a.substring(0, 150)+"...";
    }
    console.log("ahoj");

    $("#content p").text(function() {
        return limitT(this.innerHTML)
    });
</script>
</html>