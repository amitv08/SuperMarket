CREATE TABLE `supermarket`.`shop` ( 
	`Shop_id` INT(10) NOT NULL AUTO_INCREMENT , 
	`Shop_Name` VARCHAR(30) NOT NULL , 
	`Shop_Address` VARCHAR(100) NOT NULL , 
	`Shop_Opening_Time` TIME NOT NULL , 
	`Shop_Closing_Time` TIME NOT NULL , 
	PRIMARY KEY (`Shop_id`)
	) ENGINE = InnoDB COMMENT = 'Shop Table';

CREATE TABLE `supermarket`.`product_category` ( 
	`PC_id` INT(10) NOT NULL AUTO_INCREMENT , 
	`PC_Type` VARCHAR(100) NOT NULL ,  
	PRIMARY KEY (`PC_id`)
	) ENGINE = InnoDB COMMENT = 'Product Category Table';

CREATE TABLE `supermarket`.`products` ( 
	`Product_id` INT(10) NOT NULL AUTO_INCREMENT , 
	`Product_Name` VARCHAR(100) NOT NULL ,
	`Product_MRP` INT(10) NOT NULL , 	 
	PRIMARY KEY (`Product_id`)
	) ENGINE = InnoDB COMMENT = 'Product Table';

CREATE TABLE `supermarket`.`shop_category_product` ( 
	`Shop_id` INT(10) NOT NULL , 
	`PC_id` INT(10) NOT NULL , 
	`Product_id` INT(10) NOT NULL , 
	`Quantity` INT(10) NOT NULL , 	 		 
	CONSTRAINT FK_SCP_SID FOREIGN KEY (Shop_id) REFERENCES Shop(Shop_id),
	CONSTRAINT FK_SCP_PCID FOREIGN KEY (PC_id) REFERENCES product_category(PC_id),
	CONSTRAINT FK_SCP_PID FOREIGN KEY (Product_id) REFERENCES products(Product_id)
	) ENGINE = InnoDB COMMENT = 'Product Category and Product Table';

CREATE TABLE `supermarket`.`Shopper` ( 
	`Shopper_id` INT NOT NULL AUTO_INCREMENT , 
	`Shopper_FName` VARCHAR(30) NOT NULL , 
	`Shopper_LName` VARCHAR(30) NOT NULL , 
	`Shopper_Gender` CHAR(1) NOT NULL , 
	`Shopper_Address` VARCHAR(100) NOT NULL , 
	`Shopper_Email` VARCHAR(100) NOT NULL , 
	`Shopper_MPhone` VARCHAR(100) NOT NULL , 
	`Shopper_LPhone` VARCHAR(100) NOT NULL , 
	`Shopper_Uname` VARCHAR(100) NOT NULL , 
	`Shopper_Passwd` VARCHAR(100) NOT NULL 
	PRIMARY KEY (`Shopper_id`)
	) ENGINE = InnoDB COMMENT = 'Shopper Details';


INSERT INTO 
    Shop(Shop_Name, Shop_Address, Shop_Opening_Time, Shop_Closing_Time)
VALUES
    ('Shop-No-1','Mulund','10:00','23:00'),
    ('Shop-No-2','Vikroli','10:00','23:00');

 INSERT INTO product_category(PC_Type)
VALUES('General'),('Food'),('Medicine'),('Electronics'),('Books');

INSERT INTO products (Product_Name, Product_MRP) values ('Apple', 100), ('Orange', 80), 
('Television', 1000000),('Fridge', 100),('Comic', 100),('Autobiography', 100);

INSERT INTO shop_category_product (`SCP_id`, `Shop_id`, `PC_id`, `Product_id`, `Quantity`) values (1,2,1,10), (1,2,2,5), (2,2,1,10), (2,4,3,10);


SELECT
    `s`.`Shop_Name`,
    `pc`.`PC_Type`,
    `p`.`Product_Name`
FROM
    `shop` AS `s`,
    `product_category` AS `pc`,
    `products` AS `p`,
    `shop_category_product` AS `scp`
WHERE
    `s`.`Shop_id` = `scp`.`Shop_id` AND `pc`.`PC_id` = `scp`.`PC_id` AND `p`.`Product_id` = `scp`.`Product_id`;
