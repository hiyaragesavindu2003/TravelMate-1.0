<?php
session_start();
require_once 'config/db.php';

$email = '';
$error = '';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $sql = 'SELECT id, name, password FROM users WHERE email = ?';
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: dashboard.php');
            exit;
        }
    }
    $error = 'Email or password is incorrect.';
    mysqli_stmt_close($statement);
}
?>