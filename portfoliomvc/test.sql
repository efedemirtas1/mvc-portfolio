-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Mar 2022, 20:42:27
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `test`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `short_description` text COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `seo_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo_description` varchar(160) COLLATE utf8_turkish_ci NOT NULL,
  `seo_keyword` text COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) DEFAULT 0,
  `home_active` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `short_description`, `description`, `seo_url`, `seo_description`, `seo_keyword`, `rank`, `home_active`, `is_active`, `img_url`, `creat_date`, `update_date`) VALUES
(63, 'Portfolyo-1', '0', '<p>İ&ccedil;erik Kısa A&ccedil;ıklama</p>\r\n', '<p>İ&ccedil;erik Genel A&ccedil;ıklama&nbsp;</p>\r\n', 'portfolyo-1', '', '', 0, 0, 1, '', '2022-03-02 17:40:29', '2022-03-03 15:04:58'),
(64, 'Portfolyo-2', '0', '<p>Lorem ipsum....</p>\r\n', '<p>Lorem ipsum (a&ccedil;ıklama kısmı)...</p>\r\n', 'portfolyo-2', '', '', 1, 0, 1, '', '2022-03-03 14:53:01', '2022-03-03 15:04:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_images`
--

CREATE TABLE `blog_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `cover_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blog_images`
--

INSERT INTO `blog_images` (`id`, `item_id`, `img_url`, `rank`, `is_active`, `cover_active`, `creat_date`) VALUES
(3, 63, 'web-portfoly-1.jpg', 0, 1, 0, '2022-03-03 14:51:51'),
(4, 64, 'banner.jpg', 0, 1, 0, '2022-03-03 14:53:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `ust_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `modul_metod` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `seo_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) NOT NULL,
  `home_active` tinyint(4) DEFAULT 0,
  `is_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `category` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `link` text COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) DEFAULT 0,
  `home_active` tinyint(4) DEFAULT 0,
  `is_active` tinyint(4) DEFAULT 1,
  `creat_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`id`, `title`, `category`, `icon`, `link`, `description`, `rank`, `home_active`, `is_active`, `creat_date`, `update_date`) VALUES
(2, '@#', 'sosyal-medya', 'instagram', '', '', 1, 1, 1, '2021-08-12 10:22:52', '2022-03-01 16:09:03'),
(3, 'Telefon', 'bilgi', 'phone', '', '<p>------- / -------</p>\r\n', 4, 0, 1, '2021-08-12 10:24:02', '2022-02-09 14:30:18'),
(4, 'E-posta', 'bilgi', 'envelope', '', '<p>info@deneme.com</p>\r\n', 3, 0, 1, '2021-08-12 10:25:23', '2022-03-01 16:09:25'),
(5, '@#', 'sosyal-medya', 'twitter', '', '', 0, 1, 1, '2021-08-23 21:12:18', '2022-03-01 16:08:56'),
(6, '@#', 'sosyal-medya', 'facebook', '', '', 2, 1, 1, '2021-08-23 21:13:32', '2022-03-01 16:09:10'),
(7, 'Adres', 'bilgi', 'map-marker', '', '<p>------</p>\r\n', 5, 0, 1, '2021-08-29 09:46:44', '2022-02-09 14:30:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `durum` tinyint(4) NOT NULL DEFAULT 0,
  `ip` text COLLATE utf8_turkish_ci NOT NULL,
  `json_data` text COLLATE utf8_turkish_ci NOT NULL,
  `creat_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `icon_pack`
--

CREATE TABLE `icon_pack` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `theme` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `icon_pack`
--

