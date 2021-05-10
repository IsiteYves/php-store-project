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
    <title>User update response</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>User creation response:</h4>
        <p>
        <?php
        $userId = $_REQUEST['id'];
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$telephone = trim($_POST['telephone']);
$gender = trim($_POST['gender']);
$roleId = trim($_POST['role-id']);
$nationality = trim($_POST['nationality']);
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

include "../connect_to_db.php";

if (!$db_connection) {
    echo "DB Connection Error..." . mysqli_connect_error($db_connection);
} else {
    if (strlen($password) < 5) {
        echo "<span style=\"color: red;\">Error:<br>Your new password must be at least 5 characters long.</span>";
    } else {
        if ($password != $cpassword) {
            echo "<span style=\"color: red;\">Error:<br>The new password must match the confirmed password.</span>";
        } else {
            $password = hash("SHA512", $password);
            $query = "UPDATE stk_users SET firstName='$firstname', lastName='$lastname', telephone='$telephone', gender='$gender', roleId=$roleId, nationality='$nationality', password='$password' WHERE userId=$userId";
            $insert_user = mysqli_query($db_connection, $query);
            if ($insert_user) {
                echo "<span style=\"color: green;\">The user with id $userId was successfully updated.</span>";
            } else {
                echo "<span style=\"color: red;\">User update error..." . mysqli_error($db_connection) . "</span>";
            }
        }
    }
}
?>
        </p>
        <div>
            <a href="./update_user.php?id=<?= $userId ?>">Go Back</a>
        </div>
        <div>
            <a href="./read_users.php?action=all">See the new look of the list of all registered users</a>
        </div>
    </div>
</body>

</html>