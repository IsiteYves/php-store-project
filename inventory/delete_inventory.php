<?php
include "../connect_to_db.php";
session_start();
if (empty($_SESSION['role'])) {
    header('location: ../index.php');
} else {
    $inventory_id = $_REQUEST['id'];
    if (!$db_connection) {
        echo "Failed to connect to the DB..." . mysqli_connect_error($db_connection);
    } else {
        $sql = "DELETE FROM stk_inventory WHERE inventory_id=$inventory_id";
        $deletion = mysqli_query($db_connection, $sql);
        if (!$deletion) {
            echo "<span style=\"style: color: red;\">Error deleting the record..." . mysqli_error($db_connection) . "</span>";
            echo "<br><a href=\"read_inventories.php\">Ok</a>";
        } else {
            header("location: read_inventories.php");
        }
    }
}
