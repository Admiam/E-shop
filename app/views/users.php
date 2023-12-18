<head>
<?php
require("components/head.php");
$createHead = new \components\head();
$createHead->createHead();

global $tplData, $users, $rights;

?>
</head>
<!DOCTYPE html>
<html lang="cz">
<body class=" bg-green h-full">
<section class=" d-flex flex-column  h-full">
    <header class="" id="header">
        <?php
        require("components/header.php");
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
                    <tbody>
                    ";

    foreach ($users as $u) {
        $initials = strtoupper(substr($u['full_name'], 0, 2));

        echo "  <form method='POST' id='myForm'>  
                <div class='my-5'>
                <tr>
            <td>
                <a href='#' style='text-decoration: none'>
                <input type='hidden' name='user_id' value='{$u['user_id']}'>
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
        if ($tplData["perm_id"] == $u["perm_id"] && $tplData["perm_id"] == 1) {$switch = 1;
        } else if($tplData["perm_id"] == $u["perm_id"] && $tplData["perm_id"] == 2){
            $switch = 2;
        }else {
            $switch = 0;
        }

        switch ($switch) {
            case 1:
                foreach ($rights as $r) {
                    $selected = ($u['perm_id'] == $r['perm_id']) ? "selected" : "";
                    if ($r['perm_id'] == 1) {
                        echo "<option value='{$r['perm_id']}' $selected>{$r['name']}</option>";
                    }
                }
                break;
            case 2:
                    foreach ($rights as $r) {
                        $selected = ($u['perm_id'] == $r['perm_id']) ? "selected" : "";
                        if ( $r['perm_id'] == 2) {
                            echo "<option value='{$r['perm_id']}' $selected>{$r['name']}</option>";
                        }
                    }
                break;
            default:
                if ($tplData["perm_id"] == 2 && $u['perm_id'] == 1) {
                    foreach ($rights as $r) {
                        $selected = ($u['perm_id'] == $r['perm_id']) ? "selected" : "";
                        if ($r['perm_id'] == 1) {
                            echo "<option value='{$r['perm_id']}' $selected>{$r['name']}</option>";
                        }
                    }

                }else if ($tplData["perm_id"] == 1) {
                    foreach ($rights as $r) {
                        $selected = ($u['perm_id'] == $r['perm_id']) ? "selected" : "";
                        if ($r['perm_id'] != 1) {
                            echo "<option value='{$r['perm_id']}' $selected>{$r['name']}</option>";
                        }
                    }
                }else if ($tplData["perm_id"] == 2){
                    foreach ($rights as $r) {
                        $selected = ($u['perm_id'] == $r['perm_id']) ? "selected" : "";
                        if ($r['perm_id'] != 1 && $r['perm_id'] != 2) {
                            echo "<option value='{$r['perm_id']}' $selected>{$r['name']}</option>";
                        }
                    }
                }
                break;
        }



        echo "</select>
            </td>
            <td>
                <div class='dropdown nav-text w-full'>";
                if ($tplData["perm_id"] == 2) {
                    if ($u['perm_id'] == 1 || $u['perm_id'] == 2) {
                        echo "<a class='dropbtn w-full' style='text-decoration: none'>Nic tu není</a>";
                    }else{
                        echo"<a class='dropbtn w-ful' style='text-decoration: none'>Více</a>
                        <div class='dropdown-content w-full'>                        
                            <input class='all-full bx bxs-pencil mx-2' type='submit' name='update' value='Upravit'></input><br>
                            <input class='text-danger bx bxs-trash mx-2' type='submit' name='delete' value='Odstranit'></input>
                        </div>";
                    }
                }else if ($tplData["perm_id"] == 1) {
                    if ($u['perm_id'] == 1) {
                        echo "<a class='dropbtn w-full' style='text-decoration: none'>Nic tu není</a>";
                    }else{
                        echo"<a class='dropbtn w-ful' style='text-decoration: none'>Více</a>
                        <div class='dropdown-content w-full'>                        
                            <input class='all-full bx bxs-pencil mx-2' type='submit' name='update' value='Upravit'></input><br>
                            <input class='text-danger bx bxs-trash mx-2' type='submit' name='delete' value='Odstranit'></input>
                        </div>";
                    }
                }
                    echo "
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
<?php
//require("components/footer.php");
//$getFooter = new \components\footer();
//$getFooter->getFooter();
//?>
</body>
<!-- Include jQuery -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css"
      src="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css"
      src="https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css">
<link rel="stylesheet" type="text/css"
      src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<!--<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
<!--<script type="text/javascript" charset="utf8"-->
<!--        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>-->
<!--<script type="text/javascript" charset="utf8"-->
<!--        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" charset="utf8"-->
<!--        src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>-->
<!--<script type="text/javascript" charset="utf8"-->
<!--        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>-->
<!--<script type="text/javascript" charset="utf8"-->
<!--        src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>-->
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $("#example").DataTable({-->
<!--            responsive: true,-->
<!--            aaSorting: [],-->
<!---->
<!--            columnDefs: [-->
<!--                {-->
<!--                    responsivePriority: 1,-->
<!--                    targets: 0-->
<!--                },-->
<!--                {-->
<!--                    responsivePriority: 2,-->
<!--                    targets: -1-->
<!--                }-->
<!--            ]-->
<!--        });-->
<!--        $(".dataTables_filter input")-->
<!--            .attr("placeholder", "Search here...")-->
<!--            .css({-->
<!--                width: "300px",-->
<!--                display: "inline-block"-->
<!--            });-->
<!---->
<!--        $('[data-toggle="tooltip"]').tooltip();-->
<!---->
<!---->
<!--    });-->
<!---->
<!--</script>-->
</html>