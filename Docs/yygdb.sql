/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 10.0.17-MariaDB : Database - hdm191601457_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hdm191601457_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `hdm191601457_db`;

/*Table structure for table `yyg_admin` */

DROP TABLE IF EXISTS `yyg_admin`;

CREATE TABLE `yyg_admin` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `password` char(32) COLLATE utf8_bin DEFAULT NULL COMMENT '密码',
  `email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `role` tinyint(2) DEFAULT '0' COMMENT '角色:0:普通管理员，1，超级管理员',
  `time` datetime DEFAULT NULL COMMENT '创建修改时间',
  `login_time` datetime DEFAULT NULL COMMENT '最后一次登陆时间',
  `login_ip` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '最后一次登陆ip',
  `login` int(11) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='管理员';

/*Data for the table `yyg_admin` */

insert  into `yyg_admin`(`uid`,`username`,`password`,`email`,`role`,`time`,`login_time`,`login_ip`,`login`) values (1,'admin','7fef6171469e80d32c0559f88b377245','www.wpj@163.com',1,NULL,'2015-11-12 10:27:45','0.0.0.0',23),(2,'wanpinjia','c4ca4238a0b923820dcc509a6f75849b','www.wpj@163.com',1,'2015-11-10 23:42:23','2015-11-11 01:35:12','0.0.0.0',4),(4,'2','2','',0,'2015-11-11 00:30:10',NULL,NULL,0),(5,'3','3','',0,'2015-11-11 00:30:14',NULL,NULL,0),(6,'4','4','',0,'2015-11-11 00:30:18',NULL,NULL,0),(7,'5','5','',0,'2015-11-11 00:30:21',NULL,NULL,0),(8,'6','6','',0,'2015-11-11 00:30:24',NULL,NULL,0),(9,'7','7','',0,'2015-11-11 00:30:28',NULL,NULL,0),(10,'8','8','',0,'2015-11-11 00:30:32',NULL,NULL,0),(11,'9','9','',0,'2015-11-11 00:30:36',NULL,NULL,0),(12,'10','10','',0,'2015-11-11 00:30:43',NULL,NULL,0),(13,'11','11','',0,'2015-11-11 00:30:48',NULL,NULL,0),(14,'12','12','',0,'2015-11-11 00:30:52',NULL,NULL,0),(15,'12','13','',0,'2015-11-11 00:30:57',NULL,NULL,0),(16,'123','1','',0,'2015-11-11 00:31:03',NULL,NULL,0),(17,'1','1','',0,'2015-11-11 00:31:08',NULL,NULL,0),(18,'1','1','',0,'2015-11-11 00:31:12',NULL,NULL,0),(19,'1','1','',0,'2015-11-11 00:31:16',NULL,NULL,0),(20,'2','2','',0,'2015-11-11 00:31:24',NULL,NULL,0),(21,'3','3','',0,'2015-11-11 00:31:28',NULL,NULL,0),(22,'4','4','',0,'2015-11-11 00:31:32',NULL,NULL,0),(23,'5','5','',0,'2015-11-11 00:31:36',NULL,NULL,0);

/*Table structure for table `yyg_brand` */

DROP TABLE IF EXISTS `yyg_brand`;

CREATE TABLE `yyg_brand` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌id',
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '缩略图',
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '链接地址',
  `sort` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '排序字段',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='品牌管理';

/*Data for the table `yyg_brand` */

insert  into `yyg_brand`(`bid`,`name`,`thumb`,`url`,`sort`) values (12,'苹果','',NULL,NULL),(13,'华为','',NULL,NULL),(14,'三星','',NULL,NULL),(15,'周大福','',NULL,NULL),(16,'周生生','',NULL,NULL),(17,'卡西欧','',NULL,NULL),(18,'美的','',NULL,NULL);

/*Table structure for table `yyg_category` */

DROP TABLE IF EXISTS `yyg_category`;

CREATE TABLE `yyg_category` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `parentid` smallint(6) unsigned DEFAULT NULL COMMENT '父id',
  `model` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '缩略图',
  `key` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `info` text COLLATE utf8_bin COMMENT '描述',
  `sort` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='栏目分类';

/*Data for the table `yyg_category` */

insert  into `yyg_category`(`cid`,`parentid`,`model`,`name`,`thumb`,`key`,`info`,`sort`) values (4,NULL,NULL,'手机数码','/Uploads/categories/20151112/5644a28a6c4e8.png','shouji',NULL,NULL),(5,NULL,NULL,'电脑办公','/Uploads/categories/20151112/5644a29f3b832.png','computer',NULL,NULL),(6,NULL,NULL,'家电用器','/Uploads/categories/20151112/5644a2ae34eb2.png','jiadian',NULL,NULL),(7,NULL,NULL,'钟表首饰','/Uploads/categories/20151112/5644a2c2139ab.png','shoushi',NULL,NULL),(8,NULL,NULL,'化妆个护','/Uploads/categories/20151112/5644a2cdf0d80.png','huazhuang',NULL,NULL),(9,NULL,NULL,'食品','/Uploads/categories/20151112/5644a2dac2221.png','qita',NULL,NULL),(10,NULL,NULL,'图书','/Uploads/categories/20151112/5644a30d20933.png',NULL,NULL,NULL),(11,NULL,NULL,'家具用品','/Uploads/categories/20151112/5644a4a1d9e03.png',NULL,NULL,NULL);

/*Table structure for table `yyg_category_has_brand` */

DROP TABLE IF EXISTS `yyg_category_has_brand`;

CREATE TABLE `yyg_category_has_brand` (
  `cid` smallint(6) unsigned NOT NULL,
  `bid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cid`,`bid`),
  KEY `fk_yyg_category_has_yyg_brand1_yyg_brand_idx` (`bid`),
  KEY `fk_yyg_category_has_yyg_brand1_yyg_category_idx` (`cid`),
  CONSTRAINT `fk_yyg_category_has_yyg_brand_yyg_brand` FOREIGN KEY (`bid`) REFERENCES `yyg_brand` (`bid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_yyg_category_has_yyg_brand_yyg_category` FOREIGN KEY (`cid`) REFERENCES `yyg_category` (`cid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `yyg_category_has_brand` */

