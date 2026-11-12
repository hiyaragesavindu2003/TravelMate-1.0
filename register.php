<?php
session_start();
require_once 'config/db.php';

$name = '';
$email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $_POST['confirm_password'] : '';

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account | Travel Mate</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <header class="navbar">
        <a class="brand" href="index.php">Travel Mate</a>
        <a href="login.php">Already a member? Log in</a>
    </header>

<main class="form-page">
        <section class="form-card">
            <p class="eyebrow">YOUR NEXT ADVENTURE STARTS HERE</p>
            <h1>Create your account</h1>
            <p class="muted">Join travelers sharing the places they love.</p>

            <?php if ($error != '') { ?>
                <p class="message error"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>

            <form method="POST" action="register.php">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button class="button" type="submit">Create account</button>
            </form>
            <p class="form-note">Already have an account? <a href="login.php">Log in</a></p>
        </section>
    </main>
</body>
</html>

