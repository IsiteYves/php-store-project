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
    <link rel="stylesheet" href="./long-table.css" />
    <title>All products with quantities registered in store</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <div style="position: relative;top: 5%;left: -3%;">
            &nbsp;&nbsp;&nbsp;<a href="./index.php?q=logout">Logout</a>
        </div>;
        <h4>All products with quantities registered in store:</h4>
        <?php
include "connect_to_db.php";
if (!$db_connection) {
    echo "Couldn't connect to the database.";
} else {
    $sql = "SELECT * FROM stk_inventory";
    $db_result = mysqli_query($db_connection, $sql);
    $products_quantities = array();
    while($row = mysqli_fetch_array($db_result)){
        $productId = $row['productId'];
        $sql2 = "SELECT product_Name FROM stk_products WHERE productId=$productId LIMIT 1";
        $db_result2 = mysqli_query($db_connection, $sql2);
        while(list($pName) = mysqli_fetch_array($db_result2)){
            array_push($products_quantities, array($row['inventory_id'], $row['productId'], $pName, $row['quantity']));
        }
    }
    $products_nbr = count($products_quantities);
    if ($products_nbr < 1) {
        echo "<p>Currently, There are no products registered to have gone into the store.</p>";
    } else {
        echo "<table border=1>
                    <tr>
                    <th>Inventory Id</th>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    </tr>";
        for ($x = 0; $x < $products_nbr; $x++) {
            echo "<tr>
                        <td>" . $products_quantities[$x][0] . "
                        <td>" . $products_quantities[$x][1] . "
                        <td>" . $products_quantities[$x][2] . "
                        <td>" . $products_quantities[$x][3] . "
                        </tr>";
        }
        echo "</table>";
    }
}
?>
        <div>
            <a href="home.php">Go back to the Home page</a>
        </div>
    </div>
</body>

</html>