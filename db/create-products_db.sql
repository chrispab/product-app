CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_number` varchar(50) CHARACTER SET latin1 NOT NULL,
  `description` varchar(150) CHARACTER SET latin1 NOT NULL,
  'image' LONGBLOB NOT NULL,
  `stock_quantity` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cost_price` varchar(255) CHARACTER SET latin1 NOT NULL,
  `selling_price` varchar(255) CHARACTER SET latin1 NOT NULL,
  `vat_rate` varchar(255) CHARACTER SET latin1 NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `address`) VALUES
(1, 'Al-Amin Khan', 'al@min.com', '6546464', 'Dhaka,Bangladesh'),
(2, 'Sahed Bhuiyan', 's@hed.com', '987979', 'Khulna, Bangladesh'),
(3, 'Mamun', 'm@mun.com', '1234', 'Dhaka, Bangladesh'),
(9, 'foysal', 'foysal@yahoo.com', '1234556', 'Dhaka, Bangladesh.');
