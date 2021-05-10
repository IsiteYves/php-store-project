<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common_styles.css">
    <link rel="stylesheet" href="../not_home_page.css">
    <link rel="stylesheet" href="../long-table.css">
    <title>List of All Registered Products</title>
</head>

<body>
    <div class="container users-container">
        <h2>Store Management System</h2>
        <?php
if (!empty($_SESSION['role'])):
    echo '<div style="position: relative;top: 5%;left: -3%;">&nbsp;&nbsp;&nbsp;<a href="../index.php?q=logout">Logout</a></div>';
else:
    header('location: ../index.php');
endif;
?>
        <h4>List of registered products:</h4>
        <?php
include "../connect_to_db.php";
if (!$db_connection) {
    echo "Couldn't connect to the database.";
} else {
    $sql = "SELECT p.productId, p.product_Name, p.brand, p.supplier_phone, p.supplier, p.userId, p.added_date, u.username FROM stk_products p INNER JOIN stk_users u ON p.userId=u.userId";
    $db_result = mysqli_query($db_connection, $sql);
    $products = array();
    while ($row = mysqli_fetch_array($db_result)) {
        array_push($products, $row);
    }
    $nbr_of_products = count($products);
    if ($nbr_of_products < 1) {
        echo "<p>Currently, There are no registered products.</p>";
    } else {
        echo "<div class=\"table-container\"><table border=1>
                    <tr>
                    <th>ProductId</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Supplier phone</th>
                    <th>Supplier</th>
                    <th>Registered by</th>
                    <th>Added date</th>
                    <th>Update</th>
                    <th>Delete</th>
                    </tr>";
        for ($x = 0; $x < $nbr_of_products; $x++) {
            echo "<tr>
                    <td>" . $products[$x]['productId'] . "</td>
                    <td>" . $products[$x]['product_Name'] . "</td>
                    <td>" . $products[$x]['brand'] . "</td>
                    <td>" . $products[$x]['supplier_phone'] . "</td>
                    <td>" . $products[$x]['supplier'] . "</td>
                    <td>" . $products[$x]['username'] . "</td>
                    <td>" . $products[$x]['added_date'] . "</td>
                    <td><a href=\"update_product.php?id=" . $products[$x]['productId'] . "\">Update</td>
                    <td><a href=\"delete_product.php?id=" . $products[$x]['productId'] . "\">Delete</td>
                    </tr>";
        }
        echo "</table></div>";
    }
}
?>
        <div>
            <a href="../products_crud.php">Go back to Products Table CRUD</a>
        </div>
    </div>
</body>

</html>