select
`fm`.`id` AS `facility_master_id`,
`fm`.`customer_id` AS `customer_id`,
`fm`.`payment_plan_master_id` AS `payment_plan_master_id`,
`fm`.`repayment_schema_generated` AS `repayment_schema_generated`,
`fm`.`is_active` AS `is_active`,`fm`.`deleted` AS `deleted`,
`sls`.`blockrefnumber`,
`sls`.`refno` AS `sales_ref_no`,
`prj`.`projectcode` AS `projectcode`,
`prj`.`projectname` AS `project_name`,
`lctn`.`locationcode` AS `locationcode`,
`lctn`.`locationname` AS `location_name`,
`lctn`.`locationcity` AS `location_city`,
`pj`.`blocknumber`
from (
((`nmwndb_asiast`.`facility_master` 
`fm` join `nmwndb`.`sales` `sls`
 on((`fm`.`sales_ref_no` = `sls`.`refno`))) 
join `nmwndb`.`project` `prj`
 on((`sls`.`projectcode` = `prj`.`projectcode`)))
 join `nmwndb`.`location` `lctn` 
on((`sls`.`locationcode` = `lctn`.`locationcode`))
  join `nmwndb`.`projectdetails` `pj`
on((`sls`.`blockrefnumber` = `pj`.`refno`))
)



CREATE VIEW nmwndb_asiast.view_facility_sale_project_location AS
SELECT 
`fm`.`id` AS `facility_master_id`,
 `fm`.`customer_id` AS `customer_id`,
 `fm`.`deleted` AS `deleted`,
 `sls`.`refno` AS `sales_ref_no`,
 `prj`.`projectcode` AS `projectcode`,
 `prj`.`projectname` AS `project_name`,
 `lctn`.`locationcode` AS `locationcode`,
 `lctn`.`locationname` AS `location_name`,
 `lctn`.`locationcity` AS `location_city`
FROM ((`nmwndb_asiast`.`facility_master` `fm` JOIN `nmwndb`.`sales` `sls`ON((`fm`.`sales_ref_no` = `sls`.`refno`)))
JOIN `nmwndb`.`project` `prj` ON((`sls`.`projectcode` = `prj`.`projectcode`))
JOIN `nmwndb`.`location` `lctn` ON((`sls`.`locationcode` = `lctn`.`locationcode`)));


select
 `rps`.`id` AS `repayment_schema_id`,
 `rps`.`facility_master_id` AS `facility_master_id`,
 `rps`.`customer_id` AS `customer_id`,
 `rps`.`amount_payable` AS `amount_payable`,
 `rps`.`paid` AS `paid`,
 `rps`.`receipt_id` AS `receipt_id`,
 `rps`.`is_istallment` AS `is_installment`,
 `pmntmodel`.`is_installment_definer` AS `is_installment_definer`,
 `pmntmodel`.`payment_plan_item_id` AS `payment_plan_item_id`,
 `pmntmodel`.`payment_plan_master_id` AS `payment_plan_master_id`,
 `pmntmodel`.`payment_sequence` AS `payment_sequence`,
 `pitem`.`name` AS `payment_plan_item`
 from ((
    `nmwndb_asiast`.`repayment_schema` `rps` 
 join `nmwndb_asiast`.`payment_model` `pmntmodel`
 on((`rps`.`payment_model_id` = `pmntmodel`.`id`)))
 join `nmwndb_asiast`.`payment_plan_items` `pitem`
 on((`pitem`.`id` = `pmntmodel`.`payment_plan_item_id`)));



