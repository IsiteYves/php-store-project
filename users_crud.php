<?php
session_start();
if(empty($_SESSION['userId'])):
    header('location: index.php');
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common_styles.css" />
    <link rel="stylesheet" href="./not_home_page.css" />
    <title>Users Table CRUD</title>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <div style="position: relative;top: 5%;left: -2%;">
            &nbsp;&nbsp;&nbsp;<a href="./index.php?q=logout">Logout</a>
        </div>
        <h4>CRUD for Users Table:</h4>
        <ol>
            <li>
                <a href="./users/create_user.php">
                    Insert/Create a new User
                </a>
            </li>
            <li>
                <a href="./users/read_users.php?action=all">
                    Get the list of registered Users
                </a>
            </li>
            <li>
                <a href="./users/read_users.php?action=all">
                    Update a User
                </a>
            </li>
            <li>
                <a href="./users/read_users.php?action=all">
                    Delete a User
                </a>
            </li>
            <li>
                <a href="./search_users.php">
                    Search users by username
                </a>
            </li>
        </ol>
        <div>
            <a href="home.php">Go back to the Home page</a>
        </div>
    </div>
</body>

</html>
