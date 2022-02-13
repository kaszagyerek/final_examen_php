-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Feb 13. 10:15
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `social`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `crypto`
--

CREATE TABLE `crypto` (
  `idcrypto` int(11) NOT NULL,
  `cryptoname` varchar(45) DEFAULT NULL,
  `cryptosymbol` varchar(8) DEFAULT NULL,
  `currency` varchar(8) DEFAULT NULL,
  `oldDate` date DEFAULT NULL,
  `oldPrice` double DEFAULT NULL,
  `newPrice` double DEFAULT NULL,
  `newDate` date DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `expense`
--

CREATE TABLE `expense` (
  `idexpense` int(11) NOT NULL,
  `broker` decimal(8,2) DEFAULT NULL,
  `brokername` varchar(45) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `taxname` varchar(45) DEFAULT NULL,
  `hrenovationname` varchar(45) DEFAULT NULL,
  `hrenovation` decimal(8,2) DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `house`
--

CREATE TABLE `house` (
  `idhouse` int(11) NOT NULL,
  `addres` varchar(45) DEFAULT NULL,
  `totalhprice` double DEFAULT NULL,
  `ownPerson` varchar(45) DEFAULT NULL,
  `ownMobil` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `house`
--

INSERT INTO `house` (`idhouse`, `addres`, `totalhprice`, `ownPerson`, `ownMobil`, `users_id`) VALUES
(1, 'Fuzfa', 55000, 'Kasza Sandor', '0752944514', 27),
(2, 'Pictor', 60000, 'Kis Lajos', '0754514214', 28),
(8, 'Merleg', 120000, 'Kalanyos Bence', '075224445', 27),
(10, 'Pacsirta', 50000, 'Kis Lengyel', '0752445444', 27),
(12, 'Rakos', 42000, 'Aranyosi Peter', '074455544', 28),
(13, 'ZoldPeter', 150000, 'Kis Paulina', '071125448', 28),
(14, 'Fenyo', 45121, 'Kis Gida', '07411255', 28),
(16, 'Kavics', 56000, 'Pal Laszlo', '074155445', 28),
(17, 'Perec', 15000, 'Illyes Laszlo', '074556255', 27),
(18, 'Karika', 75000, 'Mako Zoltan', '074555478', 27),
(19, 'Szilva', 125000, 'Filep Levente', '074521451', 27),
(27, 'Karika', 45000, 'Illyes Laszlo', '075245554', 27),
(30, 'Kattos', 150000, 'Kis Jeno', '075555454', 29),
(35, 'Kalacs', 65000, 'Illyes Laszlo', '0755548887', 28),
(39, 'Sajt', 25000, 'Illyes Laszlo', '0745874558', 28),
(41, 'Perec', 30000, 'Filep Levente', '07554444', 28),
(49, 'Perec', 30000, 'Filep Levente', '07554444', 28),
(51, 'eqwewqwq', 312312312, 'weewqeqw', '321321321', 36),
(52, 'kalap', 23232, 'kaara rada', '0700001', 36),
(53, 'galamb', 15000, 'Kis Geza', '14050505', 36);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `houserent`
--

CREATE TABLE `houserent` (
  `idhouserent` int(11) NOT NULL,
  `pricemonth` decimal(6,2) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `house_idhouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `houserent`
--

INSERT INTO `houserent` (`idhouserent`, `pricemonth`, `start`, `end`, `house_idhouse`) VALUES
(1, '100.00', '2021-12-14', '2022-12-14', 1),
(2, '150.00', '2021-12-15', '2022-12-15', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `metals`
--

CREATE TABLE `metals` (
  `idmetals` int(11) NOT NULL,
  `metalname` varchar(45) DEFAULT NULL,
  `metalsymbol` varchar(8) DEFAULT NULL,
  `currency` varchar(6) DEFAULT NULL,
  `oldPrice` double DEFAULT NULL,
  `oldDate` date DEFAULT NULL,
  `newPrice` double DEFAULT NULL,
  `newDate` date DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `prouser`
--

CREATE TABLE `prouser` (
  `idprouser` int(11) NOT NULL,
  `prouserlicence` varchar(45) DEFAULT NULL,
  `creatorid` int(20) NOT NULL,
  `admin_idadmin` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `salary` decimal(50,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `stocks`
--

CREATE TABLE `stocks` (
  `idstocks` int(11) NOT NULL,
  `stockname` varchar(45) DEFAULT NULL,
  `stocksymbol` varchar(10) DEFAULT NULL,
  `currency` varchar(6) DEFAULT NULL,
  `oldDate` datetime DEFAULT NULL,
  `oldPrice` double DEFAULT NULL,
  `newPrice` double DEFAULT NULL,
  `open` double DEFAULT NULL,
  `close` double DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firs_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `firs_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `phone_number`) VALUES
(25, 'Sherlock', 'Bajnok', 'sherlock_bajnok', 'bajnok@sherlock.ro', '21232f297a57a5a743894a0e4a801fc3', '2021-12-02', 'img/profile_pics/r3.png', '07446544545'),
(26, 'Fa', 'Korte', 'fa_korte', 'bajnok2@sherlock.ro', '21232f297a57a5a743894a0e4a801fc3', '2021-12-02', 'img/profile_pics/r2.png', '1555555555'),
(27, 'Kasza', 'Sandor', 'kasza_sandor', 'kasza@kasza.com', '21232f297a57a5a743894a0e4a801fc3', '2021-12-06', 'img/profile_pics/r1.png', '0752944524'),
(28, 'Bajnok', 'Emre', 'bajnok_emre', 'bajnok@f.ro', '21232f297a57a5a743894a0e4a801fc3', '2021-12-06', 'img/profile_pics/r3.png', '0744444'),
(29, 'Huba', 'Hubaa', 'huba_hubaa', 'huba@huba.com', '21232f297a57a5a743894a0e4a801fc3', '2021-12-07', 'img/profile_pics/r1.png', '077777777'),
(30, '', '', '_', '', 'd41d8cd98f00b204e9800998ecf8427e', '2021-12-23', 'img/profile_pics/r3.png', ''),
(36, 'Kis', 'Anna', 'kis_anna', 'anna@anna.com', '21232f297a57a5a743894a0e4a801fc3', '2021-12-23', 'img/profile_pics/r3.png', '07555445'),
(37, 'Daada', 'Dadad', 'daada_dadad', 'kasza@kasza.com', '21232f297a57a5a743894a0e4a801fc3', '2021-12-23', 'img/profile_pics/r3.png', '074554544'),
(38, 'Kis', 'Linda', 'kis_linda', 'ada2', '21232f297a57a5a743894a0e4a801fc3', '2021-12-23', 'img/profile_pics/r3.png', '0755555555');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workplace`
--

CREATE TABLE `workplace` (
  `idworkplace` int(11) NOT NULL,
  `workplacename` varchar(45) DEFAULT NULL,
  `workplaceaddres` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `salary` decimal(8,2) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `workplace`
--

INSERT INTO `workplace` (`idworkplace`, `workplacename`, `workplaceaddres`, `users_id`, `salary`, `position`) VALUES
(8, 'OLX', 'pictor nagy istvan', 36, '25000.00', 'call center ');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- A tábla indexei `crypto`
--
ALTER TABLE `crypto`
  ADD PRIMARY KEY (`idcrypto`),
  ADD KEY `fk_crypto_users_idx` (`users_id`);

--
-- A tábla indexei `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`idexpense`),
  ADD KEY `fk_expense_users1_idx` (`users_id`);

--
-- A tábla indexei `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`idhouse`),
  ADD KEY `fk_house_users1_idx` (`users_id`);

--
-- A tábla indexei `houserent`
--
ALTER TABLE `houserent`
  ADD PRIMARY KEY (`idhouserent`),
  ADD KEY `fk_houserent_house1_idx` (`house_idhouse`);

--
-- A tábla indexei `metals`
--
ALTER TABLE `metals`
  ADD PRIMARY KEY (`idmetals`),
  ADD KEY `fk_metals_users1_idx` (`users_id`);

--
-- A tábla indexei `prouser`
--
ALTER TABLE `prouser`
  ADD PRIMARY KEY (`idprouser`),
  ADD UNIQUE KEY `prouserlicence_UNIQUE` (`prouserlicence`),
  ADD KEY `fk_prouser_admin1_idx` (`admin_idadmin`),
  ADD KEY `fk_prouser_users1_idx` (`users_id`);

--
-- A tábla indexei `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`idstocks`),
  ADD UNIQUE KEY `stockname_UNIQUE` (`stockname`),
  ADD KEY `fk_stocks_users1_idx` (`users_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Mobl` (`phone_number`);

--
-- A tábla indexei `workplace`
--
ALTER TABLE `workplace`
  ADD PRIMARY KEY (`idworkplace`),
  ADD KEY `fk_workplace_users1_idx` (`users_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `crypto`
--
ALTER TABLE `crypto`
  MODIFY `idcrypto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `house`
--
ALTER TABLE `house`
  MODIFY `idhouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT a táblához `houserent`
--
ALTER TABLE `houserent`
  MODIFY `idhouserent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `metals`
--
ALTER TABLE `metals`
  MODIFY `idmetals` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `prouser`
--
ALTER TABLE `prouser`
  MODIFY `idprouser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `stocks`
--
ALTER TABLE `stocks`
  MODIFY `idstocks` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT a táblához `workplace`
--
ALTER TABLE `workplace`
  MODIFY `idworkplace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `crypto`
--
ALTER TABLE `crypto`
  ADD CONSTRAINT `fk_crypto_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `fk_expense_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `fk_house_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `houserent`
--
ALTER TABLE `houserent`
  ADD CONSTRAINT `fk_houserent_house1` FOREIGN KEY (`house_idhouse`) REFERENCES `house` (`idhouse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `metals`
--
ALTER TABLE `metals`
  ADD CONSTRAINT `fk_metals_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `prouser`
--
ALTER TABLE `prouser`
  ADD CONSTRAINT `fk_prouser_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prouser_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `fk_stocks_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `workplace`
--
ALTER TABLE `workplace`
  ADD CONSTRAINT `fk_workplace_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
