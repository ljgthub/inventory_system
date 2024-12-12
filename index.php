<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/bc44e66a1b.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }
    ?>

    <div id="nav">
        <span id="logo">Motorparts and Accessories</span>
        <div id="links">
            <span>Orders</span>
            <span>Sales</span>
            <span>Inventory</span>
            <span id="profile">
                <i class="fa-solid fa-user"></i> 
            </span>
        </div>
    </div>

    <div id="logout" style="display: none;"> <span id="logout_btn"><i class="fa-solid fa-right-from-bracket"></i>  Log Out</span> </div>
    
    <div id="search_div">
        <i class="fa-solid fa-search"></i>
        <input type="text" id="inp" style="border: none; width: 90%; height: 100%; margin-left: 10px;">
    </div>

    <!-- Form for new item -->
    <form id="item_form" class="item_form_show" action="create.php" method="post" enctype="multipart/form-data">
        <h3>Create Item</h3>
        <div id="pic">
            <div><img src="uploads" alt="" id="img_pic" style="width: 100%; height: 150px;"></div>
            <button class="btn" id="upload_image_btn" type="button" style="margin-top: 10px;">Upload Image</button>
            <input type="file" name="image" class="image_input" id="image_input" style="display: none;">
        </div>
        <div style="margin-top: 50px;">
            <label for="name">Item Name: </label> <br>
            <input type="text" name="name" id="name" autocomplete="off" required>
        </div>
        <div>
            <label for="type">Type: </label> <br>
            <select name="type" class="type" id="type">
                <option value="Motorparts">Motorparts</option>
                <option value="Accessories">Accessories</option>
            </select>
        </div>
        <div>
            <label for="stock">Stocks:</label> <br>
            <input type="text" name="stock" id="stock" autocomplete="off" required>
        </div>
        <div>
            <label for="price">Price: </label> <br>
            <input type="text" name="price" id="price" autocomplete="off" required>
        </div>

        <div id="cc">
            <button class="btn confirm_btn" id="create_btn" type="submit" name="insert">Create</button>
        </div>
        <div id="cancel_cont">
            <button class="cancel_btn" id="cancel_btn" type="button">Cancel</button>
        </div>
    </form>

    <!-- For edit item -->
    <form id="edit_form" class="item_form" action="edit.php" method="post" enctype="multipart/form-data">
        <h3>Update Item</h3>
        <div id="pic2">
            <div><img src="uploads" alt="" id="img_pic2" style="width: 100%; height: 150px;"></div>
            <button class="btn" id="upload_image_btn2" type="button" style="margin-top: 10px;">Upload Image</button>
            <input type="file" name="image" class="image_input" id="edit_image" style="display: none;">
        </div>

        <input type="text" name="id" id="edit_id" style="display: none;">

        <div style="margin-top: 50px;">
            <label for="name">Item Name: </label> <br>
            <input type="text" name="name" id="edit_name" autocomplete="off" required>
        </div>
        <div>
            <label for="type">Type: </label> <br>
            <select name="type" class="type" id="edit_type">
                <option value="Motorparts">Motorparts</option>
                <option value="Accessories">Accessories</option>
            </select>
        </div>
        <div>
            <label for="stock">Stocks:</label> <br>
            <input type="text" name="stock" id="edit_stock" autocomplete="off" required>
        </div>
        <div>
            <label for="price">Price: </label> <br>
            <input type="text" name="price" id="edit_price" autocomplete="off" required>
        </div>

        <div id="cc">
            <button class="btn confirm_btn" id="edit_btn" type="submit" name="insert">Edit</button>
        </div>
        <div id="cancel_cont">
            <button class="cancel_btn" id="edit_cancel_btn" type="button">Cancel</button>
        </div>
    </form>

    <form id="delete_form" class="item_form" action="delete.php" method="post" enctype="multipart/form-data">
        <div id="warn">
            
        </div>
        <input type="text" name="id" id="delete_id" style="display:none;">
        <div id="warn_btn">
            <button class="btn confirm_btn" id="yes_btn" type="submit" name="insert">Yes, delete it!</button>
            <button class="btn confirm_btn" id="no_btn" type="button" name="insert">No, cancel!</button>
        </div>
    </form>

    <!-- Sort and Create New Item -->
    <div class="container">
        <div class="sort">
            <label for="services" style="font-weight: bold;">Type:</label>
            <br>
            <select id="type_select" name="services" class="select">
                <option value="" disabled selected>Select Type...</option>
                <option value="Motorparts" class="type_select">Motorparts</option>
                <option value="Accessories" class="type_select">Accessories</option>
                <option value="N/A" class="type_select">N/A</option>
            </select>
            <br><br><br>
            <label for="services" style="font-weight: bold;">Sort by:</label>
            <br>
            <input type="radio" name="sort" class="sort" id="stock_sort" style="margin-top: 10px;" value="stock"> <label for="stock_sort"> Stock</label>
            <br>
            <input type="radio" name="sort" class="sort" id="price_sort" style="margin-top: 10px;" value="price"> <label for="price_sort"> Price</label>
            <br><br><br>
            <button id="new_btn" class="new_stock btn">+ Create New Item</button>
        </div>

        <div class="item_container" id="item_container">
            <?php include('read.php'); ?>
        </div>
    </div>

    <script src="index.js"></script>
</body> 
</html>
