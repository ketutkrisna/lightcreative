-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2021 pada 09.13
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lightcreative`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id_booking` int(11) NOT NULL,
  `kode_booking` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `alamat_booking` varchar(150) NOT NULL,
  `nomertelepon_booking` varchar(20) NOT NULL,
  `tanggal_booking` varchar(100) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_ahir` date NOT NULL,
  `harga_booking` int(50) NOT NULL,
  `status_booking` varchar(20) NOT NULL,
  `notifikasi_booking` varchar(20) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `tanggal_pembayaran` varchar(100) NOT NULL,
  `notifikasi_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id_booking`, `kode_booking`, `user_id`, `member_id`, `alamat_booking`, `nomertelepon_booking`, `tanggal_booking`, `tanggal_awal`, `tanggal_ahir`, `harga_booking`, `status_booking`, `notifikasi_booking`, `bukti_pembayaran`, `tanggal_pembayaran`, `notifikasi_pembayaran`) VALUES
(52, 'LC0001', 4, 1, 'mulyasari lampung', '0821232321', '1627801881', '2021-08-10', '2021-08-12', 1500000, 'menunggu', 'belum dibaca', '', '1627801881', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeris`
--

CREATE TABLE `galeris` (
  `id_galeri` int(11) NOT NULL,
  `id_membergaleri` int(11) NOT NULL,
  `foto_galeri` varchar(100) NOT NULL,
  `deskripsi_galeri` varchar(50) NOT NULL,
  `tanggal_upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galeris`
--

INSERT INTO `galeris` (`id_galeri`, `id_membergaleri`, `foto_galeri`, `deskripsi_galeri`, `tanggal_upload`) VALUES
(16, 7, '1.jpg', 'yasi &amp; agus', '1576587979'),
(17, 7, '2.jpg', 'sentana &amp; mawar', '1576647453'),
(18, 1, '3.jpg', 'yasi &amp; agus (2)', '1576648004'),
(19, 7, '4.jpg', 'yasi makeup', '1576648223'),
(20, 1, '5.jpg', 'niken dan pras', '1576648390'),
(21, 1, '6.jpg', 'kadek &amp; wina', '1576648539'),
(22, 7, 'ClipartKey_2270349.png', 'kadek', '1576648654'),
(23, 4, '7.jpg', 'andi &amp; kristia', '1576648904');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `foto_member` varchar(100) NOT NULL,
  `nama_member` varchar(100) NOT NULL,
  `alamat_member` varchar(150) NOT NULL,
  `nomertelepon_member` varchar(20) NOT NULL,
  `jeniskelamin_member` varchar(20) NOT NULL,
  `tanggallahir_member` date NOT NULL,
  `bidang_member` varchar(20) NOT NULL,
  `harga_member` int(100) NOT NULL,
  `tanggalgabung_member` varchar(50) NOT NULL,
  `email_member` varchar(50) NOT NULL,
  `status_member` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id_member`, `foto_member`, `nama_member`, `alamat_member`, `nomertelepon_member`, `jeniskelamin_member`, `tanggallahir_member`, `bidang_member`, `harga_member`, `tanggalgabung_member`, `email_member`, `status_member`) VALUES
(1, '1.jpg', 'wayan freda k.', 'negeri agung, kab. way kanan, lampung', '081252309262', 'laki-laki', '1998-02-01', 'videografer', 500000, '66231232', 'wayanfreda12@gmail.com', 'aktif'),
(2, '2.jpg', 'wayan rida', 'tanjung senang, kota bandar lampung', '081273062253', 'laki-laki', '1997-06-25', 'fotografer', 700000, '66512323', 'contact@wayanrida.com', 'aktif'),
(4, '3.jpg', 'wfk', 'seoul korea', '0823224644', 'laki-laki', '1999-10-14', 'fotografer', 600000, '1575602683', 'muhrisky@gmail.com', 'aktif'),
(7, '4.png', 'kadek gobeh', 'negeri agung, kab. way kanan, lampung', '082279373752', 'laki-laki', '1998-01-05', 'fotografer', 1500000, '1576646765', 'kadekgobeh@gmail.com', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stars`
--

CREATE TABLE `stars` (
  `id_star` int(11) NOT NULL,
  `user_idstar` int(50) NOT NULL,
  `member_idstar` int(50) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stars`
--

INSERT INTO `stars` (`id_star`, `user_idstar`, `member_idstar`, `time`) VALUES
(21, 3, 2, '1574660694'),
(27, 3, 4, '1575656539'),
(34, 1, 2, '1579760507'),
(36, 1, 4, '1579778545'),
(39, 15, 7, '1580318995'),
(40, 15, 1, '1580318995'),
(43, 18, 7, '1580580479'),
(44, 15, 2, '1581645126'),
(46, 21, 2, '1594740355'),
(47, 21, 4, '1595340424');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `foto_user` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `alamat_user` varchar(150) NOT NULL,
  `tanggallahir_user` date NOT NULL,
  `jeniskelamin_user` varchar(20) NOT NULL,
  `nomertelepon_user` varchar(20) NOT NULL,
  `level_user` varchar(20) NOT NULL,
  `tema_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  `daftar_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `foto_user`, `nama_user`, `alamat_user`, `tanggallahir_user`, `jeniskelamin_user`, `nomertelepon_user`, `level_user`, `tema_user`, `email_user`, `password_user`, `daftar_user`) VALUES
(1, '70240419_1452167898280726_7289787273548136448_n.jpg', 'admin', 'bandar lampung', '1997-06-25', 'laki-laki', '081273062253', 'admin', 'teal', 'lightcreative@gmail.com', '12345', '1575906470'),
(2, '256747-d5a5ba2743ec10c294ceb79c652f4bc2fce746cd.jpg', 'nami', 'ohayo', '2012-12-12', 'perempuan', '08215434545', 'user', 'teal', 'nami@gmail.com', 'QWERT', '1575906470'),
(3, 'robin.png', 'robinson', 'jln raya', '1990-10-10', 'perempuan', '08214435544', 'user', 'red', 'robin@gmail.com', '12345', '1575906470'),
(4, 'sanji.png', 'krisna sykes', 'jalan pramuka no 31', '1991-07-15', 'laki-laki', '0821556467', 'user', 'teal', 'krisnasykes@gmail.com', '12345', '1575906470'),
(5, 'Gaara_by_Puppet_Girl86.jpg', 'ketut krisna', 'mulyasari', '2005-12-10', 'laki-laki', '0823123242', 'user', 'grey darken-4', 'togek@gmail.com', 'togek123', '1575968621'),
(6, '0.default.png', 'Uajng', '', '2009-08-13', 'perempuan', '', 'user', 'teal', 'ujang@gmail.com', 'babiguling', '1576585315'),
(7, '0.default.png', 'wayan rida', '', '1997-06-25', 'laki-laki', '', 'user', 'teal', 'contactwayanrida@gmail.com', '12345', '1576585848'),
(8, '0.default.png', 'Nazwa', '', '2019-12-12', 'perempuan', '', 'user', 'teal', 'nazwaikmalia.fahmi@yahoo.com', '12345', '1576721295'),
(9, '0.default.png', 'Joni', '', '2019-11-06', 'laki-laki', '', 'user', 'teal', 'jonijoni006@gmail.com', '006611', '1577118924'),
(10, '0.default.png', 'Wkwk', '', '2019-12-24', 'laki-laki', '', 'user', 'orange', 'wkwk@gmail.com', 'bodat', '1577144196'),
(11, '0.default.png', 'Coba', '', '2018-09-27', 'laki-laki', '', 'user', 'teal', 'coba@gmail.com', '12345', '1577160848'),
(12, '0.default.png', 'Yosianus Antonio', '', '1998-06-11', 'laki-laki', '', 'user', 'teal', 'yosianus@gmail.com', '110698', '1577760073'),
(13, '0.default.png', 'Wayan1', '', '1997-06-26', 'laki-laki', '', 'user', 'teal', 'wayanrida@gmail.com', '1234567', '1579079327'),
(14, '0.default.png', 'Kadek Gobeh', '', '1999-02-02', 'laki-laki', '', 'user', 'teal', 'gobeh@gmail.com', '12345', '1580064671'),
(16, '0.default.png', 'Kistiantoo', '', '2020-01-30', 'laki-laki', '', 'user', 'teal', 'kis@gmail.com', 'sayasaya', '1580349478'),
(17, '0.default.png', 'Wayan Freda', '', '1998-07-20', 'laki-laki', '', 'user', 'teal', 'pacemonofreda@gmail.com', '20pacemono', '1580358607'),
(18, '0.default.png', 'Baruna Wisnu Wardana', '', '2020-02-02', 'laki-laki', '', 'user', 'orange', 'barunawisnu2@gmail.com', 'mesuji123', '1580579897'),
(19, '0.default.png', 'Cantika', '', '2019-09-19', 'perempuan', '', 'user', 'teal', 'cantika@gmail.com', 'cantika', '1580820913'),
(20, '0.default.png', 'Pak Yuni', '', '1975-06-06', 'laki-laki', '', 'user', 'grey darken-4', 'pakyuni@gmail.com', '12345', '1583292179'),
(21, '0.default.png', 'ayay', '', '2019-01-01', 'laki-laki', '', 'user', 'teal', 'jalankeliling75@gmail.com', '12345', '1594319910'),
(22, '0.default.png', 'nandaansar01@gmail.com', '', '2020-07-05', 'laki-laki', '', 'user', 'teal', 'nanda.ansar@raja.my.id', 'nandaansar01', '1597241417'),
(23, '0.default.png', 'relep', '', '1992-12-12', 'laki-laki', '', 'user', 'grey darken-4', 'relepul@gmail.com', 'kontol', '1604751236'),
(24, '0.default.png', 'gede agus wiyarsane', '', '1992-08-15', 'laki-laki', '', 'user', 'teal', 'gedeaguswiarsane@gmail.com', 'sayangku2', '1610600449');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id_star`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `stars`
--
ALTER TABLE `stars`
  MODIFY `id_star` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
