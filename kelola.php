<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$query = mysqli_query($koneksi,
    "SELECT wisata.*, kategori.nama_kategori 
     FROM wisata 
     JOIN kategori ON wisata.id_kategori = kategori.id_kategori
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Wisata</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body { margin: 0; font-family: Poppins, sans-serif; background: #f4f9ff; display:flex; }
    
    .sidebar {
        width: 240px;
        height: 100vh;
        background: linear-gradient(135deg, #007bff, #00a8ff);
        color: white;
        padding: 25px;
        position: fixed;
    }

    .sidebar a { display: block; padding: 12px; color: white; text-decoration: none; border-radius:8px; }
    .sidebar a:hover { background: rgba(255,255,255,0.2); }
    
    .content { margin-left:260px; padding:30px; width:100%; }

    h2 { color:#007bff; }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
        background:white;
        border-radius: 15px;
        overflow:hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 12px 10px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    th { background:#007bff; color:white; }

    .btn-add {
        display:inline-block;
        background:#00bfff;
        padding:10px 15px;
        border-radius:8px;
        color:white;
        text-decoration:none;
        font-weight:600;
        transition:0.3s;
    }

    .btn-add:hover { background:#0090e0; }

    .btn-edit { color:#007bff; }
    .btn-hapus { color:#ff3333; }
</style>
</head>

<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="wisata.php" class="active">Kelola Wisata</a>
    <a href="foto_wisata.php">Kelola Foto</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="content">
    <h2>Kelola Data Wisata</h2>

    <a href="tambah_wisata.php" class="btn-add">+ Tambah Wisata</a>

    <table>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Wisata</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><img src="../<?= $row['gambar_url']; ?>" width="80"></td>
            <td><?= $row['nama_wisata']; ?></td>
            <td><?= $row['lokasi']; ?></td>
            <td>
                <a href="edit_wisata.php?id=<?= $row['id_wisata']; ?>" class="btn-edit">Edit</a> |
                <a href="hapus_wisata.php?id=<?= $row['id_wisata']; ?>" class="btn-hapus" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>
