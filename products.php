<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#">CarConnex</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <form class="form-inline my-4" method="get" action="products.php">
        <input class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search" name="search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>

<?php
session_start();
require_once 'config.php';

class Product
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getAllProducts($search = '')
    {
        $query = "SELECT * FROM products";
        if (!empty($search)) {
            $query .= " WHERE name LIKE '%$search%'";
        }
        $result = $this->mysqli->query($query);

        $products = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }
}

$product = new Product($mysqli);

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $products = $product->getAllProducts($search);
} else {
    $products = $product->getAllProducts();
}

if (!empty($products)) {
    echo '<div class="row">';
    foreach ($products as $product) {
        echo '<div class="col-md-4">';
        echo '<div class="card h-100">';
        echo '<img src="' . $product['image'] . '" class="card-img-top car-image" alt="' . $product['name'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $product['name'] . '</h5>';
        echo '<p class="card-text">$' . number_format($product['price'], 2) . '</p>';
        echo '<a href="cart.php?action=add&id=' . $product['product_id'] . '" class="btn btn-primary">Add to Cart</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>No products found.</p>';
}
?>

</div>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">CarConnex &copy; <?php echo date("Y"); ?></span>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
