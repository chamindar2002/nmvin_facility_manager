SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `facility_master` ADD `is_refunded` TINYINT NOT NULL DEFAULT '0' AFTER `deleted`;


--
-- Table structure for table `facility_refunds`
--

DROP TABLE IF EXISTS `facility_refunds`;
CREATE TABLE IF NOT EXISTS `facility_refunds` (
`id` int(11) NOT NULL,
  `facility_master_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` text COLLATE utf8_bin NOT NULL,
  `block_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `refunded_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `refunded_amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facility_refunds`
--
ALTER TABLE `facility_refunds`
 ADD PRIMARY KEY (`id`), ADD KEY `facility_master_id` (`facility_master_id`,`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facility_refunds`
--
ALTER TABLE `facility_refunds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `facility_refunds`
--
ALTER TABLE `facility_refunds`
ADD CONSTRAINT `facility_refunds_ibfk_1` FOREIGN KEY (`facility_master_id`) REFERENCES `facility_master` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;




DROP TABLE IF EXISTS `refunded_receipts`;
CREATE TABLE IF NOT EXISTS `refunded_receipts` (
  `refund_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refunded_receipts`
--
ALTER TABLE `refunded_receipts`
 ADD KEY `refund_id` (`refund_id`,`receipt_id`), ADD KEY `receipt_id` (`receipt_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `refunded_receipts`
--
ALTER TABLE `refunded_receipts`
ADD CONSTRAINT `refunded_receipts_ibfk_1` FOREIGN KEY (`refund_id`) REFERENCES `facility_refunds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `refunded_receipts_ibfk_2` FOREIGN KEY (`receipt_id`) REFERENCES `payment_receipts_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


SET FOREIGN_KEY_CHECKS=1;