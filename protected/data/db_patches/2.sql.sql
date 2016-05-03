
CREATE  VIEW `view_receipt_master_detail` AS select `rm`.`id` AS `id`,`rm`.`facility_master_id` AS `facility_master_id`,`rm`.`customer_id` AS `customer_id`,`rm`.`customer_name` AS `customer_name`,`rm`.`customer_address` AS `customer_address`,`rm`.`transaction_id` AS `transaction_id`,`rm`.`amount_paid` AS `amount_paid`,`rm`.`receipt_date` AS `receipt_date`,`rm`.`addedby` AS `addedby`,`rm`.`created_at` AS `created_at`,`rm`.`name_of_scheme` AS `name_of_scheme`,`rm`.`house_number` AS `house_number`,`rm`.`value_of_house` AS `value_of_house`,`rm`.`details` AS `details`,`rm`.`old_receipt_no` AS `old_receipt_no`,`rm`.`deleted` AS `deleted`,`rd`.`payment_type_id` AS `payment_type_id`,`rd`.`payment_type` AS `payment_type`,`rd`.`cheque_number` AS `cheque_number`,`rd`.`bank_id` AS `bank_id`,`rd`.`bank_name` AS `bank_name`,`rd`.`cheque_date` AS `cheque_date`,`rd`.`amount` AS `amount` from (`payment_receipts_master` `rm` join `payment_receipt_details` `rd` on((`rm`.`id` = `rd`.`payment_receipt_master_id`)));
