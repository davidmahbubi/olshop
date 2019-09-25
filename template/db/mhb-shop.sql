-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Sep 2019 pada 16.21
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `ordered_product_table`
--

CREATE TABLE `ordered_product_table` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_identity_table`
--

CREATE TABLE `order_identity_table` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `receiver_name` varchar(128) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `postal` int(40) NOT NULL,
  `courier_id` int(10) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `transfer_proof_img` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `airway_bill` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_status_table`
--

CREATE TABLE `order_status_table` (
  `id` int(11) NOT NULL,
  `status_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `order_date` int(11) NOT NULL,
  `order_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_review_table`
--

CREATE TABLE `product_review_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `review` varchar(255) NOT NULL,
  `product_id` int(10) NOT NULL,
  `date_posted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_table`
--

CREATE TABLE `token_table` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_type_id` int(10) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_type_table`
--

CREATE TABLE `token_type_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `block` int(2) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ordered_product_table`
--
ALTER TABLE `ordered_product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_identity_table`
--
ALTER TABLE `order_identity_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_status_table`
--
ALTER TABLE `order_status_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `owner_table`
--
ALTER TABLE `owner_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `page_table`
--
ALTER TABLE `page_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_categories_table`
--
ALTER TABLE `product_categories_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_review_table`
--
ALTER TABLE `product_review_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `token_table`
--
ALTER TABLE `token_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `token_type_table`
--
ALTER TABLE `token_type_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_role_table`
--
ALTER TABLE `user_role_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
