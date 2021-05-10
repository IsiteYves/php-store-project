<?php
include "../connect_to_db.php";
session_start();
if (empty($_SESSION['role'])) {
    header('location: ../index.php');
} else {
    if ($_SESSION['role'] != 'Administrator') {
        header('location: ../account.php');
    } else {
        $userId = $_REQUEST['id'];
        if (!$db_connection) {
            echo "Failed to connect to the DB..." . mysqli_connect_error($db_connection);
        } else {
            $sql = "DELETE FROM stk_users WHERE userId=$userId";
            $deletion = mysqli_query($db_connection, $sql);
            if (!$deletion) {
                echo "<span style=\"style: color: red;\">Error deleting the record..." . mysqli_error($db_connection) . "</span>";
                echo "<br><a href=\"read_users.php\">Ok</a>";
            } else {
                header("location: read_users.php?action=all");
            }
        }
    }
}
