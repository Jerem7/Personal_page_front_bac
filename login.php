<?php
require_once 'init.php';
// Rozpoczęcie sesji i połączenie z bazą
session_start();
$host = 'localhost';
$dbname = 'portfolio';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obsługa logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = md5(trim($_POST['password']));  // Haszowanie hasła przed porównaniem

    // Debugowanie danych wejściowych
    var_dump($user, $pass);

    // Sprawdzenie użytkownika
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Porównanie hasła (md5)
        if ($pass === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Invalid login credentials.";
        }
    } else {
        echo "Invalid login credentials.";
    }
}
includeAssets();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<form method="post" action="login.php">
    <h1>Login</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
</body>
</html>
