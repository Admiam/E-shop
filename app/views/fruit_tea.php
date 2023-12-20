<head>
    <?php
    require("components/head.php");
    $createHead = new \components\head();
    $createHead->createHead();
    global $tplData, $products;
    ?>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<html>
<body>
<section class=" d-flex flex-column bg-green">
    <header class="" id="header">
        <?php
        require("components/header.php");
        $createHeader = new \components\header();
        $createHeader->getHeader();
        ?>
    </header>
    <h1 class="title">Ovocné čaje</h1>
    <div class="grid-container px-5 my-5">
        <?php
        foreach ($products as $p) {
            $randomNumber = rand(1, 1000);
            if ($p["quantity"] > 0){
            echo "<form method='POST'>
    <div class='grid-item example-2 custom-card'>
        <div style='background: url(\"https://cdn.midjourney.com/6105a884-41ee-40ee-b13f-4fd1f6d9c688/0_0.png\"); background-size: cover;' class='wrapper'>
            <div class='header'>
                <div class='price'>
                    <span>{$p["price"]} Kč</span>
                </div>
                <ul class='menu-content'>
                    <li>
                        <a href='#' class='fa fa-bookmark-o' style='text-decoration: none'></a>
                    </li>
                    <li><a href='#' class='fa fa-heart-o' style='text-decoration: none'><span>{$randomNumber}</span></a></li>
                </ul>
            </div>
            <div class='data'>
                <div class='product-content' id='content'>
                    <h1 class='product-name' ><a href='#' style='text-decoration: none; font-size: 1.7rem'>{$p["product_name"]}</a></h1>
                    <p class='product-text'>{$p["text"]}</p>
                    <input type='hidden' name='id' value='{$p["product_id"]}'/>
                    <input type='hidden' name='quantity' value='{$p["quantity"]}'/>
                     <a href='#' class='button' style='text-decoration: none'>                
                        <input type='submit' name='buy' value='Koupit' class='buy-tea'>
                     </a>
                </div>
            </div>
        </div>
    </div>
    </form>
";
        }
        }
        ?>



    </div>
</section>
<?php
require("components/footer.php");
$getFooter = new \components\footer();
$getFooter->getFooter();
?>
</body>
<script>
    function limitT(a) {
        if (a.length > 32) return a.substring(0, 90)+"...";
    }
    // console.log("ahoj");

    $("#content p").text(function() {
        return limitT(this.innerHTML)
    });
</script>
</html>