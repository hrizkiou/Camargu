--
-- Database: `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `postid` int NOT NULL,
  `userid` int NOT NULL,
  `data` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

-- INSERT INTO `comments` (`id`, `postid`, `userid`, `data`, `creation_date`) VALUES
-- (162, 27, 7, 'good', '2021-02-25 03:03:20'),
-- (163, 27, 7, 'good 2', '2021-02-25 03:05:07'),
-- (164, 27, 7, 'good 3', '2021-02-25 03:05:33'),
-- (165, 27, 7, 'good 4', '2021-02-25 03:08:28'),
-- (166, 27, 7, 'hhhhhh', '2021-02-25 03:11:06'),
-- (167, 27, 7, 'hhhhhh  kharia', '2021-02-25 03:12:05'),
-- (168, 27, 7, 'yaak', '2021-02-25 03:13:42'),
-- (169, 27, 7, 'yak tani', '2021-02-25 03:15:07'),
-- (170, 27, 7, 'ser', '2021-02-25 03:15:51'),
-- (171, 29, 7, 'Nice', '2021-02-25 03:18:35'),
-- (172, 27, 3, 'zamel', '2021-02-25 13:51:18'),
-- (173, 29, 28, 'KARIM L7MAR', '2021-02-25 13:58:55'),
-- (174, 28, 29, 'Hamza anouar lwasiim', '2021-02-25 15:07:10'),
-- (175, 30, 3, 'Hossam Limouni 3obayd Jadab li darajat 3adab = karrim azamlan', '2021-02-25 15:09:25'),
-- (176, 30, 3, 'Wayli a khouna', '2021-02-25 15:11:04'),
-- (177, 30, 3, 'Nice one', '2021-02-25 15:17:14'),
-- (178, 30, 3, '3awd daba', '2021-02-25 15:18:20'),
-- (179, 30, 3, 'Zeed', '2021-02-25 15:19:23'),
-- (180, 5, 30, 'yaak  a si', '2021-02-25 18:03:07'),
-- (181, 28, 30, 'nice one', '2021-02-25 18:08:48'),
-- (182, 28, 3, 'Nice a m3alem', '2021-02-26 02:18:25'),
-- (183, 34, 30, 'Nice', '2021-02-26 03:45:47'),
-- (184, 35, 23, 'Good', '2021-02-26 04:03:54'),
-- (185, 49, 30, 'nice on', '2021-02-26 05:47:52'),
-- (186, 50, 30, 'niceeee', '2021-02-26 05:50:03'),
-- (191, 74, 31, 'Nice man', '2021-03-01 17:07:12'),
-- (192, 62, 32, 'Wjeh bhal laftaa', '2021-03-01 17:50:59'),
-- (193, 75, 32, 'Yahya Zamel', '2021-03-01 18:06:09'),
-- (194, 75, 32, 'khouna', '2021-03-01 18:40:00'),
-- (195, 75, 32, 'ghabiiiiii', '2021-03-01 18:40:29'),
-- (196, 77, 32, 'Rodando', '2021-03-01 18:45:00'),
-- (198, 101, 34, 'nice a brogher', '2021-03-02 16:26:24'),
-- (199, 101, 34, 'brother', '2021-03-02 16:26:32'),
-- (200, 98, 34, '&lt;script&gt;alert(\'lhwa\');&lt;/script&gt;', '2021-03-02 16:29:27'),
-- (201, 101, 34, '&lt;script&gt;alert(\'xxx\');&lt;/script&gt;', '2021-03-02 16:30:01'),
-- (202, 101, 34, 'asdasd7', '2021-03-02 16:30:09'),
-- (204, 127, 37, 'nice this', '2021-03-03 21:30:15'),
-- (205, 128, 37, 'good to be back', '2021-03-03 21:30:38'),
-- (206, 128, 37, 'nice', '2021-03-03 21:31:15'),
-- (207, 128, 37, 'nice', '2021-03-03 21:31:17'),
-- (208, 128, 37, 'nice', '2021-03-03 21:31:18'),
-- (209, 128, 3, 'Okkk', '2021-03-03 21:51:23'),
-- (210, 128, 3, 'yasss', '2021-03-03 22:09:42'),
-- (211, 128, 3, 'oksiii', '2021-03-03 22:11:43'),
-- (212, 128, 3, 'Yass we caaaan!', '2021-03-03 22:12:33'),
-- (213, 128, 3, 'Yass we cannttt', '2021-03-03 22:28:12'),
-- (214, 128, 3, 'good', '2021-03-03 22:29:27'),
-- (215, 128, 3, 'good one', '2021-03-03 22:32:07'),
-- (216, 128, 3, 'nice nice', '2021-03-03 22:32:31'),
-- (217, 101, 38, 'wa zabi', '2021-03-04 15:01:34'),
-- (218, 101, 38, 'wa zabi', '2021-03-04 15:01:34'),
-- (219, 101, 38, '&lt;script&gt;alert(\'xxx\');&lt;/script&gt;', '2021-03-04 15:01:38'),
-- (220, 134, 3, 'Nice one bro', '2021-03-04 15:05:46'),
-- (221, 134, 3, 'un test', '2021-03-04 15:06:27'),
-- (222, 134, 3, 'hhh', '2021-03-04 15:09:29'),
-- (223, 145, 3, 'iwairwrw', '2021-03-04 18:36:33'),
-- (224, 146, 3, 'ok', '2021-03-04 18:38:08'),
-- (225, 146, 3, 'kkj', '2021-03-04 18:38:36'),
-- (226, 146, 37, 'nice', '2021-03-05 20:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

CREATE TABLE `forgotpassword` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forgotpassword`
--

