<?php

namespace infrastructure\Seo\Repository;

use domain\Seo\DataMapper\SeoDataMapperInterface;
use domain\Seo\Entity\Seo;
use domain\Seo\Repository\SeoRepositoryInterface;
use infrastructure\Seo\ActiveRecord\SeoAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class SeoRepository extends ActiveRecordCrudRepository implements SeoRepositoryInterface
{
    public function __construct(SeoDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return SeoAR::class;
    }

    protected function entityName(): string
    {
        return 'Seo';
    }

    public function get(int $id): Seo
    {
        return $this->getEntity($id);
    }

    public function save(Seo $entity): Seo
    {
        return $this->saveEntity($entity);
    }
}
