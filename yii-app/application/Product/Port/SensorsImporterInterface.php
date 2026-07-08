<?php

namespace application\Product\Port;

use yii\web\UploadedFile;

interface SensorsImporterInterface
{
    public function importUploadedFile(UploadedFile $file): int;
}
