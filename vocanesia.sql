/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : vocanesia

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 30/05/2020 03:45:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `produk_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES (2, 'pdf', 1, 1, '2020-05-29 19:16:05', '2020-05-29 19:16:05');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (10, 'UI / UX', 'ui-ux', '2020-05-22 14:39:25', '2020-05-22 14:39:25');
INSERT INTO `categories` VALUES (11, 'Programming', 'programming', '2020-05-22 14:39:36', '2020-05-22 14:39:36');

-- ----------------------------
-- Table structure for course_produks
-- ----------------------------
DROP TABLE IF EXISTS `course_produks`;
CREATE TABLE `course_produks`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(20) NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `cover` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `diskon` int(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of course_produks
-- ----------------------------
INSERT INTO `course_produks` VALUES (1, 10, 'ui-ux-bareng-wak-sunari', 2, 'course-produks\\May2020\\zmszvBiQXMg975RsyHuN.jpg', 'Ui Ux Bareng Wak Sunari', 'Ui Ux', 300000, NULL, '2020-05-23 12:44:23', '2020-05-24 21:15:10', NULL);

-- ----------------------------
-- Table structure for customer_libraries
-- ----------------------------
DROP TABLE IF EXISTS `customer_libraries`;
CREATE TABLE `customer_libraries`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(20) NOT NULL,
  `produk_id` int(20) NOT NULL,
  `type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer_libraries
-- ----------------------------
INSERT INTO `customer_libraries` VALUES (6, 1, 1, 'pdf', '2020-05-22 14:51:36', '2020-05-22 14:51:36');

-- ----------------------------
-- Table structure for customer_test_answer
-- ----------------------------
DROP TABLE IF EXISTS `customer_test_answer`;
CREATE TABLE `customer_test_answer`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(20) NOT NULL,
  `video_id` int(20) NOT NULL,
  `soal_id` int(20) NOT NULL,
  `jawaban` int(20) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer_test_answer
-- ----------------------------

-- ----------------------------
-- Table structure for customer_tests
-- ----------------------------
DROP TABLE IF EXISTS `customer_tests`;
CREATE TABLE `customer_tests`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `start` datetime(0) NOT NULL,
  `end` datetime(0) NULL DEFAULT NULL,
  `expired_at` datetime(0) NULL DEFAULT NULL,
  `customer_score` int(3) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer_tests
