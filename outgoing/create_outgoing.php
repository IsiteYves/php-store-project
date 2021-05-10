<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../common_styles.css" />
    <link rel="stylesheet" href="../not_home_page.css" />
    <title>Create a new Outgoing</title>
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

        .input-sub-item:first-child label {
            z-index: 1;
            color: #808080;
            font-family: 'Segoe UI Emoji';
        }

        .input-sub-item:first-child {
            transition: all 0.3s ease-in;
        }

        input[type=text],
        input[type=tel],
        input[type=email],
        input[type=number],
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
        .input-sub-item:last-child>input[type=tel]:valid+.input-sub-item:first-child,
        .input-sub-item:last-child>input[type=email]:valid+.input-sub-item:first-child,
        .input-sub-item:last-child>input[type=number]:valid+.input-sub-item:first-child {
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
        <?php
if (!empty($_SESSION['role'])):
    echo '<div style="position: relative;top: 5%;left: -3%;">&nbsp;&nbsp;&nbsp;<a href="../index.php?q=logout">Logout</a></div>';
else:
    header('location: ../index.php');
endif;
?>
        <h4>Create/Insert a new Outgoing:</h4>
        <form action="./finish_create_outgoing.php" method="POST" autocomplete="off">
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="quantity">Quantity</label>
                </div>
                <div class="input-sub-item">
                    <input type="number" name="quantity" id="quantity" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="productId">Product Id</label>
                </div>
                <div class="input-sub-item">
                    <select name="productId" id="productId" required>
                        <option value="">Select productId</option>
                        <?php
include "../connect_to_db.php";
if (!$db_connection) {
    echo "<option style=\"color: red;\">" . mysqli_connect_error($db_connection) . "</option>";
} else {
    $c_query = "SELECT productId, product_Name FROM stk_products";
    $db_result = mysqli_query($db_connection, $c_query);
    while (list($id, $p_name) = mysqli_fetch_array($db_result)) {
        echo "\n<option value=\"$id\">$id -- $p_name</option>";
    }
}
?>
                    </select>
                </div>
            </div>
            <div class="submission-btn-holder">
                <input type="submit" name="product-create-button" value="Create Outgoing" />
            </div>
            <div class="go-to-home">
                <a href="../outgoing_crud.php">Go back to Outgoing Table CRUD</a>
            </div>
        </form>
    </div>
</body>

</html>
