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
    <title>Login to your account</title>
    <style>
        p,p * {
            font-family: 'Segoe UI';
        }
        p>span {
            color: #000;
            font-weight: 700;
        }

        .logout {
            position: relative;
            top: 5%;
        }
    </style>
</head>

<body>
    <?php
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    ?>
    <div class="container">
        <h2>Store Management System</h2>
        <div class="logout">
            <a href="./index.php?q=logout">Logout</a>
        </div>
        <h4>(Logged in)</h4>
        <p>Hello <span><?= $username ?></span>, welcome into your account!</p>
        <p><b>Your role:</b>&nbsp;&nbsp;<?= $role ?></p>
        <div>
            <a href="home.php">Go to Home (Dashboard)</a>
        </div>
    </div>
</body>

</html>