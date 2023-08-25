CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;