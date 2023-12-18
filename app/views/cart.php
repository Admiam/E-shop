<html>
<head>
    <?php
    require("components/head.php");
    $createHead = new \components\head();
    $createHead->createHead();

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
<!--<h1>Shopping Cart</h1>-->

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
            <tr class="product">
                <td class="product-image">
                    <img src="https://cdn.midjourney.com/ec734fa7-8c6c-433b-96f2-23901898b175/0_2.png">
                </td>
                <td class="product-details">
                    <div class="product-title">Dingo Dog Bones</div>
                    <p class="product-description">The best dog bones of all time. Holy crap. Your dog will be begging for these things! I got curious once and ate one myself. I'm a fan.</p>
                </td>
                <td class="product-price">12.99</td>
                <td class="product-quantity">
                    <input type="number" value="2" min="1">
                </td>
                <td class="product-removal">
                    <button class="remove-product">
                        Odstranit
                    </button>
                </td>
                <td class="product-line-price">25.98</td>
            </tr>
            <tr class="product">
                <td class="product-image">
                    <img src="https://cdn.midjourney.com/ec734fa7-8c6c-433b-96f2-23901898b175/0_2.png">
                </td>
                <td class="product-details">
                    <div class="product-title">Dingo Dog Bones</div>
                    <p class="product-description">The best dog bones of all time. Holy crap. Your dog will be begging for these things! I got curious once and ate one myself. I'm a fan.</p>
                </td>
                <td class="product-price">12.99</td>
                <td class="product-quantity">
                    <input type="number" value="2" min="1">
                </td>
                <td class="product-removal">
                    <button class="remove-product">
                        Odstranit
                    </button>
                </td>
                <td class="product-line-price">25.98</td>
            </tr>
        </tbody>
    </table>

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
        </div>
    </div>

    <button class="checkout">Zaplatit</button>

</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="views/js/cart.js"></script>
</html>