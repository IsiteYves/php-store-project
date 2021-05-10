<?php
session_start();
if (empty($_SESSION['userId'])):
    header('location: index.php');
else:
    if($_SESSION['role'] != 'Administrator' and $_SESSION['role'] != 'Manager'):
        header('location: account.php');
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Internet Info</title>
    <link rel="stylesheet" href="long-table.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: rgb(253, 253, 253);
        }

    td,table,th{
        border: 1px solid black;
        background-color: white;
    }

    tr,th,td{
        padding: 1em;
        background-color: white;
    }

    h3{
        margin-top: 2em;
    }

    table{
        background-color: white;
        border-collapse: collapse;
    }

    .table-container2 {
        background-color: white;
        margin: 4em auto auto auto;
        max-height: 50vh;
        width:55em;
        max-width: 100vw;
        overflow: auto;
        padding: 1em;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
    }

    button{
        width: 12em;
        margin-left: 43em;
        padding: 0.5em;
        padding-left: 1em;
        background-color: rgb(241, 241, 255);
        border:none;
        margin-top: 4em;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
    }

    p {
        position: relative;
        top: 2rem;
        text-align: center;
    }

    a {
        text-decoration: none;
        color: #1e90ff;
    }

    .back-anchor {
        position: relative;
        top: 2rem;
    }
    </style>
</head>
<body>
<?php
include 'connect_to_db.php';
include 'UserInfo.php';

$sql = "SELECT * FROM addresses";

$query = mysqli_query($db_connection, $sql);
if (!$query) {
    echo mysqli_error($db_connection);
} else {?>
<h3>User's Login Activity(Mac Address and Other Info)</h3>
    <p>
        <a href="./home.php">Back to dashboard</a>
    </p>
    <div class="table-container2">
    <table >
    <tr>
    <th>Username</th>
    <th>Time logged In</th>
    <th>Mac Address</th>
    <th>Ip Address</th>
    <th>Os Name</th>
    <th>Browser</th>
    </tr>
    <?php while (list($address_id, $mac, $ip, $os, $browser, $username, $time_logged_in) = mysqli_fetch_array($query)) {?>
    <tr>
    <td><?=$username?></td>
    <td><?=$time_logged_in?></td>
    <td><?=$mac?></td>
    <td><?=$ip?></td>
    <td><?=$os;?></td>
    <td><?=$browser;?></td>
    </tr>
    <?php }?>
    </table>
    </div>
<?php
}
?>
</body>
</html>