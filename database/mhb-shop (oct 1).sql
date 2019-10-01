-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 01 Okt 2019 pada 13.22
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhb-shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courier_table`
--

CREATE TABLE `courier_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `courier_table`
--

INSERT INTO `courier_table` (`id`, `name`) VALUES
(1, 'JNE'),
(2, 'JNT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ordered_product_table`
--

CREATE TABLE `ordered_product_table` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `id_product` int(11) NOT NULL,
  `total` int(50) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ordered_product_table`
--

INSERT INTO `ordered_product_table` (`id`, `order_id`, `id_product`, `total`, `sub_total`) VALUES
(10, 'mhb-ord-5d8f437ad9ad6', 1, 1, 7000000),
(11, 'mhb-ord-5d8f437ad9ad6', 2, 3, 33000000),
(12, 'mhb-ord-5d8f437ad9ad6', 4, 2, 14000000),
(14, 'mhb-ord-5d8f5f24e0104', 4, 2, 14000000),
(15, 'mhb-ord-5d8f60a587e25', 3, 1, 16000000),
(16, 'mhb-ord-5d8f6e5eaa83a', 1, 2, 14000000),
(17, 'mhb-ord-5d9183b6dcb17', 4, 1, 7000000),
(18, 'mhb-ord-5d9188bf22232', 2, 1, 11000000),
(19, 'mhb-ord-5d91eb8050e92', 2, 1, 11000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_identity_table`
--

CREATE TABLE `order_identity_table` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `receiver_name` varchar(128) NOT NULL,
  `complete_address` text NOT NULL,
  `postal` int(40) NOT NULL,
  `courier_id` int(10) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `transfer_proof_img` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `airway_bill` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_identity_table`
--

INSERT INTO `order_identity_table` (`id`, `order_id`, `receiver_name`, `complete_address`, `postal`, `courier_id`, `phone_number`, `transfer_proof_img`, `user_id`, `airway_bill`) VALUES
(5, 'mhb-ord-5d8f437ad9ad6', 'Suzukaze Aoba', '136-1035, Chayamachi, Komatsu-shi, Ishikawa, Japan', 68486, 1, 2147483647, 'pbb_atm_receipt1.jpg', 1, '12753671243'),
(7, 'mhb-ord-5d8f5f24e0104', 'Suzukaze Aoba', '136-1035, Chayamachi, Komatsu-shi, Ishikawa, Japan', 143333, 2, 776125341, 'pbb_atm_receipt12.jpg', 1, ''),
(8, 'mhb-ord-5d8f60a587e25', 'Ayra Hikari', 'asdasjbdjhas', 123444, 1, 1231248213, 'N2sbnI1aiQmwJNNMDKKChg.jpeg', 2, ''),
(9, 'mhb-ord-5d8f6e5eaa83a', 'Suzukaze Aoba', '136-1035, Chayamachi, Komatsu-shi, Ishikawa, Japan', 213333, 1, 2147483647, 'leA63VsIHvDvd2Z4mD8jHdOgoFPcf1AtZzvDB3NlWHo.jpg', 1, ''),
(10, 'mhb-ord-5d9183b6dcb17', 'Ayra Hikari', 'sdkja', 443567, 1, 2147483647, 'leA63VsIHvDvd2Z4mD8jHdOgoFPcf1AtZzvDB3NlWHo1.jpg', 2, ''),
(11, 'mhb-ord-5d9188bf22232', 'Ayra Hikari', 'asda', 443567, 1, 2147483647, 'Screenshot_from_2019-09-30_10-48-13.png', 2, ''),
(12, 'mhb-ord-5d91eb8050e92', 'Ayra Hikari', 'lsdahgs', 11123, 2, 1263651234, 'receipt_1.jpg', 2, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_status_table`
--

CREATE TABLE `order_status_table` (
  `id` int(11) NOT NULL,
  `status_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_status_table`
--

INSERT INTO `order_status_table` (`id`, `status_name`) VALUES
(1, 'Waiting for payment verification'),
(2, 'Processed by owner'),
(3, 'On the way'),
(4, 'On receiver\'s city'),
(5, 'Delivered'),
(6, 'Received');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_table`
--

CREATE TABLE `order_table` (
  `id` varchar(255) NOT NULL,
  `order_date` int(11) NOT NULL,
  `order_status` int(10) NOT NULL,
  `reviewed` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_table`
--

INSERT INTO `order_table` (`id`, `order_date`, `order_status`, `reviewed`) VALUES
('mhb-ord-5d8f437ad9ad6', 1569670010, 6, 1),
('mhb-ord-5d8f5f24e0104', 1569677092, 6, 1),
('mhb-ord-5d8f60a587e25', 1569677477, 6, 1),
('mhb-ord-5d8f6e5eaa83a', 1569680990, 1, 0),
('mhb-ord-5d9183b6dcb17', 1569817526, 6, 1),
('mhb-ord-5d9188bf22232', 1569818815, 6, 1),
('mhb-ord-5d91eb8050e92', 1569844096, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `owner_table`
--

CREATE TABLE `owner_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `owner_table`
--

INSERT INTO `owner_table` (`id`, `name`, `username`, `password`, `image`, `role_id`) VALUES
(1, 'David Mahbubi', 'davidmhb', '$2y$10$d2d15ueXgclNzsCDQAL3ieKBlIYGU40q9dZ/KwtwYh1KvbBFdr7da', 'default.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `page_table`
--

CREATE TABLE `page_table` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories_table`
--

CREATE TABLE `product_categories_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_categories_table`
--

INSERT INTO `product_categories_table` (`id`, `name`) VALUES
(1, 'Smartphone'),
(2, 'Laptop'),
(3, 'Processor'),
(4, 'RAM'),
(5, 'Harddisk'),
(6, 'SSD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_review_table`
--

CREATE TABLE `product_review_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `review` text NOT NULL,
  `product_id` int(10) NOT NULL,
  `date_posted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_review_table`
--

INSERT INTO `product_review_table` (`id`, `user_id`, `rating`, `review`, `product_id`, `date_posted`) VALUES
(1, 1, 4, 'Nice gan, keren abees', 1, 1569757875),
(2, 1, 5, 'Wooow kece parah', 2, 1569757875),
(3, 1, 2, 'Packing penyok, kaki prosesor bengkok', 4, 1569757875),
(4, 1, 5, 'Keren bosqueee', 4, 1569757972),
(5, 2, 3, 'Tydack mengecewakan, cuman salah warna aja', 3, 1569817222),
(6, 2, 5, 'Hessa, garok kun here, garoque kun ga daisukiiii', 4, 1569817829),
(7, 2, 5, 'Review kedua', 3, 1569818104),
(10, 2, 5, 'Nice gan', 2, 1569819017);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_table`
--

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(10) NOT NULL,
  `img` varchar(128) NOT NULL,
  `stock` int(11) NOT NULL,
  `rating` float NOT NULL,
  `weight` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_table`
--

INSERT INTO `product_table` (`id`, `name`, `description`, `price`, `category_id`, `img`, `stock`, `rating`, `weight`, `date_created`) VALUES
(1, 'Toshiba Portege z30', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7000000, 2, '350667-toshiba-portege-z30-a1301.jpg', 22, 0, 1200, 1551612062),
(2, 'iPhone X 128 GB', 'mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit es', 11000000, 1, 'apple_iphone_x__3_result_price_1.jpg', 12, 2, 700, 1556885403),
(3, 'MacBook Pro Touchbar', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 16000000, 2, 'mbp15touch-silver-select-cto-201807_3_1.jpeg', 3, 4, 1500, 1569580909),
(4, 'Intel core i9 9-900K', 'A family of 64-bit x86 CPUs with up to 18 cores from Intel. Introduced in 2017, the Core i9 became the top model in the Core \"i\" series. Also part of the Intel Core X-series brand, the first i9 CPU (7900x) is based on 14 nm process technology and the Skylake-X microarchitecture. It features four channels of DDR4 RAM and 44 lanes of PCI Express (compared with 28 in the i7). Designed for high-performance computing and gaming, the 3.3 GHz i9 chip can be overclocked to 4.5 GHz', 7000000, 3, 'core-i9.jpg', 4, 4, 400, 1553212800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_table`
--

CREATE TABLE `token_table` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_type_id` int(10) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `token_table`
--

INSERT INTO `token_table` (`id`, `token`, `user_id`, `token_type_id`, `date_created`) VALUES
(9, 'mhb-fg-5d9335b69a081', 7, 1, 1569928634);

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_type_table`
--

CREATE TABLE `token_type_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `token_type_table`
--

INSERT INTO `token_type_table` (`id`, `name`) VALUES
(1, 'forgot password'),
(2, 'register');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role_table`
--

CREATE TABLE `user_role_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `block` int(2) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL,
  `is_active` int(2) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_table`
--

INSERT INTO `user_table` (`id`, `first_name`, `last_name`, `email`, `password`, `address`, `block`, `image`, `date_created`, `is_active`, `role_id`) VALUES
(1, 'Suzukaze', 'Aoba', 'suzuaoba@gmail.com', '$2y$10$MHcq.FfhDVTCBqXqOaXJGOnuyk.pQwsRca.49QVP/AcD/6iQWU8yG', '136-1035, Chayamachi, Komatsu-shi, Ishikawa, Japan', 0, 'beautiful-beauty-costume-2034538.jpg', 1569407658, 1, 2),
(2, 'Ayra', 'Hikari', 'ayrachan@gmail.com', '$2y$10$z9xg7.zwzin0hy8./s3ZMOuvV/1wAT3luifFzAXmHv5i8QRFCR/0O', '', 0, 'default.png', 1569407733, 1, 2),
(3, 'David', 'Mahbubi', 'ulrichdavid0370@gmail.com', '$2y$10$PU7kGmEBokDDhV6j6pGPruqTc16ROz2LIqTyaClijvTceDfymlaN6', '', 0, 'default.png', 1569905695, 1, 2),
(7, 'Tobi', 'Chopaw', 'tebicofaw@mailspro.net', '$2y$10$bdW0q3Gmw5dF7VdV0kKoXeLvHocrme/Tsx6aH/e6SZeSzVoGVESHa', '', 0, 'default.png', 1569928627, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `courier_table`
--
ALTER TABLE `courier_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ordered_product_table`
--
ALTER TABLE `ordered_product_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_identity_table`
--
ALTER TABLE `order_identity_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_status_table`
--
ALTER TABLE `order_status_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `owner_table`
--
ALTER TABLE `owner_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `page_table`
--
ALTER TABLE `page_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_categories_table`
--
ALTER TABLE `product_categories_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_review_table`
--
ALTER TABLE `product_review_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `token_table`
--
ALTER TABLE `token_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `token_type_table`
--
ALTER TABLE `token_type_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role_table`
--
ALTER TABLE `user_role_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `courier_table`
--
ALTER TABLE `courier_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ordered_product_table`
--
ALTER TABLE `ordered_product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `order_identity_table`
--
ALTER TABLE `order_identity_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `order_status_table`
--
ALTER TABLE `order_status_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `owner_table`
--
ALTER TABLE `owner_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `page_table`
--
ALTER TABLE `page_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_categories_table`
--
ALTER TABLE `product_categories_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `product_review_table`
--
ALTER TABLE `product_review_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `token_table`
--
ALTER TABLE `token_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `token_type_table`
--
ALTER TABLE `token_type_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_role_table`
--
ALTER TABLE `user_role_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
