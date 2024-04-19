<?php
    require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="input-container">
                <label for="username"><i class="fas fa-user"></i></label>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <label for="password"><i class="fas fa-lock"></i></label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <div class="signup-link">
            <a href="signup.php">Don't have an account? Sign up here</a>
        </div>
    </div>

    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $entered_username = trim($_POST["username"]);
            $entered_password = $_POST["password"];

            $query = "SELECT username, password FROM users WHERE username = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $entered_username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($username, $hashed_password);
                $stmt->fetch();

                if (password_verify($entered_password, $hashed_password)) {
                    header("Location: home.php");
                    exit;
                } else {
                    echo "<p style='color: red; text-align: center;'>Invalid username or password</p>";
                }
            } else {
                echo "<p style='color: red; text-align: center;'>Invalid username or password</p>";
            }

            $stmt->close();
        }
    }
    ?>

</body>
</html>
