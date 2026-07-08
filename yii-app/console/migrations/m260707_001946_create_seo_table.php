<?php

use yii\db\Migration;

class m260707_001946_create_seo_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `seo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_id` int DEFAULT NULL,
  `type` int NOT NULL,
  `h1` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keyword` text,
  `description` text,
  `url_canonical` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_id_2` (`ref_id`,`type`),
  KEY `ref_id` (`ref_id`),
  KEY `url_canonical` (`url_canonical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%seo}}');
    }
}
