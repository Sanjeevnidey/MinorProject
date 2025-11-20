<?php
session_start();
require "db.php";

// If not logged in → send to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Read all booking fields from POST
$user_id = $_SESSION["user_id"];
$stay_id = $_POST["stay_id"];
$stay_name = $_POST["stay_name"];
$stay_location = $_POST["stay_location"];
$price_per_night = $_POST["price_per_night"];
$checkin = $_POST["checkin"];
$checkout = $_POST["checkout"];
$guests = $_POST["guests"];
$nights = $_POST["nights"];
$total = $_POST["total"];
$image = $_POST["image_path"];  // ⭐ FIXED — USE image_path (NOT image)


// Insert booking into database
$sql = "INSERT INTO bookings 
        (user_id, stay_id, stay_name, image_path, stay_location, checkin, checkout, guests, nights, price_per_night, total)
        VALUES 
        ('$user_id', '$stay_id', '$stay_name', '$image', '$stay_location', '$checkin', '$checkout', '$guests', '$nights', '$price_per_night', '$total')";

if (mysqli_query($conn, $sql)) {
    $id = mysqli_insert_id($conn);
    header("Location: confirm.php?id=" . $id);
    exit;
} else {
    echo "DB ERROR: " . mysqli_error($conn);
}

// Save booking info in session for confirmation page
$bookingInfo = [
    "stay_name" => $stay_name,
    "stay_location" => $stay_location,
    "checkin" => $checkin,
    "checkout" => $checkout,
    "nights" => $nights,
    "total" => $total,
    "guests" => $guests,
    "name" => $name,
    "email" => $email
];

$_SESSION["bookingInfo"] = $bookingInfo;

header("Location: confirm.php");
exit;
?>
