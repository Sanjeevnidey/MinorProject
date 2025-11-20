<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyStay | Home</title>
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
        <section class="hero">
            <div class="hero-content">
                <h2>Find your perfect stay with <span>EasyStay</span></h2>
                <p>Explore destinations, book stays, and relax your way.</p>

                <div class="search-box">
                    <div class="input-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" placeholder="Enter location..." />
                    </div>

                    <div class="input-group">
                        <label for="checkin">Check-in</label>
                        <input type="date" id="checkin" />
                    </div>

                    <div class="input-group">
                        <label for="checkout">Check-out</label>
                        <input type="date" id="checkout" />
                    </div>

                    <button id="searchBtn">Search</button>
                </div>

            </div>
        </section>

        <section class="featured">
            <h2>Featured Destinations</h2>
            <div class="card-container">
                <div class="card">
                    <img src="images/hotel1.png" alt="Goa">
                    <h3>Goa</h3>
                    <p>Sun, sand, and sea — the perfect coastal escape.</p>
                    <button onclick="exploreDestination('goa')">Explore</button>
                </div>

                <div class="card">
                    <img src="images/hotel2.png" alt="Paris">
                    <h3>Manali</h3>
                    <p>The city of lights awaits you with charm and culture.</p>
                    <button onclick="exploreDestination('manali')">Explore</button>
                </div>

                <div class="card">
                    <img src="images/hotel3.png" alt="Tokyo">
                    <h3>Udaipur</h3>
                    <p>Modern vibes meet ancient tradition in Japan’s capital.</p>
                    <button onclick="exploreDestination('udaipur')">Explore</button>
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