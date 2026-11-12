<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My places | Travel Mate</title>
    <link rel="stylesheet" href="css/my-places.css">
</head>
<body>
    <header class="navbar">
        <a class="brand" href="dashboard.php">Travel Mate</a>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="explore.php">Explore</a>
            <a href="logout.php">Log out</a>
        </nav>
    </header>

    <main class="page-content">
        <section class="page-heading">
            <p class="eyebrow">YOUR SHARED DESTINATIONS</p>
            <h1>My places</h1>
            <p>Manage the places you have shared with the community.</p>
            <a class="button" href="add-place.php">Add a new place</a>
        </section>

        <section class="place-grid">
            <!-- Places will be loaded here -->
        </section>
    </main>
</body>
</html>