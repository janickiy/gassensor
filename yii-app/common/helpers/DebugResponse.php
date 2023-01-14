<?php
/**
 * how to use: add to config/main.php
 *  'as debugResponse' => ['class' => \common\helpers\DebugResponse::class],
 * @since 2018-10-23 14:15
 */

namespace common\helpers;

use yii\base\Behavior;

class DebugResponse extends Behavior
{
    public function init()
    {
        \Yii::configure(\Yii::$app, [
            'components' => [
                'response' => [
                    'class' => '\common\helpers\CustomResponse',
                ],
            ]
        ]);
    }
}