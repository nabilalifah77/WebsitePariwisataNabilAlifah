-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2025 pada 14.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pariwisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_wisata` varchar(100) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar_url` varchar(255) DEFAULT NULL,
  `harga_tiket` int(11) DEFAULT 0,
  `jam_operasional` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `id_kategori`, `nama_wisata`, `lokasi`, `kategori`, `deskripsi`, `gambar_url`, `harga_tiket`, `jam_operasional`, `created_at`) VALUES
(3, 1, 'Pantai Parangtritis', 'Yogyakarta', NULL, 'Parangtritis adalah pantai paling terkenal di Yogyakarta dengan ombak besar dan hamparan pasir hitam yang luas. Pengunjung dapat menikmati sunset dramatis, bermain ATV, naik delman, hingga berfoto di gumuk pasir yang ikonik. Pantai ini juga kaya legenda yang melekat dalam budaya Jawa.', 'img/parangtritis3.jpeg', 10000, '07.00', '2025-10-15 06:28:40'),
(4, 4, 'Candi borobudur', 'Yogyakarta', NULL, 'Borobudur adalah candi Buddha terbesar di dunia dan salah satu mahakarya arsitektur kuno. Dibangun pada abad ke-8, candi ini memiliki lebih dari 2.600 relief yang menggambarkan perjalanan spiritual manusia. Borobudur menjadi tempat terbaik untuk menikmati sunrise yang legendaris, sekaligus mempelajari sejarah Jawa kuno dan ajaran Buddha.', 'img/BOROBUDUR.jpeg', 25000, '07.00', '2025-10-15 06:28:45'),
(5, 4, 'Candi Prambanan', 'Yogyakarta', NULL, 'Candi Prambanan adalah kompleks candi Hindu terbesar di Indonesia yang terkenal dengan arsitektur menjulang setinggi 47 meter. Dibangun pada abad ke-9, Prambanan menggambarkan kisah epik Ramayana dan menjadi salah satu warisan budaya dunia UNESCO. Keindahan reliefnya serta pertunjukan Sendratari Ramayana pada malam hari menjadikan tempat ini destinasi budaya yang wajib dikunjungi.', 'img/PRAMBANAN.jpeg', 20000, '07.00-18.00', '2025-11-12 03:41:19'),
(6, 4, 'Gembira Loka Zoo', 'Yogyakarta', NULL, 'Gembira Loka Zoo adalah kebun binatang modern di Yogyakarta yang memiliki beragam koleksi satwa dari seluruh dunia. Pengunjung dapat melihat hewan seperti harimau, gajah, orang utan, burung eksotis, reptil besar, hingga berbagai jenis ikan.\r\nSelain melihat satwa, Gembira Loka dilengkapi dengan wahana edukatif dan rekreasi seperti perahu kayuh, feeding animal, kereta wisata, dan area bermain anak. Tempat ini sangat cocok untuk wisata keluarga karena menawarkan perpaduan antara hiburan dan pembelajaran mengenai satwa.', 'img/gembiraloka.jpeg', 30000, '07.00-18.00', '2025-11-12 03:41:24'),
(7, 4, 'Malioboro', 'Yogyakarta', NULL, 'Malioboro merupakan pusat wisata belanja dan ikon paling terkenal di Yogyakarta. Di sepanjang jalan ini, pengunjung dapat menemukan pedagang kaki lima, toko oleh-oleh, kuliner khas Jogja, hingga seniman jalanan yang menampilkan pertunjukan musik atau lukisan.\r\nSuasana Malioboro semakin hidup pada malam hari, dengan lampu-lampu jalanan dan bangku-bangku tepi trotoar yang nyaman untuk bersantai. Tidak jauh dari Malioboro juga terdapat tempat bersejarah seperti Benteng Vredeburg dan Pasar Beringharjo.', 'img/malioboro2.jpeg', 0, '24jam', '2025-11-12 05:33:14'),
(8, 1, 'Pantai Pok', 'Yogyakarta', NULL, 'Pantai', 'img/pantaipok.jpeg', 0, '06.00-07.00', '2025-11-12 05:33:25'),
(9, 1, 'Pantai Nglambor', ' Yogyakarta', NULL, 'Pilihan pantai', 'img/pantaiglmabor.jpeg', 10000, '06.00-19.00', '2025-11-12 06:10:30'),
(10, 4, 'Taman Pintar', ' Yogyakarta', NULL, 'Taman Pintar adalah pusat wisata edukasi interaktif yang dirancang untuk anak-anak dan pelajar. Tempat ini menyajikan berbagai zona pembelajaran seperti sains, teknologi, astronomi, fisika, dan permainan edukatif lainnya.\r\nDi dalamnya terdapat berbagai wahana seperti Dome Planetarium, Zona Air, Ruang Sains, Zona Kreativitas, serta alat peraga interaktif yang memungkinkan anak-anak belajar sambil bermain. Taman Pintar menjadi pilihan tepat untuk wisata edukatif keluarga di tengah kota Jogja.', 'img/tamanpintar.jpeg', 30000, '06.00-19.00', '2025-11-12 06:10:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `wisata_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
