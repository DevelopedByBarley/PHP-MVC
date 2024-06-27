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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` VALUES ('4', '6672c1840a967', '3', 'knorr_admin', 'developedbybarley@gmail.com', '$2y$10$RWHQOr1Wu7.IhZ2UOFP5T..Yfu5chAPCx5PqwWMPxmQCb9m5AyEFO', 'man', '2024-06-19');
INSERT INTO `admins` VALUES ('5', '6672c1b72a8cf', '3', 'knorr_user', '0developedbybarley@gmail.com', '$2y$10$H8xRkVou7qyICONDvg/eDuHnbXGNLu9JZLOeX9aFvBgNlN9NSqF8C', 'bear', '2024-06-19');
INSERT INTO `admins` VALUES ('7', '667d54f675be4', '0', 'Szaniszló Árpád', 'Barley@gmail.com', '$2y$10$.4NJLWMSIRCooDLkpGZ./eqby./9HabEvR846/86B90o9mopse8nq', 'bear', '2024-06-27');
INSERT INTO `admins` VALUES ('8', '667d550be4cb1', '0', 'Szaniszló Árpád', 'Barley@gmail.com', '$2y$10$4eURh4CfMJVDx/ikumKLQexSh5Q9AXeXoo8l9BiCRnUCwZsWmkffG', 'rabbit', '2024-06-27');
INSERT INTO `admins` VALUES ('9', '667d55428fc0b', '0', 'Szaniszló Árpád', 'dsadsad@asd.com', '$2y$10$Zq93SUjSFrgCzwYk4BPgquchey8YVQviCAof1tOeyk.3nI9aMD1sC', 'rabbit', '2024-06-27');
INSERT INTO `admins` VALUES ('10', '667d5557c00c7', '0', 'Szaniszló Árpád', 'Barley@gmail.com', '$2y$10$Y2wz/98Xv1qN/Th3MVXhm.kBAYWMNdZVj7yu6LXxaYaLHtXM51fo.', 'bear', '2024-06-27');
INSERT INTO `admins` VALUES ('11', '667d5565e6613', '0', 'Szaniszló Árpád', 'developedbybarley@gmail.com', '$2y$10$Te4hGlnpw285Smp2G1BKvu69kxg/kNBwU6VK5J/Jnhvtb.Ya1jiTa', 'bear', '2024-06-27');

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

