<?php
Yii::setAlias('@root', dirname(dirname(dirname(__DIR__))));
Yii::setAlias('@yiiapp', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@documentroot', dirname(dirname(dirname(__DIR__))) . '/public_html');
