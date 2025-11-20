// --- Sample Data (Pretend these are from a database) ---
const stays = [
    { id: 1, name: "Ocean View Resort", desc: "Get the celebrity treatment with world-class service ", location: "goa", price: 120, rating: 4.6, images: ["images/hotel1.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 2, name: "Mountain Retreat", desc: "Get the celebrity treatment with world-class service ", location: "manali", price: 90, rating: 4.2, images: ["images/hotel2.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 3, name: "City Comfort Inn", desc: "Get the celebrity treatment with world-class service ", location: "delhi", price: 80, rating: 4.0, images: ["images/hotel3.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 4, name: "Desert Mirage Hotel", desc: "Get the celebrity treatment with world-class service ", location: "jaipur", price: 110, rating: 4.4, images: ["images/hotel4.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 5, name: "Lake View Paradise", desc: "Get the celebrity treatment with world-class service ", location: "udaipur", price: 130, rating: 4.8, images: ["images/hotel5.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 6, name: "Lake View Paradise", desc: "Get the celebrity treatment with world-class service ", location: "udaipur", price: 130, rating: 4.8, images: ["images/hotel1.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 7, name: "Lake View Paradise", desc: "Get the celebrity treatment with world-class service ", location: "udaipur", price: 130, rating: 4.8, images: ["images/hotel2.png", "images/hotel2.png", "images/hotel3.png"] },
    { id: 8, name: "ABC", desc: "Get the celebrity treatment with world-class service ", location: "ranchi", price: 130, rating: 4.8, images: ["images/hotel4.png", "images/hotel2.png", "images/hotel3.png"] }

];

// --- Handle Search Button Click on Home Page ---
const searchBtn = document.getElementById("searchBtn");

if (searchBtn) {
    searchBtn.addEventListener("click", () => {
        const locationInput = document.getElementById("location").value.trim().toLowerCase();
        const checkin = document.getElementById("checkin").value;
        const checkout = document.getElementById("checkout").value;

        if (locationInput === "" || checkin === "" || checkout === "") {
            alert("Please enter location and both dates!");
            return;
        }

        // Store all search info
        localStorage.setItem("searchLocation", locationInput);
        localStorage.setItem("checkinDate", checkin);
        localStorage.setItem("checkoutDate", checkout);

        window.location.href = "listings.php";
    });

}

function clearSearchLocation() {
    localStorage.removeItem("searchLocation");
}

// --- Display Results on Listings Page ---
if (window.location.pathname.includes("listings.php")) {
    const resultsDiv = document.getElementById("results");
    const priceFilter = document.getElementById("priceFilter");
    const ratingFilter = document.getElementById("ratingFilter");

    const searchLocation = localStorage.getItem("searchLocation");

    // If searchLocation exists, filter; else show all
    let filteredStays = searchLocation 
        ? stays.filter(s => s.location.includes(searchLocation))
        : stays.slice(); // copy all stays

    function renderResults() {
        resultsDiv.innerHTML = filteredStays.map(stay => `
            <div class="card">
              <img src="${stay.images[0]}" alt="${stay.name}">
              <h3>${stay.name}</h3>
              <div class="card-info">
                <p>${stay.location.charAt(0).toUpperCase() + stay.location.slice(1)} | ⭐ ${stay.rating}</p>
                <p class="price">$${stay.price} / night</p>
              </div>
              <button onclick="viewDetails(${stay.id})">Book Now</button>
            </div>
        `).join("");
    }

    renderResults();

    // Filters
    priceFilter.addEventListener("change", () => {
        if (priceFilter.value === "lowToHigh") filteredStays.sort((a,b) => a.price - b.price);
        else if (priceFilter.value === "highToLow") filteredStays.sort((a,b) => b.price - a.price);
        else filteredStays = searchLocation ? stays.filter(s => s.location.includes(searchLocation)) : stays.slice();
        renderResults();
    });

    ratingFilter.addEventListener("change", () => {
        const minRating = parseFloat(ratingFilter.value);
        filteredStays = (searchLocation ? stays.filter(s => s.location.includes(searchLocation)) : stays)
            .filter(s => s.rating >= minRating);
        renderResults();
    });
}


// --- Book Now Function ---
function bookNow(id) {
    localStorage.setItem("selectedStay", id);
    window.location.href = "booking.php";
}

// --- Show Selected Stay Details on booking.php ---
if (window.location.pathname.includes("booking.php")) {
    const stayId = localStorage.getItem("selectedStay");
    const stay = stays.find(s => s.id == stayId);

    const checkin = localStorage.getItem("checkinDate");
    const checkout = localStorage.getItem("checkoutDate");

    if (!stay) {
        document.querySelector(".stay-info").innerHTML = "<p>No stay selected. Go back to listings.</p>";
    } else {
        // Calculate number of nights
        const nights = Math.ceil(
            (new Date(checkout) - new Date(checkin)) / (1000 * 60 * 60 * 24)
        );
        const total = nights * stay.price;

        // Fill in details on the left side
        document.getElementById("stayImage").src = stay.images[0];
        document.getElementById("stayName").textContent = stay.name;
        document.getElementById("stayLocation").textContent =
            "Location: " + stay.location.charAt(0).toUpperCase() + stay.location.slice(1);
        document.getElementById("stayRating").textContent = "⭐ " + stay.rating;
        document.getElementById("stayPrice").textContent = `Price per Night: $${stay.price}`;

        document.getElementById("stay_id").value = stay.id;
        document.getElementById("stay_name").value = stay.name;
        document.getElementById("stay_location").value = stay.location;
        document.getElementById("price_per_night").value = stay.price;
        document.getElementById("image_path").value = stay.images[0]; // ⭐ ADD THIS
        document.getElementById("nights").value = nights;
        document.getElementById("total").value = total;


        // Optional: display total somewhere else (or console log)
        console.log(`Total: $${total} (${nights} nights)`);


        // Handle Booking Form Submission
        const form = document.getElementById("bookingForm");
        form.addEventListener("submit", e => {
            e.preventDefault();

            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const guests = document.getElementById("guests").value;

            const bookingData = {
                stay,
                name,
                email,
                guests,
                checkin,
                checkout,
                nights,
                total
            };
        });
    }
}

// --- Display Booking Confirmation -- DELETED

// --- My Bookings Page Logic --- DELETED

// --- Cancel Booking Function --- DELETED

// --- Explore Featured Destination ---
function exploreDestination(place) {
    // Store the selected destination in localStorage
    localStorage.setItem("searchLocation", place.toLowerCase());

    // Redirect to the listings page
    window.location.href = "listings.php";
}

// --- View Details Function ---
function viewDetails(id) {
    // Save the selected hotel ID so the next page knows which hotel to load
    localStorage.setItem("selectedStay", id);

    // Redirect user to the details page
    window.location.href = "details.php";
}

if (window.location.pathname.includes("details.php")) {
    const stayId = localStorage.getItem("selectedStay");
    const stay = stays.find(s => s.id == stayId);

    const infoDiv = document.getElementById("hotelInfo");
    const reviewsDiv = document.getElementById("reviewsList");

    if (!stay) {
        infoDiv.innerHTML = "<p>Stay not found.</p>";
    } else {

        // ✅ Do NOT overwrite imageDiv
        // Just update the main image
        document.getElementById("mainImage").src = stay.images[0];

        // Right side — hotel details
        infoDiv.innerHTML = `
            <h2>${stay.name}</h2>
            <p><strong>${stay.desc}</strong></p>
            <p><strong>Location:</strong> ${stay.location}</p>
            <p>⭐ ${stay.rating}</p>
            <p class="price">$${stay.price} / night</p>
            <p><strong>Facilities:</strong> Outdoor swimming pool |
            Airport shuttle | Non-smoking rooms | Room service |
            Spa and wellness centre | 2 restaurants | Facilities for disabled guests |
            Tea/coffee maker in all rooms | Bar | Very good breakfast</p>
            <button onclick="goToBooking(${stay.id})">Book This Stay</button>
        `;
    }

    // Thumbnails
    const thumbContainer = document.getElementById("thumbnailContainer");
    thumbContainer.innerHTML = stay.images.map((img, index) => `
        <img src="${img}" class="thumb ${index === 0 ? 'active-thumb' : ''}">
    `).join("");

    // Add click events
    const thumbImages = document.querySelectorAll(".thumb");

    thumbImages.forEach((thumb, idx) => {
        thumb.addEventListener("click", () => {
            document.getElementById("mainImage").src = stay.images[idx];
            thumbImages.forEach(t => t.classList.remove("active-thumb"));
            thumb.classList.add("active-thumb");
        });
    });

    // ===== IMAGE ZOOM ON CLICK =====
    const mainImage = document.getElementById("mainImage");
    const zoomModal = document.getElementById("zoomModal");
    const zoomImage = document.getElementById("zoomImage");

    // Open zoom on main image click
    mainImage.addEventListener("click", () => {
        zoomImage.src = mainImage.src;
        zoomModal.style.display = "flex";
    });

    // Close zoom when clicking outside
    zoomModal.addEventListener("click", () => {
        zoomModal.style.display = "none";
    });


    // Reviews
    const savedReviews = JSON.parse(localStorage.getItem(`reviews_${stayId}`)) || [];
    renderReviews();

    function renderReviews() {
        reviewsDiv.innerHTML = savedReviews.map(r => `
            <div class="review">
                <p>⭐ ${r.rating}</p>
                <p>${r.comment}</p>
            </div>
        `).join('') || "<p>No reviews yet. Be the first!</p>";
    }

    document.getElementById("reviewForm").addEventListener("submit", e => {
        e.preventDefault();
        const rating = document.getElementById("rating").value;
        const comment = document.getElementById("comment").value;
        savedReviews.push({ rating, comment });
        localStorage.setItem(`reviews_${stayId}`, JSON.stringify(savedReviews));
        renderReviews();
        e.target.reset();
    });
}



function goToBooking(id) {
    localStorage.setItem("selectedStay", id);
    window.location.href = "booking.php";
}


