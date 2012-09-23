-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

--
-- Table `tl_form`
--
CREATE TABLE `tl_form` (
  `extendedInserttagsActive` char(1) NOT NULL default '',
  `extendedInserttagsKey` varchar(20) NOT NULL default '',
  `extendedInserttagsIdField` varchar(64) NOT NULL default '',
  `extendedInserttagsFormParam` varchar(20) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