-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2015 at 08:05 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `nmwndb_asiast`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_action_permission`
--

DROP TABLE IF EXISTS `auth_action_permission`;
CREATE TABLE IF NOT EXISTS `auth_action_permission` (
`id` int(11) NOT NULL COMMENT 'Action ID',
  `module` varchar(50) NOT NULL COMMENT 'Module',
  `action` varchar(100) NOT NULL COMMENT 'Action Name',
  `description` varchar(150) NOT NULL COMMENT 'Description',
  `systemid` int(11) NOT NULL DEFAULT '0' COMMENT 'System ID Number'
) ENGINE=MyISAM AUTO_INCREMENT=142 DEFAULT CHARSET=latin1 COMMENT='Action Permission';

--
-- Dumping data for table `auth_action_permission`
--

INSERT INTO `auth_action_permission` (`id`, `module`, `action`, `description`, `systemid`) VALUES
(130, 'User', 'View', '', 1),
(131, 'User', 'Create', '', 1),
(132, 'User', 'Update', '', 1),
(133, 'User', 'Delete', '', 1),
(134, 'User', 'Index', '', 1),
(135, 'User', 'Admin', '', 1),
(136, 'UserRoleRef', 'View', '', 1),
(137, 'UserRoleRef', 'Create', '', 1),
(138, 'UserRoleRef', 'Update', '', 1),
(139, 'UserRoleRef', 'Delete', '', 1),
(140, 'UserRoleRef', 'Index', '', 1),
(141, 'UserRoleRef', 'Admin', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_role`
--

