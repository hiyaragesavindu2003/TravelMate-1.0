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
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($place = mysqli_fetch_assoc($result)) { ?>
                    <?php
                    $image_url = $place['image'];
                    if ($image_url == '') {
                        $image_url = 'images/default.avif';
                    }
                    ?>
                    <article class="place-card">
                        <img src="<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($place['place_name']); ?>">
                        <div class="place-info">
                            <p class="place-country"><?php echo htmlspecialchars($place['country']); ?></p>
                            <h2><?php echo htmlspecialchars($place['place_name']); ?></h2>
                            <p class="place-location"><?php echo htmlspecialchars($place['location']); ?></p>
                            <p class="description"><?php echo nl2br(htmlspecialchars($place['description'])); ?></p>
                        </div>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <div class="empty-state">
                    <h2>You haven't shared any places yet</h2>
                    <p>Add a destination to start building your travel list.</p>
                    <a class="button" href="add-place.php">Add your first place</a>
                </div>
            <?php } ?>
        </section>
    </main>
</body>
</html>