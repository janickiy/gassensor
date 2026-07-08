<?php

namespace infrastructure\News\DataMapper;

use domain\News\DataMapper\NewsDataMapperInterface;
use domain\News\Entity\News;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class NewsDataMapper extends AbstractDataMapper implements NewsDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'created_at', 'date', 'slug', 'title', 'content']);
    }

    public function toEntity(object $record): News
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return News::class;
    }
}
