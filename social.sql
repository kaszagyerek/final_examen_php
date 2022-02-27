-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Feb 27. 17:58
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

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `email`, `password`) VALUES
(1, 'ksandor', 'kasza@kasza.com', 'admin'),
(15, 'kalapacs', 'kadda@ddsfs', 'almafa'),
(16, 'kalacskepu', 'kalacs@kalacs', 'almafa'),
(17, 'krumpli', 'krumpli@krumpli', 'almafa');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `crypto`
--

CREATE TABLE `crypto` (
  `idcrypto` int(11) NOT NULL,
  `cryptosymbol` varchar(8) DEFAULT NULL,
  `lastprice` decimal(10,4) DEFAULT NULL,
  `cryptoimg` varchar(145) DEFAULT NULL,
  `marketCap` decimal(18,2) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `cryptoname` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `crypto`
--

INSERT INTO `crypto` (`idcrypto`, `cryptosymbol`, `lastprice`, `cryptoimg`, `marketCap`, `rank`, `cryptoname`, `color`) VALUES
(51, 'BTC', '39070.9626', 'https://cdn.coinranking.com/bOabBYkcX/bitcoin_btc.svg', '741163932216.00', 1, 'Bitcoin', '#f7931A'),
(52, 'ETH', '2771.2224', 'https://cdn.coinranking.com/rk4RKHOuW/eth.svg', '330824508297.00', 2, 'Ethereum', '#3C3C3D'),
(53, 'USDT', '1.0028', 'https://cdn.coinranking.com/mgHqwlCLj/usdt.svg', '79772810180.00', 3, 'Tether USD', '#22a079'),
(54, 'BNB', '372.4025', 'https://cdn.coinranking.com/B1N19L_dZ/bnb.svg', '55361944860.00', 4, 'Binance Coin', '#e8b342'),
(55, 'USDC', '1.0010', 'https://cdn.coinranking.com/jkDf8sQbY/usdc.svg', '47898558897.00', 5, 'USDC', '#7894b4'),
(56, 'HEX', '0.1458', 'https://cdn.coinranking.com/iseN4Am58/hex-vector.svg', '37676078094.00', 6, 'HEX', '#ffcd00'),
(57, 'XRP', '0.7454', 'https://cdn.coinranking.com/B1oPuTyfX/xrp.svg', '32850036976.00', 7, 'XRP', '#000000'),
(58, 'LUNA', '76.0871', 'https://cdn.coinranking.com/F-PJdF8Um/LUNA.svg', '28764917228.00', 8, 'Terra', ''),
(59, 'SOL', '88.8141', 'https://cdn.coinranking.com/yvUG4Qex5/solana.svg', '28426122528.00', 9, 'Solana', ''),
(60, 'ADA', '0.8899', 'https://cdn.coinranking.com/ryY28nXhW/ada.svg', '27686048049.00', 10, 'Cardano', '#3cc8c8'),
(61, 'DOT', '18.2371', 'https://cdn.coinranking.com/RsljYqnbu/polkadot.svg', '19987447832.00', 11, 'Polkadot', '#d64cA8'),
(62, 'BUSD', '1.0019', 'https://cdn.coinranking.com/6SJHRfClq/busd.svg', '18171984500.00', 12, 'Binance USD', '#f0b90b'),
(63, 'AVAX', '78.4416', 'https://cdn.coinranking.com/S0C6Cw2-w/avax-avalanche.png', '17251960322.00', 13, 'Avalanche', '#e84242'),
(64, 'DOGE', '0.1269', 'https://cdn.coinranking.com/H1arXIuOZ/doge.svg', '16835065042.00', 14, 'Dogecoin', '#c2a633'),
(65, 'SHIB', '0.0000', 'https://cdn.coinranking.com/D69LfI-tm/shib.png', '14426629462.00', 15, 'SHIBA INU', '#fda32b'),
(66, 'BIT', '1.2280', 'https://cdn.coinranking.com/0ClFW1IpO/bitdao.png', '12279949409.00', 16, 'BitDAO ', '#000000'),
(67, 'UST', '1.0033', 'https://cdn.coinranking.com/mtb0IvtcM/terrausd.png', '11310721128.00', 17, 'TerraUSD', '#0e3ca5'),
(68, 'MATIC', '1.4978', 'https://cdn.coinranking.com/HAf8rW3kx/polygon-matic-rebrand.png', '11289632878.00', 18, 'Polygon', '#8247e5'),
(69, 'WBTC', '39069.8815', 'https://cdn.coinranking.com/o3-8cvCHu/wbtc[1].svg', '10262185549.00', 19, 'Wrapped BTC', ''),
(70, 'DAI', '1.0017', 'https://cdn.coinranking.com/mAZ_7LwOE/mutli-collateral-dai.svg', '9216717883.00', 20, 'Dai', ''),
(71, 'ATOM', '28.6454', 'https://cdn.coinranking.com/HJzHboruM/atom.svg', '8283746707.00', 21, 'Cosmos', '#5064fb'),
(72, 'CRO', '0.4127', 'https://cdn.coinranking.com/2o91jm73M/cro.svg', '7612064794.00', 22, 'Crypto.com Chain', '#01275d'),
(73, 'LTC', '107.7412', 'https://cdn.coinranking.com/BUvPxmc9o/ltcnew.svg', '7512380857.00', 23, 'Litecoin', '#345d9d'),
(74, 'UNI', '10.0895', 'https://cdn.coinranking.com/1heSvUgtl/uniswap-v2.svg?size=48x48', '7033983909.00', 24, 'Uniswap', '#ff007a'),
(75, 'LINK', '14.3415', 'https://cdn.coinranking.com/9NOP9tOem/chainlink.svg', '6697605686.00', 25, 'Chainlink', '#4680b0'),
(76, 'TRX', '0.0599', 'https://cdn.coinranking.com/behejNqQs/trx.svg', '6100617518.00', 26, 'TRON', '#eb0029'),
(77, 'BCH', '314.4690', 'https://cdn.coinranking.com/By8ziihX7/bch.svg', '5973116713.00', 27, 'Bitcoin Cash', '#8dc451'),
(78, 'FTT', '43.3188', 'https://cdn.coinranking.com/WyBm4_EzM/ftx-exchange.svg', '5970143582.00', 28, 'FTX Token', '#77d9ed'),
(79, 'LEO', '5.9587', 'https://cdn.coinranking.com/12EKqY08r/leo.svg', '5875102812.00', 29, 'LEO', '#063f35'),
(80, 'MANA', '2.6669', 'https://cdn.coinranking.com/ph_svUzXs/decentraland(1).svg', '5850708645.00', 30, 'Decentraland', '#f47e33'),
(81, 'ALGO', '0.8293', 'https://cdn.coinranking.com/lzbmCkUGB/algo.svg', '5489213937.00', 31, 'Algorand', ''),
(82, 'STETH', '2723.2143', 'https://cdn.coinranking.com/UJ-dQdgYY/8085.png', '5405490178.00', 32, 'Lido Staked Ether', '#41c0f5'),
(83, 'NEAR', '8.8826', 'https://cdn.coinranking.com/Cth83dCnl/near.png', '5399225413.00', 33, 'NEAR Protocol', '#000000'),
(84, 'WEMIX', '5.2793', 'https://cdn.coinranking.com/1N84MQsoO/7548.png', '5279261925.00', 34, 'WEMIX TOKEN', '#9bdc70'),
(85, 'OKB', '17.3713', 'https://cdn.coinranking.com/BJcjC5rCQ/Okex.svg', '4563083241.00', 35, 'OKB', '#2d60e0'),
(86, 'SENSO', '0.6936', 'https://cdn.coinranking.com/TQFMWwtyn/senso.svg', '4102939994.00', 36, 'SENSO', '#000000'),
(87, 'HBAR', '0.2183', 'https://cdn.coinranking.com/dSCnSLilQ/hedera.svg', '4067058438.00', 37, 'Hedera HashGraph', '#000000'),
(88, 'XLM', '0.1893', 'https://cdn.coinranking.com/78CxK1xsp/Stellar_symbol_black_RGB.svg', '3824524409.00', 38, 'Stellar', '#000000'),
(89, 'ICP', '18.3152', 'https://cdn.coinranking.com/1uJ_RVrmC/dfinity-icp.png', '3800693162.00', 39, 'Internet Computer (DFINITY)', '#00042b'),
(90, 'BLOK', '0.0175', 'https://cdn.coinranking.com/P6P1BdGJ9/11206.png', '3496438705.00', 40, 'Bloktopia', '#000000'),
(91, 'ETC', '28.5961', 'https://cdn.coinranking.com/rJfyor__W/etc.svg', '3326102042.00', 41, 'Ethereum Classic', '#699070'),
(92, 'SAND', '3.0142', 'https://cdn.coinranking.com/kd_vwOcnI/sandbox.png', '3282270477.00', 42, 'The Sandbox', '#00adef'),
(93, 'VET', '0.0476', 'https://cdn.coinranking.com/B1_TDu9Dm/VEN.svg', '3179118079.00', 43, 'VeChain', '#4bc0fa'),
(94, 'CETH', '55.5931', 'https://cdn.coinranking.com/ZTQUl5jrQ/CETH2.svg', '3127880857.00', 44, 'Compound Ether', ''),
(95, 'AXS', '49.7384', 'https://cdn.coinranking.com/L3gWtlUJB/axie-infinity.png', '3029440561.00', 45, 'Axie Infinity', '#f5a616'),
(96, 'FTM', '1.6698', 'https://cdn.coinranking.com/Uh-AYdcnU/fantom.png', '2976398750.00', 46, 'Fantom', '#1969ff'),
(97, 'KLAY', '1.1962', 'https://cdn.coinranking.com/cY-BSmXaS/klay.svg', '2928437221.00', 47, 'Klaytn', '#4f473b'),
(98, 'THETA', '2.9173', 'https://cdn.coinranking.com/HJHg2k9Lf/theta.svg', '2917139515.00', 48, 'Theta Token', '#1b1f2a'),
(99, 'XTZ', '3.3167', 'https://cdn.coinranking.com/HkLUdilQ7/xtz.svg', '2911868966.00', 49, 'Tezos', '#2c7df7'),
(100, 'EGLD', '140.5509', 'https://cdn.coinranking.com/X62ruAuZQ/Elrond.svg', '2862567477.00', 50, 'Elrond', '#000000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `expense`
--

CREATE TABLE `expense` (
  `idexpense` int(11) NOT NULL,
  `broker` decimal(8,2) DEFAULT NULL,
  `brokername` varchar(45) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `hrenovation` decimal(8,2) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `expensedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `expense`
--

INSERT INTO `expense` (`idexpense`, `broker`, `brokername`, `tax`, `hrenovation`, `users_id`, `expensedate`) VALUES
(13, '250.00', 'Lapos Dia', '450.00', '350.00', 27, '2022-02-27 18:56:05');

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
  `users_id` int(11) NOT NULL,
  `housedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `house`
--

INSERT INTO `house` (`idhouse`, `addres`, `totalhprice`, `ownPerson`, `ownMobil`, `users_id`, `housedate`) VALUES
(71, 'alma', 25000, 'Kis Geza', '075252525', 27, '2022-02-27 18:55:38');

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

-- --------------------------------------------------------

--
-- A nézet helyettes szerkezete `kriptonyereseg`
-- (Lásd alább az aktuális nézetet)
--
CREATE TABLE `kriptonyereseg` (
`kvagy` decimal(37,8)
,`ktej` decimal(28,8)
,`idpersonalcrypto` int(11)
,`lastprice` decimal(10,4)
,`dbkrpto` decimal(18,4)
,`oldcrprice` decimal(18,4)
,`users_id` int(11)
);

-- --------------------------------------------------------

--
-- A nézet helyettes szerkezete `kriptoszazalek`
-- (Lásd alább az aktuális nézetet)
--
CREATE TABLE `kriptoszazalek` (
`kszaz` decimal(21,8)
,`idpersonalcrypto` int(11)
,`dbkrpto` decimal(18,4)
,`oldcrprice` decimal(18,4)
,`users_id` int(11)
);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `metals`
--

CREATE TABLE `metals` (
  `idmetals` int(11) NOT NULL,
  `metalsymbol` varchar(8) DEFAULT NULL,
  `newPrice` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `metals`
--

INSERT INTO `metals` (`idmetals`, `metalsymbol`, `newPrice`) VALUES
(211, 'AED', '3.67'),
(212, 'AFN', '91.07'),
(213, 'ALL', '107.68'),
(214, 'AMD', '477.96'),
(215, 'ANG', '1.79'),
(216, 'AOA', '496.60'),
(217, 'ARS', '106.58'),
(218, 'AUD', '1.38'),
(219, 'AWG', '1.80'),
(220, 'AZN', '1.70'),
(221, 'BAM', '1.74'),
(222, 'BBD', '2.00'),
(223, 'BDT', '85.34'),
(224, 'BGN', '1.74'),
(225, 'BHD', '0.37'),
(226, 'BIF', '1984.41'),
(227, 'BMD', '1.00'),
(228, 'BND', '1.34'),
(229, 'BOB', '6.82'),
(230, 'BRL', '5.16'),
(231, 'BSD', '0.99'),
(232, 'BTN', '74.72'),
(233, 'BWP', '11.52'),
(234, 'BYN', '2.74'),
(235, 'BYR', '19600.00'),
(236, 'BZD', '2.00'),
(237, 'CAD', '1.27'),
(238, 'CDF', '2014.00'),
(239, 'CHF', '0.93'),
(240, 'CLF', '0.03'),
(241, 'CLP', '803.89'),
(242, 'CNY', '6.32'),
(243, 'COP', '3898.12'),
(244, 'CRC', '636.46'),
(245, 'CUC', '1.00'),
(246, 'CVE', '97.86'),
(247, 'CZK', '21.94'),
(248, 'DJF', '176.71'),
(249, 'DKK', '6.60'),
(250, 'DOP', '55.53'),
(251, 'DZD', '141.18'),
(252, 'EGP', '15.63'),
(253, 'ETB', '50.88'),
(254, 'EUR', '0.89'),
(255, 'FJD', '2.14'),
(256, 'FKP', '0.73'),
(257, 'GBP', '0.75'),
(258, 'GHS', '6.72'),
(259, 'GIP', '0.73'),
(260, 'GMD', '53.30'),
(261, 'GNF', '8912.94'),
(262, 'GTQ', '7.66'),
(263, 'GYD', '207.68'),
(264, 'HKD', '7.81'),
(265, 'HNL', '24.44'),
(266, 'HRK', '6.72'),
(267, 'HTG', '103.43'),
(268, 'HUF', '323.91'),
(269, 'IDR', '14334.25'),
(270, 'ILS', '3.23'),
(271, 'INR', '75.08'),
(272, 'IQD', '1449.25'),
(273, 'ISK', '125.26'),
(274, 'JMD', '154.01'),
(275, 'JOD', '0.71'),
(276, 'JPY', '115.55'),
(277, 'KES', '113.01'),
(278, 'KGS', '94.76'),
(279, 'KHR', '4035.06'),
(280, 'KMF', '438.38'),
(281, 'KRW', '1197.83'),
(282, 'KWD', '0.30'),
(283, 'KYD', '0.83'),
(284, 'KZT', '456.73'),
(285, 'LAK', '11368.21'),
(286, 'LBP', '1500.89'),
(287, 'LKR', '201.01'),
(288, 'LRD', '154.20'),
(289, 'LSL', '15.20'),
(290, 'LYD', '4.56'),
(291, 'MAD', '9.45'),
(292, 'MDL', '18.17'),
(293, 'MGA', '3959.14'),
(294, 'MKD', '54.68'),
(295, 'MMK', '1765.06'),
(296, 'MNT', '2858.83'),
(297, 'MOP', '7.98'),
(298, 'MRO', '357.00'),
(299, 'MUR', '44.00'),
(300, 'MVR', '15.45'),
(301, 'MWK', '797.73'),
(302, 'MXN', '20.35'),
(303, 'MYR', '4.20'),
(304, 'MZN', '63.83'),
(305, 'NAD', '15.20'),
(306, 'NGN', '415.56'),
(307, 'NIO', '35.19'),
(308, 'NOK', '8.83'),
(309, 'NPR', '119.56'),
(310, 'NZD', '1.48'),
(311, 'OMR', '0.39'),
(312, 'PAB', '0.99'),
(313, 'PEN', '3.77'),
(314, 'PGK', '3.52'),
(315, 'PHP', '51.32'),
(316, 'PKR', '176.24'),
(317, 'PLN', '4.11'),
(318, 'PYG', '6888.53'),
(319, 'QAR', '3.64'),
(320, 'RON', '4.39'),
(321, 'RSD', '104.36'),
(322, 'RUB', '83.86'),
(323, 'RWF', '1006.18'),
(324, 'SAR', '3.75'),
(325, 'SBD', '8.08'),
(326, 'SCR', '14.40'),
(327, 'SEK', '9.39'),
(328, 'SHP', '1.38'),
(329, 'SLL', '11700.00'),
(330, 'SOS', '586.00'),
(331, 'SRD', '20.52'),
(332, 'SSP', '130.26'),
(333, 'STD', '20697.98'),
(334, 'SVC', '8.69'),
(335, 'SZL', '15.16'),
(336, 'THB', '32.44'),
(337, 'TJS', '11.22'),
(338, 'TMT', '3.51'),
(339, 'TND', '2.89'),
(340, 'TOP', '2.28'),
(341, 'TRY', '13.82'),
(342, 'TTD', '6.75'),
(343, 'TWD', '27.98'),
(344, 'TZS', '2297.96'),
(345, 'UAH', '29.83'),
(346, 'UGX', '3520.86'),
(347, 'UYU', '41.97'),
(348, 'UZS', '10760.48'),
(349, 'VES', '4.44'),
(350, 'VND', '22830.00'),
(351, 'VUV', '113.67'),
(352, 'WST', '2.61'),
(353, 'XAF', '582.14'),
(354, 'XAG', '0.04'),
(355, 'XAU', '0.00'),
(356, 'XCD', '2.70'),
(357, 'XDR', '0.71'),
(358, 'XOF', '582.14'),
(359, 'XPD', '0.00'),
(360, 'XPF', '106.45'),
(361, 'XPT', '0.00'),
(362, 'YER', '250.25'),
(363, 'ZAR', '15.15'),
(364, 'ZMW', '17.59'),
(365, 'JEP', '0.73'),
(366, 'GGP', '0.73'),
(367, 'IMP', '0.73'),
(368, 'CNH', '6.31'),
(369, 'ZWL', '322.00'),
(370, 'SGD', '1.35'),
(371, 'USD', '1.00'),
(372, 'BTC', '0.00'),
(373, 'BCH', '0.00'),
(374, 'ETH', '0.00'),
(375, 'LTC', '0.01'),
(376, 'LINK', '0.07'),
(377, 'XRP', '1.34'),
(378, 'XLM', '5.28'),
(379, 'UNI', '0.10'),
(380, 'ADA', '1.12'),
(381, 'ERN', '15.00'),
(382, 'GEL', '3.17'),
(383, 'LTL', '2.95'),
(384, 'LVL', '0.60'),
(385, 'VEF', '213830222338.07'),
(386, 'ZMK', '9001.20'),
(387, 'XRH', '0.00'),
(388, 'RUTH', '0.00'),
(389, 'XCU', '3.57'),
(390, 'ALU', '9.52'),
(391, 'NI', '1.32'),
(392, 'ZNC', '8.02'),
(393, 'TIN', '0.82'),
(394, 'IRD', '0.00'),
(395, 'LEAD', '13.63'),
(396, 'IRON', '224.89'),
(397, 'LBXAUAM', '0.00'),
(398, 'LBXAUPM', '0.00'),
(399, 'LBXAG', '0.04'),
(400, 'LBXPTAM', '0.00'),
(401, 'LBXPTPM', '0.00'),
(402, 'LBXPDAM', '0.00'),
(403, 'LBXPDPM', '0.00'),
(404, 'LME-ALU', '9.58'),
(405, 'LME-XCU', '3.24'),
(406, 'LME-ZNC', '8.83'),
(407, 'LME-NI', '1.30'),
(408, 'LME-LEAD', '13.63'),
(409, 'LME-TIN', '0.71'),
(410, 'URANIUM', '0.02'),
(411, 'STEEL-SC', '63.73'),
(412, 'STEEL-RE', '43.51'),
(413, 'STEEL-HR', '40.31'),
(414, 'BRONZE', '5.40'),
(415, 'MG', '4.05'),
(416, 'OSMIUM', '0.00'),
(417, 'RHENIUM', '0.02'),
(418, 'INDIUM', '0.07'),
(419, 'MO', '0.77'),
(420, 'TUNGSTEN', '96.69');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personalcrypto`
--

CREATE TABLE `personalcrypto` (
  `idpersonalcrypto` int(11) NOT NULL,
  `dbkrpto` decimal(18,4) DEFAULT NULL,
  `oldcrprice` decimal(18,4) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `crypto_idcrypto` int(11) DEFAULT NULL,
  `cryptodate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `personalcrypto`
--

INSERT INTO `personalcrypto` (`idpersonalcrypto`, `dbkrpto`, `oldcrprice`, `users_id`, `crypto_idcrypto`, `cryptodate`) VALUES
(24, '50.0000', '100.0000', 27, 51, '2022-02-27 18:55:05'),
(25, '60.0000', '200.0000', 27, 52, '2022-02-27 18:55:13'),
(26, '50.0000', '4000.0000', 27, 57, '2022-02-27 18:55:20');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personalmetal`
--

CREATE TABLE `personalmetal` (
  `idpersonalmetal` int(11) NOT NULL,
  `dbmetal` decimal(18,2) DEFAULT NULL,
  `oldprice` decimal(18,2) DEFAULT NULL,
  `metaldate` datetime DEFAULT NULL,
  `metals_idmetals` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `prouser`
--

CREATE TABLE `prouser` (
  `idprouser` int(11) NOT NULL,
  `prouserlicence` tinyint(4) DEFAULT NULL,
  `admin_idadmin` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `stocks`
--

CREATE TABLE `stocks` (
  `idstocks` int(11) NOT NULL,
  `stockname` varchar(45) DEFAULT NULL,
  `stocksymbol` varchar(10) DEFAULT NULL,
  `newPrice` decimal(10,2) DEFAULT NULL
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
(25, 'Sherlock', 'Bajnok', 'sherlock_bajnok', 'bajnok@sherlock.ro', '21232f297a57a5a743894a0e4a801fc3', '2021-12-02', 'r3.png', '07446544545'),
(27, 'Kasza', 'Sandor', 'kasza_sandor', 'kasza@kasza.com', '21232f297a57a5a743894a0e4a801fc3', '2021-12-06', 'r3.png', '0752944514'),
(36, 'Kis', 'Anna', 'kis_anna', 'anna@anna.com', '21232f297a57a5a743894a0e4a801fc3', '2021-12-23', 'r3.png', '07555445'),
(502, 'Palik', 'Paé', 'kis_paé', 'pal@pal.com', '5f0fa8b7a7397a3c1a5e746578bd3e59', '2022-02-19', 'r3.png', '0755055050');

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
  `position` varchar(45) DEFAULT NULL,
  `workdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `workplace`
--

INSERT INTO `workplace` (`idworkplace`, `workplacename`, `workplaceaddres`, `users_id`, `salary`, `position`, `workdate`) VALUES
(27, 'Sapientia', 'taploca', 27, '5000.00', 'boss', '2022-02-27 18:55:53');

-- --------------------------------------------------------

--
-- Nézet szerkezete `kriptonyereseg`
--
DROP TABLE IF EXISTS `kriptonyereseg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kriptonyereseg`  AS SELECT (`crypto`.`lastprice` - `personalcrypto`.`oldcrprice`) * `personalcrypto`.`dbkrpto` AS `kvagy`, `crypto`.`lastprice`* `personalcrypto`.`dbkrpto` AS `ktej`, `personalcrypto`.`idpersonalcrypto` AS `idpersonalcrypto`, `crypto`.`lastprice` AS `lastprice`, `personalcrypto`.`dbkrpto` AS `dbkrpto`, `personalcrypto`.`oldcrprice` AS `oldcrprice`, `personalcrypto`.`users_id` AS `users_id` FROM (`crypto` join `personalcrypto` on(`crypto`.`idcrypto` = `personalcrypto`.`crypto_idcrypto`)) ;

-- --------------------------------------------------------

--
-- Nézet szerkezete `kriptoszazalek`
--
DROP TABLE IF EXISTS `kriptoszazalek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kriptoszazalek`  AS SELECT `crypto`.`lastprice`/ `personalcrypto`.`oldcrprice` * 100 AS `kszaz`, `personalcrypto`.`idpersonalcrypto` AS `idpersonalcrypto`, `personalcrypto`.`dbkrpto` AS `dbkrpto`, `personalcrypto`.`oldcrprice` AS `oldcrprice`, `personalcrypto`.`users_id` AS `users_id` FROM (`crypto` join `personalcrypto` on(`crypto`.`idcrypto` = `personalcrypto`.`crypto_idcrypto`)) ;

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
  ADD PRIMARY KEY (`idcrypto`);

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
  ADD PRIMARY KEY (`idmetals`);

--
-- A tábla indexei `personalcrypto`
--
ALTER TABLE `personalcrypto`
  ADD PRIMARY KEY (`idpersonalcrypto`),
  ADD KEY `fk_personalcrypto_users1_idx` (`users_id`),
  ADD KEY `fk_personalcrypto_crypto1_idx` (`crypto_idcrypto`);

--
-- A tábla indexei `personalmetal`
--
ALTER TABLE `personalmetal`
  ADD PRIMARY KEY (`idpersonalmetal`),
  ADD KEY `fk_personalmetal_metals1_idx` (`metals_idmetals`),
  ADD KEY `fk_personalmetal_users1_idx` (`users_id`);

--
-- A tábla indexei `prouser`
--
ALTER TABLE `prouser`
  ADD PRIMARY KEY (`idprouser`),
  ADD KEY `fk_prouser_admin1_idx` (`admin_idadmin`),
  ADD KEY `fk_prouser_users1_idx` (`users_id`);

--
-- A tábla indexei `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`idstocks`);

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
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `crypto`
--
ALTER TABLE `crypto`
  MODIFY `idcrypto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT a táblához `expense`
--
ALTER TABLE `expense`
  MODIFY `idexpense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `house`
--
ALTER TABLE `house`
  MODIFY `idhouse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT a táblához `houserent`
--
ALTER TABLE `houserent`
  MODIFY `idhouserent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `metals`
--
ALTER TABLE `metals`
  MODIFY `idmetals` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT a táblához `personalcrypto`
--
ALTER TABLE `personalcrypto`
  MODIFY `idpersonalcrypto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT a táblához `personalmetal`
--
ALTER TABLE `personalmetal`
  MODIFY `idpersonalmetal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `prouser`
--
ALTER TABLE `prouser`
  MODIFY `idprouser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `stocks`
--
ALTER TABLE `stocks`
  MODIFY `idstocks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13400;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;

--
-- AUTO_INCREMENT a táblához `workplace`
--
ALTER TABLE `workplace`
  MODIFY `idworkplace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Megkötések a kiírt táblákhoz
--

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
-- Megkötések a táblához `personalcrypto`
--
ALTER TABLE `personalcrypto`
  ADD CONSTRAINT `fk_personalcrypto_crypto1` FOREIGN KEY (`crypto_idcrypto`) REFERENCES `crypto` (`idcrypto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personalcrypto_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `personalmetal`
--
ALTER TABLE `personalmetal`
  ADD CONSTRAINT `fk_personalmetal_metals1` FOREIGN KEY (`metals_idmetals`) REFERENCES `metals` (`idmetals`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personalmetal_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `prouser`
--
ALTER TABLE `prouser`
  ADD CONSTRAINT `fk_prouser_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prouser_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `workplace`
--
ALTER TABLE `workplace`
  ADD CONSTRAINT `fk_workplace_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
