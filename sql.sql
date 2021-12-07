-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Paź 2021, 07:38
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `jkaralus`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Mieszkanie'),
(2, 'Prąd'),
(3, 'Jedzenie'),
(35, 'Gry'),
(36, 'Ubranie'),
(37, 'Transport'),
(38, 'Paliwo'),
(39, 'Relaks'),
(40, 'Inne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `currency`
--

INSERT INTO `currency` (`id`, `currency`) VALUES
(1, 'PLN'),
(2, 'USD'),
(3, 'BTC'),
(4, 'EUR');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `expenses`
--

CREATE TABLE `expenses` (
  `id` int(255) UNSIGNED NOT NULL,
  `idUser` int(255) UNSIGNED NOT NULL,
  `value` int(255) NOT NULL,
  `idCurrency` int(10) UNSIGNED NOT NULL,
  `idCategory` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `expenses`
--

INSERT INTO `expenses` (`id`, `idUser`, `value`, `idCurrency`, `idCategory`, `date`) VALUES
(1, 2, 2000, 1, 35, '2021-10-14'),
(3, 2, 3000, 2, 2, '2021-09-29'),
(6, 1, 999, 4, 3, '2021-10-29');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `goals`
--

CREATE TABLE `goals` (
  `id` int(255) UNSIGNED NOT NULL,
  `idUser` int(100) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `value` int(255) NOT NULL,
  `idCurrency` int(10) UNSIGNED NOT NULL,
  `idCategory` int(100) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `goals`
--

INSERT INTO `goals` (`id`, `idUser`, `name`, `value`, `idCurrency`, `idCategory`, `date`, `archived`) VALUES
(2, 2, 'Przyszłość', 300, 2, 1, '2021-10-15', 0),
(3, 1, 'Samochód', 12000, 1, 1, '2021-10-04', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(255) UNSIGNED NOT NULL,
  `imie` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(535) COLLATE utf8mb4_polish_ci NOT NULL,
  `isAdmin` enum('1','0') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '0',
  `isActive` enum('1','0') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `imie`, `nazwisko`, `email`, `password`, `isAdmin`, `isActive`) VALUES
(1, 'Admin', 'SU', 'test@test.pl', '$2y$10$mbXUMh5BFommYhErdmeQSOglDaVJPtNZCJMxwbYYpsHRod.kTSlQW', '1', '1'),
(2, 'Jakub', 'Karalus', 'jakub@gm.pl', '$2y$10$1fEqLV2W458Vgs5I7qoaFOUCul.Gp8eH3CuVghNglA79rbL9arNfq', '0', '1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCurrency` (`idCurrency`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Indeksy dla tabeli `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idCurrency` (`idCurrency`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expensesIdCategoryFK` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `expensesIdCurrencyFK` FOREIGN KEY (`idCurrency`) REFERENCES `currency` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `expensesIdUserFK` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goalsIdCategoryFK` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `goalsIdCurrencyFK` FOREIGN KEY (`idCurrency`) REFERENCES `currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `goalsIdUserFK` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
