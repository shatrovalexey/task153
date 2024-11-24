DELIMITER $$

DROP TABLE IF EXISTS `products` $$
CREATE TABLE IF NOT EXISTS `products`
(
    `id` INT UNSIGNED NOT null AUTO_INCREMENT PRIMARY KEY ,
    `uuid` VARCHAR( 255 ) NOT null COMMENT'UUID товара' ,
    `category` VARCHAR( 255 ) NOT null COMMENT'Категория товара' ,
    `is_active` TINYINT DEFAULT 1  NOT null COMMENT'Флаг активности' ,
    `name` TEXT NOT null COMMENT'Тип услуги' ,
    `description` TEXT NOT null COMMENT'Описание товара' ,
    `thumbnail` VARCHAR( 255 ) COMMENT'Ссылка на картинку' ,
    `price` DECIMAL( 10 , 2 ) NOT null COMMENT'Цена'
) COMMENT = 'Товары' $$

DELIMITER ;