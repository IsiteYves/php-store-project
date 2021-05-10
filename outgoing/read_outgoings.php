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
    <title>List of All Registered Outgoings</title>
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
        <h4>List of registered Outgoings:</h4>
        <?php
include "../connect_to_db.php";
if (!$db_connection) {
    echo "Couldn't connect to the database.";
} else {
    $sql = "SELECT * FROM stk_outgoing";
    $db_result = mysqli_query($db_connection, $sql);
    $outgoings = array();
    while ($row = mysqli_fetch_array($db_result)) {
        array_push($outgoings, $row);
    }
    $nbr_of_outgoings = count($outgoings);
    if ($nbr_of_outgoings < 1) {
        echo "<p>Currently, There are no registered outgoings.</p>";
    } else {
        echo "<div class=\"table-container\"><table border=1>
                    <tr>
                    <th>Outgoing Id</th>
                    <th>Quantity</th>
                    <th>Product Id</th>
                    <th>Registered by</th>
                    <th>Added date</th>
                    <th>Update Outgoing</th>
                    <th>Delete Outgoing</th>
                    </tr>";
        for ($x = 0; $x < $nbr_of_outgoings; $x++) {
            $registrant_id = $outgoings[$x]['userId'];
            $sql2 = "SELECT username FROM stk_users WHERE userId=$registrant_id";
            $query = mysqli_query($db_connection, $sql2);
            $username = "";
            while (list($name) = mysqli_fetch_array($query)) {
                $username = $name;
            }
            echo "<tr>
                    <td>" . $outgoings[$x]['outgoingId'] . "</td>
                    <td>" . $outgoings[$x]['quantity'] . "</td>
                    <td>" . $outgoings[$x]['productId'] . "</td>
                    <td>$username</td>
                    <td>" . $outgoings[$x]['added_date'] . "</td>
                    <td><a href=\"update_outgoing.php?id=" . $outgoings[$x]['outgoingId'] . "\">Update</td>
                    <td><a href=\"delete_outgoing.php?id=" . $outgoings[$x]['outgoingId'] . "\">Delete</td>
                    </tr>";
        }
        echo "</table></div>";
    }
}
?>
        <div>
            <a href="../outgoing_crud.php">Go back to Outgoing Table CRUD</a>
        </div>
    </div>
</body>

</html>