-- ----------------------------

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_hp` bigint(20) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verivied` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `otp` int(6) NOT NULL,
  `profile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'rahmat putra', 'rahmat@yunip.id', '$2y$10$TfU8yKTMkZ.GtAX92qRbV.jjpWQAE.Cj5JLC8GaZBE6fkmAleVXlq', 85235410480, NULL, 'yes', 0, NULL, '2020-05-08 12:43:05', '2020-05-14 17:00:46');
INSERT INTO `customers` VALUES (2, 'test test', 'test@test.ctes', '$2y$10$2wuK6XCDVSrqzObMBsXm4enK9cv0XS1reGluQdPJHXmE1WPsAC3Oe', 85654123215, NULL, 'no', 471821, NULL, '2020-05-29 20:38:03', '2020-05-29 20:38:03');

-- ----------------------------
-- Table structure for data_rows
-- ----------------------------
DROP TABLE IF EXISTS `data_rows`;
CREATE TABLE `data_rows`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `data_rows_data_type_id_foreign`(`data_type_id`) USING BTREE,
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 187 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_rows
-- ----------------------------
INSERT INTO `data_rows` VALUES (1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3);
INSERT INTO `data_rows` VALUES (4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 4);
INSERT INTO `data_rows` VALUES (5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5);
INSERT INTO `data_rows` VALUES (6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8);
INSERT INTO `data_rows` VALUES (8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 9);
INSERT INTO `data_rows` VALUES (9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11);
INSERT INTO `data_rows` VALUES (10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 12);
INSERT INTO `data_rows` VALUES (11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 16);
INSERT INTO `data_rows` VALUES (12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1);
INSERT INTO `data_rows` VALUES (13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2);
INSERT INTO `data_rows` VALUES (14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3);
INSERT INTO `data_rows` VALUES (15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4);
INSERT INTO `data_rows` VALUES (16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1);
INSERT INTO `data_rows` VALUES (17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2);
INSERT INTO `data_rows` VALUES (18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3);
INSERT INTO `data_rows` VALUES (19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4);
INSERT INTO `data_rows` VALUES (20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5);
INSERT INTO `data_rows` VALUES (21, 1, 'role_id', 'text', 'Role', 0, 1, 1, 1, 1, 1, '{}', 10);
INSERT INTO `data_rows` VALUES (22, 5, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (23, 5, 'nama', 'text', 'Nama', 1, 1, 1, 0, 0, 0, '{}', 2);
INSERT INTO `data_rows` VALUES (24, 5, 'email', 'text', 'Email', 1, 1, 1, 0, 0, 0, '{}', 3);
INSERT INTO `data_rows` VALUES (25, 5, 'password', 'text', 'Password', 1, 0, 0, 0, 0, 0, '{}', 4);
INSERT INTO `data_rows` VALUES (26, 5, 'no_hp', 'text', 'No Hp', 1, 1, 1, 0, 0, 0, '{}', 5);
INSERT INTO `data_rows` VALUES (27, 5, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (28, 5, 'verivied', 'text', 'Verivied', 1, 1, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (29, 5, 'otp', 'text', 'Otp', 1, 0, 0, 0, 0, 0, '{}', 8);
INSERT INTO `data_rows` VALUES (30, 5, 'profile', 'image', 'Profile', 0, 1, 1, 0, 0, 0, '{}', 9);
INSERT INTO `data_rows` VALUES (31, 5, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 10);
INSERT INTO `data_rows` VALUES (32, 5, 'updated_at', 'date', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 11);
INSERT INTO `data_rows` VALUES (33, 6, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (34, 6, 'images', 'image', 'Images', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (35, 6, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 3);
INSERT INTO `data_rows` VALUES (36, 6, 'updated_at', 'text', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4);
INSERT INTO `data_rows` VALUES (37, 7, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (38, 7, 'profile', 'image', 'Profile', 0, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (39, 7, 'nama', 'text', 'Nama', 0, 1, 1, 1, 1, 1, '{}', 3);
INSERT INTO `data_rows` VALUES (40, 7, 'title', 'text', 'Title', 0, 1, 1, 1, 1, 1, '{}', 4);
INSERT INTO `data_rows` VALUES (41, 7, 'cerita', 'text_area', 'Cerita', 0, 0, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (42, 7, 'created_at', 'timestamp', 'Created At', 0, 1, 0, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (43, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (44, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (45, 8, 'profile', 'image', 'Profile', 0, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (46, 8, 'nama', 'text', 'Nama', 0, 1, 1, 1, 1, 1, '{}', 3);
INSERT INTO `data_rows` VALUES (47, 8, 'title', 'text', 'Title', 0, 1, 1, 1, 1, 1, '{}', 4);
INSERT INTO `data_rows` VALUES (48, 8, 'cerita', 'text_area', 'Cerita', 0, 1, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (49, 8, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (50, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (51, 9, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (56, 9, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 9);
INSERT INTO `data_rows` VALUES (57, 9, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 10);
INSERT INTO `data_rows` VALUES (58, 9, 'video_produk_belongsto_mentor_relationship', 'relationship', 'Mentor', 0, 1, 1, 1, 1, 1, '{\"scope\":\"someMentors\",\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4);
INSERT INTO `data_rows` VALUES (59, 9, 'video_name', 'file', 'Video Name', 0, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"mimes:mp4\"}}', 7);
INSERT INTO `data_rows` VALUES (60, 9, 'pdf_name', 'file', 'Pdf Name', 0, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"mimes:pdf\"}}', 8);
INSERT INTO `data_rows` VALUES (61, 9, 'name', 'text', 'Title Video', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"},\"decription\":\"Video Part 1\"}', 2);
INSERT INTO `data_rows` VALUES (62, 11, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (66, 11, 'deskripsi', 'text_area', 'Deskripsi', 1, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 9);
INSERT INTO `data_rows` VALUES (67, 11, 'harga', 'number', 'Harga', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"},\"display\":{\"width\":3}}', 10);
INSERT INTO `data_rows` VALUES (68, 11, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 12);
INSERT INTO `data_rows` VALUES (69, 11, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 13);
INSERT INTO `data_rows` VALUES (70, 11, 'course_produk_belongsto_user_relationship', 'relationship', 'Mentor', 0, 1, 1, 1, 1, 1, '{\"scope\":\"someMentors\",\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);
INSERT INTO `data_rows` VALUES (72, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (73, 12, 'video_produk_id', 'text', 'Video Produk Id', 0, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (74, 12, 'soal', 'rich_text_box', 'Soal', 0, 1, 1, 1, 1, 1, '{}', 3);
INSERT INTO `data_rows` VALUES (75, 12, 'opsi_a', 'rich_text_box', 'Opsi A', 0, 1, 1, 1, 1, 1, '{}', 4);
INSERT INTO `data_rows` VALUES (76, 12, 'opsi_b', 'rich_text_box', 'Opsi B', 0, 1, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (77, 12, 'opsi_c', 'rich_text_box', 'Opsi C', 0, 1, 1, 1, 1, 1, '{}', 6);
INSERT INTO `data_rows` VALUES (78, 12, 'opsi_d', 'rich_text_box', 'Opsi D', 0, 1, 1, 1, 1, 1, '{}', 7);
INSERT INTO `data_rows` VALUES (79, 12, 'opsi_e', 'rich_text_box', 'Opsi E', 0, 1, 1, 1, 1, 1, '{}', 8);
INSERT INTO `data_rows` VALUES (80, 12, 'jawaban', 'text', 'Jawaban', 0, 1, 1, 1, 1, 1, '{}', 9);
INSERT INTO `data_rows` VALUES (81, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 1, '{}', 10);
INSERT INTO `data_rows` VALUES (82, 12, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 11);
INSERT INTO `data_rows` VALUES (96, 11, 'cover', 'image', 'Cover', 1, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 8);
INSERT INTO `data_rows` VALUES (97, 11, 'name', 'text', 'Nama Produk', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 6);
INSERT INTO `data_rows` VALUES (98, 14, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (100, 14, 'cover', 'image', 'Cover', 1, 0, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (101, 14, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 7);
INSERT INTO `data_rows` VALUES (102, 14, 'harga', 'number', 'Harga', 1, 1, 1, 1, 1, 1, '{}', 8);
INSERT INTO `data_rows` VALUES (103, 14, 'deskripsi', 'rich_text_box', 'Deskripsi', 1, 0, 1, 1, 1, 1, '{}', 10);
INSERT INTO `data_rows` VALUES (104, 14, 'pdf_uri', 'file', 'File EBOOK (EPUB)', 1, 0, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"mimes:epub\"}}', 11);
INSERT INTO `data_rows` VALUES (105, 14, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 12);
INSERT INTO `data_rows` VALUES (106, 14, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 13);
INSERT INTO `data_rows` VALUES (107, 14, 'pdf_produk_belongsto_user_relationship', 'relationship', 'Seller Name', 0, 1, 1, 0, 0, 0, '{\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);
INSERT INTO `data_rows` VALUES (109, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (110, 15, 'invoice', 'text', 'Invoice', 0, 1, 1, 0, 0, 0, '{}', 2);
INSERT INTO `data_rows` VALUES (111, 15, 'customer_id', 'text', 'Customer Id', 1, 0, 0, 0, 0, 0, '{}', 3);
INSERT INTO `data_rows` VALUES (112, 15, 'gross_amount', 'text', 'Gross Amount', 1, 0, 1, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (113, 15, 'status', 'text', 'Status', 1, 1, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (114, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 8);
INSERT INTO `data_rows` VALUES (115, 15, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 9);
INSERT INTO `data_rows` VALUES (116, 15, 'order_belongsto_user_relationship', 'relationship', 'Nama Customer', 0, 0, 1, 0, 0, 0, '{\"model\":\"App\\\\Models\\\\Customer\",\"table\":\"customers\",\"type\":\"belongsTo\",\"column\":\"customer_id\",\"key\":\"id\",\"label\":\"nama\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4);
INSERT INTO `data_rows` VALUES (117, 15, 'order_belongsto_customer_relationship', 'relationship', 'No Hp', 0, 0, 1, 0, 0, 0, '{\"model\":\"App\\\\Models\\\\Customer\",\"table\":\"customers\",\"type\":\"belongsTo\",\"column\":\"customer_id\",\"key\":\"id\",\"label\":\"no_hp\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5);
INSERT INTO `data_rows` VALUES (118, 17, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (120, 17, 'soal', 'text_area', 'Soal', 1, 1, 1, 1, 1, 1, '{}', 4);
INSERT INTO `data_rows` VALUES (121, 17, 'opsi_a', 'text_area', 'Opsi A', 1, 0, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (122, 17, 'opsi_b', 'text_area', 'Opsi B', 1, 0, 1, 1, 1, 1, '{}', 6);
INSERT INTO `data_rows` VALUES (123, 17, 'opsi_c', 'text_area', 'Opsi C', 1, 0, 1, 1, 1, 1, '{}', 7);
INSERT INTO `data_rows` VALUES (124, 17, 'opsi_d', 'text_area', 'Opsi D', 1, 0, 1, 1, 1, 1, '{}', 8);
INSERT INTO `data_rows` VALUES (125, 17, 'opsi_e', 'text_area', 'Opsi E', 1, 0, 1, 1, 1, 1, '{}', 9);
INSERT INTO `data_rows` VALUES (126, 17, 'jawaban', 'select_dropdown', 'Jawaban', 1, 0, 1, 1, 1, 1, '{\"default\":\"opsi_a\",\"options\":{\"opsi_a\":\"Opsi A\",\"opsi_b\":\"Opsi B\",\"opsi_c\":\"Opsi C\",\"opsi_d\":\"Opsi D\",\"opsi_e\":\"Opsi E\"}}', 10);
INSERT INTO `data_rows` VALUES (127, 17, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 11);
INSERT INTO `data_rows` VALUES (128, 17, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 12);
INSERT INTO `data_rows` VALUES (129, 17, 'video_soal_belongsto_course_produk_relationship', 'relationship', 'Judul Video', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\VideoProduk\",\"table\":\"video_produks\",\"type\":\"belongsTo\",\"column\":\"video_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);
INSERT INTO `data_rows` VALUES (130, 9, 'user_id', 'text', 'Mentor', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 3);
INSERT INTO `data_rows` VALUES (131, 21, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (132, 21, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (133, 21, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 1, '{}', 3);
INSERT INTO `data_rows` VALUES (134, 21, 'updated_at', 'text', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 4);
INSERT INTO `data_rows` VALUES (135, 21, 'slug', 'text', 'Slug', 1, 0, 1, 0, 0, 0, '{}', 3);
INSERT INTO `data_rows` VALUES (136, 11, 'course_produk_belongsto_kategori_video_relationship', 'relationship', 'Kategori', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"kategori_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5);
INSERT INTO `data_rows` VALUES (137, 11, 'kategori_id', 'text', 'Kategori', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 4);
INSERT INTO `data_rows` VALUES (138, 11, 'slug', 'text', 'Slug', 1, 0, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (139, 11, 'user_id', 'text', 'Mentor', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 2);
INSERT INTO `data_rows` VALUES (140, 11, 'diskon', 'number', 'Diskon', 0, 1, 1, 1, 1, 1, '{\"description\":\"Percentage\",\"display\":{\"width\":3}}', 11);
INSERT INTO `data_rows` VALUES (141, 9, 'course_id', 'text', 'Produk Video', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 5);
INSERT INTO `data_rows` VALUES (142, 9, 'video_produk_belongsto_course_produk_relationship', 'relationship', 'Produk Video', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\CourseProduk\",\"table\":\"course_produks\",\"type\":\"belongsTo\",\"column\":\"course_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6);
INSERT INTO `data_rows` VALUES (143, 17, 'video_id', 'text', 'Judul Video', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (144, 14, 'user_id', 'text', 'Seller Name', 1, 0, 0, 0, 0, 0, '{}', 2);
INSERT INTO `data_rows` VALUES (150, 24, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (151, 24, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (152, 24, 'slug', 'text', 'Slug', 0, 0, 1, 0, 0, 0, '{}', 3);
INSERT INTO `data_rows` VALUES (153, 24, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '{}', 4);
INSERT INTO `data_rows` VALUES (154, 24, 'updated_at', 'text', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5);
INSERT INTO `data_rows` VALUES (155, 14, 'pdf_produk_belongsto_category_relationship', 'relationship', 'Kategori', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Category\",\"table\":\"categories\",\"type\":\"belongsTo\",\"column\":\"kategori_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6);
INSERT INTO `data_rows` VALUES (156, 14, 'kategori_id', 'text', 'Kategori', 1, 1, 1, 1, 1, 1, '{}', 4);
INSERT INTO `data_rows` VALUES (157, 14, 'slug', 'text', 'Slug', 1, 0, 1, 0, 0, 0, '{}', 9);
INSERT INTO `data_rows` VALUES (158, 25, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (159, 25, 'user_id', 'text', 'Book Store', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (160, 25, 'royalty', 'number', 'Royalty', 1, 1, 1, 1, 1, 1, '{\"step\":10,\"min\":0,\"max\":10}', 4);
INSERT INTO `data_rows` VALUES (161, 25, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 5);
INSERT INTO `data_rows` VALUES (162, 25, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (163, 25, 'royalty_book_store_belongsto_user_relationship', 'relationship', 'Book Store', 0, 1, 1, 1, 1, 1, '{\"scope\":\"someSeller\",\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);
INSERT INTO `data_rows` VALUES (164, 26, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (165, 26, 'user_id', 'text', 'User', 1, 1, 1, 1, 1, 1, '{}', 2);
INSERT INTO `data_rows` VALUES (166, 26, 'nominal', 'number', 'Nominal', 1, 1, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (167, 26, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (168, 26, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (169, 26, 'withdrawal_belongsto_user_relationship', 'relationship', 'User', 0, 1, 1, 1, 1, 1, '{\"scope\":\"mentorAndSeller\",\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);
INSERT INTO `data_rows` VALUES (171, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 1, 1, 1, '{}', 7);
INSERT INTO `data_rows` VALUES (172, 1, 'nama_rekening', 'text', 'Nama Rekening', 0, 0, 1, 1, 1, 1, '{}', 13);
INSERT INTO `data_rows` VALUES (173, 1, 'bank', 'text', 'Bank', 0, 0, 1, 1, 1, 1, '{}', 14);
INSERT INTO `data_rows` VALUES (174, 1, 'nomor_rekening', 'number', 'Nomor Rekening', 0, 0, 1, 1, 1, 1, '{}', 15);
INSERT INTO `data_rows` VALUES (175, 26, 'nama_rekening', 'text', 'Nama Rekening', 0, 1, 1, 1, 1, 1, '{}', 3);
INSERT INTO `data_rows` VALUES (176, 26, 'bank', 'text', 'Bank', 0, 1, 1, 1, 1, 1, '{}', 4);
INSERT INTO `data_rows` VALUES (177, 26, 'nomor_rekening', 'text', 'Nomor Rekening', 0, 1, 1, 1, 1, 1, '{}', 5);
INSERT INTO `data_rows` VALUES (178, 29, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1);
INSERT INTO `data_rows` VALUES (179, 29, 'ticket_no', 'text', 'Ticket No', 0, 1, 1, 0, 0, 0, '{}', 2);
INSERT INTO `data_rows` VALUES (181, 29, 'message', 'rich_text_box', 'Message', 1, 0, 1, 0, 0, 0, '{}', 5);
INSERT INTO `data_rows` VALUES (182, 29, 'status', 'checkbox', 'Status', 0, 1, 1, 0, 0, 0, '{}', 6);
INSERT INTO `data_rows` VALUES (183, 29, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, '{}', 7);
INSERT INTO `data_rows` VALUES (184, 29, 'updated_at', 'text', 'Updated At', 0, 0, 1, 0, 0, 0, '{}', 8);
INSERT INTO `data_rows` VALUES (185, 29, 'customer_id', 'text', 'Customer Id', 1, 0, 1, 0, 0, 0, '{}', 3);
INSERT INTO `data_rows` VALUES (186, 29, 'ticket_belongsto_customer_relationship', 'relationship', 'Customers', 0, 1, 1, 0, 0, 0, '{\"model\":\"App\\\\Models\\\\Customer\",\"table\":\"customers\",\"type\":\"belongsTo\",\"column\":\"customer_id\",\"key\":\"id\",\"label\":\"nama\",\"pivot_table\":\"banners\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4);

-- ----------------------------
-- Table structure for data_types
-- ----------------------------
DROP TABLE IF EXISTS `data_types`;
CREATE TABLE `data_types`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `model_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `policy_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `data_types_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `data_types_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_types
-- ----------------------------
INSERT INTO `data_types` VALUES (1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-05-01 06:39:10', '2020-05-20 15:50:37');
INSERT INTO `data_types` VALUES (2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-05-01 06:39:10', '2020-05-01 06:39:10');
INSERT INTO `data_types` VALUES (3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2020-05-01 06:39:10', '2020-05-01 06:39:10');
INSERT INTO `data_types` VALUES (5, 'customers', 'customers', 'Customer', 'Customers', NULL, 'App\\Models\\Customer', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"nama\",\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-08 19:46:57', '2020-05-08 19:46:57');
INSERT INTO `data_types` VALUES (6, 'banners', 'banners', 'Banner', 'Banners', NULL, 'App\\Models\\Banner', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-09 07:19:22', '2020-05-09 07:19:22');
INSERT INTO `data_types` VALUES (7, 'mentors', 'mentors', 'Mentor', 'Mentors', NULL, 'App\\Models\\Mentor', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-09 07:24:40', '2020-05-09 07:24:40');
INSERT INTO `data_types` VALUES (8, 'reviews', 'reviews', 'Review', 'Reviews', NULL, 'App\\Models\\Review', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-09 07:31:38', '2020-05-09 07:31:38');
INSERT INTO `data_types` VALUES (9, 'video_produks', 'video-produks', 'Video Produk', 'Video Produks', NULL, 'App\\Models\\VideoProduk', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-10 12:30:49', '2020-05-24 21:11:05');
INSERT INTO `data_types` VALUES (11, 'course_produks', 'course-produks', 'Course Produk', 'Course Produks', NULL, 'App\\Models\\CourseProduk', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-11 10:01:38', '2020-05-19 20:31:47');
INSERT INTO `data_types` VALUES (12, 'video_soal', 'video-soal', 'Video Soal', 'Video Soals', NULL, 'App\\Models\\VideoSoal', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-11 10:08:22', '2020-05-11 10:10:05');
INSERT INTO `data_types` VALUES (14, 'pdf_produks', 'pdf-produks', 'Ebook Produk', 'Ebook Produk', NULL, 'App\\Models\\PdfProduk', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":\"currentUser\"}', '2020-05-15 06:46:16', '2020-05-29 20:07:45');
INSERT INTO `data_types` VALUES (15, 'orders', 'orders', 'Order', 'Orders', NULL, 'App\\Models\\Order', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"updated_at\",\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":\"invoice\",\"scope\":null}', '2020-05-18 21:51:58', '2020-05-18 21:55:34');
INSERT INTO `data_types` VALUES (17, 'video_soals', 'quiz', 'Quiz Course', 'Quiz Course', 'voyager-double-right', 'App\\Models\\VideoSoal', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-18 22:38:13', '2020-05-19 18:52:14');
INSERT INTO `data_types` VALUES (21, 'kategori_videos', 'kategori-videos', 'Kategori Video', 'Kategori Video', 'voyager-categories', 'App\\Models\\KategoriVideo', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"name\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-19 15:45:49', '2020-05-19 15:54:21');
INSERT INTO `data_types` VALUES (24, 'categories', 'categories', 'Category', 'Categories', 'voyager-category', 'App\\Models\\Category', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"name\",\"order_display_column\":\"name\",\"order_direction\":\"asc\",\"default_search_key\":null}', '2020-05-19 20:33:11', '2020-05-19 20:33:11');
INSERT INTO `data_types` VALUES (25, 'royalty_book_stores', 'royalty-book-stores', 'Royalty Book Store', 'Royalty Book Stores', NULL, 'App\\Models\\RoyaltyBookStore', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-20 15:28:55', '2020-05-20 15:34:59');
INSERT INTO `data_types` VALUES (26, 'withdrawals', 'withdrawals', 'Withdrawal', 'Withdrawals', NULL, 'App\\Models\\Withdrawal', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-20 15:44:59', '2020-05-21 12:03:36');
INSERT INTO `data_types` VALUES (29, 'tickets', 'tickets', 'Ticket', 'Ticket', 'voyager-chat', 'App\\Models\\Ticket', NULL, '\\App\\Http\\Controllers\\Admin\\MessageBoxController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-05-21 12:12:36', '2020-05-21 13:22:49');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for menu_items
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `menu_items_menu_id_foreign`(`menu_id`) USING BTREE,
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_items
-- ----------------------------
INSERT INTO `menu_items` VALUES (1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2020-05-01 06:39:11', '2020-05-01 06:39:11', 'voyager.dashboard', NULL);
INSERT INTO `menu_items` VALUES (2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 9, '2020-05-01 06:39:11', '2020-05-19 20:34:29', 'voyager.media.index', NULL);
INSERT INTO `menu_items` VALUES (3, 1, 'Users', '', '_self', 'voyager-double-right', '#000000', 13, 1, '2020-05-01 06:39:11', '2020-05-08 19:50:05', 'voyager.users.index', 'null');
INSERT INTO `menu_items` VALUES (4, 1, 'Roles', '', '_self', 'voyager-double-right', '#000000', 13, 2, '2020-05-01 06:39:11', '2020-05-08 19:49:58', 'voyager.roles.index', 'null');
INSERT INTO `menu_items` VALUES (5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 11, '2020-05-01 06:39:11', '2020-05-21 11:46:22', NULL, NULL);
INSERT INTO `menu_items` VALUES (6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2020-05-01 06:39:11', '2020-05-08 19:48:38', 'voyager.menus.index', NULL);
INSERT INTO `menu_items` VALUES (7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2020-05-01 06:39:11', '2020-05-08 19:48:38', 'voyager.database.index', NULL);
INSERT INTO `menu_items` VALUES (8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2020-05-01 06:39:11', '2020-05-08 19:48:38', 'voyager.compass.index', NULL);
INSERT INTO `menu_items` VALUES (9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2020-05-01 06:39:12', '2020-05-08 19:48:38', 'voyager.bread.index', NULL);
INSERT INTO `menu_items` VALUES (10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 12, '2020-05-01 06:39:12', '2020-05-21 11:46:22', 'voyager.settings.index', NULL);
INSERT INTO `menu_items` VALUES (11, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2020-05-01 06:39:14', '2020-05-08 19:48:38', 'voyager.hooks', NULL);
INSERT INTO `menu_items` VALUES (12, 1, 'Customers', '', '_self', 'voyager-double-right', '#000000', 13, 3, '2020-05-08 19:46:57', '2020-05-08 19:49:14', 'voyager.customers.index', 'null');
INSERT INTO `menu_items` VALUES (13, 1, 'User Setting', '', '_self', 'voyager-folder', '#000000', NULL, 3, '2020-05-08 19:48:32', '2020-05-19 20:34:28', NULL, '');
INSERT INTO `menu_items` VALUES (14, 1, 'Banners', '', '_self', 'voyager-double-right', '#000000', 17, 1, '2020-05-09 07:19:23', '2020-05-09 07:36:22', 'voyager.banners.index', 'null');
INSERT INTO `menu_items` VALUES (16, 1, 'Reviews', '', '_self', 'voyager-double-right', '#000000', 17, 2, '2020-05-09 07:31:38', '2020-05-19 18:12:27', 'voyager.reviews.index', 'null');
INSERT INTO `menu_items` VALUES (17, 1, 'Home Page Setting', '', '_self', 'voyager-folder', '#000000', NULL, 4, '2020-05-09 07:35:27', '2020-05-19 20:34:28', NULL, '');
INSERT INTO `menu_items` VALUES (18, 1, 'Asset Produk', '', '_self', 'voyager-double-right', '#000000', 22, 2, '2020-05-10 12:30:50', '2020-05-19 18:14:08', 'voyager.video-produks.index', 'null');
INSERT INTO `menu_items` VALUES (19, 1, 'Produk Video', '', '_self', 'voyager-double-right', '#000000', 22, 1, '2020-05-11 10:01:39', '2020-05-19 18:13:29', 'voyager.course-produks.index', 'null');
INSERT INTO `menu_items` VALUES (22, 1, 'Produk Video', '', '_self', 'voyager-video', '#000000', NULL, 6, '2020-05-11 10:11:54', '2020-05-21 11:45:54', NULL, '');
INSERT INTO `menu_items` VALUES (23, 1, 'E-book Store Produk', '', '_self', 'voyager-book', '#000000', NULL, 8, '2020-05-15 06:46:16', '2020-05-21 11:45:58', 'voyager.pdf-produks.index', 'null');
INSERT INTO `menu_items` VALUES (29, 1, 'Orders', '', '_self', 'voyager-logbook', '#000000', NULL, 5, '2020-05-18 21:51:58', '2020-05-21 11:45:53', 'voyager.orders.index', 'null');
INSERT INTO `menu_items` VALUES (30, 1, 'Quiz', '', '_self', 'voyager-double-right', '#000000', 22, 3, '2020-05-18 22:38:13', '2020-05-19 18:13:59', 'voyager.quiz.index', 'null');
INSERT INTO `menu_items` VALUES (33, 1, 'Categories', '', '_self', 'voyager-categories', '#000000', NULL, 2, '2020-05-19 20:33:11', '2020-05-19 20:35:19', 'voyager.categories.index', 'null');
INSERT INTO `menu_items` VALUES (34, 1, 'Royalty Book Stores', '', '_self', 'voyager-fire', '#000000', NULL, 7, '2020-05-20 15:28:56', '2020-05-21 11:45:58', 'voyager.royalty-book-stores.index', 'null');
INSERT INTO `menu_items` VALUES (35, 1, 'Withdrawals', '', '_self', 'voyager-dollar', '#000000', NULL, 10, '2020-05-20 15:44:59', '2020-05-21 11:46:21', 'voyager.withdrawals.index', 'null');
INSERT INTO `menu_items` VALUES (36, 1, 'Ticket', '', '_self', 'voyager-chat', NULL, NULL, 13, '2020-05-21 12:12:38', '2020-05-21 12:12:38', 'voyager.tickets.index', NULL);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `menus_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'admin', '2020-05-01 06:39:11', '2020-05-01 06:39:11');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2016_01_01_000000_add_voyager_user_fields', 1);
INSERT INTO `migrations` VALUES (3, '2016_01_01_000000_create_data_types_table', 1);
INSERT INTO `migrations` VALUES (4, '2016_05_19_173453_create_menu_table', 1);
INSERT INTO `migrations` VALUES (5, '2016_10_21_190000_create_roles_table', 1);
INSERT INTO `migrations` VALUES (6, '2016_10_21_190000_create_settings_table', 1);
INSERT INTO `migrations` VALUES (7, '2016_11_30_135954_create_permission_table', 1);
INSERT INTO `migrations` VALUES (8, '2016_11_30_141208_create_permission_role_table', 1);
INSERT INTO `migrations` VALUES (9, '2016_12_26_201236_data_types__add__server_side', 1);
INSERT INTO `migrations` VALUES (10, '2017_01_13_000000_add_route_to_menu_items_table', 1);
INSERT INTO `migrations` VALUES (11, '2017_01_14_005015_create_translations_table', 1);
INSERT INTO `migrations` VALUES (12, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1);
INSERT INTO `migrations` VALUES (13, '2017_03_06_000000_add_controller_to_data_types_table', 1);
INSERT INTO `migrations` VALUES (14, '2017_04_21_000000_add_order_to_data_rows_table', 1);
INSERT INTO `migrations` VALUES (15, '2017_07_05_210000_add_policyname_to_data_types_table', 1);
INSERT INTO `migrations` VALUES (16, '2017_08_05_000000_add_group_to_settings_table', 1);
INSERT INTO `migrations` VALUES (17, '2017_11_26_013050_add_user_role_relationship', 1);
INSERT INTO `migrations` VALUES (18, '2017_11_26_015000_create_user_roles_table', 1);
INSERT INTO `migrations` VALUES (19, '2018_03_11_000000_add_user_settings', 1);
INSERT INTO `migrations` VALUES (20, '2018_03_14_000000_add_details_to_data_types_table', 1);
INSERT INTO `migrations` VALUES (21, '2018_03_16_000000_make_settings_value_nullable', 1);
INSERT INTO `migrations` VALUES (22, '2019_08_19_000000_create_failed_jobs_table', 1);

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `produk_id` int(20) NOT NULL,
  `harga` int(10) NOT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (17, 1, 15, 'pdf', 4, 1, 100000, '2020-05-22 14:46:15', '2020-05-22 14:46:15');
