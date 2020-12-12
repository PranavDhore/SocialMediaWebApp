-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2020 at 02:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hobbies`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(255) NOT NULL,
  `comment_user_id` int(255) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_user_id`, `comment_content`, `comment_date`, `comment_type`) VALUES
(22, 15, 19, 'Really Nice Video , I love it.', '2020-10-27', 'video'),
(23, 13, 19, 'Java is Best', '2020-10-27', 'photo'),
(24, 12, 19, 'Yupppp , great content.', '2020-10-27', 'photo'),
(25, 13, 20, 'Nice Pic Pranav', '2020-10-27', 'photo'),
(26, 16, 20, 'Amazing Video', '2020-10-27', 'video'),
(27, 15, 20, 'Its  nice one', '2020-10-27', 'video'),
(28, 17, 21, 'What a nice video', '2020-10-27', 'video'),
(29, 16, 21, 'cool video', '2020-10-27', 'video'),
(30, 15, 21, 'Amazing Video', '2020-10-27', 'video'),
(31, 12, 21, 'great', '2020-10-27', 'photo'),
(32, 15, 21, 'yeasss', '2020-10-27', 'photo'),
(33, 18, 22, 'Nice video', '2020-10-27', 'video'),
(34, 15, 22, 'Good work', '2020-10-27', 'video'),
(35, 18, 20, 'i like it yeaaah', '2020-10-27', 'photo'),
(36, 17, 18, 'Nice Con7tent', '2020-10-27', 'video'),
(37, 16, 18, 'gta 5 great', '2020-10-27', 'photo'),
(38, 18, 23, 'dsadas dasda dasdasd', '2020-10-29', 'video'),
(39, 17, 23, 'fsdf sfs dfs', '2020-10-29', 'photo'),
(40, 17, 18, 'What a nice Post it is ', '2020-10-29', 'photo');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `name`, `location`, `title`, `description`, `user_id`, `date`) VALUES
(12, '227de6be6e07c94c10ec5206616eee51.png', 'postPhotos/227de6be6e07c94c10ec5206616eee51.png', 'My First Photo', 'This is my first upload ', 18, '2020-10-27'),
(13, '2669808_fcbe.jpg', 'postPhotos/2669808_fcbe.jpg', 'Second Post ', 'So this is my second post yeahhh', 18, '2020-10-27'),
(15, 'a12d7fda9e3a2d665622351ef76c3798.jpg', 'postPhotos/a12d7fda9e3a2d665622351ef76c3798.jpg', 'Gaurav Photo', 'Yes This is New Photo of the new Era', 20, '2020-10-27'),
(16, '707055.jpg', 'postPhotos/707055.jpg', 'Lambo Car', 'New Photo of lambo city', 20, '2020-10-27'),
(17, 'javascript-node-js-abstract-logo-wallpaper-preview.jpg', 'postPhotos/javascript-node-js-abstract-logo-wallpaper-preview.jpg', 'Kunal Photo', 'This is my first photo', 21, '2020-10-27'),
(18, 'images (2).jpeg', 'postPhotos/images (2).jpeg', 'Simple post', 'This is a simple post', 22, '2020-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_college` varchar(255) NOT NULL,
  `user_year` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_username`, `user_email`, `user_college`, `user_year`, `user_password`, `user_image`) VALUES
(18, 'Pranav', 'Dhore', 'Destroyer', 'pranav@gmail.com', 'D. Y. Patil Dnyanshanti School', '2nd Year', 'Pranav@123', 'pictures/ee50579223c5bc451da048688e8b7ec1.jpg'),
(19, 'Rohan', 'Kadu', 'RohanK', 'rohan@gmail.com', 'Dr. D. Y. Patil College of Agriculture Business Management , Akurdi, Pune', '3rd Year', 'Rohan@123', 'pictures/mackevision-game-of-thrones-v-hbo-2015-1.jpg'),
(20, 'Gaurav', 'Sorte', 'GauravS', 'gaurav@gmail.com', 'Dr. D. Y. Patil Institute of Pharmacy, Akurdi, Pune', '2nd Year', 'Gaurav@123', 'pictures/kali-logo.png'),
(21, 'kunal', 'last', 'Kunal', 'kunal@gmail.com', 'Y.B Patil Polytechnic,Akurdi, Pune', '2nd Year', 'Kunal@123', 'pictures/logo.png'),
(22, 'Sahil', 'Kale', 'Austin', 'sahil@gmail.com', 'Dr. D. Y. Patil Institute of Pharmacy, Akurdi, Pune', '2nd Year', 'Sahil@123', 'pictures/Joker_2019-02ee982c-9457-43a5-9344-aff2978241a1.jpg'),
(23, 'New', 'Test', 'user', 'the@gmail.com', 'Dr. D. Y. Patil Arts, Commerce and Science Junior College', '2nd Year', 'New@123', 'pictures/ee50579223c5bc451da048688e8b7ec1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `name`, `location`, `title`, `description`, `user_id`, `date`) VALUES
(15, 'test.mp4', 'postVideos/test.mp4', 'My First Video', 'Hello , This is my first video', 18, '2020-10-27'),
(16, 'video.mp4', 'postVideos/video.mp4', 'Amazing Video 2020', 'Yes This is Video of the new Era', 19, '2020-10-27'),
(17, 'production ID_5156513.mp4', 'postVideos/production ID_5156513.mp4', 'New Video ', 'this is dechjg hjgjh hguyd juih ytf  uhuin jnmb gtyd dtwrv erresx gh hiuh mbjhi jhugbjhk iuh , ugui jkhuigv hjttyf.', 20, '2020-10-27'),
(18, 'video.mp4', 'postVideos/video.mp4', 'Lets Upload', 'Yes This is New video of the new Era', 21, '2020-10-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
