/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ty06project

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-26 11:50:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL COMMENT '厂家',
  `description` text,
  `num` int(10) unsigned DEFAULT '1',
  `state` tinyint(4) DEFAULT '1' COMMENT '1为上架2为下架',
  `sales` int(11) DEFAULT '0',
  `is_del` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('6', '49', '京东自营 2件9.8折】花花公子（PLAYBOY）休闲裤 男2017哈伦裤秋装新款潮流韩版修身小脚裤 17095PLTX703 黑色 XL', '99.00', '0aa258dd71f8e7ef239eec58726032c8.jpg', '花花公子（PLAYBOY）', '<ul id=\"parameter-brand\" class=\"p-parameter-list\"><li title=\"花花公子（PLAYBOY）\">品牌：&nbsp;花花公子（PLAYBOY）</li></ul><ul class=\"parameter2 p-parameter-list\"><li title=\"花花公子17095PLTX703\">商品名称：花花公子17095PLTX703</li><li title=\"4799393\">商品编号：4799393</li><li title=\"390.00g\">商品毛重：390.00g</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"17095PLTX703\">货号：17095PLTX703</li><li title=\"哈伦裤\">裤型：哈伦裤</li><li title=\"时尚休闲\">风格：时尚休闲</li><li title=\"常规\">厚度：常规</li><li title=\"黑色\">颜色：黑色</li><li title=\"纯色\">图案：纯色</li><li title=\"微弹\">弹力：微弹</li><li title=\"校园，运动，休闲，其它　，商务，日常\">适用场景：校园，运动，休闲，其它　，商务，日常</li><li title=\"青年\">人群：青年</li><li title=\"其它\">主要材质：其它</li><li title=\"简约，其它\">流行元素：简约，其它</li><li title=\"其他\">裤门襟：其他</li><li title=\"长裤\">裤长：长裤</li><li title=\"M码，L码，XL码，XXL码，XXXL，其它\">尺码：M码，L码，XL码，XXL码，XXXL，其它</li><li title=\"秋季\">适用季节：秋季</li><li title=\"其他\">工艺：其他</li><li title=\"中腰\">腰型：中腰</li><li title=\"2017秋季\">上市时间：2017秋季</li></ul>', '999', '1', '0', '0');
