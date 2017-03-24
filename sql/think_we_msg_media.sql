CREATE TABLE `think_we_msg_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserName` char(32) NOT NULL COMMENT '开发者微信号',
  `FromUserName` char(64) NOT NULL COMMENT '发送方帐号',
  `CreateTime` int(11) NOT NULL COMMENT '消息创建时间',
  `MsgType` char(8) NOT NULL COMMENT '消息类型',
  `MediaId` char(64) NOT NULL COMMENT '多媒体ID',
  `other` varchar(255) NOT NULL COMMENT 'PicUrl|Format|ThumbMediaId',
  `Recognition` text,
  `MsgId` bigint(64) NOT NULL COMMENT '消息id，64位整型',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='图片消息，语音消息，视频消息，小视频消息，\r\nother对应的字段有：PicUrl|Format|ThumbMediaId\r\n当语音消息时有语音识别结果时Recognition有值，其他Recognition都无值';

