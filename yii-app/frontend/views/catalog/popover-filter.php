<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//var_dump($searchModel->attributes);

use yii\helpers\Html;

$count = $dataProvider->query->count();

/* @var $request \yii\web\Request */
$request = Yii::$app->request;

$route = $request->post();

array_unshift($route, '/catalog');

?>

<?php if ($count): ?>

    Выбрано товаров <?= $count ?> шт. <?= Html::a('Показать', $route) ?>

<?php else: ?>

    Не найдено. <?= Html::a('Сбросить фильтры', '/catalog') ?>

<?php endif; ?>

