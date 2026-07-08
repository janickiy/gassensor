<?php

namespace application\Product\Port;

interface ProductFileManagerInterface
{
    public function uploadFromRequest(object $model): array;

    public function deletePict(object $model): bool;

    public function deletePdf(object $model, ?string $index = null): bool;
}
