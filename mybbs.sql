/*
Navicat MySQL Data Transfer

Source Server         : login
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : mybbs

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-04-17 20:07:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bbs_cate
-- ----------------------------
DROP TABLE IF EXISTS `bbs_cate`;
CREATE TABLE `bbs_cate` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `cname` varchar(20) NOT NULL,
  `uid` int(10) unsigned DEFAULT NULL,
  `create_times` int(60) DEFAULT NULL,
  PRIMARY KEY (`cid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bbs_cate
-- ----------------------------
INSERT INTO `bbs_cate` VALUES ('12', '2', '海王', '47', '1555072679');
INSERT INTO `bbs_cate` VALUES ('25', '9', '撑杆跳', '46', '1555491580');
INSERT INTO `bbs_cate` VALUES ('26', '10', '王者荣耀', '47', '1555491600');
INSERT INTO `bbs_cate` VALUES ('27', '9', '跑步', '45', '1555491612');
INSERT INTO `bbs_cate` VALUES ('28', '9', 'NBA', '45', '1555491622');
INSERT INTO `bbs_cate` VALUES ('29', '12', 'this', '47', '1555491661');
INSERT INTO `bbs_cate` VALUES ('30', '2', '正义联盟', '45', '1555491694');
INSERT INTO `bbs_cate` VALUES ('31', '11', '飞驰人生2', '45', '1555491870');
INSERT INTO `bbs_cate` VALUES ('32', '2', '超人', '45', '1555491886');
INSERT INTO `bbs_cate` VALUES ('33', '2', '飞驰人生3', '45', '1555492280');
INSERT INTO `bbs_cate` VALUES ('34', '2', '飞驰人生4', '45', '1555492295');

-- ----------------------------
-- Table structure for bbs_links
-- ----------------------------
DROP TABLE IF EXISTS `bbs_links`;
CREATE TABLE `bbs_links` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '友链ID',
  `title` varchar(80) DEFAULT NULL COMMENT '友链标题',
  `uname` varchar(60) DEFAULT NULL COMMENT '发布人',
  `contents` varchar(255) DEFAULT NULL COMMENT '内容',
  `pics` varchar(255) DEFAULT NULL COMMENT '图片',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bbs_links
-- ----------------------------
INSERT INTO `bbs_links` VALUES ('6', 'test3', '谷歌搜索', '我是一头垃圾熊哦!', 'Public/Uploadlinks/20190411/5caf41be47164.jpg', '1554989502');
INSERT INTO `bbs_links` VALUES ('7', '梦想很近,道路很远', 'admin', 'Hello World!!Hello World!', 'Public/Uploadlinks/20190411/5caf4362b3bdc.jpg', '1554989922');
INSERT INTO `bbs_links` VALUES ('8', '美好的早晨', '小红姐', '欢迎来迎接哦!', 'Public/Uploadlinks/20190412/5cb02fe6065de.jpg', '1555050469');
INSERT INTO `bbs_links` VALUES ('9', '视图中国', '小明哥', '黑暗地球中的一天天...', 'Public/Uploadlinks/20190412/5cb0300fb8709.jpg', '1555050511');
INSERT INTO `bbs_links` VALUES ('10', '追逐星空', 'admin', '大黄蜂GD 你也值得拥有!', 'Public/Uploadlinks/20190412/5cb034a20bd12.jpg', '1555051682');
INSERT INTO `bbs_links` VALUES ('11', '一直在路上', 'admin', '无论多远,一直都在路上', 'Public/Uploadlinks/20190412/5cb03993473ba.jpg', '1555052947');

-- ----------------------------
-- Table structure for bbs_part
-- ----------------------------
DROP TABLE IF EXISTS `bbs_part`;
CREATE TABLE `bbs_part` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pname` varchar(20) NOT NULL,
  `partname` varchar(30) NOT NULL COMMENT '分区版主',
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bbs_part
-- ----------------------------
INSERT INTO `bbs_part` VALUES ('2', '热门电影', 'admin');
INSERT INTO `bbs_part` VALUES ('9', '体育', '小明哥');
INSERT INTO `bbs_part` VALUES ('10', '游戏', '小红姐');
INSERT INTO `bbs_part` VALUES ('11', 'AA', 'admin');
INSERT INTO `bbs_part` VALUES ('12', 'BB1', 'admin');

-- ----------------------------
-- Table structure for bbs_post
-- ----------------------------
DROP TABLE IF EXISTS `bbs_post`;
CREATE TABLE `bbs_post` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `uid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `rep_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `view_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `is_jing` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_top` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` int(10) unsigned DEFAULT '0',
  `updated_at` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bbs_post
-- ----------------------------
INSERT INTO `bbs_post` VALUES ('4', '这个夏季不寂寞', '这个内容充分说明了这个号', '47', '6', '0', '5', '0', '1', '0', '1555236579', '1555484163');
INSERT INTO `bbs_post` VALUES ('5', '来啦', '我来啦', '47', '6', '0', '0', '1', '1', '0', '1555236627', '1555236627');
INSERT INTO `bbs_post` VALUES ('6', '复仇者联盟4什么时候上映啊?', '看看,点进链接可分享到百度云盘!', '47', '7', '0', '5', '1', '0', '0', '1555240582', '1555484107');
INSERT INTO `bbs_post` VALUES ('17', 'ok测试完成', '这里是内容!', '45', '5', '0', '5', '1', '0', '0', '1555244367', '1555477075');
INSERT INTO `bbs_post` VALUES ('18', '喜剧之王为什么这么火呢?', '应该很火的吧!', '45', '7', '0', '0', '0', '0', '1', '1555244452', '1555244452');
INSERT INTO `bbs_post` VALUES ('19', '好喜欢看漫威宇宙的电影', '哈哈哈哈哈哈', '45', '9', '0', '0', '0', '0', '0', '1555244567', '1555244567');
INSERT INTO `bbs_post` VALUES ('21', '字母歌能否登顶MVP', '能能能吧!', '45', '11', '0', '0', '0', '0', '1', '1555248064', '1555248064');
INSERT INTO `bbs_post` VALUES ('22', '詹皇牛气!', '有点点厉害哦', '45', '11', '0', '0', '0', '0', '1', '1555248102', '1555248102');
INSERT INTO `bbs_post` VALUES ('26', '测试是否能够置顶', '................无', '47', '5', '0', '0', '1', '0', '1', '1555310688', '1555310688');
INSERT INTO `bbs_post` VALUES ('28', '人生本来就是最后的飞驰', '人生....', '47', '5', '4', '59', '0', '0', '0', '1555311967', '1555335923');
INSERT INTO `bbs_post` VALUES ('30', '我要当海王2', '2222222', '47', '12', '9', '53', '0', '0', '0', '1555498960', '1555500592');
INSERT INTO `bbs_post` VALUES ('31', '大超', '大超人真的牛逼!!1', '47', '30', '0', '0', '1', '0', '0', '1555499219', '1555499219');
INSERT INTO `bbs_post` VALUES ('32', '蝙蝠侠', '蝙蝠侠真的厉害哦', '47', '30', '0', '0', '0', '0', '0', '1555499237', '1555499237');
INSERT INTO `bbs_post` VALUES ('33', '神奇女侠', '惊奇大妈PK神奇女侠!!', '47', '30', '0', '0', '0', '0', '0', '1555499287', '1555499287');

-- ----------------------------
-- Table structure for bbs_reply
-- ----------------------------
DROP TABLE IF EXISTS `bbs_reply`;
CREATE TABLE `bbs_reply` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rcontent` text,
  `uid` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bbs_reply
-- ----------------------------
INSERT INTO `bbs_reply` VALUES ('7', 'teststest', '47', '28', '1555329470');
INSERT INTO `bbs_reply` VALUES ('16', '楼主说得对!', '47', '28', '1555333177');
INSERT INTO `bbs_reply` VALUES ('17', '测试零一', '47', '28', '1555335923');
INSERT INTO `bbs_reply` VALUES ('18', '感谢楼主分享', '47', '6', '1555336073');
INSERT INTO `bbs_reply` VALUES ('19', '11', '47', '17', '1555477075');
INSERT INTO `bbs_reply` VALUES ('20', 'xiexie', '47', '6', '1555484107');
INSERT INTO `bbs_reply` VALUES ('21', 'sdad', '47', '4', '1555484163');
INSERT INTO `bbs_reply` VALUES ('24', '11111111111', '47', '30', '1555500090');
INSERT INTO `bbs_reply` VALUES ('25', '11111111111', '47', '30', '1555500175');
INSERT INTO `bbs_reply` VALUES ('26', '22222222', '47', '30', '1555500395');
INSERT INTO `bbs_reply` VALUES ('27', '3333333333333', '47', '30', '1555500410');
INSERT INTO `bbs_reply` VALUES ('28', '111', '47', '30', '1555500429');
INSERT INTO `bbs_reply` VALUES ('29', '11', '47', '30', '1555500482');
INSERT INTO `bbs_reply` VALUES ('30', '111111111111111111111111111111', '47', '30', '1555500519');
INSERT INTO `bbs_reply` VALUES ('31', 'dwdawd', '47', '30', '1555500592');
INSERT INTO `bbs_reply` VALUES ('32', '11111111', '47', '30', '1555500621');
INSERT INTO `bbs_reply` VALUES ('33', 'ssswd', '47', '30', '1555500639');
INSERT INTO `bbs_reply` VALUES ('34', 'nmsl', '47', '30', '1555501051');
INSERT INTO `bbs_reply` VALUES ('35', '*', '47', '30', '1555501115');
INSERT INTO `bbs_reply` VALUES ('36', 'ssssssss', '47', '30', '1555501215');
INSERT INTO `bbs_reply` VALUES ('37', 'ss', '47', '30', '1555501903');
INSERT INTO `bbs_reply` VALUES ('38', 'nmsl', '47', '30', '1555502068');

-- ----------------------------
-- Table structure for bbs_user
-- ----------------------------
DROP TABLE IF EXISTS `bbs_user`;
CREATE TABLE `bbs_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `uname` varchar(255) NOT NULL COMMENT '用户名称',
  `upwd` char(80) NOT NULL,
  `auth` int(10) unsigned NOT NULL DEFAULT '3' COMMENT '用户权限  1 超级管理员   2 管理员    3普通会员',
  `uface` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT '' COMMENT '手机号码',
  `sex` enum('x','m','w') DEFAULT 'w',
  `created_at` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bbs_user
-- ----------------------------
INSERT INTO `bbs_user` VALUES ('45', '小明哥', '$2y$10$6qof8BxjmLQfhrVwSZ97auUgNjOdxJ2/.zJUbnnc4e9lXPApCqkuO', '2', 'Public/Uploads/20190411/5caef26192ccc.jpg', '', 'm', '1554966218');
INSERT INTO `bbs_user` VALUES ('46', '小红姐姐', '$2y$10$3o3w28vpF0viCqnINBA.QuVdqbGi.D0YxNDBxWlU3LLJZCCzWqdf.', '2', 'Public/Uploads/20190411/5caee6e22f592.jpg', '', 'w', '1554966242');
INSERT INTO `bbs_user` VALUES ('47', 'admin', '$2y$10$cHel4kqO8HCmO7ktZ7gbq.AG.PeJ3FEKx.CB9G/RsVga6Qv66PcCC', '1', 'Public/Uploads/20190411/5caee6f7efca9.jpg', '18018018015', 'm', '1554966263');
INSERT INTO `bbs_user` VALUES ('48', '火狐', '$2y$10$DwlKwk4jJRXJh3BPCypExecdSP/h68Hkej4tj0e3TvWylX8.3Faf.', '3', 'Public/Uploads/20190411/5caee70444168.jpg', '', 'x', '1554966276');
INSERT INTO `bbs_user` VALUES ('49', '谷歌', '$2y$10$mSQGTI3DXnu3iKdADlJFCeZ2ZBXq4hWK4k75nA/ofm5u6uGcLOnKO', '3', 'Public/Uploads/20190411/5caee79e5fa17.jpg', '', 'x', '1554966430');
INSERT INTO `bbs_user` VALUES ('50', 'IE', '$2y$10$LKAqYHGsiebWG.xyj3yEJO1yMT0k1niSKb3LKwSzRP8c26fAJgcmy', '3', 'Public/Uploads/20190411/5caee7b6e313a.jpg', '', 'x', '1554966454');
INSERT INTO `bbs_user` VALUES ('51', '垃圾熊', '$2y$10$g2h5MlUkcRM/fEFh9KCq2OWg808uGeK8vz9QslVv1mKISrMKy3.Ve', '3', 'Public/Uploads/20190411/5caee7eb5eff3.jpg', '', 'm', '1554966507');
INSERT INTO `bbs_user` VALUES ('52', 'peter', '$2y$10$1wUDHc9W/0xdfpgbtifEd.JiTA6Yof.BTTEK2q6m6n4Fd6qVAl8pO', '3', 'Public/Uploads/20190411/5caee806d06ae.jpg', '', 'x', '1554966534');
INSERT INTO `bbs_user` VALUES ('53', 'apache', '$2y$10$FE1LiaSfCD1hApr8x8Cw8uJqtOcWzy5fApZrJl3KiXWS3JCBZ3EhS', '3', 'Public/Uploads/20190411/5caee82e2e1ff.jpg', '', 'x', '1554966574');
INSERT INTO `bbs_user` VALUES ('54', 'am', '$2y$10$.w7RVOJyOJivHnHC3Pu1O.FF90usRMWBLsieIPhAzjoYEp4ubsl5y', '3', 'Public/Uploads/20190411/5caee845129cc.jpg', '', 'w', '1554966596');
INSERT INTO `bbs_user` VALUES ('55', 'ajax', '$2y$10$/KFBc6wFaFd4WyTnprFPm.g9oMtywrQoj927K39a/UXEnfXSdKc9S', '3', 'Public/Uploads/20190411/5caef4fdd3cba.jpg', '', 'w', '1554969853');
INSERT INTO `bbs_user` VALUES ('59', '测试用户', '$2y$10$nAL7F24QlZAYFnqwpXRFD.dJwnyShqpfaY1pR9f6gx2JuO35HnpxK', '3', 'Public/Uploads/20190412/5cb06d71de3b7.jpg', '121241', 'w', '1555058621');
INSERT INTO `bbs_user` VALUES ('60', '阿达', '$2y$10$fH84JfWE9B68HxIa06ISNey2q.YepTOnylNowmHBrLkm7pyL6ygQi', '3', 'Public/Uploads/20190412/5cb0a50a16c72.jpg', '12121', 'w', '1555058698');