INSERT INTO `icon_pack` (`id`, `title`, `icon`, `theme`) VALUES
(1, 'Activity', 'activity', 0),
(2, 'Airplay', 'airplay', 0),
(3, 'Alert Circle', 'alert-circle', 0),
(4, 'Alert Octagon', 'alert-octagon', 0),
(5, 'Alert Triangle', 'alert-triangle', 0),
(6, 'Align Center', 'align-center', 0),
(7, 'Align Justify', 'align-justify', 0),
(8, 'Align Left', 'align-left', 0),
(9, 'Align Right', 'align-right', 0),
(10, 'Anchor', 'anchor', 0),
(11, 'Archive', 'archive', 0),
(12, 'At Sign', 'at-sign', 0),
(13, 'Award', 'award', 0),
(14, 'Aperture', 'aperture', 0),
(15, 'Bar Chart', 'bar-chart', 0),
(16, 'Bar Chart 2', 'bar-chart-2', 0),
(17, 'Battery', 'battery', 0),
(18, 'Battery Charging', 'battery-charging', 0),
(19, 'Bell', 'bell', 0),
(20, 'Bell Off', 'bell-off', 0),
(21, 'Bluetooth', 'bluetooth', 0),
(22, 'Book Open', 'book-open', 0),
(23, 'Book', 'book', 0),
(24, 'Bookmark', 'bookmark', 0),
(25, 'Box', 'box', 0),
(26, 'Briefcase', 'briefcase', 0),
(27, 'Calendar', 'calendar', 0),
(28, 'Camera', 'camera', 0),
(29, 'Cast', 'cast', 0),
(30, 'Circle', 'circle', 0),
(31, 'Clipboard', 'clipboard', 0),
(32, 'Clock', 'clock', 0),
(33, 'Cloud Drizzle', 'cloud-drizzle', 0),
(34, 'Cloud Lightning', 'cloud-lightning', 0),
(35, 'Cloud Rain', 'cloud-rain', 0),
(36, 'Cloud Snow', 'cloud-snow', 0),
(37, 'Cloud', 'cloud', 0),
(38, 'Codepen', 'codepen', 0),
(39, 'Codesandbox', 'codesandbox', 0),
(40, 'Code', 'code', 0),
(41, 'Coffee', 'coffee', 0),
(42, 'Columns', 'columns', 0),
(43, 'Command', 'command', 0),
(44, 'Compass', 'compass', 0),
(45, 'Copy', 'copy', 0),
(46, 'Corner Down Left', 'corner-down-left', 0),
(47, 'Corner Down Right', 'corner-down-right', 0),
(48, 'Corner Left Down', 'corner-left-down', 0),
(49, 'Corner Left Up', 'corner-left-up', 0),
(50, 'Corner Right Down', 'corner-right-down', 0),
(51, 'Corner Right Up', 'corner-right-up', 0),
(52, 'Corner Up Left', 'corner-up-left', 0),
(53, 'Corner Up Right', 'corner-up-right', 0),
(54, 'Cpu', 'cpu', 0),
(55, 'Credit Card', 'credit-card', 0),
(56, 'Crop', 'crop', 0),
(57, 'Crosshair', 'crosshair', 0),
(58, 'Database', 'database', 0),
(59, 'Delete', 'delete', 0),
(60, 'Disc', 'disc', 0),
(61, 'Dollar Sign', 'dollar-sign', 0),
(62, 'Droplet', 'droplet', 0),
(63, 'Edit', 'edit', 0),
(64, 'Edit 2', 'edit', 0),
(65, 'Edit 3', 'edit', 0),
(66, 'Eye', 'eye', 0),
(67, 'Eye Off', 'eye-off', 0),
(68, 'External Link', 'external-link', 0),
(69, 'Facebook', 'facebook', 0),
(70, 'Fast Forward', 'fast-forward', 0),
(71, 'Figma', 'figma', 0),
(72, 'File Minus', 'file-minus', 0),
(73, 'File Plus', 'file-plus', 0),
(74, 'File Text', 'file-text', 0),
(75, 'Film', 'film', 0),
(76, 'Filter', 'filter', 0),
(77, 'Flag', 'flag', 0),
(78, 'Folder Minus', 'folder-minus', 0),
(79, 'Folder Plus', 'folder-plus', 0),
(80, 'Folder', 'folder', 0),
(81, 'Framer', 'framer', 0),
(82, 'Frown', 'frown', 0),
(83, 'Gift', 'gift', 0),
(84, 'Git Branch', 'git-branch', 0),
(85, 'Git Commit', 'git-commit', 0),
(86, 'Git Merge', 'git-merge', 0),
(87, 'Git Pull Request', 'git-pull-request', 0),
(88, 'Github', 'github', 0),
(89, 'Gitlab', 'gitlab', 0),
(90, 'Globe', 'globe', 0),
(91, 'Hard Drive', 'hard-drive', 0),
(92, 'Hash', 'hash', 0),
(93, 'Headphones', 'headphones', 0),
(94, 'Heart', 'heart', 0),
(95, 'Help Circle', 'help-circle', 0),
(96, 'Hexagon', 'hexagon', 0),
(97, 'Home', 'home', 0),
(98, 'İmage', 'image', 0),
(99, 'İnbox', 'inbox', 0),
(100, 'İnstagram', 'instagram', 0),
(101, 'Key', 'key', 0),
(102, 'Layers', 'layers', 0),
(103, 'Layout', 'layout', 0),
(104, 'Link', 'link', 0),
(105, 'Link 2', 'link-2', 0),
(106, 'Linkedin', 'linkedin', 0),
(107, 'List', 'list', 0),
(108, 'Lock', 'lock', 0),
(109, 'Log-in', 'log-in', 0),
(110, 'Log-out', 'log-out', 0),
(111, 'Mail', 'mail', 0),
(112, 'Map Pin', 'map-pin', 0),
(113, 'Map', 'map', 0),
(114, 'Maximize', 'maximize', 0),
(115, 'Maximize 2', 'maximize-2', 0),
(116, 'Meh', 'meh', 0),
(117, 'Menu', 'menu', 0),
(118, 'Message Circle', 'message-circle', 0),
(119, 'Message Square', 'message-square', 0),
(120, 'Mic off', 'mic-off', 0),
(121, 'Mic', 'mic', 0),
(122, 'Minimize', 'minimize', 0),
(123, 'Minimize2', 'minimize-2', 0),
(124, 'Minus', 'minus', 0),
(125, 'Monitor', 'monitor', 0),
(126, 'Moon', 'moon', 0),
(127, 'More Horizontal', 'more-horizontal', 0),
(128, 'More Vertical', 'more-vertical', 0),
(129, 'Mouse Pointer', 'mouse-pointer', 0),
(130, 'Move', 'move', 0),
(131, 'Music', 'music', 0),
(132, 'Navigation', 'navigation', 0),
(133, 'Navigation 2', 'navigation-2', 0),
(134, 'Octagon', 'octagon', 0),
(135, 'Package', 'package', 0),
(136, 'Paperclip', 'paperclip', 0),
(137, 'Pause', 'pause', 0),
(138, 'Pause Circle', 'pause-circle', 0),
(139, 'Pen Tool', 'pen-tool', 0),
(140, 'Percent', 'percent', 0),
(141, 'Phone Call', 'phone-call', 0),
(142, 'Phone Forwarded', 'phone-forwarded', 0),
(143, 'Phone İncoming', 'phone-incoming', 0),
(144, 'Phone Missed', 'phone-missed', 0),
(145, 'Phone Off', 'phone-off', 0),
(146, 'Phone Outgoing', 'phone-outgoing', 0),
(147, 'Phone', 'phone', 0),
(148, 'Play', 'play', 0),
(149, 'Pie Chart', 'pie-chart', 0),
(150, 'Play Circle', 'play-circle', 0),
(151, 'Plus', 'plus', 0),
(153, 'Plus Circle', 'plus-circle', 0),
(154, 'Plus Square', 'plus-square', 0),
(155, 'Pocket', 'pocket', 0),
(156, 'Power', 'power', 0),
(157, 'Printer\r\n', 'printer', 0),
(158, 'Radio', 'radio', 0),
(159, 'Refresh', 'refresh-cw', 0),
(160, 'Refresh-2', 'refresh-ccw', 0),
(161, 'Repeat', 'repeat', 0),
(162, 'Rewind', 'rewind', 0),
(163, 'Rotate', 'rotate-cw', 0),
(164, 'Rotate-2', 'rotate-ccw', 0),
(165, 'RSS', 'rss', 0),
(166, 'Save', 'save', 0),
(167, 'Scissors', 'scissors', 0),
(168, 'Search', 'search', 0),
(169, 'Send', 'send', 0),
(170, 'Settings', 'settings', 0),
(171, 'Share', 'share-2', 0),
(172, 'Shield', 'shield', 0),
(173, 'Shield Off', 'shield-off', 0),
(174, 'Shopping Bag', 'shopping-bag', 0),
(175, 'Shopping Cart', 'shopping-cart', 0),
(176, 'Shuffle', 'shuffle', 0),
(177, 'Skip Back', 'skip-back', 0),
(178, 'Skip Forward', 'skip-forward', 0),
(179, 'Slack', 'slack', 0),
(180, 'Slash', 'slash', 0),
(181, 'Sliders', 'sliders', 0),
(182, 'Smartphone', 'smartphone', 0),
(183, 'Smile', 'smile', 0),
(184, 'Speaker', 'speaker', 0),
(185, 'Star', 'star', 0),
(186, 'Stop Circle', 'stop-circle', 0),
(187, 'Sun', 'sun', 0),
(188, 'Sunrise', 'sunrise', 0),
(189, 'Sunset', 'sunset', 0),
(190, 'Tablet', 'tablet', 0),
(191, 'Tag', 'tag', 0),
(192, 'Target', 'target', 0),
(193, 'Terminal', 'terminal', 0),
(194, 'Thermometer', 'thermometer', 0),
(195, 'Thumbs Down', 'thumbs-down', 0),
(196, 'Thumbs Up', 'thumbs-up', 0),
(197, 'Toggle Left', 'toggle-left', 0),
(198, 'Toggle Right', 'toggle-right', 0),
(199, 'Tool', 'tool', 0),
(200, 'Trash', 'trash', 0),
(201, 'Trash 2', 'trash-2', 0),
(202, 'Triangle', 'triangle', 0),
(203, 'Truck', 'truck', 0),
(204, 'TV', 'tv', 0),
(205, 'Twitch', 'twitch', 0),
(206, 'Twitter', 'twitter', 0),
(207, 'Type', 'type', 0),
(208, 'Umbrella', 'umbrella', 0),
(209, 'Unlock', 'unlock', 0),
(210, 'User Check', 'user-check', 0),
(211, 'User Minus', 'user-minus', 0),
(212, 'User Plus', 'user-plus', 0),
(213, 'User-x', 'user-x', 0),
(214, 'User', 'user', 0),
(215, 'Users', 'users', 0),
(216, 'Video Off', 'video-off', 0),
(217, 'Video', 'video', 0),
(218, 'Voicemail', 'voicemail', 0),
(219, 'Volume', 'volume', 0),
(220, 'Volume 1', 'volume-1', 0),
(221, 'Volume 2', 'volume-2', 0),
(222, 'Volume x', 'volume-x', 0),
(223, 'Watch', 'watch', 0),
(224, 'Wifi Off', 'wifi-off', 0),
(225, 'Wifi', 'wifi', 0),
(226, 'Wind', 'wind', 0),
(227, 'Circle X', 'x-circle', 0),
(228, 'Octagon X', 'x-octagon', 0),
(229, 'Square X', 'x-square', 0),
(230, 'X', 'x', 0),
(231, 'Youtube', 'youtube', 0),
(232, 'Zap Off', 'zap-off', 0),
(233, 'Zap', 'zap', 0),
(234, 'Zoom İn', 'zoom-in', 0),
(235, 'Zoom Out', 'zoom-out', 0),
(240, 'Facebook Kare', 'facebook-square', 1),
(241, 'Facebook F', 'facebook-f', 1),
(242, 'Facebook', 'facebook', 1),
(243, 'Facebook Official', 'facebook-official', 1),
(244, 'İnstagram', 'instagram', 1),
(245, 'Behance', 'behance', 1),
(246, 'Behance Kare', 'behance-square', 1),
(247, 'Twitter', 'twitter', 1),
(248, 'Twitter Kare', 'twitter-square', 1),
(249, 'Youtube Play', 'youtube-play', 1),
(250, 'Youtube Kare', 'youtube-square', 1),
(252, 'Youtube', 'youtube', 1),
(253, 'Ev', 'home', 1),
(254, 'Cep Telefonu', 'mobile-phone', 1),
(255, 'Telefon Kare', 'phone-square', 1),
(256, 'Telefon', 'phone', 1),
(257, 'Harita Pin', 'map-marker', 1),
(258, 'Harita Pin 2', 'map-pin', 1),
(259, 'Yol Tarifi Tabela', 'map-signs', 1),
(260, 'Harita Geniş', 'map-o', 1),
(261, 'Mail Zarf 1', 'envelope', 1),
(262, 'Mail Zarf 2', 'envelope-o', 1),
(263, 'Mail Zarf Kare', 'envelope-square', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menus`
--

CREATE TABLE `menus` (
  `id` int(11) UNSIGNED NOT NULL,
  `ust_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `seo_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `external_url` text COLLATE utf8_turkish_ci NOT NULL,
  `modul_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) DEFAULT 0,
  `header_active` tinyint(4) DEFAULT NULL,
  `footer_active` tinyint(4) DEFAULT NULL,
  `left_active` tinyint(4) DEFAULT NULL,
  `special_active` tinyint(4) DEFAULT NULL,
  `target_active` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `menus`