INSERT INTO `order_details` VALUES (18, 1, 16, 'pdf', 4, 1, 100000, '2020-05-22 14:46:19', '2020-05-22 14:46:19');
INSERT INTO `order_details` VALUES (19, 1, 17, 'video', 2, 1, 300000, '2020-05-23 12:46:45', '2020-05-23 12:46:45');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_id` int(20) NOT NULL,
  `gross_amount` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (15, 'Inv-2020052215', 1, '100000', 'pending', '2020-05-22 14:46:15', '2020-05-22 14:46:15');
INSERT INTO `orders` VALUES (16, 'Inv-2020052216', 1, '100000', 'success', '2020-05-22 14:46:19', '2020-05-22 14:51:35');
INSERT INTO `orders` VALUES (17, 'Inv-2020052317', 1, '300000', 'success', '2020-05-23 12:46:44', '2020-05-23 12:48:43');

-- ----------------------------
-- Table structure for pdf_produks
-- ----------------------------
DROP TABLE IF EXISTS `pdf_produks`;
CREATE TABLE `pdf_produks`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `kategori_id` int(20) NOT NULL,
  `cover` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `deskripsi` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pdf_uri` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pdf_produks
-- ----------------------------
INSERT INTO `pdf_produks` VALUES (1, 1, 11, 'pdf-produks/May2020/E0L6Mo4aSFmM6hQgyOEF.jpg', 'Aplikasi perangkat lunak dan perancangan interior gedung kelas XII', 'aplikasi-perangkat-lunak-dan-perancangan-interior-gedung-kelas-xii', 10000, '<p>Aplikasi perangkat lunak dan perancangan interior gedung kelas XII</p>', '[{\"download_link\":\"pdf-produks\\\\May2020\\\\vGHwpHuff7n3vSNjRF72.epub\",\"original_name\":\"User_Manual_Non_Perseorangan.epub\"}]', '2020-05-28 00:46:44', '2020-05-29 20:08:43', NULL);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_permission_id_index`(`permission_id`) USING BTREE,
  INDEX `permission_role_role_id_index`(`role_id`) USING BTREE,
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (1, 3);
INSERT INTO `permission_role` VALUES (1, 4);
INSERT INTO `permission_role` VALUES (1, 5);
INSERT INTO `permission_role` VALUES (2, 1);
INSERT INTO `permission_role` VALUES (3, 1);
INSERT INTO `permission_role` VALUES (4, 1);
INSERT INTO `permission_role` VALUES (4, 5);
INSERT INTO `permission_role` VALUES (5, 1);
INSERT INTO `permission_role` VALUES (6, 1);
INSERT INTO `permission_role` VALUES (7, 1);
INSERT INTO `permission_role` VALUES (8, 1);
INSERT INTO `permission_role` VALUES (9, 1);
INSERT INTO `permission_role` VALUES (10, 1);
INSERT INTO `permission_role` VALUES (11, 1);
INSERT INTO `permission_role` VALUES (11, 5);
INSERT INTO `permission_role` VALUES (12, 1);
INSERT INTO `permission_role` VALUES (13, 1);
INSERT INTO `permission_role` VALUES (14, 1);
INSERT INTO `permission_role` VALUES (15, 1);
INSERT INTO `permission_role` VALUES (16, 1);
INSERT INTO `permission_role` VALUES (16, 5);
INSERT INTO `permission_role` VALUES (17, 1);
INSERT INTO `permission_role` VALUES (17, 5);
INSERT INTO `permission_role` VALUES (18, 1);
INSERT INTO `permission_role` VALUES (19, 1);
INSERT INTO `permission_role` VALUES (19, 5);
INSERT INTO `permission_role` VALUES (20, 1);
INSERT INTO `permission_role` VALUES (20, 5);
INSERT INTO `permission_role` VALUES (21, 1);
INSERT INTO `permission_role` VALUES (21, 5);
INSERT INTO `permission_role` VALUES (22, 1);
INSERT INTO `permission_role` VALUES (22, 5);
INSERT INTO `permission_role` VALUES (23, 1);
INSERT INTO `permission_role` VALUES (23, 5);
INSERT INTO `permission_role` VALUES (24, 1);
INSERT INTO `permission_role` VALUES (25, 1);
INSERT INTO `permission_role` VALUES (26, 1);
INSERT INTO `permission_role` VALUES (27, 1);
INSERT INTO `permission_role` VALUES (27, 5);
INSERT INTO `permission_role` VALUES (28, 1);
INSERT INTO `permission_role` VALUES (28, 5);
INSERT INTO `permission_role` VALUES (29, 1);
INSERT INTO `permission_role` VALUES (30, 1);
INSERT INTO `permission_role` VALUES (31, 1);
INSERT INTO `permission_role` VALUES (32, 1);
INSERT INTO `permission_role` VALUES (33, 1);
INSERT INTO `permission_role` VALUES (34, 1);
INSERT INTO `permission_role` VALUES (35, 1);
INSERT INTO `permission_role` VALUES (36, 1);
INSERT INTO `permission_role` VALUES (37, 1);
INSERT INTO `permission_role` VALUES (38, 1);
INSERT INTO `permission_role` VALUES (39, 1);
INSERT INTO `permission_role` VALUES (40, 1);
INSERT INTO `permission_role` VALUES (41, 1);
INSERT INTO `permission_role` VALUES (42, 1);
INSERT INTO `permission_role` VALUES (43, 1);
INSERT INTO `permission_role` VALUES (44, 1);
INSERT INTO `permission_role` VALUES (45, 1);
INSERT INTO `permission_role` VALUES (46, 1);
INSERT INTO `permission_role` VALUES (47, 1);
INSERT INTO `permission_role` VALUES (47, 3);
INSERT INTO `permission_role` VALUES (48, 1);
INSERT INTO `permission_role` VALUES (48, 3);
INSERT INTO `permission_role` VALUES (49, 1);
INSERT INTO `permission_role` VALUES (49, 3);
INSERT INTO `permission_role` VALUES (50, 1);
INSERT INTO `permission_role` VALUES (50, 3);
INSERT INTO `permission_role` VALUES (51, 1);
INSERT INTO `permission_role` VALUES (51, 3);
INSERT INTO `permission_role` VALUES (52, 1);
INSERT INTO `permission_role` VALUES (52, 3);
INSERT INTO `permission_role` VALUES (53, 1);
INSERT INTO `permission_role` VALUES (53, 3);
INSERT INTO `permission_role` VALUES (54, 1);
INSERT INTO `permission_role` VALUES (54, 3);
INSERT INTO `permission_role` VALUES (55, 1);
INSERT INTO `permission_role` VALUES (55, 3);
INSERT INTO `permission_role` VALUES (56, 1);
INSERT INTO `permission_role` VALUES (56, 3);
INSERT INTO `permission_role` VALUES (67, 1);
INSERT INTO `permission_role` VALUES (67, 4);
INSERT INTO `permission_role` VALUES (68, 1);
INSERT INTO `permission_role` VALUES (68, 4);
INSERT INTO `permission_role` VALUES (69, 1);
INSERT INTO `permission_role` VALUES (69, 4);
INSERT INTO `permission_role` VALUES (70, 1);
INSERT INTO `permission_role` VALUES (70, 4);
INSERT INTO `permission_role` VALUES (71, 1);
INSERT INTO `permission_role` VALUES (71, 4);
INSERT INTO `permission_role` VALUES (75, 1);
INSERT INTO `permission_role` VALUES (75, 5);
INSERT INTO `permission_role` VALUES (76, 1);
INSERT INTO `permission_role` VALUES (76, 5);
INSERT INTO `permission_role` VALUES (80, 1);
INSERT INTO `permission_role` VALUES (80, 4);
INSERT INTO `permission_role` VALUES (81, 1);
INSERT INTO `permission_role` VALUES (81, 4);
INSERT INTO `permission_role` VALUES (82, 1);
INSERT INTO `permission_role` VALUES (82, 4);
INSERT INTO `permission_role` VALUES (83, 1);
INSERT INTO `permission_role` VALUES (83, 4);
INSERT INTO `permission_role` VALUES (84, 1);
INSERT INTO `permission_role` VALUES (84, 4);
INSERT INTO `permission_role` VALUES (85, 1);
INSERT INTO `permission_role` VALUES (86, 1);
INSERT INTO `permission_role` VALUES (87, 1);
INSERT INTO `permission_role` VALUES (88, 1);
INSERT INTO `permission_role` VALUES (89, 1);
INSERT INTO `permission_role` VALUES (90, 1);
INSERT INTO `permission_role` VALUES (91, 1);
INSERT INTO `permission_role` VALUES (92, 1);
INSERT INTO `permission_role` VALUES (93, 1);
INSERT INTO `permission_role` VALUES (94, 1);
INSERT INTO `permission_role` VALUES (100, 1);
INSERT INTO `permission_role` VALUES (101, 1);
INSERT INTO `permission_role` VALUES (102, 1);
INSERT INTO `permission_role` VALUES (103, 1);
INSERT INTO `permission_role` VALUES (104, 1);
INSERT INTO `permission_role` VALUES (105, 1);
INSERT INTO `permission_role` VALUES (106, 1);
INSERT INTO `permission_role` VALUES (107, 1);
INSERT INTO `permission_role` VALUES (108, 1);
INSERT INTO `permission_role` VALUES (109, 1);
INSERT INTO `permission_role` VALUES (110, 1);
INSERT INTO `permission_role` VALUES (111, 1);
INSERT INTO `permission_role` VALUES (112, 1);
INSERT INTO `permission_role` VALUES (113, 1);
INSERT INTO `permission_role` VALUES (114, 1);
INSERT INTO `permission_role` VALUES (115, 1);
INSERT INTO `permission_role` VALUES (116, 1);
INSERT INTO `permission_role` VALUES (117, 1);
INSERT INTO `permission_role` VALUES (118, 1);
INSERT INTO `permission_role` VALUES (119, 1);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `permissions_key_index`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 120 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'browse_admin', NULL, '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (2, 'browse_bread', NULL, '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (3, 'browse_database', NULL, '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (4, 'browse_media', NULL, '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (5, 'browse_compass', NULL, '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (6, 'browse_menus', 'menus', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (7, 'read_menus', 'menus', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (8, 'edit_menus', 'menus', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (9, 'add_menus', 'menus', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (10, 'delete_menus', 'menus', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (11, 'browse_roles', 'roles', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (12, 'read_roles', 'roles', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (13, 'edit_roles', 'roles', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (14, 'add_roles', 'roles', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (15, 'delete_roles', 'roles', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (16, 'browse_users', 'users', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (17, 'read_users', 'users', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (18, 'edit_users', 'users', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `permissions` VALUES (19, 'add_users', 'users', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (20, 'delete_users', 'users', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (21, 'browse_settings', 'settings', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (22, 'read_settings', 'settings', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (23, 'edit_settings', 'settings', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (24, 'add_settings', 'settings', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (25, 'delete_settings', 'settings', '2020-05-01 06:39:13', '2020-05-01 06:39:13');
INSERT INTO `permissions` VALUES (26, 'browse_hooks', NULL, '2020-05-01 06:39:14', '2020-05-01 06:39:14');
INSERT INTO `permissions` VALUES (27, 'browse_customers', 'customers', '2020-05-08 19:46:57', '2020-05-08 19:46:57');
INSERT INTO `permissions` VALUES (28, 'read_customers', 'customers', '2020-05-08 19:46:57', '2020-05-08 19:46:57');
INSERT INTO `permissions` VALUES (29, 'edit_customers', 'customers', '2020-05-08 19:46:57', '2020-05-08 19:46:57');
INSERT INTO `permissions` VALUES (30, 'add_customers', 'customers', '2020-05-08 19:46:57', '2020-05-08 19:46:57');
INSERT INTO `permissions` VALUES (31, 'delete_customers', 'customers', '2020-05-08 19:46:57', '2020-05-08 19:46:57');
INSERT INTO `permissions` VALUES (32, 'browse_banners', 'banners', '2020-05-09 07:19:22', '2020-05-09 07:19:22');
INSERT INTO `permissions` VALUES (33, 'read_banners', 'banners', '2020-05-09 07:19:22', '2020-05-09 07:19:22');
INSERT INTO `permissions` VALUES (34, 'edit_banners', 'banners', '2020-05-09 07:19:22', '2020-05-09 07:19:22');
INSERT INTO `permissions` VALUES (35, 'add_banners', 'banners', '2020-05-09 07:19:22', '2020-05-09 07:19:22');
INSERT INTO `permissions` VALUES (36, 'delete_banners', 'banners', '2020-05-09 07:19:22', '2020-05-09 07:19:22');
INSERT INTO `permissions` VALUES (37, 'browse_mentors', 'mentors', '2020-05-09 07:24:40', '2020-05-09 07:24:40');
INSERT INTO `permissions` VALUES (38, 'read_mentors', 'mentors', '2020-05-09 07:24:40', '2020-05-09 07:24:40');
INSERT INTO `permissions` VALUES (39, 'edit_mentors', 'mentors', '2020-05-09 07:24:40', '2020-05-09 07:24:40');
INSERT INTO `permissions` VALUES (40, 'add_mentors', 'mentors', '2020-05-09 07:24:40', '2020-05-09 07:24:40');
INSERT INTO `permissions` VALUES (41, 'delete_mentors', 'mentors', '2020-05-09 07:24:40', '2020-05-09 07:24:40');
INSERT INTO `permissions` VALUES (42, 'browse_reviews', 'reviews', '2020-05-09 07:31:38', '2020-05-09 07:31:38');
INSERT INTO `permissions` VALUES (43, 'read_reviews', 'reviews', '2020-05-09 07:31:38', '2020-05-09 07:31:38');
INSERT INTO `permissions` VALUES (44, 'edit_reviews', 'reviews', '2020-05-09 07:31:38', '2020-05-09 07:31:38');
INSERT INTO `permissions` VALUES (45, 'add_reviews', 'reviews', '2020-05-09 07:31:38', '2020-05-09 07:31:38');
INSERT INTO `permissions` VALUES (46, 'delete_reviews', 'reviews', '2020-05-09 07:31:38', '2020-05-09 07:31:38');
INSERT INTO `permissions` VALUES (47, 'browse_video_produks', 'video_produks', '2020-05-10 12:30:49', '2020-05-10 12:30:49');
INSERT INTO `permissions` VALUES (48, 'read_video_produks', 'video_produks', '2020-05-10 12:30:49', '2020-05-10 12:30:49');
INSERT INTO `permissions` VALUES (49, 'edit_video_produks', 'video_produks', '2020-05-10 12:30:49', '2020-05-10 12:30:49');
INSERT INTO `permissions` VALUES (50, 'add_video_produks', 'video_produks', '2020-05-10 12:30:49', '2020-05-10 12:30:49');
INSERT INTO `permissions` VALUES (51, 'delete_video_produks', 'video_produks', '2020-05-10 12:30:49', '2020-05-10 12:30:49');
INSERT INTO `permissions` VALUES (52, 'browse_course_produks', 'course_produks', '2020-05-11 10:01:38', '2020-05-11 10:01:38');
INSERT INTO `permissions` VALUES (53, 'read_course_produks', 'course_produks', '2020-05-11 10:01:38', '2020-05-11 10:01:38');
INSERT INTO `permissions` VALUES (54, 'edit_course_produks', 'course_produks', '2020-05-11 10:01:38', '2020-05-11 10:01:38');
INSERT INTO `permissions` VALUES (55, 'add_course_produks', 'course_produks', '2020-05-11 10:01:38', '2020-05-11 10:01:38');
INSERT INTO `permissions` VALUES (56, 'delete_course_produks', 'course_produks', '2020-05-11 10:01:38', '2020-05-11 10:01:38');
INSERT INTO `permissions` VALUES (67, 'browse_pdf_produks', 'pdf_produks', '2020-05-15 06:46:16', '2020-05-15 06:46:16');
INSERT INTO `permissions` VALUES (68, 'read_pdf_produks', 'pdf_produks', '2020-05-15 06:46:16', '2020-05-15 06:46:16');
INSERT INTO `permissions` VALUES (69, 'edit_pdf_produks', 'pdf_produks', '2020-05-15 06:46:16', '2020-05-15 06:46:16');
INSERT INTO `permissions` VALUES (70, 'add_pdf_produks', 'pdf_produks', '2020-05-15 06:46:16', '2020-05-15 06:46:16');
INSERT INTO `permissions` VALUES (71, 'delete_pdf_produks', 'pdf_produks', '2020-05-15 06:46:16', '2020-05-15 06:46:16');
INSERT INTO `permissions` VALUES (75, 'browse_orders', 'orders', '2020-05-18 21:51:58', '2020-05-18 21:51:58');
INSERT INTO `permissions` VALUES (76, 'read_orders', 'orders', '2020-05-18 21:51:58', '2020-05-18 21:51:58');
INSERT INTO `permissions` VALUES (77, 'edit_orders', 'orders', '2020-05-18 21:51:58', '2020-05-18 21:51:58');
INSERT INTO `permissions` VALUES (78, 'add_orders', 'orders', '2020-05-18 21:51:58', '2020-05-18 21:51:58');
INSERT INTO `permissions` VALUES (79, 'delete_orders', 'orders', '2020-05-18 21:51:58', '2020-05-18 21:51:58');
INSERT INTO `permissions` VALUES (80, 'browse_video_soal', 'video_soals', '2020-05-18 22:38:13', '2020-05-18 22:38:13');
INSERT INTO `permissions` VALUES (81, 'read_video_soal', 'video_soals', '2020-05-18 22:38:13', '2020-05-18 22:38:13');
INSERT INTO `permissions` VALUES (82, 'edit_video_soal', 'video_soals', '2020-05-18 22:38:13', '2020-05-18 22:38:13');
INSERT INTO `permissions` VALUES (83, 'add_video_soal', 'video_soals', '2020-05-18 22:38:13', '2020-05-18 22:38:13');
INSERT INTO `permissions` VALUES (84, 'delete_video_soal', 'video_soals', '2020-05-18 22:38:13', '2020-05-18 22:38:13');
INSERT INTO `permissions` VALUES (85, 'browse_video_soals', 'video_soals', '2020-05-18 22:52:13', '2020-05-18 22:52:13');
INSERT INTO `permissions` VALUES (86, 'read_video_soals', 'video_soals', '2020-05-18 22:52:13', '2020-05-18 22:52:13');
INSERT INTO `permissions` VALUES (87, 'edit_video_soals', 'video_soals', '2020-05-18 22:52:13', '2020-05-18 22:52:13');
INSERT INTO `permissions` VALUES (88, 'add_video_soals', 'video_soals', '2020-05-18 22:52:13', '2020-05-18 22:52:13');
INSERT INTO `permissions` VALUES (89, 'delete_video_soals', 'video_soals', '2020-05-18 22:52:13', '2020-05-18 22:52:13');
INSERT INTO `permissions` VALUES (90, 'browse_kategori_videos', 'kategori_videos', '2020-05-19 15:45:49', '2020-05-19 15:45:49');
INSERT INTO `permissions` VALUES (91, 'read_kategori_videos', 'kategori_videos', '2020-05-19 15:45:49', '2020-05-19 15:45:49');
INSERT INTO `permissions` VALUES (92, 'edit_kategori_videos', 'kategori_videos', '2020-05-19 15:45:49', '2020-05-19 15:45:49');
INSERT INTO `permissions` VALUES (93, 'add_kategori_videos', 'kategori_videos', '2020-05-19 15:45:49', '2020-05-19 15:45:49');
INSERT INTO `permissions` VALUES (94, 'delete_kategori_videos', 'kategori_videos', '2020-05-19 15:45:49', '2020-05-19 15:45:49');
INSERT INTO `permissions` VALUES (100, 'browse_categories', 'categories', '2020-05-19 20:33:11', '2020-05-19 20:33:11');
INSERT INTO `permissions` VALUES (101, 'read_categories', 'categories', '2020-05-19 20:33:11', '2020-05-19 20:33:11');
INSERT INTO `permissions` VALUES (102, 'edit_categories', 'categories', '2020-05-19 20:33:11', '2020-05-19 20:33:11');
INSERT INTO `permissions` VALUES (103, 'add_categories', 'categories', '2020-05-19 20:33:11', '2020-05-19 20:33:11');
INSERT INTO `permissions` VALUES (104, 'delete_categories', 'categories', '2020-05-19 20:33:11', '2020-05-19 20:33:11');
INSERT INTO `permissions` VALUES (105, 'browse_royalty_book_stores', 'royalty_book_stores', '2020-05-20 15:28:55', '2020-05-20 15:28:55');
INSERT INTO `permissions` VALUES (106, 'read_royalty_book_stores', 'royalty_book_stores', '2020-05-20 15:28:55', '2020-05-20 15:28:55');
INSERT INTO `permissions` VALUES (107, 'edit_royalty_book_stores', 'royalty_book_stores', '2020-05-20 15:28:55', '2020-05-20 15:28:55');
INSERT INTO `permissions` VALUES (108, 'add_royalty_book_stores', 'royalty_book_stores', '2020-05-20 15:28:55', '2020-05-20 15:28:55');
INSERT INTO `permissions` VALUES (109, 'delete_royalty_book_stores', 'royalty_book_stores', '2020-05-20 15:28:55', '2020-05-20 15:28:55');
INSERT INTO `permissions` VALUES (110, 'browse_withdrawals', 'withdrawals', '2020-05-20 15:44:59', '2020-05-20 15:44:59');
INSERT INTO `permissions` VALUES (111, 'read_withdrawals', 'withdrawals', '2020-05-20 15:44:59', '2020-05-20 15:44:59');
INSERT INTO `permissions` VALUES (112, 'edit_withdrawals', 'withdrawals', '2020-05-20 15:44:59', '2020-05-20 15:44:59');
INSERT INTO `permissions` VALUES (113, 'add_withdrawals', 'withdrawals', '2020-05-20 15:44:59', '2020-05-20 15:44:59');
INSERT INTO `permissions` VALUES (114, 'delete_withdrawals', 'withdrawals', '2020-05-20 15:44:59', '2020-05-20 15:44:59');
INSERT INTO `permissions` VALUES (115, 'browse_tickets', 'tickets', '2020-05-21 12:12:37', '2020-05-21 12:12:37');
INSERT INTO `permissions` VALUES (116, 'read_tickets', 'tickets', '2020-05-21 12:12:37', '2020-05-21 12:12:37');
INSERT INTO `permissions` VALUES (117, 'edit_tickets', 'tickets', '2020-05-21 12:12:37', '2020-05-21 12:12:37');
INSERT INTO `permissions` VALUES (118, 'add_tickets', 'tickets', '2020-05-21 12:12:37', '2020-05-21 12:12:37');
INSERT INTO `permissions` VALUES (119, 'delete_tickets', 'tickets', '2020-05-21 12:12:37', '2020-05-21 12:12:37');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `profile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cerita` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviews
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'Administrator', '2020-05-01 06:39:12', '2020-05-01 06:39:12');
INSERT INTO `roles` VALUES (3, 'mentor', 'mentor', '2020-05-10 12:37:07', '2020-05-10 12:37:07');
INSERT INTO `roles` VALUES (4, 'seller', 'seller', '2020-05-10 17:34:29', '2020-05-10 17:34:29');
INSERT INTO `roles` VALUES (5, 'admin web', 'admin web', '2020-05-10 17:34:56', '2020-05-10 17:34:56');

-- ----------------------------
-- Table structure for royalty_book_stores
-- ----------------------------
DROP TABLE IF EXISTS `royalty_book_stores`;
CREATE TABLE `royalty_book_stores`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `royalty` int(20) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of royalty_book_stores
-- ----------------------------
INSERT INTO `royalty_book_stores` VALUES (1, 4, 10, '2020-05-20 15:35:18', '2020-05-20 15:35:18');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `settings_key_unique`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site');
INSERT INTO `settings` VALUES (2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site');
INSERT INTO `settings` VALUES (3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site');
INSERT INTO `settings` VALUES (4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site');
INSERT INTO `settings` VALUES (5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin');
INSERT INTO `settings` VALUES (6, 'admin.title', 'Admin Title', 'Vocanesia', '', 'text', 1, 'Admin');
INSERT INTO `settings` VALUES (7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin');
INSERT INTO `settings` VALUES (8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin');
INSERT INTO `settings` VALUES (9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin');
INSERT INTO `settings` VALUES (10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');
INSERT INTO `settings` VALUES (11, 'admin.royalty_course', 'Royalti Course Video', '10', NULL, 'text', 6, 'Admin');
INSERT INTO `settings` VALUES (12, 'admin.royalty_bookstore', 'Royalty Bookstore', '10', NULL, 'text', 7, 'Admin');

-- ----------------------------
-- Table structure for soal_jawaban_customers
-- ----------------------------
DROP TABLE IF EXISTS `soal_jawaban_customers`;
CREATE TABLE `soal_jawaban_customers`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `video_produk_id` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `jawaban` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of soal_jawaban_customers
-- ----------------------------
INSERT INTO `soal_jawaban_customers` VALUES (1, 1, 1, 1, 'opsi_a', '2020-05-24 20:54:22', '2020-05-24 20:54:22');
INSERT INTO `soal_jawaban_customers` VALUES (2, 1, 1, 2, 'opsi_a', '2020-05-26 15:05:16', '2020-05-26 15:05:16');
INSERT INTO `soal_jawaban_customers` VALUES (3, 1, 2, 3, 'opsi_a', '2020-05-26 23:21:36', '2020-05-25 23:21:40');

-- ----------------------------
-- Table structure for ticket_boxes
-- ----------------------------
DROP TABLE IF EXISTS `ticket_boxes`;
CREATE TABLE `ticket_boxes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `reply` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_boxes
-- ----------------------------

