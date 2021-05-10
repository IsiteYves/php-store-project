<?php

session_start();
if (empty($_SESSION['role'])) {
    header('location: ../login.php');
} else {
    if ($_SESSION['role'] != 'Manager') {
        header('location: ../account.php');
    } else {
        include "../connect_to_db.php";
        $productId = $_REQUEST['id'];
        if (!$db_connection) {
            echo "Failed to connect to the DB..." . mysqli_connect_error($db_connection);
        } else {
            $sql = "DELETE FROM stk_products WHERE productId=$productId";
            $deletion = mysqli_query($db_connection, $sql);
            if (!$deletion) {
                echo "<span style=\"style: color: red;\">Error deleting the record..." . mysqli_error($db_connection) . "</span>";
                echo "<br><a href=\"read_products.php\">Ok</a>";
            } else {
                header("location: read_products.php");
            }
        }
    }
}
