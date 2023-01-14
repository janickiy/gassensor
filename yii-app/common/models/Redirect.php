<?php

namespace common\models;

use common\models\base\RedirectBase;
use common\models\query\RedirectQuery;
use common\models\traits\{CreatedUpdateByText,CreatedUpdateAtText};
use yii\behaviors\{BlameableBehavior,TimestampBehavior};
use common\helpers\Tools;

class Redirect extends RedirectBase
{
    use CreatedUpdateAtText;
    use CreatedUpdateByText;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['from', 'to'], 'filter', 'filter' => function($val) {
                return Tools::urlToPath($val);
            }],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return RedirectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RedirectQuery(get_called_class());
    }
}