INSERT INTO `goods` VALUES ('7', '45', '阿什兰 2017夏装新款露肩短袖连衣裙 收腰小清新白色女装短裙显瘦印花圆领裙子女 树叶花 M', '149.00', 'b36779bb3d2e42868a55dbbd9bb2abc5.jpg', '阿什兰（Ashenland）', '<ul class=\"parameter2 p-parameter-list\"><li title=\"阿什兰 2017夏装新款露肩短袖连衣裙 收腰小清新白色女装短裙显瘦印花圆领裙子女 树叶花 M\">商品名称：阿什兰 2017夏装新款露肩短袖连衣裙 收腰小清新白色女装短裙显瘦印花圆领裙子女 树叶花 M</li><li title=\"14363301164\">商品编号：14363301164</li><li title=\"滨闻服装专营店\">店铺：&nbsp;滨闻服装专营店</li><li title=\"500.00g\">商品毛重：500.00g</li><li title=\"ALQ076\">货号：ALQ076</li><li title=\"中腰\">腰型：中腰</li><li title=\"休闲，OL通勤\">风格：休闲，OL通勤</li><li title=\"圆领\">领型：圆领</li><li title=\"其它\">颜色：其它</li><li title=\"25-29周岁\">适用年龄：25-29周岁</li><li title=\"植物花卉，其它\">图案：植物花卉，其它</li><li title=\"学生，胖mm，成熟，少女，轻熟女\">人群：学生，胖mm，成熟，少女，轻熟女</li><li title=\"A字裙\">裙型：A字裙</li><li title=\"露肩\">流行元素：露肩</li><li title=\"修身型\">版型：修身型</li><li title=\"其它\">面料：其它</li><li title=\"单件\">组合形式：单件</li><li title=\"套头\">衣门襟：套头</li><li title=\"常规\">袖型：常规</li><li title=\"短袖\">袖长：短袖</li><li title=\"短裙\">裙长：短裙</li><li title=\"吊带裙\">分类：吊带裙</li><li title=\"S，M，L，XL，XXL\">尺码：S，M，L，XL，XXL</li><li title=\"2017夏季\">上市时间：2017夏季</li></ul>', '2147483647', '1', '0', '0');
INSERT INTO `goods` VALUES ('8', '84', '预售 全球购 苹果(Apple)iPhone X 移动联通 海外版 5.8英寸 深空灰色256GB', '19999.99', '8056c0dff21b0084defb89c1883f3988.jpg', 'Apple', '<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" class=\"Ptable layui-table\"><tbody><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">主体</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">型号&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>iphone x</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">入网型号&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>以官方为准</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">上市年份</td><td>2017年</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">上市月份</td><td>以官网信息为准</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">基本信息</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">机身颜色</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">机身长度（mm）</td><td>143.6</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">机身宽度（mm）</td><td>70.9</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">机身厚度（mm）</td><td>7.7</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">机身重量（g）</td><td>174</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">运营商标志或内容&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">机身材质分类</td><td>其他</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">操作系统</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">操作系统</td><td>IOS</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">主芯片</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">CPU品牌</td><td>以官网信息为准</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">CPU频率</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">CPU核数</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">CPU型号</td><td>--</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">网络支持</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">双卡机类型</td><td>单卡</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">最大支持SIM卡数量</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">SIM卡类型&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>Nano SIM</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">4G网络&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>4G：移动（TD-LTE)；4G：联通(TD-LTE)</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">3G/2G网络</td><td>3G：移动(TD-SCDMA)；3G：联通(WCDMA)</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">网络频率（2G/3G）</td><td>其他</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">存储</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">ROM&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">RAM&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">存储卡</td><td>不支持</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">屏幕</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">主屏幕尺寸（英寸）</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">分辨率</td><td>2436×1125</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">屏幕材质类型</td><td>其他</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">前置摄像头</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">前置摄像头</td><td>700万像素</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">前摄光圈大小</td><td>f/1.8</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">后置摄像头</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">摄像头数量&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>2个</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">后置摄像头</td><td>1200万像素</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">电池信息</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">电池容量（mAh）</td><td>2910</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">电池是否可拆卸&nbsp;<div class=\"Ptable-tips\"><a href=\"https://item.jd.hk/1997057499.html#none\"><span class=\"Ptable-sprite-question\"></span></a></div></td><td>否</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">充电器</td><td>其他</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">数据接口</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">数据传输接口</td><td>蓝牙；WIFI</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">NFC/NFC模式</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">耳机接口类型</td><td>lighting</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">充电接口类型</td><td>Lightning(iphone)</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">手机特性</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">指纹识别</td><td>其他</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">GPS</td><td>支持</td></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">陀螺仪</td><td>支持</td></tr><tr><th class=\"tdTitle\" colspan=\"2\" style=\"text-align: center;\">辅助功能</th></tr><tr></tr><tr><td class=\"tdTitle\" style=\"text-align: right;\">常用功能</td><td>手势识别</td></tr></tbody></table>', '5', '1', '0', '0');
INSERT INTO `goods` VALUES ('9', '36', '海信（Hisense）LED55EC780UC 55英寸 曲面4K智能平板电视 HDR动态显示 64位14核处理', '4398.00', '52057c0db26a7f3702559157142bac5f.jpg', '海信（Hisense）', '<ul class=\"parameter2 p-parameter-list\"><li title=\"海信LED55EC780UC\">商品名称：海信LED55EC780UC</li><li title=\"3433317\">商品编号：3433317</li><li title=\"26.5kg\">商品毛重：26.5kg</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"3-3.5米\">观看距离：3-3.5米</li><li title=\"超高清\">分辨率：超高清</li><li title=\"曲面电视，4K超清电视，HDR，智能电视，互联网电视，人工智能电视\">电视类型：曲面电视，4K超清电视，HDR，智能电视，互联网电视，人工智能电视</li><li title=\"三级能效\">能效等级：三级能效</li><li title=\"55英寸\">屏幕尺寸：55英寸</li></ul>', '100', '1', '0', '0');
INSERT INTO `goods` VALUES ('10', '36', 'TCL 55A950C 55英寸32核人工智能 HDR曲面超薄4K电视金属机身（枪色）', '4399.00', '2d5a90558e98ce138edc5d75bcceb34a.jpg', 'TCL', '<ul class=\"parameter2 p-parameter-list\"><li title=\"TCL55A950C\">商品名称：TCL55A950C</li><li title=\"4749506\">商品编号：4749506</li><li title=\"19.0kg\">商品毛重：19.0kg</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"3-3.5米\">观看距离：3-3.5米</li><li title=\"超高清\">分辨率：超高清</li><li title=\"曲面电视，超薄电视，4K超清电视，HDR，智能电视，互联网电视，人工智能电视\">电视类型：曲面电视，超薄电视，4K超清电视，HDR，智能电视，互联网电视，人工智能电视</li><li title=\"三级能效\">能效等级：三级能效</li><li title=\"55英寸\">屏幕尺寸：55英寸</li><li title=\"10.0-8.0\">选购指数：10.0-8.0</li></ul>', '100', '1', '0', '0');
INSERT INTO `goods` VALUES ('11', '40', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '1aa2261d8e70468e938133fbace84128.jpg', '夏普 (SHARP)', '<ul class=\"parameter2 p-parameter-list\"><li title=\"SHARPLCD-50SU460A\">商品名称：SHARPLCD-50SU460A</li><li title=\"4189028\">商品编号：4189028</li><li title=\"14.0kg\">商品毛重：14.0kg</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"爱奇艺视频合约\">合约方案：爱奇艺视频合约</li><li title=\"2.5-3米\">观看距离：2.5-3米</li><li title=\"超高清\">分辨率：超高清</li><li title=\"4K超清电视，智能电视\">电视类型：4K超清电视，智能电视</li><li title=\"三级能效\">能效等级：三级能效</li><li title=\"49-50英寸\">屏幕尺寸：49-50英寸</li></ul>', '100', '1', '0', '0');
INSERT INTO `goods` VALUES ('12', '19', '荣耀 V9 全网通 高配版 6GB+64GB 极光蓝 移动联通电信4G手机 双卡双待', '2999.00', 'b8767a5cec5691809a3c037d586ebc27.jpg', ' 华为（HUAWEI）', '<ul class=\"parameter2 p-parameter-list\"><li title=\"华为荣耀V9\">商品名称：华为荣耀V9</li><li title=\"4461470\">商品编号：4461470</li><li title=\"490.00g\">商品毛重：490.00g</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"安卓（Android）\">系统：安卓（Android）</li><li title=\"其他\">购买方式：其他</li><li title=\"4000mAh-5999mAh\">电池容量：4000mAh-5999mAh</li><li title=\"蓝色\">机身颜色：蓝色</li><li title=\"双卡双待，快速充电，指纹识别，Type-C，2K屏，支持NFC，其他，后置双摄像头\">热点：双卡双待，快速充电，指纹识别，Type-C，2K屏，支持NFC，其他，后置双摄像头</li><li title=\"6GB\">运行内存：6GB</li><li title=\"800万-1599万\">前置摄像头像素：800万-1599万</li><li title=\"后置双摄像头，1200万-1999万\">后置摄像头像素：后置双摄像头，1200万-1999万</li><li title=\"64GB\">机身内存：64GB</li></ul>', '100', '1', '0', '0');
INSERT INTO `goods` VALUES ('13', '81', 'Apple MacBook Air 13.3英寸笔记本电脑 银色(Core i5 处理器/8GB内存/128GB闪存 MQD32CH/A)', '6588.00', '548cec031257904350e6ff2852b2f5ad.jpg', 'Apple', '<ul class=\"parameter2 p-parameter-list\"><li title=\"AppleMQD32CH/A\">商品名称：AppleMQD32CH/A</li><li title=\"5225346\">商品编号：5225346</li><li title=\"2.96kg\">商品毛重：2.96kg</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"MAC\">系统：MAC</li><li title=\"10.0mm—15.0mm\">厚度：10.0mm—15.0mm</li><li title=\"其他\">内存容量：其他</li><li title=\"其他\">分辨率：其他</li><li title=\"其他\">显卡型号：其他</li><li title=\"9小时以上\">待机时长：9小时以上</li><li title=\"Intel 其他\">处理器：Intel 其他</li><li title=\"背光键盘，其他\">特性：背光键盘，其他</li><li title=\"集成显卡\">显卡类别：集成显卡</li><li title=\"1-1.5KG\">裸机重量：1-1.5KG</li><li title=\"128G固态\">硬盘容量：128G固态</li><li title=\"其他\">显存容量：其他</li><li title=\"轻薄本，常规笔记本\">分类：轻薄本，常规笔记本</li><li title=\"13.3英寸\">屏幕尺寸：13.3英寸</li></ul>', '3', '1', '0', '0');
INSERT INTO `goods` VALUES ('14', '86', '跟兄弟连学PHP（附光盘）', '83.30', '2602af21eeff66330adfe472289bded2.jpg', '兄弟连IT教育 编', '<ul id=\"parameter2\" class=\"p-parameter-list\"><li title=\"电子工业出版社\" clstag=\"shangpin|keycount|product|chubanshe_3\">出版社：&nbsp;<a target=\"_blank\" title=\"电子工业出版社\" href=\"https://book.jd.com/publish/%E7%94%B5%E5%AD%90%E5%B7%A5%E4%B8%9A%E5%87%BA%E7%89%88%E7%A4%BE_1.html\">电子工业出版社</a></li><li title=\"9787121278013\">ISBN：9787121278013</li><li title=\"1\">版次：1</li><li title=\"11850962\">商品编码：11850962</li><li title=\"平装\">包装：平装</li><li title=\"16开\">开本：16开</li><li title=\"2015-12-01\">出版时间：2015-12-01</li><li title=\"胶版纸\">用纸：胶版纸</li><li title=\"884\">页数：884</li><li title=\"1592000\">字数：1592000</li><li title=\"中文\">正文语种：中文</li><li title=\"光盘\">附件：光盘</li></ul>', '100', '1', '0', '0');
INSERT INTO `goods` VALUES ('15', '19', '细说PHP（第2版）（附光盘内容）', '70.90', '3f0649c12f0b38b0f866f8c383cd7c8e.jpg', '高洛峰  著  LAMP兄弟连  编 ', '<div class=\"formwork_bt\" id=\"contentInfo\" name=\"detail-tag-id-1\" text=\"内容简介\"><div class=\"formwork_bt_it\"><span>内容简介</span></div><div class=\"con\">　　PHP是开发Web应用系统最理想的工具，易于使用、功能强大、成本低廉、高安全性、开发速度快且执行灵活。《细说PHP（第2版）》以实用为目标设计，包含PHP开发最主流的各项技术，对每一个知识点都进行了深入详细的讲解，并附有大量的实例代码，图文并茂。系统地介绍了PHP的相关技术及其在实际Web开发中的应用。全书共六个部分，分为30个章节，每一章都是PHP独立知识点的总结。内容涵盖了动态网站开发的前台技术（HTML+CSS）、PHP编程语言的语法、PHP的常用功能模块和实用技巧、MySQL数据库的设计与应用、PHP面向对象的程序设计思想、数据库抽象层PDO、Smarty模板技术、Web开发的设计模式、自定义框架BroPHP、Web项目开发整个流程等目前PHP开发中最主流的技术。每一章中都有大量的实用示例，以及详尽的注释，加速读者的理解和学习，也为每章的技术点设置了大量的自测试题。最后以一个比较完整的、采用面向对象思想，以及通过MVC模式设计，并结合Smarty模板，基于BroPHP框架的CMS系统为案例，详细介绍了Web系统开发从设计到部署的各个细节，便于更好地进行开发实践。</div></div><div class=\"formwork_bt\" id=\"authorInfo\" name=\"detail-tag-id-2\" text=\"作者简介\"><div class=\"formwork_bt_it\"><span>作者简介</span></div><p>　　高洛峰，现任北京LAMP兄弟连（易第优教育）教学总监，五年软件开发工作经验，四年IT教学工作经验。曾在多家上市企业担任过技术总监、项目经理、高级软件工程师等职务，具有扎实的技术功底。国内资深的高级技术认证讲师，从事IT培训以来累计授课长达6000课时以上，培训近千名学员成功走向IT岗位，具有丰富的IT教学经验。熟悉掌握Unix/Linux/Windows等多种操作系统，一直从事嵌入式、CC++、J2EE、J2ME、J2SE、PHP及Oracle数据库等技术研发工作。其中，对Web系统软件开发深有研究，近年来致力于推广LAMP开源平台系列软件。</p><p><br></p></div><div class=\"formwork_bt\" id=\"catalog\" name=\"detail-tag-id-3\" text=\"目录\"><div class=\"formwork_bt_it\"><span>部分目录</span></div><div class=\"con\">LAMP兄弟连 无兄弟，不编程<br>前言<br><br>第1部分 Web开发入门篇<br>第1章 LAMP网站构建<br>第2章 HTML的设计与应用<br>第3章 层叠样式表CSS<br>第4章 DIV+CSS网页标准化布局<br>第2部分 PHP基础篇<br>第5章 从搭建你的PHP开发环境开始<br>第6章 PHP的基本语法<br>第7章 PHP的流程控制结构<br>第8章 PHP的函数应用<br>第9章 PHP中的数组与数据结构<br>第10章 PHP面向对象的程序设计<br>第11章 字符串处理<br>第12章 正则表达式<br>第3部分 PHP常用功能模块篇<br>第13章 PHP的错误和异常处理<br>第14章 PHP的日期和时间<br>第15章 文件系统处理<br>第16章 PHP动态图像处理<br>第4部分 数据库开发篇<br>第17章 MySQL数据库概述<br>第18章 MySQL数据表的设计<br>第19章 SQL语句设计<br>第20章 PHP访问MySQL的扩展函数<br>第21章 数据库抽象层PDO<br>第5部分 PHP开发高级篇<br>第22章 MemCache管理与应用<br>第23章 会话控制<br>第24章 PHP的模板引擎Smarty<br>第25章 MVC模式与PHP框架<br>第26章 超轻量级PHP框架BroPHP<br>第6部分 项目开发篇<br>第27章 B/S结构软件开发流程<br>第28章 需求分析说明书<br>第29章 数据库设计说明书<br>第30章 程序设计说明书<br>附录<br>附录A 编码规范<br>附录B PHP的安全和优化</div><p><br></p><p><br></p></div><div class=\"formwork_bt\" id=\"mediaComments\" name=\"detail-tag-id-4\" text=\"媒体评论\"><div class=\"formwork_bt_it\"><span>媒体评论</span></div><div class=\"con\">　　本书内容充实，是作者多年丰富PHP授课经验的总结，为初学者首选教材。&nbsp;<br>　　——腾讯开放平台副总经理/腾讯云平台负责人 陈磊&nbsp;<br><br>　　敏捷高效开发是PHP的一大特性，从书中掌握设计思想，学而实习，必将获益匪浅。&nbsp;<br>　　——盛大云北京研发部经理/PHPCMS负责人 王参加&nbsp;<br><br>　　此书对于PHP爱好者，可谓一本好书，内容详尽实用，结构组织符合实战需求，我诚挚推荐。&nbsp;<br>　　——北京4399轻电商团队技术总监 张宴&nbsp;<br><br>　　内容详尽，由浅入深，覆盖全面，藏经之作。&nbsp;<br>　　——Think PHP框架创始人 刘晨</div></div>', '10', '1', '0', '0');
INSERT INTO `goods` VALUES ('16', '19', 'Apple iPhone 7 Plus 128G 红色特别版 移动联通电信4G手机', '6388.00', '5bd3ac9f9e18568ae9387531eb97ce36.jpg', 'Apple', '<ul class=\"parameter2 p-parameter-list\"><li title=\"AppleiPhone7 Plus\">商品名称：AppleiPhone7 Plus</li><li title=\"3995645\">商品编号：3995645</li><li title=\"480.00g\">商品毛重：480.00g</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"苹果（IOS）\">系统：苹果（IOS）</li><li title=\"后置双摄像头\">后置摄像头像素：后置双摄像头</li><li title=\"128GB\">机身内存：128GB</li><li title=\"后置双摄像头\">热点：后置双摄像头</li></ul>', '10', '1', '0', '0');
INSERT INTO `goods` VALUES ('17', '44', '奥克斯（AUX）正1.5匹 冷暖 定速 空调挂机(KFR-35GW/HFJ+3)', '1999.00', '63cadd29beb6b4afd976186d2ee31955.jpg', '奥克斯（AUX）', '<ul class=\"parameter2 p-parameter-list\"><li title=\"奥克斯KFR-35GW/HFJ+3\">商品名称：奥克斯KFR-35GW/HFJ+3</li><li title=\"1311928\">商品编号：1311928</li><li title=\"13.5kg\">商品毛重：13.5kg</li><li title=\"中国大陆\">商品产地：中国大陆</li><li title=\"定频\">变频/定频：定频</li><li title=\"冷暖空调\">冷暖类型：冷暖空调</li><li title=\"自动清洁\">产品特色：自动清洁</li><li title=\"白色有花纹\">内机颜色：白色有花纹</li><li title=\"1.5匹\">商品匹数：1.5匹</li><li title=\"三级能效\">能效等级：三级能效</li><li title=\"15-20㎡\">使用面积：15-20㎡</li><li title=\"壁挂式空调\">空调类别：壁挂式空调</li></ul>', '10', '1', '0', '0');
INSERT INTO `goods` VALUES ('18', '87', '澳贝（AUBY） 益智玩具 手指总动员 婴幼儿童运动爬行健身早教启智 463314DS', '49.00', 'e9b2b13684c976832f646674da3f10a6.jpg', '澳贝（AUBY）', '<ul class=\"parameter2 p-parameter-list\"><li title=\"澳贝启智系列\">商品名称：澳贝启智系列</li><li title=\"1094081\">商品编号：1094081</li><li title=\"0.55kg\">商品毛重：0.55kg</li><li title=\"中国广东\">商品产地：中国广东</li><li title=\"463314DS\">货号：463314DS</li><li title=\"塑料\">材质：塑料</li><li title=\"盒装\">包装：盒装</li><li title=\"7-12个月\">适用年龄：7-12个月</li><li title=\"早教机/故事机\">分类：早教机/故事机</li></ul>', '10', '1', '0', '0');
INSERT INTO `goods` VALUES ('19', '88', '杜蕾斯 避孕套 男用 安全套 超薄 计生用品 情爱四合一 32只装 成人用品 Durex', '0.00', '5c52bc29ac99442b206a6a337ed0d808.jpg', '杜蕾斯（Durex）', '<ul class=\"parameter2 p-parameter-list\"><li title=\"杜蕾斯安全避孕\">商品名称：杜蕾斯安全避孕</li><li title=\"1340204\">商品编号：1340204</li><li title=\"110.00g\">商品毛重：110.00g</li><li title=\"青岛\">商品产地：青岛</li><li title=\"其它\">数量：其它</li><li title=\"标准\">尺寸：标准</li><li title=\"超薄\">分类：超薄</li><li title=\"乳胶\">原料：乳胶</li><li title=\"国产\">国产/进口：国产</li></ul>', '5', '1', '0', '0');
INSERT INTO `goods` VALUES ('20', '84', '韩磊', '9.99', '83d00e456adcf4f5251bc165ba7baf78.jpg', 'made in china', '只要999，韩磊带回家，白天么么哒，晚上、。。。。。', '12', '1', '0', '1');

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `display` tinyint(3) unsigned DEFAULT '1',
  `is_del` tinyint(4) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of link
