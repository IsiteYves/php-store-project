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
    <title>Outgoing update response</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>Outgoing update response:</h4>
        <p>
        <?php
        $OutgoingId = $_REQUEST['id'];
        $quantity = $_POST['quantity'];
        $productId = $_POST['productId'];

        include "../connect_to_db.php";

       if (!$db_connection) {
        echo "DB Connection Error..." . mysqli_connect_error($db_connection);
       } else {
            $query = "UPDATE stk_outgoing SET quantity=$quantity, productId=$productId";
            $update_Outgoing = mysqli_query($db_connection, $query);
        if ($update_Outgoing) {
            echo "<span style=\"color: green;\">Outgoing $OutgoingId was successfully updated.</span>";
        } else {
            echo "<span style=\"color: red;\">Outgoing update error..." . mysqli_error($db_connection) . "</span>";
         }
        }
?>
        </p>
        <div>
            <a href="./update_outgoing.php?id=<?= $OutgoingId ?>">Go Back</a>
        </div>
        <div>
            <a href="./read_outgoings.php">See the list of all registered Outgoings</a>
        </div>
    </div>
</body>

</html>