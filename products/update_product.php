<?php
session_start();
if (empty($_SESSION['userId']) or empty($_SESSION['role'])) :
    header('location: ../index.php');
else :
    if ($_SESSION['role'] != 'Manager' and $_SESSION['role'] != 'Administrator') :
        header('location: ../account.php');
    endif;
endif;

if (empty($_SESSION['userId'])) :
    header('location: ../index.php');
endif;
$productId = $_REQUEST['id'];
include "../connect_to_db.php";
$product_name = "";
$brand = "";
$supplier_phone = "";
$supplier = "";
$userId = "";
if (!$db_connection) {
    echo "DB Connection error..." . mysqli_connect_error($db_connection);
} else {
    $query = "SELECT * FROM stk_products WHERE productId=$productId";
    $result = mysqli_query($db_connection, $query);
    $row = mysqli_fetch_array($result);
    $product_name = $row['product_Name'];
    $brand = $row['brand'];
    $supplier_phone = $row['supplier_phone'];
    $supplier = $row['supplier'];
    $userId = $row['userId'];
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
    <title>Update <?= $product_name ?>'s info</title>
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
        <h4>Update product with id <?= $productId ?>:</h4>
        <form action="./finish_product_update.php?id=<?= $productId ?>" method="POST" autocomplete="off">
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="pname">New name for the Product</label>
                </div>
                <div class="input-sub-item">
                    <input type="text" name="product-name" id="pname" value="<?= $product_name ?>" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="brand">Brand</label>
                </div>
                <div class="input-sub-item">
                    <input type="text" name="brand" id="brand" value="<?= $brand ?>" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="supplier">Supplier</label>
                </div>
                <div class="input-sub-item">
                    <input type="text" name="supplier" id="supplier" value="<?= $supplier ?>" required />
                </div>
            </div>
            <div class="input-item">
                <div class="input-sub-item">
                    <label for="sup-tel-number">Supplier phone</label>
                </div>
                <div class="input-sub-item">
                    <input type="tel" name="supplier-phone" id="sup-tel-number" value="<?= $supplier_phone ?>" maxlength="14" />
                </div>
            </div>
            <div class="submission-btn-holder">
                <input type="submit" name="product-create-button" value="Update Product" />
            </div>
            <div class="go-to-home">
                <a href="../products_crud.php">Go back to Products Table CRUD</a>
            </div>
        </form>
    </div>
</body>

</html>