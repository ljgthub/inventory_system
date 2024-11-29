<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "motorparts_inventory";

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE motorparts_inventory";
if (mysqli_query($conn, $sql)) {
    echo "Database has been created";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_table = "CREATE TABLE items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(99) NOT NULL,
    type VARCHAR(99),
    stock INT(12),
    price DECIMAL(10, 2) NOT NULL,
    image_path VARCHAR(255)
)";

if (mysqli_query($conn, $sql_table)) {
    echo "Table has been created";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>