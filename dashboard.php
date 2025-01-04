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
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header>
    <h1>Welcome to the Admin Dashboard</h1>
    <a href="logout.php">Logout</a>
</header>
<main>
    <p>Here you can manage your projects and portfolio content.</p>
</main>
</body>
</html>
