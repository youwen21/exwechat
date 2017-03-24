CREATE TABLE `think_we_msg_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserName` char(32) NOT NULL COMMENT '开发者微信号',
  `FromUserName` char(64) NOT NULL COMMENT '发送方帐号',
  `CreateTime` int(11) NOT NULL COMMENT '消息创建时间',
  `MsgType` char(8) NOT NULL COMMENT '消息类型',
  `Event` char(20) DEFAULT NULL COMMENT '事件类型',
  `EventKey` char(32) DEFAULT NULL COMMENT '事件KEY值',
  `latitude` char(20) NOT NULL COMMENT '纬度',
  `longitude` char(20) NOT NULL COMMENT '经度',
  `accuracy` char(10) DEFAULT NULL COMMENT '精度：Scale｜Precision（缩放比例）',
  `altitude` char(10) DEFAULT NULL COMMENT '海拔高度',
  `Label` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `Poiname` char(4) DEFAULT NULL COMMENT '位置标签',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `MsgId` bigint(64) DEFAULT NULL COMMENT '消息ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COMMENT='上报地理位置，聊天地理位置，菜单地理位置';