-- ----------------------------
-- Table structure for tickets
-- ----------------------------
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ticket_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_id` int(20) NOT NULL,
  `judul` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `message` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tickets
-- ----------------------------

-- ----------------------------
-- Table structure for translations
-- ----------------------------
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `translations_table_name_column_name_foreign_key_locale_unique`(`table_name`, `column_name`, `foreign_key`, `locale`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of translations
-- ----------------------------

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `user_roles_user_id_index`(`user_id`) USING BTREE,
  INDEX `user_roles_role_id_index`(`role_id`) USING BTREE,
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_roles
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'users/default.png',
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama_rekening` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nomor_rekening` bigint(191) NULL DEFAULT NULL,
  `settings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'admin', 'rahmat@yunip.id', 'users/default.png', NULL, '$2y$10$9cQ00d8bUGpwCMUutYCRgOR2WrcZhV6UHHYXhfl7w.H9qZ/v0Ui3y', NULL, NULL, NULL, NULL, '{\"locale\":\"en\"}', '2020-05-01 06:41:56', '2020-05-15 06:39:50');
INSERT INTO `users` VALUES (2, 3, 'Wak Sunari', 'mentor@mentor.id', 'users/default.png', NULL, '$2y$10$LKv8ardJVzpDQygt7CGag.kSAQPkEZM/jj.bdHHwo4CGYpr1hmp7y', NULL, 'Rahmat Putra Wiranata', 'Mandiri', 1010007567191, '{\"locale\":\"id\"}', '2020-05-10 17:33:39', '2020-05-20 16:01:12');
INSERT INTO `users` VALUES (3, 5, 'admin', 'admin@vokanesia.id', 'users/default.png', NULL, '$2y$10$s2z4AjUNGEALUdSxAk1fQ.r/CMdnh7aIkL5IUjyCQRovviBEy0K56', NULL, NULL, NULL, NULL, '{\"locale\":\"en\"}', '2020-05-15 06:39:34', '2020-05-15 06:39:34');
INSERT INTO `users` VALUES (4, 4, 'Hilman Ramadhan', 'seller@seller.id', 'users\\May2020\\di0s6QIq2bfugEI5WC3E.jpg', NULL, '$2y$10$FFUfusC3tK9brcbEIJqbNO20BuHOsJt2BJ0ZBGKqtc4WY78KXIK7y', NULL, NULL, NULL, NULL, '{\"locale\":\"en\"}', '2020-05-17 07:10:58', '2020-05-18 21:38:10');

