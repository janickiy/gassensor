<?php
/**
 * generated 22-02-13 18:47:35
 *
 */

namespace common\models;

use common\helpers\Tools;
use common\models\base\UrlBase;
use common\models\query\UrlQuery;

class Url extends UrlBase
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['url'], 'filter', 'filter' => function($val) {
                return Tools::urlToPath($val);
            }],
        ]);
    }

    /**
     * @inheritdoc
     * @return UrlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UrlQuery(get_called_class());
    }
}