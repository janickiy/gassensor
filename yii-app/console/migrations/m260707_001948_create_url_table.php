<?php

use yii\db\Migration;

class m260707_001948_create_url_table extends Migration
{
    public function safeUp(): void
    {
        $this->execute(<<<'SQL'
CREATE TABLE `url` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `is_nofollow` tinyint(1) DEFAULT NULL,
  `is_noindex` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `is_nofollow` (`is_nofollow`),
  KEY `is_noindex` (`is_noindex`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SQL);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%url}}');
    }
}
