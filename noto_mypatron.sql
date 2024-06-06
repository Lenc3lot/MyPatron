-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-noto.alwaysdata.net
-- Generation Time: Jun 06, 2024 at 07:35 AM
-- Server version: 10.6.16-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noto_mypatron`
--

-- --------------------------------------------------------

--
-- Table structure for table `marque`
--

CREATE TABLE `marque` (
  `idMarque` int(11) NOT NULL,
  `libelMarque` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `marque`
--

INSERT INTO `marque` (`idMarque`, `libelMarque`) VALUES
(1, 'Super Bison'),
(2, 'Bélène'),
(3, 'Make It Yours'),
(4, 'Vestiaire Eponyme'),
(5, 'You made my day Patterns'),
(6, 'Atelier de Guillemette'),
(7, 'Fitiyoo'),
(8, 'Popeline & Linon'),
(9, 'Studio Schnittreif');

-- --------------------------------------------------------

--
-- Table structure for table `patron`
--

CREATE TABLE `patron` (
  `idPatron` int(11) NOT NULL,
  `pLibel` varchar(50) DEFAULT NULL,
  `pDesc` varchar(50) DEFAULT NULL,
  `pCheminPhoto` mediumtext DEFAULT NULL,
  `idMarque` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idTypePatron` int(11) NOT NULL,
  `pLien` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`idPatron`, `pLibel`, `pDesc`, `pCheminPhoto`, `idMarque`, `idUtilisateur`, `idTypePatron`, `pLien`) VALUES
