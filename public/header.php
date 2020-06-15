<header>
    <nav class="navigation">
        <div class="nav">
            <img src="https://lh3.googleusercontent.com/c_PbL6XsjDNQLxQvGwkWYIRYsO7X4fP83DoyRT7J1v5azy2aCQyOVT_wQkwNhEF8fw"
                 alt="logo">
            <?php if (isset($_SESSION['name']) && isset($_SESSION['password']) == true) : ?>
                <div>
                    <a href="index.php">Home</a>
                    <a href="users.php">Users</a>
                    <a href="menu.php">Menu</a>
                    <a href="menu-info.php">Menu-table</a>
                </div>
                <div>
                    <a href="logout.php">LogOut</a>
                </div>
            <?php else : ?>
                <div>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>
