<?php
/* @var $this yii\web\View */

use common\models\Gaz;
use frontend\widgets\gazConverter\GazConverterWidget;

?>

<!-- Модальное окно -->
<div class="modal fade" id="convertModal" tabindex="-1" aria-labelledby="convertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="convertModalLabel">Конвертер газа</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <?= GazConverterWidget::widget(['title' => false]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center">
    <button style="width: 100%;" class="btn btn-primary mb-2 popup-open" data-bs-toggle="modal" data-bs-target="#convertModal">Конвертер газа</button>
</div>

<div class='gaz-links-widget card p-2 d-block mt-2 bg-light'>

    <h3>Датчики и сенсоры по типу газа</h3>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">
                Газы
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">
                Фреоны (хладагенты)
            </button>
        </li>
    </ul>
    <div class="tab-content bg-white border border-top-0" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="row m-1">
                <?php foreach (Gaz::find()->notFreons()->orderBy('title')->all() as $model): ?>
                    <?= $this->render('_item', ['model' => $model]) ?>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row m-1">
                <?php foreach (Gaz::find()->freons()->orderBy('title')->all() as $model): ?>
                    <?= $this->render('_item', ['model' => $model]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>