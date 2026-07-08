<?php

namespace application\Site\Service;

use common\helpers\Uploader;

class UploadService
{
    public function uploadFromRequestFiles(array $files): string
    {
        $uploader = new Uploader([
            'name' => key($files),
        ]);

        $filename = $uploader->upload();

        return $uploader->baseUrl . '/' . basename($filename);
    }
}
