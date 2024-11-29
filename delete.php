<?php
    require_once "db_connector.php";

    if (isset($_POST['id'])) {
        $itemId = $_POST['id'];

        $deleteQuery = "DELETE FROM items WHERE id=".(int)$itemId;
        mysqli_query($conn, $deleteQuery);
            
        header("Location: index.php");
    }
    mysqli_close($conn); 
?>