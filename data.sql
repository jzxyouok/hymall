-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 10 月 29 日 17:06
-- 服务器版本: 5.5.27
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `data`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pwd` char(32) NOT NULL,
  `last_login_ip` int(11) NOT NULL DEFAULT '0',
  `last_login_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `pwd`, `last_login_ip`, `last_login_time`) VALUES
(1, 'aa', '4124bc0a9335c27f086f24ba207a4912', -1062731460, 1444205892);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sort_order` int(11) DEFAULT '50',
  `parentid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `parentid`) VALUES
(1, '服装', 20, 0),
(2, '电器', 50, 0),
(3, '男装', 50, 1),
(4, '女装', 50, 1),
(5, '电脑', 50, 2),
(6, '冰箱', 50, 2),
(7, '洗衣机', 50, 2),
(8, '空调', 50, 2),
(9, '童装', 50, 1);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `goodsid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `name` varchar(50) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `image_ori` varchar(200) DEFAULT NULL,
  `image_thumb` varchar(200) DEFAULT NULL,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `status` set('best','new','hot') NOT NULL DEFAULT '',
  `goods_desc` tinytext NOT NULL,
  PRIMARY KEY (`goodsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`goodsid`, `name`, `price`, `image_ori`, `image_thumb`, `categoryid`, `status`, `goods_desc`) VALUES
(8, 'T恤', '10.00', '5603f93b089714.25741594.jpg', 's_5603f93b089714.25741594.jpg', 3, 'best,new', '爱的啊'),
(9, '滚筒洗衣机', '1000.00', '5603f9a9cbbdb3.09757825.jpg', 's_5603f9a9cbbdb3.09757825.jpg', 7, 'new,hot', '哈哈');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text,
  `sender` varchar(32) NOT NULL DEFAULT '',
  `receiver` varchar(32) NOT NULL DEFAULT '',
  `color` char(7) NOT NULL DEFAULT '',
  `biaoqing` varchar(32) NOT NULL DEFAULT '',
  `add_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `proID` int(10) NOT NULL AUTO_INCREMENT,
  `proname` varchar(40) DEFAULT NULL COMMENT '产品名称',
  `proguige` varchar(20) DEFAULT NULL COMMENT '产品规格',
  `proprice` decimal(19,4) DEFAULT NULL,
  `proamount` smallint(5) DEFAULT NULL,
  `proimages` varchar(50) DEFAULT NULL,
  `proweb` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`proID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`proID`, `proname`, `proguige`, `proprice`, `proamount`, `proimages`, `proweb`) VALUES
