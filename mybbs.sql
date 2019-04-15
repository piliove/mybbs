/*
 Navicat Premium Data Transfer

 Source Server         : link
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : mybbs

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 14/04/2019 16:54:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bbs_cate
-- ----------------------------
DROP TABLE IF EXISTS `bbs_cate`;
CREATE TABLE `bbs_cate`  (
  `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL,
  `cname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `uid` int(10) UNSIGNED NULL DEFAULT NULL,
  `create_times` int(60) NULL DEFAULT NULL,
  PRIMARY KEY (`cid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bbs_cate
-- ----------------------------
INSERT INTO `bbs_cate` VALUES (5, 1, '飞驰人生', 47, 1555072322);
INSERT INTO `bbs_cate` VALUES (6, 2, '流浪地球', 46, 1555072422);
INSERT INTO `bbs_cate` VALUES (7, 1, '喜剧之王', 45, 1555072622);
INSERT INTO `bbs_cate` VALUES (8, 2, '复仇者榴莲', 47, 1555072722);
INSERT INTO `bbs_cate` VALUES (9, 1, '复仇者榴莲2', 47, 1555072112);
INSERT INTO `bbs_cate` VALUES (10, 4, '英雄联盟', 45, 1555072900);
INSERT INTO `bbs_cate` VALUES (11, 3, 'NBA', 47, 1555072809);
INSERT INTO `bbs_cate` VALUES (12, 2, '海王', 47, 1555072679);
INSERT INTO `bbs_cate` VALUES (16, 4, '浴血奋战', 45, 1555073084);
INSERT INTO `bbs_cate` VALUES (17, 4, '超越时空', 45, 1555073137);

-- ----------------------------
-- Table structure for bbs_links
-- ----------------------------
DROP TABLE IF EXISTS `bbs_links`;
CREATE TABLE `bbs_links`  (
  `uid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '友链ID',
  `title` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '友链标题',
  `uname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发布人',
  `contents` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '内容',
  `pics` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片',
  `create_time` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bbs_links
-- ----------------------------
INSERT INTO `bbs_links` VALUES (6, 'test3', '谷歌搜索', '我是一头垃圾熊哦!', 'Public/Uploadlinks/20190411/5caf41be47164.jpg', 1554989502);
INSERT INTO `bbs_links` VALUES (7, '梦想很近,道路很远', 'admin', 'Hello World!!', 'Public/Uploadlinks/20190411/5caf4362b3bdc.jpg', 1554989922);
INSERT INTO `bbs_links` VALUES (8, '美好的早晨', '小红姐', '欢迎来哦!', 'Public/Uploadlinks/20190412/5cb02fe6065de.jpg', 1555050469);
INSERT INTO `bbs_links` VALUES (9, '视图中国', '小明哥', '黑暗地球中的一天天...', 'Public/Uploadlinks/20190412/5cb0300fb8709.jpg', 1555050511);
INSERT INTO `bbs_links` VALUES (10, '追逐星空', 'admin', '大黄蜂GD 你也值得拥有!', 'Public/Uploadlinks/20190412/5cb034a20bd12.jpg', 1555051682);
INSERT INTO `bbs_links` VALUES (11, '一直在路上', 'admin', '无论多远,一直都在路上', 'Public/Uploadlinks/20190412/5cb03993473ba.jpg', 1555052947);

-- ----------------------------
-- Table structure for bbs_part
-- ----------------------------
DROP TABLE IF EXISTS `bbs_part`;
CREATE TABLE `bbs_part`  (
  `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bbs_part
-- ----------------------------
INSERT INTO `bbs_part` VALUES (1, '冷门电影');
INSERT INTO `bbs_part` VALUES (2, '热门电影');
INSERT INTO `bbs_part` VALUES (3, '体育');
INSERT INTO `bbs_part` VALUES (4, '游戏');
INSERT INTO `bbs_part` VALUES (7, '铁血军事');
INSERT INTO `bbs_part` VALUES (8, '探索');

-- ----------------------------
-- Table structure for bbs_post
-- ----------------------------
DROP TABLE IF EXISTS `bbs_post`;
CREATE TABLE `bbs_post`  (
  `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL,
  `rep_cnt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `view_cnt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_jing` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_top` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_display` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` int(10) UNSIGNED NULL DEFAULT 0,
  `updated_at` int(10) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`pid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bbs_user
-- ----------------------------
DROP TABLE IF EXISTS `bbs_user`;
CREATE TABLE `bbs_user`  (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `uname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名称',
  `upwd` char(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `auth` int(10) UNSIGNED NOT NULL DEFAULT 3 COMMENT '用户权限  1 超级管理员   2 管理员    3普通会员',
  `uface` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '手机号码',
  `sex` enum('x','m','w') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'w',
  `created_at` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bbs_user
-- ----------------------------
INSERT INTO `bbs_user` VALUES (45, '小明哥', '$2y$10$6qof8BxjmLQfhrVwSZ97auUgNjOdxJ2/.zJUbnnc4e9lXPApCqkuO', 2, 'Public/Uploads/20190411/5caef26192ccc.jpg', '', 'm', 1554966218);
INSERT INTO `bbs_user` VALUES (46, '小红姐姐', '$2y$10$3o3w28vpF0viCqnINBA.QuVdqbGi.D0YxNDBxWlU3LLJZCCzWqdf.', 2, 'Public/Uploads/20190411/5caee6e22f592.jpg', '', 'w', 1554966242);
INSERT INTO `bbs_user` VALUES (47, 'admin', '$2y$10$A4VsJbnf8GDNz.qg3VGQjOzm5DxYirbzJDbAP/0/LmKOeAa42TexO', 1, 'Public/Uploads/20190411/5caee6f7efca9.jpg', '', 'm', 1554966263);
INSERT INTO `bbs_user` VALUES (48, '火狐', '$2y$10$DwlKwk4jJRXJh3BPCypExecdSP/h68Hkej4tj0e3TvWylX8.3Faf.', 3, 'Public/Uploads/20190411/5caee70444168.jpg', '', 'x', 1554966276);
INSERT INTO `bbs_user` VALUES (49, '谷歌', '$2y$10$mSQGTI3DXnu3iKdADlJFCeZ2ZBXq4hWK4k75nA/ofm5u6uGcLOnKO', 3, 'Public/Uploads/20190411/5caee79e5fa17.jpg', '', 'x', 1554966430);
INSERT INTO `bbs_user` VALUES (50, 'IE', '$2y$10$LKAqYHGsiebWG.xyj3yEJO1yMT0k1niSKb3LKwSzRP8c26fAJgcmy', 3, 'Public/Uploads/20190411/5caee7b6e313a.jpg', '', 'x', 1554966454);
INSERT INTO `bbs_user` VALUES (51, '垃圾熊', '$2y$10$g2h5MlUkcRM/fEFh9KCq2OWg808uGeK8vz9QslVv1mKISrMKy3.Ve', 3, 'Public/Uploads/20190411/5caee7eb5eff3.jpg', '', 'm', 1554966507);
INSERT INTO `bbs_user` VALUES (52, 'peter', '$2y$10$1wUDHc9W/0xdfpgbtifEd.JiTA6Yof.BTTEK2q6m6n4Fd6qVAl8pO', 3, 'Public/Uploads/20190411/5caee806d06ae.jpg', '', 'x', 1554966534);
INSERT INTO `bbs_user` VALUES (53, 'apache', '$2y$10$FE1LiaSfCD1hApr8x8Cw8uJqtOcWzy5fApZrJl3KiXWS3JCBZ3EhS', 3, 'Public/Uploads/20190411/5caee82e2e1ff.jpg', '', 'x', 1554966574);
INSERT INTO `bbs_user` VALUES (54, 'am', '$2y$10$.w7RVOJyOJivHnHC3Pu1O.FF90usRMWBLsieIPhAzjoYEp4ubsl5y', 3, 'Public/Uploads/20190411/5caee845129cc.jpg', '', 'w', 1554966596);
INSERT INTO `bbs_user` VALUES (55, 'ajax', '$2y$10$/KFBc6wFaFd4WyTnprFPm.g9oMtywrQoj927K39a/UXEnfXSdKc9S', 3, 'Public/Uploads/20190411/5caef4fdd3cba.jpg', '', 'w', 1554969853);
INSERT INTO `bbs_user` VALUES (59, '测试用户', '$2y$10$nAL7F24QlZAYFnqwpXRFD.dJwnyShqpfaY1pR9f6gx2JuO35HnpxK', 3, 'Public/Uploads/20190412/5cb06d71de3b7.jpg', '121241', 'w', 1555058621);
INSERT INTO `bbs_user` VALUES (60, '阿达', '$2y$10$fH84JfWE9B68HxIa06ISNey2q.YepTOnylNowmHBrLkm7pyL6ygQi', 3, 'Public/Uploads/20190412/5cb0a50a16c72.jpg', '12121', 'w', 1555058698);

SET FOREIGN_KEY_CHECKS = 1;
