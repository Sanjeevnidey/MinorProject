<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book Your Stay | EasyStay</title>
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

  <main>
  <section class="booking-section">
    <!-- Left: Stay Details -->
    <div class="stay-details">
      <img id="stayImage" src="images/default.jpg" alt="Stay Image">
      <div class="stay-info">
        <h2 id="stayName">Stay Name</h2>
        <p id="stayLocation">Location</p>
        <p id="stayRating">⭐ Rating</p>
        <p id="stayPrice">Price per Night</p>
      </div>
    </div>

    <!-- Right: Booking Form -->
    <div class="form-container">
      <h2>Booking Details</h2>
      <form action="save_booking.php" method="POST">

        <input type="hidden" name="stay_id" id="stay_id">
        <input type="hidden" name="stay_name" id="stay_name">
        <input type="hidden" name="stay_location" id="stay_location">
        <input type="hidden" name="price_per_night" id="price_per_night">
        <input type="hidden" name="nights" id="nights">
        <input type="hidden" name="total" id="total">
        <input type="hidden" name="image_path" id="image_path">   <!-- ⭐ REQUIRED FIELD ADDED -->

        <label for="checkin">Check-in Date</label>
        <input type="date" id="checkin" name="checkin" required>

        <label for="checkout">Check-out Date</label>
        <input type="date" id="checkout" name="checkout" required>

        <label for="guests">Guests</label>
        <input type="number" id="guests" name="guests" min="1" required>

        <button type="submit">Confirm Booking</button>

      </form>


    </div>
  </section>
  </main>

  <footer>
    <p>© 2025 EasyStay · All rights reserved.</p>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>
