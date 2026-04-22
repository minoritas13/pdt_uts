-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2026 at 12:24 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pusat`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `penerbit_id` bigint UNSIGNED NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_nasional` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kategori_id`, `penerbit_id`, `isbn`, `judul`, `penulis`, `harga_nasional`, `created_at`, `updated_at`) VALUES
(1, 8, 8, '9797290168114', 'Inventore vero quo nam.', 'Dr. Rowan Bogisich III', 138000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(2, 4, 9, '9784538638034', 'Eligendi voluptas nisi dolor et.', 'Jaqueline Schulist', 117000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(3, 3, 6, '9781710915372', 'Nobis qui explicabo hic.', 'Princess Connelly', 264000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(4, 2, 10, '9787746463443', 'Voluptatem aperiam quos.', 'Bonnie Kiehn', 126000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(5, 2, 10, '9786970419004', 'Eius vel.', 'Haylie Hegmann', 242000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(6, 3, 15, '9790543847293', 'Illo occaecati enim.', 'Dr. Corene Mertz', 171000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(7, 7, 3, '9780058825312', 'At recusandae rerum dolorum.', 'Mr. Damon Tremblay Sr.', 205000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(8, 7, 10, '9790452698733', 'Repellat dolor hic pariatur.', 'Gustave Hagenes', 95000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(9, 5, 8, '9782334064088', 'Cupiditate enim consectetur.', 'Elissa Waelchi', 229000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(10, 7, 14, '9791352592930', 'Quisquam impedit tenetur.', 'Dianna Thiel PhD', 67000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(11, 8, 14, '9794677896134', 'Laboriosam excepturi.', 'Ms. Marcelle Volkman', 217000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(12, 5, 2, '9790654584292', 'Omnis repellendus dolorum.', 'Claude Dibbert', 244000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(13, 6, 4, '9780052664474', 'Quia veritatis quibusdam.', 'Dan Conroy', 155000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(14, 2, 6, '9791928775545', 'Quas et iusto.', 'Justine Thiel', 98000.00, '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(15, 6, 12, '9780384333475', 'Similique in soluta.', 'Kacie Grimes V', 262000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(16, 1, 2, '9787512841185', 'Molestias voluptatem repellat magnam.', 'Dr. Sydnie Goyette', 150000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(17, 9, 13, '9783417063806', 'Eum numquam voluptates.', 'Prof. Ernest Kunde', 247000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(18, 6, 4, '9784051871963', 'Recusandae debitis deserunt ut.', 'Prof. Julien Corwin', 179000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(19, 6, 9, '9783846412640', 'Doloremque maiores et possimus.', 'Mr. Kevon Torp', 149000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(20, 8, 6, '9797255392820', 'Tempore excepturi molestiae doloribus.', 'Julie Swaniawski', 254000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(21, 1, 3, '9794302785871', 'Et perspiciatis omnis.', 'Lennie Rodriguez', 139000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(22, 7, 9, '9781379812494', 'Voluptatum error corporis.', 'Niko Price', 173000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(23, 9, 5, '9796869496474', 'Ipsa odio corrupti.', 'Olga Wunsch', 216000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(24, 5, 11, '9785079286043', 'Qui quia esse accusantium.', 'Margot Ratke', 103000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(25, 8, 6, '9795305003702', 'Vel ex fuga nemo.', 'Rhianna Feeney', 216000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(26, 6, 2, '9798698043850', 'Et fugit tempora.', 'Prof. Devin Ledner PhD', 54000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(27, 10, 3, '9785077802313', 'Nihil non sit.', 'Keven Zulauf DVM', 135000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(28, 5, 4, '9791887694505', 'In distinctio in.', 'Maximo Hahn', 217000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(29, 4, 12, '9793567518705', 'Velit doloribus odio et.', 'Mrs. Brandi Borer V', 140000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(30, 4, 13, '9788540205345', 'Ut illo laboriosam.', 'Prof. Keaton Abshire Sr.', 295000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(31, 9, 11, '9787338910935', 'Qui ex aut explicabo.', 'Dr. Amelie Johnston II', 110000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(32, 4, 14, '9785548022561', 'Placeat placeat veritatis.', 'Aiden Christiansen', 267000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(33, 5, 3, '9784404367228', 'Rerum quo sit amet.', 'Cathy Weimann', 49000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(34, 4, 13, '9799959184916', 'Et dignissimos.', 'Dr. Elinor Wehner', 299000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(35, 2, 2, '9784695035998', 'Consectetur dolores ipsam.', 'Twila Lemke', 176000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(36, 8, 10, '9783227810171', 'Laborum asperiores excepturi id.', 'Ernest Feil', 107000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(37, 4, 12, '9788850420322', 'Omnis velit eius dolorem.', 'Yazmin Spencer II', 182000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(38, 9, 1, '9782873219697', 'Voluptatem suscipit similique possimus eligendi.', 'Evangeline Beahan', 252000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(39, 1, 3, '9796029997469', 'Vel voluptatibus quasi molestias.', 'Ms. Valentina Kutch III', 158000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(40, 6, 6, '9789286812507', 'Blanditiis maxime natus est.', 'Dr. Maxine Zemlak', 207000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(41, 2, 7, '9788216160695', 'Consequatur maiores impedit est.', 'Evert Osinski', 199000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(42, 6, 15, '9784092992535', 'Eligendi esse quia nobis hic.', 'Maddison Schinner', 200000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(43, 8, 1, '9782312975283', 'Quidem aliquam blanditiis.', 'Helen Funk', 147000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(44, 1, 15, '9788774128380', 'Est sunt recusandae nobis.', 'Muriel Reichel', 218000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(45, 4, 2, '9781079053791', 'Mollitia eligendi aut aut.', 'Cristal Mosciski', 224000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(46, 10, 5, '9788662923639', 'Sunt ut deserunt.', 'Brendon Fisher', 251000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(47, 7, 14, '9795227963337', 'Mollitia asperiores.', 'Berenice Robel', 147000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(48, 3, 1, '9796205108610', 'Cupiditate modi sed.', 'Amely Hickle', 171000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(49, 9, 11, '9782433579575', 'Debitis quia placeat porro.', 'Madelyn Batz Jr.', 113000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(50, 6, 11, '9783114901494', 'Dolorum autem sed recusandae minima.', 'Norwood Kerluke IV', 241000.00, '2026-04-21 22:20:53', '2026-04-21 22:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `kode_cabang`, `nama_cabang`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'CBG-67', 'Gramedia Gibsontown', '8403 Anderson Expressway\nDoyleberg, MD 73299', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(2, 'CBG-33', 'Gramedia Kulasburgh', '696 Beatty Roads\nNorth Joel, KS 10622-4051', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(3, 'CBG-94', 'Gramedia East Pinkietown', '12228 Bosco Ferry Apt. 363\nNorth Asha, KY 95831', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(4, 'CBG-64', 'Gramedia East Kenneth', '7951 Leilani Neck\nNew Lamarshire, IN 67143-8976', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(5, 'CBG-48', 'Gramedia Dickinsonshire', '83544 Jeromy Groves\nWilliamsonstad, AL 36146', '2026-04-21 22:20:53', '2026-04-21 22:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Seni', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(2, 'Sejarah', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(3, 'Biografi', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(4, 'Kesehatan', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(5, 'Hukum', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(6, 'Anak-anak', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(7, 'Teknologi', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(8, 'Sastra', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(9, 'Fiksi', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(10, 'Komik', '2026-04-21 22:20:52', '2026-04-21 22:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_gudang_pusat`
--

