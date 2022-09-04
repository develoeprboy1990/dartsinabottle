//06-07-2022
ALTER TABLE `shipping_details` ADD `address_2` TEXT NULL DEFAULT NULL AFTER `address`;  
ALTER TABLE `shipping_details` CHANGE `city_id` `city_id` VARCHAR(255) NULL DEFAULT NULL; 
ALTER TABLE `users` CHANGE `city_id` `city_id` VARCHAR(255) NULL DEFAULT NULL; 
ALTER TABLE `billing_details` CHANGE `city_id` `city_id` VARCHAR(255) NULL DEFAULT NULL; 
ALTER TABLE `billing_details` ADD `address_2` TEXT NULL DEFAULT NULL AFTER `address`; 

//13-07-2022
ALTER TABLE `users` ADD `deposit_cost` VARCHAR(255) NOT NULL DEFAULT '40' AFTER `paypal_email`; 