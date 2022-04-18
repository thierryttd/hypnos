-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 17 avr. 2022 à 13:13
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 8.0.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hypnos`
--

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`user_id`, `suite_id`, `begin`, `end`, `bill`) VALUES
(100, 45, '2022-04-22', '2022-04-26', 2000),
(102, 41, '2022-04-23', '2022-05-04', 5500),
(100, 42, '2022-04-26', '2022-05-02', 3000);

--
-- Déchargement des données de la table `galleries`
--

INSERT INTO `galleries` (`id`, `source`, `suite`) VALUES
(120, '../gallery/IMG_1650128878', 41),
(121, '../gallery/IMG_1650129050', 41),
(122, '../gallery/IMG_1650129608', 41),
(123, '../gallery/IMG_1650129617', 41),
(124, '../gallery/IMG_1650132215', 42),
(125, '../gallery/IMG_1650132230', 42),
(126, '../gallery/IMG_1650132247', 42),
(127, '../gallery/IMG_1650132473', 43),
(128, '../gallery/IMG_1650132488', 43),
(129, '../gallery/IMG_1650132513', 43),
(130, '../gallery/IMG_1650133347', 44),
(131, '../gallery/IMG_1650133358', 44),
(132, '../gallery/IMG_1650133368', 44),
(133, '../gallery/IMG_1650133382', 44),
(134, '../gallery/IMG_1650189376', 45),
(135, '../gallery/IMG_1650189388', 45),
(136, '../gallery/IMG_1650189405', 45),
(137, '../gallery/IMG_1650189422', 45),
(138, '../gallery/IMG_1650189433', 45),
(139, '../gallery/IMG_1650189451', 45);

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `city`, `zipcode`, `street`, `streetnumber`, `description`, `manager`) VALUES
(11, 'HOTEL INITIAL', 'REIMS', '51100', 'Boulevard Pommery', '15', 'Maison bourgeoise de style art déco proposant 4 suites de luxe disposant chacune d&#039;un accès privatif à une partie du parc.', 99),
(13, 'HOTEL DE L&#039;EPINE', 'STRASBOURG', '67000', 'Rue de l&#039;âne portant l&#039;écritoire.', '125', 'L&#039;histoire de ce monument vous sera conté par l&#039;historien Claude l&#039;aîné du muséum d&#039;histoire de la ville.', 99),
(14, 'HOTEL DE L&#039;EMBARCADERE', 'TOULON', '83100', 'Avenue de l&#039;ancien port.', '18', 'L&#039;hôtel se compose de 4 suites grand luxe. Deux en duplex avec roof-top vous permettant de profiter d&#039;un jacuzzi en toute intimité. Deux autres suites située en rez de jardin, vous offrant un accès au parc.', 101);

--
-- Déchargement des données de la table `suites`
--

INSERT INTO `suites` (`id`, `title`, `featured`, `description`, `price`, `linkbooking`, `hotel`) VALUES
(41, 'suite une hotel initial', '../gallery/IMG_1650128878   ', 'pour test supression image', 500, 'qsdcssd', 11),
(42, 'SUITE BECAUD', '../gallery/IMG_1650132215', 'Et maintenant, une atmosphère année 1960 pour cet ensemble chambre king size et SPA privatif.', 500, 'lien réservation booking', 14),
(43, 'SUITE EVASION', '../gallery/IMG_1650132473', 'Située au dernier étage de notre établissement, vous bénéficierez d&amp;#039;une vue imprenable sur le mont Faron. Après une escapade, ressourcez-vous dans votre jacuzzi personnel.', 500, 'lien booking', 14),
(44, 'SUITE DORE', '../gallery/IMG_1650133347 ', 'Une suite à l&amp;#039;ambiance propice à l&amp;#039;abandon au plaisir du corps et de l&amp;#039;esprit. Une atmosphère cosy twistée d&amp;#039;un zeste d&amp;#039;extrême modernité.', 500, 'lien booking', 13),
(45, 'SUITE JUNIOR', '../gallery/IMG_1650189376 ', 'Une vraie rupture culturelle, plongez-vous dans l&amp;#039;atmosphère &amp;quot;urban zen&amp;quot; même la Californie ne connait pas encore !!', 500, 'lien de résa booking', 13);

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `email`, `role`, `password`) VALUES
(93, 'admin', 'admin', 'admin@hypnos.com', 'ADM', '$2y$10$9xgcgYYlVz3CRJPqUkzziuR6b0VJnsCUoR4VtSofFeD4NSDH91C/a'),
(99, 'MANAGER THIERRY', 'Thierry', 'thierry@hypnos.com', 'MNG', '$2y$10$FcTMaVnVI2piKXe91h/6KeE33eZhg0U.qLGd99VcH47y73ulK0ALa'),
(100, 'CLIENT CHRISTINE', 'Christine', 'christine@gmail.com', '', '$2y$10$4kNvmG399ot.xLR4HsGMCuYV4mUbeHAOoQO4Q.5k5XsoN4xhoP5f2'),
(101, 'MANAGER ISABELLE', 'Isabelle', 'isabelle@hypnos.com', 'MNG', '$2y$10$rc68NBqpyFg8Z50NuFd0SOEhiTtS60YG4nd1kX1aebC4VciLqUBd2'),
(102, 'CLIENT SEVERINE', 'Séverine', 'severine@gmail.com', '', '$2y$10$PNqYAzKd.qpapdWF8dNNUeLHUP68auK.zwqtUwsCR8Zpy27xU9Y1C');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
