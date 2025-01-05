<?php
require_once 'init.php';
?>
<html>

<body>
<footer>
    <p>&copy; 2025 My Portfolio. All rights reserved.</p>
    <nav>
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</footer>
</body>
</html>
