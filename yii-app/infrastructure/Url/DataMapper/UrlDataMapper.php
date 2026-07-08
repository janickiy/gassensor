<?php

namespace infrastructure\Url\DataMapper;

use domain\Url\DataMapper\UrlDataMapperInterface;
use domain\Url\Entity\Url;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class UrlDataMapper extends AbstractDataMapper implements UrlDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'url', 'is_nofollow', 'is_noindex']);
    }

    public function toEntity(object $record): Url
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Url::class;
    }
}
