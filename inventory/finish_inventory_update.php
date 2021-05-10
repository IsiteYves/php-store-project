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
    <title>Inventory update response</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>Inventory Update response:</h4>
        <p>
        <?php
        $InventoryId = $_REQUEST['id'];
        $quantity = $_POST['quantity'];
        $productId = $_POST['productId'];

        include "../connect_to_db.php";

       if (!$db_connection) {
        echo "DB Connection Error..." . mysqli_connect_error($db_connection);
       } else {
            $query = "UPDATE stk_inventory SET quantity=$quantity, productId=$productId";
            $update_Inventory = mysqli_query($db_connection, $query);
        if ($update_Inventory) {
            echo "<span style=\"color: green;\">Inventory $InventoryId was successfully updated.</span>";
        } else {
            echo "<span style=\"color: red;\">Inventory update error..." . mysqli_error($db_connection) . "</span>";
         }
        }
?>
        </p>
        <div>
            <a href="./update_inventory.php?id=<?= $InventoryId ?>">Go Back</a>
        </div>
        <div>
            <a href="./read_inventories.php">See the list of all registered Inventories</a>
        </div>
    </div>
</body>

</html>