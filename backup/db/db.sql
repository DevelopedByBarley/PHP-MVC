-- Table structure for `admin_activities`
CREATE TABLE `admin_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(300) NOT NULL,
  `contentInEn` varchar(300) DEFAULT NULL,
  `adminRef_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `adminRef_id` (`adminRef_id`),
  CONSTRAINT `admin_activities_ibfk_1` FOREIGN KEY (`adminRef_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin_activities` VALUES ('24', 'dasdsads adsad sad as', '', '5', '2024-06-27 11:33:13');
INSERT INTO `admin_activities` VALUES ('25', 'dsadadasdsadsadasdasd', '', '4', '2024-06-27 11:33:46');
INSERT INTO `admin_activities` VALUES ('26', 'dsadsadsad', '', '5', '2024-06-27 11:33:52');
INSERT INTO `admin_activities` VALUES ('27', 'dasdsadsadsadsa', '', '4', '2024-06-27 11:33:57');
INSERT INTO `admin_activities` VALUES ('28', 'dsadasdasdasd', '', '5', '2024-06-27 11:34:08');
INSERT INTO `admin_activities` VALUES ('29', 'dsadasdasdasd', '', '5', '2024-06-27 11:34:08');

-- Table structure for `admins`
CREATE TABLE `admins` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `adminId` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(500) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` VALUES ('4', '6672c1840a967', '3', 'knorr_admin', '0developedbybarley@gmail.com', '$2y$10$5b8KV35ntMIp42I9b4wXqOVtIszFGq3YitMnyW9A3fnXzjZ/lROnO', 'shark', '2024-06-19');
INSERT INTO `admins` VALUES ('5', '6672c1b72a8cf', '3', 'knorr_user', '0developedbybarley@gmail.com', '$2y$10$U1WLkh2qzKMGKXKDCYpSmeN/AskkEYXCkyfCEfcASrT0fkNGwnTmS', 'bear', '2024-06-19');
INSERT INTO `admins` VALUES ('14', '667d5b2c37694', '0', 'Barleysdasddad', 'Barley@gmail.com', '$2y$10$U1WLkh2qzKMGKXKDCYpSmeN/AskkEYXCkyfCEfcASrT0fkNGwnTmS', 'bear', '2024-06-27');

-- Table structure for `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `class` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `ident_number` int(11) NOT NULL,
  `main_teamRef_id` int(11) DEFAULT NULL,
  `team_sportRef_id` int(11) DEFAULT NULL,
  `duel_sportRef_id` int(11) DEFAULT NULL,
  `chess` tinyint(1) NOT NULL,
  `run` tinyint(1) NOT NULL,
  `transfer` int(11) NOT NULL,
  `vegetarian` tinyint(1) NOT NULL,
  `actimo` tinyint(1) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `main_teamRef_id` (`main_teamRef_id`),
  KEY `duel_sportRef_id` (`duel_sportRef_id`),
  KEY `team_sportRef_id` (`team_sportRef_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` VALUES ('1', 'Szaniszló Árpád', 'mittomén', 'developedbybarley@asd.com', '2132313', '1', '1', '1', '0', '0', '2', '1', '1', '2024-06-18');
INSERT INTO `users` VALUES ('2', 'Szaniszló Árpád', 'mittomén', 'developedbybarley@asd.com', '2132313', '1', '1', '1', '0', '0', '2', '1', '1', '2024-06-18');

