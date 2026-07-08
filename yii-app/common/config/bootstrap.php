<?php
Yii::setAlias('@root', dirname(dirname(dirname(__DIR__))));
Yii::setAlias('@yiiapp', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@application', dirname(dirname(__DIR__)) . '/application');
Yii::setAlias('@domain', dirname(dirname(__DIR__)) . '/domain');
Yii::setAlias('@infrastructure', dirname(dirname(__DIR__)) . '/infrastructure');
Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/modules');
Yii::setAlias('@documentroot', dirname(dirname(dirname(__DIR__))) . '/public_html');
