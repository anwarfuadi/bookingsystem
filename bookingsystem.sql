/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : bookingsystem

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 13/09/2021 09:06:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for booking_details
-- ----------------------------
DROP TABLE IF EXISTS `booking_details`;
CREATE TABLE `booking_details` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `use_date` date NOT NULL,
  `hour_num` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`booking_id`,`room_id`,`use_date`),
  KEY `fk_booking_details_room` (`room_id`),
  CONSTRAINT `fk_booking_details_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `fk_booking_details_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of booking_details
-- ----------------------------
BEGIN;
INSERT INTO `booking_details` VALUES (8, 7, '2021-09-12', 1, '2021-09-12 11:29:42', '2021-09-12 11:29:42', NULL);
INSERT INTO `booking_details` VALUES (9, 7, '2021-09-02', 1, '2021-09-12 11:30:34', '2021-09-12 11:30:34', NULL);
INSERT INTO `booking_details` VALUES (10, 8, '2021-09-14', 1, '2021-09-12 11:31:04', '2021-09-12 11:31:04', NULL);
INSERT INTO `booking_details` VALUES (11, 7, '2021-08-18', 1, '2021-09-12 11:31:20', '2021-09-12 11:31:20', NULL);
INSERT INTO `booking_details` VALUES (12, 8, '2021-09-21', 1, '2021-09-12 11:37:13', '2021-09-12 11:37:13', NULL);
INSERT INTO `booking_details` VALUES (13, 7, '2021-09-15', 1, '2021-09-12 11:38:25', '2021-09-12 11:38:25', NULL);
INSERT INTO `booking_details` VALUES (13, 8, '2021-09-23', 1, '2021-09-12 11:38:25', '2021-09-12 11:38:25', NULL);
COMMIT;

