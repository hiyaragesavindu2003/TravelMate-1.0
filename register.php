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

