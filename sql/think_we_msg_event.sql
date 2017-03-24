/*
Navicat MySQL Data Transfer

Source Server         : 112.126.74.71demo_bauth
Source Server Version : 50537
Source Host           : localhost:3306
Source Database       : demo_bauth

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2017-03-24 15:32:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `think_we_msg_event`
-- ----------------------------
DROP TABLE IF EXISTS `think_we_msg_event`;
CREATE TABLE `think_we_msg_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserName` char(32) NOT NULL COMMENT '开发者微信号',
  `FromUserName` char(64) NOT NULL COMMENT '发送方帐号',
  `CreateTime` int(11) NOT NULL COMMENT '消息创建时间',
  `MsgType` char(8) NOT NULL COMMENT '消息类型',
  `Event` char(20) NOT NULL COMMENT '事件类型',
  `EventKey` char(32) NOT NULL COMMENT '事件KEY值',
  `other` text COMMENT '其他字段',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Ticket：二维码的ticket，可用来换取二维码图片\r\nLatitude：地理位置纬度\r\nLongitude：地理位置经度\r\nPrecision：地理位置精度';
