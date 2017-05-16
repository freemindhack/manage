/*
SQLyog Trial
MySQL - 5.5.40 : Database - manage
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `BookIn` */

CREATE TABLE `BookIn` (
  `sid` varchar(255) NOT NULL,
  `UID` varchar(255) NOT NULL,
  `arriveTime` datetime NOT NULL,
  `custonerName` varchar(255) DEFAULT NULL,
  `paxNumber` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `upLoadTime` datetime NOT NULL,
  `IsDel` bit(20) NOT NULL DEFAULT b'0',
  `ShopId` varchar(255) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `CardRecord` */

CREATE TABLE `CardRecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(255) NOT NULL COMMENT '客户端的主键',
  `uid` varchar(255) NOT NULL COMMENT '商户ID',
  `shopId` varchar(255) NOT NULL COMMENT '店铺ID',
  `SYYId` varchar(255) NOT NULL COMMENT '收银员ID',
  `deviceNo` varchar(255) NOT NULL COMMENT '收银机号',
  `OrderNo` varchar(255) NOT NULL COMMENT '订单号',
  `OrderTime_Time` datetime NOT NULL COMMENT '订单时间',
  `cardUid` varchar(255) NOT NULL COMMENT 'M1卡唯一ID',
  `cardNo` varchar(255) NOT NULL COMMENT '卡号',
  `cardOldAmount` varchar(255) NOT NULL COMMENT '交易前可用金额',
  `cardNowAmount` varchar(255) NOT NULL COMMENT '交易后可用金额',
  `cardMortgage` varchar(255) NOT NULL COMMENT '卡押金',
  `OrderAmount` varchar(255) NOT NULL COMMENT '订单金额',
  `UpLoadTime_Time` datetime NOT NULL COMMENT '上传时间',
  `HandlerTime` varchar(255) NOT NULL COMMENT '该条记录处理时间',
  `flag` int(255) NOT NULL COMMENT '是否处理  0：未处理 1：已处理',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `Cashier` */

CREATE TABLE `Cashier` (
  `Sid` varchar(255) NOT NULL,
  `UId` varchar(255) NOT NULL,
  `Number` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PassWord` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `IsAdmin` int(11) NOT NULL DEFAULT '0',
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `ShopId` varchar(255) NOT NULL,
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Category` */

CREATE TABLE `Category` (
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `colorCode` varchar(255) DEFAULT NULL,
  `orderBy` int(11) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `City` */

CREATE TABLE `City` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `FirstLetter` varchar(1) DEFAULT NULL,
  `ProId` int(11) NOT NULL,
  `IsDel` bit(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Device` */

CREATE TABLE `Device` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Uid` varchar(255) NOT NULL,
  `Imei` varchar(255) NOT NULL,
  `Number` int(11) NOT NULL,
  `CreateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;

/*Table structure for table `District` */

CREATE TABLE `District` (
  `sid` varchar(255) NOT NULL,
  `index` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `ShopId` varchar(255) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `FreezeCard` */

CREATE TABLE `FreezeCard` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CardNo` varchar(255) NOT NULL,
  `Note` text NOT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `IPCAM` */

CREATE TABLE `IPCAM` (
  `Id` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Did` varchar(255) NOT NULL,
  `PWD` varchar(255) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Note` text,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `Inventory` */

CREATE TABLE `Inventory` (
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Pid` varchar(255) NOT NULL,
  `Wid` varchar(255) NOT NULL,
  `Number` int(11) NOT NULL,
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Inventory_Log` */

CREATE TABLE `Inventory_Log` (
  `id` varchar(255) NOT NULL,
  `uId` varchar(255) NOT NULL,
  `wId` varchar(255) NOT NULL,
  `wName` varchar(255) NOT NULL,
  `pId` varchar(255) NOT NULL,
  `pName` varchar(255) NOT NULL,
  `oldCount` int(11) NOT NULL COMMENT '原有数量',
  `changeCount` int(11) NOT NULL COMMENT '变更数量',
  `newCount` int(11) NOT NULL COMMENT '变更后的数量',
  `logType` int(11) NOT NULL COMMENT '日志类型 1.销售(包括销售和退货) 2.入库 3.下架 4.盘点修正',
  `logTypeDescribe` varchar(255) NOT NULL COMMENT '日志类型描述',
  `createTime` datetime NOT NULL COMMENT '发生时间',
  `note` text NOT NULL COMMENT '备注',
  `isDel` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否已经删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `JKD_Detail` */

CREATE TABLE `JKD_Detail` (
  `sid` varchar(255) NOT NULL,
  `jkSid` varchar(255) NOT NULL,
  `payMoney` double NOT NULL,
  `payType` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `JKD_Head` */

CREATE TABLE `JKD_Head` (
  `sid` varchar(255) NOT NULL,
  `no` int(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `shopId` varchar(255) NOT NULL,
  `deviceId` varchar(255) NOT NULL,
  `cashierNo` varchar(255) NOT NULL,
  `jkMoney` float NOT NULL,
  `jkDate_D` datetime NOT NULL,
  `note` text,
  `upLoadTime_D` datetime NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Line0_Detail` */

CREATE TABLE `Line0_Detail` (
  `itemId` bigint(11) NOT NULL,
  `orderId` bigint(11) NOT NULL,
  `isStockOut` int(11) NOT NULL,
  `itemAmount` float NOT NULL,
  `itemCount` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `propertyOneDictValue` varchar(255) NOT NULL,
  `propertyTwoDictValue` varchar(255) NOT NULL,
  `itemRemarkStr` varchar(255) NOT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Line0_Order` */

CREATE TABLE `Line0_Order` (
  `orderId` bigint(11) NOT NULL,
  `orderCode` varchar(255) NOT NULL,
  `createTime` varchar(255) NOT NULL,
  `orderConfirmTime` varchar(255) NOT NULL,
  `orderCount` int(11) NOT NULL,
  `orderAmount` float NOT NULL,
  `goodAmount` float NOT NULL,
  `orderStatus` int(11) NOT NULL,
  `acceptCsOrderStatus` int(11) NOT NULL,
  `deliveryMethod` int(11) NOT NULL,
  `receiverAddress` varchar(255) NOT NULL,
  `receiverMobile` varchar(255) NOT NULL,
  `goodReceiver` varchar(255) NOT NULL,
  `orderDeliveryCost` float NOT NULL,
  `orderBookingType` int(11) NOT NULL,
  `isLossOrder` bit(1) NOT NULL DEFAULT b'0',
  `unPayAmount` float NOT NULL,
  `waitingTime` varchar(255) NOT NULL,
  `csRemark` varchar(255) NOT NULL,
  `customerRemark` varchar(255) NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Menus` */

CREATE TABLE `Menus` (
  `Sid` varchar(255) NOT NULL,
  `UId` varchar(255) DEFAULT NULL,
  `category_sid` varchar(255) DEFAULT NULL,
  `colorCode` varchar(255) DEFAULT NULL,
  `group_sid` varchar(320) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `CostPrice` double NOT NULL DEFAULT '0',
  `unit` varchar(255) NOT NULL,
  `mainPrinterSid` varchar(255) DEFAULT NULL,
  `backPrinterSid` varchar(255) DEFAULT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `createTime` datetime NOT NULL,
  `orderBy` int(11) NOT NULL,
  `isHide` bit(1) NOT NULL DEFAULT b'0',
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `Code_bm` varchar(255) NOT NULL DEFAULT '' COMMENT '商品编码',
  `specification` varchar(255) DEFAULT NULL COMMENT '商品规格',
  `valuationType` int(1) NOT NULL DEFAULT '0' COMMENT '计价类型  0:按件卖  1:计重',
  `genre` int(1) NOT NULL DEFAULT '0' COMMENT '商品产生类型 0：自制  1：外购',
  `setFlag` bit(1) NOT NULL DEFAULT b'0' COMMENT '是不是套餐',
  `setPids` text COMMENT '套餐包含商品的sid，逗号分隔',
  `setOldPrice` double DEFAULT NULL COMMENT '套餐原始价格'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Menus_Supplier` */

CREATE TABLE `Menus_Supplier` (
  `id` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `No` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `Modified` */

CREATE TABLE `Modified` (
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `GroupSid` varchar(255) NOT NULL,
  `Price` double NOT NULL,
  `CostPrice` double NOT NULL DEFAULT '0',
  `unit` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `colorCode` varchar(255) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `orderBy` int(11) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `ModifiedGroup` */

CREATE TABLE `ModifiedGroup` (
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `option` int(11) NOT NULL,
  `orderBy` int(11) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `O2OToken` */

CREATE TABLE `O2OToken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uId` varchar(255) NOT NULL,
  `shopId` bigint(11) NOT NULL COMMENT '店铺ID',
  `shopName` varchar(255) NOT NULL,
  `o2oType` int(11) NOT NULL COMMENT '0:零号线  1:微信  2:饿了没',
  `accessToken` varchar(255) NOT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `Order` */

CREATE TABLE `Order` (
  `Id` varchar(255) NOT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `shopNo` varchar(255) DEFAULT NULL COMMENT '店铺号',
  `cashNo` varchar(255) DEFAULT NULL COMMENT '收银机号',
  `no` int(11) NOT NULL COMMENT '小票号',
  `remoney` double NOT NULL COMMENT '应收',
  `acmoney` double DEFAULT NULL COMMENT '实收',
  `cgmoney` double DEFAULT NULL COMMENT '找零',
  `yyMoney` double DEFAULT NULL COMMENT '收银损益',
  `discount` double DEFAULT NULL COMMENT '折扣金额',
  `discountType` int(11) DEFAULT NULL COMMENT '折扣类型',
  `singleDiscount` double DEFAULT NULL COMMENT '单品折扣额',
  `totalDiscount` double DEFAULT NULL COMMENT '整单折扣额',
  `by` varchar(255) DEFAULT NULL COMMENT '收银员号',
  `cashName` varchar(255) DEFAULT NULL COMMENT '收银员名',
  `serverNo` varchar(255) DEFAULT NULL COMMENT '服务员号',
  `serverName` varchar(255) DEFAULT NULL COMMENT '服务员名',
  `tableId` varchar(255) DEFAULT NULL COMMENT '餐桌id',
  `tableNo` varchar(255) DEFAULT NULL COMMENT '餐桌号',
  `totalNumer` int(11) DEFAULT NULL COMMENT '就餐人数',
  `saleMethod` int(11) DEFAULT NULL COMMENT '销售方式',
  `type` int(11) DEFAULT NULL COMMENT '交易类型：销售 退货',
  `kdType` int(11) DEFAULT NULL COMMENT '开单类型',
  `paxNumber` int(11) DEFAULT NULL COMMENT '本单商品数量',
  `memberNo` varchar(255) DEFAULT NULL COMMENT '会员号',
  `imel` varchar(255) DEFAULT NULL COMMENT '设备唯一识别码',
  `startTime` datetime NOT NULL COMMENT '开单时间',
  `endTime` datetime DEFAULT NULL COMMENT '结束时间',
  `status` int(11) NOT NULL COMMENT '订单状态',
  `obj1` varchar(255) DEFAULT NULL,
  `obj2` varchar(255) DEFAULT NULL,
  `obj3` varchar(255) DEFAULT NULL,
  `obj4` varchar(255) DEFAULT NULL,
  `obj5` varchar(255) DEFAULT NULL,
  `UpLoadTime` datetime NOT NULL COMMENT '上传时间',
  `IsClear` bit(1) NOT NULL DEFAULT b'0' COMMENT '是否处理',
  `obj6` varchar(255) DEFAULT NULL,
  `obj7` varchar(255) DEFAULT NULL,
  `obj8` varchar(255) DEFAULT NULL,
  `obj9` varchar(255) DEFAULT NULL,
  `obj10` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Order_Menus` */

CREATE TABLE `Order_Menus` (
  `Id` varchar(255) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `order_sid` varchar(255) DEFAULT NULL COMMENT 'order表的sid',
  `lineNum` int(11) DEFAULT NULL COMMENT '行号',
  `serverNo` varchar(255) DEFAULT NULL COMMENT '服务员编号',
  `serverName` varchar(255) DEFAULT NULL COMMENT '服务员姓名',
  `menus_sid` varchar(255) DEFAULT NULL COMMENT '商品的sid',
  `menus_name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `m_price` double DEFAULT NULL COMMENT '商品单价',
  `price` double DEFAULT NULL COMMENT '商品总价',
  `saleprice` double DEFAULT NULL COMMENT '销售总价',
  `number` int(11) DEFAULT NULL COMMENT '商品数量',
  `discount` double DEFAULT NULL,
  `discountType` int(11) DEFAULT NULL,
  `singleDiscount` double DEFAULT NULL,
  `totalDiscount` double DEFAULT NULL,
  `discountCode` varchar(255) DEFAULT NULL COMMENT '折扣碼',
  `terminalNum` varchar(255) DEFAULT NULL COMMENT '终端号/设备号',
  `saleMethod` int(11) DEFAULT NULL COMMENT '销售方式',
  `exception` int(11) DEFAULT NULL COMMENT '销售异常',
  `callCount` int(11) DEFAULT NULL COMMENT '催单次数',
  `type` int(11) DEFAULT NULL COMMENT '交易类型：销售 退货',
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  `obj1` varchar(255) DEFAULT NULL,
  `obj2` varchar(255) DEFAULT NULL,
  `obj3` varchar(255) DEFAULT NULL,
  `obj4` varchar(255) DEFAULT NULL,
  `obj5` varchar(255) DEFAULT NULL,
  `obj6` varchar(255) DEFAULT NULL,
  `UpLoadTime` datetime NOT NULL,
  `addTime` datetime NOT NULL COMMENT '添加时间',
  `parentSid` varchar(255) DEFAULT NULL COMMENT '父id',
  `IsClear` bit(1) NOT NULL COMMENT '是否处理',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Order_PayType` */

CREATE TABLE `Order_PayType` (
  `Id` varchar(255) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `colorCode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '付款方式名',
  `order_sid` varchar(255) DEFAULT NULL COMMENT '订单sid',
  `orderBy` int(11) DEFAULT NULL COMMENT '排序',
  `payType` int(11) DEFAULT NULL COMMENT '付款类型',
  `price` double NOT NULL COMMENT '实收金额',
  `price_zl` double NOT NULL DEFAULT '0' COMMENT '找零金额',
  `price_ys` double NOT NULL DEFAULT '0' COMMENT '因收金额',
  `lineNum` int(11) DEFAULT NULL COMMENT '行号',
  `payId` varchar(255) DEFAULT NULL COMMENT '付款方式id',
  `payNumber1` varchar(255) DEFAULT NULL,
  `payNumber2` varchar(255) DEFAULT NULL,
  `payNumber3` varchar(255) DEFAULT NULL,
  `obj1` varchar(255) DEFAULT NULL,
  `obj2` varchar(255) DEFAULT NULL,
  `obj4` varchar(255) DEFAULT NULL,
  `obj5` varchar(255) DEFAULT NULL,
  `UpLoadTime` datetime NOT NULL,
  `IsClear` int(1) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `PayType` */

CREATE TABLE `PayType` (
  `Sid` varchar(255) NOT NULL,
  `UId` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `colorCode` varchar(255) DEFAULT NULL,
  `orderBy` int(11) NOT NULL,
  `payType` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `AliPayUrl` text,
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `PrintTask` */

CREATE TABLE `PrintTask` (
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `ShopId` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `Port` varchar(255) NOT NULL,
  `Order_Sid` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `IsOpenBox` int(1) NOT NULL DEFAULT '0',
  `CreateTime` datetime NOT NULL,
  `PrintTime` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT '0' COMMENT '0:未处理 1:已处理 2:出错',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `PrinterSetting` */

CREATE TABLE `PrinterSetting` (
  `Sid` varchar(255) NOT NULL,
  `ShopId` varchar(255) NOT NULL,
  `Uid` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `PrinterType` */

CREATE TABLE `PrinterType` (
  `Sid` varchar(255) NOT NULL,
  `UId` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Promary` */

CREATE TABLE `Promary` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `FirstLetter` varchar(1) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Report_Order` */

CREATE TABLE `Report_Order` (
  `Id` varchar(255) NOT NULL,
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `DPH` varchar(255) DEFAULT NULL,
  `SYJH` varchar(255) DEFAULT NULL,
  `XPH` int(11) NOT NULL,
  `YS` double NOT NULL,
  `SS` double NOT NULL,
  `ZL` double NOT NULL,
  `YY` double NOT NULL,
  `ZK` double NOT NULL,
  `ZKLX` int(11) DEFAULT NULL,
  `DPZKE` double NOT NULL,
  `ZDZKE` double NOT NULL,
  `SYYH` varchar(255) NOT NULL,
  `SYYM` varchar(255) DEFAULT NULL,
  `FWYH` varchar(255) DEFAULT NULL,
  `FWYM` varchar(255) DEFAULT NULL,
  `CZID` varchar(255) DEFAULT NULL,
  `CZH` varchar(255) DEFAULT NULL,
  `ZDSPSL` int(11) DEFAULT NULL,
  `XSLX` int(11) NOT NULL,
  `DJLX` int(11) DEFAULT NULL,
  `KDFS` int(11) DEFAULT NULL,
  `RS` int(11) DEFAULT NULL,
  `HYH` varchar(255) DEFAULT NULL,
  `IMEI` varchar(255) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `yyyyMMdd` datetime NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `HH` int(11) NOT NULL,
  `mm` int(11) NOT NULL,
  `EndTime` datetime DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `obj1` varchar(255) DEFAULT NULL,
  `obj2` varchar(255) DEFAULT NULL,
  `obj3` varchar(255) DEFAULT NULL,
  `obj4` varchar(255) DEFAULT NULL,
  `obj5` varchar(255) DEFAULT NULL,
  `UpLoadTime` datetime NOT NULL,
  `CrearTime` datetime NOT NULL,
  `IsClear` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Report_Order_Menus` */

CREATE TABLE `Report_Order_Menus` (
  `Id` varchar(255) NOT NULL,
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Order_Sid` varchar(255) NOT NULL,
  `HH` int(11) DEFAULT NULL,
  `FWYH` varchar(255) DEFAULT NULL,
  `FUYM` varchar(255) DEFAULT NULL,
  `Menus_Sid` varchar(255) NOT NULL,
  `SPLX` varchar(255) DEFAULT NULL,
  `SPMC` varchar(255) NOT NULL,
  `SPDJ` double NOT NULL,
  `SPZJ` double NOT NULL,
  `YSZE` double NOT NULL,
  `YSDJ` double NOT NULL,
  `SPSL` int(11) NOT NULL,
  `ZK` double DEFAULT NULL,
  `DPZKLX` int(11) DEFAULT NULL,
  `DPZKE` double DEFAULT NULL,
  `ZDZKE` double DEFAULT NULL,
  `ZKSQM` varchar(255) DEFAULT NULL,
  `DCZDH` varchar(255) DEFAULT NULL,
  `XSLX` int(11) DEFAULT NULL,
  `YCYY` int(11) DEFAULT NULL,
  `CCCS` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `obj1` varchar(255) DEFAULT NULL,
  `obj2` varchar(255) DEFAULT NULL,
  `obj3` varchar(255) DEFAULT NULL,
  `obj4` varchar(255) DEFAULT NULL,
  `obj5` varchar(255) DEFAULT NULL,
  `obj6` varchar(255) DEFAULT NULL,
  `UpLoadTime` datetime NOT NULL,
  `Orde_CreateTime` datetime DEFAULT NULL,
  `Order_yyyyMMdd` datetime DEFAULT NULL,
  `Order_years` int(11) DEFAULT NULL,
  `Order_month` int(11) DEFAULT NULL,
  `Order_day` int(11) DEFAULT NULL,
  `Order_HH` int(11) DEFAULT NULL,
  `Order_mm` int(11) DEFAULT NULL,
  `ClearTime` datetime NOT NULL,
  `parentSid` varchar(255) DEFAULT NULL,
  `IsClear` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `Shop` */

CREATE TABLE `Shop` (
  `Id` varchar(255) NOT NULL,
  `UId` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Coordinates` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Contacts` varchar(255) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `TopTemplate` text NOT NULL,
  `BottomTemplate` text NOT NULL,
  `Wid` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `SumAmount` */

CREATE TABLE `SumAmount` (
  `Id` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `RQ` datetime NOT NULL,
  `XSJE` double NOT NULL,
  `ZKJE` double NOT NULL,
  `XSSR` double NOT NULL,
  `KXFE` double NOT NULL COMMENT '卡消费金额',
  `DJJJE` double NOT NULL DEFAULT '0' COMMENT '代金卷金额',
  `AliJE` double NOT NULL COMMENT '支付宝消费金额',
  `WXJE` double NOT NULL COMMENT '微信消费金额',
  `DPH` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `SuperSysMenus` */

CREATE TABLE `SuperSysMenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `tag` int(11) DEFAULT NULL,
  `hide` bit(1) NOT NULL,
  `IsNewPage` bit(1) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `SysMenus` */

CREATE TABLE `SysMenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `tag` int(11) DEFAULT NULL,
  `hide` bit(1) NOT NULL,
  `IsNewPage` bit(1) NOT NULL,
  `IsSuperAdmin` bit(1) NOT NULL DEFAULT b'0',
  `OrderBy` int(11) NOT NULL DEFAULT '0',
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

/*Table structure for table `Table` */

CREATE TABLE `Table` (
  `sid` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `height` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sectionId` varchar(255) NOT NULL,
  `tableType` int(1) NOT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `ShopId` varchar(255) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `User` */

CREATE TABLE `User` (
  `Id` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(90) NOT NULL,
  `Contacts` varchar(255) DEFAULT NULL,
  `PassWord` varchar(32) NOT NULL,
  `PromaryId` int(11) NOT NULL,
  `CityId` int(11) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Authorize` bigint(20) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Office` varchar(255) DEFAULT NULL,
  `Industry` varchar(255) NOT NULL,
  `IsActivate` bit(1) NOT NULL DEFAULT b'0',
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `UserName` varchar(60) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `lasttime` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  `createip` varchar(30) NOT NULL,
  `lastip` varchar(30) NOT NULL,
  `diynum` int(11) NOT NULL,
  `activitynum` int(11) NOT NULL,
  `card_num` int(11) NOT NULL,
  `card_create_status` tinyint(1) NOT NULL,
  `wechat_card_num` mediumint(4) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL,
  `viptime` varchar(13) NOT NULL,
  `connectnum` int(11) NOT NULL DEFAULT '0',
  `lastloginmonth` smallint(2) NOT NULL DEFAULT '0',
  `IsSuperAdmin` bit(1) NOT NULL DEFAULT b'0',
  `AliPayIsSettng` bit(1) NOT NULL DEFAULT b'0' COMMENT '0',
  `WxPayIsSetting` bit(1) NOT NULL,
  `WxToken` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id_int`,`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

/*Table structure for table `UserToKen` */

CREATE TABLE `UserToKen` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Imei` varchar(255) NOT NULL,
  `ToKen` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `CreateTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

/*Table structure for table `Warehouse` */

CREATE TABLE `Warehouse` (
  `Sid` varchar(255) NOT NULL,
  `Uid` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `receiveAddress` varchar(255) NOT NULL DEFAULT '0' COMMENT '收获地址',
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `checkStockDetail` */

CREATE TABLE `checkStockDetail` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `hid` varchar(255) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `menuCode` varchar(255) NOT NULL COMMENT '商品编码',
  `menuName` varchar(255) NOT NULL,
  `menuBarCode` varchar(255) NOT NULL COMMENT '商品条码',
  `specification` varchar(255) NOT NULL COMMENT '规格',
  `unit` varchar(255) NOT NULL COMMENT '单位',
  `category` varchar(255) NOT NULL COMMENT '商品分类',
  `checkStockNumber` int(11) NOT NULL COMMENT '盘点的数量',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `checkStockHead` */

CREATE TABLE `checkStockHead` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `orderNo` varchar(255) NOT NULL COMMENT '盘点单号',
  `warehouseId` varchar(255) NOT NULL COMMENT '仓库ID',
  `createDate` datetime NOT NULL COMMENT '创建时间',
  `finishDate` datetime DEFAULT NULL COMMENT '完成时间',
  `status` int(11) NOT NULL COMMENT '0:盘点中 1:盘点完成待入库 2:已入库(覆盖掉仓库库存) 3:已取消盘点',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `checkStockLockInventory` */

CREATE TABLE `checkStockLockInventory` (
  `id` varchar(255) NOT NULL,
  `hid` varchar(255) NOT NULL COMMENT '盘点单头id',
  `pid` varchar(255) NOT NULL COMMENT '商品ID',
  `Inventory` int(11) NOT NULL COMMENT '库存数量',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `jPushBindUser` */

CREATE TABLE `jPushBindUser` (
  `id` varchar(255) NOT NULL,
  `uId` varchar(255) NOT NULL,
  `jPushId` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `outOrderDetail` */

CREATE TABLE `outOrderDetail` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `hid` varchar(255) NOT NULL COMMENT 'Head的ID',
  `pid` varchar(255) NOT NULL COMMENT '商品ID',
  `menuCode` varchar(255) NOT NULL COMMENT '商品编码',
  `menuName` varchar(255) NOT NULL,
  `menuBarCode` varchar(255) NOT NULL COMMENT '商品条码',
  `specification` varchar(255) NOT NULL COMMENT '规格',
  `unit` varchar(255) NOT NULL COMMENT '单位',
  `category` varchar(255) NOT NULL COMMENT '商品分类',
  `price` double NOT NULL COMMENT '单价',
  `currentInventory` int(11) NOT NULL COMMENT '当前库存',
  `outCount` int(11) NOT NULL COMMENT '退场数量',
  `isDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `outOrderHead` */

CREATE TABLE `outOrderHead` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `orderNo` varchar(255) NOT NULL COMMENT '退货单号',
  `supplierId` varchar(255) NOT NULL COMMENT '供应商id',
  `warehouseId` varchar(255) NOT NULL COMMENT '仓库id',
  `createDate` datetime NOT NULL COMMENT '申请日期',
  `receiveDate` datetime DEFAULT NULL COMMENT '退货日期',
  `note` text,
  `status` int(11) NOT NULL COMMENT '0:待退货 1:已退货 -2:已取消',
  `isDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_caccaca` */

CREATE TABLE `pospi_caccaca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_jiesuan` char(12) NOT NULL,
  `shop_id` varchar(60) NOT NULL,
  `total` varchar(60) DEFAULT NULL,
  `lease_fee` varchar(60) DEFAULT NULL,
  `health_fee` varchar(60) DEFAULT NULL,
  `split_fee` varchar(60) DEFAULT NULL,
  `baodi_fee` varchar(60) DEFAULT NULL,
  `custom_fee` varchar(60) DEFAULT NULL,
  `water_fee` varchar(60) DEFAULT NULL,
  `dian_fee` varchar(60) DEFAULT NULL,
  `update_time` varchar(60) NOT NULL,
  `xj` varchar(60) DEFAULT NULL,
  `ba` varchar(60) DEFAULT NULL,
  `wa` varchar(60) DEFAULT NULL,
  `aa` varchar(60) DEFAULT NULL,
  `ga` varchar(60) DEFAULT NULL,
  `ta` varchar(60) DEFAULT NULL,
  `qt` varchar(60) DEFAULT NULL,
  `m1` varchar(60) DEFAULT NULL,
  `is_print` varchar(1) DEFAULT 'N' COMMENT '是否已经打印',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_card_freeze` */

CREATE TABLE `pospi_card_freeze` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CardNo` varchar(255) NOT NULL COMMENT '卡号',
  `Note` text NOT NULL,
  `CreateTime` datetime NOT NULL,
  `IsDel` varchar(1) NOT NULL DEFAULT '0',
  `shop` char(11) NOT NULL COMMENT '店铺',
  `bywho` varchar(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `pospi_card_info` */

CREATE TABLE `pospi_card_info` (
  `cardNo` varchar(50) NOT NULL COMMENT '卡号',
  `cardUid` varchar(50) DEFAULT NULL COMMENT '卡原始id',
  `cardType` int(11) DEFAULT NULL COMMENT '卡类型 ',
  `shop` varchar(50) DEFAULT NULL COMMENT '发卡门店',
  `cardStatus` char(50) DEFAULT NULL COMMENT '卡状态 D：冻结 Y：已使用 N：未使用 T：退卡',
  `cardAmount` double DEFAULT NULL COMMENT '卡上可用金额',
  `cardMortgageAmount` double DEFAULT NULL COMMENT '卡上押金',
  `cardTotalAmount` double DEFAULT NULL COMMENT '卡总金额',
  `cardAmount_Sys` double DEFAULT NULL COMMENT '系统中卡金额',
  `cardMortgageAmount_Sys` double DEFAULT NULL COMMENT '系统中卡押金',
  `cardTotalAmount_Sys` double DEFAULT NULL COMMENT '系统中卡卡总金额',
  `lastChangeAmount` double DEFAULT NULL COMMENT '最后一次变更金额',
  `lastChangeTime` datetime DEFAULT NULL COMMENT '最后一次变更时间',
  `enableTime` datetime DEFAULT NULL COMMENT '启用时间',
  `createTime` datetime DEFAULT NULL COMMENT '记录创建时间',
  `correctingTime` datetime DEFAULT NULL COMMENT '上次矫正时间',
  `note` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`cardNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_card_record` */

CREATE TABLE `pospi_card_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(255) NOT NULL COMMENT '客户端id',
  `uid` varchar(255) NOT NULL,
  `shopId` varchar(255) NOT NULL COMMENT '店铺id',
  `SYYId` varchar(255) NOT NULL COMMENT '收银员id',
  `deviceNo` varchar(255) NOT NULL COMMENT '设备id',
  `OrderNo` varchar(255) NOT NULL COMMENT '订单号',
  `OrderTime_Time` datetime NOT NULL COMMENT '订单时间',
  `cardUid` varchar(50) NOT NULL COMMENT '卡原始id',
  `cardNo` varchar(50) NOT NULL COMMENT '卡号',
  `cardOldAmount` double(255,2) NOT NULL COMMENT '卡交易前金额',
  `cardNowAmount` double(255,2) NOT NULL COMMENT '卡交易后金额',
  `cardMortgage` double(255,2) NOT NULL COMMENT '卡押金',
  `changeAmount` double(255,2) NOT NULL COMMENT '变更金额',
  `UpLoadTime_Time` datetime NOT NULL COMMENT '记录上传时间',
  `HandlerTime` datetime NOT NULL DEFAULT '1900-01-01 00:00:00' COMMENT '记录处理时间',
  `flag` int(255) NOT NULL COMMENT '记录处理状态 0未处理 1已处理 2处理出错',
  `receivableAmount` double NOT NULL DEFAULT '0' COMMENT '应收金额',
  `paidInAmount` double NOT NULL DEFAULT '0' COMMENT '实收金额',
  `giveChangeAmount` double NOT NULL DEFAULT '0' COMMENT '找零金额',
  `payType` varchar(2) NOT NULL COMMENT '付款方式，C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡，L:礼品券，T:团购，R:人工修正，O:Other',
  `saleType` varchar(2) NOT NULL COMMENT '交易类型 C:充值 TK:退卡 X:消费 TH:退货',
  `onlinePayInfo` varchar(50) NOT NULL DEFAULT '' COMMENT '在线支付的返回值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_card_record_queue` */

CREATE TABLE `pospi_card_record_queue` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_adminuser` */

CREATE TABLE `pospi_cashier_adminuser` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL,
  `account` varchar(100) NOT NULL,
  `pwd` varchar(35) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `lastlogintime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `mid` (`mid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `pospi_cashier_coin` */

CREATE TABLE `pospi_cashier_coin` (
  `Sid` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(11) NOT NULL,
  `Pwd` varchar(60) NOT NULL,
  `Number` varchar(11) NOT NULL,
  `Isdel` varchar(1) NOT NULL DEFAULT 'N',
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`Sid`)
) ENGINE=MyISAM AUTO_INCREMENT=1118 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_employee` */

CREATE TABLE `pospi_cashier_employee` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `account` char(100) NOT NULL,
  `password` char(32) NOT NULL,
  `email` char(200) NOT NULL,
  `salt` char(20) NOT NULL,
  `roleid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1可用,2删除',
  `addtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`eid`),
  KEY `mid` (`mid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_fans` */

CREATE TABLE `pospi_cashier_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL,
  `appid` varchar(200) NOT NULL COMMENT '公众号id',
  `openid` varchar(250) NOT NULL COMMENT '公众号对应的公众号openid',
  `cf` varchar(100) NOT NULL DEFAULT 'local' COMMENT '来源',
  `totalfee` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付总额(分)',
  `refund` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '退款金额分',
  `is_subscribe` tinyint(4) NOT NULL COMMENT '1关注',
  `nickname` varchar(250) NOT NULL COMMENT '昵称',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1男2女0未知',
  `province` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `headimgurl` varchar(500) NOT NULL COMMENT '头像',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '微信粉丝分组id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_merchants` */

CREATE TABLE `pospi_cashier_merchants` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `thirduserid` varchar(100) NOT NULL COMMENT '第三方唯一身份ID',
  `password` char(32) DEFAULT NULL,
  `salt` char(50) NOT NULL,
  `wxname` char(210) NOT NULL,
  `weixin` varchar(150) NOT NULL COMMENT '微信号',
  `email` char(100) DEFAULT NULL,
  `logo` char(200) NOT NULL,
  `regTime` int(11) DEFAULT NULL,
  `regIp` char(20) DEFAULT NULL,
  `lastLoginTime` int(11) DEFAULT '0',
  `lastLoginIp` char(20) DEFAULT NULL,
  `source` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `mfypwd` tinyint(1) unsigned NOT NULL COMMENT '1修改过密码',
  `aeskey` varchar(50) NOT NULL COMMENT 'EncodingAESKey',
  `wxtoken` varchar(40) NOT NULL COMMENT 'wxToken',
  `encodetype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '消息加解密方式',
  `isadmin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1是总后台生成账号',
  PRIMARY KEY (`mid`),
  KEY `thirduserid` (`thirduserid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_order` */

CREATE TABLE `pospi_cashier_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` char(32) NOT NULL,
  `mid` int(11) NOT NULL,
  `pmid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理者mid',
  `pay_way` char(50) NOT NULL,
  `pay_type` char(50) NOT NULL,
  `goods_type` char(50) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_name` char(200) NOT NULL,
  `goods_describe` varchar(500) NOT NULL,
  `goods_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `add_time` int(11) NOT NULL,
  `paytime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `ispay` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已支付',
  `truename` varchar(250) NOT NULL,
  `openid` varchar(250) NOT NULL,
  `p_openid` varchar(250) NOT NULL COMMENT 'p_mid对应openid',
  `transaction_id` varchar(250) NOT NULL COMMENT '第三方支付订单号',
  `refund` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1退款中2已退款3失败',
  `refundtext` text NOT NULL COMMENT '退款结果数据',
  `comefrom` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0本地1微信营销 2微店 3 o2o系统',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_payconfig` */

CREATE TABLE `pospi_cashier_payconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `isOpen` tinyint(1) NOT NULL DEFAULT '0',
  `configData` varchar(2000) DEFAULT NULL,
  `proxymid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理者的mid',
  `wxsubmchid` varchar(30) NOT NULL COMMENT '分配到的子商户号',
  `pfpaymid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '平台代付mid',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_roles` */

CREATE TABLE `pospi_cashier_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `rolename` char(60) NOT NULL,
  `authority` text,
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_shops` */

CREATE TABLE `pospi_cashier_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户编号',
  `mid` int(11) NOT NULL,
  `eid` int(5) NOT NULL COMMENT '添加人',
  `shopname` char(12) NOT NULL COMMENT '商户名称',
  `contacts` char(12) NOT NULL COMMENT '联系人',
  `tel` char(12) NOT NULL COMMENT '电话',
  `bank_account` char(12) NOT NULL COMMENT '银行户名',
  `bank` char(20) NOT NULL COMMENT '银行',
  `card_num` varchar(20) NOT NULL COMMENT '银行卡号',
  `add_time` int(12) NOT NULL COMMENT '添加时间',
  `update_time` int(12) NOT NULL COMMENT '修改时间',
  `is_del` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_wxcoupon` */

CREATE TABLE `pospi_cashier_wxcoupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL,
  `card_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `card_title` varchar(250) NOT NULL,
  `card_id` varchar(250) NOT NULL COMMENT '微信卡券ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '卡券状态',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1删除',
  `begin_timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `end_timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `quantity` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `receivenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取数',
  `consumenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '核销数量',
  `get_limit` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '每人可领几张',
  `kqcontent` text NOT NULL COMMENT '卡券内容',
  `kqexpand` text NOT NULL COMMENT '卡券扩展内容',
  `checktime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '审核通过时间',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `cardticket` varchar(250) NOT NULL,
  `cardurl` varchar(250) NOT NULL COMMENT ' 二维码图片解析后的地址',
  `is_open_cell` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启买单功能（0：否，1：开启）',
  `activate` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会员卡激活方式（0:字段激活，1：一键激活，2：手动激活）',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_wxcoupon_common` */

CREATE TABLE `pospi_cashier_wxcoupon_common` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL,
  `logurl` varchar(250) NOT NULL,
  `mname` varchar(100) NOT NULL COMMENT '商户名字',
  `wxlogurl` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_cashier_wxcoupon_receive` */

CREATE TABLE `pospi_cashier_wxcoupon_receive` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(250) NOT NULL COMMENT '领取人openid',
  `give_openId` varchar(250) NOT NULL COMMENT '转赠送方账号openid',
  `cardid` varchar(250) NOT NULL,
  `cardtype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '卡券类型',
  `cardtitle` varchar(250) NOT NULL COMMENT '卡券标题',
  `isgivebyfriend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为转赠',
  `cardcode` varchar(100) NOT NULL COMMENT 'code序列号',
  `oldcardcode` varchar(100) NOT NULL COMMENT '转赠前的code序列号',
  `outerid` int(10) unsigned NOT NULL COMMENT 'mid值',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0领取1核销',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `deltime` int(10) unsigned NOT NULL COMMENT '用户删除时间',
  `consumetime` int(10) unsigned NOT NULL COMMENT '消费时间',
  `consumesource` varchar(100) NOT NULL COMMENT '核销来源',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_charge` */

CREATE TABLE `pospi_charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '费用名称',
  `class` int(11) NOT NULL COMMENT '费用类型0普通1水电',
  `base` varchar(60) NOT NULL,
  `addtime` int(11) NOT NULL,
  `isdel` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_contract` */

CREATE TABLE `pospi_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ht_code` char(60) NOT NULL COMMENT '合同编码',
  `ht_status` varchar(1) NOT NULL DEFAULT 'Y' COMMENT '合同状态',
  `ht_class` int(3) NOT NULL COMMENT '合同分类',
  `ht_venderID` varchar(60) NOT NULL COMMENT '商户编码',
  `ht_venderName` varchar(255) NOT NULL COMMENT '商户名称',
  `ht_business` int(3) NOT NULL COMMENT '经营方式,1租赁2,联营',
  `ht_startT` varchar(60) NOT NULL COMMENT '合同开始日期',
  `ht_endT` varchar(60) NOT NULL COMMENT '合同结束日期',
  `ht_pinpai` varchar(255) DEFAULT NULL COMMENT '经营品牌',
  `ht_baodi` varchar(60) DEFAULT NULL COMMENT '保底',
  `ht_koulv` varchar(60) DEFAULT NULL COMMENT '扣率',
  `ht_square` varchar(60) DEFAULT NULL COMMENT '面积',
  `ht_puweiNo` varchar(60) DEFAULT NULL COMMENT '铺位号',
  `ht_yewuyuan` varchar(60) DEFAULT NULL COMMENT '业务员',
  `ht_sourceNO` varchar(60) DEFAULT NULL COMMENT '原始编码',
  `ht_content` varchar(255) DEFAULT NULL COMMENT '备注',
  `ht_lururen` varchar(60) DEFAULT NULL COMMENT '录入人员',
  `ht_luruTime` varchar(60) DEFAULT NULL COMMENT '录入时间',
  `ht_shenheren` varchar(60) DEFAULT NULL COMMENT '审核人员',
  `ht_check` varchar(1) NOT NULL DEFAULT 'N',
  `ht_shenheTime` varchar(60) DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_fee_jieshuan` */

CREATE TABLE `pospi_fee_jieshuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shop_id` char(60) NOT NULL COMMENT '店铺id',
  `water_fee` char(60) DEFAULT NULL,
  `dian_fee` char(60) DEFAULT NULL,
  `lease_fee` char(60) DEFAULT NULL COMMENT '租赁费',
  `health_fee` char(60) DEFAULT NULL COMMENT '卫生费',
  `split_fee` char(60) DEFAULT NULL COMMENT '分润点数',
  `baodi_fee` char(60) DEFAULT NULL COMMENT '保底',
  `custom_fee` tinytext COMMENT '自定义',
  `sale_fee` char(60) NOT NULL COMMENT '销售额',
  `refund_fee` char(60) DEFAULT NULL COMMENT '应退款',
  `jiesuan_month` char(30) NOT NULL COMMENT '结算月',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_fee_manage` */

CREATE TABLE `pospi_fee_manage` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shop_id` char(60) NOT NULL COMMENT '店铺id',
  `lease_fee` char(60) DEFAULT NULL COMMENT '租赁费',
  `health_fee` char(60) DEFAULT NULL COMMENT '卫生费',
  `split_fee` char(60) DEFAULT NULL COMMENT '分润点数',
  `baodi_fee` char(60) DEFAULT NULL COMMENT '保底',
  `custom_fee` text COMMENT '自定义',
  `is_default` char(1) NOT NULL DEFAULT 'Y',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_fee_manage_temp` */

CREATE TABLE `pospi_fee_manage_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `shop_id` char(60) NOT NULL COMMENT '店铺id',
  `water_fee` char(60) DEFAULT NULL COMMENT '水费',
  `dian_fee` char(60) DEFAULT NULL COMMENT '电费',
  `last_jiesuan` char(60) NOT NULL,
  `update_time` char(60) NOT NULL,
  PRIMARY KEY (`id`,`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_jiesuan` */

CREATE TABLE `pospi_jiesuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '结算单号',
  `status` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'N未审核Y已审核',
  `fk_status` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'N未付款Y已付款',
  `riqi` varchar(60) NOT NULL,
  `shop_id` varchar(60) NOT NULL COMMENT '商户编码',
  `shop_name` varchar(255) NOT NULL COMMENT '商户名称',
  `ht_no` varchar(60) NOT NULL COMMENT '合同编码',
  `ht_class` int(11) NOT NULL COMMENT '合同分类',
  `ht_pwh` varchar(60) DEFAULT NULL COMMENT '铺位号',
  `ht_jypp` varchar(255) DEFAULT NULL COMMENT '经营品牌',
  `ht_square` varchar(255) DEFAULT NULL COMMENT '店铺面积',
  `xse` varchar(60) DEFAULT NULL COMMENT '销售额',
  `zj` varchar(60) DEFAULT NULL COMMENT '租金',
  `bdje` varchar(60) DEFAULT NULL COMMENT '保底金额',
  `qt` varchar(60) DEFAULT NULL COMMENT '其他(装修费,损坏赔偿)',
  `kd` varchar(60) DEFAULT NULL COMMENT '扣点',
  `xscc` varchar(60) DEFAULT NULL COMMENT '销售抽成',
  `fyje` varchar(60) DEFAULT NULL COMMENT '费用金额',
  `yjje` varchar(60) DEFAULT NULL COMMENT '应结金额',
  `sgtz` varchar(60) DEFAULT NULL COMMENT '手工调整',
  `sjfkje` varchar(60) DEFAULT NULL COMMENT '实际付款金额',
  `fkfs` varchar(60) DEFAULT NULL COMMENT '付款方式',
  `lrr` varchar(60) DEFAULT NULL COMMENT '录入人',
  `lrsj` varchar(60) DEFAULT NULL COMMENT '录入时间',
  `shr` varchar(60) DEFAULT NULL COMMENT '审核和人',
  `shsj` varchar(60) DEFAULT NULL COMMENT '审核时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_mem` */

CREATE TABLE `pospi_mem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caca_date` varchar(60) DEFAULT NULL COMMENT '水电上次结算日期',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_info` */

CREATE TABLE `pospi_onlinecard_info` (
  `cardNo` varchar(50) NOT NULL COMMENT '卡号',
  `cardUid` varchar(50) NOT NULL COMMENT '卡原始id',
  `cardType` int(11) NOT NULL COMMENT '卡类型 ',
  `shop` varchar(50) DEFAULT NULL COMMENT '发卡门店',
  `cardStatus` char(50) NOT NULL COMMENT '卡状态 D：冻结 Y：已使用 N：未使用 T：退卡',
  `cardAmount` double(11,2) NOT NULL COMMENT '卡上可用金额',
  `lastChangeAmount` double(11,2) NOT NULL COMMENT '最后一次变更金额',
  `lastChangeTime` datetime DEFAULT NULL COMMENT '最后一次变更时间',
  `enableTime` datetime DEFAULT NULL COMMENT '启用时间',
  `createTime` datetime DEFAULT NULL COMMENT '记录创建时间',
  `correctingTime` datetime DEFAULT NULL COMMENT '上次矫正时间',
  `note` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`cardNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_record` */

CREATE TABLE `pospi_onlinecard_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(255) NOT NULL COMMENT '客户端id',
  `uid` varchar(255) NOT NULL,
  `shopId` varchar(255) NOT NULL COMMENT '店铺id',
  `SYYId` varchar(255) NOT NULL COMMENT '收银员id',
  `deviceNo` varchar(255) NOT NULL COMMENT '设备id',
  `OrderNo` varchar(255) NOT NULL COMMENT '订单号',
  `OrderTime_Time` datetime NOT NULL COMMENT '订单时间',
  `cardUid` varchar(50) NOT NULL COMMENT '卡原始id',
  `cardNo` varchar(50) NOT NULL COMMENT '卡号',
  `cardOldAmount` double(11,2) NOT NULL COMMENT '卡交易前金额',
  `cardNowAmount` double(11,2) NOT NULL COMMENT '卡交易后金额',
  `changeAmount` double(11,2) NOT NULL COMMENT '变更金额',
  `UpLoadTime_Time` datetime NOT NULL COMMENT '记录上传时间',
  `HandlerTime` datetime NOT NULL DEFAULT '1900-01-01 00:00:00' COMMENT '记录处理时间',
  `receivableAmount` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '应收金额',
  `paidInAmount` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `giveChangeAmount` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '找零金额',
  `payType` varchar(2) NOT NULL COMMENT '付款方式，C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡，L:礼品券，T:团购，R:人工修正，O:Other',
  `saleType` varchar(2) NOT NULL COMMENT '交易类型 C:充值 TK:退卡 X:消费 TH:退货',
  `onlinePayInfo` varchar(50) NOT NULL DEFAULT '' COMMENT '在线支付的返回值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_report_merchant_day` */

CREATE TABLE `pospi_onlinecard_report_merchant_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `uid` varchar(50) NOT NULL COMMENT '用户id',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `cardAmount` double NOT NULL DEFAULT '0' COMMENT 'M1卡销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_report_merchant_hour` */

CREATE TABLE `pospi_onlinecard_report_merchant_hour` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `uid` varchar(50) NOT NULL COMMENT '用户id',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `cardAmount` double NOT NULL DEFAULT '0' COMMENT 'M1卡销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  `hour` int(11) DEFAULT NULL COMMENT '几小时',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12329 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_report_recharge_day` */

CREATE TABLE `pospi_onlinecard_report_recharge_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime NOT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  `rechargeType` char(255) NOT NULL COMMENT '充值类型 C：充值 T：退卡',
  `posNo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_report_recharge_hour` */

CREATE TABLE `pospi_onlinecard_report_recharge_hour` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  `hour` int(11) DEFAULT NULL COMMENT '几小时',
  `rechargeType` char(255) NOT NULL COMMENT '充值类型 C：充值 T：退卡',
  `posNo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_onlinecard_type` */

CREATE TABLE `pospi_onlinecard_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(50) NOT NULL COMMENT '卡类型名称',
  `typeNote` varchar(200) NOT NULL COMMENT '卡类型备注',
  `action` varchar(50) NOT NULL COMMENT '权限值 1,1,1,1 充,退,消费,退货',
  `mortgageAmount` double NOT NULL DEFAULT '0' COMMENT '押金金额',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_report_merchant_day` */

CREATE TABLE `pospi_report_merchant_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `uid` varchar(50) NOT NULL COMMENT '用户id',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `cardAmount` double NOT NULL DEFAULT '0' COMMENT 'M1卡销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_report_merchant_hour` */

CREATE TABLE `pospi_report_merchant_hour` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `uid` varchar(50) NOT NULL COMMENT '用户id',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `cardAmount` double NOT NULL DEFAULT '0' COMMENT 'M1卡销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  `hour` int(11) DEFAULT NULL COMMENT '几小时',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12329 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_report_recharge_day` */

CREATE TABLE `pospi_report_recharge_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime NOT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  `rechargeType` char(255) NOT NULL COMMENT '充值类型 C：充值 T：退卡',
  `posNo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_report_recharge_hour` */

CREATE TABLE `pospi_report_recharge_hour` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增涨',
  `date` date NOT NULL COMMENT '报表日期',
  `totalAmount` double NOT NULL DEFAULT '0' COMMENT '总销售额',
  `cashAmount` double NOT NULL DEFAULT '0' COMMENT '现金销售额',
  `bankCardAmount` double NOT NULL DEFAULT '0' COMMENT '银行卡销售额',
  `weChatAmount` double NOT NULL DEFAULT '0' COMMENT '微信销售额',
  `aliPayAmount` double NOT NULL DEFAULT '0' COMMENT '支付宝销售额',
  `giftAmount` double NOT NULL DEFAULT '0' COMMENT '礼品券销售额',
  `tuanAmount` double NOT NULL DEFAULT '0' COMMENT '团购销售额',
  `otherAmount` double NOT NULL DEFAULT '0' COMMENT '其他销售额',
  `obj1` varchar(50) DEFAULT NULL,
  `obj2` varchar(50) DEFAULT NULL,
  `obj3` varchar(50) DEFAULT NULL,
  `obj4` varchar(50) DEFAULT NULL,
  `obj5` varchar(50) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `resetTime` datetime DEFAULT NULL COMMENT '上一次重算时间',
  `hour` int(11) DEFAULT NULL COMMENT '几小时',
  `rechargeType` char(255) NOT NULL COMMENT '充值类型 C：充值 T：退卡',
  `posNo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_vender` */

CREATE TABLE `pospi_vender` (
  `Id` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(90) NOT NULL,
  `Contacts` varchar(255) DEFAULT NULL,
  `PassWord` varchar(32) NOT NULL,
  `PromaryId` int(11) NOT NULL,
  `CityId` int(11) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Authorize` bigint(20) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Office` varchar(255) DEFAULT NULL,
  `Industry` varchar(255) NOT NULL,
  `IsActivate` bit(1) NOT NULL DEFAULT b'0',
  `IsDel` bit(1) NOT NULL DEFAULT b'0',
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `UserName` varchar(60) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `lasttime` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  `createip` varchar(30) NOT NULL,
  `lastip` varchar(30) NOT NULL,
  `diynum` int(11) NOT NULL,
  `activitynum` int(11) NOT NULL,
  `card_num` int(11) NOT NULL,
  `card_create_status` tinyint(1) NOT NULL,
  `wechat_card_num` mediumint(4) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL,
  `viptime` varchar(13) NOT NULL,
  `connectnum` int(11) NOT NULL DEFAULT '0',
  `lastloginmonth` smallint(2) NOT NULL DEFAULT '0',
  `IsSuperAdmin` bit(1) NOT NULL DEFAULT b'0',
  `AliPayIsSettng` bit(1) NOT NULL DEFAULT b'0' COMMENT '0',
  `WxPayIsSetting` bit(1) NOT NULL,
  `WxToken` varchar(255) NOT NULL DEFAULT '',
  `shopname` char(12) NOT NULL COMMENT '商户名称',
  `tel` char(12) NOT NULL COMMENT '电话',
  `bank_account` char(12) NOT NULL COMMENT '银行户名',
  `bank` char(20) NOT NULL COMMENT '银行',
  PRIMARY KEY (`Id_int`,`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_vender_charge` */

CREATE TABLE `pospi_vender_charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '单据编号',
  `no` varchar(60) NOT NULL COMMENT '手工单号',
  `check` varchar(1) NOT NULL DEFAULT 'N' COMMENT '审核标志',
  `ht_no` varchar(60) NOT NULL COMMENT '合同编号',
  `js_no` varchar(60) NOT NULL COMMENT '结算单号',
  `shop_id` varchar(60) NOT NULL COMMENT '商户编号',
  `shop_name` varchar(60) DEFAULT NULL COMMENT '商户名称',
  `js_date` varchar(60) NOT NULL COMMENT '结算期',
  `fee_no` varchar(60) NOT NULL COMMENT '费用编码',
  `fee_class` int(11) NOT NULL COMMENT '费用类型',
  `fee_name` varchar(60) DEFAULT NULL COMMENT '费用名称',
  `fee_date` varchar(60) DEFAULT NULL COMMENT '费用发生日期',
  `fee_start` varchar(60) DEFAULT NULL COMMENT '费用所属起始日期',
  `fee_end` varchar(60) DEFAULT NULL COMMENT '费用所属结束日期',
  `fee_position` varchar(255) DEFAULT NULL COMMENT '费用发生位置',
  `jf_start` varchar(60) DEFAULT NULL COMMENT '计费起始值',
  `jf_end` varchar(60) DEFAULT NULL COMMENT '计费结束值',
  `jf_use` varchar(60) DEFAULT NULL COMMENT '实际用量',
  `jf_price` varchar(60) DEFAULT NULL COMMENT '单价',
  `jf_money` varchar(255) DEFAULT NULL COMMENT '计费金额',
  `jf_adjust` varchar(255) DEFAULT NULL COMMENT '调整金额',
  `fy_price` varchar(255) NOT NULL COMMENT '费用金额',
  `content` varchar(255) DEFAULT NULL COMMENT '备注',
  `lr_man` varchar(60) DEFAULT NULL,
  `lr_time` varchar(60) DEFAULT NULL,
  `sh_man` varchar(60) DEFAULT NULL,
  `sh_time` varchar(60) DEFAULT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_vender_check` */

CREATE TABLE `pospi_vender_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` varchar(60) NOT NULL COMMENT '商户编码',
  `shop_name` varchar(255) DEFAULT NULL COMMENT '商户名称',
  `check_date` varchar(60) NOT NULL COMMENT '日期',
  `sy_ck` varchar(60) DEFAULT NULL COMMENT '系统餐卡',
  `sy_wx` varchar(60) DEFAULT NULL COMMENT '系统微信',
  `sy_zfb` varchar(60) DEFAULT NULL COMMENT '系统支付宝',
  `sg_wx` varchar(60) DEFAULT NULL COMMENT '手工微信',
  `sg_zfb` varchar(60) DEFAULT NULL COMMENT '手工支付宝',
  `sg_mt` varchar(60) DEFAULT NULL COMMENT '手工美团',
  `sg_dzdp` varchar(60) DEFAULT NULL COMMENT '手工大众点评',
  `sg_lm` varchar(60) DEFAULT NULL COMMENT '手工糯米',
  `sg_dyqcz` varchar(60) DEFAULT NULL COMMENT '手工抵用券/储值卡',
  `sg_xj` varchar(60) DEFAULT NULL COMMENT '手工现金',
  `sg_yhnk` varchar(60) DEFAULT NULL COMMENT '手工银行内卡',
  `sg_yhwk` varchar(60) DEFAULT NULL COMMENT '手工银行外卡',
  `option1` varchar(60) DEFAULT NULL,
  `option2` varchar(60) DEFAULT NULL,
  `option3` varchar(60) DEFAULT NULL,
  `option4` varchar(60) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `hj` varchar(60) DEFAULT NULL COMMENT '合计金额',
  `shbz` varchar(60) DEFAULT 'N' COMMENT '审核标志Y:已审核',
  `lrr` varchar(60) DEFAULT NULL COMMENT '录入人',
  `lrsj` varchar(60) DEFAULT NULL COMMENT '录入时间',
  `shr` varchar(60) DEFAULT NULL COMMENT '审核人',
  `shsj` varchar(60) DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Table structure for table `pospi_vender_check1` */

CREATE TABLE `pospi_vender_check1` (
  `shop_id` varchar(60) NOT NULL COMMENT '商户编码',
  `shop_name` varchar(255) DEFAULT NULL COMMENT '商户名称',
  `year_mon` varchar(60) NOT NULL,
  `check_date` varchar(60) NOT NULL COMMENT '日期',
  `sy_ck` varchar(60) DEFAULT NULL COMMENT '系统餐卡',
  `sy_wx` varchar(60) DEFAULT NULL COMMENT '系统微信',
  `sy_zfb` varchar(60) DEFAULT NULL COMMENT '系统支付宝',
  `sg_wx` varchar(60) DEFAULT NULL COMMENT '手工微信',
  `sg_zfb` varchar(60) DEFAULT NULL COMMENT '手工支付宝',
  `sg_mt` varchar(60) DEFAULT NULL COMMENT '手工美团',
  `sg_dzdp` varchar(60) DEFAULT NULL COMMENT '手工大众点评',
  `sg_lm` varchar(60) DEFAULT NULL COMMENT '手工糯米',
  `sg_dyqcz` varchar(60) DEFAULT NULL COMMENT '手工抵用券/储值卡',
  `sg_xj` varchar(60) DEFAULT NULL COMMENT '手工现金',
  `sg_yhnk` varchar(60) DEFAULT NULL COMMENT '手工银行内卡',
  `sg_yhwk` varchar(60) DEFAULT NULL COMMENT '手工银行外卡',
  `option1` varchar(60) DEFAULT NULL,
  `option2` varchar(60) DEFAULT NULL,
  `option3` varchar(60) DEFAULT NULL,
  `option4` varchar(60) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `hj` varchar(60) DEFAULT NULL COMMENT '合计金额',
  `shbz` varchar(60) DEFAULT 'N' COMMENT '审核标志Y:已审核',
  `lrr` varchar(60) DEFAULT NULL COMMENT '录入人',
  `lrsj` varchar(60) DEFAULT NULL COMMENT '录入时间',
  `shr` varchar(60) DEFAULT NULL COMMENT '审核人',
  `shsj` varchar(60) DEFAULT NULL COMMENT '审核时间',
  `sj` int(11) DEFAULT NULL,
  PRIMARY KEY (`shop_id`,`check_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `purchaseOrderDetail` */

CREATE TABLE `purchaseOrderDetail` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `hid` varchar(255) NOT NULL COMMENT 'Head的ID',
  `pid` varchar(255) NOT NULL COMMENT '商品ID',
  `menuCode` varchar(255) NOT NULL COMMENT '商品编码',
  `menuName` varchar(255) NOT NULL,
  `menuBarCode` varchar(255) NOT NULL COMMENT '商品条码',
  `specification` varchar(255) NOT NULL COMMENT '规格',
  `unit` varchar(255) NOT NULL COMMENT '单位',
  `category` varchar(255) NOT NULL COMMENT '商品分类',
  `price` double NOT NULL COMMENT '单价',
  `currentInventory` int(11) NOT NULL COMMENT '当前库存',
  `purchaseCount` int(11) NOT NULL COMMENT '订货数量',
  `receiveCount` int(11) NOT NULL DEFAULT '0' COMMENT '已收货数量',
  `isDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `purchaseOrderHead` */

CREATE TABLE `purchaseOrderHead` (
  `id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `orderNo` varchar(255) NOT NULL COMMENT '订货单号',
  `orderNo_rk` varchar(255) NOT NULL COMMENT '入库单号',
  `supplierId` varchar(255) NOT NULL COMMENT '供应商id',
  `warehouseId` varchar(255) NOT NULL COMMENT '仓库id',
  `createDate` datetime NOT NULL COMMENT '申请日期',
  `hopeReceiveDate` datetime NOT NULL COMMENT '期望收获日期',
  `receiveDate` datetime DEFAULT NULL COMMENT '实际收获日期',
  `deliverType` varchar(255) NOT NULL COMMENT '发货方式 0:自提  1:快递',
  `phone` varchar(255) NOT NULL,
  `receiveAddress` varchar(255) NOT NULL COMMENT '收获地址',
  `note` text,
  `status` int(11) NOT NULL COMMENT '0:待审核 1:审核通过-待收货 -2:审核未通过 2:已收获-完成',
  `isDel` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tp_site_plugmenu` */

CREATE TABLE `tp_site_plugmenu` (
  `token` varchar(60) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT '',
  `taxis` mediumint(4) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  KEY `token` (`token`,`taxis`,`display`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* Trigger structure for table `Order_PayType` */

DELIMITER $$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `create_pay_queue` AFTER INSERT ON `Order_PayType` FOR EACH ROW   #这句话在mysql是固定的

begin
	DECLARE payType VARCHAR(10);
	DECLARE saleType VARCHAR(10);

	IF new.payType!=6 THEN
		IF new.payType=1 THEN
			SET payType = "X";
		ELSEIF new.payType=2 || new.payType=4 ||new.payType=12 ||new.payType=11 ||new.payType=15 THEN
			SET PayType = "Y";
	  ELSEIF new.payType=13 THEN
			SET PayType = "W";
	  ELSEIF new.payType=14 THEN
			SET PayType = "Z";
	  ELSEIF new.payType=3 THEN
			SET PayType = "L";
	  ELSEIF new.payType=9 THEN
			SET PayType = "T";
	  ELSEIF new.payType=10 || new.payType=5|| new.payType=7 THEN
			SET PayType = "O";
		END IF;
		
		IF new.price_ys > 0 THEN
			SET saleType = "X";
		ELSE
			SET saleType = "TH";
		END IF;

		INSERT INTO pospi_card_record(sid,uid,shopId,SYYId,deviceNo,OrderNo,
			OrderTime_Time,cardUid,cardNo,cardOldAmount,cardNowAmount,
			cardMortgage,changeAmount,UpLoadTime_Time,HandlerTime,flag,
			receivableAmount,paidInAmount,giveChangeAmount,payType,
			saleType,onlinePayInfo)
			VALUES(new.sid,new.Uid,"","","","",new.UpLoadTime,"nocard","nocard",0,0,0,0,
						new.UpLoadTime,new.UpLoadTime,0,new.price_ys,new.price,new.price_zl,PayType,saleType,"");
	END IF;
end */$$


DELIMITER ;

/* Trigger structure for table `pospi_card_record` */

DELIMITER $$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `create_card_record_queue` AFTER INSERT ON `pospi_card_record` FOR EACH ROW Begin
	INSERT INTO pospi_card_record_queue VALUES(new.id);
end */$$


DELIMITER ;

/* Trigger structure for table `pospi_onlinecard_record` */

DELIMITER $$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `create_card_record_queue_copy` AFTER INSERT ON `pospi_onlinecard_record` FOR EACH ROW Begin
	INSERT INTO pospi_card_record_queue VALUES(new.id);
end */$$


DELIMITER ;

/* Procedure structure for procedure `p1` */

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `p1`()
BEGIN
	DECLARE _i INT DEFAULT 0;
	DECLARE _thisId INT;
	DECLARE _count INT;
	DECLARE _error INTEGER DEFAULT 0;
	#定义游标
	DECLARE _curIds CURSOR FOR SELECT id FROM pospi_card_record_queue;
	#捕捉异常后不处理
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET _error=_thisId;

	SELECT count(id) INTO _count FROM pospi_card_record_queue;
	OPEN _curIds;
		WHILE _i<_count DO
			SET _i=_i+1;
			FETCH _curIds INTO _thisId;
			START TRANSACTION;

			#这里写主要业务逻辑

			UPDATE pospi_card_record SET flag = 1,HandlerTime=NOW() WHERE id=_thisId;
			IF _error = _thisId THEN
				ROLLBACK;
				UPDATE pospi_card_record SET flag = 2,HandlerTime=NOW() WHERE id=_thisId;
			ELSE
				COMMIT;
			END IF;
			#删除消息队列表中的数据
			DELETE FROM pospi_card_record_queue WHERE id=_thisId;
		END WHILE;
	CLOSE _curIds;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t1` */

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `t1`()
BEGIN
	DECLARE _i INT DEFAULT 0;
	DECLARE _thisId INT;
	DECLARE _count INT;
	#定义游标
	DECLARE _curIds CURSOR FOR SELECT id FROM pospi_card_record_queue;

	SELECT count(id) INTO _count FROM pospi_card_record_queue;
	OPEN _curIds;
		WHILE _i<_count DO
			SET _i=_i+1;
			FETCH _curIds INTO _thisId;

			CALL t2(_thisId);

		END WHILE;
	CLOSE _curIds;
END */$$
DELIMITER ;

/* Procedure structure for procedure `t2` */

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `t2`(IN `_id` int)
BEGIN
	DECLARE _flag INT;
	DECLARE _sid,_uid,_shopId,_SYYId,_deviceNo,_OrderNo,_cardUid,_cardNo,_payType,_saleType VARCHAR(50);
	DECLARE _OrderTime_Time,_UpLoadTime_Time,_HandlerTime DATETIME;
	DECLARE _cardOldAmount,_cardNowAmount,_cardMortgage,_OrderAmount,_receivableAmount,_paidInAmount,_giveChangeAmount  DOUBLE;
	DECLARE _count INT;
	DECLARE _cardStatus VARCHAR(50);

	DECLARE _error INTEGER DEFAULT 0;
	#捕捉异常后不处理
	#DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET _error=1;

	START TRANSACTION;
		#读取一条卡流水数据
		SELECT sid,uid,shopId,SYYId,deviceNo,OrderNo,OrderTime_Time,cardUid,cardNo,cardOldAmount,cardNowAmount,
						cardMortgage,OrderAmount,UpLoadTime_Time,HandlerTime,flag,receivableAmount,paidInAmount,giveChangeAmount,payType,saleType
						INTO _sid,_uid,_shopId,_SYYId,_deviceNo,_OrderNo,_OrderTime_Time,_cardUid,_cardNo,_cardOldAmount,
						_cardNowAmount,_cardMortgage,_OrderAmount,_UpLoadTime_Time,_HandlerTime,_flag,_receivableAmount,
						_paidInAmount,_giveChangeAmount,_payType,_saleType
						FROM pospi_card_record WHERE id=_id;

		IF _cardNo <> "-99999999" THEN
			#如果卡号不等于'-99999999'说明改记录为真实卡流水
			IF _saleType = "tk" THEN
				SET _cardStatus = "T";
			ELSE
				SET _cardStatus = "Y";
			END IF;

			SELECT count(*) INTO _count FROM pospi_card_info WHERE cardNo = _cardNo;

			IF _count = 0 THEN
				INSERT INTO pospi_card_info(cardNo,cardUid,cardType,shop,cardStatus,cardAmount,cardMortgageAmount,cardTotalAmount,
																		cardAmount_Sys,cardMortgageAmount_Sys,cardTotalAmount_Sys,lastChangeAmount,lastChangeTime,
																		enableTime,createTime)
										VALUES(_cardNo,_cardUid,0,"默认",_cardStatus,_cardNowAmount,_cardMortgage,_cardNowAmount+_cardMortgage,
													 _cardNowAmount,_cardMortgage,_cardNowAmount+_cardMortgage,_OrderAmount,_OrderTime_Time,
													 _OrderTime_Time,NOW());
			ELSE
				SELECT _count;
			END IF;
		END IF;

	UPDATE pospi_card_record SET flag = 1,HandlerTime=NOW() WHERE id=_id;

	IF _error = 1 THEN
		ROLLBACK;
		UPDATE pospi_card_record SET flag = 2,HandlerTime=NOW() WHERE id=_id;
	ELSE
		COMMIT;
	END IF;

	#删除消息队列表中的数据
	DELETE FROM pospi_card_record_queue WHERE id=_id;
END */$$
DELIMITER ;

/*Table structure for table `View_JKD` */

DROP TABLE IF EXISTS `View_JKD`;

/*!50001 CREATE TABLE  `View_JKD`(
 `sid` varchar(255) ,
 `uid` varchar(255) ,
 `no` int(255) ,
 `shopId` varchar(255) ,
 `ShopName` varchar(255) ,
 `cashierNo` varchar(255) ,
 `CashierName` varchar(255) ,
 `jkMoney` float ,
 `jkDate_D` datetime ,
 `upLoadTime_D` datetime ,
 `deviceId` varchar(255) 
)*/;

/*Table structure for table `View_JKD_Detail` */

DROP TABLE IF EXISTS `View_JKD_Detail`;

/*!50001 CREATE TABLE  `View_JKD_Detail`(
 `sid` varchar(255) ,
 `uid` varchar(255) ,
 `no` int(255) ,
 `shopId` varchar(255) ,
 `ShopName` varchar(255) ,
 `cashierNo` varchar(255) ,
 `CashierName` varchar(255) ,
 `TotalMoney` float ,
 `jkDate_D` datetime ,
 `upLoadTime_D` datetime ,
 `deviceId` varchar(255) ,
 `payMoney` double ,
 `payType` int(11) 
)*/;

/*Table structure for table `View_Order_PayType` */

DROP TABLE IF EXISTS `View_Order_PayType`;

/*!50001 CREATE TABLE  `View_Order_PayType`(
 `Id` varchar(255) ,
 `sid` varchar(255) ,
 `Uid` varchar(255) ,
 `code` varchar(255) ,
 `colorCode` varchar(255) ,
 `name` varchar(255) ,
 `order_sid` varchar(255) ,
 `orderBy` int(11) ,
 `payType` int(11) ,
 `price` double ,
 `status` int(11) ,
 `lineNum` int(11) ,
 `payId` varchar(255) ,
 `payNumber1` varchar(255) ,
 `payNumber2` varchar(255) ,
 `payNumber3` varchar(255) ,
 `obj1` varchar(255) ,
 `obj2` varchar(255) ,
 `obj4` varchar(255) ,
 `obj5` varchar(255) ,
 `UpLoadTime` datetime ,
 `IsClear` int(1) ,
 `CreateTime` datetime ,
 `yyyyMMdd` datetime ,
 `year` int(11) ,
 `month` int(11) ,
 `day` int(11) ,
 `HH` int(11) ,
 `mm` int(11) ,
 `DPH` varchar(255) ,
 `SYJH` varchar(255) ,
 `XPH` int(11) ,
 `SYYH` varchar(255) ,
 `SYYM` varchar(255) 
)*/;

/*Table structure for table `pospi_view_onlinecard_info` */

DROP TABLE IF EXISTS `pospi_view_onlinecard_info`;

/*!50001 CREATE TABLE  `pospi_view_onlinecard_info`(
 `cardNo` varchar(50) ,
 `cardUid` varchar(50) ,
 `cardType` int(11) ,
 `shop` varchar(50) ,
 `cardStatus` char(50) ,
 `cardAmount` double(11,2) ,
 `lastChangeAmount` double(11,2) ,
 `lastChangeTime` datetime ,
 `enableTime` datetime ,
 `createTime` datetime ,
 `correctingTime` datetime ,
 `note` varchar(200) ,
 `typeName` varchar(50) ,
 `typeNote` varchar(200) ,
 `action` varchar(50) ,
 `mortgageAmount` double 
)*/;

/*View structure for view View_JKD */

/*!50001 DROP TABLE IF EXISTS `View_JKD` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `View_JKD` AS select `JKD_Head`.`sid` AS `sid`,`JKD_Head`.`uid` AS `uid`,`JKD_Head`.`no` AS `no`,`JKD_Head`.`shopId` AS `shopId`,`Shop`.`Name` AS `ShopName`,`JKD_Head`.`cashierNo` AS `cashierNo`,`Cashier`.`Name` AS `CashierName`,`JKD_Head`.`jkMoney` AS `jkMoney`,`JKD_Head`.`jkDate_D` AS `jkDate_D`,`JKD_Head`.`upLoadTime_D` AS `upLoadTime_D`,`JKD_Head`.`deviceId` AS `deviceId` from ((`JKD_Head` left join `Shop` on((`JKD_Head`.`shopId` = `Shop`.`Id`))) left join `Cashier` on(((`JKD_Head`.`uid` = `Cashier`.`UId`) and (`JKD_Head`.`cashierNo` = `Cashier`.`Number`)))) */;

/*View structure for view View_JKD_Detail */

/*!50001 DROP TABLE IF EXISTS `View_JKD_Detail` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `View_JKD_Detail` AS select `View_JKD`.`sid` AS `sid`,`View_JKD`.`uid` AS `uid`,`View_JKD`.`no` AS `no`,`View_JKD`.`shopId` AS `shopId`,`View_JKD`.`ShopName` AS `ShopName`,`View_JKD`.`cashierNo` AS `cashierNo`,`View_JKD`.`CashierName` AS `CashierName`,`View_JKD`.`jkMoney` AS `TotalMoney`,`View_JKD`.`jkDate_D` AS `jkDate_D`,`View_JKD`.`upLoadTime_D` AS `upLoadTime_D`,`View_JKD`.`deviceId` AS `deviceId`,`JKD_Detail`.`payMoney` AS `payMoney`,`JKD_Detail`.`payType` AS `payType` from (`View_JKD` left join `JKD_Detail` on((`JKD_Detail`.`jkSid` = `View_JKD`.`sid`))) */;

/*View structure for view View_Order_PayType */

/*!50001 DROP TABLE IF EXISTS `View_Order_PayType` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `View_Order_PayType` AS select `Order_PayType`.`Id` AS `Id`,`Order_PayType`.`sid` AS `sid`,`Order_PayType`.`Uid` AS `Uid`,`Order_PayType`.`code` AS `code`,`Order_PayType`.`colorCode` AS `colorCode`,`Order_PayType`.`name` AS `name`,`Order_PayType`.`order_sid` AS `order_sid`,`Order_PayType`.`orderBy` AS `orderBy`,`Order_PayType`.`payType` AS `payType`,`Order_PayType`.`price` AS `price`,`Order_PayType`.`status` AS `status`,`Order_PayType`.`lineNum` AS `lineNum`,`Order_PayType`.`payId` AS `payId`,`Order_PayType`.`payNumber1` AS `payNumber1`,`Order_PayType`.`payNumber2` AS `payNumber2`,`Order_PayType`.`payNumber3` AS `payNumber3`,`Order_PayType`.`obj1` AS `obj1`,`Order_PayType`.`obj2` AS `obj2`,`Order_PayType`.`obj4` AS `obj4`,`Order_PayType`.`obj5` AS `obj5`,`Order_PayType`.`UpLoadTime` AS `UpLoadTime`,`Order_PayType`.`IsClear` AS `IsClear`,`Report_Order`.`CreateTime` AS `CreateTime`,`Report_Order`.`yyyyMMdd` AS `yyyyMMdd`,`Report_Order`.`year` AS `year`,`Report_Order`.`month` AS `month`,`Report_Order`.`day` AS `day`,`Report_Order`.`HH` AS `HH`,`Report_Order`.`mm` AS `mm`,`Report_Order`.`DPH` AS `DPH`,`Report_Order`.`SYJH` AS `SYJH`,`Report_Order`.`XPH` AS `XPH`,`Report_Order`.`SYYH` AS `SYYH`,`Report_Order`.`SYYM` AS `SYYM` from (`Order_PayType` join `Report_Order`) where (`Order_PayType`.`order_sid` = `Report_Order`.`Sid`) */;

/*View structure for view pospi_view_onlinecard_info */

/*!50001 DROP TABLE IF EXISTS `pospi_view_onlinecard_info` */;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `pospi_view_onlinecard_info` AS select `pospi_onlinecard_info`.`cardNo` AS `cardNo`,`pospi_onlinecard_info`.`cardUid` AS `cardUid`,`pospi_onlinecard_info`.`cardType` AS `cardType`,`pospi_onlinecard_info`.`shop` AS `shop`,`pospi_onlinecard_info`.`cardStatus` AS `cardStatus`,`pospi_onlinecard_info`.`cardAmount` AS `cardAmount`,`pospi_onlinecard_info`.`lastChangeAmount` AS `lastChangeAmount`,`pospi_onlinecard_info`.`lastChangeTime` AS `lastChangeTime`,`pospi_onlinecard_info`.`enableTime` AS `enableTime`,`pospi_onlinecard_info`.`createTime` AS `createTime`,`pospi_onlinecard_info`.`correctingTime` AS `correctingTime`,`pospi_onlinecard_info`.`note` AS `note`,`pospi_onlinecard_type`.`typeName` AS `typeName`,`pospi_onlinecard_type`.`typeNote` AS `typeNote`,`pospi_onlinecard_type`.`action` AS `action`,`pospi_onlinecard_type`.`mortgageAmount` AS `mortgageAmount` from (`pospi_onlinecard_info` left join `pospi_onlinecard_type` on((`pospi_onlinecard_info`.`cardType` = `pospi_onlinecard_type`.`id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
