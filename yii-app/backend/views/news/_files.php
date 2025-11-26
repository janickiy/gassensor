<?php

use common\helpers\Tools;

/* @var $this yii\web\View */
/* @var $model common\models\News */

?>

<?php foreach ($model->getUploadFilenames() as $filename):

    $url = $model->getUploadUrl() . '/' . basename($filename);

    ?>
    <div class="m-1 p-1">

        <?php if (Tools::isPict($url)): ?>
            <br/>
            <img src="<?= $url ?>" style="width: 120px;" class="border m-2"/>
        <?php endif; ?>

    </div>
<?php endforeach; ?>


