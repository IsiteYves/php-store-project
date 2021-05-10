<?php
session_start();
if (empty($_SESSION['userId'])) :
    header('location: ../index.php');
endif;
include "../connect_to_db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common_styles.css" />
    <link rel="stylesheet" href="../not_home_page.css" />
    <title>User creation response</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>User creation response:</h4>
        <p>
            <?php
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $telephone = trim($_POST['telephone']);
            $gender = trim($_POST['gender']);
            $roleId = trim($_POST['role-id']);
            $nationality = trim($_POST['nationality']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $sql = "SELECT * FROM stk_users WHERE username='$username'";
            $sql2 = "SELECT * FROM stk_users WHERE email='$email'";
            $user_query = mysqli_query($db_connection, $sql);
            $email_result = mysqli_query($db_connection, $sql2);

            if (!$db_connection) {
                echo "DB Connection Error..." . mysqli_connect_error($db_connection);
            } else {
                if (strlen($password) < 5) {
                    echo "<span style=\"color: red;\">Error:<br>Your password must be at least 5 characters long.</span>";
                } else {
                    if ($password != $cpassword) {
                        echo "<span style=\"color: red;\">Error:<br>The password must match the confirmed password.</span>";
                    } else {
                        if (mysqli_num_rows($email_result) != 0) {
                            echo "<span style=\"color: red;\">Error:<br>Email already taken.</span>";
                        } else {
                            if (mysqli_num_rows($user_query) != 0) {
                                echo "<span style=\"color: red;\">Error:<br>Username already taken.</span>";
                            } else {
                                $password = hash("SHA512", $password);
                                $query = "INSERT INTO stk_users(firstName, lastName, telephone, gender, roleId, nationality, username, email, password) VALUES('$firstname', '$lastname', '$telephone', '$gender', $roleId, '$nationality', '$username', '$email', '$password')";
                                $insert_user = mysqli_query($db_connection, $query);
                                if ($insert_user) {
                                    echo "<span style=\"color: green;\">$firstname $lastname was registered successfully.</span>";
                                } else {
                                    echo "<span style=\"color: red;\">User registration error..." . mysqli_error($db_connection) . "</span>";
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </p>
        <div>
            <a href="./read_users.php?action=all">See the list of all registered users</a>
        </div>
    </div>
</body>

</html>