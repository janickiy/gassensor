<?php
/* @var $this yii\web\View */
/* @var $formAdd common\components\cart\AddToCartForm */
/* @var $hiddenCount bool */

use common\widgets\bs5\ModalCustomHeader;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="add-product-to-cart-wrap">
        <?php $form = ActiveForm::begin(['action' => ['cart/add']]) ?>

          <?= $form->field($formAdd, 'productId')->hiddenInput(['id'=>'addtocartform-productid-p' . $model->id])->label(false) ?>

          <?php
            $countControl = $form->field($formAdd, 'count');
          ?>
          <?php if($hiddenCount): ?>
          	<?= $countControl->hiddenInput(['id'=>'addtocartform-productid-' . $model->id])->label(false) ?>
          <?php else: ?>
          	<?= $countControl->input('number', ['class' => 'cart-item-count'])->label('Кол-во') ?>
          <?php endif; ?>

          <?= Html::submitButton('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg> Добавить в корзину', ['class' => 'btn btn-success mt-1 ',]) ?>

        <?php ActiveForm::end(); ?>

        <?php ModalCustomHeader::begin([
            'title' => 'Корзина',
            'footer' => Html::button('Продолжить покупки', ['class' => 'btn btn-continue', 'data-bs-dismiss' => 'modal'])
                . Html::a('Оформить заказ', '/cart', ['class' => 'btn', 'onclick' => "ym(85084891,'reachGoal','CLICK_ON_CART')"])
        ]) ?>



    <table class="cart-item table">
      <tr>
        <th>Фото</th>
        <th>Наименование</th>
        <th>Кол-во, шт</th>
      </tr>
      <tr>
        <td>
        <?php
          $url = $model->getPictUrl() ?: '/i/no-photo.gif';
        ?>

          <div class="col">
              <?= Html::img($url, [
                  'alt' => $model->name,
                  'loading' => "lazy",
                  'title' => $model->name,
                  'style' => 'width: 120px;',
              ]) ?>
          </div>

        </td>
        <td><?= $model->name ?></td>
        <td>
          <?= Html::input('number', 'count', 1, ['style' => 'width: 100px;', 'class' => 'cart-item-count']) ?>
        </td>
      </tr>
    </table>


        <?php ModalCustomHeader::end();?>

    </div>