-- --------------------------------------------------------
-- Host:                         203.146.127.133
-- Server version:               5.5.5-10.4.12-MariaDB-log - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table zkorn_template.ck_backend_menu
DROP TABLE IF EXISTS `ck_backend_menu`;
CREATE TABLE IF NOT EXISTS `ck_backend_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `ref` int(11) DEFAULT 0,
  `isActive` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Dumping data for table zkorn_template.ck_backend_menu: ~35 rows (approximately)
/*!40000 ALTER TABLE `ck_backend_menu` DISABLE KEYS */;
INSERT INTO `ck_backend_menu` (`id`, `name`, `icon`, `url`, `sort`, `ref`, `isActive`) VALUES
	(1, 'Frontend', 'bx bx-lock\r\n', 'backend/', NULL, 0, 'Y'),
	(3, 'Instagram', 'bx bx-lock\r\n', 'backend/instagram', NULL, 0, 'Y'),
	(4, 'Promotions\r\n', 'bx bx-lock\r\n', 'backend/promotion', NULL, 0, 'Y'),
	(6, 'Permission', 'bx bx-lock\r\n', 'backend/', NULL, 0, 'Y'),
	(7, 'Log', 'bx bx-lock\r\n', 'backend/', NULL, 0, 'Y'),
	(8, 'Account (ผู้ดูแลระบบ)', NULL, 'backend/permission/admin', NULL, 6, 'Y');
/*!40000 ALTER TABLE `ck_backend_menu` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_frontend_instagram
DROP TABLE IF EXISTS `ck_frontend_instagram`;
CREATE TABLE IF NOT EXISTS `ck_frontend_instagram` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(5) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `isActive` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_frontend_instagram: ~30 rows (approximately)
/*!40000 ALTER TABLE `ck_frontend_instagram` DISABLE KEYS */;
INSERT INTO `ck_frontend_instagram` (`id`, `locale_id`, `img`, `ext`, `url`, `sort`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:41:39', NULL),
	(4, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:41:52', NULL),
	(5, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:42:05', NULL),
	(6, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:42:19', NULL),
	(7, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:47:53', NULL),
	(8, 'en', NULL, NULL, NULL, 1, 'Y', NULL, '2020-05-21 15:52:45', NULL),
	(9, 'en', NULL, NULL, NULL, 2, 'Y', NULL, '2020-05-21 15:53:08', NULL),
	(10, 'en', NULL, NULL, NULL, 2, 'Y', NULL, '2020-05-21 15:52:24', NULL),
	(11, 'en', NULL, NULL, NULL, 2, 'Y', NULL, '2020-05-21 15:52:09', NULL),
	(12, 'en', NULL, NULL, NULL, 2, 'Y', NULL, '2020-05-21 15:51:42', NULL),
	(13, 'en', NULL, NULL, NULL, 2, 'Y', NULL, '2020-05-21 15:51:24', NULL),
	(14, 'en', NULL, NULL, NULL, 2, 'Y', NULL, '2020-05-21 15:51:08', NULL),
	(15, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:50:56', NULL),
	(16, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:50:44', NULL),
	(17, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:50:33', NULL),
	(18, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:50:19', NULL),
	(19, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:50:07', NULL),
	(20, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:49:52', NULL),
	(21, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:49:39', NULL),
	(22, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:49:20', NULL),
	(23, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:48:53', NULL),
	(24, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:48:30', NULL),
	(25, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:48:18', NULL),
	(26, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:42:35', NULL),
	(27, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:42:51', NULL),
	(28, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:43:08', NULL),
	(29, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:43:28', NULL),
	(30, 'en', NULL, NULL, NULL, NULL, 'Y', NULL, '2020-05-21 15:47:08', NULL);
/*!40000 ALTER TABLE `ck_frontend_instagram` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_frontend_label_slide
DROP TABLE IF EXISTS `ck_frontend_label_slide`;
CREATE TABLE IF NOT EXISTS `ck_frontend_label_slide` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(5) DEFAULT NULL,
  `name_en` varchar(150) DEFAULT NULL,
  `name_locale` varchar(150) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `isActive` enum('Y','N') CHARACTER SET latin1 DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_frontend_label_slide: ~0 rows (approximately)
/*!40000 ALTER TABLE `ck_frontend_label_slide` DISABLE KEYS */;
INSERT INTO `ck_frontend_label_slide` (`id`, `locale_id`, `name_en`, `name_locale`, `sort`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'en', 'Free delivery on orders over THB 1,000.', 'จัดส่งฟรีเมื่อสั่งซื้อสินค้าครบ 1,000 บาท', 1, 'Y', '2020-05-24 07:32:40', '2020-05-24 07:33:18', NULL),
	(2, 'en', 'Free delivery on orders over THB 2,000.', 'ส่งฟรีเมื่อสั่งซื้อครบ 2,000 บาท', 2, 'Y', '2020-05-25 10:58:33', '2020-05-25 10:58:33', NULL);
/*!40000 ALTER TABLE `ck_frontend_label_slide` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_frontend_promotion
DROP TABLE IF EXISTS `ck_frontend_promotion`;
CREATE TABLE IF NOT EXISTS `ck_frontend_promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(2) DEFAULT NULL COMMENT 'อักษรย่อประเทศ',
  `slug` varchar(250) DEFAULT NULL COMMENT 'url name / about, terms',
  `title_en` varchar(255) DEFAULT NULL COMMENT '(ภาษาอังกฤษ) ',
  `title_locale` varchar(255) DEFAULT NULL COMMENT '(ภาษาตามประเทศ) ',
  `img` varchar(10) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `meta_keywords_en` varchar(255) DEFAULT NULL,
  `meta_keywords_locale` varchar(255) DEFAULT NULL,
  `meta_description_en` varchar(255) DEFAULT NULL,
  `meta_description_locale` varchar(255) DEFAULT NULL,
  `brief_en` text DEFAULT NULL,
  `brief_locale` text DEFAULT NULL,
  `body_en` longtext DEFAULT NULL,
  `body_locale` longtext DEFAULT NULL,
  `isActive` enum('Y','N') DEFAULT 'Y',
  `isLink` enum('Y','N') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_frontend_promotion: ~5 rows (approximately)
