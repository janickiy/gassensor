<?php
/**
 * generated 2021-11-17 15:33:42
 */

namespace common\models\base;

use Yii;


/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $ref_id
 * @property string $content
 */
class PageBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'content'], 'required'],
            [['type', 'ref_id'], 'integer'],
            [['content'], 'string'],
            [['type', 'ref_id'], 'unique', 'targetAttribute' => ['type', 'ref_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'ref_id' => Yii::t('app', 'Ref ID'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    /**
     * @inheritdoc
     * @return PageBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageBaseQuery(get_called_class());
    }
}