DROP TABLE IF EXISTS `auth_role`;
CREATE TABLE IF NOT EXISTS `auth_role` (
`rid` int(11) NOT NULL COMMENT 'Role ID',
  `name` varchar(20) NOT NULL COMMENT 'Role Name',
  `description` varchar(150) NOT NULL COMMENT 'Description'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='User Role';

--
-- Dumping data for table `auth_role`
--

INSERT INTO `auth_role` (`rid`, `name`, `description`) VALUES
(1, 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `auth_role_action_permission`
--

DROP TABLE IF EXISTS `auth_role_action_permission`;
CREATE TABLE IF NOT EXISTS `auth_role_action_permission` (
  `rid` int(11) NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Role - Action_Permission Mapping';

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE IF NOT EXISTS `auth_user` (
`uid` int(11) NOT NULL COMMENT 'User ID',
  `enabled` tinyint(4) NOT NULL COMMENT 'User is enabled',
  `loginname` varchar(200) NOT NULL COMMENT 'User Name',
  `familyname` varchar(200) NOT NULL COMMENT 'Family Name',
  `firstname` varchar(200) NOT NULL COMMENT 'First Name',
  `password` varchar(200) NOT NULL COMMENT 'Password',
  `deleted` tinyint(4) DEFAULT '0' COMMENT 'Delete Status'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='User';

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`uid`, `enabled`, `loginname`, `familyname`, `firstname`, `password`, `deleted`) VALUES
(1, 1, 'admin', 'Admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_role_ref`
--

DROP TABLE IF EXISTS `auth_user_role_ref`;
CREATE TABLE IF NOT EXISTS `auth_user_role_ref` (
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User - Role Mapping';

--
-- Dumping data for table `auth_user_role_ref`
--

INSERT INTO `auth_user_role_ref` (`uid`, `rid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `facility_master`
--

DROP TABLE IF EXISTS `facility_master`;
CREATE TABLE IF NOT EXISTS `facility_master` (
`id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_plan_master_id` int(11) NOT NULL,
  `sales_ref_no` int(11) NOT NULL,
  `repayment_schema_generated` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment_bank`
--

DROP TABLE IF EXISTS `payment_bank`;
CREATE TABLE IF NOT EXISTS `payment_bank` (
`id` int(11) NOT NULL,
  `bank_code` varchar(20) COLLATE utf8_bin NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payment_bank`
--

INSERT INTO `payment_bank` (`id`, `bank_code`, `bank_name`, `sort_order`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'UD', 'Undefined', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'PBC', 'People''s Bank', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'COM', 'Commercial Bank Of Ceylon', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'SAMP', 'Sampath Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 'BOC', 'Bank Of Ceylon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 'DFCC', 'DFCC Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 'HNB', 'Hatton National Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 'HSBC', 'HSBC Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 'NTB', 'Nations Trust Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(10, 'NDB', 'National Development Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(11, 'PABC', 'Pan Asia Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 'SEYB', 'Seylan Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(13, 'UB', 'Union Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(14, 'AB', 'Amana Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(15, 'SCB', 'Standard Chartered Bank', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(16, 'MCB', 'MCB Islamic Banking', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(17, 'ASST', 'Asia Asset', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_model`
--

DROP TABLE IF EXISTS `payment_model`;
CREATE TABLE IF NOT EXISTS `payment_model` (
`id` int(11) NOT NULL,
  `payment_plan_master_id` int(11) NOT NULL,
  `payment_plan_item_id` int(11) NOT NULL,
  `is_installment_definer` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'flag to idenfy if it is the installment definer in the payment model. only one payment definer can be defined per payment model',
  `no_of_installments` int(11) NOT NULL,
  `installment_amount` float NOT NULL,
  `interest` float DEFAULT '0',
  `tax` float NOT NULL DEFAULT '0',
  `total_payable` float NOT NULL,
  `payment_sequence` int(11) NOT NULL DEFAULT '1' COMMENT 'defines the order in which payments will be accepted',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Table structure for table `payment_plan_items`
--

DROP TABLE IF EXISTS `payment_plan_items`;
CREATE TABLE IF NOT EXISTS `payment_plan_items` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan_master`
--

DROP TABLE IF EXISTS `payment_plan_master`;
CREATE TABLE IF NOT EXISTS `payment_plan_master` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `assign_to_customer_id` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Table structure for table `payment_receipts_imports_mapping`
--

DROP TABLE IF EXISTS `payment_receipts_imports_mapping`;
CREATE TABLE IF NOT EXISTS `payment_receipts_imports_mapping` (
`id` bigint(20) NOT NULL,
  `old_receipt_no` int(11) NOT NULL,
  `new_receipt_no` int(11) NOT NULL,
  `sale_ref_no` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Table structure for table `payment_receipts_master`
--

DROP TABLE IF EXISTS `payment_receipts_master`;
CREATE TABLE IF NOT EXISTS `payment_receipts_master` (
`id` int(11) NOT NULL COMMENT 'receipt number',
  `facility_master_id` int(11) NOT NULL COMMENT 'Facility Master table reference',
  `customer_id` int(11) NOT NULL COMMENT 'customer code',
  `customer_name` varchar(255) NOT NULL COMMENT 'customer name',
  `customer_address` text NOT NULL,
  `transaction_id` int(11) NOT NULL COMMENT 'transaction id',
  `amount_paid` float NOT NULL,
  `receipt_date` date NOT NULL,
  `deleted` tinyint(4) DEFAULT '0' COMMENT 'Record deleted',
  `addedby` int(11) DEFAULT NULL COMMENT 'Added by',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name_of_scheme` varchar(255) DEFAULT NULL,
  `house_number` varchar(255) DEFAULT NULL,
  `value_of_house` float DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `old_receipt_no` int(11) NOT NULL DEFAULT '0' COMMENT 'imported receipt number from nimavin backoffice system'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='customer payment receipts';


DROP TABLE IF EXISTS `payment_receipt_details`;
CREATE TABLE IF NOT EXISTS `payment_receipt_details` (
`id` bigint(20) NOT NULL,
  `payment_receipt_master_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `payment_type` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'cash, cheque, bank deposit, etc',
  `cheque_number` varchar(20) COLLATE utf8_bin NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `cheque_date` date DEFAULT NULL,
  `amount` float NOT NULL,
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `payment_receipt_print_counter`
--

DROP TABLE IF EXISTS `payment_receipt_print_counter`;
CREATE TABLE IF NOT EXISTS `payment_receipt_print_counter` (
`id` int(11) NOT NULL,
  `receipt_master_id` int(11) NOT NULL,
  `printed_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE IF NOT EXISTS `payment_types` (
`id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `created_at`, `updated_at`, `sort_order`) VALUES
(1, 'CASH', '0000-00-00 00:00:00', 0, 1),
(2, 'CHEQUE', '0000-00-00 00:00:00', 0, 2),
(3, 'BANK DEPOSIT', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `repayment_schema`
--

DROP TABLE IF EXISTS `repayment_schema`;
CREATE TABLE IF NOT EXISTS `repayment_schema` (
`id` int(11) NOT NULL,
  `facility_master_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_model_id` int(11) NOT NULL,
  `payment_plan_master_id` int(11) NOT NULL,
  `amount_payable` float NOT NULL,
  `amount_paid` float NOT NULL,
  `amount_diff` float NOT NULL,
  `installment_number` int(11) NOT NULL,
  `payment_due_date` date NOT NULL,
  `paid` tinyint(4) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `is_istallment` tinyint(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Table structure for table `repayment_schema_settlement`
--

DROP TABLE IF EXISTS `repayment_schema_settlement`;
CREATE TABLE IF NOT EXISTS `repayment_schema_settlement` (
`id` bigint(20) NOT NULL,
  `facility_master_id` int(11) NOT NULL,
  `payment_receipt_master_id` int(11) NOT NULL,
  `repayment_schema_id` int(11) NOT NULL,
  `paid_full` tinyint(4) NOT NULL COMMENT '1-Y, 0-N(partially paid)',
  `amount_payable` float NOT NULL COMMENT 'amount_payable - amount_paid',
  `amount_paid` float NOT NULL,
  `balance_bf` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment` tinytext COLLATE utf8_bin,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `temp_receipt`
--

DROP TABLE IF EXISTS `temp_receipt`;
CREATE TABLE IF NOT EXISTS `temp_receipt` (
`id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
`id` bigint(20) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Stand-in structure for view `view_facility_customer_block_relation`
--
DROP VIEW IF EXISTS `view_facility_customer_block_relation`;
CREATE TABLE IF NOT EXISTS `view_facility_customer_block_relation` (
`facility_master_id` int(11)
,`customer_id` int(11)
,`sales_ref_no` int(11)
,`is_active` tinyint(4)
,`deleted` tinyint(4)
,`customercode` int(11)
,`familyname` varchar(100)
,`firstname` varchar(100)
,`addressline1` varchar(100)
,`addressline2` varchar(100)
,`passportno` varchar(100)
,`mobile` varchar(100)
,`blocknumber` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_facility_customer_relation`
--
DROP VIEW IF EXISTS `view_facility_customer_relation`;
CREATE TABLE IF NOT EXISTS `view_facility_customer_relation` (
`facility_master_id` int(11)
,`customer_id` int(11)
,`sales_ref_no` int(11)
,`is_active` tinyint(4)
,`deleted` tinyint(4)
,`customercode` int(11)
,`familyname` varchar(100)
,`firstname` varchar(100)
,`addressline1` varchar(100)
,`addressline2` varchar(100)
,`passportno` varchar(100)
,`mobile` varchar(100)
);
-- --------------------------------------------------------

--
-- Structure for view `view_facility_customer_block_relation`
--
DROP TABLE IF EXISTS `view_facility_customer_block_relation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_facility_customer_block_relation` AS select `fm`.`id` AS `facility_master_id`,`fm`.`customer_id` AS `customer_id`,`fm`.`sales_ref_no` AS `sales_ref_no`,`fm`.`is_active` AS `is_active`,`fm`.`deleted` AS `deleted`,`cs`.`customercode` AS `customercode`,`cs`.`familyname` AS `familyname`,`cs`.`firstname` AS `firstname`,`cs`.`addressline1` AS `addressline1`,`cs`.`addressline2` AS `addressline2`,`cs`.`passportno` AS `passportno`,`cs`.`mobile` AS `mobile`,`pd`.`blocknumber` AS `blocknumber` from (((`nmwndb`.`customerdetails` `cs` join `facility_master` `fm` on((`fm`.`customer_id` = `cs`.`customercode`))) join `nmwndb`.`sales` `sls` on((`sls`.`refno` = `fm`.`sales_ref_no`))) join `nmwndb`.`projectdetails` `pd` on((`sls`.`blockrefnumber` = `pd`.`refno`)));

-- --------------------------------------------------------

--
-- Structure for view `view_facility_customer_relation`
--
DROP TABLE IF EXISTS `view_facility_customer_relation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_facility_customer_relation` AS select `fm`.`id` AS `facility_master_id`,`fm`.`customer_id` AS `customer_id`,`fm`.`sales_ref_no` AS `sales_ref_no`,`fm`.`is_active` AS `is_active`,`fm`.`deleted` AS `deleted`,`cs`.`customercode` AS `customercode`,`cs`.`familyname` AS `familyname`,`cs`.`firstname` AS `firstname`,`cs`.`addressline1` AS `addressline1`,`cs`.`addressline2` AS `addressline2`,`cs`.`passportno` AS `passportno`,`cs`.`mobile` AS `mobile` from (`nmwndb`.`customerdetails` `cs` join `facility_master` `fm` on((`fm`.`customer_id` = `cs`.`customercode`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_action_permission`
--
ALTER TABLE `auth_action_permission`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `action_permission_U_1` (`module`,`action`);

--
-- Indexes for table `auth_role`
--
ALTER TABLE `auth_role`
 ADD PRIMARY KEY (`rid`), ADD UNIQUE KEY `role_U_1` (`name`);

--
-- Indexes for table `auth_role_action_permission`
--
ALTER TABLE `auth_role_action_permission`
 ADD PRIMARY KEY (`rid`,`aid`), ADD KEY `role_action_permission_ref_FI_2` (`aid`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `user_U_1` (`loginname`);

--
-- Indexes for table `auth_user_role_ref`
--
ALTER TABLE `auth_user_role_ref`
 ADD PRIMARY KEY (`uid`), ADD KEY `user_role_ref_FI_2` (`rid`);

--
-- Indexes for table `facility_master`
--
ALTER TABLE `facility_master`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `payment_plan_master_id` (`payment_plan_master_id`);

--
-- Indexes for table `payment_bank`
--
ALTER TABLE `payment_bank`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_model`
--
ALTER TABLE `payment_model`
 ADD PRIMARY KEY (`id`), ADD KEY `payment_plan_master_id` (`payment_plan_master_id`,`payment_plan_item_id`), ADD KEY `payment_plan_item_id` (`payment_plan_item_id`);

--
-- Indexes for table `payment_plan_items`
--
ALTER TABLE `payment_plan_items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plan_master`
--
ALTER TABLE `payment_plan_master`
 ADD PRIMARY KEY (`id`), ADD KEY `assign_to_customer_id` (`assign_to_customer_id`);

--
-- Indexes for table `payment_receipts_imports_mapping`
--
ALTER TABLE `payment_receipts_imports_mapping`
 ADD PRIMARY KEY (`id`), ADD KEY `old_receipt_no` (`old_receipt_no`), ADD KEY `new_receipt_no` (`new_receipt_no`);

--
-- Indexes for table `payment_receipts_master`
--
ALTER TABLE `payment_receipts_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_receipt_details`
--
ALTER TABLE `payment_receipt_details`
 ADD PRIMARY KEY (`id`), ADD KEY `payment_receipt_master_id` (`payment_receipt_master_id`), ADD KEY `payment_type_id` (`payment_type_id`), ADD KEY `bank_id` (`bank_id`);

--
-- Indexes for table `payment_receipt_print_counter`
--
ALTER TABLE `payment_receipt_print_counter`
 ADD PRIMARY KEY (`id`), ADD KEY `receipt_master_id` (`receipt_master_id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repayment_schema`
--
ALTER TABLE `repayment_schema`
 ADD PRIMARY KEY (`id`), ADD KEY `facility_master_id` (`facility_master_id`,`customer_id`,`payment_model_id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `payment_model_id` (`payment_model_id`), ADD KEY `payment_plan_master_id` (`payment_plan_master_id`);

--
-- Indexes for table `repayment_schema_settlement`
--
ALTER TABLE `repayment_schema_settlement`
 ADD PRIMARY KEY (`id`), ADD KEY `payment_receipt_master_id` (`payment_receipt_master_id`), ADD KEY `repayment_schema_id` (`repayment_schema_id`), ADD KEY `facility_master_id` (`facility_master_id`);

--
-- Indexes for table `temp_receipt`
--
ALTER TABLE `temp_receipt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_action_permission`
--
ALTER TABLE `auth_action_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Action ID',AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `auth_role`
--
ALTER TABLE `auth_role`
MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role ID',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `facility_master`
--
ALTER TABLE `facility_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_bank`
--
ALTER TABLE `payment_bank`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `payment_model`
--
ALTER TABLE `payment_model`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payment_plan_items`
--
ALTER TABLE `payment_plan_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment_plan_master`
--
ALTER TABLE `payment_plan_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_receipts_imports_mapping`
--
ALTER TABLE `payment_receipts_imports_mapping`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_receipts_master`
--
ALTER TABLE `payment_receipts_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'receipt number',AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_receipt_details`
--
ALTER TABLE `payment_receipt_details`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_receipt_print_counter`
--
ALTER TABLE `payment_receipt_print_counter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `repayment_schema`
--
ALTER TABLE `repayment_schema`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `repayment_schema_settlement`
--
ALTER TABLE `repayment_schema_settlement`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `temp_receipt`
--
ALTER TABLE `temp_receipt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=372;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_user_role_ref`
--
ALTER TABLE `auth_user_role_ref`
ADD CONSTRAINT `auth_user_role_ref_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `auth_user` (`uid`),
ADD CONSTRAINT `auth_user_role_ref_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `auth_role` (`rid`);

--
-- Constraints for table `facility_master`
--
ALTER TABLE `facility_master`
ADD CONSTRAINT `facility_master_ibfk_1` FOREIGN KEY (`payment_plan_master_id`) REFERENCES `payment_plan_master` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `payment_model`
--
ALTER TABLE `payment_model`
ADD CONSTRAINT `payment_model_ibfk_1` FOREIGN KEY (`payment_plan_master_id`) REFERENCES `payment_plan_master` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `payment_model_ibfk_2` FOREIGN KEY (`payment_plan_item_id`) REFERENCES `payment_plan_items` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `payment_receipts_imports_mapping`
--
ALTER TABLE `payment_receipts_imports_mapping`
ADD CONSTRAINT `payment_receipts_imports_mapping_ibfk_1` FOREIGN KEY (`new_receipt_no`) REFERENCES `payment_receipts_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_receipt_details`
--
ALTER TABLE `payment_receipt_details`
ADD CONSTRAINT `payment_receipt_details_ibfk_2` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`),
ADD CONSTRAINT `payment_receipt_details_ibfk_3` FOREIGN KEY (`payment_receipt_master_id`) REFERENCES `payment_receipts_master` (`id`),
ADD CONSTRAINT `payment_receipt_details_ibfk_4` FOREIGN KEY (`bank_id`) REFERENCES `payment_bank` (`id`);

--
-- Constraints for table `repayment_schema_settlement`
--
ALTER TABLE `repayment_schema_settlement`
ADD CONSTRAINT `repayment_schema_settlement_ibfk_1` FOREIGN KEY (`payment_receipt_master_id`) REFERENCES `payment_receipts_master` (`id`),
ADD CONSTRAINT `repayment_schema_settlement_ibfk_2` FOREIGN KEY (`repayment_schema_id`) REFERENCES `repayment_schema` (`id`),
ADD CONSTRAINT `repayment_schema_settlement_ibfk_3` FOREIGN KEY (`facility_master_id`) REFERENCES `facility_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

select
 `rps`.`id` AS `repayment_schema_id`,
 `rps`.`facility_master_id` AS `facility_master_id`,
 `rps`.`customer_id` AS `customer_id`,
 `rps`.`amount_payable` AS `amount_payable`,
 `rps`.`paid` AS `paid`,
 `rps`.`receipt_id` AS `receipt_id`,
 `rps`.`is_istallment` AS `is_installment`,
 `pmntmodel`.`is_installment_definer` AS `is_installment_definer`,
 `pmntmodel`.`payment_plan_item_id` AS `payment_plan_item_id`,
 `pmntmodel`.`payment_plan_master_id` AS `payment_plan_master_id`,
 `pmntmodel`.`payment_sequence` AS `payment_sequence`,
 `pitem`.`name` AS `payment_plan_item`
 from ((
    `nmwndb_asiast`.`repayment_schema` `rps` 
 join `nmwndb_asiast`.`payment_model` `pmntmodel`
 on((`rps`.`payment_model_id` = `pmntmodel`.`id`)))
 join `nmwndb_asiast`.`payment_plan_items` `pitem`
 on((`pitem`.`id` = `pmntmodel`.`payment_plan_item_id`)));


SELECT 
 `fm`.`id` AS  `facility_master_id`,
 `fm`.`customer_id` AS  `customer_id`,
 `fm`.`deleted` AS  `deleted`,
 `sls`.`refno` AS `sales_ref_no`,
 `prj`.`projectname` AS `project_name`,
 `lctn`.`locationname` AS `location_name`,
 `lctn`.`locationcity` AS `location_city`,
from((
        `nmwndb_asiast`.`facility_master` `fm`
        JOIN `nmwndb`.`sales` `sls`
        ON((`fm`.`sales_ref_no` = `sls`.`refno`)))

        JOIN `nmwndb`.`project` `prj`
        ON((`sls`.`projectcode` = `prj`.`projectcode`))

        JOIN `nmwndb`.`project` `prj`
        ON((`sls`.`locationcode` = `prj`.`locationcode`))
);

select
 `cs`.`customercode` AS `customercode`,
 `cs`.`familyname` AS `familyname`,
 `cs`.`firstname` AS `firstname`,
 `cs`.`title` AS `title`,`cs`.`addressline1` AS `addressline1`,
 `cs`.`addressline2` AS `addressline2`,
 `cs`.`passportno` AS `passportno`,`cs`.`mobile` AS `mobile`,
 `pd`.`blocknumber` AS `blocknumber`,`pd`.`refno` AS `refno`,
 `pd`.`projectcode` AS `projectcode`,
 `prj`.`projectname` AS `project_name`
  from ((
          `nmwndb`.`customerdetails` `cs`
          join `nmwndb`.`projectdetails` `pd`
          on((`cs`.`customercode` = `pd`.`customercode`)))

          join `nmwndb`.`project` `prj`
          on((`pd`.`projectcode` = `prj`.`projectcode`))

  );

--   old system merge db changes


--
-- Structure for view `view_customer_block_relation`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_customer_block_relation` AS select `cs`.`customercode` AS `customercode`,`cs`.`familyname` AS `familyname`,`cs`.`firstname` AS `firstname`,`cs`.`title` AS `title`,`cs`.`addressline1` AS `addressline1`,`cs`.`addressline2` AS `addressline2`,`cs`.`passportno` AS `passportno`,`cs`.`mobile` AS `mobile`,`pd`.`blocknumber` AS `blocknumber`,`pd`.`refno` AS `refno`,`pd`.`projectcode` AS `projectcode`,`prj`.`projectname` AS `project_name` from ((`customerdetails` `cs` join `projectdetails` `pd` on((`cs`.`customercode` = `pd`.`customercode`))) join `project` `prj` on((`pd`.`projectcode` = `prj`.`projectcode`)));

--
-- VIEW  `view_customer_block_relation`
-- Data: None
--