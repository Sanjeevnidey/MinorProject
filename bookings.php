<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM bookings WHERE user_id=$user_id ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Bookings | EasyStay</title>
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
        <section class="my-bookings">
            <h2>My Bookings</h2>
            <div id="bookingsList" class="bookings-container">
                <div class="bookings-container">
                <?php while ($b = mysqli_fetch_assoc($result)) { ?>
                    <div class="card booking-card">
                        
                        <img src="<?= $b["image_path"] ?>" class="booking-image" alt="Stay Image">

                        <div class="booking-info">
                            <h3><?= $b["stay_name"] ?></h3>
                            <p>Location: <strong><?= ucfirst($b["stay_location"]) ?></strong></p>
                            <p>Check-in: <strong><?= $b["checkin"] ?></strong></p>
                            <p>Check-out: <strong><?= $b["checkout"] ?></strong></p>
                            <p>Total: <strong>$<?= $b["total"] ?></strong></p>


                            <form action="cancel_booking.php" method="POST">
                                <input type="hidden" name="booking_id" value="<?= $b["id"] ?>">
                                <button class="cancel-btn">Cancel Booking</button>
                            </form>
                        </div>

                    </div>
                <?php } ?>


                <?php if (mysqli_num_rows($result) == 0) echo "<p>No bookings yet.</p>"; ?>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 EasyStay · All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>