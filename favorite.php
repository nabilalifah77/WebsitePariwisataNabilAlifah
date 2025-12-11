<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$user_query = mysqli_query($koneksi, "SELECT id_users FROM users WHERE username='$username' LIMIT 1");
$user_data = mysqli_fetch_assoc($user_query);
$id_user = $user_data['id_users'];

if (isset($_GET['id'])) {
    $id_wisata = intval($_GET['id']);

    $cek = mysqli_query($koneksi, "SELECT * FROM favorite WHERE id_users='$id_user' AND id_wisata='$id_wisata'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Wisata ini sudah ada di favorit!'); window.location='favorite.php';</script>";
        exit;
    }

    mysqli_query($koneksi, "
        INSERT INTO favorite (id_users, id_wisata)
        VALUES ('$id_user', '$id_wisata')
    ");

    echo "<script>alert('Ditambahkan ke favorit!'); window.location='favorite.php';</script>";
    exit;
}

if (isset($_GET['hapus'])) {
    $id_wisata = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM favorite WHERE id_users='$id_user' AND id_wisata='$id_wisata'");
    header("Location: favorite.php");
    exit;
}

$sql = "SELECT wisata.*, kategori.nama_kategori 
        FROM favorite 
        JOIN wisata ON favorite.id_wisata = wisata.id_wisata 
        JOIN kategori ON wisata.id_kategori = kategori.id_kategori
        WHERE favorite.id_users = '$id_user'";
$query = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Favorit Saya - Pariwisata Jogja</title>
  <link rel="stylesheet" href="css_index.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<?php include "navbar.php"; ?>

<section class="destinations">
  <h2>❤️ Wisata Favorit Saya</h2>

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
                  <a href='detail.php?id={$data['id_wisata']}' class='btn-detail'>Detail</a>

                  <a href='favorite.php?hapus={$data['id_wisata']}' 
                     class='btn-fav'
                     onclick='return confirm(\"Hapus dari favorit?\")'>
                     🗑 Hapus
                  </a>
                </div>

              </div>
            </div>
            ";
        }
    } else {
        echo "<p class='no-data'>Belum ada wisata favorit yang kamu tambahkan 💙</p>";
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
