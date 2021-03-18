CREATE TABLE `category` (
  `category_id` int unsigned COLLATE utf8mb4_unicode_ci NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int unsigned COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sort_order` int COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `unique` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert  into `category`(`category_id`,`category_name`,`category_link`,`parent_id`,`sort_order`) values (1,'Home','home',0,0),
(2,'Tutorials','tutorials',0,1),
(3,'Java','java',2,1),
(4,'Liferay','liferay',2,1),
(5,'Frameworks','frameworks',0,2),
(6,'JSF','jsf',5,2),
(7,'Struts','struts',5,2),
(8,'Spring','spring',5,2),
(9,'Hibernate','hibernate',5,2),
(10,'Webservices','webservices',0,3),
(11,'REST','rest',10,3),
(12,'SOAP','soap',10,3),
(13,'Contact','contact',0,4),
(14,'About','about',0,5);