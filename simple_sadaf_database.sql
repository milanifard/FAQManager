DROP database IF EXISTS sadaf_faq;

create database sadaf_faq char set utf8 collate utf8_persian_ci;

use sadaf_faq;

DROP TABLE IF EXISTS `sadaf_faq`.`AccountSpecs`;
CREATE TABLE  `sadaf_faq`.`AccountSpecs` (
  `AccountSpecID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `UserPassword` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `PersonID` int(11) DEFAULT NULL,
  PRIMARY KEY (`AccountSpecID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`EMonArray`;
CREATE TABLE  `sadaf_faq`.`EMonArray` (
  `_id` int(11) NOT NULL,
  `emon` int(11) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`FacilityPages`;
CREATE TABLE  `sadaf_faq`.`FacilityPages` (
  `FacilityPageID` int(11) NOT NULL AUTO_INCREMENT,
  `FacilityID` int(11) DEFAULT NULL,
  `PageName` varchar(145) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`FacilityPageID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`FMonArray`;
CREATE TABLE  `sadaf_faq`.`FMonArray` (
  `_id` int(11) NOT NULL,
  `fmon` int(11) DEFAULT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`persons`;
CREATE TABLE  `sadaf_faq`.`persons` (
  `PersonID` int(11) NOT NULL AUTO_INCREMENT,
  `pfname` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
  `plname` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL,
  `CardNumber` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`PersonID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`SysAudit`;
CREATE TABLE  `sadaf_faq`.`SysAudit` (
  `RecID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `ActionType` tinyint(3) unsigned DEFAULT NULL,
  `ActionDesc` varchar(500) COLLATE utf8_persian_ci DEFAULT NULL,
  `IPAddress` bigint(20) DEFAULT NULL,
  `SysCode` tinyint(3) unsigned DEFAULT NULL,
  `IsSecure` tinyint(3) unsigned DEFAULT NULL,
  `ATS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`RecID`),
  KEY `UserID` (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`SystemDBLog`;
CREATE TABLE  `sadaf_faq`.`SystemDBLog` (
  `RecID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'صفحه',
  `query` text COLLATE utf8_persian_ci COMMENT 'پرس و جو',
  `SerializedParam` text COLLATE utf8_persian_ci COMMENT 'پارامتر پرس و جو',
  `UserID` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'شناسه کاربر',
  `IPAddress` bigint(20) DEFAULT NULL COMMENT 'آدرس IP',
  `SysCode` tinyint(3) unsigned DEFAULT NULL COMMENT 'کد سیستم',
  `ATS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'تاریخ اجرا',
  `ExecuteTime` float(14,10) NOT NULL COMMENT 'مدت زمان اجرا',
  `QueryStatus` enum('SUCCESS','FAILED') COLLATE utf8_persian_ci DEFAULT 'SUCCESS' COMMENT 'وضعیت پرس و جو',
  `DBName` varchar(30) COLLATE utf8_persian_ci DEFAULT '' COMMENT 'نام پایگاه داده',
  PRIMARY KEY (`RecID`),
  KEY `UserID` (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`SpecialPages`;
CREATE TABLE  `sadaf_faq`.`SpecialPages` (
  `SpecialPageID` int(11) NOT NULL AUTO_INCREMENT,
  `PageName` varchar(245) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`SpecialPageID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`SystemFacilities`;
CREATE TABLE  `sadaf_faq`.`SystemFacilities` (
  `FacilityID` int(11) NOT NULL AUTO_INCREMENT,
  `FacilityName` varchar(245) COLLATE utf8_persian_ci DEFAULT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `OrderNo` int(11) DEFAULT NULL,
  `PageAddress` varchar(345) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`FacilityID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`SystemFacilityGroups`;
CREATE TABLE  `sadaf_faq`.`SystemFacilityGroups` (
  `GroupID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(145) COLLATE utf8_persian_ci DEFAULT NULL,
  `OrderNo` int(11) DEFAULT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

DROP TABLE IF EXISTS `sadaf_faq`.`UserFacilities`;
CREATE TABLE  `sadaf_faq`.`UserFacilities` (
  `FacilityPageID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `FacilityID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FacilityPageID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO sadaf_faq.SpecialPages VALUES (1,'main.php'),(2,'/main.php'),(3,'/Menu.php'),(4,'/MainContent.php'),(5,'/ChangePassword.php'),(6,'/MyActions.php'),(7,'/SelectPersonel.php'),(8,'/SelectCustomer.php'),(9,'/SelectStaff.php'),(10,'/GetExamItemPrice.php');


insert into sadaf_faq.persons (pfname, plname, CardNumber) values ('اميد', 'ميلاني فرد', '0');

insert into sadaf_faq.AccountSpecs (UserID, UserPassword, PersonID) values ('omid', 'omid3000', 1);

INSERT INTO sadaf_faq.SystemFacilityGroups VALUES (1,'مدیریت',1),(2,'عملیات کاری',3),(3,'گزارشات',4);

INSERT INTO sadaf_faq.SystemFacilities VALUES (1,'مدیریت افراد',1,3,'Managepersons.php'),(3,'مدیریت امکانات',1,2,'ManageSystemFacilities.php'),(4,'مدیریت گروه های منو',1,1,'ManageSystemFacilityGroups.php'),(5,'مدیریت کاربران',1,4,'ManageAccountSpecs.php');

INSERT INTO sadaf_faq.UserFacilities VALUES (1,'omid',1),(2,'omid',3),(3,'omid',4),(4,'omid',5);

INSERT INTO sadaf_faq.EMonArray VALUES (1,31),(2,28),(3,31),(4,30),(5,31),(6,30),(7,31),(8,31),(9,30),(10,31),(11,30),(12,31);

INSERT INTO sadaf_faq.FMonArray VALUES (1,31),(2,31),(3,31),(4,31),(5,31),(6,31),(7,30),(8,30),(9,30),(10,30),(11,30),(12,29);

INSERT INTO sadaf_faq.FacilityPages VALUES (9,5,'/ManageAccountSpecs.php'),(3,3,'/ManageSystemFacilities.php'),(4,3,'/ManageFacilityPages.php'),(5,3,'/ManageSystemFacilities.php'),(6,3,'/ManageUserFacilities.php'),(7,4,'/ManageSystemFacilityGroups.php'),(8,1,'/Managepersons.php'),(48,12,'/GetJasonData.php'),(25,5,'/ManageUserPermissions.php');

DELIMITER $$

DROP FUNCTION IF EXISTS `sadaf_faq`.`g2j`$$
CREATE FUNCTION  `sadaf_faq`.`g2j`(_edate  date) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN
declare gy,gm,gd    int ;
declare  g_day_no   int ;
declare  i  int;

declare j_day_no ,  j_np ,  jy , jm , jd  int ;
set gy  = year(_edate)-1600;
set gm = month(_edate)-1;
set gd  = day(_edate)-1;

if  (year(_edate) < 1900  or year(_edate) > 2100  )  or (month(_edate) <1  or month(_edate)  > 12 )   or  (day(_edate) < 1 or day(_edate) > 31 )  then
return 'date-error';
end if;

set g_day_no = 365 * gy + floor((gy+3) /  4) - floor((gy+99) / 100) + floor((gy+399)/ 400);

set i=0;
while i < gm do
  set g_day_no=g_day_no+(select  emon from EMonArray  where _id=i+1);
  set i = i + 1;
end while;
if  gm >1  and ((gy % 4 =0 and gy % 100 !=0)  or  (gy%400=0))   then
  set g_day_no = g_day_no + 1 ;
end if;
set  g_day_no = g_day_no + gd;
set  j_day_no =  g_day_no-79;
set  j_np = floor(j_day_no /  12053);
set  j_day_no = j_day_no % 12053;
set  jy = 979+33 *  j_np + 4  *  floor(j_day_no /  1461);
set j_day_no = j_day_no % 1461;

if   j_day_no >= 366  then
  set jy = jy + floor((j_day_no-1) /  365);
  set j_day_no = (j_day_no-1) % 365;
end if;

set  i=0;
while  i < 11  and j_day_no >=  ( select fmon from FMonArray  where _id= i + 1)  do
  set j_day_no = j_day_no - ( select fmon from FMonArray  where _id = i + 1);
  set  i = i + 1;
end while;

set jm = i+1;
set jd = j_day_no+1;

return  concat_ws('/',jy,if(jm < 10 , concat('0',jm) , jm)    ,if(jd < 10 , concat('0',jd) , jd ));
END;

 $$

DELIMITER ;

DELIMITER $$

DROP FUNCTION IF EXISTS `sadaf_faq`.`j2g`$$
CREATE FUNCTION  `sadaf_faq`.`j2g`(j_y int , j_m int , j_d  int ) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN

declare  jy,jm,jd  int ;
declare  j_day_no , g_day_no   , gy,gm,gd  int ;
declare  i int ;
declare  leap  bool;

if  (j_y < 1300  or  j_y > 1450  )  or (j_m <1  or j_m  > 12 )   or  (j_d < 1 or j_d > 31 )  then
return 'date-error';
end if;


set  jy = j_y-979;
set  jm = j_m-1;
set  jd = j_d-1;

set j_day_no = 365 * jy + floor(jy/33) * 8 + floor(((jy%33)+3) /  4);
set i  = 0;
while  i < jm  do
  set j_day_no = j_day_no + (select fmon from FMonArray  where  _id=i+1);
  set i = i+1;
end while;
set  j_day_no = j_day_no + jd;
set  g_day_no = j_day_no+79;
set  gy = 1600 + 400 *  floor(g_day_no /  146097);
set  g_day_no = g_day_no % 146097;
set  leap = true;
if  g_day_no >= 36525  then   
  set g_day_no = g_day_no - 1;
  set gy = gy + 100 * floor(g_day_no /  36524);
  set g_day_no = g_day_no % 36524;
  if  g_day_no >= 365  then
    set g_day_no  =  g_day_no + 1;
  else
    set leap = false;
  end if;
end if;
set gy = gy + 4 *  floor(g_day_no / 1461);
set g_day_no = g_day_no % 1461;
if  g_day_no >= 366  then
  set leap = false;
  set g_day_no = g_day_no - 1 ;
  set gy = gy + floor(g_day_no /  365);
  set g_day_no = g_day_no % 365;
end if;
set  i = 0;
while  g_day_no >= ( select  emon from EMonArray  where _id = i + 1 ) + ( select if(i = 1 and  leap = true , 1 , 0) )   do
  set g_day_no = g_day_no - (( select  emon from EMonArray  where _id = i + 1)  + ( select if ( i = 1 and  leap= true ,1,0)));
  set i = i + 1;
end while;
set gm = i+1;
set gd = g_day_no+1;
return  concat_ws('-',gy , gm , gd );
END;

 $$

DELIMITER ;

