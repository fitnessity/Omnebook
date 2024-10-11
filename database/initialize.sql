# ************************************************************
# Sequel Ace SQL dump
# Version 20033
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.7.38)
# Database: fitnessity_development
# Generation Time: 2022-11-22 05:28:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ==fees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `==fees`;

CREATE TABLE `==fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `verification_fees` double DEFAULT NULL,
  `service_fees` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table activity_Get_Started_Fast
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity_Get_Started_Fast`;

CREATE TABLE `activity_Get_Started_Fast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `small_text` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table addr_cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addr_cities`;

CREATE TABLE `addr_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table addr_countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addr_countries`;

CREATE TABLE `addr_countries` (
  `country_code` varchar(3) NOT NULL,
  `country_name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  UNIQUE KEY `country_code` (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table addr_states
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addr_states`;

CREATE TABLE `addr_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(30) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_code` (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('admin','business','customer') COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gender` char(10) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `country` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` int(6) DEFAULT NULL,
  `activated` tinyint(1) DEFAULT '1',
  `is_social_login` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `banned` tinyint(1) DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` tinytext COLLATE utf8_bin,
  `status` enum('draft','review_pending','approved','rejected') COLLATE utf8_bin NOT NULL,
  `rejected_reason` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `email` (`email`),
  KEY `is_social_login` (`is_social_login`),
  KEY `password` (`password`),
  KEY `gender` (`gender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table background_check_faq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `background_check_faq`;

CREATE TABLE `background_check_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qustion` varchar(255) DEFAULT NULL,
  `answer` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table background_check_vatted_business_faq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `background_check_vatted_business_faq`;

CREATE TABLE `background_check_vatted_business_faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answers` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table bookactivity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookactivity`;

CREATE TABLE `bookactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `_token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table braintree_cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `braintree_cart`;

CREATE TABLE `braintree_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_fk` int(11) DEFAULT NULL,
  `user_id_fk` int(11) DEFAULT NULL,
  `order_id_fk` int(11) DEFAULT NULL,
  `cart_status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`cart_id`),
  KEY `product_id_fk` (`product_id_fk`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `order_id_fk` (`order_id_fk`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id_fk`) REFERENCES `braintree_products` (`product_id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id_fk`) REFERENCES `braintree_users` (`user_id`),
  CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`order_id_fk`) REFERENCES `braintree_orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table braintree_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `braintree_orders`;

CREATE TABLE `braintree_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `braintreeCode` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id_fk` (`user_id_fk`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `braintree_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table braintree_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `braintree_products`;

CREATE TABLE `braintree_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) DEFAULT NULL,
  `product_desc` text,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table braintree_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `braintree_users`;

CREATE TABLE `braintree_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table busi_page_favourite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `busi_page_favourite`;

CREATE TABLE `busi_page_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table busi_page_followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `busi_page_followers`;

CREATE TABLE `busi_page_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table business_activity_scheduler
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_activity_scheduler`;

CREATE TABLE `business_activity_scheduler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `spots_available` int(11) DEFAULT NULL,
  `activity_meets` varchar(50) DEFAULT NULL,
  `scheduled_day_or_week_num` int(11) DEFAULT NULL,
  `scheduled_day_or_week` varchar(255) DEFAULT NULL,
  `starting` date DEFAULT NULL,
  `end_activity_date` date DEFAULT NULL,
  `schedule_until` varchar(50) DEFAULT NULL,
  `sales_tax` varchar(10) DEFAULT NULL,
  `sales_tax_percent` varchar(5) DEFAULT NULL,
  `dues_tax` varchar(10) DEFAULT NULL,
  `dues_tax_percent` varchar(5) DEFAULT NULL,
  `activity_days` text,
  `shift_start` text,
  `shift_end` text,
  `set_duration` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_claims
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_claims`;

CREATE TABLE `business_claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) NOT NULL,
  `business_type` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` longtext,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `claim_business_verification_code` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_companydetail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_companydetail`;

CREATE TABLE `business_companydetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `Companyname` varchar(255) NOT NULL,
  `Address` longtext,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(20) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `EINnumber` varchar(20) DEFAULT NULL,
  `Establishmentyear` int(11) DEFAULT NULL,
  `Businessusername` longtext,
  `Profilepic` varchar(255) DEFAULT NULL,
  `Firstnameb` varchar(255) DEFAULT NULL,
  `Lastnameb` varchar(255) DEFAULT NULL,
  `Emailb` varchar(255) DEFAULT NULL,
  `Phonenumber` varchar(50) DEFAULT NULL,
  `Aboutcompany` varchar(500) DEFAULT NULL,
  `Shortdescription` text,
  `EmbedVideo` text,
  `showstep` int(11) NOT NULL DEFAULT '2',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table business_experience
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_experience`;

CREATE TABLE `business_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `frm_organisationname` longtext NOT NULL,
  `frm_position` longtext NOT NULL,
  `frm_ispresentcheck` varchar(500) DEFAULT NULL,
  `frm_servicestart` longtext,
  `frm_serviceend` longtext,
  `frm_course` longtext NOT NULL,
  `frm_university` longtext NOT NULL,
  `frm_passingyear` longtext NOT NULL,
  `certification` longtext NOT NULL,
  `frm_passingdate` longtext NOT NULL,
  `skill_type` longtext NOT NULL,
  `skillcompletion` longtext NOT NULL,
  `frm_skilldetail` longtext NOT NULL,
  `showstep` int(11) NOT NULL DEFAULT '3',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table business_informations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_informations`;

CREATE TABLE `business_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `ein_number` varchar(255) DEFAULT NULL,
  `establishment_year` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_post_views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_post_views`;

CREATE TABLE `business_post_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table business_price_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_price_details`;

CREATE TABLE `business_price_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_service_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `pay_chk` text,
  `category_id` text,
  `price_title` text,
  `pay_session_type` text,
  `membership_type` varchar(50) DEFAULT NULL,
  `pay_session` text,
  `pay_price` text,
  `pay_discountcat` text,
  `pay_discounttype` text,
  `pay_discount` text,
  `pay_estearn` text,
  `pay_setnum` text,
  `pay_setduration` text,
  `pay_after` text,
  `fitnessity_fee` text NOT NULL,
  `adult_cus_weekly_price` text,
  `adult_weekend_price_diff` text,
  `adult_discount` text,
  `adult_estearn` text,
  `weekend_adult_estearn` text,
  `child_cus_weekly_price` text,
  `child_weekend_price_diff` text,
  `child_discount` text,
  `child_estearn` text,
  `weekend_child_estearn` text,
  `infant_cus_weekly_price` text,
  `infant_weekend_price_diff` text,
  `infant_discount` text,
  `infant_estearn` text,
  `weekend_infant_estearn` text,
  `is_recurring_adult` varchar(3) DEFAULT NULL,
  `recurring_run_auto_pay_adult` text,
  `recurring_cust_be_charge_adult` text,
  `recurring_every_time_num_adult` int(11) DEFAULT NULL,
  `recurring_every_time_adult` text,
  `recurring_nuberofautopays_adult` int(11) DEFAULT NULL,
  `recurring_happens_aftr_12_pmt_adult` text,
  `recurring_client_be_charge_on_adult` text,
  `recurring_price_adult` text,
  `recurring_first_pmt_adult` text,
  `recurring_recurring_pmt_adult` text,
  `recurring_total_contract_revenue_adult` text,
  `is_recurring_child` varchar(3) DEFAULT NULL,
  `recurring_run_auto_pay_child` text,
  `recurring_cust_be_charge_child` text,
  `recurring_every_time_num_child` text,
  `recurring_every_time_child` text,
  `recurring_nuberofautopays_child` text,
  `recurring_happens_aftr_12_pmt_child` text,
  `recurring_client_be_charge_on_child` text,
  `recurring_price_child` text,
  `recurring_first_pmt_child` text,
  `recurring_recurring_pmt_child` text,
  `recurring_total_contract_revenue_child` text,
  `is_recurring_infant` varchar(3) DEFAULT NULL,
  `recurring_run_auto_pay_infant` text,
  `recurring_cust_be_charge_infant` text,
  `recurring_every_time_num_infant` text,
  `recurring_every_time_infant` text,
  `recurring_nuberofautopays_infant` text,
  `recurring_happens_aftr_12_pmt_infant` text,
  `recurring_client_be_charge_on_infant` text,
  `recurring_price_infant` text,
  `recurring_first_pmt_infant` text,
  `recurring_recurring_pmt_infant` text,
  `recurring_total_contract_revenue_infant` text,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_price_details_ages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_price_details_ages`;

CREATE TABLE `business_price_details_ages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `category_title` text COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table business_review
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_review`;

CREATE TABLE `business_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text COLLATE utf8mb4_bin,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `images` text COLLATE utf8mb4_bin NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table business_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_service`;

CREATE TABLE `business_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `languages` varchar(200) DEFAULT NULL,
  `medical_states` varchar(50) DEFAULT NULL,
  `medical_type` varchar(50) DEFAULT NULL,
  `fitness_goals` varchar(255) DEFAULT NULL,
  `goals_option` varchar(255) DEFAULT NULL,
  `hours_opt` varchar(100) DEFAULT NULL,
  `mon_shift_start` varchar(10) DEFAULT NULL,
  `mon_shift_end` varchar(10) DEFAULT NULL,
  `tue_shift_start` varchar(10) DEFAULT NULL,
  `tue_shift_end` varchar(10) DEFAULT NULL,
  `wed_shift_start` varchar(10) DEFAULT NULL,
  `wed_shift_end` varchar(10) DEFAULT NULL,
  `thu_shift_start` varchar(10) DEFAULT NULL,
  `thu_shift_end` varchar(10) DEFAULT NULL,
  `fri_shift_start` varchar(10) DEFAULT NULL,
  `fri_shift_end` varchar(10) DEFAULT NULL,
  `sat_shift_start` varchar(10) DEFAULT NULL,
  `sat_shift_end` varchar(10) DEFAULT NULL,
  `sun_shift_start` varchar(10) DEFAULT NULL,
  `sun_shift_end` varchar(10) DEFAULT NULL,
  `serTimeZone` varchar(200) DEFAULT NULL,
  `special_days_off` varchar(500) DEFAULT NULL,
  `serBusinessoff1` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table business_service_review
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_service_review`;

CREATE TABLE `business_service_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text COLLATE utf8mb4_bin,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `images` text COLLATE utf8mb4_bin NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table business_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_services`;

CREATE TABLE `business_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `serviceid` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `sport_activity` varchar(50) DEFAULT NULL,
  `program_name` longtext NOT NULL,
  `program_desc` longtext,
  `profile_pic` varchar(255) DEFAULT NULL,
  `instant_booking` int(1) NOT NULL DEFAULT '0',
  `reserved_booking` int(1) NOT NULL DEFAULT '0',
  `notice_value` varchar(20) DEFAULT NULL,
  `notice_key` varchar(2) DEFAULT NULL,
  `advance_value` varchar(20) DEFAULT NULL,
  `advance_key` varchar(2) DEFAULT NULL,
  `activity_value` varchar(20) DEFAULT NULL,
  `activity_key` varchar(2) DEFAULT NULL,
  `cancel_value` varchar(20) DEFAULT NULL,
  `cancel_key` varchar(255) DEFAULT NULL,
  `willing_to_travel` varchar(5) DEFAULT NULL,
  `addi_info_help` text,
  `addi_info` text,
  `miles` varchar(10) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `meetup_location` varchar(500) DEFAULT NULL,
  `select_service_type` varchar(255) DEFAULT NULL,
  `activity_location` varchar(255) DEFAULT NULL,
  `activity_for` varchar(255) DEFAULT NULL,
  `age_range` varchar(255) DEFAULT NULL,
  `group_size` int(50) NOT NULL DEFAULT '1',
  `difficult_level` varchar(255) DEFAULT NULL,
  `activity_experience` varchar(255) DEFAULT NULL,
  `instructor_habit` varchar(255) DEFAULT NULL,
  `activity_meets` varchar(50) DEFAULT NULL,
  `starting` varchar(10) DEFAULT NULL,
  `schedule_until` varchar(50) DEFAULT NULL,
  `sales_tax` varchar(10) DEFAULT NULL,
  `sales_tax_percent` varchar(5) DEFAULT NULL,
  `dues_tax` varchar(10) DEFAULT NULL,
  `dues_tax_percent` varchar(5) DEFAULT NULL,
  `mon_shift_start` varchar(10) DEFAULT NULL,
  `mon_shift_end` varchar(10) DEFAULT NULL,
  `tue_shift_start` varchar(10) DEFAULT NULL,
  `tue_shift_end` varchar(10) DEFAULT NULL,
  `wed_shift_start` varchar(10) DEFAULT NULL,
  `wed_shift_end` varchar(10) DEFAULT NULL,
  `thu_shift_start` varchar(10) DEFAULT NULL,
  `thu_shift_end` varchar(10) DEFAULT NULL,
  `fri_shift_start` varchar(10) DEFAULT NULL,
  `fri_shift_end` varchar(10) DEFAULT NULL,
  `sat_shift_start` varchar(10) DEFAULT NULL,
  `sat_shift_end` varchar(10) DEFAULT NULL,
  `sun_shift_start` varchar(10) DEFAULT NULL,
  `sun_shift_end` varchar(10) DEFAULT NULL,
  `mon_duration` varchar(50) DEFAULT NULL,
  `tue_duration` varchar(50) DEFAULT NULL,
  `wed_duration` varchar(50) DEFAULT NULL,
  `accessibility` text,
  `thu_duration` varchar(50) DEFAULT NULL,
  `fri_duration` varchar(50) DEFAULT NULL,
  `sat_duration` varchar(50) DEFAULT NULL,
  `sun_duration` varchar(50) DEFAULT NULL,
  `frm_servicedesc` text,
  `exp_country` varchar(50) DEFAULT NULL,
  `exp_highlight` varchar(255) DEFAULT NULL,
  `exp_address` varchar(150) DEFAULT NULL,
  `exp_building` varchar(50) DEFAULT NULL,
  `exp_city` varchar(50) DEFAULT NULL,
  `exp_state` varchar(50) DEFAULT NULL,
  `exp_zip` varchar(10) DEFAULT NULL,
  `is_late_fee` varchar(10) DEFAULT NULL,
  `late_fee` double DEFAULT '0',
  `included_items` text,
  `notincluded_items` text,
  `bring_wear` text,
  `req_safety` varchar(100) DEFAULT NULL,
  `days_plan_title` text,
  `desc_location` text,
  `days_plan_desc` text,
  `days_plan_img` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `instructor_id` int(11) DEFAULT NULL,
  `request_booking` varchar(255) DEFAULT NULL,
  `frm_min_participate` varchar(255) DEFAULT NULL,
  `exp_lat` varchar(255) DEFAULT NULL,
  `exp_lng` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_services_favorite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_services_favorite`;

CREATE TABLE `business_services_favorite` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `service_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table business_services_map
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_services_map`;

CREATE TABLE `business_services_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `pubdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_subscription_plan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_subscription_plan`;

CREATE TABLE `business_subscription_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `item` varchar(100) NOT NULL,
  `qty` int(2) NOT NULL,
  `price` float(4,2) DEFAULT NULL,
  `service_fee` varchar(10) DEFAULT NULL,
  `grand_total` float(4,2) NOT NULL,
  `pubdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `site_tax` varchar(255) DEFAULT NULL,
  `fitnessity_fee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table business_terms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_terms`;

CREATE TABLE `business_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `houserules` varchar(500) DEFAULT NULL,
  `cancelation` varchar(500) DEFAULT NULL,
  `cleaning` varchar(500) DEFAULT NULL,
  `termcondfaq` int(1) DEFAULT '0',
  `termcondfaqtext` longtext,
  `contractterms` int(1) DEFAULT '0',
  `contracttermstext` longtext,
  `liability` int(1) DEFAULT '0',
  `liabilitytext` longtext,
  `covid` int(1) DEFAULT '0',
  `covidtext` longtext,
  `refundpolicy` int(1) DEFAULT '0',
  `refundpolicytext` longtext,
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table business_verified
# ------------------------------------------------------------

DROP TABLE IF EXISTS `business_verified`;

CREATE TABLE `business_verified` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `card_expiry` varchar(10) NOT NULL,
  `card_cvv` int(4) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `ssn` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rights_summary` longtext,
  `ack_summary` int(1) DEFAULT NULL,
  `authorize_detail` longtext,
  `ack_authorize` int(1) DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table calendar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `calendar`;

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_fk` int(11) DEFAULT NULL,
  `user_id_fk` int(11) DEFAULT NULL,
  `order_id_fk` int(11) DEFAULT NULL,
  `cart_status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`cart_id`),
  KEY `product_id_fk` (`product_id_fk`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `order_id_fk` (`order_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table ci_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table cms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms`;

CREATE TABLE `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` varchar(200) NOT NULL,
  `content_alias` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `banner_image` varchar(200) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table company_informations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company_informations`;

CREATE TABLE `company_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address` longtext,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `ein_number` varchar(255) DEFAULT NULL,
  `establishment_year` varchar(4) DEFAULT NULL,
  `business_user_tag` longtext,
  `about_company` longtext,
  `short_description` text,
  `embed_video` varchar(150) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `company_images` longtext,
  `serviceid` int(11) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=inacive , 1=active',
  `is_verified` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=unclaimed 1=claimed',
  `claim_business_verification_code` varchar(255) DEFAULT NULL,
  `stripe_connect_id` varchar(255) DEFAULT NULL,
  `charges_enabled` int(11) NOT NULL DEFAULT '0',
  `dba_business_name` varchar(255) DEFAULT NULL,
  `additional_address` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `business_phone` varchar(255) DEFAULT NULL,
  `business_email` varchar(255) DEFAULT NULL,
  `business_website` varchar(255) DEFAULT NULL,
  `business_type` varchar(255) DEFAULT NULL,
  `business_added_by_cust_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table contact_us
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact_us`;

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table country_flag_information
# ------------------------------------------------------------

DROP TABLE IF EXISTS `country_flag_information`;

CREATE TABLE `country_flag_information` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `flag_image` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `country_short_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table discover
# ------------------------------------------------------------

DROP TABLE IF EXISTS `discover`;

CREATE TABLE `discover` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `_token` varchar(255) NOT NULL DEFAULT 'none',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table event_booking
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event_booking`;

CREATE TABLE `event_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table fit_carts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fit_carts`;

CREATE TABLE `fit_carts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `booking_id` int(20) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `fit_date` varchar(20) DEFAULT NULL,
  `numberofpersons` int(11) DEFAULT NULL,
  `fit_time` varchar(20) DEFAULT NULL,
  `service_choice` int(11) DEFAULT NULL,
  `duestaxpercentage` int(11) DEFAULT NULL,
  `salestaxpercentage` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table fit_help
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fit_help`;

CREATE TABLE `fit_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL,
  `qustion` text,
  `answer` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table fitnessity_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fitnessity_admin`;

CREATE TABLE `fitnessity_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table fitnessity_content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fitnessity_content`;

CREATE TABLE `fitnessity_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `page_url` varchar(50) DEFAULT NULL,
  `description` longtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table fitnessity_feedbacks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fitnessity_feedbacks`;

CREATE TABLE `fitnessity_feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL,
  `comment` text NOT NULL,
  `suggestion` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table getstarted
# ------------------------------------------------------------

DROP TABLE IF EXISTS `getstarted`;

CREATE TABLE `getstarted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `_token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table home_tracker
# ------------------------------------------------------------

DROP TABLE IF EXISTS `home_tracker`;

CREATE TABLE `home_tracker` (
  `id` int(11) NOT NULL,
  `trainers` int(11) NOT NULL,
  `locations` int(11) NOT NULL,
  `activities` int(11) NOT NULL,
  `businesses` int(11) NOT NULL,
  `bookings` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table inquiry_box
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inquiry_box`;

CREATE TABLE `inquiry_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table instant_forms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `instant_forms`;

CREATE TABLE `instant_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(255) DEFAULT NULL,
  `qoutes` int(11) DEFAULT NULL,
  `activity_for` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `expLevel` varchar(255) DEFAULT NULL,
  `expActivity` varchar(255) DEFAULT NULL,
  `expProfessional` varchar(255) DEFAULT NULL,
  `gear` varchar(255) DEFAULT NULL,
  `gearYes` varchar(255) DEFAULT NULL,
  `do_activity` varchar(255) DEFAULT NULL,
  `which_personality` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `ageRange` varchar(255) DEFAULT NULL,
  `participateActivity` varchar(255) DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `time_available` varchar(255) DEFAULT NULL,
  `medicalIssue` varchar(255) DEFAULT NULL,
  `medicalYes` varchar(255) DEFAULT NULL,
  `trainingLocation` varchar(255) DEFAULT NULL,
  `StartActivity` varchar(255) DEFAULT NULL,
  `travelUpto` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table jobpostbidding
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobpostbidding`;

CREATE TABLE `jobpostbidding` (
  `id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `quotes` text NOT NULL,
  `is_hired` enum('0','1','','') NOT NULL COMMENT '0=no,1=yes',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table jobpostquestions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobpostquestions`;

CREATE TABLE `jobpostquestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobid` int(11) NOT NULL,
  `question_id` varchar(50) NOT NULL,
  `answer` mediumtext NOT NULL,
  `other` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table jobposts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobposts`;

CREATE TABLE `jobposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `lesson_type` enum('quick','direct') NOT NULL,
  `sports` varchar(150) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `quote_by_text` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `quote_by_email` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `hired_userid` int(11) NOT NULL,
  `is_active` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `is_booked` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `is_deleted` enum('0','1') NOT NULL COMMENT '0=no,1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(49) CHARACTER SET utf8 DEFAULT NULL,
  `iso_639-1` char(2) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table meetings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meetings`;

CREATE TABLE `meetings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) DEFAULT NULL,
  `host_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_url` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encrypted_password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` mediumtext COLLATE utf8mb4_unicode_ci,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `start_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mytimezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_jbh` tinyint(1) DEFAULT NULL,
  `option_host_video` tinyint(1) DEFAULT NULL,
  `option_participants_video` tinyint(1) DEFAULT NULL,
  `option_cn_meeting` tinyint(1) DEFAULT NULL,
  `option_in_meeting` tinyint(1) DEFAULT NULL,
  `option_enforce_login` tinyint(1) DEFAULT NULL,
  `option_audio` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table membership_plans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membership_plans`;

CREATE TABLE `membership_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price_per_month` float NOT NULL,
  `quote_per_month` int(11) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_deleted` (`is_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table miscellaneous
# ------------------------------------------------------------

DROP TABLE IF EXISTS `miscellaneous`;

CREATE TABLE `miscellaneous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table newsletters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `newsletters`;

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table notification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-page,2-profile',
  `notification_type` int(11) NOT NULL COMMENT '1-Follow',
  `status` int(11) NOT NULL COMMENT '0-unread, 1-read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table online
# ------------------------------------------------------------

DROP TABLE IF EXISTS `online`;

CREATE TABLE `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `timings` time NOT NULL,
  `price` int(11) NOT NULL,
  `_token` varchar(255) NOT NULL DEFAULT 'none',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table Orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Orders`;

CREATE TABLE `Orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `braintreeCode` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id_fk` (`user_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table page_attachment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_attachment`;

CREATE TABLE `page_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attachment_name` varchar(100) NOT NULL,
  `attachment_data` text,
  `attachment_status` tinyint(1) NOT NULL,
  `cover_photo` tinyint(1) DEFAULT NULL,
  `cover_order` tinyint(1) DEFAULT NULL,
  `attachment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table page_like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_like`;

CREATE TABLE `page_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL COMMENT 'user-id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table page_post_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_post_likes`;

CREATE TABLE `page_post_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_like` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table page_post_save
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_post_save`;

CREATE TABLE `page_post_save` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table page_postcomments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_postcomments`;

CREATE TABLE `page_postcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table page_postcomments_like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_postcomments_like`;

CREATE TABLE `page_postcomments_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table page_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_posts`;

CREATE TABLE `page_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_text` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `images` longtext COLLATE utf8mb4_bin,
  `video` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `music` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table person
# ------------------------------------------------------------

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `timings` time NOT NULL,
  `price` int(11) NOT NULL,
  `_token` varchar(255) NOT NULL DEFAULT 'none',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table post_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_comments`;

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table post_comments_like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_comments_like`;

CREATE TABLE `post_comments_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table post_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_likes`;

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_like` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table post_reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_reports`;

CREATE TABLE `post_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `report_post` tinyint(4) NOT NULL COMMENT 'report=1, unreport=0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table Products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Products`;

CREATE TABLE `Products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) DEFAULT NULL,
  `product_desc` text,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table professional_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `professional_type`;

CREATE TABLE `professional_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table profile_favs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_favs`;

CREATE TABLE `profile_favs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fav_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table profile_followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_followers`;

CREATE TABLE `profile_followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table profile_post_views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_post_views`;

CREATE TABLE `profile_post_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table profile_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_posts`;

CREATE TABLE `profile_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_text` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `images` longtext COLLATE utf8mb4_bin,
  `video` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `music` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table profile_saves
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_saves`;

CREATE TABLE `profile_saves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table profile_views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile_views`;

CREATE TABLE `profile_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reviewfor_userid` int(11) DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `review` text NOT NULL,
  `reviewby_userid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`reviewfor_userid`),
  KEY `created_by` (`reviewby_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table slider
# ------------------------------------------------------------

DROP TABLE IF EXISTS `slider`;

CREATE TABLE `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `stext` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `_token` varchar(255) NOT NULL DEFAULT 'default',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table social_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_accounts`;

CREATE TABLE `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table sports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sports`;

CREATE TABLE `sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_name` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text,
  `booking_option` varchar(255) DEFAULT NULL,
  `parent_sport_id` int(11) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table sports_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sports_categories`;

CREATE TABLE `sports_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table staff_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff_members`;

CREATE TABLE `staff_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table tbl_payment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_payment`;

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `item_number` text NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency_code` varchar(55) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_response` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeline_feeds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeline_feeds`;

CREATE TABLE `timeline_feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feed_type` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `is_shared` tinyint(1) NOT NULL DEFAULT '0',
  `original_post_id` int(11) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeline_feeds_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeline_feeds_comments`;

CREATE TABLE `timeline_feeds_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeline_feeds_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeline_feeds_likes`;

CREATE TABLE `timeline_feeds_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`feed_id`),
  KEY `feed_id` (`feed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeline_feeds_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeline_feeds_media`;

CREATE TABLE `timeline_feeds_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feed_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_type` tinyint(1) NOT NULL DEFAULT '1',
  `media_path` varchar(255) NOT NULL,
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeline_feeds_report
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeline_feeds_report`;

CREATE TABLE `timeline_feeds_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `report_notes` text NOT NULL,
  `feed_owner_id` int(11) NOT NULL,
  `comment_owner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `feed_id` (`feed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table timeline_feeds_share
# ------------------------------------------------------------

DROP TABLE IF EXISTS `timeline_feeds_share`;

CREATE TABLE `timeline_feeds_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `original_feed_id` int(11) NOT NULL,
  `feed_owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `feed_id` (`feed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table trainer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trainer`;

CREATE TABLE `trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `_token` varchar(255) NOT NULL DEFAULT 'none',
  `Created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table user_autologin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_autologin`;

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table user_booking_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_booking_details`;

CREATE TABLE `user_booking_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `sport` varchar(255) NOT NULL COMMENT 'service id',
  `booking_detail` text,
  `zipcode` int(11) DEFAULT NULL,
  `quote_by_text` varchar(255) NOT NULL DEFAULT '0',
  `quote_by_email` varchar(255) NOT NULL DEFAULT '0',
  `note` text,
  `schedule` text,
  `price` varchar(255) DEFAULT NULL,
  `participate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `priceid` varchar(255) DEFAULT NULL COMMENT ' business_price_details = id',
  `act_schedule_id` varchar(45) DEFAULT NULL,
  `bookedtime` date NOT NULL,
  `payment_number` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_booking_quotes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_booking_quotes`;

CREATE TABLE `user_booking_quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `quote_price` char(20) NOT NULL,
  `rate_type` enum('hourly','weekly') NOT NULL,
  `quote` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_booking_recurring_payment_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_booking_recurring_payment_details`;

CREATE TABLE `user_booking_recurring_payment_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `person_type` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `pmt_number` int(11) NOT NULL,
  `Amount` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `stripe_intent_id` text COLLATE utf8mb4_bin,
  `user_order_details_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table user_booking_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_booking_status`;

CREATE TABLE `user_booking_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `booking_type` enum('quick','direct') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `status` enum('requested','confirmed','rejected') DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `rejected_reason` text,
  `stripe_id` text,
  `stripe_status` varchar(50) DEFAULT NULL,
  `currency_code` varchar(20) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `bookedtime` date NOT NULL,
  `pmt_type` int(11) DEFAULT NULL COMMENT '0=full, 1= recurring',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`business_id`) USING BTREE,
  KEY `booking_type` (`booking_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_certifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_certifications`;

CREATE TABLE `user_certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `completion_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_customer_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_customer_details`;

CREATE TABLE `user_customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `about_me` text,
  `banner_image` varchar(255) DEFAULT NULL,
  `intro` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table user_educations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_educations`;

CREATE TABLE `user_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `university` varchar(70) DEFAULT NULL,
  `passing_year` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_employment_histories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_employment_histories`;

CREATE TABLE `user_employment_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `is_present` tinyint(4) NOT NULL DEFAULT '0',
  `service_start` date NOT NULL,
  `service_end` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_evident
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_evident`;

CREATE TABLE `user_evident` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `evident_id` varchar(200) DEFAULT NULL,
  `userIdentityToken` longtext,
  `idOwnerId` longtext,
  `business_email` varchar(100) DEFAULT NULL,
  `other_data` mediumtext,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_family_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_family_details`;

CREATE TABLE `user_family_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) NOT NULL COMMENT ' ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_follower
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_follower`;

CREATE TABLE `user_follower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table user_memberships
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_memberships`;

CREATE TABLE `user_memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `membership_plan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_networks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_networks`;

CREATE TABLE `user_networks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` enum('requested','accepted') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table user_professional_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_professional_details`;

CREATE TABLE `user_professional_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `experience_level` varchar(500) DEFAULT NULL,
  `train_to` varchar(255) DEFAULT NULL,
  `personality` varchar(255) DEFAULT NULL,
  `availability` longtext,
  `professional_type_old` enum('facility','freelancer') DEFAULT 'freelancer',
  `professional_type_id` int(11) DEFAULT '1',
  `about_me` text,
  `about_business` text,
  `languages` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `skill_lavel` varchar(500) DEFAULT NULL,
  `medical_states` tinyint(1) DEFAULT '0',
  `medical_type` varchar(500) DEFAULT NULL,
  `work_locations` varchar(500) DEFAULT NULL,
  `goals_states` tinyint(1) DEFAULT '0',
  `goals_option` varchar(500) DEFAULT NULL,
  `hours` int(2) DEFAULT NULL,
  `timezone` varchar(20) DEFAULT NULL,
  `special_days_off` varchar(500) DEFAULT NULL,
  `notice_each_book` varchar(255) DEFAULT NULL,
  `advance_book` varchar(255) DEFAULT NULL,
  `willing_to_travel` enum('yes','no') NOT NULL DEFAULT 'no',
  `travel_miles` varchar(4) DEFAULT NULL,
  `travel_times` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `twitter_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gfc_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `google_open_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `yahoo_open_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table user_security_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_security_questions`;

CREATE TABLE `user_security_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` varchar(50) NOT NULL,
  `answer` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_services`;

CREATE TABLE `user_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `sport` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `timeslot_from` varchar(255) DEFAULT NULL,
  `timeslot_to` varchar(255) DEFAULT NULL,
  `price` char(20) DEFAULT NULL,
  `servicedesc` text,
  `servicetype` varchar(100) DEFAULT NULL,
  `programtype` varchar(100) DEFAULT NULL,
  `agerange` varchar(100) DEFAULT NULL,
  `programfor` varchar(100) DEFAULT NULL,
  `numberofpeople` varchar(100) DEFAULT NULL,
  `experience_level` varchar(100) DEFAULT NULL,
  `serv_time_slot` text,
  `servicelocation` varchar(100) DEFAULT NULL,
  `focuses` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `specialdeals` varchar(100) DEFAULT NULL,
  `servicepriceoption` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `terms_conditions` longtext,
  `expire_days` varchar(20) DEFAULT NULL,
  `expire_in_option` varchar(20) DEFAULT NULL,
  `expire_in_option2` varchar(20) DEFAULT NULL,
  `sessions` varchar(20) DEFAULT NULL,
  `multiple_count` varchar(20) DEFAULT NULL,
  `recurring_pay` varchar(255) DEFAULT NULL,
  `introoffer` varchar(255) DEFAULT NULL,
  `runautopay` varchar(30) DEFAULT NULL,
  `often` varchar(255) DEFAULT NULL,
  `often_every_op1` varchar(255) DEFAULT NULL,
  `often_every_op2` varchar(20) DEFAULT NULL,
  `numberofpays` varchar(20) DEFAULT NULL,
  `chargeclients` varchar(50) DEFAULT NULL,
  `termcondfaq` varchar(255) DEFAULT NULL,
  `contractterms` varchar(255) DEFAULT NULL,
  `contracttermstext` mediumtext,
  `liability` varchar(255) DEFAULT NULL,
  `liabilitytext` mediumtext,
  `covid` varchar(255) DEFAULT NULL,
  `covidtext` mediumtext,
  `setupprice` varchar(255) DEFAULT NULL,
  `offerpro_states` varchar(255) DEFAULT NULL,
  `activitydesignsfor` mediumtext,
  `activitytype` mediumtext,
  `frm_teachingstyle` mediumtext,
  `salestax` varchar(10) DEFAULT NULL,
  `salestaxpercentage` varchar(20) DEFAULT NULL,
  `duestax` varchar(10) DEFAULT NULL,
  `duestaxpercentage` varchar(20) DEFAULT NULL,
  `after_drop` longtext,
  `class_meets` varchar(255) DEFAULT NULL,
  `starting_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `available_dates` longtext,
  `schedule_until` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user_skill_awards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_skill_awards`;

CREATE TABLE `user_skill_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `completion_date` date NOT NULL,
  `skill_detail` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('admin','business','customer','professional') COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `position` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gender` char(10) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8_bin DEFAULT 'profile.png',
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_bin DEFAULT '42687',
  `state` varchar(255) COLLATE utf8_bin DEFAULT '3920',
  `country` varchar(255) COLLATE utf8_bin DEFAULT 'US',
  `zipcode` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `activated` tinyint(1) DEFAULT '1',
  `is_social_login` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `banned` tinyint(1) DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `buddy_key` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` tinytext COLLATE utf8_bin,
  `status` enum('draft','review_pending','approved','rejected','email_activation_pending') COLLATE utf8_bin NOT NULL,
  `rejected_reason` text COLLATE utf8_bin,
  `is_deleted` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `is_firstlogin_after_approve` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `confirmation_code` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `ein_number` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `establishment_year` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `social_security_no` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `meeting_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `is_upgrade` tinyint(4) NOT NULL DEFAULT '0',
  `show_step` tinyint(4) NOT NULL DEFAULT '0',
  `company_images` longtext COLLATE utf8_bin,
  `provider_id` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `birthdate` date NOT NULL DEFAULT '2000-01-01',
  `dobstatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0= show, 1=hide',
  `quick_intro` text COLLATE utf8_bin,
  `favorit_activity` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `business_info` text COLLATE utf8_bin,
  `cover_photo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bstep` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `serviceid` int(11) NOT NULL DEFAULT '0',
  `servicetype` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stripe_connect_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `stripe_customer_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `email` (`email`),
  KEY `is_social_login` (`is_social_login`),
  KEY `password` (`password`),
  KEY `gender` (`gender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table users_add_attachment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_add_attachment`;

CREATE TABLE `users_add_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `attachment_name` varchar(100) NOT NULL,
  `attachment_data` text,
  `attachment_status` tinyint(1) NOT NULL,
  `cover_photo` tinyint(1) DEFAULT NULL,
  `cover_order` tinyint(1) DEFAULT NULL,
  `attachment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users_favourite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_favourite`;

CREATE TABLE `users_favourite` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `favourite_user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table users_follow
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_follow`;

CREATE TABLE `users_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL DEFAULT '0',
  `follower_id` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table users_follow_temp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_follow_temp`;

CREATE TABLE `users_follow_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL DEFAULT '0',
  `follower_id` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table users_payment_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_payment_info`;

CREATE TABLE `users_payment_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `card_stripe_id` varchar(255) NOT NULL,
  `card_token_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_st` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table vetted_business_faq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vetted_business_faq`;

CREATE TABLE `vetted_business_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qustion` varchar(255) DEFAULT NULL,
  `answer` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table zip_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `zip_codes`;

CREATE TABLE `zip_codes` (
  `zip` char(5) NOT NULL,
  `state` char(2) NOT NULL,
  `latitude` char(10) NOT NULL,
  `longitude` char(10) NOT NULL,
  UNIQUE KEY `zip` (`zip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
