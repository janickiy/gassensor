<?php

use yii\helpers\Html;
use common\models\Setting;

/* @var $this yii\web\View */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'sort' => '-id']];

?>
<div class="row">

    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <!-- widget options:
            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
            data-widget-colorbutton="false"
            data-widget-editbutton="false"
            data-widget-togglebutton="false"
            data-widget-deletebutton="false"
            data-widget-fullscreenbutton="false"
            data-widget-custombutton="false"
            data-widget-collapsed="true"
            data-widget-sortable="false"
            -->

            <!-- widget div-->
            <div>

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= Html::beginForm(['save']) ?>

                    <div class="form-group">
                        Email, на который отправлять заказы (Можно задать неск адресов через зпт)
                        <?= Html::textInput('setting[' . Setting::NAME_EMAIL_MANAGER_ORDER . ']', Setting::getEmailManagerOrder(), ['class' => 'form-control']) ?>
                    </div>

                    <div class="form-group">
                        Контактный номер телефона
                        <?= Html::textInput('setting[' . Setting::NAME_PHONE . ']', Setting::getPhone(), ['class' => 'form-control']) ?>
                    </div>


                    <div class="form-group">
                        Контактный номер телефона 2
                        <?= Html::textInput('setting[' . Setting::NAME_PHONE_2 . ']', Setting::getPhone2(), ['class' => 'form-control']) ?>
                    </div>

                    <div class="form-group">
                        Адрес
                        <?= Html::textInput('setting[' . Setting::NAME_ADRESS . ']', Setting::getAdress(), ['class' => 'form-control']) ?>
                    </div>

                    <div class="form-group">
                        Электронный адрес
                        <?= Html::textInput('setting[' . Setting::NAME_EMAIL . ']', Setting::getEmail(), ['class' => 'form-control']) ?>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>

                    <?= Html::endForm() ?>

                </div>

                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </div>

    </article>

</div>