(1, '苹果汁', '每箱24瓶', '18.0000', 39, 'images\\1.bmp', 'http://www.sina.com.cn'),
(2, '牛奶', '每箱24瓶', '19.0000', 17, 'images\\2.bmp', 'http://www.sohu.com'),
(3, '蕃茄酱', '每箱12瓶', '10.0000', 13, 'images\\3.bmp', NULL),
(4, '盐', '每箱12瓶', '22.0000', 53, 'images\\4.bmp', 'http://www.sina.com.cn'),
(5, '麻油', '每箱12瓶', '21.3500', 0, 'images\\5.bmp', 'http://www.sina.com.cn'),
(6, '酱油', '每箱12瓶', '25.0000', 120, 'images\\6.bmp', 'http://www.sohu.com'),
(7, '海鲜粉', '每箱30盒', '30.0000', 15, '', 'http://www.sina.com.cn'),
(8, '胡椒粉', '每箱30盒', '40.0000', 6, 'images\\8.bmp', 'http://www.sina.com.cn'),
(9, '鸡', '每袋500克', '97.0000', 29, 'images\\9.bmp', 'http://www.sina.com.cn'),
(10, '蟹', '每袋500克', '31.0000', 31, 'images\\10.bmp', 'http://www.sina.com.cn'),
(11, '大众奶酪', '每袋6包', '21.0000', 22, '', NULL),
(12, '德国奶酪', '每箱12瓶', '38.0000', 86, 'images\\12.bmp', 'http://www.sina.com.cn'),
(13, '龙虾', '每袋500克', '6.0000', 24, 'images\\13.bmp', 'http://www.sina.com.cn'),
(14, '沙茶', '每箱12瓶', '23.2500', 35, '', 'http://www.sohu.com'),
(15, '味精', '每箱30盒', '15.5000', 39, 'images\\15.bmp', 'http://www.sina.com.cn'),
(16, '饼干', '每箱30盒', '17.4500', 29, 'images\\16.bmp', 'http://www.google.com'),
(17, '猪肉', '每袋500克', '39.0000', 0, 'images\\17.bmp', 'http://www.sina.com.cn'),
(18, '墨鱼', '每袋500克', '62.5000', 42, '', NULL),
(19, '糖果', '每箱30盒', '9.2000', 25, 'images\\19.bmp', 'http://www.sina.com.cn'),
(20, '桂花糕', '每箱30盒', '81.0000', 40, 'images\\20.bmp', 'http://www.sina.com.cn'),
(21, '花生', '每箱30包', '10.0000', 3, 'images\\21.bmp', 'http://www.google.com'),
(22, '糯米', '每袋3公斤', '21.0000', 104, 'images\\22.bmp', 'http://www.sina.com.cn'),
(23, '燕麦', '每袋3公斤', '9.0000', 61, 'images\\23.bmp', NULL),
(24, '汽水', '每箱12瓶', '4.5000', 20, '', 'http://www.sina.com.cn'),
(25, '巧克力', '每箱30盒', '14.0000', 76, 'images\\25.bmp', 'http://www.sina.com.cn'),
(26, '棉花糖', '每箱30盒', '31.2300', 15, 'images\\26.bmp', 'http://www.sina.com.cn'),
(27, '牛肉干', '每箱30包', '43.9000', 49, 'images\\27.bmp', 'http://www.sina.com.cn'),
(28, '烤肉酱', '每箱12瓶', '45.6000', 26, 'images\\28.bmp', NULL),
(29, '鸭肉', '每袋3公斤', '123.7900', 0, '', 'http://www.sina.com.cn'),
(30, '黄鱼', '每袋3公斤', '25.8900', 10, 'images\\30.bmp', 'http://www.sohu.com'),
(31, '温馨奶酪', '每箱12瓶', '12.5000', 0, 'images\\31.bmp', 'http://www.sina.com.cn'),
(32, '白奶酪', '每箱12瓶', '32.0000', 9, 'images\\32.bmp', 'http://www.sina.com.cn'),
(33, '浪花奶酪', '每箱12瓶', '2.5000', 112, '', 'http://www.sina.com.cn'),
(34, '啤酒', '每箱24瓶', '14.0000', 111, 'images\\34.bmp', 'http://www.sohu.com'),
(35, '蜜桃汁', '每箱24瓶', '18.0000', 20, '', 'http://www.sina.com.cn'),
(36, '鱿鱼', '每袋3公斤', '19.0000', 112, 'images\\36.bmp', 'http://www.sina.com.cn'),
(37, '干贝', '每袋3公斤', '26.0000', 11, 'images\\37.bmp', 'http://www.sina.com.cn'),
(38, '绿茶', '每箱24瓶', '263.5000', 17, 'images\\38.bmp', 'http://www.sohu.com'),
(39, '运动饮料', '每箱24瓶', '18.0000', 69, 'images\\39.bmp', 'http://www.sina.com.cn'),
(40, '虾米', '每袋3公斤', '18.4000', 123, 'images\\40.bmp', NULL),
(41, '虾子', '每袋3公斤', '9.6500', 85, 'images\\41.bmp', 'http://www.google.com'),
(42, '糙米', '每袋3公斤', '14.0000', 26, 'images\\42.bmp', 'http://www.sina.com.cn'),
(43, '柳橙汁', '每箱24瓶', '46.0000', 17, 'images\\43.bmp', NULL),
(44, '蚝油', '每箱24瓶', '19.4500', 27, 'images\\44.bmp', 'http://www.sina.com.cn'),
(45, '雪鱼', '每袋3公斤', '9.5000', 5, 'images\\45.bmp', 'http://www.google.com'),
(46, '蚵', '每袋3公斤', '12.0000', 95, 'images\\46.bmp', NULL),
(47, '蛋糕', '每箱24个', '9.5000', 36, '', 'http://www.sina.com.cn'),
(48, '玉米片', '每箱24包', '12.7500', 15, 'images\\48.bmp', 'http://www.chinaren.com.cn'),
(49, '薯条', '每箱24包', '20.0000', 10, 'images\\49.bmp', NULL),
(50, '玉米饼', '每箱24包', '16.2500', 65, '', 'http://www.sina.com.cn'),
(51, '猪肉干', '每箱24包', '53.0000', 20, 'images\\51.bmp', 'http://www.sina.com.cn'),
(52, '三合一麦片', '每箱24包', '7.0000', 38, 'images\\52.bmp', 'http://www.sina.com.cn'),
(53, '盐水鸭', '每袋3公斤', '32.8000', 0, '', 'http://www.sina.com.cn'),
(54, '鸡肉', '每袋3公斤', '7.4500', 21, 'images\\54.bmp', NULL),
(55, '鸭肉', '每袋3公斤', '24.0000', 115, 'images\\55.bmp', 'http://www.google.com'),
(56, '白米', '每袋3公斤', '38.0000', 21, 'images\\56.bmp', 'http://www.sina.com.cn'),
(57, '小米', '每袋3公斤', '19.5000', 36, '', 'http://www.chinaren.com.cn'),
(58, '海参', '每袋3公斤', '13.2500', 62, 'images\\58.bmp', 'http://www.sina.com.cn'),
(59, '光明奶酪', '每箱24瓶', '55.0000', 79, 'images\\59.bmp', NULL),
(60, '花奶酪', '每箱24瓶', '34.0000', 19, 'images\\60.bmp', 'http://www.sina.com.cn'),
(61, '海鲜酱', '每箱24瓶', '28.5000', 113, 'images\\61.bmp', 'http://www.163.com'),
(62, '山渣片', '每箱24包', '49.3000', 17, 'images\\62.bmp', 'http://www.sina.com.cn'),
(63, '甜辣酱', '每箱24瓶', '43.9000', 24, '', 'http://www.163.com'),
(64, '黄豆', '每袋3公斤', '33.2500', 22, 'images\\64.bmp', 'http://www.sina.com.cn'),
(65, '海苔酱', '每箱24瓶', '21.0500', 76, 'images\\65.bmp', 'http://www.sina.com.cn'),
(66, '肉松', '每箱24瓶', '17.0000', 4, 'images\\66.bmp', NULL),
(67, '矿泉水', '每箱24瓶', '14.0000', 52, 'images\\67.bmp', 'http://www.sina.com.cn'),
(68, '绿豆糕', '每箱24包', '12.5000', 6, '', 'http://www.sina.com.cn'),
(69, '黑奶酪', '每盒24个', '36.0000', 26, 'images\\69.bmp', 'http://www.163.com'),
(70, '苏打水', '每箱24瓶', '15.0000', 15, 'images\\70.bmp', 'http://www.google.com'),
(71, '意大利奶酪', '每箱2个', '21.5000', 26, 'images\\71.bmp', 'http://www.sina.com.cn'),
(72, '酸奶酪', '每箱2个', '34.8000', 14, '', 'http://www.chinaren.com.cn'),
(73, '海哲皮', '每袋3公斤', '15.0000', 101, 'images\\73.bmp', NULL),
(74, '鸡精', '每盒24个', '10.0000', 4, 'images\\74.bmp', 'http://www.sina.com.cn');

