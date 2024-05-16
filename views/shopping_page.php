<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Website</title>
    <link rel="stylesheet" href="static/styles.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile-icon"></div>
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="shopping_page.php">Shopping</a>
        <button id="toggleSidebar">Toggle Sidebar</button> <!-- Button to toggle sidebar -->
    </div>

    <!-- Page content -->
    <div class="main-content">
        <header>
            <h1 class="heading">Welcome to Your Website</h1>
            <h3 class="title">Explore Our Services</h3>
        </header>

        <div class="container">
            <!-- Your shopping page content goes here -->
            <h2>Featured Products</h2>
            <div class="product-list">
    <?php if (isset($products)) : ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?php echo $product['image_url']; ?>" alt="Product Image">
                <h3><?php echo $product['product_name']; ?></h3>
                <p><?php echo $product['description']; ?></p>
                <p>$<?php echo $product['price']; ?></p>
                <button>Add to Cart</button>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No products available</p>
    <?php endif; ?>
</div>

        </div>

        <footer>
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </footer>
    </div>

    <script>
        // JavaScript to toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
        });
    </script>
</body>
</html>