CREATE TABLE `mutasi_gudang_pusat` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `jenis` enum('MASUK','KELUAR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mutasi_gudang_pusat`
--

INSERT INTO `mutasi_gudang_pusat` (`id`, `buku_id`, `jenis`, `qty`, `keterangan`, `waktu`, `created_at`, `updated_at`) VALUES
(1, 1, 'KELUAR', 50, 'Distribusi Barang ke Cabang Lampung', '2026-04-22 06:40:53', '2026-04-22 06:40:53', '2026-04-22 06:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_nasional`
--

CREATE TABLE `pelanggan_nasional` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan_nasional`
--

INSERT INTO `pelanggan_nasional` (`id`, `nama`, `asal_cabang`, `created_at`, `updated_at`) VALUES
(1, 'Mackenzie Heller II', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(2, 'Jaeden Barton', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(3, 'Dagmar Waelchi', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(4, 'Leila Kshlerin', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(5, 'Blaze Schultz', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(6, 'Aaron Maggio', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(7, 'Prof. Pearline Herzog', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(8, 'Myron Zieme', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(9, 'Lurline Streich', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(10, 'Florencio Cole', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(11, 'Gracie Boyer', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(12, 'Loma Von', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(13, 'Lula Wunsch', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(14, 'Prof. Morton Ullrich', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(15, 'Miss Angelica Zulauf', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(16, 'Mr. Brennan Upton', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(17, 'Mitchel Raynor', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(18, 'Mauricio Farrell', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(19, 'Marcelo Wolff', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(20, 'Gwendolyn Rosenbaum PhD', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(21, 'Golda Funk', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(22, 'Ethelyn Wisoky', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(23, 'Aubrey Watsica', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(24, 'Dr. Garth Murazik V', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(25, 'Prof. Jordy Murazik Sr.', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(26, 'Fletcher Rice PhD', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(27, 'Ms. Tierra Douglas III', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(28, 'Alvis Lehner III', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(29, 'Britney Beahan II', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(30, 'Lucie Nader', 'Gramedia Lampung', '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(31, 'Mahasiswa Unila', 'Gramedia Lampung', '2026-04-22 05:28:57', '2026-04-22 05:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama_penerbit`, `kota`, `created_at`, `updated_at`) VALUES
(1, 'Penerbit Hyatt, Dietrich and Schmitt', 'Grimesville', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(2, 'Penerbit Cummerata and Sons', 'Cartwrightport', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(3, 'Penerbit Kshlerin and Sons', 'New Mariettaville', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(4, 'Penerbit Kozey-Altenwerth', 'Lindgrenbury', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(5, 'Penerbit Smith-McGlynn', 'South Gideon', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(6, 'Penerbit Armstrong-DuBuque', 'Franceschester', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(7, 'Penerbit Kling-O\'Conner', 'Hintzfurt', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(8, 'Penerbit Medhurst-Bernhard', 'North Pearlmouth', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(9, 'Penerbit Schulist LLC', 'Bauchtown', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(10, 'Penerbit Nicolas, Gottlieb and Langworth', 'South Elianshire', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(11, 'Penerbit Yost-Gusikowski', 'West Antwonhaven', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(12, 'Penerbit Lowe and Sons', 'Emeliemouth', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(13, 'Penerbit Hoppe-Sawayn', 'South Samanthaton', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(14, 'Penerbit Armstrong-Senger', 'Jenkinston', '2026-04-21 22:20:52', '2026-04-21 22:20:52'),
(15, 'Penerbit Douglas LLC', 'Port Alphonso', '2026-04-21 22:20:52', '2026-04-21 22:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `rekap_harian_nasional`
--

CREATE TABLE `rekap_harian_nasional` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `total_transaksi` int NOT NULL DEFAULT '0',
  `total_pendapatan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekap_harian_nasional`
--

INSERT INTO `rekap_harian_nasional` (`id`, `cabang_id`, `tanggal`, `total_transaksi`, `total_pendapatan`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-04-22', 41, 35834000.00, '2026-04-21 22:20:56', '2026-04-22 12:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `stok_gudang_pusat`
--

CREATE TABLE `stok_gudang_pusat` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `qty_tersedia` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stok_gudang_pusat`
--

INSERT INTO `stok_gudang_pusat` (`id`, `buku_id`, `qty_tersedia`, `created_at`, `updated_at`) VALUES
(1, 1, 117, '2026-04-21 22:20:53', '2026-04-22 06:40:53'),
(2, 2, 400, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(3, 3, 376, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(4, 4, 396, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(5, 5, 143, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(6, 6, 417, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(7, 7, 427, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(8, 8, 143, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(9, 9, 387, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(10, 10, 259, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(11, 11, 107, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(12, 12, 477, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(13, 13, 386, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(14, 14, 448, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(15, 15, 121, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(16, 16, 328, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(17, 17, 352, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(18, 18, 477, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(19, 19, 466, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(20, 20, 196, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(21, 21, 328, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(22, 22, 384, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(23, 23, 121, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(24, 24, 207, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(25, 25, 312, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(26, 26, 279, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(27, 27, 300, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(28, 28, 158, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(29, 29, 211, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(30, 30, 441, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(31, 31, 130, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(32, 32, 268, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(33, 33, 467, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(34, 34, 466, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(35, 35, 397, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(36, 36, 369, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(37, 37, 378, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(38, 38, 426, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(39, 39, 300, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(40, 40, 150, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(41, 41, 425, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(42, 42, 428, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(43, 43, 367, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(44, 44, 114, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(45, 45, 236, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(46, 46, 165, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(47, 47, 296, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(48, 48, 199, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(49, 49, 400, '2026-04-21 22:20:53', '2026-04-21 22:20:53'),
(50, 50, 259, '2026-04-21 22:20:53', '2026-04-21 22:20:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buku_isbn_unique` (`isbn`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`),
  ADD KEY `buku_penerbit_id_foreign` (`penerbit_id`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cabang_kode_cabang_unique` (`kode_cabang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_gudang_pusat`
--
ALTER TABLE `mutasi_gudang_pusat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutasi_gudang_pusat_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `pelanggan_nasional`
--
ALTER TABLE `pelanggan_nasional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap_harian_nasional`
--
ALTER TABLE `rekap_harian_nasional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekap_harian_nasional_cabang_id_foreign` (`cabang_id`);

--
-- Indexes for table `stok_gudang_pusat`
--
ALTER TABLE `stok_gudang_pusat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_gudang_pusat_buku_id_foreign` (`buku_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mutasi_gudang_pusat`
--
ALTER TABLE `mutasi_gudang_pusat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan_nasional`
--
ALTER TABLE `pelanggan_nasional`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rekap_harian_nasional`
--
ALTER TABLE `rekap_harian_nasional`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_gudang_pusat`
--
ALTER TABLE `stok_gudang_pusat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `buku_penerbit_id_foreign` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id`);

--
-- Constraints for table `mutasi_gudang_pusat`
--
ALTER TABLE `mutasi_gudang_pusat`
  ADD CONSTRAINT `mutasi_gudang_pusat_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`);

--
-- Constraints for table `rekap_harian_nasional`
--
ALTER TABLE `rekap_harian_nasional`
  ADD CONSTRAINT `rekap_harian_nasional_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabang` (`id`);

--
-- Constraints for table `stok_gudang_pusat`
--
ALTER TABLE `stok_gudang_pusat`
  ADD CONSTRAINT `stok_gudang_pusat_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
