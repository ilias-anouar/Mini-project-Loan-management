-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 mars 2023 à 20:45
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `choise library`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `Id_book` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `publishing_date` year(4) NOT NULL,
  `date_of_purchase` date NOT NULL,
  `pages` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`Id_book`, `title`, `author`, `image`, `state`, `publishing_date`, `date_of_purchase`, `pages`, `type`) VALUES
(8, 'Things Fall Apart', 'Chinua Achebe', 'images/things-fall-apart.jpg', 'Good condition', 1958, '2023-03-03', 209, 'novel'),
(9, 'Fairy tales', 'Hans Christian Andersen', 'images/fairy-tales.jpg', 'Good condition', 0000, '2023-03-03', 784, 'Collection'),
(10, 'The Divine Comedy', 'Dante Alighieri', 'images/the-divine-comedy.jpg', 'New', 0000, '2023-03-03', 928, 'novel'),
(11, 'The Epic Of Gilgamesh', 'Unknown', 'images/the-epic-of-gilgamesh.jpg', 'Good condition', 0000, '2023-03-03', 160, 'novel'),
(12, 'The Book Of Job', 'Unknown', 'images/the-book-of-job.jpg', 'New', 0000, '2023-03-03', 176, 'novel'),
(13, 'One Thousand and One Nights', 'Unknown', 'images/one-thousand-and-one-nights.jpg', 'New', 0000, '2023-03-03', 288, 'novel'),
(14, 'Pride and Prejudice', 'Jane Austen', 'images/pride-and-prejudice.jpg', 'New', 0000, '2023-03-03', 226, 'novel'),
(15, 'Le Père Goriot', 'Honoré de Balzac', 'images/le-pere-goriot.jpg', 'Good condition', 0000, '2023-03-03', 443, 'novel'),
(16, 'Molloy, Malone Dies, The Unnamable, the trilogy', 'Samuel Beckett', 'images/molloy-malone-dies-the-unnamable.jpg', 'Good condition', 1952, '2023-03-03', 256, 'novel'),
(17, 'The Decameron', 'Giovanni Boccaccio', 'images/the-decameron.jpg', 'New', 0000, '2023-03-03', 1024, 'novel'),
(18, 'Ficciones', 'Jorge Luis Borges', 'images/ficciones.jpg', 'New', 1965, '2023-03-03', 224, 'novel'),
(19, 'Wuthering Heights', 'Emily Brontë', 'images/wuthering-heights.jpg', 'New', 0000, '2023-03-03', 342, 'novel'),
(20, 'The Stranger', 'Albert Camus', 'images/l-etranger.jpg', 'New', 1942, '2023-03-03', 185, 'novel)'),
(21, 'Poems', 'Paul Celan', 'images/poems-paul-celan.jpg', 'Good condition', 1952, '2023-03-03', 320, 'novel'),
(22, 'Journey to the End of the Night', 'Louis-Ferdinand Céline', 'images/voyage-au-bout-de-la-nuit.jpg', 'Good condition', 1932, '2023-03-03', 505, 'novel'),
(23, 'Don Quijote De La Mancha', 'Miguel de Cervantes', 'images/don-quijote-de-la-mancha.jpg', 'New', 0000, '2023-03-03', 1056, 'novel'),
(24, 'The Canterbury Tales', 'Geoffrey Chaucer', 'images/the-canterbury-tales.jpg', 'Acceptable', 0000, '2023-03-03', 544, 'novel'),
(25, 'Stories', 'Anton Chekhov', 'images/stories-of-anton-chekhov.jpg', 'Good condition', 0000, '2023-03-03', 194, 'novel'),
(26, 'Nostromo', 'Joseph Conrad', 'images/nostromo.jpg', 'New', 1904, '2023-03-03', 320, 'novel'),
(27, 'Great Expectations', 'Charles Dickens', 'images/great-expectations.jpg', 'New', 0000, '2023-03-03', 194, 'novel'),
(28, 'Jacques the Fatalist', 'Denis Diderot', 'images/jacques-the-fatalist.jpg', 'Good condition', 0000, '2023-03-03', 596, 'novel'),
(29, 'Berlin Alexanderplatz', 'Alfred Döblin', 'images/berlin-alexanderplatz.jpg', 'Acceptable', 1929, '2023-03-03', 600, 'novel'),
(30, 'Crime and Punishment', 'Fyodor Dostoevsky', 'images/crime-and-punishment.jpg', 'Good condition', 0000, '2023-03-03', 0, 'novel'),
(31, 'The Idiot', 'Fyodor Dostoevsky', 'images/the-idiot.jpg', 'Good condition', 0000, '2023-03-03', 656, 'novel'),
(32, 'The Possessed', 'Fyodor Dostoevsky', 'images/the-possessed.jpg', 'Good condition', 0000, '2023-03-03', 768, 'novel'),
(33, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'images/the-brothers-karamazov.jpg', 'Good condition', 0000, '2023-03-03', 824, 'novel'),
(34, 'Middlemarch', 'George Eliot', 'images/middlemarch.jpg', 'New', 0000, '2023-03-03', 800, 'novel'),
(35, 'Invisible Man', 'Ralph Ellison', 'images/invisible-man.jpg', 'quite used', 1952, '2023-03-03', 581, 'novel'),
(36, 'Medea', 'Euripides', 'images/medea.jpg', 'Acceptable', 0000, '2023-03-03', 104, 'novel'),
(37, 'Absalom, Absalom!', 'William Faulkner', 'images/absalom-absalom.jpg', 'quite used', 1936, '2023-03-03', 313, 'novel'),
(38, 'The Sound and the Fury', 'William Faulkner', 'images/the-sound-and-the-fury.jpg', 'quite used', 1929, '2023-03-03', 326, 'novel'),
(39, 'Madame Bovary', 'Gustave Flaubert', 'images/madame-bovary.jpg', 'Good condition', 0000, '2023-03-03', 528, 'novel'),
(40, 'Sentimental Education', 'Gustave Flaubert', 'images/l-education-sentimentale.jpg', 'Good condition', 0000, '2023-03-03', 606, 'novel'),
(41, 'Gypsy Ballads', 'Federico García Lorca', 'images/gypsy-ballads.jpg', 'New', 1928, '2023-03-03', 218, 'novel'),
(42, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 'images/one-hundred-years-of-solitude.jpg', 'Good condition', 1967, '2023-03-03', 417, 'novel'),
(43, 'Love in the Time of Cholera', 'Gabriel García Márquez', 'images/love-in-the-time-of-cholera.jpg', 'Good condition', 1985, '2023-03-03', 368, 'novel'),
(44, 'Faust', 'Johann Wolfgang von Goethe', 'images/faust.jpg', 'New', 0000, '2023-03-03', 158, 'novel'),
(45, 'Dead Souls', 'Nikolai Gogol', 'images/dead-souls.jpg', 'Good condition', 0000, '2023-03-03', 432, 'novel'),
(46, 'The Tin Drum', 'Günter Grass', 'images/the-tin-drum.jpg', 'Acceptable', 1959, '2023-03-03', 600, 'novel'),
(47, 'The Devil to Pay in the Backlands', 'João Guimarães Rosa', 'images/the-devil-to-pay-in-the-backlands.jpg', 'quite used', 1956, '2023-03-03', 494, 'novel'),
(48, 'Hunger', 'Knut Hamsun', 'images/hunger.jpg', 'quite used', 0000, '2023-03-03', 176, 'novel'),
(49, 'The Old Man and the Sea', 'Ernest Hemingway', 'images/the-old-man-and-the-sea.jpg', 'quite used', 1952, '2023-03-03', 128, 'novel'),
(50, 'Iliad', 'Homer', 'images/the-iliad-of-homer.jpg', 'Acceptable', 0000, '2023-03-03', 608, 'novel'),
(51, 'Odyssey', 'Homer', 'images/the-odyssey-of-homer.jpg', 'Acceptable', 0000, '2023-03-03', 374, 'novel'),
(52, 'Ulysses', 'James Joyce', 'images/ulysses.jpg', 'Acceptable', 1922, '2023-03-03', 228, 'novel'),
(53, 'Stories', 'Franz Kafka', 'images/stories-of-franz-kafka.jpg', 'New', 1924, '2023-03-03', 488, 'novel'),
(54, 'The Trial', 'Franz Kafka', 'images/the-trial.jpg', 'Acceptable', 1925, '2023-03-03', 160, 'novel'),
(55, 'The Castle', 'Franz Kafka', 'images/the-castle.jpg', 'New', 1926, '2023-03-03', 352, 'novel'),
(56, 'The recognition of Shakuntala', 'Kālidāsa', 'images/the-recognition-of-shakuntala.jpg', 'New', 0000, '2023-03-03', 147, 'novel'),
(57, 'The Sound of the Mountain', 'Yasunari Kawabata', 'images/the-sound-of-the-mountain.jpg', 'Acceptable', 1954, '2023-03-03', 288, 'novel'),
(58, 'Zorba the Greek', 'Nikos Kazantzakis', 'images/zorba-the-greek.jpg', 'Acceptable', 1946, '2023-03-03', 368, 'novel'),
(59, 'Sons and Lovers', 'D. H. Lawrence', 'images/sons-and-lovers.jpg', 'New', 1913, '2023-03-03', 432, 'novel'),
(60, 'Independent People', 'Halldór Laxness', 'images/independent-people.jpg', 'quite used', 1934, '2023-03-03', 470, 'novel'),
(61, 'Poems', 'Giacomo Leopardi', 'images/poems-giacomo-leopardi.jpg', 'New', 0000, '2023-03-03', 184, '\n'),
(62, 'The Golden Notebook', 'Doris Lessing', 'images/the-golden-notebook.jpg', 'New', 1962, '2023-03-03', 688, 'novel'),
(63, 'Pippi Longstocking', 'Astrid Lindgren', 'images/pippi-longstocking.jpg', 'quite used', 1945, '2023-03-03', 160, 'novel'),
(64, 'Diary of a Madman', 'Lu Xun', 'images/diary-of-a-madman.jpg', 'quite used', 1918, '2023-03-03', 389, 'novel'),
(65, 'Children of Gebelawi', 'Naguib Mahfouz', 'images/children-of-gebelawi.jpg', 'quite used', 1959, '2023-03-03', 355, 'novel'),
(66, 'Buddenbrooks', 'Thomas Mann', 'images/buddenbrooks.jpg', 'Acceptable', 1901, '2023-03-03', 736, 'novel'),
(67, 'The Magic Mountain', 'Thomas Mann', 'images/the-magic-mountain.jpg', 'Acceptable', 1924, '2023-03-03', 720, 'novel'),
(68, 'Moby Dick', 'Herman Melville', 'images/moby-dick.jpg', 'quite used', 0000, '2023-03-03', 378, 'novel'),
(69, 'Essays', 'Michel de Montaigne', 'images/essais.jpg', 'Good condition', 0000, '2023-03-03', 404, 'Montaigne'),
(70, 'History', 'Elsa Morante', 'images/history.jpg', 'New', 1974, '2023-03-03', 600, 'novel'),
(71, 'Beloved', 'Toni Morrison', 'images/beloved.jpg', 'quite used', 1987, '2023-03-03', 321, 'novel'),
(72, 'The Tale of Genji', 'Murasaki Shikibu', 'images/the-tale-of-genji.jpg', 'Acceptable', 0000, '2023-03-03', 1360, 'novel'),
(73, 'The Man Without Qualities', 'Robert Musil', 'images/the-man-without-qualities.jpg', 'Acceptable', 1931, '2023-03-03', 365, 'novel'),
(74, 'Lolita', 'Vladimir Nabokov', 'images/lolita.jpg', 'Good condition', 1955, '2023-03-03', 317, 'novel'),
(75, 'Nineteen Eighty-Four', 'George Orwell', 'images/nineteen-eighty-four.jpg', 'New', 1949, '2023-03-03', 272, 'novel'),
(76, 'Metamorphoses', 'Ovid', 'images/the-metamorphoses-of-ovid.jpg', 'Good condition', 0000, '2023-03-03', 576, 'novel'),
(77, 'The Book of Disquiet', 'Fernando Pessoa', 'images/the-book-of-disquiet.jpg', 'Good condition', 1928, '2023-03-03', 272, 'novel'),
(78, 'Tales', 'Edgar Allan Poe', 'images/tales-and-poems-of-edgar-allan-poe.jpg', 'quite used', 1950, '2023-03-03', 842, 'novel'),
(79, 'In Search of Lost Time', 'Marcel Proust', 'images/a-la-recherche-du-temps-perdu.jpg', 'Good condition', 1920, '2023-03-03', 2408, 'novel'),
(80, 'Gargantua and Pantagruel', 'François Rabelais', 'images/gargantua-and-pantagruel.jpg', 'Good condition', 0000, '2023-03-03', 623, 'novel'),
(81, 'Pedro Paramo', 'Juan Rulfo', 'images/pedro-paramo.jpg', 'Good condition', 1955, '2023-03-03', 124, 'novel'),
(82, 'The Masnavi', 'Rumi', 'images/the-masnavi.jpg', 'Good condition', 0000, '2023-03-03', 438, 'novel'),
(83, 'Midnights Children', 'Salman Rushdie', 'images/midnights-children.jpg', 'New', 1981, '2023-03-03', 536, 'novel'),
(84, 'Bostan', 'Saadi', 'images/bostan.jpg', 'New', 0000, '2023-03-03', 298, 'book'),
(85, 'Season of Migration to the North', 'Tayeb Salih', 'images/season-of-migration-to-the-north.jpg', 'New', 1966, '2023-03-03', 139, 'novel'),
(86, 'Blindness', 'José Saramago', 'images/blindness.jpg', 'New', 1995, '2023-03-03', 352, 'novel'),
(87, 'Hamlet', 'William Shakespeare', 'images/hamlet.jpg', 'Acceptable', 0000, '2023-03-03', 432, 'novel'),
(88, 'King Lear', 'William Shakespeare', 'images/king-lear.jpg', 'Acceptable', 0000, '2023-03-03', 384, 'novel'),
(89, 'Othello', 'William Shakespeare', 'images/othello.jpg', 'Acceptable', 0000, '2023-03-03', 314, 'novel'),
(90, 'Oedipus the King', 'Sophocles', 'images/oedipus-the-king.jpg', 'Acceptable', 0000, '2023-03-03', 88, 'novel'),
(91, 'The Red and the Black', 'Stendhal', 'images/le-rouge-et-le-noir.jpg', 'Good condition', 0000, '2023-03-03', 576, 'novel'),
(92, 'The Life And Opinions of Tristram Shandy', 'Laurence Sterne', 'images/the-life-and-opinions-of-tristram-shandy.jp', 'Acceptable', 0000, '2023-03-03', 640, 'novel'),
(93, 'Confessions of Zeno', 'Italo Svevo', 'images/confessions-of-zeno.jpg', 'New', 1923, '2023-03-03', 412, 'novel'),
(94, 'Gullivers Travels', 'Jonathan Swift', 'images/gullivers-travels.jpg', 'Good condition', 0000, '2023-03-03', 178, 'novel'),
(95, 'War and Peace', 'Leo Tolstoy', 'images/war-and-peace.jpg', 'Good condition', 0000, '2023-03-03', 1296, 'novel'),
(96, 'Anna Karenina', 'Leo Tolstoy', 'images/anna-karenina.jpg', 'Good condition', 0000, '2023-03-03', 864, 'novel'),
(97, 'The Death of Ivan Ilyich', 'Leo Tolstoy', 'images/the-death-of-ivan-ilyich.jpg', 'Good condition', 0000, '2023-03-03', 92, 'book'),
(98, 'The Adventures of Huckleberry Finn', 'Mark Twain', 'images/the-adventures-of-huckleberry-finn.jpg', 'quite used', 0000, '2023-03-03', 224, 'novel'),
(99, 'Ramayana', 'Valmiki', 'images/ramayana.jpg', 'New', 0000, '2023-03-03', 152, 'book'),
(100, 'The Aeneid', 'Virgil', 'images/the-aeneid.jpg', 'New', 0000, '2023-03-03', 442, 'book'),
(101, 'Mahabharata', 'Vyasa', 'images/the-mahab-harata.jpg', 'New', 0000, '2023-03-03', 276, 'book'),
(102, 'Leaves of Grass', 'Walt Whitman', 'images/leaves-of-grass.jpg', 'quite used', 0000, '2023-03-03', 152, 'book'),
(103, 'Mrs Dalloway', 'Virginia Woolf', 'images/mrs-dalloway.jpg', 'New', 1925, '2023-03-03', 216, 'book'),
(104, 'To the Lighthouse', 'Virginia Woolf', 'images/to-the-lighthouse.jpg', 'New', 1927, '2023-03-03', 209, 'book'),
(105, 'Memoirs of Hadrian', 'Marguerite Yourcenar', 'images/memoirs-of-hadrian.jpg', 'Good condition', 1951, '2023-03-03', 408, 'book');

