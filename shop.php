<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mudassiir";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch products from 'buy' table
$sql = "SELECT * FROM buy";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Shop - Johnny</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="logo">Johnny</div>
    <nav>
      <a href="index.html">Home</a>
      <a href="shop.php">Shop</a>
      <a href="cart.html">Cart</a>
      <a href="contact.html">Contact</a>
    </nav>
  </header>

  <main>
    <section class="products">
      <h2>Shop All Products</h2>

      <!-- Add new product -->
      <h3>Add New Product</h3>
      <form method="POST" action="add_to_cart.php">
        <input type="text" name="product_name" placeholder="Product name" required>
        <input type="number" name="quantity" value="1" min="1" required>
        <button type="submit">Add Product</button>
      </form>

      <div class="product-grid">
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="product-card">
              <h3><?php echo htmlspecialchars($row['name']); ?></h3>
              <p>Quantity: <?php echo $row['quantity']; ?></p>

              <!-- Edit form -->
              <form method="POST" action="edit_product.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" required>
                <button type="submit">Edit</button>
              </form>

              <!-- Delete form -->
              <form method="POST" action="delete_product.php" onsubmit="return confirm('Are you sure you want to delete this product?');">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Delete</button>
              </form>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No products found.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Johnny. All rights reserved.</p>
  </footer>
</body>
</html>

<?php $conn->close(); ?>
