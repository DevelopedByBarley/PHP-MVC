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

INSERT INTO `admins` VALUES ('4', '6672c1840a967', '3', 'knorr_admin', '0developedbybarley@gmail.com', '$2y$10$LtbEMJPx/OGVO7WjcrbWqOBc7sufmGQcErg5DxPDDcQQerTeMHtla', 'bear', '2024-06-19');
INSERT INTO `admins` VALUES ('5', '6672c1b72a8cf', '3', 'knorr_user', '0developedbybarley@gmail.com', '$2y$10$U1WLkh2qzKMGKXKDCYpSmeN/AskkEYXCkyfCEfcASrT0fkNGwnTmS', 'bear', '2024-06-19');
INSERT INTO `admins` VALUES ('14', '667d5b2c37694', '0', 'Barleysdasddad', 'Barley@gmail.com', '$2y$10$U1WLkh2qzKMGKXKDCYpSmeN/AskkEYXCkyfCEfcASrT0fkNGwnTmS', 'bear', '2024-06-27');

-- Table structure for `feedbacks`
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(45) NOT NULL,
  `feedback` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `feedbacks` VALUES ('8', '2', '2', '2024-07-01 13:51:30');

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


-- Table structure for `visits`
CREATE TABLE `visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `visit_start` datetime NOT NULL DEFAULT current_timestamp(),
  `visit_end` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `visits` VALUES ('37', 'mrr3m72418tv9hps6f2rtediil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'http://localhost:8080/admin/dashboard', 'Desktop', 'Localhost', '2024-07-01 11:50:00', '2024-07-01 11:50:01');
INSERT INTO `visits` VALUES ('38', 'ooota5554vt1pm9iedfds9jqq5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'Windows NT', 'http://localhost:8080/admin/dashboard', 'Desktop', 'Localhost', '2024-07-01 14:19:15', '2024-07-01 14:19:18');

