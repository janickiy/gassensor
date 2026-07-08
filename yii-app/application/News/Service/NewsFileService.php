<?php

namespace application\News\Service;

use RuntimeException;
use yii\web\UploadedFile;

class NewsFileService
{
    public function uploadFromRequest(object $model): void
    {
        $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
        if ($model->uploadFile) {
            $model->upload();
        }
    }

    public function deleteFile(object $model, ?string $basename): void
    {
        $model->delFile($basename);
    }

    public function fixFilename(object $model, ?string $basename): string
    {
        $filename = "{$model->uploadDir}/{$basename}";
        if (!is_file($filename)) {
            throw new RuntimeException('file not found');
        }

        $info = pathinfo($filename);
        $fixed = $this->slug((string)$info['filename']);
        $filenameNew = "{$model->uploadDir}/{$fixed}.{$info['extension']}";

        if (!rename($filename, $filenameNew)) {
            throw new RuntimeException('fail renaming');
        }

        return $filenameNew;
    }

    private function slug(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/i', '-', $text) ?? '';

        return trim($text, '-');
    }
}
