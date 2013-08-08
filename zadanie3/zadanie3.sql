CREATE TABLE IF NOT EXISTS `osoby` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imie` varchar(50) NOT NULL DEFAULT '0',
  `nazwisko` varchar(50) NOT NULL DEFAULT '0',
  `wiek` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;