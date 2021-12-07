-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 04 Lip 2021, 21:35
-- Wersja serwera: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- Wersja PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `2k21_jkaralus`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL,
  `isAdmin` enum('1','0') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '0',
  `isActive` enum('1','0') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `imie`, `nazwisko`, `email`, `password`, `isAdmin`, `isActive`) VALUES
(1, '', '', 'test@test.pl', '$2y$10$jjs2pHjJMFjenZVd8zNAg..EqFcdIjz.BqumUhpgI50VLh4nMwTKS', '1', '1'),
(2, 'Jakub', 'Karalus', 'jakub@gm.pl', '$2y$10$PjJpU91a54.ooRa.1vxyoOZ3CNrXA5n28F58/mLPV3JaDE3l55.XS', '0', '1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
