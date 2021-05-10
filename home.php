<?php
session_start();
if (empty($_SESSION['userId'])):
    header('location: index.php');
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common_styles.css" />
    <title>Store Management System - Home</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>Options:</h4>
        <div style="position: relative;top: 2%;">
            &nbsp;&nbsp;&nbsp;<a href="./index.php?q=logout">Logout</a>
        </div>
        <ol>
            <li>
                <a href="./account.php">&leftarrow;&nbsp;&nbsp;Back</a>
            </li>
            <?php
            if(!empty($_SESSION['role'])):
                echo "<li><a href=\"./macaddress.php\">View Login Activity</a></li>";
            endif;
            ?>
            <li>
                <a href="./users_crud.php">
                    Users Table SCRUD
                </a>
            </li>
            <li>
                <a href="./products_crud.php">
                    Products Table CRUD
                </a>
            </li>
            <li>
                <a href="./inventory_crud.php">
                    Stock Inventory Table CRUD
                </a>
            </li>
            <li>
                <a href="./outgoing_crud.php">
                    Stock Outgoing Table CRUD
                </a>
            </li>
            <li>
                <a href="./quantity_by_product_in.php">
                    Quantity by product registered in store
                </a>
            </li>
            <li>
                <a href="./quantity_by_product_out.php">
                    Total Quantity by product taken in store
                </a>
            </li>
            <li>
                <a href="./products_quantities_in.php">
                    List of all products with quantities registered in store
                </a>
            </li>
            <li>
                <a href="./products_quantities_out.php">
                    List of all products with quantities taken in store
                </a>
            </li>
        </ol>
    </div>
</body>

</html>
