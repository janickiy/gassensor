<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

use common\helpers\Tools;
use yii\helpers\Html;

?>
<a class="col-md-4 col-sm-6 col-xs-12 news-box p-1" href="/news/<?= $model->slug ?>">
  <div class="post-box post type-post entry">
  <div class="header-post">
      <header class="entry-header">
          <div class="entry-meta">
          <span class="posted-on">
            <span class="entry-date published">
                <?php
                    $time = strtotime($model->date);
                ?>
              <span class="date text-right">
                <?= Tools::$months[date('n', $time) -1] ?>
                <?= date('Y', $time) ?>
              </span>
            </span>
          </span>
          </div>
      </header>
  </div>

  <div class="entry-media">
    <?php
        $url = $model->getPictUrl() ?: 'https://dummyimage.com/240x160/fff/aaa.png&text=no%20foto';
    ?>
    <?= Html::img($url, ['alt' => $model->title, 'loading' => "lazy", 'title' => $model->title,]) ?>
  </div>
  <div class="inner-post">
      <div class="entry-summary">
      <p>
        <?= mb_substr(strip_tags($model->content), 0, 100) ?>&nbsp;...
      </p>
      </div>
  </div>
  </div>
</a>