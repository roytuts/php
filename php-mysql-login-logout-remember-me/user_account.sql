CREATE TABLE `user_account` (
  `account_id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_login` varchar(25) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert  into `user_account`(`account_id`,`account_login`,`account_password`,`user_name`,`user_email`,`last_login`) values (1,'user','ee11cbb19052e40b07aac0ca060c23ee ','soumitra','contact@roytuts.com','2020-01-21 07:36:07');