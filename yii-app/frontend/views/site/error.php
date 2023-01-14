<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use common\widgets\TraceViewer;
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>

<?php if (defined('CUSTOM_ERROR_VIEWER')): ?>
error.php
<style>
    .site-error {
        background: #222;
        color: orange;
        padding: 4px;
    }

    .site-error h1,
    .site-error h3 {
        color: red;
    }

    .syntaxhighlighter {
        _font-size: 0.95rem !important;
    }
    .trace-item {
        border: 1px solid #444;
        margin-bottom: 4px;
        padding: 2px 4px;
        border-radius: 8px;
    }
    .trace-item .header {
        font-size: 0.7rem;
        font-family: consolas;
    }
</style>

<h3 >message: <?= $exception->getMessage() ?></h3>
<h3 >class: <?= get_class($exception) ?></h3>
<?php

if ($exception instanceof \yii\web\HttpException) {
    echo 'statusCode: ' . (int)$exception->statusCode;
}

if ($exception instanceof \yii\web\NotFoundHttpException) {

    echo '<br/>' . Html::a(
        'create action ' . Yii::$app->requestedRoute,
        ['my-tools/create-action', 'route' => Yii::$app->requestedRoute, 'queryParams' => Yii::$app->request->queryParams],
        ['target' => '_blank', 'class' => 'btn']
    );

}

?>


<?= TraceViewer::widget([
    'exception' => $exception,
]) ?>

<?php endif; ?>

</div>