/*!40000 ALTER TABLE `ck_frontend_promotion` DISABLE KEYS */;
INSERT INTO `ck_frontend_promotion` (`id`, `locale_id`, `slug`, `title_en`, `title_locale`, `img`, `ext`, `meta_keywords_en`, `meta_keywords_locale`, `meta_description_en`, `meta_description_locale`, `brief_en`, `brief_locale`, `body_en`, `body_locale`, `isActive`, `isLink`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'en', 'test', 'test', 'เทส', NULL, NULL, 'test', 'เทส', 'test', 'เทส', '<p>PA&Ntilde;PURI extends the warmest birthday wishes with this special present.</p>', '<p>PA&Ntilde;PURI extends the warmest birthday wishes with this special present.</p>', '<p>test</p>', '<p>เทส</p>', 'Y', 'N', '2020-05-24 01:40:33', '2020-05-24 15:02:58', NULL),
	(2, 'en', 'www.test2.com', 'test2', 'เทส2', '00002', '.jpg', 'test2', 'เทส2', 'test2', 'เทส2', '<p>PA&Ntilde;PURI extends the warmest birthday wishes with this special present.</p>', '<p>PA&Ntilde;PURI extends the warmest birthday wishes with this special present.</p>', '<p>test2</p>', '<p>เทส2</p>', 'Y', 'Y', '2020-05-24 01:50:24', '2020-06-01 11:31:23', NULL),
	(3, 'en', 'www.test3.com', 'test3', 'เทส3', '00003', '.jpg', 'test3', 'เทส3', 'test3', 'เทส3', '<p>PA&Ntilde;PURI extends the warmest birthday wishes with this special present.</p>', '<p>PA&Ntilde;PURI extends the warmest birthday wishes with this special present.</p>', '<p>test3</p>', '<p>เทส3</p>', 'Y', 'Y', '2020-05-24 01:51:40', '2020-06-01 11:31:07', NULL);
/*!40000 ALTER TABLE `ck_frontend_promotion` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_locale
DROP TABLE IF EXISTS `ck_locale`;
CREATE TABLE IF NOT EXISTS `ck_locale` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '(PK) ID ประเทศ',
  `locale` varchar(5) DEFAULT '0' COMMENT 'อักษรย่อประเทศ',
  `name` varchar(255) DEFAULT NULL COMMENT 'ชื่อประเทศ (ภาษาอังกฤษ) ',
  `isActive` enum('Y','N') DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_locale: ~6 rows (approximately)
/*!40000 ALTER TABLE `ck_locale` DISABLE KEYS */;
INSERT INTO `ck_locale` (`id`, `locale`, `name`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'en', 'USA/EN/Global', 'Y', NULL, NULL, NULL),
	(2, 'th', 'Thailand', 'Y', NULL, NULL, NULL),
	(3, 'jp', 'Japan', 'Y', NULL, NULL, NULL),
	(4, 'fr', 'Franch', 'Y', NULL, NULL, NULL),
	(5, 'kr', 'Korea', 'Y', NULL, NULL, NULL),
	(6, 'ch', 'China', 'Y', NULL, NULL, NULL);
