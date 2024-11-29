<?php

    require_once "db_connector.php";

    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    if (!$id) { die("No ID provided."); }

    $query = "SELECT * FROM items WHERE id = $id";
        
    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) === 0) {
        die("Item not found.");
    }
        
    $item = mysqli_fetch_assoc($result); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $stock = (int)$_POST['stock'];
        $price = (float)$_POST['price'];
        
        $update = "UPDATE items SET name = ?, type = ?, stock = ?, price = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt, "ssidi", $name, $type, $stock, $price, $id);

        if (mysqli_stmt_execute($stmt)) {
            //echo "Item updated!";
            header("Location: index.php"); 
            exit();
        } else {
            echo "Error updating item: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);

?>