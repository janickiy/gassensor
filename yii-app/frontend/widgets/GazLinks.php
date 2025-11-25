<?php
/**
 *
 * @since 2021-11-15 18:24
 */
namespace frontend\widgets;

use yii\base\Widget;

class GazLinks extends Widget
{
    public function run()
    {
        return $this->render('gaz-links');
    }

}
