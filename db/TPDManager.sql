-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.41 - Source distribution
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-12-15 14:17:51
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for tpdmanager
DROP DATABASE IF EXISTS `tpdmanager`;
CREATE DATABASE IF NOT EXISTS `tpdmanager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tpdmanager`;


-- Dumping structure for table tpdmanager.tpd_manager_access
DROP TABLE IF EXISTS `tpd_manager_access`;
CREATE TABLE IF NOT EXISTS `tpd_manager_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_access: 10 rows
/*!40000 ALTER TABLE `tpd_manager_access` DISABLE KEYS */;
INSERT INTO `tpd_manager_access` (`role_id`, `node_id`, `level`, `pid`, `module`) VALUES
	(7, 84, 3, 7, NULL),
	(7, 129, 3, 125, NULL),
	(7, 127, 2, 1, NULL),
	(7, 125, 2, 1, NULL),
	(7, 128, 2, 1, NULL),
	(7, 30, 2, 1, NULL),
	(7, 40, 2, 1, NULL),
	(7, 1, 1, 0, NULL),
	(7, 36, 3, 30, NULL),
	(7, 37, 3, 30, NULL);
/*!40000 ALTER TABLE `tpd_manager_access` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_group
DROP TABLE IF EXISTS `tpd_manager_group`;
CREATE TABLE IF NOT EXISTS `tpd_manager_group` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `title` varchar(50) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_group: 1 rows
/*!40000 ALTER TABLE `tpd_manager_group` DISABLE KEYS */;
INSERT INTO `tpd_manager_group` (`id`, `name`, `title`, `create_time`, `update_time`, `status`, `sort`, `show`) VALUES
	(2, 'App', '系统设置', 1222841259, 0, 1, 0, 0);
/*!40000 ALTER TABLE `tpd_manager_group` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_groups
DROP TABLE IF EXISTS `tpd_manager_groups`;
CREATE TABLE IF NOT EXISTS `tpd_manager_groups` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_groups: 3 rows
/*!40000 ALTER TABLE `tpd_manager_groups` DISABLE KEYS */;
INSERT INTO `tpd_manager_groups` (`id`, `name`) VALUES
	(1, '项目组1'),
	(2, '项目组2'),
	(3, '项目组3');
/*!40000 ALTER TABLE `tpd_manager_groups` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_menus
DROP TABLE IF EXISTS `tpd_manager_menus`;
CREATE TABLE IF NOT EXISTS `tpd_manager_menus` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pid` int(4) DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT 'navTab',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='后台管理菜单';

-- Dumping data for table tpdmanager.tpd_manager_menus: ~5 rows (approximately)
/*!40000 ALTER TABLE `tpd_manager_menus` DISABLE KEYS */;
INSERT INTO `tpd_manager_menus` (`id`, `pid`, `title`, `controller`, `action`, `target`) VALUES
	(3, 0, '系统设置', NULL, NULL, 'navTab'),
	(7, 3, '后台菜单管理', 'manager_menus', 'index', 'navTab'),
	(8, 3, '节点管理', 'manager_node', 'index', 'navTab'),
	(9, 3, '角色管理', 'manager_role', 'index', 'navTab'),
	(10, 3, '后台用户', 'manager_user', 'index', 'navTab');
