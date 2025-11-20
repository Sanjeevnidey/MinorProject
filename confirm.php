<?php
session_start();
require "db.php";

if (!isset($_GET["id"])) {
    echo "Invalid booking!";
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM bookings WHERE id=$id";
$result = mysqli_query($conn, $sql);
$booking = mysqli_fetch_assoc($result);

// Use session for user info
$user_name = $_SESSION['user'] ?? 'Guest';
$user_email = $_SESSION['user_email'] ?? 'your email';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Confirmed | EasyStay</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <header>
    <h1 class="logo">EasyStay</h1>
    <nav>
      <a href="index.php" class="nav-btn">Home</a>
      <a href="listings.php" class="nav-btn" onclick="clearSearchLocation()">Browse</a>
      <a href="bookings.php" class="nav-btn">My Bookings</a>
    </nav>
  </header>

  <main>
    <section class="confirmation-section">
      <div class="confirmation-card">
          <h2>🎉 Booking Confirmed!</h2>
          <div id="confirmationMsg">
              <p>Thank you, <strong><?= $user_name ?></strong>!</p>
              <p>Your booking for <strong><?= $booking['stay_name'] ?></strong> in <strong><?= ucfirst($booking['stay_location']) ?></strong> is confirmed.</p>
              <p><strong>Check-in:</strong> <?= $booking['checkin'] ?> | <strong>Check-out:</strong> <?= $booking['checkout'] ?></p>
              <p><strong>Nights:</strong> <?= $booking['nights'] ?></p>
              <p><strong>Total Price:</strong> $<?= $booking['total'] ?></p>
              <p><strong>Guests:</strong> <?= $booking['guests'] ?></p>
              <p>We’ve sent the booking details to <strong><?= $user_email ?></strong>.</p>
          </div>
          <a href="index.php" class="back-btn">Back to Home</a>
      </div>
  </section>

  </main>

  <footer>
    <p>© 2025 EasyStay ·  All rights reserved.</p>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>
