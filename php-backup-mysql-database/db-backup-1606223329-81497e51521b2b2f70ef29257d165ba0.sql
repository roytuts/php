DROP TABLE blog;

CREATE TABLE `blog` (
  `blog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_date` datetime NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO blog VALUES("1","Test Blog Title","Test Blog Content","2020-09-30 13:42:17");
INSERT INTO blog VALUES("2","Test Blog Title","Test Blog Content","2020-09-30 13:42:17");
INSERT INTO blog VALUES("3","Test Blog Title","Test Blog Content","2020-09-30 13:42:17");