<?php

namespace infrastructure\Product\Service;

use application\Product\Port\ProductFileManagerInterface;
use application\Product\Service\ProductService;
use yii\web\UploadedFile;

class ProductFileManager implements ProductFileManagerInterface
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function uploadFromRequest(object $model): array
    {
        $errors = [];
        $model->uploadPict = UploadedFile::getInstance($model, 'uploadPict');
        if ($model->uploadPict && !$model->uploadPict()) {
            $errors[] = 'Ошибка загрузки картинки';
        }

        foreach ($model::getPdfIndexes() as $index) {
            $attribute = 'uploadPdf' . $index;
            $model->$attribute = UploadedFile::getInstance($model, $attribute);
            if ($model->$attribute && !$model->uploadPdf($index)) {
                $errors[] = "Ошибка загрузки pdf {$index}";
            }
        }

        return $errors;
    }

    public function deletePict(object $model): bool
    {
        if (!$this->deleteFile($model->getPictPath())) {
            return false;
        }

        $model->img = null;
        $this->productService->saveModel($model);

        return true;
    }

    public function deletePdf(object $model, ?string $index = null): bool
    {
        $index = $index ? (int)$index : '';
        if (!$this->deleteFile($model->getPdfPath($index))) {
            return false;
        }

        $attribute = 'pdf' . $index;
        $model->$attribute = null;
        $this->productService->saveModel($model);

        return true;
    }

    private function deleteFile(?string $filename): bool
    {
        if (!$filename || !is_file($filename)) {
            return true;
        }

        return unlink($filename);
    }
}
