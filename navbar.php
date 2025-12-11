<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<nav class="navbar">
  <div class="logo">PARIWISATA.ID</div>

  <ul class="nav-links">
    <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Beranda</a></li>

    <?php if (isset($_SESSION['username'])): ?>
      <li><a href="favorite.php" class="<?= basename($_SERVER['PHP_SELF']) == 'favorite.php' ? 'active' : '' ?>">Favorit Saya</a></li>
      <li><a href="logout.php" class="logout-btn">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php" class="login-btn">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>

<style>
  .navbar {
    background: linear-gradient(135deg, #007bff, #00a8ff);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    position: sticky;
    top: 0;
    z-index: 100;
  }

  .logo {
    font-size: 1.5em;
    font-weight: 600;
    letter-spacing: 1px;
  }

  .nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
  }

  .nav-links a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
  }

  .nav-links a:hover,
  .nav-links a.active {
    text-decoration: underline;
  }

  .logout-btn {
    background: #ff4d4d;
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    transition: background 0.3s;
  }

  .logout-btn:hover {
    background: #cc0000;
  }

  .login-btn {
    background: #00bfff;
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
    transition: background 0.3s;
  }

  .login-btn:hover {
    background: #007bff;
  }
</style>
