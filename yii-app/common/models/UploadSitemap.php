<?php


namespace common\models;

use yii\base\Model;

class UploadSitemap extends Model
{
    public $file;

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            ['file', 'file',
                'extensions' => ['xml'],
                'checkExtensionByMimeType' => true,
            ],
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs("../../public/{$this->file->baseName}.{$this->file->extension}");
            return true;
        } else {
            return false;
        }
    }
}