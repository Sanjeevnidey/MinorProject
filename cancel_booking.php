<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST["booking_id"];
    $user_id = $_SESSION["user_id"];

    $sql = "DELETE FROM bookings WHERE id=$booking_id AND user_id=$user_id";
    mysqli_query($conn, $sql);

    header("Location: bookings.php");
    exit;
}
?>
