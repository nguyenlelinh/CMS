-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th3 31, 2023 lúc 06:15 AM
-- Phiên bản máy phục vụ: 10.4.26-MariaDB
-- Phiên bản PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cms`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `(X)related_events`
--

CREATE TABLE `(X)related_events` (
  `REV_id` int(10) UNSIGNED NOT NULL,
  `REV_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REV_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `REV_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `REV_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `REV_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `REV_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `ADM_id` int(10) UNSIGNED NOT NULL,
  `ADM_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADM_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADM_slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADM_password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADM_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADM_avatar` int(10) UNSIGNED DEFAULT NULL,
  `ADM_phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADM_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADM_role` int(10) UNSIGNED NOT NULL,
  `ADM_extend_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ghi chú, Bio, Mã bưu chính, số tài khoản...',
  `ADM_password_reset_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADM_order_prioritize` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ADM_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ADM_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ADM_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`ADM_id`, `ADM_name`, `ADM_username`, `ADM_slug`, `ADM_password`, `ADM_email`, `ADM_avatar`, `ADM_phone`, `ADM_address`, `ADM_role`, `ADM_extend_data`, `ADM_password_reset_key`, `ADM_order_prioritize`, `ADM_status`, `ADM_created_date`, `ADM_changed_date`) VALUES
(21, 'a', 'a', 'a', 'a', 'a', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(23, 'a', 'b', 'b', 'a', 'b', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(24, 'a', 'c', 'c', 'a', 'c', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(27, 'a', 'd', 'd', 'a', 'd', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(28, 'a', 'e', 'e', 'a', 'e', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(29, 'a', 'f', 'f', 'a', 'f', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(30, 'a', 'g', 'g', 'a', 'g', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(31, 'a', 'h', 'h', 'a', 'h', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(32, 'a', 'i', 'i', 'a', 'i', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680164235),
(33, 'a', 'k', 'k', 'a', 'k', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680167784),
(34, 'a', 'l', 'l', 'a', 'l', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680167782),
(35, 'a', 'm', 'm', 'a', 'm', NULL, 'a', NULL, 1, NULL, NULL, 0, 2, 0, 1680167780),
(36, 't1t1t', 't1t', 't1t', '8eb64d11619c1950cf054b10fb60cf89', 't1t1t', NULL, '3t2t23t', NULL, 2, NULL, NULL, 0, 1, 1680175775, 0),
(37, 'ưegưeg', 'gege', 'gege', '8eb64d11619c1950cf054b10fb60cf89', 'ưegưeg', NULL, 'egưge', 'gưegư', 2, NULL, NULL, 0, 1, 1680175845, 0),
(38, '34y34y', 'y34y', 'y34y', '8eb64d11619c1950cf054b10fb60cf89', 'tungpv4@breadntea.vn', NULL, '+84352209866', 'ẻhẻh', 2, NULL, NULL, 0, 1, 1680178277, 0),
(39, '34y34y', 'y34y6', 'y34y6', '8eb64d11619c1950cf054b10fb60cf89', 'tungpv@breadntea.vn', NULL, '+84352209866', 'ẻhẻh', 2, NULL, NULL, 0, 1, 1680178388, 0),
(41, '34y3', 'y4y3', 'y4y3', '8eb64d11619c1950cf054b10fb60cf89', 'tungp3v@breadntea.vn', NULL, '0352209866', 'h5', 3, NULL, NULL, 0, 1, 1680179423, 0),
(43, 'dfg', 'y4y35h5h5', 'y4y35h5h5', '8eb64d11619c1950cf054b10fb60cf89', 'tungpv@breadntea.vn6', NULL, '+84352209866', 'greg', 1, NULL, NULL, 0, 1, 1680225693, 1680230275);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_log`
--