-- --------------------------------------------------------

--
-- 表的结构 `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sess_id` varchar(32) NOT NULL,
  `sess_value` text NOT NULL,
  `sess_expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `session`
--

INSERT INTO `session` (`sess_id`, `sess_value`, `sess_expires`) VALUES
('1qvmoemu1f64ban7mhu0cpbfe6', '', 1443018718),
('3lm1892fh2gt2hf968ee3s9b00', '', 1443018048),
('5gnts4r4negr50mrnqmfpea365', 'code|s:2:"FE";admin|a:5:{s:2:"id";s:1:"1";s:4:"name";s:2:"aa";s:3:"pwd";s:32:"4124bc0a9335c27f086f24ba207a4912";s:13:"last_login_ip";s:10:"2130706433";s:15:"last_login_time";s:10:"1443332344";}', 1443332373),
('b94pc8kndc641rh2iee17nnof2', '', 1443019314),
('btfua5t9jo9ap5iuvk970gofc7', '', 1443018296),
('d5r77ntggoetsbrtcjuei1amn3', 'code|s:2:"2R";admin|a:5:{s:2:"id";s:1:"1";s:4:"name";s:2:"aa";s:3:"pwd";s:32:"4124bc0a9335c27f086f24ba207a4912";s:13:"last_login_ip";s:10:"2130706433";s:15:"last_login_time";s:10:"1442825905";}', 1443019920),
('dktgtp6f2bli22olflceb04t94', '', 1443018938),
('fovbdic8f0a35nlb27mncv6244', 'code|s:2:"9I";admin|a:5:{s:2:"id";s:1:"1";s:4:"name";s:2:"aa";s:3:"pwd";s:32:"4124bc0a9335c27f086f24ba207a4912";s:13:"last_login_ip";s:10:"2130706433";s:15:"last_login_time";s:10:"1443332362";}', 1443846897),
('ib1tarjq0p84im8gpd81kb97f5', 'code|s:2:"G5";admin|a:5:{s:2:"id";s:1:"1";s:4:"name";s:2:"aa";s:3:"pwd";s:32:"4124bc0a9335c27f086f24ba207a4912";s:13:"last_login_ip";s:10:"2130706433";s:15:"last_login_time";s:10:"1443019897";}', 1443100987),
('itj0umpch3uonlvfvk2h7rlm80', 'code|s:2:"KA";admin|a:5:{s:2:"id";s:1:"1";s:4:"name";s:2:"aa";s:3:"pwd";s:32:"4124bc0a9335c27f086f24ba207a4912";s:13:"last_login_ip";s:10:"2130706433";s:15:"last_login_time";s:10:"1443094660";}', 1443107255),
('k15anc2kuarfl63oesbmdtqlm1', '', 1443018882),
('m0rumi19c3ih9cpo9rehjeb1b6', 'code|s:2:"4D";', 1443019810),
('qe52jlhid48v8obkm91kiiqe40', 'code|s:2:"7G";admin|a:5:{s:2:"id";s:1:"1";s:4:"name";s:2:"aa";s:3:"pwd";s:32:"4124bc0a9335c27f086f24ba207a4912";s:13:"last_login_ip";s:10:"2130706433";s:15:"last_login_time";s:10:"1443846882";}', 1444205901),
('ut3jer8jr1gbgie681cvsnhtb1', '', 1443018702);

-- --------------------------------------------------------

--
-- 表的结构 `sw_auth`
--

CREATE TABLE IF NOT EXISTS `sw_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '权限名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '模块',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `sw_auth`
--

