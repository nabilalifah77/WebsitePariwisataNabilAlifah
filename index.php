<?php
session_start();
include "koneksi.php";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$sql = "SELECT wisata.*, kategori.nama_kategori 
        FROM wisata 
        JOIN kategori ON wisata.id_kategori = kategori.id_kategori 
        WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND wisata.nama_wisata LIKE '%$search%'";
}

if (!empty($kategori)) {
    $sql .= " AND kategori.nama_kategori = '$kategori'";
}

$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Info Pariwisata Indonesia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f4f9ff;
      color: #333;
      overflow-x: hidden;
    }

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

    .hero {
      background: linear-gradient(to right, #007bff, #00a8ff);
      color: white;
      text-align: center;
      padding: 80px 20px;
    }

    .hero-content h1 {
      font-size: 2.5em;
      margin-bottom: 30px;
    }

    .search-box {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .search-box input,
    .search-box select {
      padding: 10px;
      border-radius: 10px;
      border: none;
      width: 200px;
      outline: none;
    }

    .search-box button {
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      background: white;
      color: #007bff;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    .search-box button:hover {
      background: #e6f0ff;
    }

    .destinations {
      text-align: center;
      padding: 50px 20px;
    }

    .destinations h2 {
      color: #007bff;
      margin-bottom: 30px;
    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 25px;
      padding: 0 40px;
    }

    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      opacity: 0;
      transform: translateY(20px);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    .card h3 {
      color: #007bff;
      margin-bottom: 5px;
    }

    .card .lokasi {
      font-size: 0.9em;
      color: #555;
    }

    .card .kategori {
      font-size: 0.8em;
      color: #888;
      margin-bottom: 10px;
    }

    .card-buttons {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-detail,
    .btn-fav {
      text-decoration: none;
      padding: 8px 10px;
      border-radius: 8px;
      font-size: 0.9em;
      transition: 0.3s;
    }

    .btn-detail {
      background: #007bff;
      color: white;
    }

    .btn-detail:hover {
      background: #0056b3;
    }

    .btn-fav {
      background: #ff4d4d;
      color: white;
    }

    .btn-fav:hover {
      background: #cc0000;
    }

    .no-data {
      grid-column: 1/-1;
      color: #777;
      font-size: 1.1em;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 1.8em;
      }

      .navbar {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="logo">PARIWISATA.JOGJA</div>
  <ul class="nav-links">
    <li><a href="index.php" class="active">Beranda</a></li>
    <?php if (isset($_SESSION['username'])): ?>
      <li><a href="favorite.php">Favorit Saya</a></li>
      <li><a href="logout.php" class="logout-btn">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php" class="login-btn">Login untuk tambah favorite!</a></li>
    <?php endif; ?>
  </ul>
</nav>

<section class="hero">
  <div class="hero-content">
    <h1>Liburan Bingung? JOGJA aja!</h1>

    <form method="GET" class="search-box">
            <select name="kategori">
    <option value="">Semua Kategori</option>
    <?php
    $kategori_query = mysqli_query($koneksi, "SELECT * FROM kategori");

    while ($row = mysqli_fetch_assoc($kategori_query)) {
        $selected = ($row['nama_kategori'] == $kategori) ? 'selected' : '';
        echo "<option value='{$row['nama_kategori']}' $selected>{$row['nama_kategori']}</option>";
    }
    ?>
</select>

      <button type="submit">Cari</button>
    </form>
  </div>
</section>

<section class="destinations">
  <h2>Tempat Wisata Populer</h2>
  <div class="card-container">
    <?php
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            echo "
            <div class='card'>
              <img src='{$data['gambar_url']}' alt='{$data['nama_wisata']}'>
              <div class='card-body'>
                <h3>{$data['nama_wisata']}</h3>
                <p class='lokasi'>{$data['lokasi']}</p>
                <p class='kategori'>{$data['nama_kategori']}</p>
                <div class='card-buttons'>
                  <a href='detail.php?id={$data['id_wisata']}' class='btn-detail'>Detail</a>";
            if (isset($_SESSION['username'])) {
                echo "<a href='favorite.php?id={$data['id_wisata']}' class='btn-fav'>❤️ Favorit</a>";
            }
            echo "</div></div></div>";
        }
    } else {
        echo "<p class='no-data'>Wisata tidak ditemukan 😢</p>";
    }
    ?>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".card");
  cards.forEach((card, index) => {
    setTimeout(() => {
      card.style.transition = "all 0.5s ease";
      card.style.opacity = "1";
      card.style.transform = "translateY(0)";
    }, index * 150);
  });
});
</script>

</body>
</html>
