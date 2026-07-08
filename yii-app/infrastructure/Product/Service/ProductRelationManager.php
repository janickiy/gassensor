<?php

namespace infrastructure\Product\Service;

use application\Product\Port\ProductRelationManagerInterface;
use common\models\ProductRange;

class ProductRelationManager implements ProductRelationManagerInterface
{
    public function saveCreateRelations(object $model, array $productGazData, array $modelsRange): void
    {
        $mainGazId = $productGazData['is_main'] ?? null;
        $model->saveGazs(array_unique(array_filter([$mainGazId])));
        if ($mainGazId) {
            $model->saveMainbGaz($mainGazId);
        }
        $this->saveOptionalMainGazs($model, $productGazData);
        $this->saveRanges($model, $modelsRange);
    }

    public function saveUpdateRelations(object $model, array $productGazData, array $modelsRange, array $productRangeData): void
    {
        if (!isset($productGazData['is_main'])) {
            return;
        }

        $ids = [$productGazData['is_main']];
        if (isset($productGazData['gaz_id']) && is_array($productGazData['gaz_id'])) {
            $ids = array_merge($ids, $productGazData['gaz_id']);
        }
        foreach (['is_main_2', 'is_main_3'] as $field) {
            if (!empty($productGazData[$field])) {
                $ids[] = $productGazData[$field];
            }
        }

        $model->saveGazs(array_unique(array_filter($ids)));
        $model->saveMainbGaz($productGazData['is_main']);
        $this->saveOptionalMainGazs($model, $productGazData);
        $this->deleteRemovedRanges($productRangeData);
        $this->saveRanges($model, $modelsRange);
    }

    private function saveOptionalMainGazs(object $model, array $productGazData): void
    {
        if (!empty($productGazData['is_main_2'])) {
            $model->saveMainbGaz2($productGazData['is_main_2']);
        }
        if (!empty($productGazData['is_main_3'])) {
            $model->saveMainbGaz3($productGazData['is_main_3']);
        }
    }

    private function saveRanges(object $model, array $modelsRange): void
    {
        foreach ($modelsRange as $modelRange) {
            $modelRange->product_id = $model->id;
            $modelRange->save(false);
        }
    }

    private function deleteRemovedRanges(array $productRangeData): void
    {
        $deletedIds = [];
        foreach ($productRangeData as $rangeData) {
            if (!isset($rangeData['pos'], $rangeData['unit'], $rangeData['to']) && isset($rangeData['id'])) {
                $deletedIds[] = $rangeData['id'];
            }
        }

        if ($deletedIds !== []) {
            ProductRange::deleteAll(['id' => $deletedIds]);
        }
    }
}