INSERT INTO `sw_auth` (`auth_id`, `auth_name`, `auth_pid`, `auth_c`, `auth_a`, `auth_path`, `auth_level`) VALUES
(1, '商品管理', 0, '', '', '1', 0),
(2, '订单管理', 0, '', '', '2', 0),
(3, '权限管理', 0, '', '', '3', 0),
(4, '显示商品', 1, 'Goods', 'showlist', '1-4', 1),
(5, '添加商品', 1, 'Goods', 'add', '1-5', 1),
(6, '显示订单', 2, 'Orders', 'showlist', '2-6', 1),
(8, '角色管理', 3, 'Role', 'showlist', '3-8', 1),
(9, '权限分发', 3, 'Authority', 'showlist', '3-9', 1),
(12, '品牌管理', 1, 'Brand', 'showlist', '1-12', 1),
(15, '会员管理', 0, '', '', '15', 0),
(16, '显示会员', 15, 'User', 'showlist', '15-16', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sw_auth_copy`
--

CREATE TABLE IF NOT EXISTS `sw_auth_copy` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '权限名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '模块',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `sw_auth_copy`
--

INSERT INTO `sw_auth_copy` (`auth_id`, `auth_name`, `auth_pid`, `auth_c`, `auth_a`, `auth_path`, `auth_level`) VALUES
(7, '订单查询', 2, 'Orders', 'select', '2-7', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sw_brand`
--

CREATE TABLE IF NOT EXISTS `sw_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) NOT NULL DEFAULT '',
  `brand_log` varchar(255) DEFAULT '',
  `brand_thumb` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `brand_desc` text,
  `last_time` int(11) DEFAULT '0',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `sw_brand`
--

INSERT INTO `sw_brand` (`brand_id`, `brand_name`, `brand_log`, `brand_thumb`, `create_time`, `brand_desc`, `last_time`) VALUES
(2, '联想Lenovo', '2015-10-26/water_562e375694041.jpg', '2015-10-26/s_562e375694041.jpg', 1445869398, '可以', 1446109008),
(3, '摩托罗拉', '2015-10-26/water_562e391a17b49.gif', '2015-10-26/s_562e391a17b49.gif', 1445869850, '不错', 1446097107),
(4, '索尼', '2015-10-26/water_562e39fc708f4.jpg', '2015-10-26/s_562e39fc708f4.jpg', 1445870076, '将就你的', 1446082583),
(5, '神州', '2015-10-26/water_562e3ad69cddb.jpg', '2015-10-26/s_562e3ad69cddb.jpg', 1445870294, '优雅很好', 1446109055),
(7, '华硕', '2015-10-26/water_562e3da2c8506.jpg', '2015-10-26/s_562e3da2c8506.jpg', 1445871010, '坚如磐石', 0),
(8, '诺基亚', '2015-10-29/water_5631deb28faf1.jpg', '2015-10-29/s_5631deb28faf1.jpg', 1445871051, '砸核桃砸死', 1446108850),
(10, 'i疯', '2015-10-26/water_562e3ee632887.jpg', '2015-10-26/s_562e3ee632887.jpg', 1445871334, '肾牌', 0),
(11, '宏碁', '2015-10-26/water_562e42ea765bd.jpg', '2015-10-26/s_562e42ea765bd.jpg', 1445872362, '不错', 1446018219),
(12, '方正', '2015-10-27/water_562f0f8c54c0e.jpg', '2015-10-27/s_562f0f8c54c0e.jpg', 1445924748, '可以的', 1446017693),
(13, '三星', '2015-10-28/water_56306a41b5889.jpg', '2015-10-28/s_56306a41b5889.jpg', 1446013505, '不错的队伍', 1446049969);

-- --------------------------------------------------------

--
-- 表的结构 `sw_category`
--

CREATE TABLE IF NOT EXISTS `sw_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `sw_category`
--

INSERT INTO `sw_category` (`cat_id`, `cat_name`) VALUES
(1, '手机'),
(2, '电脑'),
(3, '相机'),
(4, '耳机'),
(5, '电池');

-- --------------------------------------------------------

--
-- 表的结构 `sw_goods`
--

CREATE TABLE IF NOT EXISTS `sw_goods` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `goods_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_weight` int(11) NOT NULL DEFAULT '0' COMMENT '重量',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `goods_number` int(11) NOT NULL DEFAULT '100' COMMENT '数量',
  `goods_category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类',
  `goods_brand_id` int(11) NOT NULL DEFAULT '0' COMMENT '品牌',
  `goods_introduce` text COLLATE utf8_unicode_ci COMMENT '详细介绍',
  `goods_big_img` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_small_img` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商品小图',
  `goods_create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `goods_last_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `sw_goods`
--

INSERT INTO `sw_goods` (`goods_id`, `goods_name`, `goods_weight`, `goods_price`, `goods_number`, `goods_category_id`, `goods_brand_id`, `goods_introduce`, `goods_big_img`, `goods_small_img`, `goods_create_time`, `goods_last_time`) VALUES
(1, 'I疯泼辣死', 0, '6800.00', 100, 1, 10, '疯了', '2015-10-28/water_563067b88eed7.jpg', '2015-10-28/small_563067b88eed7.jpg', 1446012856, 1446097069),
(2, 'i疯6s', 0, '5800.00', 100, 1, 10, '可以的', '2015-10-28/water_5630681a1fbdb.jpg', '2015-10-28/small_5630681a1fbdb.jpg', 1446018233, 1446083007),
(3, 'i疯5s', 0, '4800.00', 100, 1, 10, '不错', '2015-10-28/water_5630684457fea.jpg', '2015-10-28/small_5630684457fea.jpg', 1446013014, 1446053980),
(4, 'i疯5', 0, '2800.00', 100, 1, 10, '一般', '2015-10-28/water_563068af6cc6f.jpg', '2015-10-28/small_563068af6cc6f.jpg', 1446013927, 0),
(5, 'i疯4s', 0, '1200.00', 100, 1, 10, '便宜', '2015-10-28/water_563068f2502b8.jpg', '2015-10-28/small_563068f2502b8.jpg', 1446017814, 1446021807),
(6, 'i疯4', 0, '800.00', 100, 1, 10, '更便宜', '2015-10-28/water_563069a3c2b57.jpg', '2015-10-28/small_563069a3c2b57.jpg', 1446021500, 1446054438),
(7, '三星blue', 0, '2900.00', 100, 1, 13, '恩', '2015-10-29/water_5630f48ba4b8b.jpg', '2015-10-29/small_5630f48ba4b8b.jpg', 1446048907, 1446055060),
(8, '三星white', 0, '1800.00', 100, 1, 13, '恩可以的', '2015-10-29/water_5630f4b26b284.jpg', '2015-10-29/small_5630f4b26b284.jpg', 1446048946, 1446048946),
(9, 'SKT_T1', 0, '9999.00', 100, 1, 13, '还不错', '2015-10-29/water_5630f4e2e9143.jpg', '2015-10-29/small_5630f4e2e9143.jpg', 1446048994, 1446082904),
(10, 'koo_tigers', 0, '5000.00', 100, 1, 13, '可以', '2015-10-29/water_5630f5167845f.jpg', '2015-10-29/small_5630f5167845f.jpg', 1446049046, 1446084540),
(13, 'Fnatic', 0, '8900.00', 100, 1, 13, '还不错', '2015-10-29/water_5630f5d529649.jpg', '2015-10-29/small_5630f5d529649.jpg', 1446049237, 1446082661),
(14, 'Origen', 0, '7500.00', 100, 1, 13, '不错', '2015-10-29/water_5630f6364de7e.jpg', '2015-10-29/small_5630f6364de7e.jpg', 1446049334, 1446055044),
(15, '肾7', 0, '99999.00', 100, 1, 10, '还在疼', '2015-10-29/water_5630f65505562.jpg', '2015-10-29/small_5630f65505562.jpg', 1446049365, 1446054486),
(16, '联想Y460', 0, '1200.00', 100, 2, 2, '恩', '2015-10-29/water_5630f6b22e303.jpg', '2015-10-29/small_5630f6b22e303.jpg', 1446049458, 1446082446),
(17, '联想Y560', 0, '5600.00', 100, 2, 2, '不错', '2015-10-29/water_5630f6d482a6f.jpg', '2015-10-29/small_5630f6d482a6f.jpg', 1446049492, 1446054458),
(18, '联想Y660', 0, '7800.00', 100, 2, 2, '可以', '2015-10-29/water_5630f6fda0477.jpg', '2015-10-29/small_5630f6fda0477.jpg', 1446049533, 1446049533),
(19, '联想Y760', 0, '5200.00', 100, 2, 2, '恩不错的', '2015-10-29/water_5631e040d247d.jpg', '2015-10-29/small_5631e040d247d.jpg', 1446049571, 1446109248),
(20, '联想Y860', 0, '6000.00', 100, 2, 2, '恩', '2015-10-29/water_5630f74cca668.jpg', '2015-10-29/small_5630f74cca668.jpg', 1446049612, 1446049612),
(21, '联想Y960', 0, '6000.00', 100, 2, 2, '哦哦..', '2015-10-29/water_56317f79056c4.jpg', '2015-10-29/small_56317f79056c4.jpg', 1446049712, 1446084472),
(22, '三星S6', 0, '900.00', 100, 1, 13, '哎呀', '2015-10-29/water_5631e028191ed.jpg', '2015-10-29/small_5631e028191ed.jpg', 1446109224, 1446109224);

--
-- 触发器 `sw_goods`
--
DROP TRIGGER IF EXISTS `trig_delete`;
DELIMITER //
CREATE TRIGGER `trig_delete` AFTER DELETE ON `sw_goods`
 FOR EACH ROW begin
                 insert into sw_goods_copy values(old.`goods_id`,old.`goods_name`,old.`goods_weight`,old.`goods_price`,old.`goods_number`,old.`goods_category_id`,old.`goods_brand_id`,old.`goods_introduce`,old.`goods_big_img`,old.`goods_small_img`,old.`goods_create_time`,old.`goods_last_time`);
            end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `sw_manager`
--

CREATE TABLE IF NOT EXISTS `sw_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(32) NOT NULL,
  `mg_pwd` varchar(32) NOT NULL,
  `mg_time` int(10) unsigned NOT NULL COMMENT '时间',
  `mg_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sw_manager`
--

INSERT INTO `sw_manager` (`mg_id`, `mg_name`, `mg_pwd`, `mg_time`, `mg_role_id`) VALUES
(1, 'aa', 'aa', 0, 0),
(2, 'bb', 'bb', 0, 1),
(3, 'cc', 'cc', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `sw_role`
--

CREATE TABLE IF NOT EXISTS `sw_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作方法 连接的字符串 Goods-add,Order-showlist',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `sw_role`
--

INSERT INTO `sw_role` (`role_id`, `role_name`, `role_auth_ids`, `role_auth_ac`) VALUES
(1, '主管', '1,4,2,6', 'Goods-showlist,Orders-showlist'),
(2, '经理', '1,2,4,5,6,7', 'Goods-showlist,Goods-add,Orders-showlist,Order-select');

-- --------------------------------------------------------

--
-- 表的结构 `sw_user`
--

CREATE TABLE IF NOT EXISTS `sw_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `user_email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `user_sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别',
  `user_qq` varchar(32) NOT NULL DEFAULT '' COMMENT 'qq',
  `user_tel` varchar(32) NOT NULL DEFAULT '' COMMENT '手机',
  `user_xueli` tinyint(4) NOT NULL DEFAULT '1' COMMENT '学历',
  `user_hobby` varchar(32) NOT NULL DEFAULT '' COMMENT '爱好',
  `user_introduce` text COMMENT '简介',
  `user_time` int(11) DEFAULT NULL,
  `last_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sw_user`
--

INSERT INTO `sw_user` (`user_id`, `username`, `password`, `user_email`, `user_sex`, `user_qq`, `user_tel`, `user_xueli`, `user_hobby`, `user_introduce`, `user_time`, `last_time`) VALUES
(1, 'aa', 'aa', 'aa@aa.com', 3, '1234987', '13245653478', 4, '', 'I am jack', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `hobby` varchar(50) DEFAULT NULL,
  `regdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
