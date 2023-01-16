<?php
/**
 *
 * @since 2021-11-15 11:03
 */
namespace frontend\widgets\gazConverter;

use yii\base\Widget;

class GazConverterWidget extends Widget
{
    public $title = 'Конвертер';

    public function run()
    {
        return $this->render('run');
    }
}