-- ----------------------------
INSERT INTO `link` VALUES ('1', '谷歌', 'http://www.google.com', '0', '0');
INSERT INTO `link` VALUES ('3', '淘宝', 'http://www.taobao.com', '1', '0');
INSERT INTO `link` VALUES ('4', '百度', 'http://www.baidu.com', '1', '0');
INSERT INTO `link` VALUES ('6', '联系我们', 'http://', '1', '0');
INSERT INTO `link` VALUES ('7', '联系客服', 'http://', '1', '0');
INSERT INTO `link` VALUES ('8', '合作招商', 'http://', '1', '0');
INSERT INTO `link` VALUES ('9', '商家帮助', 'http://', '1', '0');
INSERT INTO `link` VALUES ('10', '营销中心', 'http://', '1', '0');
INSERT INTO `link` VALUES ('11', '手机京东', 'http://', '1', '0');
INSERT INTO `link` VALUES ('12', '友情链接', 'http://', '1', '0');
INSERT INTO `link` VALUES ('13', '销售联盟', 'http://', '0', '0');
INSERT INTO `link` VALUES ('14', '京东社区', 'http://', '1', '0');
INSERT INTO `link` VALUES ('15', '风险监测', 'http://', '1', '0');
INSERT INTO `link` VALUES ('16', '隐私政策', 'http://', '1', '0');
INSERT INTO `link` VALUES ('17', '京东公益', 'http://', '0', '0');
INSERT INTO `link` VALUES ('18', 'English Site', 'http://', '0', '0');
INSERT INTO `link` VALUES ('19', 'Media & IR', 'http://', '0', '0');
INSERT INTO `link` VALUES ('20', '兄弟连教育', 'http://www.itxdl.cn', '1', '0');
INSERT INTO `link` VALUES ('23', '康维的博客', 'http://www.zhangzhiwei.net.cn', '1', '0');
INSERT INTO `link` VALUES ('24', 'zhaoritian', 'http://', '1', '0');

