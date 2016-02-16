-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 12 月 02 日 20:11
-- 服务器版本: 5.5.27-log
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `myshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `it_address`
--

CREATE TABLE IF NOT EXISTS `it_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增的编号',
  `user_id` int(11) NOT NULL COMMENT '登陆用户的id',
  `consignee` varchar(32) NOT NULL COMMENT '收货人姓名',
  `address` varchar(64) NOT NULL COMMENT '收货人地址',
  `mobile` bigint(20) NOT NULL COMMENT '收货人电话',
  `post` mediumint(9) NOT NULL COMMENT '邮编',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `it_address`
--

INSERT INTO `it_address` (`id`, `user_id`, `consignee`, `address`, `mobile`, `post`) VALUES
(1, 1, '掌门人', '上海市闵行区三鲁公路', 15555555555, 210000);

-- --------------------------------------------------------

--
-- 表的结构 `it_admin`
--

CREATE TABLE IF NOT EXISTS `it_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员的编号',
  `admin_name` varchar(32) NOT NULL COMMENT '管理员的用户名',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  `salt` char(6) NOT NULL COMMENT '密码密匙',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `it_admin`
--

INSERT INTO `it_admin` (`admin_id`, `admin_name`, `password`, `salt`) VALUES
(1, 'admin', 'b41290779a8cc57d9da2bb65026ce9ac', 'erty12'),
(2, 'aa', '2646ebc3d2e4af5c24760996d0f961a4', 'dc40fb'),
(3, 'bb', '82a05afb9d4bf668b0d0cf5de7e573ba', '180e60'),
(4, 'cc', 'c11c9135ffde265c1f4f563f00cbb7fa', '178169'),
(5, 'dd', '2ba5aed1ff9794d429a5b3a31d4768b9', '1cb918'),
(6, 'king', 'f15dc14598c7cbabc24f87316dd519cb', '5cfc11');

-- --------------------------------------------------------

--
-- 表的结构 `it_admin_role`
--

CREATE TABLE IF NOT EXISTS `it_admin_role` (
  `admin_id` smallint(5) unsigned NOT NULL COMMENT '管理员的编号',
  `role_id` smallint(5) unsigned NOT NULL COMMENT '角色的编号',
  KEY `admin_id` (`admin_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `it_admin_role`
--

INSERT INTO `it_admin_role` (`admin_id`, `role_id`) VALUES
(4, 3),
(5, 4),
(6, 6),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- 表的结构 `it_attribute`
--

CREATE TABLE IF NOT EXISTS `it_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '��Ʒ���Ա��',
  `type_id` tinyint(3) unsigned NOT NULL COMMENT '��Ʒ�����',
  `attr_name` varchar(32) NOT NULL COMMENT '���Ե�����',
  `attr_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '���Ե����ͣ�0��ʾΨһ���ԣ�1��ʾ��ѡ����',
  `attr_input_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '���Ե�¼�뷽ʽ��0��ʾ�ֹ�¼�룬1��ʾ�б�ѡ��',
  `attr_value` varchar(64) NOT NULL DEFAULT '' COMMENT '��ѡֵ�б�',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `it_attribute`
--

INSERT INTO `it_attribute` (`attr_id`, `type_id`, `attr_name`, `attr_type`, `attr_input_type`, `attr_value`) VALUES
(1, 1, '屏幕尺寸', 0, 0, ''),
(2, 1, '选择版本', 0, 1, '移动版，联通版，电信版'),
(3, 1, '购买方式', 1, 1, '非合约机，合约机'),
(4, 1, '内存容量', 1, 0, ''),
(5, 1, '颜色', 1, 1, '红色，土豪金，白色'),
(6, 3, '显示器尺寸', 1, 0, ''),
(7, 3, '操作系统', 1, 1, 'win7，win8，win10'),
(8, 3, '显卡类型', 0, 1, '独立显卡，集成显卡'),
(9, 3, '硬盘容量', 1, 0, ''),
(10, 2, '作者', 0, 0, '4G，8G，16G');

-- --------------------------------------------------------

--
-- 表的结构 `it_cart`
--

CREATE TABLE IF NOT EXISTS `it_cart` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品的编号',
  `goods_attr_id` varchar(32) NOT NULL DEFAULT '' COMMENT '商品属性的编号，it_goods_attr中的id',
  `goods_count` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '购买的数量',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户的编号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `it_cart`
--

INSERT INTO `it_cart` (`goods_id`, `goods_attr_id`, `goods_count`, `user_id`) VALUES
(7, '38,40,42', 18, 1),
(9, '53,54,56', 7, 1);

-- --------------------------------------------------------

--
-- 表的结构 `it_category`
--

CREATE TABLE IF NOT EXISTS `it_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '��Ʒ��Ŀ���',
  `cat_name` varchar(32) NOT NULL COMMENT '��Ŀ������',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '��Ŀ�ĸ�����Ŀ���',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `it_category`
