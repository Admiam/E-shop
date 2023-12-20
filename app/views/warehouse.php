<head>
<?php
require("components/head.php");
$createHead = new \components\head();
$createHead->createHead();

global $tplData, $categories, $products;

?>
</head>
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
    <h1 class="title">Sklad</h1>
    <a class="add-btn" href="index.php?page=newProduct">Přidat produkt</a>

    <?php
    echo "<div class='container'>
        <div class='row py-5'>
            <div class='col-12'>
                <table id='example' class='table table-hover responsive nowrap' style='width:100%'>
                    <thead>
                        <tr>
                            <th>Jméno</th>
                            <th>Cena</th>
                            <th>Množství</th>
                            <th>Kategorie</th>
                            <th>Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                    ";

    foreach ($products as $u) {
        $initials = strtoupper(substr($u['full_name'], 0, 2));

        echo "  <form method='POST' id='myForm'>  
                <div class='my-5'>
                <tr>
            <td>
                <a href='#' style='text-decoration: none'>
                <input type='hidden' name='product_id' value='{$u['product_id']}'>
                    <div class='d-flex align-items-center'>
                        <div>
                            <p class='font-weight-bold mb-0'>{$u['product_name']}</p>
                            <p class='text-muted mb-0'>{$u['country']}</p>
                        </div>
                    </div>
                </a>
            </td>
            <td><input type='number' name='price' value='{$u['price']}'></input></td>
            <td><input type='number' name='quantity' value='{$u['quantity']}'></input></td>
            <td>
                <select name='category_id'>";
                foreach ($categories as $c) {
                    $selected = ($u['category_id'] == $c['category_id']) ? "selected" : "";
                    echo "<option value='{$c['category_id']}' $selected>{$c['category_name']}</option>";

                }

                echo"</select>
            </td>
            <td>
                <div class='dropdown nav-text w-full'>
                        <a class='dropbtn w-ful' style='text-decoration: none'>Více</a>
                        <div class='dropdown-content w-full'>                        
                            <input class='all-full bx bxs-pencil mx-2' type='submit' name='update' value='Upravit'></input><br>
                            <input class='text-danger bx bxs-trash mx-2' type='submit' name='delete' value='Odstranit'></input>
                        </div>
      
                </div>
            </td>
        </tr>
        </div>
       </form>


";
    }


    echo "
</tbody>
        </table>
    </div>
</div>
</div>";
    ?>


</section>

</body>
</html>