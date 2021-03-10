CREATE TABLE `user` (
	`user_id` int unsigned COLLATE utf8mb4_unicode_ci NOT NULL AUTO_INCREMENT,
	`login_username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
	`login_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	`last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`),
	UNIQUE KEY `login_email_UNIQUE` (`login_username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into `user`(`user_id`,`login_username`,`login_password`,`last_login`) 
values (1,'user1','$2a$08$S5IfrpOVOvFbbOSOmZpjsO5N9PXgEerTloK','2014-07-19 19:18:30'),(2,'user2','$2a$08$v1kJflweCK3FOcoAsmYAUCMxFa5Shh7c2','2013-11-17 19:22:46');