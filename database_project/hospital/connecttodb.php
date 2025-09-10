<?php
// Database connection configuration
$connection = mysqli_connect("localhost", "root", "", "hospital_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($connection, "utf8");

// Debug: Database connection confirmation
echo "<!-- Database connected successfully -->";
?>
