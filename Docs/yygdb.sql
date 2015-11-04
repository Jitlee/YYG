/*
 Navicat MySQL Data Transfer

 Source Server         : YYG
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : yygdb

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 11/05/2015 01:14:18 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `yyg_admin`
-- ----------------------------
DROP TABLE IF EXISTS `yyg_admin`;
CREATE TABLE `yyg_admin` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `password` char(32) COLLATE utf8_bin DEFAULT NULL COMMENT '密码',
  `email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `time` datetime DEFAULT NULL COMMENT '创建修改时间',
  `login_time` datetime DEFAULT NULL COMMENT '最后一次登陆时间',
  `login_ip` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '最后一次登陆ip',
  `login` int(11) DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='管理员';

-- ----------------------------
--  Records of `yyg_admin`
-- ----------------------------
BEGIN;
INSERT INTO `yyg_admin` VALUES ('1', 'admin', '7fef6171469e80d32c0559f88b377245', null, null, '0000-00-00 00:00:00', '127.0.0.1', '3');
COMMIT;

-- ----------------------------
--  Table structure for `yyg_brand`
-- ----------------------------
DROP TABLE IF EXISTS `yyg_brand`;
CREATE TABLE `yyg_brand` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌id',
  `cid` smallint(6) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `thumb` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '缩略图',
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '链接地址',
  `sort` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT '排序字段',
  PRIMARY KEY (`bid`),
  UNIQUE KEY `bid_UNIQUE` (`bid`),
  KEY `fk_yyg_brand_yyg_category1_idx` (`cid`),
  CONSTRAINT `fk_yyg_brand_yyg_category1` FOREIGN KEY (`cid`) REFERENCES `mydb`.`yyg_category` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='品牌管理';

-- ----------------------------
--  Table structure for `yyg_category`
-- ----------------------------
DROP TABLE IF EXISTS `yyg_category`;
CREATE TABLE `yyg_category` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `parentid` smallint(6) unsigned DEFAULT NULL COMMENT '父id',
  `model` tinyint(1) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `key` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `info` text COLLATE utf8_bin COMMENT '描述',
  `sort` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='栏目分类';

-- ----------------------------
--  Records of `yyg_category`
-- ----------------------------
BEGIN;
INSERT INTO `yyg_category` VALUES ('1', '0', '1', '数码产品', 'shuma', null, null), ('2', '0', '1', '智能手机', 'shouji', null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
