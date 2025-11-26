<?php
/**
 * @since 2022-03-16
 */
namespace frontend\widgets;

use yii\base\Widget;

class CartAddWidget extends Widget
{
    /**
     * @var \common\components\cart\AddToCartForm
     */
    public $formAdd;

    /**
     * @var \common\models\Product
     */
    public $model;

    public $hiddenCount = true;

    public $tableGrid = false;

    public function run()
    {
        return $this->render('cart-add', [
            'formAdd' => $this->formAdd,
            'model' => $this->model,
            'hiddenCount' => $this->hiddenCount,
            'tableGrid' => $this->tableGrid,

        ]);
    }
}
