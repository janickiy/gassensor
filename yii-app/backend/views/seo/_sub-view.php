<?php
/* @var $this yii\web\View */
/* @var $model common\models\Seo */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>

<?php if ($model): ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'h1',
            'title',
            'keyword:ntext',
            'description:ntext',
            'url_canonical',
        ],
    ]) ?>

<?php else: ?>
  Нет данных
  <?= Html::a('Создать', Url::current(['update']), ['class' => 'btn btn-primary']) ?>
<?php endif; ?>

