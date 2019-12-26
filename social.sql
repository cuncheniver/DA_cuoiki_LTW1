-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 26, 2019 lúc 01:55 PM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `social`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `read` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `type`, `value`, `read`, `time`) VALUES
(1, 1, 2, 'ahihi, liuliu ', '', '', 0, '2019-12-25 16:10:25'),
(2, 1, 2, 'trả lời mình đi mà', '', '', 0, '2019-12-25 16:10:38'),
(3, 1, 2, 'huhu', '', '', 0, '2019-12-25 16:10:46'),
(4, 1, 2, 'rồi nè', '', '', 0, '2019-12-25 16:27:40'),
(5, 2, 1, 'quỳ', '', '', 0, '2019-12-25 16:28:01'),
(6, 1, 2, 'a', '', '', 0, '2019-12-25 16:28:42'),
(7, 1, 2, 'b', '', '', 0, '2019-12-25 16:28:49'),
(8, 1, 2, 'c', '', '', 0, '2019-12-25 16:28:50'),
(9, 1, 2, 'k', '', '', 0, '2019-12-25 16:31:21'),
(10, 1, 2, 'ư ư ư ', '', '', 0, '2019-12-25 16:34:35'),
(11, 1, 2, '', 'picture', '18425203_1968810340072131_4466984801651272802_n.jpg', 0, '2019-12-26 12:45:43'),
(12, 1, 3, 'eee', '', '', 0, '2019-12-26 12:46:00'),
(13, 3, 1, 'sao hả ', '', '', 0, '2019-12-26 12:46:48'),
(14, 1, 3, 'em yêu anh ', '', '', 0, '2019-12-26 12:46:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `content` text NOT NULL,
  `value` varchar(1024) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likes` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `uid`, `postid`, `content`, `value`, `time`, `likes`) VALUES
(60, 1, 54, 'ổn ', '', '2019-12-23 17:57:53', 1),
(59, 2, 51, '', '74677125_817768911970777_5688752692575338496_o.jpg', '2019-12-24 21:02:35', 2),
(57, 2, 51, 'text', '', '2019-12-23 10:48:57', 0),
(58, 2, 51, 'a', 'Tuong-chi-de-song-ao-giua-thap-Eiffel-con-co-ca-nha-hang-va-bi-an-nhat-la-can-ho-khong-lo-nam-tren-dinh-9.jpg', '2019-12-23 17:49:42', 1),
(56, 2, 51, 'okia', '', '2019-12-23 10:39:50', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `follow`
--

CREATE TABLE `follow` (
  `user1Id` int(100) NOT NULL,
  `user2Id` int(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `follow`
--

INSERT INTO `follow` (`user1Id`, `user2Id`, `createAt`) VALUES
(1, 2, '2019-12-23 17:09:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `friends`
--

CREATE TABLE `friends` (
  `user1Id` int(100) NOT NULL,
  `user2Id` int(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `friends`
--

INSERT INTO `friends` (`user1Id`, `user2Id`, `createAt`) VALUES
(1, 2, '2019-12-23 23:59:23'),
(2, 1, '2019-12-23 23:59:04'),
(3, 1, '2019-12-25 21:41:58'),
(1, 3, '2019-12-25 21:40:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `friendship`
--

CREATE TABLE `friendship` (
  `userId1` int(11) NOT NULL,
  `userId2` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `likes`
--

INSERT INTO `likes` (`postId`, `userId`, `createdAt`, `type`) VALUES
(48, 1, '2019-12-23 14:05:40', 0),
(49, 2, '2019-12-23 15:22:21', 0),
(51, 1, '2019-12-23 14:30:53', 0),
(52, 1, '2019-12-23 14:05:06', 0),
(53, 1, '2019-12-23 14:00:47', 0),
(54, 1, '2019-12-23 10:57:53', 0),
(54, 2, '2019-12-23 15:16:26', 0),
(55, 1, '2019-12-23 15:18:44', 0),
(55, 2, '2019-12-23 17:45:51', 0),
(58, 1, '2019-12-23 17:49:41', 1),
(59, 1, '2019-12-23 17:58:33', 1),
(59, 2, '2019-12-24 21:02:34', 1),
(60, 1, '2019-12-23 17:57:53', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id` int(100) UNSIGNED NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id`, `user_name`, `password`, `email`) VALUES
(1, 'tranphu', 'bc2ca1373d6e9fa0a25551d9f6cddc47', 'nguyentranphu1233@gmail.com'),
(2, 'quan', '8c198691d0e39b4d7ac090b390ce9ba9', 'nmquanvn@gmail.com'),
(3, 'nhat', 'f222b283f4a23f9c7364e482418d722b', 'dxxx@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromUserId` int(11) NOT NULL,
  `toUserId` int(11) NOT NULL,
  `createdAt` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `child` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `from`, `to`, `parent`, `child`, `type`, `read`, `time`) VALUES
