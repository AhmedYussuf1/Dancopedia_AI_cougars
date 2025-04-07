CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `full_name` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `session_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `chatbot_interactions` (
  `interaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `query` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `interaction_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`interaction_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `chatbot_interactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `dances` (
  `dance_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_id` int(11) DEFAULT NULL,
  `genre` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `city` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`dance_id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `dances_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL UNIQUE,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `dance_id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`picture_id`),
  KEY `dance_id` (`dance_id`),
  CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`dance_id`) REFERENCES `dances` (`dance_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `search_history` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `search_query` varchar(255) DEFAULT NULL,
  `search_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`search_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `search_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user_settings` (
  `user_id` int(11) NOT NULL,
  `theme` int(11) DEFAULT NULL,
  `email_blog` tinyint(1) DEFAULT NULL,
  `email_events` tinyint(1) DEFAULT NULL,
  `email_dance` tinyint(1) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `dance_id` int(11) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`video_id`),
  KEY `dance_id` (`dance_id`),
  CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`dance_id`) REFERENCES `dances` (`dance_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `password_resets` (`id`, `email`, `token`, `expires`) VALUES
(1, 'yared1alemu@gmail.com', '69b80aed88a62742da63ecac38f50fd9935b5c8b18370e9ad38c416a2c3e14829abf44167130450998e9196a3ca5a7df584b', 1738821757);



INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `user_id`, `image_path`, `image`) VALUES
(1, 'test', 'test', '2025-02-04 11:57:17', NULL, NULL, NULL),
(2, 'test', 'test', '2025-02-04 11:57:58', NULL, NULL, NULL),
(3, 'test', 'test2', '2025-02-04 11:58:34', NULL, NULL, NULL),
(15, 'chat', 'Chatbot: Dance in America has a rich history that reflects the cultural diversity of the country. From Native American dances to the influence of European settlers, African rhythms, and Latin styles, American dance forms have continually evolved and blended over the centuries. In the early 20th century, American dance was greatly influenced by social dances like the Charleston and the Lindy Hop. The mid-20th century saw the rise of modern dance pioneers such as Martha Graham and Doris Humphrey, who pushed the boundaries of traditional ballet and paved the way for contemporary dance. In recent decades, hip-hop and street dance styles have become prominent in American popular culture, alongside more traditional forms like ballet and tap. The diversity of dance in America continues to thrive, with new forms\r\n\r\n', '2025-02-05 07:07:13', 3, NULL, NULL),
(19, 'picture', 'test', '2025-02-22 18:54:54', 3, NULL, 'american-flag-2144392_640.png');





INSERT INTO `search_history` (`search_id`, `user_id`, `search_query`, `search_timestamp`) VALUES
(1, 1, 'what is breakdancing?', '2025-02-04 12:01:00');



INSERT INTO `users` (`user_id`, `username`, `password_hash`, `email`, `full_name`, `role`, `session_token`, `created_at`, `updated_at`) VALUES
(1, 'test', '$2y$10$Y0QKAhdmUqdLVQKUMemreuqN5Bx3vBo91coWENBaN5IsM2MIue5Ou', 'yared700alemu@gmail.com', 'test1', 'admin', NULL, '2025-02-04 11:05:34', '2025-02-11 04:32:57'),
(3, 'james', '$2y$10$yyXFFojafDAi/s2FsDTFae/6e2KamopWxQOSdC0nCxvWCXcAiB9JS', '1yared7alemu@gmail.com', 'james', 'admin', NULL, '2025-02-04 07:18:40', '2025-02-04 07:19:29'),
(10, 'admin', 'password_hash_example', 'admin@example.com', 'Admin User', 'admin', 'dummy_token', '2025-02-05 23:53:12', '2025-02-05 23:53:12'),
(14, 'john', '$2y$10$Q2T0W6xJ3Sm4KGCtNIXXQejp1qJFgJnNQLEMHsfbxFBiuylwSEN8i', 'johntest1234@yahoo.com', 'john', 'admin', NULL, '2025-02-11 04:34:24', '2025-02-22 19:04:58');




INSERT INTO `user_settings` (`user_id`, `theme`, `email_blog`, `email_events`, `email_dance`, `language`) VALUES
(3, 2, 0, 0, 0, 'English');


