<?php
/**
 *
 * @since 2021-11-26 21:19
 */
namespace common\helpers;

use yii\base\BaseObject;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

class Uploader extends BaseObject
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $uploaded;

    public $baseUrl = '/upload';

    /**
     *
     * @var string
     *      like: Html::fileInput('name1') -> 'name1',
     *            Html::fileInput('name4[]') -> 'name4[0]', 'name4[1]'
     */
    public $name;

    public function init()
    {
        $this->uploaded = UploadedFile::getInstanceByName($this->name);
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function upload()
    {
        if (!$this->uploaded) {
            throw new \Exception("init UploadedFile required");
        }

        $basename = $this->uploaded->name;
        $basename = Inflector::transliterate($basename);
        $basename = strtolower($basename);

        $dir = $this->getDirectory();

        $filename = "$dir/$basename";

        $filename = Tools::makeFilenameUnique($filename);

        if (!$this->uploaded->saveAs($filename)) {
            throw new \Exception('fail upload');
        }

        return $filename;
    }

    /**
     * @return false|string
     */
    public function getDirectory()
    {
        return \Yii::getAlias('@documentroot' . $this->baseUrl);
    }

}

