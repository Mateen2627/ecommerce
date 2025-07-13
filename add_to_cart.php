<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mudassiir";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO buy (name, quantity) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $product_name, $quantity);

if ($stmt->execute()) {
  header("Location: shop.php");
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
