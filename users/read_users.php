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
    <title>List of All Registered Users</title>
</head>

<body>
    <div class="container users-container">
        <h2>Store Management System</h2>
        <?php
        if (!empty($_SESSION['role'])) :
            echo '<div style="position: absolute;top: 5%;">&nbsp;&nbsp;&nbsp;<a href="../index.php?q=logout">Logout</a></div>';
        else :
            header('location: ../index.php');
        endif;
        ?>
        <h4><?php
            if ($_REQUEST['action'] == 'search') {
                echo "Search results for \"" . $_POST['search-field'] . "\":";
            } else {
                echo "List of registered users:";
            }
            ?></h4>
        <?php
        include "../connect_to_db.php";
        $search_input = "";
        if (!$db_connection) {
            echo "Couldn't connect to the database.";
        } else {
            $sql = "";
            if ($_REQUEST['action'] == 'search') {
                $search_input = trim($_POST['search-field']);
                $sql = "SELECT u.userId, u.firstName, u.lastName, u.telephone, u.gender, u.nationality, u.username, u.email, r.role FROM stk_users u INNER JOIN roles r ON u.roleId=r.roleId WHERE username LIKE '%$search_input%'";
            } else {
                $sql = "SELECT u.userId, u.firstName, u.lastName, u.telephone, u.gender, u.nationality, u.username, u.email, r.role FROM stk_users u INNER JOIN roles r ON u.roleId=r.roleId";
            }
            $db_result = mysqli_query($db_connection, $sql);
            $users = array();
            $total_quantity = 0;
            while ($row = mysqli_fetch_array($db_result)) {
                array_push($users, $row);
            }
            $nbr_of_users = count($users);
            if ($nbr_of_users < 1) {
                if ($_REQUEST['action'] == 'search') {
                    echo "<p>No users match your search.</p>";
                } else {
                    echo "<p>Currently, There are no registered users.</p>";
                }
            } else {
                echo "<div class=\"table-container\"><table border=1>
                    <tr>
                    <th>UserId</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Telephone</th>
                    <th>Gender</th>
                    <th>Nationality</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Update User</th>
                    <th>Delete User</th>
                    </tr>";
                for ($x = 0; $x < $nbr_of_users; $x++) {
                    echo "<tr>
                    <td>" . $users[$x]['userId'] . "</td>
                    <td>" . $users[$x]['firstName'] . "</td>
                    <td>" . $users[$x]['lastName'] . "</td>
                    <td>" . $users[$x]['telephone'] . "</td>
                    <td>" . $users[$x]['gender'] . "</td>
                    <td>" . $users[$x]['nationality'] . "</td>
                    <td>" . $users[$x]['username'] . "</td>
                    <td>" . $users[$x]['email'] . "</td>
                    <td>" . $users[$x]['role'] . "</td>
                    <td><a href=\"update_user.php?id=" . $users[$x]['userId'] . "\">Update</td>
                    <td><a href=\"delete_user.php?id=" . $users[$x]['userId'] . "\">Delete</td>
                    </tr>";
                }
                echo "</table></div>";
            }
        }
        ?>
        <div>
            <a href="../users_crud.php">Go back to Users Table SCRUD</a>
        </div>
    </div>
</body>

</html>