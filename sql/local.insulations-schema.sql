/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `insulations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` int(10) unsigned NOT NULL,
  `location_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_temp` int(11) DEFAULT NULL,
  `min_temp` int(11) DEFAULT NULL,
  `insulation_mat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insulation_spec` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_mat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finish_spec` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chapter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `explanation` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'no_image.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_insulations_locations_idx` (`location_id`),
  CONSTRAINT `fk_insulations_locations_idx` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
