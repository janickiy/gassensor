<?php

namespace application\Manufacture\Service;

use yii\web\UploadedFile;

class ManufactureFileService
{
    public function uploadPictFromRequest(object $model): bool
    {
        $model->uploadPict = UploadedFile::getInstance($model, 'uploadPict');
        if (!$model->uploadPict) {
            return true;
        }

        return $model->uploadPict();
    }
}
