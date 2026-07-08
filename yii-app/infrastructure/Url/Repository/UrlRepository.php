<?php

namespace infrastructure\Url\Repository;

use domain\Url\DataMapper\UrlDataMapperInterface;
use domain\Url\Entity\Url;
use domain\Url\Repository\UrlRepositoryInterface;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;
use infrastructure\Url\ActiveRecord\UrlAR;

class UrlRepository extends ActiveRecordCrudRepository implements UrlRepositoryInterface
{
    public function __construct(UrlDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return UrlAR::class;
    }

    protected function entityName(): string
    {
        return 'Url';
    }

    public function get(int $id): Url
    {
        return $this->getEntity($id);
    }

    public function save(Url $entity): Url
    {
        return $this->saveEntity($entity);
    }
}