/*!40000 ALTER TABLE `ck_locale` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_order
DROP TABLE IF EXISTS `ck_order`;
CREATE TABLE IF NOT EXISTS `ck_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(2) DEFAULT NULL COMMENT 'อักษรย่อประเทศ',
  `customer_id` int(11) DEFAULT NULL,
  `no` varchar(255) DEFAULT NULL COMMENT 'รหัสการสั่งซื้อ',
  `date` date DEFAULT NULL COMMENT 'วันสั่งซื้อ',
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `ck_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `ck_order` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_order_item
DROP TABLE IF EXISTS `ck_order_item`;
CREATE TABLE IF NOT EXISTS `ck_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_size_id` int(11) DEFAULT NULL,
  `price_normal` double DEFAULT NULL COMMENT 'ราคาปกติ/ชิ้น(บาท) EX : 95',
  `price_sale` double DEFAULT NULL COMMENT 'ราคาขาย/ชิ้น(บาท) EX : 81',
  `quantity` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL COMMENT 'price*quantity',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_order_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `ck_order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `ck_order_item` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_page
DROP TABLE IF EXISTS `ck_page`;
CREATE TABLE IF NOT EXISTS `ck_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(2) DEFAULT NULL COMMENT 'อักษรย่อประเทศ',
  `slug` varchar(100) DEFAULT NULL COMMENT 'url name / about, terms',
  `images` varchar(100) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL COMMENT '(ภาษาอังกฤษ) ',
  `title_locale` varchar(255) DEFAULT NULL COMMENT '(ภาษาตามประเทศ) ',
  `meta_keywords_en` varchar(255) DEFAULT NULL,
  `meta_keywords_locale` varchar(255) DEFAULT NULL,
  `meta_description_en` varchar(255) DEFAULT NULL,
  `meta_description_locale` varchar(255) DEFAULT NULL,
  `body_en` longtext DEFAULT NULL,
  `body_locale` longtext DEFAULT NULL,
  `isActive` enum('Y','N') DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table zkorn_template.ck_page: ~2 rows (approximately)
/*!40000 ALTER TABLE `ck_page` DISABLE KEYS */;
INSERT INTO `ck_page` (`id`, `locale_id`, `slug`, `images`, `title_en`, `title_locale`, `meta_keywords_en`, `meta_keywords_locale`, `meta_description_en`, `meta_description_locale`, `body_en`, `body_locale`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'en', '1', NULL, '2e', NULL, '3e', NULL, '4e', NULL, '5e', NULL, 'Y', '2020-05-21 08:06:34', '2020-05-21 08:07:10', NULL),
	(2, 'en', '2', NULL, '2', NULL, '2', NULL, '2', NULL, '2', NULL, 'Y', '2020-05-21 08:14:32', '2020-05-21 08:14:32', NULL);
/*!40000 ALTER TABLE `ck_page` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_users_admin
DROP TABLE IF EXISTS `ck_users_admin`;
CREATE TABLE IF NOT EXISTS `ck_users_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT 'en' COMMENT 'อักษรย่อประเทศ',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table zkorn_template.ck_users_admin: ~3 rows (approximately)
/*!40000 ALTER TABLE `ck_users_admin` DISABLE KEYS */;
INSERT INTO `ck_users_admin` (`id`, `locale_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'Kron', 'chinakron@orange-thailand.com', NULL, '$2y$10$22JKhA9QsBvGe7oCtNQk8.u8I/c1yCaX299itxg8Ho7KDjwysAari', NULL, 'Y', NULL, '2020-05-18 03:49:48', NULL),
	(2, NULL, 'Sysop', 'sysop@orange-thailand.com', NULL, '$2y$10$iAUMa9KrIs5eNIaw8uN3QuiAqiaNNYdclpwZMpyiLDgGOtUVTJRjm', NULL, 'Y', NULL, '2020-05-17 23:24:37', NULL),
	(3, 'en', 'Admin', 'admin@orange-thailand.com', NULL, '$2y$10$iAUMa9KrIs5eNIaw8uN3QuiAqiaNNYdclpwZMpyiLDgGOtUVTJRjm', NULL, 'N', NULL, '2020-06-01 11:05:29', NULL);
/*!40000 ALTER TABLE `ck_users_admin` ENABLE KEYS */;


-- Dumping structure for table zkorn_template.ck_users_customer
DROP TABLE IF EXISTS `ck_users_customer`;
CREATE TABLE IF NOT EXISTS `ck_users_customer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `locale_id` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อักษรย่อประเทศ',
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('M','F') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` int(11) DEFAULT NULL COMMENT 'วันเกิด',
  `birth_month` int(11) DEFAULT NULL COMMENT 'เดือนเกิด',
  `birth_year` int(11) DEFAULT NULL COMMENT 'ปีเกิด',
  `nationality` int(11) DEFAULT NULL COMMENT 'สัญชาติ',
  `tel` int(11) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `provider` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zkorn_template.ck_users_customer: ~2 rows (approximately)
/*!40000 ALTER TABLE `ck_users_customer` DISABLE KEYS */;
INSERT INTO `ck_users_customer` (`id`, `locale_id`, `firstname`, `lastname`, `gender`, `birth_date`, `birth_month`, `birth_year`, `nationality`, `tel`, `email`, `email_verified_at`, `password`, `remember_token`, `isActive`, `provider`, `provider_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'en', 'User', 'Last', 'M', 0, 0, 0, 0, 0, 'user@orange-thailand.com', NULL, '$2y$10$iAUMa9KrIs5eNIaw8uN3QuiAqiaNNYdclpwZMpyiLDgGOtUVTJRjm', NULL, 'Y', NULL, NULL, NULL, NULL, NULL),
	(19, 'en', 'test', 'test', 'M', 1, 1, 2020, 1, 869099122, 'test@gmail.com', NULL, '$2y$10$dCDn5UGcVI9M3XWvaFBdz.4ysWaKBcFmZVpu6s4S8yUihMG2T1VUm', NULL, 'Y', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ck_users_customer` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
