<?php
session_start();
require_once 'config.php';

if(isset($_GET['action']) && $_GET['action']=="add"){
    $id=intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }else{
        $query = "SELECT * FROM products WHERE product_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row != null){
            $_SESSION['cart'][$id] = array(
                "quantity" => 1,
                "price" => $row['price'],
                "name" => $row['name'],
                "image" => $row['image']
            );
        }else{
            $message="This product ID is invalid!";
        }
    }
}

if(isset($_GET['action']) && $_GET['action']=="remove"){
    $id=intval($_GET['id']);
    unset($_SESSION['cart'][$id]);
}

if(isset($_GET['action']) && $_GET['action']=="place_order"){
    unset($_SESSION['cart']);
    header('Location: checkout.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
if(!empty($_SESSION['cart'])){
    echo '<div class="container">';
    echo '<div class="row">';
    foreach($_SESSION['cart'] as $key => $product){
        echo '<div class="col-md-4">';
        echo '<div class="card h-100">';
        echo '<img src="' . $product['image'] . '" class="card-img-top car-image" alt="' . $product['name'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $product['name'] . '</h5>';
        echo '<p class="card-text">$' . number_format($product['price'], 2) . '</p>';
        echo '<a href="cart.php?action=remove&id=' . $key . '" class="btn btn-danger">Remove</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '<div class="container mt-4">';
    echo '<a href="cart.php?action=place_order" class="btn btn-success btn-lg btn-block">Place Order</a>';
    echo '</div>';
}else{
    echo '<p>Your cart is empty.</p>';
}
?>

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
