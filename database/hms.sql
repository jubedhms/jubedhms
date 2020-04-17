-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 01:02 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `hms_about_us`
--

CREATE TABLE `hms_about_us` (
  `id` int(3) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` int(3) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(3) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_about_us`
--

INSERT INTO `hms_about_us` (`id`, `description`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '', 'A', 1, 1, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_api_config`
--

CREATE TABLE `hms_api_config` (
  `ID` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `api_key` varchar(300) NOT NULL,
  `account_key` varchar(300) NOT NULL,
  `token_number` varchar(300) NOT NULL,
  `expiry_time` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_api_config`
--

INSERT INTO `hms_api_config` (`ID`, `title`, `url`, `company_code`, `api_key`, `account_key`, `token_number`, `expiry_time`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'SOAP API11', 'http://10.10.98.120:80/', 'HP', 'HPIHWSUAT', 'HPIHWSUAT', '281110441332', '2019-11-28 23:59:59', 'A', 1, 0, 1, '2019-08-21', 1, '2019-11-25', 1, 1, 1, 1),
(2, 'FCM Registration', '', '', '', '', '', '0000-00-00 00:00:00', 'A', 1, 0, 1, '2019-08-21', 1, '2019-11-25', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_api_synchronize`
--

CREATE TABLE `hms_api_synchronize` (
  `ID` tinyint(4) NOT NULL,
  `config_id` int(11) NOT NULL,
  `api_secret_key` text NOT NULL,
  `dropbox_sync_datetime` datetime NOT NULL,
  `dropbox_response` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updation_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_api_synchronize_data`
--

CREATE TABLE `hms_api_synchronize_data` (
  `ID` int(11) NOT NULL,
  `sync_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_project_no` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `on_app` varchar(255) NOT NULL,
  `synced_date` datetime NOT NULL,
  `old_record` tinyint(1) NOT NULL DEFAULT 0,
  `order_by` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_api_temp`
--

CREATE TABLE `hms_api_temp` (
  `ID` int(11) NOT NULL,
  `api_client_secret` varchar(300) NOT NULL,
  `data` text NOT NULL,
  `response` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_app_banner_setting`
--

CREATE TABLE `hms_app_banner_setting` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `short_by` int(3) NOT NULL DEFAULT 1 COMMENT '1 : First',
  `position` varchar(255) NOT NULL COMMENT 'left, right, top, bottom',
  `is_slider` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 : No, 1 : Yes',
  `is_image` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Image, 2: Video',
  `module_name` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_app_banner_setting`
--

INSERT INTO `hms_app_banner_setting` (`ID`, `name`, `src`, `text`, `short_by`, `position`, `is_slider`, `is_image`, `module_name`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Image-1', 'data/app/tour_guide/1574939731_intro2.png', '', 1, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(2, 'Image-2', 'data/app/tour_guide/1574939748_intro3.png', '', 2, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(3, 'Image-3', 'data/app/tour_guide/1574939766_intro4.png', '', 3, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(4, 'Image-4', 'data/app/tour_guide/1574939785_intro5.png', '', 4, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(5, 'Image-5', 'data/app/tour_guide/1574939812_intro6.png', '', 5, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(6, 'Image-6', 'data/app/tour_guide/1574939830_intro7.png', '', 6, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(7, 'Image-1', 'data/app/login/1574935783_login.png', '', 1, 'top', 0, 1, 'login', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(8, 'Image-1', 'data/app/registration/1.jpg', '', 1, 'top', 0, 1, 'registration', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(9, 'Image-1', 'data/app/due_date/1575606894_home-banner.png', '', 1, 'top', 0, 1, 'due_date', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(10, 'Image-1', 'data/app/home_screen/1574921678_home-banner.png', '', 1, 'top', 0, 1, 'home_screen', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(11, 'Image-1', 'data/app/booking_appointment/1574932602_appointment-slider.png', '', 1, 'top', 1, 1, 'booking_appointment', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(12, 'Image-2', 'data/app/booking_appointment/1574932619_appointment-slider.png', '', 2, 'top', 1, 1, 'booking_appointment', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(13, 'Image-3', 'data/app/booking_appointment/1574932640_appointment-slider.png', '', 3, 'top', 1, 1, 'booking_appointment', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(14, 'Image-4', 'data/app/booking_appointment/1574934152_appointment-slider.png', '', 4, 'top', 1, 1, 'booking_appointment', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(15, 'Image-1', 'data/app/doctor_profile/1575609953_doctor-slide.png', '', 1, 'top', 1, 1, 'doctor_profile', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(16, 'Image-2', 'data/app/doctor_profile/1575610067_doctor-slide.png', '', 2, 'top', 1, 1, 'doctor_profile', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(17, 'Image-3', 'data/app/doctor_profile/1575610084_doctor-slide.png', '', 3, 'top', 1, 1, 'doctor_profile', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(18, 'Image-4', 'data/app/doctor_profile/1575610102_doctor-slide.png', '', 4, 'top', 1, 1, 'doctor_profile', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(19, 'Image-1', 'data/app/vaccination/1.jpg', '', 1, 'top', 1, 1, 'vaccination', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(20, 'Image-2', 'data/app/vaccination/2.jpg', '', 2, 'top', 1, 1, 'vaccination', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(21, 'Image-3', 'data/app/vaccination/3.jpg', '', 3, 'top', 1, 1, 'vaccination', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(22, 'Image-4', 'data/app/vaccination/4.jpg', '', 4, 'top', 1, 1, 'vaccination', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(23, 'Image-1', 'data/app/shop/1574934840_shop-slider.png', '', 1, 'top', 1, 1, 'shop', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(24, 'Image-2', 'data/app/shop/1574934874_shop-slider.png', '', 2, 'top', 1, 1, 'shop', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(25, 'Image-3', 'data/app/shop/1574934895_shop-slider.png', '', 3, 'top', 1, 1, 'shop', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(26, 'Image-4', 'data/app/shop/1574934911_shop-slider.png', '', 4, 'top', 1, 1, 'shop', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(27, 'Image-5', 'data/app/shop/1574934926_shop-slider.png', '', 5, 'top', 1, 1, 'shop', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(28, 'Image-6', 'data/app/shop/1574934945_shop-slider.png', '', 6, 'top', 1, 1, 'shop', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(29, 'Image-1', 'data/app/about_us/1574934337_aboutus-slider.png', '', 1, 'top', 1, 1, 'about_us', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(30, 'Image-2', 'data/app/about_us/1574934353_aboutus-slider.png', '', 2, 'top', 1, 1, 'about_us', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(31, 'Image-3', 'data/app/about_us/1574934377_aboutus-slider.png', '', 3, 'top', 1, 1, 'about_us', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(32, 'Image-3', 'data/app/patient_dashboard/1575607357_dashboard-slider.png', '', 1, 'top', 1, 1, 'patient_dashboard', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(33, 'Image-3', 'data/app/patient_dashboard/1575607373_dashboard-slider.png', '', 2, 'top', 1, 1, 'patient_dashboard', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(34, 'Image-3', 'data/app/patient_dashboard/1575607395_dashboard-slider.png', '', 3, 'top', 1, 1, 'patient_dashboard', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(35, 'Image-3', 'data/app/health_awareness/1575611421_health-awareness2.png', '', 1, 'top', 1, 1, 'health_awareness', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(36, 'Image-3', 'data/app/hospital_map/1575612545_hospital-map.png', '', 1, 'top', 1, 1, 'hospital_map', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(37, 'Image-3', 'data/app/hospital_map/1575612562_hospital-map.png', '', 2, 'top', 1, 1, 'hospital_map', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(38, 'Image-3', 'data/app/hospital_map/1575612579_hospital-map.png', '', 3, 'top', 1, 1, 'hospital_map', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(39, 'Image-3', 'data/app/send_otp/1575613609_send-otp.png', '', 1, 'top', 1, 1, 'send_otp', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(40, 'Image-3', '', '', 1, 'top', 1, 1, 'match_otp', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(41, 'Image-3', 'data/app/reset_password_otp/1575613666_send-otp.png', '', 1, 'top', 1, 1, 'reset_password_otp', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(42, 'Image-3', '', '', 1, 'top', 1, 1, 'reset_password_match_otp', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(43, 'Image-3', 'data/app/all_doctor/1575608065_doctor-slide.png', '', 1, 'top', 1, 1, 'all_doctor', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(44, 'Image-3', 'data/app/all_doctor/1575608085_doctor-slide.png', '', 2, 'top', 1, 1, 'all_doctor', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(45, 'Image-3', 'data/app/all_doctor/1575608102_doctor-slide.png', '', 3, 'top', 1, 1, 'all_doctor', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(46, 'Image-3', 'data/app/doctor_details/1575608495_doctor-slide.png', '', 1, 'top', 1, 1, 'doctor_details', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(47, 'Image-3', 'data/app/doctor_details/1575608515_doctor-slide.png', '', 2, 'top', 1, 1, 'doctor_details', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(48, 'Image-3', 'data/app/doctor_details/1575608534_doctor-slide.png', '', 3, 'top', 1, 1, 'doctor_details', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1),
(49, 'Image-6', '', '', 7, 'top', 0, 1, 'tour_guide', 'A', 1, 0, 1, '2019-11-07', 1, '2019-11-07', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_app_info_setting`
--

CREATE TABLE `hms_app_info_setting` (
  `ID` tinyint(4) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `emergency_contact_number` varchar(255) NOT NULL,
  `fax_number` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `map_api_key` varchar(300) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `about_us` text NOT NULL,
  `android_version` varchar(255) NOT NULL,
  `ios_version` varchar(255) NOT NULL,
  `terms_of_services` text NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) DEFAULT 1,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_app_info_setting`
--

INSERT INTO `hms_app_info_setting` (`ID`, `name`, `contact_number`, `emergency_contact_number`, `fax_number`, `email_id`, `map_api_key`, `latitude`, `longitude`, `address`, `about_us`, `android_version`, `ios_version`, `terms_of_services`, `gmail`, `facebook`, `twitter`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Hanh Phuc International Hospital', '19006765', '19006765', '+84 6503636068', 'info@hanhphuchospital.com', 'AIzaSyArYeNczYWwlrTikPpnn-zsWZ_9K303f2U', '10.8683703', '106.7121339', '18 Binh duong Boulevard, Thuan an District,\r\nBinh Duong Province, Viet Nam', 'Our Vision\r\nTo be the hospital of choice for women and children by partnering our patients and their families in delivering services that are effective, differentiated and integrated care for the well-being of our patients.\r\n\r\n \r\nOur Mission\r\nTo provide high standard of clinical quality care and personalized services with respect, compassion and understanding.\r\n\r\n \r\nOur Philosophy\r\nAt the heart of HANH PHUC’s philosophy of care is a commitment to not just meet but exceed our patients’ expectations. At HANH PHUC International Hospital, we want our patients to experience family-oriented care.\r\n \r\nA great deal of effort is put into creating the right ambience for our patients from tastefully/designed and comfortable rooms to personalized services to meet the individual and unique needs of our patients. Because every life is precious, we uphold the philosophy of celebrating life with our patients and their family while caring for them to achieve the best possible clinical outcome.', '1.0.1', '1.0.1', ' Upon accessing any part of www.hanhphuchospital.com, you shall be deemed as having agreed to be legally bound by these Terms of Use (as may be amended from time to time by HANH PHUC International Hospital. These Terms of Use shall be governed and construed in accordance with the laws of Vietnam.\r\n\r\n \r\n\r\nUse of Materials\r\nMaterials on www.hanhphuchospital.com (“Materials”), including but not limited to text, graphics and images, are protected by copyright, trade mark and other laws, and any unauthorized use of such Materials by you may violate such laws. The contents of this website should not be quoted or reproduced without prior written permission from HANH PHUC International Hospital.\r\n\r\n \r\n\r\nDisclaimer\r\nTHIS WEBSITE DOES NOT PROVIDE MEDICAL ADVICE NOR PURPORTS TO DO SO. The contents of this website are meant purely for informational and educational purposes only. The website is not a substitute for medical advice, diagnosis, treatment or professional care. If you have or suspect you have a health problem, you should consult a doctor or a qualified healthcare provider. Do not disregard professional medical advice or delay in seeking it because of something you have read on this website.\r\n\r\n \r\n\r\nAny reliance by you on the information contained in this website shall be at your own risk. HANH PHUC International Hospital makes no express or implied representation or warranty regarding the completeness, accuracy, reliability or currency of the information contained in the Materials. To the fullest extent permitted by law, HANH PHUC International Hospital disclaims all express or implied warranties, including but not limited to, warranties of satisfactory quality, merchantability, and fitness for a particular purpose. HANH PHUC International Hospital shall not be liable for any damage or loss of any kind directly or indirectly arising from or in connection with your use or inability to access www.hanhphuchospital.com and/or use the Materials.\r\n\r\n \r\n\r\nThe provision of access to other external websites is solely for your convenience and does not imply HANH PHUC International Hospital’s endorsement of, or affiliation or association to, the linked web sites or their operators. HANH PHUC International Hospital is not responsible for the availability, accuracy or content of these external sites. Your access of any linked web site shall be at your sole risk. HANH PHUC International Hospital shall not be responsible for any damage or loss to you arising from or in connection with your use of such web sites', 'https://www.gmail.com/test', 'https://www.facebook.com/test', 'https://www.twitter.com/test', 1, '2019-12-09', 1, '2019-12-09', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_awareness`
--

CREATE TABLE `hms_awareness` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_group` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `awareness_image` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `push_notification` tinyint(1) NOT NULL COMMENT 'PT: 1 (Yes), 0 (No)',
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_awareness`
--

INSERT INTO `hms_awareness` (`ID`, `name`, `customer_group`, `start_date`, `end_date`, `awareness_image`, `description`, `push_notification`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Do You Know the ABCs of Health Care?', 'Women', '2019-11-01', '2019-11-10', 'data/awareness-image/2019/12/1575012184_health-awareness.png', 'Lorem Ipsum is simply dummy\r\ntext of the printing and\r\ntypesetting industry.\r\nLorem Ipsum has been the industry\'s\r\nstandard dummy text ever ', 1, 'A', 1, 0, 1, '2019-11-06', 1, '2019-11-14', 1, 1, 1, 1),
(8, 'Testing Awarenes 2', 'All', '2019-11-15', '2019-11-21', 'data/awareness-image/2019/12/1575012108_health-awareness.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibhLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh', 1, 'A', 1, 0, 1, '2019-11-15', 1, '2019-11-29', 1, 1, 1, 1),
(9, 'Lorem ipsum dolor sit amet, consectetuer adipi', 'All', '2019-11-29', '2019-11-29', 'data/awareness-image/2019/12/1575012282_health-awareness.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibhLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh', 0, 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(10, 'Lorem ipsum dolor sit amet, consectetuer', 'All', '2019-11-29', '2019-11-29', 'data/awareness-image/2019/12/1575012322_health-awareness.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibhLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh', 0, 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(11, 'Lorem ipsum dolor sit amet', 'All', '2019-11-29', '2019-11-29', 'data/awareness-image/2019/12/1575012369_appointment-slider.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibhLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh', 0, 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(12, 'Lorem ipsum dolor sit', 'All', '2019-11-28', '2019-12-30', 'data/awareness-image/2019/12/1575012446_appointment-slider.png', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibhLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh', 0, 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-30', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_awar_push_notification`
--

CREATE TABLE `hms_awar_push_notification` (
  `ID` int(11) NOT NULL,
  `awareness_id` int(11) NOT NULL,
  `home_banner` tinyint(1) NOT NULL,
  `home_banner_start` time NOT NULL,
  `home_banner_end` time NOT NULL,
  `home_slider_banner` tinyint(1) NOT NULL,
  `home_slider_start` time NOT NULL,
  `home_slider_end` time NOT NULL,
  `notiocation_page_banner` tinyint(1) NOT NULL,
  `notiocation_page_start` time NOT NULL,
  `notiocation_page_end` time NOT NULL,
  `notiocation_banner` tinyint(1) NOT NULL,
  `notiocation_start` time NOT NULL,
  `notiocation_end` time NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_awar_push_notification`
--

INSERT INTO `hms_awar_push_notification` (`ID`, `awareness_id`, `home_banner`, `home_banner_start`, `home_banner_end`, `home_slider_banner`, `home_slider_start`, `home_slider_end`, `notiocation_page_banner`, `notiocation_page_start`, `notiocation_page_end`, `notiocation_banner`, `notiocation_start`, `notiocation_end`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 1, 1, '01:15:00', '22:50:00', 1, '02:23:00', '12:00:00', 1, '10:55:00', '14:09:00', 1, '11:50:00', '01:10:00', 0, 'A', 1, 1, '2019-11-14', 1, '2019-11-14', 1, 1, 1, 1),
(4, 8, 1, '01:05:00', '10:50:00', 1, '02:10:00', '06:00:00', 1, '06:00:00', '06:00:00', 0, '00:00:00', '00:00:00', 0, 'A', 1, 1, '2019-11-15', 1, '2019-11-29', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_chat_questions`
--

CREATE TABLE `hms_chat_questions` (
  `ID` int(11) NOT NULL,
  `question_english` text NOT NULL,
  `question_vietnamese` text NOT NULL,
  `patient_type` tinyint(11) NOT NULL,
  `question_type` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hms_chat_questions`
--

INSERT INTO `hms_chat_questions` (`ID`, `question_english`, `question_vietnamese`, `patient_type`, `question_type`, `is_deleted`, `status`, `date_created`) VALUES
(1, 'Please tell me have you even been visited Hanh Phuc International Hospital before?', 'Xin cho hỏi chị đã từng khám ở BVQT Hạnh Phúc lần nào trước đây chưa?', 0, 1, 0, 1, '2019-12-04 11:08:48'),
(2, 'Please tell me your full name', 'Xin cho biết Họ và tên đầy đủ của chị', 0, 1, 0, 1, '2019-12-04 11:09:53'),
(3, 'Please tell me the date of birth', 'Xin cho biết ngày tháng năm sinh', 0, 1, 0, 1, '2019-12-04 11:10:41'),
(4, 'Please tell me your full name', 'Xin cho biết Họ và tên đầy đủ của chị', 0, 1, 0, 1, '2019-12-04 11:11:12'),
(5, 'Please tell me the reason of the check up?', 'Xin cho hỏi chị muốn khám vấn đề gì?', 0, 1, 0, 1, '2019-12-04 11:11:50'),
(6, 'Please tell me which department you want to see?', 'Xin cho hỏi chị muốn khám khoa nào?', 0, 1, 0, 1, '2019-12-04 11:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `hms_contact`
--

CREATE TABLE `hms_contact` (
  `ID` int(11) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `office_location` text NOT NULL,
  `working_hours` text NOT NULL,
  `facebook_link` varchar(200) NOT NULL,
  `gmail_link` varchar(200) NOT NULL,
  `linkin_link` varchar(200) NOT NULL,
  `twitter_link` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_countries`
--

CREATE TABLE `hms_countries` (
  `ID` int(3) NOT NULL,
  `country_code1` varchar(255) NOT NULL,
  `country_code2` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` tinyint(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL DEFAULT 1,
  `updater_date` date NOT NULL,
  `company_id` tinyint(1) NOT NULL DEFAULT 1,
  `branch_id` tinyint(1) NOT NULL DEFAULT 1,
  `division_id` tinyint(1) NOT NULL DEFAULT 1,
  `other_id` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_countries`
--

INSERT INTO `hms_countries` (`ID`, `country_code1`, `country_code2`, `name`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'AF', 'AFG', 'Afghanistan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(2, 'AL', 'ALB', 'Albania', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(3, 'DZ', 'DZA', 'Algeria', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(4, 'AS', 'ASM', 'American Samoa', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(5, 'AD', 'AND', 'Andorra', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(6, 'AO', 'AGO', 'Angola', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(7, 'AI', 'AIA', 'Anguilla', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(8, 'AQ', 'ATA', 'Antarctica', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(9, 'AG', 'ATG', 'Antigua and Barbuda', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(10, 'AR', 'ARG', 'Argentina', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(11, 'AM', 'ARM', 'Armenia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(12, 'AW', 'ABW', 'Aruba', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(13, 'AU', 'AUS', 'Australia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(14, 'AT', 'AUT', 'Austria', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(15, 'AZ', 'AZE', 'Azerbaijan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(16, 'BS', 'BHS', 'Bahamas (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(17, 'BH', 'BHR', 'Bahrain', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(18, 'BD', 'BGD', 'Bangladesh', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(19, 'BB', 'BRB', 'Barbados', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(20, 'BY', 'BLR', 'Belarus', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(21, 'BE', 'BEL', 'Belgium', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(22, 'BZ', 'BLZ', 'Belize', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(23, 'BJ', 'BEN', 'Benin', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(24, 'BM', 'BMU', 'Bermuda', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(25, 'BT', 'BTN', 'Bhutan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(26, 'BO', 'BOL', 'Bolivia (Plurinational State of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(27, 'BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(28, 'BA', 'BIH', 'Bosnia and Herzegovina', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(29, 'BW', 'BWA', 'Botswana', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(30, 'BV', 'BVT', 'Bouvet Island', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(31, 'BR', 'BRA', 'Brazil', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(32, 'IO', 'IOT', 'British Indian Ocean Territory (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(33, 'BN', 'BRN', 'Brunei Darussalam', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(34, 'BG', 'BGR', 'Bulgaria', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(35, 'BF', 'BFA', 'Burkina Faso', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(36, 'BI', 'BDI', 'Burundi', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(37, 'CV', 'CPV', 'Cabo Verde', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(38, 'KH', 'KHM', 'Cambodia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(39, 'CM', 'CMR', 'Cameroon', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(40, 'CA', 'CAN', 'Canada', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(41, 'KY', 'CYM', 'Cayman Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(42, 'CF', 'CAF', 'Central African Republic (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(43, 'TD', 'TCD', 'Chad', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(44, 'CL', 'CHL', 'Chile', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(45, 'CN', 'CHN', 'China', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(46, 'CX', 'CXR', 'Christmas Island', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(47, 'CC', 'CCK', 'Cocos (Keeling) Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(48, 'CO', 'COL', 'Colombia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(49, 'KM', 'COM', 'Comoros (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(50, 'CD', 'COD', 'Congo (the Democratic Republic of the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(51, 'CG', 'COG', 'Congo (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(52, 'CK', 'COK', 'Cook Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(53, 'CR', 'CRI', 'Costa Rica', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(54, 'HR', 'HRV', 'Croatia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(55, 'CU', 'CUB', 'Cuba', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(56, 'CW', 'CUW', 'Curaçao', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(57, 'CY', 'CYP', 'Cyprus', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(58, 'CZ', 'CZE', 'Czechia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(59, 'CI', 'CIV', 'Côte d\'Ivoire', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(60, 'DK', 'DNK', 'Denmark', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(61, 'DJ', 'DJI', 'Djibouti', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(62, 'DM', 'DMA', 'Dominica', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(63, 'DO', 'DOM', 'Dominican Republic (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(64, 'EC', 'ECU', 'Ecuador', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(65, 'EG', 'EGY', 'Egypt', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(66, 'SV', 'SLV', 'El Salvador', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(67, 'GQ', 'GNQ', 'Equatorial Guinea', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(68, 'ER', 'ERI', 'Eritrea', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(69, 'EE', 'EST', 'Estonia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(70, 'SZ', 'SWZ', 'Eswatini', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(71, 'ET', 'ETH', 'Ethiopia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(72, 'FK', 'FLK', 'Falkland Islands (the) [Malvinas]', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(73, 'FO', 'FRO', 'Faroe Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(74, 'FJ', 'FJI', 'Fiji', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(75, 'FI', 'FIN', 'Finland', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(76, 'FR', 'FRA', 'France', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(77, 'GF', 'GUF', 'French Guiana', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(78, 'PF', 'PYF', 'French Polynesia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(79, 'TF', 'ATF', 'French Southern Territories (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(80, 'GA', 'GAB', 'Gabon', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(81, 'GM', 'GMB', 'Gambia (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(82, 'GE', 'GEO', 'Georgia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(83, 'DE', 'DEU', 'Germany', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(84, 'GH', 'GHA', 'Ghana', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(85, 'GI', 'GIB', 'Gibraltar', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(86, 'GR', 'GRC', 'Greece', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(87, 'GL', 'GRL', 'Greenland', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(88, 'GD', 'GRD', 'Grenada', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(89, 'GP', 'GLP', 'Guadeloupe', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(90, 'GU', 'GUM', 'Guam', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(91, 'GT', 'GTM', 'Guatemala', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(92, 'GG', 'GGY', 'Guernsey', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(93, 'GN', 'GIN', 'Guinea', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(94, 'GW', 'GNB', 'Guinea-Bissau', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(95, 'GY', 'GUY', 'Guyana', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(96, 'HT', 'HTI', 'Haiti', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(97, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(98, 'VA', 'VAT', 'Holy See (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(99, 'HN', 'HND', 'Honduras', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(100, 'HK', 'HKG', 'Hong Kong', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(101, 'HU', 'HUN', 'Hungary', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(102, 'IS', 'ISL', 'Iceland', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(103, 'IN', 'IND', 'India', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(104, 'ID', 'IDN', 'Indonesia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(105, 'IR', 'IRN', 'Iran (Islamic Republic of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(106, 'IQ', 'IRQ', 'Iraq', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(107, 'IE', 'IRL', 'Ireland', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(108, 'IM', 'IMN', 'Isle of Man', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(109, 'IL', 'ISR', 'Israel', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(110, 'IT', 'ITA', 'Italy', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(111, 'JM', 'JAM', 'Jamaica', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(112, 'JP', 'JPN', 'Japan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(113, 'JE', 'JEY', 'Jersey', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(114, 'JO', 'JOR', 'Jordan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(115, 'KZ', 'KAZ', 'Kazakhstan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(116, 'KE', 'KEN', 'Kenya', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(117, 'KI', 'KIR', 'Kiribati', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(118, 'KP', 'PRK', 'Korea (the Democratic People\'s Republic of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(119, 'KR', 'KOR', 'Korea (the Republic of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(120, 'KW', 'KWT', 'Kuwait', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(121, 'KG', 'KGZ', 'Kyrgyzstan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(122, 'LA', 'LAO', 'Lao People\'s Democratic Republic (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(123, 'LV', 'LVA', 'Latvia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(124, 'LB', 'LBN', 'Lebanon', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(125, 'LS', 'LSO', 'Lesotho', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(126, 'LR', 'LBR', 'Liberia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(127, 'LY', 'LBY', 'Libya', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(128, 'LI', 'LIE', 'Liechtenstein', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(129, 'LT', 'LTU', 'Lithuania', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(130, 'LU', 'LUX', 'Luxembourg', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(131, 'MO', 'MAC', 'Macao', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(132, 'MG', 'MDG', 'Madagascar', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(133, 'MW', 'MWI', 'Malawi', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(134, 'MY', 'MYS', 'Malaysia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(135, 'MV', 'MDV', 'Maldives', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(136, 'ML', 'MLI', 'Mali', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(137, 'MT', 'MLT', 'Malta', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(138, 'MH', 'MHL', 'Marshall Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(139, 'MQ', 'MTQ', 'Martinique', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(140, 'MR', 'MRT', 'Mauritania', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(141, 'MU', 'MUS', 'Mauritius', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(142, 'YT', 'MYT', 'Mayotte', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(143, 'MX', 'MEX', 'Mexico', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(144, 'FM', 'FSM', 'Micronesia (Federated States of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(145, 'MD', 'MDA', 'Moldova (the Republic of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(146, 'MC', 'MCO', 'Monaco', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(147, 'MN', 'MNG', 'Mongolia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(148, 'ME', 'MNE', 'Montenegro', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(149, 'MS', 'MSR', 'Montserrat', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(150, 'MA', 'MAR', 'Morocco', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(151, 'MZ', 'MOZ', 'Mozambique', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(152, 'MM', 'MMR', 'Myanmar', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(153, 'NA', 'NAM', 'Namibia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(154, 'NR', 'NRU', 'Nauru', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(155, 'NP', 'NPL', 'Nepal', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(156, 'NL', 'NLD', 'Netherlands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(157, 'NC', 'NCL', 'New Caledonia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(158, 'NZ', 'NZL', 'New Zealand', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(159, 'NI', 'NIC', 'Nicaragua', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(160, 'NE', 'NER', 'Niger (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(161, 'NG', 'NGA', 'Nigeria', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(162, 'NU', 'NIU', 'Niue', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(163, 'NF', 'NFK', 'Norfolk Island', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(164, 'MP', 'MNP', 'Northern Mariana Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(165, 'NO', 'NOR', 'Norway', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(166, 'OM', 'OMN', 'Oman', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(167, 'PK', 'PAK', 'Pakistan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(168, 'PW', 'PLW', 'Palau', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(169, 'PS', 'PSE', 'Palestine, State of', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(170, 'PA', 'PAN', 'Panama', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(171, 'PG', 'PNG', 'Papua New Guinea', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(172, 'PY', 'PRY', 'Paraguay', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(173, 'PE', 'PER', 'Peru', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(174, 'PH', 'PHL', 'Philippines (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(175, 'PN', 'PCN', 'Pitcairn', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(176, 'PL', 'POL', 'Poland', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(177, 'PT', 'PRT', 'Portugal', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(178, 'PR', 'PRI', 'Puerto Rico', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(179, 'QA', 'QAT', 'Qatar', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(180, 'MK', 'MKD', 'Republic of North Macedonia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(181, 'RO', 'ROU', 'Romania', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(182, 'RU', 'RUS', 'Russian Federation (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(183, 'RW', 'RWA', 'Rwanda', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(184, 'RE', 'REU', 'Réunion', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(185, 'BL', 'BLM', 'Saint Barthélemy', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(186, 'SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(187, 'KN', 'KNA', 'Saint Kitts and Nevis', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(188, 'LC', 'LCA', 'Saint Lucia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(189, 'MF', 'MAF', 'Saint Martin (French part)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(190, 'PM', 'SPM', 'Saint Pierre and Miquelon', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(191, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(192, 'WS', 'WSM', 'Samoa', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(193, 'SM', 'SMR', 'San Marino', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(194, 'ST', 'STP', 'Sao Tome and Principe', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(195, 'SA', 'SAU', 'Saudi Arabia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(196, 'SN', 'SEN', 'Senegal', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(197, 'RS', 'SRB', 'Serbia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(198, 'SC', 'SYC', 'Seychelles', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(199, 'SL', 'SLE', 'Sierra Leone', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(200, 'SG', 'SGP', 'Singapore', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(201, 'SX', 'SXM', 'Sint Maarten (Dutch part)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(202, 'SK', 'SVK', 'Slovakia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(203, 'SI', 'SVN', 'Slovenia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(204, 'SB', 'SLB', 'Solomon Islands', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(205, 'SO', 'SOM', 'Somalia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(206, 'ZA', 'ZAF', 'South Africa', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(207, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(208, 'SS', 'SSD', 'South Sudan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(209, 'ES', 'ESP', 'Spain', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(210, 'LK', 'LKA', 'Sri Lanka', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(211, 'SD', 'SDN', 'Sudan (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(212, 'SR', 'SUR', 'Suriname', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(213, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(214, 'SE', 'SWE', 'Sweden', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(215, 'CH', 'CHE', 'Switzerland', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(216, 'SY', 'SYR', 'Syrian Arab Republic', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(217, 'TW', 'TWN', 'Taiwan (Province of China)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(218, 'TJ', 'TJK', 'Tajikistan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(219, 'TZ', 'TZA', 'Tanzania, United Republic of', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(220, 'TH', 'THA', 'Thailand', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(221, 'TL', 'TLS', 'Timor-Leste', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(222, 'TG', 'TGO', 'Togo', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(223, 'TK', 'TKL', 'Tokelau', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(224, 'TO', 'TON', 'Tonga', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(225, 'TT', 'TTO', 'Trinidad and Tobago', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(226, 'TN', 'TUN', 'Tunisia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(227, 'TR', 'TUR', 'Turkey', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(228, 'TM', 'TKM', 'Turkmenistan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(229, 'TC', 'TCA', 'Turks and Caicos Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(230, 'TV', 'TUV', 'Tuvalu', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(231, 'UG', 'UGA', 'Uganda', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(232, 'UA', 'UKR', 'Ukraine', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(233, 'AE', 'ARE', 'United Arab Emirates (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(234, 'GB', 'GBR', 'United Kingdom of Great Britain and Northern Ireland (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(235, 'UM', 'UMI', 'United States Minor Outlying Islands (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(236, 'US', 'USA', 'United States of America (the)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(237, 'UY', 'URY', 'Uruguay', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(238, 'UZ', 'UZB', 'Uzbekistan', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(239, 'VU', 'VUT', 'Vanuatu', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(240, 'VE', 'VEN', 'Venezuela (Bolivarian Republic of)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(241, 'VN', 'VNM', 'Viet Nam', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(242, 'VG', 'VGB', 'Virgin Islands (British)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(243, 'VI', 'VIR', 'Virgin Islands (U.S.)', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(244, 'WF', 'WLF', 'Wallis and Futuna', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(245, 'EH', 'ESH', 'Western Sahara', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(246, 'YE', 'YEM', 'Yemen', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(247, 'ZM', 'ZMB', 'Zambia', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(248, 'ZW', 'ZWE', 'Zimbabwe', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1),
(249, 'AX', 'ALA', 'Åland Islands', 'A', 1, 0, 1, '0000-00-00', 1, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_districts`
--

CREATE TABLE `hms_districts` (
  `ID` int(3) NOT NULL,
  `country_code1` varchar(255) NOT NULL,
  `district_code` int(5) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` tinyint(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL DEFAULT 1,
  `updater_date` date NOT NULL,
  `company_id` tinyint(1) NOT NULL DEFAULT 1,
  `branch_id` tinyint(1) NOT NULL DEFAULT 1,
  `division_id` tinyint(1) NOT NULL DEFAULT 1,
  `other_id` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_districts`
--

INSERT INTO `hms_districts` (`ID`, `country_code1`, `district_code`, `name`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'VN', 1, 'An Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(2, 'VN', 2, 'Bac Lieu', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(3, 'VN', 3, 'Ben Tre', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(4, 'VN', 4, 'Binh Thuan', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(5, 'VN', 5, 'Can Tho', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(6, 'VN', 6, 'Da Nang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(7, 'VN', 7, 'Dak Nong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(8, 'VN', 8, 'Dien Bien', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(9, 'VN', 9, 'Dong Thap', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(10, 'VN', 10, 'Gia Lai', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(11, 'VN', 11, 'Ha Noi', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(12, 'VN', 12, 'Hai Duong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(13, 'VN', 13, 'Hai Phong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(14, 'VN', 14, 'Haiphong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(15, 'VN', 15, 'Hanoi', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(16, 'VN', 16, 'Hau Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(17, 'VN', 17, 'Ho Chi Minh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(18, 'VN', 18, 'Ho Chi Minh City', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(19, 'VN', 19, 'Hung Yen', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(20, 'VN', 20, 'Kon Tum', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(21, 'VN', 21, 'Lam Dong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(22, 'VN', 22, 'Long An', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(23, 'VN', 23, 'Nam Dinh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(24, 'VN', 24, 'Phu Tho', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(25, 'VN', 25, 'Quang Nam', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(26, 'VN', 26, 'Quảng Ngãi Province', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(27, 'VN', 27, 'Quang Ninh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(28, 'VN', 28, 'Soc Trang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(29, 'VN', 29, 'Son La', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(30, 'VN', 30, 'Tây Ninh Province', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(31, 'VN', 31, 'Thai Binh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(32, 'VN', 32, 'Thai Nguyen', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(33, 'VN', 33, 'Thanh Hoa', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(34, 'VN', 34, 'Thanh Pho Can Tho', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(35, 'VN', 35, 'Thanh Pho GJa Nang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(36, 'VN', 36, 'Thanh Pho Ha Noi', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(37, 'VN', 37, 'Thanh Pho Hai Phong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(38, 'VN', 38, 'Tien Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(39, 'VN', 39, 'Tinh Ba Ria-Vung Tau', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(40, 'VN', 40, 'Tinh Bac Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(41, 'VN', 41, 'Tinh Bac Kan', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(42, 'VN', 42, 'Tinh Bac Lieu', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(43, 'VN', 43, 'Tinh Bac Ninh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(44, 'VN', 44, 'Tinh Ben Tre', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(45, 'VN', 45, 'Tinh Binh Dinh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(46, 'VN', 46, 'Tinh Binh Duong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(47, 'VN', 47, 'Tinh Binh GJinh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(48, 'VN', 48, 'Tinh Binh Phuoc', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(49, 'VN', 49, 'Tinh Binh Thuan', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(50, 'VN', 50, 'Tinh Ca Mau', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(51, 'VN', 51, 'Tinh Cao Bang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(52, 'VN', 52, 'Tinh Dien Bien', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(53, 'VN', 53, 'Tinh GJak Lak', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(54, 'VN', 54, 'Tinh GJong Nai', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(55, 'VN', 55, 'Tinh GJong Thap', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(56, 'VN', 56, 'Tinh Ha Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(57, 'VN', 57, 'Tinh Ha Nam', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(58, 'VN', 58, 'Tinh Ha Tinh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(59, 'VN', 59, 'Tinh Hai Duong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(60, 'VN', 60, 'Tinh Hoa Binh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(61, 'VN', 61, 'Tinh Hung Yen', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(62, 'VN', 62, 'Tinh Khanh Hoa', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(63, 'VN', 63, 'Tinh Kien Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(64, 'VN', 64, 'Tinh Lai Chau', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(65, 'VN', 65, 'Tinh Lam GJong', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(66, 'VN', 66, 'Tinh Lang Son', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(67, 'VN', 67, 'Tinh Lao Cai', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(68, 'VN', 68, 'Tinh Nam GJinh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(69, 'VN', 69, 'Tinh Nghe An', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(70, 'VN', 70, 'Tinh Ninh Binh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(71, 'VN', 71, 'Tinh Ninh Thuan', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(72, 'VN', 72, 'Tinh Phu Tho', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(73, 'VN', 73, 'Tinh Phu Yen', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(74, 'VN', 74, 'Tinh Quang Binh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(75, 'VN', 75, 'Tinh Quang Nam', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(76, 'VN', 76, 'Tinh Quang Ngai', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(77, 'VN', 77, 'Tinh Quang Ninh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(78, 'VN', 78, 'Tinh Quang Tri', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(79, 'VN', 79, 'Tinh Soc Trang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(80, 'VN', 80, 'Tinh Son La', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(81, 'VN', 81, 'Tinh Tay Ninh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(82, 'VN', 82, 'Tinh Thai Binh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(83, 'VN', 83, 'Tinh Thai Nguyen', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(84, 'VN', 84, 'Tinh Thanh Hoa', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(85, 'VN', 85, 'Tinh Thua Thien-Hue', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(86, 'VN', 86, 'Tinh Tien Giang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(87, 'VN', 87, 'Tinh Tra Vinh', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(88, 'VN', 88, 'Tinh Tuyen Quang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(89, 'VN', 89, 'Tinh Vinh Long', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(90, 'VN', 90, 'Tinh Vinh Phuc', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(91, 'VN', 91, 'Tinh Yen Bai', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(92, 'VN', 92, 'Tuyen Quang', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1),
(93, 'VN', 93, 'Đắk Lắk', 'A', 1, 0, 1, '2019-11-19', 1, '2019-11-19', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor`
--

CREATE TABLE `hms_doctor` (
  `ID` int(11) NOT NULL,
  `mcr` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `alternet_number` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '1: Male, 2: Female, 3: Other',
  `dob` date NOT NULL,
  `image` varchar(300) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `department_code` varchar(255) NOT NULL,
  `primary_department_code` varchar(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor`
--

INSERT INTO `hms_doctor` (`ID`, `mcr`, `title`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email_id`, `contact_number`, `alternet_number`, `gender`, `dob`, `image`, `grade`, `department_code`, `primary_department_code`, `is_available`, `status`, `show_status`, `is_deleted`, `description`, `last_login`, `last_logout`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '123456789', '', 'Admin', '', '', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '07,05,11,10,03,12,09,08,02,04,OTH,01,06,SPA', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(2, 'DR01923', 'Dr', 'Bianca James', '', '', '', '', '', '01425221', '', 1, '1970-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(3, '110504', '', 'Bui', 'Gio', 'An', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(4, '100906', '', 'Bui Ngoc Uyen Chi', '', '', '', '', '', 'NA', '', 2, '2016-06-13', '', 'Doctor', '05,07,09', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(5, '110133', '', 'Bùi', 'Long', 'Thân', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(6, '960000', '', 'Bùi', 'Minh', 'Hải', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(7, 'EXTDR111101', '', 'Bùi', 'Ngọc', 'Phượng', '', '', '', '0913 676 835', '', 2, '1980-01-01', '', 'Doctor', '02,07', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(8, '140902', '', 'Bùi Thị', 'Phương', 'Nga', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(9, '160211', '', 'Bùi', 'Thị Trúc', 'My', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(10, 'EXTDR552013', '', 'Bạch', 'Cẩm', 'An', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(11, '140603', '', 'Cam', 'Ngọc', 'Phượng', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(12, 'EXTDR1108018', '', 'Cao', 'Hữu', 'Thịnh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(13, 'EXTDR472013', '', 'Chu', 'Thị', 'Bá', '', '', '', '1', '', 2, '1980-01-01', '', 'Level D', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(14, '160217', '', 'Châu', 'Thị Ngọc', 'Ánh', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(15, '120407', '', 'Châu Thị', 'Xuân', 'Cẩm', '', '', '', '1', '', 2, '1980-01-01', '', 'Standard', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(16, '100800', '', 'Cái Thị', 'Thùy', 'Trang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(17, 'DOCTOR01', '', 'DOCTOR01', '', '', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,05,11,10,03,07,12,09,08,04,OTH,01,06,SPA', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(18, 'DOCTOR02', '', 'DOCTOR02', '', '', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(19, 'DOCTOR03', '', 'DOCTOR03', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(20, 'DOCTOR04', '', 'DOCTOR04', '', '', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(21, 'DOCTOR05', '', 'DOCTOR05', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(22, 'DOCTOR06', '', 'DOCTOR06', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(23, 'DOCTOR07', '', 'DOCTOR07', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(24, 'DOCTOR08', '', 'DOCTOR08', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(25, 'DOCTOR09', '', 'DOCTOR09', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(26, 'DOCTOR10', '', 'DOCTOR10', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(27, '1929192', '', 'DRPHARMACY', '', '', '', '', '', '.', '', 2, '1931-10-08', '', 'Standard', '01,OG', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(28, '110605', '', 'Dang Thi', 'Huynh', 'Yen', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(29, '100901', '', 'Dinh Huynh Thi Nguyet', '', '', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(30, '110403', '', 'Dinh', 'Thi', 'Hong', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(31, '100701', '', 'Dinh Van Tam', '', '', '', '', '', 'NA', '', 2, '2016-09-05', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(32, '100802', '', 'Do Danh Toan', '', '', '', '', '', 'NA', '', 1, '1948-06-27', '', 'Doctor', '03,07,12,02', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(33, '100932', '', 'Do Duc Tin', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '03,12,OTH', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(34, '090801', '', 'Do Thi Kim Quynh', '', '', '', '', '', 'NA', '', 2, '1985-03-25', '', 'Doctor', '07,05,11,10,03,12,09,08,02,04,OTH,01,06,SPA', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(35, '110810', '', 'Doan', 'Chau', 'Quynh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(36, 'HPE0003', '', 'Doctor', '', '1', '', '', '', '.', '', 2, '1980-01-01', '', 'Standard', 'OG,03,07,02,01,06', 'OG', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(37, 'HPE0004', '', 'Doctor', '', '2', '', '', '', '.', '', 1, '1980-01-01', '', 'Standard', '03,07,02,OG,01,06', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(38, '777777', '', 'Dr', 'Reserved', 'Vaccine', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,05,11,10,03,07,12,09,08,02,04,OTH,06,SPA', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(39, '101111', '', 'Duong', 'Minh', 'Cuong', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(40, 'EXTDR392013', '', 'Dương', 'Ngọc', 'Diệp', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(41, 'EXTDR111014', '', 'Dương', 'Phương', 'Mai', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(42, 'EXTDR111017', '', 'Dương Thị', 'Thu', 'Hải', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(43, 'EXTDR442013', '', 'Dương', 'Đăng', 'Hanh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(44, 'EXTDR', '', 'External Doctor', '', '', '', '', '', 'NA', '', 1, '1980-01-01', '', 'Doctor', '03,05,10,07,09,08,02,04,OTH,01,06', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(45, 'EXTDR622013', '', 'Giang', 'Châu', 'Võ', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(46, '100710', 'Mr', 'Ha Minh Thong', '', '', '', '', '', 'NA', '', 1, '1986-10-24', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(47, '110807', '', 'Ha Nguyen', 'Bich', 'Thuy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(48, '100975', '', 'Ha Van Dan', '', '', '', '', '', 'NA', '', 2, '2010-09-06', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(49, 'V00002', 'Dr', 'Hang', 'Seok', 'Choi', '', '', '', '1', '', 1, '1965-01-01', '', 'Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(50, '121102-E', 'Dr', 'Hang', 'Seok', 'Choi', '', '', '', '0000000000', '', 1, '1950-12-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(51, '101048', '', 'Ho Huy Tuan', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '03,12,OTH', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(52, '100618', '', 'Ho Nguyen Tien', '', '', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Standard', '02,07,08,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(53, '101206', '', 'Ho', 'Thanh', 'Tung', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(54, '140901', '', 'Ho Thi Hoang Anh', '', '', '', '', '', 'NA', '', 2, '1977-06-01', '', 'Doctor', '06,07,12,02,OTH', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(55, '110209', '', 'Ho', 'Tran', 'Ban', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(56, '110119', '', 'Hoang', 'Ngoc', 'Hai', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(57, '101219', '', 'Hoang Thi', 'Diem', 'Thuy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,08', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(58, '111006', '', 'Hoàng', 'Ngọc', 'Dung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(59, 'EXTDR982015', '', 'Hoàng Thị', 'Diễm', 'Tuyết', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(60, '160208', '', 'Hoàng', 'Trọng', 'Biên', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(61, '717000', '', 'Hua', 'Hoang', 'Yen', '', '', '', '.', '', 2, '1980-01-01', '', 'Standard', 'OG,07,02,01', 'OG', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(62, '101220', '', 'Huynh', 'Thanh', 'Hung', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01,08,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(63, '100911', '', 'Huynh Thi Thu Thao', '', '', '', '', '', 'NA', '', 2, '2017-09-29', '', 'Doctor', '02,07,09', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(64, '101227', '', 'Huynh Vo', 'Dong', 'Vuong', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12,OTH', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(65, '160414', '', 'Huỳnh', 'Kim', 'Tuấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,05,11,10,07,12,09,08,02,04,OTH,01,06,SPA', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(66, '150703', '', 'Huỳnh', 'Phượng', 'Hải', '', '', '', '123', '', 2, '1980-01-01', '', 'External Doctor', '03', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(67, 'EXTDR182012', '', 'Huỳnh', 'Thị', 'Hiếu', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(68, '902000', '', 'Huỳnh Thị', 'Hồng', 'Nghĩa', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(69, '160218', '', 'Huỳnh', 'Thị Ngọc', 'Thúy', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(70, 'EXTDR112012', '', 'Huỳnh Thị', 'Thúy', 'Mai', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(71, 'EXTDR802014', '', 'Huỳnh', 'Thị', 'Trong', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(72, '150602', '', 'Huỳnh', 'Văn', 'Nhàn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(73, 'EXTDR782014', 'Dr', 'Huỳnh', 'Văn', 'Tiên', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '09,07,02', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(74, '130506', '', 'Huỳnh Vĩnh', 'Phạm', 'Uyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(75, '121105-E', '', 'Hye', 'Won', 'Paik', '', '', '', '1', '', 1, '1980-01-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(76, '121108-E', 'Dr', 'Hyung', 'Jun', 'Kim', '', '', '', '00000000', '', 1, '1950-12-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(77, '120201', '', 'Hà', 'Duy', 'Tú', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(78, 'EXTDR1111021', '', 'Hà', 'Tố', 'Nguyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(79, '968000', '', 'Hồ Châu', 'Anh', 'Thư', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(80, 'EXTDR932015', '', 'Hồ Kỳ', 'Thu', 'Nguyệt', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(81, '120710', '', 'Hồ', 'Quang', 'Nhật', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(82, 'EXTDR962015', '', 'Hồ', 'Quyết', 'Thắng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(83, '130209', '', 'Hồ', 'Quốc', 'Khải', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,14', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(84, '857000', '', 'Hồ', 'Quốc', 'Pháp', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(85, '151002', 'Dr', 'Hồ', 'Thái', 'Sơn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(86, 'EXTDR682014', '', 'Hồ', 'Thị', 'Cúc', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(87, '130306', '', 'Hồ Thị', 'Kim', 'Thoa', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(88, 'EXTDR232013', '', 'Hồ', 'Thị', 'Ngọc', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(89, '151120', 'Dr', 'Hồ Thị', 'Thanh ', 'Phương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(90, '120506', '', 'Hồ', 'Xuân', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(91, '123457', '', 'IT-Doctor', '', '', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '10,07,02', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(92, 'EXTDR1108020', '', 'JEAN', 'CLAUDE', 'TISSOT', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(93, '121104-E', 'Dr', 'Joon', 'Sung', 'Bae', '', '', '', '00000000000', '', 1, '1950-01-01', '', 'Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(94, '864000', '', 'Kamal', '', 'Jalil', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(95, '140707', '', 'Kimi', '', 'Kan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(96, '121101-E', 'Dr', 'Kwon', '', 'Joo', '', '', '', '0000000000', '', 1, '1950-12-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(97, 'HPH001270', 'Mr', 'LE', ' PHAN TUAN ', 'KHOA', '', '', '', '11', '', 1, '1987-03-17', '', 'Standard', '07,05,11,10,03,12,09,15,08,02,OG,04,OTH,01,06,SPA,14', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(98, 'EXTDR101212', 'Dr', 'LE', 'TOAN', 'THANG', '', '', '', '065093636066', '', 1, '1943-12-01', '', 'External Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(99, '100201', 'Dr', 'LE', 'VAN', 'DUC', '', '', '', '0949808701', '', 2, '1980-01-01', '', 'Level A', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(100, '111119', '', 'Le ', 'Thi', 'Ngoc Bich', '', '', '', '.', '', 2, '2018-05-01', '', 'Standard', '02,07', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(101, '100947', '', 'Le Hoang Chuong', '', '', '', '', '', 'NA', '', 2, '2009-10-14', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(102, '110214', '', 'Le Kim Nghia', 'Bao', 'Hanh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(103, '110609', '', 'Le', 'Minh', 'Dien', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(104, '110402', '', 'Le', 'Thanh', 'Hien', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(105, 'EXTDR1109013', '', 'Le Thi', 'Hoa', 'Binh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(106, '110106', '', 'Le Thi', 'Ngoc', 'Cang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(107, '110104', '', 'Le', 'Thi', 'Thao', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(108, '110216', '', 'Le Thi', 'Thu', 'Thao', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,05,11,10,07,12,09,08,02,04,OTH,01,06,SPA', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(109, '100837', '', 'Le Van Quy', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '01,08,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(110, '936000', '', 'Lâm Xuân', 'Thục', 'Quyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(111, 'EXTDR322013', '', 'Lê', 'Anh', 'Phương', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(112, '150806', '', 'Lê', 'Anh', 'Tài', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '07,04', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(113, 'EXTDR082012', '', 'Lê', 'Anh', 'Tài', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(114, '130119', '', 'Lê', 'Hoàng', 'Gia', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(115, '120505', '', 'Lê', 'Hải', 'Lợi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(116, '160517', 'Dr', 'Lê Hồ', 'Minh', 'Thức', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(117, '121007', '', 'Lê', 'Hồng', 'Chính', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(118, 'EXTDR872014', '', 'Lê', 'Hồng', 'Cẩm', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(119, '131202', '', 'Lê', 'Hữu', 'Bình', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(120, 'HPH001006', '', 'Lê', 'Lệ', 'Quyên', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '05,11,10,03,07,12,09,15,08,02,OG,04,OTH,01,06,SPA,14', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(121, 'EXTDR912014', '', 'Lê', 'Ngọc', 'Diệp', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(122, 'EXTDR11060104', '', 'Lê', 'Quang', 'Thanh', '', '', '', '1', '', 1, '1964-12-22', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(123, '160216', '', 'Lê', 'Quang', 'Thạnh', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(124, 'EXTDR572013', '', 'Lê', 'Thanh', 'Hùng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(125, '160212', '', 'Lê', 'Thanh', 'Hải', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(126, 'EXTDR11060205', '', 'Lê', 'Thị Anh', 'Thư', '', '', '', '1', '', 2, '1961-08-20', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(127, '141201', '', 'Lê Thị', 'Cẩm', 'Tú', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(128, 'EXTDR972015', '', 'Lê Thị', 'Hải', 'Yến', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(129, '121209', '', 'Lê Thị', 'Hồng', 'Huệ', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(130, 'EXTDR1124020', '', 'Lê Thị', 'Kiều', 'Dung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(131, 'EXTDR122012', '', 'Lê Thị', 'Lan', 'Phương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(132, '811000', '', 'Lê Thị', 'Thanh ', 'Tu', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(133, '150601', '', 'Lê Thị', 'Thanh', 'Thủy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(134, 'EXTDR512013', '', 'Lê Thị', 'Thu', 'Hà', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(135, '130904', '', 'Lê Thị', 'Thu', 'Mai', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(136, 'EXTDR672014', '', 'Lê Thị', 'Thu', 'Trang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(137, '130118', '', 'Lê Thị', 'Thúy', 'Hằng', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(138, '121105', '', 'Lê', 'Thị', 'Vy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(139, '150801', '', 'Lê', 'Toàn', 'Thắng', '', '', '', '123', '', 1, '1980-01-01', '', 'External Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(140, 'EXTDR742014', '', 'Lê Trần', 'Anh', 'Thư', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(141, '130905', '', 'Lê', 'Tấn', 'Bảo', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(142, 'EXTDR252013', '', 'Lê', 'Tấn', 'Cảnh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(143, 'EXTDR262013', '', 'Lê', 'Văn', 'Hiền', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(144, '130101', '', 'Lê Xuân', 'Hoàng', 'Khanh', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(145, '131001', '', 'Lê Đình', 'Trà', 'Mân', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(146, 'EXTDR092012', '', 'Lý', 'Thái', 'Lộc', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(147, 'EXTDR312013', '', 'Lăng Thị', 'Hữu', 'Hiệp', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(148, 'EXTDR642014', '', 'Lưu', 'Thế', 'Duyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(149, 'EXTDR11060307', '', 'Lương', '', 'Thiềm', '', '', '', '1', '', 2, '1953-10-12', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(150, '120905', '', 'Lương', 'Thúy', 'Vân', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(151, 'EXTDR882014', '', 'Lệnh', 'Tú', 'Cường', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(152, '100942', '', 'Lữ', 'Văn', 'Thật', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(153, '110306', '', 'Mai Dao', 'Ai', 'Nhu', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(154, '150301', '', 'Mai', 'Minh', 'Phương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(155, '101217', '', 'Mai', 'Van', 'Bon', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(156, '121107-E', '', 'Myung', 'Chui', 'Kim', '', '', '', '1', '', 1, '1980-01-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(157, '100502', '', 'NGUYỄN THỊ', 'HẠNH', 'LÊ', '', '', '', 'NA', '', 2, '1956-11-05', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(158, '60701', '', 'NGUYỄN', 'THỤC', 'ANH', '', '', '', 'NA', '', 2, '1982-12-17', '', 'Doctor', '02,05,11,10,03,07,12,09,08,04,OTH,01,06,SPA', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(159, '110109', '', 'Ngo', '', 'Sau', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(160, '101216', '', 'Nguyen', 'Cong', 'Vien', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(161, '110118', '', 'Nguyen', 'Dinh', 'Hao', '', '', '', '1', '', 1, '1980-01-10', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(162, '100614', '', 'Nguyen Dinh Vinh', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(163, '101225', '', 'Nguyen Do', 'Nhu', 'Tue', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(164, '110501', '', 'Nguyen', 'Hoai', 'Thu', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(165, '110107', '', 'Nguyen', 'Huu', 'Nguyen', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(166, '110116', '', 'Nguyen', 'Huu', 'Thuan', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,07', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(167, '110806', '', 'Nguyen Huynh', 'Cam', 'Tu', '', '', '', '1', '', 2, '1984-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(168, '100810', '', 'Nguyen The Giang Thanh', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '04,05,11,10,03,07,12,09,08,02,OTH,01,06,SPA,14', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(169, '100835', '', 'Nguyen Thi Hai Thanh', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(170, '110204', '', 'Nguyen Thi', 'Minh', 'Tam', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(171, '100832', '', 'Nguyen Thi Thien An', '', '', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(172, 'EXTDR110902', '', 'Nguyen Thi', 'Thu', 'Ha', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(173, '110131', '', 'Nguyen Thi', 'Tuyet', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(174, '121004', '', 'Nguyen Tran', 'Bao', 'Chi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(175, '110110', '', 'Nguyen', 'Van', 'Hanh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(176, '110108', '', 'Nguyen Vu', 'Dang', 'Thu', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(177, 'EXTDR452013', '', 'Nguyễn', 'Anh', 'Danh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(178, '111111', '', 'Nguyễn', 'Anh', 'Tuấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(179, 'EXTDR1108019', '', 'Nguyễn Bá', 'Mỹ', 'Nhi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(180, 'EXTDR372013', '', 'Nguyễn', 'Bích', 'Hải', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(181, 'EXTDR120101', '', 'Nguyễn', 'Duy', 'Tài', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(182, '151010', '', 'Nguyễn', 'Hoàng Anh', 'Thư', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '01,07,06', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(183, '120603', '', 'Nguyễn Hoàng', 'Mai', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(184, 'EXTDR332013', '', 'Nguyễn', 'Hoàng', 'Tuấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(185, '160504', '', 'Nguyễn Hồng ', 'Thanh ', 'Thảo', '', '', '', '1', '', 2, '1980-01-01', '', 'Level C', 'OG,11,10,03,07,12,09,15,08,02,04,OTH,01,06,SPA,14', 'OG', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(186, '140801', '', 'Nguyễn', 'Hữu', 'Hòa', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '11', '11', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(187, 'EXTDR11030202 ', '', 'Nguyễn', 'Hữu', 'Trung', '', '', '', '1', '', 1, '1973-10-06', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(188, '786000', '', 'Nguyễn', 'Minh', 'Ngọc', '', '', '', '1', '', 1, '1980-01-01', '', 'Standard', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(189, '908000', '', 'Nguyễn Minh', 'Thanh', 'Giang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '15', '15', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(190, '130923', '', 'Nguyễn', 'Mạnh', 'Bảo', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(191, 'EXTDR352013', '', 'Nguyễn Ngô Thị', 'Tố', 'Như', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(192, 'EXTDR712014', '', 'Nguyễn Ngọc', 'Diễm', 'Uyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(193, '729000', 'Dr', 'Nguyễn Ngọc', 'Mai', 'Huy', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(194, '160215', '', 'Nguyễn', 'Ngọc', 'Phước', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(195, '120901', '', 'Nguyễn', 'Phúc', 'Thịnh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(196, 'EXTDR272013', '', 'Nguyễn', 'Phương', 'Thảo', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(197, '120802', '', 'Nguyễn Phạm', 'Tuấn', 'Vinh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01,05,11,10,03,07,12,09,08,02,04,OTH,06,SPA', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(198, '120706', '', 'Nguyễn Quý', 'Tỷ', 'Dao', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(199, '130210', '', 'Nguyễn', 'Quốc', 'Hải', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(200, 'EXTDR362013', '', 'Nguyễn', 'Song', 'Nguyên', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(201, '160213', '', 'Nguyễn', 'Thanh', 'Long', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(202, '120803', '', 'Nguyễn', 'Thanh', 'Thiện', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(203, '150802', '', 'Nguyễn', 'Thanh', 'Trúc', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(204, 'EXTDR632013', '', 'Nguyễn', 'Thu', 'Đông', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(205, '815000', '', 'Nguyễn', 'Thành', 'Như', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(206, 'EXTDR272012', '', 'Nguyễn', 'Thành', 'Như', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(207, 'EXTDR562013', '', 'Nguyễn', 'Thái', 'Hà', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(208, '125000', '', 'Nguyễn', 'Thế', 'Huy', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(209, '120501', '', 'Nguyễn Thị', 'Anh', 'Đào', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,05,11,10,03,12,09,08,02,04,OTH,01,06,SPA', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(210, '120703', '', 'Nguyễn Thị', 'Bích', 'Ngọc', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(211, '121204', '', 'Nguyễn', 'Thị', 'Bảy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(212, '871000', '', 'Nguyễn Thị', 'Cẩm', 'Xuyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(213, '973000', '', 'Nguyễn Thị', 'Hoàng', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(214, '868000', '', 'Nguyễn', 'Thị', 'Huế', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(215, '884000', '', 'Nguyễn Thị', 'Hương', 'Thư', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(216, '140806', '', 'Nguyễn Thị', 'Hồng', 'Hoa', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12,OTH', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(217, '750000', '', 'Nguyễn Thị', 'Hồng', 'Hạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(218, '150514', '', 'Nguyễn', 'Thị', 'Khanh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1);
INSERT INTO `hms_doctor` (`ID`, `mcr`, `title`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email_id`, `contact_number`, `alternet_number`, `gender`, `dob`, `image`, `grade`, `department_code`, `primary_department_code`, `is_available`, `status`, `show_status`, `is_deleted`, `description`, `last_login`, `last_logout`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(219, '120804', '', 'Nguyễn Thị', 'Kim', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(220, 'EXTDR592013', '', 'Nguyễn Thị', 'Kim', 'Dung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(221, 'HPH643', '', 'Nguyễn Thị', 'Kim', 'Hạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(222, 'EXTDR862014', '', 'Nguyễn Thị', 'Kim', 'Viễn', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(223, '812000', '', 'Nguyễn Thị', 'Liên', 'Phương', '', '', '', '2', '', 2, '1980-01-01', '', 'Doctor', '02,07', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(224, '120507', '', 'Nguyễn Thị', 'Long', 'Giang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(225, 'EXTDR492013', '', 'Nguyễn Thị', 'Minh', 'Tuyết', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(226, '130105', '', 'Nguyễn Thị', 'Mộng', 'Loan', '', '', '', '1', '', 2, '1980-01-01', '', 'Standard', '07,12,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(227, '120406', '', 'Nguyễn Thị', 'Mỹ', 'Hạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(228, '120807', '', 'Nguyễn Thị', 'Ngọc', 'Dung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(229, '882000', '', 'Nguyễn Thị', 'Ngọc', 'Lan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(230, 'EXTDR032012', '', 'Nguyễn Thị', 'Ngọc', 'Lan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(231, 'EXTDR110804', '', 'Nguyễn', 'Thị Ngọc', 'Phượng', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,07,09,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(232, 'EXTDR142012', '', 'Nguyễn Thị', 'Ngọc', 'Sương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(233, '160206', '', 'Nguyễn', 'Thị Ngọc', 'Thịnh', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '07,04', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(234, 'EXTDR042012', '', 'Nguyễn Thị', 'Ngọc', 'Trang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(235, 'EXTDR292013', '', 'Nguyễn Thị', 'Ngọc', 'Trang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(236, '987000', '', 'Nguyễn Thị', 'Ngọc', 'Trang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02,OG', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(237, '120405', '', 'Nguyễn Thị', 'Quỳnh', 'Hương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(238, '121104', '', 'Nguyễn Thị', 'Quỳnh', 'Lan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(239, 'EXTDR342013', '', 'Nguyễn Thị', 'Song', 'Hà', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,07', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(240, 'EXTDR11050103 ', '', 'Nguyễn', 'Thị Thanh', 'Hà', '', '', '', '1', '', 2, '1960-03-15', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(241, '877000', '', 'Nguyễn Thị', 'Thanh', 'Hà', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(242, '120404', '', 'Nguyễn Thị', 'Thanh', 'Tâm', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(243, '160214', '', 'Nguyễn', 'Thị Thu', 'Hà', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(244, 'EXTDR602013', '', 'Nguyễn', 'Thị', 'Thắm', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(245, '130507', '', 'Nguyễn Thị Trang', 'Khánh', 'Linh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(246, 'EXTDR1129023', '', 'Nguyễn Thị', 'Vĩnh', 'Thành', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(247, '150503', '', 'Nguyễn Thị', 'Ái', 'Xuân', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(248, 'EXTDR722014', '', 'Nguyễn', 'Tiến', 'Minh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(249, '140206', '', 'Nguyễn', 'Trung', 'Thành', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(250, 'EXTDR11070210', '', 'Nguyễn', 'Trọng', 'Lưu', '', '', '', '0913903265', '', 1, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(251, 'EXTDR172012', '', 'Nguyễn', 'Tấn', 'Phát', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(252, '131201', '', 'Nguyễn', 'Tấn', 'Tài', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(253, '121106', '', 'Nguyễn', 'Tất', 'Thành', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(254, 'EXTDR110801', '', 'Nguyễn', 'Văn', 'Hưng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(255, '140805', '', 'Nguyễn', 'Văn', 'Hữu', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(256, '150701', '', 'Nguyễn', 'Văn', 'Linh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(257, '101091', '', 'Nguyễn', 'Văn', 'Nhân', '', '', '', '3', '', 1, '1972-01-11', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(258, '150516', '', 'Nguyễn', 'Văn', 'Sửu', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(259, '130704', '', 'Nguyễn', 'Xuân', 'Lan', '', '', '', '1', '', 2, '1984-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(260, 'EXTDR702014', '', 'Nguyễn', 'Xuân', 'Vũ', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(261, 'EXTDR102012', '', 'Nguyễn', '', 'Điền', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(262, '141109', '', 'Nguyễn', 'Đình', 'Huấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(263, 'EXTDR162012', '', 'Nguyễn', 'Đạo', 'Thuấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(264, '140911', '', 'Nguyễn Đặng', 'Bảo', 'Minh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(265, '870000', '', 'Nguyễn', 'Đỗ', 'Trọng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(266, '160209', '', 'Nguyễn', 'Đỗ Vũ', 'Linh', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(267, '120205', '', 'Nguyễn', 'Đức', 'Dũng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(268, '160501', '', 'Ngô', 'Anh', 'Thúy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(269, '131106', '', 'Ngô', 'Hồng', 'Thiết', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,05,11,10,07,12,09,08,02,04,OTH,01,06,SPA,14', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(270, '140509', '', 'Ngô Thị', 'Kim', 'Loan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(271, 'EXTDR902014', '', 'Ngô Thị', 'Phương', 'Mai', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(272, '160210', '', 'Ngô', 'Văn', 'Dũng', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(273, '160219', '', 'Nông', 'Thị Thùy', 'Dương', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(274, '110130', '', 'Pham', 'Phuong', 'Minh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(275, '12345', 'Dr', 'Pham', 'Phuong', 'Minh A', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(276, '110809', '', 'Pham Thi', 'Ngoc', 'Diep', '', '', '', '1', '', 2, '1980-01-01', '', 'Standard', '07,12,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(277, '101212', '', 'Pham', 'Tri', 'Dung', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12,OTH', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(278, '140920', 'Mr', 'Phan', 'Cao', 'Minh', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(279, '876000', '', 'Phan Hà', 'Minh', 'Hạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(280, '111005', '', 'Phan Nguyễn', 'Hoàng', 'Vân', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(281, '140502', 'Mr', 'Phan', 'Thành', 'Trung', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(282, '140403', '', 'Phan Thị', 'Hạnh', 'Quyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(283, '120903', '', 'Phan Thị', 'Hồng', 'Loan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(284, '918000', '', 'Phan Thị', 'Quỳnh', 'Như', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(285, 'EXTDR110812', '', 'Phan', 'Văn', 'Thám', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(286, 'EXTDR282013', '', 'Phan', 'Xuân', 'Khoa', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(287, '150102', '', 'Phan', 'Đăng', 'Nghị', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(288, '1009522', '', 'Phuoc', '', 'Quang', '', '', '', '123', '', 1, '1980-01-01', '', 'Level A', '07,02,OG', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(289, '140926', '', 'Phùng', 'Ngọc', 'Thư', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(290, '140802', '', 'Phùng Thị', 'Phương', 'Chi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '11', '11', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(291, '130207', '', 'Phùng Thị', 'Thu', 'Hằng', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(292, 'EXTDR692014', '', 'Phạm', '', 'Dung', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(293, '891000', '', 'Phạm Lê', 'Mỹ', 'Hạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '15', '15', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(294, '120704', '', 'Phạm Lưu', 'Nhất', 'Hoàng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(295, '151108', '', 'Phạm', 'Phương', 'Phi', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(296, 'EXTDR812014', '', 'Phạm', 'Quang', 'Nhật', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(297, '688000', '', 'Phạm', 'Thế', 'Vinh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(298, 'EXTDR772014', '', 'Phạm Thị', 'Hồng', 'Loan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(299, '160309', '', 'Phạm', 'Thị Lan', 'Phương', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(300, '111208', 'Ms', 'Phạm', 'Thị Minh', 'Trang', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(301, 'EXTDR842014', '', 'Phạm Thị', 'Thu', 'Hương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(302, '655', '', 'Phạm Thị', 'Thu', 'Thủy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(303, '120805', '', 'Phạm Thị', 'Việt', 'Dung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(304, 'EXTDR212012', '', 'Phạm Thị', 'Ánh', 'Tuyết', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(305, '120602', '', 'Phạm Thị', 'Đức', 'Lợi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(306, 'EXTDR11030101', '', 'Phạm', 'Thủy', 'Linh', '', '', '', '1', '', 2, '1961-10-01', '', 'Doctor', '07,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(307, 'EXTDR522013', '', 'Phạm', 'Thủy', 'Linh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(308, '141011', '', 'Phạm', 'Ái', 'Thụy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(309, '130509', 'Mr', 'Raymond', '', 'Chia', '', '', '', '123', '', 1, '2016-01-26', '', 'Doctor', '07,05,11,10,03,12,09,08,02,04,OTH,01,06,SPA', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(310, '111101', '', 'Robert', '', 'Riche', '', '', '', '123', '', 1, '1962-05-09', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(311, '121106-E', '', 'Soon', 'Hong', 'Kwon', '', '', '', '1', '', 2, '1980-01-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(312, '121103-E', '', 'Sung', 'Sik', 'Kim', '', '', '', '1', '', 1, '1980-01-01', '', 'External Doctor', '10', '10', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(313, 'HPH612', 'Dr', 'Sử Thị', 'Ngọc ', 'Quyến', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(314, 'V00001', '', 'Tay ', 'Eng ', 'Hseon ', '', '', '', '0065', '', 1, '1980-01-01', '', 'Doctor', '04', '04', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(315, '444444', '', 'Tay', 'Huan', 'Huan', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,05,11,10,03,07,12,09,08,04,OTH,01,06,SPA', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(316, '100836', '', 'Tieu Thanh Lieu', '', '', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Doctor', '01,08,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(317, '110115', '', 'To Thi', 'Tram', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(318, '110120', '', 'Tran', 'Duc', 'Tuan', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(319, '100403', '', 'Tran Huu Quang', '', '', '', '', '', 'NA', '', 2, '0000-00-00', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(320, '100812', '', 'Tran Kim Quyen', '', '', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(321, '110208', '', 'Tran Ngoc', 'Nhu', 'Bich', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(322, '911111', '', 'Tran', 'Thi', 'Dieu Linh', '', '', '', '.', '', 2, '2018-05-01', '', 'Standard', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(323, '110803', '', 'Tran Thi', 'Hoa', 'Phuong', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(324, 'HPH630', 'Dr', 'Trương ', 'Ngọc ', 'Quyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(325, '757000', '', 'Trương', 'Minh', 'Hiếu', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,05,11,10,03,12,09,08,02,04,OTH,01,06,SPA', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(326, '832000', '', 'Trương', 'Minh', 'Thuận', '', '', '', '1', '', 2, '1980-01-01', '', 'Standard', '01,05,11,10,03,07,12,09,15,08,02,04,OTH,06,SPA', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(327, 'EXTDR792014', '', 'Trương', 'Ngọc', 'Thảo', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(328, '100603', 'Dr', 'Trương', 'Ngọc', 'Tiến', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Doctor', '06,12', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(329, '824000', '', 'Trương', 'Quang', 'Hiển', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(330, '120504', '', 'Trương Thị', 'Ngọc', 'Phú', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(331, 'HPH629', 'Dr', 'Trương Thị', 'Phương', 'Uyên', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(332, '120904', '', 'Trương Thị', 'Thanh', 'Trúc', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(333, 'EXTDR922015', '', 'Trương', 'Thị', 'Thảo', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(334, '130102', '', 'Trần Hà', 'Phương', 'Tâm', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(335, '130809', '', 'Trần', '', 'Hùng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(336, '869000', '', 'Trần', 'Hồng', 'Nhạn', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(337, '120403', '', 'Trần', 'Lâm', 'Khoa', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(338, '120907', '', 'Trần Ngọc', 'Kim', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(339, '111115', '', 'Trần', 'Nhật', 'Thăng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(340, '140202', '', 'Trần Phan', 'Nhã', 'Vi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(341, 'EXTDR302013', '', 'Trần', 'Quang', 'Thành', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(342, '131014', '', 'Trần', 'Quế', 'Hoàng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(343, 'EXTDR072012', '', 'Trần', 'Thanh', 'Kỳ', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(344, '120906', '', 'Trần', 'Thanh', 'Thúy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(345, 'EXTDR382013', '', 'Trần Thị', 'Kim', 'Xuyến', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(346, 'EXTDR952015', '', 'Trần', 'Thị', 'Miền', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(347, '130801', '', 'Trần Thị', 'Thúy', 'Phương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(348, '120705', '', 'Trần Thị', 'Trúc', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(349, '140505', '', 'Trần', 'Thống', 'Nhất', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(350, '140103', 'Ms', 'Trần', 'Trọng Hạnh', 'Tường', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(351, 'EXTDR892014', '', 'Trần', 'Việt', 'Cường', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(352, 'EXTDR11060406', '', 'Trịnh', 'Hồng', 'Hạnh', '', '', '', '1', '', 2, '1969-07-12', '', 'Doctor', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(353, '111102', '', 'Trịnh Nhựt', 'Thư', 'Hương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(354, 'EXTDR822014', '', 'Trịnh', 'Quốc', 'Toàn', '', '', '', '123', '', 1, '1980-01-01', '', 'External Doctor', '09', '09', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(355, 'EXTDR482013', '', 'Tô Thị', 'Minh', 'Nguyệt', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(356, '130908', '', 'Tô', 'Vĩnh', 'Ninh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,07,12,02', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(357, '151005', '', 'Tăng', 'Thị Ngọc', 'Vân', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(358, '140804', '', 'Tạ', 'Thanh', 'Liêu', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '11', '11', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(359, 'EXTDR582013', '', 'Tạ Thị', 'Thanh', 'Thủy', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(360, '131002', '', 'Uông', 'Tuyết', 'Nhung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(361, '100301', '', 'Van Nguyen Thanh Nhan', '', '', '', '', '', 'NA', '', 2, '1977-07-01', '', 'Doctor', '02,05,11,10,03,07,12,09,08,04,OTH,01,06,SPA', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(362, '100834', '', 'Vo Minh Chuong', '', '', '', '', '', 'NA', '', 2, '1975-11-09', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(363, '110401', '', 'Vo Thanh', 'Lien', 'Anh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(364, '101218', '', 'Vo Thi', 'Phuong', 'Lien', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(365, '130803', '', 'Vo Thi Thuy Dieu', '', '', '', '', '', 'NA', '', 2, '1980-01-01', '', 'Level A', '02,07,OTH', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(366, '110902', '', 'Vu', 'Quang', 'Vinh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01,OTH', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(367, 'EXTDR532013', '', 'Võ Doãn', 'Mỹ', 'Thạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(368, '872000', '', 'Võ', 'Hoàng', 'Khoa', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(369, 'EXTDR542013', '', 'Võ', 'Minh', 'Tuấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(370, '141112', '', 'Võ', 'Nguyên', 'Đại', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(371, '140803', '', 'Võ', 'Thanh', 'Nhân', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '11', '11', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(372, '140205', '', 'Võ Thị', 'Cẩm', 'Hiền', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(373, 'EXTDR662014', '', 'Võ Thị', 'Diệu', 'Phương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(374, 'EXTDR412013', '', 'Vũ', 'Duy', 'Minh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(375, '160207', '', 'Vũ', 'Thị Phương', 'Thảo', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(376, 'EXTDR012012', '', 'Vũ Thị', 'Thanh', 'Dung', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(377, 'HPH637', 'Dr', 'Vũ', 'Tuấn', 'Ngọc', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(378, '150307', '', 'Vũ', 'Văn', 'Phi', '', '', '', '1', '', 1, '1980-01-01', '', 'Standard', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(379, '160205', '', 'Vũ', 'Đình', 'Tuân', '', '', '', '123', '', 1, '1980-01-01', '', 'Doctor', '07,04', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(380, '130901', '', 'Vương Doãn', 'Đan', 'Phương', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(381, '141107', '', 'Vương', 'Huy', 'Tuấn', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(382, '130211', '', 'Vương Đình', 'Hoàng', 'Dũng', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(383, '110409', '', 'Yeong', 'Cheng', 'Toh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,12,09,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(384, 'ZM-001', 'Mr', 'ZOLESHAN', 'MICHAEL', 'THOMAS', '', '', '', '3243424', '', 1, '1967-02-02', '', 'Doctor', '05', '05', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(385, '160310', '', 'lâm', 'Thị Ngọc', 'Anh', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(386, 'EXTDR762014', '', 'Âu', 'Nhựt', 'Luân', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(387, '120103', '', 'Đinh', 'Xuân', 'Diễm', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(388, '837000', '', 'Đoàn', 'Kim', 'Khuê', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(389, '935000', '', 'Đoàn Vũ', 'Đại', 'Nam', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '02,07', '02', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(390, '151106', '', 'Đào', 'Thị Yến', 'Thủy', '', '', '', '123', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(391, '130606', '', 'Đặng', 'Ngọc', 'Sinh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '03,12', '03', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(392, '875000', '', 'Đặng', 'Quốc', 'Bửu', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '15', '15', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(393, 'EXTDR111015', '', 'Đặng', 'Thị', 'Hà', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02,OTH', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(394, 'EXTDR022012', '', 'Đặng Thị', 'Trân', 'Hạnh', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(395, '100845', '', 'Đặng', 'Văn', 'Sỹ', '', '', '', 'NA', '', 1, '1973-01-01', '', 'Doctor', '', '', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(396, '938000', '', 'Đặng', 'Đình', 'Vinh', '', '', '', '1', '', 1, '1980-01-01', '', 'Doctor', '06', '06', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(397, '120203', '', 'Đỗ Ngọc', 'Xuân', 'Trang', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,12,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(398, '827000', '', 'Đỗ Thị', 'Hạ', 'Kỳ', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '01', '01', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(399, 'EXTDR402013', '', 'Đỗ Thị', 'Lệ', 'Chi', '', '', '', '1', '', 2, '1980-01-01', '', 'Doctor', '07,02', '07', 1, 'A', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor_address`
--

CREATE TABLE `hms_doctor_address` (
  `ID` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `address_line1` text CHARACTER SET utf8 NOT NULL,
  `address_line2` text CHARACTER SET utf8 NOT NULL,
  `address_line3` text CHARACTER SET utf8 NOT NULL,
  `address_line4` text CHARACTER SET utf8 NOT NULL,
  `address_line5` text CHARACTER SET utf8 NOT NULL,
  `address_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: home, 2: office',
  `postal_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `district_code` varchar(255) NOT NULL,
  `city_code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor_address`
--

INSERT INTO `hms_doctor_address` (`ID`, `doctor_id`, `address_line1`, `address_line2`, `address_line3`, `address_line4`, `address_line5`, `address_type`, `postal_code`, `country_code`, `state_code`, `district_code`, `city_code`, `active`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 1, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(2, 2, 'HCM', '', '', '', '', 1, '', 'GB', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(3, 3, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(4, 4, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'TN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(5, 5, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(6, 6, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(7, 7, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(8, 8, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(9, 9, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(10, 10, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(11, 11, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(12, 12, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(13, 13, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(14, 14, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(15, 15, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(16, 16, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(17, 17, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(18, 18, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(19, 19, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(20, 20, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(21, 21, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(22, 22, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(23, 23, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(24, 24, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(25, 25, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(26, 26, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(27, 27, '.', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(28, 28, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(29, 29, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(30, 30, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(31, 31, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(32, 32, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(33, 33, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(34, 34, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(35, 35, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(36, 36, '.', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(37, 37, '.', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(38, 38, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(39, 39, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(40, 40, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(41, 41, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(42, 42, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(43, 43, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(44, 44, 'HP', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(45, 45, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(46, 46, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(47, 47, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(48, 48, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(49, 49, 'Korea', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(50, 50, 'Binh Duong', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(51, 51, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(52, 52, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(53, 53, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(54, 54, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(55, 55, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(56, 56, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(57, 57, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(58, 58, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(59, 59, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(60, 60, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(61, 61, '.', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(62, 62, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(63, 63, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(64, 64, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(65, 65, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(66, 66, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(67, 67, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(68, 68, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(69, 69, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(70, 70, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(71, 71, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(72, 72, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(73, 73, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(74, 74, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(75, 75, '1', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(76, 76, 'Binh Duong', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(77, 77, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(78, 78, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(79, 79, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(80, 80, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(81, 81, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(82, 82, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(83, 83, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(84, 84, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(85, 85, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(86, 86, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(87, 87, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(88, 88, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(89, 89, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(90, 90, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(91, 91, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(92, 92, '1', '', '', '', '', 1, '', 'FR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(93, 93, 'Binh Duong', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(94, 94, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(95, 95, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(96, 96, 'Binh Duong', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(97, 97, '.', '8', '.', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(98, 98, 'BINH DUONG', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(99, 99, 'TP.HCM', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(100, 100, 'Doctor House', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(101, 101, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(102, 102, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(103, 103, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(104, 104, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(105, 105, 'Benh Vien Dai Hoc Y Duoc', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(106, 106, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(107, 107, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(108, 108, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(109, 109, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(110, 110, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(111, 111, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(112, 112, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(113, 113, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(114, 114, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(115, 115, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(116, 116, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(117, 117, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(118, 118, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(119, 119, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(120, 120, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(121, 121, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(122, 122, '47C Trần Phú', 'P.4', 'Q.5', 'HCM', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(123, 123, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(124, 124, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(125, 125, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(126, 126, '47C Trần Phú', 'P.4', 'Q.5', 'HCM', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(127, 127, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(128, 128, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(129, 129, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(130, 130, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(131, 131, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(132, 132, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(133, 133, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(134, 134, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(135, 135, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(136, 136, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(137, 137, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(138, 138, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(139, 139, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(140, 140, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(141, 141, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(142, 142, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(143, 143, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(144, 144, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(145, 145, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(146, 146, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(147, 147, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(148, 148, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(149, 149, '778/73 Nguyễn Kiệm', 'P.4', 'Phú Nhuận', 'HCM', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(150, 150, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(151, 151, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(152, 152, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(153, 153, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(154, 154, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(155, 155, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(156, 156, '1', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(157, 157, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(158, 158, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(159, 159, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(160, 160, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(161, 161, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(162, 162, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(163, 163, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(164, 164, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(165, 165, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(166, 166, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(167, 167, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(168, 168, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(169, 169, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(170, 170, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(171, 171, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(172, 172, 'Benh Vien Dong Nai', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(173, 173, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(174, 174, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(175, 175, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(176, 176, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(177, 177, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(178, 178, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(179, 179, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(180, 180, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(181, 181, 'ĐHYD', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(182, 182, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(183, 183, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(184, 184, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(185, 185, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(186, 186, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(187, 187, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(188, 188, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(189, 189, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(190, 190, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(191, 191, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(192, 192, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(193, 193, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(194, 194, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(195, 195, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(196, 196, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(197, 197, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(198, 198, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(199, 199, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(200, 200, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(201, 201, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(202, 202, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(203, 203, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(204, 204, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(205, 205, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(206, 206, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(207, 207, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(208, 208, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(209, 209, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(210, 210, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(211, 211, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(212, 212, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(213, 213, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(214, 214, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(215, 215, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(216, 216, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(217, 217, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(218, 218, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(219, 219, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(220, 220, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(221, 221, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(222, 222, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(223, 223, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(224, 224, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(225, 225, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(226, 226, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(227, 227, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(228, 228, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(229, 229, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(230, 230, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(231, 231, 'Từ Dũ', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(232, 232, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(233, 233, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(234, 234, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(235, 235, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(236, 236, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(237, 237, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(238, 238, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(239, 239, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(240, 240, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(241, 241, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(242, 242, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(243, 243, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(244, 244, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(245, 245, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(246, 246, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(247, 247, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(248, 248, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(249, 249, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(250, 250, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(251, 251, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(252, 252, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(253, 253, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(254, 254, 'Từ Dũ', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(255, 255, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(256, 256, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(257, 257, '18 BD', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(258, 258, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(259, 259, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(260, 260, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(261, 261, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(262, 262, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(263, 263, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(264, 264, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(265, 265, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(266, 266, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(267, 267, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(268, 268, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(269, 269, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(270, 270, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(271, 271, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(272, 272, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(273, 273, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(274, 274, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(275, 275, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(276, 276, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(277, 277, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(278, 278, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(279, 279, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(280, 280, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(281, 281, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(282, 282, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(283, 283, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(284, 284, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(285, 285, 'Đồng Nai Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(286, 286, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(287, 287, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(288, 288, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(289, 289, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(290, 290, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(291, 291, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(292, 292, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(293, 293, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(294, 294, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(295, 295, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(296, 296, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(297, 297, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(298, 298, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(299, 299, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(300, 300, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(301, 301, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(302, 302, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(303, 303, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(304, 304, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(305, 305, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(306, 306, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(307, 307, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(308, 308, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(309, 309, '123', '', '', '', '', 1, '', 'SG', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(310, 310, '123', '', '', '', '', 1, '', 'FR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(311, 311, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(312, 312, '1', '', '', '', '', 1, '', 'KR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(313, 313, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(314, 314, 'Singapore', '', '', '', '', 1, '', 'SG', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(315, 315, '1', '', '', '', '', 1, '', 'SG', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(316, 316, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(317, 317, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(318, 318, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(319, 319, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(320, 320, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(321, 321, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(322, 322, 'Doctor House', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(323, 323, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(324, 324, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(325, 325, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(326, 326, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(327, 327, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(328, 328, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(329, 329, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(330, 330, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(331, 331, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(332, 332, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(333, 333, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(334, 334, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(335, 335, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(336, 336, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(337, 337, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(338, 338, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(339, 339, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(340, 340, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(341, 341, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(342, 342, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(343, 343, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(344, 344, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(345, 345, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(346, 346, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(347, 347, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(348, 348, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(349, 349, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(350, 350, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(351, 351, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(352, 352, '1F2 Nguyễn Thái Sơn', 'P.3', 'Gò Vấp', 'HCM', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(353, 353, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(354, 354, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(355, 355, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(356, 356, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(357, 357, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(358, 358, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(359, 359, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(360, 360, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(361, 361, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(362, 362, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(363, 363, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(364, 364, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(365, 365, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(366, 366, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(367, 367, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(368, 368, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(369, 369, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(370, 370, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(371, 371, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(372, 372, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(373, 373, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(374, 374, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(375, 375, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(376, 376, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(377, 377, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(378, 378, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(379, 379, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(380, 380, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(381, 381, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(382, 382, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(383, 383, '1', '', '', '', '', 1, '', 'SG', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(384, 384, 'F23', 'Nineth Avenue', 'Kimington', 'Hanoi', '23727272', 1, '', 'AR', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(385, 385, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(386, 386, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(387, 387, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(388, 388, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(389, 389, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(390, 390, '123', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(391, 391, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(392, 392, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(393, 393, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(394, 394, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(395, 395, 'Hanh Phuc Hospital', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(396, 396, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(397, 397, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(398, 398, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(399, 399, '1', '', '', '', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor_availability`
--

CREATE TABLE `hms_doctor_availability` (
  `ID` int(11) NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `doctor_mcr` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `session_starttime` time NOT NULL,
  `session_endtime` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor_availability`
--

INSERT INTO `hms_doctor_availability` (`ID`, `doctor_id`, `doctor_mcr`, `date`, `session_starttime`, `session_endtime`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '2', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(2, '2', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(3, '2', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(4, '2', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(5, '2', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(6, '2', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(7, '2', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(8, '2', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(9, '2', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(10, '2', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(11, '3', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(12, '3', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(13, '3', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(14, '3', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(15, '3', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(16, '3', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(17, '3', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(18, '3', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(19, '3', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(20, '3', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(21, '4', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(22, '4', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(23, '4', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(24, '4', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(25, '4', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(26, '4', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(27, '4', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(28, '4', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(29, '4', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(30, '4', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(31, '5', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(32, '5', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(33, '5', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(34, '5', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(35, '5', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(36, '5', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(37, '5', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(38, '5', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(39, '5', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(40, '5', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(41, '6', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(42, '6', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(43, '6', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(44, '6', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(45, '6', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(46, '6', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(47, '6', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(48, '6', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(49, '6', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(50, '6', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(51, '7', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(52, '7', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(53, '7', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(54, '7', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(55, '7', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(56, '7', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(57, '7', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(58, '7', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(59, '7', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(60, '7', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(61, '8', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(62, '8', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(63, '8', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(64, '8', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(65, '8', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(66, '8', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(67, '8', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(68, '8', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(69, '8', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(70, '8', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(71, '9', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(72, '9', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(73, '9', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(74, '9', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(75, '9', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(76, '9', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(77, '9', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(78, '9', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(79, '9', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(80, '9', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(81, '10', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(82, '10', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(83, '10', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(84, '10', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(85, '10', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(86, '10', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(87, '10', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(88, '10', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(89, '10', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(90, '11', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(91, '10', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(92, '11', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(93, '11', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(94, '11', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(95, '11', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(96, '11', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(97, '11', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(98, '11', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(99, '11', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(100, '11', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(101, '11', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(102, '11', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(103, '12', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(104, '12', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(105, '12', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(106, '12', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(107, '12', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(108, '12', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(109, '12', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(110, '12', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(111, '12', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(112, '12', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(113, '12', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(114, '12', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(115, '13', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(116, '13', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(117, '13', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(118, '13', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(119, '13', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(120, '13', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(121, '13', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(122, '13', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(123, '13', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(124, '13', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(125, '13', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(126, '13', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(127, '14', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(128, '14', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(129, '14', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(130, '14', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(131, '14', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(132, '14', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(133, '14', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(134, '14', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(135, '14', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(136, '14', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(137, '14', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(138, '14', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(139, '15', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(140, '15', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(141, '15', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(142, '15', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(143, '15', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(144, '15', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(145, '16', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(146, '16', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(147, '16', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(148, '16', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(149, '16', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(150, '16', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(151, '17', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(152, '17', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(153, '17', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(154, '17', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(155, '17', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(156, '17', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(157, '18', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(158, '18', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(159, '18', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(160, '18', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(161, '18', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(162, '18', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(163, '19', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(164, '19', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(165, '19', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(166, '19', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(167, '19', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(168, '19', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(169, '20', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(170, '20', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(171, '20', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(172, '20', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(173, '20', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(174, '21', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(175, '20', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(176, '21', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(177, '21', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(178, '21', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(179, '21', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(180, '22', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(181, '21', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(182, '22', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(183, '22', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(184, '22', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(185, '23', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(186, '23', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(187, '22', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(188, '23', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(189, '22', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(190, '23', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(191, '24', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(192, '23', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(193, '24', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(194, '23', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(195, '24', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(196, '24', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(197, '24', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(198, '25', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(199, '24', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(200, '25', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(201, '25', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(202, '25', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(203, '25', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(204, '25', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(205, '26', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(206, '26', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(207, '26', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(208, '26', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(209, '26', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(210, '27', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(211, '26', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(212, '27', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(213, '27', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(214, '27', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(215, '27', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(216, '27', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(217, '28', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(218, '28', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(219, '28', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(220, '28', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(221, '28', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(222, '29', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(223, '28', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(224, '29', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(225, '29', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(226, '29', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(227, '29', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(228, '30', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(229, '29', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(230, '30', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(231, '30', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(232, '30', '', '2019-12-01', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(233, '31', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(234, '30', '', '2019-12-04', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(235, '30', '', '2019-12-05', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(236, '32', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(237, '31', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(238, '33', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(239, '32', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(240, '34', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(241, '33', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(242, '35', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(243, '34', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(244, '36', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(245, '35', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(246, '37', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(247, '36', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(248, '38', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(249, '38', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(250, '37', '', '2019-12-02', '13:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(251, '38', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(252, '38', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(253, '38', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(254, '38', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(255, '38', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(256, '38', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(257, '38', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(258, '38', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(259, '38', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(260, '38', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(261, '38', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(262, '39', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(263, '38', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(264, '39', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(265, '39', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(266, '39', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(267, '39', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(268, '39', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(269, '39', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(270, '39', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(271, '39', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(272, '39', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(273, '39', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(274, '39', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(275, '39', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(276, '40', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(277, '39', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(278, '40', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(279, '40', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(280, '40', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(281, '40', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(282, '40', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(283, '40', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(284, '40', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(285, '40', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(286, '40', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(287, '40', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(288, '40', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(289, '40', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(290, '40', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(291, '41', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(292, '41', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(293, '41', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(294, '41', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(295, '41', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(296, '41', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(297, '41', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(298, '41', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(299, '41', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(300, '41', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(301, '41', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(302, '41', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(303, '41', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(304, '41', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(305, '42', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(306, '42', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(307, '42', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(308, '42', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(309, '42', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(310, '42', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(311, '42', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(312, '42', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(313, '42', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(314, '42', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(315, '42', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(316, '42', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(317, '42', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(318, '42', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(319, '43', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(320, '43', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(321, '43', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(322, '43', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(323, '43', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(324, '43', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(325, '43', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(326, '43', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(327, '43', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(328, '43', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(329, '43', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(330, '43', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(331, '43', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(332, '43', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(333, '44', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(334, '44', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(335, '44', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(336, '44', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(337, '44', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(338, '44', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(339, '44', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(340, '44', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(341, '44', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(342, '44', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(343, '44', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(344, '44', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(345, '44', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(346, '44', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(347, '45', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(348, '45', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(349, '45', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(350, '45', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(351, '45', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(352, '45', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(353, '45', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(354, '45', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(355, '45', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(356, '45', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(357, '45', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(358, '45', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(359, '45', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(360, '45', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(361, '46', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(362, '46', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(363, '46', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(364, '46', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(365, '46', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(366, '46', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(367, '46', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(368, '46', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(369, '46', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(370, '46', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(371, '46', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(372, '46', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(373, '46', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(374, '46', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(375, '47', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(376, '47', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(377, '47', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(378, '47', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(379, '47', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(380, '47', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(381, '47', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(382, '47', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(383, '47', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(384, '47', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(385, '47', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(386, '47', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(387, '47', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(388, '47', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(389, '48', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(390, '48', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(391, '48', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(392, '48', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(393, '48', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(394, '48', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(395, '48', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(396, '48', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(397, '48', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(398, '48', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(399, '48', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(400, '48', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(401, '48', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(402, '48', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(403, '49', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(404, '49', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(405, '49', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(406, '49', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(407, '49', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(408, '49', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(409, '49', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(410, '49', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(411, '49', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(412, '49', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(413, '49', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(414, '49', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(415, '49', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(416, '49', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(417, '50', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(418, '50', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(419, '50', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(420, '50', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(421, '50', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(422, '50', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(423, '50', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(424, '50', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(425, '50', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(426, '50', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(427, '50', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(428, '50', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(429, '50', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(430, '50', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(431, '51', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(432, '51', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(433, '51', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(434, '51', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(435, '51', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(436, '51', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(437, '51', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(438, '51', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(439, '51', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(440, '51', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(441, '51', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(442, '51', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(443, '51', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(444, '51', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(445, '52', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(446, '52', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(447, '52', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(448, '52', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(449, '52', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(450, '52', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(451, '52', '', '2019-11-30', '20:00:00', '09:05:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(452, '52', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(453, '52', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1);
INSERT INTO `hms_doctor_availability` (`ID`, `doctor_id`, `doctor_mcr`, `date`, `session_starttime`, `session_endtime`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(454, '52', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(455, '52', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(456, '52', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(457, '52', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(458, '52', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(459, '53', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(460, '53', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(461, '53', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(462, '53', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(463, '53', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(464, '53', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(465, '53', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(466, '53', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(467, '53', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(468, '53', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(469, '53', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(470, '53', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(471, '53', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(472, '53', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(473, '54', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(474, '54', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(475, '54', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(476, '54', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(477, '54', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(478, '54', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(479, '54', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(480, '54', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(481, '54', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(482, '54', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(483, '54', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(484, '54', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(485, '55', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(486, '54', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(487, '55', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(488, '54', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(489, '55', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(490, '55', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(491, '55', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(492, '55', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(493, '55', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(494, '55', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(495, '55', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(496, '55', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(497, '55', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(498, '55', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(499, '55', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(500, '55', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(501, '56', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(502, '56', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(503, '56', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(504, '56', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(505, '56', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(506, '56', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(507, '56', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(508, '56', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(509, '56', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(510, '56', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(511, '56', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(512, '56', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(513, '56', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(514, '56', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(515, '57', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(516, '57', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(517, '57', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(518, '57', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(519, '57', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(520, '57', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(521, '57', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(522, '57', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(523, '57', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(524, '57', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(525, '57', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(526, '57', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(527, '57', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(528, '57', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(529, '58', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(530, '58', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(531, '58', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(532, '58', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(533, '58', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(534, '58', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(535, '58', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(536, '58', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(537, '58', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(538, '58', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(539, '58', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(540, '58', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(541, '58', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(542, '58', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(543, '59', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(544, '59', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(545, '59', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(546, '59', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(547, '59', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(548, '59', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(549, '59', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(550, '59', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(551, '59', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(552, '59', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(553, '59', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(554, '59', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(555, '59', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(556, '59', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(557, '60', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(558, '60', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(559, '60', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(560, '60', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(561, '60', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(562, '60', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(563, '60', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(564, '60', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(565, '60', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(566, '60', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(567, '60', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(568, '60', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(569, '60', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(570, '60', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(571, '61', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(572, '61', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(573, '61', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(574, '61', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(575, '61', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(576, '61', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(577, '61', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(578, '61', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(579, '61', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(580, '61', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(581, '61', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(582, '61', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(583, '61', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(584, '61', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(585, '62', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(586, '62', '', '2019-11-29', '10:25:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(587, '62', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(588, '62', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(589, '62', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(590, '62', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(591, '62', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(592, '62', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(593, '62', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(594, '62', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(595, '62', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(596, '62', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(597, '62', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(598, '62', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(599, '63', '', '2019-11-29', '08:45:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(600, '63', '', '2019-11-29', '08:45:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(601, '63', '', '2019-11-30', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(602, '63', '', '2019-11-30', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(603, '63', '', '2019-12-01', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(604, '63', '', '2019-12-01', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(605, '63', '', '2019-12-02', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(606, '63', '', '2019-12-02', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(607, '63', '', '2019-12-03', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(608, '63', '', '2019-12-03', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(609, '63', '', '2019-12-04', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(610, '63', '', '2019-12-04', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(611, '63', '', '2019-12-05', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(612, '63', '', '2019-12-05', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(613, '64', '', '2019-11-29', '08:45:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(614, '64', '', '2019-11-30', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(615, '64', '', '2019-12-01', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(616, '64', '', '2019-11-29', '08:45:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(617, '64', '', '2019-12-02', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(618, '64', '', '2019-11-30', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(619, '64', '', '2019-12-03', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(620, '64', '', '2019-12-01', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(621, '64', '', '2019-12-04', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(622, '64', '', '2019-12-02', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(623, '64', '', '2019-12-05', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(624, '64', '', '2019-12-03', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(625, '64', '', '2019-12-04', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(626, '64', '', '2019-12-05', '08:30:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(627, '65', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(628, '65', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(629, '66', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(630, '66', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(631, '67', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(632, '68', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(633, '67', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(634, '69', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(635, '68', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(636, '70', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(637, '69', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(638, '71', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(639, '70', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(640, '72', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(641, '71', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(642, '73', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(643, '72', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(644, '74', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(645, '73', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(646, '75', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(647, '74', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(648, '76', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(649, '75', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(650, '77', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(651, '76', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(652, '78', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(653, '77', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(654, '79', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(655, '78', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(656, '80', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(657, '79', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(658, '81', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(659, '80', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(660, '82', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(661, '81', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(662, '83', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(663, '82', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(664, '84', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(665, '83', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(666, '85', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(667, '84', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(668, '86', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(669, '85', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(670, '87', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(671, '88', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(672, '86', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(673, '89', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(674, '87', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(675, '90', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(676, '88', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(677, '91', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(678, '89', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(679, '92', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(680, '90', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(681, '93', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(682, '91', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(683, '94', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(684, '92', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(685, '95', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(686, '93', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(687, '96', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(688, '94', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(689, '97', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(690, '95', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(691, '98', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(692, '96', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(693, '97', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(694, '98', '', '2019-11-29', '07:00:00', '12:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(695, '143', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(696, '143', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(697, '143', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(698, '143', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(699, '143', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(700, '143', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(701, '143', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(702, '144', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(703, '144', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(704, '144', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(705, '144', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(706, '143', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(707, '144', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(708, '143', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(709, '144', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(710, '143', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(711, '144', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(712, '143', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(713, '143', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(714, '143', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(715, '143', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(716, '145', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(717, '145', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(718, '145', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(719, '145', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(720, '145', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(721, '144', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(722, '144', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(723, '145', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(724, '144', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(725, '145', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(726, '144', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(727, '144', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(728, '144', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(729, '144', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(730, '146', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(731, '146', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(732, '146', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(733, '146', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(734, '146', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(735, '146', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(736, '146', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(737, '145', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(738, '145', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(739, '145', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(740, '145', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(741, '145', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(742, '145', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(743, '147', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(744, '145', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(745, '147', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(746, '147', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(747, '147', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(748, '147', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(749, '147', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(750, '147', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(751, '146', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(752, '146', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(753, '146', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(754, '146', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(755, '146', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(756, '146', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(757, '146', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(758, '148', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(759, '148', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(760, '148', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(761, '148', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(762, '148', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(763, '148', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(764, '147', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(765, '148', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(766, '147', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(767, '147', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(768, '147', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(769, '147', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(770, '147', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(771, '147', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(772, '149', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(773, '149', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(774, '149', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(775, '149', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(776, '148', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(777, '149', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(778, '148', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(779, '149', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(780, '148', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(781, '149', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(782, '148', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(783, '148', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(784, '148', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(785, '148', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(786, '150', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(787, '150', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(788, '150', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(789, '150', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(790, '150', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(791, '150', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(792, '150', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(793, '149', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(794, '149', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(795, '149', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(796, '151', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(797, '149', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(798, '151', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(799, '149', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(800, '151', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(801, '149', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(802, '151', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(803, '149', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(804, '151', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(805, '151', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(806, '151', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(807, '150', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(808, '150', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(809, '150', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(810, '150', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(811, '150', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(812, '152', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(813, '150', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(814, '152', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(815, '150', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(816, '152', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(817, '152', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(818, '152', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(819, '152', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(820, '152', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(821, '151', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(822, '151', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(823, '151', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(824, '153', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(825, '151', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(826, '153', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(827, '151', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(828, '153', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(829, '151', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(830, '153', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(831, '151', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(832, '153', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(833, '153', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(834, '153', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(835, '152', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(836, '152', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(837, '152', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(838, '152', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(839, '152', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(840, '152', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(841, '154', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(842, '152', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(843, '154', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(844, '154', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(845, '154', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(846, '154', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(847, '154', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(848, '154', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(849, '153', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(850, '153', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(851, '153', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(852, '153', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(853, '155', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(854, '153', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(855, '155', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(856, '153', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(857, '155', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(858, '153', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(859, '155', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(860, '155', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(861, '155', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(862, '155', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(863, '156', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(864, '156', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(865, '156', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(866, '156', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(867, '156', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(868, '154', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(869, '156', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(870, '154', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(871, '156', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(872, '154', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(873, '154', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(874, '154', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(875, '154', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(876, '154', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(877, '155', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(878, '155', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(879, '155', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(880, '155', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(881, '155', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(882, '155', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(883, '155', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(884, '157', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(885, '156', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(886, '156', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(887, '158', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(888, '156', '', '2019-12-01', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(889, '156', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(890, '156', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(891, '156', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(892, '156', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(893, '159', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(894, '160', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(895, '161', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(896, '157', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(897, '162', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(898, '158', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(899, '163', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(900, '159', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(901, '164', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(902, '160', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(903, '165', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1);
INSERT INTO `hms_doctor_availability` (`ID`, `doctor_id`, `doctor_mcr`, `date`, `session_starttime`, `session_endtime`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(904, '161', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(905, '166', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(906, '162', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(907, '167', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(908, '163', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(909, '168', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(910, '164', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(911, '169', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(912, '165', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(913, '170', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(914, '166', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(915, '171', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(916, '167', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(917, '172', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(918, '168', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(919, '173', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(920, '169', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(921, '174', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(922, '170', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(923, '175', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(924, '171', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(925, '176', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(926, '172', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(927, '177', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(928, '173', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(929, '178', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(930, '174', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(931, '179', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(932, '180', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(933, '175', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(934, '181', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(935, '176', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(936, '182', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(937, '177', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(938, '183', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(939, '178', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(940, '184', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(941, '179', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(942, '180', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(943, '185', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(944, '185', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(945, '185', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(946, '185', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(947, '181', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(948, '186', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(949, '186', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(950, '186', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(951, '182', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(952, '186', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(953, '183', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(954, '187', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(955, '187', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(956, '187', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(957, '187', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(958, '184', '', '2019-11-29', '13:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(959, '188', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(960, '188', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(961, '188', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(962, '188', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(963, '185', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(964, '185', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(965, '185', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(966, '185', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(967, '189', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(968, '189', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(969, '189', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(970, '189', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(971, '186', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(972, '186', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(973, '186', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(974, '186', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(975, '190', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(976, '190', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(977, '190', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(978, '187', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(979, '190', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(980, '187', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(981, '187', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(982, '187', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(983, '191', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(984, '191', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(985, '188', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(986, '191', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(987, '188', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(988, '191', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(989, '188', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(990, '188', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(991, '192', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(992, '189', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(993, '192', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(994, '189', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(995, '192', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(996, '189', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(997, '192', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(998, '189', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(999, '193', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1000, '190', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1001, '193', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1002, '190', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1003, '193', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1004, '190', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1005, '193', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1006, '190', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1007, '194', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1008, '194', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1009, '191', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1010, '194', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1011, '194', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1012, '191', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1013, '191', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1014, '191', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1015, '195', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1016, '195', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1017, '195', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1018, '195', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1019, '192', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1020, '192', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1021, '192', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1022, '192', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1023, '196', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1024, '196', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1025, '196', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1026, '196', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1027, '193', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1028, '193', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1029, '193', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1030, '193', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1031, '197', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1032, '197', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1033, '197', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1034, '197', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1035, '194', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1036, '194', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1037, '194', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1038, '194', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1039, '198', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1040, '198', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1041, '198', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1042, '198', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1043, '195', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1044, '195', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1045, '195', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1046, '199', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1047, '195', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1048, '199', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1049, '199', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1050, '199', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1051, '196', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1052, '196', '', '2019-12-02', '00:00:00', '07:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1053, '196', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1054, '196', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1055, '200', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1056, '200', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1057, '200', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1058, '200', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1059, '197', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1060, '197', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1061, '197', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1062, '201', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1063, '197', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1064, '201', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1065, '201', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1066, '201', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1067, '198', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1068, '198', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1069, '198', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1070, '202', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1071, '198', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1072, '202', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1073, '202', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1074, '202', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1075, '199', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1076, '203', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1077, '199', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1078, '203', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1079, '199', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1080, '199', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1081, '203', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1082, '203', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1083, '200', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1084, '204', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1085, '200', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1086, '204', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1087, '200', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1088, '204', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1089, '200', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1090, '204', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1091, '201', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1092, '205', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1093, '201', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1094, '205', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1095, '201', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1096, '205', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1097, '201', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1098, '205', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1099, '202', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1100, '206', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1101, '202', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1102, '206', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1103, '202', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1104, '206', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1105, '202', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1106, '206', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1107, '203', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1108, '207', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1109, '203', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1110, '207', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1111, '203', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1112, '207', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1113, '203', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1114, '207', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1115, '204', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1116, '208', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1117, '204', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1118, '208', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1119, '204', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1120, '208', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1121, '204', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1122, '208', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1123, '205', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1124, '209', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1125, '205', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1126, '209', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1127, '205', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1128, '209', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1129, '205', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1130, '209', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1131, '206', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1132, '206', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1133, '210', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1134, '206', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1135, '210', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1136, '206', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1137, '210', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1138, '210', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1139, '207', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1140, '211', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1141, '207', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1142, '211', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1143, '207', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1144, '211', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1145, '207', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1146, '211', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1147, '208', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1148, '208', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1149, '212', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1150, '208', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1151, '212', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1152, '208', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1153, '212', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1154, '212', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1155, '209', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1156, '209', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1157, '209', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1158, '209', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1159, '213', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1160, '213', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1161, '213', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1162, '213', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1163, '210', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1164, '214', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1165, '210', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1166, '214', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1167, '210', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1168, '214', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1169, '210', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1170, '214', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1171, '211', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1172, '215', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1173, '211', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1174, '215', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1175, '211', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1176, '215', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1177, '211', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1178, '215', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1179, '212', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1180, '216', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1181, '212', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1182, '216', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1183, '212', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1184, '216', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1185, '212', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1186, '216', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1187, '213', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1188, '217', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1189, '213', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1190, '217', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1191, '213', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1192, '217', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1193, '213', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1194, '217', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1195, '214', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1196, '218', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1197, '214', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1198, '218', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1199, '214', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1200, '218', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1201, '214', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1202, '218', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1203, '215', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1204, '219', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1205, '215', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1206, '219', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1207, '215', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1208, '219', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1209, '215', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1210, '219', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1211, '216', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1212, '220', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1213, '216', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1214, '220', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1215, '216', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1216, '220', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1217, '216', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1218, '220', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1219, '217', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1220, '221', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1221, '217', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1222, '221', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1223, '217', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1224, '221', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1225, '217', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1226, '221', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1227, '218', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1228, '218', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1229, '218', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1230, '222', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1231, '218', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1232, '222', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1233, '222', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1234, '222', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1235, '219', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1236, '219', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1237, '219', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1238, '219', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1239, '223', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1240, '223', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1241, '223', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1242, '223', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1243, '220', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1244, '220', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1245, '220', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1246, '220', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1247, '224', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1248, '224', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1249, '224', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1250, '224', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1251, '221', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1252, '221', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1253, '221', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1254, '221', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1255, '225', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1256, '225', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1257, '225', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1258, '225', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1259, '222', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1260, '222', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1261, '222', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1262, '222', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1263, '226', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1264, '226', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1265, '226', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1266, '223', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1267, '226', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1268, '223', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1269, '223', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1270, '223', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1271, '227', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1272, '224', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1273, '227', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1274, '224', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1275, '227', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1276, '224', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1277, '227', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1278, '224', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1279, '228', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1280, '225', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1281, '228', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1282, '225', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1283, '228', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1284, '225', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1285, '228', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1286, '225', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1287, '229', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1288, '226', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1289, '229', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1290, '229', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1291, '226', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1292, '229', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1293, '226', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1294, '226', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1295, '230', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1296, '230', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1297, '230', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1298, '230', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1299, '227', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1300, '227', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1301, '227', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1302, '231', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1303, '227', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1304, '231', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1305, '231', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1306, '231', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1307, '228', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1308, '228', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1309, '228', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1310, '232', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1311, '228', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1312, '232', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1313, '232', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1314, '232', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1315, '229', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1316, '229', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1317, '229', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1318, '229', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1319, '233', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1320, '233', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1321, '233', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1322, '233', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1323, '234', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1324, '234', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1325, '234', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1326, '234', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1327, '230', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1328, '230', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1329, '230', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1330, '230', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1331, '235', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1332, '231', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1333, '235', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1334, '231', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1335, '235', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1336, '231', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1337, '235', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1338, '231', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1339, '236', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1340, '232', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1341, '236', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1342, '232', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1343, '236', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1344, '232', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1345, '236', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1346, '232', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1347, '237', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1);
INSERT INTO `hms_doctor_availability` (`ID`, `doctor_id`, `doctor_mcr`, `date`, `session_starttime`, `session_endtime`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1348, '233', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1349, '237', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1350, '233', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1351, '237', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1352, '233', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1353, '237', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1354, '233', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1355, '238', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1356, '238', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1357, '238', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1358, '238', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1359, '234', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1360, '234', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1361, '234', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1362, '234', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1363, '239', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1364, '239', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1365, '239', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1366, '239', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1367, '235', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1368, '235', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1369, '235', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1370, '240', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1371, '240', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1372, '235', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1373, '240', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1374, '240', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1375, '236', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1376, '236', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1377, '236', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1378, '236', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1379, '241', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1380, '241', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1381, '241', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1382, '241', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1383, '237', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1384, '242', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1385, '237', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1386, '242', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1387, '237', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1388, '242', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1389, '237', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1390, '242', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1391, '238', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1392, '243', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1393, '243', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1394, '238', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1395, '243', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1396, '238', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1397, '243', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1398, '238', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1399, '244', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1400, '239', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1401, '239', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1402, '244', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1403, '239', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1404, '244', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1405, '239', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1406, '244', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1407, '240', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1408, '240', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1409, '240', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1410, '245', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1411, '240', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1412, '245', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1413, '245', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1414, '245', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1415, '241', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1416, '241', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1417, '241', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1418, '246', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1419, '241', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1420, '246', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1421, '246', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1422, '246', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1423, '242', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1424, '242', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1425, '242', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1426, '242', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1427, '247', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1428, '247', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1429, '247', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1430, '247', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1431, '243', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1432, '243', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1433, '243', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1434, '248', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1435, '243', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1436, '248', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1437, '248', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1438, '248', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1439, '244', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1440, '244', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1441, '244', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1442, '244', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1443, '249', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1444, '249', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1445, '249', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1446, '249', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1447, '245', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1448, '250', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1449, '250', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1450, '245', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1451, '245', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1452, '250', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1453, '245', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1454, '250', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1455, '246', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1456, '251', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1457, '246', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1458, '251', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1459, '246', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1460, '251', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1461, '246', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1462, '251', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1463, '247', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1464, '252', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1465, '247', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1466, '252', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1467, '247', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1468, '252', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1469, '247', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1470, '252', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1471, '248', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1472, '253', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1473, '248', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1474, '253', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1475, '248', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1476, '253', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1477, '248', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1478, '253', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1479, '249', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1480, '254', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1481, '249', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1482, '254', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1483, '249', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1484, '254', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1485, '249', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1486, '254', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1487, '250', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1488, '255', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1489, '250', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1490, '255', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1491, '250', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1492, '255', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1493, '255', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1494, '250', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1495, '256', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1496, '251', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1497, '256', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1498, '251', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1499, '256', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1500, '251', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1501, '256', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1502, '251', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1503, '257', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1504, '252', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1505, '257', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1506, '252', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1507, '257', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1508, '252', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1509, '257', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1510, '252', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1511, '258', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1512, '253', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1513, '258', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1514, '253', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1515, '258', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1516, '253', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1517, '258', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1518, '253', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1519, '259', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1520, '254', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1521, '259', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1522, '254', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1523, '259', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1524, '254', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1525, '259', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1526, '254', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1527, '260', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1528, '255', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1529, '255', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1530, '260', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1531, '255', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1532, '260', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1533, '255', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1534, '260', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1535, '256', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1536, '261', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1537, '256', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1538, '261', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1539, '256', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1540, '261', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1541, '256', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1542, '261', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1543, '257', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1544, '257', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1545, '262', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1546, '257', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1547, '262', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1548, '257', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1549, '262', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1550, '262', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1551, '258', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1552, '258', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1553, '258', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1554, '263', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1555, '258', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1556, '263', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1557, '263', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1558, '263', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1559, '259', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1560, '259', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1561, '259', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1562, '259', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1563, '264', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1564, '264', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1565, '264', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1566, '264', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1567, '260', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1568, '260', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1569, '260', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1570, '260', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1571, '265', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1572, '265', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1573, '265', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1574, '261', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1575, '265', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1576, '261', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1577, '261', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1578, '261', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1579, '266', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1580, '266', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1581, '262', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1582, '266', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1583, '262', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1584, '266', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1585, '262', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1586, '262', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1587, '267', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1588, '267', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1589, '267', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1590, '263', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1591, '267', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1592, '263', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1593, '263', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1594, '263', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1595, '268', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1596, '268', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1597, '268', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1598, '268', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1599, '264', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1600, '264', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1601, '264', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1602, '264', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1603, '269', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1604, '269', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1605, '269', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1606, '265', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1607, '265', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1608, '269', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1609, '265', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1610, '265', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1611, '270', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1612, '270', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1613, '270', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1614, '266', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1615, '270', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1616, '266', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1617, '266', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1618, '266', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1619, '271', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1620, '267', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1621, '271', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1622, '267', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1623, '271', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1624, '267', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1625, '271', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1626, '267', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1627, '272', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1628, '268', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1629, '272', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1630, '268', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1631, '272', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1632, '268', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1633, '272', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1634, '268', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1635, '273', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1636, '273', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1637, '273', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1638, '269', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1639, '273', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1640, '269', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1641, '269', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1642, '269', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1643, '274', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1644, '274', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1645, '270', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1646, '274', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1647, '270', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1648, '274', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1649, '270', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1650, '270', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1651, '275', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1652, '275', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1653, '275', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1654, '275', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1655, '271', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1656, '271', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1657, '271', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1658, '271', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1659, '276', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1660, '276', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1661, '272', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1662, '276', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1663, '272', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1664, '276', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1665, '272', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1666, '272', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1667, '277', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1668, '277', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1669, '277', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1670, '273', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1671, '277', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1672, '273', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1673, '273', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1674, '273', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1675, '278', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1676, '278', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1677, '278', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1678, '274', '', '2019-12-02', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1679, '274', '', '2019-12-03', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1680, '274', '', '2019-12-04', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1681, '274', '', '2019-12-05', '07:00:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1682, '279', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1683, '279', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1684, '279', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1685, '280', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1686, '280', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1687, '280', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1688, '281', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1689, '281', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1690, '281', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1691, '282', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1692, '282', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1693, '282', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1694, '283', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1695, '283', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1696, '283', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1697, '284', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1698, '284', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1699, '284', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1700, '285', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1701, '285', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1702, '285', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1703, '286', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1704, '286', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1705, '286', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1706, '287', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1707, '287', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1708, '287', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1709, '288', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1710, '288', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1711, '288', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1712, '289', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1713, '289', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1714, '289', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1715, '290', '', '2019-11-29', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1716, '290', '', '2019-12-02', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1717, '290', '', '2019-12-04', '07:00:00', '11:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1718, '291', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1719, '291', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1720, '292', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1721, '292', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1722, '293', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1723, '293', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1724, '294', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1725, '294', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1726, '295', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1727, '295', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1728, '296', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1729, '296', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1730, '297', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1731, '297', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1732, '298', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1733, '298', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1734, '299', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1735, '299', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1736, '300', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1737, '300', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1738, '301', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1739, '301', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1740, '302', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1741, '302', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1742, '303', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1743, '303', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1744, '304', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1745, '304', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1746, '305', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1747, '305', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1748, '306', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1749, '306', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1750, '307', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1751, '307', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1752, '308', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1753, '308', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1754, '309', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1755, '309', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1756, '310', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1757, '310', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1758, '311', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1759, '311', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1760, '312', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1761, '312', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1762, '313', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1763, '313', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1764, '314', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1765, '314', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1766, '315', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1767, '315', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1768, '316', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1769, '316', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1770, '317', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1771, '317', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1772, '318', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1773, '318', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1774, '319', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1775, '319', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1776, '320', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1777, '320', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1778, '321', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1779, '321', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1780, '322', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1781, '322', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1782, '323', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1783, '323', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1784, '324', '', '2019-12-04', '07:30:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1785, '324', '', '2019-12-05', '07:00:00', '16:30:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1786, '325', '', '2019-12-01', '07:00:00', '19:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1787, '326', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1788, '326', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1789, '326', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1790, '326', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1);
INSERT INTO `hms_doctor_availability` (`ID`, `doctor_id`, `doctor_mcr`, `date`, `session_starttime`, `session_endtime`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1791, '326', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1792, '326', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1793, '327', '', '2019-11-29', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1794, '327', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1795, '327', '', '2019-12-02', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1796, '327', '', '2019-12-03', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1797, '327', '', '2019-12-04', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1798, '327', '', '2019-12-05', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1799, '328', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1800, '329', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1801, '330', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1802, '331', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1803, '332', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1804, '333', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1805, '334', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1806, '335', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1807, '336', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1808, '337', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1809, '338', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1810, '339', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1811, '340', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1812, '341', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1813, '342', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1814, '343', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1815, '344', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1816, '345', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1817, '346', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1818, '347', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1819, '348', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1820, '349', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1821, '350', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1822, '351', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1823, '352', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1824, '353', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1825, '354', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1826, '355', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1827, '356', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1828, '357', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1829, '358', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1830, '359', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1831, '360', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1832, '361', '', '2019-11-30', '11:55:00', '14:10:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1833, '362', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1834, '363', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1835, '364', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1836, '365', '', '2019-11-30', '07:00:00', '20:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1837, '366', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1838, '366', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1839, '367', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1840, '367', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1841, '368', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1842, '368', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1843, '369', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1844, '369', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1845, '370', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1846, '370', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1847, '371', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1848, '371', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1849, '372', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1850, '372', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1851, '373', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1852, '373', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1853, '374', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1854, '374', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1855, '375', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1856, '375', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1857, '376', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1858, '376', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1859, '377', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1860, '377', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1861, '378', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1862, '378', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1863, '379', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1864, '379', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1865, '380', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1866, '380', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1867, '381', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1868, '381', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1869, '382', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1870, '382', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1871, '383', '', '2019-11-30', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1872, '383', '', '2019-12-05', '08:30:00', '17:00:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1873, '384', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1874, '384', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1875, '384', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1876, '384', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1877, '384', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1878, '384', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1879, '384', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1880, '385', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1881, '385', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1882, '385', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1883, '385', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1884, '385', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1885, '385', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1886, '385', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1887, '386', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1888, '386', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1889, '386', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1890, '386', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1891, '386', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1892, '386', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1893, '386', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1894, '387', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1895, '387', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1896, '387', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1897, '387', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1898, '387', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1899, '387', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1900, '387', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1901, '388', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1902, '388', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1903, '388', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1904, '388', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1905, '388', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1906, '388', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1907, '388', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1908, '389', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1909, '389', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1910, '389', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1911, '389', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1912, '389', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1913, '389', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1914, '389', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1915, '390', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1916, '390', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1917, '390', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1918, '390', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1919, '390', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1920, '390', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1921, '390', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1922, '391', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1923, '391', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1924, '391', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1925, '391', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1926, '391', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1927, '391', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1928, '391', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1929, '392', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1930, '392', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1931, '392', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1932, '392', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1933, '392', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1934, '392', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1935, '392', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1936, '393', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1937, '393', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1938, '393', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1939, '393', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1940, '393', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1941, '393', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1942, '393', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1943, '394', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1944, '394', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1945, '394', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1946, '394', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1947, '394', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1948, '394', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1949, '394', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1950, '395', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1951, '395', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1952, '395', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1953, '395', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1954, '395', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1955, '395', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1956, '395', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1957, '396', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1958, '396', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1959, '396', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1960, '396', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1961, '396', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1962, '396', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1963, '396', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1964, '397', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1965, '397', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1966, '397', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1967, '397', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1968, '397', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1969, '397', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1970, '397', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1971, '398', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1972, '398', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1973, '398', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1974, '398', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1975, '398', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1976, '398', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1977, '398', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1978, '399', '', '2019-11-29', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1979, '399', '', '2019-11-30', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1980, '399', '', '2019-12-01', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1981, '399', '', '2019-12-02', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1982, '399', '', '2019-12-03', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1983, '399', '', '2019-12-04', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1984, '399', '', '2019-12-05', '20:00:00', '23:55:00', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(1985, '361', '', '2019-11-30', '11:05:00', '12:05:00', 'A', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(1986, '361', '', '2019-11-30', '12:10:00', '15:10:00', 'A', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1),
(1991, '34', '', '2019-11-30', '00:00:00', '02:00:00', 'A', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor_documents`
--

CREATE TABLE `hms_doctor_documents` (
  `ID` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL COMMENT 'for profile details completed: 1',
  `description` text NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor_documents`
--

INSERT INTO `hms_doctor_documents` (`ID`, `doctor_id`, `code`, `value`, `expiry_date`, `description`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 1, 'X1', '00070853', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(2, 1, 'X2', 'P-00050835', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(3, 2, 'X2', 'P-00050772', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(4, 3, 'X2', 'P-00002250', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(5, 4, 'X2', 'P-00000004', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(6, 5, 'X2', 'P-00000493', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(7, 6, 'X2', 'P-00051151', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(8, 7, 'X2', 'P-00008243', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(9, 8, 'X2', 'P-00038483', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(10, 9, 'X2', 'P-00050735', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(11, 10, 'X2', 'P-00027785', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(12, 11, 'X2', 'P-00034715', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(13, 12, 'X2', 'P-00007512', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(14, 13, 'X2', 'P-00026711', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(15, 14, 'X2', 'P-00050741', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(16, 15, 'X2', 'P-00011517', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(17, 16, 'X2', 'P-00051177', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(18, 17, 'X2', 'P-00050758', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(19, 18, 'X2', 'P-00050759', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(20, 19, 'X2', 'P-00050761', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(21, 20, 'X2', 'P-00050764', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(22, 21, 'X2', 'P-00050766', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(23, 22, 'X2', 'P-00050767', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(24, 23, 'X2', 'P-00050768', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(25, 24, 'X2', 'P-00050769', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(26, 25, 'X2', 'P-00050770', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(27, 26, 'X2', 'P-00050771', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(28, 27, 'X2', 'P-00051194', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(29, 28, 'X2', 'P-00002847', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(30, 29, 'X2', 'P-00000196', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(31, 30, 'X1', '00006698', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(32, 30, 'X2', 'P-00001440', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(33, 31, 'X2', 'P-00000007', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(34, 32, 'X1', '00007451', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(35, 32, 'X2', 'P-00000038', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(36, 33, 'X2', 'P-00000286', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(37, 34, 'X2', 'P-00000283', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(38, 35, 'X2', 'P-00005231', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(39, 36, 'X2', 'P-00051213', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(40, 37, 'X2', 'P-00051214', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(41, 38, 'X2', 'P-00041622', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(42, 39, 'X2', 'P-00000336', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(43, 40, 'X2', 'P-00026101', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(44, 41, 'X2', 'P-00006904', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(45, 42, 'X2', 'P-00006902', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(46, 43, 'X2', 'P-00026428', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(47, 44, 'X2', 'P-00000302', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(48, 45, 'X2', 'P-00029500', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(49, 46, 'X1', '00000623', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(50, 46, 'X2', 'P-00000084', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(51, 47, 'X2', 'P-00004814', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(52, 48, 'X2', 'P-00000006', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(53, 49, 'X2', 'P-00012577', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(54, 50, 'X2', 'P-00018563', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(55, 51, 'X2', 'P-00000135', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(56, 52, 'X2', 'P-00000136', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(57, 53, 'X2', 'P-00000334', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(58, 54, 'X2', 'P-00000103', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(59, 55, 'X2', 'P-00000492', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(60, 56, 'X2', 'P-00000369', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(61, 57, 'X2', 'P-00000315', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(62, 58, 'X2', 'P-00006800', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(63, 59, 'X2', 'P-00049682', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(64, 60, 'X2', 'P-00050732', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(65, 61, 'X2', 'P-00051224', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(66, 62, 'X2', 'P-00000316', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(67, 63, 'X1', '00070956', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(68, 63, 'X2', 'P-00000087', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(69, 64, 'X2', 'P-00000371', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(70, 65, 'X2', 'P-00050751', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(71, 66, 'X2', 'P-00049781', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(72, 67, 'X2', 'P-00050005', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(73, 68, 'X2', 'P-00051101', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(74, 69, 'X2', 'P-00050742', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(75, 70, 'X2', 'P-00014558', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(76, 71, 'X2', 'P-00039411', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(77, 72, 'X2', 'P-00047813', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(78, 73, 'X2', 'P-00039577', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(79, 74, 'X2', 'P-00022459', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(80, 75, 'X2', 'P-00021941', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(81, 76, 'X2', 'P-00018565', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(82, 77, 'X2', 'P-00009615', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(83, 78, 'X2', 'P-00007628', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(84, 79, 'X2', 'P-00051163', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(85, 80, 'X2', 'P-00043033', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(86, 81, 'X2', 'P-00015026', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(87, 82, 'X2', 'P-00048798', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(88, 83, 'X2', 'P-00020221', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(89, 84, 'X2', 'P-00051007', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(90, 85, 'X2', 'P-00050824', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(91, 86, 'X2', 'P-00032404', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(92, 87, 'X1', '00060305', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(93, 87, 'X2', 'P-00020533', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(94, 88, 'X2', 'P-00020315', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(95, 89, 'X2', 'P-00050825', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(96, 90, 'X2', 'P-00012622', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(97, 91, 'X2', 'P-00046381', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(98, 92, 'X2', 'P-00007514', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(99, 93, 'X2', 'P-00018562', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(100, 94, 'X2', 'P-00051047', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(101, 95, 'X2', 'P-00036446', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(102, 96, 'X2', 'P-00018564', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(103, 97, 'X2', 'P-00051241', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(104, 98, 'X2', 'P-00018508', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(105, 99, 'X2', 'P-00000138', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(106, 100, 'X2', 'P-00051112', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(107, 101, 'X2', 'P-00000005', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(108, 102, 'X2', 'P-00000598', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(109, 103, 'X2', 'P-00003819', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(110, 104, 'X2', 'P-00001439', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(111, 105, 'X2', 'P-00005929', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(112, 106, 'X2', 'P-00000518', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(113, 107, 'X2', 'P-00000337', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(114, 108, 'X2', 'P-00000600', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(115, 109, 'X2', 'P-00000250', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(116, 110, 'X2', 'P-00051121', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(117, 111, 'X2', 'P-00025666', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(118, 112, 'X2', 'P-00050095', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(119, 113, 'X2', 'P-00011715', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(120, 114, 'X2', 'P-00019624', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(121, 115, 'X2', 'P-00012621', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(122, 116, 'X2', 'P-00050793', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(123, 117, 'X2', 'P-00017386', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(124, 118, 'X2', 'P-00040580', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(125, 119, 'X2', 'P-00028312', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(126, 120, 'X2', 'P-00051178', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(127, 121, 'X2', 'P-00042363', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(128, 122, 'X2', 'P-00005084', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(129, 123, 'X2', 'P-00050740', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(130, 124, 'X2', 'P-00028297', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(131, 125, 'X2', 'P-00050736', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(132, 126, 'X2', 'P-00005085', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(133, 127, 'X2', 'P-00041793', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(134, 128, 'X2', 'P-00048952', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(135, 129, 'X2', 'P-00018770', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(136, 130, 'X2', 'P-00008064', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(137, 131, 'X2', 'P-00014560', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(138, 132, 'X2', 'P-00050979', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(139, 133, 'X2', 'P-00047812', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(140, 134, 'X2', 'P-00027289', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(141, 135, 'X2', 'P-00025877', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(142, 136, 'X2', 'P-00031486', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(143, 137, 'X2', 'P-00019776', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(144, 138, 'X2', 'P-00017866', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(145, 139, 'X2', 'P-00049783', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(146, 140, 'X2', 'P-00035727', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(147, 141, 'X1', '00046165', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(148, 141, 'X2', 'P-00025878', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(149, 142, 'X2', 'P-00023017', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(150, 143, 'X2', 'P-00024837', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(151, 144, 'X2', 'P-00018961', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(152, 145, 'X2', 'P-00026484', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(153, 146, 'X2', 'P-00013364', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(154, 147, 'X2', 'P-00025665', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(155, 148, 'X2', 'P-00030630', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(156, 149, 'X2', 'P-00005087', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(157, 150, 'X2', 'P-00016067', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(158, 151, 'X2', 'P-00040582', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(159, 152, 'X2', 'P-00000109', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(160, 153, 'X2', 'P-00001017', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(161, 154, 'X2', 'P-00044883', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(162, 155, 'X2', 'P-00000313', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(163, 156, 'X2', 'P-00021943', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(164, 157, 'X2', 'P-00000251', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(165, 158, 'X1', '00000929', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(166, 158, 'X2', 'P-00000019', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(167, 159, 'X2', 'P-00000521', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(168, 160, 'X2', 'P-00000312', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(169, 161, 'X2', 'P-00000368', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(170, 162, 'X2', 'P-00000104', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(171, 163, 'X2', 'P-00000311', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(172, 164, 'X2', 'P-00001441', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(173, 165, 'X2', 'P-00000519', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(174, 166, 'X2', 'P-00000361', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(175, 167, 'X2', 'P-00004813', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(176, 168, 'X2', 'P-00000256', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(177, 169, 'X2', 'P-00000248', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(178, 170, 'X2', 'P-00000452', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(179, 171, 'X2', 'P-00000246', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(180, 172, 'X2', 'P-00006029', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(181, 173, 'X2', 'P-00000454', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(182, 174, 'X1', '00070976', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(183, 174, 'X2', 'P-00000490', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(184, 175, 'X2', 'P-00000522', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(185, 176, 'X2', 'P-00000520', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(186, 177, 'X2', 'P-00026429', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(187, 178, 'X2', 'P-00008067', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(188, 179, 'X2', 'P-00007513', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(189, 180, 'X2', 'P-00026098', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(190, 181, 'X2', 'P-00009423', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(191, 182, 'X2', 'P-00050714', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(192, 183, 'X2', 'P-00012954', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(193, 184, 'X2', 'P-00025667', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(194, 185, 'X2', 'P-00050783', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(195, 186, 'X2', 'P-00036444', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(196, 187, 'X2', 'P-00005079', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(197, 188, 'X2', 'P-00051055', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(198, 189, 'X2', 'P-00051096', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(199, 190, 'X2', 'P-00026480', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(200, 191, 'X2', 'P-00025563', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(201, 192, 'X2', 'P-00036449', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(202, 193, 'X2', 'P-00050918', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(203, 194, 'X2', 'P-00050739', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(204, 195, 'X2', 'P-00015949', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(205, 196, 'X2', 'P-00025584', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(206, 197, 'X1', '00070630', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(207, 197, 'X2', 'P-00015221', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(208, 198, 'X2', 'P-00014358', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(209, 199, 'X2', 'P-00020222', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(210, 200, 'X2', 'P-00025663', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(211, 201, 'X2', 'P-00050737', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(212, 202, 'X2', 'P-00015179', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(213, 203, 'X2', 'P-00050033', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(214, 204, 'X2', 'P-00029501', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(215, 205, 'X2', 'P-00050983', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(216, 206, 'X2', 'P-00029606', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(217, 207, 'X2', 'P-00027786', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(218, 208, 'X2', 'P-00051221', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(219, 209, 'X2', 'P-00012271', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(220, 210, 'X2', 'P-00014354', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(221, 211, 'X2', 'P-00008370', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(222, 212, 'X2', 'P-00051051', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(223, 213, 'X2', 'P-00051166', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(224, 214, 'X2', 'P-00051048', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(225, 215, 'X2', 'P-00051084', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(226, 216, 'X2', 'P-00000335', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(227, 217, 'X2', 'P-00050919', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(228, 218, 'X2', 'P-00047810', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(229, 219, 'X2', 'P-00015180', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(230, 220, 'X2', 'P-00028299', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(231, 221, 'X2', 'P-00050839', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(232, 222, 'X2', 'P-00040418', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(233, 223, 'X2', 'P-00050980', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(234, 224, 'X2', 'P-00012623', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(235, 225, 'X2', 'P-00027288', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(236, 226, 'X2', 'P-00019183', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(237, 227, 'X2', 'P-00011486', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(238, 228, 'X2', 'P-00015514', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(239, 229, 'X2', 'P-00051086', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(240, 230, 'X2', 'P-00010280', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(241, 231, 'X2', 'P-00004891', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(242, 232, 'X2', 'P-00029024', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(243, 233, 'X2', 'P-00050730', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(244, 234, 'X2', 'P-00010767', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(245, 235, 'X2', 'P-00025586', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(246, 236, 'X2', 'P-00051170', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(247, 237, 'X2', 'P-00011484', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(248, 238, 'X2', 'P-00017779', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(249, 239, 'X2', 'P-00000359', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(250, 240, 'X2', 'P-00005081', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(251, 241, 'X2', 'P-00051083', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(252, 242, 'X2', 'P-00011483', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(253, 243, 'X2', 'P-00050738', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(254, 244, 'X2', 'P-00032156', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(255, 245, 'X2', 'P-00021688', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(256, 246, 'X2', 'P-00008563', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(257, 247, 'X2', 'P-00046804', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(258, 248, 'X2', 'P-00035165', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(259, 249, 'X2', 'P-00030789', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(260, 250, 'X2', 'P-00005089', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(261, 251, 'X2', 'P-00022313', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(262, 252, 'X2', 'P-00028311', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(263, 253, 'X2', 'P-00017867', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(264, 254, 'X2', 'P-00004792', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(265, 255, 'X2', 'P-00036445', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(266, 256, 'X2', 'P-00048905', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(267, 257, 'X2', 'P-00000289', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(268, 258, 'X2', 'P-00047811', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(269, 259, 'X2', 'P-00024281', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(270, 260, 'X2', 'P-00000367', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(271, 261, 'X2', 'P-00013588', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(272, 262, 'X2', 'P-00040237', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(273, 263, 'X2', 'P-00029605', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(274, 264, 'X2', 'P-00040053', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(275, 265, 'X2', 'P-00051050', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(276, 266, 'X2', 'P-00050733', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(277, 267, 'X2', 'P-00010000', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(278, 268, 'X2', 'P-00006106', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(279, 269, 'X2', 'P-00028083', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(280, 270, 'X2', 'P-00035932', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(281, 271, 'X2', 'P-00041760', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(282, 272, 'X2', 'P-00050734', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(283, 273, 'X2', 'P-00050743', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(284, 274, 'X2', 'P-00000453', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(285, 275, 'X2', 'P-00000471', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(286, 276, 'X2', 'P-00005230', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(287, 277, 'X2', 'P-00000317', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(288, 278, 'X2', 'P-00038689', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(289, 279, 'X2', 'P-00051072', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(290, 280, 'X2', 'P-00006705', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(291, 281, 'X2', 'P-00034281', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(292, 282, 'X2', 'P-00032728', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(293, 283, 'X2', 'P-00016063', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(294, 284, 'X2', 'P-00051114', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(295, 285, 'X2', 'P-00007052', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(296, 286, 'X2', 'P-00025585', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(297, 287, 'X2', 'P-00041991', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(298, 288, 'X2', 'P-00050716', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(299, 289, 'X2', 'P-00043848', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(300, 290, 'X2', 'P-00036443', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(301, 291, 'X2', 'P-00020386', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(302, 292, 'X2', 'P-00035095', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(303, 293, 'X2', 'P-00051087', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(304, 294, 'X2', 'P-00014355', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(305, 295, 'X2', 'P-00050717', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(306, 296, 'X2', 'P-00039412', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(307, 297, 'X2', 'P-00050923', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(308, 298, 'X2', 'P-00037344', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(309, 299, 'X2', 'P-00050725', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(310, 300, 'X2', 'P-00009028', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(311, 301, 'X2', 'P-00039413', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(312, 302, 'X2', 'P-00050880', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(313, 303, 'X2', 'P-00015182', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(314, 304, 'X2', 'P-00022053', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(315, 305, 'X2', 'P-00012953', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(316, 306, 'X2', 'P-00004892', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(317, 307, 'X2', 'P-00027286', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(318, 308, 'X2', 'P-00039249', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(319, 309, 'X2', 'P-00023770', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(320, 310, 'X1', '00023970', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(321, 310, 'X2', 'P-00006911', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(322, 311, 'X2', 'P-00021942', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(323, 312, 'X2', 'P-00021843', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(324, 313, 'X2', 'P-00050794', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(325, 314, 'X2', 'P-00000306', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(326, 315, 'X2', 'P-00050708', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(327, 316, 'X1', '00010077', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(328, 316, 'X2', 'P-00000249', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(329, 317, 'X2', 'P-00000360', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(330, 318, 'X2', 'P-00000370', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(331, 319, 'X2', 'P-00000113', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(332, 320, 'X2', 'P-00000205', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(333, 321, 'X2', 'P-00000491', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(334, 322, 'X2', 'P-00051113', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(335, 323, 'X2', 'P-00004732', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(336, 324, 'X2', 'P-00050830', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(337, 325, 'X2', 'P-00050920', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(338, 326, 'X2', 'P-00050995', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(339, 327, 'X2', 'P-00039409', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(340, 328, 'X2', 'P-00000037', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(341, 329, 'X2', 'P-00051004', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(342, 330, 'X2', 'P-00012619', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(343, 331, 'X2', 'P-00050829', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(344, 332, 'X2', 'P-00016066', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(345, 333, 'X2', 'P-00042953', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(346, 334, 'X2', 'P-00018962', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(347, 335, 'X2', 'P-00043703', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(348, 336, 'X2', 'P-00051049', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(349, 337, 'X2', 'P-00011485', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(350, 338, 'X2', 'P-00016068', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(351, 339, 'X2', 'P-00008065', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(352, 340, 'X2', 'P-00030317', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(353, 341, 'X2', 'P-00025664', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(354, 342, 'X2', 'P-00043704', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(355, 343, 'X2', 'P-00011714', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(356, 344, 'X2', 'P-00016065', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(357, 345, 'X2', 'P-00026095', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(358, 346, 'X2', 'P-00048797', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(359, 347, 'X2', 'P-00024903', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(360, 348, 'X2', 'P-00014357', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(361, 349, 'X2', 'P-00034120', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(362, 350, 'X2', 'P-00029277', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(363, 351, 'X2', 'P-00040583', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(364, 352, 'X2', 'P-00005086', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(365, 353, 'X2', 'P-00007166', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(366, 354, 'X2', 'P-00039579', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(367, 355, 'X2', 'P-00026712', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(368, 356, 'X2', 'P-00026244', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(369, 357, 'X2', 'P-00050721', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(370, 358, 'X2', 'P-00036441', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(371, 359, 'X2', 'P-00028298', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(372, 360, 'X2', 'P-00026482', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(373, 361, 'X2', 'P-00000110', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(374, 362, 'X2', 'P-00000247', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(375, 363, 'X2', 'P-00001438', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(376, 364, 'X2', 'P-00000314', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(377, 365, 'X2', 'P-00000137', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(378, 366, 'X1', '00029276', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(379, 366, 'X2', 'P-00005482', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(380, 367, 'X2', 'P-00027287', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(381, 368, 'X2', 'P-00051056', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(382, 369, 'X2', 'P-00027784', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(383, 370, 'X2', 'P-00040875', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(384, 371, 'X2', 'P-00036442', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(385, 372, 'X2', 'P-00030788', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(386, 373, 'X2', 'P-00031485', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(387, 374, 'X2', 'P-00026097', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(388, 375, 'X2', 'P-00050731', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(389, 376, 'X2', 'P-00009589', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(390, 377, 'X2', 'P-00050836', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(391, 378, 'X2', 'P-00045661', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(392, 379, 'X2', 'P-00050729', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(393, 380, 'X2', 'P-00025874', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(394, 381, 'X2', 'P-00040236', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(395, 382, 'X2', 'P-00020532', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(396, 383, 'X2', 'P-00002598', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(397, 384, 'X2', 'P-00050890', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(398, 385, 'X2', 'P-00050726', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(399, 386, 'X2', 'P-00036053', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(400, 387, 'X2', 'P-00008939', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(401, 388, 'X2', 'P-00050997', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(402, 389, 'X2', 'P-00051120', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(403, 390, 'X2', 'P-00050722', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(404, 391, 'X2', 'P-00024492', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(405, 392, 'X2', 'P-00051071', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(406, 393, 'X2', 'P-00006903', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(407, 394, 'X2', 'P-00010279', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(408, 395, 'X1', '00064192', '0000-00-00', 'System Generated', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(409, 395, 'X2', 'P-00000042', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(410, 396, 'X2', 'P-00051134', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(411, 397, 'X2', 'P-00009818', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(412, 398, 'X2', 'P-00050989', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(413, 399, 'X2', 'P-00026102', '0000-00-00', 'NOK/GUA/EMP No.', 0, 'A', 1, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor_education`
--

CREATE TABLE `hms_doctor_education` (
  `ID` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `from_year` int(6) NOT NULL,
  `to_year` int(6) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor_education`
--

INSERT INTO `hms_doctor_education` (`ID`, `doctor_id`, `from_year`, `to_year`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 16, 2001, 2003, 'Testing1', 'A', 1, 0, 1, '2019-12-07', 1, '2019-12-07', 1, 1, 1, 1),
(2, 16, 2003, 2004, 'Testing2', 'A', 1, 0, 1, '2019-12-07', 1, '2019-12-07', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor_experience`
--

CREATE TABLE `hms_doctor_experience` (
  `ID` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `from_year` int(6) NOT NULL,
  `to_year` int(6) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor_experience`
--

INSERT INTO `hms_doctor_experience` (`ID`, `doctor_id`, `from_year`, `to_year`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 16, 2004, 2006, 'Testing1', 'A', 1, 0, 1, '2019-12-07', 1, '2019-12-07', 1, 1, 1, 1),
(2, 16, 2007, 2009, 'Testing2', 'A', 1, 0, 1, '2019-12-07', 1, '2019-12-07', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctor_specialization`
--

CREATE TABLE `hms_doctor_specialization` (
  `ID` int(3) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctor_specialization`
--

INSERT INTO `hms_doctor_specialization` (`ID`, `code`, `name`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '01', 'Paediatrics', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(2, '02', 'Obstetric', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(3, '03', 'General', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(4, '04', 'Oncology', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(5, '05', 'Anaesthetic', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(6, '06', 'Radiologist', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(7, '07', 'Gynaecology', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(8, '08', 'Nursery', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(9, '09', 'IVF', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(10, '10', 'Day Surgery', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(11, '11', 'Cancer', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(12, '12', 'Health Screening', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(13, '14', 'Unknow - do not use', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(14, '15', 'NICU', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(15, 'OG', 'Obstetric & Gynaecology', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(16, 'OTH', 'Others', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(17, 'SPA', 'SPA Centre', '', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_email_template`
--

CREATE TABLE `hms_email_template` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `mail_body` longtext NOT NULL,
  `description` text NOT NULL,
  `otp_expiry` int(3) NOT NULL DEFAULT 0 COMMENT 'In minutes, 0 : unlimited	',
  `otp_length` int(3) NOT NULL DEFAULT 0 COMMENT '0: unlimited',
  `type` varchar(255) NOT NULL DEFAULT 'OTP',
  `status` varchar(10) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_email_template`
--

INSERT INTO `hms_email_template` (`ID`, `title`, `sender`, `subject`, `mail_body`, `description`, `otp_expiry`, `otp_length`, `type`, `status`, `show_status`, `is_deleted`) VALUES
(1, 'Forgot Password', 'noreply@softlogique.com', 'Forgot Password', '<br/><div class=\"ii gt adP adO\" id=\":q9\"><div class=\"a3s aXjCH m155016b5bbbb6c3b\" id=\":pz\"><div><div class=\"adM\"> </div> \r\n								<table cellspacing=\"0\" cellpadding=\"0\" style=\"padding:30px 10px;background:#eee;width:100%;font-family:arial\"> \r\n								<tbody> <tr> <td> <table align=\"center\" cellspacing=\"0\" style=\"max-width:650px;min-width:320px\"> <tbody>\r\n								<tr> <td style=\"text-align:left;padding-bottom:0px\"><div><img src=\"[WEBSITE_LOGO]\"></div></td></tr><tr><td align=\"center\" style=\"background:#fff;border:1px solid #e4e4e4;padding:40px 30px\"> \r\n								<table align=\"center\"> <tbody> <tr> <td style=\"color:#666;text-align:center\"> <table align=\"center\" style=\"margin:auto\"> \r\n								<tbody> <tr><td style=\"color:#666;font-size:20px;font-weight:bold;text-align:center;font-family:arial\"> Forgot password </td> </tr> </tbody> \r\n								</table> </td> </tr> <tr> <td style=\"color:#666;padding:15px;font-size:14px;line-height:18px;text-align:left\">\r\n								 <div style=\"margin-bottom:25px\">\r\n								 <p>Hi, We have received a request to reset your [WEBSITE_NAME] password.</p> \r\n								 <p>To initiate the process, please click the following link: <a target=\"_blank\" style=\"color:#00b22c;text-decoration:none\" href=\"[URL]\">[URL]</a></p> <p>If clicking the link above does not work, copy and paste the URL in a new browser window. The URL will expire in 24 hours for security reasons. If you did not make this request, simply ignore this message.</p> </div> \r\n								 <div style=\"padding-top:10px;text-align:center;font-family:arial;\"> <img src=\"[THANK_IMG_SRC]\" alt=\"Thanks\" class=\"CToWUd\"> <br> The [WEBSITE_NAME] Team </div> </td> </tr> </tbody> </table> </td> </tr> <tr> <td align=\"center\" style=\"background:#636363;border:1px solid #e4e4e4;border-top:none;padding:24px 10px\"> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <div></div> </div></div></div>', '', 0, 0, 'Text', 'A', 1, 0),
(2, 'Reset Password', 'noreply@softlogique.com', 'Reset Password', '<br/><div class=\"ii gt adP adO\" id=\":q9\"><div class=\"a3s aXjCH m155016b5bbbb6c3b\" id=\":pz\"><div><div class=\"adM\"> </div> \r\n								<table cellspacing=\"0\" cellpadding=\"0\" style=\"padding:30px 10px;background:#eee;width:100%;font-family:arial\"> \r\n								<tbody> <tr> <td> <table align=\"center\" cellspacing=\"0\" style=\"max-width:650px;min-width:320px\"> <tbody>\r\n								<tr> <td style=\"text-align:left;padding-bottom:0px\"><div><img src=\"[WEBSITE_LOGO]\"></div></td></tr><tr><td align=\"center\" style=\"background:#fff;border:1px solid #e4e4e4;padding:40px 30px\"> \r\n								<table align=\"center\"> <tbody> <tr> <td style=\"color:#666;text-align:center\"> <table align=\"center\" style=\"margin:auto\"> \r\n								<tbody> <tr><td style=\"color:#666;font-size:20px;font-weight:bold;text-align:center;font-family:arial\">Reset password </td> </tr> </tbody> \r\n								</table> </td> </tr> <tr> <td style=\"color:#666;padding:15px;font-size:14px;line-height:18px;text-align:left\">\r\n								 <div style=\"margin-bottom:25px\">\r\n								 <p>Hi, We have received a request to reset your [WEBSITE_NAME] password.</p> \r\n								  <p>To initiate the process, please click the following link: <a target=\"_blank\" style=\"color:#00b22c;text-decoration:none\" href=\"[URL]\">[URL]</a></p> <p>If clicking the link above does not work, copy and paste the URL in a new browser window. The URL will expire in 24 hours for security reasons. If you did not make this request, simply ignore this message.</p><p>Please change password after login.</p> </div> \r\n								 <div style=\"padding-top:10px;text-align:center;font-family:arial\"> <img src=\"[THANK_IMG_SRC]\" alt=\"Thanks\" class=\"CToWUd\"> <br> The [WEBSITE_NAME] Team </div> </td> </tr> </tbody> </table> </td> </tr> <tr> <td align=\"center\" style=\"background:#636363;border:1px solid #e4e4e4;border-top:none;padding:24px 10px\"> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <div></div> </div></div></div>', '', 0, 0, 'Text', 'A', 1, 0),
(3, 'Generate New Password', 'noreply@softlogique.com', 'Generate New Password', '<br/><div class=\"ii gt adP adO\" id=\":q9\"><div class=\"a3s aXjCH m155016b5bbbb6c3b\" id=\":pz\"><div><div class=\"adM\"> </div> \r\n								<table cellspacing=\"0\" cellpadding=\"0\" style=\"padding:30px 10px;background:#eee;width:100%;font-family:arial\"> \r\n								<tbody> <tr> <td> <table align=\"center\" cellspacing=\"0\" style=\"max-width:650px;min-width:320px\"> <tbody>\r\n								<tr> <td style=\"text-align:left;padding-bottom:0px\"><div><img src=\"[WEBSITE_LOGO]\"></div></td></tr><tr><td align=\"center\" style=\"background:#fff;border:1px solid #e4e4e4;padding:40px 30px\"> \r\n								<table align=\"center\"> <tbody> <tr> <td style=\"color:#666;text-align:center\"> <table align=\"center\" style=\"margin:auto\"> \r\n								<tbody> <tr><td style=\"color:#666;font-size:20px;font-weight:bold;text-align:center;font-family:arial\">Reset password </td> </tr> </tbody> \r\n								</table> </td> </tr> <tr> <td style=\"color:#666;padding:15px;font-size:14px;line-height:18px;text-align:left\">\r\n								 <div style=\"margin-bottom:25px\">\r\n								 <p>Hi, We have received a request to Generate your [WEBSITE_NAME] password.</p> \r\n								  <p>To initiate the process, please click the following link: <a target=\"_blank\" style=\"color:#00b22c;text-decoration:none\" href=\"[URL]\">[URL]</a></p> <p>If clicking the link above does not work, copy and paste the URL in a new browser window. The URL will expire in 24 hours for security reasons. If you did not make this request, simply ignore this message.</p><p>Please change password after login.</p> </div> \r\n								 <div style=\"padding-top:10px;text-align:center;font-family:arial\"> <img src=\"[THANK_IMG_SRC]\" alt=\"Thanks\" class=\"CToWUd\"> <br> The [WEBSITE_NAME] Team </div> </td> </tr> </tbody> </table> </td> </tr> <tr> <td align=\"center\" style=\"background:#636363;border:1px solid #e4e4e4;border-top:none;padding:24px 10px\"> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <div></div> </div></div></div>', '', 0, 0, 'Text', 'A', 1, 0),
(4, 'Mobile verification', 'noreply@softlogique.com', 'Mobile verification', '<br/><div class=\"ii gt adP adO\" id=\":q9\"><div class=\"a3s aXjCH m155016b5bbbb6c3b\" id=\":pz\"><div><div class=\"adM\"> </div> \r\n								<table cellspacing=\"0\" cellpadding=\"0\" style=\"padding:30px 10px;background:#eee;width:100%;font-family:arial\"> \r\n								<tbody> <tr> <td> <table align=\"center\" cellspacing=\"0\" style=\"max-width:650px;min-width:320px\"> <tbody>\r\n								<tr> <td style=\"text-align:left;padding-bottom:0px\"><div><img src=\"[WEBSITE_LOGO]\"></div></td></tr><tr><td align=\"center\" style=\"background:#fff;border:1px solid #e4e4e4;padding:40px 30px\"> \r\n								<table align=\"center\"> <tbody> <tr> <td style=\"color:#666;text-align:center\"> <table align=\"center\" style=\"margin:auto\"> \r\n								<tbody> <tr><td style=\"color:#666;font-size:20px;font-weight:bold;text-align:center;font-family:arial\">[TITLE] </td> </tr> </tbody> \r\n								</table> </td> </tr> <tr> <td style=\"color:#666;padding:15px;font-size:14px;line-height:18px;text-align:left\">\r\n								 <div style=\"margin-bottom:25px\">\r\n								 <p>Hi, We have received a request to Generate your mobile verification OTP.</p> \r\n								  <p>[OTP] is The OTP for mobile verification. This OTP is valid for one time or 10 mins only. Do not share it with anyone.</p> <p>If you did not make this request, simply ignore this message.</p></div> \r\n								 <div style=\"padding-top:10px;text-align:center;font-family:arial\"> <img src=\"[THANK_IMG_SRC]\" alt=\"Thanks\" class=\"CToWUd\"> <br> The [WEBSITE_NAME] Team </div> </td> </tr> </tbody> </table> </td> </tr> <tr> <td align=\"center\" style=\"background:#636363;border:1px solid #e4e4e4;border-top:none;padding:24px 10px\"> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <div></div> </div></div></div>', '', 10, 6, 'OTP', 'A', 1, 0),
(5, 'Password reset verification', 'noreply@softlogique.com', 'Password reset verification', '<br/><div class=\"ii gt adP adO\" id=\":q9\"><div class=\"a3s aXjCH m155016b5bbbb6c3b\" id=\":pz\"><div><div class=\"adM\"> </div> \r\n								<table cellspacing=\"0\" cellpadding=\"0\" style=\"padding:30px 10px;background:#eee;width:100%;font-family:arial\"> \r\n								<tbody> <tr> <td> <table align=\"center\" cellspacing=\"0\" style=\"max-width:650px;min-width:320px\"> <tbody>\r\n								<tr> <td style=\"text-align:left;padding-bottom:0px\"><div><img src=\"[WEBSITE_LOGO]\"></div></td></tr><tr><td align=\"center\" style=\"background:#fff;border:1px solid #e4e4e4;padding:40px 30px\"> \r\n								<table align=\"center\"> <tbody> <tr> <td style=\"color:#666;text-align:center\"> <table align=\"center\" style=\"margin:auto\"> \r\n								<tbody> <tr><td style=\"color:#666;font-size:20px;font-weight:bold;text-align:center;font-family:arial\">[TITLE] </td> </tr> </tbody> \r\n								</table> </td> </tr> <tr> <td style=\"color:#666;padding:15px;font-size:14px;line-height:18px;text-align:left\">\r\n								 <div style=\"margin-bottom:25px\">\r\n								 <p>Hi, We have received a request to Generate Password reset verification OTP.</p> \r\n								  <p>[OTP] is The OTP for mobile verification. This OTP is valid for one time or 10 mins only. Do not share it with anyone.</p> <p>If you did not make this request, simply ignore this message.</p></div> \r\n								 <div style=\"padding-top:10px;text-align:center;font-family:arial\"> <img src=\"[THANK_IMG_SRC]\" alt=\"Thanks\" class=\"CToWUd\"> <br> The [WEBSITE_NAME] Team </div> </td> </tr> </tbody> </table> </td> </tr> <tr> <td align=\"center\" style=\"background:#636363;border:1px solid #e4e4e4;border-top:none;padding:24px 10px\"> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <div></div> </div></div></div>', '', 10, 6, 'OTP', 'A', 1, 0),
(6, 'Patient appointment confirmation', 'noreply@softlogique.com', 'Patient appointment confirmation', '<br/><div class=\"ii gt adP adO\" id=\":q9\"><div class=\"a3s aXjCH m155016b5bbbb6c3b\" id=\":pz\"><div><div class=\"adM\"> </div> \r\n								<table cellspacing=\"0\" cellpadding=\"0\" style=\"padding:30px 10px;background:#eee;width:100%;font-family:arial\"> \r\n								<tbody> <tr> <td> <table align=\"center\" cellspacing=\"0\" style=\"max-width:650px;min-width:320px\"> <tbody>\r\n								<tr> <td style=\"text-align:left;padding-bottom:0px\"><div><img src=\"[WEBSITE_LOGO]\"></div></td></tr><tr><td align=\"center\" style=\"background:#fff;border:1px solid #e4e4e4;padding:40px 30px\"> \r\n								<table align=\"center\"> <tbody> <tr> <td style=\"color:#666;text-align:center\"> <table align=\"center\" style=\"margin:auto\"> \r\n								<tbody> <tr><td style=\"color:#666;font-size:20px;font-weight:bold;text-align:center;font-family:arial\">[TITLE] </td> </tr> </tbody> \r\n								</table> </td> </tr> <tr> <td style=\"color:#666;padding:15px;font-size:14px;line-height:18px;text-align:left\">\r\n								 <div style=\"margin-bottom:25px\">\r\n								 <p>Hi, We have received a request for appointment.</p> \r\n								  <p>You appointment confirm</p></div> \r\n								 <div style=\"padding-top:10px;text-align:center;font-family:arial\"> <img src=\"[THANK_IMG_SRC]\" alt=\"Thanks\" class=\"CToWUd\"> <br> The [WEBSITE_NAME] Team </div> </td> </tr> </tbody> </table> </td> </tr> <tr> <td align=\"center\" style=\"background:#636363;border:1px solid #e4e4e4;border-top:none;padding:24px 10px\"> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <div></div> </div></div></div>', '', 10, 6, 'OTP', 'A', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_mail`
--

CREATE TABLE `hms_mail` (
  `ID` int(11) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_email` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `view_status` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_map`
--

CREATE TABLE `hms_map` (
  `ID` int(11) NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_map`
--

INSERT INTO `hms_map` (`ID`, `latitude`, `longitude`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '28.641976', '77.296919', 'A', 1, 0, '0000-00-00', 0, '0000-00-00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_module`
--

CREATE TABLE `hms_module` (
  `ID` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_url` varchar(255) NOT NULL,
  `parent_id` int(3) NOT NULL,
  `short_by` int(3) NOT NULL,
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `icon` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_module`
--

INSERT INTO `hms_module` (`ID`, `module_name`, `module_url`, `parent_id`, `short_by`, `show_status`, `icon`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Dashboard', 'dashboard', 0, 1, 1, 'fa fa-dashboard', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(2, 'Profile', 'user/user_profile', 0, 2, 1, 'fa fa-address-book', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(3, 'APP Info', 'dashboard/app_performance', 1, 1, 1, 'fa fa-building', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(4, 'Booking Info', 'dashboard/booking_performance', 1, 2, 1, 'fa fa-th-list', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(5, 'Patient Info', 'dashboard/patient_profile_info', 1, 3, 1, 'fa fa-address-card-o', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(6, 'Revenue Info', 'dashboard/revenue_info', 1, 4, 0, 'fa fa-calendar', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(7, '', '', 1, 3, 0, 'fa fa-dashboard', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(8, '', '', 0, 4, 0, 'fa fa-group', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(9, 'Settings', '', 0, 3, 1, 'fa fa-cogs', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(10, 'Website Settings', 'website_setting', 9, 1, 1, 'fa fa-wrench', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(11, 'APP Info Settings', 'app_info_setting', 9, 2, 1, 'fa fa-wrench', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(12, 'Manage Patients', 'patient', 22, 1, 1, 'fa fa-address-card-o', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(13, 'Doctors', '', 0, 5, 1, 'fa fa-users', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(14, 'Manage Emp Role', 'role', 0, 1, 0, 'fa fa-bars', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(15, 'Manage Employee', 'user', 0, 4, 1, 'fa fa-user', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(16, 'Manage Doctors', 'doctor', 13, 3, 1, 'fa fa-user', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(17, 'Appointment', 'appointment', 22, 2, 1, 'fa fa-briefcase', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(18, 'Retail Shop', '', 0, 10, 0, 'fa fa-shopping-cart ', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(19, 'Manage New offers', 'offer', 18, 1, 1, 'fa fa-handshake-o', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(20, 'Manage Products', 'product_list', 18, 2, 1, 'fa fa-diamond', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(21, 'Manage Services', 'services', 18, 3, 1, 'fa fa-globe', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(22, 'Patients', '', 0, 6, 1, 'fa fa-briefcase', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(23, 'Manage Vaccine', '', 22, 3, 0, 'fa fa-briefcase', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(24, 'Patient Awareness', 'awareness', 0, 13, 0, 'fa fa-question-circle', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(25, 'Manage Notification', '', 0, 14, 0, 'fa fa-bell', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(26, '', '', 25, 1, 0, 'fa fa-flag-checkered', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(27, '', '', 25, 2, 0, 'fa fa-envelope', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(28, '', '', 25, 3, 0, 'fa fa-commenting', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(29, '', '', 25, 4, 0, 'fa fa-comments', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(30, 'Email Template', '', 9, 4, 0, 'fa fa-wrench', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(31, 'SMS/OTP Setting', '', 9, 5, 0, 'fa fa-wrench', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(32, 'Payment list', 'payment', 0, 17, 0, 'fa fa-money', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(33, 'Emergency Call', 'emergency_calls', 0, 19, 1, 'fa fa-ambulance', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(34, 'APP Banner', 'app_banner_setting', 9, 3, 1, 'fa fa-wrench', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(35, 'Feedback', 'customer_feedback', 0, 20, 1, 'fa fa-briefcase', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(36, 'ChatBot', '', 0, 18, 0, 'fa fa-window-restore', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(37, 'Doctor Specialization', 'doctor_specialization', 13, 2, 1, 'fa fa-snowflake-o', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1),
(38, 'Report', '', 0, 23, 0, 'fa fa-file-text', 0, 1, '2018-08-15', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_offer`
--

CREATE TABLE `hms_offer` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_group` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `image` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_offer`
--

INSERT INTO `hms_offer` (`ID`, `name`, `customer_group`, `quantity`, `start_date`, `end_date`, `image`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Testing Offer', 'Women', 1, '2019-11-11 00:00:00', '2019-12-11 00:00:00', 'data/new-offers-image/2019/12/19120601010815_72_5....', 'This is testing offer', 'A', 1, 0, 1, '2019-11-05', 1, '2019-11-05', 1, 1, 1, 1),
(2, 'Testing Offer', 'Women', 11, '2019-11-08 00:00:00', '2019-11-08 00:00:00', 'data/new-offers-image/2019/12/19120601010815_72_5.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'A', 1, 0, 1, '2019-11-08', 1, '2019-11-08', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_office_location`
--

CREATE TABLE `hms_office_location` (
  `ID` int(11) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `office_location` text NOT NULL,
  `working_days` varchar(200) NOT NULL,
  `working_time` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient`
--

CREATE TABLE `hms_patient` (
  `ID` int(11) NOT NULL,
  `prn` varchar(300) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email_id` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `alternet_number` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '1: Male, 2: Female, 3: Other',
  `blood_group` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dob` date NOT NULL,
  `marital_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1; unmarried, 2: married',
  `religious` varchar(255) NOT NULL,
  `patient_group` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1:Pregnancy , 2:Non-Pregnancy ,3:Mom with first kid,4:Mon with kid+ ',
  `device_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Android, 2: IOS, 3: Another OS',
  `first_device_id` varchar(255) NOT NULL,
  `last_device_id` varchar(255) NOT NULL,
  `promo_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `charge_category_code` varchar(255) NOT NULL COMMENT '05: NTUC MEMBER, ',
  `payment_class_code` varchar(255) NOT NULL COMMENT 'PT: Private (Independent OP), ',
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `last_chat` datetime NOT NULL,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_patient`
--

INSERT INTO `hms_patient` (`ID`, `prn`, `title`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email_id`, `contact_number`, `alternet_number`, `gender`, `blood_group`, `dob`, `marital_status`, `religious`, `patient_group`, `device_type`, `first_device_id`, `last_device_id`, `promo_code`, `status`, `show_status`, `is_deleted`, `description`, `charge_category_code`, `payment_class_code`, `last_login`, `last_logout`, `last_chat`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(2, '2081119', 'Mr.', 'Dinesh', '', 'Gurjar', '9784628881', 'f518104f9bb30b478b8c011415d064dec6492404', 'dinesh.qcws@gmail.com', '9784628881', '', 1, 'A-', '1989-01-01', 2, 'Hindu', 4, 1, 'undefined', 'demo', '', 'A', 1, 0, '', '', '', '2019-12-10 03:12:16', '2019-12-07 03:12:27', '2019-12-10 04:36:17', 2, '2019-12-05', 0, '2019-12-05', 1, 1, 1, 1),
(3, '3091119', '', 'SOUMMYA', '', 'KARMAKAR', '8750237242', 'd841b562ea6ebb91f9c2b48c75cca2a371d59b65', 'karmakarsoummya@gmail.com', '8750237242', '', 1, '', '1985-01-01', 1, '', 1, 1, 'undefined', 'demo', '', 'A', 1, 0, '', '', '', '2019-12-07 06:12:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '2019-11-06', 3, '2019-11-06', 1, 1, 1, 1),
(4, '4091119', '', 'Arijit', '', 'Das', '7595960285', '03b2960b915c723f97cfd03dad5651cbfa04a96a', 'a.arijitdas@gmail.com', '7595960285', '', 1, '', '1989-12-01', 1, '', 2, 2, 'undefined', '', '', 'A', 1, 0, '', '', '', '2019-11-09 06:11:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, '2019-12-02', 4, '2019-12-11', 1, 1, 1, 1),
(5, '5091119', '', 'Arindrajit', '', 'Das', '9560598858', 'b114e8efceae633d8dfe23d422d7a84d4fd1445d', 'ardjit@gmail.com', '9560598858', '', 1, '', '1992-01-01', 1, '', 3, 1, 'undefined', 'demo', '', 'A', 1, 0, '', '', '', '2019-12-01 05:12:32', '0000-00-00 00:00:00', '2019-12-10 03:33:46', 5, '2019-12-04', 5, '2019-12-04', 1, 1, 1, 1),
(7, '11197', '', 'Dinesh ', 'Chandra', 'Gurjar', 'gurjardinesh93@gmail.com', 'd2a1ec9f030f9d3c256d1ba9574ea6b35daac26c', 'gurjardinesh93@gmail.com', '8800890344', '', 1, 'A%2B', '1995-01-01', 2, 'Humanity', 3, 1, '123456', 'demo', '', 'A', 1, 0, '', '', '', '2019-11-21 07:11:58', '0000-00-00 00:00:00', '2019-12-10 03:34:00', 7, '2019-12-04', 8, '2019-12-04', 1, 1, 1, 1),
(8, '11198', '', 'test1', 'test2', 'test3', '9555797772', '382b9858a937aafbe8d9ebce8ab65392ecbedceb', 'test@gmail.com', '9555797772', '', 1, 'A%2B', '1997-01-01', 1, 'humanity', 1, 2, '123456', 'demo', '', 'A', 1, 0, '', '', '', '2019-11-21 05:11:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, '2019-12-03', 0, '2019-12-03', 1, 1, 1, 1),
(9, '11199', 'Mr.', 'Saurav', '', 'Choudhury', '6290636076', 'a85adc3c60a34aec3c315fec0cfc8cc02e541b5a', 'sauravchoudhury541@gmail.com', '629063607', '', 1, 'A%2B', '1980-01-22', 1, 'Hindu', 1, 1, 'Jangli@nvm65', 'demo', '', 'A', 1, 0, '', '', '', '2019-12-02 04:12:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, '2019-12-05', 45, '2019-12-05', 1, 1, 1, 1),
(10, '121910', 'Mr.', 'Shushank', '', 'Kumar', '8279818917', '3ba4cc3b0b372252291fc709f45a9905e712ecf0', 'shushank.kumar@softlogique.com', '8279818917', '', 1, 'O%2B', '1998-01-03', 1, 'Hindu', 0, 1, 'demo', 'demo', '', 'A', 1, 0, '', '', '', '2019-12-05 05:12:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, '2019-12-05', 0, '2019-12-05', 1, 1, 1, 1),
(11, '121911', '', 'Soummya ', '', 'Karmamar', 'ksoummya@gmail.com', '6da8e568700a1e2113576b3918105ee424769b7f', 'karmakarsoummya@gmail.com', '8750237242', '', 0, '', '0000-00-00', 1, '', 0, 1, 'demo', '', '', 'A', 1, 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, '2019-12-05', 11, '2019-12-05', 1, 1, 1, 1),
(12, '121912', '', 'Thuy', '', 'Dinh', 'thuydinh@ashavi.com', '8351aee6b54559b7afafd03319a0746095b07308', 'thuydinh@ashavi.com', '933969538', '', 0, '', '0000-00-00', 1, '', 0, 1, 'demo', 'demo', '', 'A', 1, 0, '', '', '', '2019-12-09 07:12:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, '2019-12-06', 12, '2019-12-06', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient_address`
--

CREATE TABLE `hms_patient_address` (
  `ID` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `address_line1` text NOT NULL,
  `address_line2` text NOT NULL,
  `address_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: home, 2: office',
  `postal_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `district_code` varchar(255) NOT NULL,
  `city_code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_patient_address`
--

INSERT INTO `hms_patient_address` (`ID`, `patient_id`, `address_line1`, `address_line2`, `address_type`, `postal_code`, `country_code`, `state_code`, `district_code`, `city_code`, `active`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(2, 2, 'Veerdholiya', 'Mavli', 1, '313201', 'VN', '1', '93', '', 1, 0, 'A', 1, 2, '2019-11-08', 0, '2019-12-01', 1, 1, 1, 1),
(3, 3, '', '', 1, '', 'VN', '', '2', '', 1, 0, 'A', 1, 3, '2019-11-09', 0, '0000-00-00', 1, 1, 1, 1),
(4, 4, '', '', 1, '', 'VN', '', '1', '', 1, 0, 'A', 1, 4, '2019-11-09', 0, '0000-00-00', 1, 1, 1, 1),
(5, 5, '', '', 1, '', 'VN', '', '6', '', 1, 0, 'A', 1, 5, '2019-11-09', 0, '0000-00-00', 1, 1, 1, 1),
(7, 7, 'Veerdholiya', 'Udaipur', 1, '3132014', 'VN', '1', '5', '', 1, 0, 'A', 1, 7, '2019-11-19', 8, '2019-11-21', 1, 1, 1, 1),
(8, 8, 'h block', 'noida', 1, '313201', 'VN', '1', '17', '', 1, 0, 'A', 1, 8, '2019-11-21', 0, '2019-11-21', 1, 1, 1, 1),
(9, 9, 'A-29,AG West Bengal Housing Society,kol-94', 'Kolkata', 1, '700094', 'VN', '1', '2', '', 1, 0, 'A', 1, 9, '2019-11-28', 45, '2019-11-28', 1, 1, 1, 1),
(10, 10, 'sjejw hsjshejdb ', 'Omon', 1, '171315', 'VN', '1', '5', '', 1, 0, 'A', 1, 10, '2019-12-05', 0, '2019-12-05', 1, 1, 1, 1),
(11, 11, '', '', 1, '', '', '', '', '', 1, 0, 'A', 1, 11, '2019-12-05', 11, '2019-12-05', 1, 1, 1, 1),
(12, 12, '', '', 1, '', '', '', '', '', 1, 0, 'A', 1, 12, '2019-12-06', 12, '2019-12-06', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient_appointment`
--

CREATE TABLE `hms_patient_appointment` (
  `ID` int(3) NOT NULL,
  `prn` varchar(255) NOT NULL,
  `parent_prn` varchar(255) NOT NULL COMMENT '1: Old Checkup, 2: New Checkup',
  `department_code` varchar(255) NOT NULL,
  `doctor_mcr` varchar(255) NOT NULL,
  `booking_date` datetime NOT NULL,
  `appointment_date` datetime NOT NULL,
  `lab_testing_date` datetime NOT NULL,
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_patient_appointment`
--

INSERT INTO `hms_patient_appointment` (`ID`, `prn`, `parent_prn`, `department_code`, `doctor_mcr`, `booking_date`, `appointment_date`, `lab_testing_date`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '11193', '2081119', '11', '100901', '2019-12-07 05:06:08', '2019-12-08 16:35:25', '2019-12-07 16:35:25', 'For testing purpose', 'A', 1, 0, 2, '2019-12-07', 2, '2019-12-07', 1, 1, 1, 1),
(2, '2081119', '', '05', '100906', '2019-12-07 05:25:45', '2019-12-09 16:54:51', '2019-12-11 16:54:51', 'testing', 'A', 1, 0, 2, '2019-12-07', 2, '2019-12-07', 1, 1, 1, 1),
(3, '3091119', '', '05', '100906', '2019-12-07 05:27:56', '2019-12-08 16:57:09', '2019-12-09 16:57:09', 'test', 'A', 1, 0, 3, '2019-12-07', 3, '2019-12-07', 1, 1, 1, 1),
(4, '121912', '', '07', '100802', '2019-12-08 07:37:28', '2019-12-08 20:35:16', '2019-12-08 20:35:16', 'test', 'A', 1, 0, 12, '2019-12-08', 12, '2019-12-08', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient_documents`
--

CREATE TABLE `hms_patient_documents` (
  `ID` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'for profile details completed: 1',
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_patient_documents`
--

INSERT INTO `hms_patient_documents` (`ID`, `patient_id`, `contact_person`, `image`, `is_completed`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(2, 2, '', 'data/patient-profile-image/2019/12/1575611070_myImage_30.jpg', 1, 0, 'A', 1, 2, '2019-11-08', 0, '2019-12-01', 1, 1, 1, 1),
(3, 3, '', 'data/patient-profile-image/2019/12/19120704040732_e_82.jpg', 0, 0, 'A', 1, 3, '2019-11-09', 0, '0000-00-00', 1, 1, 1, 1),
(4, 4, '', '', 0, 0, 'A', 1, 4, '2019-11-09', 0, '0000-00-00', 1, 1, 1, 1),
(5, 5, '', '', 0, 0, 'A', 1, 5, '2019-11-09', 0, '0000-00-00', 1, 1, 1, 1),
(7, 7, '', 'data/patient-profile-pic/1574341932_myImage_28.jpg', 1, 0, 'A', 1, 7, '2019-11-19', 8, '2019-11-21', 1, 1, 1, 1),
(8, 8, '', 'data/patient-profile-pic/1574337948_myImage_37.jpg', 1, 0, 'A', 1, 8, '2019-11-21', 0, '2019-11-21', 1, 1, 1, 1),
(9, 9, '', '', 1, 0, 'A', 1, 9, '2019-11-28', 45, '2019-11-28', 1, 1, 1, 1),
(10, 10, '', 'data/patient-profile-pic/1575537250_myImage_32.jpg', 1, 0, 'A', 1, 10, '2019-12-05', 0, '2019-12-05', 1, 1, 1, 1),
(11, 11, '', '', 0, 0, 'A', 1, 11, '2019-12-05', 11, '2019-12-05', 1, 1, 1, 1),
(12, 12, '', '', 0, 0, 'A', 1, 12, '2019-12-06', 12, '2019-12-06', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient_emergency_calls`
--

CREATE TABLE `hms_patient_emergency_calls` (
  `ID` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) DEFAULT 0,
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL DEFAULT 1,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_patient_emergency_calls`
--

INSERT INTO `hms_patient_emergency_calls` (`ID`, `patient_id`, `username`, `date`, `time`, `location`, `latitude`, `longitude`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 0, '9784628881', '2019-11-05', '02:34:00', '', '28.6255141', '77.3772918', 'A', 1, 0, 1, '2019-11-14', 1, '2019-11-14', 1, 1, 1, 1),
(2, 0, '9784628881', '2019-11-26', '03:15:11', '', '28.6255141', '77.3772918', 'A', 1, 0, 1, '2019-11-26', 1, '2019-11-26', 1, 1, 1, 1),
(3, 0, '9784628881', '2019-11-26', '03:41:12', '', '28.6255141', '77.3772918', 'A', 1, 0, 1, '2019-11-26', 1, '2019-11-26', 1, 1, 1, 1),
(4, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(5, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(6, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(7, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(8, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(9, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(10, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(11, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(12, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(13, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(14, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(15, 0, '6290636076', '2019-11-28', '12:08:54', '', '12', '12', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(16, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(17, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(18, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(19, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(20, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(21, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(22, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(23, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(24, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(25, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(26, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(27, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(28, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(29, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(30, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(31, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(32, 0, '6290636076', '2019-11-28', '01:24:39', '', '28.6254565', '77.3771264', 'A', 1, 0, 1, '2019-11-28', 1, '2019-11-28', 1, 1, 1, 1),
(33, 0, '9784628881', '2019-11-29', '02:18:55', '', '28.6254465', '77.3771384', 'A', 1, 0, 1, '2019-11-29', 1, '2019-11-29', 1, 1, 1, 1),
(34, 0, '9784628881', '2019-12-01', '06:01:33', '', '28.629246', '77.1470198', 'A', 1, 0, 1, '2019-12-01', 1, '2019-12-01', 1, 1, 1, 1),
(35, 0, '9784628881', '2019-12-02', '05:42:21', '', '28.62546693037106', '77.37725421553927', 'A', 1, 0, 1, '2019-12-02', 1, '2019-12-02', 1, 1, 1, 1),
(36, 0, '8279818917', '2019-12-05', '05:02:19', '', '28.625504', '77.3771763', 'A', 1, 0, 1, '2019-12-05', 1, '2019-12-05', 1, 1, 1, 1),
(37, 0, '8279818917', '2019-12-05', '05:41:56', '', '12', '12', 'A', 1, 0, 1, '2019-12-05', 1, '2019-12-05', 1, 1, 1, 1),
(38, 0, '8750237242', '2019-12-07', '03:38:32', '', '28.6255062', '77.3771945', 'A', 1, 0, 1, '2019-12-07', 1, '2019-12-07', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient_feedback`
--

CREATE TABLE `hms_patient_feedback` (
  `ID` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `hospital_rate` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 to 5',
  `checkup_rate` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 to 5',
  `description` text CHARACTER SET utf8 NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL DEFAULT 1,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_patient_feedback`
--

INSERT INTO `hms_patient_feedback` (`ID`, `patient_id`, `username`, `date`, `hospital_rate`, `checkup_rate`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 0, '9784628881', '2019-11-14 10:00:00', 5, 5, 'It is a long established fact that a reader will be distracted by the readable ', 'A', 1, 0, 1, '2019-11-14', 1, '2019-11-14', 1, 1, 1, 1),
(3, 0, '9784628881', '2019-11-27 01:17:44', 2, 4, 'beta app', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(4, 0, '9784628881', '2019-11-27 01:18:06', 2, 4, 'beta app +', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(5, 0, '9784628881', '2019-11-27 01:20:28', 2, 3, 'all functionality not working.', 'A', 1, 0, 1, '2019-11-27', 1, '2019-11-27', 1, 1, 1, 1),
(6, 0, '9784628881', '2019-12-07 03:35:14', 2, 4, 'for testing purpose.', 'A', 1, 0, 1, '2019-12-07', 1, '2019-12-07', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_patient_log`
--

CREATE TABLE `hms_patient_log` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `signin_time` datetime NOT NULL,
  `signout_time` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` int(11) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(3) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_product`
--

CREATE TABLE `hms_product` (
  `ID` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL,
  `image` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `product_amount` varchar(11) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_product`
--

INSERT INTO `hms_product` (`ID`, `product_id`, `name`, `quantity`, `image`, `description`, `product_amount`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '#AST-0001', 'anesthetic machine', 2, 'data/products-image/2019/12/19120601010815_72_5.jpg', 'randomised words even slightly believable', '$62480 ', 'A', 1, 0, 0, '0000-00-00', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_services`
--

CREATE TABLE `hms_services` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL,
  `customer_group` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text NOT NULL,
  `service_amount` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_services`
--

INSERT INTO `hms_services` (`ID`, `name`, `service_id`, `quantity`, `customer_group`, `image`, `start_date`, `end_date`, `description`, `service_amount`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Testing Service', '#AST-0001', 1, '1', 'data/services-image/2019/12/19120601011423_72_5.jpg', '2019-11-05 00:00:00', '2019-11-05 00:00:00', 'This is testing Service', '$62480', 'A', 1, 0, 1, '2019-11-05', 0, '0000-00-00', 1, 1, 1, 1),
(2, 'anesthetic machine', '#AST-00011', 11, 'Women', 'data/services_image/1573216283_offer.png', '2019-11-06 00:00:00', '2019-11-27 00:00:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '$2000', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_sms_setting`
--

CREATE TABLE `hms_sms_setting` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `api_url` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `template_id` varchar(255) NOT NULL,
  `otp_expiry` int(3) NOT NULL DEFAULT 0 COMMENT 'In minutes, 0 : unlimited',
  `otp_length` int(3) NOT NULL COMMENT '0: unlimited',
  `type` varchar(255) NOT NULL DEFAULT 'OTP',
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_sms_setting`
--

INSERT INTO `hms_sms_setting` (`ID`, `name`, `api_url`, `auth_key`, `template_id`, `otp_expiry`, `otp_length`, `type`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Mobile number verification', 'https://api.msg91.com/api/v5/otp', '302562AgdtgZ1pz5dc37b8e', '5dc40eabd6fc055a11080d46', 10, 6, 'OTP', '', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1),
(2, 'OTP verification', 'https://api.msg91.com/api/v5/otp/verify', '302562AgdtgZ1pz5dc37b8e', '', 0, 0, 'OTP', '', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1),
(3, 'Order confirmation', 'https://api.msg91.com/api/v5/sms', '302562AgdtgZ1pz5dc37b8e', '', 0, 0, 'SMS', '', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1),
(4, 'Order cancellation confirmation', 'https://api.msg91.com/api/v5/sms', '302562AgdtgZ1pz5dc37b8e', '', 0, 0, 'SMS', '', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1),
(5, 'Password reset verification', 'https://api.msg91.com/api/v5/otp', '302562AgdtgZ1pz5dc37b8e', '5dc40eabd6fc055a11080d46', 10, 6, 'OTP', '', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1),
(6, 'patient appointment confirmation', 'https://api.msg91.com/api/v5/sms', '302562AgdtgZ1pz5dc37b8e', '', 0, 0, 'SMS', '', 'A', 1, 0, 1, '2019-11-08', 0, '0000-00-00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_sub_patient`
--

CREATE TABLE `hms_sub_patient` (
  `ID` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL COMMENT 'Patient ID',
  `parent_username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `parent_relation` varchar(255) NOT NULL,
  `prn` varchar(300) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `alternet_number` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '1: Male, 2: Female, 3: Other',
  `blood_group` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dob` date NOT NULL,
  `marital_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1; unmarried, 2: married',
  `religious` varchar(255) NOT NULL,
  `first_device_id` varchar(255) NOT NULL,
  `last_device_id` varchar(255) NOT NULL,
  `promo_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `charge_category_code` varchar(255) NOT NULL COMMENT '05: NTUC MEMBER, ',
  `payment_class_code` varchar(255) NOT NULL COMMENT 'PT: Private (Independent OP), ',
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_sub_patient`
--

INSERT INTO `hms_sub_patient` (`ID`, `parent_id`, `parent_username`, `parent_relation`, `prn`, `title`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `email_id`, `contact_number`, `alternet_number`, `gender`, `blood_group`, `dob`, `marital_status`, `religious`, `first_device_id`, `last_device_id`, `promo_code`, `status`, `show_status`, `is_deleted`, `description`, `charge_category_code`, `payment_class_code`, `last_login`, `last_logout`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(3, 2, '9784628881', 'Daughter', '11193', 'Mr.', 'Demo2', 'Lal', 'Lal2', 'Demo-3', '', 'dinesh.qcws@gmail.com', '9784628881', '', 2, '', '2011-11-26', 1, 'Hindu', 'demo', '', '', 'A', 1, 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '2019-11-26', 0, '2019-11-28', 1, 1, 1, 1),
(4, 9, '6290636076', 'Father', '11194', 'Mr.', 'Sourav', '', 'Choudhury', 'Sourav-4', '', 'sauravchoudhury541@gmail.com', '629063607', '', 1, '', '1990-01-21', 1, 'Hindu', 'demo', '', '', 'A', 1, 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, '2019-11-28', 4, '2019-11-28', 1, 1, 1, 1),
(10, 10, '8279818917', 'Son', '121910', 'Mr.', 'Shanu', '', 'Kumar', 'Shanu-10', '', 'shushank.kumar@softlogique.com', '8279818917', '', 1, '', '2019-03-05', 1, 'Hindu', 'demo', '', '', 'A', 1, 0, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, '2019-12-05', 10, '2019-12-05', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_sub_patient_address`
--

CREATE TABLE `hms_sub_patient_address` (
  `ID` int(11) NOT NULL,
  `sub_patient_id` int(11) NOT NULL,
  `address_line1` text NOT NULL,
  `address_line2` text NOT NULL,
  `address_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: home, 2: office',
  `postal_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `district_code` varchar(255) NOT NULL,
  `city_code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_sub_patient_address`
--

INSERT INTO `hms_sub_patient_address` (`ID`, `sub_patient_id`, `address_line1`, `address_line2`, `address_type`, `postal_code`, `country_code`, `state_code`, `district_code`, `city_code`, `active`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(3, 3, 'Veerdholiya', 'Mavli', 1, '313201', 'VN', '', '1', '', 1, 0, 'A', 1, 3, '2019-11-26', 3, '2019-11-26', 1, 1, 1, 1),
(4, 4, 'A-29,AG West Bengal Housing Society,kol-94', 'Kolkata', 1, '700094', 'VN', '1', '2', '', 1, 0, 'A', 1, 4, '2019-11-28', 4, '2019-11-28', 1, 1, 1, 1),
(10, 10, 'sjejw hsjshejdb ', 'Omon', 1, '171315', 'VN', '1', '5', '', 1, 0, 'A', 1, 10, '2019-12-05', 10, '2019-12-05', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_sub_patient_documents`
--

CREATE TABLE `hms_sub_patient_documents` (
  `ID` int(11) NOT NULL,
  `sub_patient_id` int(11) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'for profile details completed: 1',
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_sub_patient_documents`
--

INSERT INTO `hms_sub_patient_documents` (`ID`, `sub_patient_id`, `contact_person`, `image`, `is_completed`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(3, 3, '', 'data/sub-patient-profile-image/2019/12/1575611218_myImage_19.jpg', 1, 0, 'A', 1, 3, '2019-11-26', 3, '2019-11-26', 1, 1, 1, 1),
(4, 4, '', 'data/sub-patient-profile-pic/1574932862_Screenshot_20191128-105522.png', 1, 0, 'A', 1, 4, '2019-11-28', 4, '2019-11-28', 1, 1, 1, 1),
(10, 10, '', 'data/sub-patient-profile-pic/1575532143_IMG_20161204_092012.jpg', 1, 0, 'A', 1, 10, '2019-12-05', 10, '2019-12-05', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_time_zone`
--

CREATE TABLE `hms_time_zone` (
  `ID` int(11) NOT NULL,
  `lebel` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_time_zone`
--

INSERT INTO `hms_time_zone` (`ID`, `lebel`, `value`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`) VALUES
(1, '(GMT-11:00) American Samoa', 'American Samoa', 'A', 1, 0, 1, '2019-05-01'),
(2, '(GMT-11:00) International Date Line West', 'International Date Line West', 'A', 1, 0, 1, '2019-05-01'),
(3, '(GMT-11:00) Midway Island', 'Midway Island', 'A', 1, 0, 1, '2019-05-01'),
(4, '(GMT-10:00) Hawaii', 'Hawaii', 'A', 1, 0, 1, '2019-05-01'),
(5, '(GMT-09:00) Alaska', 'Alaska', 'A', 1, 0, 1, '2019-05-01'),
(6, '(GMT-08:00) Pacific Time (US &amp; Canada)', 'Pacific Time (US &amp; Canada)', 'A', 1, 0, 1, '2019-05-01'),
(7, '(GMT-08:00) Tijuana', 'Tijuana', 'A', 1, 0, 1, '2019-05-01'),
(8, '(GMT-07:00) Arizona', 'Arizona', 'A', 1, 0, 1, '2019-05-01'),
(9, '(GMT-07:00) Chihuahua', 'Chihuahua', 'A', 1, 0, 1, '2019-05-01'),
(10, '(GMT-07:00) Mazatlan', 'Mazatlan', 'A', 1, 0, 1, '2019-05-01'),
(11, '(GMT-07:00) Mountain Time (US &amp; Canada)', 'Mountain Time (US &amp; Canada)', 'A', 1, 0, 1, '2019-05-01'),
(12, '(GMT-06:00) Central America', 'Central America', 'A', 1, 0, 1, '2019-05-01'),
(13, '(GMT-06:00) Central Time (US &amp; Canada)', 'Central Time (US &amp; Canada)', 'A', 1, 0, 1, '2019-05-01'),
(14, '(GMT-06:00) Guadalajara', 'Guadalajara', 'A', 1, 0, 1, '2019-05-01'),
(15, '(GMT-06:00) Mexico City', 'Mexico City', 'A', 1, 0, 1, '2019-05-01'),
(16, '(GMT-06:00) Monterrey', 'Monterrey', 'A', 1, 0, 1, '2019-05-01'),
(17, '(GMT-06:00) Saskatchewan', 'Saskatchewan', 'A', 1, 0, 1, '2019-05-01'),
(18, '(GMT-05:00) Bogota', 'Bogota', 'A', 1, 0, 1, '2019-05-01'),
(19, '(GMT-05:00) Eastern Time (US &amp; Canada)', 'Eastern Time (US &amp; Canada)', 'A', 1, 0, 1, '2019-05-01'),
(20, '(GMT-05:00) Indiana (East)', 'Indiana (East)', 'A', 1, 0, 1, '2019-05-01'),
(21, '(GMT-05:00) Lima', 'Lima', 'A', 1, 0, 1, '2019-05-01'),
(22, '(GMT-05:00) Quito', 'Quito', 'A', 1, 0, 1, '2019-05-01'),
(23, '(GMT-04:00) Atlantic Time (Canada)', 'Atlantic Time (Canada)', 'A', 1, 0, 1, '2019-05-01'),
(24, '(GMT-04:00) Caracas', 'Caracas', 'A', 1, 0, 1, '2019-05-01'),
(25, '(GMT-04:00) Georgetown', 'Georgetown', 'A', 1, 0, 1, '2019-05-01'),
(26, '(GMT-04:00) La Paz', 'La Paz', 'A', 1, 0, 1, '2019-05-01'),
(27, '(GMT-04:00) Santiago', 'Santiago', 'A', 1, 0, 1, '2019-05-01'),
(28, '(GMT-03:30) Newfoundland', 'Newfoundland', 'A', 1, 0, 1, '2019-05-01'),
(29, '(GMT-03:00) Brasilia', 'Brasilia', 'A', 1, 0, 1, '2019-05-01'),
(30, '(GMT-03:00) Buenos Aires', 'Buenos Aires', 'A', 1, 0, 1, '2019-05-01'),
(31, '(GMT-03:00) Greenland', 'Greenland', 'A', 1, 0, 1, '2019-05-01'),
(32, '(GMT-03:00) Montevideo', 'Montevideo', 'A', 1, 0, 1, '2019-05-01'),
(33, '(GMT-02:00) Mid-Atlantic', 'Mid-Atlantic', 'A', 1, 0, 1, '2019-05-01'),
(34, '(GMT-01:00) Azores', 'Azores', 'A', 1, 0, 1, '2019-05-01'),
(35, '(GMT-01:00) Cape Verde Is.', 'Cape Verde Is.', 'A', 1, 0, 1, '2019-05-01'),
(36, '(GMT+00:00) Casablanca', 'Casablanca', 'A', 1, 0, 1, '2019-05-01'),
(37, '(GMT+00:00) Dublin', 'Dublin', 'A', 1, 0, 1, '2019-05-01'),
(38, '(GMT+00:00) Edinburgh', 'Edinburgh', 'A', 1, 0, 1, '2019-05-01'),
(39, '(GMT+00:00) Lisbon', 'Lisbon', 'A', 1, 0, 1, '2019-05-01'),
(40, '(GMT+00:00) London', 'London', 'A', 1, 0, 1, '2019-05-01'),
(41, '(GMT+00:00) Monrovia', 'Monrovia', 'A', 1, 0, 1, '2019-05-01'),
(42, '(GMT+00:00) UTC', 'UTC', 'A', 1, 0, 1, '2019-05-01'),
(43, '(GMT+01:00) Amsterdam', 'Amsterdam', 'A', 1, 0, 1, '2019-05-01'),
(44, '(GMT+01:00) Belgrade', 'Belgrade', 'A', 1, 0, 1, '2019-05-01'),
(45, '(GMT+01:00) Berlin', 'Berlin', 'A', 1, 0, 1, '2019-05-01'),
(46, '(GMT+01:00) Bern', 'Bern', 'A', 1, 0, 1, '2019-05-01'),
(47, '(GMT+01:00) Bratislava', 'Bratislava', 'A', 1, 0, 1, '2019-05-01'),
(48, '(GMT+01:00) Brussels', 'Brussels', 'A', 1, 0, 1, '2019-05-01'),
(49, '(GMT+01:00) Budapest', 'Budapest', 'A', 1, 0, 1, '2019-05-01'),
(50, '(GMT+01:00) Copenhagen', 'Copenhagen', 'A', 1, 0, 1, '2019-05-01'),
(51, '(GMT+01:00) Ljubljana', 'Ljubljana', 'A', 1, 0, 1, '2019-05-01'),
(52, '(GMT+01:00) Madrid', 'Madrid', 'A', 1, 0, 1, '2019-05-01'),
(53, '(GMT+01:00) Paris', 'Paris', 'A', 1, 0, 1, '2019-05-01'),
(54, '(GMT+01:00) Prague', 'Prague', 'A', 1, 0, 1, '2019-05-01'),
(55, '(GMT+01:00) Rome', 'Rome', 'A', 1, 0, 1, '2019-05-01'),
(56, '(GMT+01:00) Sarajevo', 'Sarajevo', 'A', 1, 0, 1, '2019-05-01'),
(57, '(GMT+01:00) Skopje', 'Skopje', 'A', 1, 0, 1, '2019-05-01'),
(58, '(GMT+01:00) Stockholm', 'Stockholm', 'A', 1, 0, 1, '2019-05-01'),
(59, '(GMT+01:00) Vienna', 'Vienna', 'A', 1, 0, 1, '2019-05-01'),
(60, '(GMT+01:00) Warsaw', 'Warsaw', 'A', 1, 0, 1, '2019-05-01'),
(61, '(GMT+01:00) West Central Africa', 'West Central Africa', 'A', 1, 0, 1, '2019-05-01'),
(62, '(GMT+01:00) Zagreb', 'Zagreb', 'A', 1, 0, 1, '2019-05-01'),
(63, '(GMT+02:00) Athens', 'Athens', 'A', 1, 0, 1, '2019-05-01'),
(64, '(GMT+02:00) Bucharest', 'Bucharest', 'A', 1, 0, 1, '2019-05-01'),
(65, '(GMT+02:00) Cairo', 'Cairo', 'A', 1, 0, 1, '2019-05-01'),
(66, '(GMT+02:00) Harare', 'Harare', 'A', 1, 0, 1, '2019-05-01'),
(67, '(GMT+02:00) Helsinki', 'Helsinki', 'A', 1, 0, 1, '2019-05-01'),
(68, '(GMT+02:00) Jerusalem', 'Jerusalem', 'A', 1, 0, 1, '2019-05-01'),
(69, '(GMT+02:00) Kaliningrad', 'Kaliningrad', 'A', 1, 0, 1, '2019-05-01'),
(70, '(GMT+02:00) Kyiv', 'Kyiv', 'A', 1, 0, 1, '2019-05-01'),
(71, '(GMT+02:00) Pretoria', 'Pretoria', 'A', 1, 0, 1, '2019-05-01'),
(72, '(GMT+02:00) Riga', 'Riga', 'A', 1, 0, 1, '2019-05-01'),
(73, '(GMT+02:00) Sofia', 'Sofia', 'A', 1, 0, 1, '2019-05-01'),
(74, '(GMT+02:00) Tallinn', 'Tallinn', 'A', 1, 0, 1, '2019-05-01'),
(75, '(GMT+02:00) Vilnius', 'Vilnius', 'A', 1, 0, 1, '2019-05-01'),
(76, '(GMT+03:00) Baghdad', 'Baghdad', 'A', 1, 0, 1, '2019-05-01'),
(77, '(GMT+03:00) Istanbul', 'Istanbul', 'A', 1, 0, 1, '2019-05-01'),
(78, '(GMT+03:00) Kuwait', 'Kuwait', 'A', 1, 0, 1, '2019-05-01'),
(79, '(GMT+03:00) Minsk', 'Minsk', 'A', 1, 0, 1, '2019-05-01'),
(80, '(GMT+03:00) Moscow', 'Moscow', 'A', 1, 0, 1, '2019-05-01'),
(81, '(GMT+03:00) Nairobi', 'Nairobi', 'A', 1, 0, 1, '2019-05-01'),
(82, '(GMT+03:00) Riyadh', 'Riyadh', 'A', 1, 0, 1, '2019-05-01'),
(83, '(GMT+03:00) St. Petersburg', 'St. Petersburg', 'A', 1, 0, 1, '2019-05-01'),
(84, '(GMT+03:00) Volgograd', 'Volgograd', 'A', 1, 0, 1, '2019-05-01'),
(85, '(GMT+03:30) Tehran', 'Tehran', 'A', 1, 0, 1, '2019-05-01'),
(86, '(GMT+04:00) Abu Dhabi', 'Abu Dhabi', 'A', 1, 0, 1, '2019-05-01'),
(87, '(GMT+04:00) Baku', 'Baku', 'A', 1, 0, 1, '2019-05-01'),
(88, '(GMT+04:00) Muscat', 'Muscat', 'A', 1, 0, 1, '2019-05-01'),
(89, '(GMT+04:00) Samara', 'Samara', 'A', 1, 0, 1, '2019-05-01'),
(90, '(GMT+04:00) Tbilisi', 'Tbilisi', 'A', 1, 0, 1, '2019-05-01'),
(91, '(GMT+04:00) Yerevan', 'Yerevan', 'A', 1, 0, 1, '2019-05-01'),
(92, '(GMT+04:30) Kabul', 'Kabul', 'A', 1, 0, 1, '2019-05-01'),
(93, '(GMT+05:00) Ekaterinburg', 'Ekaterinburg', 'A', 1, 0, 1, '2019-05-01'),
(94, '(GMT+05:00) Islamabad', 'Islamabad', 'A', 1, 0, 1, '2019-05-01'),
(95, '(GMT+05:00) Karachi', 'Karachi', 'A', 1, 0, 1, '2019-05-01'),
(96, '(GMT+05:00) Tashkent', 'Tashkent', 'A', 1, 0, 1, '2019-05-01'),
(97, '(GMT+05:30) Chennai', 'Chennai', 'A', 1, 0, 1, '2019-05-01'),
(98, '(GMT+05:30) Kolkata', 'Kolkata', 'A', 1, 0, 1, '2019-05-01'),
(99, '(GMT+05:30) Mumbai', 'Mumbai', 'A', 1, 0, 1, '2019-05-01'),
(100, '(GMT+05:30) New Delhi', 'New Delhi', 'A', 1, 0, 1, '2019-05-01'),
(101, '(GMT+05:30) Sri Jayawardenepura', 'Sri Jayawardenepura', 'A', 1, 0, 1, '2019-05-01'),
(102, '(GMT+05:45) Kathmandu', 'Kathmandu', 'A', 1, 0, 1, '2019-05-01'),
(103, '(GMT+06:00) Almaty', 'Almaty', 'A', 1, 0, 1, '2019-05-01'),
(104, '(GMT+06:00) Astana', 'Astana', 'A', 1, 0, 1, '2019-05-01'),
(105, '(GMT+06:00) Dhaka', 'Dhaka', 'A', 1, 0, 1, '2019-05-01'),
(106, '(GMT+06:00) Urumqi', 'Urumqi', 'A', 1, 0, 1, '2019-05-01'),
(107, '(GMT+06:30) Rangoon', 'Rangoon', 'A', 1, 0, 1, '2019-05-01'),
(108, '(GMT+07:00) Bangkok', 'Bangkok', 'A', 1, 0, 1, '2019-05-01'),
(109, '(GMT+07:00) Hanoi', 'Hanoi', 'A', 1, 0, 1, '2019-05-01'),
(110, '(GMT+07:00) Jakarta', 'Jakarta', 'A', 1, 0, 1, '2019-05-01'),
(111, '(GMT+07:00) Krasnoyarsk', 'Krasnoyarsk', 'A', 1, 0, 1, '2019-05-01'),
(112, '(GMT+07:00) Novosibirsk', 'Novosibirsk', 'A', 1, 0, 1, '2019-05-01'),
(113, '(GMT+08:00) Beijing', 'Beijing', 'A', 1, 0, 1, '2019-05-01'),
(114, '(GMT+08:00) Chongqing', 'Chongqing', 'A', 1, 0, 1, '2019-05-01'),
(115, '(GMT+08:00) Hong Kong', 'Hong Kong', 'A', 1, 0, 1, '2019-05-01'),
(116, '(GMT+08:00) Irkutsk', 'Irkutsk', 'A', 1, 0, 1, '2019-05-01'),
(117, '(GMT+08:00) Kuala Lumpur', 'Kuala Lumpur', 'A', 1, 0, 1, '2019-05-01'),
(118, '(GMT+08:00) Perth', 'Perth', 'A', 1, 0, 1, '2019-05-01'),
(119, '(GMT+08:00) Singapore', 'Singapore', 'A', 1, 0, 1, '2019-05-01'),
(120, '(GMT+08:00) Taipei', 'Taipei', 'A', 1, 0, 1, '2019-05-01'),
(121, '(GMT+08:00) Ulaanbaatar', 'Ulaanbaatar', 'A', 1, 0, 1, '2019-05-01'),
(122, '(GMT+09:00) Osaka', 'Osaka', 'A', 1, 0, 1, '2019-05-01'),
(123, '(GMT+09:00) Sapporo', 'Sapporo', 'A', 1, 0, 1, '2019-05-01'),
(124, '(GMT+09:00) Seoul', 'Seoul', 'A', 1, 0, 1, '2019-05-01'),
(125, '(GMT+09:00) Tokyo', 'Tokyo', 'A', 1, 0, 1, '2019-05-01'),
(126, '(GMT+09:00) Yakutsk', 'Yakutsk', 'A', 1, 0, 1, '2019-05-01'),
(127, '(GMT+09:30) Adelaide', 'Adelaide', 'A', 1, 0, 1, '2019-05-01'),
(128, '(GMT+09:30) Darwin', 'Darwin', 'A', 1, 0, 1, '2019-05-01'),
(129, '(GMT+10:00) Brisbane', 'Brisbane', 'A', 1, 0, 1, '2019-05-01'),
(130, '(GMT+10:00) Canberra', 'Canberra', 'A', 1, 0, 1, '2019-05-01'),
(131, '(GMT+10:00) Guam', 'Guam', 'A', 1, 0, 1, '2019-05-01'),
(132, '(GMT+10:00) Hobart', 'Hobart', 'A', 1, 0, 1, '2019-05-01'),
(133, '(GMT+10:00) Melbourne', 'Melbourne', 'A', 1, 0, 1, '2019-05-01'),
(134, '(GMT+10:00) Port Moresby', 'Port Moresby', 'A', 1, 0, 1, '2019-05-01'),
(135, '(GMT+10:00) Sydney', 'Sydney', 'A', 1, 0, 1, '2019-05-01'),
(136, '(GMT+10:00) Vladivostok', 'Vladivostok', 'A', 1, 0, 1, '2019-05-01'),
(137, '(GMT+11:00) Magadan', 'Magadan', 'A', 1, 0, 1, '2019-05-01'),
(138, '(GMT+11:00) New Caledonia', 'New Caledonia', 'A', 1, 0, 1, '2019-05-01'),
(139, '(GMT+11:00) Solomon Is.', 'Solomon Is.', 'A', 1, 0, 1, '2019-05-01'),
(140, '(GMT+11:00) Srednekolymsk', 'Srednekolymsk', 'A', 1, 0, 1, '2019-05-01'),
(141, '(GMT+12:00) Auckland', 'Auckland', 'A', 1, 0, 1, '2019-05-01'),
(142, '(GMT+12:00) Fiji', 'Fiji', 'A', 1, 0, 1, '2019-05-01'),
(143, '(GMT+12:00) Kamchatka', 'Kamchatka', 'A', 1, 0, 1, '2019-05-01'),
(144, '(GMT+12:00) Marshall Is.', 'Marshall Is.', 'A', 1, 0, 1, '2019-05-01'),
(145, '(GMT+12:00) Wellington', 'Wellington', 'A', 1, 0, 1, '2019-05-01'),
(146, '(GMT+12:45) Chatham Is.', 'Chatham Is.', 'A', 1, 0, 1, '2019-05-01'),
(147, '(GMT+13:00) Nuku\'alofa', 'Nuku\'alofa', 'A', 1, 0, 1, '2019-05-01'),
(148, '(GMT+13:00) Samoa', 'Samoa', 'A', 1, 0, 1, '2019-05-01'),
(149, '(GMT+13:00) Tokelau Is.', 'Tokelau Is.', 'A', 1, 0, 1, '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `hms_user`
--

CREATE TABLE `hms_user` (
  `ID` int(3) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `contact_number` varchar(200) NOT NULL,
  `alternet_contact_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `blood_group` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role_type` varchar(200) NOT NULL,
  `role_id` int(3) NOT NULL,
  `department_id` int(3) NOT NULL,
  `description` text NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_user`
--

INSERT INTO `hms_user` (`ID`, `emp_no`, `title`, `first_name`, `middle_name`, `last_name`, `user_name`, `user_password`, `email_id`, `contact_number`, `alternet_contact_number`, `gender`, `dob`, `blood_group`, `role_type`, `role_id`, `department_id`, `description`, `last_login`, `last_logout`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, '', 'Mr.', 'Admin', '', '1', 'admin@nitdemo.in', 'd841b562ea6ebb91f9c2b48c75cca2a371d59b65', 'admin@nitdemo.in', '9999999999', '5555555555', 'M', '1989-10-25', 'AB', 'Developer', 1, 6, 'Hello', '2019-12-10 03:12:18', '2019-12-09 06:12:06', 'A', 1, 0, 1, '2019-01-01', 1, '2019-12-10', 1, 1, 1, 1),
(6, '', 'Mr.', 'test', '', '1', 'test@test.com', 'd841b562ea6ebb91f9c2b48c75cca2a371d59b65', 'test@softlogique.com', '7894567890', '', 'M', '1989-10-30', 'B+', 'User', 3, 2, 'ABC', '2019-11-14 11:11:52', '2019-11-14 11:11:53', 'A', 1, 0, 1, '2019-05-24', 1, '2019-12-10', 1, 1, 1, 1),
(7, '', 'Dr.', 'Test1', '', '', 'test1@test.com', 'd841b562ea6ebb91f9c2b48c75cca2a371d59b65', 'test1@test.com', '9999999999', '', 'M', '1989-11-30', 'AB+', 'User', 3, 1, 'Hello, this is testing user.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'A', 1, 0, 1, '2019-06-05', 1, '2019-12-10', 1, 1, 1, 1),
(34, 'HANH - 34', 'Mr.', 'test4', '', '', 'test4@gmail.com', '47b2e3bf057bae34593a0803d2009ccc4c3c29a1', 'test4@gmail.com', '2312312333', '', 'M', '2019-11-21', 'A-', 'Employee', 2, 4, 'zczxczxczxc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'A', 1, 0, 1, '2019-11-27', 1, '2019-12-10', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_user_address`
--

CREATE TABLE `hms_user_address` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_line1` text NOT NULL,
  `address_line2` text NOT NULL,
  `address_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: home, 2: office',
  `postal_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `district_code` varchar(255) NOT NULL,
  `city_code` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_user_address`
--

INSERT INTO `hms_user_address` (`ID`, `user_id`, `address_line1`, `address_line2`, `address_type`, `postal_code`, `country_code`, `state_code`, `district_code`, `city_code`, `active`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 1, 'ABC', 'XYZ1', 1, '111111', 'VN', '', '1', '', 1, 0, 'A', 1, 1, '2019-01-01', 1, '2019-12-10', 1, 1, 1, 1),
(3, 6, 'XYZ', 'PQR', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 1, '2019-05-24', 1, '2019-12-10', 1, 1, 1, 1),
(4, 7, 'New Delhi', '', 1, '', 'VN', '', '', '', 1, 0, 'A', 1, 1, '2019-06-05', 1, '2019-12-10', 1, 1, 1, 1),
(31, 34, 'ABC', 'XYZ', 1, '111111', 'VN', '', '3', '', 1, 0, 'A', 1, 1, '2019-11-21', 1, '2019-12-10', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_user_documents`
--

CREATE TABLE `hms_user_documents` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'for profile details completed: 1',
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL DEFAULT 1,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_user_documents`
--

INSERT INTO `hms_user_documents` (`ID`, `user_id`, `contact_person`, `image`, `is_completed`, `is_deleted`, `status`, `show_status`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(2, 1, '', 'data/user-profile-image/2019/12/19120612123236_st-3.jpg', 1, 0, 'A', 1, 2, '2019-05-24', 1, '2019-12-10', 1, 1, 1, 1),
(6, 6, 'Demo', 'data/user-profile-image/2019/12/19121012123243_st-3.jpg', 1, 0, 'A', 1, 1, '2019-05-24', 1, '2019-12-10', 1, 1, 1, 1),
(7, 7, 'Demo', 'data/user-profile-image/2019/12/19121012122431_st-3.jpg', 1, 0, 'A', 1, 1, '2019-06-05', 1, '2019-12-10', 1, 1, 1, 1),
(29, 34, '', 'data/user-profile-image/2019/12/19120911114246_st-3.jpg', 1, 0, 'A', 1, 1, '2019-11-21', 1, '2019-12-10', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_user_log`
--

CREATE TABLE `hms_user_log` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `signin_time` datetime NOT NULL,
  `signout_time` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hms_user_module`
--

CREATE TABLE `hms_user_module` (
  `ID` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `all_btn` tinyint(1) DEFAULT 0,
  `add_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `view_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `edit_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `delete_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `status_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `print_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `other_btn` tinyint(1) DEFAULT 0 COMMENT '1: Enable, 0 : Disable',
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_user_module`
--

INSERT INTO `hms_user_module` (`ID`, `role_id`, `module_id`, `all_btn`, `add_btn`, `view_btn`, `edit_btn`, `delete_btn`, `status_btn`, `print_btn`, `other_btn`, `status`, `show_status`, `is_deleted`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(3, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(4, 1, 4, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(5, 1, 5, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(6, 1, 6, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(7, 1, 7, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(8, 1, 8, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(9, 1, 9, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(10, 1, 10, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(11, 1, 11, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(12, 1, 12, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(13, 1, 13, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(14, 1, 14, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(15, 1, 15, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(16, 1, 16, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(17, 1, 17, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(18, 1, 18, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(19, 1, 19, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(20, 1, 20, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(21, 1, 21, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(22, 1, 22, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(23, 1, 23, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(24, 1, 24, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(25, 1, 25, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(26, 1, 26, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(27, 1, 27, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(28, 1, 28, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(29, 1, 29, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(30, 1, 30, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(31, 1, 31, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(32, 1, 32, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(33, 1, 33, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(34, 1, 34, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(35, 1, 35, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(36, 1, 36, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(37, 1, 37, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(38, 1, 38, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(39, 1, 39, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(40, 1, 40, 1, 1, 1, 1, 1, 1, 1, 1, 'A', 1, 0),
(49, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(50, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(51, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(52, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(53, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(54, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(55, 2, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(56, 2, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(57, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(58, 2, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(59, 2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(60, 2, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(61, 2, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(62, 2, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(63, 2, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(64, 2, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(65, 2, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(66, 2, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(67, 2, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(68, 2, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(69, 2, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(70, 2, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(71, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(72, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(73, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(74, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(75, 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(76, 3, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(77, 3, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(78, 3, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(79, 3, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(80, 3, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(81, 3, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(82, 3, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(83, 3, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(84, 3, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(85, 3, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(86, 3, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(87, 3, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(88, 3, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(89, 3, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(90, 3, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(91, 3, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0),
(92, 3, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_user_role`
--

CREATE TABLE `hms_user_role` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'A',
  `show_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 : Hide , 1 : Show ',
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `maker_id` int(11) NOT NULL,
  `maker_date` date NOT NULL,
  `updater_id` int(11) NOT NULL,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL DEFAULT 1,
  `branch_id` int(3) NOT NULL DEFAULT 1,
  `division_id` int(3) NOT NULL DEFAULT 1,
  `other_id` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_user_role`
--

INSERT INTO `hms_user_role` (`ID`, `name`, `description`, `status`, `show_status`, `is_deleted`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Admin', 'Main User', 'A', 1, 0, 1, '2018-09-02', 1, '2018-09-02', 1, 1, 1, 1),
(2, 'Manger', 'Hello', 'A', 1, 0, 1, '2019-12-09', 1, '2019-12-09', 1, 1, 1, 1),
(3, 'Lab Tech', 'demo', 'A', 1, 0, 1, '2019-12-09', 1, '2019-12-09', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_websitesetting`
--

CREATE TABLE `hms_websitesetting` (
  `ID` tinyint(4) NOT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `logo` tinytext DEFAULT NULL,
  `customer_care_no` varchar(250) NOT NULL,
  `smtpmail_host` varchar(255) DEFAULT NULL,
  `smtpmail_port` varchar(10) DEFAULT NULL,
  `smtpmail_mail` varchar(255) DEFAULT NULL,
  `smtpmail_password` varchar(255) DEFAULT NULL,
  `map_api_key` varchar(300) NOT NULL,
  `maker_id` int(11) DEFAULT 1,
  `maker_date` date DEFAULT NULL,
  `updater_id` int(11) NOT NULL DEFAULT 1,
  `updater_date` date NOT NULL,
  `company_id` int(3) NOT NULL,
  `branch_id` int(3) NOT NULL,
  `division_id` int(3) NOT NULL,
  `other_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_websitesetting`
--

INSERT INTO `hms_websitesetting` (`ID`, `website_name`, `logo`, `customer_care_no`, `smtpmail_host`, `smtpmail_port`, `smtpmail_mail`, `smtpmail_password`, `map_api_key`, `maker_id`, `maker_date`, `updater_id`, `updater_date`, `company_id`, `branch_id`, `division_id`, `other_id`) VALUES
(1, 'Hanh Phuc', '', '+91 xxxxxx, xxxxxx', 'demo@softlogique.in', '25', 'demo@softlogique.in', 'info@321', 'AIzaSyArYeNczYWwlrTikPpnn-zsWZ_9K303f2U', 1, '2019-11-01', 1, '2019-11-01', 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hms_about_us`
--
ALTER TABLE `hms_about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hms_api_config`
--
ALTER TABLE `hms_api_config`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_api_synchronize`
--
ALTER TABLE `hms_api_synchronize`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_api_synchronize_data`
--
ALTER TABLE `hms_api_synchronize_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_api_temp`
--
ALTER TABLE `hms_api_temp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_app_banner_setting`
--
ALTER TABLE `hms_app_banner_setting`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_app_info_setting`
--
ALTER TABLE `hms_app_info_setting`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_awareness`
--
ALTER TABLE `hms_awareness`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_awar_push_notification`
--
ALTER TABLE `hms_awar_push_notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_chat_questions`
--
ALTER TABLE `hms_chat_questions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_contact`
--
ALTER TABLE `hms_contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_countries`
--
ALTER TABLE `hms_countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_districts`
--
ALTER TABLE `hms_districts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor`
--
ALTER TABLE `hms_doctor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor_address`
--
ALTER TABLE `hms_doctor_address`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor_availability`
--
ALTER TABLE `hms_doctor_availability`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor_documents`
--
ALTER TABLE `hms_doctor_documents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor_education`
--
ALTER TABLE `hms_doctor_education`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor_experience`
--
ALTER TABLE `hms_doctor_experience`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_doctor_specialization`
--
ALTER TABLE `hms_doctor_specialization`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_email_template`
--
ALTER TABLE `hms_email_template`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_mail`
--
ALTER TABLE `hms_mail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_map`
--
ALTER TABLE `hms_map`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_module`
--
ALTER TABLE `hms_module`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_offer`
--
ALTER TABLE `hms_offer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_office_location`
--
ALTER TABLE `hms_office_location`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_patient`
--
ALTER TABLE `hms_patient`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_name` (`username`);

--
-- Indexes for table `hms_patient_address`
--
ALTER TABLE `hms_patient_address`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_patient_appointment`
--
ALTER TABLE `hms_patient_appointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_patient_documents`
--
ALTER TABLE `hms_patient_documents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_patient_emergency_calls`
--
ALTER TABLE `hms_patient_emergency_calls`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_patient_feedback`
--
ALTER TABLE `hms_patient_feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_patient_log`
--
ALTER TABLE `hms_patient_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_product`
--
ALTER TABLE `hms_product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_services`
--
ALTER TABLE `hms_services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_sms_setting`
--
ALTER TABLE `hms_sms_setting`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_sub_patient`
--
ALTER TABLE `hms_sub_patient`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_name` (`username`);

--
-- Indexes for table `hms_sub_patient_address`
--
ALTER TABLE `hms_sub_patient_address`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_sub_patient_documents`
--
ALTER TABLE `hms_sub_patient_documents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_time_zone`
--
ALTER TABLE `hms_time_zone`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_user`
--
ALTER TABLE `hms_user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `hms_user_address`
--
ALTER TABLE `hms_user_address`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_user_documents`
--
ALTER TABLE `hms_user_documents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_user_log`
--
ALTER TABLE `hms_user_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_user_module`
--
ALTER TABLE `hms_user_module`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_user_role`
--
ALTER TABLE `hms_user_role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hms_websitesetting`
--
ALTER TABLE `hms_websitesetting`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hms_about_us`
--
ALTER TABLE `hms_about_us`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hms_api_config`
--
ALTER TABLE `hms_api_config`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hms_api_synchronize`
--
ALTER TABLE `hms_api_synchronize`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_api_synchronize_data`
--
ALTER TABLE `hms_api_synchronize_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_api_temp`
--
ALTER TABLE `hms_api_temp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_app_banner_setting`
--
ALTER TABLE `hms_app_banner_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `hms_app_info_setting`
--
ALTER TABLE `hms_app_info_setting`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hms_awareness`
--
ALTER TABLE `hms_awareness`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hms_awar_push_notification`
--
ALTER TABLE `hms_awar_push_notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hms_chat_questions`
--
ALTER TABLE `hms_chat_questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hms_contact`
--
ALTER TABLE `hms_contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_countries`
--
ALTER TABLE `hms_countries`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `hms_districts`
--
ALTER TABLE `hms_districts`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `hms_doctor`
--
ALTER TABLE `hms_doctor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `hms_doctor_address`
--
ALTER TABLE `hms_doctor_address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `hms_doctor_availability`
--
ALTER TABLE `hms_doctor_availability`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1992;

--
-- AUTO_INCREMENT for table `hms_doctor_documents`
--
ALTER TABLE `hms_doctor_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT for table `hms_doctor_education`
--
ALTER TABLE `hms_doctor_education`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_doctor_experience`
--
ALTER TABLE `hms_doctor_experience`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_doctor_specialization`
--
ALTER TABLE `hms_doctor_specialization`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hms_email_template`
--
ALTER TABLE `hms_email_template`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hms_mail`
--
ALTER TABLE `hms_mail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_map`
--
ALTER TABLE `hms_map`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hms_module`
--
ALTER TABLE `hms_module`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hms_offer`
--
ALTER TABLE `hms_offer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_office_location`
--
ALTER TABLE `hms_office_location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_patient`
--
ALTER TABLE `hms_patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hms_patient_address`
--
ALTER TABLE `hms_patient_address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hms_patient_appointment`
--
ALTER TABLE `hms_patient_appointment`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hms_patient_documents`
--
ALTER TABLE `hms_patient_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hms_patient_emergency_calls`
--
ALTER TABLE `hms_patient_emergency_calls`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hms_patient_feedback`
--
ALTER TABLE `hms_patient_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hms_patient_log`
--
ALTER TABLE `hms_patient_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_product`
--
ALTER TABLE `hms_product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hms_services`
--
ALTER TABLE `hms_services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hms_sms_setting`
--
ALTER TABLE `hms_sms_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hms_sub_patient`
--
ALTER TABLE `hms_sub_patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hms_sub_patient_address`
--
ALTER TABLE `hms_sub_patient_address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hms_sub_patient_documents`
--
ALTER TABLE `hms_sub_patient_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hms_time_zone`
--
ALTER TABLE `hms_time_zone`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `hms_user`
--
ALTER TABLE `hms_user`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `hms_user_address`
--
ALTER TABLE `hms_user_address`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `hms_user_documents`
--
ALTER TABLE `hms_user_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hms_user_log`
--
ALTER TABLE `hms_user_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hms_user_module`
--
ALTER TABLE `hms_user_module`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `hms_user_role`
--
ALTER TABLE `hms_user_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hms_websitesetting`
--
ALTER TABLE `hms_websitesetting`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