-- --------------------------------------------------------

--
-- Structure de la table `loan`
--

CREATE TABLE `loan` (
  `Id_loan` int(11) NOT NULL,
  `loan_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `Id_reservation` int(11) NOT NULL,
  `Id_book` int(11) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `C_I_N` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `type` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `opening_date` date NOT NULL,
  `penalty` int(11) NOT NULL,
  `Role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id_member`, `full_name`, `address`, `email`, `phone`, `C_I_N`, `date_of_birth`, `type`, `nickname`, `password`, `opening_date`, `penalty`, `Role`) VALUES
(2, 'ilias', 'hay el mers achennad', 'ilias@gmail.com', 654535351, 'KN76757', '2001-07-08', 'Student', 'ilias', '$2y$10$SqB3lWF5HXY54kRA77FMWeed5.vSRAecKK/Q.xw/vyAbyQrUnC16m', '2023-03-19', 5, 0),
(3, 'admin', 'hay el mers achennad', 'admin435choise@gmail.com', 654532675, 'N546427', '2001-07-08', 'Student', 'admin', '$2y$10$0RYdBbaz6Md51CB.XLuCLej1dco/LdzOwh3T6mqaH6tNaxIAkA2ae', '2023-03-19', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `Id_reservation` int(11) NOT NULL,
  `reservation_date` datetime NOT NULL,
  `id_member` int(11) NOT NULL,
  `Id_book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`Id_reservation`, `reservation_date`, `id_member`, `Id_book`) VALUES
(1, '2023-03-19 18:17:18', 2, 10),
(2, '2023-03-19 18:17:22', 2, 12),
(3, '2023-03-19 18:17:25', 2, 13);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Id_book`);

--
-- Index pour la table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`Id_loan`),
  ADD UNIQUE KEY `Id_reservation` (`Id_reservation`),
  ADD KEY `Id_book` (`Id_book`),
  ADD KEY `id_member` (`id_member`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Id_reservation`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `Id_book` (`Id_book`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `Id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pour la table `loan`
--
ALTER TABLE `loan`
  MODIFY `Id_loan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`Id_reservation`) REFERENCES `reservation` (`Id_reservation`),
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`Id_book`) REFERENCES `books` (`Id_book`),
  ADD CONSTRAINT `loan_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Id_book`) REFERENCES `books` (`Id_book`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
