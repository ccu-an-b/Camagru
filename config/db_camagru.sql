-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 07 mai 2018 à 09:26
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_camagru`
--
CREATE DATABASE IF NOT EXISTS `db_camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_camagru`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_picture` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `like` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `id_user`, `img`, `date`, `like`, `comment`) VALUES
(1, 11, 'https://images.unsplash.com/photo-1485921198582-a55119c97421?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=c6d9cabdc7f046b490c67663caa3754e&auto=format&fit=crop&w=1000&q=80', '2018-05-02 09:39:44', 1, 0),
(2, 11, 'https://images.unsplash.com/photo-1501959915551-4e8d30928317?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=afc5d8f90598eafe4667e19d3d3db791&auto=format&fit=crop&w=934&q=80', '2018-05-07 09:39:44', 2, 0),
(3, 11, 'https://images.unsplash.com/photo-1503764654157-72d979d9af2f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=71cdddf5cc615224cf2c26614d20154d&auto=format&fit=crop&w=1953&q=80', '2018-05-04 09:39:44', 3, 0),
(4, 11, 'https://images.unsplash.com/photo-1485963631004-f2f00b1d6606?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a98ac47048f530b6d587279d52c13ab7&auto=format&fit=crop&w=1568&q=80', '2018-05-01 09:39:44', 0, 0),
(5, 11, 'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=c9443baefd581d4e532b6d4f1e7879be&auto=format&fit=crop&w=1950&q=80', '2018-04-27 09:39:44', 1, 0),
(6, 11, 'https://images.unsplash.com/photo-1455099229380-7b52707e356a?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=1c4ac0bc668b0ce5e9d8abd2010a5279&auto=format&fit=crop&w=1949&q=80', '2018-04-17 00:00:00', 0, 0),
(7, 11, 'https://images.unsplash.com/photo-1498588747262-0f2241707d13?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=46540f9be54e407cfc9741fd64789844&auto=format&fit=crop&w=1950&q=80', '2018-04-30 00:00:00', 0, 0),
(8, 13, 'https://images.unsplash.com/photo-1508495761350-6a8bf2a2128a?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=d6f5c6aef82385e442e5b1b6f439c733&auto=format&fit=crop&w=1950&q=80', '2018-05-03 00:00:00', 0, 0),
(9, 13, 'https://images.unsplash.com/photo-1506020757198-1a3adb04b6b5?ixlib=rb-0.3.5&s=5cd2bd15a9bae4df17f9fe9c477bb63e&auto=format&fit=crop&w=975&q=80', '2018-04-29 00:00:00', 0, 0),
(13, 13, 'https://images.unsplash.com/photo-1475688621402-4257c812d6db?ixlib=rb-0.3.5&s=a9c400651135a892430e71319622f264&auto=format&fit=crop&w=1567&q=80', '2018-05-07 00:00:00', 2, 0),
(14, 13, 'https://images.unsplash.com/photo-1509220676330-01891402eb14?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f5f704e5db35604f14c9c96534961343&auto=format&fit=crop&w=935&q=80', '2018-04-24 00:00:00', 1, 0),
(15, 13, 'https://images.unsplash.com/photo-1505335321107-bed35fdb8990?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=4dec4ee26fa84418e6f4b02d21ca08c1&auto=format&fit=crop&w=958&q=80', '2018-05-05 00:00:00', 1, 0),
(21, 2, 'https://images.unsplash.com/photo-1462899006636-339e08d1844e?ixlib=rb-0.3.5&s=75a97dec563d923be5f6cc55422a9165&auto=format&fit=crop&w=1950&q=80', '2018-05-07 15:04:18', 0, 0),
(22, 2, 'https://images.unsplash.com/photo-1467154243382-ebe2c7d14fef?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=b582caa6afd4a87876de663c78980def&auto=format&fit=crop&w=1906&q=80', '2018-05-01 00:00:00', 0, 0),
(23, 2, 'https://images.unsplash.com/photo-1498568584133-7b76cea38337?ixlib=rb-0.3.5&s=5d889690c62a2ff11a45812c7ee05f24&auto=format&fit=crop&w=1000&q=80', '2018-04-30 00:00:00', 1, 0),
(24, 2, 'https://images.unsplash.com/photo-1469614369149-4f0c1468c331?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3035db31d01b52535dbbd289c62e22c8&auto=format&fit=crop&w=1567&q=80', '2018-05-02 00:00:00', 0, 0),
(25, 2, 'https://images.unsplash.com/photo-1489949148730-b1c68cd128bf?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e1e549d474c13c8ce6857d03990857f9&auto=format&fit=crop&w=934&q=80', '2018-05-06 00:00:00', 0, 0),
(26, 2, 'https://images.unsplash.com/photo-1512685660451-f42f193bd24b?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=63b22312bdfd8dcbabffe07a495f7e10&auto=format&fit=crop&w=1000&q=80', '2018-04-26 00:00:00', 0, 0),
(33, 4, 'https://images.unsplash.com/photo-1518115717919-4c755c325f07?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=fca585b7b912acdc7375214ffe4faf84&auto=format&fit=crop&w=1567&q=80', '2018-05-01 00:00:00', 0, 0),
(34, 4, 'https://images.unsplash.com/photo-1500672860114-9e913f298978?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=18663cf942fc18c2d8e06c9d498e5f41&auto=format&fit=crop&w=1949&q=80', '2018-04-30 00:00:00', 0, 0),
(35, 4, 'https://images.unsplash.com/photo-1519530782816-ba0c305fbb0d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=59bc5229f1379f17f2c7a79c8550186d&auto=format&fit=crop&w=1950&q=80', '2018-05-06 00:00:00', 0, 0),
(36, 4, 'https://images.unsplash.com/photo-1503032685466-60d120903e9f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cc648c74ff824a4634541d53910ce53f&auto=format&fit=crop&w=1525&q=80', '2018-04-28 00:00:00', 0, 0),
(37, 4, 'https://images.unsplash.com/photo-1513682121497-80211f36a7d3?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=06ba98b35511c904aae494c3dca8cd1b&auto=format&fit=crop&w=934&q=80', '2018-05-05 00:00:00', 0, 0),
(38, 4, 'https://images.unsplash.com/photo-1489582558212-475fa5010897?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cc6e93a991d7f256e61ce38d9b1f2177&auto=format&fit=crop&w=1951&q=80', '2018-05-02 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sticker`
--

CREATE TABLE `sticker` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `admin` enum('0','1') DEFAULT NULL,
  `profile` varchar(255) NOT NULL DEFAULT './public/icons/profile.png',
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mail`, `pass`, `admin`, `profile`, `bio`) VALUES
(1, 'admin', 'ccu-an-b@student.42.fr', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a9186a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', '1', './public/icons/profile.png', NULL),
(2, 'architecture', 'architecture@beta.fr', '4ca303a3bf7ddf7be8652031ff027f351973a205cddafbffa580750f61bc93ce74b7bab6023b14904f72f5e92991db3181523c2306e621b3d8dd3fd691a93099b6ad59f2986b7f60acda8357bc7f67cae7daeb5693f8e971f9fa0ab976f3fa7e', '0', 'https://images.unsplash.com/photo-1484330427105-e9002a08eb66?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=563a810ae45476fee926404ebf8cedec&auto=format&fit=crop&w=1903&q=80', 'Tout est dans la perspective ...'),
(4, 'people', 'people@beta.fr', 'c9022680f888674e2b2274758755bfa07dea729b68d71cde5c521ed70ef261bfce8b108af83c629f875a6c654c5ab545ac1fcd57dcbf62cb82902eeb87936b572a87bc64043eeca4cf1907533f263ba2e2e5a1853ce2ebe0356296925e8a3100', '0', 'https://images.unsplash.com/photo-1444210971048-6130cf0c46cf?ixlib=rb-0.3.5&s=002832bfaedf1440835471a604f485c9&auto=format&fit=crop&w=1952&q=80', NULL),
(11, 'food', 'food@beta.fr', 'c1f026582fe6e8cb620d0c85a72fe421ddded756662a8ec00ed4c297ad10676b529926ed32c6c7fe21c3e1827f0eae94c9bbcedfb574296c27ac64fd6a448f2a0d0fff6db90ba6a1786eb18fa92b99f7745803b0f9775f77942af8b1875830dc', '0', 'https://images.unsplash.com/photo-1424847651672-bf20a4b0982b?ixlib=rb-0.3.5&s=e7091e38bef139c93cac9d8fd8d99606&auto=format&fit=crop&w=1950&q=80', 'À table !'),
(13, 'travel', 'travel@beta.fr', '0209442e115ad7bc79fd281d91423a86b619e3c711fe574b7cc198d2e3c461c47f6cd24e989f49c44bd9b41652af01aabe1aaaa10859f9a77e266940167f3866c8c759ac82d4551ab6f99580c4afd485dadff244137719edf5bf0f962fe8c02a', '0', 'https://images.unsplash.com/photo-1504609773096-104ff2c73ba4?ixlib=rb-0.3.5&s=509df440981436b4c96e5e2dd42b9977&auto=format&fit=crop&w=1950&q=80', 'Voyage Voyage !');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sticker`
--
ALTER TABLE `sticker`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `sticker`
--
ALTER TABLE `sticker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
