<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';
$user_id = $_SESSION['user_id'];

$sql = 'SELECT * FROM places WHERE user_id = ? ORDER BY created_at DESC';
$statement = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($statement, 'i', $user_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
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
            <!-- Data fetched; UI rendering in progress -->
        </section>
    </main>
</body>
</html>