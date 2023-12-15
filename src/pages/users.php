<?php


require("../components/head.php");
$createHead = new \components\head();
$createHead->createHead();

require_once("MyDatabase.class.php");
$myDB = new MyDatabase();

if (!empty($_POST['user_id'])) {
    // smazu daneho uzivatele z databaze
    $res = $myDB->deleteFromTable(TABLE_USER, "user_id='$_POST[user_id]'");
    // vysledek mazani
    if ($res) {
        echo "OK: Uživatel byl smazán z databáze.";
    } else {
        echo "ERROR: Smazání uživatele se nezdařilo.";
    }
}

// ziskam data vsech uzivatelu
$users = $myDB->getAllUsers();

?>
<html>
<body>
<section class="screen d-flex flex-column second_bg">
    <header class="" id="header">
        <?php
        require("../components/header.php");
        $createHeader = new \components\header();
        $createHeader->getHeader();
        ?>
    </header>
    <h1 class="title color_orange">Správa uživatelů</h1>
    <?php
    // projdu uzivatele a vypisu je
    echo "<div class='container'>
        <div class='row py-5'>
            <div class='col-12'>
                <table id='example' class='table table-hover responsive nowrap' style='width:100%'>
                    <thead>
                        <tr>
                            <th>Jméno</th>
                            <th>Mobilní číslo</th>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Role</th>
                            <th>Akce</th>
                        </tr>
                    </thead>
                    <tbody>";

    foreach ($users as $u) {
        $initials = strtoupper(substr($u['full_name'], 0, 2));

        echo "<tr>
            <td>
                <a href='#' style='text-decoration: none'>
                    <div class='d-flex align-items-center'>
                        <div class='avatar avatar-blue mr-3'>$initials</div>

                        <div>
                            <p class='font-weight-bold mb-0'>{$u['full_name']}</p>
                            <p class='text-muted mb-0'>{$u['email']}</p>
                        </div>
                    </div>
                </a>
            </td>
            <td>{$u['phone']}</td>
            <td>{$u['user_id']}</td>
            <td>{$u['login']}</td>
            <td>
                <select name='perm'>";

        $rights = $myDB->getAllRights();
        foreach ($rights as $r) {
           
            $selected = ($u['perm_id'] == $r['perm_id']) ? "selected" : "";
            echo "<option value='{$r['perm_id']}' $selected>{$r['name']}</option>";
        }

        echo "</select>
            </td>
            <td>
                <div class='dropdown nav-text w-full'>
                    <a class='dropbtn w-full' style='text-decoration: none'>Kategorie</a>
                    <div class='dropdown-content w-full'>
                        <a class='all-full' href='#'><i class='bx bxs-pencil mx-2'></i> Upravit profil</a>
                        <a class='text-danger' href='#'><i class='bx bxs-trash mx-2'></i> Odstranit</a>
                    </div>
                </div>
            </td>
        </tr>";
    }

    echo "</tbody>
        </table>
    </div>
</div>
</div>";
    ?>

</section>
<?php
require("../components/footer.php");
$getFooter = new \components\footer();
$getFooter->getFooter();
?>
</body>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css"
      src="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css"
      src="https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css">
<link rel="stylesheet" type="text/css"
      src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $("#example").DataTable({
            responsive: true,
            aaSorting: [],

            columnDefs: [
                {
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                }
            ]
        });
        $(".dataTables_filter input")
            .attr("placeholder", "Search here...")
            .css({
                width: "300px",
                display: "inline-block"
            });

        $('[data-toggle="tooltip"]').tooltip();


    });

</script>
</html>