--

INSERT INTO `menus` (`id`, `ust_id`, `title`, `seo_url`, `external_url`, `modul_url`, `rank`, `header_active`, `footer_active`, `left_active`, `special_active`, `target_active`, `is_active`, `creat_date`, `update_date`) VALUES
(2, 0, 'Anasayfa', '', '', 'index', 0, 1, NULL, 0, NULL, NULL, 1, '2021-11-01 19:53:09', '2021-11-01 19:53:09'),
(3, 0, 'Hakkımda', 'hakkimda', '', 'pages', 1, 1, NULL, NULL, NULL, NULL, 1, '2021-11-01 19:53:44', '2021-11-02 19:49:23'),
(6, 0, 'Portfölyo', 'portfolyo', '', 'blogs', 5, 1, NULL, NULL, NULL, NULL, 1, '2021-11-01 19:54:59', '2022-03-03 20:32:18'),
(8, 0, 'İletişim', 'iletisim', '', 'contact', 7, 1, NULL, NULL, NULL, NULL, 1, '2021-11-01 19:56:13', '2021-11-01 19:56:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `moduls`
--

CREATE TABLE `moduls` (
  `id` int(11) UNSIGNED NOT NULL,
  `ust_id` int(11) NOT NULL,
  `icon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo_description` varchar(160) COLLATE utf8_turkish_ci NOT NULL,
  `seo_keyword` text COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) DEFAULT 0,
  `home_active` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `moduls`
--

INSERT INTO `moduls` (`id`, `ust_id`, `icon`, `title`, `category`, `seo_url`, `seo_description`, `seo_keyword`, `rank`, `home_active`, `is_active`, `creat_date`, `update_date`) VALUES
(43, 0, 'layout', 'Sayfalar', 'grup1', 'pages', 'Bu sayfada kurumsal bilgiler yer alacaktır', 'sayfalar, kurumsal, hakkımızda, vizyon, misyon', 1, 1, 1, '2021-08-04 10:08:53', '2021-08-05 15:22:02'),
(51, 0, 'rss', 'Blog Yazıları', 'grup1', 'blogs', '', '', 3, 1, 1, '2021-08-04 10:29:01', '2022-03-03 20:29:50'),
(55, 0, 'monitor', 'Slayt', 'grup1', 'slides', '', '', 4, NULL, 1, '2021-08-04 10:36:39', '2021-08-10 10:57:49'),
(59, 0, 'home', 'Giriş', 'grup1', 'index', '', '', 0, 0, 1, '2021-08-04 10:41:40', '2021-11-03 10:06:13'),
(60, 0, 'menu', 'Menüler', 'grup1', 'menus', '', '', 5, NULL, 1, '2021-08-05 13:06:30', '2021-08-05 15:24:13'),
(72, 0, 'phone', 'İletişim Bilgileri', 'grup3', 'contact', '', '', 7, 1, 1, '2021-08-05 16:08:34', '2021-08-05 16:08:34'),
(74, 0, 'users', 'Kullanıcılar', 'grup4', 'users', '', '', 9, NULL, 1, '2021-08-05 16:09:56', '2021-08-05 16:09:56'),
(81, 80, 'bar-chart', 'Panel Logları', 'grup1', 'log-dashboard', '', '', 20, NULL, 0, '2021-08-05 16:20:31', '2021-08-05 16:20:31'),
(82, 80, 'bar-chart-2', 'Site Logları', 'grup1', 'sitelog', '', '', 20, NULL, 1, '2021-08-05 16:21:42', '2021-09-27 16:23:53'),
(83, 0, 'monitor', 'Site Ayarları', 'grup5', 'site-ayarlari', '', '', 12, NULL, 1, '2021-08-05 16:22:30', '2021-08-05 16:22:30'),
(84, 83, 'settings', 'Genel Ayarlar', 'grup1', 'settingsgeneral', '', '', 21, NULL, 1, '2021-08-05 16:25:05', '2021-08-12 14:26:24'),
(85, 83, 'type', 'Terimler', 'grup1', 'terms', '', '', 21, NULL, 1, '2021-08-05 16:34:29', '2021-10-14 15:33:24'),
(87, 0, 'settings', 'Panel Ayarları', 'grup5', 'panel-ayarlari', '', '', 13, NULL, 1, '2021-08-05 16:38:27', '2021-08-05 16:38:41'),
(88, 87, 'hexagon', 'Modüller', 'grup1', 'moduls', '', '', 22, NULL, 1, '2021-08-05 16:39:33', '2021-08-05 16:39:33'),
(91, 0, 'log-out', 'Çıkış Yap', 'grup5', 'logout', '', '', 15, NULL, 1, '2021-08-05 16:48:23', '2021-08-25 09:06:35'),
(95, 61, 'git-merge', 'Kategoriler', 'grup1', 'category', '', '', 1, 1, 1, '2021-08-24 14:41:38', '2021-09-14 17:24:01'),
(96, 61, 'list', 'Hizmet Listesi', 'grup1', 'services', '', '', 0, 1, 1, '2021-08-24 14:42:20', '2021-08-24 14:42:20'),
(105, 87, 'hash', 'İkonlar', 'grup1', 'icons', '', '', 27, NULL, 1, '2021-10-27 19:37:41', '2021-10-27 19:37:41'),
(107, 61, 'alert-circle', 'sss', 'grup3', 'sss', '', '', 14, 1, 1, '2022-03-02 18:49:24', '2022-03-02 18:51:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `template` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `short_description` text COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `seo_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `seo_description` varchar(160) COLLATE utf8_turkish_ci NOT NULL,
  `seo_keyword` text COLLATE utf8_turkish_ci NOT NULL,
  `rank` int(11) DEFAULT 0,
  `home_active` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `metod` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `title`, `template`, `short_description`, `description`, `seo_url`, `seo_description`, `seo_keyword`, `rank`, `home_active`, `is_active`, `img_url`, `metod`, `creat_date`, `update_date`) VALUES
(1, 'Hakkımda', '1', '<div class=\"about_top_text\" id=\"contentvh\">\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>\r\n', '<div class=\"about_top_text\">\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>\r\n', 'hakkimda', '', '', 0, 1, 1, '', 'about', '2021-11-01 20:44:54', '2022-03-01 16:07:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `page_images`
--

CREATE TABLE `page_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `cover_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `page_images`
--

INSERT INTO `page_images` (`id`, `item_id`, `img_url`, `rank`, `is_active`, `cover_active`, `creat_date`) VALUES
(4, 4, '22-icerik-1.jpg', 0, 1, 1, '2022-01-06 13:48:23'),
(5, 6, '23-icerik-1.jpg', 0, 1, 1, '2022-01-06 13:48:51'),
(6, 7, '24-icerik-1.jpg', 0, 1, 1, '2022-01-06 13:49:03'),
(7, 1, 'resim-11.jpg', 0, 1, 1, '2022-03-01 16:07:22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `tema` varchar(10) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'light',
  `slogan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `logo2` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `seo_description` varchar(160) COLLATE utf8_turkish_ci NOT NULL,
  `seo_keyword` text COLLATE utf8_turkish_ci NOT NULL,
  `smtp_protocol` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `smtp_sunucu` text COLLATE utf8_turkish_ci NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_eposta` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `smtp_sifre` text COLLATE utf8_turkish_ci NOT NULL,
  `head_script` text COLLATE utf8_turkish_ci NOT NULL,
  `footer_script` text COLLATE utf8_turkish_ci NOT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `title`, `tema`, `slogan`, `link`, `copyright`, `logo`, `logo2`, `seo_description`, `seo_keyword`, `smtp_protocol`, `smtp_sunucu`, `smtp_port`, `smtp_eposta`, `smtp_sifre`, `head_script`, `footer_script`, `creat_date`, `update_date`) VALUES
(5, 'Deneme Test Portfolyo', 'dark', '', '', '2021 Tüm hakları Saklıdır.', 'logo.png', 'logo.png', '', '', '', '', 0, '', '', '', '', '2021-08-12 15:19:56', '2022-03-01 20:07:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slides`
--

CREATE TABLE `slides` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `link1` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT 0,
  `is_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slides`
--

INSERT INTO `slides` (`id`, `title`, `link1`, `category`, `description`, `rank`, `is_active`, `creat_date`, `update_date`) VALUES
(44, 'Demo Slider-2', '#', 'resim', '', 1, 1, '2021-08-24 12:35:14', '2022-03-01 16:06:39'),
(47, 'Demo Slider-1', '#', 'resim', '', 0, 1, '2021-11-03 12:10:40', '2022-03-01 16:06:10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slide_images`
--

CREATE TABLE `slide_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `cover_active` tinyint(4) DEFAULT 0,
  `creat_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slide_images`
--

INSERT INTO `slide_images` (`id`, `item_id`, `img_url`, `rank`, `is_active`, `cover_active`, `creat_date`) VALUES
(62, 47, 'slider-31.jpg', 0, 1, 0, '2022-03-01 16:06:03'),
(63, 44, 'slider-41.jpg', 0, 1, 0, '2022-03-01 16:06:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `metod` varchar(250) NOT NULL,
  `theme` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `terms`
--

INSERT INTO `terms` (`id`, `text`, `metod`, `theme`, `is_active`, `creat_date`, `update_date`) VALUES
(1, 'Anasayfa', 'baslik-anasayfa', 1, 1, '2021-11-02 19:36:46', '2021-11-02 19:36:46'),
(2, 'Deneme Portfölyo Site', 'baslik-video', 1, 1, '2021-11-02 19:37:21', '2022-03-02 18:40:36'),
(3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'text-video', 1, 1, '2021-11-02 19:37:37', '2022-03-02 18:42:01'),
(4, 'Ad Soyad', 'form-ad-soyad', 1, 1, '2021-11-03 10:08:09', '2021-11-03 10:08:09'),
(5, 'E posta', 'form-eposta', 1, 1, '2021-11-03 10:08:25', '2021-11-03 10:08:25'),
(6, 'Telefon', 'form-tel', 1, 1, '2021-11-03 10:08:46', '2021-11-03 10:08:46'),
(7, 'Konu', 'form-konu', 1, 1, '2021-11-03 10:09:05', '2021-11-03 10:09:05'),
(8, 'Mesaj', 'form-mesaj', 1, 1, '2021-11-03 10:09:16', '2021-11-03 10:09:16'),
(9, 'Gönder', 'btn-gonder', 1, 1, '2021-11-03 10:09:31', '2021-11-03 10:09:31'),
(10, 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing', 'footer-kurumsaltxt', 1, 1, '2021-11-03 10:31:20', '2022-03-02 18:42:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `img_url` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `authority` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `power` text COLLATE utf8_turkish_ci NOT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `creat_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `img_url`, `user_name`, `full_name`, `email`, `password`, `authority`, `power`, `is_active`, `creat_date`, `update_date`) VALUES
(4, 'default-user4.png ', 'efedemirtas', 'efe demirtas', 'efe@biiclick.com', '6287c9d20a9d18ce3024a9e3946ce078', '0', '{\"giris\":{\"read\":\"on\"},\"sayfalar\":{\"read\":\"on\"},\"projeler\":{\"read\":\"on\"},\"bulten\":{\"read\":\"on\"},\"haberler\":{\"read\":\"on\"},\"blog-yazilari\":{\"read\":\"on\"},\"etkinlikler\":{\"read\":\"on\"},\"slayt\":{\"read\":\"on\"},\"menuler\":{\"read\":\"on\"},\"hizmetler\":{\"read\":\"on\"},\"hizmet-listesi\":{\"read\":\"on\"},\"kategoriler\":{\"read\":\"on\"},\"iletisim-bilgileri\":{\"read\":\"on\"},\"gelen-kutusu\":{\"read\":\"on\"},\"kullanicilar\":{\"read\":\"on\"},\"dosya-yoneticisi\":{\"read\":\"on\"},\"istatistikler\":{\"read\":\"on\"},\"panel-loglari\":{\"read\":\"on\"},\"site-loglari\":{\"read\":\"on\"},\"site-ayarlari\":{\"read\":\"on\"},\"genel-ayarlar\":{\"read\":\"on\"},\"terimler\":{\"read\":\"on\"},\"dil\":{\"read\":\"on\"},\"panel-ayarlari\":{\"read\":\"on\"},\"moduller\":{\"read\":\"on\"},\"ikonlar\":{\"read\":\"on\"},\"cikis-yap\":{\"read\":\"on\"}}', 1, '2022-01-04 08:00:59', '2022-03-01 16:10:24');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blog_images`
--
ALTER TABLE `blog_images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `icon_pack`
--
ALTER TABLE `icon_pack`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `page_images`
--
ALTER TABLE `page_images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slide_images`
--
ALTER TABLE `slide_images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Tablo için AUTO_INCREMENT değeri `blog_images`
--
ALTER TABLE `blog_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `icon_pack`
--
ALTER TABLE `icon_pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- Tablo için AUTO_INCREMENT değeri `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `moduls`
--
ALTER TABLE `moduls`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `page_images`
--
ALTER TABLE `page_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `slide_images`
--
ALTER TABLE `slide_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Tablo için AUTO_INCREMENT değeri `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
