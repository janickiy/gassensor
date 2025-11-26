<?php

use common\helpers\Tools;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

?>

<?php foreach ($model->getUploadFilenames() as $filename):

    $url = $model->getUploadUrl() . '/' . basename($filename);

?>
    <div class="m-1 p-1">



            <?php if (Yii::$app->user->isDeveloper()): ?>
                <?= Html::a('fix name',
                    ['fix-filename', 'id' => $model->id, 'basename' => basename($filename),],
                    ['class' => 'btn btn-sm btn-warning ms-1']) ?>

            <?php endif; ?>

            <span class="fs-07"><?= basename($filename) ?></span>

            <?php if (Tools::isPict($url)): ?>
                <br/>
                <img src="<?= $url ?>" style="width: 120px;" class="border m-2"/>
            <?php endif; ?>



        <?= Html::a('<i class="fa fa-close"></i>',
            ['delete-file', 'id' => $model->id, 'basename' => basename($filename),],
            ['class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Вы действительно хотите удалить этот файл?')"]) ?>

    </div>
<?php endforeach; ?>


