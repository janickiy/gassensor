<?php

use yii\db\Migration;

class m260707_001941_create_order_product_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `order_product` (
  `order_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `product_info` varchar(255) DEFAULT NULL,
  `count` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  UNIQUE KEY `order_id_2` (`order_id`,`product_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_order_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_order_product_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%order_product}}');
    }
}
