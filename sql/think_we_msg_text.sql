CREATE TABLE `think_we_msg_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserName` char(32) NOT NULL COMMENT '开发者微信号',
  `FromUserName` char(64) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `CreateTime` int(11) NOT NULL COMMENT '消息创建时间 （整型）',
  `MsgType` char(8) NOT NULL COMMENT '消息类型',
  `Content` text NOT NULL COMMENT '消息内容',
  `MsgId` char(64) NOT NULL COMMENT '消息id，64位整型',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;