insert  into `yyg_category_has_brand`(`cid`,`bid`) values (4,12),(4,13),(4,14),(5,12),(6,18),(7,15),(7,16),(7,17);

/*Table structure for table `yyg_goods` */

DROP TABLE IF EXISTS `yyg_goods`;

CREATE TABLE `yyg_goods` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '秒杀ID',
  `cid` int(11) unsigned DEFAULT NULL COMMENT '商品分类',
  `bid` int(10) unsigned DEFAULT NULL COMMENT '品牌',
  `title` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '标题',
  `subtitle` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '副标题',
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '描述',
  `qishu` int(10) unsigned DEFAULT '1' COMMENT '期数',
  `maxqishu` int(11) DEFAULT NULL COMMENT '最大期数',
  `money` decimal(8,0) DEFAULT NULL COMMENT '总价',
  `danjia` int(11) DEFAULT NULL COMMENT '单价',
  `qipaijia` int(11) DEFAULT NULL COMMENT '起拍价',
  `jiafujia` int(11) DEFAULT NULL COMMENT '加幅价',
  `baozhenjin` int(11) DEFAULT NULL COMMENT '保证金',
  `xiangoujia` int(11) DEFAULT NULL COMMENT '限购价',
  `xiangouzishu` int(11) DEFAULT NULL COMMENT '个人限购次数',
  `xiangouzongliang` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '限购总量',
  `thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '缩略图',
  `content` text COLLATE utf8_bin COMMENT '详情url',
  `zongrenshu` int(11) DEFAULT '0' COMMENT '总人数',
  `canyurenshu` int(11) DEFAULT '0' COMMENT '总需份数',
  `shengyurenshu` int(11) DEFAULT '0' COMMENT '剩余数',
  `type` tinyint(1) DEFAULT '1' COMMENT '1:一元购 2：限购专区，3:拍卖专区',
  `renqi` tinyint(4) DEFAULT '0' COMMENT '人气商品(0:否,1是)',
  `tuijian` tinyint(4) DEFAULT '0' COMMENT '推荐商品(0:否,1是)',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `time` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商品列表';

/*Data for the table `yyg_goods` */

insert  into `yyg_goods`(`gid`,`cid`,`bid`,`title`,`subtitle`,`description`,`qishu`,`maxqishu`,`money`,`danjia`,`qipaijia`,`jiafujia`,`baozhenjin`,`xiangoujia`,`xiangouzishu`,`xiangouzongliang`,`thumb`,`content`,`zongrenshu`,`canyurenshu`,`shengyurenshu`,`type`,`renqi`,`tuijian`,`sort`,`time`) values (12,4,0,'iPhone 6s Plus','仅需一元可获得，全新未拆包','Apple，脑残粉',1,100,'5699',1,NULL,NULL,NULL,NULL,NULL,NULL,'/Uploads/Goods/20151108/563f692c5cbb9.jpeg','&lt;p&gt;我是苹果我怕谁&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0002.gif&quot;/&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0005.gif&quot;/&gt;&lt;/p&gt;',0,0,0,1,1,1,0,'2015-11-08 23:26:23');

/*Table structure for table `yyg_goods_images` */

DROP TABLE IF EXISTS `yyg_goods_images`;

CREATE TABLE `yyg_goods_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gid` int(10) unsigned NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `idx_yyg_goods_image_gid` (`gid`),
  KEY `gid_2` (`gid`),
  KEY `gid_3` (`gid`),
  KEY `gid_4` (`gid`),
  KEY `gid_5` (`gid`),
  KEY `idx_yyg_goods_images_gid` (`gid`),
  CONSTRAINT `fk_yyg_goods_images_gid` FOREIGN KEY (`gid`) REFERENCES `yyg_goods` (`gid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `yyg_goods_images` */

