<?php

use yii\db\Migration;

class m260707_001934_create_gaz_to_group_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `gaz_to_group` (
  `gaz_id` int NOT NULL,
  `gaz_group_id` int NOT NULL,
  UNIQUE KEY `gaz_id` (`gaz_id`,`gaz_group_id`),
  KEY `gaz_to_group_gaz_id_foreign` (`gaz_id`),
  KEY `gaz_to_group_gaz_group_foreign` (`gaz_group_id`),
  CONSTRAINT `fk_gaztogroup_gaz` FOREIGN KEY (`gaz_id`) REFERENCES `gaz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_gaztogroup_group` FOREIGN KEY (`gaz_group_id`) REFERENCES `gaz_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%gaz_to_group}}');
    }
}
