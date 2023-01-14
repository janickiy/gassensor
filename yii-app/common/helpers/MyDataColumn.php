<?php
/**
 *
 * @since 2020-02-24 18:00
 */
namespace common\helpers;

use yii\grid\DataColumn;

class MyDataColumn extends DataColumn
{
    /**
     * @var \yii\base\Model
     */
    public $model;

    public $tpl;

    public $format = 'raw';

    public $cls;

    public function init()
    {
        if ($tpl = $this->tpl) {
            $this->value = function($model) use ($tpl){
                return \Yii::$app->view->render($tpl, ['model' => $model]);
            };
        }

        if ($cls = $this->cls) {

            $this->contentOptions = function($model, $key, $index, $col) use ($cls) {
                return [
                    'class' => is_callable($cls) ? call_user_func_array($cls, func_get_args()) : $cls,
                ];
            };
        }
    }

}
