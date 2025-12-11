<?php
session_start();
include "koneksi.php";

if (!isset($_GET['id'])) {
    echo "Wisata tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($koneksi, "SELECT * FROM wisata WHERE id_wisata = $id");
$wisata = mysqli_fetch_assoc($query);

if (!$wisata) {
    echo "Data wisata tidak ditemukan.";
    exit;
}

$fotos = mysqli_query($koneksi, "SELECT * FROM wisata_foto WHERE id_wisata = $id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Wisata - <?= $wisata['nama_wisata']; ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background: #f4f9ff;
    }

    .container {
        width: 90%;
        margin: 30px auto;
    }

    .title {
        font-size: 28px;
        font-weight: 700;
        color: #007bff;
        margin-bottom: 15px;
    }

    .detail-box {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    /* Slideshow */
    .slider {
        width: 48%;
        min-width: 300px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .slider img {
        width: 100%;
        display: block;
    }

    /* Deskripsi */
    .info {
        width: 48%;
        min-width: 300px;
    }

    .info h3 {
        margin: 10px 0;
        color: #007bff;
    }

    .info p {
        line-height: 1.7;
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 18px;
        background: #007bff;
        color: white;
        border-radius: 10px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-back:hover {
        background: #0056b3;
    }

    /* Slideshow animation */
    .slide {
        display: none;
        animation: fade 0.7s ease-in-out;
    }

    @keyframes fade {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    .dots {
        text-align: center;
        margin-top: 8px;
    }

    .dot {
        height: 12px;
        width: 12px;
        background-color: #b5d4ff;
        border-radius: 50%;
        display: inline-block;
        margin: 0 4px;
        cursor: pointer;
    }

    .active-dot {
        background-color: #007bff;
    }
</style>
</head>

<body>

<div class="container">
    <h1 class="title"><?= $wisata['nama_wisata']; ?></h1>

    <div class="detail-box">

<!-- SLIDESHOW FOTO -->
<div class="slider" id="slider">
    <?php
    $index = 0;
    while ($foto = mysqli_fetch_assoc($fotos)) {
        $index++;
        echo "
        <div class='slide'>
            <img src='{$foto['file_foto']}' alt='Foto Wisata'>
        </div>";
    }
    ?>

    <div class="dots">
        <?php for ($i = 1; $i <= $index; $i++): ?>
            <span class="dot" onclick="currentSlide(<?= $i ?>)"></span>
        <?php endfor; ?>
    </div>
</div>


        <div class="info">
            <h3>Lokasi</h3>
            <p><?= $wisata['lokasi']; ?></p>

            <h3>Harga Tiket</h3>
            <p>Rp <?= number_format($wisata['harga_tiket'], 0, ',', '.'); ?></p>

            <h3>Jam Operasional</h3>
            <p><?= $wisata['jam_operasional']; ?></p>

            <h3>Deskripsi</h3>
            <p><?= nl2br($wisata['deskripsi']); ?></p>

            <a href="index.php" class="btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>

<script>
let slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");

    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active-dot");
    }

    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].classList.add("active-dot");
}
</script>

</body>
</html>
