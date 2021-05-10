<?php
include "connect_to_db.php";
include "UserInfo.php";
$errors = [];
$email = "";
if (!$db_connection) {
    die("Failed to connect to db..." . mysqli_connect_error($db_connection));
} else {
    session_start();
    if (!empty($_SESSION['userId'])):
        header('location: ./account.php');
    endif;
    if (isset($_REQUEST['q'])) {
        if ($_REQUEST['q'] == 'logout'):
            session_destroy();
        endif;
    }
    if (isset($_POST['login-btn']) and !empty($_POST['email']) and !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $password = hash("SHA512", $password);
        $sql = "SELECT u.userId, u.email, u.username, u.password, r.role FROM stk_users u INNER JOIN roles r ON u.roleId=r.roleId WHERE u.email='$email' AND u.password='$password'";
        $query = mysqli_query($db_connection, $sql);
        if (mysqli_num_rows($query) == 0) {
            array_push($errors, "Incorrect credentials.");
        } else {
            while (list($userId, $email, $username, $password, $role) = mysqli_fetch_array($query)) {
                $_SESSION['userId'] = $userId;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $MAC = exec('getmac');
                $MAC = strtok($MAC, ' ');

                $IP = gethostbyname(gethostname());
                $os = UserInfo::get_os();

                function get_browser_name($user_agent)
                {
                    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
                        return 'Opera';
                    } elseif (strpos($user_agent, 'Edge')) {
                        return 'Edge';
                    } elseif (strpos($user_agent, 'Chrome')) {
                        return 'Chrome';
                    } elseif (strpos($user_agent, 'Safari')) {
                        return 'Safari';
                    } elseif (strpos($user_agent, 'Firefox')) {
                        return 'Firefox';
                    } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) {
                        return 'Internet Explorer';
                    }

                    return 'Other';
                }

                $browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
                $t = time();
                $time_logged_in = date('Y-m-d h:i:s a', $t);
                $address_query = "INSERT INTO addresses(username, time_logged_in, macAddress, ipAddress, osName, browser) VALUES('$username', '$time_logged_in', '$MAC', '$IP', '$os', '$browser')";
                $address_query = mysqli_query($db_connection, $address_query);
                if (!$address_query) {
                    die(mysqli_error($db_connection));
                }
                header('location: account.php');
            }
        }
    }
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
        .input-item {
            margin: 3% auto;
        }

        .input-item:not(:last-child) {
            margin: 3% 0 0 0;
            width: 70%;
        }

        .input-item:not(:last-child) input {
            width: 100%;
            padding: 2% 3%;
            border: 0.8px solid #ccc;
            outline: none;
            font-size: 17px;
            color: #363434;
            font-family: 'Segoe UI Emoji';
        }

        label {
            font-family: 'Segoe UI Emoji';
        }

        .input-item:not(:last-child) input:focus {
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

        .errors ul {
            list-style-type: none;
        }

        .errors li {
            color: red;
            font-family: 'Segoe UI';
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Store Management System</h2>
        <h4>Login</h4>
        <div class="errors">
            <ul>
            <?php
for ($x = 0; $x < count($errors); $x++) {
    echo "<li>" . $errors[$x] . "</li>";
}
?>
            </ul>
        </div>
        <form action="index.php" method="POST">
            <div class="input-item">
                <label for="email">Your email</label>
                <input type="email" name="email" value="<?=$email?>" required />
            </div>
            <div class="input-item">
                <label for="password">Password</label>
                <input type="password" name="password" required />
            </div>
            <div class="input-item">
                <input type="submit" name="login-btn" value="Login">
            </div>
        </form>
        <div>
            <a href="home.php">Go back to the Home page</a>
        </div>
    </div>
</body>

</html>

