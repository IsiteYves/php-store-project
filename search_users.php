<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common_styles.css" />
    <link rel="stylesheet" href="./not_home_page.css" />
    <title>Search Users by username</title>
    <style>
        .input-item {
            margin: 3% auto;
        }

        .input-item:first-child {
            margin: 3% 0 0 0;
            width: 70%;
        }

        .input-item:first-child input {
            width: 100%;
            padding: 2% 3%;
            border: 0.8px solid #ccc;
            outline: none;
            font-size: 17px;
            color: #363434;
            font-family: 'Segoe UI Emoji';
        }

        .input-item:first-child input::placeholder {
            color: #808080;
        }

        .input-item:first-child input:focus {
         border: 0.8px solid #b3b1b1;   
        }

        input[type=submit] {
            background-color: #1e90ff;
            font-family: 'Segoe UI Emoji';
            color: #fff;
            padding: 2% 6%;
            text-align: center;
            border: none;
            font-size: 16px;
            font-weight: 500;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #2a74be;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <?php
        session_start();
        if(!empty($_SESSION['role'])):
            echo '<div style="position: relative;top: 5%;left: -3%;">&nbsp;&nbsp;&nbsp;<a href="./index.php?q=logout">Logout</a></div>';
        else:
            header('location: index.php');
        endif;
        ?>
        <h4>Search users by username:</h4>
        <form action="./users/read_users.php?action=search" method="POST">
            <div class="input-item">
                <input type="search" name="search-field" placeholder="Search here...">
            </div>
            <div class="input-item">
                <input type="submit" name="search-btn" value="Search" required>
            </div>
        </form>
        <div>
            <a href="index.php">Go back to the Home page</a>
        </div>
    </div>
</body>

</html>