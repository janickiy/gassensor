<?php

namespace common\models\base;

use Yii;

class ApplicationsBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'applications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','description','content'], 'required'],
            [['title','description','content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    /**
     * @inheritdoc
     * @return ApplicationsBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationsBaseQuery(get_called_class());
    }
}