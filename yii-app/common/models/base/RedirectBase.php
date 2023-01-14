<?php
/**
 * generated 2021-12-17 15:00:36
 */

namespace common\models\base;

use common\models\User;
use Yii;

/**
 * This is the model class for table "redirect".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $from
 * @property string $to
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class RedirectBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['from', 'to'], 'required'],
            [['from', 'to'], 'string', 'max' => 255],
            [['from'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @inheritdoc
     * @return RedirectBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RedirectBaseQuery(get_called_class());
    }
}