-- ----------------------------
-- Table structure for booking_summaries
-- ----------------------------
DROP TABLE IF EXISTS `booking_summaries`;
CREATE TABLE `booking_summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `yearmonth` int(11) NOT NULL,
  `book_num` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_booking_sum_room` (`room_id`),
  CONSTRAINT `fk_booking_sum_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of booking_summaries
-- ----------------------------
BEGIN;
INSERT INTO `booking_summaries` VALUES (1, 7, 202109, 5, NULL, NULL, NULL);
INSERT INTO `booking_summaries` VALUES (2, 8, 202109, 4, NULL, NULL, NULL);
INSERT INTO `booking_summaries` VALUES (3, 7, 202108, 4, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for bookings
-- ----------------------------
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_no` varchar(10) NOT NULL,
  `booking_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_book_cust` (`customer_id`),
  KEY `fk_book_user` (`user_id`),
  CONSTRAINT `fk_book_cust` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `fk_book_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bookings
-- ----------------------------
BEGIN;
INSERT INTO `bookings` VALUES (8, 'OKNEH', '2021-09-12', 1, 4, '2021-09-12 11:29:42', '2021-09-12 11:29:42', NULL);
INSERT INTO `bookings` VALUES (9, '8IN3J', '2021-09-12', 1, 4, '2021-09-12 11:30:34', '2021-09-12 11:30:34', NULL);
INSERT INTO `bookings` VALUES (10, 'POKM3', '2021-09-12', 1, 4, '2021-09-12 11:31:04', '2021-09-12 11:31:04', NULL);
INSERT INTO `bookings` VALUES (11, '1WK5B', '2021-09-12', 1, 4, '2021-09-12 11:31:20', '2021-09-12 11:31:20', NULL);
INSERT INTO `bookings` VALUES (12, '90OEN', '2021-09-12', 1, 4, '2021-09-12 11:37:13', '2021-09-12 11:37:13', NULL);
INSERT INTO `bookings` VALUES (13, 'HLO63', '2021-09-12', 1, 4, '2021-09-12 11:38:25', '2021-09-12 11:38:25', NULL);
COMMIT;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
BEGIN;
INSERT INTO `customers` VALUES (4, 'C4', 'Kalila Radiya', 'Jl. Gajah Mada No .12', 'Ponorogo2', 'kalila@gmail.com2', '08123456789', NULL, '2021-09-12 10:39:45', NULL);
COMMIT;

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_code` varchar(5) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `floor` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rooms
-- ----------------------------
BEGIN;
INSERT INTO `rooms` VALUES (7, 'A21', 'Isfahan', 21, '1', '2021-09-12 11:25:58', '2021-09-12 11:25:58', NULL);
INSERT INTO `rooms` VALUES (8, 'A22', 'Andalusia', 10, '1', '2021-09-12 11:26:15', '2021-09-12 11:26:15', NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Administrator', '087654321', 'admin@bookingsystem.com', '$2y$10$/VDC8wWZdyT8/l.b2fBZsuSl89L4zHpMK2I7yDnRAPuXEDYuGUTF6', 'admin', '2021-09-11 14:14:46', '2021-09-11 14:14:46', NULL);
INSERT INTO `users` VALUES (2, 'Anwar Fuadi', '085649010588', 'anwar@akn.net', '$2y$10$RZVpJJGLghP9kxfdqdZXQuBU29kmZoPJb2UXu25.dp.al5uR0ZhCy', 'user', '2021-09-12 01:31:35', '2021-09-13 01:58:18', NULL);
COMMIT;

-- ----------------------------
-- View structure for booking_per_bulan
-- ----------------------------
DROP VIEW IF EXISTS `booking_per_bulan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `booking_per_bulan` AS select monthname(`bd`.`use_date`) AS `bulan`,year(`bd`.`use_date`) AS `tahun`,count(0) AS `jml_booking` from `booking_details` `bd` group by monthname(`bd`.`use_date`),year(`bd`.`use_date`);

-- ----------------------------
-- Function structure for new_cust_no
-- ----------------------------
DROP FUNCTION IF EXISTS `new_cust_no`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `new_cust_no`() RETURNS varchar(10) CHARSET utf8mb4
BEGIN
	DECLARE ai INT;
	DECLARE cust_no VARCHAR(10);
	SET ai = (SELECT AUTO_INCREMENT
		FROM information_schema.TABLES
		WHERE TABLE_SCHEMA = "bookingsystem"
		AND TABLE_NAME = "customers");
	SET cust_no = CONCAT("C",ai);
  RETURN cust_no;
END;
;;
delimiter ;

-- ----------------------------
-- Procedure structure for proc_customer
-- ----------------------------
DROP PROCEDURE IF EXISTS `proc_customer`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_customer`(
	proc VARCHAR(6),
	pId INT,
	pNama VARCHAR(50),
	pAddress VARCHAR(255),
	pCity VARCHAR(50),
	pEmail VARCHAR(100),
	pHp VARCHAR(15)
)
BEGIN
	IF proc = 'ADD' THEN
		INSERT INTO customers(customer_no, customer_name, address, city, email, hp) values(new_cust_no(), pNama, pAddress, pCity, pEmail, pHp);
	ELSEIF proc = 'EDIT' THEN
		UPDATE customers SET customer_name = pNama, address = pAddress, city = pCity, email = pEmail, hp = pHp WHERE id = pId;
	ELSEIF proc = 'DELETE' THEN
		DELETE FROM customers	WHERE id = pId;
	END IF;
END;
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table booking_details
-- ----------------------------
DROP TRIGGER IF EXISTS `insert_booking`;
delimiter ;;
CREATE TRIGGER `insert_booking` AFTER INSERT ON `booking_details` FOR EACH ROW BEGIN
	DECLARE ym INT;
	SET ym = (SELECT EXTRACT(YEAR_MONTH FROM NEW.use_date));

	IF EXISTS(SELECT * FROM booking_summaries WHERE room_id=NEW.room_id AND yearmonth=ym) THEN
	BEGIN
		UPDATE booking_summaries SET book_num = book_num + 1;
	END;
	ELSE
	BEGIN
		INSERT INTO booking_summaries(room_id, yearmonth, book_num) VALUES (NEW.room_id, ym, 1);
	END;
	END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
