<?php
/* @var $this yii\web\View */

use common\models\Seo;
use yii\widgets\LinkPager;

$seo = Seo::findOne(['type' => Seo::TYPE_PAGE_REMAINS])->registerMetaTags($this);

$this->params['breadcrumbs'][] = $this->title;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
    <h1><?= $seo->h1 ?></h1>

    <div class="row">
        <div class="col-12 col-sm-12">

            <table class="table  table-striped table-bordered">
                <thead>
                <tr>
                    <th>Позиция</th>
                    <th>Газ</th>
                    <th class="text-nowrap">Количество</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($sensors as $sensor): ?>

                    <tr>
                        <td>
                            <?php if ($sensor->link): ?>
                                <a href="<?= $sensor->link ?>"><?= $sensor->name ?></a>
                            <?php else: ?>
                                <?= $sensor->name ?>
                            <?php endif; ?>
                        </td>
                        <td><?= $sensor->name2 ?></td>
                        <td><?= $sensor->count ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>

        <div class="col-12 mt-3">
            <?= LinkPager::widget([
                    'pagination' => $pages,
            ]); ?>
        </div>
    </div>
</div>


