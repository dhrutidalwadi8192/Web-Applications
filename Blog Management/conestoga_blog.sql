-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2024 at 01:08 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conestoga_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_likes` int NOT NULL DEFAULT '0',
  `total_comments` int NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `description`, `created_by`, `created_at`, `total_likes`, `total_comments`, `updated_at`, `status`, `is_deleted`) VALUES
(1, 'Essential Ingredients for Every Blog Post', 'Whatever type of blog post you’re writing, whoever your target audience is, and whatever niche you’re working in, you’ll need these four key elements:\r\n\r\nYour blog post title needs to be clear—not clever. Don’t try to get too artful when coming up with a blog title, use my free blog title generator instead. You want readers to know what to expect from your post. Plus, you want to use keywords in your title for SEO (search engine optimization) purposes.\r\n\r\nYour post introduction should set the scene for your post. It needs to grab the reader’s attention and it also needs to make it clear that they’re in the right place for the information (or entertainment) they’re seeking.', 1, '2024-04-12 20:48:59', 0, 1, '0000-00-00 00:00:00', 'Active', 0),
(2, 'What’s the Most Helpful Thing a Therapist Has Ever Told You?', '<p>Right before she said this, I&rsquo;d been describing a stressful parenting situation and kept interrupting myself to say, &ldquo;But I really, really, really, really, really love my kids.&rdquo; Finally, she said, &ldquo;Joanna, it&rsquo;s okay, you can find parenting overwhelming AND love your kids.&nbsp;<em>Two things can be true.</em>&rdquo;<br />\r\n<br />\r\nSince then, the concept has come to mind many times.&nbsp;<a href=\"https://www.instagram.com/p/CmXOGmjPIs9/\" target=\"_blank\">When my stepfather died</a>, I was relieved that he could finally rest AND heartbroken that he was gone. When we laughed at my mom&rsquo;s house after his funeral, I realized that we could celebrate his life AND mourn his death. Whenever&nbsp;<a href=\"https://cupofjo.com/2021/09/07/weekend-alone-brooklyn/\" target=\"_blank\">I&rsquo;ve spent an evening or weekend alone</a>, I&rsquo;ve enjoyed the quiet AND missed the noise of my children. When I think back on new parenthood, I remembered desperately craving sleep AND feeling my heart explode every time I looked at my baby.<br />\r\n<br />\r\nSo! Have you ever been to therapy? What&rsquo;s something helpful a therapist has told you? Eager to hear these special nuggets.</p>\r\n', 1, '2024-04-12 20:57:10', 0, 1, '0000-00-00 00:00:00', 'Active', 0),
(3, '25 Ways How to Be More Productive', '<p>This year, my to-do list has turned into a growing mountain of &ldquo;<em>important</em>&rdquo; tasks that always seem to lead to something else (of course equally as important) that&nbsp;<em>needs</em>&nbsp;to be accomplished.<br />\r\n<br />\r\nOver the past several months, I&rsquo;ve been taking on more time-intensive projects than I ever have before&hellip; all at the same time as moving from San Francisco to Los Angeles. My to-do list has ballooned out of control. As a result, I&rsquo;ve had to get very serious about how I utilize my time. I&rsquo;ve had to become way more productive.<br />\r\n<br />\r\nI&rsquo;ve been doing a lot more experimentation, testing, and coming up with my own&nbsp;<strong>productivity tips</strong>&nbsp;to not only squeeze more time out of my workday, but to be more effective with that limited amount of time (which is what I believe productivity is&nbsp;<em>really</em>&nbsp;about).<br />\r\n<br />\r\nThe thing is, if you&rsquo;re like most people, you&nbsp;<em>can</em>&nbsp;find extra time to do the things you truly want (and need).<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p>It&rsquo;s amazing how much time we waste in our average day if we&rsquo;re brutally honest with ourselves. Ten minutes of checking Facebook notifications when you get to work, scrolling through Instagram for half an hour at lunch, reading up on the day&rsquo;s news during the afternoon, the list goes on.</p>\r\n\r\n<p>At the same time, while you may take pride in replying to every email as soon as you receive it, it does waste an awful lot of your time that could otherwise be used more effectively. That&rsquo;s why today, I&rsquo;m sharing my list of 25 surprisingly impactful productivity tips to help you be more productive in all areas of your life.</p>\r\n\r\n<p><em>Disclaimer: Some of these productivity tips will sound like a no-brainer, but trust me&hellip; it&rsquo;s the implementation, repetition, and discipline in sticking to them long enough to pay off, that&rsquo;ll be most difficult.</em></p>\r\n', 2, '2024-04-12 21:01:22', 0, 1, '0000-00-00 00:00:00', 'Active', 0),
(4, 'Why Every Small Business Needs a Strategic Plan', '<p>Every Small Business Faces Volatility</p>\r\n\r\n<p>I&#39;m making a bold claim about strategic planning for small businesses: the ones that have them are in the best position to weather volatility. Businesses without a strategic plan are in for a rude surprise.</p>\r\n\r\n<p>Here&#39;s a personal example that paints the picture.</p>\r\n\r\n<p>Back in my publishing days, the imprint I worked for struggled. Imagine my shock when I strode into the office one day and discovered that my boss had quit and I was elevated to take his place as the publisher of the worst-performing division of Thomas Nelson. I knew things weren&#39;t great before my boss left, but I didn&#39;t realize how bad things were until I took the reins.<br />\r\n<br />\r\n&nbsp;</p>\r\n\r\n<p>Here&#39;s what I found:</p>\r\n\r\n<ul>\r\n	<li><strong>We were the least profitable imprint</strong>&nbsp;of fourteen in the company. We had lost money the previous year, and people in the other divisions were mumbling that our performance had dragged the whole company down.</li>\r\n	<li><strong>Revenue hadn&#39;t grown in years.</strong>&nbsp;And to add insult to injury, one of our competitors walked away with our bestselling author.</li>\r\n	<li><strong>We were consuming enormous corporate resources</strong>&nbsp;and providing virtually no return to our shareholders.</li>\r\n	<li><strong>The team was small and overworked.</strong>&nbsp;We published about 125 new titles a year with ten people, and the quality suffered.</li>\r\n</ul>\r\n\r\n<p>The imprint had no vision or plan. This was the first thing I set about to fix when I took over. And once we created a strategic plan and executed it, we turned things around in 18 months. What was the worst-performing division in the company became the best.</p>\r\n\r\n<p>And it all started with a plan.&nbsp;</p>\r\n', 3, '2024-04-12 21:05:39', 0, 1, '0000-00-00 00:00:00', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE IF NOT EXISTS `post_comments` (
  `post_comment_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `comment_by` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`post_comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`post_comment_id`, `post_id`, `comment_by`, `created_at`, `updated_at`, `comment`) VALUES
(1, 1, 1, '2024-04-12 20:50:07', '0000-00-00 00:00:00', 'Adding first comment on my post'),
(2, 2, 1, '2024-04-12 20:57:29', '0000-00-00 00:00:00', 'Nice Post'),
(3, 4, 1, '2024-04-12 21:06:11', '0000-00-00 00:00:00', 'Nice article, really helpful'),
(4, 3, 1, '2024-04-12 21:06:44', '0000-00-00 00:00:00', 'Good one.. keep posting this type of artices');

--
-- Triggers `post_comments`
--
DROP TRIGGER IF EXISTS `update_post_comment_count_after_delete`;
DELIMITER $$
CREATE TRIGGER `update_post_comment_count_after_delete` AFTER DELETE ON `post_comments` FOR EACH ROW UPDATE posts SET total_comments = GREATEST(CAST(total_comments AS signed)-1, 0) WHERE post_id = old.post_id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_post_comment_count_after_insert`;
DELIMITER $$
CREATE TRIGGER `update_post_comment_count_after_insert` AFTER INSERT ON `post_comments` FOR EACH ROW UPDATE posts SET total_comments = total_comments + 1 WHERE post_id = new.post_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `created_at`) VALUES
(1, 'Dhruti', 'Dalwadi', 'dhruti.m25@gmail.com', '$2y$10$mEAEyI4Ea12PrWiitvef.eBnT43/xJQ2eNHBJwv/Z35eakw0vLQl2', '2024-04-12 20:47:32'),
(2, 'Malaxi', 'Dalwadi', 'malaxi@gmail.com', '$2y$10$T5hL2poJh8gs3Fo3alPxseDkUSWT43N3Ew.b6j7TP24Lizu1dZlq.', '2024-04-12 20:58:48'),
(3, 'Adam', 'Smith', 'adamsmith@gmail.com', '$2y$10$.2TlAuliL86tA5OB6bHR/en4KNjBEHiIqsUTX2Et6uBj3xdkd2JEi', '2024-04-12 21:02:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
