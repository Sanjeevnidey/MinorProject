<?php
session_start();
require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Available Stays | EasyStay</title>
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

    <section class="featured">
        <h2>Available Stays</h2>
        <div class="filters">
            <label for="priceFilter">Sort by Price:</label>
            <select id="priceFilter">
                <option value="default">Default</option>
                <option value="lowToHigh">Low to High</option>
                <option value="highToLow">High to Low</option>
            </select>

            <label for="ratingFilter">Min Rating:</label>
            <select id="ratingFilter">
                <option value="0">All</option>
                <option value="4">4+</option>
                <option value="4.5">4.5+</option>
            </select>
        </div>

        <div class="card-container" id="results"></div>
    </section>

    <script src="js/script.js"></script>
    <footer>
  <p>© 2025 EasyStay</p>
</footer>

</body>

</html>