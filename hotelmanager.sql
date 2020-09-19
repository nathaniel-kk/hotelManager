-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.28 - MySQL Community Server (GPL)
-- 服务器OS:                        Win64
-- HeidiSQL 版本:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for hotelmanager
CREATE DATABASE IF NOT EXISTS `hotelmanager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hotelmanager`;

-- Dumping structure for table hotelmanager.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工号',
  `work_id` varchar(50) NOT NULL COMMENT '工号',
  `password` text NOT NULL COMMENT '密码',
  `auth_code` int(11) NOT NULL DEFAULT '0' COMMENT '权限代码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.admin: ~0 rows (大约)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.check_record
CREATE TABLE IF NOT EXISTS `check_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录编号',
  `time_id` varchar(50) NOT NULL DEFAULT '' COMMENT '时间记录编号',
  `cust_id` varchar(50) NOT NULL DEFAULT '' COMMENT '顾客编号',
  `room_id` int(11) NOT NULL DEFAULT '0' COMMENT '房间编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.check_record: ~0 rows (大约)
/*!40000 ALTER TABLE `check_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_record` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.cust_info
CREATE TABLE IF NOT EXISTS `cust_info` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '顾客编号',
  `sex` varchar(50) NOT NULL DEFAULT '' COMMENT '性别',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `id_code` varchar(50) NOT NULL DEFAULT '' COMMENT '身份证号',
  `tel` varchar(50) NOT NULL DEFAULT '' COMMENT '电话',
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.cust_info: ~0 rows (大约)
/*!40000 ALTER TABLE `cust_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `cust_info` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.log
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL COMMENT 'log编号',
  `type` varchar(50) NOT NULL DEFAULT '0' COMMENT '0是新增等 1是删除等',
  `info` text NOT NULL COMMENT 'info',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.log: ~0 rows (大约)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录编号',
  `cust_id` varchar(50) NOT NULL DEFAULT '' COMMENT '顾客编号',
  `arrival_time` timestamp NOT NULL COMMENT '到店时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.reservation: ~0 rows (大约)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.room_class
CREATE TABLE IF NOT EXISTS `room_class` (
  `class_id` int(11) NOT NULL COMMENT '类别编号',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `price` int(11) NOT NULL COMMENT '价格'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.room_class: ~3 rows (大约)
/*!40000 ALTER TABLE `room_class` DISABLE KEYS */;
INSERT INTO `room_class` (`class_id`, `name`, `price`) VALUES
	(1, '大床房', 199),
	(2, '标准间', 299),
	(3, '主题房', 399);
/*!40000 ALTER TABLE `room_class` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.room_info
CREATE TABLE IF NOT EXISTS `room_info` (
  `room_id` int(11) NOT NULL COMMENT '房间编号',
  `class_id` int(11) NOT NULL COMMENT '类别编号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.room_info: ~45 rows (大约)
/*!40000 ALTER TABLE `room_info` DISABLE KEYS */;
INSERT INTO `room_info` (`room_id`, `class_id`) VALUES
	(101, 1),
	(102, 2),
	(103, 1),
	(104, 1),
	(105, 1),
	(106, 1),
	(107, 1),
	(108, 1),
	(109, 1),
	(201, 1),
	(202, 1),
	(203, 1),
	(204, 1),
	(205, 1),
	(206, 1),
	(207, 1),
	(208, 1),
	(209, 1),
	(301, 1),
	(302, 1),
	(303, 1),
	(304, 1),
	(305, 1),
	(306, 1),
	(307, 1),
	(308, 1),
	(309, 1),
	(401, 1),
	(402, 1),
	(403, 1),
	(404, 1),
	(405, 1),
	(406, 1),
	(407, 1),
	(408, 1),
	(409, 1),
	(501, 1),
	(502, 1),
	(503, 1),
	(504, 1),
	(505, 1),
	(506, 1),
	(507, 1),
	(508, 1),
	(509, 1);
/*!40000 ALTER TABLE `room_info` ENABLE KEYS */;

-- Dumping structure for table hotelmanager.time_record
CREATE TABLE IF NOT EXISTS `time_record` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '事件记录编号',
  `in_time` timestamp NOT NULL COMMENT '入住时间',
  `out_time` timestamp NOT NULL COMMENT '预期离店时间',
  `res_time` timestamp NULL DEFAULT NULL COMMENT '实际离店时间',
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table hotelmanager.time_record: ~0 rows (大约)
/*!40000 ALTER TABLE `time_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_record` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
