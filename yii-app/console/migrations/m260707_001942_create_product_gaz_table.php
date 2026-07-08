<?php

use yii\db\Migration;

class m260707_001942_create_product_gaz_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `product_gaz` (
  `product_id` int NOT NULL,
  `gaz_id` int NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `is_main_2` tinyint(1) NOT NULL DEFAULT '0',
  `is_main_3` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`gaz_id`),
  KEY `product_id` (`product_id`),
  KEY `gaz_id` (`gaz_id`),
  KEY `is_main` (`is_main`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%product_gaz}}');
    }
}