CREATE TABLE `admin_log` (
  `ADL_id` int(10) UNSIGNED NOT NULL,
  `ADL_admin_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADL_action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADL_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ADL_created_date` int(11) NOT NULL DEFAULT 0,
  `ADL_changed_date` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_log`
--

INSERT INTO `admin_log` (`ADL_id`, `ADL_admin_username`, `ADL_action`, `ADL_status`, `ADL_created_date`, `ADL_changed_date`) VALUES
(2, 'a', 'Xoá tài khoản quản trị a', 1, 1680163467, 0),
(3, 'a', 'Xoá tài khoản quản trị a', 1, 1680163708, 0),
(4, 'a', 'Xoá tài khoản quản trị a', 1, 1680163733, 0),
(5, 'a', 'Xoá tài khoản quản trị b', 1, 1680163819, 0),
(6, 'a', 'Khôi phục tài khoản quản trị b', 1, 1680164113, 0),
(7, 'a', 'Xoá tài khoản quản trị b', 1, 1680164206, 0),
(8, 'a', 'Xoá tài khoản quản trị a', 1, 1680164208, 0),
(9, 'a', 'Khôi phục tài khoản quản trị a', 1, 1680164235, 0),
(10, 'a', 'Xoá vĩnh viễn tài khoản quản trị b', 1, 1680164390, 0),
(11, 'a', 'Xoá tài khoản quản trị m', 1, 1680167768, 0),
(12, 'a', 'Xoá tài khoản quản trị l', 1, 1680167771, 0),
(13, 'a', 'Xoá tài khoản quản trị k', 1, 1680167773, 0),
(14, 'a', 'Khôi phục tài khoản quản trị m', 1, 1680167780, 0),
(15, 'a', 'Khôi phục tài khoản quản trị l', 1, 1680167782, 0),
(16, 'a', 'Khôi phục tài khoản quản trị k', 1, 1680167784, 0),
(17, 'a', 'Tạo mới tài khoản quản trị y4y35h5h5', 1, 1680225693, 0),
(18, 'a', 'Chỉnh sửa thông tin tài khoản quản trị ', 1, 1680230245, 0),
(19, 'a', 'Chỉnh sửa thông tin tài khoản quản trị ', 1, 1680230256, 0),
(20, 'a', 'Chỉnh sửa thông tin tài khoản quản trị ', 1, 1680230265, 0),
(21, 'a', 'Chỉnh sửa thông tin tài khoản quản trị ', 1, 1680230275, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_role`
--

CREATE TABLE `admin_role` (
  `ADR_id` int(10) UNSIGNED NOT NULL,
  `ADR_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADR_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ADR_extend_data` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `ADR_permission` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `ADR_order_prioritize` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `ADR_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ADR_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ADR_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_role`
--

INSERT INTO `admin_role` (`ADR_id`, `ADR_name`, `ADR_slug`, `ADR_extend_data`, `ADR_permission`, `ADR_order_prioritize`, `ADR_status`, `ADR_created_date`, `ADR_changed_date`) VALUES
(1, 'Quản trị hệ thống', 'quan-tri-he-thong', '', '', 0, 1, 0, 0),
(2, 'Quản trị viên', 'quan-tri-vien', '', '', 0, 1, 0, 0),
(3, 'Cộng tác viên', 'cong-tac-vien', '', '', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `artifacts`
--

CREATE TABLE `artifacts` (
  `ATF_id` int(10) UNSIGNED NOT NULL,
  `ATF_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ATF_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ATF_another_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ATF_parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ATF_register_serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_collection_serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_classify_serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_other_serial` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_special_relics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_manufacturing_situation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `ATF_3d_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_avatar` int(10) UNSIGNED DEFAULT NULL,
  `ATF_images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Length, Width, Height...',
  `ATF_warehouse_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_chest_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_tier_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_archive_time` int(11) DEFAULT NULL,
  `ATF_register_archive_time` int(11) DEFAULT NULL,
  `ATF_create_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_collect_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_use_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_discover_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_create_place` int(10) UNSIGNED DEFAULT NULL,
  `ATF_use_place` int(10) UNSIGNED DEFAULT NULL,
  `ATF_collect_place` int(10) UNSIGNED DEFAULT NULL,
  `ATF_creator` int(10) UNSIGNED DEFAULT NULL,
  `ATF_user` int(10) UNSIGNED DEFAULT NULL,
  `ATF_collector` int(10) UNSIGNED DEFAULT NULL,
  `ATF_owner` int(10) UNSIGNED DEFAULT NULL,
  `ATF_last_owner` int(10) UNSIGNED DEFAULT NULL,
  `ATF_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_insurance_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_valuation_board` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_valuation_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_references_documents` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_legal_documents` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ATF_order_prioritize` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `ATF_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ATF_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ATF_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Hiện vật';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `CTG_id` int(10) UNSIGNED NOT NULL,
  `CTG_parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `CTG_taxonomy` int(10) UNSIGNED NOT NULL,
  `CTG_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CTG_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CTG_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CTG_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CTG_order_prioritize` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `CTG_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CTG_extend_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CTG_extend_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CTG_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `CTG_created_date` int(11) NOT NULL DEFAULT 0,
  `CTG_changed_date` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`CTG_id`, `CTG_parent_id`, `CTG_taxonomy`, `CTG_name`, `CTG_slug`, `CTG_avatar`, `CTG_icon`, `CTG_order_prioritize`, `CTG_description`, `CTG_extend_data`, `CTG_extend_fields`, `CTG_status`, `CTG_created_date`, `CTG_changed_date`) VALUES
(1, 0, 1, 'Ảnh', 'image', NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0),
(2, 0, 1, 'Video', 'video', NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0),
(3, 0, 1, 'Tài liệu', 'document', NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0),
(4, 3, 1, 'Docx', 'docx', NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0),
(5, 3, 1, 'PDF', 'pdf', NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0),
(6, 3, 1, 'Excel', 'excel', NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cms_feature`
--

CREATE TABLE `cms_feature` (
  `CF_id` int(10) UNSIGNED NOT NULL,
  `CF_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CF_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CF_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `CF_controller` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `CF_order_prioritize` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `CF_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `CF_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `CF_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department`
--

CREATE TABLE `department` (
  `DPM_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department_regency`
--

CREATE TABLE `department_regency` (
  `DPMR_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `documents`
--

CREATE TABLE `documents` (
  `DCM_id` int(10) UNSIGNED NOT NULL,
  `DCM_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DCM_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DCM_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `DCM_media` int(10) UNSIGNED NOT NULL,
  `DCM_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `DCM_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `DCM_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `EPL_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filter`
--

CREATE TABLE `filter` (
  `FTL_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filter_criteria`
--

CREATE TABLE `filter_criteria` (
  `FTC_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission`
--

CREATE TABLE `permission` (
  `PMS_id` int(10) UNSIGNED NOT NULL,
  `PMS_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PMS_slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PMS_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PMS_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `PMS_created_date` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission`
--

INSERT INTO `permission` (`PMS_id`, `PMS_name`, `PMS_slug`, `PMS_description`, `PMS_status`, `PMS_created_date`) VALUES
(1, 'Thêm mới', 'create', NULL, 1, 0),
(2, 'Chỉnh sửa', 'update', NULL, 1, 0),
(3, 'Ném vào thùng rác', 'delete', NULL, 1, 0),
(4, 'Xoá vĩnh viễn', 'remove', NULL, 1, 0),
(5, 'In', 'print', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_of_admin`
--

CREATE TABLE `permission_of_admin` (
  `POA_admin_id` int(10) UNSIGNED NOT NULL,
  `POA_feature_id` int(10) UNSIGNED NOT NULL,
  `POA_permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `P_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `record_count`
--

CREATE TABLE `record_count` (
  `RC_id` int(11) UNSIGNED NOT NULL,
  `RC_table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RC_total_rows_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `RC_using_rows_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `RC_trash_rows_count` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `record_count`
--

INSERT INTO `record_count` (`RC_id`, `RC_table_name`, `RC_total_rows_count`, `RC_using_rows_count`, `RC_trash_rows_count`) VALUES
(1, 'admin', 18, 18, 0),
(2, 'admin_log', 20, 20, 0),
(3, 'admin_role', 3, 3, 0),
(4, 'artifacts', 0, 0, 0),
(5, 'taxonomi', 1, 1, 0),
(6, 'categories', 6, 6, 0),
(7, 'cms_feature', 0, 0, 0),
(8, 'department', 0, 0, 0),
(9, 'department_regency', 0, 0, 0),
(10, 'documents', 0, 0, 0),
(11, 'employee', 0, 0, 0),
(12, 'filter', 0, 0, 0),
(13, 'filter_criteria', 0, 0, 0),
(14, 'permission', 5, 5, 0),
(15, 'related_events', 0, 0, 0),
(16, 'related_person', 0, 0, 0),
(17, 'related_places', 0, 0, 0),
(18, 'status', 3, 3, 0),
(19, 'tags', 0, 0, 0),
(20, 'uploaded_files', 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `related_person`
--

CREATE TABLE `related_person` (
  `RPS_id` int(10) UNSIGNED NOT NULL,
  `RPS_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPS_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPS_story` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RPS_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `RPS_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `RPS_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `related_places`
--

CREATE TABLE `related_places` (
  `RPL_id` int(10) UNSIGNED NOT NULL,
  `RPL_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPL_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RPL_parent_id` int(10) UNSIGNED DEFAULT 0,
  `RPL_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RPL_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `RPL_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `RPL_chaged_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `S_id` tinyint(3) UNSIGNED NOT NULL,
  `S_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `S_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `S_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `S_order_prioritize` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `S_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `S_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `status`
--

INSERT INTO `status` (`S_id`, `S_name`, `S_slug`, `S_description`, `S_order_prioritize`, `S_created_date`, `S_changed_date`) VALUES
(1, 'Kích hoạt', NULL, NULL, 1, 0, 0),
(2, 'Tạm ngưng', NULL, NULL, 2, 0, 0),
(3, 'Ẩn', NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `TAG_id` int(10) UNSIGNED NOT NULL,
  `TAG_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TAG_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TAG_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `TAG_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `TAG_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `TAG_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taxonomy`
--

CREATE TABLE `taxonomy` (
  `TXNM_id` int(10) UNSIGNED NOT NULL,
  `TXNM_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TXNM_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TXNM_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TXNM_extend` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TXNM_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `TXNM_created_date` int(11) NOT NULL DEFAULT 0,
  `TXNM_chaged_date` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taxonomy`
--

INSERT INTO `taxonomy` (`TXNM_id`, `TXNM_name`, `TXNM_slug`, `TXNM_description`, `TXNM_extend`, `TXNM_status`, `TXNM_created_date`, `TXNM_chaged_date`) VALUES
(1, 'Loại file', 'loai-file', NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `ULF_id` int(10) UNSIGNED NOT NULL,
  `ULF_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ULF_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ULF_type` int(10) UNSIGNED NOT NULL,
  `ULF_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ULF_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ULF_extend_data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'title, alt, class, basic config...',
  `ULF_order_prioritize` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `ULF_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ULF_created_date` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ULF_changed_date` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `(X)related_events`
--
ALTER TABLE `(X)related_events`
  ADD PRIMARY KEY (`REV_id`),
  ADD UNIQUE KEY `REV_slug` (`REV_slug`),
  ADD KEY `FK_(X)related_events_status` (`REV_status`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADM_id`),
  ADD UNIQUE KEY `ADM_username` (`ADM_username`),
  ADD UNIQUE KEY `ADM_email` (`ADM_email`),
  ADD UNIQUE KEY `ADM_slug` (`ADM_slug`),
  ADD KEY `FK_admin_status` (`ADM_status`),
  ADD KEY `FK_admin_admin_role` (`ADM_role`);

--
-- Chỉ mục cho bảng `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`ADL_id`),
  ADD KEY `FK_admin_log_admin` (`ADL_admin_username`),
  ADD KEY `FK_admin_log_status` (`ADL_status`);

--
-- Chỉ mục cho bảng `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`ADR_id`),
  ADD UNIQUE KEY `ADR_name` (`ADR_name`),
  ADD UNIQUE KEY `ADR_slug` (`ADR_slug`),
  ADD KEY `FK_admin_role_status` (`ADR_status`);

--
-- Chỉ mục cho bảng `artifacts`
--
ALTER TABLE `artifacts`
  ADD PRIMARY KEY (`ATF_id`),
  ADD UNIQUE KEY `ATF_slug` (`ATF_slug`),
  ADD KEY `FK_artifacts_status` (`ATF_status`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CTG_id`),
  ADD UNIQUE KEY `CTG_slug` (`CTG_slug`),
  ADD KEY `FK_category_taxonomy` (`CTG_taxonomy`),
  ADD KEY `FK_categories_status` (`CTG_status`);

--
-- Chỉ mục cho bảng `cms_feature`
--
ALTER TABLE `cms_feature`
  ADD PRIMARY KEY (`CF_id`),
  ADD UNIQUE KEY `CF_controller` (`CF_controller`),
  ADD UNIQUE KEY `CF_name` (`CF_name`),
  ADD UNIQUE KEY `CF_slug` (`CF_slug`),
  ADD KEY `FK_cms_feature_status` (`CF_status`);

--
-- Chỉ mục cho bảng `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DPM_id`);

--
-- Chỉ mục cho bảng `department_regency`
--
ALTER TABLE `department_regency`
  ADD PRIMARY KEY (`DPMR_id`);

--
-- Chỉ mục cho bảng `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DCM_id`),
  ADD KEY `FK_documents_status` (`DCM_status`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EPL_id`);

--
-- Chỉ mục cho bảng `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`FTL_id`);

--
-- Chỉ mục cho bảng `filter_criteria`
--
ALTER TABLE `filter_criteria`
  ADD PRIMARY KEY (`FTC_id`);

--
-- Chỉ mục cho bảng `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`PMS_id`),
  ADD UNIQUE KEY `PMS_name` (`PMS_name`),
  ADD UNIQUE KEY `PMS_slug` (`PMS_slug`),
  ADD KEY `FK_permission_status` (`PMS_status`);

--
-- Chỉ mục cho bảng `permission_of_admin`
--
ALTER TABLE `permission_of_admin`
  ADD PRIMARY KEY (`POA_admin_id`,`POA_feature_id`,`POA_permission_id`),
  ADD KEY `FK__cms_feature` (`POA_feature_id`),
  ADD KEY `FK__permission` (`POA_permission_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`P_id`);

--
-- Chỉ mục cho bảng `record_count`
--
ALTER TABLE `record_count`
  ADD PRIMARY KEY (`RC_id`),
  ADD UNIQUE KEY `RC_table_name` (`RC_table_name`);

--
-- Chỉ mục cho bảng `related_person`
--
ALTER TABLE `related_person`
  ADD PRIMARY KEY (`RPS_id`),
  ADD UNIQUE KEY `RPS_slug` (`RPS_slug`),
  ADD KEY `FK_related_person_status` (`RPS_status`);

--
-- Chỉ mục cho bảng `related_places`
--
ALTER TABLE `related_places`
  ADD PRIMARY KEY (`RPL_id`) USING BTREE,
  ADD UNIQUE KEY `RPL_slug` (`RPL_slug`),
  ADD KEY `FK_related_places_status` (`RPL_status`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`S_id`),
  ADD UNIQUE KEY `S_name` (`S_name`),
  ADD UNIQUE KEY `S_slug` (`S_slug`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`TAG_id`),
  ADD UNIQUE KEY `TAG_name` (`TAG_name`),
  ADD UNIQUE KEY `TAG_slug` (`TAG_slug`),
  ADD KEY `FK_tags_status` (`TAG_status`);

--
-- Chỉ mục cho bảng `taxonomy`
--
ALTER TABLE `taxonomy`
  ADD PRIMARY KEY (`TXNM_id`),
  ADD UNIQUE KEY `TXNM_name` (`TXNM_name`),
  ADD UNIQUE KEY `TXNM_slug` (`TXNM_slug`),
  ADD KEY `FK_taxonomy_status` (`TXNM_status`);

--
-- Chỉ mục cho bảng `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`ULF_id`) USING BTREE,
  ADD UNIQUE KEY `ULF_slug` (`ULF_slug`),
  ADD KEY `FK_uploaded_files_status` (`ULF_status`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `(X)related_events`
--
ALTER TABLE `(X)related_events`
  MODIFY `REV_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `ADM_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `ADL_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `ADR_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `artifacts`
--
ALTER TABLE `artifacts`
  MODIFY `ATF_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `CTG_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cms_feature`
--
ALTER TABLE `cms_feature`
  MODIFY `CF_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `department`
--
ALTER TABLE `department`
  MODIFY `DPM_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `department_regency`
--
ALTER TABLE `department_regency`
  MODIFY `DPMR_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `documents`
--
ALTER TABLE `documents`
  MODIFY `DCM_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `employee`
--
ALTER TABLE `employee`
  MODIFY `EPL_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `filter`
--
ALTER TABLE `filter`
  MODIFY `FTL_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `filter_criteria`
--
ALTER TABLE `filter_criteria`
  MODIFY `FTC_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `PMS_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `P_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `record_count`
--
ALTER TABLE `record_count`
  MODIFY `RC_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `related_person`
--
ALTER TABLE `related_person`
  MODIFY `RPS_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `related_places`
--
ALTER TABLE `related_places`
  MODIFY `RPL_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `S_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `TAG_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taxonomy`
--
ALTER TABLE `taxonomy`
  MODIFY `TXNM_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `ULF_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `(X)related_events`
--
ALTER TABLE `(X)related_events`
  ADD CONSTRAINT `FK_(X)related_events_status` FOREIGN KEY (`REV_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_admin_role` FOREIGN KEY (`ADM_role`) REFERENCES `admin_role` (`ADR_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_admin_status` FOREIGN KEY (`ADM_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `admin_log`
--
ALTER TABLE `admin_log`
  ADD CONSTRAINT `FK_admin_log_admin` FOREIGN KEY (`ADL_admin_username`) REFERENCES `admin` (`ADM_username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_admin_log_status` FOREIGN KEY (`ADL_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `FK_admin_role_status` FOREIGN KEY (`ADR_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `artifacts`
--
ALTER TABLE `artifacts`
  ADD CONSTRAINT `FK_artifacts_status` FOREIGN KEY (`ATF_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_categories_status` FOREIGN KEY (`CTG_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_category_taxonomy` FOREIGN KEY (`CTG_taxonomy`) REFERENCES `taxonomy` (`TXNM_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cms_feature`
--
ALTER TABLE `cms_feature`
  ADD CONSTRAINT `FK_cms_feature_status` FOREIGN KEY (`CF_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `FK_documents_status` FOREIGN KEY (`DCM_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `FK_permission_status` FOREIGN KEY (`PMS_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permission_of_admin`
--
ALTER TABLE `permission_of_admin`
  ADD CONSTRAINT `FK__admin` FOREIGN KEY (`POA_admin_id`) REFERENCES `admin` (`ADM_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__cms_feature` FOREIGN KEY (`POA_feature_id`) REFERENCES `cms_feature` (`CF_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__permission` FOREIGN KEY (`POA_permission_id`) REFERENCES `permission` (`PMS_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `related_person`
--
ALTER TABLE `related_person`
  ADD CONSTRAINT `FK_related_person_status` FOREIGN KEY (`RPS_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `related_places`
--
ALTER TABLE `related_places`
  ADD CONSTRAINT `FK_related_places_status` FOREIGN KEY (`RPL_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `FK_tags_status` FOREIGN KEY (`TAG_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `taxonomy`
--
ALTER TABLE `taxonomy`
  ADD CONSTRAINT `FK_taxonomy_status` FOREIGN KEY (`TXNM_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD CONSTRAINT `FK_uploaded_files_status` FOREIGN KEY (`ULF_status`) REFERENCES `status` (`S_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
