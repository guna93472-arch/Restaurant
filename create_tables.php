<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop and recreate orders table with all columns
$conn->query("DROP TABLE IF EXISTS orders");

$sql = "CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255),
    address TEXT,
    phone VARCHAR(50),
    subtotal DECIMAL(10,2),
    tax DECIMAL(10,2),
    total DECIMAL(10,2),
    items TEXT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "✅ Table created! Now try bill page.";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>