<?php
$create[] = "CREATE TABLE `users` (
  `id` int(255) UNSIGNED NOT NULL,
  `imie` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(535) COLLATE utf8mb4_polish_ci NOT NULL,
  `isAdmin` enum('1','0') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '0',
  `isActive` enum('1','0') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";
$create[] .= "ALTER TABLE `users` ADD PRIMARY KEY (`id`);";
$create[] .= "ALTER TABLE `users` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
$create[] .= "CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";
$create[] .= "CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";
$create[] .= "CREATE TABLE `expenses` (
  `id` int(255) UNSIGNED NOT NULL,
  `idUser` int(255) UNSIGNED NOT NULL,
  `value` int(255) NOT NULL,
  `idCurrency` int(10) UNSIGNED NOT NULL,
  `idCategory` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";
$create[] .= "CREATE TABLE `goals` (
  `id` int(255) UNSIGNED NOT NULL,
  `idUser` int(100) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `value` int(255) NOT NULL,
  `idCurrency` int(10) UNSIGNED NOT NULL,
  `idCategory` int(100) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";
$create[] .= "ALTER TABLE `category` ADD PRIMARY KEY (`id`);";
$create[] .= "ALTER TABLE `currency` ADD PRIMARY KEY (`id`);";
$create[] .= "ALTER TABLE `expenses` ADD PRIMARY KEY (`id`), ADD KEY `idUser` (`idUser`), ADD KEY `idCurrency` (`idCurrency`), ADD KEY `idCategory` (`idCategory`);";
$create[] .= "ALTER TABLE `goals` ADD PRIMARY KEY (`id`), ADD KEY `idUser` (`idUser`), ADD KEY `idCategory` (`idCategory`), ADD KEY `idCurrency` (`idCurrency`);";
$create[] .= "ALTER TABLE `users` ADD PRIMARY KEY (`id`);";
$create[] .= "ALTER TABLE `category` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;";
$create[] .= "ALTER TABLE `currency` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;";
$create[] .= "ALTER TABLE `expenses` MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
$create[] .= "ALTER TABLE `goals` MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
$create[] .= "ALTER TABLE `users` MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;";
$create[] .= "ALTER TABLE `expenses`
ADD CONSTRAINT `expensesIdCategoryFK` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON UPDATE NO ACTION,
ADD CONSTRAINT `expensesIdCurrencyFK` FOREIGN KEY (`idCurrency`) REFERENCES `currency` (`id`) ON UPDATE NO ACTION,
ADD CONSTRAINT `expensesIdUserFK` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;";
$create[] .= "ALTER TABLE `goals`
ADD CONSTRAINT `goalsIdCategoryFK` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `goalsIdCurrencyFK` FOREIGN KEY (`idCurrency`) REFERENCES `currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `goalsIdUserFK` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;";
$create[] .= "COMMIT;";

?>