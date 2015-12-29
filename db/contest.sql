/*
Navicat MySQL Data Transfer

Source Server         : lampp
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : contest

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2015-12-29 18:31:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`,`admin_user`,`admin_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Open Judge Admin', 'sample@example.com', null);

-- ----------------------------
-- Table structure for `bulk_user_package`
-- ----------------------------
DROP TABLE IF EXISTS `bulk_user_package`;
CREATE TABLE `bulk_user_package` (
  `bulk_user_package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bulk_user_package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bulk_user_package_id`),
  KEY `bulkuser_cont_FK1` (`contest_id`),
  CONSTRAINT `bulkuser_cont_FK1` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bulk_user_package
-- ----------------------------

-- ----------------------------
-- Table structure for `bulk_user_rel`
-- ----------------------------
DROP TABLE IF EXISTS `bulk_user_rel`;
CREATE TABLE `bulk_user_rel` (
  `bulk_user_rel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bulk_user_package_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bulk_user_rel_id`),
  KEY `bulk_rel_bulk_FK1` (`bulk_user_package_id`),
  KEY `bul_rel_user_FK2` (`user_id`),
  CONSTRAINT `bul_rel_user_FK2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bulk_rel_bulk_FK1` FOREIGN KEY (`bulk_user_package_id`) REFERENCES `bulk_user_package` (`bulk_user_package_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bulk_user_rel
-- ----------------------------

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'geometry');
INSERT INTO `category` VALUES ('2', 'greedy');
INSERT INTO `category` VALUES ('3', 'dp');
INSERT INTO `category` VALUES ('4', 'implementation');
INSERT INTO `category` VALUES ('5', 'math');
INSERT INTO `category` VALUES ('6', 'ds');
INSERT INTO `category` VALUES ('7', 'graph');
INSERT INTO `category` VALUES ('8', 'number theory');
INSERT INTO `category` VALUES ('9', 'game theory');
INSERT INTO `category` VALUES ('10', 'string');

-- ----------------------------
-- Table structure for `clarification`
-- ----------------------------
DROP TABLE IF EXISTS `clarification`;
CREATE TABLE `clarification` (
  `clarification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clarification_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clarification_reply` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clarification_status` tinyint(2) NOT NULL DEFAULT '0',
  `clarification_time` datetime NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `judge_id` int(10) unsigned DEFAULT NULL,
  `problem_id` int(10) unsigned DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`clarification_id`),
  KEY `clar_user_FK1` (`user_id`),
  KEY `clar_judge_FK2` (`judge_id`),
  KEY `clar_prob_FK3` (`problem_id`),
  KEY `clar_cont_FK4` (`contest_id`),
  KEY `clar_admin_FK1` (`admin_id`),
  CONSTRAINT `clar_admin_FK1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clar_cont_FK4` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clar_judge_FK2` FOREIGN KEY (`judge_id`) REFERENCES `judge` (`judge_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clar_prob_FK3` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clar_user_FK1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of clarification
-- ----------------------------
INSERT INTO `clarification` VALUES ('47', 'Be careful about conversion specifier for long long, don\'t use %I64d, instead use %lld', null, '0', '2015-12-28 10:12:31', '9', null, null, null, '1');
INSERT INTO `clarification` VALUES ('49', 'Be careful about conversion specifier for long long, don\'t use %I64d, instead use %lld', null, '0', '2015-12-29 17:59:51', '11', null, null, null, '1');
INSERT INTO `clarification` VALUES ('50', 'Can we get chocolate? ', 'No -_-', '1', '2015-12-29 18:28:05', '11', '9', null, null, '1');

-- ----------------------------
-- Table structure for `contest`
-- ----------------------------
DROP TABLE IF EXISTS `contest`;
CREATE TABLE `contest` (
  `contest_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contest_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contest_type` tinyint(2) NOT NULL DEFAULT '0',
  `contest_pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contest_start` datetime NOT NULL,
  `contest_end` datetime NOT NULL,
  `contest_status` tinyint(2) DEFAULT '-1',
  PRIMARY KEY (`contest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contest
-- ----------------------------
INSERT INTO `contest` VALUES ('9', 'IST Internal Programming Contest 2015', '0', '', '2015-12-30 12:00:00', '2015-12-30 17:00:00', '-1');
INSERT INTO `contest` VALUES ('11', 'IST Internal Mock Contest 2015', '0', '', '2015-12-29 18:03:00', '2015-12-29 18:28:00', '2');

-- ----------------------------
-- Table structure for `judge`
-- ----------------------------
DROP TABLE IF EXISTS `judge`;
CREATE TABLE `judge` (
  `judge_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judge_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `judge_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `judge_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `judge_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `judge_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`judge_id`,`judge_user`,`judge_email`),
  KEY `judge_id` (`judge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of judge
-- ----------------------------
INSERT INTO `judge` VALUES ('4', 'muntasir_billah', '514c4f881e6d0c520ca3c225cf38ff5f', 'Muntasir Billah Munna', 'lights.on.me@gmail.com', '01516180603');
INSERT INTO `judge` VALUES ('5', 'alaminopu', 'aea1618697309f246626a75dfb0a8618', 'Md. Al-Amin Opu', 'alaminopu.me@gmail.com', '01614831959');
INSERT INTO `judge` VALUES ('6', 'aniskhan001', 'd3b40452450034e53db0555081b58def', 'Anisuzzaman Khan', 'aniskhan001@gmail.com', '01671169799');

-- ----------------------------
-- Table structure for `judge_cont_rel`
-- ----------------------------
DROP TABLE IF EXISTS `judge_cont_rel`;
CREATE TABLE `judge_cont_rel` (
  `judge_cont_rel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judge_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`judge_cont_rel_id`),
  KEY `judge_cont_judge_FK1` (`judge_id`),
  KEY `judge_cont_cont_FK2` (`contest_id`),
  CONSTRAINT `judge_cont_cont_FK2` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `judge_cont_judge_FK1` FOREIGN KEY (`judge_id`) REFERENCES `judge` (`judge_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of judge_cont_rel
-- ----------------------------
INSERT INTO `judge_cont_rel` VALUES ('3', '4', '9');
INSERT INTO `judge_cont_rel` VALUES ('4', '5', '9');
INSERT INTO `judge_cont_rel` VALUES ('5', '6', '9');
INSERT INTO `judge_cont_rel` VALUES ('6', '4', '11');
INSERT INTO `judge_cont_rel` VALUES ('7', '5', '11');
INSERT INTO `judge_cont_rel` VALUES ('8', '6', '11');

-- ----------------------------
-- Table structure for `language`
-- ----------------------------
DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `language_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of language
-- ----------------------------
INSERT INTO `language` VALUES ('1', 'GNU C11');
INSERT INTO `language` VALUES ('2', 'GNU C++14');

-- ----------------------------
-- Table structure for `prob_cat_rel`
-- ----------------------------
DROP TABLE IF EXISTS `prob_cat_rel`;
CREATE TABLE `prob_cat_rel` (
  `prob_cat_rel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `problem_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`prob_cat_rel_id`),
  KEY `prob_cat_cat_FK1` (`category_id`),
  KEY `prob_cat_prob_FK2` (`problem_id`),
  CONSTRAINT `prob_cat_cat_FK1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prob_cat_prob_FK2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of prob_cat_rel
-- ----------------------------
INSERT INTO `prob_cat_rel` VALUES ('20', '5', '7');
INSERT INTO `prob_cat_rel` VALUES ('21', '5', '8');
INSERT INTO `prob_cat_rel` VALUES ('22', '1', '9');
INSERT INTO `prob_cat_rel` VALUES ('23', '5', '9');

-- ----------------------------
-- Table structure for `prob_cont_rel`
-- ----------------------------
DROP TABLE IF EXISTS `prob_cont_rel`;
CREATE TABLE `prob_cont_rel` (
  `prob_cont_rel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  `prob_cont_rel_order` int(10) unsigned NOT NULL,
  `prob_cont_tried` int(11) NOT NULL DEFAULT '0',
  `prob_cont_solved` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prob_cont_rel_id`),
  KEY `prob_cont_prob_FK1` (`problem_id`),
  KEY `prob_cont_cont_FK2` (`contest_id`),
  CONSTRAINT `prob_cont_cont_FK2` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prob_cont_prob_FK1` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of prob_cont_rel
-- ----------------------------
INSERT INTO `prob_cont_rel` VALUES ('96', '7', '11', '1', '2', '2');
INSERT INTO `prob_cont_rel` VALUES ('97', '11', '11', '2', '2', '0');
INSERT INTO `prob_cont_rel` VALUES ('98', '8', '11', '3', '2', '2');

-- ----------------------------
-- Table structure for `problem`
-- ----------------------------
DROP TABLE IF EXISTS `problem`;
CREATE TABLE `problem` (
  `problem_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `problem_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `problem_level` tinyint(2) DEFAULT NULL,
  `problem_time_limit` int(10) NOT NULL,
  `problem_memory_limit` int(10) NOT NULL,
  `problem_input_channel` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `problem_output_channel` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `problem_description` longblob NOT NULL,
  `problem_input` blob NOT NULL,
  `problem_output` blob NOT NULL,
  `problem_sample_input` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `problem_sample_output` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `problem_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `problem_add_date` datetime NOT NULL,
  `problem_judge_input` blob,
  `problem_judge_output` blob NOT NULL,
  `problem_io_type` tinyint(2) NOT NULL DEFAULT '0',
  `problem_hint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `problem_setter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `problem_status` tinyint(2) NOT NULL DEFAULT '0',
  `problem_special_judge` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of problem
-- ----------------------------
INSERT INTO `problem` VALUES ('7', 'Addition', null, '1000', '32768', 'Standard Input', 'Standard Output', 0x3C703E596F75206861766520746F206164642074776F206E756D6265727320616E6420646973706C61792074686520726573756C743C2F703E, 0x3C703E74776F20696E7465676572732C207820616E6420792E3C2F703E, 0x3C703E7468652073756D6D6174696F6E206F66207820616E6420792E3C2F703E, '3 2', '5', null, '2015-12-09 23:21:11', 0x3230203130, 0x3330, '0', '<p>Remember that the summation of two integers can be larger than the limit of integer.</p>', 'Open Judge', '0', '0');
INSERT INTO `problem` VALUES ('8', 'Multiplication', null, '1000', '32768', 'Standard Input', 'Standard Output', 0x3C703E596F75206861766520746F206D756C7469706C792074776F206E756D6265727320616E6420646973706C61792074686520726573756C743C2F703E, 0x3C703E74776F20696E7465676572732C207820616E6420792E3C2F703E, 0x3C703E746865206D756C7469706C69636174696F6E206F66207820616E6420792E3C2F703E, '3 2', '6', null, '2015-12-09 23:22:01', 0x3230203130, 0x323030, '0', '<p>Remember that the multiplication of two integers can be larger than the limit of integer.</p>', 'Open Judge', '0', '0');
INSERT INTO `problem` VALUES ('9', 'Area of a circle', null, '1000', '32768', 'Standard Input', 'Standard Output', 0x3C703E596F75276C6C20626520676976656E2074686520726164697573206F66206120636972636C652E20596F75206861766520746F2063616C63756C617465207468652061726561206F66207468617420636972636C652E20417373756D65205049203D20332E313431363C2F703E, 0x3C703E4120706F73697469766520666C6F6174696E6720706F696E74206E756D62657220723C2F703E, 0x3C703E5468652061726561206F662074686520636972636C6520686176696E6720726164697573206F6620722E204F75747075742073686F756C64206265206D61746368656420757020746F20322064696769747320616674657220646563696D616C20706F696E74733C2F703E, '10.0', '314.16', null, '2015-12-09 23:26:11', 0x3533312E32313736, 0x3838363533342E3832, '0', '<p>Make sure floating point rounding to avoid wrong answer.</p>', 'Open Judge', '0', '0');
INSERT INTO `problem` VALUES ('11', 'Hello World :D', null, '1000', '512', 'Standard Input', 'Standard Output', 0x3C703E4A757374207072696E74202248656C6C6F20576F726C6422206E2074696D65732C20776974686F7574207468652071756F7465732C20696E206E206C696E65732E3C2F703E, 0x3C703E45616368206C696E65206F662074686520696E70757420636F6E7461696E7320616E20696E7465676572203C7374726F6E673E6E202831266C743B3D206E20266C743B3D3130292E3C2F7374726F6E673E3C2F703E, 0x3C703E4A757374207072696E74202248656C6C6F20576F726C6422206E2074696D65732C20776974686F7574207468652071756F7465732C20696E206E206C696E657320666F722065616368207465737420636173652E204F757470757420612073696E676C6520626C616E6B206C696E65206265747765656E2074776F20746573742063617365732E3C2F703E, '2\r\n3', 'Hello World\r\nHello World\r\n\r\nHello World\r\nHello World\r\nHello World', null, '2015-12-29 17:51:35', 0x350D0A3130, 0x48656C6C6F20576F726C640A48656C6C6F20576F726C640A0A48656C6C6F20576F726C640A0A48656C6C6F20576F726C640A0A48656C6C6F20576F726C640A0A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A48656C6C6F20576F726C640A, '0', '', 'Md. Al-Amin Opu', '0', '0');

-- ----------------------------
-- Table structure for `rank`
-- ----------------------------
DROP TABLE IF EXISTS `rank`;
CREATE TABLE `rank` (
  `rank_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contest_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `rank_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank_solved` tinyint(4) NOT NULL DEFAULT '0',
  `rank_penalty` int(11) NOT NULL DEFAULT '0',
  `rank_disqualified` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`rank_id`),
  KEY `rank_contest_FK1` (`contest_id`),
  KEY `rank_user_FK2` (`user_id`),
  CONSTRAINT `rank_contest_FK1` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rank_user_FK2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rank
-- ----------------------------
INSERT INTO `rank` VALUES ('71', '11', '9', '1,15,15,6,0,0,1,17,17', '2', '32', null);
INSERT INTO `rank` VALUES ('72', '11', '10', '3,17,57,2,0,0,1,18,18', '2', '75', null);
INSERT INTO `rank` VALUES ('73', '11', '11', '0,NA,0,0,NA,0,0,NA,0', '0', '0', null);

-- ----------------------------
-- Table structure for `submission`
-- ----------------------------
DROP TABLE IF EXISTS `submission`;
CREATE TABLE `submission` (
  `submission_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned DEFAULT NULL,
  `submission_source` blob NOT NULL,
  `submission_type` tinyint(4) NOT NULL DEFAULT '0',
  `submission_time` datetime NOT NULL,
  `submission_status` tinyint(4) NOT NULL DEFAULT '1',
  `submission_result` tinyint(2) DEFAULT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `submission_tle` float NOT NULL,
  PRIMARY KEY (`submission_id`),
  KEY `sub_prob_FK1` (`problem_id`),
  KEY `sub_user_FK2` (`user_id`),
  KEY `sub_cont_FK3` (`contest_id`),
  KEY `sub_lang_FK4` (`language_id`),
  CONSTRAINT `sub_cont_FK3` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_lang_FK4` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_prob_FK1` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_user_FK2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission
-- ----------------------------
INSERT INTO `submission` VALUES ('120', '11', '9', '11', 0x23696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A696E74206D61696E28297B0D0A2020202020696E74206E3B0D0A2020202020696E7420666C61673D303B0D0A20202020207768696C652863696E203E3E206E297B0D0A20202020202020202020696628666C61672920636F7574203C3C20656E646C3B0D0A20202020202020202020666C61673D313B0D0A20202020202020202020666F7228696E7420693D313B20693C3D6E3B20692B2B297B0D0A202020202020202020202020202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A202020202020202020207D0D0A20202020207D0D0A202020202072657475726E20303B0D0A7D, '0', '2015-12-29 18:06:50', '0', '5', '2', '0.00594401');
INSERT INTO `submission` VALUES ('121', '11', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A20202020696E74206E3B0D0A20202020696E7420666C6167203D20303B0D0A202020207768696C652863696E203E3E206E297B0D0A2020202020202020696628666C61672920636F7574203C3C20656E646C3B0D0A2020202020202020666C61673D313B0D0A2020202020202020666F7228696E7420693D313B20693C3D6E3B20692B2B297B0D0A202020202020202020202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20202020202020207D0D0A202020207D0D0A0D0A2020202072657475726E20303B0D0A207D, '0', '2015-12-29 18:09:13', '0', '2', '2', '0.00560808');
INSERT INTO `submission` VALUES ('122', '11', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A202020202F2F6672656F70656E2822696E7075742E747874222C2272222C737464696E293B0D0A20202020696E74206E3B0D0A20202020696E7420666C6167203D20303B0D0A202020207768696C652863696E203E3E206E297B0D0A2020202020202020696628666C6167297B0D0A202020202020202020202020636F7574203C3C20656E646C3B0D0A202020202020202020202020636F7574203C3C20656E646C3B0D0A20202020202020207D0D0A2020202020202020666C61673D313B0D0A2020202020202020666F7228696E7420693D313B20693C6E3B20692B2B297B0D0A202020202020202020202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20202020202020207D0D0A2020202020202020636F7574203C3C202248656C6C6F20576F726C64223B0D0A202020207D0D0A0D0A2020202072657475726E20303B0D0A207D, '0', '2015-12-29 18:12:53', '0', '2', '2', '0.00639296');
INSERT INTO `submission` VALUES ('123', '11', '10', '11', 0x23696E636C756465203C626974732F737464632B2B2E683E0D0A7573696E67206E616D657370616365207374643B0D0A0D0A696E74206D61696E2829207B0D0A6672656F70656E2822696E2E747874222C202272222C20737464696E293B0D0A6672656F70656E28226F75742E747874222C202277222C207374646F7574293B0D0A696E7420746573743B0D0A626F6F6C206C696E65203D2066616C73653B0D0A7768696C652863696E203E3E207465737429207B0D0A20206966286C696E652920636F7574203C3C20656E646C3B0D0A20206C696E65203D20747275653B0D0A2020666F722028696E7420693D303B20693C74657374202626206C696E653B202B2B6929207B0D0A20202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20207D0D0A7D0D0A72657475726E20303B0D0A7D0D0A, '0', '2015-12-29 18:15:59', '0', '2', '2', '0.00482297');
INSERT INTO `submission` VALUES ('124', '11', '10', '11', 0x23696E636C756465203C626974732F737464632B2B2E683E0D0A7573696E67206E616D657370616365207374643B0D0A0D0A696E74206D61696E2829207B0D0A2F2F6672656F70656E2822696E2E747874222C202272222C20737464696E293B0D0A2F2F6672656F70656E28226F75742E747874222C202277222C207374646F7574293B0D0A696E7420746573743B0D0A626F6F6C206C696E65203D2066616C73653B0D0A7768696C652863696E203E3E207465737429207B0D0A20206966286C696E652920636F7574203C3C20656E646C3B0D0A20206C696E65203D20747275653B0D0A2020666F722028696E7420693D303B20693C74657374202626206C696E653B202B2B6929207B0D0A20202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20207D0D0A7D0D0A72657475726E20303B0D0A7D0D0A, '0', '2015-12-29 18:16:34', '0', '2', '2', '0.00447679');
INSERT INTO `submission` VALUES ('125', '11', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A202020202F2F6672656F70656E2822696E7075742E747874222C2272222C737464696E293B0D0A20202020696E74206E3B0D0A20202020696E7420666C6167203D20303B0D0A202020207768696C652863696E203E3E206E297B0D0A2020202020202020696628666C6167297B0D0A202020202020202020202020636F7574203C3C20656E646C3B0D0A202020202020202020202020636F7574203C3C20656E646C3B0D0A20202020202020207D0D0A2020202020202020666C61673D313B0D0A2020202020202020666F7228696E7420693D313B20693C6E3B20692B2B297B0D0A202020202020202020202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20202020202020207D0D0A2020202020202020636F7574203C3C202248656C6C6F20576F726C64223B0D0A202020207D0D0A0D0A2020202072657475726E20303B0D0A207D, '0', '2015-12-29 18:17:00', '0', '2', '2', '0.00543118');
INSERT INTO `submission` VALUES ('126', '7', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A20202020696E7420612C20623B0D0A2020202063696E203E3E2061203E3E20623B0D0A20202020636F7574203C3C20612B623B0D0A2020202072657475726E20303B0D0A207D0D0A, '0', '2015-12-29 18:18:28', '0', '1', '2', '0.00554085');
INSERT INTO `submission` VALUES ('127', '7', '10', '11', 0x23696E636C756465203C63737464696F3E0D0A0D0A696E74206D61696E202829207B0D0A2020696E7420612C20623B0D0A20207363616E6628222564202564222C2026612C202662293B0D0A20207072696E746628222564222C20612B62293B0D0A202072657475726E20303B0D0A7D, '0', '2015-12-29 18:18:40', '0', '5', '1', '0.00596499');
INSERT INTO `submission` VALUES ('128', '7', '10', '11', 0x23696E636C756465203C63737464696F3E0D0A0D0A696E74206D61696E202829207B0D0A696E7420612C20623B0D0A7363616E6628222564202564222C2026612C202662293B0D0A7072696E746628222564222C20612B62293B0D0A72657475726E20303B0D0A7D, '0', '2015-12-29 18:19:59', '0', '5', '1', '0.00327396');
INSERT INTO `submission` VALUES ('129', '7', '10', '11', 0x23696E636C756465203C63737464696F3E0D0A0D0A696E74206D61696E202829207B0D0A696E7420612C20623B0D0A7363616E6628222564202564222C2026612C202662293B0D0A7072696E746628222564222C20612B62293B0D0A72657475726E20303B0D0A7D, '0', '2015-12-29 18:20:37', '0', '1', '2', '0.00321913');
INSERT INTO `submission` VALUES ('130', '8', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A20202020696E7420612C20623B0D0A2020202063696E203E3E2061203E3E20623B0D0A20202020636F7574203C3C20612A623B0D0A2020202072657475726E20303B0D0A207D0D0A, '0', '2015-12-29 18:20:39', '0', '1', '2', '0.00932312');
INSERT INTO `submission` VALUES ('131', '8', '10', '11', 0x23696E636C756465203C63737464696F3E0D0A0D0A696E74206D61696E202829207B0D0A696E7420612C20623B0D0A7363616E6628222564202564222C2026612C202662293B0D0A7072696E746628222564222C20612A62293B0D0A72657475726E20303B0D0A7D, '0', '2015-12-29 18:21:20', '0', '1', '2', '0.00352192');
INSERT INTO `submission` VALUES ('132', '11', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A202020206672656F70656E2822696E7075742E747874222C2272222C737464696E293B0D0A20202020696E74206E3B0D0A20202020696E7420666C6167203D20303B0D0A202020207768696C652863696E203E3E206E297B0D0A2020202020202020696628666C6167297B0D0A202020202020202020202020636F7574203C3C20656E646C3B0D0A20202020202020207D0D0A2020202020202020666C61673D313B0D0A2020202020202020666F7228696E7420693D313B20693C3D6E3B20692B2B297B0D0A202020202020202020202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20202020202020207D0D0A202020207D0D0A0D0A2020202072657475726E20303B0D0A207D0D0A, '0', '2015-12-29 18:24:46', '0', '2', '2', '0.00403094');
INSERT INTO `submission` VALUES ('133', '11', '9', '11', 0x2023696E636C756465203C626974732F737464632B2B2E683E0D0A0D0A207573696E67206E616D657370616365207374643B0D0A0D0A20696E74206D61696E28297B0D0A202020202F2F6672656F70656E2822696E7075742E747874222C2272222C737464696E293B0D0A20202020696E74206E3B0D0A20202020696E7420666C6167203D20303B0D0A202020207768696C652863696E203E3E206E297B0D0A2020202020202020696628666C6167297B0D0A202020202020202020202020636F7574203C3C20656E646C3B0D0A20202020202020207D0D0A2020202020202020666C61673D313B0D0A2020202020202020666F7228696E7420693D313B20693C3D6E3B20692B2B297B0D0A202020202020202020202020636F7574203C3C202248656C6C6F20576F726C6422203C3C20656E646C3B0D0A20202020202020207D0D0A202020207D0D0A0D0A2020202072657475726E20303B0D0A207D0D0A, '0', '2015-12-29 18:27:26', '0', '5', '1', '0.00358796');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_handle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` tinyint(2) NOT NULL DEFAULT '0',
  `user_status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`,`user_handle`,`user_email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('9', 'test1', '5a105e8b9d40e1329780d62ea2265d8a', 'Test User 1', 'sample@test1.com', '123456789', '0', '1');
INSERT INTO `user` VALUES ('10', 'test2', 'ad0234829205b9033196ba818f7a872b', 'Test User 2', 'sample@test2.com', '12345678', '0', '1');
INSERT INTO `user` VALUES ('11', 'test3', 'ad0234829205b9033196ba818f7a872b', 'Test User 3', 'sample@test3.com', '345678', '0', '1');

-- ----------------------------
-- Table structure for `user_cont_rel`
-- ----------------------------
DROP TABLE IF EXISTS `user_cont_rel`;
CREATE TABLE `user_cont_rel` (
  `user_cont_rel` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_cont_rel`),
  KEY `user_cont_user_FK1` (`user_id`),
  KEY `user_cont_cont_FK2` (`contest_id`),
  CONSTRAINT `user_cont_cont_FK2` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_cont_user_FK1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_cont_rel
-- ----------------------------
INSERT INTO `user_cont_rel` VALUES ('11', '9', '11');
INSERT INTO `user_cont_rel` VALUES ('12', '10', '11');
INSERT INTO `user_cont_rel` VALUES ('13', '11', '11');

-- ----------------------------
-- View structure for `prob_for_display`
-- ----------------------------
DROP VIEW IF EXISTS `prob_for_display`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prob_for_display` AS select `problem`.`problem_id` AS `problem_id`,`problem`.`problem_name` AS `problem_name`,`problem`.`problem_level` AS `problem_level`,`problem`.`problem_time_limit` AS `problem_time_limit`,`problem`.`problem_memory_limit` AS `problem_memory_limit`,`problem`.`problem_input_channel` AS `problem_input_channel`,`problem`.`problem_output_channel` AS `problem_output_channel`,`problem`.`problem_description` AS `problem_description`,`problem`.`problem_input` AS `problem_input`,`problem`.`problem_output` AS `problem_output`,`problem`.`problem_sample_input` AS `problem_sample_input`,`problem`.`problem_sample_output` AS `problem_sample_output`,`problem`.`problem_image` AS `problem_image`,`problem`.`problem_add_date` AS `problem_add_date`,`problem`.`problem_io_type` AS `problem_io_type`,`problem`.`problem_hint` AS `problem_hint`,`problem`.`problem_setter` AS `problem_setter`,`problem`.`problem_status` AS `problem_status`,`problem`.`problem_special_judge` AS `problem_special_judge` from `problem` ;