--

INSERT INTO `it_category` (`cat_id`, `cat_name`, `parent_id`) VALUES
(1, '手机类型', 0),
(2, '手机配件', 0),
(3, '充值卡', 0),
(5, '3G手机', 1),
(6, '4G手机', 1),
(7, '8G+手机', 1),
(8, '充电器', 2),
(9, '耳机', 2),
(10, '电池', 2),
(11, '联通充值卡', 3),
(12, '移动充值卡', 3),
(14, '在线充值卡', 11),
(15, '实体充值卡', 11),
(16, '云充值卡', 12),
(17, '雨充值卡', 12);

-- --------------------------------------------------------

--
-- 表的结构 `it_goods`
--

CREATE TABLE IF NOT EXISTS `it_goods` (
  `goods_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '��Ʒid���',
  `goods_name` varchar(32) NOT NULL DEFAULT '' COMMENT '��Ʒ������',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '��Ŀ���',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒ�������ͱ��',
  `goods_sn` varchar(32) NOT NULL DEFAULT '' COMMENT '��Ʒ�Ļ���',
  `shop_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '����۸�',
  `market_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '�г��۸�',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ���Ʒ��0����1��',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ�������0����1��',
  `is_best` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ�Ʒ��0����1��',
  `is_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '�Ƿ����ۣ�0����1��',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ�ɾ����0����1��',
  `goods_ori` varchar(128) NOT NULL DEFAULT '' COMMENT '�ϴ���ԭͼ·��',
  `goods_img` varchar(128) NOT NULL DEFAULT '' COMMENT '��ͼ·��',
  `goods_thumb` varchar(128) NOT NULL DEFAULT '' COMMENT 'Сͼ·��',
  `goods_desc` text NOT NULL COMMENT '��Ʒ����',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '��Ʒ�Ŀ��',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`goods_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `it_goods`
--

INSERT INTO `it_goods` (`goods_id`, `goods_name`, `cat_id`, `type_id`, `goods_sn`, `shop_price`, `market_price`, `is_new`, `is_hot`, `is_best`, `is_sale`, `is_delete`, `goods_ori`, `goods_img`, `goods_thumb`, `goods_desc`, `goods_number`, `add_time`) VALUES
(1, 'SKT_T1', 7, 1, '1', '1.00', '1.00', 1, 1, 1, 1, 0, 'Goods/2015-11-23/5652f358c0a41.jpg', 'Goods/2015-11-23/1_thumb_5652f358c0a41.jpg', 'Goods/2015-11-23/0_thumb_5652f358c0a41.jpg', '<p>1</p>', 40, 1448515777),
(3, 'Origen', 5, 1, '3', '1200.00', '3.00', 1, 0, 0, 1, 0, 'Goods/2015-11-23/5652f4331d6e0.jpg', 'Goods/2015-11-23/1_thumb_5652f4331d6e0.jpg', 'Goods/2015-11-23/0_thumb_5652f4331d6e0.jpg', '<p>3</p>', 3, 1448515777),
(5, '德邦手机', 6, 1, '111', '1200.00', '1200.00', 1, 0, 1, 1, 0, 'Goods/2015-11-26/565698c151864.jpg', 'Goods/2015-11-26/1_thumb_565698c151864.jpg', 'Goods/2015-11-26/0_thumb_565698c151864.jpg', '<p>nice</p>', 20, 1448515777),
(6, '诺克萨斯', 6, 1, '12', '1344.00', '2333.00', 1, 1, 0, 1, 0, 'Goods/2015-11-26/56569907c38ba.jpg', 'Goods/2015-11-26/1_thumb_56569907c38ba.jpg', 'Goods/2015-11-26/0_thumb_56569907c38ba.jpg', '<p>不错</p>', 12, 1448515847),
(7, 'AHQ', 7, 1, '5656cf5fb1e5f', '1123.00', '233.00', 1, 1, 0, 1, 0, 'Goods/2015-11-26/5656cf5f6d88f.jpg', 'Goods/2015-11-26/1_thumb_5656cf5f6d88f.jpg', 'Goods/2015-11-26/0_thumb_5656cf5f6d88f.jpg', '<p>可以的</p>', 81, 1448529759),
(9, '约德尔城', 5, 1, '565821c53a75e', '1111.00', '1111.00', 1, 0, 1, 1, 0, 'Goods/2015-11-27/565821c515d66.jpg', 'Goods/2015-11-27/1_thumb_565821c515d66.jpg', 'Goods/2015-11-27/0_thumb_565821c515d66.jpg', '<p>可以的 小矮子们</p>', 20, 1448616389);

-- --------------------------------------------------------

--
-- 表的结构 `it_goods_attr`
--

CREATE TABLE IF NOT EXISTS `it_goods_attr` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增的编号',
  `goods_id` smallint(5) unsigned NOT NULL COMMENT '商品的编号',
  `attr_id` smallint(5) unsigned NOT NULL COMMENT '商品属性的编号',
  `attr_value` varchar(64) NOT NULL COMMENT '属性值内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- 转存表中的数据 `it_goods_attr`
--

INSERT INTO `it_goods_attr` (`id`, `goods_id`, `attr_id`, `attr_value`) VALUES
(1, 1, 1, '1'),
(2, 1, 2, '电信版'),
(3, 1, 3, '非合约机'),
(4, 1, 4, '1'),
(5, 1, 4, '2'),
(6, 1, 5, '土豪金'),
(7, 1, 5, '红色'),
(15, 3, 1, '3'),
(16, 3, 2, '联通版'),
(17, 3, 3, '非合约机'),
(18, 3, 4, '3'),
(19, 3, 4, '33'),
(20, 3, 5, '红色'),
(21, 3, 5, '土豪金'),
(22, 3, 5, '白色'),
(23, 5, 1, '5.5'),
(24, 5, 2, '联通版'),
(25, 5, 3, '非合约机'),
(26, 5, 4, '32G'),
(27, 5, 4, '16G'),
(28, 5, 5, '红色'),
(29, 5, 5, '土豪金'),
(30, 6, 1, '5'),
(31, 6, 2, '电信版'),
(32, 6, 3, '非合约机'),
(33, 6, 4, '32G'),
(34, 6, 5, '红色'),
(35, 6, 5, '白色'),
(36, 7, 1, '6.0'),
(37, 7, 2, '移动版'),
(38, 7, 3, '非合约机'),
(39, 7, 3, '合约机'),
(40, 7, 4, '32G'),
(41, 7, 4, '64G'),
(42, 7, 5, '红色'),
(43, 7, 5, '白色'),
(51, 9, 1, '6.0'),
(52, 9, 2, '移动版'),
(53, 9, 3, '合约机'),
(54, 9, 4, '32G'),
(55, 9, 4, '64G'),
(56, 9, 5, '红色'),
(57, 9, 5, '土豪金'),
(70, 9, 3, '非合约机'),
(71, 6, 3, '合约机'),
(72, 6, 4, '64G'),
(73, 5, 3, '合约机'),
(74, 1, 3, '合约机'),
(75, 3, 3, '合约机');

-- --------------------------------------------------------

--
-- 表的结构 `it_goods_photo`
--

CREATE TABLE IF NOT EXISTS `it_goods_photo` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增的编号',
  `goods_id` smallint(5) unsigned NOT NULL COMMENT '商品的编号',
  `photo_ori` varchar(128) NOT NULL DEFAULT '' COMMENT '相册原图路径',
  `photo_thumb` varchar(128) NOT NULL DEFAULT '' COMMENT '相册缩略图路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `it_goods_photo`
--

INSERT INTO `it_goods_photo` (`id`, `goods_id`, `photo_ori`, `photo_thumb`) VALUES
(1, 1, 'Photo/2015-11-23/5652f35a05a57.jpg', 'Photo/2015-11-23/0_thumb_5652f35a05a57.jpg'),
(2, 1, 'Photo/2015-11-23/5652f35a08938.jpg', 'Photo/2015-11-23/0_thumb_5652f35a08938.jpg'),
(5, 3, 'Photo/2015-11-23/5652f433dcd8d.jpg', 'Photo/2015-11-23/0_thumb_5652f433dcd8d.jpg'),
(6, 3, 'Photo/2015-11-23/5652f433e0ff6.jpg', 'Photo/2015-11-23/0_thumb_5652f433e0ff6.jpg'),
(7, 5, 'Photo/2015-11-26/565698c220f3a.jpg', 'Photo/2015-11-26/0_thumb_565698c220f3a.jpg'),
(8, 5, 'Photo/2015-11-26/565698c2245ea.jpg', 'Photo/2015-11-26/0_thumb_565698c2245ea.jpg'),
(9, 6, 'Photo/2015-11-26/56569908518a1.jpg', 'Photo/2015-11-26/0_thumb_56569908518a1.jpg'),
(10, 6, 'Photo/2015-11-26/56569908537e1.jpg', 'Photo/2015-11-26/0_thumb_56569908537e1.jpg'),
(11, 7, 'Photo/2015-11-26/5656cf6088a67.jpg', 'Photo/2015-11-26/0_thumb_5656cf6088a67.jpg'),
(12, 7, 'Photo/2015-11-26/5656cf608a1d7.jpg', 'Photo/2015-11-26/0_thumb_5656cf608a1d7.jpg'),
(15, 9, 'Photo/2015-11-27/565821c5cee81.jpg', 'Photo/2015-11-27/0_thumb_565821c5cee81.jpg'),
(16, 9, 'Photo/2015-11-27/565821c5d11a9.jpg', 'Photo/2015-11-27/0_thumb_565821c5d11a9.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `it_order_goods`
--

CREATE TABLE IF NOT EXISTS `it_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增的编号',
  `order_id` int(10) unsigned NOT NULL COMMENT '订单id',
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品的id',
  `goods_name` varchar(32) NOT NULL COMMENT '商品的名称',
  `goods_attr_id` varchar(32) NOT NULL COMMENT '商品的属性',
  `shop_price` decimal(9,2) NOT NULL COMMENT '商品的本店价格',
  `goods_count` smallint(5) unsigned NOT NULL COMMENT '购买数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `it_order_goods`
--

INSERT INTO `it_order_goods` (`id`, `order_id`, `goods_id`, `goods_name`, `goods_attr_id`, `shop_price`, `goods_count`) VALUES
(1, 1, 7, 'AHQ', '38,40,42', '1123.00', 9),
(2, 1, 8, 'Fnatic', '46,48,50', '123.00', 8),
(3, 1, 11, '艾欧尼亚', '66,67,69', '3333.00', 4),
(4, 1, 1, 'SKT_T1', '3,5,7', '1.00', 1),
(5, 2, 3, 'Origen', '17,18,20', '1200.00', 1),
(6, 3, 7, 'AHQ', '39,41,43', '1123.00', 1),
(7, 4, 9, '约德尔城', '70,55,57', '1111.00', 5),
(8, 5, 1, 'SKT_T1', '74,5,7', '1.00', 10),
(9, 6, 9, '约德尔城', '53,54,56', '1111.00', 15),
(10, 6, 7, 'AHQ', '38,41,43', '1123.00', 18);

-- --------------------------------------------------------

--
-- 表的结构 `it_order_info`
--

CREATE TABLE IF NOT EXISTS `it_order_info` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单表自增的编号',
  `order_sn` varchar(32) NOT NULL COMMENT '订单号',
  `goods_amount` decimal(9,2) NOT NULL COMMENT '订单的总金额',
  `pay_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付状态，0表示未支付1表示已支付',
  `user_id` int(11) NOT NULL COMMENT '登陆用户的id',
  `consignee` varchar(32) NOT NULL COMMENT '收货人',
  `address` varchar(64) NOT NULL COMMENT '收货人地址',
  `mobile` bigint(20) unsigned NOT NULL COMMENT '收货人的手机',
  `payment` tinyint(4) NOT NULL COMMENT '支付方式',
  `shipping` tinyint(4) NOT NULL COMMENT '配送方式',
  `addtime` int(11) NOT NULL COMMENT '下单时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `it_order_info`
--

INSERT INTO `it_order_info` (`order_id`, `order_sn`, `goods_amount`, `pay_status`, `user_id`, `consignee`, `address`, `mobile`, `payment`, `shipping`, `addtime`) VALUES
(3, 'sn_565dbef71a1b7', '1123.00', 0, 1, '掌门人', '上海市闵行区三鲁公路', 15555555555, 1, 6, 1448984311),
(4, 'sn_565dc1d486bce', '5555.00', 0, 1, '掌门人', '上海市闵行区三鲁公路', 15555555555, 1, 5, 1448985044),
(5, 'sn_565dc9db9d936', '10.00', 0, 1, '掌门人', '上海市闵行区三鲁公路', 15555555555, 0, 0, 1448987099),
(6, 'sn_565dda5d261d4', '36879.00', 0, 1, '掌门人', '上海市闵行区三鲁公路', 15555555555, 3, 3, 1448991325);

-- --------------------------------------------------------

--
-- 表的结构 `it_privilege`
--

CREATE TABLE IF NOT EXISTS `it_privilege` (
  `priv_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限的编号',
  `priv_name` varchar(32) NOT NULL DEFAULT '' COMMENT '权限的名称',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限的父级编号',
  `module_name` varchar(32) NOT NULL DEFAULT '' COMMENT '权限对应的模块名',
  `controller_name` varchar(32) NOT NULL DEFAULT '' COMMENT '权限对应的控制器名',
  `action_name` varchar(32) NOT NULL DEFAULT '' COMMENT '权限对应的方法名',
  PRIMARY KEY (`priv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `it_privilege`
--

INSERT INTO `it_privilege` (`priv_id`, `priv_name`, `parent_id`, `module_name`, `controller_name`, `action_name`) VALUES
(1, '商品管理', 0, '', '', ''),
(2, '订单管理', 0, '', '', ''),
(3, '角色管理', 0, '', '', ''),
(5, '商品列表', 1, 'Admin', 'Goods', 'showlist'),
(6, '添加商品', 1, 'Admin', 'Goods', 'add'),
(7, '栏目列表', 1, 'Admin', 'Category', 'showlist'),
(8, '添加栏目', 7, 'Admin', 'Category', 'add'),
(9, '订单列表', 2, 'Admin', 'Order', 'showlist'),
(10, '显示属性', 6, 'Admin', 'Goods', 'showAttr'),
(11, '删除商品', 5, 'Admin', 'Goods', 'del'),
(12, '修改商品', 5, 'Admin', 'Goods', 'update'),
(13, '删除栏目', 7, 'Admin', 'Category', 'del'),
(14, '修改栏目', 7, 'Admin', 'Category', 'update'),
(15, '添加角色', 3, 'Admin', 'Role', 'add'),
(16, '角色列表', 3, 'Admin', 'Role', 'showlist'),
(18, '会员管理', 0, '', '', ''),
(19, '会员列表', 18, 'Home', 'User', 'showlist'),
(20, '会员注册', 18, 'Home', 'User', 'register'),
(21, '删除角色', 16, 'Admin', 'Role', 'del'),
(22, '修改角色', 16, 'Admin', 'Role', 'update'),
(23, '管理员管理', 0, '', '', ''),
(24, '管理员列表', 23, 'Admin', 'Admin', 'showlist'),
(25, '添加管理员', 23, 'Admin', 'Admin', 'add'),
(26, '删除管理员', 24, 'Admin', 'Admin', 'del'),
(27, '修改管理员', 24, 'Admin', 'Admin', 'update'),
(28, '商品类型', 1, 'Admin', 'Type', 'showlist'),
(29, '添加类型', 28, 'Admin', 'Type', 'add'),
(30, '删除类型', 28, 'Admin', 'Type', 'del'),
(31, '修改类型', 28, 'Admin', 'Type', 'update'),
(32, '权限管理', 0, '', '', ''),
(33, '权限列表', 32, 'Admin', 'Privilege', 'showlist'),
(34, '添加权限', 32, 'Admin', 'Privilege', 'add');

-- --------------------------------------------------------

--
-- 表的结构 `it_product`
--

CREATE TABLE IF NOT EXISTS `it_product` (
  `goods_id` int(10) unsigned NOT NULL COMMENT '商品的id',
  `goods_attr_id` varchar(32) NOT NULL COMMENT '商品的属性,it_goods_attr表中的id属性多个逗号隔开',
  `goods_number` int(11) NOT NULL DEFAULT '0' COMMENT '商品的库存'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `it_product`
--

INSERT INTO `it_product` (`goods_id`, `goods_attr_id`, `goods_number`) VALUES
(7, '39,41,43', 29),
(7, '38,40,42', 20),
(7, '39,40,42', 10),
(7, '38,41,43', 22),
(1, '74,5,7', 40),
(9, '70,55,57', 5),
(9, '53,54,56', 5),
(9, '53,55,57', 10),
(6, '32,33,34', 12);

-- --------------------------------------------------------

--
-- 表的结构 `it_role`
--

CREATE TABLE IF NOT EXISTS `it_role` (
  `role_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色的编号',
  `role_name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色的名称',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `it_role`
--

INSERT INTO `it_role` (`role_id`, `role_name`) VALUES
(1, '初级员工'),
(2, '资深员工'),
(3, '项目经理'),
(4, '部门经理'),
(6, 'CEO');

-- --------------------------------------------------------

--
-- 表的结构 `it_role_privilege`
--

CREATE TABLE IF NOT EXISTS `it_role_privilege` (
  `role_id` smallint(5) unsigned DEFAULT NULL COMMENT '角色的编号',
  `priv_id` smallint(5) unsigned DEFAULT NULL COMMENT '权限的编号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `it_role_privilege`
--

INSERT INTO `it_role_privilege` (`role_id`, `priv_id`) VALUES
(2, 1),
(2, 5),
(2, 12),
(2, 6),
(2, 10),
(2, 7),
(2, 8),
(2, 14),
(2, 2),
(2, 9),
(2, 18),
(2, 19),
(2, 20),
(4, 1),
(4, 5),
(4, 11),
(4, 12),
(4, 6),
(4, 10),
(4, 7),
(4, 8),
(4, 13),
(4, 14),
(4, 2),
(4, 9),
(4, 3),
(4, 15),
(4, 16),
(4, 18),
(4, 19),
(4, 20),
(0, 1),
(0, 5),
(0, 11),
(0, 12),
(0, 6),
(0, 10),
(0, 7),
(0, 8),
(0, 13),
(0, 14),
(0, 2),
(0, 9),
(0, 3),
(0, 15),
(0, 16),
(0, 21),
(0, 22),
(0, 18),
(0, 19),
(0, 20),
(1, 1),
(1, 5),
(1, 6),
(1, 10),
(1, 7),
(1, 8),
(1, 28),
(1, 29),
(1, 18),
(1, 19),
(1, 20),
(6, 1),
(6, 5),
(6, 11),
(6, 12),
(6, 6),
(6, 10),
(6, 7),
(6, 8),
(6, 13),
(6, 14),
(6, 28),
(6, 29),
(6, 30),
(6, 31),
(6, 2),
(6, 9),
(6, 3),
(6, 15),
(6, 16),
(6, 21),
(6, 22),
(6, 18),
(6, 19),
(6, 20),
(6, 23),
(6, 24),
(6, 26),
(6, 27),
(6, 25),
(6, 32),
(6, 33),
(6, 34),
(3, 1),
(3, 5),
(3, 11),
(3, 12),
(3, 6),
(3, 10),
(3, 7),
(3, 8),
(3, 13),
(3, 14),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 2),
(3, 9),
(3, 3),
(3, 16),
(3, 18),
(3, 19),
(3, 20);

-- --------------------------------------------------------

--
-- 表的结构 `it_type`
--

CREATE TABLE IF NOT EXISTS `it_type` (
  `type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '��Ʒ�����',
  `type_name` varchar(32) NOT NULL COMMENT '��Ʒ�������',
  PRIMARY KEY (`type_id`),
  KEY `type_name` (`type_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `it_type`
--

INSERT INTO `it_type` (`type_id`, `type_name`) VALUES
(7, '可以'),
(2, '图书'),
(1, '手机'),
(8, '掌门人'),
(3, '笔记本电脑'),
(5, '衬衫'),
(6, '连衣裙');

-- --------------------------------------------------------

--
-- 表的结构 `it_user`
--

CREATE TABLE IF NOT EXISTS `it_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户的编号',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `email` varchar(32) NOT NULL COMMENT '用户邮箱',
  `validate` varchar(32) NOT NULL DEFAULT '' COMMENT '密码的密匙',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户的状态，0表示未激活，1表示激活',
  `question` varchar(32) NOT NULL COMMENT '设置问题，用于找回密码',
  `answer` varchar(32) NOT NULL COMMENT '问题答案，用于找回密码',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `it_user`
--

INSERT INTO `it_user` (`user_id`, `username`, `password`, `email`, `validate`, `active`, `question`, `answer`) VALUES
(1, 'aa', '123456', '763502022@qq.com', '565718c04b3e3', 1, '1111', '2222'),
(2, 'bb', '123456', '2916177759@qq.com', '5657219a2ba6c', 1, '1111', '2222');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