/*Table structure for table `yyg_miaosha` */

DROP TABLE IF EXISTS `yyg_miaosha`;

CREATE TABLE `yyg_miaosha` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gid` int(10) unsigned NOT NULL COMMENT '商品id',
  `qishu` int(10) unsigned DEFAULT '1' COMMENT '当前期数',
  `money` decimal(8,0) unsigned DEFAULT NULL COMMENT '总价',
  `danjia` int(10) unsigned DEFAULT NULL COMMENT '单价',
  `xiangoushu` smallint(6) unsigned DEFAULT '0' COMMENT '限购数量，默认为0不限购',
  `zongrenshu` int(10) unsigned DEFAULT '0' COMMENT '总人数',
  `canyurenshu` int(10) unsigned DEFAULT '0' COMMENT '参与人数',
  `shengyurenshu` int(10) unsigned DEFAULT '0' COMMENT '剩余人数',
  `time` datetime DEFAULT NULL COMMENT '时间',
  `endtime` datetime DEFAULT NULL COMMENT '揭晓时间',
  `resultcode` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '中奖码',
  `userid` int(11) DEFAULT NULL COMMENT '中奖用户id',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：0:开始,1:结束\n',
  `renqi` tinyint(3) unsigned DEFAULT '0' COMMENT '人气',
  `tuijian` tinyint(4) unsigned DEFAULT '0' COMMENT '推荐',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `id_UNIQUE` (`mid`),
  KEY `fk_yyg_miaosha_yyg_goods_idx` (`gid`),
  CONSTRAINT `fk_yyg_miaosha_goods_gid` FOREIGN KEY (`gid`) REFERENCES `yyg_goods` (`gid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='秒杀专区';

/*Data for the table `yyg_miaosha` */

insert  into `yyg_miaosha`(`mid`,`gid`,`qishu`,`money`,`danjia`,`xiangoushu`,`zongrenshu`,`canyurenshu`,`shengyurenshu`,`time`,`endtime`,`resultcode`,`userid`,`status`,`renqi`,`tuijian`) values (1,12,1,'5699',1,0,0,0,0,'2015-11-08 23:26:23',NULL,NULL,NULL,0,0,0);

/*Table structure for table `yyg_slide` */

DROP TABLE IF EXISTS `yyg_slide`;

CREATE TABLE `yyg_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL COMMENT '超链接',
  `img` varchar(255) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='幻灯片';

/*Data for the table `yyg_slide` */

insert  into `yyg_slide`(`id`,`name`,`link`,`img`) values (1,'广告1','http://www.baidu.com','/Uploads/Slides/20151113/5644c38b9edd8.png'),(2,'广告2','http://www.baidu.com','/Uploads/Slides/20151113/5644c09b0b71d.jpg'),(3,'广告3','http://www.baidu.com','/Uploads/Slides/20151113/5644c0af858e3.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
