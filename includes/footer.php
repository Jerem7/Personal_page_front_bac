<?php
require_once 'init.php';
?> <html>
<body>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Jeremiasz Żołnierek-Kielczewski </p>
    <nav> <?php if (isset($_SESSION['user_id'])): ?> <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Wyloguj</a> <?php else: ?> <a href="login.php">Zaloguj</a> <?php endif; ?>
    </nav>
</footer>
</body>
</html>