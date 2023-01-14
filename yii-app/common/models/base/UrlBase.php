<?php
/**
 * generated 2022-02-14 14:41:28
 */

namespace common\models\base;

use Yii;


/**
 * This is the model class for table "url".
 *
 * @property integer $id
 * @property string $url
 * @property integer $is_nofollow
 * @property integer $is_noindex
 */
class UrlBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['is_nofollow', 'is_noindex'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'is_nofollow' => Yii::t('app', 'Is Nofollow'),
            'is_noindex' => Yii::t('app', 'Is Noindex'),
        ];
    }

    /**
     * @inheritdoc
     * @return UrlBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UrlBaseQuery(get_called_class());
    }
}