-- INSERT INTO `forgotpassword` (`id`, `userid`, `token`, `token_expire`) VALUES
-- (36, 1, 'b206813264d46', '2021-02-06 09:32:26'),
-- (58, 17, '6320e6553ac36', '2021-02-23 17:07:46'),
-- (59, 30, 'c4eb6f80efe34', '2021-02-26 17:25:57'),
-- (72, 31, '5a63ea0da6878', '2021-03-01 17:14:40'),
-- (79, 34, 'ee7b063260980', '2021-03-02 16:37:55'),
-- (80, 33, '601f5b13a77e3', '2021-03-02 17:08:26'),
-- (86, 36, '2d000d24d6f3f', '2021-03-02 17:41:02'),
-- (91, 3, '7b30c6bbf0713', '2021-03-03 15:56:04'),
-- (102, 37, '70644934ba92c', '2021-03-03 18:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `postid` int NOT NULL,
  `userid` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

-- INSERT INTO `likes` (`id`, `postid`, `userid`, `creation_date`) VALUES
-- (130, 25, 7, '2021-02-15 16:52:16'),
-- (132, 19, 7, '2021-02-15 16:52:29'),
-- (143, 22, 7, '2021-02-19 10:16:40'),
-- (151, 27, 25, '2021-02-22 14:54:19'),
-- (152, 22, 25, '2021-02-22 14:54:23'),
-- (153, 23, 25, '2021-02-22 14:54:27'),
-- (154, 24, 25, '2021-02-22 14:54:30'),
-- (155, 15, 3, '2021-02-23 16:03:11'),
-- (161, 29, 29, '2021-02-25 15:06:36'),
-- (163, 28, 29, '2021-02-25 15:06:46'),
-- (164, 30, 3, '2021-02-25 15:08:58'),
-- (166, 35, 23, '2021-02-26 04:03:44'),
-- (173, 62, 32, '2021-03-01 17:50:42'),
-- (174, 60, 32, '2021-03-01 17:51:18'),
-- (175, 75, 32, '2021-03-01 18:06:03'),
-- (176, 77, 32, '2021-03-01 18:45:05'),
-- (178, 85, 30, '2021-03-01 21:27:39'),
-- (179, 98, 35, '2021-03-02 15:31:24'),
-- (180, 101, 34, '2021-03-02 16:26:16'),
-- (181, 57, 34, '2021-03-02 17:04:19'),
-- (183, 141, 3, '2021-03-04 18:35:35'),
-- (188, 147, 37, '2021-03-05 21:36:19'),
-- (189, 147, 30, '2021-03-05 21:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `data` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

-- INSERT INTO `posts` (`id`, `userid`, `data`, `creation_date`) VALUES
-- (1, 1, './img/photo/1.jpg', '2021-02-05 15:46:37'),
-- (2, 1, './img/photo/2.jpg', '2021-02-05 15:47:00'),
-- (3, 1, './img/photo/3.jpg', '2021-02-05 15:47:00'),
-- (4, 1, './img/photo/4.jpg', '2021-02-05 15:47:00'),
-- (5, 1, './img/photo/5.jpg', '2021-02-05 15:47:00'),
-- (6, 1, './img/photo/6.jpg', '2021-02-05 15:47:00'),
-- (7, 1, './img/photo/7.jpg', '2021-02-05 15:48:42'),
-- (9, 1, './img/photo/8.jpg', '2021-02-05 15:48:59'),
-- (10, 2, './img/photo/9.jpg', '2021-02-07 14:29:22'),
-- (11, 2, './img/photo/10.jpg', '2021-02-07 14:29:53'),
-- (12, 2, './img/photo/11.jpg', '2021-02-07 14:29:53'),
-- (13, 2, './img/photo/12.jpg', '2021-02-07 14:29:53'),
-- (14, 2, './img/photo/13.jpg', '2021-02-07 14:29:53'),
-- (15, 2, './img/photo/14.jpg', '2021-02-07 14:29:53'),
-- (16, 3, './img/photo/15.jpg', '2021-02-09 15:35:25'),
-- (17, 3, './img/photo/16.jpg', '2021-02-09 15:35:48'),
-- (18, 3, './img/photo/18.jpg', '2021-02-09 15:35:48'),
-- (19, 3, './img/photo/19.jpg', '2021-02-09 15:35:48'),
-- (20, 3, './img/photo/20.jpg', '2021-02-09 15:35:48'),
-- (21, 8, './img/photo/21.jpg', '2021-02-10 16:34:56'),
-- (22, 8, './img/photo/22.jpg', '2021-02-10 16:36:45'),
-- (23, 8, './img/photo/23.jpg', '2021-02-10 16:36:45'),
-- (24, 8, './img/photo/24.jpg', '2021-02-10 16:36:45'),
-- (25, 8, './img/photo/25.jpg', '2021-02-10 16:36:45'),
-- (26, 8, './img/photo/26.jpg', '2021-02-10 16:36:45'),
-- (27, 7, './img/photo/35.jpg', '2021-02-16 15:53:26'),
-- (28, 10, './img/photo/36.jpg', '2021-02-24 21:12:18'),
-- (29, 7, './img/photo/21.jpg', '2021-02-25 03:18:20'),
-- (30, 29, './img/photo/37.jpg', '2021-02-25 15:08:41'),
-- (33, 3, './img/60386ea03b86b.png', '2021-02-26 03:44:32'),
-- (34, 30, './img/60386eded8a3a.png', '2021-02-26 03:45:35'),
-- (35, 30, './img/60386facc90bd.png', '2021-02-26 03:49:00'),
-- (37, 23, './img/603876f963c87.png', '2021-02-26 04:20:09'),
-- (38, 23, './img/60387b599e6d4.png', '2021-02-26 04:38:50'),
-- (39, 23, './img/60387dc74c8e7.png', '2021-02-26 04:49:11'),
-- (40, 23, './img/60387e853e514.png', '2021-02-26 04:52:21'),
-- (41, 23, './img/60387e9e6fa7b.png', '2021-02-26 04:52:46'),
-- (42, 23, './img/6038800ade738.png', '2021-02-26 04:58:50'),
-- (43, 23, './img/6038819236f11.png', '2021-02-26 05:05:22'),
-- (44, 23, './img/603881a3c5d56.png', '2021-02-26 05:05:39'),
-- (45, 23, './img/603883058eec5.png', '2021-02-26 05:11:33'),
-- (46, 23, './img/6038831e253a2.png', '2021-02-26 05:11:58'),
-- (47, 23, './img/60388366570aa.png', '2021-02-26 05:13:10'),
-- (48, 30, './img/60388a0488522.png', '2021-02-26 05:41:25'),
-- (49, 30, './img/60388b5899d35.png', '2021-02-26 05:47:04'),
-- (50, 30, './img/60388bfe91568.png', '2021-02-26 05:49:50'),
-- (57, 30, './img/60390e4936bbc.png', '2021-02-26 15:05:45'),
-- (58, 30, './img/60390e57d692a.png', '2021-02-26 15:05:59'),
-- (59, 30, './img/60390e7b80573.png', '2021-02-26 15:06:35'),
-- (60, 30, './img/60390ff78dc6c.png', '2021-02-26 15:12:55'),
-- (61, 30, './img/6039100451457.png', '2021-02-26 15:13:08'),
-- (62, 30, './img/6039104443c14.png', '2021-02-26 15:14:12'),
-- (74, 31, './img/603d1f22940c1.png', '2021-03-01 17:06:42'),
-- (75, 32, './img/603d2ce23240a.png', '2021-03-01 18:05:22'),
-- (77, 32, './img/603d3616782a6.png', '2021-03-01 18:44:39'),
-- (78, 3, './img/603d4dc384fe4.png', '2021-03-01 20:25:40'),
-- (81, 32, './img/603d4e6767a0d.png', '2021-03-01 20:28:23'),
-- (82, 32, './img/603d4e7642117.png', '2021-03-01 20:28:38'),
-- (84, 32, './img/603d591dd95c3.png', '2021-03-01 21:14:05'),
-- (85, 30, './img/603d5c4025459.png', '2021-03-01 21:27:28'),
-- (88, 30, './img/603d95aa25507.png', '2021-03-02 01:32:26'),
-- (91, 34, './img/603e4b1b6445e.png', '2021-03-02 14:26:35'),
-- (92, 34, './img/603e4c7b0c3bd.png', '2021-03-02 14:32:27'),
-- (93, 3, './img/603e4c83c9ba5.png', '2021-03-02 14:32:35'),
-- (94, 3, './img/603e4c9767d7e.png', '2021-03-02 14:32:55'),
-- (95, 3, './img/603e4ca27f6e5.png', '2021-03-02 14:33:06'),
-- (96, 34, './img/603e4ce351696.png', '2021-03-02 14:34:11'),
-- (97, 34, './img/603e4cff4b11c.png', '2021-03-02 14:34:39'),
-- (98, 3, './img/603e59f4e6bc6.png', '2021-03-02 15:29:57'),
-- (101, 34, './img/603e661d1dd8c.png', '2021-03-02 16:21:49'),
-- (102, 34, './img/603e6d4d750dd.png', '2021-03-02 16:52:29'),
-- (127, 30, './img/603fffc6ae028.png', '2021-03-03 21:29:43'),
-- (128, 37, './img/603ffff391415.png', '2021-03-03 21:30:28'),
-- (134, 38, './img/6040f5777bf76.png', '2021-03-04 14:57:59'),
-- (136, 3, './img/6040f8a996a69.png', '2021-03-04 15:11:38'),
-- (137, 3, './img/6040f99155110.png', '2021-03-04 15:15:29'),
-- (138, 3, './img/6040fc608b928.png', '2021-03-04 15:27:28'),
-- (139, 3, './img/6040fc8f410ac.png', '2021-03-04 15:28:15'),
-- (140, 3, './img/6040fd4256a71.png', '2021-03-04 15:31:15'),
-- (141, 3, './img/6040fd6763b03.png', '2021-03-04 15:31:51'),
-- (142, 3, './img/6040fdc3c5ad7.png', '2021-03-04 15:33:24'),
-- (145, 3, './img/604128a21c222.png', '2021-03-04 18:36:18'),
-- (146, 37, './img/604128ff804a1.png', '2021-03-04 18:37:51'),
-- (147, 3, './img/60418c3e6b282.png', '2021-03-05 01:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `profilpic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT './img/profile.png',
  `active` tinyint NOT NULL,
  `deleted` tinyint NOT NULL,
  `notification` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

-- INSERT INTO `users` (`id`, `full_name`, `email`, `username`, `password`, `token`, `profilpic`, `active`, `deleted`, `notification`) VALUES
-- (1, 'hrizkiou', 'hrizkiou@hotmail.com', 'hrizkiou', '$2y$10$47Y6VoSi6DknlvTYnHB5dOeWmAGA0mBRRRIyW7wLVbrGsdIkTB2Iy', 'ce734610edc75', './img/large_hrizkiou.jpg', 0, 1, 1),
-- (2, 'Houssam Lout', 'Lout@gmail.com', 'Lout', '$2y$10$el9qDLTaovtyXoNVKr1e1.9RLjawLT.25B.beAD9jB5DElHGlQG4e', 'cca2a49406d17', './img/large_lout.png', 0, 1, 1),
-- (3, 'omar', 'omar@gmail.com', 'omar', '$2y$10$hMVF9mPVIVByv5dAXSNtBOnxewiavl5CuhKvfj/CjcOpqBZD3O9W2', '16a3141850f7d', 'images/60412892464ed.jpeg', 1, 1, 1),
-- (4, 'akerkar ayoub', 'ayoubakerkar89@gmail.com', 'ayoubakerkar89', '$2y$10$QmXNFBrB4cMpFmVToqLYbOSmp2S7ejU1EIPAkQIpbrXa4PcZpQwUC', 'e703d53e6616e', '', 0, 1, 1),
-- (5, 'rayan', 'rayan@gmail.com', 'rayan', '$2y$10$7hYKdGbXy.SEXlXLcFkp2eQnKwtPNTiGUTljSxbWVMtF7v3X13Rxe', '63d52e740f10c', '', 1, 1, 1),
-- (6, 'hamza', 'hamza@homail.com', 'hamza', '$2y$10$s5X.dT.GiGutoEn3.1zDget6V4Y8nQJmaPiDPhIHDCIrakGpPZyqu', '1673f93ce940f', '', 0, 1, 1),
-- (7, 'Mustapha Matrouf', 'ssssssss@basicmail.host', 'mmatrouf', '$2y$10$geckCTjooUnlznPiyBdv1e6qvelOgOmAJ/5y2qHZKtO/VIuoPwgES', 'ed921041c6310', './img/large_mmatrouf.jpg', 1, 1, 1),
-- (8, 'Said Zouf', 'saidzouf@gmail.com', 'saidzouf', '$2y$10$e5a6uhPesOsd.un8t1gmY.8AFmWIgnUKcu71EruvL11CZ1mDbmFBK', '80060c7205225', './img/said.png', 0, 1, 1),
-- (9, 'pikacu', 'lout-pk@gmail.com', 'louut_m416', '$2y$10$FHkW.0X1YRe929miQE/o7OCI.XZ8awp8pJJNnerU84EqWGQF8hbvC', '24de8d226600c', './img/large_lout.png', 1, 1, 1),
-- (10, 'hamza Riz', 'hamzarizkioui@hotmail.com', 'hamzarizkioui', '$2y$10$cf0giWg5nSrv42dRg8ovfOW9lTqnp7jFLvyaOpOum1roDkGUD8FLm', '1ad49c0f51d62', '', 1, 1, 1),
-- (17, 'wisolol', 'wisolol722@seacob.com', 'wisolol722', '$2y$10$rcdWXGm0Qy71SVm74q7BH.ZwyV8qvVOEX2r58H5ZvWt5H6ftZYeva', 'c6f34140a5a01', '', 0, 1, 1),
-- (19, 'vorocij', 'vorocij472@edultry.com', 'vorocij472', '$2y$10$enlJLuLKNoz852b7IQZzyueZFc9/a4O8ahWg/u85gtQQaAmSDcRs6', '937d3c969010a', '', 0, 1, 1),
-- (20, 'bebacod', 'bebacod235@edultry.com', 'bebacod235', '$2y$10$hBMEmMWNMdcAW/1vvefNx.uGe0lbCiAO2xJBsyJvzl1LTJ/bNuJvO', 'abb16067143a2', '', 0, 1, 1),
-- (21, 'kireb', 'kireb44628@geeky83.com', 'kireb44628', '$2y$10$G1XqlPzoqNrXitOFCOMrVeVCZrbTt0lX673ftkB3Dq/PuVWhrMROe', 'd7c431611100d', '', 0, 1, 1),
-- (22, 'jaracaw', 'jaracaw399@geeky83.com', 'jaracaw399', '$2y$10$kOYxcEr31hcqRaBCd8C2jOQUaQ9yNL8srP.y9heDDYxSLtwqutfxC', 'b5c421d306d72', '', 1, 1, 1),
-- (23, 'kejih lopac', 'kejih25272@bulkbye.com', 'kejih25272', '$2y$10$VdZHc9vR1FLh.91iZDFV0u5Rc5CDIUJQPjNIRmKDxG6ogyl1fnCCe', '63aa1d17801e3', '', 1, 1, 1),
-- (24, 'vefasok', 'vefasok232@bulkbye.com', 'vefasok232', '$2y$10$rGzbs0Dx/bDJOyuUGOixwOzhi9aRH0ZJMQqXKzhyjF1VxagQaIkW.', '3b790ba21386b', '', 1, 1, 1),
-- (25, 'karimkahbouri', 'karimkhabourii@gmail.com', 'kkhabour', '$2y$10$Ad1aGJAW7arGKfH2K73CPu3st9xeA3iC7LNE4a5qYg4WWTEpGomQ.', '3bd65f930c970', '', 1, 1, 1),
-- (26, 'xahenoj', 'xahenoj174@seacob.com', 'xahenoj174', 'kkkk', '6380ecd3c062a', '', 1, 1, 1),
-- (27, 'ssssssss', 'ssssssss@basicmail.host', 'ssssssss', '$2y$10$gRCUDDv9GaWPUbvLYYMy1ecdr7dpyeCjj9VQYCX0xO6oL5VekgJii', '653e1c3a610c5', '', 1, 1, 1),
-- (28, 'hhhhhhhhhhh', 'llllllll@basicmail.host', 'hhhhhhhhhhh', '$2y$10$yVGEcCvv8Q3YtAc0KjLpCuZLoFgv.bzfEAbBu7SVQscUj1DghehrC', 'bc39739aa8d60', '', 1, 1, 1),
-- (29, 'Hossam Limouni', 'hhhhhhhhhhh@BasicMail.host', 'LimouniHossam', '$2y$10$7BbRNGjRoP0EtiwX/TP5BO5Sbkx5xZ3DNMVFHADFVmTPRr9/A4MUq', 'bd703ccb16cda', '', 1, 1, 1),
-- (30, 'fatimaezzahra', 'fatimaezzahra@appmailer.org', 'honey', '$2y$10$T43KSj/Y5hokyVW3CzPgxeRrPL5j2yjPwv6e9W.Wj7PD0gzVH1J8S', '63ccf03c700c1', 'images/603d647d93a89.png', 1, 1, 1),
-- (31, 'qtuyhacsd', 'qtuyhacsd@maxresistance.com', 'qtuyhacsd', '$2y$10$5/j1B7HRfrQEiBdpJtgUbO.YdTZe0lUqccZYYcpPGqWuRoCH.zbUe', '1609d198d13d8', 'images/603d1f0c76026.jpeg', 1, 1, 1),
-- (32, 'yahya Najim', 'yahya.najimy@gmail.com', 'yahya.najimy', '$2y$10$cAj4ZbtI6L582phVqhwCzO0MkjkSKxx1G7zjIvqg5gJv1QGca.xHC', 'ed4276398bda0', 'images/603d2d025766f.png', 1, 1, 1),
-- (33, 'Test', 'ssgcgyxntsk@maxresistance.com', 'test', '$2y$10$OolPBBCwQJ9ZYnqd6XM3EeHE/c8MeGVjycKf6q4.Ha6ZnXZdzajRa', '63caee0924d96', '', 1, 1, 1),
-- (34, 'karimkhabouri', 'lpyvfbshehihpzn@maxresistance.com', 'futureisloading', '$2y$10$m2tUdaOQMDnvZiL.kHM6.u0C58hVt7iPx4n8Fc44f/Va0bwrcVtGu', '8a384663e8720', 'images/603e66eca0738.', 1, 1, 1),
-- (35, 'Ayoub saadlah', 'ayoub.sadellah@gmail.com', 'ayoub.sadellah', '$2y$10$Z6yVqnNipwK7sRdIGKUH8.lQgJA1OBurGBXryn3MMUDdZ.KjqbCfq', 'c23996a03051e', 'images/603e5a38e3039.png', 1, 1, 1),
-- (36, 'vicfpungpzta', 'vicfpungpzta@maxresistance.com', 'vicfpungpzta', '$2y$10$jLwQ1F27Qjckz4bDcFYTt.ux/s93BPfu29cFGshTnS/3jtEOlcJV.', '10b8da7e20376', 'images/603e776f157b9.jpeg', 1, 1, 1),
-- (37, 'feqmkgievqtbm', 'feqmkgievqtbm@maxresistance.com', 'feqmkgievqtbm', '$2y$10$JOXNEvsOtIzry3Ez6dahPewbA1o2hK42lMSDdW63CS1MnNgfbM9gi', '3f2a02b70dbd6', 'images/60400039d31dd.jpeg', 1, 1, 1),
-- (38, 'youssef abakhar', 'youssef.abakhar52@gmail.com', 'yabakhar', '$2y$10$GgcsvEneQ4MxIu81dCPfruRPV67mqj./Yf.HEoR/Vy4XfKFdAGkX2', 'a40983600f440', 'images/6040f5c2126a5.jpeg', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `comments_ibfk_2` (`postid`);

--
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`postid`,`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD CONSTRAINT `forgotpassword_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