-- ----------------------------
-- Table structure for orderinfo
-- ----------------------------
DROP TABLE IF EXISTS `orderinfo`;
CREATE TABLE `orderinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oid` char(30) NOT NULL,
  `gid` int(11) NOT NULL,
  `gname` varchar(255) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `gnum` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orderinfo
-- ----------------------------
INSERT INTO `orderinfo` VALUES ('8', '2017092101241382', '6', '京东自营 2件9.8折】花花公子（PLAYBOY）休闲裤 男2017哈伦裤秋装新款潮流韩版修身小脚裤 17095PLTX703 黑色 XL', '99.00', '1', '1', '1505928253');
INSERT INTO `orderinfo` VALUES ('9', '2017092101241382', '10', 'TCL 55A950C 55英寸32核人工智能 HDR曲面超薄4K电视金属机身（枪色）', '4399.00', '2', '1', '1505928253');
INSERT INTO `orderinfo` VALUES ('10', '2017092102164131', '7', '阿什兰 2017夏装新款露肩短袖连衣裙 收腰小清新白色女装短裙显瘦印花圆领裙子女 树叶花 M', '149.00', '1', '1', '1505931401');
INSERT INTO `orderinfo` VALUES ('11', '2017092109112167', '8', '预售 全球购 苹果(Apple)iPhone X 移动联通 海外版 5.8英寸 深空灰色256GB', '19999.99', '5', '27', '1505956281');
INSERT INTO `orderinfo` VALUES ('12', '2017092109112167', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '7', '27', '1505956281');
INSERT INTO `orderinfo` VALUES ('13', '2017092110291467', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '1', '1', '1505960954');
INSERT INTO `orderinfo` VALUES ('14', '2017092115050263', '9', '海信（Hisense）LED55EC780UC 55英寸 曲面4K智能平板电视 HDR动态显示 64位14核处理', '4398.00', '1', '19', '1505977502');
INSERT INTO `orderinfo` VALUES ('15', '2017092115311722', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '1', '1', '1505979077');
INSERT INTO `orderinfo` VALUES ('16', '2017092115315144', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '1', '1', '1505979111');
INSERT INTO `orderinfo` VALUES ('17', '2017092115322517', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '27', '28', '1505979145');
INSERT INTO `orderinfo` VALUES ('18', '2017092115324151', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '27', '28', '1505979161');
INSERT INTO `orderinfo` VALUES ('19', '2017092115524192', '11', '夏普 (SHARP) LCD-50SU460A 50英寸4K超高清wifi智能网络液晶平板电视机（黑色）', '3099.00', '1', '28', '1505980361');
INSERT INTO `orderinfo` VALUES ('20', '2017092119102131', '14', '跟兄弟连学PHP（附光盘）', '83.30', '1', '1', '1505992221');
INSERT INTO `orderinfo` VALUES ('21', '2017092119112420', '14', '跟兄弟连学PHP（附光盘）', '83.30', '1', '1', '1505992284');
INSERT INTO `orderinfo` VALUES ('22', '2017092121092886', '9', '海信（Hisense）LED55EC780UC 55英寸 曲面4K智能平板电视 HDR动态显示 64位14核处理', '4398.00', '4', '34', '1505999368');
INSERT INTO `orderinfo` VALUES ('23', '2017092121092886', '17', '奥克斯（AUX）正1.5匹 冷暖 定速 空调挂机(KFR-35GW/HFJ+3)', '1999.00', '3', '34', '1505999368');
INSERT INTO `orderinfo` VALUES ('24', '2017092212132351', '20', '韩磊', '9.99', '2', '1', '1506053603');
INSERT INTO `orderinfo` VALUES ('25', '2017092212132351', '14', '跟兄弟连学PHP（附光盘）', '83.30', '2', '1', '1506053603');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` char(30) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `linkman` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `postcode` char(6) DEFAULT NULL,
  `total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0 等待支付 1 已支付 2 已发货	3 已收货 4',
  `addtime` int(10) unsigned NOT NULL,
  `is_del` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('2017092119102131', '1', 'sdf', 'dsfsd', '12', '12', '83.30', '4', '1505992221', '1');
