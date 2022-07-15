-- -------------------------------------------------------------
-- TablePlus 4.7.1(428)
--
-- https://tableplus.com/
--
-- Database: shift_app
-- Generation Time: 2022-07-15 17:45:38.5650
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `department_shift` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_id` int DEFAULT NULL,
  `shift_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `shifts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `user_id` int NOT NULL,
  `location_id` int NOT NULL,
  `event_id` int DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `charge` float DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `department_shift` (`id`, `department_id`, `shift_id`, `created_at`) VALUES
(1, 1, 1, '2018-10-24 00:00:00'),
(2, 2, 1, '2018-10-24 00:00:00'),
(3, 3, 1, '2018-10-24 00:00:00'),
(4, 4, 2, '2018-10-24 00:00:00'),
(5, 5, 2, '2018-10-24 00:00:00');

INSERT INTO `departments` (`id`, `name`, `created_at`) VALUES
(1, 'Technology', '2018-10-24 00:00:00'),
(2, 'Gaming', '2018-10-24 00:00:00'),
(3, 'Construction', '2018-10-24 00:00:00'),
(4, 'Finances', '2018-10-24 00:00:00'),
(5, 'Health', '2018-10-24 00:00:00');

INSERT INTO `events` (`id`, `name`, `start`, `end`, `created_at`) VALUES
(1, 'Ceremony', '2018-10-22 00:00:00', '2018-10-24 00:00:00', '2018-10-24 00:00:00'),
(2, 'Induction', '2018-10-22 00:00:00', '2018-10-24 00:00:00', '2018-10-24 00:00:00'),
(3, 'Sports', '2018-10-22 00:00:00', '2018-10-24 00:00:00', '2018-10-24 00:00:00'),
(4, 'Coding', '2018-10-22 00:00:00', '2018-10-24 00:00:00', '2018-10-24 00:00:00'),
(5, 'Interview', '2018-10-22 00:00:00', '2018-10-24 00:00:00', '2018-10-24 00:00:00');

INSERT INTO `locations` (`id`, `name`, `created_at`) VALUES
(1, 'Lagos', '2018-10-24 00:00:00'),
(2, 'Ikeja Nigeria', '2018-10-24 00:00:00'),
(3, 'Lekki Nigeria', '2018-10-24 00:00:00'),
(4, 'Ikoyi Nigeria', '2018-10-24 00:00:00'),
(5, 'Surulere Nigeria', '2018-10-24 00:00:00');

INSERT INTO `shifts` (`id`, `type`, `start`, `end`, `user_id`, `location_id`, `event_id`, `rate`, `charge`, `area`, `created_at`) VALUES
(1, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(2, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(3, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(4, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(5, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(6, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(7, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(8, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(9, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(10, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(11, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(12, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(13, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(14, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(15, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(16, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(17, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(18, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(19, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(20, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(21, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(22, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(23, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(24, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(25, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(26, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(27, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(28, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(29, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(30, 'shift', '2018-10-25 17:00:00', '2018-10-30 00:00:00', 1, 1, 1, NULL, NULL, NULL, '2018-10-24 00:00:00'),
(31, 'shift', '2018-10-25 00:00:00', '2018-10-29 00:00:00', 2, 3, 2, NULL, NULL, NULL, '2018-10-24 00:00:00');

INSERT INTO `users` (`id`, `name`, `email`, `created_at`) VALUES
(1, 'Bola', 'Bola@test.com', '2018-10-24 00:00:00'),
(2, 'John', 'John@test.com', '2018-10-24 00:00:00'),
(3, 'Jude', 'Jude@test.com', '2018-10-24 00:00:00'),
(4, 'Tanel', 'Tanel@test.com', '2018-10-24 00:00:00'),
(5, 'Ade', 'Ade@test.com', '2018-10-24 00:00:00');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;