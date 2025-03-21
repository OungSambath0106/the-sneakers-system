/*
 Navicat Premium Dump SQL

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80300 (8.3.0)
 Source Host           : localhost:3306
 Source Schema         : the_sneaker_shop

 Target Server Type    : MySQL
 Target Server Version : 80300 (8.3.0)
 File Encoding         : 65001

 Date: 21/03/2025 20:50:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for baners
-- ----------------------------
DROP TABLE IF EXISTS `baners`;
CREATE TABLE `baners`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of baners
-- ----------------------------
INSERT INTO `baners` VALUES (3, 'Banner 1', '2025-03-07-67c9e2050b60f.webp', 1, 1, '2025-01-20 10:44:27', '2025-03-07 00:57:36');
INSERT INTO `baners` VALUES (4, 'Banner 2', '2025-03-07-67c9e3561cb75.webp', 1, 1, '2025-01-20 10:44:39', '2025-03-07 01:03:05');
INSERT INTO `baners` VALUES (5, 'Banner 3', '2025-03-07-67c9e372617da.webp', 1, 1, '2025-01-20 10:44:48', '2025-03-07 01:03:32');

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES (5, 'Vans', '2025-01-24-67939427b6c4b.png', 1, 1, '2024-11-09 07:03:41', '2025-02-28 13:36:08');
INSERT INTO `brands` VALUES (6, 'Nike', '2025-01-24-6793943b4e998.png', 1, 1, '2025-01-24 13:23:07', '2025-02-28 13:37:43');
INSERT INTO `brands` VALUES (7, 'Adidas', '2025-03-01-67c30a1c48535.png', 1, 1, '2025-01-24 13:23:47', '2025-03-01 20:22:36');
INSERT INTO `brands` VALUES (8, 'PUMA', '2025-01-24-679394da9845f.png', 1, 1, '2025-01-24 13:25:46', '2025-02-28 13:37:51');
INSERT INTO `brands` VALUES (9, 'New Balance', '2025-01-24-679395166b1e2.png', 1, 1, '2025-01-24 13:26:46', '2025-02-20 20:42:35');
INSERT INTO `brands` VALUES (10, 'The North Face', '2025-01-24-6793953bec5b8.png', 1, 1, '2025-01-24 13:27:23', '2025-02-28 13:47:50');
INSERT INTO `brands` VALUES (11, 'Converse', '2025-01-24-679395542d53f.png', 1, 1, '2025-01-24 13:27:48', '2025-01-24 13:27:48');
INSERT INTO `brands` VALUES (12, 'Columbia', '2025-01-24-67939566a56c8.png', 1, 1, '2025-01-24 13:28:06', '2025-01-24 13:28:06');
INSERT INTO `brands` VALUES (13, 'Umbro', '2025-01-24-6793957080080.png', 1, 1, '2025-01-24 13:28:16', '2025-02-28 13:47:50');
INSERT INTO `brands` VALUES (14, 'Reebok', '2025-01-24-6793958009af7.png', 1, 1, '2025-01-24 13:28:32', '2025-01-24 13:28:32');
INSERT INTO `brands` VALUES (15, 'Under Armour', '2025-01-24-679395a384ed5.png', 1, 1, '2025-01-24 13:29:07', '2025-01-24 13:29:07');
INSERT INTO `brands` VALUES (16, 'Sketchers', '2025-01-24-679395bdacca3.png', 1, 1, '2025-01-24 13:29:33', '2025-01-31 20:01:48');
INSERT INTO `brands` VALUES (17, 'GUCCI', '2025-01-24-679395d200037.png', 1, 1, '2025-01-24 13:29:54', '2025-02-27 16:53:37');
INSERT INTO `brands` VALUES (18, 'Louis Vuitton', '2025-01-24-6793960bb6e55.png', 1, 1, '2025-01-24 13:30:51', '2025-02-27 16:51:46');

-- ----------------------------
-- Table structure for business_settings
-- ----------------------------
DROP TABLE IF EXISTS `business_settings`;
CREATE TABLE `business_settings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of business_settings
-- ----------------------------
INSERT INTO `business_settings` VALUES (1, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true},{\"id\":2,\"name\":\"Khmer\",\"direction\":\"ltr\",\"code\":\"kh\",\"status\":1,\"default\":false}]', NULL, '2024-11-12 20:05:44');
INSERT INTO `business_settings` VALUES (2, 'pnc_language', '[\"en\",\"kh\"]', NULL, NULL);
INSERT INTO `business_settings` VALUES (3, 'company_name', 'THE SNEAKER STORE', '2024-01-31 04:37:49', '2024-11-28 13:13:51');
INSERT INTO `business_settings` VALUES (4, 'phone', '+855 10 679 106', '2024-01-31 04:37:49', '2024-08-06 09:18:14');
INSERT INTO `business_settings` VALUES (5, 'email', 'thesneaker@gmail.com', '2024-01-31 04:37:49', '2024-11-09 13:06:26');
INSERT INTO `business_settings` VALUES (6, 'company_address', 'Siem Reap, Cambodia', '2024-01-31 04:37:49', '2024-08-24 10:19:58');
INSERT INTO `business_settings` VALUES (7, 'copy_right_text', '© Copyright 2024 by The Sneaker Store', '2024-01-31 04:37:49', '2024-11-09 13:06:26');
INSERT INTO `business_settings` VALUES (14, 'timezone', 'Asia/Ho_Chi_Minh', '2024-01-31 04:37:49', '2024-01-31 04:37:49');
INSERT INTO `business_settings` VALUES (15, 'currency', 'USD', '2024-01-31 04:37:49', '2024-01-31 04:37:49');
INSERT INTO `business_settings` VALUES (16, 'social_media', '[{\"title\":\"Facebook\",\"link\":null,\"icon\":\"2024-08-13-66bb14f6eec53.png\",\"status\":1},{\"title\":\"Instagram\",\"link\":null,\"icon\":\"2024-08-07-66b31f241528c.png\",\"status\":1},{\"title\":\"Twitter\",\"link\":null,\"icon\":\"2024-08-07-66b31f2415888.png\",\"status\":1},{\"title\":\"Youtube\",\"link\":null,\"icon\":\"2024-08-07-66b31f2415df8.png\",\"status\":1},{\"title\":\"Linkedin\",\"link\":null,\"icon\":\"2024-08-07-66b31f24208ec.png\",\"status\":1}]', '2024-01-31 04:37:49', '2024-08-24 10:19:58');
INSERT INTO `business_settings` VALUES (17, 'web_header_logo', '2024-08-22-66c6e933675e8.png', '2024-02-06 04:06:10', '2024-08-22 14:30:59');
INSERT INTO `business_settings` VALUES (19, 'fav_icon', '2024-08-22-66c6e9336b3a0.png', '2024-02-06 04:06:10', '2024-08-22 14:30:59');
INSERT INTO `business_settings` VALUES (20, 'link_google_map', NULL, '2024-02-06 04:34:36', '2024-08-24 10:19:58');
INSERT INTO `business_settings` VALUES (23, 'company_description', '<span data-metadata=\"<!--(figmeta)eyJmaWxlS2V5IjoiTUppTWdaNnF3VGl2TnBmMER2Y2QzdiIsInBhc3RlSUQiOjIwNDU4MTY1MjUsImRhdGFUeXBlIjoic2NlbmUifQo=(/figmeta)-->\"></span><br>', '2024-02-06 06:32:52', '2024-08-24 10:19:58');
INSERT INTO `business_settings` VALUES (45, 'payment', '[{\"title\":\"Visa\",\"icon\":\"2024-08-10-66b7143a7955f.png\",\"status\":1},{\"title\":\"master\",\"icon\":\"2024-08-10-66b719b20d105.png\",\"status\":1}]', '2024-08-10 14:16:11', '2024-11-28 10:46:38');
INSERT INTO `business_settings` VALUES (46, 'contact', '[{\"title\":\"+855 10 679 106\",\"link\":null,\"icon\":\"2024-08-21-66c58690b27be.png\",\"status\":1},{\"title\":\"+855 10 679 106\",\"link\":null,\"icon\":\"2024-08-21-66c58690ba09a.png\",\"status\":1}]', '2024-08-11 13:14:51', '2024-12-08 15:44:07');
INSERT INTO `business_settings` VALUES (49, 'slider_title', NULL, '2024-12-08 15:43:54', '2024-12-08 15:43:54');
INSERT INTO `business_settings` VALUES (50, 'slider_description', NULL, '2024-12-08 15:43:54', '2024-12-08 15:43:54');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `timezone` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `customers_api_token_unique`(`api_token` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Thon', 'Sotheavann', 'female', '022 333 444', 'sotheavann@gmail.com', '$10$3pqP3Us2mVcWsdgfY8l1..WTkIhMpDhmOHMjpe1GOsuAi6NpJmmI2', '2025-02-18-67b4ba4e3e364.png', 1, NULL, NULL, '2025-01-26 16:06:42', '2025-02-18 23:50:23', NULL, NULL, NULL, NULL);
INSERT INTO `customers` VALUES (3, 'China', 'Ing', 'male', '098 765 432', 'china@gmail.com', '$2y$10$uSrEOf/FtEQNBdiAeIzJWOTAs3qDyQOJ3Z5JkB95tiov./9GNPjKu', '2025-02-18-67b4b634c0c93.png', 0, NULL, NULL, '2025-02-18 23:32:55', '2025-02-18 23:33:02', NULL, NULL, NULL, NULL);
INSERT INTO `customers` VALUES (12, 'Chea', 'Ichigo', 'male', '010 679 106', 'chea@gmail.com', '$2y$10$wCGwdgytOXJQFcpLjfdFgujZmWyK7/MGnhPikSnjrE1vkhz1OiwD6', NULL, 1, NULL, NULL, '2025-03-21 20:18:00', '2025-03-21 20:18:00', 'XNzW6QW1Dwz1wEG4tXBXWgNvnGUDLHJuWW2UxgjTwU0QYPvcbqJGG1mAMQyBetu6', '2025-03-21 20:18:00', 'en', 'Asia/Bangkok');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 142 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_12_15_232210_create_business_settings_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_12_17_083144_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (7, '2022_12_19_054410_create_products_table', 1);
INSERT INTO `migrations` VALUES (8, '2023_08_25_092523_create_translations_table', 1);
INSERT INTO `migrations` VALUES (9, '2023_08_26_035115_add_some_column_to_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2023_08_28_112457_create_categories_table', 1);
INSERT INTO `migrations` VALUES (11, '2023_08_29_144037_add_columns_to_products_table', 1);
INSERT INTO `migrations` VALUES (12, '2023_08_30_140724_add_column_user_id_to_users_table', 1);
INSERT INTO `migrations` VALUES (13, '2024_01_31_132916_create_menus_table', 2);
INSERT INTO `migrations` VALUES (14, '2024_01_31_144511_create_sliders_table', 3);
INSERT INTO `migrations` VALUES (19, '2024_02_01_085241_create_rooms_table', 5);
INSERT INTO `migrations` VALUES (21, '2024_02_01_130123_create_galleries_table', 6);
INSERT INTO `migrations` VALUES (24, '2024_02_01_143446_create_home_stay_amenities_table', 7);
INSERT INTO `migrations` VALUES (25, '2024_02_01_091400_create_home_stay_galleries_table', 8);
INSERT INTO `migrations` VALUES (27, '2024_02_02_155704_create_rate_plans_table', 9);
INSERT INTO `migrations` VALUES (28, '2024_02_04_163121_create_services_table', 10);
INSERT INTO `migrations` VALUES (29, '2024_02_04_164435_create_service_galleries_table', 10);
INSERT INTO `migrations` VALUES (30, '2024_02_01_103934_create_blog_categories_table', 11);
INSERT INTO `migrations` VALUES (31, '2024_02_01_162910_create_blog_tags_table', 11);
INSERT INTO `migrations` VALUES (32, '2024_02_03_133205_create_facilities_table', 11);
INSERT INTO `migrations` VALUES (33, '2024_02_05_105401_create_blogs_table', 11);
INSERT INTO `migrations` VALUES (34, '2024_02_05_153903_create_menu_explores_table', 12);
INSERT INTO `migrations` VALUES (35, '2024_02_06_085552_create_customers_table', 13);
INSERT INTO `migrations` VALUES (39, '2024_02_06_160452_create_comments_table', 14);
INSERT INTO `migrations` VALUES (41, '2024_02_07_104601_add_columns_menu_url_to_menus_table', 15);
INSERT INTO `migrations` VALUES (42, '2024_02_07_104719_add_columns_menu_url_to_menu_explores_table', 15);
INSERT INTO `migrations` VALUES (43, '2024_02_07_102508_create_extra_services_table', 16);
INSERT INTO `migrations` VALUES (44, '2024_02_05_134456_create_facilities_table', 17);
INSERT INTO `migrations` VALUES (45, '2024_02_08_105218_create_room_dates_table', 17);
INSERT INTO `migrations` VALUES (46, '2024_02_09_091120_add_column_price_table', 17);
INSERT INTO `migrations` VALUES (47, '2024_02_10_093614_create_transactions_table', 17);
INSERT INTO `migrations` VALUES (48, '2024_02_10_143338_add_column_type_to_room_dates_table', 17);
INSERT INTO `migrations` VALUES (49, '2024_02_12_141641_edit_columns_in_room_dates_table', 17);
INSERT INTO `migrations` VALUES (50, '2024_02_12_153516_add_column_number_to_rooms_table', 17);
INSERT INTO `migrations` VALUES (51, '2024_02_13_090938_add_amenities_to_rooms_table', 17);
INSERT INTO `migrations` VALUES (52, '2024_02_13_120006_add_more_column_to_rooms_table', 17);
INSERT INTO `migrations` VALUES (53, '2024_02_13_144521_add_soft_delete_to_transactions_table', 17);
INSERT INTO `migrations` VALUES (54, '2024_02_13_162125_add_start_date_and_end_date_to_transactions_table', 17);
INSERT INTO `migrations` VALUES (55, '2024_02_14_100126_add_column_admin_id_to_table_comment', 18);
INSERT INTO `migrations` VALUES (56, '2024_02_14_103157_create_contact_us_table', 18);
INSERT INTO `migrations` VALUES (57, '2024_02_16_091636_add_column_to_table_rooms', 18);
INSERT INTO `migrations` VALUES (58, '2024_02_17_165149_add_fiels_to_customer_table', 19);
INSERT INTO `migrations` VALUES (59, '2024_02_19_135224_add_columns_to_transactions_table', 19);
INSERT INTO `migrations` VALUES (60, '2024_02_20_092033_add_customer_id_to_transactions_table', 19);
INSERT INTO `migrations` VALUES (61, '2024_02_24_110033_create_notifications_table', 20);
INSERT INTO `migrations` VALUES (62, '2024_02_24_160816_add_is_send_date_to_notifications_table', 21);
INSERT INTO `migrations` VALUES (63, '2024_02_24_170747_add_blog_id_to_comments_table', 22);
INSERT INTO `migrations` VALUES (64, '2024_02_25_194629_change_columns_in_sliders_table', 22);
INSERT INTO `migrations` VALUES (65, '2024_03_27_084453_create_pages_table', 22);
INSERT INTO `migrations` VALUES (66, '2024_03_27_084704_create_section_titles_table', 22);
INSERT INTO `migrations` VALUES (67, '2024_04_01_101605_add_column_des_to_table_galleries', 23);
INSERT INTO `migrations` VALUES (68, '2024_04_01_101845_add_column_status_to_table_comments', 23);
INSERT INTO `migrations` VALUES (69, '2024_05_08_145345_add_3_column_to_table_room', 24);
INSERT INTO `migrations` VALUES (70, '2024_05_09_085247_add_column_type_to_slider', 25);
INSERT INTO `migrations` VALUES (72, '2024_08_07_152808_add_thumbnail_to_facilities_table', 26);
INSERT INTO `migrations` VALUES (73, '2024_08_08_090757_add_some_column_to_rooms_table', 27);
INSERT INTO `migrations` VALUES (74, '2024_08_08_113008_create_staycations_table', 28);
INSERT INTO `migrations` VALUES (75, '2024_08_08_115418_add_amenities_to_staycations_table', 29);
INSERT INTO `migrations` VALUES (76, '2024_08_08_130239_add_some_column_to_staycations_table', 30);
INSERT INTO `migrations` VALUES (77, '2024_08_08_162324_create_highlights_table', 31);
INSERT INTO `migrations` VALUES (78, '2024_08_12_122704_add_price_to_rooms_table', 32);
INSERT INTO `migrations` VALUES (79, '2024_08_14_094310_add_icon_to_highlights_table', 33);
INSERT INTO `migrations` VALUES (80, '2024_08_19_105334_add_category_id_to_galleries_table', 34);
INSERT INTO `migrations` VALUES (81, '2024_08_20_101051_create_gallery_categories_table', 35);
INSERT INTO `migrations` VALUES (89, '2024_11_09_200925_add_some_to_products_table', 39);
INSERT INTO `migrations` VALUES (96, '2024_11_13_163719_add_images_to_products_table', 46);
INSERT INTO `migrations` VALUES (99, '2024_11_29_115432_create_customers_table', 49);
INSERT INTO `migrations` VALUES (104, '2025_01_05_155550_create_transactions_table', 54);
INSERT INTO `migrations` VALUES (105, '2025_01_08_102407_add_status_to_transactions_table', 55);
INSERT INTO `migrations` VALUES (106, '2025_01_08_103548_add_payment_method_to_transactions_table', 56);
INSERT INTO `migrations` VALUES (107, '2025_01_08_105405_add_delivery_to_transactions_table', 57);
INSERT INTO `migrations` VALUES (110, '2025_01_19_140346_create_shoessliders_table', 58);
INSERT INTO `migrations` VALUES (112, '2016_06_01_000001_create_oauth_auth_codes_table', 59);
INSERT INTO `migrations` VALUES (113, '2016_06_01_000002_create_oauth_access_tokens_table', 59);
INSERT INTO `migrations` VALUES (114, '2016_06_01_000003_create_oauth_refresh_tokens_table', 59);
INSERT INTO `migrations` VALUES (115, '2016_06_01_000004_create_oauth_clients_table', 59);
INSERT INTO `migrations` VALUES (116, '2016_06_01_000005_create_oauth_personal_access_clients_table', 59);
INSERT INTO `migrations` VALUES (117, '2024_07_29_113819_create_jobs_table', 59);
INSERT INTO `migrations` VALUES (118, '2024_11_09_133037_create_brands_table', 59);
INSERT INTO `migrations` VALUES (119, '2024_11_09_134511_create_products_table', 59);
INSERT INTO `migrations` VALUES (120, '2024_11_10_152744_add_some_column_to_promotions_table', 59);
INSERT INTO `migrations` VALUES (121, '2024_11_10_195031_add_column_product_to_products_table', 59);
INSERT INTO `migrations` VALUES (122, '2024_11_10_213047_create_promotion_product_table', 59);
INSERT INTO `migrations` VALUES (123, '2024_11_11_145306_add_status_to_products_table', 59);
INSERT INTO `migrations` VALUES (124, '2024_11_11_190735_add_column_to_promotions_table', 59);
INSERT INTO `migrations` VALUES (125, '2024_11_11_192232_create_promotion_brand_table', 59);
INSERT INTO `migrations` VALUES (126, '2024_11_23_195453_create_product_galleries_table', 59);
INSERT INTO `migrations` VALUES (127, '2024_11_28_101613_add_column_rating_to_products_table', 59);
INSERT INTO `migrations` VALUES (128, '2024_11_29_115928_create_customers_table', 59);
INSERT INTO `migrations` VALUES (129, '2024_11_30_101039_add_column_count_product_sale_to_products_table', 59);
INSERT INTO `migrations` VALUES (130, '2024_12_08_120612_add_status_columns_to_products_table', 59);
INSERT INTO `migrations` VALUES (131, '2025_01_05_115754_create_promotion_galleries_table', 59);
INSERT INTO `migrations` VALUES (132, '2025_01_08_110011_create_orders_table', 59);
INSERT INTO `migrations` VALUES (133, '2025_01_08_110032_create_order_details_table', 59);
INSERT INTO `migrations` VALUES (134, '2025_01_19_143358_create_shoes_sliders_table', 59);
INSERT INTO `migrations` VALUES (135, '2025_01_24_134656_add_api_token_to_customers_table', 60);
INSERT INTO `migrations` VALUES (137, '2025_02_13_201734_add_gender_to_users_table', 61);
INSERT INTO `migrations` VALUES (139, '2025_03_18_203744_add_some_column_to_customers_table', 62);
INSERT INTO `migrations` VALUES (140, '2025_03_21_200203_add_column_invoice_ref_to_order_details_table', 62);
INSERT INTO `migrations` VALUES (141, '2025_03_21_203856_add_column_invoice_ref_to_orders_table', 63);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 3);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 4);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 5);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 6);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 7);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 8);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 9);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 10);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 11);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 12);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 13);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 14);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 15);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 16);
INSERT INTO `model_has_roles` VALUES (7, 'App\\Models\\User', 17);

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('c88ae075afedbab6fdf2b748a507e746838c1201d0c7470e74bc1ec23a9103877fbee212c9d644e1', 12, 1, 'Customer Access Token', '[]', 0, '2025-03-21 20:18:00', '2025-03-21 20:18:01', '2026-03-21 20:18:00');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_auth_codes_user_id_index`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', 'JwC55H6Ge8JNpt19sWazJykFdnSngcCFAExAqE39', NULL, 'http://localhost', 1, 0, 0, '2025-03-21 20:16:56', '2025-03-21 20:16:56');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'EpyhQ1cdpjSt08t0Z5S2BFbFBzdLJOZIhRy3l0j1', 'users', 'http://localhost', 0, 1, 0, '2025-03-21 20:16:56', '2025-03-21 20:16:56');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2025-03-21 20:16:56', '2025-03-21 20:16:56');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for onboards
-- ----------------------------
DROP TABLE IF EXISTS `onboards`;
CREATE TABLE `onboards`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of onboards
-- ----------------------------
INSERT INTO `onboards` VALUES (2, 'Logo Onboard', '2024-08-24-66c9673f531b8.png', 1, '2024-08-24 11:52:32', '2024-12-13 20:43:23');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `product_details` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `product_qty` int NULL DEFAULT NULL,
  `product_size` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `product_price` decimal(10, 2) NULL DEFAULT NULL,
  `discount` decimal(10, 2) NULL DEFAULT NULL,
  `discount_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `delivery_status` enum('pending','delivered','cancelled') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','paid') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_details_order_id_foreign`(`order_id` ASC) USING BTREE,
  INDEX `order_details_product_id_foreign`(`product_id` ASC) USING BTREE,
  INDEX `order_details_brand_id_foreign`(`brand_id` ASC) USING BTREE,
  CONSTRAINT `order_details_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (4, 2, 26, 8, NULL, 2, '40', 70.00, 0.00, NULL, 'pending', NULL, '2025-03-21 20:47:14', '2025-03-21 20:47:14');
INSERT INTO `order_details` VALUES (5, 2, 21, 6, NULL, 5, '41', 120.00, 0.00, NULL, 'pending', NULL, '2025-03-21 20:47:14', '2025-03-21 20:47:14');
INSERT INTO `order_details` VALUES (6, 2, 21, 6, NULL, 5, '42', 130.00, 0.00, NULL, 'pending', NULL, '2025-03-21 20:47:14', '2025-03-21 20:47:14');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_ref` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `order_amount` decimal(10, 2) NULL DEFAULT NULL,
  `discount_amount` decimal(10, 2) NULL DEFAULT NULL,
  `shipping_method` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `shipping_address` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `shipping_fee` decimal(10, 2) NULL DEFAULT NULL,
  `order_status` enum('pending','confirmed','packaging','out_for_delivery','delivered','failed_to_deliver','cancelled') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'pending',
  `order_note` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `payment_status` enum('unpaid','paid') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `payment_method` enum('cash_on_delivery','ABA','AC') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `payment_image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `latitude` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `orders_customer_id_foreign`(`customer_id` ASC) USING BTREE,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (2, 'INV-250321002', 12, 790.00, 440.00, 'J&T Express', 'Pou Banteay Chey Village, Siem Reap Province', 5.00, 'pending', 'Please delivery fast', 'paid', 'AC', NULL, '13.362077', '103.860218', '2025-03-21 20:47:14', '2025-03-21 20:47:14');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'user.view', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'user.create', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'user.edit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'user.delete', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (5, 'customer.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (6, 'blog.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (7, 'gallery.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (8, 'service.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (9, 'slider.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (10, 'facility.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (11, 'menu.view', 'web', '2024-02-20 02:43:33', '2024-02-20 02:43:33');
INSERT INTO `permissions` VALUES (12, 'menu.explore.view', 'web', '2024-02-20 03:06:20', '2024-02-20 03:06:20');
INSERT INTO `permissions` VALUES (13, 'room.view', 'web', '2024-02-20 06:54:46', '2024-02-20 06:54:46');
INSERT INTO `permissions` VALUES (14, 'banner.view', 'web', '2024-11-09 21:31:56', '2024-11-09 21:31:56');
INSERT INTO `permissions` VALUES (15, 'onboard.view', 'web', '2024-11-09 21:31:56', '2024-11-09 21:31:56');
INSERT INTO `permissions` VALUES (16, 'promotion.view', 'web', '2024-11-09 21:31:56', '2024-11-09 21:31:56');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES (1, 'App\\Models\\User', 1, 'accessToken', 'ded913a11dabfae17aaa5b2c654e6e3e90ccae96c1b5797f13e25e9a0ffe61c5', '[\"*\"]', NULL, '2024-08-24 13:41:02', '2024-08-24 13:41:02');
INSERT INTO `personal_access_tokens` VALUES (2, 'App\\Models\\User', 1, 'accessToken', '5a4c152bb71078eada120deb082eb8b89fa08bb53f6c3abbe272e4f3cf35ee60', '[\"*\"]', NULL, '2024-08-24 13:41:35', '2024-08-24 13:41:35');
INSERT INTO `personal_access_tokens` VALUES (3, 'App\\Models\\User', 1, 'accessToken', '81d7fffddcd80eeefb651a9ef4bdbbb06b3d645349ce1f1fc30bf1b45f97027d', '[\"*\"]', NULL, '2024-08-24 13:41:58', '2024-08-24 13:41:58');
INSERT INTO `personal_access_tokens` VALUES (4, 'App\\Models\\User', 1, 'accessToken', 'fe0bc1ce6e0cea612edccd80d8f6807b175cf3a321f59f0d4356a111952a521c', '[\"*\"]', NULL, '2024-08-24 13:42:26', '2024-08-24 13:42:26');
INSERT INTO `personal_access_tokens` VALUES (5, 'App\\Models\\User', 1, 'accessToken', 'd7b9ad74d0b2358afc9979a67dee70e33b2c401cd67959e62fc97428b70c5ae2', '[\"*\"]', NULL, '2024-08-24 13:42:36', '2024-08-24 13:42:36');
INSERT INTO `personal_access_tokens` VALUES (6, 'App\\Models\\User', 1, 'accessToken', 'd7e222b421e4a83872fcb4d3681200400a0b2a86b36a673c57caa856aff554c4', '[\"*\"]', NULL, '2024-08-24 13:51:58', '2024-08-24 13:51:58');
INSERT INTO `personal_access_tokens` VALUES (7, 'App\\Models\\User', 1, 'accessToken', 'a8c9246bcd4c9162f60eb40c33f481323ec3ee083f54aed179822ec6b73d49ad', '[\"*\"]', NULL, '2024-08-24 13:53:59', '2024-08-24 13:53:59');
INSERT INTO `personal_access_tokens` VALUES (8, 'App\\Models\\User', 1, 'accessToken', '99a71e0b2321735e2ea31554d98352134b41a6ba756ff95959332d7059771b9b', '[\"*\"]', NULL, '2024-08-24 13:59:40', '2024-08-24 13:59:40');
INSERT INTO `personal_access_tokens` VALUES (9, 'App\\Models\\User', 1, 'accessToken', 'c1a491022679aec7cd3014078dc032830d477df3a2422e23c6bca1052d951ae3', '[\"*\"]', NULL, '2024-08-24 14:04:25', '2024-08-24 14:04:25');
INSERT INTO `personal_access_tokens` VALUES (10, 'App\\Models\\User', 1, 'accessToken', 'a1cc4dd14688642372396b806bac660a345f276c3f0ed8e43e9b2bd309c41018', '[\"*\"]', NULL, '2024-08-24 14:06:40', '2024-08-24 14:06:40');
INSERT INTO `personal_access_tokens` VALUES (11, 'App\\Models\\User', 1, 'accessToken', '8855315bae44b03c8dcaf1697448ae17cfd34a0d8a7edb76d3b166d6b5194315', '[\"*\"]', NULL, '2024-08-24 14:11:21', '2024-08-24 14:11:21');
INSERT INTO `personal_access_tokens` VALUES (12, 'App\\Models\\User', 1, 'Personal Access Token', '224de9f42f66a7187a5dcce69699821264617068daa7235efcac06403bc4de73', '[\"*\"]', NULL, '2024-08-24 14:12:57', '2024-08-24 14:12:57');
INSERT INTO `personal_access_tokens` VALUES (13, 'App\\Models\\User', 1, 'accessToken', '05e7c57000062e68dc2608305cf5c191e8dab65a6698102021aaa8a9cd8af1c5', '[\"*\"]', NULL, '2024-08-24 14:13:45', '2024-08-24 14:13:45');
INSERT INTO `personal_access_tokens` VALUES (14, 'App\\Models\\User', 1, 'accessToken', '279bb3a5bc47086b3d23c06ed5e2db998fdd4114b05877b1b0d489875ae7c2f9', '[\"*\"]', NULL, '2024-08-24 14:23:13', '2024-08-24 14:23:13');
INSERT INTO `personal_access_tokens` VALUES (15, 'App\\Models\\User', 1, 'accessToken', '51ef63c0f8dccbd1d2a4024a9efeba56ceb966fbb0dacf886047ab0ef02d0b39', '[\"*\"]', NULL, '2024-08-24 14:23:29', '2024-08-24 14:23:29');

-- ----------------------------
-- Table structure for product_galleries
-- ----------------------------
DROP TABLE IF EXISTS `product_galleries`;
CREATE TABLE `product_galleries`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `images` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_galleries
-- ----------------------------
INSERT INTO `product_galleries` VALUES (1, 1, '[\"2024-11-25-6743ece1a145f.png\",\"2024-11-25-6743ece6179f8.png\"]', '2024-11-25 03:20:10', '2024-11-25 03:20:10');
INSERT INTO `product_galleries` VALUES (2, 2, '[\"2024-11-25-6743ee200a8ae.png\",\"2024-11-25-6743ee253fafb.png\"]', '2024-11-25 03:25:30', '2024-11-28 03:35:52');
INSERT INTO `product_galleries` VALUES (3, 10, '[\"2024-11-28-6747e4e150a46.png\",\"2024-11-28-6747e4e891b98.png\",\"2024-11-28-674823e4a89c3.png\"]', '2024-11-28 03:35:10', '2024-11-28 08:03:53');
INSERT INTO `product_galleries` VALUES (4, 11, '[\"2024-12-08-67552d6ecc95d.png\",\"2024-12-08-67552d6eccc13.png\",\"2024-12-08-67552d6ecce9a.png\"]', '2024-12-08 05:15:35', '2025-01-05 07:29:53');
INSERT INTO `product_galleries` VALUES (5, 12, '[\"2025-01-24-6793b2d258935.png\"]', '2025-01-24 15:33:42', '2025-01-24 15:33:42');
INSERT INTO `product_galleries` VALUES (6, 13, '[\"2025-01-24-6793b46025f35.png\"]', '2025-01-24 15:40:20', '2025-01-24 15:40:20');
INSERT INTO `product_galleries` VALUES (7, 14, '[\"2025-01-24-6793b55639754.png\"]', '2025-01-24 15:44:27', '2025-01-24 15:44:27');
INSERT INTO `product_galleries` VALUES (8, 15, '[\"2025-01-24-6793b5c112021.png\",\"2025-01-24-6793b5e37f539.png\"]', '2025-01-24 15:46:48', '2025-01-24 15:46:48');
INSERT INTO `product_galleries` VALUES (9, 16, '[\"2025-01-24-6793b68b04f66.png\",\"2025-01-24-6793b68d64ad6.png\"]', '2025-01-24 15:49:39', '2025-01-24 15:49:39');
INSERT INTO `product_galleries` VALUES (10, 17, '[]', '2025-01-24 15:52:04', '2025-01-24 15:52:15');
INSERT INTO `product_galleries` VALUES (11, 18, '[\"2025-01-24-6793b7aa5824a.png\",\"2025-01-24-6793b7ac12a95.png\"]', '2025-01-24 15:54:24', '2025-01-24 15:54:24');
INSERT INTO `product_galleries` VALUES (12, 20, '[\"2025-01-24-6793b82bca381.png\"]', '2025-01-24 15:57:01', '2025-01-24 15:57:01');
INSERT INTO `product_galleries` VALUES (13, 21, '[\"2025-01-24-6793b8c93f54d.png\",\"2025-01-24-6793b8cb10022.png\",\"2025-01-24-6793b8ccc2d77.png\"]', '2025-01-24 15:59:14', '2025-01-24 15:59:14');
INSERT INTO `product_galleries` VALUES (14, 22, '[\"2025-01-24-6793b9903698b.png\",\"2025-01-24-6793b9925a98b.png\",\"2025-01-24-6793b9944f144.png\",\"2025-01-24-6793b99640f25.png\"]', '2025-01-24 16:02:37', '2025-01-24 16:02:37');
INSERT INTO `product_galleries` VALUES (15, 23, '[\"2025-01-24-6793ba2346dda.png\",\"2025-01-24-6793ba258565a.png\"]', '2025-01-24 16:04:57', '2025-01-24 16:04:57');
INSERT INTO `product_galleries` VALUES (16, 24, '[\"2025-01-24-6793bc05dcad7.png\"]', '2025-01-24 16:12:58', '2025-01-24 16:12:58');
INSERT INTO `product_galleries` VALUES (17, 25, '[\"2025-01-24-6793bc528ef5a.png\"]', '2025-01-24 16:14:15', '2025-01-24 16:14:15');
INSERT INTO `product_galleries` VALUES (18, 26, '[\"2025-01-24-6793bc98541d2.png\"]', '2025-01-24 16:15:24', '2025-01-24 16:15:24');
INSERT INTO `product_galleries` VALUES (19, 27, '[\"2025-01-24-6793bcf3015e6.png\"]', '2025-01-24 16:16:54', '2025-01-24 16:16:54');
INSERT INTO `product_galleries` VALUES (20, 28, '[\"2025-01-24-6793bd39c4450.png\"]', '2025-01-24 16:18:12', '2025-01-24 16:18:12');
INSERT INTO `product_galleries` VALUES (21, 29, '[\"2025-01-24-6793bd86506e4.png\"]', '2025-01-24 16:19:25', '2025-01-24 16:19:25');
INSERT INTO `product_galleries` VALUES (22, 30, '[\"2025-01-24-6793bdfde9a65.png\"]', '2025-01-24 16:21:26', '2025-01-24 16:21:26');
INSERT INTO `product_galleries` VALUES (23, 31, '[\"2025-01-24-6793bebaa49c0.png\",\"2025-01-24-6793bebc79c54.png\"]', '2025-01-24 16:25:01', '2025-01-24 16:25:01');
INSERT INTO `product_galleries` VALUES (24, 32, '[\"2025-01-24-6793bf25c71ce.png\"]', '2025-01-24 16:26:17', '2025-01-24 16:26:17');
INSERT INTO `product_galleries` VALUES (25, 33, '[\"2025-01-24-6793bf8572250.png\"]', '2025-01-24 16:27:54', '2025-01-24 16:27:54');
INSERT INTO `product_galleries` VALUES (26, 34, '[\"2025-01-31-679cb44fdc294.png\"]', '2025-01-31 11:30:28', '2025-01-31 11:30:28');
INSERT INTO `product_galleries` VALUES (27, 35, '[\"2025-01-31-679cb4da41856.png\"]', '2025-01-31 11:32:47', '2025-01-31 11:32:47');
INSERT INTO `product_galleries` VALUES (28, 36, '[\"2025-01-31-679cb55bedf52.png\"]', '2025-01-31 11:34:55', '2025-01-31 11:34:55');
INSERT INTO `product_galleries` VALUES (29, 37, '[\"2025-01-31-679cb5ed93eff.png\"]', '2025-01-31 11:37:27', '2025-01-31 11:37:27');
INSERT INTO `product_galleries` VALUES (30, 38, '[\"2025-01-31-679cb68831d56.png\"]', '2025-01-31 11:39:56', '2025-01-31 11:39:56');
INSERT INTO `product_galleries` VALUES (31, 39, '[\"2025-01-31-679cb70881de8.png\"]', '2025-01-31 11:42:04', '2025-01-31 11:42:04');
INSERT INTO `product_galleries` VALUES (32, 40, '[\"2025-01-31-679cb791add4e.png\"]', '2025-01-31 11:44:22', '2025-01-31 11:44:22');
INSERT INTO `product_galleries` VALUES (33, 41, '[\"2025-01-31-679cb7ef44dc4.png\"]', '2025-01-31 11:45:55', '2025-01-31 11:45:55');
INSERT INTO `product_galleries` VALUES (34, 42, '[\"2025-01-31-679cb84087315.png\"]', '2025-01-31 11:47:17', '2025-01-31 11:47:17');
INSERT INTO `product_galleries` VALUES (35, 43, '[\"2025-01-31-679cb89c0f6fc.png\"]', '2025-01-31 11:48:47', '2025-02-18 00:12:21');
INSERT INTO `product_galleries` VALUES (36, 44, '[\"2025-02-14-67af698333082.png\"]', '2025-02-14 23:04:33', '2025-02-14 23:04:33');
INSERT INTO `product_galleries` VALUES (37, 45, '[\"2025-02-14-67af6a5ab4383.png\"]', '2025-02-14 23:08:06', '2025-02-14 23:08:06');
INSERT INTO `product_galleries` VALUES (38, 46, '[\"2025-02-15-67af788e67f59.png\"]', '2025-02-15 00:08:35', '2025-02-15 00:08:35');
INSERT INTO `product_galleries` VALUES (39, 51, '[\"2025-03-01-67c2fe7d29d02.png\"]', '2025-03-01 19:33:05', '2025-03-01 19:33:05');
INSERT INTO `product_galleries` VALUES (40, 52, '[\"2025-03-01-67c303997385b.png\"]', '2025-03-01 19:55:09', '2025-03-01 19:55:09');
INSERT INTO `product_galleries` VALUES (41, 53, '[\"2025-03-01-67c304049cdb0.png\"]', '2025-03-01 19:56:40', '2025-03-01 19:56:40');
INSERT INTO `product_galleries` VALUES (42, 54, '[\"2025-03-01-67c304afe8f37.png\"]', '2025-03-01 19:59:31', '2025-03-01 19:59:31');
INSERT INTO `product_galleries` VALUES (43, 56, '[\"2025-03-01-67c308ce00250.png\",\"2025-03-01-67c308d537e8e.png\"]', '2025-03-01 20:17:43', '2025-03-01 20:17:43');
INSERT INTO `product_galleries` VALUES (44, 57, '[\"2025-03-01-67c30a9a7baf1.png\",\"2025-03-01-67c30a9a7bd24.png\"]', '2025-03-01 20:24:46', '2025-03-01 20:24:46');
INSERT INTO `product_galleries` VALUES (45, 58, '[\"2025-03-02-67c34a3be7899.png\"]', '2025-03-01 21:52:29', '2025-03-02 00:58:35');
INSERT INTO `product_galleries` VALUES (46, 59, '[\"2025-03-02-67c42454b495c.png\"]', '2025-03-02 00:59:36', '2025-03-02 16:26:49');
INSERT INTO `product_galleries` VALUES (47, 60, '[\"2025-03-02-67c4241d2be6d.png\",\"2025-03-02-67c4241d2c0a7.png\"]', '2025-03-02 15:48:14', '2025-03-02 16:26:03');
INSERT INTO `product_galleries` VALUES (48, 61, '[]', '2025-03-02 16:29:06', '2025-03-02 16:30:30');
INSERT INTO `product_galleries` VALUES (49, 62, '[\"2025-03-04-67c69bbf7580d.png\",\"2025-03-04-67c69bbf7627b.png\"]', '2025-03-02 16:32:13', '2025-03-04 13:20:52');
INSERT INTO `product_galleries` VALUES (50, 63, '[\"2025-03-04-67c69e9d42937.png\",\"2025-03-04-67c69e9d42b8c.png\",\"2025-03-04-67c69e9d42dcb.png\",\"2025-03-04-67c69e9d42fe7.png\"]', '2025-03-04 13:33:02', '2025-03-04 13:33:03');
INSERT INTO `product_galleries` VALUES (51, 64, '[\"2025-03-04-67c6a22373528.png\"]', '2025-03-04 13:48:11', '2025-03-04 13:48:11');
INSERT INTO `product_galleries` VALUES (52, 70, '[\"2025-03-04-67c6bd6bb947b.png\",\"2025-03-04-67c6bd9fe8bc2.png\",\"2025-03-04-67c6bd9fe8df4.png\",\"2025-03-04-67c6be496124c.png\",\"2025-03-04-67c6be496143f.png\"]', '2025-03-04 14:37:49', '2025-03-04 15:57:29');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `brand_id` bigint UNSIGNED NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_info` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `status` int NOT NULL DEFAULT 1,
  `rating` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `count_product_sale` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT '0',
  `new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `recommended` tinyint(1) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Air Jordan 1 Retro High Off-White Chicago', 'Sneaker Shoes', 5, 1, '2025-01-24 15:19:20', '2024-11-25 03:20:10', '2025-01-24 15:19:20', '[{\"product_size\":\"41\",\"product_price\":\"4500.00\",\"product_qty\":\"5\"},{\"product_size\":\"42\",\"product_price\":\"4700.00\",\"product_qty\":\"8\"}]', 1, '5', '0', 0, 1, 0);
INSERT INTO `products` VALUES (2, 'Nike Dunk SB Low Bucks', 'Sneaker Shoes', 5, 1, '2025-01-24 15:19:18', '2024-11-25 03:25:30', '2025-01-24 15:19:18', '[{\"product_size\":\"42\",\"product_price\":\"400.00\",\"product_qty\":\"10\"},{\"product_size\":\"43\",\"product_price\":\"450.00\",\"product_qty\":\"6\"}]', 1, '4', '0', 0, 1, 1);
INSERT INTO `products` VALUES (10, 'Yeezy Boost 700 V1 Wave Runner', 'Adidas', 5, 1, '2025-01-24 15:19:13', '2024-11-28 03:35:10', '2025-01-24 15:19:13', '[{\"product_size\":\"43\",\"product_price\":\"550.00\",\"product_qty\":\"8\"},{\"product_size\":\"44\",\"product_price\":\"560.00\",\"product_qty\":\"9\"},{\"product_size\":\"45\",\"product_price\":\"570.00\",\"product_qty\":\"10\"}]', 1, '3', '0', 0, 0, 0);
INSERT INTO `products` VALUES (11, 'Vans', 'Vans Old Skool', 5, 1, '2025-01-24 15:19:11', '2024-12-08 05:15:35', '2025-01-24 15:19:11', '[{\"product_size\":\"41\",\"product_price\":\"100.00\",\"product_qty\":\"8\"},{\"product_size\":\"43\",\"product_price\":\"100.00\",\"product_qty\":\"5\"},{\"product_size\":\"44\",\"product_price\":\"120.00\",\"product_qty\":\"5\"}]', 1, '4', '0', 1, 0, 1);
INSERT INTO `products` VALUES (12, 'Nike Air Force 1 \'07', 'The radiance lives on in the Nike Air Force 1 ’07, the b-ball OG that puts a fresh spin on what you know best: durably stitched overlays.', 6, 1, NULL, '2025-01-24 15:33:42', '2025-01-24 15:34:14', '[{\"product_size\":\"41\",\"product_price\":\"115.00\",\"product_qty\":\"5\"}]', 1, '5', '0', 1, 1, 0);
INSERT INTO `products` VALUES (13, 'Nike Air Max Dn x Isamaya Ffrench', 'Designed in collaboration with renowned makeup artist Isamaya Ffrench', 6, 1, NULL, '2025-01-24 15:40:20', '2025-01-24 15:42:14', '[{\"product_size\":\"39\",\"product_price\":\"170.00\",\"product_qty\":\"5\"},{\"product_size\":\"38\",\"product_price\":\"170.00\",\"product_qty\":\"10\"}]', 1, '4', '0', 1, 1, 0);
INSERT INTO `products` VALUES (14, 'Nike Air Max Plus OG', 'Hot damn! Better than gold and more sensory stimulating than grandma\'s raspberry pie.', 6, 1, NULL, '2025-01-24 15:44:27', '2025-01-24 15:44:27', '[{\"product_size\":\"40\",\"product_price\":\"180.00\",\"product_qty\":\"10\"},{\"product_size\":\"41\",\"product_price\":\"180.00\",\"product_qty\":\"5\"},{\"product_size\":\"39\",\"product_price\":\"180.00\",\"product_qty\":\"5\"}]', 1, '5', '0', 1, 1, 0);
INSERT INTO `products` VALUES (15, 'Nike Blazer Mid \'77 Vintage', 'In the ‘70s, Nike was the new shoe on the block. So new in fact, we were still breaking into the basketball scene and testing prototypes on the feet of our local team.', 6, 1, NULL, '2025-01-24 15:46:48', '2025-01-24 15:46:48', '[{\"product_size\":\"40\",\"product_price\":\"105.00\",\"product_qty\":\"20\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (16, 'Nike Blazer Low Pro Club', 'Sleek, simple and never basic. A leather and suede upper softens with wear while remaining durable. Mesh accents add varsity flair.', 6, 1, NULL, '2025-01-24 15:49:39', '2025-01-24 15:49:39', '[{\"product_size\":\"38\",\"product_price\":\"100.00\",\"product_qty\":\"10\"},{\"product_size\":\"39\",\"product_price\":\"100.00\",\"product_qty\":\"10\"},{\"product_size\":\"40\",\"product_price\":\"100.00\",\"product_qty\":\"5\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (17, 'Air Jordan 1 Low', 'Inspired by the original that debuted in 1985, the Air Jordan 1 Low offers a clean, classic look that\'s familiar yet always fresh.', 6, 1, '2025-01-24 15:53:05', '2025-01-24 15:52:04', '2025-01-24 15:53:05', '[{\"product_size\":\"40\",\"product_price\":\"115.00\",\"product_qty\":\"20\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (18, 'Nike Dunk Low Retro', 'You can always count on a classic. The Dunk Low pairs its iconic color blocking with premium materials and plush padding for game-changing comfort that lasts.', 6, 1, NULL, '2025-01-24 15:54:24', '2025-01-24 15:54:24', '[{\"product_size\":\"40\",\"product_price\":\"115.00\",\"product_qty\":\"20\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (20, 'Nike Dunk High Next Nature', 'Taking design cues from leather jackets and bags, the Dunk High combines bold color blocking and plush padding for game-changing comfort that lasts.', 6, 1, NULL, '2025-01-24 15:57:01', '2025-01-24 15:57:01', '[{\"product_size\":\"38\",\"product_price\":\"130.00\",\"product_qty\":\"10\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (21, 'Nike Air Force 1 \'07 LV8', 'Comfortable, durable and timeless. The classic ‘80s construction pairs with bold details for style that tracks whether you’re on court or on the go.', 6, 1, NULL, '2025-01-24 15:59:14', '2025-03-21 20:47:14', '[{\"product_size\":\"41\",\"product_price\":\"120.00\",\"product_qty\":\"15\"},{\"product_size\":\"42\",\"product_price\":\"130.00\",\"product_qty\":\"15\"}]', 1, '5', '10', 1, 1, 1);
INSERT INTO `products` VALUES (22, 'Nike Zoom Vomero 5 SE', 'A combination of breathable and durable materials stands ready for the rigors of your day, while Zoom Air cushioning delivers a smooth ride.', 6, 1, NULL, '2025-01-24 16:02:37', '2025-01-24 16:02:37', '[{\"product_size\":\"41\",\"product_price\":\"160.00\",\"product_qty\":\"10\"},{\"product_size\":\"40\",\"product_price\":\"160.00\",\"product_qty\":\"10\"}]', 1, '4', '0', 0, 1, 0);
INSERT INTO `products` VALUES (23, 'Nike Cortez Vintage Suede', 'Now with a wider toe area and firmer side panels, you can comfortably wear them day in and day out. Plus, reengineered materials help prevent warping or creasing.', 6, 1, NULL, '2025-01-24 16:04:57', '2025-01-24 16:04:57', '[{\"product_size\":\"38\",\"product_price\":\"100.00\",\"product_qty\":\"30\"}]', 1, '5', '0', 1, 1, 0);
INSERT INTO `products` VALUES (24, 'PUMA x LAMELO BALL MB.04 Scooby-Doo', 'Zoinks! LaMelo Ball’s signature shoe, the MB.04, gets a groovy redesign based off of everyone’s favorite cartoon car: The Mystery', 8, 1, NULL, '2025-01-24 16:12:58', '2025-01-24 16:12:58', '[{\"product_size\":\"41\",\"product_price\":\"135.00\",\"product_qty\":\"30\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (25, 'Speedcat OG', 'An icon of racing culture, the PUMA Speedcat has been synonymous with speed, precision, and unparalleled performance for over 25', 8, 1, NULL, '2025-01-24 16:14:15', '2025-01-24 16:14:15', '[{\"product_size\":\"39\",\"product_price\":\"100.00\",\"product_qty\":\"20\"}]', 1, '5', '0', 1, 1, 0);
INSERT INTO `products` VALUES (26, 'Amplifier', 'Introducing the Amplifier. In the Amplifier Sneakers, you can enjoy performance-worthy design with every step of day-to-day life.', 8, 1, NULL, '2025-01-24 16:15:24', '2025-03-21 20:47:14', '[{\"product_size\":\"40\",\"product_price\":\"70.00\",\"product_qty\":\"17\"}]', 1, '4', '2', 1, 1, 0);
INSERT INTO `products` VALUES (27, 'Rebound V6', 'Inspired by basketball, the Rebound Low is back to change the game. V6 offers a low-cut silhouette for daily wear on and off the court.', 8, 1, NULL, '2025-01-24 16:16:54', '2025-01-24 16:16:54', '[{\"product_size\":\"40\",\"product_price\":\"70.00\",\"product_qty\":\"30\"}]', 1, '5', '0', 1, 1, 0);
INSERT INTO `products` VALUES (28, 'Viz Runner Repeat', 'Viz Runner\'s stable cushioning will take care of all your running needs.', 8, 1, NULL, '2025-01-24 16:18:12', '2025-01-24 16:18:12', '[{\"product_size\":\"39\",\"product_price\":\"70.00\",\"product_qty\":\"10\"},{\"product_size\":\"38\",\"product_price\":\"70.00\",\"product_qty\":\"10\"}]', 1, '4', '0', 1, 1, 0);
INSERT INTO `products` VALUES (29, 'PUMA x LAMELO BALL MB.04 Heem', 'Melo is HEEM. LaMelo Ball’s signature shoe, the MB.04, gets a neon redesign inspired by the energy he brings on the court.', 8, 1, NULL, '2025-01-24 16:19:25', '2025-01-24 16:19:25', '[{\"product_size\":\"40\",\"product_price\":\"125.00\",\"product_qty\":\"25\"}]', 1, '5', '0', 1, 1, 0);
INSERT INTO `products` VALUES (30, 'Scuderia Ferrari Suede XL Hero', 'Rev up your style with PUMA and Scuderia Ferrari\'s latest collaboration.', 8, 1, NULL, '2025-01-24 16:21:26', '2025-01-24 16:21:26', '[{\"product_size\":\"38\",\"product_price\":\"90.00\",\"product_qty\":\"20\"},{\"product_size\":\"39\",\"product_price\":\"90.00\",\"product_qty\":\"20\"},{\"product_size\":\"40\",\"product_price\":\"90.00\",\"product_qty\":\"10\"},{\"product_size\":\"41\",\"product_price\":\"90.00\",\"product_qty\":\"5\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (31, 'Darter Pro', 'PROFOAM delivers an instant, responsive ride and the engineered mesh upper keeps you cool at high speeds.', 8, 1, NULL, '2025-01-24 16:25:01', '2025-01-24 16:25:01', '[{\"product_size\":\"40\",\"product_price\":\"80.00\",\"product_qty\":\"5\"},{\"product_size\":\"37\",\"product_price\":\"80.00\",\"product_qty\":\"10\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (32, 'Neutron', 'The all new Neutron brings a fresh design language to our Viz Tech assortment, featuring advanced support and increased foam coverage for all day comfort.', 8, 1, NULL, '2025-01-24 16:26:17', '2025-01-24 16:26:17', '[{\"product_size\":\"39\",\"product_price\":\"80.00\",\"product_qty\":\"20\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (33, 'Rebound V6', 'V6 offers a low-cut silhouette for daily wear on and off the court, a soft, tumbled leather look on the upper, and colourblocked PUMA branding for impact.', 8, 1, NULL, '2025-01-24 16:27:54', '2025-01-24 16:27:54', '[{\"product_size\":\"39\",\"product_price\":\"70.00\",\"product_qty\":\"10\"},{\"product_size\":\"38\",\"product_price\":\"70.00\",\"product_qty\":\"10\"},{\"product_size\":\"37\",\"product_price\":\"70.00\",\"product_qty\":\"5\"}]', 1, '5', '0', 1, 1, 1);
INSERT INTO `products` VALUES (34, 'Chuck 70 Glow-In-The-Dark Giraffe Print', 'Roaring with a retro animal print, this Chuck 70 demands to be spotted, anywhere under the sun.', 11, 1, NULL, '2025-01-31 11:30:28', '2025-01-31 11:30:28', '[{\"product_size\":\"38\",\"product_price\":\"95.00\",\"product_qty\":\"30\"}]', 1, '4', '0', 0, 0, 0);
INSERT INTO `products` VALUES (35, 'Chuck Taylor All Star CX EXP2', 'Explore concrete jungles and urban playgrounds in these iconic high-tops made to keep up.', 11, 1, NULL, '2025-01-31 11:32:47', '2025-01-31 11:32:47', '[{\"product_size\":\"39\",\"product_price\":\"85.00\",\"product_qty\":\"20\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (36, 'Chuck 70 Canvas', 'The Chuck 70 offers a blank canvas for you to tell your own stories—through style or activity.', 11, 1, NULL, '2025-01-31 11:34:55', '2025-01-31 11:34:55', '[{\"product_size\":\"37\",\"product_price\":\"90.00\",\"product_qty\":\"30\"}]', 1, '3', '0', 1, 0, 0);
INSERT INTO `products` VALUES (37, 'Chuck 70 Lunar New Year', 'Shed your old look and level up in these premium, Year of the Snake Chucks—Keywords: mysterious, intelligent, charming.', 11, 1, NULL, '2025-01-31 11:37:27', '2025-01-31 11:37:27', '[{\"product_size\":\"40\",\"product_price\":\"105.00\",\"product_qty\":\"20\"},{\"product_size\":\"38\",\"product_price\":\"105.00\",\"product_qty\":\"20\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (38, 'Chuck 70 Canvas', 'The Chuck 70 offers a blank canvas for you to tell your own stories—through style or activity.', 11, 1, NULL, '2025-01-31 11:39:56', '2025-01-31 11:39:56', '[{\"product_size\":\"38\",\"product_price\":\"85.00\",\"product_qty\":\"30\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (39, 'CONS x Bobby Dekeyzer One Star Academy Pro', 'the Converse CONS x Bobby Dekeyzer One Star Academy Pro is a timeless take on tradition.', 11, 1, NULL, '2025-01-31 11:42:04', '2025-01-31 11:42:04', '[{\"product_size\":\"39\",\"product_price\":\"90.00\",\"product_qty\":\"40\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (40, 'CONS AS-1 Pro', 'Only from CONS, a cupsole skate shoe as visionary as its namesake—Alexis Sablone.', 11, 1, NULL, '2025-01-31 11:44:22', '2025-01-31 11:44:22', '[{\"product_size\":\"38\",\"product_price\":\"85.00\",\"product_qty\":\"20\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (41, 'Pro Blaze Classic Leather & Suede', 'Meet retro sport style with an elevated twist. AKA this Pro Blaze Classic.', 11, 1, NULL, '2025-01-31 11:45:55', '2025-01-31 11:45:55', '[{\"product_size\":\"37\",\"product_price\":\"85.00\",\"product_qty\":\"25\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (42, 'CONS Fastbreak Pro Leather & Nylon', 'The \'83 hardwood icon recalibrated by CONS for your skateboard', 11, 1, NULL, '2025-01-31 11:47:17', '2025-01-31 11:47:17', '[{\"product_size\":\"40\",\"product_price\":\"80.00\",\"product_qty\":\"30\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (43, 'Chuck Taylor All Star Malden Street', 'Dress like you shred in mid-top Chucks with skate-inspired materials and details.', 11, 1, NULL, '2025-01-31 11:48:47', '2025-02-28 09:40:38', '[{\"product_size\":\"39\",\"product_price\":\"70.00\",\"product_qty\":\"40\"}]', 1, '4', '0', 1, 0, 0);
INSERT INTO `products` VALUES (44, 'demo', 'demo', 6, 1, '2025-02-15 00:06:54', '2025-02-14 23:04:33', '2025-02-15 00:06:54', '[{\"product_size\":null,\"product_price\":\"0.00\",\"product_qty\":null}]', 1, '1', '0', 0, 0, 0);
INSERT INTO `products` VALUES (45, 'heh', 'rh', 9, 1, '2025-02-15 00:06:50', '2025-02-14 23:08:06', '2025-02-15 00:06:50', '[{\"product_size\":null,\"product_price\":\"0.00\",\"product_qty\":null}]', 1, '4', '0', 0, 0, 0);
INSERT INTO `products` VALUES (46, 'g', 's', 6, 1, '2025-02-15 00:08:45', '2025-02-15 00:08:35', '2025-02-15 00:08:45', '[{\"product_size\":null,\"product_price\":\"0.00\",\"product_qty\":null}]', 1, '3', '0', 0, 0, 0);
INSERT INTO `products` VALUES (51, 'a', 'a', 5, 1, '2025-03-02 00:14:26', '2025-03-01 19:33:05', '2025-03-02 00:14:26', '[{\"product_size\":\"11\",\"product_price\":\"22.00\",\"product_qty\":\"33\"}]', 1, '2', '0', 1, 1, 0);
INSERT INTO `products` VALUES (52, 'a', 'aa', 5, 1, '2025-03-02 00:14:18', '2025-03-01 19:55:09', '2025-03-02 00:14:18', '[{\"product_size\":\"66\",\"product_price\":\"55.00\",\"product_qty\":\"44\"}]', 1, '2', '0', 1, 0, 1);
INSERT INTO `products` VALUES (53, 'a1', 'a1', 7, 1, '2025-03-02 00:14:16', '2025-03-01 19:56:40', '2025-03-02 00:14:16', '[{\"product_size\":\"56\",\"product_price\":\"43.00\",\"product_qty\":\"46\"}]', 1, '2', '0', 1, 1, 0);
INSERT INTO `products` VALUES (54, 'a2', 'a2', 6, 1, '2025-03-02 00:14:13', '2025-03-01 19:59:31', '2025-03-02 00:14:13', '[{\"product_size\":\"45\",\"product_price\":\"34.00\",\"product_qty\":\"224\"}]', 1, '3', '0', 1, 1, 0);
INSERT INTO `products` VALUES (56, 'he', 'hr', 6, 1, '2025-03-02 00:14:09', '2025-03-01 20:17:42', '2025-03-02 00:14:09', '[{\"product_size\":\"23\",\"product_price\":\"454.00\",\"product_qty\":\"23\"}]', 1, '4', '0', 1, 1, 0);
INSERT INTO `products` VALUES (57, 'fdg', 'dfg', 8, 1, '2025-03-02 00:14:02', '2025-03-01 20:24:46', '2025-03-02 00:14:02', '[{\"product_size\":\"32\",\"product_price\":\"435.00\",\"product_qty\":\"23\"}]', 1, '5', '0', 1, 0, 1);
INSERT INTO `products` VALUES (58, 'Adidas', 'haha', 7, 1, '2025-03-02 16:32:50', '2025-03-01 21:52:29', '2025-03-02 16:32:50', '[{\"product_size\":\"44\",\"product_price\":\"444.00\",\"product_qty\":\"4\"}]', 1, '4', '0', 0, 1, 0);
INSERT INTO `products` VALUES (59, 'ggg', 'gg', 6, 1, '2025-03-02 16:33:18', '2025-03-02 00:59:36', '2025-03-02 16:33:18', '[{\"product_size\":\"4\",\"product_price\":\"44.00\",\"product_qty\":\"43\"}]', 1, '5', '0', 0, 1, 0);
INSERT INTO `products` VALUES (60, 'aa', 'aa', 6, 1, '2025-03-02 16:31:27', '2025-03-02 15:48:14', '2025-03-02 16:31:27', '[{\"product_size\":\"32\",\"product_price\":\"342.00\",\"product_qty\":\"22\"}]', 1, '4', '0', 0, 0, 1);
INSERT INTO `products` VALUES (61, 'a1', 'aaa', 6, 1, '2025-03-02 16:31:19', '2025-03-02 16:29:06', '2025-03-02 16:31:19', '[{\"product_size\":\"342\",\"product_price\":\"44.00\",\"product_qty\":\"3\"}]', 1, '3', '0', 1, 0, 0);
INSERT INTO `products` VALUES (62, 'a', 'aa', 6, 1, '2025-03-04 13:31:33', '2025-03-02 16:32:13', '2025-03-04 13:31:33', '[{\"product_size\":\"45\",\"product_price\":\"21.00\",\"product_qty\":\"34\"}]', 1, '5', '0', 0, 0, 1);
INSERT INTO `products` VALUES (63, 'a', '1', 9, 1, '2025-03-04 13:33:30', '2025-03-04 13:33:02', '2025-03-04 13:33:30', '[{\"product_size\":\"2\",\"product_price\":\"23.00\",\"product_qty\":\"23\"}]', 1, '1', '0', 1, 0, 1);
INSERT INTO `products` VALUES (64, 'a', 'a1', 7, 1, '2025-03-04 23:53:26', '2025-03-04 13:48:11', '2025-03-04 23:53:26', '[{\"product_size\":\"23\",\"product_price\":\"212.00\",\"product_qty\":\"22\"}]', 1, '3', '0', 1, 0, 0);
INSERT INTO `products` VALUES (70, 'aa', 'aa1', 7, 1, '2025-03-04 23:53:29', '2025-03-04 14:37:48', '2025-03-04 23:53:29', '[{\"product_size\":\"1\",\"product_price\":\"1.00\",\"product_qty\":\"1\"},{\"product_size\":\"21\",\"product_price\":\"2.00\",\"product_qty\":\"2\"}]', 1, '4', '0', 0, 1, 0);

-- ----------------------------
-- Table structure for promotion_brand
-- ----------------------------
DROP TABLE IF EXISTS `promotion_brand`;
CREATE TABLE `promotion_brand`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `promotion_brand_promotion_id_foreign`(`promotion_id` ASC) USING BTREE,
  INDEX `promotion_brand_brand_id_foreign`(`brand_id` ASC) USING BTREE,
  CONSTRAINT `promotion_brand_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `promotion_brand_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of promotion_brand
-- ----------------------------

-- ----------------------------
-- Table structure for promotion_galleries
-- ----------------------------
DROP TABLE IF EXISTS `promotion_galleries`;
CREATE TABLE `promotion_galleries`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `images` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of promotion_galleries
-- ----------------------------
INSERT INTO `promotion_galleries` VALUES (1, 7, '[\"2025-01-26-6795c7d6e81f8.png\",\"2025-01-26-6795c7d6e866a.png\"]', '2025-01-26 12:27:56', '2025-01-26 12:27:56');

-- ----------------------------
-- Table structure for promotion_product
-- ----------------------------
DROP TABLE IF EXISTS `promotion_product`;
CREATE TABLE `promotion_product`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `promotion_product_promotion_id_foreign`(`promotion_id` ASC) USING BTREE,
  INDEX `promotion_product_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `promotion_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `promotion_product_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of promotion_product
-- ----------------------------
INSERT INTO `promotion_product` VALUES (1, 7, 1, NULL, NULL);
INSERT INTO `promotion_product` VALUES (2, 7, 2, NULL, NULL);

-- ----------------------------
-- Table structure for promotions
-- ----------------------------
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `banner` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `discount_type` enum('percent','amount') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `percent` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `amount` decimal(11, 2) NULL DEFAULT 0.00,
  `promotion_type` enum('brand','product') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of promotions
-- ----------------------------
INSERT INTO `promotions` VALUES (7, 'Chinese New Year', NULL, 1, '2025-01-26 12:27:56', '2025-01-26 12:27:56', '2025-01-26', '2025-01-31', 'promotion for Chinese New Year', 'amount', NULL, 30.00, 'product');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (1, 7);
INSERT INTO `role_has_permissions` VALUES (14, 7);
INSERT INTO `role_has_permissions` VALUES (15, 7);
INSERT INTO `role_has_permissions` VALUES (16, 7);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'web', NULL, NULL);
INSERT INTO `roles` VALUES (7, 'Employee', 'web', '2024-02-20 06:54:46', '2024-11-09 21:31:45');

-- ----------------------------
-- Table structure for shoes_sliders
-- ----------------------------
DROP TABLE IF EXISTS `shoes_sliders`;
CREATE TABLE `shoes_sliders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shoes_sliders
-- ----------------------------
INSERT INTO `shoes_sliders` VALUES (1, 'Shoes Slider 1', '2025-01-20-678dc7121d1de.png', 1, '2025-01-20 10:46:26', '2025-01-20 10:46:26');
INSERT INTO `shoes_sliders` VALUES (2, 'Shoes Slider 2', '2025-01-20-678dc72c39eb1.jpg', 1, '2025-01-20 10:46:52', '2025-01-20 10:46:52');
INSERT INTO `shoes_sliders` VALUES (3, 'Shoes Slider 3', '2025-01-20-678dc74581d2d.jpeg', 1, '2025-01-20 10:47:17', '2025-01-20 10:47:17');

-- ----------------------------
-- Table structure for shoessliders
-- ----------------------------
DROP TABLE IF EXISTS `shoessliders`;
CREATE TABLE `shoessliders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shoessliders
-- ----------------------------

-- ----------------------------
-- Table structure for translations
-- ----------------------------
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `translationable_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `translationable_id` bigint UNSIGNED NULL DEFAULT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 380 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of translations
-- ----------------------------
INSERT INTO `translations` VALUES (2, 'App\\Models\\Slider', 3, 'kh', 'name', 'PHOUM CHAUFEA RESORT', NULL, NULL);
INSERT INTO `translations` VALUES (3, 'App\\Models\\Slider', 3, 'kh', 'short_des', 'Experience the best of Cambodia,  both past and present', NULL, NULL);
INSERT INTO `translations` VALUES (4, 'App\\Models\\HomeStayAmenity', 3, 'kh', 'value', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (5, 'App\\Models\\HomeStayAmenity', 3, 'kh', 'title', 'Special Package', NULL, NULL);
INSERT INTO `translations` VALUES (9, 'App\\Models\\HomeStayAmenity', 4, 'kh', 'value', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (27, 'App\\Models\\Room', 14, 'kh', 'checkin', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (28, 'App\\Models\\Room', 14, 'kh', 'checkout', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (29, 'App\\Models\\Room', 15, 'kh', 'checkin', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (30, 'App\\Models\\Room', 15, 'kh', 'checkout', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (31, 'App\\Models\\Room', 16, 'kh', 'checkin', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (32, 'App\\Models\\Room', 16, 'kh', 'checkout', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (33, 'App\\Models\\Room', 17, 'kh', 'checkin', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (34, 'App\\Models\\Room', 17, 'kh', 'checkout', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (35, 'App\\Models\\Room', 18, 'kh', 'checkin', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (36, 'App\\Models\\Room', 18, 'kh', 'checkout', '[]', NULL, NULL);
INSERT INTO `translations` VALUES (39, 'App\\Models\\HomeStayAmenity', 4, 'kh', 'title', 'Amenity', NULL, NULL);
INSERT INTO `translations` VALUES (42, 'App\\Models\\Room', 3, 'kh', 'checkin', '[{\"title\":\"Check-in 9:00 AM-Anytime\"},{\"title\":\"Early check-in subject to availability\"}]', NULL, NULL);
INSERT INTO `translations` VALUES (43, 'App\\Models\\Room', 3, 'kh', 'checkout', '[{\"title\":\"Check-out before noon\"},{\"title\":\"Express check-out\"}]', NULL, NULL);
INSERT INTO `translations` VALUES (44, 'App\\Models\\RatePlan', 1, 'kh', 'title', 'Rate Plan Single Stay', NULL, NULL);
INSERT INTO `translations` VALUES (45, 'App\\Models\\RatePlan', 1, 'kh', 'description', 'Rate Plan Single Stay', NULL, NULL);
INSERT INTO `translations` VALUES (49, 'App\\Models\\Room', 3, 'kh', 'title', 'Chaufea Villa', NULL, NULL);
INSERT INTO `translations` VALUES (50, 'App\\Models\\Room', 3, 'kh', 'special_note', 'Morem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit int erdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia  nostra, per inceptos himenaeos. Curabitur tempus urna at turpis condimentum lobortis.  Ut commodo efficitur neque.', NULL, NULL);
INSERT INTO `translations` VALUES (51, 'App\\Models\\Room', 3, 'kh', 'description', '<p class=\"MsoNormal\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Chaufea Villa</span><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">&nbsp;or Lok Mchas Villa</span><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">, a luxurious two-story retreat nestled in the heart of Phoum Chaufea. This exquisite villa boasts six private bedrooms, two maid bedrooms, and nine bathrooms, providing ample space for relaxation and comfort. With two fully equipped kitchens, an executive meeting room, a library, and a meditation room, Chaufea Villa offers the perfect blend of convenience and sophistication.&nbsp;</span><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">The generous terrace of Chaufea Villa offers breathtaking panoramic views of the surrounding landscape, allowing guests to immerse themselves in the beauty of Phoum Chaufea. Whether you are hosting a private function or seeking a romantic getaway, Chaufea Villa is the ideal choice for those looking for a luxurious and elegant retreat.&nbsp;</span><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">With its Khmer-inspired design and modern amenities, Chaufea Villa is the perfect setting for a luxury wedding celebration or a romantic escape. Indulge in the opulence of this magnificent villa and create unforgettable memories in the serene surroundings of Phoum Chaufea.</span><br><br><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Experience the epitome of luxury at Chaufea Villa, where every detail is designed to exceed your expectations. Book your stay today and discover the beauty and elegance of this exceptional retreat.</span></p><p><span style=\"font-weight: bolder;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">FEATURES</span></span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Outdoor fans&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Work/writing desk</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Kitchenette with full refrigerators&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Indoor rain showers</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Fully stocked mini bars&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Iron/Ironing board (on request)</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Exclusive outdoor bathrooms&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Dinning area</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Daily Mineral water&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Cooking utensils</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">High Speed Internet Wifi&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Terrace</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">6 55\" Smart TVs&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Living room/sitting area</span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\">Walking closeth&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style=\"font-size: 0.875rem; font-family: &quot;Times New Roman&quot;;\">Coffe/tea making facilities</span></p>', NULL, NULL);
INSERT INTO `translations` VALUES (56, 'App\\Models\\Blog', 1, 'kh', 'title', 'The best restaurant in  siem reap only Phoum Chaufea resort', NULL, NULL);
INSERT INTO `translations` VALUES (371, 'App\\Models\\Brand', 4, 'kh', 'name', 'Louis Vuitton', NULL, NULL);
INSERT INTO `translations` VALUES (372, 'App\\Models\\Brand', 5, 'kh', 'name', 'Reebok', NULL, NULL);
INSERT INTO `translations` VALUES (373, 'App\\Models\\Product', 1, 'kh', 'name', 'Adidas Samba', NULL, NULL);
INSERT INTO `translations` VALUES (374, 'App\\Models\\Product', 1, 'kh', 'description', 'The Adidas Samba, born in 1950 as a soccer shoe, is now a global style icon loved for its versatility and timeless design.', NULL, NULL);
INSERT INTO `translations` VALUES (375, 'App\\Models\\Product', 2, 'kh', 'name', 'Converse', NULL, NULL);
INSERT INTO `translations` VALUES (376, 'App\\Models\\Product', 2, 'kh', 'description', 'Converse, founded in 1908, is an iconic footwear brand known for its timeless Chuck Taylor All Star sneakers.', NULL, NULL);
INSERT INTO `translations` VALUES (377, 'App\\Models\\Brand', 15, 'kh', 'name', 'sonic', NULL, NULL);
INSERT INTO `translations` VALUES (378, 'App\\Models\\Product', 43, 'kh', 'name', 'Chuck Taylor All Star Malden Street', NULL, NULL);
INSERT INTO `translations` VALUES (379, 'App\\Models\\Product', 43, 'kh', 'description', 'Dress like you shred in mid-top Chucks with skate-inspired materials and details.', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT 'male',
  `phone` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `telegram` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'superadmin', 'admin@gmail.com', NULL, '$2y$10$78nrUBLUIqOO0lWLNWCCde1Njlk4Vdq90Bh6SaevJFCIDJr0xGe5K', 'YKl1ORPJ5X8BJH81L4xOko8N8Qcq580wHYhxTTaA5Q8bNbYX7KhWmAaoyeSy', '2023-09-07 10:11:02', '2025-03-03 16:40:48', 'Admin', 'Super', 'male', '010679106', '010679106', '2025-03-03-67c5791cc7c87.png', NULL, NULL);
INSERT INTO `users` VALUES (2, 'smith08', 'jonhsmith123@gmail.com', NULL, '$2y$10$ImOK/eWOnQQo/lvs4pY6Ruf3kWitZkYxMeiwgxwMbR7CtRtyRg0k.', NULL, '2024-02-05 07:28:03', '2025-02-16 15:55:55', 'Jonh', 'Smith', 'male', '0957878709', '0957878709', NULL, '2025-02-16 15:55:55', NULL);
INSERT INTO `users` VALUES (3, 'testing@gmail.com', 'testing@gmail.com', NULL, '$2y$10$3pqP3Us2mVcWsdgfY8l1..WTkIhMpDhmOHMjpe1GOsuAi6NpJmmI2', NULL, '2024-02-20 08:59:20', '2025-01-30 20:21:17', 'user', 'test', 'male', '0877777888', '0877767767', '2025-01-05-677aa530a6721.png', NULL, NULL);
INSERT INTO `users` VALUES (4, 'Demo1', 'demo1@gmail.com', NULL, '$2y$10$NwNNquGVHlo4Jmj/xaDSg.R7yFQczwm3/6lZBRnqb65tLtuOuYJfy', NULL, '2025-02-13 19:19:00', '2025-02-16 17:05:23', 'Demo', '1', 'male', '123456', '123', NULL, '2025-02-16 17:05:23', NULL);
INSERT INTO `users` VALUES (5, 'Demo2', 'demo2@gmail.com', NULL, '$2y$10$1vtoHTcshptHBXhDL97vDOWiIbTnXN2Yg80TFvehNRz5v195pQi/a', NULL, '2025-02-13 19:19:36', '2025-02-17 21:02:12', 'Demo', '2', 'male', '345678', '345678', '2025-02-17-67b3416300d6f.png', NULL, NULL);
INSERT INTO `users` VALUES (6, NULL, 'demo3@gmail.com', NULL, '$2y$10$5F1/.D6t8QeQIO/sV/Pt5uLehXrxxhFMAYDH9U5akrvFpBmWby3hu', NULL, '2025-02-13 20:32:00', '2025-02-18 00:20:58', 'demo', '3', 'female', '123456', '234567', NULL, '2025-02-18 00:20:58', NULL);
INSERT INTO `users` VALUES (7, NULL, 'demo4@gmail.com', NULL, '$2y$10$TBuUpQXKUz6IcHKs8rf4NetiJ1E9EwfpvvFgP9IspUy4Nq7TG9bc.', NULL, '2025-02-13 20:35:07', '2025-02-18 00:17:53', 'demo', '4', 'female', '345678', '234567', NULL, '2025-02-18 00:17:53', NULL);
INSERT INTO `users` VALUES (8, NULL, 'demo5@gmail.com', NULL, '$2y$10$Hbcn.JfZHBL7V3YDyvLGG.RDzdX.KlP7Uo4x5xmE0eMttsJV83xh.', NULL, '2025-02-16 23:25:21', '2025-02-16 23:25:21', 'demo', '5', 'male', '22143', '2343242', NULL, NULL, NULL);
INSERT INTO `users` VALUES (9, NULL, 'demo6@gmail.com', NULL, '$2y$10$SFlZ9jo60.4cQ7p/hv.q0uuTJdl83WfawGyRo5cjt57g6S/eGKn2a', NULL, '2025-02-16 23:39:16', '2025-02-16 23:39:16', 'Demo', '6', 'female', '096 493 0590', '1234567', NULL, NULL, NULL);
INSERT INTO `users` VALUES (10, NULL, 'china@gmail.com', NULL, '$2y$10$kU7skQhePnMPMmwZwfuBpuxN1JBug.nQ1vvsQxfYTNJCdxX4ljC2e', NULL, '2025-02-16 23:49:56', '2025-02-16 23:49:56', 'China', 'Ing', 'male', '012 345 678', '012 345 678', '2025-02-16-67b21731695a5.png', NULL, NULL);
INSERT INTO `users` VALUES (11, NULL, 'demo7@gmail.com', NULL, '$2y$10$0CoLcL1LqBpH.aveMNrmxOASpHsbSspExI7S3rk20KCmVo28wY4Wu', NULL, '2025-02-16 23:52:28', '2025-02-16 23:52:28', 'Demo', '7', 'male', '23532', '324', '2025-02-16-67b217c86ab2d.png', NULL, NULL);
INSERT INTO `users` VALUES (12, NULL, 'demo8@gmail.com', NULL, '$2y$10$FNuUAWoDxZhwoRWXzWMtremjz4PnOSCzXQK85fRjDhxujV5wNv.lG', NULL, '2025-02-16 23:56:10', '2025-02-18 00:20:48', 'Demo', '8', 'male', '096 493 0590', '345678', '2025-02-17-67b33ee48209f.png', '2025-02-18 00:20:48', NULL);
INSERT INTO `users` VALUES (13, NULL, 'demo9@gmail.com', NULL, '$2y$10$8rWUI5M0SC/x39D0IXRTguKbmXQCxgDppA6zW0JWlVQtNZJR4VGvW', NULL, '2025-02-17 00:02:06', '2025-02-17 00:02:06', 'demo', '9', 'male', '6436543', '365466', '2025-02-17-67b21a0752275.png', NULL, NULL);
INSERT INTO `users` VALUES (14, NULL, 'demo10@gmail.com', NULL, '$2y$10$9weQKSerzv/VfqdSLBJ8zeZVtAgoz0FSaGiIF5nNeS6c7e4Eb2gy2', NULL, '2025-02-17 00:11:07', '2025-02-17 19:39:15', 'Demo', '11', 'female', '345678', '1234567', '2025-02-17-67b2291fda145.png', NULL, NULL);
INSERT INTO `users` VALUES (15, NULL, 'zoro@gmail.com', NULL, '$2y$10$ODzFYqvoXfs6UibscCLsde4WbzkfNesxjSeRqrto6hN9X3elCePA6', NULL, '2025-02-17 23:52:10', '2025-02-17 23:52:10', 'Zo', 'Ro', 'male', '73264', '83468', '2025-02-17-67b36938b022b.png', NULL, NULL);
INSERT INTO `users` VALUES (16, NULL, 'demo111@gmail.com', NULL, '$2y$10$UjTphgzhDOxOaRnDb7RFHunan.xu8AxXzibkfKFRLFNyVPafWul4u', NULL, '2025-02-28 21:39:37', '2025-02-28 21:39:37', 'Demo', '111', 'male', '0123456789', '0123456789', '2025-02-28-67c1caa772f4d.png', NULL, NULL);
INSERT INTO `users` VALUES (17, NULL, 'goku@gmail.com', NULL, '$2y$10$bfHIP4WcZiC82EqPoMkAN.UY4LfC9BDGb3PSuNR.ReLLpR33BdXVy', NULL, '2025-02-28 21:40:28', '2025-02-28 21:40:28', 'dg', 'wte', 'female', '23453', '235', '2025-02-28-67c1cacc3539b.png', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