INSERT INTO `orders` VALUES ('2017092101241382', '1', '测试', '测试test', '123456', '123456', '8897.00', '4', '1505928253', '1');
INSERT INTO `orders` VALUES ('2017092110291467', '1', '王鹏', '太原兄弟连', '132456', '123456', '3099.00', '4', '1505960954', '1');
INSERT INTO `orders` VALUES ('2017092115050263', '19', '郭波', '太原市兄弟连', '1311111111', '123456', '4398.00', '3', '1505977502', '0');
INSERT INTO `orders` VALUES ('2017092115311722', '1', 'dfsdf', 'sdfrwesf', '1223345', '234234', '3099.00', '1', '1505979077', '0');
INSERT INTO `orders` VALUES ('2017092115315144', '1', 'esfr', 'qwrewe', '234324', '32434', '3099.00', '1', '1505979111', '0');
INSERT INTO `orders` VALUES ('2017092115324151', '28', '1111111111', '1111111111111111', '111111', '111111', '83673.00', '3', '1505979161', '0');
INSERT INTO `orders` VALUES ('2017092115524192', '28', '1', '1', '1', '111111', '3099.00', '4', '1505980361', '1');
INSERT INTO `orders` VALUES ('2017092119112420', '1', 'ergt', '213', '12', '213', '83.30', '1', '1505992284', '0');
INSERT INTO `orders` VALUES ('2017092121092886', '34', 'skadsaj', 'taiyuan', '123421321', '11111', '23589.00', '3', '1505999368', '0');
INSERT INTO `orders` VALUES ('2017092212132351', '1', '赵化育', '123123a1d23as132dsad', '132123', '123123', '186.58', '0', '1506053603', '0');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '0,',
  `display` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('25', '家用电器', '0', '0,', '1');
