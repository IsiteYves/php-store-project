<?php
session_start();
if(empty($_SESSION['userId'])):
    header('location: ../index.php');
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common_styles.css" />
    <link rel="stylesheet" href="../not_home_page.css" />
    <title>Product creation response</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>Product creation response:</h4>
        <p>
        <?php
$quantity = $_POST['quantity'];
$productId = $_POST['productId'];
$userId = $_SESSION['userId'];

include "../connect_to_db.php";

if (!$db_connection) {
    echo "DB Connection Error..." . mysqli_connect_error($db_connection);
} else {
    $query = "INSERT INTO stk_inventory(quantity, productId, userId) VALUES($quantity, $productId, $userId)";
    $insert_inventory = mysqli_query($db_connection, $query);
    if ($insert_inventory) {
        echo "<span style=\"color: green;\">Inventory was registered successfully.</span>";
    } else {
        echo "<span style=\"color: red;\">Inventory registration error..." . mysqli_error($db_connection) . "</span>";
    }
}
?>
        </p>
        <div>
            <a href="./read_inventories.php">See the list of all registered inventories</a>
        </div>
    </div>
</body>

</html>