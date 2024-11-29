<?php

    require_once "db_connector.php";

    $query = "SELECT * FROM items";

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)) {
        $element = "";
        $element .= "<img src='" . $row['image_path'] . "' alt=''>";
        $element .= "<p id='name_p'><span>" . $row['name'] . "</span></p>";
        $element .= "<p id='id_p'>[<span>" . $row['id'] . "</span>]</p>";    
        $element .= "<p id='type_p'><span>" . $row['type'] . "</span></p>";
        $element .= "<p id='stock_p'>Qty. <span>" . $row['stock'] . "</span></p>";
        $element .= "<p id='price_p'><span>" . $row['price'] . "</span> PHP</p>";
        $element2 = "<div id='buttons'>
                        <button class='btn edit_btn'><i class='fa-solid fa-pen'></i></button>
                        <button class='btn delete_btn'><i class='fa-solid fa-trash'></i></button>
                    </div>";
        echo "<div class='item'>" . "<div class='item_content'>" . $element . "</div>" . $element2 . "</div>";
    }

    
?>

