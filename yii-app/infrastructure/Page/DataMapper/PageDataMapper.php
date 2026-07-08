<?php

namespace infrastructure\Page\DataMapper;

use domain\Page\DataMapper\PageDataMapperInterface;
use domain\Page\Entity\Page;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class PageDataMapper extends AbstractDataMapper implements PageDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'type', 'ref_id', 'content']);
    }

    public function toEntity(object $record): Page
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Page::class;
    }
}
