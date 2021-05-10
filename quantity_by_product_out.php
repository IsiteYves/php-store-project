<?php
    session_start();
    if(empty($_SESSION['userId'])) {
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common_styles.css" />
    <link rel="stylesheet" href="./not_home_page.css" />
    <title>Total quantity by product taken out of the store</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <div style="position: relative;top: 5%;left: -3%;">
            &nbsp;&nbsp;&nbsp;<a href="./index.php?q=logout">Logout</a>
        </div>
        <h4>Total quantity by product taken out of the store:</h4>
        <?php
            include "connect_to_db.php";
            if (!$db_connection) {
                echo "Couldn't connect to the database.";
            } else {
                $sql = "SELECT * FROM stk_products";
                $db_result = mysqli_query($db_connection, $sql);
                $products_quantities = array();
                while($row = mysqli_fetch_array($db_result)){
                    $productId = $row['productId'];
                    $product_name = $row['product_Name'];
                    $quantity_query = "SELECT quantity FROM stk_outgoing WHERE productId=$productId";
                    $quantity_result = mysqli_query($db_connection, $quantity_query);
                    $total_quantity = 0;
                    while(list($pQuantity) = mysqli_fetch_array($quantity_result)){
                        $total_quantity += $pQuantity;
                    }
                    array_push($products_quantities, array($productId, $product_name, $total_quantity));
                }
                $products_nbr = count($products_quantities);
                if($products_nbr < 1){
                    echo "<p>Currently, There are no products registered to have gone out of the store.</p>";
                }else{
                    echo "<table border=1>
                    <tr>
                    <th>ProductId</th>
                    <th>Product Name</th>
                    <th>Total quantity Taken Out</th>
                    </tr>";
                    for($x=0;$x<$products_nbr;$x++){
                        echo "<tr>
                        <td>".$products_quantities[$x][0]."
                        <td>".$products_quantities[$x][1]."
                        <td>".$products_quantities[$x][2]."
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