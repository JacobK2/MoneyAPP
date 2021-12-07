<?php
$insert[] = "INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Mieszkanie'),
(2, 'Prąd'),
(3, 'Jedzenie'),
(35, 'Gry'),
(36, 'Ubranie'),
(37, 'Transport'),
(38, 'Paliwo'),
(39, 'Relaks'),
(40, 'Inne');";
$insert[] .= "INSERT INTO `currency` (`id`, `currency`) VALUES
(1, 'PLN'),
(2, 'USD'),
(3, 'BTC'),
(4, 'EUR');";
$insert[] .= "INSERT INTO `expenses` (`id`, `idUser`, `value`, `idCurrency`, `idCategory`, `date`) VALUES
(1, 2, 2000, 1, 35, '2021-10-14'),
(3, 2, 3000, 2, 2, '2021-09-29'),
(6, 1, 999, 4, 3, '2021-10-29');";
$insert[] .= "INSERT INTO `goals` (`id`, `idUser`, `name`, `value`, `idCurrency`, `idCategory`, `date`, `archived`) VALUES
(2, 2, 'Przyszłość', 300, 2, 1, '2021-10-15', 0),
(3, 1, 'Samochód', 12000, 1, 1, '2021-10-04', 0);";
$insert[] .= "INSERT INTO `users` (`id`, `imie`, `nazwisko`, `email`, `password`, `isAdmin`, `isActive`) VALUES
(1, 'Admin', 'SU', 'test@test.pl', '$2y$10\$mbXUMh5BFommYhErdmeQSOglDaVJPtNZCJMxwbYYpsHRod.kTSlQW', '1', '1'),
(2, 'Jakub', 'Karalus', 'jakub@gm.pl', '$2y$10$1fEqLV2W458Vgs5I7qoaFOUCul.Gp8eH3CuVghNglA79rbL9arNfq', '0', '1');";
// $insert[] .= "INSERT INTO `".$prefix."users` (`id`, `imie`, `nazwisko`, `email`, `password`, `isAdmin`, `isActive`) VALUES
// (1, '', '', 'test@test.pl', '\$2y\$10\$jjs2pHjJMFjenZVd8zNAg..EqFcdIjz.BqumUhpgI50VLh4nMwTKS', '1', '1'),
// (2, 'Jakub', 'Karalus', 'jakub@gm.pl', '\$2y\$10\$PjJpU91a54.ooRa.1vxyoOZ3CNrXA5n28F58/mLPV3JaDE3l55.XS', '0', '1');";
?>