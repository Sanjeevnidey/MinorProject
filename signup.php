<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["user"] = $username;
        $_SESSION["user_id"] = mysqli_insert_id($conn);
        header("Location: index.php");
        exit;
    } else {
        $error = "Error creating account: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup | EasyStay</title>
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
    <h2>Signup</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Signup</button>
    </form>
    <p class="error"><?= $error ?? "" ?></p>
    <p style="text-align:center; margin-top: 1rem;">
        Already have an account? <a href="login.php" style="color:#2a9d8f; font-weight:bold;">Login</a>
    </p>
</div>


<script>
function clearSearchLocation() {
    localStorage.removeItem("searchLocation");
}
</script>

</body>
</html>
