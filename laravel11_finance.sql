/*
 Navicat Premium Data Transfer

 Source Server         : mydb
 Source Server Type    : MySQL
 Source Server Version : 80403 (8.4.3)
 Source Host           : localhost:3306
 Source Schema         : laravel11_finance

 Target Server Type    : MySQL
 Target Server Version : 80403 (8.4.3)
 File Encoding         : 65001

 Date: 19/05/2025 17:06:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_subtypes
-- ----------------------------
DROP TABLE IF EXISTS `account_subtypes`;
CREATE TABLE `account_subtypes`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `multi_currency` tinyint(1) NOT NULL DEFAULT 0,
  `inverse_cash_flow` tinyint(1) NOT NULL DEFAULT 0,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `account_subtypes_company_id_foreign`(`company_id` ASC) USING BTREE,
  CONSTRAINT `account_subtypes_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of account_subtypes
-- ----------------------------

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `subtype_id` bigint UNSIGNED NULL DEFAULT NULL,
  `parent_id` bigint UNSIGNED NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `accounts_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `accounts_subtype_id_foreign`(`subtype_id` ASC) USING BTREE,
  INDEX `accounts_parent_id_foreign`(`parent_id` ASC) USING BTREE,
  INDEX `accounts_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `accounts_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  INDEX `accounts_code_index`(`code` ASC) USING BTREE,
  INDEX `accounts_name_index`(`name` ASC) USING BTREE,
  CONSTRAINT `accounts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `accounts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `accounts_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `accounts_subtype_id_foreign` FOREIGN KEY (`subtype_id`) REFERENCES `account_subtypes` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `accounts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 1, NULL, NULL, NULL, 'Assets', '1000', 'Cash', 'IDR', NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (2, 1, NULL, NULL, NULL, 'Liabilities', NULL, 'Accounts Payable', 'IDR', NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (3, 1, NULL, NULL, NULL, 'Equity', NULL, 'Owner’s Equity', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (4, 1, NULL, NULL, NULL, 'Revenue', NULL, 'Sales Revenue', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (5, 1, NULL, NULL, NULL, 'Expenses', NULL, 'Cost of Goods Sold', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (6, 1, NULL, NULL, NULL, 'Assets', '1', 'Bank Account', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (7, 1, NULL, NULL, NULL, 'Assets', '1010 ', 'Accounts Receivable', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (8, 1, NULL, NULL, NULL, 'Assets', '1030 ', 'Inventory', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (9, 1, NULL, NULL, NULL, 'Assets', '1', '	Fixed Assets', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (10, 1, NULL, NULL, NULL, 'Liabilities', NULL, 'Tax Payable', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (11, 1, NULL, NULL, NULL, 'Equity', NULL, 'Retained Earnings', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);
INSERT INTO `accounts` VALUES (12, 1, NULL, NULL, NULL, 'Assets', '1020 ', 'Prepaid Expenses', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for addresses
-- ----------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `parent_address_id` bigint UNSIGNED NULL DEFAULT NULL,
  `addressable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressable_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `state_id` smallint NULL DEFAULT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `addresses_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `addresses_parent_address_id_foreign`(`parent_address_id` ASC) USING BTREE,
  INDEX `addresses_addressable_type_addressable_id_index`(`addressable_type` ASC, `addressable_id` ASC) USING BTREE,
  INDEX `addresses_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `addresses_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `addresses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `addresses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `addresses_parent_address_id_foreign` FOREIGN KEY (`parent_address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `addresses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of addresses
-- ----------------------------

-- ----------------------------
-- Table structure for adjustmentables
-- ----------------------------
DROP TABLE IF EXISTS `adjustmentables`;
CREATE TABLE `adjustmentables`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `adjustment_id` bigint UNSIGNED NOT NULL,
  `adjustmentable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adjustmentable_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `adjustmentables_adjustment_id_foreign`(`adjustment_id` ASC) USING BTREE,
  INDEX `adjustmentables_adjustmentable_type_adjustmentable_id_index`(`adjustmentable_type` ASC, `adjustmentable_id` ASC) USING BTREE,
  INDEX `adjustmentables_adjustmentable_id_adjustmentable_type_index`(`adjustmentable_id` ASC, `adjustmentable_type` ASC) USING BTREE,
  CONSTRAINT `adjustmentables_adjustment_id_foreign` FOREIGN KEY (`adjustment_id`) REFERENCES `adjustments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of adjustmentables
-- ----------------------------

-- ----------------------------
-- Table structure for adjustments
-- ----------------------------
DROP TABLE IF EXISTS `adjustments`;
CREATE TABLE `adjustments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tax',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sales',
  `recoverable` tinyint(1) NOT NULL DEFAULT 0,
  `rate` bigint NOT NULL DEFAULT 0,
  `computation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `scope` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` datetime NULL DEFAULT NULL,
  `end_date` datetime NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `adjustments_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `adjustments_account_id_foreign`(`account_id` ASC) USING BTREE,
  INDEX `adjustments_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `adjustments_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `adjustments_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `adjustments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `adjustments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `adjustments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of adjustments
-- ----------------------------

-- ----------------------------
-- Table structure for bank_accounts
-- ----------------------------
DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE `bank_accounts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `institution_id` bigint UNSIGNED NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'depository',
  `number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bank_accounts_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `bank_accounts_account_id_foreign`(`account_id` ASC) USING BTREE,
  INDEX `bank_accounts_institution_id_foreign`(`institution_id` ASC) USING BTREE,
  INDEX `bank_accounts_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `bank_accounts_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `bank_accounts_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `bank_accounts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `bank_accounts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `bank_accounts_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `bank_accounts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bank_accounts
-- ----------------------------

-- ----------------------------
-- Table structure for bills
-- ----------------------------
DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NULL DEFAULT NULL,
  `bill_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `due_date` date NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discount_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_line_item',
  `discount_computation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `discount_rate` bigint NOT NULL DEFAULT 0,
  `subtotal` bigint NOT NULL DEFAULT 0,
  `tax_total` bigint NOT NULL DEFAULT 0,
  `discount_total` bigint NOT NULL DEFAULT 0,
  `total` bigint NOT NULL DEFAULT 0,
  `amount_paid` bigint NOT NULL DEFAULT 0,
  `amount_due` bigint GENERATED ALWAYS AS ((`total` - `amount_paid`)) STORED NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bills_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `bills_vendor_id_foreign`(`vendor_id` ASC) USING BTREE,
  INDEX `bills_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `bills_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `bills_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `bills_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `bills_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `bills_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bills
-- ----------------------------

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('5c785c036466adea360111aa28563bfd556b5fba', 'i:3;', 1745208830);
INSERT INTO `cache` VALUES ('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1745208830;', 1745208830);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `clients_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `clients_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `clients_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `clients_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `clients_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `clients_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clients
-- ----------------------------

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comments_commentable_type_commentable_id_index`(`commentable_type` ASC, `commentable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (1, 'comment1', 'App\\Models\\Post', 1, NULL, NULL);
INSERT INTO `comments` VALUES (2, 'comment2', 'App\\Models\\Post', 2, NULL, NULL);
INSERT INTO `comments` VALUES (3, 'comment2-1', 'App\\Models\\Post', 2, NULL, NULL);

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` int NULL DEFAULT NULL,
  `personal_company` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES (1, 'Alphabet', 'perusahaan induk Google yang dibentuk pada tahun 2015, menaungi banyak anak perusahaan di bawah Google, yang masing-masing berfokus pada inovasi di berbagai bidang teknologi.', NULL, 0, '2025-05-16 09:48:41', NULL);
INSERT INTO `companies` VALUES (2, 'Google Venture', 'Google Ventures, sekarang dikenal sebagai GV, adalah sebuah perusahaan modal ventura yang didirikan oleh Bill Maris pada tahun 2009. GV adalah anak perusahaan dari Alphabet Inc., perusahaan induk dari Google.', 1, 0, '2025-05-16 09:48:44', NULL);
INSERT INTO `companies` VALUES (3, 'Calico', 'anak perusahaan Google yang bergerak di bidang kesehatan, fokusnya adalah pada isu serupa diatas seperti penuaan serta penyakit terkait proses penuaan yang terjadi pada manusia.', 1, 0, '2025-05-16 09:48:47', NULL);
INSERT INTO `companies` VALUES (4, 'Google X', 'Google X dikenal sebagai \"moonshot factory\" karena fokusnya pada proyek-proyek yang ambisius dan inovatif, yang dapat memiliki dampak besar pada masyarakat. Proyek-proyek ini seringkali melibatkan teknologi baru dan eksperimental', 1, 0, '2025-05-16 09:48:53', NULL);
INSERT INTO `companies` VALUES (5, 'Fiber', 'layanan internet yang diberi nama Google Fiber, memfasilitasi layanan internet yang cepat dan stabil.', 1, 0, '2025-05-16 09:48:55', NULL);
INSERT INTO `companies` VALUES (6, 'Google Capital', 'Google Capital adalah sebuah divisi investasi yang dimiliki oleh Google. Google Capital berinvestasi pada perusahaan-perusahaan yang memiliki potensi untuk tumbuh dan berkembang.', 1, 0, '2025-05-16 09:48:57', NULL);
INSERT INTO `companies` VALUES (7, 'Google', 'Google adalah sebuah perusahaan multinasional Amerika yang bergerak di bidang teknologi, terutama dalam pengembangan dan pemasaran layanan internet. Didirikan pada tahun 1998 oleh Larry Page dan Sergey Brin,', 1, 0, '2025-05-16 09:48:59', NULL);
INSERT INTO `companies` VALUES (8, 'Google Android', ' Android adalah sebuah sistem operasi untuk perangkat mobile yang dikembangkan oleh Google. Android pertama kali dirilis pada tahun 2008 dan sekarang menjadi salah satu sistem operasi mobile yang paling populer di dunia.', 7, 0, '2025-05-16 09:49:01', NULL);
INSERT INTO `companies` VALUES (9, 'Google Search', 'Google Search adalah mesin pencari yang paling populer di dunia. Mesin pencari ini memungkinkan pengguna untuk mencari informasi dan konten di internet dengan menggunakan kata kunci atau frasa.', 7, 0, '2025-05-16 09:49:04', NULL);
INSERT INTO `companies` VALUES (10, 'Google Apps', 'Google Play Store adalah sebuah toko aplikasi yang menawarkan berbagai aplikasi untuk perangkat Android. Pengguna dapat mengunduh dan menginstal aplikasi dari berbagai kategori, termasuk game, produktivitas, dan hiburan.', 7, 0, '2025-05-16 09:49:13', NULL);
INSERT INTO `companies` VALUES (11, 'Google Youtube', 'YouTube adalah sebuah platform video sharing yang dikembangkan oleh Google. YouTube memungkinkan pengguna untuk mengunggah, membagikan, dan menonton video dari seluruh dunia.', 7, 0, '2025-05-16 09:49:10', NULL);
INSERT INTO `companies` VALUES (12, 'Google Maps', ' Google Maps adalah sebuah layanan pemetaan yang memungkinkan pengguna untuk mencari lokasi, mendapatkan arahan, dan melihat peta dari seluruh dunia.', 7, 0, '2025-05-16 09:49:08', NULL);
INSERT INTO `companies` VALUES (13, 'Google Ads', 'Google Ads adalah sebuah platform periklanan yang memungkinkan bisnis untuk membuat dan menampilkan iklan di Google Search, YouTube, dan situs web lainnya. ', 7, 0, '2025-05-16 09:49:06', NULL);

-- ----------------------------
-- Table structure for company_defaults
-- ----------------------------
DROP TABLE IF EXISTS `company_defaults`;
CREATE TABLE `company_defaults`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `bank_account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `company_defaults_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `company_defaults_bank_account_id_foreign`(`bank_account_id` ASC) USING BTREE,
  INDEX `company_defaults_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `company_defaults_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `company_defaults_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `company_defaults_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `company_defaults_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `company_defaults_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company_defaults
-- ----------------------------

-- ----------------------------
-- Table structure for company_invitations
-- ----------------------------
DROP TABLE IF EXISTS `company_invitations`;
CREATE TABLE `company_invitations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `company_invitations_company_id_email_unique`(`company_id` ASC, `email` ASC) USING BTREE,
  CONSTRAINT `company_invitations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company_invitations
-- ----------------------------

-- ----------------------------
-- Table structure for company_profiles
-- ----------------------------
DROP TABLE IF EXISTS `company_profiles`;
CREATE TABLE `company_profiles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tax_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `entity_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `company_profiles_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `company_profiles_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `company_profiles_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `company_profiles_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `company_profiles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `company_profiles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company_profiles
-- ----------------------------

-- ----------------------------
-- Table structure for company_user
-- ----------------------------
DROP TABLE IF EXISTS `company_user`;
CREATE TABLE `company_user`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `contact_id` bigint UNSIGNED NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `employment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `hire_date` date NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `department_id` bigint UNSIGNED NULL DEFAULT NULL,
  `job_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_of_birth` date NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `marital_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `compensation_amount` bigint NULL DEFAULT NULL,
  `compensation_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `compensation_frequency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `education_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `field_of_study` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emergency_contact_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emergency_contact_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emergency_contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `company_user_company_id_user_id_unique`(`company_id` ASC, `user_id` ASC) USING BTREE,
  INDEX `company_user_contact_id_foreign`(`contact_id` ASC) USING BTREE,
  INDEX `company_user_department_id_foreign`(`department_id` ASC) USING BTREE,
  CONSTRAINT `company_user_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `company_user_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company_user
-- ----------------------------
INSERT INTO `company_user` VALUES (1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for connected_accounts
-- ----------------------------
DROP TABLE IF EXISTS `connected_accounts`;
CREATE TABLE `connected_accounts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `token` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `refresh_token` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `expires_at` datetime NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `connected_accounts_user_id_id_index`(`user_id` ASC, `id` ASC) USING BTREE,
  INDEX `connected_accounts_provider_provider_id_index`(`provider` ASC, `provider_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of connected_accounts
-- ----------------------------

-- ----------------------------
-- Table structure for connected_bank_accounts
-- ----------------------------
DROP TABLE IF EXISTS `connected_bank_accounts`;
CREATE TABLE `connected_bank_accounts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `institution_id` bigint UNSIGNED NULL DEFAULT NULL,
  `bank_account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `external_account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `access_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_balance` double NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mask` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'depository',
  `subtype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `import_transactions` tinyint(1) NOT NULL DEFAULT 0,
  `last_imported_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `connected_bank_accounts_identifier_unique`(`identifier` ASC) USING BTREE,
  INDEX `connected_bank_accounts_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `connected_bank_accounts_institution_id_foreign`(`institution_id` ASC) USING BTREE,
  INDEX `connected_bank_accounts_bank_account_id_foreign`(`bank_account_id` ASC) USING BTREE,
  INDEX `connected_bank_accounts_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `connected_bank_accounts_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `connected_bank_accounts_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `connected_bank_accounts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `connected_bank_accounts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `connected_bank_accounts_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `connected_bank_accounts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of connected_bank_accounts
-- ----------------------------

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phones` json NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `contactable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactable_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `contacts_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `contacts_contactable_type_contactable_id_index`(`contactable_type` ASC, `contactable_id` ASC) USING BTREE,
  INDEX `contacts_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `contacts_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `contacts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `contacts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contacts
-- ----------------------------

-- ----------------------------
-- Table structure for currencies
-- ----------------------------
DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` bigint NOT NULL DEFAULT 1,
  `precision` tinyint UNSIGNED NOT NULL DEFAULT 2,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `symbol_first` tinyint(1) NOT NULL DEFAULT 1,
  `decimal_mark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '.',
  `thousands_separator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `currencies_company_id_code_unique`(`company_id` ASC, `code` ASC) USING BTREE,
  INDEX `currencies_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `currencies_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  INDEX `currencies_code_index`(`code` ASC) USING BTREE,
  CONSTRAINT `currencies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `currencies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `currencies_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of currencies
-- ----------------------------

-- ----------------------------
-- Table structure for currency_lists
-- ----------------------------
DROP TABLE IF EXISTS `currency_lists`;
CREATE TABLE `currency_lists`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `available` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of currency_lists
-- ----------------------------

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `manager_id` bigint UNSIGNED NULL DEFAULT NULL,
  `parent_id` bigint UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `departments_company_id_name_unique`(`company_id` ASC, `name` ASC) USING BTREE,
  INDEX `departments_manager_id_foreign`(`manager_id` ASC) USING BTREE,
  INDEX `departments_parent_id_foreign`(`parent_id` ASC) USING BTREE,
  INDEX `departments_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `departments_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `departments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `departments_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `departments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `departments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 1, 1, NULL, 'Software Development', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (2, 1, 1, 1, 'Backend Development', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (3, 1, 1, 1, 'Frontend Development', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (4, 1, 1, 1, 'Mobile Development', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (5, 1, 92, 1, 'DevOps / Site Reliability Engineering (SRE)', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (6, 1, 1, 1, 'QA / Testing', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (7, 1, 1, NULL, 'Product Management', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (8, 1, 1, 7, 'Product Manager', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (9, 1, 1, 7, 'Product Owner', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (10, 1, 1, 7, 'UX/UI Designer', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (11, 1, 1, 7, 'Business Analyst', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (12, 1, 1, NULL, 'IT Infrastructure / Cloud / Network', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (13, 1, 1, NULL, 'Data & AI', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (14, 1, 1, 13, 'Data Engineering', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (15, 1, 1, 13, 'Data Science', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (16, 1, 1, 13, 'Machine Learning Engineering', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (17, 1, 1, 13, 'Business Intelligence / Data Analyst', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (18, 1, 1, NULL, 'Technical Support / Customer Success', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `departments` VALUES (19, 1, 1, NULL, 'Marketing', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for document_defaults
-- ----------------------------
DROP TABLE IF EXISTS `document_defaults`;
CREATE TABLE `document_defaults`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `show_logo` tinyint(1) NOT NULL DEFAULT 0,
  `number_prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'due_upon_receipt',
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subheader` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `accent_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `font` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `item_name` json NULL,
  `unit_name` json NULL,
  `price_name` json NULL,
  `amount_name` json NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `document_defaults_company_id_type_unique`(`company_id` ASC, `type` ASC) USING BTREE,
  INDEX `document_defaults_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `document_defaults_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `document_defaults_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `document_defaults_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `document_defaults_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document_defaults
-- ----------------------------

-- ----------------------------
-- Table structure for document_line_items
-- ----------------------------
DROP TABLE IF EXISTS `document_line_items`;
CREATE TABLE `document_line_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `documentable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint UNSIGNED NOT NULL,
  `offering_id` bigint UNSIGNED NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `quantity` decimal(10, 2) NOT NULL DEFAULT 1.00,
  `unit_price` bigint NOT NULL DEFAULT 0,
  `subtotal` bigint GENERATED ALWAYS AS ((`quantity` * `unit_price`)) STORED NULL,
  `total` bigint GENERATED ALWAYS AS ((((`quantity` * `unit_price`) + `tax_total`) - `discount_total`)) STORED NULL,
  `tax_total` bigint NOT NULL DEFAULT 0,
  `discount_total` bigint NOT NULL DEFAULT 0,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `document_line_items_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `document_line_items_documentable_type_documentable_id_index`(`documentable_type` ASC, `documentable_id` ASC) USING BTREE,
  INDEX `document_line_items_offering_id_foreign`(`offering_id` ASC) USING BTREE,
  INDEX `document_line_items_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `document_line_items_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `document_line_items_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `document_line_items_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `document_line_items_offering_id_foreign` FOREIGN KEY (`offering_id`) REFERENCES `offerings` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `document_line_items_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document_line_items
-- ----------------------------

-- ----------------------------
-- Table structure for estimates
-- ----------------------------
DROP TABLE IF EXISTS `estimates`;
CREATE TABLE `estimates`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subheader` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `estimate_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `reference_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `expiration_date` date NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `converted_at` timestamp NULL DEFAULT NULL,
  `declined_at` timestamp NULL DEFAULT NULL,
  `last_sent_at` timestamp NULL DEFAULT NULL,
  `last_viewed_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discount_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_line_item',
  `discount_computation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `discount_rate` bigint NOT NULL DEFAULT 0,
  `subtotal` bigint NOT NULL DEFAULT 0,
  `tax_total` bigint NOT NULL DEFAULT 0,
  `discount_total` bigint NOT NULL DEFAULT 0,
  `total` bigint NOT NULL DEFAULT 0,
  `terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `estimates_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `estimates_client_id_foreign`(`client_id` ASC) USING BTREE,
  INDEX `estimates_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `estimates_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `estimates_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `estimates_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `estimates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `estimates_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of estimates
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint UNSIGNED NOT NULL,
  `imageable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (1, 'https://unsplash.com/photos/white-and-blue-cloudy-sky-f5_lfi2S-d4', 1, '1', '2025-05-19 07:56:03', NULL);
INSERT INTO `images` VALUES (2, 'https://unsplash.com/photos/a-large-white-boat-floating-on-top-of-a-body-of-water-agEBTnS_Nuc', 2, '2', '2025-05-19 07:56:17', NULL);
INSERT INTO `images` VALUES (3, 'https://unsplash.com/photos/a-long-wooden-bridge-over-a-body-of-water-38-p-NVIWh8', 3, '3', '2025-05-19 07:56:36', NULL);

-- ----------------------------
-- Table structure for institutions
-- ----------------------------
DROP TABLE IF EXISTS `institutions`;
CREATE TABLE `institutions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `external_institution_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `institutions_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `institutions_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  INDEX `institutions_name_index`(`name` ASC) USING BTREE,
  CONSTRAINT `institutions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `institutions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of institutions
-- ----------------------------

-- ----------------------------
-- Table structure for invoices
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NULL DEFAULT NULL,
  `estimate_id` bigint UNSIGNED NULL DEFAULT NULL,
  `recurring_invoice_id` bigint UNSIGNED NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subheader` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `invoice_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `due_date` date NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `last_sent_at` timestamp NULL DEFAULT NULL,
  `last_viewed_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discount_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_line_item',
  `discount_computation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `discount_rate` bigint NOT NULL DEFAULT 0,
  `subtotal` bigint NOT NULL DEFAULT 0,
  `tax_total` bigint NOT NULL DEFAULT 0,
  `discount_total` bigint NOT NULL DEFAULT 0,
  `total` bigint NOT NULL DEFAULT 0,
  `amount_paid` bigint NOT NULL DEFAULT 0,
  `amount_due` bigint GENERATED ALWAYS AS ((`total` - `amount_paid`)) STORED NULL,
  `terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `invoices_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `invoices_client_id_foreign`(`client_id` ASC) USING BTREE,
  INDEX `invoices_estimate_id_foreign`(`estimate_id` ASC) USING BTREE,
  INDEX `invoices_recurring_invoice_id_foreign`(`recurring_invoice_id` ASC) USING BTREE,
  INDEX `invoices_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `invoices_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `invoices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `invoices_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `invoices_recurring_invoice_id_foreign` FOREIGN KEY (`recurring_invoice_id`) REFERENCES `recurring_invoices` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of invoices
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for journal_entries
-- ----------------------------
DROP TABLE IF EXISTS `journal_entries`;
CREATE TABLE `journal_entries`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `journal_entries_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `journal_entries_transaction_id_foreign`(`transaction_id` ASC) USING BTREE,
  INDEX `journal_entries_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `journal_entries_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  INDEX `journal_entries_account_id_type_index`(`account_id` ASC, `type` ASC) USING BTREE,
  INDEX `journal_entries_account_id_transaction_id_index`(`account_id` ASC, `transaction_id` ASC) USING BTREE,
  CONSTRAINT `journal_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `journal_entries_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `journal_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `journal_entries_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `journal_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of journal_entries
-- ----------------------------

-- ----------------------------
-- Table structure for localizations
-- ----------------------------
DROP TABLE IF EXISTS `localizations`;
CREATE TABLE `localizations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M j, Y',
  `time_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'g:i A',
  `fiscal_year_end_month` tinyint UNSIGNED NOT NULL DEFAULT 12,
  `fiscal_year_end_day` tinyint UNSIGNED NOT NULL DEFAULT 31,
  `week_start` tinyint UNSIGNED NOT NULL DEFAULT 1,
  `number_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comma_dot',
  `percent_first` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `localizations_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `localizations_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `localizations_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `localizations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `localizations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `localizations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of localizations
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NULL DEFAULT NULL,
  `sequence` int NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `menus_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `menus_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Cash Book', NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (2, 'Revenue', NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (3, 'Sales Revenue Reconciliation', 2, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (4, 'Expense', NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (5, 'Recurring Payment', 4, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (6, 'Partner ', 4, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (7, 'Account', NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (8, 'General Journal', 8, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (9, 'Trial Balance', 8, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (10, 'Adjustment Entry', 8, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (11, 'Trial Balance After Adjustment Entry', 8, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (12, 'Closing Entry', 8, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (13, 'Cost List', 4, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (14, 'Financial Report', NULL, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (15, 'Journal Report', 14, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (16, 'Balance Sheet', 14, NULL, NULL, NULL, NULL, NULL, 1);
INSERT INTO `menus` VALUES (17, 'Income Statement', 14, NULL, NULL, NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_05_21_100000_create_companies_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_05_21_200000_create_company_user_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_05_21_300000_create_company_invitations_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_12_22_000000_create_connected_accounts_table', 1);
INSERT INTO `migrations` VALUES (9, '2023_09_03_032820_create_currencies_table', 1);
INSERT INTO `migrations` VALUES (10, '2023_09_03_100000_create_accounting_tables', 1);
INSERT INTO `migrations` VALUES (11, '2023_09_08_040159_create_company_defaults_table', 1);
INSERT INTO `migrations` VALUES (12, '2023_09_12_032057_create_document_defaults_table', 1);
INSERT INTO `migrations` VALUES (13, '2023_09_14_034800_create_company_profiles_table', 1);
INSERT INTO `migrations` VALUES (14, '2023_09_19_000500_create_departments_table', 1);
INSERT INTO `migrations` VALUES (15, '2023_09_19_050544_create_contacts_table', 1);
INSERT INTO `migrations` VALUES (16, '2023_09_19_065547_modify_company_user_table', 1);
INSERT INTO `migrations` VALUES (17, '2023_10_11_210415_create_localizations_table', 1);
INSERT INTO `migrations` VALUES (18, '2023_11_18_041015_create_currency_lists_table', 1);
INSERT INTO `migrations` VALUES (19, '2024_01_01_234943_create_transactions_table', 1);
INSERT INTO `migrations` VALUES (20, '2024_01_11_062614_create_journal_entries_table', 1);
INSERT INTO `migrations` VALUES (21, '2024_10_13_163049_update_posted_at_column_in_transactions_table', 1);
INSERT INTO `migrations` VALUES (22, '2024_11_02_182328_add_inverse_cash_flow_to_account_subtypes_table', 1);
INSERT INTO `migrations` VALUES (23, '2024_11_13_214149_create_offerings_table', 1);
INSERT INTO `migrations` VALUES (24, '2024_11_13_214358_create_clients_table', 1);
INSERT INTO `migrations` VALUES (25, '2024_11_13_214406_create_vendors_table', 1);
INSERT INTO `migrations` VALUES (26, '2024_11_13_220301_create_document_line_items_table', 1);
INSERT INTO `migrations` VALUES (27, '2024_11_14_230753_create_adjustments_table', 1);
INSERT INTO `migrations` VALUES (28, '2024_11_15_225714_create_adjustmentables_table', 1);
INSERT INTO `migrations` VALUES (29, '2024_11_19_225812_create_addresses_table', 1);
INSERT INTO `migrations` VALUES (30, '2024_11_27_221657_create_bills_table', 1);
INSERT INTO `migrations` VALUES (31, '2024_11_27_223000_create_estimates_table', 1);
INSERT INTO `migrations` VALUES (32, '2024_11_27_223001_create_recurring_invoices_table', 1);
INSERT INTO `migrations` VALUES (33, '2024_11_27_223015_create_invoices_table', 1);
INSERT INTO `migrations` VALUES (34, '2025_03_31_005115_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (35, '2025_03_31_050856_create_products_table', 1);
INSERT INTO `migrations` VALUES (36, '2025_05_14_065901_create_posts_table', 2);
INSERT INTO `migrations` VALUES (37, '2025_05_14_070048_create_videos_table', 2);
INSERT INTO `migrations` VALUES (38, '2025_05_14_070206_create_comments_table', 2);
INSERT INTO `migrations` VALUES (39, '2025_05_16_061814_create_images_table', 3);
INSERT INTO `migrations` VALUES (40, '2025_05_16_061814_create_images1_table', 4);
INSERT INTO `migrations` VALUES (41, '2025_05_16_061814_create_images2_table', 5);
INSERT INTO `migrations` VALUES (42, '2024_11_13_214406_create_menus_table', 6);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `module_id` bigint UNSIGNED NOT NULL,
  `module_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_activated` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `modules_module_id_foreign`(`module_id` ASC) USING BTREE,
  INDEX `modules_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `modules_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `modules_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `modules_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES (1, 1, 'App\\Models\\Menu\\', 'Sales', NULL, NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for offerings
-- ----------------------------
DROP TABLE IF EXISTS `offerings`;
CREATE TABLE `offerings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price` int NOT NULL DEFAULT 0,
  `sellable` tinyint(1) NOT NULL DEFAULT 0,
  `purchasable` tinyint(1) NOT NULL DEFAULT 0,
  `income_account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `expense_account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `offerings_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `offerings_income_account_id_foreign`(`income_account_id` ASC) USING BTREE,
  INDEX `offerings_expense_account_id_foreign`(`expense_account_id` ASC) USING BTREE,
  INDEX `offerings_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `offerings_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  INDEX `offerings_name_index`(`name` ASC) USING BTREE,
  CONSTRAINT `offerings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `offerings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `offerings_expense_account_id_foreign` FOREIGN KEY (`expense_account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `offerings_income_account_id_foreign` FOREIGN KEY (`income_account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `offerings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of offerings
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (1, 'post1', 'content post1', '2025-05-14 14:08:25', NULL);
INSERT INTO `posts` VALUES (2, 'post2', 'content post2', '2025-05-14 14:08:39', NULL);
INSERT INTO `posts` VALUES (3, 'post3', 'content post2', '2025-05-14 14:08:54', NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_sold` tinyint(1) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'prod1-13', 'detail1', 0, '2025-04-16 03:42:27', '2025-04-21 06:03:04');
INSERT INTO `products` VALUES (2, 'pRod2', 'Det2', 0, '2025-04-16 03:45:03', '2025-04-16 03:45:03');
INSERT INTO `products` VALUES (3, 'Prod3', 'det3', 0, '2025-04-16 03:45:35', '2025-04-16 03:45:35');
INSERT INTO `products` VALUES (4, 'prOd4-5', 'det4', 1, '2025-04-16 03:46:07', '2025-04-21 06:06:25');
INSERT INTO `products` VALUES (5, 'prod5', 'det5', 1, '2025-04-16 04:09:15', '2025-04-16 04:09:15');
INSERT INTO `products` VALUES (6, 'proD6-5', 'det6', 0, '2025-04-16 04:09:38', '2025-04-16 04:39:53');
INSERT INTO `products` VALUES (7, 'prod6-1', 'det6', 0, '2025-04-16 04:23:29', '2025-04-16 04:23:29');
INSERT INTO `products` VALUES (8, 'Prod6-4', 'det6', 1, '2025-04-16 04:24:24', '2025-04-16 04:39:36');
INSERT INTO `products` VALUES (9, 'prod7', 'det prod7', 1, '2025-04-17 06:10:28', '2025-04-17 06:10:28');
INSERT INTO `products` VALUES (10, 'prod8', 'det prod8', 1, '2025-04-17 06:11:06', '2025-04-17 06:11:06');
INSERT INTO `products` VALUES (11, 'prod9', 'a', 1, '2025-04-17 06:53:15', '2025-04-17 06:54:43');
INSERT INTO `products` VALUES (13, 'dsfxcv', 'cvbcvb', 1, '2025-04-17 07:12:43', '2025-04-17 07:12:43');
INSERT INTO `products` VALUES (14, 'xcn', 'gfnf', 1, '2025-04-17 07:13:26', '2025-04-17 07:13:26');
INSERT INTO `products` VALUES (15, 'fdhgfd', 'hgjhg', 1, '2025-04-17 07:13:53', '2025-04-17 07:13:53');
INSERT INTO `products` VALUES (16, 'prod999', 'detail-prod999', NULL, '2025-04-28 02:56:18', '2025-04-28 02:56:18');

-- ----------------------------
-- Table structure for recurring_invoices
-- ----------------------------
DROP TABLE IF EXISTS `recurring_invoices`;
CREATE TABLE `recurring_invoices`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subheader` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'due_upon_receipt',
  `approved_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `frequency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `interval_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `interval_value` tinyint NULL DEFAULT NULL,
  `month` tinyint NULL DEFAULT NULL,
  `day_of_month` tinyint NULL DEFAULT NULL,
  `day_of_week` tinyint NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'never',
  `max_occurrences` smallint NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `occurrences_count` smallint NOT NULL DEFAULT 0,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UTC',
  `next_date` date NULL DEFAULT NULL,
  `last_date` date NULL DEFAULT NULL,
  `auto_send` tinyint(1) NOT NULL DEFAULT 0,
  `send_time` time NOT NULL DEFAULT '09:00:00',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discount_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_line_item',
  `discount_computation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `discount_rate` bigint NOT NULL DEFAULT 0,
  `subtotal` bigint NOT NULL DEFAULT 0,
  `tax_total` bigint NOT NULL DEFAULT 0,
  `discount_total` bigint NOT NULL DEFAULT 0,
  `total` bigint NOT NULL DEFAULT 0,
  `terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `recurring_invoices_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `recurring_invoices_client_id_foreign`(`client_id` ASC) USING BTREE,
  INDEX `recurring_invoices_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `recurring_invoices_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `recurring_invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `recurring_invoices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `recurring_invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `recurring_invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recurring_invoices
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('Dpefya9CJ6NJu3dVboYkg6so4zIQbSh6jlaw2oTC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmFBS1lPQXdmcGY3YXY3ZTFyWW9aS1R0SkdmOTlESFNDMnhhYjBVWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMS93YXJlaG91c2UvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747646358);

-- ----------------------------
-- Table structure for taggables
-- ----------------------------
DROP TABLE IF EXISTS `taggables`;
CREATE TABLE `taggables`  (
  `tag_id` bigint UNSIGNED NOT NULL,
  `taggable_id` bigint UNSIGNED NOT NULL,
  `taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  INDEX `taggables_tag_id_index`(`tag_id` ASC) USING BTREE,
  INDEX `taggables_taggable_id_taggable_type_index`(`taggable_id` ASC, `taggable_type` ASC) USING BTREE,
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of taggables
-- ----------------------------

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tags_name_unique`(`name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES (1, 'tags1', '2025-05-16 13:34:52', '2025-05-16 13:34:54');
INSERT INTO `tags` VALUES (2, 'tsgd2', '2025-05-16 13:35:01', '2025-05-16 13:35:03');

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `transactionable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `transactionable_id` bigint UNSIGNED NULL DEFAULT NULL,
  `account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `bank_account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `plaid_transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contact_id` bigint UNSIGNED NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_channel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_payment` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amount` bigint NOT NULL DEFAULT 0,
  `pending` tinyint(1) NOT NULL DEFAULT 0,
  `reviewed` tinyint(1) NOT NULL DEFAULT 0,
  `posted_at` date NOT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `transactions_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `transactions_transactionable_type_transactionable_id_index`(`transactionable_type` ASC, `transactionable_id` ASC) USING BTREE,
  INDEX `transactions_contact_id_foreign`(`contact_id` ASC) USING BTREE,
  INDEX `transactions_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `transactions_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  INDEX `transactions_account_id_posted_at_index`(`account_id` ASC, `posted_at` ASC) USING BTREE,
  INDEX `transactions_bank_account_id_posted_at_index`(`bank_account_id` ASC, `posted_at` ASC) USING BTREE,
  CONSTRAINT `transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `transactions_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `transactions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `transactions_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `transactions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_company_id` bigint UNSIGNED NULL DEFAULT NULL,
  `current_connected_account_id` bigint UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'name1', 'name1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-16 12:46:01', NULL);
INSERT INTO `users` VALUES (2, 'aslan2', 'aslan2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-16 12:46:14', NULL);
INSERT INTO `users` VALUES (3, 'Prof. Kacey Casper II', 'aubrey.ankunding@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '2xhhMoXDK2', NULL, NULL, NULL, '2025-05-16 04:06:58', '2025-05-16 04:06:58');
INSERT INTO `users` VALUES (4, 'Mrs. Noemi Kunde II', 'aiden92@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'i9YgZbL6r3', NULL, NULL, NULL, '2025-05-16 04:06:58', '2025-05-16 04:06:58');
INSERT INTO `users` VALUES (5, 'Geovanny Gorczany', 'slowe@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'EvPzTGUDCn', NULL, NULL, NULL, '2025-05-16 04:06:58', '2025-05-16 04:06:58');
INSERT INTO `users` VALUES (6, 'Arthur Wiegand', 'volkman.lukas@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'BnknGbm5so', NULL, NULL, NULL, '2025-05-16 04:06:58', '2025-05-16 04:06:58');
INSERT INTO `users` VALUES (7, 'Prof. Filiberto Emard DDS', 'qhackett@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'S3mciDYgQ2', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (8, 'Richmond Hagenes', 'georgiana48@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '6Oaz1BUOIH', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (9, 'Vincenzo Turner DVM', 'lauryn.ratke@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'vgBS8tDYrG', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (10, 'Florida Rau', 'hackett.margot@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '02duZZkIbt', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (11, 'Miller Ebert', 'mazie.cole@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'wIkULzoTeS', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (12, 'Dr. Frederique Swift MD', 'hamill.maritza@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '9VQetSQavW', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (13, 'Gideon Kris', 'ruecker.audra@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'vdaH3IBaEV', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (14, 'Larissa Lebsack', 'stacey34@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '05bFjHY5Yx', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (15, 'Prof. Lenny Reichel', 'mae92@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'NCAOLtCQFR', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (16, 'Aubrey Pagac', 'jacobson.casey@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'Fwyfe0QTrA', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (17, 'Prof. Vicenta Buckridge', 'alana72@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'W9dx3I9S1K', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (18, 'Kieran Franecki', 'mcglynn.art@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'qxqDxmcnSD', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (19, 'Mrs. Adah Hermann', 'jaylin10@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '0BIumv4EDH', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (20, 'Miss Teagan Walter DVM', 'beer.jordy@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'QKb1w0shQD', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (21, 'Alfonzo McGlynn', 'ward.guadalupe@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'hofGAMbfki', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (22, 'Prof. Garnet Jacobson', 'vjakubowski@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'RpBTOn8F1a', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (23, 'Velma Cremin', 'prudence.jerde@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '7lrWaSkI0l', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (24, 'Prof. Dulce Huels Sr.', 'wilhelmine.koepp@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'BgqPV7tUrV', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (25, 'Tony Rodriguez DDS', 'hcronin@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'zgqYFiV8L8', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (26, 'Dr. Ryleigh Huel', 'mohr.imelda@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', '09cF6b2j1N', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (27, 'Gerardo Dare', 'patrick.witting@example.net', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 't7BbBmpWl8', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (28, 'Lera Collier', 'prudence97@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'Dyqe2SgShT', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (29, 'Bailee Breitenberg', 'thaddeus.boyer@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'ZnuymwjMAk', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (30, 'Katrina Stracke MD', 'braxton79@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'rssrCPQL8R', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (31, 'Marlin Watsica', 'nola.littel@example.com', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'ejtXj0eZvt', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (32, 'Tommie Schaden', 'chandler.reinger@example.org', '2025-05-16 04:06:58', '$2y$12$2DvkM9z3zM8RaAMpqXs2oOeuUxkkr3L5AzDoTpvXHkzXV1wIDZJ6W', 'i16CB0FXdZ', NULL, NULL, NULL, '2025-05-16 04:06:59', '2025-05-16 04:06:59');
INSERT INTO `users` VALUES (33, 'Gerard Wolff', 'aufderhar.naomi@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', '1CiuJJgQ8f', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (34, 'Prof. Margarette Hessel MD', 'mkutch@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'vQ69pvAkwY', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (35, 'Taryn Kozey', 'mariane.leannon@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'g6kypGSBxR', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (36, 'Myrtice Vandervort', 'kertzmann.garrick@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'oWLZLe1MTG', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (37, 'Edison Collins', 'gerald59@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'gjSknZeqc2', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (38, 'Danielle McCullough', 'iwill@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'QEqH5Zl516', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (39, 'Eugenia Lang', 'herman.daron@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'WsZs7Rrf5b', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (40, 'Alvena Kling', 'esmeralda83@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'VQIpeuLvAt', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (41, 'Okey Bechtelar', 'champlin.devon@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'zFwncyOzp0', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (42, 'Jackeline Baumbach', 'qbatz@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'ZrDEdcL1vc', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (43, 'Miss Destany Welch', 'corkery.adolfo@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'CMFdnPsf3E', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (44, 'Dr. Norbert Medhurst III', 'edgardo.hessel@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'BXeQj6EwTj', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (45, 'Bridie Spencer IV', 'sedrick53@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'x7Rc4C8KCm', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (46, 'Gust Hahn Jr.', 'oreilly.johnathon@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'DVNxOB0VjI', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (47, 'Orrin Kuhn', 'prunolfsdottir@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'tFcOfx1qyg', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (48, 'Miss Ebba Gleason II', 'callie.welch@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'MdWuX7eVLB', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (49, 'Quinton Weber', 'marcellus42@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', '8gax63XdtA', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (50, 'Jessyca Roberts', 'slynch@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'I8jEyYo3KS', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (51, 'Quincy Ondricka II', 'elwin.volkman@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', '2Y5RmYmBkW', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (52, 'Miracle Russel', 'mittie03@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'Q7LnqDSsXa', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (53, 'Callie Fadel', 'assunta79@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', '72FlfmHG7v', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (54, 'Estell Von I', 'jairo01@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'QjRLuAHxir', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (55, 'Dr. Julianne Witting', 'tiana03@example.net', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', '3BZO7o65lE', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (56, 'Deven Gulgowski DDS', 'littel.orval@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'AMqsiCbKYw', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (57, 'Dr. Luisa Lynch Sr.', 'bkling@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'BGdeK5iCGs', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (58, 'Beaulah Hackett', 'evan43@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'UVeiWAZBpb', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (59, 'Prof. Kelsie Grimes', 'ernie.cruickshank@example.org', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'xIkbxERB1C', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (60, 'Alessia Steuber DVM', 'darian21@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'qGiuZ0dATn', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (61, 'Abbey Nikolaus', 'cory.roberts@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'HH9zJ8Ef6p', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (62, 'Dr. Erica Huel', 'clesch@example.com', '2025-05-16 04:07:09', '$2y$12$dLiDFvJNm74p.Qu6JfDHcuSsuO2uJ4uS6g44E2sBlmJqJDxKbl5mm', 'ImVNiGItcV', NULL, NULL, NULL, '2025-05-16 04:07:09', '2025-05-16 04:07:09');
INSERT INTO `users` VALUES (63, 'Arne Veum', 'rogelio.okuneva@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'bXxnxOA6bV', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (64, 'Mr. Kristian Labadie', 'cjohnston@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'nNnob9yvzo', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (65, 'Josephine Reynolds', 'shackett@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'YzeTCEJXan', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (66, 'Prof. Mckenzie Stehr III', 'hconn@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'tG3CZImXqB', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (67, 'Shanel Sporer', 'mateo.torp@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'ANMdvWGLt4', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (68, 'Genevieve Sauer', 'melisa31@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', '9fIVx7oRd9', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (69, 'Jasen Romaguera', 'santino.mraz@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'zoNIet0Hoc', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (70, 'Oma Rath', 'jvandervort@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'awG23ob7IF', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (71, 'Lionel Greenholt', 'wtreutel@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'YQld2vFrEW', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (72, 'Cody Hudson', 'dena.towne@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'neZbV8bIPt', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (73, 'Kiera Collins', 'jackson68@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'I9viiO9fWW', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (74, 'Stuart Wilkinson', 'gia68@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'kGdx0hhWjX', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (75, 'Dr. Lucious Rempel MD', 'glennie.renner@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'DbUBzLq2T5', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (76, 'Dr. Jeremie Swift DVM', 'rpowlowski@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'B3yOTVgWoW', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (77, 'Nathanial Rau', 'darren44@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', '7EawtN7C89', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (78, 'John Lindgren', 'izieme@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', '13AG3ASU28', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (79, 'Prof. Fermin Nader I', 'larson.kari@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'ITz9myHUgg', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (80, 'Ms. Carmen Pagac', 'wsatterfield@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'vj6ZInSQL6', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (81, 'Verlie Heaney DDS', 'vanessa90@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', '0vC9N1h7Jm', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (82, 'Noble Roberts', 'lauryn33@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'jyGPvljPPh', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (83, 'Regan Carroll', 'jlynch@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'ATVn6HzQJ8', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (84, 'Mr. Justen Bayer', 'tdickens@example.com', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'fdlcw7QZSr', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (85, 'Kasey Ortiz', 'sylvia.breitenberg@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'BAuZiVvrOq', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (86, 'Mr. Cullen Turcotte PhD', 'akeem.boyer@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'DQF1I2XRAB', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (87, 'Eldon O\'Hara', 'tremblay.tommie@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'IznHfwS4SC', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (88, 'Mr. Raul Brown', 'douglas.aaliyah@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'DhNblf3JMc', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (89, 'Mrs. Isabel Ruecker Sr.', 'vergie51@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'lhG5XwhrYe', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (90, 'Leo Walsh', 'ohara.dedrick@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'yvgA0Bxbmu', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (91, 'Dr. Marianne Huels', 'enid26@example.org', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'PnRwzCKTHL', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');
INSERT INTO `users` VALUES (92, 'Ms. Marie Tremblay', 'senger.grace@example.net', '2025-05-16 04:07:11', '$2y$12$IlnNKdRwGk5qpXhLsi1cLOXbkm6fhGFvpm8nGqFkT1wE67fMgHeCa', 'HI9lfQa5j7', NULL, NULL, NULL, '2025-05-16 04:07:11', '2025-05-16 04:07:11');

-- ----------------------------
-- Table structure for vendors
-- ----------------------------
DROP TABLE IF EXISTS `vendors`;
CREATE TABLE `vendors`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contractor_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ssn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ein` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `vendors_company_id_foreign`(`company_id` ASC) USING BTREE,
  INDEX `vendors_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `vendors_updated_by_foreign`(`updated_by` ASC) USING BTREE,
  CONSTRAINT `vendors_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `vendors_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `vendors_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendors
-- ----------------------------

-- ----------------------------
-- Table structure for videos
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of videos
-- ----------------------------
INSERT INTO `videos` VALUES (1, 'videos1', 'dfgdfh', NULL, NULL);
INSERT INTO `videos` VALUES (2, 'videos2', 'dfhfgh', NULL, NULL);
INSERT INTO `videos` VALUES (3, 'videos3', 'dfgdfg', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
