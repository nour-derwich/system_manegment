-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 27, 2021 at 01:15 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `security`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data_permission`
--

CREATE TABLE `admin_data_permission` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `permission` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_module_list`
--

CREATE TABLE `admin_module_list` (
  `id` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ref_controller` varchar(255) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `function` varchar(255) DEFAULT NULL,
  `mdl_name` varchar(255) DEFAULT NULL,
  `mdl_icon` varchar(80) DEFAULT NULL,
  `mdl_heading` varchar(255) DEFAULT NULL,
  `is_super` tinyint(1) DEFAULT '0',
  `is_enable` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_module_list`
--

INSERT INTO `admin_module_list` (`id`, `sort_order`, `parent_id`, `ref_controller`, `controller`, `function`, `mdl_name`, `mdl_icon`, `mdl_heading`, `is_super`, `is_enable`, `created_date`, `created_by`) VALUES
(1, 1, 0, NULL, 'Dashboard', NULL, 'Dashboard', 'icon-dashboard', 'h_dashboard', 0, 1, '2016-06-07 13:29:11', 1),
(2, 2, 0, NULL, '', NULL, 'Admin', 'icon-dashboard', 'h_admin', 0, 1, '2016-06-07 13:29:11', 1),
(3, 1, 2, NULL, 'Users', NULL, 'User Management', 'icon-dashboard', 'h_usermanagment', 0, 1, '2016-06-07 13:29:11', 1),
(4, 3, 2, NULL, NULL, NULL, 'System Hierarchy', 'icon-dashboard', 'h_system_hierarchy', 0, 1, '2016-06-07 13:29:11', 1),
(5, 2, 4, 'Hierarchy', NULL, 'country_list', 'Country List', 'icon-dashboard', 'h_country_list', 0, 1, '2016-06-07 13:29:11', 1),
(6, 4, 4, 'Hierarchy', NULL, 'branch_list', 'Branch List', 'icon-dashboard', 'h_city_list', 0, 0, '2016-11-26 00:00:00', 1),
(7, 3, 4, 'Hierarchy', NULL, 'city_list', 'City List', 'icon-dashboard', 'h_city_list', 0, 1, '2016-11-26 00:00:00', 1),
(8, 3, 0, NULL, NULL, NULL, 'Guard', 'icon-dashboard', 'Client', 0, 1, '2016-11-26 00:00:00', 1),
(9, 3, 8, '', 'Client', 'client_history', 'Guard History', 'icon-dashboard', 'Client History', 0, 1, '2016-11-26 00:00:00', 1),
(10, 2, 8, '', 'Client', 'client_record', 'Guard Record', 'icon-dashboard', 'Client Record', 0, 1, '2016-11-26 00:00:00', 1),
(11, 1, 8, NULL, 'Client', 'client_action', 'New Guard', NULL, 'New Client', 0, 1, '2016-11-26 00:00:00', 1),
(12, 6, 0, NULL, NULL, NULL, 'Report', 'icon-dashboard', 'Report', 0, 1, '2017-01-20 00:00:00', 1),
(13, 2, 12, NULL, 'Report', 'buyer_sales_report', 'Buyer Sales Report', 'icon-dashboard', 'Buyer Sales Report', 0, 0, '2017-01-23 00:00:00', 1),
(14, 2, 12, NULL, 'Report', 'seller_sales_report', 'Seller Sales Report', 'icon-dashboard', 'Seller Sales Report', 0, 0, '2017-01-23 00:00:00', 1),
(15, 11, 4, 'Hierarchy', NULL, 'building_expense_type_list', 'Construction Expense Type List', 'icon-dashboard', 'Construction Expense Type List', 0, 1, '2017-02-14 00:00:00', 1),
(16, 8, 4, 'Hierarchy', NULL, 'expense_type_list', 'Expense Type List', 'icon-dashboard', 'Expense Type List', 0, 1, '2017-02-14 00:00:00', 1),
(17, 4, 0, NULL, NULL, NULL, 'Account', 'icon-dashboard', 'Account', 0, 1, '2017-02-28 00:00:00', 1),
(18, 2, 17, NULL, 'Account', 'account_list', 'Building Account', 'icon-dashboard', 'Building Account', 0, 1, '2017-02-28 00:00:00', 1),
(19, 3, 17, NULL, 'Account', 'order_list', 'Order List', 'icon-dashboard', 'Order List', 0, 0, '2017-02-28 00:00:00', 1),
(20, 2, 2, NULL, 'MyAccount', NULL, 'My Account', 'icon-dashboard', 'My_Account', 0, 1, '2017-03-27 00:00:00', 1),
(21, 5, 4, 'Hierarchy', NULL, 'logo_list', 'Logo List', 'icon-dashboard', 'Logo List', 0, 0, '2017-03-31 00:00:00', 1),
(22, 1, 17, NULL, 'Account', 'seller_account_list', 'Seller Account', 'icon-dashboard', 'Seller Account', 0, 0, '2017-04-07 00:00:00', 1),
(23, 7, 8, NULL, 'Product', 'order_list', 'Add Order', 'icon-dashboard', 'Add Order', 0, 0, '2017-08-16 00:00:00', 1),
(24, 8, 8, NULL, 'Product', 'add_payment', 'Add Payment', 'icon-dashboard', 'add_payment', 0, 0, '2017-09-11 00:00:00', 1),
(25, 4, 0, NULL, NULL, NULL, 'Bank', 'icon-dashboard', 'Bank', 0, 1, '2017-09-18 00:00:00', 1),
(26, 1, 25, NULL, 'Bank', 'bank_list', 'Bank List', 'icon-dashboard', 'Bank List', 0, 1, '2017-09-18 00:00:00', 1),
(27, 2, 25, NULL, 'Bank', 'check_list', 'Cheque List', 'icon-dashboard', 'Cheque List', 0, 1, '2017-09-11 00:00:00', 1),
(28, 3, 25, NULL, 'Bank', 'buyer_check_list', 'Buyer Check List', 'icon-dashboard', 'Buyer Check List', 0, 0, '2017-09-20 00:00:00', 1),
(29, 3, 0, NULL, NULL, NULL, 'Buyer', 'icon-dashboard', 'Buyer', 0, 0, '2017-09-22 00:00:00', 1),
(30, 1, 29, NULL, 'Buyer', 'add_order', 'Add Order', 'icon-dashboard', 'Add Order', 0, 1, '2017-09-22 00:00:00', 1),
(31, 2, 29, NULL, 'Buyer', 'add_payment', 'Add Paymnet', 'icon-dashboard', 'Add Payment', 0, 1, '2017-09-22 00:00:00', 1),
(32, 3, 29, NULL, 'Buyer', 'order_list', 'Buyer Order List', 'icon-dashboard', 'Buyer Order List', 0, 1, '2017-09-22 00:00:00', 1),
(33, 4, 29, NULL, 'Buyer', 'buyer_list', 'Buyer Account List', 'icon-dashboard', 'Buyer Account List', 0, 1, '2017-09-22 00:00:00', 1),
(34, 3, 0, NULL, NULL, NULL, 'Seller', 'icon-dashboard', 'Seller', 0, 0, '2017-09-22 00:00:00', 1),
(35, 1, 34, NULL, 'Seller', 'add_order', 'Add Order', 'icon-dashboard', 'Add Order', 0, 1, NULL, 1),
(36, 2, 34, NULL, 'Seller', 'add_payment', 'Add Payment', 'icon-dashboard', 'Add Payment', 0, 1, NULL, 1),
(37, 3, 34, NULL, 'Seller', 'order_list', 'Seller Order List', 'icon-dashboard', 'Seller Order List', 0, 1, NULL, 1),
(38, 4, 34, NULL, 'Seller', 'seller_list', 'Seller Account List', 'icon-dashboard', 'Seller Account List', 0, 1, NULL, 1),
(39, 9, 4, 'Hierarchy', NULL, 'system_setting_list', 'System Setting List', 'icon-dashboard', 'System Setting List', 0, 1, '2017-09-28 00:00:00', 1),
(40, 3, 12, NULL, 'Report', 'check_list_report', 'Cheque List Report', 'icon-dashboard', 'Cheque List Report', 0, 1, '2017-09-29 00:00:00', 1),
(41, 7, 0, NULL, NULL, NULL, 'Site Order', 'icon-dashboard', 'Site Order', 0, 0, '2017-10-12 00:00:00', 1),
(42, 1, 41, NULL, 'Site', 'site_order_list', 'Site Order List', 'icon-dashboard', 'site_order_list', 0, 1, '2017-10-12 00:00:00', 1),
(43, 10, 4, 'Hierarchy', NULL, 'user_type_list', 'User Type List', 'icon-dashboard', 'User Type List', 0, 1, '2017-12-07 00:00:00', 1),
(44, 7, 0, NULL, NULL, NULL, 'General Expense', 'icon-dashboard', 'General Expense', 0, 1, '2017-12-23 00:00:00', 1),
(45, 1, 44, NULL, 'Expense', 'expense_list', 'General Expense List', 'icon-dashboard', 'General \r\nExpense List', 0, 1, '2017-12-23 00:00:00', 1),
(46, 2, 44, NULL, 'Expense', 'withdraw_list', 'With Draw List', 'icon-dashboard', 'With Draw List', 0, 0, '2017-12-23 00:00:00', 1),
(47, 1, 12, NULL, 'Report', 'expense_report', 'Expense Report', 'icon-dashboard', 'Expense Report', 0, 1, '2017-12-23 00:00:00', 1),
(48, 2, 12, NULL, 'Report', 'with_draw_report', 'With Draw Report', 'icon-dashboard', 'With Draw Report', 0, 1, '2017-12-23 00:00:00', 1),
(49, 6, 4, 'Hierarchy', NULL, 'floor_list', 'Floor List', 'icon-dashboard', 'Floor List', 0, 1, '2018-01-13 00:00:00', 1),
(50, 7, 4, 'Hierarchy', NULL, 'unit_list', 'Unit List', 'icon-dashboard', 'Unit List', 0, 1, '2018-01-13 00:00:00', 1),
(51, 5, 4, 'Hierarchy', NULL, 'project_list', 'Project List', 'icon-dashboard', 'Project List', 0, 0, '2018-01-15 00:00:00', 1),
(52, 8, 0, NULL, NULL, NULL, 'Employs  Expense', 'icon-dashboard', 'Construction Expense', 0, 1, '2018-01-17 00:00:00', 1),
(53, 1, 52, NULL, 'BuildingExpense', 'expense_list', 'Employs Expense List', 'icon-dashboard', 'Construction Expense List', 0, 1, '2018-01-17 00:00:00', 1),
(54, 3, 0, NULL, NULL, NULL, 'Weapons', 'icon-dashboard', 'Project', 0, 1, '2018-02-19 00:00:00', 1),
(55, 1, 54, NULL, 'Project', 'add_project', 'Add Weapons', 'icon-dashboard', 'Add Project', 0, 1, '2018-02-19 00:00:00', 1),
(56, 2, 54, NULL, 'Project', 'project_list', 'Weapons List', 'icon-dashboard', 'Project List', 0, 1, '2018-02-19 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_module_permission`
--

CREATE TABLE `admin_module_permission` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `permission` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_module_permission`
--

INSERT INTO `admin_module_permission` (`id`, `userid`, `usertype`, `permission`, `created_by`, `created_date`, `modify_by`, `modify_date`) VALUES
(1, 1, '1', '{\"1\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"2\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"3\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"4\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"5\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"6\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"7\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"8\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"9\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"10\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"11\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"12\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"13\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"14\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"15\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"16\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"17\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"18\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"19\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"20\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"21\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"22\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"23\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"24\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"25\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"26\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"27\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"28\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"29\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"30\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"31\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"32\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"33\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"34\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"35\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"36\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"37\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"38\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"39\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"40\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"41\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"42\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"43\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"44\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"45\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"46\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"47\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"48\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"49\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"50\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"51\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"52\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"53\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"54\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"55\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"56\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"57\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"58\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"59\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"60\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"61\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"62\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1}}', 1, '2016-11-26 00:00:00', 1, '2016-12-05 09:45:32'),
(2, 2, '2', '{\"1\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"2\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"3\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"20\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"4\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"5\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"7\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"6\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"21\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"15\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"43\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"16\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"39\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"8\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"11\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"10\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"9\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"23\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"24\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"29\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"30\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"31\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"32\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"33\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"34\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"35\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"36\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"37\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"38\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"17\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"22\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"18\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"19\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"25\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"26\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"27\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"28\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"12\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"47\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"13\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"14\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"48\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"40\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"41\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"42\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"44\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"45\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"46\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0}}', 1, '2017-04-07 09:45:23', 1, '2017-12-24 00:10:31'),
(3, 3, '2', '{\"1\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"2\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"3\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"20\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"4\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"5\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"7\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"6\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"21\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"51\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"15\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"43\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"49\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"50\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"16\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"39\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"8\":{\"a\":0,\"e\":0,\"d\":0,\"v\":1},\"11\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"10\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"9\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"23\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"24\":{\"a\":1,\"e\":1,\"d\":1,\"v\":1},\"29\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"30\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"31\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"32\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"33\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"34\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"35\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"36\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"37\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"38\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"17\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"22\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"18\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"19\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"25\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"26\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"27\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"28\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"12\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"47\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"13\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"14\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"48\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"40\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"41\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"42\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"44\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"45\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0},\"46\":{\"a\":0,\"e\":0,\"d\":0,\"v\":0}}', 1, '2018-01-17 11:48:47', 1, '2018-01-17 11:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 undefined , 1 present , 2  absent',
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `is_enable` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `status`, `staff_id`, `date`, `user_id`, `ip_address`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 1, 1, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, '2018-02-17 12:02:23', 1),
(2, 2, 2, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, '2018-02-17 12:02:26', 1),
(3, 0, 3, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(4, 0, 4, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(5, 0, 5, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(6, 0, 6, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(7, 0, 7, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(8, 0, 8, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(9, 0, 9, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(10, 0, 10, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(11, 0, 11, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(12, 0, 12, '2018-02-17', 1, '::1', 1, '2018-02-17 12:00:56', 1, NULL, NULL),
(13, 0, 1, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(14, 0, 2, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(15, 0, 3, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(16, 0, 4, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(17, 0, 5, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(18, 0, 6, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(19, 0, 7, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(20, 0, 8, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(21, 0, 9, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(22, 0, 10, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(23, 0, 11, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:41', 1, NULL, NULL),
(24, 0, 12, '2019-02-17', 1, '::1', 1, '2018-02-17 12:02:42', 1, NULL, NULL),
(25, 0, 1, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(26, 0, 2, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(27, 0, 3, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(28, 0, 4, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(29, 0, 5, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(30, 0, 6, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(31, 0, 7, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(32, 0, 8, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(33, 0, 9, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(34, 0, 10, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(35, 0, 11, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(36, 0, 12, '2019-04-17', 1, '::1', 1, '2018-02-17 12:02:48', 1, NULL, NULL),
(37, 0, 1, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:00', 1, NULL, NULL),
(38, 0, 2, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:00', 1, NULL, NULL),
(39, 0, 3, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:00', 1, NULL, NULL),
(40, 0, 4, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:00', 1, NULL, NULL),
(41, 0, 5, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:00', 1, NULL, NULL),
(42, 0, 6, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(43, 0, 7, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(44, 0, 8, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(45, 0, 9, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(46, 0, 10, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(47, 0, 11, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(48, 0, 12, '2018-02-19', 1, '::1', 1, '2018-02-19 13:17:01', 1, NULL, NULL),
(49, 0, 1, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(50, 0, 2, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(51, 0, 3, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(52, 0, 4, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(53, 0, 5, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(54, 0, 6, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(55, 0, 7, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(56, 0, 8, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:57', 1, NULL, NULL),
(57, 0, 9, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:58', 1, NULL, NULL),
(58, 0, 10, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:58', 1, NULL, NULL),
(59, 0, 11, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:58', 1, NULL, NULL),
(60, 0, 12, '2018-02-22', 1, '::1', 1, '2018-02-22 16:25:58', 1, NULL, NULL),
(61, 0, 1, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(62, 0, 2, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(63, 0, 3, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(64, 0, 4, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(65, 0, 5, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(66, 0, 6, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(67, 0, 7, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(68, 0, 8, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(69, 0, 9, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(70, 0, 10, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(71, 0, 11, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(72, 0, 12, '2021-03-05', 1, '::1', 1, '2021-03-05 00:34:51', 1, NULL, NULL),
(73, 0, 1, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(74, 0, 2, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(75, 0, 3, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(76, 0, 4, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(77, 0, 5, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(78, 0, 6, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(79, 0, 7, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(80, 0, 8, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(81, 0, 9, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:48', 1, NULL, NULL),
(82, 0, 10, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:49', 1, NULL, NULL),
(83, 0, 11, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:49', 1, NULL, NULL),
(84, 0, 12, '2021-10-04', 1, '::1', 1, '2021-10-04 00:32:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_list`
--

CREATE TABLE `bank_list` (
  `id` bigint(20) NOT NULL,
  `bank_name` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `is_enable` int(1) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `branch_list`
--

CREATE TABLE `branch_list` (
  `id` int(11) NOT NULL,
  `postal_code` varchar(200) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `branch_code` varchar(3) NOT NULL,
  `branch_name` varchar(500) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_list`
--

INSERT INTO `branch_list` (`id`, `postal_code`, `country_id`, `city_id`, `branch_code`, `branch_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '', 1, 1, '', 'Gulshan', 1, '2017-12-18 12:07:08', 1, NULL, NULL),
(2, '', 1, 1, '', 'Johar', 1, '2017-12-18 12:41:46', 1, NULL, NULL),
(3, '', 1, 1, '', 'orangi', 1, '2017-12-18 13:07:11', 1, '2017-12-18 13:07:44', 1),
(4, '', 1, 1, 'nw', 'new', 1, '2017-12-22 17:10:13', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_list`
--

CREATE TABLE `brand_list` (
  `id` int(11) NOT NULL COMMENT 'The brand ID of the brand',
  `brand_name` text COMMENT 'Name of the Brand ',
  `brand_image` varchar(255) NOT NULL COMMENT 'Image url for brand logo',
  `brand_description` text COMMENT 'Description about the brand',
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `brand_list`
--

INSERT INTO `brand_list` (`id`, `brand_name`, `brand_image`, `brand_description`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`, `deleted_id`, `deleted_date`) VALUES
(1, 'Oxford', 'brand_14871330601.jpg', '', 1, '2017-02-15 09:31:00', 1, NULL, NULL, NULL, NULL),
(2, 'Guess', 'brand_14871330771.jpg', '', 1, '2017-02-15 09:31:17', 1, NULL, NULL, NULL, NULL),
(3, 'Fashion Cafe', 'brand_14871330991.jpg', '', 1, '2017-02-15 09:31:39', 1, '2017-02-15 09:31:42', 1, NULL, NULL),
(4, 'Maybelline New York', 'brand_14871331221.jpg', '', 1, '2017-02-15 09:32:02', 1, NULL, NULL, NULL, NULL),
(5, 'Ego', 'brand_14871331451.jpg', '', 1, '2017-02-15 09:32:25', 1, NULL, NULL, NULL, NULL),
(6, 'MAC', 'brand_14871331551.jpg', '', 1, '2017-02-15 09:32:35', 1, NULL, NULL, NULL, NULL),
(7, 'ETHNIC by Outfitters', 'brand_14871331731.jpg', '', 1, '2017-02-15 09:32:53', 1, NULL, NULL, NULL, NULL),
(8, 'Lala', 'brand_14871331931.jpg', '', 1, '2017-02-15 09:33:13', 1, NULL, NULL, NULL, NULL),
(9, 'Jade', 'brand_14871332011.jpg', '', 1, '2017-02-15 09:33:21', 1, NULL, NULL, NULL, NULL),
(10, 'Unze London', 'brand_14871332161.jpg', '', 1, '2017-02-15 09:33:36', 1, NULL, NULL, NULL, NULL),
(11, 'Mardaz', 'brand_14871332301.jpg', '', 1, '2017-02-15 09:33:50', 1, NULL, NULL, NULL, NULL),
(12, 'Generation', 'brand_14871332451.jpg', '', 1, '2017-02-15 09:34:05', 1, NULL, NULL, NULL, NULL),
(13, 'Alkaram studio', 'brand_14871332591.jpg', '', 1, '2017-02-15 09:34:19', 1, NULL, NULL, NULL, NULL),
(14, 'Makeup Revolution London', 'brand_14871332711.jpg', '', 1, '2017-02-15 09:34:31', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `building_expense_list`
--

CREATE TABLE `building_expense_list` (
  `id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `exp_des` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `exp_price` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `exp_from` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `exp_type` varchar(100) DEFAULT NULL,
  `exp_date` date NOT NULL,
  `is_enable` int(1) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `building_expense_list`
--

INSERT INTO `building_expense_list` (`id`, `country_id`, `city_id`, `project_id`, `expense_type_id`, `exp_des`, `exp_price`, `exp_from`, `exp_type`, `exp_date`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 1, 1, 1, 8, 'dassafadsfwwwwwwwwwwwww', '12000', 'asad', 'building_expense', '2018-01-17', 1, '2018-01-17 15:31:03', 1, '2018-01-17 15:35:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `building_expense_type_list`
--

CREATE TABLE `building_expense_type_list` (
  `id` int(11) NOT NULL,
  `building_expense_type_name` text,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `building_expense_type_list`
--

INSERT INTO `building_expense_type_list` (`id`, `building_expense_type_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'Cement', 1, '2018-01-17 14:57:59', 1, '2018-01-17 14:58:31', 1),
(2, 'Bore Well', 1, '2018-01-17 14:58:43', 1, NULL, NULL),
(3, 'Electrical', 1, '2018-01-17 14:59:07', 1, NULL, NULL),
(4, 'Electricity', 1, '2018-01-17 14:59:21', 1, NULL, NULL),
(5, 'Extra Labour', 1, '2018-01-17 14:59:31', 1, NULL, NULL),
(6, 'Flooring', 1, '2018-01-17 14:59:39', 1, NULL, NULL),
(7, 'Interior', 1, '2018-01-17 14:59:56', 1, NULL, NULL),
(8, 'Painting', 1, '2018-01-17 15:00:05', 1, NULL, NULL),
(9, 'Plumbing', 1, '2018-01-17 15:00:16', 1, NULL, NULL),
(10, 'Sand', 1, '2018-01-17 15:00:23', 1, NULL, NULL),
(11, 'Steel', 1, '2018-01-17 15:00:30', 1, NULL, NULL),
(12, 'Water', 1, '2018-01-17 15:00:45', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_list`
--

CREATE TABLE `cart_list` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_price` varchar(200) DEFAULT NULL,
  `sell_price` varchar(200) DEFAULT NULL,
  `qty` varchar(200) DEFAULT NULL,
  `other_features` text,
  `other_charges` varchar(200) DEFAULT NULL,
  `total_price` varchar(200) DEFAULT NULL,
  `cart_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `is_enable` int(11) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_list`
--

INSERT INTO `cart_list` (`order_id`, `order_code`, `product_id`, `product_price`, `sell_price`, `qty`, `other_features`, `other_charges`, `total_price`, `cart_date`, `user_id`, `user_type`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'BUY-1-131117', 2, '16000', NULL, '5', NULL, NULL, '80000', '2017-11-13', 1, 'buyer', 1, '2017-11-13 15:09:13', 1, NULL, NULL),
(2, 'BUY-1-131117', 1, '14000', NULL, '5', NULL, NULL, '70000', '2017-11-13', 1, 'buyer', 1, '2017-11-13 15:09:13', 1, NULL, NULL),
(3, 'BUY-1-131117', 3, '7000', NULL, '5', NULL, NULL, '35000', '2017-11-13', 1, 'buyer', 1, '2017-11-13 15:09:13', 1, NULL, NULL),
(4, 'BUY-2-131117', 4, '12500', NULL, '3', NULL, NULL, '37500', '2017-11-13', 2, 'buyer', 1, '2017-11-13 15:23:52', 1, NULL, NULL),
(5, 'ORD-3-131117', 3, '7000', '7500', '3', '', '51300', '73800', '2017-11-13', 3, 'seller', 1, '2017-11-13 15:37:37', 1, NULL, NULL),
(6, 'ORD-4-131117', 3, '7000', '7500', '2', '', '4200', '19200', '2017-11-13', 4, 'seller', 1, '2017-11-13 19:49:44', 1, NULL, NULL),
(7, 'BUY-5-141117', 5, '13000', NULL, '2', NULL, NULL, '26000', '2017-11-14', 5, 'buyer', 1, '2017-11-14 20:39:14', 1, NULL, NULL),
(8, 'ORD-6-141117', 5, '13000', '12800', '2', 'LESS 2GB', '', '25600', '2017-11-14', 3, 'seller', 1, '2017-11-14 20:40:19', 1, NULL, NULL),
(9, 'ORD-6-141117', 1, '14000', '13800', '2', 'LESS 2GB', '100', '27700', '2017-11-14', 3, 'seller', 1, '2017-11-14 20:40:19', 1, NULL, NULL),
(10, 'ORD-7-161117', 1, '14000', '12700', '1', 'without hdd', '', '12700', '2017-11-16', 6, 'seller', 1, '2017-11-16 20:17:56', 1, NULL, NULL),
(11, 'ORD-8-161117', 2, '16000', '16000', '1', '', '', '16000', '2017-11-16', 4, 'seller', 1, '2017-11-16 20:21:55', 1, NULL, NULL),
(12, 'ORD-9-161117', 1, '14000', '14500', '1', '', '', '14500', '2017-11-16', 7, 'seller', 1, '2017-11-16 20:25:12', 1, NULL, NULL),
(13, 'ORD-10-171117', 1, '14000', '14500', '1', '', '', '14500', '2017-11-17', 8, 'seller', 1, '2017-11-17 21:00:37', 1, NULL, NULL),
(14, 'ORD-10-171117', 2, '16000', '16500', '1', '', '100', '16600', '2017-11-17', 8, 'seller', 1, '2017-11-17 21:00:37', 1, NULL, NULL),
(15, 'BUY-11-171117', 6, '12000', NULL, '1', NULL, NULL, '12000', '2017-11-17', 9, 'buyer', 1, '2017-11-17 21:14:49', 1, NULL, NULL),
(16, 'BUY-11-171117', 7, '11500', NULL, '1', NULL, NULL, '11500', '2017-11-17', 9, 'buyer', 1, '2017-11-17 21:14:49', 1, NULL, NULL),
(17, 'ORD-12-171117', 6, '12000', '13000', '1', '', '', '13000', '2017-11-17', 3, 'seller', 1, '2017-11-17 21:15:51', 1, NULL, NULL),
(18, 'ORD-12-171117', 7, '11500', '12000', '1', '', '100', '12100', '2017-11-17', 3, 'seller', 1, '2017-11-17 21:15:51', 1, NULL, NULL),
(19, 'BUY-13-181117', 8, '10500', NULL, '5', NULL, NULL, '52500', '2017-11-18', 10, 'buyer', 1, '2017-11-18 19:49:30', 1, NULL, NULL),
(20, 'BUY-13-181117', 5, '13500', NULL, '5', NULL, NULL, '67500', '2017-11-18', 10, 'buyer', 1, '2017-11-18 19:49:30', 1, NULL, NULL),
(21, 'ORD-14-181117', 5, '13500', '13500', '1', '', '', '13500', '2017-11-18', 11, 'seller', 1, '2017-11-18 20:20:41', 1, NULL, NULL),
(22, 'ORD-15-201117', 8, '10500', '11500', '2', 'Packing', '100', '23100', '2017-11-20', 8, 'seller', 1, '2017-11-20 18:48:12', 1, NULL, NULL),
(23, 'ORD-16-201117', 4, '12500', '14000', '1', '', '', '14000', '2017-11-20', 12, 'seller', 1, '2017-11-20 19:48:54', 1, NULL, NULL),
(24, 'ORD-16-201117', 2, '16000', '16200', '1', '', '100', '16300', '2017-11-20', 12, 'seller', 1, '2017-11-20 19:48:54', 1, NULL, NULL),
(25, 'BUY-17-201117', 1, '14000', NULL, '3', NULL, NULL, '42000', '2017-11-20', 1, 'buyer', 1, '2017-11-20 21:30:02', 1, NULL, NULL),
(26, 'BUY-18-201117', 2, '15600', NULL, '3', NULL, NULL, '46800', '2017-11-20', 13, 'buyer', 1, '2017-11-20 21:31:14', 1, NULL, NULL),
(27, 'ORD-19-211117', 4, '12500', '13700', '1', '', '', '13700', '2017-11-21', 14, 'seller', 1, '2017-11-21 17:07:20', 1, NULL, NULL),
(28, 'ORD-20-211117', 8, '10500', '12000', '1', '', '', '12000', '2017-11-21', 15, 'seller', 1, '2017-11-21 17:09:18', 1, NULL, NULL),
(29, 'ORD-21-211117', 1, '14000', '14200', '3', '', '', '42600', '2017-11-21', 16, 'seller', 1, '2017-11-21 17:16:37', 1, NULL, NULL),
(30, 'ORD-21-211117', 2, '15600', '16200', '3', '', '200', '48800', '2017-11-21', 16, 'seller', 1, '2017-11-21 17:16:37', 1, NULL, NULL),
(31, 'BUY-22-211117', 3, '8000', NULL, '2', NULL, NULL, '16000', '2017-11-21', 10, 'buyer', 1, '2017-11-21 19:03:41', 1, NULL, NULL),
(32, 'ORD-23-211117', 3, '8000', '8000', '1', '', '', '8000', '2017-11-21', 17, 'seller', 1, '2017-11-21 19:04:39', 1, NULL, NULL),
(33, 'BUY-24-211117', 1, '14000', NULL, '5', NULL, NULL, '70000', '2017-11-21', 1, 'buyer', 1, '2017-11-21 21:19:03', 1, NULL, NULL),
(34, 'ORD-25-211117', 4, '12500', '14000', '1', '', '', '14000', '2017-11-21', 8, 'seller', 1, '2017-11-21 21:24:05', 1, NULL, NULL),
(35, 'ORD-25-211117', 2, '15600', '16500', '1', '', '100', '16600', '2017-11-21', 8, 'seller', 1, '2017-11-21 21:24:05', 1, NULL, NULL),
(36, 'ORD-26-211117', 8, '10500', '11000', '2', '', '', '22000', '2017-11-21', 18, 'seller', 1, '2017-11-21 21:35:34', 1, NULL, NULL),
(37, 'ORD-26-211117', 5, '13500', '13000', '3', '', '5300', '44300', '2017-11-21', 18, 'seller', 1, '2017-11-21 21:35:34', 1, NULL, NULL),
(38, 'ORD-27-211117', 1, '14000', '14300', '3', '', '25200', '68100', '2017-11-21', 3, 'seller', 1, '2017-11-21 21:48:27', 1, NULL, NULL),
(39, 'BUY-28-211117', 10, '9700', NULL, '1', NULL, NULL, '9700', '2017-11-21', 1, 'buyer', 1, '2017-11-21 21:55:48', 1, NULL, NULL),
(40, 'ORD-29-211117', 10, '9700', '10300', '1', '', '100', '10400', '2017-11-21', 19, 'seller', 1, '2017-11-21 21:56:41', 1, NULL, NULL),
(41, 'BUY-30-241117', 11, '20000', NULL, '20', NULL, NULL, '400000', '2017-11-24', 20, 'buyer', 1, '2017-11-24 20:58:57', 1, NULL, NULL),
(42, 'ORD-31-241117', 5, '13500', '12800', '1', '', '', '12800', '2017-11-24', 18, 'seller', 1, '2017-11-24 21:55:27', 1, NULL, NULL),
(43, 'ORD-31-241117', 11, '20000', '19700', '5', '', '200', '98700', '2017-11-24', 18, 'seller', 1, '2017-11-24 21:55:27', 1, NULL, NULL),
(44, 'ORD-32-241117', 11, '20000', '21500', '3', '', '100', '64600', '2017-11-24', 21, 'seller', 1, '2017-11-24 22:03:53', 1, NULL, NULL),
(45, 'ORD-33-281117', 11, '20000', '21000', '8', '', '200', '168200', '2017-11-28', 16, 'seller', 1, '2017-11-28 17:56:25', 1, NULL, NULL),
(46, 'ORD-34-281117', 11, '20000', '21500', '2', '', '100', '43100', '2017-11-28', 8, 'seller', 1, '2017-11-28 18:55:04', 1, NULL, NULL),
(47, 'BUY-35-291117', 8, '10000', NULL, '5', NULL, NULL, '50000', '2017-11-29', 10, 'buyer', 1, '2017-11-29 16:20:56', 1, NULL, NULL),
(48, 'ORD-36-291117', 8, '10000', '12000', '1', '', '', '12000', '2017-11-29', 15, 'seller', 1, '2017-11-29 16:22:11', 1, NULL, NULL),
(49, 'ORD-36-291117', 1, '14000', '15500', '1', '', '', '15500', '2017-11-29', 15, 'seller', 1, '2017-11-29 16:22:11', 1, NULL, NULL),
(50, 'ORD-37-291117', 3, '8000', '8000', '1', '', '', '8000', '2017-11-29', 15, 'seller', 1, '2017-11-29 20:01:38', 1, NULL, NULL),
(51, 'BUY-38-291117', 3, '6500', NULL, '4', NULL, NULL, '26000', '2017-11-29', 10, 'buyer', 1, '2017-11-29 20:06:15', 1, NULL, NULL),
(52, 'BUY-38-291117', 12, '6500', NULL, '4', NULL, NULL, '26000', '2017-11-29', 10, 'buyer', 1, '2017-11-29 20:06:15', 1, NULL, NULL),
(53, 'ORD-39-291117', 12, '6500', '7500', '1', '', '', '7500', '2017-11-29', 4, 'seller', 1, '2017-11-29 20:10:10', 1, NULL, NULL),
(54, 'ORD-39-291117', 8, '10000', '11000', '1', '', '11000', '22000', '2017-11-29', 4, 'seller', 1, '2017-11-29 20:10:10', 1, NULL, NULL),
(55, 'ORD-40-291117', 12, '6500', '7200', '2', '', '', '14400', '2017-11-29', 18, 'seller', 1, '2017-11-29 21:31:23', 1, NULL, NULL),
(56, 'ORD-40-291117', 3, '6500', '7200', '1', '', '100', '7300', '2017-11-29', 18, 'seller', 1, '2017-11-29 21:31:23', 1, NULL, NULL),
(57, 'BUY-41-011217', 14, '11700', NULL, '5', NULL, NULL, '58500', '2017-12-01', 1, 'buyer', 1, '2017-12-01 03:59:38', 1, NULL, NULL),
(58, 'BUY-41-011217', 13, '6000', NULL, '15', NULL, NULL, '90000', '2017-12-01', 1, 'buyer', 1, '2017-12-01 03:59:38', 1, NULL, NULL),
(59, 'ORD-42-021217', 1, '14000', '15000', '1', '', '', '15000', '2017-12-02', 15, 'seller', 1, '2017-12-02 18:09:05', 1, NULL, NULL),
(60, 'ORD-43-021217', 2, '15600', '16000', '1', '', '', '16000', '2017-12-02', 15, 'seller', 1, '2017-12-02 18:11:33', 1, NULL, NULL),
(61, 'ORD-44-041217', 13, '6000', '6500', '2', '', '', '13000', '2017-12-04', 15, 'seller', 1, '2017-12-04 21:45:10', 1, NULL, NULL),
(62, 'ORD-45-041217', 13, '6000', '6300', '5', '', '2800', '34300', '2017-12-04', 22, 'seller', 1, '2017-12-04 21:46:29', 1, NULL, NULL),
(63, 'ORD-46-041217', 14, '11700', '12000', '2', '', '', '24000', '2017-12-04', 3, 'seller', 1, '2017-12-04 21:51:57', 1, NULL, NULL),
(64, 'ORD-46-041217', 8, '10000', '10800', '2', '', '100', '21700', '2017-12-04', 3, 'seller', 1, '2017-12-04 21:51:57', 1, NULL, NULL),
(65, 'BUY-47-051217', 16, '6200', NULL, '10', NULL, NULL, '62000', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(66, 'BUY-47-051217', 17, '6200', NULL, '10', NULL, NULL, '62000', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(67, 'BUY-47-051217', 15, '5300', NULL, '20', NULL, NULL, '106000', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(68, 'BUY-47-051217', 18, '6800', NULL, '14', NULL, NULL, '95200', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(69, 'BUY-47-051217', 23, '6800', NULL, '9', NULL, NULL, '61200', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(70, 'BUY-47-051217', 19, '4800', NULL, '5', NULL, NULL, '24000', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(71, 'BUY-47-051217', 20, '6300', NULL, '5', NULL, NULL, '31500', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(72, 'BUY-47-051217', 22, '6600', NULL, '7', NULL, NULL, '46200', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(73, 'BUY-47-051217', 21, '5000', NULL, '20', NULL, NULL, '100000', '2017-12-05', 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(74, 'ORD-48-061217', 8, '10000', '11000', '1', '', '', '11000', '2017-12-06', 24, 'seller', 1, '2017-12-06 17:11:00', 1, NULL, NULL),
(75, 'ORD-48-061217', 14, '11700', '12000', '1', '', '', '12000', '2017-12-06', 24, 'seller', 1, '2017-12-06 17:11:00', 1, NULL, NULL),
(76, 'ORD-48-061217', 13, '6000', '7000', '1', '', '', '7000', '2017-12-06', 24, 'seller', 1, '2017-12-06 17:11:00', 1, NULL, NULL),
(77, 'ORD-49-061217', 23, '6800', '13000', '1', '', '', '13000', '2017-12-06', 15, 'seller', 1, '2017-12-06 17:14:25', 1, NULL, NULL),
(78, 'ORD-50-061217', 11, '20000', '22500', '1', '', '', '22500', '2017-12-06', 14, 'seller', 1, '2017-12-06 20:37:49', 1, NULL, NULL),
(79, 'ORD-51-061217', 21, '5000', '6200', '2', '', '', '12400', '2017-12-06', 25, 'seller', 1, '2017-12-06 21:06:55', 1, NULL, NULL),
(80, 'ORD-51-061217', 17, '6200', '6200', '2', '', '', '12400', '2017-12-06', 25, 'seller', 1, '2017-12-06 21:06:55', 1, NULL, NULL),
(81, 'ORD-51-061217', 18, '6800', '7800', '1', '', '3500', '11300', '2017-12-06', 25, 'seller', 1, '2017-12-06 21:06:55', 1, NULL, NULL),
(82, 'ORD-52-061217', 15, '5300', '5800', '4', '', '2100', '25300', '2017-12-06', 26, 'seller', 1, '2017-12-06 21:16:45', 1, NULL, NULL),
(83, 'ORD-53-081217', 3, '6500', '7000', '1', '', '', '7000', '2017-12-08', 27, 'seller', 1, '2017-12-08 05:25:18', 1, NULL, NULL),
(84, 'ORD-53-081217', 17, '6200', '7000', '2', '', '1000', '15000', '2017-12-08', 27, 'seller', 1, '2017-12-08 05:25:18', 1, NULL, NULL),
(85, 'ORD-54-081217', 3, '6500', '7000', '1', '', '', '7000', '2017-12-08', 27, 'seller', 1, '2017-12-08 05:49:18', 1, NULL, NULL),
(86, 'BUY-55-081217', 3, '1200', NULL, '1', NULL, NULL, '1200', '2017-12-08', 28, 'buyer', 1, '2017-12-08 05:59:09', 1, NULL, NULL),
(87, 'BUY-56-081217', 3, '1200', NULL, '1', NULL, NULL, '1200', '2017-12-08', 29, 'buyer', 1, '2017-12-08 06:01:53', 1, NULL, NULL),
(88, 'ORD-57-081217', 3, '1200', '120', '1', 'iiio', '', '120', '2017-12-08', 30, 'seller', 1, '2017-12-08 08:10:18', 1, NULL, NULL),
(89, 'BUY-58-081217', 3, '1200', NULL, '2', NULL, NULL, '2400', '2017-12-08', 31, 'buyer', 1, '2017-12-08 08:39:27', 1, NULL, NULL),
(90, 'ORD-59-081217', 0, '', '', '1', '', '', '', '2017-12-08', 32, 'seller', 1, '2017-12-08 08:42:33', 1, NULL, NULL),
(91, 'ORD-60-081217', 0, '', '', '1', '', '', '', '2017-12-08', 33, 'seller', 1, '2017-12-08 08:42:42', 1, NULL, NULL),
(92, 'BUY-61-081217', 3, '1200', NULL, '2', NULL, NULL, '2400', '2017-12-08', 34, 'buyer', 1, '2017-12-08 08:51:18', 1, NULL, NULL),
(97, 'ORD-62-091217', 3, '1200', '1300', '2', '', '', '2600', '2017-12-09', 36, 'seller', 1, '2017-12-09 00:56:41', 1, NULL, NULL),
(98, 'ORD-62-091217', 12, '6500', '7000', '1', '', '', '7000', '2017-12-09', 36, 'seller', 1, '2017-12-09 00:56:41', 1, NULL, NULL),
(99, 'ORD-66-091217', 16, '6200', '6500', '1', '', '', '6500', '2017-12-09', 36, 'seller', 1, '2017-12-09 00:58:57', 1, NULL, NULL),
(100, 'ORD-67-091217', 3, '1200', '1300', '1', 'ss', '', '1300', '2017-12-09', 36, 'seller', 1, '2017-12-09 01:02:05', 1, NULL, NULL),
(101, 'ORD-68-091217', 3, '1200', '1300', '2', '', '', '2600', '2017-12-09', 37, 'seller', 1, '2017-12-09 01:04:26', 1, NULL, NULL),
(102, 'ORD-69-091217', 3, '1200', '1300', '2', '', '', '2600', '2017-12-09', 38, 'seller', 1, '2017-12-09 01:04:50', 1, NULL, NULL),
(103, 'ORD-70-091217', 12, '6500', '7000', '1', '', '1000', '8000', '2017-12-09', 38, 'seller', 1, '2017-12-09 01:05:57', 1, NULL, NULL),
(104, 'BUY-71-091217', 3, '1200', NULL, '50', NULL, NULL, '60000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:15:02', 1, NULL, NULL),
(105, 'BUY-72-091217', 3, '1200', NULL, '10', NULL, NULL, '12000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:17:43', 1, NULL, NULL),
(106, 'BUY-72-091217', 16, '6000', NULL, '5', NULL, NULL, '30000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:17:43', 1, NULL, NULL),
(107, 'BUY-73-091217', 3, '12000', NULL, '1', NULL, NULL, '12000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:20:10', 1, NULL, NULL),
(108, 'BUY-73-091217', 3, '14000', NULL, '2', NULL, NULL, '28000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:20:10', 1, NULL, NULL),
(109, 'BUY-74-091217', 3, '9000', NULL, '1', NULL, NULL, '9000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:22:49', 1, NULL, NULL),
(110, 'BUY-74-091217', 17, '12000', NULL, '1', NULL, NULL, '12000', '2017-12-09', 39, 'buyer', 1, '2017-12-09 01:22:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(11) NOT NULL COMMENT 'The category ID',
  `parent_category_id` varchar(65) NOT NULL DEFAULT '0' COMMENT 'This will store the parent category of the sub category. Parent category will have this field 0',
  `category_name` text NOT NULL COMMENT 'Name of the Category',
  `category_image` varchar(255) NOT NULL COMMENT 'Category Image URL',
  `sort_order` int(11) NOT NULL,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL COMMENT 'User ID of the person who will delete',
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `parent_category_id`, `category_name`, `category_image`, `sort_order`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`, `deleted_id`, `deleted_date`) VALUES
(1, '0', 'DELL', 'category_15083596961.jpg', 0, 1, '2017-10-19 01:46:28', 1, '2017-10-19 01:48:16', 1, NULL, NULL),
(2, '0', 'HP', 'category_15083597831.jpg', 0, 1, '2017-10-19 01:49:43', 1, NULL, NULL, NULL, NULL),
(3, '0', 'IBM LENOVO', 'category_15083598411.jpg', 0, 1, '2017-10-19 01:50:41', 1, '2017-10-19 01:52:05', 1, NULL, NULL),
(4, '0', 'Gateway', 'category_15083599021.jpg', 0, 1, '2017-10-19 01:51:42', 1, NULL, NULL, NULL, NULL),
(5, '0', 'TOSHIBA', 'category_15083600291.jpg', 0, 1, '2017-10-19 01:53:49', 1, NULL, NULL, NULL, NULL),
(6, '0', '', 'category_15083601001.jpg', 0, 1, '2017-10-19 01:55:00', 1, '2017-12-20 14:50:13', 1, NULL, NULL),
(7, '0', 'SONY VIO', 'category_15083601881.jpg', 0, 1, '2017-10-19 01:56:28', 1, NULL, NULL, NULL, NULL),
(8, '0', 'Asus', 'category_15083602631.jpg', 0, 1, '2017-10-19 01:57:43', 1, NULL, NULL, NULL, NULL),
(9, '0', 'APPLE', 'category_15083603871.jpg', 0, 1, '2017-10-19 01:59:47', 1, NULL, NULL, NULL, NULL),
(10, '0', 'FUJITSU', 'category_15083604281.jpg', 0, 1, '2017-10-19 02:00:28', 1, NULL, NULL, NULL, NULL),
(11, '0', 'SAMSUNG', 'category_15083605031.jpg', 0, 1, '2017-10-19 02:01:43', 1, NULL, NULL, NULL, NULL),
(12, '0', 'BRANDED LAPTOP BAGS', 'category_15083608851.jpg', 0, 1, '2017-10-19 02:08:05', 1, NULL, NULL, NULL, NULL),
(13, '0', 'LAPTOPS ORIGINAL CHARGERS', 'category_15083609801.jpg', 0, 1, '2017-10-19 02:09:40', 1, NULL, NULL, NULL, NULL),
(14, '0', 'LAPTOP ACCESSORIES', 'category_15083611281.jpg', 0, 1, '2017-10-19 02:12:08', 1, NULL, NULL, NULL, NULL),
(15, '0', 'BOX PACK LAPTOPS', 'category_15083615761.jpg', 0, 1, '2017-10-19 02:19:36', 1, '2017-10-19 03:25:13', 1, NULL, NULL),
(16, '1', 'CORE TO DUE', '', 0, 1, '2017-10-19 02:22:14', 1, NULL, NULL, NULL, NULL),
(17, '1', 'AMD VISION QUAD CORE', '', 0, 1, '2017-10-19 02:22:48', 1, NULL, NULL, NULL, NULL),
(18, '1', 'CORE I3 FIRST GENERATION', '', 0, 1, '2017-10-19 02:23:19', 1, NULL, NULL, NULL, NULL),
(19, '1', 'CORE I3 SECOND GENERATION', '', 0, 1, '2017-10-19 02:23:42', 1, NULL, NULL, NULL, NULL),
(20, '1', 'CORE I3 THIRD GENERATION', '', 0, 1, '2017-10-19 02:24:10', 1, NULL, NULL, NULL, NULL),
(21, '1', 'CORE I3 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:24:35', 1, NULL, NULL, NULL, NULL),
(22, '1', 'CORE I3 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:24:56', 1, NULL, NULL, NULL, NULL),
(23, '1', 'CORE I3 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:25:29', 1, NULL, NULL, NULL, NULL),
(24, '1', 'CORE I3 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:25:48', 1, NULL, NULL, NULL, NULL),
(25, '2', 'CORE TO DUE', '', 0, 1, '2017-10-19 02:26:16', 1, NULL, NULL, NULL, NULL),
(26, '2', 'CORE I3 FIRST GENERATION', '', 0, 1, '2017-10-19 02:26:32', 1, NULL, NULL, NULL, NULL),
(27, '2', 'CORE I3 SECOND GENERATION', '', 0, 1, '2017-10-19 02:26:59', 1, NULL, NULL, NULL, NULL),
(28, '2', 'CORE I3 THIRD GENERATION', '', 0, 1, '2017-10-19 02:27:36', 1, NULL, NULL, NULL, NULL),
(29, '2', 'CORE I3 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:28:01', 1, NULL, NULL, NULL, NULL),
(30, '2', 'CORE I3 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:28:20', 1, NULL, NULL, NULL, NULL),
(31, '2', 'CORE I3 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:28:53', 1, '2017-10-19 02:29:31', 1, NULL, NULL),
(32, '2', 'CORE I3 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:30:03', 1, NULL, NULL, NULL, NULL),
(33, '1', 'CORE I5 FIRST GENERATION', '', 0, 1, '2017-10-19 02:30:31', 1, NULL, NULL, NULL, NULL),
(34, '1', 'CORE I5 SECOND GENERATION', '', 0, 1, '2017-10-19 02:31:01', 1, NULL, NULL, NULL, NULL),
(35, '1', 'CORE I5 THIRD GENERATION', '', 0, 1, '2017-10-19 02:31:33', 1, NULL, NULL, NULL, NULL),
(36, '1', 'CORE I5 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:32:23', 1, NULL, NULL, NULL, NULL),
(37, '1', 'CORE I5 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:32:41', 1, NULL, NULL, NULL, NULL),
(38, '1', 'CORE I5 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:33:01', 1, NULL, NULL, NULL, NULL),
(39, '1', 'CORE I5 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:33:19', 1, NULL, NULL, NULL, NULL),
(40, '1', 'CORE I7 FIRST GENERATION', '', 0, 1, '2017-10-19 02:33:45', 1, NULL, NULL, NULL, NULL),
(41, '1', 'CORE I7 SECOND GENERATION', '', 0, 1, '2017-10-19 02:34:11', 1, NULL, NULL, NULL, NULL),
(42, '1', 'CORE I7 THIRD GENERATION', '', 0, 1, '2017-10-19 02:35:21', 1, NULL, NULL, NULL, NULL),
(43, '1', 'CORE I7 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:35:46', 1, NULL, NULL, NULL, NULL),
(44, '1', 'CORE I7 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:36:05', 1, NULL, NULL, NULL, NULL),
(45, '1', 'CORE I7 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:36:38', 1, NULL, NULL, NULL, NULL),
(46, '1', 'CORE I7 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:37:00', 1, NULL, NULL, NULL, NULL),
(47, '2', 'AMD VISION QUAD CORE', '', 0, 1, '2017-10-19 02:38:04', 1, NULL, NULL, NULL, NULL),
(48, '1', 'AMD', '', 0, 1, '2017-10-19 02:38:23', 1, NULL, NULL, NULL, NULL),
(49, '2', 'AMD', '', 0, 1, '2017-10-19 02:38:36', 1, NULL, NULL, NULL, NULL),
(50, '2', 'CORE I5 FIRST GENERATION', '', 0, 1, '2017-10-19 02:39:16', 1, NULL, NULL, NULL, NULL),
(51, '2', 'CORE I5 SECOND GENERATION', '', 0, 1, '2017-10-19 02:39:32', 1, NULL, NULL, NULL, NULL),
(52, '2', 'CORE I5 THIRD GENERATION', '', 0, 1, '2017-10-19 02:39:52', 1, NULL, NULL, NULL, NULL),
(53, '2', 'CORE I5 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:40:08', 1, NULL, NULL, NULL, NULL),
(54, '2', 'CORE I5 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:40:25', 1, NULL, NULL, NULL, NULL),
(55, '2', 'CORE I5 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:40:43', 1, NULL, NULL, NULL, NULL),
(56, '2', 'CORE I5 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:40:58', 1, NULL, NULL, NULL, NULL),
(57, '2', 'CORE I7 FIRST GENERATION', '', 0, 1, '2017-10-19 02:41:55', 1, NULL, NULL, NULL, NULL),
(58, '2', 'CORE I7 SECOND GENERATION', '', 0, 1, '2017-10-19 02:42:08', 1, NULL, NULL, NULL, NULL),
(59, '2', 'CORE I7 THIRD GENERATION', '', 0, 1, '2017-10-19 02:42:24', 1, NULL, NULL, NULL, NULL),
(60, '2', 'CORE I7 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:42:39', 1, NULL, NULL, NULL, NULL),
(61, '2', 'CORE I7 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:42:53', 1, NULL, NULL, NULL, NULL),
(62, '2', 'CORE I7 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:43:12', 1, NULL, NULL, NULL, NULL),
(63, '2', 'CORE I7 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:43:29', 1, NULL, NULL, NULL, NULL),
(64, '3', 'CORE TO DUE', '', 0, 1, '2017-10-19 02:44:23', 1, NULL, NULL, NULL, NULL),
(65, '3', 'CORE I3 FIRST GENERATION', '', 0, 1, '2017-10-19 02:44:49', 1, NULL, NULL, NULL, NULL),
(66, '3', 'CORE I3 SECOND GENERATION', '', 0, 1, '2017-10-19 02:45:05', 1, '2017-10-19 02:46:25', 1, NULL, NULL),
(67, '3', 'CORE I3 THIRD GENERATION', '', 0, 1, '2017-10-19 02:45:19', 1, '2017-10-19 02:46:46', 1, NULL, NULL),
(68, '3', 'CORE I3 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:45:32', 1, '2017-10-19 02:47:08', 1, NULL, NULL),
(69, '3', 'CORE I3 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:45:46', 1, NULL, NULL, NULL, NULL),
(70, '3', 'CORE I3 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:47:39', 1, NULL, NULL, NULL, NULL),
(71, '3', 'CORE I3 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:48:03', 1, NULL, NULL, NULL, NULL),
(72, '3', 'CORE I5 FIRST GENERATION', '', 0, 1, '2017-10-19 02:48:34', 1, NULL, NULL, NULL, NULL),
(73, '3', 'CORE I5 SECOND GENERATION', '', 0, 1, '2017-10-19 02:48:52', 1, NULL, NULL, NULL, NULL),
(74, '3', 'CORE I5 THIRD GENERATION', '', 0, 1, '2017-10-19 02:49:11', 1, NULL, NULL, NULL, NULL),
(75, '3', 'CORE I5 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:49:27', 1, NULL, NULL, NULL, NULL),
(76, '3', 'CORE I5 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:49:44', 1, NULL, NULL, NULL, NULL),
(77, '3', 'AMD VISION QUAD CORE', '', 0, 1, '2017-10-19 02:49:58', 1, '2017-10-19 02:51:50', 1, NULL, NULL),
(78, '3', 'CORE I5 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:50:16', 1, NULL, NULL, NULL, NULL),
(79, '3', 'CORE I5 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:50:33', 1, NULL, NULL, NULL, NULL),
(80, '3', 'CORE I7 FIRST GENERATION', '', 0, 1, '2017-10-19 02:53:07', 1, NULL, NULL, NULL, NULL),
(81, '3', 'CORE I7 SECOND GENERATION', '', 0, 1, '2017-10-19 02:53:25', 1, NULL, NULL, NULL, NULL),
(82, '3', 'CORE I7 THIRD GENERATION', '', 0, 1, '2017-10-19 02:53:48', 1, NULL, NULL, NULL, NULL),
(83, '3', 'CORE I7 FOURTH GENERATION', '', 0, 1, '2017-10-19 02:54:04', 1, NULL, NULL, NULL, NULL),
(84, '3', 'CORE I7 FIFTH GENERATION', '', 0, 1, '2017-10-19 02:54:22', 1, NULL, NULL, NULL, NULL),
(85, '3', 'CORE I7 SIXTH GENERATION', '', 0, 1, '2017-10-19 02:55:28', 1, NULL, NULL, NULL, NULL),
(86, '3', 'CORE I7 SEVENTH GENERATION', '', 0, 1, '2017-10-19 02:55:45', 1, NULL, NULL, NULL, NULL),
(87, '12', 'MIX BAGS', '', 0, 1, '2017-10-19 02:57:42', 1, NULL, NULL, NULL, NULL),
(88, '13', 'DELL', 'sub_category_15083639911.jpg', 0, 1, '2017-10-19 02:59:51', 1, '2017-10-19 03:05:24', 1, NULL, NULL),
(89, '13', 'HP', 'sub_category_15083640741.jpg', 0, 1, '2017-10-19 03:01:14', 1, NULL, NULL, NULL, NULL),
(90, '13', 'ALL BRANDS ORIGINAL CHARGERS', 'sub_category_15083641481.jpg', 0, 1, '2017-10-19 03:02:28', 1, NULL, NULL, NULL, NULL),
(91, '14', 'ALL TYPES OF ACCESSORIES', 'sub_category_15083642021.jpg', 0, 1, '2017-10-19 03:03:22', 1, NULL, NULL, NULL, NULL),
(92, '15', 'CORE I3 FOURTH GENERATION', '', 0, 1, '2017-10-19 03:09:29', 1, NULL, NULL, NULL, NULL),
(93, '15', 'CORE I3 FIFTH GENERATION', '', 0, 1, '2017-10-19 03:09:46', 1, NULL, NULL, NULL, NULL),
(94, '15', 'CORE I3 SIXTH GENERATION', '', 0, 1, '2017-10-19 03:10:06', 1, NULL, NULL, NULL, NULL),
(95, '15', 'CORE I3 SEVENTH GENERATION', '', 0, 1, '2017-10-19 03:10:28', 1, NULL, NULL, NULL, NULL),
(96, '15', 'CORE I5 FIFTH GENERATION', '', 0, 1, '2017-10-19 03:10:48', 1, NULL, NULL, NULL, NULL),
(97, '15', 'CORE I5 SEVENTH GENERATION', '', 0, 1, '2017-10-19 03:11:07', 1, '2017-10-19 03:12:20', 1, NULL, NULL),
(98, '15', 'CORE I5 SIXTH GENERATION', '', 0, 1, '2017-10-19 03:11:35', 1, NULL, NULL, NULL, NULL),
(99, '15', 'CORE I7 FIFTH GENERATION', '', 0, 1, '2017-10-19 03:12:56', 1, NULL, NULL, NULL, NULL),
(100, '15', 'CORE I7 SIXTH GENERATION', '', 0, 1, '2017-10-19 03:13:12', 1, NULL, NULL, NULL, NULL),
(101, '15', 'CORE I7 SEVENTH GENERATION', '', 0, 1, '2017-10-19 03:13:31', 1, NULL, NULL, NULL, NULL),
(102, '4', 'CORE TO DUE', '', 0, 1, '2017-10-19 03:15:20', 1, NULL, NULL, NULL, NULL),
(103, '4', 'AMD VISION QUAD CORE', '', 0, 1, '2017-10-19 03:15:41', 1, NULL, NULL, NULL, NULL),
(104, '4', 'AMD', '', 0, 1, '2017-10-19 03:15:53', 1, NULL, NULL, NULL, NULL),
(105, '4', 'CORE I3 FIRST GENERATION', '', 0, 1, '2017-10-19 03:16:15', 1, NULL, NULL, NULL, NULL),
(106, '4', 'CORE I3 SECOND GENERATION', '', 0, 1, '2017-10-19 03:16:32', 1, NULL, NULL, NULL, NULL),
(107, '4', 'CORE I3 THIRD GENERATION', '', 0, 1, '2017-10-19 03:16:49', 1, NULL, NULL, NULL, NULL),
(108, '4', 'CORE I5 FIRST GENERATION', '', 0, 1, '2017-10-19 03:17:12', 1, NULL, NULL, NULL, NULL),
(109, '4', 'CORE I5 SECOND GENERATION', '', 0, 1, '2017-10-19 03:17:29', 1, NULL, NULL, NULL, NULL),
(110, '4', 'CORE I5 THIRD GENERATION', '', 0, 1, '2017-10-19 03:17:46', 1, NULL, NULL, NULL, NULL),
(111, '4', 'CORE I7 FIRST GENERATION', '', 0, 1, '2017-10-19 03:18:33', 1, NULL, NULL, NULL, NULL),
(112, '5', 'CORE TO DUE', '', 0, 1, '2017-10-19 03:27:26', 1, NULL, NULL, NULL, NULL),
(113, '5', 'CORE I3 FIRST GENERATION', '', 0, 1, '2017-10-19 03:27:45', 1, NULL, NULL, NULL, NULL),
(114, '5', 'CORE I3 SECOND GENERATION', '', 0, 1, '2017-10-19 03:28:06', 1, NULL, NULL, NULL, NULL),
(115, '5', 'CORE I3 THIRD GENERATION', '', 0, 1, '2017-10-19 03:28:25', 1, NULL, NULL, NULL, NULL),
(116, '5', 'CORE I5 FIRST GENERATION', '', 0, 1, '2017-10-19 03:28:40', 1, NULL, NULL, NULL, NULL),
(117, '5', 'CORE I5 SECOND GENERATION', '', 0, 1, '2017-10-19 03:28:55', 1, NULL, NULL, NULL, NULL),
(118, '5', 'CORE I5 THIRD GENERATION', '', 0, 1, '2017-10-19 03:29:12', 1, '2017-10-19 03:29:49', 1, NULL, NULL),
(119, '5', 'CORE I7 FIRST GENERATION', '', 0, 1, '2017-10-19 03:30:13', 1, NULL, NULL, NULL, NULL),
(120, '5', 'CORE I7 SECOND GENERATION', '', 0, 1, '2017-10-19 03:30:28', 1, NULL, NULL, NULL, NULL),
(121, '5', 'CORE I7 THIRD GENERATION', '', 0, 1, '2017-10-19 03:30:44', 1, NULL, NULL, NULL, NULL),
(122, '6', 'CORE TO DUE', '', 0, 1, '2017-10-19 03:31:34', 1, NULL, NULL, NULL, NULL),
(123, '6', 'CORE I3 FIRST GENERATION', '', 0, 1, '2017-10-19 03:31:56', 1, NULL, NULL, NULL, NULL),
(124, '2', 'AMD A6', '', 0, 1, '2017-11-13 15:16:35', 1, NULL, NULL, NULL, NULL),
(125, '11', 'CORE I3 SECOND GENERATION', '', 0, 1, '2017-11-17 21:11:38', 1, NULL, NULL, NULL, NULL),
(126, '3', 'Atom', '', 0, 1, '2017-12-01 03:49:10', 1, NULL, NULL, NULL, NULL),
(127, '8', 'CORE TO DUE', '', 0, 1, '2017-12-05 20:35:55', 1, NULL, NULL, NULL, NULL),
(128, '0', 'Acer', '', 0, 0, '2017-12-20 14:47:59', 1, NULL, NULL, NULL, NULL),
(129, '0', '', '', 0, 0, '2017-12-20 14:50:20', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `check_list`
--

CREATE TABLE `check_list` (
  `id` bigint(20) NOT NULL,
  `check_type` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `check_amount` varchar(500) NOT NULL,
  `check_no` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `bank` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `branch` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `branch_code` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `check_date` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `check_clear_date` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `check_status` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `is_enable` int(1) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_code` varchar(200) NOT NULL,
  `city_name` varchar(500) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `country_id`, `city_code`, `city_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 1, '', 'karachi', 1, '2017-12-18 11:20:47', 1, NULL, NULL),
(2, 1, '', 'lahore', 0, '2017-12-18 11:22:03', 1, NULL, NULL),
(3, 2, '', 'india12', 1, '2017-12-18 11:22:24', 1, '2017-12-18 12:05:47', 1),
(4, 0, '', '', 0, '2017-12-21 14:21:02', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_payment_list`
--

CREATE TABLE `client_payment_list` (
  `id` int(20) NOT NULL,
  `payment_code` varchar(100) NOT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `paid` varchar(200) DEFAULT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `check_no` varchar(30) DEFAULT NULL,
  `check_image` varchar(200) DEFAULT NULL,
  `check_bank_name` varchar(200) DEFAULT NULL,
  `check_branch_name` varchar(200) DEFAULT NULL,
  `check_status` varchar(200) NOT NULL DEFAULT '0' COMMENT '0 pending,1 clear',
  `pay_no` varchar(200) DEFAULT NULL,
  `pay_image` varchar(200) DEFAULT NULL,
  `pay_bank_name` varchar(200) DEFAULT NULL,
  `pay_branch_name` varchar(200) DEFAULT NULL,
  `pay_status` varchar(200) DEFAULT '0' COMMENT '0 pending,1 clear',
  `online_account_from` varchar(200) DEFAULT NULL,
  `online_bank_from` varchar(200) DEFAULT NULL,
  `online_branch_from` varchar(200) DEFAULT NULL,
  `online_account_to` varchar(200) DEFAULT NULL,
  `online_bank_to` varchar(200) DEFAULT NULL,
  `online_branch_to` varchar(200) DEFAULT NULL,
  `client_personal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'regular',
  `description` varchar(500) DEFAULT NULL,
  `remarks` text,
  `payment_date` varchar(200) DEFAULT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_payment_list`
--

INSERT INTO `client_payment_list` (`id`, `payment_code`, `discount`, `paid`, `payment_type`, `check_no`, `check_image`, `check_bank_name`, `check_branch_name`, `check_status`, `pay_no`, `pay_image`, `pay_bank_name`, `pay_branch_name`, `pay_status`, `online_account_from`, `online_bank_from`, `online_branch_from`, `online_account_to`, `online_bank_to`, `online_branch_to`, `client_personal_id`, `user_id`, `branch_id`, `payment_status`, `description`, `remarks`, `payment_date`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'RCPT-1-221217', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, 'regular', NULL, NULL, NULL, 1, '2017-12-22 18:58:29', 2, NULL, NULL),
(2, 'RCPT-2-231217', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, 'regular', NULL, NULL, NULL, 1, '2017-12-23 10:53:33', 2, NULL, NULL),
(3, 'RCPT-3-231217', '0', '2000', 'check', '123', 'check_15140240112.jpg', 'hbl', 'gulshan', '0', NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, 'remaining paid', 'Booking', 'booking amount,.', '2017-12-24', 1, '2017-12-23 15:13:31', 2, NULL, NULL),
(4, 'RCPT-4-231217', '0', '2000', 'cash', NULL, '', NULL, NULL, '0', NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 2, 'remaining paid', 'Confirmation', 'GOOD', '2017-12-25', 1, '2017-12-23 18:46:28', 2, NULL, NULL),
(5, 'RCPT-5-231217', '0', '1000', 'online', NULL, '', NULL, NULL, '0', NULL, '', NULL, NULL, '0', 'a', 'hbl', 'gulshan', 'aa', 'ubl', 'johar', 1, 2, 2, 'remaining paid', 'Installment', 'asdfas', '2017-12-23', 1, '2017-12-23 19:33:59', 2, NULL, NULL),
(6, 'RCPT-6-050321', '', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 2, 'regular', NULL, NULL, NULL, 1, '2021-03-05 00:31:07', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_personal_list`
--

CREATE TABLE `client_personal_list` (
  `id` int(20) NOT NULL,
  `file_no` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `so_name` varchar(200) NOT NULL,
  `postal_address` text NOT NULL,
  `contact1` varchar(200) NOT NULL,
  `contact2` varchar(200) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_personal_list`
--

INSERT INTO `client_personal_list` (`id`, `file_no`, `name`, `so_name`, `postal_address`, `contact1`, `contact2`, `email`, `user_id`, `branch_id`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '1001', 'khan jamal', 'junaid', 'karachi', '0900', '0800', 'khan@gmail.com', 2, 2, 1, '2017-12-22 18:58:29', 2, '2017-12-23 10:53:33', 2),
(2, '1001', 'Ali', 'Ahmed', 'Karachi, Pakistan', '03131234567', '03131234567', 'ali@gmail.com', 1, 2, 1, '2021-03-05 00:31:07', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_record_list`
--

CREATE TABLE `client_record_list` (
  `id` int(20) NOT NULL,
  `client_code` varchar(100) NOT NULL,
  `cottage_no` varchar(200) DEFAULT NULL,
  `floor` varchar(200) DEFAULT NULL,
  `co` varchar(200) DEFAULT NULL,
  `cnic` varchar(200) DEFAULT NULL,
  `nomine` varchar(200) DEFAULT NULL,
  `relation` varchar(200) DEFAULT NULL,
  `nomine_address` text,
  `cash` varchar(200) NOT NULL,
  `loan` varchar(200) DEFAULT NULL,
  `discount` varchar(200) DEFAULT NULL,
  `total_cost` varchar(200) NOT NULL,
  `documentation` varchar(200) NOT NULL,
  `schedule_date` varchar(200) DEFAULT NULL,
  `schedule_amount` varchar(200) DEFAULT NULL,
  `mydate` varchar(200) NOT NULL,
  `client_personal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_record_list`
--

INSERT INTO `client_record_list` (`id`, `client_code`, `cottage_no`, `floor`, `co`, `cnic`, `nomine`, `relation`, `nomine_address`, `cash`, `loan`, `discount`, `total_cost`, `documentation`, `schedule_date`, `schedule_amount`, `mydate`, `client_personal_id`, `user_id`, `branch_id`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'CLT-1-221217', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '1000', '1000', '0', '4000', '2000', '2017-12-23', '500', '2017-12-22', 1, 2, 2, 1, '2017-12-22 18:58:29', 2, NULL, NULL),
(2, 'CLT-2-231217', 'a', 'aa', 'aaa', 'b', 'bb', 'bbb', 'bbbb', '1000', '1000', '0', '3000', '1000', '2017-12-31', '500', '2017-12-23', 1, 2, 2, 1, '2017-12-23 10:53:33', 2, NULL, NULL),
(3, 'CLT-3-050321', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2021-03-05', 2, 1, 2, 1, '2021-03-05 00:31:07', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_list`
--

CREATE TABLE `country_list` (
  `id` int(11) NOT NULL,
  `country_code` varchar(200) NOT NULL,
  `country_name` varchar(500) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_list`
--

INSERT INTO `country_list` (`id`, `country_code`, `country_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '', 'Pakistan', 1, '2017-12-18 11:18:43', 1, '2017-12-18 11:19:13', 1),
(2, '', 'China', 1, '2017-12-18 11:19:26', 1, '2021-03-05 00:35:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense_list`
--

CREATE TABLE `expense_list` (
  `id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `exp_des` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `exp_price` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `exp_from` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `exp_type` varchar(100) DEFAULT NULL,
  `exp_date` date NOT NULL,
  `is_enable` int(1) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `expense_list`
--

INSERT INTO `expense_list` (`id`, `country_id`, `city_id`, `expense_type_id`, `exp_des`, `exp_price`, `exp_from`, `exp_type`, `exp_date`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 1, 1, 1, 'lunch asdfasdf', '100', 'asad', 'expense', '2017-12-23', 1, '2017-12-23 23:50:34', 1, '2018-01-17 15:31:48', 1),
(2, 1, 1, 2, 'AA', '200', 'jamal', 'expense', '2017-12-24', 1, '2017-12-24 00:18:11', 2, NULL, NULL),
(3, 1, 1, 3, 'adsfasdfasdf', '12000', 'khan', 'expense', '2018-01-17', 1, '2018-01-17 15:45:53', 1, NULL, NULL),
(4, 1, 1, 1, 'asdfasdf', '2', '222', 'expense', '2018-02-02', 1, '2018-02-02 15:19:29', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_type_list`
--

CREATE TABLE `expense_type_list` (
  `id` int(11) NOT NULL,
  `expense_type_name` text,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `expense_type_list`
--

INSERT INTO `expense_type_list` (`id`, `expense_type_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`, `deleted_id`, `deleted_date`) VALUES
(1, 'lunch', 1, '2017-12-23 23:36:49', 1, '2017-12-23 23:37:13', 1, NULL, NULL),
(2, 'tea', 1, '2017-12-23 23:37:08', 1, NULL, NULL, NULL, NULL),
(3, 'dinner', 1, '2017-12-23 23:37:20', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_record_list`
--

CREATE TABLE `file_record_list` (
  `id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `detail` varchar(500) DEFAULT NULL,
  `create_date` varchar(200) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_record_list`
--

INSERT INTO `file_record_list` (`id`, `client_id`, `user_id`, `detail`, `create_date`, `image_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 1, 2, 'asdfgasd', '2017-12-23', 'file_15140395152.jpg', 1, '2017-12-23 19:31:55', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `floor_list`
--

CREATE TABLE `floor_list` (
  `id` int(11) NOT NULL,
  `floor_no` varchar(100) DEFAULT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor_list`
--

INSERT INTO `floor_list` (`id`, `floor_no`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '1st', 1, '2018-01-13 17:47:47', 1, NULL, NULL),
(2, '2nd', 1, '2018-01-13 17:48:54', 1, '2018-01-13 17:49:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `payment_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enable` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `staff_id`, `title`, `description`, `amount`, `creation_timestamp`, `payment_timestamp`, `payment_method`, `payment_details`, `status`, `user_id`, `ip_address`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 6, 'dasfasd1', 'asdfasf1', 10001, 1551294000, '', '', '', 'unpaid', 1, '::1', 1, '2018-02-17 12:05:27', 1, '2018-02-17 15:07:19', 1),
(2, 1, 'dfasf', 'asdfasf', 33, 1518721200, '', '', '', 'paid', 1, '::1', 1, '2018-02-17 12:09:34', 1, NULL, NULL),
(3, 1, 'asdfasdf', 'asdfa', 0, 1518807600, '', '', '', 'paid', 1, '::1', 1, '2018-02-17 12:16:16', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `phrase_id` int(11) NOT NULL,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bengali` longtext COLLATE utf8_unicode_ci NOT NULL,
  `spanish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `arabic` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dutch` longtext COLLATE utf8_unicode_ci NOT NULL,
  `russian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `chinese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `turkish` longtext COLLATE utf8_unicode_ci NOT NULL,
  `portuguese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hungarian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `french` longtext COLLATE utf8_unicode_ci NOT NULL,
  `greek` longtext COLLATE utf8_unicode_ci NOT NULL,
  `german` longtext COLLATE utf8_unicode_ci NOT NULL,
  `italian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `thai` longtext COLLATE utf8_unicode_ci NOT NULL,
  `urdu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hindi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `latin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `indonesian` longtext COLLATE utf8_unicode_ci NOT NULL,
  `japanese` longtext COLLATE utf8_unicode_ci NOT NULL,
  `korean` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(1, 'login', 'login', 'লগইন', 'login', 'دخول', 'login', 'Войти', '注册', 'giriş', 'login', 'bejelentkezés', 'Connexion', 'σύνδεση', 'Login', 'login', 'เข้าสู่ระบบ', 'لاگ ان', 'लॉगिन', 'login', 'login', 'ログイン', '로그인'),
(2, 'account_type', 'account type', 'অ্যাকাউন্ট টাইপ', 'tipo de cuenta', 'نوع الحساب', 'type account', 'тип счета', '账户类型', 'hesap türü', 'tipo de conta', 'fiók típusát', 'Type de compte', 'τον τύπο του λογαριασμού', 'Kontotyp', 'tipo di account', 'ประเภทบัญชี', 'اکاؤنٹ کی قسم', 'खाता प्रकार', 'propter speciem', 'Jenis akun', '口座の種類', '계정 유형'),
(3, 'admin', 'admin', 'অ্যাডমিন', 'administración', 'مشرف', 'admin', 'админ', '管理', 'yönetim', 'administrador', 'admin', 'administrateur', 'το admin', 'Admin', 'Admin', 'ผู้ดูแลระบบ', 'منتظم', 'प्रशासन', 'Lorem ipsum dolor sit', 'admin', '管理者', '관리자'),
(4, 'teacher', 'teacher', 'শিক্ষক', 'profesor', 'معلم', 'leraar', 'учитель', '老师', 'öğretmen', 'professor', 'tanár', 'professeur', 'δάσκαλος', 'Lehrer', 'insegnante', 'ครู', 'استاد', 'शिक्षक', 'Magister', 'guru', '教師', '선생'),
(5, 'student', 'student', 'ছাত্র', 'estudiante', 'طالب', 'student', 'студент', '学生', 'öğrenci', 'estudante', 'diák', 'étudiant', 'φοιτητής', 'Schüler', 'studente', 'นักเรียน', 'طالب علم', 'छात्र', 'discipulo', 'mahasiswa', '学生', '학생'),
(6, 'parent', 'parent', 'পিতা বা মাতা', 'padre', 'أصل', 'ouder', 'родитель', '亲', 'ebeveyn', 'parente', 'szülő', 'mère', 'μητρική εταιρεία', 'Elternteil', 'genitore', 'ผู้ปกครอง', 'والدین', 'माता - पिता', 'parente', 'induk', '親', '부모의'),
(7, 'email', 'email', 'ইমেইল', 'email', 'البريد الإلكتروني', 'e-mail', 'по электронной почте', '电子邮件', 'E-posta', 'e-mail', 'E-mail', 'email', 'e-mail', 'E-Mail-', 'e-mail', 'อีเมล์', 'ای میل', 'ईमेल', 'email', 'email', 'メール', '이메일'),
(8, 'password', 'password', 'পাসওয়ার্ড', 'contraseña', 'كلمة السر', 'wachtwoord', 'пароль', '密码', 'şifre', 'senha', 'jelszó', 'mot de passe', 'τον κωδικό', 'Passwort', 'password', 'รหัสผ่าน', 'پاس', 'पासवर्ड', 'Signum', 'kata sandi', 'パスワード', '암호'),
(9, 'forgot_password ?', 'forgot password ?', 'পাসওয়ার্ড ভুলে গেছেন?', '¿Olvidó su contraseña?', 'نسيت كلمة المرور؟', 'wachtwoord vergeten?', 'забыли пароль?', '忘记密码？', 'Şifremi unuttum?', 'Esqueceu a senha?', 'Elfelejtett jelszó?', 'Mot de passe oublié?', 'Ξεχάσατε τον κωδικό;', 'Passwort vergessen?', 'dimenticato la password?', 'ลืมรหัสผ่าน', 'پاس ورڈ بھول گیا؟', 'क्या संभावनाएं हैं?', 'oblitus esne verbi?', 'lupa password?', 'パスワードを忘れた？', '비밀번호를 잊으 셨나요?'),
(10, 'reset_password', 'reset password', 'পাসওয়ার্ড রিসেট', 'restablecer la contraseña', 'إعادة تعيين كلمة المرور', 'reset wachtwoord', 'сбросить пароль', '重设密码', 'şifrenizi sıfırlamak', 'redefinir a senha', 'Jelszó visszaállítása', 'réinitialiser le mot de passe', 'επαναφέρετε τον κωδικό πρόσβασης', 'Kennwort zurücksetzen', 'reimpostare la password', 'ตั้งค่ารหัสผ่าน', 'پاس ورڈ ری سیٹ', 'पासवर्ड रीसेट', 'Duis adipiscing', 'reset password', 'パスワードを再設定する', '암호를 재설정'),
(11, 'reset', 'reset', 'রিসেট করুন', 'reajustar', 'إعادة تعيين', 'reset', 'сброс', '重置', 'ayarlamak', 'restabelecer', 'vissza', 'remettre', 'επαναφορά', 'rücksetzen', 'reset', 'ตั้งใหม่', 'ری سیٹ', 'रीसेट करें', 'Duis', 'ulang', 'リセット', '재설정'),
(12, 'admin_dashboard', 'admin dashboard', 'অ্যাডমিন ড্যাশবোর্ড', 'administrador salpicadero', 'المشرف وحة القيادة', 'admin dashboard', 'админ панель', '管理面板', 'Admin paneli', 'Admin Dashboard', 'admin műszerfal', 'administrateur tableau de bord', 'πίνακα ελέγχου του διαχειριστή', 'Admin-Dashboard', 'Admin Dashboard', 'แผงควบคุมของผู้ดูแลระบบ', 'ایڈمن ڈیش بورڈ', 'व्यवस्थापक डैशबोर्ड', 'Lorem ipsum dolor sit Dashboard', 'admin dashboard', '管理ダッシュボード', '관리자 대시 보드'),
(13, 'account', 'account', 'হিসাব', 'cuenta', 'حساب', 'rekening', 'счет', '帐户', 'hesap', 'conta', 'számla', 'compte', 'λογαριασμός', 'Konto', 'conto', 'บัญชี', 'اکاؤنٹ', 'खाता', 'propter', 'rekening', 'アカウント', '계정'),
(14, 'profile', 'profile', 'পরিলেখ', 'perfil', 'ملف', 'profiel', 'профиль', '轮廓', 'profil', 'perfil', 'profil', 'profil', 'προφίλ', 'Profil', 'profilo', 'โปรไฟล์', 'پروفائل', 'रूपरेखा', 'profile', 'profil', 'プロフィール', '프로필'),
(15, 'change_password', 'change password', 'পাসওয়ার্ড পরিবর্তন', 'cambiar la contraseña', 'تغيير كلمة المرور', 'wachtwoord wijzigen', 'изменить пароль', '更改密码', 'şifresini değiştirmek', 'alterar a senha', 'jelszó megváltoztatása', 'changer le mot de passe', 'αλλάξετε τον κωδικό πρόσβασης', 'Kennwort ändern', 'cambiare la password', 'เปลี่ยนรหัสผ่าน', 'پاس ورڈ تبدیل', 'पासवर्ड परिवर्तित', 'mutare password', 'mengubah password', 'パスワードを変更する', '암호를 변경'),
(16, 'logout', 'logout', 'লগ আউট', 'logout', 'تسجيل الخروج', 'logout', 'выход', '注销', 'logout', 'Sair', 'logout', 'Déconnexion', 'αποσύνδεση', 'logout', 'Esci', 'ออกจากระบบ', 'لاگ آؤٹ کریں', 'लॉगआउट', 'logout', 'logout', 'ログアウト', '로그 아웃'),
(17, 'panel', 'panel', 'প্যানেল', 'panel', 'لوحة', 'paneel', 'панель', '面板', 'panel', 'painel', 'bizottság', 'panneau', 'πίνακας', 'Platte', 'pannello', 'แผงหน้าปัด', 'پینل', 'पैनल', 'panel', 'panel', 'パネル', '패널'),
(18, 'dashboard_help', 'dashboard help', 'ড্যাশবোর্ড সহায়তা', 'salpicadero ayuda', 'لوحة القيادة مساعدة', 'dashboard hulp', 'Приборная панель помощь', '仪表板帮助', 'pano yardım', 'dashboard ajuda', 'műszerfal help', 'tableau de bord aide', 'ταμπλό βοήθεια', 'Dashboard-Hilfe', 'dashboard aiuto', 'แผงควบคุมความช่วยเหลือ', 'ڈیش بورڈ مدد', 'डैशबोर्ड मदद', 'Dashboard auxilium', 'dashboard bantuan', 'ダッシュボードヘルプ', '대시 보드 도움말'),
(19, 'dashboard', 'dashboard', 'ড্যাশবোর্ড', 'salpicadero', 'لوحة القيادة', 'dashboard', 'приборная панель', '仪表盘', 'gösterge paneli', 'painel de instrumentos', 'műszerfal', 'tableau de bord', 'ταμπλό', 'Armaturenbrett', 'cruscotto', 'หน้าปัด', 'ڈیش بورڈ', 'डैशबोर्ड', 'Dashboard', 'dasbor', 'ダッシュボード', '계기판'),
(20, 'student_help', 'student help', 'শিক্ষার্থীর সাহায্য', 'ayuda estudiantil', 'مساعدة الطالب', 'student hulp', 'студент помощь', '学生的帮助', 'Öğrenci yardım', 'ajuda estudante', 'diák segítségével', 'aide aux étudiants', 'φοιτητής βοήθεια', 'Schüler-Hilfe', 'help studente', 'ช่วยเหลือนักเรียน', 'طالب علم کی مدد', 'छात्र मदद', 'Discipulus auxilium', 'membantu siswa', '学生のヘルプ', '학생 도움말'),
(21, 'teacher_help', 'teacher help', 'শিক্ষক সাহায্য', 'ayuda del maestro', 'مساعدة المعلم', 'leraar hulp', 'Учитель помощь', '老师的帮助', 'öğretmen yardım', 'ajuda de professores', 'tanár segítségével', 'aide de l\'enseignant', 'βοήθεια των εκπαιδευτικών', 'Lehrer-Hilfe', 'aiuto dell\'insegnante', 'ครูช่วยเหลือ', 'استاد کی مدد', 'शिक्षक मदद', 'doctor auxilium', 'bantuan guru', '教師のヘルプ', '교사의 도움'),
(22, 'subject_help', 'subject help', 'বিষয় সাহায্য', 'ayuda sujeto', 'مساعدة الموضوع', 'Onderwerp hulp', 'Заголовок помощь', '主题帮助', 'konusu yardım', 'ajuda assunto', 'tárgy segítségével', 'l\'objet de l\'aide', 'υπόκεινται βοήθεια', 'Thema Hilfe', 'Aiuto Subject', 'ความช่วยเหลือเรื่อง', 'موضوع مدد', 'विषय मदद', 'agitur salus', 'bantuan subjek', '件名ヘルプ', '주제 도움'),
(23, 'subject', 'subject', 'বিষয়', 'sujeto', 'موضوع', 'onderwerp', 'тема', '主题', 'konu', 'assunto', 'tárgy', 'sujet', 'θέμα', 'Thema', 'soggetto', 'เรื่อง', 'موضوع', 'विषय', 'agitur', 'subyek', 'テーマ', '제목'),
(24, 'class_help', 'class help', 'বর্গ সাহায্য', 'clase de ayuda', 'الطبقة مساعدة', 'klasse hulp', 'Класс помощь', '类的帮助', 'sınıf yardım', 'classe ajuda', 'osztály segítségével', 'aide de la classe', 'Κατηγορία βοήθεια', 'Klasse Hilfe', 'help classe', 'ความช่วยเหลือในชั้นเรียน', 'کلاس مدد', 'कक्षा मदद', 'genus auxilii', 'kelas bantuan', 'クラスのヘルプ', '클래스 도움'),
(25, 'class', 'class', 'বর্গ', 'clase', 'فئة', 'klasse', 'класс', '类', 'sınıf', 'classe', 'osztály', 'classe', 'κατηγορία', 'Klasse', 'classe', 'ชั้น', 'کلاس', 'वर्ग', 'class', 'kelas', 'クラス', '클래스'),
(26, 'exam_help', 'exam help', 'পরীক্ষায় সাহায্য', 'ayuda examen', 'امتحان مساعدة', 'examen hulp', 'Экзамен помощь', '考试帮助', 'sınav yardım', 'exame ajuda', 'vizsga help', 'aide à l\'examen', 'εξετάσεις βοήθεια', 'Prüfung Hilfe', 'esame di guida', 'การสอบความช่วยเหลือ', 'امتحان مدد', 'परीक्षा मदद', 'ipsum Auxilium', 'ujian bantuan', '試験ヘルプ', '시험에 도움'),
(27, 'exam', 'exam', 'পরীক্ষা', 'examen', 'امتحان', 'tentamen', 'экзамен', '考试', 'sınav', 'exame', 'vizsgálat', 'exam', 'εξέταση', 'Prüfung', 'esame', 'การสอบ', 'امتحان', 'परीक्षा', 'Lorem ipsum', 'ujian', '試験', '시험'),
(28, 'marks_help', 'marks help', 'চিহ্ন সাহায্য', 'marcas ayudan', 'علامات مساعدة', 'markeringen helpen', 'метки помогают', '标记帮助', 'işaretleri yardım', 'marcas ajudar', 'jelek segítenek', 'marques aident', 'σήματα βοηθήσει', 'Markierungen helfen', 'segni aiutano', 'เครื่องหมายช่วย', 'نمبر مدد', 'निशान मदद', 'notas auxilio', 'tanda membantu', 'マークのヘルプ', '마크는 데 도움이'),
(29, 'marks-attendance', 'marks-attendance', 'চিহ্ন-উপস্থিতির', 'marcas-asistencia', 'علامات-الحضور', 'merken-deelname', 'знаки-посещаемости', '标记缺席', 'işaretleri-katılım', 'marcas de comparecimento', 'jelek-ellátás', 'marques-participation', 'σήματα προσέλευση', 'Marken-Teilnahme', 'marchi-presenze', 'เครื่องหมายการเข้าร่วม', 'نمبر حاضری', 'निशान उपस्थिति', 'signa eius ministrabant,', 'tanda-pertemuan', 'マーク·出席', '마크 출석'),
(30, 'grade_help', 'grade help', 'গ্রেড সাহায্য', 'ayuda de grado', 'مساعدة الصف', 'leerjaar hulp', 'оценка помощь', '级帮助', 'sınıf yardım', 'ajuda grau', 'fokozat help', 'aide de qualité', 'βαθμού βοήθεια', 'Grade-Hilfe', 'aiuto grade', 'ช่วยเหลือเกรด', 'گریڈ مدد', 'ग्रेड मदद', 'gradus ope', 'kelas bantuan', 'グレードのヘルプ', '급 도움'),
(31, 'exam-grade', 'exam-grade', 'পরীক্ষার শ্রেণী', 'examen de grado', 'امتحان الصف', 'examen-grade', 'экзамен класса', '考试级别', 'sınav notu', 'exame de grau', 'vizsga-grade', 'examen de qualité', 'εξετάσεις ποιότητας', 'Prüfung-Grade', 'esami-grade', 'สอบเกรด', 'امتحان گریڈ', 'परीक्षा ग्रेड', 'ipsum turpis,', 'ujian-grade', '試験グレード', '시험 등급'),
(32, 'class_routine_help', 'class routine help', 'ক্লাসের রুটিন সাহায্য', 'clase ayuda rutina', 'الطبقة مساعدة روتينية', 'klasroutine hulp', 'класс рутина помощь', '类常规帮助', 'sınıf rutin yardım', 'classe ajuda rotina', 'osztály rutin segít', 'classe aide routine', 'κατηγορία ρουτίνας βοήθεια', 'Klasse Routine Hilfe', 'Classe aiuto di routine', 'ระดับความช่วยเหลือตามปกติ', 'کلاس معمول مدد', 'वर्ग दिनचर्या मदद', 'uno genere auxilium', 'kelas bantuan rutin', 'クラスルーチンのヘルプ', '클래스 루틴 도움'),
(33, 'class_routine', 'class routine', 'ক্লাসের রুটিন', 'rutina de la clase', 'فئة الروتينية', 'klasroutine', 'класс подпрограмм', '常规类', 'sınıf rutin', 'rotina classe', 'osztály rutin', 'routine de classe', 'Κατηγορία ρουτίνα', 'Klasse Routine', 'classe di routine', 'ประจำชั้น', 'کلاس معمول', 'वर्ग दिनचर्या', 'in genere uno,', 'rutin kelas', 'クラス·ルーチン', '클래스 루틴'),
(34, 'invoice_help', 'invoice help', 'চালান সাহায্য', 'ayuda factura', 'مساعدة الفاتورة', 'factuur hulp', 'счет-фактура помощь', '发票帮助', 'fatura yardım', 'ajuda factura', 'számla segítségével', 'aide facture', 'τιμολόγιο βοήθεια', 'Rechnungs Hilfe', 'help fattura', 'ช่วยเหลือใบแจ้งหนี้', 'انوائس مدد', 'चालान सहायता', 'auxilium cautionem', 'bantuan faktur', '送り状ヘルプ', '송장 도움'),
(35, 'payment', 'payment', 'প্রদান', 'pago', 'دفع', 'betaling', 'оплата', '付款', 'ödeme', 'pagamento', 'fizetés', 'paiement', 'πληρωμή', 'Zahlung', 'pagamento', 'การชำระเงิน', 'ادائیگی', 'भुगतान', 'pecunia', 'pembayaran', '支払い', '지불'),
(36, 'book_help', 'book help', 'বইয়ের সাহায্য', 'libro de ayuda', 'كتاب المساعدة', 'boek hulp', 'Книга помощь', '本书帮助', 'kitap yardımı', 'livro ajuda', 'könyv segít', 'livre aide', 'βοήθεια του βιβλίου', 'Buch-Hilfe', 'della guida', 'ช่วยเหลือหนังสือ', 'کتاب مدد', 'पुस्तक मदद', 'auxilium libro,', 'Buku bantuan', 'ブックのヘルプ', '책 도움말'),
(37, 'library', 'library', 'লাইব্রেরি', 'biblioteca', 'مكتبة', 'bibliotheek', 'библиотека', '文库', 'kütüphane', 'biblioteca', 'könyvtár', 'bibliothèque', 'βιβλιοθήκη', 'Bibliothek', 'biblioteca', 'ห้องสมุด', 'لائبریری', 'पुस्तकालय', 'library', 'perpustakaan', '図書館', '도서관'),
(38, 'transport_help', 'transport help', 'যানবাহনের সাহায্য', 'ayuda de transporte', 'مساعدة النقل', 'vervoer help', 'транспорт помощь', '运输帮助', 'ulaşım yardım', 'ajuda de transporte', 'szállítás Súgó', 'le transport de l\'aide', 'βοηθούν τη μεταφορά', 'Transport Hilfe', 'help trasporti', 'ช่วยเหลือการขนส่ง', 'نقل و حمل مدد', 'परिवहन मदद', 'auxilium onerariis', 'transportasi bantuan', '輸送のヘルプ', '전송 도움'),
(39, 'transport', 'transport', 'পরিবহন', 'transporte', 'نقل', 'vervoer', 'транспорт', '运输', 'taşıma', 'transporte', 'szállítás', 'transport', 'μεταφορά', 'Transport', 'trasporto', 'การขนส่ง', 'نقل و حمل', 'परिवहन', 'onerariis', 'angkutan', '輸送', '수송'),
(40, 'dormitory_help', 'dormitory help', 'আস্তানা সাহায্য', 'dormitorio de ayuda', 'عنبر المساعدة', 'slaapzaal hulp', 'общежитие помощь', '宿舍帮助', 'yatakhane yardım', 'dormitório ajuda', 'kollégiumi help', 'dortoir aide', 'κοιτώνα βοήθεια', 'Wohnheim Hilfe', 'dormitorio aiuto', 'หอพักช่วยเหลือ', 'شیناگار مدد', 'छात्रावास मदद', 'dormitorium auxilium', 'asrama bantuan', '寮のヘルプ', '기숙사 도움말'),
(41, 'dormitory', 'dormitory', 'শ্রমিক - আস্তানা', 'dormitorio', 'المهجع', 'slaapzaal', 'спальня', '宿舍', 'yatakhane', 'dormitório', 'hálóterem', 'dortoir', 'κοιτώνα', 'Wohnheim', 'dormitorio', 'หอพัก', 'شیناگار', 'छात्रावास', 'dormitorium', 'asrama mahasiswa', '寮', '기숙사'),
(42, 'noticeboard_help', 'noticeboard help', 'নোটিশবোর্ড সাহায্য', 'tablón de anuncios de la ayuda', 'اللافتة مساعدة', 'prikbord hulp', 'доска для объявлений помощь', '布告帮助', 'noticeboard yardım', 'avisos ajuda', 'üzenőfalán help', 'panneau d\'aide', 'ανακοινώσεων βοήθεια', 'Brett-Hilfe', 'bacheca aiuto', 'ป้ายประกาศความช่วยเหลือ', 'noticeboard مدد', 'Noticeboard मदद', 'auxilium noticeboard', 'pengumuman bantuan', '伝言板のヘルプ', '의 noticeboard 도움말'),
(43, 'noticeboard-event', 'noticeboard-event', 'নোটিশবোর্ড-ইভেন্ট', 'tablón de anuncios de eventos', 'اللافتة الحدث', 'prikbord-event', 'доска для объявлений-событие', '布告牌事件', 'noticeboard olay', 'avisos de eventos', 'üzenőfalán esemény', 'panneau d\'événement', 'ανακοινώσεων εκδήλωση', 'Brett-Ereignis', 'bacheca-evento', 'ป้ายประกาศของเหตุการณ์', 'noticeboard ایونٹ', 'Noticeboard घटना', 'noticeboard eventus,', 'pengumuman-acara', '伝言板イベント', '의 noticeboard 이벤트'),
(44, 'bed_ward_help', 'bed ward help', 'বিছানা ওয়ার্ড সাহায্য', 'cama ward ayuda', 'جناح سرير المساعدة', 'bed ward hulp', 'кровать подопечный помощь', '床病房的帮助', 'yatak koğuş yardım', 'ajuda cama enfermaria', 'ágy Ward help', 'lit salle de l\'aide', 'κρεβάτι πτέρυγα βοήθεια', 'Betten-Station Hilfe', 'Letto reparto aiuto', 'วอร์ดเตียงช่วยเหลือ', 'بستر وارڈ مدد', 'बिस्तर वार्ड मदद', 'lectum stans auxilium', 'tidur bangsal bantuan', 'ベッド病棟のヘルプ', '침대 병동 도움'),
(45, 'settings', 'settings', 'সেটিংস', 'configuración', 'إعدادات', 'instellingen', 'настройки', '设置', 'ayarları', 'definições', 'beállítások', 'paramètres', 'Ρυθμίσεις', 'Einstellungen', 'Impostazioni', 'การตั้งค่า', 'ترتیبات', 'सेटिंग्स', 'occasus', 'Pengaturan', '設定', '설정'),
(46, 'system_settings', 'system settings', 'সিস্টেম সেটিংস', 'configuración del sistema', 'إعدادات النظام', 'systeeminstellingen', 'настройки системы', '系统设置', 'sistem ayarları', 'configurações do sistema', 'rendszerbeállításokat', 'les paramètres du système', 'ρυθμίσεις του συστήματος', 'Systemeinstellungen', 'impostazioni di sistema', 'การตั้งค่าระบบ', 'نظام کی ترتیبات', 'प्रणाली सेटिंग्स', 'ratio occasus', 'pengaturan sistem', 'システム設定', '시스템 설정'),
(47, 'manage_language', 'manage language', 'ভাষা ও পরিচালনা', 'gestionar idioma', 'إدارة اللغة', 'beheren taal', 'управлять язык', '管理语言', 'dil yönetmek', 'gerenciar língua', 'kezelni nyelv', 'gérer langue', 'διαχείριση γλώσσα', 'verwalten Sprache', 'gestire lingua', 'จัดการภาษา', 'زبان کا انتظام', 'भाषा का प्रबंधन', 'moderari linguam,', 'mengelola bahasa', '言語を管理', '언어를 관리'),
(48, 'backup_restore', 'backup restore', 'ব্যাকআপ পুনঃস্থাপন', 'copia de seguridad a restaurar', 'استعادة النسخ الاحتياطي', 'backup terugzetten', 'восстановить резервного копирования', '备份还原', 'yedekleme geri', 'de backup restaurar', 'Backup Restore', 'restauration de sauvegarde', 'επαναφοράς αντιγράφων ασφαλείας', 'Backup wiederherstellen', 'ripristino di backup', 'การสำรองข้อมูลเรียกคืน', 'بیک اپ بحال', 'बैकअप बहाल', 'tergum restituunt', 'backup restore', 'バックアップは、リストア', '백업 복원'),
(49, 'profile_help', 'profile help', 'সাহায্য প্রোফাইল', 'Perfil Ayuda', 'ملف المساعدة', 'profile hulp', 'анкета помощь', '简介帮助', 'yardım profile', 'Perfil ajuda', 'profile help', 'profil aide', 'προφίλ βοήθεια', 'Profil Hilfe', 'profilo di aiuto', 'โปรไฟล์ความช่วยเหลือ', 'مدد پروفائل', 'प्रोफाइल में', 'Auctor nullam opem', 'Profil bantuan', 'プロフィールヘルプ', '도움 프로필'),
(50, 'manage_student', 'manage student', 'শিক্ষার্থী ও পরিচালনা', 'gestionar estudiante', 'إدارة الطلبة', 'beheren student', 'управлять студента', '管理学生', 'öğrenci yönetmek', 'gerenciar estudante', 'kezelni diák', 'gérer étudiant', 'διαχείριση των φοιτητών', 'Schüler verwalten', 'gestire studente', 'การจัดการศึกษา', 'طالب علم کا انتظام', 'छात्र का प्रबंधन', 'curo alumnorum', 'mengelola siswa', '生徒を管理', '학생 관리'),
(51, 'manage_teacher', 'manage teacher', 'শিক্ষক ও পরিচালনা', 'gestionar maestro', 'إدارة المعلم', 'beheren leraar', 'управлять учителя', '管理老师', 'öğretmen yönetmek', 'gerenciar professor', 'kezelni tanár', 'gérer enseignant', 'διαχείριση των εκπαιδευτικών', 'Lehrer verwalten', 'gestire insegnante', 'จัดการครู', 'ٹیچر کا انتظام', 'शिक्षक का प्रबंधन', 'magister curo', 'mengelola guru', '教師を管理', '교사 관리'),
(52, 'noticeboard', 'noticeboard', 'নোটিশবোর্ড', 'tablón de anuncios', 'اللافتة', 'prikbord', 'доска для объявлений', '布告', 'noticeboard', 'quadro de avisos', 'üzenőfalán', 'panneau d\'affichage', 'ανακοινώσεων', 'Brett', 'bacheca', 'ป้ายประกาศ', 'noticeboard', 'Noticeboard', 'noticeboard', 'pengumuman', '伝言板', '의 noticeboard'),
(53, 'language', 'language', 'ভাষা', 'idioma', 'لغة', 'taal', 'язык', '语', 'dil', 'língua', 'nyelv', 'langue', 'γλώσσα', 'Sprache', 'lingua', 'ภาษา', 'زبان', 'भाषा', 'Lingua', 'bahasa', '言語', '언어'),
(54, 'backup', 'backup', 'ব্যাকআপ', 'reserva', 'دعم', 'reservekopie', 'резервный', '备用', 'yedek', 'backup', 'mentés', 'sauvegarde', 'εφεδρικός', 'Sicherungskopie', 'di riserva', 'การสำรองข้อมูล', 'بیک اپ', 'बैकअप', 'tergum', 'backup', 'バックアップ', '지원'),
(55, 'calendar_schedule', 'calendar schedule', 'ক্যালেন্ডার সময়সূচী', 'horario de calendario', 'الجدول الزمني', 'kalender schema', 'Календарь Расписание', '日历日程', 'takvim programı', 'agenda calendário', 'naptári ütemezés', 'calendrier calendrier', 'χρονοδιαγράμματος του ημερολογίου', 'Kalender Zeitplan', 'programma di calendario', 'ปฏิทินตารางนัดหมาย', 'کیلنڈر شیڈول', 'कैलेंडर अनुसूची', 'kalendarium ipsum', 'jadwal kalender', 'カレンダーのスケジュール', '캘린더 일정'),
(56, 'select_a_class', 'select a class', 'একটি শ্রেণী নির্বাচন', 'seleccionar una clase', 'حدد فئة', 'selecteer een class', 'выберите класс', '选择一个类', 'bir sınıf seçin', 'selecionar uma classe', 'válasszon ki egy osztályt', 'sélectionner une classe', 'επιλέξτε μια κατηγορία', 'Wählen Sie eine Klasse', 'selezionare una classe', 'เลือกชั้น', 'ایک کلاس منتخب کریں', 'एक वर्ग का चयन करें', 'eligere genus', 'pilih kelas', 'クラスを選択', '클래스를 선택'),
(57, 'student_list', 'student list', 'শিক্ষার্থীর তালিকা', 'lista de alumnos', 'قائمة الطلاب', 'student lijst', 'Список студент', '学生名单', 'öğrenci listesi', 'lista de alunos', 'diák lista', 'liste des étudiants', 'κατάλογο των φοιτητών', 'Schülerliste', 'elenco degli studenti', 'รายชื่อนักเรียน', 'طالب علم کی فہرست', 'छात्र सूची', 'Discipulus album', 'daftar mahasiswa', '学生のリスト', '학생 목록'),
(58, 'add_student', 'add student', 'ছাত্র যোগ', 'añadir estudiante', 'إضافة طالب', 'voeg student', 'добавить студента', '新增学生', 'öğrenci eklemek', 'adicionar estudante', 'hozzá hallgató', 'ajouter étudiant', 'προσθέστε φοιτητής', 'Student hinzufügen', 'aggiungere studente', 'เพิ่มนักเรียน', 'طالب علم شامل', 'छात्र जोड़', 'adde elit', 'menambahkan mahasiswa', '学生を追加', '학생을 추가'),
(59, 'roll', 'roll', 'রোল', 'rollo', 'لفة', 'broodje', 'рулон', '滚', 'rulo', 'rolo', 'tekercs', 'rouleau', 'ρολό', 'Rolle', 'rotolo', 'ม้วน', 'رول', 'रोल', 'volumen', 'gulungan', 'ロール', '롤'),
(60, 'photo', 'photo', 'ছবি', 'foto', 'صور', 'foto', 'фото', '照片', 'fotoğraf', 'foto', 'fénykép', 'photo', 'φωτογραφία', 'Foto', 'foto', 'ภาพถ่าย', 'تصویر', 'फ़ोटो', 'Lorem ipsum', 'foto', '写真', '사진'),
(61, 'student_name', 'student name', 'শিক্ষার্থীর নাম', 'Nombre del estudiante', 'اسم الطالب', 'naam van de leerling', 'Имя студента', '学生姓名', 'Öğrenci adı', 'nome do aluno', 'tanuló nevét', 'nom de l\'étudiant', 'το όνομα του μαθητή', 'Studentennamen', 'nome dello studente', 'ชื่อนักเรียน', 'طالب علم کے نام', 'छात्र का नाम', 'ipsum est nomen', 'nama siswa', '学生の名前', '학생의 이름'),
(62, 'address', 'address', 'ঠিকানা', 'dirección', 'عنوان', 'adres', 'адрес', '地址', 'adres', 'endereço', 'cím', 'adresse', 'διεύθυνση', 'Adresse', 'indirizzo', 'ที่อยู่', 'ایڈریس', 'पता', 'Oratio', 'alamat', 'アドレス', '주소'),
(63, 'options', 'options', 'অপশন', 'Opciones', 'خيارات', 'opties', 'опции', '选项', 'seçenekleri', 'opções', 'lehetőségek', 'les options', 'Επιλογές', 'Optionen', 'Opzioni', 'ตัวเลือก', 'اختیارات', 'विकल्प', 'options', 'Pilihan', 'オプション', '옵션'),
(64, 'marksheet', 'marksheet', 'marksheet', 'marksheet', 'marksheet', 'Marksheet', 'marksheet', 'marksheet', 'Marksheet', 'marksheet', 'Marksheet', 'relevé de notes', 'Marksheet', 'marksheet', 'Marksheet', 'marksheet', 'marksheet', 'अंकपत्र', 'marksheet', 'marksheet', 'marksheet', 'marksheet'),
(65, 'id_card', 'id card', 'আইডি কার্ড', 'carnet de identidad', 'بطاقة الهوية', 'id-kaart', 'удостоверение личности', '身份证', 'kimlik kartı', 'carteira de identidade', 'személyi igazolvány', 'carte d\'identité', 'id κάρτα', 'Ausweis', 'carta d\'identità', 'บัตรประชาชน', 'شناختی کارڈ', 'औ डी कार्ड', 'id ipsum', 'id card', 'IDカード', '신분증'),
(66, 'edit', 'edit', 'সম্পাদন করা', 'editar', 'تحرير', 'uitgeven', 'редактировать', '编辑', 'düzenleme', 'editar', 'szerkeszt', 'modifier', 'edit', 'bearbeiten', 'modifica', 'แก้ไข', 'میں ترمیم کریں', 'संपादित करें', 'edit', 'mengedit', '編集', '편집'),
(67, 'delete', 'delete', 'মুছে ফেলা', 'borrar', 'حذف', 'verwijderen', 'удалять', '删除', 'silmek', 'excluir', 'töröl', 'effacer', 'διαγραφή', 'löschen', 'cancellare', 'ลบ', 'خارج', 'हटाना', 'vel deleri,', 'menghapus', '削除する', '삭제'),
(68, 'personal_profile', 'personal profile', 'ব্যক্তিগত প্রোফাইল', 'perfil personal', 'ملف شخصي', 'persoonlijk profiel', 'личный профиль', '个人简介', 'kişisel profil', 'perfil pessoal', 'személyes profil', 'profil personnel', 'προσωπικό προφίλ', 'persönliches Profil', 'profilo personale', 'รายละเอียดข้อมูลส่วนตัว', 'ذاتی پروفائل', 'व्यक्तिगत प्रोफाइल', 'personal profile', 'profil pribadi', '人物点描', '개인 프로필'),
(69, 'academic_result', 'academic result', 'একাডেমিক ফলাফল', 'resultado académico', 'نتيجة الأكاديمية', 'academische resultaat', 'академический результат', '学术成果', 'akademik sonuç', 'resultado acadêmico', 'tudományos eredmény', 'résultat académique', 'ακαδημαϊκή αποτέλεσμα', 'Studienergebnis', 'risultato accademico', 'ผลการศึกษา', 'تعلیمی نتیجہ', 'शैक्षिक परिणाम', 'Ex academicis', 'Hasil akademik', '学術結果', '학습 결​​과'),
(70, 'name', 'name', 'নাম', 'nombre', 'اسم', 'naam', 'название', '名称', 'isim', 'nome', 'név', 'nom', 'όνομα', 'Name', 'nome', 'ชื่อ', 'نام', 'नाम', 'nomen,', 'nama', '名前', '이름'),
(71, 'birthday', 'birthday', 'জন্মদিন', 'cumpleaños', 'عيد ميلاد', 'verjaardag', 'день рождения', '生日', 'doğum günü', 'aniversário', 'születésnap', 'anniversaire', 'γενέθλια', 'Geburtstag', 'compleanno', 'วันเกิด', 'سالگرہ', 'जन्मदिन', 'natalis', 'ulang tahun', '誕生日', '생일'),
(72, 'sex', 'sex', 'লিঙ্গ', 'sexo', 'جنس', 'seks', 'секс', '性别', 'seks', 'sexo', 'szex', 'sexe', 'φύλο', 'Sex', 'sesso', 'เพศ', 'جنسی', 'लिंग', 'sex', 'seks', 'セックス', '섹스'),
(73, 'male', 'male', 'পুরুষ', 'masculino', 'ذكر', 'mannelijk', 'мужской', '男性', 'erkek', 'masculino', 'férfi', 'mâle', 'αρσενικός', 'männlich', 'maschio', 'เพศชาย', 'پروفائل', 'नर', 'masculus', 'laki-laki', '男性', '남성'),
(74, 'female', 'female', 'মহিলা', 'femenino', 'أنثى', 'vrouw', 'женский', '女', 'kadın', 'feminino', 'női', 'femelle', 'θηλυκός', 'weiblich', 'femminile', 'เพศหญิง', 'خواتین', 'महिला', 'femina,', 'perempuan', '女性', '여성'),
(75, 'religion', 'religion', 'ধর্ম', 'religión', 'دين', 'religie', 'религия', '宗教', 'din', 'religião', 'vallás', 'religion', 'θρησκεία', 'Religion', 'religione', 'ศาสนา', 'مذہب', 'धर्म', 'religionis,', 'agama', '宗教', '종교'),
(76, 'blood_group', 'blood group', 'রক্তের বিভাগ', 'grupo sanguíneo', 'فصيلة الدم', 'bloedgroep', 'группа крови', '血型', 'kan grubu', 'grupo sanguíneo', 'vércsoport', 'groupe sanguin', 'ομάδα αίματος', 'Blutgruppe', 'gruppo sanguigno', 'กรุ๊ปเลือด', 'خون کے گروپ', 'रक्त वर्ग', 'sanguine coetus', 'golongan darah', '血液型', '혈액형'),
(77, 'phone', 'phone', 'ফোন', 'teléfono', 'هاتف', 'telefoon', 'телефон', '电话', 'telefon', 'telefone', 'telefon', 'téléphone', 'τηλέφωνο', 'Telefon', 'telefono', 'โทรศัพท์', 'فون', 'फ़ोन', 'Praesent', 'telepon', '電話', '전화'),
(78, 'father_name', 'father name', 'পিতার নাম', 'Nombre del padre', 'اسم الأب', 'naam van de vader', 'отчество', '父亲姓名', 'baba adı', 'nome pai', 'apa név', 'nom de père', 'Το όνομα του πατέρα', 'Der Name des Vaters', 'nome del padre', 'ชื่อพ่อ', 'والد کا نام', 'पिता का नाम', 'nomine Patris,', 'Nama ayah', '父親の名前', '아버지의 이름'),
(79, 'mother_name', 'mother name', 'মায়ের নাম', 'Nombre de la madre', 'اسم الأم', 'moeder naam', 'Имя матери', '母亲的名字', 'anne adı', 'Nome mãe', 'anyja név', 'nom de la mère', 'το όνομα της μητέρας', 'Name der Mutter', 'Nome madre', 'ชื่อแม่', 'ماں کا نام', 'माता का नाम', 'matris nomen,', 'Nama ibu', '母の名前', '어머니 이름'),
(80, 'edit_student', 'edit student', 'সম্পাদনা ছাত্র', 'edit estudiante', 'تحرير الطالب', 'bewerk student', 'редактирования студент', '编辑学生', 'edit öğrenci', 'edição aluno', 'szerkesztés diák', 'modifier étudiant', 'επεξεργασία των φοιτητών', 'Schüler bearbeiten', 'modifica dello studente', 'แก้ไขนักเรียน', 'ترمیم کے طالب علم', 'संपादित छात्र', 'edit studiosum', 'mengedit siswa', '編集学生', '편집 학생'),
(81, 'teacher_list', 'teacher list', 'শিক্ষক তালিকা', 'lista maestra', 'قائمة المعلم', 'leraar lijst', 'Список учителей', '老师名单', 'öğretmen listesi', 'lista de professores', 'tanár lista', 'Liste des enseignants', 'Λίστα των εκπαιδευτικών', 'Lehrer-Liste', 'elenco degli insegnanti', 'รายชื่อครู', 'استاد فہرست', 'शिक्षक सूची', 'magister album', 'daftar guru', '教員リスト', '교사의 목록'),
(82, 'add_teacher', 'add teacher', 'শিক্ষক যোগ', 'añadir profesor', 'إضافة المعلم', 'voeg leraar', 'добавить учителя', '加上老师', 'öğretmen ekle', 'adicionar professor', 'hozzá tanár', 'ajouter enseignant', 'προσθέστε δάσκαλος', 'Lehrer hinzufügen', 'aggiungere insegnante', 'เพิ่มครู', 'استاد شامل', 'शिक्षक जोड़', 'Magister addit', 'menambah guru', '先生を追加', '교사를 추가'),
(83, 'teacher_name', 'teacher name', 'শিক্ষক নাম', 'Nombre del profesor', 'اسم المعلم', 'leraarsnaam', 'Имя учителя', '老师姓名', 'öğretmen adı', 'nome professor', 'tanár név', 'nom des enseignants', 'όνομα των εκπαιδευτικών', 'Lehrer Name', 'Nome del docente', 'ชื่อครู', 'استاد کا نام', 'शिक्षक का नाम', 'magister nomine', 'nama guru', '教員名', '교사 이름'),
(84, 'edit_teacher', 'edit teacher', 'সম্পাদনা শিক্ষক', 'edit maestro', 'تحرير المعلم', 'leraar bewerken', 'править учитель', '编辑老师', 'edit öğretmen', 'editar professor', 'szerkesztés tanár', 'modifier enseignant', 'edit εκπαιδευτικών', 'edit Lehrer', 'modifica insegnante', 'แก้ไขครู', 'ترمیم استاد', 'संपादित करें शिक्षक', 'edit magister', 'mengedit guru', '編集の先生', '편집 교사'),
(85, 'manage_parent', 'manage parent', 'অভিভাবক ও পরিচালনা', 'gestionar los padres', 'إدارة الأم', 'beheren ouder', 'управлять родителей', '母公司管理', 'ebeveyn yönetmek', 'gerenciar pai', 'kezelni szülő', 'gérer parent', 'διαχείριση μητρική', 'verwalten Mutter', 'gestione genitore', 'จัดการปกครอง', 'والدین کا انتظام', 'माता - पिता का प्रबंधन', 'curo parent', 'mengelola orang tua', '親を管理', '부모 관리'),
(86, 'parent_list', 'parent list', 'মূল তালিকা', 'lista primaria', 'قائمة الوالد', 'ouder lijst', 'родительского списка', '父列表', 'ebeveyn listesi', 'lista pai', 'szülő lista', 'liste parent', 'μητρική λίστα', 'geordneten Liste', 'elenco padre', 'รายชื่อผู้ปกครอง', 'والدین کی فہرست', 'माता - पिता सूची', 'parente album', 'daftar induk', '親リスト', '상위 목록'),
(87, 'parent_name', 'parent name', 'মূল নাম', 'Nombre del padre', 'اسم الوالد', 'oudernaam', 'родитель название', '父名', 'ebeveyn isim', 'nome do pai', 'szülő név', 'nom du parent', 'μητρικό όνομα', 'Mutternamen', 'nome del padre', 'ชื่อผู้ปกครอง', 'والدین کے نام', 'माता - पिता का नाम', 'Nomen parentis,', 'nama orang tua', '親の名前', '부모 이름'),
(88, 'relation_with_student', 'relation with student', 'ছাত্রদের সঙ্গে সম্পর্ক', 'relación con el estudiante', 'العلاقة مع الطالب', 'relatie met student', 'отношения с учеником', '与学生关系', 'öğrenci ile ilişkisi', 'relação com o aluno', 'kapcsolatban diák', 'relation avec l\'élève', 'σχέση με τον μαθητή', 'Zusammenhang mit Studenten', 'rapporto con lo studente', 'ความสัมพันธ์กับนักเรียน', 'طالب علم کے ساتھ تعلق', 'छात्रा के साथ संबंध', 'cum inter ipsum', 'hubungan dengan siswa', '学生との関係', '학생과의 관계'),
(89, 'parent_email', 'parent email', 'মূল ইমেইল', 'correo electrónico de los padres', 'البريد الإلكتروني الأم', 'ouder email', 'родитель письмо', '父母的电子邮件', 'ebeveyn email', 'e-mail dos pais', 'szülő e-mail', 'parent email', 'email του γονέα', 'Eltern per E-Mail', 'email genitore', 'อีเมล์ผู้ปกครอง', 'والدین کا ای میل', 'माता - पिता ईमेल', 'parente email', 'email induk', '親電子メール', '부모의 이메일'),
(90, 'parent_phone', 'parent phone', 'ঊর্ধ্বতন ফোন', 'teléfono de los padres', 'الهاتف الوالدين', 'ouder telefoon', 'родитель телефон', '家长电话', 'ebeveyn telefon', 'telefone dos pais', 'szülő telefon', 'mère de téléphone', 'μητρική τηλέφωνο', 'Elterntelefon', 'telefono genitore', 'โทรศัพท์ของผู้ปกครอง', 'والدین فون', 'माता - पिता को फोन', 'parentis phone', 'telepon orang tua', '親の携帯電話', '부모 전화'),
(91, 'parrent_address', 'parrent address', 'parrent ঠিকানা', 'Dirección Parrent', 'عنوان parrent', 'parrent adres', 'Parrent адрес', 'parrent地址', 'parrent adresi', 'endereço Parrent', 'parrent cím', 'adresse Parrent', 'parrent διεύθυνση', 'parrent Adresse', 'Indirizzo parrent', 'ที่อยู่ parrent', 'parrent ایڈریس', 'parrent पता', 'oratio parrent', 'alamat parrent', 'parrentアドレス', 'parrent 주소'),
(92, 'parrent_occupation', 'parrent occupation', 'parrent বৃত্তি', 'ocupación Parrent', 'الاحتلال parrent', 'parrent bezetting', 'Parrent оккупация', 'parrent职业', 'parrent işgal', 'ocupação Parrent', 'parrent Foglalkozás', 'occupation Parrent', 'parrent επάγγελμα', 'parrent Beruf', 'occupazione parrent', 'อาชีพ parrent', 'parrent قبضے', 'parrent कब्जे', 'opus parrent', 'pendudukan parrent', 'parrent職業', 'parrent 직업'),
(93, 'add', 'add', 'যোগ করা', 'añadir', 'إضافة', 'toevoegen', 'добавлять', '加', 'eklemek', 'adicionar', 'hozzáad', 'ajouter', 'προσθήκη', 'hinzufügen', 'aggiungere', 'เพิ่ม', 'شامل', 'जोड़ना', 'Adde', 'menambahkan', '加える', '추가'),
(94, 'parent_of', 'parent of', 'অভিভাবক', 'matriz de', 'الأم ل', 'ouder van', 'родитель', '父', 'ebeveyn', 'pai', 'szülő', 'parent d\'', 'γονέας', 'Muttergesellschaft der', 'madre di', 'ผู้ปกครองของ', 'والدین', 'के माता - पिता', 'parentem,', 'induk dari', 'の親', '의 부모'),
(95, 'profession', 'profession', 'পেশা', 'profesión', 'مهنة', 'beroep', 'профессия', '职业', 'meslek', 'profissão', 'szakma', 'profession', 'επάγγελμα', 'Beruf', 'professione', 'อาชีพ', 'پیشہ', 'व्यवसाय', 'professio', 'profesi', '職業', '직업'),
(96, 'edit_parent', 'edit parent', 'সম্পাদনা ঊর্ধ্বতন', 'edit padres', 'تحرير الوالدين', 'bewerk ouder', 'править родитель', '编辑父', 'edit ebeveyn', 'edição pai', 'szerkesztés szülő', 'modifier parent', 'edit γονέα', 'edit Mutter', 'modifica genitore', 'แก้ไขผู้ปกครอง', 'میں ترمیم کریں والدین', 'संपादित जनक', 'edit parent', 'mengedit induk', '編集親', '편집 부모'),
(97, 'add_parent', 'add parent', 'ঊর্ধ্বতন যোগ', 'añadir los padres', 'إضافة الوالد', 'Voeg een ouder', 'добавить родителя', '添加父', 'ebeveyn ekle', 'adicionar pai', 'hozzá szülő', 'ajouter parent', 'προσθέστε μητρική', 'Mutter hinzufügen', 'aggiungere genitore', 'เพิ่มผู้ปกครอง', 'والدین شامل', 'माता - पिता जोड़', 'adde parent', 'menambahkan orang tua', '親を追加', '부모를 추가'),
(98, 'manage_subject', 'manage subject', 'বিষয় ও পরিচালনা', 'gestionar sujeto', 'إدارة الموضوع', 'beheren onderwerp', 'управлять тему', '管理主题', 'konuyu yönetmek', 'gerenciar assunto', 'kezelni tárgy', 'gérer sujet', 'διαχείριση υπόκειται', 'Thema verwalten', 'gestire i soggetti', 'การจัดการเรื่อง', 'موضوع کا انتظام', 'विषय का प्रबंधन', 'subiectum disponat', 'mengelola subjek', '対象を管理', '대상 관리'),
(99, 'subject_list', 'subject list', 'বিষয় তালিকা', 'lista por materia', 'قائمة الموضوع', 'Onderwerp lijst', 'Список подлежит', '主题列表', 'konu listesi', 'lista por assunto', 'téma lista', 'liste de sujets', 'υπόκεινται λίστα', 'Themenliste', 'lista soggetto', 'รายการเรื่อง', 'موضوع کی فہرست', 'विषय सूची', 'subiectum album', 'daftar subjek', 'サブジェクトリスト', '주제 목록'),
(100, 'add_subject', 'add subject', 'বিষয় যোগ', 'Añadir asunto', 'إضافة الموضوع', 'Onderwerp toevoegen', 'добавить тему', '新增主题', 'konu ekle', 'adicionar assunto', 'Tárgy hozzáadása', 'ajouter l\'objet', 'Προσθήκη θέματος', 'Thema hinzufügen', 'aggiungere soggetto', 'เพิ่มเรื่อง', 'موضوع', 'जोड़ें विषय', 're addere', 'menambahkan subjek', '件名を追加', '제목을 추가'),
(101, 'subject_name', 'subject name', 'বিষয় নাম', 'nombre del sujeto', 'اسم الموضوع', 'Onderwerp naam', 'имя субъекта', '主题名称', 'konu adı', 'nome do assunto', 'tárgy megnevezése', 'nom du sujet', 'υπόκεινται όνομα', 'Thema Namen', 'nome del soggetto', 'ชื่อเรื่อง', 'موضوع کے نام', 'विषय का नाम', 'agitur nomine', 'nama subjek', 'サブジェクト名', '주체 이름'),
(102, 'edit_subject', 'edit subject', 'সম্পাদনা বিষয়', 'Editar asunto', 'تحرير الموضوع', 'Onderwerp bewerken', 'Изменить тему', '编辑主题', 'düzenleme konusu', 'Editar assunto', 'Tárgy szerkesztése', 'modifier l\'objet', 'edit θέμα', 'Betreff bearbeiten', 'Modifica oggetto', 'แก้ไขเรื่อง', 'موضوع میں ترمیم کریں', 'विषय संपादित करें', 'edit subiecto', 'mengedit subjek', '編集対象', '제목 수정'),
(103, 'manage_class', 'manage class', 'ক্লাস ও পরিচালনা', 'gestionar clase', 'إدارة الصف', 'beheren klasse', 'управлять класс', '管理类', 'sınıf yönetmek', 'gerenciar classe', 'kezelni osztály', 'gérer classe', 'διαχείριση τάξης', 'Klasse verwalten', 'gestione della classe', 'การจัดการชั้นเรียน', 'کلاس کا انتظام', 'वर्ग का प्रबंधन', 'genus regendi', 'mengelola kelas', 'クラスを管理', '클래스에게 관리'),
(104, 'class_list', 'class list', 'বর্গ তালিকা', 'lista de la clase', 'قائمة فئة', 'klasse lijst', 'Список класс', '类列表', 'sınıf listesi', 'lista de classe', 'class lista', 'liste de classe', 'πίνακας αποτελεσμάτων', 'Klassenliste', 'elenco di classe', 'รายการชั้น', 'کلاس فہرست', 'कक्षा सूची', 'genus album', 'daftar kelas', 'クラスリスト', '클래스 목록'),
(105, 'add_class', 'add class', 'ক্লাসে যোগ', 'agregar la clase', 'إضافة فئة', 'voeg klasse', 'добавить класс', '添加类', 'sınıf eklemek', 'adicionar classe', 'hozzá osztály', 'ajouter la classe', 'προσθέσετε τάξη', 'Klasse hinzufügen', 'aggiungere classe', 'เพิ่มระดับ', 'کلاس شامل کریں', 'वर्ग जोड़', 'adde genus', 'menambahkan kelas', 'クラスを追加', '클래스를 추가'),
(106, 'class_name', 'class name', 'শ্রেণীর নাম', 'nombre de la clase', 'اسم الفئة', 'class naam', 'Имя класса', '类名', 'sınıf adı', 'nome da classe', 'osztály neve', 'nom de la classe', 'όνομα της κλάσης', 'Klassennamen', 'nome della classe', 'ชื่อชั้น', 'کلاس نام', 'वर्ग के नाम', 'Classis nomine', 'nama kelas', 'クラス名', '클래스 이름'),
(107, 'numeric_name', 'numeric name', 'সাংখ্যিক নাম', 'nombre numérico', 'اسم رقمية', 'numerieke naam', 'числовое имя', '数字名称', 'Sayısal isim', 'nome numérico', 'numerikus név', 'nom numérique', 'αριθμητικό όνομα', 'numerischen Namen', 'nome numerico', 'ชื่อตัวเลข', 'عددی نام', 'सांख्यिक नाम', 'secundum numerum est secundum nomen,', 'Nama numerik', '数値の名前', '숫자 이름'),
(108, 'name_numeric', 'name numeric', 'সাংখ্যিক নাম দিন', 'nombre numérico', 'تسمية رقمية', 'naam numerieke', 'назвать числовой', '数字命名', 'sayısal isim', 'nome numérico', 'név numerikus', 'nommer numérique', 'όνομα αριθμητικό', 'nennen numerischen', 'nome numerico', 'ชื่อตัวเลข', 'عددی نام', 'सांख्यिक का नाम', 'secundum numerum est secundum nomen,', 'nama numerik', '数値に名前を付ける', '숫자 이름을'),
(109, 'edit_class', 'edit class', 'সম্পাদনা বর্গ', 'clase de edición', 'الطبقة تحرير', 'bewerken klasse', 'править класс', '编辑类', 'sınıf düzenle', 'edição classe', 'szerkesztés osztály', 'modifier la classe', 'edit κατηγορία', 'Klasse bearbeiten', 'modifica della classe', 'แก้ไขระดับ', 'ترمیم کلاس', 'संपादित वर्ग', 'edit genere', 'mengedit kelas', '編集クラス', '편집 클래스'),
(110, 'manage_exam', 'manage exam', 'পরীক্ষা পরিচালনা', 'gestionar examen', 'إدارة الامتحان', 'beheren examen', 'управлять экзамен', '考试管理', 'sınavı yönetmek', 'gerenciar exame', 'kezelni vizsga', 'gérer examen', 'διαχείριση εξετάσεις', 'Prüfung verwalten', 'gestire esame', 'การจัดการสอบ', 'امتحان کا انتظام', 'परीक्षा का प्रबंधन', 'curo ipsum', 'mengelola ujian', '試験を管理', '시험 관리'),
(111, 'exam_list', 'exam list', 'পরীক্ষার তালিকা', 'lista de exámenes', 'قائمة الامتحان', 'examen lijst', 'Список экзамен', '考试名单', 'sınav listesi', 'lista de exames', 'vizsga lista', 'liste d\'examen', 'Λίστα εξετάσεις', 'Prüfungsliste', 'elenco esami', 'รายการสอบ', 'امتحان فہرست', 'परीक्षा सूची', 'Lorem ipsum album', 'daftar ujian', '試験のリスト', '시험 목록'),
(112, 'add_exam', 'add exam', 'পরীক্ষার যোগ', 'agregar examen', 'إضافة امتحان', 'voeg examen', 'добавить экзамен', '新增考试', 'sınav eklemek', 'adicionar exame', 'hozzá vizsga', 'ajouter examen', 'προσθέσετε εξετάσεις', 'Prüfung hinzufügen', 'aggiungere esame', 'เพิ่มการสอบ', 'امتحان میں شامل کریں', 'परीक्षा जोड़', 'adde ipsum', 'menambahkan ujian', '試験を追加', '시험에 추가'),
(113, 'exam_name', 'exam name', 'পরীক্ষার নাম', 'nombre del examen', 'اسم الامتحان', 'examen naam', 'Название экзамен', '考试名称', 'sınav adı', 'nome do exame', 'Vizsga neve', 'nom de l\'examen', 'Το όνομά εξετάσεις', 'Prüfungsnamen', 'nome dell\'esame', 'ชื่อสอบ', 'امتحان کے نام', 'परीक्षा का नाम', 'ipsum nomen,', 'Nama ujian', '試験名', '시험 이름'),
(114, 'date', 'date', 'তারিখ', 'fecha', 'تاريخ', 'datum', 'дата', '日期', 'tarih', 'data', 'dátum', 'date', 'ημερομηνία', 'Datum', 'data', 'วันที่', 'تاریخ', 'तारीख', 'date', 'tanggal', '日付', '날짜'),
(115, 'comment', 'comment', 'মন্তব্য', 'comentario', 'تعليق', 'commentaar', 'комментарий', '评论', 'yorum', 'comentário', 'megjegyzés', 'commentaire', 'σχόλιο', 'Kommentar', 'commento', 'ความเห็น', 'تبصرہ', 'टिप्पणी', 'comment', 'komentar', 'コメント', '논평'),
(116, 'edit_exam', 'edit exam', 'সম্পাদনা পরীক্ষা', 'examen de edición', 'امتحان تحرير', 'bewerk examen', 'править экзамен', '编辑考试', 'edit sınavı', 'edição do exame', 'szerkesztés vizsga', 'modifier examen', 'edit εξετάσεις', 'edit Prüfung', 'modifica esame', 'แก้ไขการสอบ', 'ترمیم امتحان', 'संपादित परीक्षा', 'edit ipsum', 'mengedit ujian', '編集試験', '편집 시험'),
(117, 'manage_exam_marks', 'manage exam marks', 'পরীক্ষা চিহ্ন ও পরিচালনা', 'gestionar marcas de examen', 'إدارة علامات الامتحان', 'beheren examencijfers', 'управлять экзаменационные отметки', '管理考试痕', 'sınav işaretleri yönetmek', 'gerenciar marcas exame', 'kezelni vizsga jelek', 'gérer les marques d\'examen', 'διαχείριση των σημάτων εξετάσεις', 'Prüfungsnoten verwalten', 'gestire i voti degli esami', 'จัดการสอบเครื่องหมาย', 'امتحان کے نشانات کا انتظام', 'परीक्षा के निशान का प्रबंधन', 'ipsum curo indicia', 'mengelola nilai ujian', '試験マークを管理', '시험 점수를 관리'),
(118, 'manage_marks', 'manage marks', 'চিহ্ন ও পরিচালনা', 'gestionar marcas', 'إدارة علامات', 'beheren merken', 'управлять знаки', '商标管理', 'işaretleri yönetmek', 'gerenciar marcas', 'kezelni jelek', 'gérer les marques', 'διαχείριση των σημάτων', 'Markierungen verwalten', 'gestire i marchi', 'จัดการเครื่องหมาย', 'نمبروں کا انتظام', 'निशान का प्रबंधन', 'curo indicia', 'mengelola tanda', 'マークを管理', '마크를 관리'),
(119, 'select_exam', 'select exam', 'পরীক্ষার নির্বাচন', 'seleccione examen', 'حدد الامتحان', 'selecteer examen', 'выбрать экзамен', '选择考试', 'sınavı seçin', 'selecionar exame', 'válassza ki a vizsga', 'sélectionnez examen', 'επιλέξτε εξετάσεις', 'Prüfung wählen', 'seleziona esame', 'เลือกสอบ', 'امتحان منتخب کریں', 'परीक्षा का चयन', 'velit ipsum', 'pilih ujian', '受験を選択', '시험을 선택'),
(120, 'select_class', 'select class', 'বর্গ নির্বাচন', 'seleccione clase', 'حدد فئة', 'selecteren klasse', 'выбрать класс', '选择产品类别', 'sınıf seçin', 'selecionar classe', 'válassza osztály', 'sélectionnez classe', 'Επιλέξτε κατηγορία', 'Klasse wählen', 'seleziona classe', 'เลือกชั้น', 'کلاس منتخب کریں', 'वर्ग का चयन करें', 'genus eligere,', 'pilih kelas', 'クラスを選択', '클래스를 선택'),
(121, 'select_subject', 'select subject', 'বিষয় নির্বাচন করুন', 'seleccione tema', 'حدد الموضوع', 'Selecteer onderwerp', 'выберите тему', '选择主题', 'konu seçin', 'selecionar assunto', 'Válassza a Tárgy', 'sélectionner le sujet', 'επιλέξτε θέμα', 'Thema wählen', 'seleziona argomento', 'เลือกเรื่อง', 'موضوع منتخب کریں', 'विषय का चयन', 'eligere subditos', 'pilih subjek', '件名を選択', '주제를 선택'),
(122, 'select_an_exam', 'select an exam', 'একটি পরীক্ষা নির্বাচন', 'seleccione un examen', 'حدد الامتحان', 'selecteer een examen', 'выбрать экзамен', '选择考试', 'Bir sınav seçin', 'selecionar um exame', 'válasszon ki egy vizsga', 'sélectionner un examen', 'επιλέξτε μια εξέταση', 'Wählen Sie eine Prüfung', 'selezionare un esame', 'เลือกสอบ', 'امتحان منتخب کریں', 'एक परीक्षा का चयन', 'Eligebatur autem ipsum', 'pilih ujian', '受験を選択', '시험을 선택'),
(123, 'mark_obtained', 'mark obtained', 'চিহ্নিত প্রাপ্ত', 'calificación obtenida', 'بمناسبة الحصول على', 'markeren verkregen', 'отметить получены', '获得标', 'işaretlemek elde', 'marca obtida', 'jelölje kapott', 'marquer obtenu', 'σήμα που λαμβάνεται', 'Markieren Sie erhalten', 'contrassegnare ottenuto', 'ทำเครื่องหมายที่ได้รับ', 'نشان زد حاصل', 'अंक प्राप्त', 'attende obtinuit', 'menandai diperoleh', 'マークが得', '마크 획득'),
(124, 'attendance', 'attendance', 'উপস্থিতি', 'asistencia', 'الحضور', 'opkomst', 'посещаемость', '护理', 'katılım', 'comparecimento', 'részvétel', 'présence', 'παρουσία', 'Teilnahme', 'partecipazione', 'การดูแลรักษา', 'حاضری', 'उपस्थिति', 'auscultant', 'kehadiran', '出席', '출석'),
(125, 'manage_grade', 'manage grade', 'গ্রেড পরিচালনা', 'gestión de calidad', 'إدارة الصف', 'beheren leerjaar', 'управлять класс', '管理级', 'notu yönetmek', 'gerenciar grau', 'kezelni fokozat', 'gérer de qualité', 'διαχείριση ποιότητας', 'Klasse verwalten', 'gestione grade', 'จัดการเกรด', 'گریڈ کا انتظام', 'ग्रेड का प्रबंधन', 'moderari gradu', 'mengelola kelas', 'グレードを管理', '등급 관리'),
(126, 'grade_list', 'grade list', 'গ্রেড তালিকা', 'Lista de grado', 'قائمة الصف', 'cijferlijst', 'Список класса', '等级列表', 'sınıf listesi', 'lista grau', 'fokozat lista', 'liste de qualité', 'Λίστα βαθμού', 'Notenliste', 'elenco grade', 'รายการเกรด', 'گریڈ فہرست', 'ग्रेड की सूची', 'gradus album', 'daftar kelas', 'グレード一覧', '등급 목록'),
(127, 'add_grade', 'add grade', 'গ্রেড যোগ করুন', 'añadir grado', 'إضافة الصف', 'voeg leerjaar', 'добавить класс', '添加级', 'not eklemek', 'adicionar grau', 'hozzá fokozat', 'ajouter note', 'προσθήκη βαθμού', 'Klasse hinzufügen', 'aggiungere grade', 'เพิ่มเกรด', 'گریڈ میں شامل کریں', 'ग्रेड जोड़', 'adde gradum,', 'menambahkan kelas', 'グレードを追加', '등급을 추가'),
(128, 'grade_name', 'grade name', 'গ্রেড নাম', 'Nombre de grado', 'اسم الصف', 'rangnaam', 'Название сорта', '等级名称', 'sınıf adı', 'nome da classe', 'fokozat név', 'nom de la catégorie', 'Όνομα βαθμού', 'Klasse Name', 'nome del grado', 'ชื่อชั้น', 'گریڈ نام', 'ग्रेड का नाम', 'nomen, gradus,', 'nama kelas', 'グレード名', '등급 이름'),
(129, 'grade_point', 'grade point', 'গ্রেড পয়েন্ট', 'de calificaciones', 'تراكمي', 'rangpunt', 'балл', '成绩', 'not', 'ponto de classe', 'fokozatú pont', 'cumulative', 'βαθμών', 'Noten', 'punto di grado', 'จุดเกรด', 'گریڈ پوائنٹ', 'ग्रेड बिंदु', 'gradus punctum', 'indeks prestasi', '成績評価点', '학점'),
(130, 'mark_from', 'mark from', 'চিহ্ন থেকে', 'marca de', 'علامة من', 'mark uit', 'знак от', '从商标', 'mark dan', 'marca de', 'jelölést', 'marque de', 'σήμα από', 'Marke aus', 'segno da', 'เครื่องหมายจาก', 'نشان سے', 'मार्क से', 'marcam', 'mark dari', 'マークから', '표에서'),
(131, 'mark_upto', 'mark upto', 'পর্যন্ত চিহ্নিত', 'marcar hasta', 'بمناسبة تصل', 'mark tot', 'отметить ДО', '高达标记', 'kadar işaretlemek', 'marcar até', 'jelölje upto', 'marquer jusqu\'à', 'σήμα μέχρι', 'Markieren Sie bis zu', 'contrassegnare fino a', 'ทำเครื่องหมายเกิน', 'تک کے موقع', 'तक चिह्नित', 'Genitus est notare', 'menandai upto', '点で最大マーク', '표까지'),
(132, 'edit_grade', 'edit grade', 'সম্পাদনা গ্রেড', 'edit grado', 'تحرير الصف', 'Cijfer bewerken', 'править класса', '编辑等级', 'edit notu', 'edição grau', 'szerkesztés fokozat', 'edit qualité', 'edit βαθμού', 'edit Grad', 'modifica grade', 'แก้ไขเกรด', 'ترمیم گریڈ', 'संपादित ग्रेड', 'edit gradu', 'mengedit kelas', '編集グレード', '편집 등급'),
(133, 'manage_class_routine', 'manage class routine', 'ক্লাসের রুটিন পরিচালনা', 'gestionar rutina de la clase', 'إدارة الطبقة الروتينية', 'beheren klasroutine', 'управлять рутину класса', '管理类常规', 'sınıf rutin yönetmek', 'gerenciar rotina classe', 'kezelni class rutin', 'gérer la routine de classe', 'διαχειρίζονται τάξη ρουτίνα', 'verwalten Klasse Routine', 'gestione classe di routine', 'การจัดการชั้นเรียนตามปกติ', 'کلاس معمول کا انتظام', 'वर्ग दिनचर्या का प्रबंधन', 'uno in genere tractare', 'mengelola rutinitas kelas', 'クラスルーチンを管理', '수준의 일상적인 관리'),
(134, 'class_routine_list', 'class routine list', 'ক্লাসের রুটিন তালিকা', 'clase de lista de rutina', 'قائمة الروتينية الطبقة', 'klasroutine lijst', 'класс рутина список', '班级常规列表', 'sınıf rutin listesi', 'classe de lista de rotina', 'osztály rutin lista', 'classe liste routine', 'κλάση list ρουτίνας', 'Klasse Routine Liste', 'classe lista di routine', 'รายการประจำชั้น', 'کلاس معمول کے مطابق فہرست', 'वर्ग दिनचर्या सूची', 'uno genere album', 'Daftar rutin kelas', 'クラスルーチン一覧', '클래스 루틴 목록'),
(135, 'add_class_routine', 'add class routine', 'ক্লাসের রুটিন যুক্ত', 'añadir rutina de la clase', 'إضافة فئة الروتينية', 'voeg klasroutine', 'добавить подпрограмму класса', '添加类常规', 'sınıf rutin eklemek', 'adicionar rotina classe', 'hozzá class rutin', 'ajouter routine de classe', 'προσθέσετε τάξη ρουτίνα', 'Klasse hinzufügen Routine', 'aggiungere classe di routine', 'เพิ่มระดับตามปกติ', 'کلاس معمول میں شامل کریں', 'वर्ग दिनचर्या जोड़', 'adde genus moris', 'menambahkan rutin kelas', 'クラス·ルーチンを追加', '클래스 루틴을 추가'),
(136, 'day', 'day', 'দিন', 'día', 'يوم', 'dag', 'день', '日', 'gün', 'dia', 'nap', 'jour', 'ημέρα', 'Tag', 'giorno', 'วัน', 'دن', 'दिन', 'die,', 'hari', '日', '일'),
(137, 'starting_time', 'starting time', 'সময়ের শুরু', 'tiempo de inicio', 'بدءا الوقت', 'starttijd', 'время начала', '开始时间', 'başlangıç ​​zamanı', 'tempo começando', 'indítási idő', 'temps de démarrage', 'ώρα έναρξης', 'Startzeit', 'tempo di avviamento', 'เวลาเริ่มต้น', 'وقت شروع ہونے', 'समय की शुरुआत के', 'tum satus', 'waktu mulai', '起動時間', '시작 시간'),
(138, 'ending_time', 'ending time', 'সময় শেষ', 'hora de finalización', 'تنتهي الساعة', 'eindtijd', 'время окончания', '结束时间', 'bitiş zamanını', 'tempo final', 'befejezési időpont', 'heure de fin', 'ώρα λήξης', 'Endzeit', 'ora finale', 'สิ้นสุดเวลา', 'وقت ختم', 'समय समाप्त होने के', 'et finis temporis,', 'akhir waktu', '終了時刻', '종료 시간'),
(139, 'edit_class_routine', 'edit class routine', 'সম্পাদনা ক্লাস রুটিন', 'rutina de la clase de edición', 'الطبقة تحرير الروتينية', 'bewerk klasroutine', 'Процедура редактирования класс', '编辑类常规', 'sınıf düzenle rutin', 'rotina de edição de classe', 'szerkesztés osztály rutin', 'routine modifier de classe', 'edit τάξη ρουτίνα', 'edit Klasse Routine', 'modifica della classe di routine', 'แก้ไขชั้นเรียนตามปกติ', 'ترمیم کلاس معمول', 'संपादित वर्ग दिनचर्या', 'edit uno genere', 'rutin mengedit kelas', '編集クラスのルーチン', '편집 클래스 루틴'),
(140, 'manage_invoice/payment', 'manage invoice/payment', 'চালান / পেমেন্ট পরিচালনা', 'gestionar factura / pago', 'إدارة فاتورة / دفع', 'beheren factuur / betaling', 'управлять счета / оплата', '管理发票/付款', 'fatura / ödeme yönetmek', 'gerenciar fatura / pagamento', 'kezelni számla / fizetési', 'gérer facture / paiement', 'διαχείριση τιμολογίου / πληρωμής', 'Verwaltung Rechnung / Zahlung', 'gestione fattura / pagamento', 'จัดการใบแจ้งหนี้ / การชำระเงิน', 'انوائس / ادائیگی کا انتظام', 'चालान / भुगतान का प्रबंधन', 'curo cautionem / solutionem', 'mengelola tagihan / pembayaran', '請求書/支払管理', '인보이스 / 결제 관리'),
(141, 'invoice/payment_list', 'invoice/payment list', 'চালান / পেমেন্ট তালিকা', 'lista de facturas / pagos', 'قائمة فاتورة / دفع', 'factuur / betaling lijst', 'Список счета / оплата', '发票/付款清单', 'fatura / ödeme listesi', 'lista de fatura / pagamento', 'számla / fizetési lista', 'liste facture / paiement', 'Λίστα τιμολογίου / πληρωμής', 'Rechnung / Zahlungsliste', 'elenco fattura / pagamento', 'รายการใบแจ้งหนี้ / การชำระเงิน', 'انوائس / ادائیگی کی فہرست', 'चालान / भुगतान सूची', 'cautionem / list pretium', 'daftar tagihan / pembayaran', '請求書/支払一覧', '인보이스 / 결제리스트'),
(142, 'add_invoice/payment', 'add invoice/payment', 'চালান / পেমেন্ট যোগ', 'añadir factura / pago', 'إضافة فاتورة / دفع', 'voeg factuur / betaling', 'добавить счета / оплата', '添加发票/付款', 'fatura / ödeme eklemek', 'adicionar factura / pagamento', 'hozzá számla / fizetési', 'ajouter facture / paiement', 'προσθήκη τιμολογίου / πληρωμής', 'hinzufügen Rechnung / Zahlung', 'aggiungere fatturazione / pagamento', 'เพิ่มใบแจ้งหนี้ / การชำระเงิน', 'انوائس / ادائیگی شامل', 'चालान / भुगतान जोड़ें', 'add cautionem / solutionem', 'menambahkan tagihan / pembayaran', '請求書/支払を追加', '송장 / 지불을 추가'),
(143, 'title', 'title', 'খেতাব', 'título', 'لقب', 'titel', 'название', '标题', 'başlık', 'título', 'cím', 'titre', 'τίτλος', 'Titel', 'titolo', 'ชื่อเรื่อง', 'عنوان', 'शीर्षक', 'title', 'judul', 'タイトル', '표제'),
(144, 'description', 'description', 'বিবরণ', 'descripción', 'وصف', 'beschrijving', 'описание', '描述', 'tanım', 'descrição', 'leírás', 'description', 'περιγραφή', 'Beschreibung', 'descrizione', 'ลักษณะ', 'تفصیل', 'विवरण', 'description', 'deskripsi', '説明', '기술');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `bengali`, `spanish`, `arabic`, `dutch`, `russian`, `chinese`, `turkish`, `portuguese`, `hungarian`, `french`, `greek`, `german`, `italian`, `thai`, `urdu`, `hindi`, `latin`, `indonesian`, `japanese`, `korean`) VALUES
(145, 'amount', 'amount', 'পরিমাণ', 'cantidad', 'مبلغ', 'bedrag', 'количество', '量', 'miktar', 'quantidade', 'mennyiség', 'montant', 'ποσό', 'Menge', 'importo', 'จำนวน', 'رقم', 'राशि', 'tantum', 'jumlah', '額', '양'),
(146, 'status', 'status', 'অবস্থা', 'estado', 'حالة', 'toestand', 'статус', '状态', 'durum', 'estado', 'állapot', 'statut', 'κατάσταση', 'Status', 'stato', 'สถานะ', 'درجہ', 'हैसियत', 'status', 'status', 'ステータス', '지위'),
(147, 'view_invoice', 'view invoice', 'দেখুন চালান', 'vista de la factura', 'عرض الفاتورة', 'view factuur', 'вид счета-фактуры', '查看发票', 'view fatura', 'vista da fatura', 'view számla', 'vue facture', 'προβολή τιμολόγιο', 'Ansicht Rechnung', 'vista fattura', 'ดูใบแจ้งหนี้', 'دیکھیں انوائس', 'देखें चालान', 'propter cautionem', 'lihat faktur', 'ビュー請求書', '보기 송장'),
(148, 'paid', 'paid', 'পরিশোধ', 'pagado', 'مدفوع', 'betaald', 'оплаченный', '支付', 'ücretli', 'pago', 'fizetett', 'payé', 'καταβληθεί', 'bezahlt', 'pagato', 'ต้องจ่าย', 'ادا کیا', 'प्रदत्त', 'solutis', 'dibayar', '支払われた', '지급'),
(149, 'unpaid', 'unpaid', 'অবৈতনিক', 'no pagado', 'غير مدفوع', 'onbetaald', 'неоплаченный', '未付', 'ödenmemiş', 'não remunerado', 'kifizetetlen', 'non rémunéré', 'απλήρωτη', 'unbezahlt', 'non pagato', 'ยังไม่ได้ชำระ', 'بلا معاوضہ', 'अवैतनिक', 'non est constitutus,', 'dibayar', '未払い', '지불하지 않은'),
(150, 'add_invoice', 'add invoice', 'চালান যোগ', 'añadir factura', 'إضافة الفاتورة', 'voeg factuur', 'добавить счет', '添加发票', 'faturayı eklemek', 'adicionar fatura', 'hozzá számla', 'ajouter facture', 'προσθέστε τιμολόγιο', 'Rechnung hinzufügen', 'aggiungere fattura', 'เพิ่มใบแจ้งหนี้', 'انوائس میں شامل', 'चालान जोड़', 'add cautionem', 'menambahkan faktur', '請求書を追加', '송장을 추가'),
(151, 'payment_to', 'payment to', 'পেমেন্ট', 'pago a', 'دفع ل', 'betaling aan', 'оплата', '支付', 'için ödeme', 'pagamento', 'fizetés', 'paiement', 'πληρωμή', 'Zahlung an', 'pagamento', 'ชำระเงินให้กับ', 'ادائیگی', 'को भुगतान', 'pecunia', 'pembayaran kepada', 'への支払い', '에 지불'),
(152, 'bill_to', 'bill to', 'বিল', 'proyecto de ley para', 'مشروع قانون ل', 'wetsvoorstel om', 'Законопроект о', '法案', 'bill', 'projeto de lei para', 'törvényjavaslat', 'projet de loi', 'νομοσχέδιο για την', 'Gesetzentwurf zur', 'disegno di legge per', 'บิล', 'بل', 'बिल के लिए', 'latumque', 'RUU untuk', '請求する', '법안'),
(153, 'invoice_title', 'invoice title', 'চালান শিরোনাম', 'Título de la factura', 'عنوان الفاتورة', 'factuur titel', 'Название счета', '发票抬头', 'fatura başlık', 'título fatura', 'számla cím', 'titre de la facture', 'Τίτλος τιμολόγιο', 'Rechnungs Titel', 'title fattura', 'ชื่อใบแจ้งหนี้', 'انوائس عنوان', 'चालान शीर्षक', 'title cautionem', 'judul faktur', '請求書のタイトル', '송장 제목'),
(154, 'invoice_id', 'invoice id', 'চালান আইডি', 'Identificación de la factura', 'فاتورة معرف', 'factuur id', 'счет-фактура ID', '发票编号', 'fatura id', 'id fatura', 'számla id', 'Identifiant facture', 'id τιμολόγιο', 'Rechnung-ID', 'fattura id', 'ใบแจ้งหนี้หมายเลข', 'انوائس ID', 'चालान आईडी', 'id cautionem', 'faktur id', '請求書ID', '송장 ID'),
(155, 'edit_invoice', 'edit invoice', 'সম্পাদনা চালান', 'edit factura', 'تحرير الفاتورة', 'bewerk factuur', 'редактирования счета-фактуры', '编辑发票', 'edit fatura', 'edição fatura', 'szerkesztés számla', 'modifier la facture', 'edit τιμολόγιο', 'edit Rechnung', 'modifica fattura', 'แก้ไขใบแจ้งหนี้', 'ترمیم انوائس', 'संपादित चालान', 'edit cautionem', 'mengedit faktur', '編集送り状', '편집 송장'),
(156, 'manage_library_books', 'manage library books', 'লাইব্রেরির বই ও পরিচালনা', 'gestionar libros de la biblioteca', 'إدارة مكتبة الكتب', 'beheren bibliotheekboeken', 'управлять библиотечные книги', '管理图书', 'kitapları kütüphane yönetmek', 'gerenciar os livros da biblioteca', 'kezelni könyvtári könyvek', 'gérer des livres de bibliothèque', 'διαχειριστείτε τα βιβλία της βιβλιοθήκης', 'Bücher aus der Bibliothek verwalten', 'gestire i libri della biblioteca', 'จัดการหนั​​งสือห้องสมุด', 'کتب خانے کی کتابیں منظم', 'पुस्तकालय की पुस्तकों का प्रबंधन', 'curo bibliotheca librorum,', 'mengelola buku perpustakaan', '図書館の本を管理', '도서관 책 관리'),
(157, 'book_list', 'book list', 'পাঠ্যতালিকা', 'lista de libros', 'قائمة الكتب', 'boekenlijst', 'Список книг', '书单', 'kitap listesi', 'lista de livros', 'book lista', 'liste de livres', 'λίστα βιβλίων', 'Buchliste', 'elenco libri', 'รายการหนั​​งสือ', 'کتاب کی فہرست', 'पुस्तक सूची', 'album', 'daftar buku', 'ブックリスト', '도서 목록'),
(158, 'add_book', 'add book', 'বই যোগ', 'Añadir libro', 'إضافة كتاب', 'boek toevoegen', 'добавить книгу', '加入书', 'kitap eklemek', 'adicionar livro', 'Könyv hozzáadása', 'ajouter livre', 'προσθέστε το βιβλίο', 'Buch hinzufügen', 'aggiungere il libro', 'เพิ่มหนังสือ', 'کتاب شامل', 'पुस्तक जोड़', 'adde libri', 'menambahkan buku', '本を追加', '책을 추가'),
(159, 'book_name', 'book name', 'বইয়ের নাম', 'Nombre del libro', 'اسم الكتاب', 'boeknaam', 'Название книги', '书名', 'kitap adı', 'nome livro', 'book név', 'nom de livre', 'το όνομα του βιβλίου', 'Buchnamen', 'nome del libro', 'ชื่อหนังสือ', 'کتاب کا نام', 'किताब का नाम', 'librum nomine', 'nama buku', 'ブック名', '책 이름'),
(160, 'author', 'author', 'লেখক', 'autor', 'الكاتب', 'auteur', 'автор', '作者', 'yazar', 'autor', 'szerző', 'auteur', 'συγγραφέας', 'Autor', 'autore', 'ผู้เขียน', 'مصنف', 'लेखक', 'auctor', 'penulis', '著者', '저자'),
(161, 'price', 'price', 'দাম', 'precio', 'السعر', 'prijs', 'цена', '价格', 'fiyat', 'preço', 'ár', 'prix', 'τιμή', 'Preis', 'prezzo', 'ราคา', 'قیمت', 'कीमत', 'price', 'harga', '価格', '가격'),
(162, 'available', 'available', 'উপলব্ধ', 'disponible', 'متاح', 'beschikbaar', 'доступный', '可用的', 'mevcut', 'disponível', 'rendelkezésre álló', 'disponible', 'διαθέσιμος', 'verfügbar', 'disponibile', 'สามารถใช้ได้', 'دستیاب', 'उपलब्ध', 'available', 'tersedia', '利用できる', '유효한'),
(163, 'unavailable', 'unavailable', 'অপ্রাপ্য', 'indisponible', 'غير متاح', 'niet beschikbaar', 'недоступен', '不可用', 'yok', 'indisponível', 'érhető el', 'indisponible', 'διαθέσιμο', 'nicht verfügbar', 'non disponibile', 'ไม่มี', 'دستیاب نہیں', 'अनुपलब्ध', 'unavailable', 'tidak tersedia', '利用できない', '없는'),
(164, 'edit_book', 'edit book', 'সম্পাদনা বই', 'libro de edición', 'كتاب تحرير', 'bewerk boek', 'править книга', '编辑本书', 'edit kitap', 'edição do livro', 'edit könyv', 'edit livre', 'επεξεργαστείτε το βιβλίο', 'edit Buch', 'modifica book', 'แก้ไขหนังสือ', 'ترمیم کتاب', 'संपादित पुस्तक', 'edit Liber', 'mengedit buku', '編集の本', '편집 책'),
(165, 'manage_transport', 'manage transport', 'পরিবহন ও পরিচালনা', 'gestionar el transporte', 'إدارة النقل', 'beheren van vervoerssystemen', 'управлять транспортом', '运输管理', 'ulaşım yönetmek', 'gerenciar o transporte', 'kezelni a közlekedés', 'la gestion du transport', 'διαχείριση των μεταφορών', 'Transport verwalten', 'gestire i trasporti', 'การจัดการการขนส่ง', 'نقل و حمل کے انتظام', 'परिवहन का प्रबंधन', 'curo onerariis', 'mengelola transportasi', '輸送を管理', '교통 관리'),
(166, 'transport_list', 'transport list', 'পরিবহন তালিকা', 'Lista de transportes', 'قائمة النقل', 'lijst vervoer', 'лист транспорт', '运输名单', 'taşıma listesi', 'Lista de transportes', 'szállítás lista', 'liste de transport', 'Λίστα των μεταφορών', 'Transportliste', 'elenco trasporti', 'รายการการขนส่ง', 'نقل و حمل کی فہرست', 'परिवहन सूची', 'turpis album', 'daftar transport', '輸送一覧', '전송 목록'),
(167, 'add_transport', 'add transport', 'পরিবহন যোগ করুন', 'añadir el transporte', 'إضافة النقل', 'voeg vervoer', 'добавить транспорт', '加上运输', 'taşıma ekle', 'adicionar transporte', 'hozzá a közlekedés', 'ajouter transports', 'προσθέστε μεταφορών', 'add-Transport', 'aggiungere il trasporto', 'เพิ่มการขนส่ง', 'نقل و حمل شامل', 'परिवहन जोड़', 'adde onerariis', 'tambahkan transportasi', 'トランスポートを追加', '전송을 추가'),
(168, 'route_name', 'route name', 'রুট নাম', 'nombre de la ruta', 'اسم توجيه', 'naam van de route', 'Имя маршрут', '路由名称', 'rota ismi', 'nome da rota', 'útvonal nevét', 'nom de la route', 'Όνομα διαδρομής', 'Routennamen', 'nome del percorso', 'ชื่อเส้นทาง', 'راستے نام', 'मार्ग का नाम', 'iter nomine', 'Nama rute', 'ルートの名前', '경로 이름'),
(169, 'number_of_vehicle', 'number of vehicle', 'গাড়ীর সংখ্যা', 'número de vehículo', 'عدد من المركبات', 'aantal voertuigkilometers', 'количество автомобиля', '车辆的数量', 'Aracın sayısı', 'número de veículo', 'számú gépjármű', 'nombre de véhicules', 'αριθμός των οχημάτων', 'Anzahl der Fahrzeug', 'numero di veicolo', 'จำนวนของยานพาหนะ', 'گاڑی کی تعداد', 'वाहन की संख्या', 'de numero scilicet vehiculum', 'jumlah kendaraan', '車両の数', '차량의 수'),
(170, 'route_fare', 'route fare', 'রুট করবেন', 'ruta hacer', 'المسار تفعل', 'route doen', 'маршрут делать', '路线做', 'yol yapmak', 'rota fazer', 'útvonal do', 'itinéraire faire', 'διαδρομή κάνει', 'Route zu tun', 'r', 'เส้นทางทำ', 'راستے کرتے', 'मार्ग करना', 'iter faciunt,', 'rute lakukan', 'ルートか', '경로는 할'),
(171, 'edit_transport', 'edit transport', 'সম্পাদনা পরিবহন', 'transporte de edición', 'النقل تحرير', 'vervoer bewerken', 'править транспорт', '编辑运输', 'edit ulaşım', 'edição transporte', 'szerkesztés szállítás', 'transport modifier', 'edit μεταφορών', 'edit Transport', 'modifica dei trasporti', 'แก้ไขการขนส่ง', 'ترمیم نقل و حمل', 'संपादित परिवहन', 'edit onerariis', 'mengedit transportasi', '編集輸送', '편집 전송'),
(172, 'manage_dormitory', 'manage dormitory', 'আস্তানা ও পরিচালনা', 'gestionar dormitorio', 'إدارة مهجع', 'beheren slaapzaal', 'управлять общежитие', '宿舍管理', 'yurt yönetmek', 'gerenciar dormitório', 'kezelni kollégiumi', 'gérer dortoir', 'διαχείριση κοιτώνα', 'Schlafsaal verwalten', 'gestione dormitorio', 'จัดการหอพัก', 'شیناگار کا انتظام', 'छात्रावास का प्रबंधन', 'curo dormitorio', 'mengelola asrama', '寮を管理', '기숙사를 관리'),
(173, 'dormitory_list', 'dormitory list', 'আস্তানা তালিকা', 'lista dormitorio', 'قائمة مهجع', 'slaapzaal lijst', 'Список общежитие', '宿舍名单', 'yurt listesi', 'lista dormitório', 'kollégiumi lista', 'liste de dortoir', 'Λίστα κοιτώνα', 'Schlafsaal Liste', 'elenco dormitorio', 'รายชื่อหอพัก', 'شیناگار فہرست', 'छात्रावास सूची', 'dormitorium album', 'daftar asrama', '寮のリスト', '기숙사 목록'),
(174, 'add_dormitory', 'add dormitory', 'আস্তানা যোগ', 'añadir dormitorio', 'إضافة مهجع', 'voeg slaapzaal', 'добавить общежитие', '添加宿舍', 'yurt ekle', 'adicionar dormitório', 'hozzá kollégiumi', 'ajouter dortoir', 'προσθήκη κοιτώνα', 'Schlaf hinzufügen', 'aggiungere dormitorio', 'เพิ่มหอพัก', 'شیناگار شامل', 'छात्रावास जोड़', 'adde dormitorio', 'menambahkan asrama', '寮を追加', '기숙사를 추가'),
(175, 'dormitory_name', 'dormitory name', 'আস্তানা নাম', 'Nombre del dormitorio', 'اسم المهجع', 'slaapzaal naam', 'Имя общежитие', '宿舍名', 'yurt adı', 'nome dormitório', 'kollégiumi név', 'nom de dortoir', 'Όνομα κοιτώνα', 'Schlaf Namen', 'Nome dormitorio', 'ชื่อหอพัก', 'شیناگار نام', 'छात्रावास नाम', 'dormitorium nomine', 'Nama asrama', '寮名', '기숙사 이름'),
(176, 'number_of_room', 'number of room', 'ঘরের সংখ্যা', 'número de habitación', 'عدد الغرف', 'aantal kamer', 'число комнате', '房间数量', 'oda sayısı', 'número de quarto', 'száma szobában', 'nombre de salle', 'τον αριθμό των δωματίων', 'Anzahl der Zimmer', 'numero delle camera', 'จำนวนห้องพัก', 'کمرے کی تعداد', 'कमरे की संख्या', 'numerus locus', 'Jumlah kamar', 'お部屋数', '객실 수'),
(177, 'manage_noticeboard', 'manage noticeboard', 'নোটিশবোর্ড পরিচালনা', 'gestionar tablón de anuncios', 'إدارة اللافتة', 'beheren prikbord', 'управлять доске объявлений', '管理布告', 'Noticeboard yönetmek', 'gerenciar avisos', 'kezelni üzenőfalán', 'gérer panneau d\'affichage', 'διαχείριση ανακοινώσεων', 'Brett verwalten', 'gestione bacheca', 'จัดการป้ายประกาศ', 'noticeboard کا انتظام', 'Noticeboard का प्रबंधन', 'curo noticeboard', 'mengelola pengumuman', '伝言板を管理', '의 noticeboard 관리'),
(178, 'noticeboard_list', 'noticeboard list', 'নোটিশবোর্ড তালিকা', 'tablón de anuncios de la lista', 'قائمة اللافتة', 'prikbord lijst', 'Список доска для объявлений', '布告名单', 'noticeboard listesi', 'lista de avisos', 'üzenőfalán lista', 'liste de panneau d\'affichage', 'λίστα ανακοινώσεων', 'Brett-Liste', 'elenco bacheca', 'รายการป้ายประกาศ', 'noticeboard فہرست', 'Noticeboard सूची', 'noticeboard album', 'daftar pengumuman', '伝言板一覧', '의 noticeboard 목록'),
(179, 'add_noticeboard', 'add noticeboard', 'নোটিশবোর্ড যোগ', 'añadir tablón de anuncios', 'إضافة اللافتة', 'voeg prikbord', 'добавить доске объявлений', '添加布告', 'Noticeboard ekle', 'adicionar avisos', 'hozzá üzenőfalán', 'ajouter panneau d\'affichage', 'προσθήκη ανακοινώσεων', 'Brett hinzufügen', 'aggiungere bacheca', 'เพิ่มป้ายประกาศ', 'noticeboard شامل', 'Noticeboard जोड़', 'adde noticeboard', 'menambahkan pengumuman', '伝言板を追加', '의 noticeboard 추가'),
(180, 'notice', 'notice', 'বিজ্ঞপ্তি', 'aviso', 'إشعار', 'kennisgeving', 'уведомление', '通知', 'uyarı', 'aviso', 'értesítés', 'délai', 'ειδοποίηση', 'Bekanntmachung', 'avviso', 'แจ้งให้ทราบ', 'نوٹس', 'नोटिस', 'Observa', 'pemberitahuan', '予告', '통지'),
(181, 'add_notice', 'add notice', 'নোটিশ যোগ করুন', 'añadir aviso', 'إضافة إشعار', 'voeg bericht', 'добавить уведомление', '添加通知', 'haber ekle', 'adicionar aviso', 'hozzá értesítés', 'ajouter un avis', 'προσθέστε ανακοίνωση', 'Hinweis hinzufügen', 'aggiungere preavviso', 'เพิ่มแจ้งให้ทราบล่วงหน้า', 'نوٹس کا اضافہ کریں', 'नोटिस जोड़', 'addunt et titulum', 'tambahkan pemberitahuan', '通知を追加', '통지를 추가'),
(182, 'edit_noticeboard', 'edit noticeboard', 'সম্পাদনা নোটিশবোর্ড', 'edit tablón de anuncios', 'تحرير اللافتة', 'bewerk prikbord', 'править доска для объявлений', '编辑布告', 'edit noticeboard', 'edição de avisos', 'szerkesztés üzenőfalán', 'modifier panneau d\'affichage', 'edit ανακοινώσεων', 'Brett bearbeiten', 'modifica bacheca', 'แก้ไขป้ายประกาศ', 'میں ترمیم کریں noticeboard', 'संपादित Noticeboard', 'edit noticeboard', 'mengedit pengumuman', '編集伝言板', '편집의 noticeboard'),
(183, 'system_name', 'system name', 'সিস্টেমের নাম', 'Nombre del sistema', 'اسم النظام', 'Name System', 'Имя системы', '系统名称', 'sistemi adı', 'nome do sistema', 'rendszer neve', 'nom du système', 'όνομα του συστήματος', 'Systemnamen', 'nome del sistema', 'ชื่อระบบ', 'نظام کا نام', 'सिस्टम नाम', 'ratio nominis', 'Nama sistem', 'システム名', '시스템 이름'),
(184, 'save', 'save', 'রক্ষা', 'guardar', 'حفظ', 'besparen', 'экономить', '节省', 'kurtarmak', 'salvar', 'kivéve', 'sauver', 'εκτός', 'sparen', 'salvare', 'ประหยัด', 'کو بچانے کے', 'बचाना', 'salvum', 'menyimpan', '保存', '저장'),
(185, 'system_title', 'system title', 'সিস্টেম শিরোনাম', 'Título de sistema', 'عنوان النظام', 'systeem titel', 'Название системы', '系统标题', 'Sistem başlık', 'título sistema', 'rendszer cím', 'titre du système', 'Τίτλος του συστήματος', 'System-Titel', 'titolo di sistema', 'ชื่อระบบ', 'نظام عنوان', 'सिस्टम शीर्षक', 'ratio title', 'title sistem', 'システムのタイトル', '시스템 제목'),
(186, 'paypal_email', 'paypal email', 'PayPal ইমেইল', 'paypal email', 'باي بال البريد الإلكتروني', 'paypal e-mail', 'PayPal по электронной почте', 'PayPal电子邮件', 'paypal e-posta', 'paypal e-mail', 'paypal email', 'paypal email', 'paypal ηλεκτρονικό ταχυδρομείο', 'paypal E-Mail', 'paypal-mail', 'paypal อีเมล์', 'پے پال ای میل', 'पेपैल ईमेल', 'Paypal email', 'email paypal', 'Paypalのメール', '페이팔 이메일'),
(187, 'currency', 'currency', 'মুদ্রা', 'moneda', 'عملة', 'valuta', 'валюта', '货币', 'para', 'moeda', 'valuta', 'monnaie', 'νόμισμα', 'Währung', 'valuta', 'เงินตรา', 'کرنسی', 'मुद्रा', 'currency', 'mata uang', '通貨', '통화'),
(188, 'phrase_list', 'phrase list', 'ফ্রেজ তালিকা', 'lista de frases', 'قائمة جملة', 'zinnenlijst', 'Список фраза', '短语列表', 'ifade listesi', 'lista de frases', 'kifejezés lista', 'liste de phrase', 'Λίστα φράση', 'Phrasenliste', 'elenco frasi', 'รายการวลี', 'جملہ فہرست', 'वाक्यांश सूची', 'dicitur album', 'Daftar frase', 'フレーズリスト', '문구 목록'),
(189, 'add_phrase', 'add phrase', 'শব্দগুচ্ছ যুক্ত', 'añadir la frase', 'إضافة عبارة', 'voeg zin', 'добавить фразу', '添加词组', 'ifade eklemek', 'adicionar frase', 'adjunk kifejezést', 'ajouter la phrase', 'προσθέστε φράση', 'Begriff hinzufügen', 'aggiungere la frase', 'เพิ่มวลี', 'جملہ شامل', 'वाक्यांश जोड़ना', 'addere phrase', 'menambahkan frase', 'フレーズを追加', '문구를 추가'),
(190, 'add_language', 'add language', 'ভাষা যুক্ত', 'añadir idioma', 'إضافة لغة', 'add taal', 'добавить язык', '新增语言', 'dil ekle', 'adicionar língua', 'nyelv hozzáadása', 'ajouter la langue', 'προσθέστε γλώσσα', 'Sprache hinzufügen', 'aggiungere la lingua', 'เพิ่มภาษา', 'زبان کو شامل', 'भाषा जोड़ना', 'addere verbis', 'menambahkan bahasa', '言語を追加', '언어를 추가'),
(191, 'phrase', 'phrase', 'বাক্য', 'frase', 'العبارة', 'frase', 'фраза', '短语', 'ifade', 'frase', 'kifejezés', 'phrase', 'φράση', 'Ausdruck', 'frase', 'วลี', 'جملہ', 'वाक्यांश', 'phrase', 'frasa', 'フレーズ', '구'),
(192, 'manage_backup_restore', 'manage backup restore', 'ব্যাকআপ পুনঃস্থাপন ও পরিচালনা', 'gestionar copias de seguridad a restaurar', 'إدارة استعادة النسخ الاحتياطي', 'beheer van back-up herstellen', 'управлять восстановить резервного копирования', '管理备份恢复', 'yedekleme geri yönetmek', 'gerenciar o backup de restauração', 'kezelni a biztonsági mentés visszaállítása', 'gérer de restauration de sauvegarde', 'διαχείριση επαναφοράς αντιγράφων ασφαλείας', 'verwalten Backup wiederherstellen', 'gestire il ripristino di backup', 'จัดการการสำรองข้อมูลเรียกคืน', 'بیک اپ بحال انتظام', 'बैकअप बहाल का प्रबंधन', 'curo tergum restituunt', 'mengelola backup restore', 'バックアップ、リストアを管理', '백업 복원 관리'),
(193, 'restore', 'restore', 'প্রত্যর্পণ করা', 'restaurar', 'استعادة', 'herstellen', 'восстановление', '恢复', 'geri', 'restaurar', 'visszaad', 'restaurer', 'επαναφέρετε', 'wiederherstellen', 'ripristinare', 'ฟื้นฟู', 'بحال', 'बहाल', 'reddite', 'mengembalikan', '復元する', '복원'),
(194, 'mark', 'mark', 'ছাপ', 'marca', 'علامة', 'mark', 'знак', '标志', 'işaret', 'marca', 'jel', 'marque', 'σημάδι', 'Marke', 'marchio', 'เครื่องหมาย', 'نشان', 'निशान', 'Marcus', 'tanda', 'マーク', '표'),
(195, 'grade', 'grade', 'গ্রেড', 'grado', 'درجة', 'graad', 'класс', '等级', 'sınıf', 'grau', 'fokozat', 'grade', 'βαθμός', 'Klasse', 'grado', 'เกรด', 'گریڈ', 'ग्रेड', 'gradus,', 'kelas', 'グレード', '학년'),
(196, 'invoice', 'invoice', 'চালান', 'factura', 'فاتورة', 'factuur', 'счет-фактура', '发票', 'fatura', 'fatura', 'számla', 'facture', 'τιμολόγιο', 'Rechnung', 'fattura', 'ใบกำกับสินค้า', 'انوائس', 'बीजक', 'cautionem', 'faktur', 'インボイス', '송장'),
(197, 'book', 'book', 'বই', 'libro', 'كتاب', 'boek', 'книга', '书', 'kitap', 'livro', 'könyv', 'livre', 'βιβλίο', 'Buch', 'libro', 'หนังสือ', 'کتاب', 'किताब', 'Liber', 'buku', '本', '책'),
(198, 'all', 'all', 'সব', 'todo', 'كل', 'alle', 'все', '所有', 'tüm', 'tudo', 'minden', 'tout', 'όλα', 'alle', 'tutto', 'ทั้งหมด', 'تمام', 'सब', 'omnes', 'semua', 'すべて', '모든'),
(199, 'upload_&_restore_from_backup', 'upload &amp; restore from backup', 'আপলোড &amp; ব্যাকআপ থেকে পুনঃস্থাপন', 'cargar y restaurar copia de seguridad', 'تحميل واستعادة من النسخة الاحتياطية', 'uploaden en terugzetten van een backup', 'загрузить и восстановить из резервной копии', '上传及从备份中恢复', 'yükleyebilir ve yedekten geri yükleme', 'fazer upload e restauração de backup', 'feltölteni és visszaállítani backup', 'télécharger et restauration de la sauvegarde', 'ανεβάσετε και επαναφορά από backup', 'Upload &amp; Wiederherstellung von Backups', 'caricare e ripristinare dal backup', 'อัปโหลดและเรียกคืนจากการสำรองข้อมูล', 'اپ لوڈ کریں اور بیک اپ سے بحال', 'अपलोड और बैकअप से बहाल', 'restituo ex tergum upload,', 'meng-upload &amp; restore dari backup', 'アップロード＆バックアップから復元', '업로드 및 백업에서 복원'),
(200, 'manage_profile', 'manage profile', 'প্রফাইলটি পরিচালনা', 'gestionar el perfil', 'إدارة الملف الشخصي', 'te beheren!', 'управлять профилем', '管理配置文件', 'profilini yönetmek', 'gerenciar o perfil', 'Profil kezelése', 'gérer le profil', 'διαχειριστείτε το προφίλ', 'Profil verwalten', 'gestire il profilo', 'จัดการรายละเอียด', 'پروفائل کا نظم کریں', 'प्रोफाइल का प्रबंधन', 'curo profile', 'mengelola profil', 'プロファイル（個人情報）の管理', '프로필 (내 정보) 관리'),
(201, 'update_profile', 'update profile', 'প্রোফাইল আপডেট', 'actualizar el perfil', 'تحديث الملف الشخصي', 'Profiel bijwerken', 'обновить профиль', '更新个人资料', 'profilinizi güncelleyin', 'atualizar o perfil', 'frissíteni profil', 'mettre à jour le profil', 'ενημερώσετε το προφίλ', 'Profil aktualisieren', 'aggiornare il profilo', 'อัปเดตโปรไฟล์', 'پروفائل کو اپ ڈیٹ', 'प्रोफ़ाइल अपडेट', 'magna eget ipsum', 'memperbarui profil', 'プロファイルを更新', '프로필을 업데이트'),
(202, 'new_password', 'new password', 'নতুন পাসওয়ার্ড', 'nueva contraseña', 'كلمة مرور جديدة', 'nieuw wachtwoord', 'новый пароль', '新密码', 'Yeni şifre', 'nova senha', 'Új jelszó', 'nouveau mot de passe', 'νέο κωδικό', 'Neues Passwort', 'nuova password', 'รหัสผ่านใหม่', 'نیا پاس ورڈ', 'नया पासवर्ड', 'novum password', 'kata sandi baru', '新しいパスワード', '새 암호'),
(203, 'confirm_new_password', 'confirm new password', 'নতুন পাসওয়ার্ড নিশ্চিত করুন', 'confirmar nueva contraseña', 'تأكيد كلمة المرور الجديدة', 'Bevestig nieuw wachtwoord', 'подтвердить новый пароль', '确认新密码', 'yeni parolayı onaylayın', 'confirmar nova senha', 'erősítse meg az új jelszót', 'confirmer le nouveau mot de passe', 'επιβεβαιώσετε το νέο κωδικό', 'Bestätigen eines neuen Kennwortes', 'conferma la nuova password', 'ยืนยันรหัสผ่านใหม่', 'نئے پاس ورڈ کی توثیق', 'नए पासवर्ड की पुष्टि', 'confirma novum password', 'konfirmasi password baru', '新しいパスワードを確認', '새 암호를 확인합니다'),
(204, 'update_password', 'update password', 'পাসওয়ার্ড আপডেট', 'actualizar la contraseña', 'تحديث كلمة السر', 'updaten wachtwoord', 'обновить пароль', '更新密码', 'Parolanızı güncellemek', 'atualizar senha', 'frissíti jelszó', 'mettre à jour le mot de passe', 'ενημερώσετε τον κωδικό πρόσβασης', 'Kennwort aktualisieren', 'aggiornare la password', 'ปรับปรุงรหัสผ่าน', 'پاس اپ ڈیٹ', 'पासवर्ड अद्यतन', 'scelerisque eget', 'memperbarui sandi', 'パスワードを更新', '암호를 업데이트'),
(205, 'teacher_dashboard', 'teacher dashboard', 'শিক্ষক ড্যাশবোর্ড', 'tablero maestro', 'لوحة أجهزة القياس المعلم', 'leraar dashboard', 'учитель приборной панели', '老师仪表板', 'öğretmen pano', 'dashboard professor', 'tanár műszerfal', 'enseignant tableau de bord', 'ταμπλό των εκπαιδευτικών', 'Lehrer-Dashboard', 'dashboard insegnante', 'กระดานครู', 'استاد ڈیش بورڈ', 'शिक्षक डैशबोर्ड', 'magister Dashboard', 'dashboard guru', '教師のダッシュボード', '교사 대시 보드'),
(206, 'backup_restore_help', 'backup restore help', 'ব্যাকআপ পুনঃস্থাপন সাহায্য', 'copia de seguridad restaurar ayuda', 'استعادة النسخ الاحتياطي المساعدة', 'backup helpen herstellen', 'восстановить резервную копию помощь', '备份恢复的帮助', 'yedekleme yardım geri', 'de backup restaurar ajuda', 'Backup Restore segítségével', 'restauration de sauvegarde de l\'aide', 'επαναφοράς αντιγράφων ασφαλείας βοήθεια', 'Backup wiederherstellen Hilfe', 'Backup Restore aiuto', 'การสำรองข้อมูลเรียกคืนความช่วยเหลือ', 'بیک اپ کی مدد بحال', 'बैकअप मदद बहाल', 'auxilium tergum restituunt', 'backup restore bantuan', 'バックアップヘルプを復元', '백업 도움을 복원'),
(207, 'student_dashboard', 'student dashboard', 'ছাত্র ড্যাশবোর্ড', 'salpicadero estudiante', 'لوحة القيادة الطلابية', 'student dashboard', 'студент приборной панели', '学生的仪表板', 'Öğrenci paneli', 'dashboard estudante', 'tanuló műszerfal', 'tableau de bord de l\'élève', 'ταμπλό των φοιτητών', 'Schüler Armaturenbrett', 'studente dashboard', 'แผงควบคุมนักเรียน', 'طالب علم کے ڈیش بورڈ', 'छात्र डैशबोर्ड', 'Discipulus Dashboard', 'dashboard mahasiswa', '学生のダッシュボード', '학생 대시 보드'),
(208, 'parent_dashboard', 'parent dashboard', 'অভিভাবক ড্যাশবোর্ড', 'salpicadero padres', 'لوحة أجهزة القياس الأم', 'ouder dashboard', 'родитель приборной панели', '家长仪表板', 'ebeveyn kontrol paneli', 'dashboard pai', 'szülő műszerfal', 'parent tableau de bord', 'μητρική ταμπλό', 'Mutter Armaturenbrett', 'dashboard genitore', 'แผงควบคุมของผู้ปกครอง', 'والدین کے ڈیش بورڈ', 'माता - पिता डैशबोर्ड', 'Dashboard parent', 'orangtua dashboard', '親ダッシュ', '부모 대시 보드'),
(209, 'view_marks', 'view marks', 'দেখুন চিহ্ন', 'Vista marcas', 'علامات رأي', 'view merken', 'вид знаки', '鉴于商标', 'görünümü işaretleri', 'vista marcas', 'view jelek', 'Vue marques', 'σήματα άποψη', 'Ansicht Marken', 'Vista marchi', 'เครื่องหมายมุมมอง', 'دیکھیں نشانات', 'देखने के निशान', 'propter signa', 'lihat tanda', 'ビューマーク', '보기 마크'),
(210, 'delete_language', 'delete language', 'ভাষা মুছতে', 'eliminar el lenguaje', 'حذف اللغة', 'verwijderen taal', 'удалить язык', '删除语言', 'dili silme', 'excluir língua', 'törlése nyelv', 'supprimer la langue', 'διαγραφή γλώσσα', 'Sprache löschen', 'eliminare lingua', 'ลบภาษา', 'زبان کو خارج کر دیں', 'भाषा को हटाना', 'linguam turpis', 'menghapus bahasa', '言語を削除する', '언어를 삭제'),
(211, 'settings_updated', 'settings updated', 'সেটিংস আপডেট', 'configuración actualizado', 'الإعدادات المحدثة', 'instellingen bijgewerkt', 'Настройки обновлены', '设置更新', 'ayarları güncellendi', 'definições atualizadas', 'beállítások frissítve', 'paramètres mis à jour', 'Ρυθμίσεις ενημέρωση', 'Einstellungen aktualisiert', 'impostazioni aggiornate', 'การตั้งค่าการปรับปรุง', 'ترتیبات کی تازہ کاری', 'सेटिंग्स अद्यतन', 'venenatis eu', 'pengaturan diperbarui', '設定が更新', '설정이 업데이트'),
(212, 'update_phrase', 'update phrase', 'আপডেট ফ্রেজ', 'actualización de la frase', 'تحديث العبارة', 'Update zin', 'обновление фраза', '更新短语', 'güncelleme ifade', 'atualização frase', 'frissítést kifejezés', 'mise à jour phrase', 'ενημέρωση φράση', 'Update Begriff', 'aggiornamento frase', 'ปรับปรุงวลี', 'اپ ڈیٹ جملہ', 'अद्यतन वाक्यांश', 'eget dictum', 'frase pembaruan', '更新フレーズ', '업데이트 구문'),
(213, 'login_failed', 'login failed', 'লগইন ব্যর্থ হয়েছে', 'Error de acceso', 'فشل تسجيل الدخول', 'inloggen is mislukt', 'Ошибка входа', '登录失败', 'giriş başarısız oldu', 'Falha no login', 'bejelentkezés sikertelen', 'Échec de la connexion', 'Είσοδος απέτυχε', 'Fehler bei der Anmeldung', 'Accesso non riuscito', 'เข้าสู่ระบบล้มเหลว', 'لاگ ان ناکام', 'लॉगिन विफल', 'tincidunt defecit', 'Login gagal', 'ログインに失敗しました', '로그인 실패'),
(214, 'live_chat', 'live chat', 'লাইভ চ্যাট', 'chat en vivo', 'الدردشة الحية', 'live chat', 'Онлайн-чат', '即时聊天', 'canlı sohbet', 'chat ao vivo', 'élő chat', 'chat en direct', 'live chat', 'Live-Chat', 'live chat', 'อยู่สนทนา', 'لائیو چیٹ', 'लाइव चैट', 'Vivamus nibh', 'live chat', 'ライブチャット', '라이브 채팅'),
(215, 'client 1', 'client 1', 'ক্লায়েন্টের 1', 'cliente 1', 'العميل 1', 'client 1', 'Клиент 1', '客户端1', 'istemcisi 1', 'cliente 1', 'ügyfél 1', 'client 1', 'πελάτη 1', 'Client 1', 'client 1', 'ลูกค้า 1', 'کلائنٹ 1', 'ग्राहक 1', 'I huius', 'client 1', 'クライアント1', '클라이언트 1'),
(216, 'buyer', 'buyer', 'ক্রেতা', 'comprador', 'مشتر', 'koper', 'покупатель', '买方', 'alıcı', 'comprador', 'vevő', 'acheteur', 'αγοραστής', 'Käufer', 'compratore', 'ผู้ซื้อ', 'خریدار', 'खरीददार', 'qui emit,', 'pembeli', 'バイヤー', '구매자'),
(217, 'purchase_code', 'purchase code', 'ক্রয় কোড', 'código de compra', 'كود الشراء', 'aankoop code', 'покупка код', '申购代码', 'satın alma kodu', 'código de compra', 'vásárlási kódot', 'code d\'achat', 'Κωδικός αγορά', 'Kauf-Code', 'codice di acquisto', 'รหัสการสั่งซื้อ', 'خریداری کے کوڈ', 'खरीद कोड', 'Mauris euismod', 'kode pembelian', '購入コード', '구매 코드'),
(218, 'system_email', 'system email', 'সিস্টেম ইমেইল', 'correo electrónico del sistema', 'نظام البريد الإلكتروني', 'systeem e-mail', 'система электронной почты', '邮件系统', 'sistem e-posta', 'e-mail do sistema', 'a rendszer az e-mail', 'email de système', 'e-mail συστήματος', 'E-Mail-System', 'email sistema', 'อีเมล์ระบบ', 'نظام کی ای میل', 'प्रणाली ईमेल', 'Praesent sit amet', 'email sistem', 'システムの電子メール', '시스템 전자 메일'),
(219, 'option', 'option', 'বিকল্প', 'opción', 'خيار', 'optie', 'вариант', '选项', 'seçenek', 'opção', 'opció', 'option', 'επιλογή', 'Option', 'opzione', 'ตัวเลือกที่', 'آپشن', 'विकल्प', 'optio', 'pilihan', 'オプション', '선택권'),
(220, 'edit_phrase', 'edit phrase', 'সম্পাদনা ফ্রেজ', 'edit frase', 'تحرير العبارة', 'bewerk zin', 'править фраза', '编辑语', 'edit ifade', 'edição frase', 'szerkesztés kifejezés', 'modifier phrase', 'edit φράση', 'edit Begriff', 'modifica frase', 'แก้ไขวลี', 'ترمیم کے جملہ', 'संपादित वाक्यांश', 'edit phrase', 'mengedit frase', '編集フレーズ', '편집 구');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `account_title` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `mobile_no` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_type` int(2) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `is_enable` int(1) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `last_action` datetime NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `account_title`, `username`, `password`, `mobile_no`, `email`, `country_id`, `city_id`, `project_id`, `user_type`, `ip_address`, `is_enable`, `last_login`, `last_logout`, `last_action`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'Super Admin', 'superadmin', '9efc81da9e4a0de3a1f1d067caf4ef3a4c8e184c447b71f00401dc070db6b98760a00cbae72ff516f0953ea0b1216b6e1115a58f435f49c1cfb8e58ea734be03', '03131234567', 'info@webxzone.com', 0, 0, 0, 1, '::1', 1, '2021-10-13 14:37:53', '2021-10-13 15:05:53', '0000-00-00 00:00:00', '2016-11-26 00:00:00', 1, '2021-03-05 00:35:37', '1'),
(2, 'User', 'khan', 'bc2437b0a2d54c5d8a433ef01ede4efb0069bcd2e97edc37098ff68add1f19aa33f06d7e53bf76a4dda6ac230b8ca19ed2d50ccd96903fef0c537e62e449050a', '0900-1234567', 'khan@gmail.com', 1, 1, 1, 2, '::1', 1, '2017-12-24 00:10:38', '2017-12-24 00:18:24', '0000-00-00 00:00:00', '2017-12-21 19:12:03', 1, '2018-01-17 12:55:19', '1'),
(3, 'User', 'jamal', 'bc2437b0a2d54c5d8a433ef01ede4efb0069bcd2e97edc37098ff68add1f19aa33f06d7e53bf76a4dda6ac230b8ca19ed2d50ccd96903fef0c537e62e449050a', '09000000', 'jamal@gmail.com', 1, 1, 1, 2, '::1', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-01-17 11:41:01', 1, '2018-01-17 12:56:40', '1');

-- --------------------------------------------------------

--
-- Table structure for table `logo_list`
--

CREATE TABLE `logo_list` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `logo_image` text NOT NULL,
  `show_title` int(1) DEFAULT NULL,
  `show_logo` int(1) DEFAULT NULL,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logo_list`
--

INSERT INTO `logo_list` (`id`, `title`, `logo_image`, `show_title`, `show_logo`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'Online Shopping', 'logo_15008225871.jpg', 1, 1, 1, '2017-03-31 00:00:00', 1, '2017-07-23 20:09:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_history_list`
--

CREATE TABLE `order_history_list` (
  `id` int(11) NOT NULL,
  `order_track` int(10) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `order_status` varchar(100) NOT NULL,
  `order_info` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(100) DEFAULT NULL,
  `discount_price` varchar(100) NOT NULL DEFAULT '0',
  `total_price` varchar(200) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `payment_mode` varchar(200) DEFAULT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `is_enable` int(11) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `order_code`, `discount_price`, `total_price`, `order_date`, `payment_mode`, `order_status`, `user_id`, `user_type`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'BUY-1-131117', '0', '185000', '2017-11-13', 'cash', NULL, 1, 'buyer', 1, '2017-11-13 15:09:13', 1, NULL, NULL),
(2, 'BUY-2-131117', '0', '37500', '2017-11-13', 'cash', NULL, 2, 'buyer', 1, '2017-11-13 15:23:52', 1, NULL, NULL),
(3, 'ORD-3-131117', '0', '73800', '2017-11-13', 'cash', NULL, 3, 'seller', 1, '2017-11-13 15:37:36', 1, NULL, NULL),
(4, 'ORD-4-131117', '0', '19200', '2017-11-13', 'cash', NULL, 4, 'seller', 1, '2017-11-13 19:49:44', 1, NULL, NULL),
(5, 'BUY-5-141117', '0', '26000', '2017-11-14', 'cash', NULL, 5, 'buyer', 1, '2017-11-14 20:39:14', 1, NULL, NULL),
(6, 'ORD-6-141117', '0', '53300', '2017-11-14', 'cash', NULL, 3, 'seller', 1, '2017-11-14 20:40:19', 1, NULL, NULL),
(7, 'ORD-7-161117', '0', '12700', '2017-11-16', 'cash', NULL, 6, 'seller', 1, '2017-11-16 20:17:56', 1, NULL, NULL),
(8, 'ORD-8-161117', '0', '16000', '2017-11-16', 'cash', NULL, 4, 'seller', 1, '2017-11-16 20:21:55', 1, NULL, NULL),
(9, 'ORD-9-161117', '0', '14500', '2017-11-16', 'cash', NULL, 7, 'seller', 1, '2017-11-16 20:25:11', 1, NULL, NULL),
(10, 'ORD-10-171117', '0', '31100', '2017-11-17', 'cash', NULL, 8, 'seller', 1, '2017-11-17 21:00:37', 1, NULL, NULL),
(11, 'BUY-11-171117', '0', '23500', '2017-11-17', 'cash', NULL, 9, 'buyer', 1, '2017-11-17 21:14:49', 1, NULL, NULL),
(12, 'ORD-12-171117', '0', '25100', '2017-11-17', 'cash', NULL, 3, 'seller', 1, '2017-11-17 21:15:51', 1, NULL, NULL),
(13, 'BUY-13-181117', '0', '120000', '2017-11-18', 'cash', NULL, 10, 'buyer', 1, '2017-11-18 19:49:30', 1, NULL, NULL),
(14, 'ORD-14-181117', '0', '13500', '2017-11-18', 'cash', NULL, 11, 'seller', 1, '2017-11-18 20:20:41', 1, NULL, NULL),
(15, 'ORD-15-201117', '0', '23100', '2017-11-20', 'cash', NULL, 8, 'seller', 1, '2017-11-20 18:48:12', 1, NULL, NULL),
(16, 'ORD-16-201117', '0', '30300', '2017-11-20', 'cash', NULL, 12, 'seller', 1, '2017-11-20 19:48:54', 1, NULL, NULL),
(17, 'BUY-17-201117', '0', '42000', '2017-11-20', 'cash', NULL, 1, 'buyer', 1, '2017-11-20 21:30:02', 1, NULL, NULL),
(18, 'BUY-18-201117', '0', '46800', '2017-11-20', 'cash', NULL, 13, 'buyer', 1, '2017-11-20 21:31:14', 1, NULL, NULL),
(19, 'ORD-19-211117', '0', '13700', '2017-11-21', 'cash', NULL, 14, 'seller', 1, '2017-11-21 17:07:19', 1, NULL, NULL),
(20, 'ORD-20-211117', '0', '12000', '2017-11-21', 'cash', NULL, 15, 'seller', 1, '2017-11-21 17:09:18', 1, NULL, NULL),
(21, 'ORD-21-211117', '0', '91400', '2017-11-21', 'cash', NULL, 16, 'seller', 1, '2017-11-21 17:16:37', 1, NULL, NULL),
(22, 'BUY-22-211117', '0', '16000', '2017-11-21', 'cash', NULL, 10, 'buyer', 1, '2017-11-21 19:03:41', 1, NULL, NULL),
(23, 'ORD-23-211117', '0', '8000', '2017-11-21', 'cash', NULL, 17, 'seller', 1, '2017-11-21 19:04:39', 1, NULL, NULL),
(24, 'BUY-24-211117', '0', '70000', '2017-11-21', 'cash', NULL, 1, 'buyer', 1, '2017-11-21 21:19:03', 1, NULL, NULL),
(25, 'ORD-25-211117', '0', '30600', '2017-11-21', 'cash', NULL, 8, 'seller', 1, '2017-11-21 21:24:05', 1, NULL, NULL),
(26, 'ORD-26-211117', '0', '66300', '2017-11-21', 'cash', NULL, 18, 'seller', 1, '2017-11-21 21:35:33', 1, NULL, NULL),
(27, 'ORD-27-211117', '0', '68100', '2017-11-21', 'cash', NULL, 3, 'seller', 1, '2017-11-21 21:48:27', 1, NULL, NULL),
(28, 'BUY-28-211117', '0', '9700', '2017-11-21', 'cash', NULL, 1, 'buyer', 1, '2017-11-21 21:55:47', 1, NULL, NULL),
(29, 'ORD-29-211117', '0', '10400', '2017-11-21', 'cash', NULL, 19, 'seller', 1, '2017-11-21 21:56:41', 1, NULL, NULL),
(30, 'BUY-30-241117', '0', '400000', '2017-11-24', 'cash', NULL, 20, 'buyer', 1, '2017-11-24 20:58:57', 1, NULL, NULL),
(31, 'ORD-31-241117', '0', '111500', '2017-11-24', 'cash', NULL, 18, 'seller', 1, '2017-11-24 21:55:27', 1, NULL, NULL),
(32, 'ORD-32-241117', '0', '64600', '2017-11-24', 'cash', NULL, 21, 'seller', 1, '2017-11-24 22:03:53', 1, NULL, NULL),
(33, 'ORD-33-281117', '0', '168200', '2017-11-28', 'cash', NULL, 16, 'seller', 1, '2017-11-28 17:56:25', 1, NULL, NULL),
(34, 'ORD-34-281117', '0', '43100', '2017-11-28', 'cash', NULL, 8, 'seller', 1, '2017-11-28 18:55:04', 1, NULL, NULL),
(35, 'BUY-35-291117', '0', '50000', '2017-11-29', 'cash', NULL, 10, 'buyer', 1, '2017-11-29 16:20:56', 1, NULL, NULL),
(36, 'ORD-36-291117', '0', '27500', '2017-11-29', 'cash', NULL, 15, 'seller', 1, '2017-11-29 16:22:11', 1, NULL, NULL),
(37, 'ORD-37-291117', '0', '8000', '2017-11-29', 'cash', NULL, 15, 'seller', 1, '2017-11-29 20:01:38', 1, NULL, NULL),
(38, 'BUY-38-291117', '0', '52000', '2017-11-29', 'cash', NULL, 10, 'buyer', 1, '2017-11-29 20:06:15', 1, NULL, NULL),
(39, 'ORD-39-291117', '0', '29500', '2017-11-29', 'cash', NULL, 4, 'seller', 1, '2017-11-29 20:10:10', 1, NULL, NULL),
(40, 'ORD-40-291117', '0', '21700', '2017-11-29', 'cash', NULL, 18, 'seller', 1, '2017-11-29 21:31:23', 1, NULL, NULL),
(41, 'BUY-41-011217', '0', '148500', '2017-12-01', 'cash', NULL, 1, 'buyer', 1, '2017-12-01 03:59:38', 1, NULL, NULL),
(42, 'ORD-42-021217', '0', '15000', '2017-12-02', 'cash', NULL, 15, 'seller', 1, '2017-12-02 18:09:05', 1, NULL, NULL),
(43, 'ORD-43-021217', '0', '16000', '2017-12-02', 'cash', NULL, 15, 'seller', 1, '2017-12-02 18:11:33', 1, NULL, NULL),
(44, 'ORD-44-041217', '0', '13000', '2017-12-04', 'cash', NULL, 15, 'seller', 1, '2017-12-04 21:45:10', 1, NULL, NULL),
(45, 'ORD-45-041217', '0', '34300', '2017-12-04', 'cash', NULL, 22, 'seller', 1, '2017-12-04 21:46:29', 1, NULL, NULL),
(46, 'ORD-46-041217', '0', '45700', '2017-12-04', 'cash', NULL, 3, 'seller', 1, '2017-12-04 21:51:57', 1, NULL, NULL),
(47, 'BUY-47-051217', '0', '588100', '2017-12-05', 'cash', NULL, 23, 'buyer', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(48, 'ORD-48-061217', '0', '30000', '2017-12-06', 'cash', NULL, 24, 'seller', 1, '2017-12-06 17:10:59', 1, NULL, NULL),
(49, 'ORD-49-061217', '0', '13000', '2017-12-06', 'cash', NULL, 15, 'seller', 1, '2017-12-06 17:14:25', 1, NULL, NULL),
(50, 'ORD-50-061217', '0', '22500', '2017-12-06', 'cash', NULL, 14, 'seller', 1, '2017-12-06 20:37:49', 1, NULL, NULL),
(51, 'ORD-51-061217', '0', '36100', '2017-12-06', 'cash', NULL, 25, 'seller', 1, '2017-12-06 21:06:55', 1, NULL, NULL),
(52, 'ORD-52-061217', '0', '25300', '2017-12-06', 'cash', NULL, 26, 'seller', 1, '2017-12-06 21:16:45', 1, NULL, NULL),
(53, 'ORD-53-081217', '2000', '20000', '2017-12-08', 'cash', NULL, 27, 'seller', 1, '2017-12-08 05:25:18', 1, NULL, NULL),
(54, 'ORD-54-081217', '0', '7000', '2017-12-08', 'cash', NULL, 27, 'seller', 1, '2017-12-08 05:49:18', 1, NULL, NULL),
(55, 'BUY-55-081217', '200', '1000', '2017-12-08', 'cash', NULL, 28, 'buyer', 1, '2017-12-08 05:59:09', 1, NULL, NULL),
(56, 'BUY-56-081217', '100', '1100', '2017-12-08', 'cash', NULL, 29, 'buyer', 1, '2017-12-08 06:01:53', 1, NULL, NULL),
(57, 'ORD-57-081217', '100', '20', '2017-12-08', 'cash', NULL, 30, 'seller', 1, '2017-12-08 08:10:17', 1, NULL, NULL),
(58, 'BUY-58-081217', '200', '2200', '2017-12-08', 'cash', NULL, 31, 'buyer', 1, '2017-12-08 08:39:27', 1, NULL, NULL),
(59, 'ORD-59-081217', '0', '0', '2017-12-08', 'cash', NULL, 32, 'seller', 1, '2017-12-08 08:42:33', 1, NULL, NULL),
(60, 'ORD-60-081217', '0', '0', '2017-12-08', 'cash', NULL, 33, 'seller', 1, '2017-12-08 08:42:42', 1, NULL, NULL),
(61, 'BUY-61-081217', '100', '2300', '2017-12-08', 'cash', NULL, 34, 'buyer', 1, '2017-12-08 08:51:18', 1, NULL, NULL),
(65, 'ORD-62-091217', '600', '9000', '2017-12-09', 'cash', NULL, 36, 'seller', 1, '2017-12-09 00:56:41', 1, NULL, NULL),
(66, 'ORD-66-091217', '0', '6500', '2017-12-09', 'cash', NULL, 36, 'seller', 1, '2017-12-09 00:58:57', 1, NULL, NULL),
(67, 'ORD-67-091217', '0', '1300', '2017-12-09', 'cash', NULL, 36, 'seller', 1, '2017-12-09 01:02:05', 1, NULL, NULL),
(68, 'ORD-68-091217', '600', '2000', '2017-12-09', 'cash', NULL, 37, 'seller', 1, '2017-12-09 01:04:26', 1, NULL, NULL),
(69, 'ORD-69-091217', '600', '2000', '2017-12-09', 'cash', NULL, 38, 'seller', 1, '2017-12-09 01:04:49', 1, NULL, NULL),
(70, 'ORD-70-091217', '0', '8000', '2017-12-09', 'cash', NULL, 38, 'seller', 1, '2017-12-09 01:05:57', 1, NULL, NULL),
(71, 'BUY-71-091217', '5000', '55000', '2017-12-09', 'cash', NULL, 39, 'buyer', 1, '2017-12-09 01:15:02', 1, NULL, NULL),
(72, 'BUY-72-091217', '2000', '40000', '2017-12-09', 'cash', NULL, 39, 'buyer', 1, '2017-12-09 01:17:43', 1, NULL, NULL),
(73, 'BUY-73-091217', '0', '40000', '2017-12-09', 'cash', NULL, 39, 'buyer', 1, '2017-12-09 01:20:10', 1, NULL, NULL),
(74, 'BUY-74-091217', '1000', '20000', '2017-12-09', 'cash', NULL, 39, 'buyer', 1, '2017-12-09 01:22:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages_list`
--

CREATE TABLE `pages_list` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(100) NOT NULL,
  `pages_image` text NOT NULL,
  `short_description` text,
  `long_description` text,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages_list`
--

INSERT INTO `pages_list` (`id`, `page_name`, `title`, `sub_title`, `pages_image`, `short_description`, `long_description`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'About Us', 'About Us1', 'About Us', '', 'All types of computer & laptop with top brand & trands are available in affordable price.', 'All types of computer & laptop with top brand & trands are available in affordable price.\r\nAll types of computer & laptop with top brand & trands are available in affordable price.\r\n\r\n\r\n\r\n\r\nAll types of computer & laptop with top brand & trands are available in affordable price.\r\n\r\n\r\n\r\n\r\n\r\nAll types of computer & laptop with top brand & trands are available in affordable price.', 1, '2017-11-08 00:00:00', 1, '2017-12-08 07:41:42', '1'),
(4, 'Facebook', 'Facebook', 'facebook', '', '#', '#', 1, '2017-11-08 09:00:39', 1, '2017-12-08 04:47:13', '1'),
(5, 'Twitter', 'Twitter', 'Twitter', '', '#', '#', 1, '2017-11-08 09:01:15', 1, '2017-11-08 09:02:05', '1'),
(6, 'Gmail', 'Gmail', 'Gmail', '', '#', '#', 1, '2017-11-08 09:01:25', 1, '2017-11-08 09:02:02', '1'),
(7, 'Linkedin', 'Linkedin', 'Linkedin', '', '#', '#', 1, '2017-11-08 09:01:40', 1, '2017-11-08 09:02:03', '1'),
(8, 'Skype', 'Skype', 'Skype', '', '#', '#', 1, '2017-11-08 09:01:52', 1, '2017-11-08 09:02:04', '1');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--

CREATE TABLE `payment_list` (
  `payment_id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `slip_no` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `order_code` varchar(100) DEFAULT NULL,
  `paid_price` varchar(30) NOT NULL,
  `old_paid_price` varchar(30) DEFAULT NULL,
  `remaining_price` varchar(30) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `is_enable` int(11) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`payment_id`, `user_id`, `slip_no`, `user_type`, `order_id`, `order_code`, `paid_price`, `old_paid_price`, `remaining_price`, `payment_date`, `payment_mode`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '1', '3249', 'buyer', '1', 'BUY-1-131117', '0', '0', '0', '2017-11-13', 'cash', 1, '2017-11-13 15:09:13', 1, NULL, NULL),
(2, '2', '2378', 'buyer', '2', 'BUY-2-131117', '0', '0', '37500', '2017-11-13', 'cash', 1, '2017-11-13 15:23:52', 1, NULL, NULL),
(3, '3', NULL, 'seller', '3', 'ORD-3-131117', '0', '0', '0', '2017-11-13', 'cash', 1, '2017-11-13 15:37:37', 1, NULL, NULL),
(4, '4', NULL, 'seller', '4', 'ORD-4-131117', '0', '0', '0', '2017-11-13', 'cash', 1, '2017-11-13 19:49:44', 1, NULL, NULL),
(5, '3', NULL, 'seller', '3', 'ORD-3-131117', '40000', '40000', '33800', '2017-11-14', 'cash', 1, '2017-11-14 16:19:07', 1, NULL, NULL),
(6, '5', '666', 'buyer', '5', 'BUY-5-141117', '0', '0', '26000', '2017-11-14', 'cash', 1, '2017-11-14 20:39:14', 1, NULL, NULL),
(7, '3', NULL, 'seller', '6', 'ORD-6-141117', '0', '0', '87100', '2017-11-14', 'cash', 1, '2017-11-14 20:40:19', 1, NULL, NULL),
(8, '4', NULL, 'seller', '4', 'ORD-4-131117', '13000', '13000', '0', '2017-11-15', 'cash', 1, '2017-11-15 16:24:18', 1, NULL, NULL),
(9, '6', NULL, 'seller', '7', 'ORD-7-161117', '12000', '12000', '700', '2017-11-16', 'cash', 1, '2017-11-16 20:17:56', 1, NULL, NULL),
(10, '4', NULL, 'seller', '4', 'ORD-4-131117', '6200', '6200', '0', '2017-11-16', 'cash', 1, '2017-11-16 20:21:55', 1, NULL, NULL),
(11, '4', NULL, 'seller', '8', 'ORD-8-161117', '9800', '9800', '6200', '2017-11-16', 'cash', 1, '2017-11-16 20:21:55', 1, NULL, NULL),
(12, '7', NULL, 'seller', '9', 'ORD-9-161117', '0', '0', '0', '2017-11-16', 'cash', 1, '2017-11-16 20:25:12', 1, NULL, NULL),
(13, '8', NULL, 'seller', '10', 'ORD-10-171117', '0', '0', '31100', '2017-11-17', 'cash', 1, '2017-11-17 21:00:37', 1, NULL, NULL),
(14, '7', NULL, 'seller', '9', 'ORD-9-161117', '14500', '14500', '0', '2017-11-17', 'cash', 1, '2017-11-17 21:06:23', 1, NULL, NULL),
(15, '9', '0000', 'buyer', '11', 'BUY-11-171117', '0', '0', '0', '2017-11-17', 'cash', 1, '2017-11-17 21:14:49', 1, NULL, NULL),
(16, '3', NULL, 'seller', '12', 'ORD-12-171117', '0', '0', '0', '2017-11-17', 'cash', 1, '2017-11-17 21:15:51', 1, NULL, NULL),
(17, '10', '685', 'buyer', '13', 'BUY-13-181117', '0', '0', '120000', '2017-11-18', 'cash', 1, '2017-11-18 19:49:30', 1, NULL, NULL),
(18, '1', 'BUY-1-131117', 'buyer', '1', 'BUY-1-131117', '143300', '143300', '0', '2017-11-18', 'cash', 1, '2017-11-18 20:13:24', 1, NULL, NULL),
(19, '1', 'BUY-1-131117', 'buyer', '1', 'BUY-1-131117', '41700', '41700', '0', '2017-11-18', 'cash', 1, '2017-11-18 20:14:52', 1, NULL, NULL),
(20, '11', NULL, 'seller', '14', 'ORD-14-181117', '13500', '13500', '0', '2017-11-18', 'cash', 1, '2017-11-18 20:20:41', 1, NULL, NULL),
(21, '8', NULL, 'seller', '15', 'ORD-15-201117', '0', '0', '0', '2017-11-20', 'cash', 1, '2017-11-20 18:48:12', 1, NULL, NULL),
(22, '12', NULL, 'seller', '16', 'ORD-16-201117', '0', '0', '0', '2017-11-20', 'cash', 1, '2017-11-20 19:48:54', 1, NULL, NULL),
(23, '3', NULL, 'seller', '12', 'ORD-12-171117', '25000', '25000', '87200', '2017-11-20', 'cash', 1, '2017-11-20 20:57:39', 1, NULL, NULL),
(24, '1', '00', 'buyer', '17', 'BUY-17-201117', '0', '0', '42000', '2017-11-20', 'cash', 1, '2017-11-20 21:30:02', 1, NULL, NULL),
(25, '13', '0021', 'buyer', '18', 'BUY-18-201117', '0', '0', '0', '2017-11-20', 'cash', 1, '2017-11-20 21:31:14', 1, NULL, NULL),
(26, '8', NULL, 'seller', '15', 'ORD-15-201117', '1000 CHARGER', '1000 CHARGER', '0', '2017-11-21', 'cash', 1, '2017-11-21 16:16:37', 1, NULL, NULL),
(27, '8', NULL, 'seller', '15', 'ORD-15-201117', '28000', '28000', '25200', '2017-11-21', 'cash', 1, '2017-11-21 16:17:17', 1, NULL, NULL),
(28, '14', NULL, 'seller', '19', 'ORD-19-211117', '13700', '13700', '0', '2017-11-21', 'cash', 1, '2017-11-21 17:07:20', 1, NULL, NULL),
(29, '15', NULL, 'seller', '20', 'ORD-20-211117', '12000', '12000', '0', '2017-11-21', 'cash', 1, '2017-11-21 17:09:18', 1, NULL, NULL),
(30, '16', NULL, 'seller', '21', 'ORD-21-211117', '0', '0', '0', '2017-11-21', 'cash', 1, '2017-11-21 17:16:37', 1, NULL, NULL),
(31, '9', '', 'buyer', '11', 'BUY-11-171117', '23500', '23500', '0', '2017-11-21', 'cash', 1, '2017-11-21 17:30:05', 1, NULL, NULL),
(32, '13', '', 'buyer', '18', 'BUY-18-201117', '46800', '46800', '0', '2017-11-21', 'cash', 1, '2017-11-21 17:34:00', 1, NULL, NULL),
(33, '10', '3233', 'buyer', '22', 'BUY-22-211117', '0', '0', '136000', '2017-11-21', 'cash', 1, '2017-11-21 19:03:41', 1, NULL, NULL),
(34, '17', NULL, 'seller', '23', 'ORD-23-211117', '8000', '8000', '0', '2017-11-21', 'cash', 1, '2017-11-21 19:04:39', 1, NULL, NULL),
(35, '1', '', 'buyer', '24', 'BUY-24-211117', '0', '0', '112000', '2017-11-21', 'cash', 1, '2017-11-21 21:19:03', 1, NULL, NULL),
(36, '8', NULL, 'seller', '25', 'ORD-25-211117', '0', '0', '0', '2017-11-21', 'cash', 1, '2017-11-21 21:24:05', 1, NULL, NULL),
(37, '18', NULL, 'seller', '26', 'ORD-26-211117', '0', '0', '0', '2017-11-21', 'cash', 1, '2017-11-21 21:35:34', 1, NULL, NULL),
(38, '3', NULL, 'seller', '27', 'ORD-27-211117', '0', '0', '0', '2017-11-21', 'cash', 1, '2017-11-21 21:48:27', 1, NULL, NULL),
(39, '1', '', 'buyer', '28', 'BUY-28-211117', '0', '0', '0', '2017-11-21', 'cash', 1, '2017-11-21 21:55:48', 1, NULL, NULL),
(40, '19', NULL, 'seller', '29', 'ORD-29-211117', '0', '0', '10400', '2017-11-21', 'cash', 1, '2017-11-21 21:56:41', 1, NULL, NULL),
(41, '20', '490', 'buyer', '30', 'BUY-30-241117', '0', '0', '400000', '2017-11-24', 'cash', 1, '2017-11-24 20:58:57', 1, NULL, NULL),
(42, '18', NULL, 'seller', '26', 'ORD-26-211117', '30000', '30000', '36300', '2017-11-24', 'cash', 1, '2017-11-24 21:05:18', 1, NULL, NULL),
(43, '18', NULL, 'seller', '31', 'ORD-31-241117', '0', '0', '147800', '2017-11-24', 'cash', 1, '2017-11-24 21:55:27', 1, NULL, NULL),
(44, '21', NULL, 'seller', '32', 'ORD-32-241117', '0', '0', '64600', '2017-11-24', 'cash', 1, '2017-11-24 22:03:53', 1, NULL, NULL),
(45, '16', NULL, 'seller', '21', 'ORD-21-211117', '91400', '91400', '0', '2017-11-28', 'cash', 1, '2017-11-28 17:53:44', 1, NULL, NULL),
(46, '16', NULL, 'seller', '33', 'ORD-33-281117', '120000', '120000', '48200', '2017-11-28', 'cash', 1, '2017-11-28 17:56:25', 1, NULL, NULL),
(47, '8', NULL, 'seller', '25', 'ORD-25-211117', '15000', '15000', '40800', '2017-11-28', 'cash', 1, '2017-11-28 18:53:42', 1, NULL, NULL),
(48, '8', NULL, 'seller', '34', 'ORD-34-281117', '0', '0', '83900', '2017-11-28', 'cash', 1, '2017-11-28 18:55:04', 1, NULL, NULL),
(49, '10', '00', 'buyer', '35', 'BUY-35-291117', '0', '0', '186000', '2017-11-29', 'cash', 1, '2017-11-29 16:20:57', 1, NULL, NULL),
(50, '15', NULL, 'seller', '36', 'ORD-36-291117', '27500', '27500', '0', '2017-11-29', 'cash', 1, '2017-11-29 16:22:11', 1, NULL, NULL),
(51, '15', NULL, 'seller', '37', 'ORD-37-291117', '0', '0', '0', '2017-11-29', 'cash', 1, '2017-11-29 20:01:39', 1, NULL, NULL),
(52, '15', NULL, 'seller', '37', 'ORD-37-291117', '8000', '8000', '0', '2017-11-29', 'cash', 1, '2017-11-29 20:04:30', 1, NULL, NULL),
(53, '10', '999', 'buyer', '38', 'BUY-38-291117', '0', '0', '238000', '2017-11-29', 'cash', 1, '2017-11-29 20:06:15', 1, NULL, NULL),
(54, '4', NULL, 'seller', '39', 'ORD-39-291117', '0', '0', '0', '2017-11-29', 'cash', 1, '2017-11-29 20:10:10', 1, NULL, NULL),
(55, '18', NULL, 'seller', '40', 'ORD-40-291117', '0', '0', '119500', '2017-11-29', 'cash', 1, '2017-11-29 21:31:23', 1, NULL, NULL),
(56, '1', '', 'buyer', '28', 'BUY-28-211117', '121700', '121700', '0', '2017-12-01', 'cash', 1, '2017-12-01 03:58:08', 1, NULL, NULL),
(57, '1', '', 'buyer', '41', 'BUY-41-011217', '0', '0', '148500', '2017-12-01', 'cash', 1, '2017-12-01 03:59:38', 1, NULL, NULL),
(58, '15', NULL, 'seller', '42', 'ORD-42-021217', '15000', '15000', '0', '2017-12-02', 'cash', 1, '2017-12-02 18:09:05', 1, NULL, NULL),
(59, '15', NULL, 'seller', '43', 'ORD-43-021217', '16000', '16000', '0', '2017-12-02', 'cash', 1, '2017-12-02 18:11:33', 1, NULL, NULL),
(60, '15', NULL, 'seller', '44', 'ORD-44-041217', '13000', '13000', '0', '2017-12-04', 'cash', 1, '2017-12-04 21:45:10', 1, NULL, NULL),
(61, '22', NULL, 'seller', '45', 'ORD-45-041217', '0', '0', '34300', '2017-12-04', 'cash', 1, '2017-12-04 21:46:29', 1, NULL, NULL),
(62, '3', NULL, 'seller', '27', 'ORD-27-211117', '25000', '25000', '0', '2017-12-04', 'cash', 1, '2017-12-04 21:48:01', 1, NULL, NULL),
(63, '3', NULL, 'seller', '27', 'ORD-27-211117', '30000', '30000', '0', '2017-12-04', 'cash', 1, '2017-12-04 21:48:30', 1, NULL, NULL),
(64, '3', NULL, 'seller', '27', 'ORD-27-211117', '23500', '23500', '76800', '2017-12-04', 'cash', 1, '2017-12-04 21:49:49', 1, NULL, NULL),
(65, '3', NULL, 'seller', '46', 'ORD-46-041217', '0', '0', '0', '2017-12-04', 'cash', 1, '2017-12-04 21:51:57', 1, NULL, NULL),
(66, '3', NULL, 'seller', '46', 'ORD-46-041217', '30000', '30000', '92500', '2017-12-05', 'cash', 1, '2017-12-05 15:44:42', 1, NULL, NULL),
(67, '23', '511', 'buyer', '47', 'BUY-47-051217', '588100', '588100', '0', '2017-12-05', 'cash', 1, '2017-12-05 20:55:07', 1, NULL, NULL),
(68, '24', NULL, 'seller', '48', 'ORD-48-061217', '0', '0', '30000', '2017-12-06', 'cash', 1, '2017-12-06 17:11:00', 1, NULL, NULL),
(69, '15', NULL, 'seller', '49', 'ORD-49-061217', '13000', '13000', '0', '2017-12-06', 'cash', 1, '2017-12-06 17:14:25', 1, NULL, NULL),
(70, '14', NULL, 'seller', '50', 'ORD-50-061217', '22500', '22500', '0', '2017-12-06', 'cash', 1, '2017-12-06 20:37:49', 1, NULL, NULL),
(71, '25', NULL, 'seller', '51', 'ORD-51-061217', '20000', '20000', '16100', '2017-12-06', 'cash', 1, '2017-12-06 21:06:55', 1, NULL, NULL),
(72, '26', NULL, 'seller', '52', 'ORD-52-061217', '0', '0', '25300', '2017-12-06', 'cash', 1, '2017-12-06 21:16:45', 1, NULL, NULL),
(73, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:00:45', 1, NULL, NULL),
(74, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:02:59', 1, NULL, NULL),
(75, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:00', 1, NULL, NULL),
(76, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:00', 1, NULL, NULL),
(77, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:00', 1, NULL, NULL),
(78, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:02', 1, NULL, NULL),
(79, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:02', 1, NULL, NULL),
(80, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:02', 1, NULL, NULL),
(81, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:03', 1, NULL, NULL),
(82, '4', NULL, 'seller', '39', 'ORD-39-291117', '700', '700', '35000', '2017-12-08', 'cash', 1, '2017-12-08 05:03:03', 1, NULL, NULL),
(83, '27', NULL, 'seller', '53', 'ORD-53-081217', '10000', '10000', '10000', '2017-12-08', 'cash', 1, '2017-12-08 05:25:18', 1, NULL, NULL),
(84, '27', NULL, 'seller', '54', 'ORD-54-081217', '0', '0', '0', '2017-12-08', 'cash', 1, '2017-12-08 05:49:18', 1, NULL, NULL),
(85, '28', '', 'buyer', '55', 'BUY-55-081217', '200', '200', '800', '2017-12-08', 'cash', 1, '2017-12-08 05:59:09', 1, NULL, NULL),
(86, '29', '33', 'buyer', '56', 'BUY-56-081217', '100', '100', '0', '2017-12-08', 'cash', 1, '2017-12-08 06:01:53', 1, NULL, NULL),
(87, '12', NULL, 'seller', '16', 'ORD-16-201117', '30000', '30000', '300', '2017-12-08', 'cash', 1, '2017-12-08 08:05:54', 1, NULL, NULL),
(88, '30', NULL, 'seller', '57', 'ORD-57-081217', '10', '10', '10', '2017-12-08', 'cash', 1, '2017-12-08 08:10:18', 1, NULL, NULL),
(89, '27', NULL, 'seller', '54', 'ORD-54-081217', '5000', '5000', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:27:43', 1, NULL, NULL),
(90, '27', NULL, 'seller', '54', 'ORD-54-081217', '1000', '1000', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:28:20', 1, NULL, NULL),
(91, '27', NULL, 'seller', '54', 'ORD-54-081217', '2000', '2000', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:29:49', 1, NULL, NULL),
(92, '27', NULL, 'seller', '54', 'ORD-54-081217', '500', '500', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:33:51', 1, NULL, NULL),
(93, '29', '123', 'buyer', '56', 'BUY-56-081217', '200', '200', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:34:18', 1, NULL, NULL),
(94, '29', '33', 'buyer', '56', 'BUY-56-081217', '500', '500', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:37:36', 1, NULL, NULL),
(95, '31', 'dd', 'buyer', '58', 'BUY-58-081217', '', '', 'NaN', '2017-12-08', 'cash', 1, '2017-12-08 08:39:27', 1, NULL, NULL),
(96, '32', NULL, 'seller', '59', 'ORD-59-081217', '', '', '', '2017-12-08', 'cash', 1, '2017-12-08 08:42:33', 1, NULL, NULL),
(97, '33', NULL, 'seller', '60', 'ORD-60-081217', '', '', '', '2017-12-08', 'cash', 1, '2017-12-08 08:42:42', 1, NULL, NULL),
(98, '', '', 'buyer', '', '', '', '', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:48:39', 1, NULL, NULL),
(99, '', '', 'buyer', '', '', '', '', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:48:40', 1, NULL, NULL),
(100, '', '', 'buyer', '', '', '', '', '0', '2017-12-08', 'cash', 1, '2017-12-08 08:48:40', 1, NULL, NULL),
(101, '29', '1234', 'buyer', '56', 'BUY-56-081217', '100', '100', '200', '2017-12-08', 'cash', 1, '2017-12-08 08:48:58', 1, NULL, NULL),
(102, '27', NULL, 'seller', '54', 'ORD-54-081217', '500', '500', '1000', '2017-12-08', 'cash', 1, '2017-12-08 08:50:14', 1, NULL, NULL),
(103, '34', '0900', 'buyer', '61', 'BUY-61-081217', '2000', '2000', '300', '2017-12-08', 'cash', 1, '2017-12-08 08:51:19', 1, NULL, NULL),
(107, '36', NULL, 'seller', '65', 'ORD-62-091217', '4000', '4000', '5000', '2017-12-09', 'cash', 1, '2017-12-09 00:56:41', 1, NULL, NULL),
(108, '36', NULL, 'seller', '66', 'ORD-66-091217', '1500', '1500', '10000', '2017-12-09', 'cash', 1, '2017-12-09 00:58:57', 1, NULL, NULL),
(109, '36', NULL, 'seller', '67', 'ORD-67-091217', '6300', '6300', '5000', '2017-12-09', 'cash', 1, '2017-12-09 01:02:05', 1, NULL, NULL),
(110, '37', NULL, 'seller', '68', 'ORD-68-091217', '1000', '1000', '1000', '2017-12-09', 'cash', 1, '2017-12-09 01:04:26', 1, NULL, NULL),
(111, '38', NULL, 'seller', '69', 'ORD-69-091217', '1000', '1000', '0', '2017-12-09', 'cash', 1, '2017-12-09 01:04:50', 1, NULL, NULL),
(112, '38', NULL, 'seller', '69', 'ORD-69-091217', '500', '500', '0', '2017-12-09', 'cash', 1, '2017-12-09 01:05:24', 1, NULL, NULL),
(113, '38', NULL, 'seller', '69', 'ORD-69-091217', '500', '500', '0', '2017-12-09', 'cash', 1, '2017-12-09 01:05:57', 1, NULL, NULL),
(114, '38', NULL, 'seller', '70', 'ORD-70-091217', '0', '0', '8000', '2017-12-09', 'cash', 1, '2017-12-09 01:05:57', 1, NULL, NULL),
(115, '39', '0900', 'buyer', '71', 'BUY-71-091217', '5000', '5000', '50000', '2017-12-09', 'cash', 1, '2017-12-09 01:15:02', 1, NULL, NULL),
(116, '39', '', 'buyer', '72', 'BUY-72-091217', '40000', '40000', '0', '2017-12-09', 'cash', 1, '2017-12-09 01:17:43', 1, NULL, NULL),
(117, '39', '', 'buyer', '72', 'BUY-72-091217', '50000', '50000', '0', '2017-12-09', 'cash', 1, '2017-12-09 01:20:11', 1, NULL, NULL),
(118, '39', '', 'buyer', '73', 'BUY-73-091217', '0', '0', '0', '2017-12-09', 'cash', 1, '2017-12-09 01:20:11', 1, NULL, NULL),
(119, '39', '0999', 'buyer', '73', 'BUY-73-091217', '20000', '20000', '20000', '2017-12-09', 'cash', 1, '2017-12-09 01:21:47', 1, NULL, NULL),
(120, '39', '', 'buyer', '74', 'BUY-74-091217', '0', '0', '40000', '2017-12-09', 'cash', 1, '2017-12-09 01:22:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` bigint(20) NOT NULL COMMENT 'Id of the product',
  `product_code` varchar(500) DEFAULT '987654',
  `product_name` text NOT NULL COMMENT 'Name of the product',
  `product_image` varchar(255) NOT NULL COMMENT 'Image Url of the product',
  `featured_image` varchar(255) DEFAULT NULL,
  `is_new` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Is 1 if the product is displayed to be a new product',
  `product_featured` text COMMENT 'features of the product(HTML)',
  `product_description` text NOT NULL COMMENT 'Ingredients in product(HTML)',
  `product_price` double NOT NULL COMMENT 'MRP of the Product',
  `product_sell_price` double DEFAULT NULL,
  `discount_price` double DEFAULT NULL COMMENT 'The discounted price of the product',
  `total_price` double NOT NULL,
  `discount_status` int(11) DEFAULT '0' COMMENT 'to use discounted price or not',
  `category_id` varchar(255) NOT NULL COMMENT 'Category Ids of the product(comma seperated if multiple)',
  `subcategory_id` varchar(255) NOT NULL COMMENT 'Sub-Category Ids of the product(comma seperated if multiple)',
  `product_quantity` int(11) NOT NULL,
  `product_sell_quantity` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `deleted_id` varchar(255) DEFAULT NULL COMMENT 'Id of the deleter',
  `deleted_date` datetime DEFAULT NULL COMMENT 'Date of deletion of the product'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `product_code`, `product_name`, `product_image`, `featured_image`, `is_new`, `product_featured`, `product_description`, `product_price`, `product_sell_price`, `discount_price`, `total_price`, `discount_status`, `category_id`, `subcategory_id`, `product_quantity`, `product_sell_quantity`, `seller_id`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`, `deleted_id`, `deleted_date`) VALUES
(1, '987655', '8460', 'product_15105670771.jpg', '', '0', 'BUSINESS CLASS LAPTOP', 'CORE I5 SECOND GENERATION 2.4 PRO, 4GB DDR3 RAM, 250GB HARD DRIVE, ORIGINAL CAMERA, DVD COMBO, ORIGINAL CHARGER...', 14000, 17000, NULL, 14000, 0, '2', '51', 0, 13, 0, 1, '2017-11-13 14:57:57', 1, NULL, NULL, NULL, NULL),
(2, '987656', '8470', 'product_15105672661.jpg', '', '0', 'BUSINESS CLASS LAPTOP', 'CORE I5 THIRD GENERATION 2.4 PRO, 4GB DDR3 RAM, 250GB HARD DRIVE, DVD COMBO, ORIGINAL CAMERA, ORIGINAL CHARGER', 15600, 19000, NULL, 15600, 0, '2', '52', 0, 8, 0, 1, '2017-11-13 15:01:06', 1, NULL, NULL, NULL, NULL),
(3, '987657', 'LATITUDE E6400', 'product_15105673941.jpg', '', '0', 'BEST FOR USAGE', 'CORE TO DU 2.4 PRO, 2GB DDR2 RAM, 160GB HARD DRIVE, CAMERA, DVD COMBO, CHARGER', 9000, 0, NULL, 9000, 0, '1', '16', 56, 23, 0, 1, '2017-11-13 15:03:14', 1, NULL, NULL, NULL, NULL),
(4, '987658', 'PRO BOOK 6565', 'product_15105685121.jpg', '', '0', 'GRAPHICS BOOK', 'AMD A6 3rd GENERATION 1.6 PRO, 4GB DDR3 RAM, 250GB HARD DRIVE, CAMERA, DVD COMBO, CHARGER. 512 GRAPHIC CARD, SHARING GRAPHICS 2 GB......', 12500, 16500, NULL, 12500, 0, '2', '124', 0, 3, 0, 1, '2017-11-13 15:21:52', 1, NULL, NULL, NULL, NULL),
(5, '987659', 'LATITUDE E6420', 'product_15106736111.jpg', '', '0', 'BUSINESS SERIES', '2.4 CORE I5 SECOND GENERATION 4GB DDR3 RAM, 320 GB HARD DRIVE ORIGINAL CAMERA, DVD COMBO, CHARGER ', 13500, 15500, NULL, 13500, 0, '1', '34', 0, 7, 0, 1, '2017-11-14 20:33:31', 1, NULL, NULL, NULL, NULL),
(8, '987662', 'Latitude E6410', 'product_15110154051.jpg', '', '0', 'BUSINESS SERIES', '2.4 PRO, 4GB DDR3 RAM, 250 GB HARD DRIVE, CAMERA, DVD COMBO CHARER', 10000, 13500, NULL, 10000, 0, '1', '33', 0, 10, 0, 1, '2017-11-18 19:30:05', 1, NULL, NULL, NULL, NULL),
(10, '987663', 'THINKPAD T410', 'product_15112832871.jpg', '', '0', 'BUSINESS SERIES', '2.4 PRO, CORE I5 FIRST GENERATION, 4 GB DDR3 RAM, 250 GB HARD DRIVE, ORIGINAL CAMERA, ORIGINAL CHARGER....', 9700, 13500, NULL, 9700, 0, '3', '72', 0, 1, 0, 1, '2017-11-21 21:54:47', 1, NULL, NULL, NULL, NULL),
(11, '987664', 'ELITE BOOK 820 G1', 'product_15115390181.jpg', '', '0', 'SLIM BUSINESS SERIES', '2.3 PRO CORE I5 4TH GENERATION, 4GB DDR3 RAM, 250 GB HARD DRIVE, CAMERA , CHARGER, 12.5\" SCREEN SIZE', 20000, 25000, NULL, 20000, 0, '2', '53', 1, 19, 0, 1, '2017-11-24 20:56:58', 1, NULL, NULL, NULL, NULL),
(12, '987665', 'LATITUDE E6500', 'product_15119675511.jpg', '', '0', 'BUSINESS SERIES', '2.5 CORE TO DU, 2 GB DDR2 RAM, 160GB HARD DRIVE, CAMERA, COMBO, CHARGER', 6500, 9500, NULL, 6500, 0, '1', '16', -3, 7, 0, 1, '2017-11-29 19:59:11', 1, NULL, NULL, NULL, NULL),
(13, '987666', 'Lenovo S12', 'product_15120824181.jpg', 'subproduct_151208241811.jpg', '0', 'SLIM LAPTOP', '1.6 ATOM, 2GB DDR2 RAM, 160 GB HARD DRIVE ORIGINAL CAMERA ORIGINAL CHARGER 12.5\" SCREEN SIZE..', 6000, 9500, NULL, 6000, 0, '3', '126', 7, 8, 0, 1, '2017-12-01 03:53:38', 1, NULL, NULL, NULL, NULL),
(14, '987667', 'ELITE BOOK 8440p', 'product_15120826501.jpg', 'subproduct_151208265011.jpg', '0', 'BUSINESS SERIES', '2.4 CORE I5 FIRST GENERATION, 4 GB DDR3 RAM, 250GB HARD DRIVE, DVD COMBO, CAMERA, CHARGER.', 11700, 14500, NULL, 11700, 0, '2', '50', 2, 3, 0, 1, '2017-12-01 03:57:30', 1, NULL, NULL, NULL, NULL),
(15, '987668', 'LATITUDE D630', 'product_15124865511.jpg', '', '0', 'BUSINESS SERIES', '2.0 CORE TO DU, 2GB DDR2 RAM, 80 GB HARD DRIVE, DVD COMBO, CHARGER 14.5\" SCREEN', 5300, 7500, NULL, 5300, 0, '1', '16', 16, 4, 0, 1, '2017-12-05 20:09:11', 1, NULL, NULL, NULL, NULL),
(16, '987669', 'HP 530', 'product_15124867761.jpg', '', '0', 'BUSINESS SERIES ', '2.0 CORE TO DU, 2GB DDR2 RAM, 80 GB HARD DRIVE, DVD COMBO, CHARGER', 6000, 7000, NULL, 6000, 0, '2', '25', 14, 1, 0, 1, '2017-12-05 20:12:56', 1, NULL, NULL, NULL, NULL),
(17, '987670', 'HP 6710', 'product_15124868911.jpg', '', '0', 'BUSINESS SERIES', '2.0 CORE TO DU, 2 GB DDR2 RAM, 80 GB HARD DRIVE, DVD COMBO, CHARGER', 12000, 13000, NULL, 12000, 0, '2', '25', 7, 4, 0, 1, '2017-12-05 20:14:51', 1, NULL, NULL, NULL, NULL),
(18, '987671', 'VOSTRO 1510', 'product_15124872891.jpg', 'subproduct_151248728911.jpg', '0', 'GLOSSY SERIES', '2.0. CORE TO DU, 2GB DDR2 RAM, 160 GB HARD DRIVE, CHARGER ', 6800, 9500, NULL, 6800, 0, '1', '16', 13, 1, 0, 1, '2017-12-05 20:21:29', 1, NULL, NULL, NULL, NULL),
(19, '987672', 'THINKPAD R60', 'product_15124874431.jpg', '', '0', 'BUSINESS SERIES', '1.8 CORE TO DU, 2GB DDR2 RAM, 80 GB HARD DRIVE, DVD, CHARGER', 4800, 6500, NULL, 4800, 0, '3', '64', 5, NULL, 0, 1, '2017-12-05 20:24:03', 1, NULL, NULL, NULL, NULL),
(20, '987673', 'BYTESPEED', 'product_15124882541.jpg', '', '0', 'BYTESPEED ', '2.0 CORE TO DU, 2 GB DDR2 RAM, 160 GB HARD DRIVE, CAMERA COMBO CHARGER', 6300, 8500, NULL, 6300, 0, '8', '127', 5, NULL, 0, 1, '2017-12-05 20:37:34', 1, NULL, NULL, NULL, NULL),
(21, '987674', 'ASPIRE 5620', 'product_15124884931.jpg', '', '0', 'ASPIRE SERIES', '2.0 CORE TO DU, 2 GB DDR 2 RAM, 80 GB, DVD CHARGER', 5000, 7500, NULL, 5000, 0, '6', '122', 18, 2, 0, 1, '2017-12-05 20:41:33', 1, NULL, NULL, NULL, NULL),
(22, '987675', 'LENOVO R500', 'product_15124886491.jpg', '', '0', 'BUSINESS SEREIES', '2.2 CORE TO DU, 2 GB DDR3 RAM, 160 GB HARD DRIVE, CAMERA COMBO, CHARGER.', 6600, 8500, NULL, 6600, 0, '3', '64', 7, NULL, 0, 1, '2017-12-05 20:44:09', 1, NULL, NULL, NULL, NULL),
(23, '987676', 'ELITE BOOK 6930/8530/COMPAQ', 'product_15124888241.jpg', '', '0', 'BUSINESS SERIES', '2.2 CORE TO DU, 2 GB DDR2 RAM, 160GB HARD DRIVE, CAMERA COMBO , CHARGER', 6800, 9500, NULL, 6800, 0, '2', '25', 8, 1, 0, 1, '2017-12-05 20:47:04', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `project_name` varchar(150) NOT NULL,
  `site_address` varchar(500) NOT NULL,
  `project_image` varchar(150) NOT NULL,
  `project_email` varchar(150) NOT NULL,
  `project_fax` varchar(150) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `contact_no` varchar(150) NOT NULL,
  `start_date` varchar(150) NOT NULL,
  `end_date` varchar(150) NOT NULL,
  `project_amount` varchar(150) NOT NULL,
  `total_floor` int(11) DEFAULT NULL,
  `total_unit` int(11) DEFAULT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `country_id`, `city_id`, `project_name`, `site_address`, `project_image`, `project_email`, `project_fax`, `contact_person`, `contact_no`, `start_date`, `end_date`, `project_amount`, `total_floor`, `total_unit`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 1, 1, 'Guards Deployment', 'gulshan project', '', 'project@email.com', '09999', 'asad', '03422345678', '01-02-2018', '01-02-2020', '1000000', 22, NULL, 1, '2018-01-17 10:55:18', 1, '2018-01-17 11:25:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Builder Management System'),
(2, 'system_title', 'Builder Management System'),
(3, 'address', 'karachi'),
(4, 'phone', '03432762242'),
(5, 'paypal_email', 'info@skytechsol.com'),
(6, 'currency', 'PK'),
(7, 'system_email', 'info@skytechsol.com'),
(8, 'buyer', 'dsaf'),
(9, 'purchase_code', 'asdf'),
(11, 'language', 'english'),
(12, 'text_align', 'left-to-right');

-- --------------------------------------------------------

--
-- Table structure for table `site_order_list`
--

CREATE TABLE `site_order_list` (
  `id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `account_type` varchar(100) DEFAULT 'site_user',
  `name` text NOT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `address` text NOT NULL,
  `user_type` varchar(100) DEFAULT 'site_user',
  `category_name` varchar(200) DEFAULT NULL,
  `subcategory_name` varchar(200) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_sell_price` varchar(200) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT NULL,
  `order_date` varchar(100) NOT NULL,
  `is_enable` int(1) DEFAULT '1',
  `ip_address` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `slider_list`
--

CREATE TABLE `slider_list` (
  `id` int(11) NOT NULL COMMENT 'The brand ID of the brand',
  `slider_name` text COMMENT 'Name of the Slider',
  `slider_image` varchar(255) NOT NULL COMMENT 'Image url for slider logo',
  `slider_description` text COMMENT 'Description about the slider',
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `deleted_id` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `slider_list`
--

INSERT INTO `slider_list` (`id`, `slider_name`, `slider_image`, `slider_description`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`, `deleted_id`, `deleted_date`) VALUES
(1, 'slider1', 'slider_14871328371.jpg', NULL, 1, '2017-02-15 09:27:17', 1, '2017-11-17 21:25:12', 1, NULL, NULL),
(2, 'slider2', 'slider_14871328471.jpg', NULL, 1, '2017-02-15 09:27:27', 1, NULL, NULL, NULL, NULL),
(3, 'slider3', 'slider_14871328571.jpg', NULL, 1, '2017-02-15 09:27:37', 1, NULL, NULL, NULL, NULL),
(4, 'slider4', 'slider_14871328661.jpg', NULL, 1, '2017-02-15 09:27:46', 1, NULL, NULL, NULL, NULL),
(5, 'slider5', 'slider_14871328771.jpg', NULL, 1, '2017-02-15 09:27:57', 1, NULL, NULL, NULL, NULL),
(6, 'slider6', 'slider_14871328881.jpg', NULL, 1, '2017-02-15 09:28:08', 1, '2017-07-23 20:11:18', 1, NULL, NULL),
(7, NULL, 'slider_15008219611.jpg', NULL, 1, '2017-07-23 19:59:21', 1, NULL, NULL, NULL, NULL),
(8, NULL, 'slider_15008227051.jpg', NULL, 1, '2017-07-23 20:11:45', 1, NULL, NULL, NULL, NULL),
(9, 'sale on laptops', '', NULL, 0, '2017-11-21 16:11:15', 1, '2017-11-21 16:13:07', 1, NULL, NULL),
(10, 'LAPTOPS SALES', 'slider_15112627531.jpg', NULL, 1, '2017-11-21 16:12:33', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_list`
--

CREATE TABLE `staff_list` (
  `staff_id` int(11) NOT NULL,
  `staff_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `staff_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff_list`
--

INSERT INTO `staff_list` (`staff_id`, `staff_code`, `name`, `birthday`, `sex`, `address`, `phone`, `email`, `staff_image`, `user_id`, `ip_address`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '10001', 'adsf1', '02/17/2019', 'female', 'asdfasdf1', 'asdfq1', 'aaaa1', 'staff_15188476481.jpg', 1, '::1', 1, '2018-02-17 11:07:28', 1, '2018-02-17 15:04:42', 1),
(2, '10002', 'khan', '12/28/2008', 'male', 'karachi pakistan', '09001234567', 'asad@gmail.com', 'staff_15188477101.jpg', 1, '::1', 1, '2018-02-17 11:08:30', 1, NULL, NULL),
(3, '10003', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:13:38', 1, NULL, NULL),
(4, '10004', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:16:53', 1, NULL, NULL),
(5, '10005', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:16:54', 1, NULL, NULL),
(6, '10006', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:16:54', 1, NULL, NULL),
(7, '10007', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:17:03', 1, NULL, NULL),
(8, '10008', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:17:40', 1, NULL, NULL),
(9, '10009', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:17:40', 1, NULL, NULL),
(10, '10010', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:17:41', 1, NULL, NULL),
(11, '10011', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:17:41', 1, NULL, NULL),
(12, '10012', '', '', '', '', '', '', '', 1, '::1', 1, '2018-02-17 11:17:41', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_setting_list`
--

CREATE TABLE `system_setting_list` (
  `id` int(11) NOT NULL,
  `system_name` varchar(255) DEFAULT NULL,
  `system_title` varchar(255) DEFAULT NULL,
  `system_image` text NOT NULL,
  `short_address` text,
  `long_address` text,
  `map_location` text,
  `mobile` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `fax` varchar(200) DEFAULT NULL,
  `website` varchar(100) NOT NULL,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_setting_list`
--

INSERT INTO `system_setting_list` (`id`, `system_name`, `system_title`, `system_image`, `short_address`, `long_address`, `map_location`, `mobile`, `email`, `fax`, `website`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'Security Management', 'Security Management', 'system_15140351431.jpg', 'Karachi, Pakistan.', 'Karachi, Pakistan.', '', '0900 78601', 'info@webxzone.com', '+92-21-34935602', 'www.webxzone.com', 1, '2017-05-17 00:00:00', 1, '2021-03-03 02:23:12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `unit_list`
--

CREATE TABLE `unit_list` (
  `id` int(11) NOT NULL,
  `floor_id` varchar(50) DEFAULT NULL,
  `unit_no` varchar(50) DEFAULT NULL,
  `is_enable` int(1) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_list`
--

INSERT INTO `unit_list` (`id`, `floor_id`, `unit_no`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, '1', 'unit12', 1, '2018-01-13 18:45:50', 1, '2018-01-13 18:54:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE `user_list` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `user_type` varchar(100) DEFAULT 'user',
  `is_enable` int(1) DEFAULT '1',
  `ip_address` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`id`, `name`, `email`, `contact`, `address`, `user_type`, `is_enable`, `ip_address`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(2, 'khan1', 'khan@gmail.coms', '2222222', 'karachiaaaaaaaaaa', '2', 1, '::1', NULL, NULL, '2018-01-17 12:55:12', 1),
(3, 'jamal', 'jamal@gmail.com', '098765433333', 'karachi paksitan', '2', 1, '::1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_type_list`
--

CREATE TABLE `user_type_list` (
  `id` int(11) NOT NULL,
  `user_type_name` text,
  `is_enable` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_type_list`
--

INSERT INTO `user_type_list` (`id`, `user_type_name`, `is_enable`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 'labour 1', 1, '2018-01-17 12:00:43', 1, '2018-01-17 12:01:10', 1),
(2, 'labour 2', 1, '2018-01-17 12:01:03', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data_permission`
--
ALTER TABLE `admin_data_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `admin_module_list`
--
ALTER TABLE `admin_module_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_module_permission`
--
ALTER TABLE `admin_module_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `bank_list`
--
ALTER TABLE `bank_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_list`
--
ALTER TABLE `branch_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_list`
--
ALTER TABLE `brand_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_expense_list`
--
ALTER TABLE `building_expense_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_expense_type_list`
--
ALTER TABLE `building_expense_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_list`
--
ALTER TABLE `cart_list`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_list`
--
ALTER TABLE `check_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_payment_list`
--
ALTER TABLE `client_payment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_personal_list`
--
ALTER TABLE `client_personal_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_record_list`
--
ALTER TABLE `client_record_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_list`
--
ALTER TABLE `country_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_list`
--
ALTER TABLE `expense_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type_list`
--
ALTER TABLE `expense_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_record_list`
--
ALTER TABLE `file_record_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floor_list`
--
ALTER TABLE `floor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_list`
--
ALTER TABLE `logo_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_history_list`
--
ALTER TABLE `order_history_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_list`
--
ALTER TABLE `payment_list`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `site_order_list`
--
ALTER TABLE `site_order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_list`
--
ALTER TABLE `slider_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_list`
--
ALTER TABLE `staff_list`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `system_setting_list`
--
ALTER TABLE `system_setting_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_list`
--
ALTER TABLE `unit_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type_list`
--
ALTER TABLE `user_type_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data_permission`
--
ALTER TABLE `admin_data_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_module_list`
--
ALTER TABLE `admin_module_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `admin_module_permission`
--
ALTER TABLE `admin_module_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `bank_list`
--
ALTER TABLE `bank_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branch_list`
--
ALTER TABLE `branch_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `brand_list`
--
ALTER TABLE `brand_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The brand ID of the brand', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `building_expense_list`
--
ALTER TABLE `building_expense_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `building_expense_type_list`
--
ALTER TABLE `building_expense_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The category ID', AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `check_list`
--
ALTER TABLE `check_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `client_payment_list`
--
ALTER TABLE `client_payment_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `client_personal_list`
--
ALTER TABLE `client_personal_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_record_list`
--
ALTER TABLE `client_record_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `country_list`
--
ALTER TABLE `country_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expense_list`
--
ALTER TABLE `expense_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `expense_type_list`
--
ALTER TABLE `expense_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `file_record_list`
--
ALTER TABLE `file_record_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `floor_list`
--
ALTER TABLE `floor_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logo_list`
--
ALTER TABLE `logo_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_history_list`
--
ALTER TABLE `order_history_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `payment_list`
--
ALTER TABLE `payment_list`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id of the product', AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `site_order_list`
--
ALTER TABLE `site_order_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slider_list`
--
ALTER TABLE `slider_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The brand ID of the brand', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `staff_list`
--
ALTER TABLE `staff_list`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `unit_list`
--
ALTER TABLE `unit_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_type_list`
--
ALTER TABLE `user_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
