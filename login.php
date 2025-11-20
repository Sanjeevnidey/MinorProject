<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["username"];
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | EasyStay</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<header>
    <h1 class="logo">EasyStay</h1>
    <nav>
        <a href="index.php" class="nav-btn">Home</a>
        <a href="listings.php" class="nav-btn" onclick="clearSearchLocation()">Browse</a>
        <a href="bookings.php" class="nav-btn">My Bookings</a>

        <?php if(isset($_SESSION["user"])): ?>
            <span class="nav-btn" style="font-weight:bold;">Hi, <?php echo $_SESSION["user"]; ?></span>
            <a href="logout.php" class="nav-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="nav-btn">Login</a>
            <a href="signup.php" class="nav-btn">Signup</a>
        <?php endif; ?>
    </nav>
</header>

<div class="auth-container">
    <h2>Login</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p class="error"><?= $error ?? "" ?></p>
    <p style="text-align:center; margin-top: 1rem;">
        Don't have an account? <a href="signup.php" style="color:#2a9d8f; font-weight:bold;">Sign up</a>
    </p>
</div>

<script>
function clearSearchLocation() {
    localStorage.removeItem("searchLocation");
}
</script>

</body>
</html>
