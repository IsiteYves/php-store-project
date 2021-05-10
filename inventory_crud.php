<?php
session_start();
if(empty($_SESSION['userId'])):
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
    <link rel="stylesheet" href="./not_home_page.css" />
    <title>Stock Inventory Table CRUD</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <div style="position: relative;top: 5%;left: -3%;">
            &nbsp;&nbsp;&nbsp;<a href="./index.php?q=logout">Logout</a>
        </div>
        <h4>CRUD for Stock Inventory Table:</h4>
        <ol>
            <li>
                <a href="./inventory/create_inventory.php">
                    Insert/Create a new Inventory
                </a>
            </li>
            <li>
                <a href="./inventory/read_inventories.php">
                    Get the list of registered Inventories
                </a>
            </li>
            <li>
                <a href="./inventory/read_inventories.php">
                    Update an Inventory
                </a>
            </li>
            <li>
                <a href="./inventory/read_inventories.php">
                    Delete an Inventory
                </a>
            </li>
        </ol>
        <div>
            <a href="home.php">Go back to the Home page</a>
        </div>
    </div>
</body>

</html>
