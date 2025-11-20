<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Details | EasyStay</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header>
        <h1 class="logo">EasyStay</h1>
        <nav>
            <a href="index.php" class="nav-btn">Home</a>
            <a href="listings.php" class="nav-btn">Browse</a>
            <a href="bookings.php" class="nav-btn">My Bookings</a>
        </nav>
    </header>

    <main>
        <section class="hotel-details">
            <div class="hotel-container">
                <!-- Left: Image -->
                <div class="hotel-image">
                    <img id="mainImage" src="images/default.jpg" alt="Hotel Image">

                    <div class="thumbnail-container" id="thumbnailContainer">
                        <!-- Thumbnails added by JS -->
                    </div>
                </div>


                <!-- Right: Info -->
                <div class="hotel-info" id="hotelInfo">
                    <!-- Populated dynamically via JS -->
                </div>
            </div>

            <!-- Ratings & Reviews -->
            <div class="ratings-section">
                <h2>Ratings & Reviews</h2>
                <div id="reviewsList"></div>

                <form id="reviewForm">
                    <h3>Leave a Review</h3>
                    <label for="rating">Rating (1-5):</label>
                    <input type="number" id="rating" min="1" max="5" required>

                    <label for="comment">Comment:</label>
                    <textarea id="comment" rows="3" required></textarea>

                    <button type="submit">Submit Review</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Zoom click -->
    <div id="zoomModal">
        <img id="zoomImage" src="" alt="">
    </div>


    <footer>
        <p>© 2025 EasyStay · Designed with 💙 by You</p>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>