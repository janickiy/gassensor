<?php

namespace application\Seo\Service;

use Yii;
use yii\web\UploadedFile;

class SeoTextFileService
{
    public function readRobots(): string
    {
        return $this->read('robots.txt');
    }

    public function saveRobots(string $content): void
    {
        $this->write('robots.txt', $content);
    }

    public function readGoogleUrlList(): string
    {
        return $this->read('url_list.txt');
    }

    public function saveGoogleUrlList(string $content): void
    {
        $this->write('url_list.txt', $content);
    }

    public function uploadSitemapFromRequest(object $model): bool
    {
        $model->file = UploadedFile::getInstance($model, 'file');
        if (!$model->file) {
            return false;
        }

        return $model->upload();
    }

    private function read(string $filename): string
    {
        $path = $this->path($filename);

        return is_file($path) ? (string)file_get_contents($path) : '';
    }

    private function write(string $filename, string $content): void
    {
        file_put_contents($this->path($filename), $content);
    }

    private function path(string $filename): string
    {
        return rtrim(Yii::getAlias('@documentroot'), '/') . '/' . ltrim($filename, '/');
    }
}
