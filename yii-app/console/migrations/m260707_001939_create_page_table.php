<?php

use yii\db\Migration;

class m260707_001939_create_page_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `ref_id` int DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_2` (`type`,`ref_id`),
  KEY `type` (`type`),
  KEY `ref_id` (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%page}}');
    }
}