(13, 1, 2, 48, 0, 1, 0, '2019-12-23 14:05:41'),
(14, 1, 2, 51, 0, 1, 0, '2019-12-23 14:10:25'),
(15, 1, 2, 51, 0, 1, 0, '2019-12-23 14:12:39'),
(16, 1, 2, 51, 0, 1, 0, '2019-12-23 14:14:11'),
(17, 1, 2, 51, 0, 1, 0, '2019-12-23 14:14:43'),
(18, 1, 2, 51, 0, 1, 0, '2019-12-23 14:18:28'),
(19, 1, 2, 51, 0, 1, 0, '2019-12-23 14:30:53'),
(20, 2, 1, 54, 0, 1, 0, '2019-12-23 15:16:26'),
(21, 1, 2, 55, 0, 1, 0, '2019-12-23 15:18:44'),
(22, 2, 1, 49, 0, 1, 0, '2019-12-23 15:22:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(12) NOT NULL,
  `uid` int(32) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `value` varchar(1024) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `public` int(11) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL DEFAULT '0',
  `shares` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `uid`, `content`, `type`, `value`, `time`, `public`, `likes`, `comments`, `shares`) VALUES
(47, 1, 'helo', 'images', '', '2019-12-22 16:55:33', 1, 0, 0, 0),
(48, 2, 'accoool', 'images', '', '2019-12-23 14:05:41', 1, 1, 0, 0),
(49, 1, 'chỉ bạn mới thấy\r\n', 'images', '', '2019-12-23 15:22:22', 2, 1, 0, 0),
(50, 1, 'chỉ mình tôi', 'images', '', '2019-12-23 10:02:07', 0, 0, 0, 0),
(51, 2, 'ak', 'images', '', '2019-12-23 14:30:53', 1, 1, 0, 0),
(52, 1, 'ssss', 'images', '', '2019-12-23 14:05:07', 1, 1, 0, 0),
(53, 1, 'giờ mới biết luôn', 'images', '', '2019-12-23 14:00:47', 1, 1, 0, 0),
(54, 1, 'hihi ', 'images', '', '2019-12-23 15:16:26', 1, 2, 0, 0),
(55, 2, 'aaa', 'images', '', '2019-12-23 17:45:52', 1, 2, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profile`
--

CREATE TABLE `profile` (
  `id` int(100) UNSIGNED NOT NULL,
  `user_ID` int(100) NOT NULL,
  `user_fullName` varchar(225) CHARACTER SET utf8mb4 NOT NULL,
  `user_contact` int(11) NOT NULL,
  `user_image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `profile`
--

INSERT INTO `profile` (`id`, `user_ID`, `user_fullName`, `user_contact`, `user_image`) VALUES
(1, 1, 'Nguyễn Trần Phú               ', 367931438, '1.jpg'),
(2, 2, 'Nguyễn Minh Quân   ', 929011099, '2.png'),
(3, 3, 'Trần Văn Nhất         ', 93823191, '3.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unread_chat_messages` (`from`,`to`,`read`),
  ADD KEY `update_chat_status` (`to`,`read`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`userId1`,`userId2`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`postId`,`userId`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_activity` (`from`,`type`),
  ADD KEY `notifications_widget` (`to`,`type`,`read`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `public` (`public`),
  ADD KEY `type` (`type`),
  ADD KEY `uid` (`uid`),
  ADD KEY `time` (`time`),
  ADD KEY `news_feed` (`uid`,`public`),
  ADD KEY `value` (`value`(255));

--
-- Chỉ mục cho bảng `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
