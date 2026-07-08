<?php

namespace application\Product\Port;

interface ProductRelationManagerInterface
{
    public function saveCreateRelations(object $model, array $productGazData, array $modelsRange): void;

    public function saveUpdateRelations(object $model, array $productGazData, array $modelsRange, array $productRangeData): void;
}
