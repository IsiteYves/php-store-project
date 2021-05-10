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
        if(empty($_SESSION['userId'])):
            header('location: ../index.php');
        endif;
$product_name = $_POST['product-name'];
$brand = $_POST['brand'];
$supplier = $_POST['supplier'];
$supplier_phone = $_POST['supplier-phone'];
$userId = $_SESSION['userId'];

include "../connect_to_db.php";

if (!$db_connection) {
    echo "DB Connection Error..." . mysqli_connect_error($db_connection);
} else {
    $query = "INSERT INTO stk_products(product_Name, brand, supplier_phone, supplier, userId) 
    VALUES('$product_name', '$brand', '$supplier_phone', '$supplier', $userId)";
    $insert_product = mysqli_query($db_connection, $query);
    if ($insert_product) {
        echo "<span style=\"color: green;\">The $product_name was registered successfully.</span>";
    } else {
        echo "<span style=\"color: red;\">Product registration error..." . mysqli_error($db_connection) . "</span>";
    }
}
?>
        </p>
        <div>
            <a href="./read_products.php">See the list of all registered products</a>
        </div>
    </div>
</body>

</html>