INSERT INTO `type` VALUES ('10', '手机 / 数码', '0', '0,', '1');
INSERT INTO `type` VALUES ('26', '女装 / 鞋包 / 钟表 / 珠宝', '0', '0,', '1');
INSERT INTO `type` VALUES ('27', '男鞋 / 运动 / 户外', '0', '0,', '1');
INSERT INTO `type` VALUES ('28', '母婴 / 玩具乐器', '0', '0,', '1');
INSERT INTO `type` VALUES ('12', '电脑 / 办公', '0', '0,', '1');
INSERT INTO `type` VALUES ('13', '家具 / 家居 / 家装 / 厨具', '0', '0,', '1');
INSERT INTO `type` VALUES ('15', '美妆个护 / 宠物', '0', '0,', '1');
INSERT INTO `type` VALUES ('14', '男装 / 女装 / 童装 / 内衣', '0', '0,', '1');
INSERT INTO `type` VALUES ('16', '汽车 / 汽车用品', '0', '0,', '1');
INSERT INTO `type` VALUES ('19', '华为', '10', '0,10,', '1');
INSERT INTO `type` VALUES ('42', '55英寸', '35', '0,25,35,', '1');
INSERT INTO `type` VALUES ('29', '食品 / 酒类 / 生鲜 / 特产', '0', '0,', '1');
INSERT INTO `type` VALUES ('41', '荣耀v9', '19', '0,10,19,', '1');
INSERT INTO `type` VALUES ('30', '礼品鲜花 / 农资绿植', '0', '0,', '1');
INSERT INTO `type` VALUES ('31', '医疗保健 / 计生情趣', '0', '0,', '1');
INSERT INTO `type` VALUES ('32', '图书 / 音像 / 电子书', '0', '0,', '1');
INSERT INTO `type` VALUES ('33', '机票 / 酒店 / 旅游 / 生活', '0', '0,', '1');
INSERT INTO `type` VALUES ('34', '理财 / 众筹 / 白条 / 保险', '0', '0,', '0');
INSERT INTO `type` VALUES ('35', '电视', '25', '0,25,', '1');
INSERT INTO `type` VALUES ('36', '曲面电视', '35', '0,25,35,', '1');
INSERT INTO `type` VALUES ('37', '超薄电视', '35', '0,25,35,', '1');
INSERT INTO `type` VALUES ('38', 'HDR电视', '35', '0,25,35,', '1');
INSERT INTO `type` VALUES ('39', 'OLED电视', '35', '0,25,35,', '1');
INSERT INTO `type` VALUES ('40', '4K超清电视', '35', '0,25,35,', '1');
INSERT INTO `type` VALUES ('43', '空调', '25', '0,25,', '1');
INSERT INTO `type` VALUES ('44', '壁挂式空调', '43', '0,25,43,', '1');
INSERT INTO `type` VALUES ('45', '女装', '14', '0,14,', '1');
INSERT INTO `type` VALUES ('46', '男装', '14', '0,14,', '1');
INSERT INTO `type` VALUES ('47', '内衣', '14', '0,14,', '1');
INSERT INTO `type` VALUES ('48', '配饰', '14', '0,14,', '1');
INSERT INTO `type` VALUES ('49', '当季热卖', '46', '0,14,46,', '1');
INSERT INTO `type` VALUES ('50', '柜式空调', '43', '0,25,43,', '1');
INSERT INTO `type` VALUES ('51', '中央空调', '43', '0,25,43,', '1');
INSERT INTO `type` VALUES ('52', '以旧换新', '43', '0,25,43,', '1');
INSERT INTO `type` VALUES ('53', '0元安装', '43', '0,25,43,', '1');
INSERT INTO `type` VALUES ('54', '空调配件', '43', '0,25,43,', '1');
INSERT INTO `type` VALUES ('55', '洗衣机', '25', '0,25,', '1');
INSERT INTO `type` VALUES ('56', '滚筒洗衣机', '55', '0,25,55,', '1');
INSERT INTO `type` VALUES ('57', '洗烘一体机', '55', '0,25,55,', '1');
INSERT INTO `type` VALUES ('58', '波轮洗衣机', '55', '0,25,55,', '1');
INSERT INTO `type` VALUES ('59', '迷你洗衣机', '55', '0,25,55,', '1');
INSERT INTO `type` VALUES ('60', '烘干机', '55', '0,25,55,', '1');
INSERT INTO `type` VALUES ('61', '洗衣机配件', '55', '0,25,55,', '1');
INSERT INTO `type` VALUES ('62', '冰箱', '25', '0,25,', '1');
INSERT INTO `type` VALUES ('63', '多门', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('64', '对开门', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('65', '三门', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('66', '双门', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('67', '冷柜/冰吧', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('68', '酒柜', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('69', '冰箱配件', '62', '0,25,62,', '1');
INSERT INTO `type` VALUES ('70', '厨卫大电', '25', '0,25,', '1');
INSERT INTO `type` VALUES ('71', '油烟机', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('72', '燃气灶', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('73', '烟灶套装', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('74', '消毒柜', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('75', '洗碗机', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('76', '电热水器', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('77', '燃气热水器', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('78', '嵌入式厨电', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('79', '商用厨房电器', '70', '0,25,70,', '1');
INSERT INTO `type` VALUES ('80', '电脑整机', '12', '0,12,', '1');
INSERT INTO `type` VALUES ('81', '笔记本', '80', '0,12,80,', '1');
INSERT INTO `type` VALUES ('82', '游戏本', '80', '0,12,80,', '1');
INSERT INTO `type` VALUES ('84', 'Apple', '10', '0,10,', '1');
INSERT INTO `type` VALUES ('85', '编程语言与程序', '32', '0,32,', '1');
INSERT INTO `type` VALUES ('86', 'PHP', '85', '0,32,85,', '1');
INSERT INTO `type` VALUES ('87', '6-12个月', '28', '0,28,', '1');
INSERT INTO `type` VALUES ('88', '避孕套', '31', '0,31,', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL,
  `password` char(32) NOT NULL,
  `level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0普通会员   1 普通管理员 2 超级管理员 3-禁止',
  `addtime` int(10) unsigned NOT NULL,
  `is_del` tinyint(3) unsigned DEFAULT '0' COMMENT '0为未删除1为已删除',
  `login_num` int(11) unsigned DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2', '1505205344', '0', '160', '1506080437');
INSERT INTO `user` VALUES ('7', 'test8', 'e10adc3949ba59abbe56e057f20f883e', '0', '1505393386', '0', '20', '1505875840');
INSERT INTO `user` VALUES ('8', 'admin2', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879220', '0', '0', null);
INSERT INTO `user` VALUES ('9', 'admin3', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879268', '0', '0', null);
INSERT INTO `user` VALUES ('10', 'admin', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879405', '0', '0', null);
INSERT INTO `user` VALUES ('11', 'admin4', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879411', '0', '0', null);
INSERT INTO `user` VALUES ('12', 'admin5', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879430', '0', '1', '1505879439');
INSERT INTO `user` VALUES ('13', 'admin6', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879516', '0', '0', null);
INSERT INTO `user` VALUES ('14', 'admin7', '21232f297a57a5a743894a0e4a801fc3', '0', '1505879584', '0', '0', null);
INSERT INTO `user` VALUES ('15', 'admin8', '21232f297a57a5a743894a0e4a801fc3', '0', '1505885834', '0', '0', null);
INSERT INTO `user` VALUES ('16', 'admin9', '21232f297a57a5a743894a0e4a801fc3', '0', '1505886285', '0', '1', '1505886524');
INSERT INTO `user` VALUES ('17', 'admin10', '21232f297a57a5a743894a0e4a801fc3', '0', '1505886534', '0', '1', '1505886544');
INSERT INTO `user` VALUES ('18', 'admin11', '21232f297a57a5a743894a0e4a801fc3', '0', '1505886582', '0', '7', '1506053542');
INSERT INTO `user` VALUES ('19', 'admin12', '21232f297a57a5a743894a0e4a801fc3', '0', '1505904520', '0', '3', '1505977831');
INSERT INTO `user` VALUES ('20', 'admin13', '21232f297a57a5a743894a0e4a801fc3', '0', '1505904573', '0', '1', '1505904578');
INSERT INTO `user` VALUES ('21', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '0', '1505904700', '0', '0', null);
INSERT INTO `user` VALUES ('23', 'asdasdasd', 'a8f5f167f44f4964e6c998dee827110c', '0', '1505904713', '0', '0', null);
INSERT INTO `user` VALUES ('24', '1111111111111', '2b97cb3305e4b85ba2ba904cecff5601', '0', '1505904718', '0', '0', null);
INSERT INTO `user` VALUES ('25', 'wang123', '328e587f0d908c02f3bd479c4f710520', '0', '1505904746', '0', '0', null);
INSERT INTO `user` VALUES ('27', '佘宇翔', '5e2c4055b9c33c6959972ea11fe980ee', '0', '1505956226', '0', '1', '1505956237');

-- ----------------------------
-- Table structure for userinfo
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `uid` int(11) unsigned NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `age` tinyint(3) unsigned DEFAULT NULL,
  `sex` tinyint(3) unsigned DEFAULT NULL COMMENT '0 女 1男 2保密',
  `phone` char(11) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
INSERT INTO `userinfo` VALUES ('1', '肯定会空间啊是的', '12', '1', '11', '11@1111', 'ac8abec427a82836c95ee4504a29326e.jpg', '1,2,4,5,9,10,12', '太原市');
INSERT INTO `userinfo` VALUES ('7', '康维', '21', '1', '15635058664', 'code_zhang@163.com', '7c45e2c65e70ef21b17471af183518d7.jpg', '3,4', '太原市1');
INSERT INTO `userinfo` VALUES ('10', '', null, null, '', null, '', '', '');
INSERT INTO `userinfo` VALUES ('19', '郝效敏', '18', '2', '123456789', 'abc@abc.com', 'bfd6e46ca0793b5006076139ceb7262a.jpg', '2,3', '泰国');
INSERT INTO `userinfo` VALUES ('33', '韩磊', '99', '0', '123456', 'a@a.a', '9145f78e36269374494fb5df142d5a9b.jpg', '1', '太原兄弟了');
