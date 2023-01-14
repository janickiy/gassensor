<?php
/* @var $this \yii\web\View */
/* @var $exception \Exception */
/* @var $handler \yii\web\ErrorHandler */
use common\widgets\TraceViewer;
use yii\helpers\Html;
use common\helpers\Tools;

?>
<?php if (method_exists($this, 'beginPage')): ?>
    <?php $this->beginPage() ?>
<?php endif ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>exception.php</title>

    <?php if (method_exists($this, 'head')): ?>
        <?php $this->head() ?>
    <?php endif ?>

<!-- yii\web\ErrorHandler -->
<?php if (!$this instanceof \yii\web\View): ?>
  <link href="/lib/hl/theme-rdark.css" rel="stylesheet">
  <script src="/lib/hl/syntaxhighlighter.js"></script>
<?php endif; ?>

<style>

body {
    background: #222;
    color: orange;
    padding: 0 8px;
}

.syntaxhighlighter {
    font-size: 0.8rem !important;
}

.trace-item {
    border: 1px solid #444;
    margin-bottom: 8px;
    padding: 2px 4px;
    border-radius: 8px;
}

.trace-item .header {
    font-size: 0.7rem;
    font-family: consolas;
}

</style>

</head>
<body>

<?php
    $trace = $exception->getTrace();
?>

<h3>Name: <?= $name = $handler->getExceptionName($exception) ?></h3>
<h3>Message: <pre><?= $exception->getMessage() ?></pre></h3>
<h3>Class: <?= get_class($exception) ?></h3>
<h4>$this: <?= get_class($this) ?></h4>

<?php if ($exception instanceof \yii\web\HttpException): ?>
    <h4>http status code: <?= (int)$exception->statusCode ?></h4>
<?php endif; ?>

<?php if ($exception instanceof \yii\base\ViewNotFoundException): ?>
  <?= Html::a(
      'create view file',
      ['my-tools/create-view', 'filename' => $trace[0]['args']['0']],
      ['target' => '_blank'],
  )?>
<?php elseif($exception instanceof yii\db\Exception): ?>

    <?php
        $sql = $trace[0]['args'][1];
    ?>

    <?= Tools::sqlFormatting($sql) ?>

<?php endif; ?>


<?= TraceViewer::widget([
    'exception' => $exception,
]) ?>


<h3>
previous exception
</h3>

<?php

///var_dump($exception->getPrevious());

?>

<?php if (0): ?>


<!--
<div class="previous">
    <span class="arrow">&crarr;</span>
    <h2>
        <span>Caused by:</span>
        <?php $name = $handler->getExceptionName($exception) ?>
        <?php if ($name !== null): ?>
            <span><?= $handler->htmlEncode($name) ?></span> &ndash;
            <?= $handler->addTypeLinks(get_class($exception)) ?>
        <?php else: ?>
            <span><?= $handler->htmlEncode(get_class($exception)) ?></span>
        <?php endif; ?>
    </h2>
    <h3><?= nl2br($handler->htmlEncode($exception->getMessage())) ?></h3>
    <p>in <span class="file"><?= $exception->getFile() ?></span> at line <span class="line"><?= $exception->getLine() ?></span></p>
    <?php if ($exception instanceof \yii\db\Exception && !empty($exception->errorInfo)): ?>
        <pre>Error Info: <?= $handler->htmlEncode(print_r($exception->errorInfo, true)) ?></pre>
    <?php endif ?>
    <?= $handler->renderPreviousExceptions($exception) ?>
</div>
 -->
<?php endif; ?>

<h3>
request
</h3>
    <div class="request">
        <div class="code">
            <?= $handler->renderRequest() ?>
        </div>
    </div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