(20, 'Blouse Bardot', '', './uploads/users/user5/bardot_pdf.webp', 1, 5, 12, 'https://www.super-bison.com/products/patron-blouse'),
(21, 'Robe Poème', '', './uploads/users/user5/poeme_pdf.webp', 1, 5, 2, 'https://www.super-bison.com/products/patron-robe-p'),
(22, 'Bermuda Diego', 'Homme', './uploads/users/user5/diego_PDF_e823a12c-96c4-4040-bf24-18351acb680b.webp', 1, 5, 13, 'https://www.super-bison.com/products/patron-bermud'),
(23, 'Kit Beauté Zen', '', './uploads/users/user5/kitbeautezen.webp', 1, 5, 16, 'https://www.super-bison.com/products/patron-gratui'),
(24, 'Maillot de Bain Nido', '', './uploads/users/user5/74ec6a_e010989cbaa840b78dde5e1c8a079e22~mv2.webp', 2, 5, 9, 'https://www.belene-paris.com/product-page/pdf-du-m');

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE `pdf` (
  `idPDF` int(11) NOT NULL,
  `relativePath` varchar(50) DEFAULT NULL,
  `idPatron` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `pdf`
--

INSERT INTO `pdf` (`idPDF`, `relativePath`, `idPatron`) VALUES
(19, './uploads/users/user5/notice_bardot.pdf', 20),
(20, './uploads/users/user5/patron_A0_Bardot.pdf', 20),
(21, './uploads/users/user5/patron_A4_Bardot.pdf', 20),
(22, './uploads/users/user5/patron_Projection_Bardot.pdf', 20),
(23, './uploads/users/user5/Notice  POEME.pdf', 21),
(24, './uploads/users/user5/patron_Projection_poeme.pdf', 21),
(25, './uploads/users/user5/PatronA0_poeme.pdf', 21),
(26, './uploads/users/user5/PatronA4_Poeme.pdf', 21),
(27, './uploads/users/user5/notice_diego.pdf', 22),
(28, './uploads/users/user5/PatronA0_Diego.pdf', 22),
(29, './uploads/users/user5/patronA4_diego.pdf', 22),
(30, './uploads/users/user5/bienvenue_zen.pdf', 23),
(31, './uploads/users/user5/Notice_zen.pdf', 23),
(32, './uploads/users/user5/PatronA0_zen.pdf', 23),
(33, './uploads/users/user5/PatronA4_zen.pdf', 23),
(34, './uploads/users/user5/livret_a4_belene_nido.pdf', 24),
(35, './uploads/users/user5/maillot-NIDO-BELENE.pdf', 24),
(36, './uploads/users/user5/new-nido-1p-belene.pdf', 24),
(37, './uploads/users/user5/new-nido-bikini-belene.pdf', 24);

-- --------------------------------------------------------

--
-- Table structure for table `posséder`
--

CREATE TABLE `posséder` (
  `idPatron` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `posséder`
--

INSERT INTO `posséder` (`idPatron`, `idTag`) VALUES
(20, 5),
(21, 4),
(21, 5),
(22, 4),
(24, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `idTag` int(11) NOT NULL,
  `tLibel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`idTag`, `tLibel`) VALUES
(1, 'Court'),
(2, 'Long'),
(3, 'De soirée'),
(4, 'Été'),
(5, 'Printemps'),
(6, 'Hiver'),
(7, 'Automne'),
(8, 'Habillé'),
(9, 'Détente');

-- --------------------------------------------------------

--
-- Table structure for table `typepatron`
--

CREATE TABLE `typepatron` (
  `idTypePatron` int(11) NOT NULL,
  `tpLibel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `typepatron`
--

INSERT INTO `typepatron` (`idTypePatron`, `tpLibel`) VALUES
(1, 'T-Shirt'),
(2, 'Robe'),
(3, 'Jupe'),
(4, 'Pantalon'),
(5, 'Crop-Top'),
(6, 'Culotte'),
(7, 'Veste'),
(8, 'Débardeur'),
(9, 'Maillot de bain'),
(10, 'Soutien-gorge'),
(11, 'Chemise'),
(12, 'Blouse'),
(13, 'Short'),
(14, 'Manteau'),
(15, 'Sac'),
(16, 'Accessoire'),
(17, 'Body'),
(18, 'Combinaison'),
(19, 'Corset'),
(20, 'Legging');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `uNom` varchar(50) DEFAULT NULL,
  `uPNom` varchar(50) DEFAULT NULL,
  `uLogin` varchar(50) DEFAULT NULL,
  `uMdp` varchar(255) DEFAULT NULL,
  `uMail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `uNom`, `uPNom`, `uLogin`, `uMdp`, `uMail`) VALUES
(0, 'R0X', 'R0X', 'R0X_Admin', '3d9390a6a9b8b70544c89eae33400b0ccf95b08503a25bf3069ba5f6d0625183', 'admin@mail.fr'),
(3, 'noto', 'baptiste', 'bnoto', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'noto.baptiste2910@gmail.com'),
(5, 'guillet', 'caroline', 'the fantastic wood', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'thefantastic.wood@gmail.com'),
(9, 'compte', 'exa', 'cptexam', '569a783a31f6adae41b42a04d4792198bb8ded1e4bb4f5cf313357a2c6313b31', 'cptexam@mail.fr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`idMarque`);

--
-- Indexes for table `patron`
--
ALTER TABLE `patron`
  ADD PRIMARY KEY (`idPatron`),
  ADD KEY `idMarque` (`idMarque`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idTypePatron` (`idTypePatron`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`idPDF`),
  ADD KEY `idPatron` (`idPatron`);

--
-- Indexes for table `posséder`
--
ALTER TABLE `posséder`
  ADD PRIMARY KEY (`idPatron`,`idTag`),
  ADD KEY `idTag` (`idTag`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`idTag`);

--
-- Indexes for table `typepatron`
--
ALTER TABLE `typepatron`
  ADD PRIMARY KEY (`idTypePatron`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marque`
--
ALTER TABLE `marque`
  MODIFY `idMarque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patron`
--
ALTER TABLE `patron`
  MODIFY `idPatron` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `idPDF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `idTag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `typepatron`
--
ALTER TABLE `typepatron`
  MODIFY `idTypePatron` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patron`
--
ALTER TABLE `patron`
  ADD CONSTRAINT `patron_ibfk_1` FOREIGN KEY (`idMarque`) REFERENCES `marque` (`idMarque`),
  ADD CONSTRAINT `patron_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `patron_ibfk_3` FOREIGN KEY (`idTypePatron`) REFERENCES `typepatron` (`idTypePatron`);

--
-- Constraints for table `pdf`
--
ALTER TABLE `pdf`
  ADD CONSTRAINT `pdf_ibfk_1` FOREIGN KEY (`idPatron`) REFERENCES `patron` (`idPatron`);

--
-- Constraints for table `posséder`
--
ALTER TABLE `posséder`
  ADD CONSTRAINT `posséder_ibfk_1` FOREIGN KEY (`idPatron`) REFERENCES `patron` (`idPatron`),
  ADD CONSTRAINT `posséder_ibfk_2` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
