-- --------------------------------------------------------

--
-- Структура таблицы `boards`
--

CREATE TABLE IF NOT EXISTS `boards` (
  `boards_id` int(11) NOT NULL auto_increment,
  `boards_user` varchar(50) NOT NULL,
  `boards_title` varchar(50) NOT NULL,
  `boards_text` varchar(300) NOT NULL,
  `boards_price` varchar(50) NOT NULL,
  `boards_name` varchar(100) NOT NULL,
  `boards_time` varchar(60) NOT NULL,
  `boards_view` smallint(2) NOT NULL default '0',
  `boards_rub` smallint(2) NOT NULL,
  `boards_author` int(2) NOT NULL,
  `boards_cat` int(3) NOT NULL,
  `boards_phone` varchar(20) NOT NULL default '0',
  `boards_icq` int(10) NOT NULL default '0',
  `boards_skype` varchar(50) NOT NULL,
  `boards_pic` varchar(80) NOT NULL default '',
  `boards_pic2` varchar(80) NOT NULL default '',
  PRIMARY KEY  (`boards_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Дамп данных таблицы `boards`
--

INSERT INTO `boards` (`boards_id`, `boards_user`, `boards_title`, `boards_text`, `boards_price`, `boards_name`, `boards_time`, `boards_view`, `boards_rub`, `boards_author`, `boards_cat`, `boards_phone`, `boards_icq`, `boards_skype`, `boards_pic`, `boards_pic2`) VALUES
(1, 'flingthing@yandex.ru', 'Продам мотоцикл в хорошем качестве', 'Продаётся мотоцикл. Хорошее качество. Звоните, пишите', '25000', '', '15 ноября 2011 13:10:34', 1, 1, 2, 1, '0', 0, '', '', ''),
(2, 'flingthing@yandex.ru', 'Электрочайник', 'Продам чайник в плохом качестве!', '20', '', '15 ноября 2011 21:56:27', 1, 2, 1, 3, '0', 0, '', '', ''),
(3, 'flingthing@yandex.ru', 'KGHjmhlmj', 'TEST TEST TEST', '40000', '', '22.11.2011 17:04:01', 1, 2, 1, 8, '0', 0, '', '', ''),
(4, 'flingthing@yandex.ru', 'JKJLYUYIKY', 'TEST', '4500', '', '22.11.2011 17:05:10', 1, 3, 1, 15, '0', 0, '', '', ''),
(5, 'flingthing@yandex.ru', 'HJTYJylklkjylIKbnbnbn', 'TEST', '36999', '', '22.11.2011 17:06:10', 1, 1, 1, 1, '0', 0, '', '', ''),
(6, 'flingthing@yandex.ru', 'HJhnnehyugsdbwvjscvbds', 'TEST', '3699', '', '22.11.2011 17:06:15', 1, 4, 1, 1, '0', 0, '', '', ''),
(7, 'flingthing@yandex.ru', 'khglhknmlghkltyito', 'TEST', '399', '', '22.11.2011 17:06:50', 1, 1, 1, 1, '0', 0, '', '', ''),
(8, 'flingthing@yandex.ru', 'HJTYJylklkjytytytyttynbnbn', 'TEST', '39', '', '22.11.2011 17:07:00', 1, 3, 1, 1, '0', 0, '', '', ''),
(9, 'flingthing@yandex.ru', 'HJTYJylklkjylIKbnbnbn', 'TEST', '36999', '', '22.11.2011 17:06:10', 1, 2, 1, 1, '0', 0, '', '', ''),
(10, 'flingthing@yandex.ru', 'cnvmbdvdjbfjejbnbn', 'TEST', '89', '', '22.11.2011 17:08:10', 1, 2, 1, 1, '0', 0, '', '', ''),
(11, 'flingthing@yandex.ru', 'HJTYJylthytjun', 'TEST', '36999', '', '22.11.2011 17:09:10', 1, 2, 1, 1, '0', 0, '', '', ''),
(12, 'flingthing@yandex.ru', 'HJTYJylklkjjklklklk', 'TEST', '36999', '', '22.11.2011 17:09:50', 1, 3, 1, 3, '0', 0, '', '', ''),
(13, 'flingthing@yandex.ru', 'Huiuyuhfjdskssdsdsdssdsnbn', 'TEST', '36999', '', '22.11.2011 17:15:10', 1, 2, 2, 3, '0', 0, '', '', ''),
(14, 'flingthing@yandex.ru', 'Chahu', 'TEST', '390', '', '22.11.2011 17:16:10', 1, 1, 1, 3, '0', 0, '', '', ''),
(15, 'flingthing@yandex.ru', 'Dianchahu', 'TEST', '399', '', '22.11.2011 17:16:39', 1, 2, 1, 3, '0', 0, '', '', ''),
(16, 'flingthing@yandex.ru', 'Diandeng', 'TEST', '99', '', '22.11.2011 17:06:10', 1, 4, 1, 3, '0', 0, '', '', ''),
(17, 'flingthing@yandex.ru', 'Dsvgegfueyghsdjbdjbdjsbvhjb', 'TEST', '36999', '', '22.11.2011 17:18:15', 1, 2, 1, 3, '0', 0, '', '', ''),
(18, 'flingthing@yandex.ru', 'fldkfdnfjkdnfkjdvhjb', 'TEST', '36999', '', '22.11.2011 18:18:15', 1, 2, 1, 1, '0', 0, '', '', ''),
(19, 'flingthing@yandex.ru', 'Djhghjgjgjhgjhgjgjb', 'TEST', '369', '', '22.11.2011 18:18:45', 1, 2, 1, 1, '0', 0, '', '', ''),
(20, 'flingthing@yandex.ru', 'dfghfghfhfjsbvhjb', 'TEST', '369', '', '22.11.2011 18:28:15', 1, 2, 1, 1, '0', 0, '', '', ''),
(21, 'flingthing@yandex.ru', 'vgfhgmhflfhbvhjb', 'TEST', '3699', '', '22.11.2011 18:29:05', 1, 2, 1, 1, '0', 0, '', '', ''),
(22, 'flingthing@yandex.ru', 'hgfghfhfhfhfhfjbdjbdjsbvhjb', 'TEST', '399', '', '22.11.2011 18:30:55', 1, 2, 1, 1, '0', 0, '', '', ''),
(23, 'flingthing@yandex.ru', 'fhdhdfhdhhdhdhgjgjb', 'TEST', '3888', '', '22.11.2011 18:31:15', 1, 2, 1, 1, '0', 0, '', '', ''),
(24, '', '', 'kmnlkhmlgmnlm lmhlnmgnmhg', '', '', '', 0, 0, 0, 0, '0', 0, '', '', ''),
(25, 'info@wlantele.com', '', 'Проверка', '', '', '', 0, 0, 0, 0, '0', 0, '', '', ''),
(26, 'info@wlantele.com', 'Книга', 'Проверяем на тип.', '', '', '', 0, 2, 0, 0, '0', 0, '', '', ''),
(35, 'info@wlantele.com', 'ICQ', 'ICQ-TEST', '', '', '27 Nov 2011 14:37:47', 0, 1, 0, 1, '+8865499899', 89652669, '', '', ''),
(36, 'info@wlantele.com', 'ICQQQQQ', 'TESTTTTT', '', '', '27 Nov 2011 14:39:41', 0, 1, 0, 1, '+69454124545', 7894562, '', '', ''),
(39, 'info@wlantele.com', 'Skype', 'skype test', '', '', '27 Nov 2011 15:01:21', 0, 6, 0, 2, '', 0, 'ghghfhgsfdasaada', '', ''),
(40, 'info@wlantele.com', 'Проверка 1', 'ПРРОПпооеоеноеоеоеое', '78', '', '27 Nov 2011 15:45:29', 0, 6, 0, 1, '', 0, '', '', ''),
(41, 'info@wlantele.com', 'PRICE NOT', 'glhmnglmnlkgmnlk mlmnlmnlgnghg', 'Бесплатно!', '', '27 Nov 2011 15:46:49', 1, 1, 0, 3, '', 0, '', '', ''),
(46, 'info@wlantele.com', '', '', '89', '', '27 Nov 2011 16:50:48', 1, 10, 0, 4, '+8869547895', 9895656, 'ghghghfgfhggh', '', ''),
(44, 'info@wlantele.com', 'GGGGGGGGGG', 'ngnghmjhmmhjmhmhjh', 'Бесплатно!', '', '27 Nov 2011 15:50:39', 1, 1, 0, 3, '', 0, '', '', ''),
(45, 'info@wlantele.com', 'Цена', 'ртпртьл ьдлрьтдрлпьт ьзьзжьбетзнщлзентзщлтенлтзещетеео', 'Договорная', '', '27 Nov 2011 15:51:46', 1, 1, 0, 41, '', 0, '', '', ''),
(48, 'flingthing@yandex.ru', 'ТЕСТ', 'тнл щзлщлртщплтшщл лтщзлезтлзенлзеое', 'Договорная', '', '27 Nov 2011 17:06:31', 0, 1, 1, 4, '', 0, '', '', ''),
(49, 'flingthing@yandex.ru', 'Проверка', 'ноеое ьит а тптилатиолтилатилалтал', '82', '', '27 Nov 2011 17:10:03', 0, 11, 1, 2, '', 0, '', '', ''),
(50, 'flingthing@yandex.ru', 'Проверка', 'олитпалтпилоатиатиаиа', '82', '', '27 Nov 2011 17:13:22', 0, 11, 1, 2, '', 0, '', '', ''),
(51, 'info@wlantele.com', 'Проверочное', 'jbkgjnfknj kngkbngjkfnbkfnb', 'Договорная', '', '27 Nov 2011 18:00:41', 0, 30, 1, 1, '', 0, '', '', ''),
(52, 'info@wlantele.com', 'ТЕСТ', 'пльдль тпищатпищщкщк', 'Договорная', '', '27 Nov 2011 18:03:26', 0, 1, 0, 4, '', 0, '', '', ''),
(53, 'info@wlantele.com', 'ТЕСТ&quot;&quot;&quot;&quot;&quot;', 'ававпв', 'Договорная', '', '27 Nov 2011 18:05:44', 0, 1, 0, 4, '', 0, '', '', ''),
(54, 'info@wlantele.com', 'ТЕС&lt;a href=&quot;&quot;&gt;&lt;/a&gt;', 'ававпвbdfbfddfbdbddbd', '852', '', '27 Nov 2011 18:07:48', 0, 1, 0, 1, '', 0, '', '', ''),
(55, 'info@wlantele.com', 'Проверрка №', 'лдаиьдпьиладпьтдаьтщкеншщоншщще', 'Договорная', 'Zhang Liwang', '27 Nov 2011 19:02:44', 0, 3, 1, 2, '', 0, '', '', ''),
(56, 'info@wlantele.com', 'hklnklhm klhl ngnkgnkgnh', 'fdjnrfjkg nikrtnbinrtuinrbiur nn inrnbirnbunbununbutnbuntu', '456321', 'klfldflndndk', '27 Nov 2011 19:17:01', 0, 1, 1, 4, '', 0, '', '', ''),
(57, 'flingthing@yandex.ru', 'Проверка', 'ипмвамаввипат олпт олатолаила а', 'Бесплатно!', 'j ngfnbtn iniritr', '27 Nov 2011 21:50:58', 0, 6, 1, 3, '+789569596596', 656598565, 'trterwewccccwcwfwfger', '', ''),
(58, 'flingthing@yandex.ru', 'Хорек', 'ываываываыва', '10000', 'АААА', '28 Nov 2011 08:40:51', 1, 6, 1, 1, '+7(987)1211212', 984654654, 'ываыва654', '', ''),
(68, 'admin', 'hhghghg', 'cvvvvvvvvvvvvvvvcvcvcv', '898989', 'fgfgfgfggjyuyuyliul', '30 Nov 2011 01:39:12', 0, 1, 1, 1, '', 0, '', '/pics//t-edit.png', '/pics//t-new.png'),
(69, 'admin', 'hjghggjhjgg', 'hghjggggggggggggggg', '89898989', 'hgjhgjggj', '30 Nov 2011 01:41:15', 0, 27, 1, 4, '', 0, '', '/pics/t-new.png', '/pics/t-edit.png'),
(70, 'admin', 'fgfgfffffffgggggggggggggggggggggg', 'vbvbvv nghngnggnghng', '456', 'gnghnghngnghhjhj', '30 Nov 2011 01:43:07', 0, 1, 1, 1, '', 0, '', '/pics/t-new.png', '/pics/t-edit.png'),
(71, 'admin', '123gfgffghjkloiuytttttt', 'bgfhfhh52h52g5hg25hg5hg552522525', '789', 'nhnhnhnhnhnhnhn', '30 Nov 2011 01:46:54', 0, 1, 1, 1, '', 0, '', 'http://dfboard.wlantele.com/pics/t-edit.png', 'http://dfboard.wlantele.com/pics/t-new.png'),
(72, 'admin', 'jmjmjmjm', 'mjjj89899999999999999955555555555555555555555', '565', '789456123', '30 Nov 2011 01:52:07', 0, 1, 1, 4, '', 0, '', 'http://dfboard.wlantele.com/pics/t-edit.png', 'http://dfboard.wlantele.com/pics/t-new.png'),
(73, 'admin', '123456', '77777777777777777777777777777777777777777', '555', 'ghjkl', '30 Nov 2011 01:55:53', 0, 1, 1, 1, '', 0, '', 'http://dfboard.wlantele.com/pics/t-edit.png', 'http://dfboard.wlantele.com/pics/t-new.png'),
(74, 'admin', 'ffffffffffffgggggggggggggggggggggggggggggggggghhhh', 'csxsxsxsxsxsxsxplplpplpplplplplplpoikikikik', 'Бесплатно!', 'bnbnbnbnbnbnb', '30 Nov 2011 14:24:21', 0, 1, 1, 3, '', 0, '', './pics/t-download.png', './pics/t-upload.png'),
(75, 'admin', '5656565656565', '4561356568899', '85555', '123456', '30 Nov 2011 14:25:57', 0, 28, 1, 4, '', 0, '', './pics/t-download.png', './pics/T-UploaD.png'),
(76, 'admin', '987654321', 'qwertyuasdfghjkl', '9223372036854775807', 'mnbvcxz', '30 Nov 2011 14:27:58', 0, 1, 1, 1, '', 0, '', './pics/t-download.png', './pics/T-UploaD.png'),
(77, 'admin', '09876543210', 'gkmbkhmghnkgknkjnkg', '654987', 'zxcvbnmqwertyuiophgfjl', '30 Nov 2011 14:30:13', 0, 1, 1, 1, '', 0, '', './pics/t-download.png', './pics/t-upload.png'),
(78, 'admin', '789456', 'okjuokjuypykpjykpjupykojyp', '528000', 'vbnmkjh', '30 Nov 2011 14:34:24', 0, 24, 1, 4, '', 0, '', './pics/t-download.png', './pics/t-upload.png'),
(80, 'admin', 'Сингл Iron Maiden From Fear To Eternity 2011', 'Новый сингл 2011 года. Куплю.', 'Договорная', 'Metaller', '30 Nov 2011 19:28:49', 1, 15, 1, 2, '895656895659595', 232323232, 'mbkgbmglmlgmhklmlgmlg', './pics/2011_from_fear_to_eternity.jpg', './pics/t-back.png'),
(81, 'admin', 'gbfgfbgfbfbfbfbfbfbfbfb', 'gbfbgfbfbfbfbfbfbgfbfbgf', '654855', 'bfbfgbfbgfb', '30 Nov 2011 23:22:46', 1, 1, 1, 16, '', 0, '', './pics/t-paste.png', './pics/t-back.png'),
(82, 'admin', 'zxcvbn', '123zxc', '96', 'zxcvbnm', '01 Dec 2011 00:06:03', 1, 4, 1, 4, '13221355555', 0, '', './pics/', './pics/'),
(83, 'admin', 'gfbglfngklngfklnlgf', 'texttttt', '58', 'mnbvccccxxccvvgbg', '01 Dec 2011 00:11:51', 0, 1, 1, 4, '', 0, '', './pics/./pics/2011_from_fear_to_eternity.jpg', 't-paste.png'),
(94, 'admin', 'Альбом Powerslave (1984)', 'Iron maiden Powerslave', 'Договорная', 'Metaller', '01 Dec 2011 18:35:00', 1, 2, 1, 15, '+69(58)4545656', 4569874, 'zxcvbnmlkjhfderg', './pics/1984_aces_high.jpg', './pics/1984_powerslave.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL auto_increment,
  `categoria_title` varchar(50) NOT NULL,
  PRIMARY KEY  (`categoria_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_title`) VALUES
(1, 'авто/мото запчасти'),
(2, 'антиквариат/коллекции'),
(3, 'бытовая техника'),
(4, 'готовый бизнес'),
(5, 'детский мир'),
(6, 'животные'),
(7, 'здоровье'),
(8, 'игровые приставки'),
(9, 'канцтовары'),
(10, 'книги/журналы'),
(11, 'коммерческий транспорт'),
(12, 'компьютеры'),
(13, 'красота'),
(14, 'мебель/декор'),
(15, 'мир музыки'),
(16, 'образование'),
(17, 'одежда/обувь'),
(18, 'оргтехника'),
(19, 'охота/рыбалка'),
(20, 'предложения турфирм'),
(21, 'продукты питания'),
(22, 'промоборудование'),
(23, 'развлечения'),
(24, 'ремонт'),
(25, 'ритуальные услуги'),
(26, 'садоводство/растения'),
(27, 'спецтехника'),
(28, 'спорт/спортинвентарь'),
(29, 'строительство'),
(30, 'стройматериалы'),
(31, 'сырьё и материалы'),
(32, 'телефоны'),
(33, 'торговое оборудование'),
(34, 'транспортные услуги'),
(35, 'украшения'),
(36, 'услуги для бизнеса'),
(37, 'финансы'),
(38, 'фото/видео'),
(39, 'хозтовары'),
(40, 'эзотерика'),
(41, 'юридические услуги');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL default '',
  `num` smallint(4) NOT NULL default '3',
  `icq` int(10) NOT NULL default '0',
  `phone` varchar(20) NOT NULL default '0',
  `skype` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `num` (`num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `name`, `num`, `icq`, `phone`, `skype`) VALUES
(1, 'admin', '897c8fde25c5cc5270cda61425eed3c8', 'Дмитрий', 1, 0, '+79308545545', 'f-dmitry-skype'),
(2, 'manager', '42df55041d8d6de9e5e80a2c055590a3', '', 2, 0, '+79595959999', '');