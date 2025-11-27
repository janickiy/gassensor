<?php
/**
 * generated 2021-10-23 01:13:26
 */

namespace common\models\base;

use Yii;


/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $created_at
 * @property string $date
 * @property string $slug
 * @property string $title
 * @property string $content
 */
class NewsBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['date'], 'safe'],
            [['title', 'content'], 'required'],
            [['content'], 'string', 'max' => 300],
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
            'created_at' => Yii::t('app', 'Created At'),
            'date' => Yii::t('app', 'Date'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    /**
     * @inheritdoc
     * @return NewsBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsBaseQuery(get_called_class());
    }
}
