<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "applications".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $content
 */
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
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['slug', 'title'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
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