INSERT INTO `chatbot_interactions` (`interaction_id`, `user_id`, `query`, `response`, `interaction_timestamp`) VALUES
(1, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-01-31 09:56:19'),
(2, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-01-31 10:43:22'),
(3, NULL, 'hi can you tell me the capital of china', 'Sorry, I can only help with questions about dance in America.', '2025-01-31 11:41:21'),
(4, NULL, 'what kind of breakdancing does the usa have', 'In the USA, breakdancing is a popular form of dance that originated in the Bronx, New York City in the 1970s. It is known for its acrobatic moves, intricate footwork, and self-expression through movement. Breakdancing competitions and events, known as \"battles,\" are held in cities across the country, showcasing the skills and creativity of dancers in this dynamic style.', '2025-01-31 11:42:30'),
(5, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-03 07:18:03'),
(6, NULL, 'whats dance', 'Sorry, I can only help with questions about dance in America.', '2025-02-03 07:18:15'),
(7, NULL, 'what dance in america', 'There are various dance styles in America that have originated or evolved in the country. Some popular dance styles in America include jazz, tap dance, hip-hop, ballet, modern dance, and various cultural dances from different communities across the nation. Each style has its own unique history and significance in American dance culture.', '2025-02-03 07:18:27'),
(8, 1, 'dance', 'Sorry, I can only help with questions about dance in America.', '2025-02-04 07:39:31'),
(9, 1, 'then start', 'Sure, feel free to ask me anything related to dance in America!', '2025-02-04 07:39:46'),
(10, 3, 'tell me a little history about dances in america', 'Dance in America has a rich history that reflects the cultural diversity of the country. From Native American dances to the influence of European settlers, African rhythms, and Latin styles, American dance forms have continually evolved and blended over the centuries. In the early 20th century, American dance was greatly influenced by social dances like the Charleston and the Lindy Hop. The mid-20th century saw the rise of modern dance pioneers such as Martha Graham and Doris Humphrey, who pushed the boundaries of traditional ballet and paved the way for contemporary dance. In recent decades, hip-hop and street dance styles have become prominent in American popular culture, alongside more traditional forms like ballet and tap. The diversity of dance in America continues to thrive, with new forms', '2025-02-05 07:06:34'),
(11, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-06 06:40:19'),
(12, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-06 07:00:51'),
(13, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-06 07:40:54'),
(14, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-06 07:45:33'),
(15, NULL, 'then what dance', 'Sorry, I can only help with questions about dance in America.', '2025-02-06 07:45:45'),
(16, NULL, 'when did dance in america start', 'Dance in America has a rich and diverse history that dates back to the indigenous peoples of North America who used dance as a form of expression, storytelling, and celebration. European settlers also brought their own dance traditions to America, which eventually merged with African dance styles through the African diaspora and slavery. This blending of cultural influences laid the foundation for the development of various dance forms in America. Sorry, I can only help with questions about dance in America.', '2025-02-06 07:46:06'),
(17, NULL, 'hi', 'Sorry, I couldn\'t process your request. Please try again.', '2025-02-06 21:42:51'),
(18, NULL, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-06 21:44:37'),
(19, NULL, 'hi', 'Sorry, I can only help with questions about dance in America. ', '2025-02-06 21:56:58'),
(20, NULL, 'dance is', 'Sorry, I can only help with questions about dance in America.', '2025-02-07 05:24:41'),
(21, NULL, 'whats dance in america like', 'Dance in America is incredibly diverse and vibrant, with a wide range of styles and influences. From traditional Native American dances to modern hip-hop, ballet, jazz, and contemporary dance, there is a rich tapestry of dance forms found throughout the country. American dance has been shaped by a variety of cultural traditions, immigration patterns, and historical influences, making it a dynamic and evolving art form.', '2025-02-08 14:34:50'),
(22, 3, 'hi', 'Sorry, I can only help with questions about dance in America. ', '2025-02-11 05:28:23'),
(23, 3, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-11 07:20:53'),
(24, 3, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-11 07:49:47'),
(25, 3, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-11 07:56:56'),
(26, 3, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-11 08:02:54'),
(27, 3, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-11 08:13:14'),
(28, 3, 'whats dance in america like', 'Dance in America is incredibly diverse and vibrant, encompassing a wide range of styles and traditions. From ballet and modern dance to hip hop and jazz, American dance reflects the country\'s multicultural heritage and creative spirit. There are also indigenous dance forms, such as Native American dance, that showcase the rich cultural tapestry of the United States. Overall, dance in America is an important art form that continues to evolve and thrive in both traditional and contemporary settings.', '2025-02-11 08:47:08'),
(29, 3, 'hi', 'Sorry, I can only help with questions about dance in America.', '2025-02-11 08:58:30'),
(30, 14, 'hi', 'Sorry, I couldn\'t process your request. Please try again.', '2025-02-20 04:04:56'),
(31, 14, 'hi', 'Sorry, I couldn\'t process your request. Please try again.', '2025-02-20 04:29:57');




INSERT INTO `dances` (`dance_id`, `name`, `description`, `region`, `image_url`, `video_url`, `created_at`, `updated_at`, `admin_id`, `genre`, `link`, `city`) VALUES
(1, 'Ballet', 'A view of a set of ballet moves.', 'California', 'images/ballet.jpg', 'https://www.youtube.com/watch?v=WUrJuSh0evE', '2025-02-05 23:53:59', '2025-03-19 23:48:30', 1, 'Classical', 'https://www.youtube.com/watch?v=WUrJuSh0evE', 'Anaheim'),
(2, 'Hip-Hop', 'An introduction to hip-hop dances.', 'Texas', 'images/hiphop.jpg', 'https://www.youtube.com/watch?v=1WIA6Yvj8Yg', '2025-02-05 23:53:59', '2025-03-19 23:48:34', 1, 'Hip-Hop', 'https://www.youtube.com/watch?v=1WIA6Yvj8Yg', 'Houston'),
(3, 'Tango Delight', 'A romantic tango evening with passionate performances.', 'Florida', 'images/tango.jpg', 'https://www.youtube.com/watch?v=nsiaKAnynfQ', '2025-02-05 23:53:59', '2025-03-19 23:48:38', 1, 'Ballroom', 'https://www.youtube.com/watch?v=nsiaKAnynfQ', 'Miami'),
(4, 'Contemporary Vibes', 'A fusion of modern contemporary dance styles.', 'California', 'images/contemporary.jpg', 'https://www.youtube.com/watch?v=oss8ow97kl8', '2025-02-05 23:53:59', '2025-03-19 23:48:41', 1, 'Contemporary', 'https://www.youtube.com/watch?v=oss8ow97kl8', 'Los Angeles'),
(5, 'Salsa Fiesta', 'A vibrant salsa night with amazing performances!', 'California', 'images/salsa.jpg', 'https://www.youtube.com/watch?v=Df9GrBwgyjQ', '2025-02-06 00:04:57', '2025-03-19 23:48:44', 1, 'Latin', 'https://www.youtube.com/watch?v=Df9GrBwgyjQ', 'San Francisco'),
(6, 'Ballet', 'A behind the scenes look at ballet in New York', 'New York', 'images/ballet.jpg', 'https://www.youtube.com/watch?v=aUDnHPspS_s', '2025-02-06 00:04:57', '2025-03-19 23:48:48', 1, 'Classical', 'https://www.youtube.com/watch?v=aUDnHPspS_s', 'New York'),
(7, 'Hip-Hop Madness', 'An exciting hip-hop battle featuring the best dancers!', 'Texas', 'images/hiphop.jpg', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', '2025-02-06 00:04:57', '2025-03-19 23:48:51', 1, 'Hip-Hop', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', 'Dallas'),
(8, 'Tango Delight', 'A romantic tango evening with passionate performances.', 'Florida', 'images/tango.jpg', 'https://www.youtube.com/watch?v=pSXDkPHx1_w', '2025-02-06 00:04:57', '2025-03-19 23:48:54', 1, 'Ballroom', 'https://www.youtube.com/watch?v=pSXDkPHx1_w', 'Miami'),
(9, 'Contemporary Vibes', 'A fusion of modern contemporary dance styles.', 'New York', 'images/contemporary.jpg', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', '2025-02-06 00:04:57', '2025-03-19 23:48:57', 1, 'Contemporary', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', 'New York'),
(10, 'Classical', 'A look at classical dances from Minneapolis', 'Minnesota', NULL, 'https://www.youtube.com/watch?v=vcV45NtDIUU', '2025-02-11 06:22:59', '2025-03-19 23:49:03', 3, 'Classical', 'https://www.youtube.com/watch?v=vcV45NtDIUU', 'Minneapolis'),
(11, 'Dancopedia AI', 'test 700', 'usa', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', '2025-02-11 06:54:37', '2025-03-19 23:44:19', 3, 'Hip-Hop', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', NULL),
(12, 'Classical', 'A look at classical dances from Chicago', 'Illinois', NULL, 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', '2025-02-20 05:55:13', '2025-03-19 23:50:50', 1, 'Classical', 'https://youtu.be/ctLyL5EWTFU?si=eaWsj2kLkduPR8nx', 'Chicago'),
(13, 'c walk', 'west coast dance', 'usa', NULL, 'https://youtu.be/nIkfs6EC91U?si=n1NSERgjAUT6T31H', '2025-02-22 19:12:01', '2025-03-19 23:51:17', 1, 'Hip-Hop', '', 'USA');




INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `image`, `created_at`) VALUES
(1, 'jame', 'yared1alemu@gmail.com', 'test', '', '2025-02-20 04:48:22'),
(2, 'jame', 'yared1alemu@gmail.com', 'test', '', '2025-02-20 04:51:15'),
(3, 'jame', 'yared1alemu@gmail.com', 'test1', '', '2025-02-20 04:54:07'),
(4, 'jame', 'yared1alemu@gmail.com', 'test2', '', '2025-02-20 04:55:31'),
(5, 'jame', 'yared1alemu@gmail.com', 'test4', '', '2025-02-20 04:55:51'),
(6, 'jame', 'yared1alemu@gmail.com', 'test5', '', '2025-02-20 04:58:27'),
(7, 'jame', 'yared1alemu@gmail.com', 'test5', '', '2025-02-20 05:00:07'),
(8, 'jame', 'yared1alemu@gmail.com', 'test7', '', '2025-02-20 05:00:24'),
(9, 'jame', 'yared1alemu@gmail.com', 'test700', '', '2025-02-20 05:37:45'),
(10, 'jame', 'yared1alemu@gmail.com', 'test800', '', '2025-02-20 05:38:29');

