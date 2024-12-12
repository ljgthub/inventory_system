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

    function handleFileUpload($file){
        $imagePath = "uploads/" . basename($file['name']);
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "File upload failed with error code: " . $file['error'];
            return false;
        }
    
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        return move_uploaded_file($file['tmp_name'], $imagePath) ? $imagePath : false;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $stock = (int)$_POST['stock'];
        $price = (float)$_POST['price'];

        $query = "SELECT image_path FROM items WHERE id = ".$id;
        $result2 = mysqli_query($conn, $query);
        if ($result2 && mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $imagePath = $row['image_path'];
            
        } else {
            $imagePath = '';
        }

        echo $imagePath;
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = handleFileUpload($_FILES['image']);
            if ($imagePath === false) {
                echo "Error uploading image!";
                return;
            }
        }
        $update = "UPDATE items SET name = ?, type = ?, stock = ?, price = ?, image_path = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update);
        $imagePathString = (string)$imagePath;
        mysqli_stmt_bind_param($stmt, "ssidsi", $name, $type, $stock, $price, $imagePathString, $id);

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