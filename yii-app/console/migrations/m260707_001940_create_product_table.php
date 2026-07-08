<?php

use yii\db\Migration;

class m260707_001940_create_product_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `manufacture_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(3) DEFAULT NULL,
  `pdf` varchar(100) DEFAULT NULL,
  `pdf2` varchar(100) DEFAULT NULL,
  `pdf3` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `measurement_type_id` int NOT NULL,
  `formfactor` varchar(30) DEFAULT NULL,
  `formfactor_unit` varchar(20) DEFAULT NULL,
  `range_from` float DEFAULT NULL,
  `range_to` float DEFAULT NULL,
  `range_unit` varchar(30) DEFAULT NULL,
  `resolution` float DEFAULT NULL,
  `sensitivity` varchar(255) DEFAULT NULL,
  `sensitivity_first` varchar(100) DEFAULT NULL,
  `sensitivity_analog` varchar(100) DEFAULT NULL,
  `sensitivity_digital` varchar(100) DEFAULT NULL,
  `sensitivity_from` float DEFAULT NULL,
  `sensitivity_to` float DEFAULT NULL,
  `sensitivity_unit` varchar(20) DEFAULT NULL,
  `response_time` float DEFAULT '0',
  `response_time_unit` varchar(10) DEFAULT NULL,
  `energy_consumption_from` float DEFAULT NULL,
  `energy_consumption_to` float DEFAULT NULL,
  `energy_consumption_unit` varchar(10) DEFAULT NULL,
  `temperature_range_from` int DEFAULT '0',
  `temperature_range_to` int DEFAULT '0',
  `info` varchar(512) DEFAULT NULL,
  `bias_voltage` varchar(255) NOT NULL,
  `first` tinyint(1) NOT NULL DEFAULT '0',
  `analog` tinyint(1) NOT NULL DEFAULT '0',
  `digital` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `manufacture_id` (`manufacture_id`),
  KEY `measurement_type_id` (`measurement_type_id`),
  CONSTRAINT `fk_product_manufacture` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_product_measurement_type` FOREIGN KEY (`measurement_type_id`) REFERENCES `measurement_type` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%product}}');
    }
}
