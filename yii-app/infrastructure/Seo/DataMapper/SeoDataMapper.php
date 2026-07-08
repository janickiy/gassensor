<?php

namespace infrastructure\Seo\DataMapper;

use domain\Seo\DataMapper\SeoDataMapperInterface;
use domain\Seo\Entity\Seo;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class SeoDataMapper extends AbstractDataMapper implements SeoDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'ref_id', 'type', 'h1', 'title', 'keyword', 'description', 'url_canonical']);
    }

    public function toEntity(object $record): Seo
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Seo::class;
    }
}