/*!40000 ALTER TABLE `tpd_manager_menus` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_node
DROP TABLE IF EXISTS `tpd_manager_node`;
CREATE TABLE IF NOT EXISTS `tpd_manager_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `title` varchar(50) DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned DEFAULT '0',
  `ismenu` tinyint(1) DEFAULT '1' COMMENT '是否作为菜单',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_node: 21 rows
/*!40000 ALTER TABLE `tpd_manager_node` DISABLE KEYS */;
INSERT INTO `tpd_manager_node` (`id`, `name`, `title`, `pid`, `status`, `remark`, `sort`, `level`, `type`, `group_id`, `ismenu`) VALUES
	(49, 'read', '查看', 30, 1, '', NULL, 3, 0, 0, 1),
	(40, 'Index', '默认模块', 1, 1, '', 1, 2, 0, 0, 1),
	(39, 'index', '列表', 30, 1, '', NULL, 3, 0, 0, 1),
	(37, 'resume', '恢复', 30, 1, '', NULL, 3, 0, 0, 1),
	(36, 'forbid', '禁用', 30, 1, '', NULL, 3, 0, 0, 1),
	(35, 'foreverdelete', '删除', 30, 1, '', NULL, 3, 0, 0, 1),
	(34, 'update', '更新', 30, 1, '', NULL, 3, 0, 0, 1),
	(33, 'edit', '编辑', 30, 1, '', NULL, 3, 0, 0, 1),
	(32, 'insert', '写入', 30, 1, '', NULL, 3, 0, 0, 1),
	(31, 'add', '新增', 30, 1, '', NULL, 3, 0, 0, 1),
	(30, 'Public', '公共模块', 1, 1, '', 2, 2, 0, 0, 1),
	(7, 'manager_user', '后台用户', 1, 1, '', 4, 2, 0, 2, 1),
	(6, 'manager_role', '角色管理', 1, 1, '', 3, 2, 0, 2, 1),
	(2, 'manager_node', '节点管理', 1, 1, '', 2, 2, 0, 0, 1),
	(1, 'Admin', '后台管理', 0, 1, NULL, NULL, 1, 0, 0, 1),
	(50, 'main', '空白首页', 40, 1, '', NULL, 3, 0, 0, 1),
	(84, 'insert', '添加用户', 7, 1, '', NULL, 3, 0, 0, 1),
	(128, 'user', '用户管理', 1, 1, '', NULL, 2, 0, 0, 1),
	(125, 'user_group', '用户组管理', 1, 1, '', NULL, 2, 0, 0, 1),
	(127, 'manager_menus', '后台菜单管理', 1, 1, '', NULL, 2, 0, 0, 1),
	(129, 'add', '添加用户组', 125, 1, '', NULL, 3, 0, 0, 1);
/*!40000 ALTER TABLE `tpd_manager_node` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_role
DROP TABLE IF EXISTS `tpd_manager_role`;
CREATE TABLE IF NOT EXISTS `tpd_manager_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ename` varchar(5) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_role: 1 rows
/*!40000 ALTER TABLE `tpd_manager_role` DISABLE KEYS */;
INSERT INTO `tpd_manager_role` (`id`, `name`, `pid`, `status`, `remark`, `ename`, `create_time`, `update_time`) VALUES
	(7, '客服人员', 0, 1, '', NULL, 1254325787, 1345098887);
/*!40000 ALTER TABLE `tpd_manager_role` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_role_user
DROP TABLE IF EXISTS `tpd_manager_role_user`;
CREATE TABLE IF NOT EXISTS `tpd_manager_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_role_user: 1 rows
/*!40000 ALTER TABLE `tpd_manager_role_user` DISABLE KEYS */;
INSERT INTO `tpd_manager_role_user` (`role_id`, `user_id`) VALUES
	(7, '37');
/*!40000 ALTER TABLE `tpd_manager_role_user` ENABLE KEYS */;


-- Dumping structure for table tpdmanager.tpd_manager_user
DROP TABLE IF EXISTS `tpd_manager_user`;
CREATE TABLE IF NOT EXISTS `tpd_manager_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table tpdmanager.tpd_manager_user: 2 rows
/*!40000 ALTER TABLE `tpd_manager_user` DISABLE KEYS */;
INSERT INTO `tpd_manager_user` (`id`, `account`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `info`) VALUES
	(1, 'admin', '管理员', '21232f297a57a5a743894a0e4a801fc3', '', 1355551595, '127.0.0.1', 962, '8888', 'liu21st@gmail.com', '备注信息', 1222907803, 1351150730, 1, 0, ''),
	(37, 'seiven', '', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '', 1351145094, '127.0.0.1', 9, NULL, 'aaaaaa@as.ocm', '', 1345099019, 0, 1, 0, '');
/*!40000 ALTER TABLE `tpd_manager_user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
