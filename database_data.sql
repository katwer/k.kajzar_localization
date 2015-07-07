-- phpMyAdmin SQL Dump
-- version 4.0.10.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 07 Lip 2015, 19:07
-- Wersja serwera: 5.1.58-1~dotdeb.0-log
-- Wersja PHP: 5.2.17-0.dotdeb.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `katwer_localization`
--

--
-- Tabela Truncate przed wstawieniem `comment`
--

TRUNCATE TABLE `comment`;
--
-- Zrzut danych tabeli `comment`
--

INSERT INTO `comment` (`id`, `localization_id`, `text`, `email`, `created_time`) VALUES
(19, 57, 'lorem nie ipsum', 'ds@ps.com', '2015-07-07 14:59:24'),
(20, 57, 'some one else', 'www@malpa.pl', '2015-07-07 14:59:40'),
(25, 17, 'qwerqwerf', 'asd@asd.pl', '2015-07-07 15:08:11');

--
-- Tabela Truncate przed wstawieniem `localization`
--

TRUNCATE TABLE `localization`;
--
-- Zrzut danych tabeli `localization`
--

INSERT INTO `localization` (`id`, `name`, `description`, `address`, `email`, `date_from`, `date_to`, `lat`, `lng`) VALUES
(16, 'Wrocław', 'somewhere in Poland', 'Grunwaldzka 12, Wrocław, Poland', 'asd@asd.pl', '2015-07-11', '2015-07-12', 51.114902, 17.056297),
(17, 'Bydgoszcz', 'somewhere in Poland', 'Grunwaldzka 12, Bydgoszcz, Poland', 'asd@asd.pl', '2015-07-14', '2016-04-23', 53.127266, 17.985596),
(18, 'Kasprowicza', 'somewhere in Poland', 'Kasprowicza 4, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-25', '2015-12-25', 52.734264, 15.220877),
(19, 'Chopina', 'somewhere in Poland', 'Chopina 5, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-25', '2015-11-22', 52.731991, 15.220794),
(20, 'Kossaka', 'somewhere in Poland', 'Juliusza Kossaka, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-11', '2015-07-31', 52.736046, 15.218659),
(21, 'Norwida', 'somewhere in Poland', 'Norwida 12, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-11', '2015-07-30', 52.736145, 15.224371),
(22, 'Staszica', 'somewhere in Poland', 'Staszica 34, 66-400 Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-18', '2015-07-30', 52.740025, 15.216325),
(23, 'Berlin', 'small town', 'Berlin, Germany', 'asd@asd.pl', '2015-07-11', '2015-07-31', 52.520008, 13.404954),
(24, 'Estkowskiego', 'somewhere in Poland', 'Estkowskiego 5, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-25', '2015-09-25', 52.729897, 15.225396),
(25, 'Wisła', 'some place in Poland', 'Wisła, Poland', 'asdasdasd@asd.pl', '2015-07-12', '2015-07-26', 49.647320, 18.867739),
(26, 'Pałac', 'kurnik', 'Kurniki, Kraków, Poland', 'k.kajzar@gmail.com', '2015-07-17', '2015-07-31', 50.067268, 19.943705),
(27, 'Może morze?', 'bomba w Bałtyku', 'Kolobrzeg, Poland', 'asd@asd.pl', '2015-07-13', '2015-07-23', 54.175919, 15.583267),
(28, 'Może morze?', 'jeszcze raz', 'Mielno, Poland', 'asd@asd.pl', '2015-07-16', '2015-07-31', 54.259979, 16.062206),
(29, 'Może morze?', 'będzie błąd', 'Międzywodzie, Poland', 'asd@asd.pl', '2015-07-15', '2015-07-25', 54.004581, 14.696865),
(30, 'Liceum', 'najlepsze się rozumie :)', 'Puszkina 31, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-13', '2015-07-31', 52.751617, 15.234386),
(31, 'Gorzów', 'rondo', 'Kosynierów Gdyńskich, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-22', '2015-07-31', 52.736721, 15.229588),
(32, 'Gorzów', 'rondo', 'Kosynierów Gdyńskich, Gorzów Wielkopolski, Poland', 'asd@asd.pl', '2015-07-22', '2015-07-31', 52.736721, 15.229588),
(33, 'asdasd', 'sadgsadfg', 'Kosocicka, Kraków, Poland', 'asd@asd.pl', '2015-07-13', '2015-07-31', 50.003967, 20.005737),
(34, 'asd', 'asdasdasd', 'Aleksandry 23, 33-332 Kraków, Poland', 'k.kajzar@gmail.com', '2015-07-20', '2015-07-31', 50.010044, 20.018393),
(40, 'asd', 'asd', 'Bahamas (ASD), Andros Town, The Bahamas', 'asd@asd.pl', '2015-07-14', '2015-07-25', 24.698364, -77.795265),
(41, 'adfg', 'sdfg', 'sdfg, Saint George, UT 84770, USA', 'asd@asd.pl', '2015-07-13', '2015-07-24', 37.082150, -113.606537),
(42, 'df', 'asdf', 'Faizabad Junction, Railway Colony - Station Road, ', 'asd@asd.pl', '2015-07-13', '2015-08-01', 26.768751, 82.135658),
(43, 'df', 'asdf', 'Faizabad Junction, Railway Colony - Station Road, ', 'asd@asd.pl', '2015-07-13', '2015-08-01', 26.768751, 82.135658),
(44, 'df', 'asdf', 'Faizabad Junction, Railway Colony - Station Road, ', 'asd@asd.pl', '2015-07-13', '2015-08-01', 26.768751, 82.135658),
(45, 'i', 'i', 'Yeşilköy, Istanbul Ataturk Airport (IST), 34149 Ba', 'asd@asd.pl', '2015-07-14', '2015-07-31', 40.982990, 28.810444),
(46, 'rere', 'agrsdfhg', 'Tom River, Russia', 'asd@asd.pl', '2015-07-17', '2015-08-01', 55.447491, 86.003220),
(56, 'Jerzmanowskiego, Kraków', 'sdfsdkjb', 'Erazma Jerzmanowskiego, Kraków, Poland', 'asd@asd.pl', '2015-07-14', '2015-08-02', 50.015278, 20.012335),
(57, 'Gdynia', 'some place in 3city', 'plac Kaszubski 15, Gdynia, Poland', 'dodek@x.pl', '2015-07-31', '2015-08-01', 54.522442, 18.543501),
(58, 'sdf', 'sdfgsdfg', 'Shrirangapatna Railway Station, Srirangapatna, Kar', 'asd@asd.pl', '2015-07-22', '2015-07-25', 12.424810, 76.678223);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
