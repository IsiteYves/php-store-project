<?php
include "../connect_to_db.php";
$userId = $_REQUEST['id'];
session_start();
if (empty($_SESSION['role'])) :
    header('location: ../index.php');
else :
    if ($_SESSION['userId'] != $userId) :
        header('location: ../account.php');
    endif;
endif;
$firstname = "";
$lastname = "";
$telephone = "";
$gender = "";
$dbRoleId = 0;
$nationality = "";
$countries = array();
if (!$db_connection) {
    echo "DB Connection error..." . mysqli_connect_error($db_connection);
} else {
    $query = "SELECT * FROM stk_users WHERE userId=$userId";
    $result = mysqli_query($db_connection, $query);
    $row = mysqli_fetch_array($result);
    $firstname = $row['firstName'];
    $lastname = $row['lastName'];
    $telephone = $row['telephone'];
    $gender = $row['gender'];
    $dbRoleId = $row['roleId'];
    $nationality = $row['nationality'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common_styles.css" />
    <link rel="stylesheet" href="../not_home_page.css" />
    <title>Update <?= $firstname . " " . $lastname ?>'s Details</title>
    <style>
        form {
            max-height: 64vh;
            overflow: auto;
        }

        form::-webkit-scrollbar {
            width: 8px;
        }

        form::-webkit-scrollbar-track {
            border-radius: 20px;
            box-shadow: 0 0 5px inset #b3b1b1;
        }

        form::-webkit-scrollbar-thumb {
            background-color: #b6b5b5;
            border-radius: 20px;
        }

        form::-webkit-scrollbar-thumb:hover {
            background-color: #9e9c9c;
        }

        h4:first-of-type {
            font-size: 19px;
            text-align: center !important;
        }

        .input-item {
            margin: 0.2% auto;
            width: 80%;
        }

        .input-item:not(:first-child) {
            margin: 5% auto;
        }

        .gender-inputs {
            position: relative;
            width: 40%;
            top: 0.5em;
            display: flex;
            justify-content: space-between;
        }

        .gender-inputs label {
            color: #696666;
        }

        .gender-inputs>* {
            width: 100%;
        }

        .input-sub-item:first-child label {
            z-index: 1;
            color: #808080;
            font-family: 'Segoe UI Emoji';
        }

        .input-sub-item:first-child {
            transition: all 0.3s ease-in;
        }

        .input-item:not(:nth-child(4)) .input-sub-item:first-child {
            position: relative;
        }

        input[type=text],
        input[type=number],
        input[type=password],
        select {
            border: none;
            outline: none;
            border-bottom: 0.5px solid #ccc;
            border-radius: 0;
            width: 100%;
            z-index: 20;
            font-family: 'Segoe UI Emoji';
            font-size: 17px;
            color: #312e2e;
        }

        .input-sub-item:last-child>input[type=text]:valid label,
        .input-sub-item:last-child>input[type=number]:valid+.input-sub-item:first-child,
        .input-sub-item:last-child>input[type=password]:valid+.input-sub-item:first-child {
            display: none;
            top: -0.4em;
        }

        /* .input-item:focus-within .input-sub-item:first-child {
            top: -0.4em;
        } */

        .go-to-home {
            text-align: center;
            margin-top: 1em;
        }

        .submission-btn-holder {
            margin: 8% auto 5% auto;
            text-align: center;
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
        <h4>Update your details</h4>
        <form action="./finish_user_update.php?id=<?= $userId ?>" method="POST" autocomplete="off">
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="fname">Firstname</label>
                </div>
                <div class="input-sub-item">
                    <input type="text" name="firstname" id="fname" value="<?= $firstname ?>" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="lname">Lastname</label>
                </div>
                <div class="input-sub-item">
                    <input type="text" name="lastname" id="lname" value="<?= $lastname ?>" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="tel-number">Telephone</label>
                </div>
                <div class="input-sub-item">
                    <input type="number" name="telephone" id="tel-number" value="<?= $telephone ?>" minlength="9" maxlength="10" min="0" max="9999999999" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label>Gender</label>
                </div>
                <div class="gender-inputs">
                    <div class="gender-sub-item">
                        <label for="male">Male</label>
                        <?php
                        if ($gender == "male") {
                            echo "<input type=\"radio\" name=\"gender\" id=\"male\" value=\"male\" checked />";
                        } else {
                            echo "<input type=\"radio\" name=\"gender\" id=\"male\" value=\"male\" />";
                        }
                        ?>
                    </div>
                    <div class="gender-sub-item">
                        <label for="female">Female</label>
                        <?php
                        if ($gender == "female") {
                            echo "<input type=\"radio\" name=\"gender\" id=\"female\" value=\"female\" checked />";
                        } else {
                            echo "<input type=\"radio\" name=\"gender\" id=\"female\" value=\"female\" />";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['role'] == 'Administrator') { ?>
                <div class="input-item">
                    <div class="input-sub-item">
                        <label for="role">User role</label>
                    </div>
                    <div class="input-sub-item">
                        <select name="role-id" id="role" required>
                            <option value="">Select role</option>
                            <?php
                            include "../connect_to_db.php";
                            if (!$db_connection) {
                                die(mysqli_connect_error($db_connection));
                            } else {
                                $c_query = "SELECT * FROM roles";
                                $db_result = mysqli_query($db_connection, $c_query);
                                while (list($roleId, $role) = mysqli_fetch_array($db_result)) {
                                    if ($roleId == $dbRoleId) :
                                        echo "\n<option value=\"$roleId\" selected>$role</option>";
                                    else :
                                        echo "\n<option value=\"$roleId\">$role</option>";
                                    endif;
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="nationality">Your nationality</label>
                </div>
                <div class="input-sub-item">
                    <select name="nationality" id="nationality" required>
                        <?php
                        include "../connect_to_db.php";
                        $database = "World_Countries";
                        $db_connection = mysqli_connect($host, $db_username, $db_password, $database);
                        if (!$db_connection) {
                            echo "<option style=\"color: red;\">" . mysqli_connect_error($db_connection) . "</option>";
                        } else {
                            $c_query = "SELECT nicename FROM country";
                            $db_result = mysqli_query($db_connection, $c_query);
                            while (list($nicename) = mysqli_fetch_array($db_result)) {
                                array_push($countries, $nicename);
                            }
                            for ($a = 0; $a < count($countries); $a++) {
                                if ($countries[$a] == $nationality) {
                                    echo "\n<option selected>" . $countries[$a] . "</option>";
                                } else {
                                    echo "\n<option>" . $countries[$a] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="password">New password</label>
                </div>
                <div class="input-sub-item">
                    <input type="password" name="password" id="password" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="confirmed-password">Confirm new password</label>
                </div>
                <div class="input-sub-item">
                    <input type="password" name="cpassword" id="confirmed-password" required />
                </div>
            </div>
            <div class="submission-btn-holder">
                <input type="submit" name="user-create-button" value="Update User" />
            </div>
            <div class="go-to-home">
                <a href="../users_crud.php">Go back to Users Table CRUD</a>
            </div>
        </form>
    </div>
</body>

</html>