-- ----------------------------
-- Table structure for video_produks
-- ----------------------------
DROP TABLE IF EXISTS `video_produks`;
CREATE TABLE `video_produks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `course_id` int(20) NULL DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `video_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pdf_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video_produks
-- ----------------------------
INSERT INTO `video_produks` VALUES (1, 2, 1, NULL, '[{\"download_link\":\"video-produks\\\\May2020\\\\eTWL0V9SeqU0O8SVEehM.mp4\",\"original_name\":\"[IU] Blueming Live Clip (2019 IU Tour Concert \'Love, poem\').mp4\"}]', '[{\"download_link\":\"video-produks\\\\May2020\\\\h7teibkxu0dXOtto17q9.pdf\",\"original_name\":\"document.pdf\"}]', 'Ui Ux', '2020-05-23 12:45:40', '2020-05-24 21:11:48', NULL);
INSERT INTO `video_produks` VALUES (2, 2, 1, 'https://www.youtube.com/watch?v=EiVmQZwJhsA', '[{\"download_link\":\"video-produks\\\\May2020\\\\zO3WE4d5cWT0dZnsSvWq.mp4\",\"original_name\":\"IU beautiful clip series.mp4\"}]', '[{\"download_link\":\"video-produks\\\\May2020\\\\TvHrjcLBQVoUXpgVPWD0.pdf\",\"original_name\":\"Deskripsi Platform Online - Applikasi Doctor Quincy.pdf\"}]', 'Part 2', '2020-05-26 14:28:27', '2020-05-30 00:36:55', NULL);

-- ----------------------------
-- Table structure for video_soals
-- ----------------------------
DROP TABLE IF EXISTS `video_soals`;
CREATE TABLE `video_soals`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `soal` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_a` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_b` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_c` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_d` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `opsi_e` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jawaban` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video_soals
-- ----------------------------
INSERT INTO `video_soals` VALUES (1, 1, 'males bikin soal ?', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'opsi_a', '2020-05-23 12:46:10', '2020-05-23 12:46:10', NULL);
INSERT INTO `video_soals` VALUES (2, 1, 'males bikin soal ?', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'opsi_a', '2020-05-23 12:46:10', '2020-05-23 12:46:10', NULL);
INSERT INTO `video_soals` VALUES (3, 2, 'males bikin soal ?', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'opsi_a', '2020-05-23 12:46:10', '2020-05-23 12:46:10', NULL);
INSERT INTO `video_soals` VALUES (4, 2, 'males bikin soal ?', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'jawabannya a', 'opsi_a', '2020-05-23 12:46:10', '2020-05-23 12:46:10', NULL);

-- ----------------------------
-- Table structure for withdrawals
-- ----------------------------
DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE `withdrawals`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `nama_rekening` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_rekening` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominal` bigint(20) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of withdrawals
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
